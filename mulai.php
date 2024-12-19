<?php
include "conf/inc.koneksi.php";

$NOIP = $_SERVER['REMOTE_ADDR'];

# Periksa apabila sudah ditemukan
// Periksa data solusi di dalam tmp
$sql_cekh = "SELECT * FROM tmp_solusi WHERE noip='$NOIP' GROUP BY kd_solusi";
$qry_cekh = mysqli_query($koneksi, $sql_cekh); // Gunakan mysqli_query
$hsl_cekh = mysqli_num_rows($qry_cekh);
if ($hsl_cekh == 1) {
    // Apabila data tmp_solusi isinya 1
    $hsl_data = mysqli_fetch_array($qry_cekh);

    // Memindahkan data tmp ke tabel hasil_analisa
    $sql_pasien = "SELECT * FROM tmp_pasien WHERE noip='$NOIP'";
    $qry_pasien = mysqli_query($koneksi, $sql_pasien);
    $hsl_pasien = mysqli_fetch_array($qry_pasien);

    // Perintah untuk memindah data
    $sql_in = "INSERT INTO analisa_hasil SET
        nama='{$hsl_pasien['nama']}',
        kelamin='{$hsl_pasien['kelamin']}',
        alamat='{$hsl_pasien['alamat']}',
        pekerjaan='{$hsl_pasien['pekerjaan']}',
        kd_solusi='{$hsl_data['kd_solusi']}',
        noip='{$hsl_pasien['noip']}',
        tanggal='{$hsl_pasien['tanggal']}'";
    mysqli_query($koneksi, $sql_in);

    // Redireksi setelah pemindahan data
    echo "<meta http-equiv='refresh' content='0; url=index.php?page=result'>";
    exit;
}

# Apabila BELUM MENEMUKAN solusi
$sqlcek = "SELECT * FROM tmp_analisa WHERE noip='$NOIP'";
$qrycek = mysqli_query($koneksi, $sqlcek);
$datacek = mysqli_num_rows($qrycek);
if ($datacek >= 1) {
    // Seandainya tmp_analisa tidak kosong
    $sqlg = "SELECT gejala.* FROM gejala,tmp_analisa
        WHERE gejala.kd_gejala=tmp_analisa.kd_gejala
        AND tmp_analisa.noip='$NOIP'
        AND NOT tmp_analisa.kd_gejala
        IN(SELECT kd_gejala
            FROM tmp_gejala WHERE noip='$NOIP')
        ORDER BY gejala.kd_gejala LIMIT 1";
    $qryg = mysqli_query($koneksi, $sqlg);
    $datag = mysqli_fetch_array($qryg);

    $kdgejala = $datag['kd_gejala'];
    $gejala = $datag['nm_gejala'];
} else {
    // Seandainya tmp kosong
    $sqlg = "SELECT * FROM gejala ORDER BY kd_gejala LIMIT 1";
    $qryg = mysqli_query($koneksi, $sqlg);
    $datag = mysqli_fetch_array($qryg);

    $kdgejala = $datag['kd_gejala'];
    $gejala = $datag['nm_gejala'];
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
                        <h3><span class="label label-default">Apakah <?php echo "$gejala"; ?> ? </span></h3>
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