<?php
include "conf/inc.koneksi.php";

# Baca variabel Form
$nama = $_REQUEST['nama'];
$kelamin = $_REQUEST['jk'];
$alamat = $_REQUEST['alamat'];
$pekerjaan = $_REQUEST['pekerjaan'];

# Validasi Form
if (trim($nama) == "") {
    include "konsultasi.php";
    echo "Nama belum diisi, ulangi kembali";
} elseif (trim($alamat) == "") {
    include "konsultasi.php";
    echo "Alamat masih kosong, ulangi kembali";
} elseif (trim($pekerjaan) == "") {
    include "konsultasi.php";
    echo "Pekerjaan masih kosong, ulangi kembali";
} else {
    $NOIP = $_SERVER['REMOTE_ADDR'];
    $sqldel = "DELETE FROM tmp_pasien WHERE noip=?";
    $stmt = mysqli_prepare($koneksi, $sqldel);
    mysqli_stmt_bind_param($stmt, "s", $NOIP);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    $sql = "INSERT INTO tmp_pasien (nama, kelamin, alamat, pekerjaan, noip, tanggal) 
            VALUES (?, ?, ?, ?, ?, NOW())";
    $stmt = mysqli_prepare($koneksi, $sql);
    mysqli_stmt_bind_param($stmt, "sssss", $nama, $kelamin, $alamat, $pekerjaan, $NOIP);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    $sqlhapus = "DELETE FROM tmp_solusi WHERE noip=?";
    $stmt = mysqli_prepare($koneksi, $sqlhapus);
    mysqli_stmt_bind_param($stmt, "s", $NOIP);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    $sqlhapus2 = "DELETE FROM tmp_analisa WHERE noip=?";
    $stmt = mysqli_prepare($koneksi, $sqlhapus2);
    mysqli_stmt_bind_param($stmt, "s", $NOIP);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    $sqlhapus3 = "DELETE FROM tmp_gejala WHERE noip=?";
    $stmt = mysqli_prepare($koneksi, $sqlhapus3);
    mysqli_stmt_bind_param($stmt, "s", $NOIP);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    echo "<meta http-equiv='refresh' content='0; url=index.php?page=start'>";
}
?>