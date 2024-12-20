<?php

include "conf/inc.koneksi.php";
# Baca variabel gejala
$kdgejala = $_REQUEST['kd_gejala'] ?? "G07";

# Nama gejala berdasarkan kode
$gejalaList = [
    "G01" => "sulit mengunyah",
    "G01a" => "sulit mengunyah",
    "G02" => "pembengkakan atau peradangan pada gusi",
    "G02a" => "pembengkakan atau peradangan pada gusi",
    "G02b" => "pembengkakan atau peradangan pada gusi",
    "G03" => "gigi bergoyang",
    "G04" => "rahang terjadi pembengkakan",
    "G05" => "demam",
    "G05a" => "demam",
    "G06" => "pembengkakan kelenjar getah bening sekitar rahang atau leher",
    "G06a" => "pembengkakan kelenjar getah bening sekitar rahang atau leher",
    "G07" => "bau mulut tak sedap",
    "G08" => "rasa sakit atau nyeri di sekitar gusi",
    "G09" => "rasa sakit yang hebat selama beberapa hari setelah pencabutan gigi",
    "G10" => "tulang terlihat pada socket",
    "G11" => "gigi terasa nyilu dan sensitif",
    "G11a" => "gigi terasa nyilu dan sensitif",
    "G12" => "bentuk gigi tampak terkikis",
    "G13" => "sakit kepala",
    "G14" => "insomnia atau merasa gelisah",
    "G15" => "suara gemeretak gigi yang terdengar ketika tidur",
    "G16" => "gusi mudah berdarah",
    "G16a" => "gusi mudah berdarah",
    "G17" => "bentuk gusi agak membulat",
    "G18" => "konsistensi gusi menjadi lunak",
    "G19" => "gusi atau gigi bernanah",
    "G19a" => "gusi atau gigi bernanah",
    "G20" => "gigi terasa sakit atau berdenyut",
    "G21" => "kemerahan pada sudut-sudut mulut",
    "G22" => "sudut mulut terasa nyeri",
    "G23" => "sudut mulut bersisik",
    "G24" => "ulkus (luka pada sudut mulut)",
    "G25" => "dentin terlihat",
    "G26" => "gigi berlubang",
    "G27" => "pulpa terinfeksi/radang pada pulpa",
    "G28" => "sakit berdenyut tanpa rangsangan",
    "G29" => "bintik putih pada gigi",
    "G30" => "bercak putih pada lidah",
    "G31" => "bercak putih pada rongga mulut",
    "G32" => "terdapat endapan plak",
    "G33" => "terdapat karang gigi",
    "G34" => "pembusukan gigi",
    "G35" => "pulpa mati rasa",
    "G36" => "ruang pulpa terbuka",
    "G37" => "gusi berwarna merah"
];

# Ambil deskripsi gejala dari array $gejalaList
$gejalaDeskripsi = $gejalaList[$kdgejala] ?? "Gejala tidak ditemukan";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nama'], $_POST['kelamin'], $_POST['alamat'], $_POST['pekerjaan'])) {
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $kelamin = mysqli_real_escape_string($koneksi, $_POST['kelamin']);
    $alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);
    $pekerjaan = mysqli_real_escape_string($koneksi, $_POST['pekerjaan']);
    $noip = $_SERVER['REMOTE_ADDR'];
    $tanggal = date("Y-m-d H:i:s");

    // Insert data ke tabel tmp_pasien
    $sql = "INSERT INTO tmp_pasien (nama, kelamin, alamat, pekerjaan, noip, tanggal) 
            VALUES ('$nama', '$kelamin', '$alamat', '$pekerjaan', '$noip', '$tanggal')";
    if (!mysqli_query($koneksi, $sql)) {
        echo "Error: " . mysqli_error($koneksi);
    }
}
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><span class="glyphicon glyphicon-hand-up"></span> Konsultasi</h3>
    </div>
    <div class="panel-body">
        <form action="?page=processcon" method="post" name="form1" target="_self">
            <table class="table" width="100%" border="0" cellpadding="2" cellspacing="1">
                <tr>
                    <td style="border:none;" colspan="2" align="center">
                        <h3><span class="label label-default">Apakah <?php echo $gejalaDeskripsi; ?> ? </span></h3>
                        <input name="TxtKdGejala" type="hidden" value="<?php echo $kdgejala; ?>">
                    </td>
                </tr>
                <tr>
                    <td style="border:none;">
                        <span class="input-group-addon"><input type="radio" name="RbPilih" value="YA" checked> Ya </span>
                        <span class="input-group-addon"><input type="radio" name="RbPilih" value="TIDAK"> Tidak </span>
                    </td>
                </tr>
                <tr>
                    <td align="center" style="border:none;">
                        <input type="submit" class="btn btn-success" name="Submit" value="Selanjutnya">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>