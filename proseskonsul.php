<?php
include "conf/inc.koneksi.php";
session_start(); // Memulai session untuk menyimpan data sementara
$noip = $_SERVER['REMOTE_ADDR'];

# Fungsi untuk menyimpan hasil diagnosa ke tabel analisa_hasil
function saveDiagnosisResult($kd_solusi, $noip, $koneksi) {
    // Ambil data pasien dari tabel tmp_pasien berdasarkan IP pengguna
    $sql_pasien = "SELECT * FROM tmp_pasien WHERE noip = '$noip' ORDER BY id DESC LIMIT 1";
    $qry_pasien = mysqli_query($koneksi, $sql_pasien) or die("Error: " . mysqli_error($koneksi));
    $data_pasien = mysqli_fetch_assoc($qry_pasien);

    if (!$data_pasien) {
        die("Data pasien tidak ditemukan. Pastikan data pasien sudah dimasukkan.");
    }

    // Data pasien
    $nama = mysqli_real_escape_string($koneksi, $data_pasien['nama']);
    $kelamin = mysqli_real_escape_string($koneksi, $data_pasien['kelamin']);
    $alamat = mysqli_real_escape_string($koneksi, $data_pasien['alamat']);
    $pekerjaan = mysqli_real_escape_string($koneksi, $data_pasien['pekerjaan']);
    $tanggal = date("Y-m-d H:i:s");

    // Simpan ke tabel analisa_hasil
    $sql = "INSERT INTO analisa_hasil (nama, kelamin, alamat, pekerjaan, kd_solusi, noip, tanggal)
            VALUES ('$nama', '$kelamin', '$alamat', '$pekerjaan', '$kd_solusi', '$noip', '$tanggal')";
    mysqli_query($koneksi, $sql) or die("Error: " . mysqli_error($koneksi));
}

# Baca variabel Form
$RbPilih = $_REQUEST['RbPilih'] ?? null; // "YA" atau "TIDAK"
$TxtKdGejala = $_REQUEST['TxtKdGejala'] ?? "G07"; // Gejala awal (default G07)

# Fungsi untuk menangani diagnosa sesuai pohon keputusan
function getNextGejalaOrSolusi($currentGejala, $jawaban)
{
    // Pohon keputusan berdasarkan diagram
    $tree = [
        // G07: Bau mulut
        "G07" => ["YA" => "G01", "TIDAK" => "G26"],

        // G01: Sulit mengunyah
        "G01" => ["YA" => "G04", "TIDAK" => "G16"],
        "G04" => ["YA" => "G08", "TIDAK" => "G08"],
        "G08" => ["YA" => "G02", "TIDAK" => "G02"],
        "G02" => ["YA" => "P08", "TIDAK" => "G05"],
        "G05" => ["YA" => "G06", "TIDAK" => "G06"],
        "G06" => ["YA" => "P02", "TIDAK" => "P02"],

        "G16" => ["YA" => "G02b", "TIDAK" => "G09"],
        "G09" => ["YA" => "G10", "TIDAK" => "G30"],
        "G10" => ["YA" => "P03", "TIDAK" => "P03"],
        "G30" => ["YA" => "G31", "TIDAK" => "G31"], 
        "G31" => ["YA" => "P13", "TIDAK" => "P13"], 

        "G02b" => ["YA" => "G19", "TIDAK" => "G32"],
        "G19" => ["YA" => "G37", "TIDAK" => "G37"],
        "G37" => ["YA" => "P16", "TIDAK" => "P16"],

        "G32" => ["YA" => "G33", "TIDAK" => "G33"],
        "G33" => ["YA" => "P14", "TIDAK" => "P14"],


        // G26: Gigi berlubang
        "G26" => ["YA" => "G25", "TIDAK" => "G02a"], 
        "G25" => ["YA" => "G11", "TIDAK" => "G29"],
        "G11" => ["YA" => "P10", "TIDAK" => "G27"],
        "G27" => ["YA" => "G28", "TIDAK" => "G28"],
        "G28" => ["YA" => "P11", "TIDAK" => "P11"],
        "G29" => ["YA" => "P12", "TIDAK" => "G34"], 
        "G34" => ["YA" => "G35", "TIDAK" => "G35"], 
        "G35" => ["YA" => "G36", "TIDAK" => "G36"],
        "G36" => ["YA" => "P15", "TIDAK" => "P15"], 

        // G26: Jalur tambahan dari G26 -> TIDAK
        "G02a" => ["YA" => "G01a", "TIDAK" => "G11a"], 
        "G01a" => ["YA" => "G03", "TIDAK" => "G16a"], 
        "G03" => ["YA" => "P01", "TIDAK" => "P01"], 
        "G16a" => ["YA" => "G17", "TIDAK" => "G05a"],
        "G17" => ["YA" => "G18", "TIDAK" => "G18"],
        "G18" => ["YA" => "P06", "TIDAK" => "P06"],
        "G05a" => ["YA" => "G06a", "TIDAK" => "G06a"],
        "G06a" => ["YA" => "G19a", "TIDAK" => "G19a"], 
        "G19a" => ["YA" => "G20", "TIDAK" => "G20"], 
        "G20" => ["YA" => "P07", "TIDAK" => "P07"],


        "G11a" => ["YA" => "G12", "TIDAK" => "G21"],
        "G12" => ["YA" => "P04", "TIDAK" => "P04"],
        "G13" => ["YA" => "G14", "TIDAK" => "G14"],
        "G14" => ["YA" => "G15", "TIDAK" => "G15"],
        "G15" => ["YA" => "P05", "TIDAK" => "P05"],

        "G21" => ["YA" => "G22", "TIDAK" => "G22"], 
        "G22" => ["YA" => "G23", "TIDAK" => "G23"], 
        "G23" => ["YA" => "G24", "TIDAK" => "G24"], 
        "G24" => ["YA" => "P09", "TIDAK" => "P09"], 
    ];

    // Kembalikan gejala berikutnya atau solusi
    return $tree[$currentGejala][$jawaban] ?? "END";
}

# Proses logika pohon keputusan
$nextGejala = getNextGejalaOrSolusi($TxtKdGejala, $RbPilih, $noip, $koneksi);

# Simpan jejak gejala ke tmp_analisa
if ($nextGejala !== "END" && strpos($nextGejala, "P") === false) {
    $sql = "INSERT INTO tmp_analisa (noip, kd_gejala) VALUES ('$noip', '$TxtKdGejala')";
    mysqli_query($koneksi, $sql) or die("Error: " . mysqli_error($koneksi));
}

if (strpos($nextGejala, "P") === 0) {
    // Simpan hasil diagnosa ke tabel analisa_hasil
    saveDiagnosisResult($nextGejala, $noip, $koneksi);

    // Redirect ke halaman hasil diagnosa
    echo "<meta http-equiv='refresh' content='0; url=index.php?page=result'>";
    exit;
} elseif ($nextGejala == "END") {
    // Jika tidak ditemukan solusi
    echo "<meta http-equiv='refresh' content='0; url=index.php?page=result&status=tidak_ditemukan'>";
    exit;
} else {
    // Redirect ke gejala berikutnya
    echo "<meta http-equiv='refresh' content='0; url=index.php?page=start&kd_gejala=$nextGejala'>";
    exit;
}
?>