<?php
include "conf/inc.koneksi.php"; // Pastikan koneksi menggunakan mysqli

# Mendapatkan No IP Lokal
$NOIP = $_SERVER['REMOTE_ADDR'];

# Perintah Ambil data analisa_hasil
$sql = "SELECT analisa_hasil.*, solusi.*
        FROM analisa_hasil
        INNER JOIN solusi ON solusi.kd_solusi = analisa_hasil.kd_solusi
        WHERE analisa_hasil.noip = '$NOIP'
        ORDER BY analisa_hasil.id DESC LIMIT 1";
$qry = mysqli_query($koneksi, $sql) or die("Query Hasil salah: " . mysqli_error($koneksi));
$data = mysqli_fetch_array($qry);

$sql2 = "SELECT * FROM tmp_pasien WHERE noip = '$NOIP'";
$qry2 = mysqli_query($koneksi, $sql2) or die("Query Hasil salah: " . mysqli_error($koneksi));
$data2 = mysqli_fetch_array($qry2);

# Membuat hasil Pria atau Wanita
$kelamin = ($data2['kelamin'] == "P") ? "Pria" : "Wanita";
?>

<body onload="window.print();" Layout="Portrait">

<table width="100%" border="0" cellpadding="3" cellspacing="1">
    <tr align="center">
        <td colspan="3">
            <font color="#d1ad2e"><b>HASIL DIAGNOSIS PENYAKIT</b></font>
            <hr color="#d1ad2e">
        </td>
    </tr>
    <tr>
        <td colspan="3"><br><br><b>DATA PASIEN</b></td>
    </tr>
    <tr>
        <td width="86">Nama</td>
        <td>:</td>
        <td width="989"><?php echo $data2['nama']; ?></td>
    </tr>
    <tr>
        <td>Kelamin</td>
        <td>:</td>
        <td><?php echo $kelamin; ?></td>
    </tr>
    <tr>
        <td>Alamat</td>
        <td>:</td>
        <td><?php echo $data2['alamat']; ?></td>
    </tr>
    <tr>
        <td>Pekerjaan</td>
        <td>:</td>
        <td><?php echo $data2['pekerjaan']; ?></td>
    </tr>
</table>

<table width="100%" border="0" cellpadding="2" cellspacing="1">
    <tr>
        <td colspan="2"><br><br><b>HASIL DIAGNOSIS</b></td>
    </tr>
    <tr>
        <td width="86">Penyakit</td>
        <td width="689"><?php echo $data['nm_solusi']; ?></td>
    </tr>
    <tr>
        <td valign="top">Gejala</td>
        <td>
            <?php
            # Menampilkan Daftar Gejala
            $sql_gejala = "SELECT gejala.*
                           FROM gejala
                           INNER JOIN rule ON gejala.kd_gejala = rule.kd_gejala
                           WHERE rule.kd_solusi = '{$data['kd_solusi']}'
                           ORDER BY gejala.kd_gejala";
            $qry_gejala = mysqli_query($koneksi, $sql_gejala);
            $i = 1;
            while ($hsl_gejala = mysqli_fetch_array($qry_gejala)) {
                echo "$i . {$hsl_gejala['nm_gejala']} <br>";
                $i++;
            }
            ?>
        </td>
    </tr>
    <tr>
        <td valign="top">Definisi</td>
        <td><?php echo $data['definisi']; ?></td>
    </tr>
    <tr>
        <td valign="top">Solusi</td>
        <td><?php echo $data['solusi']; ?></td>
    </tr>
</table>

</body>
