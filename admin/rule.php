<?php 
include('inc.session.php'); 
include('inc.koneksi.php'); 
include('atas.php'); 

// Menambahkan data aturan
if(isset($_GET['entri'])) { 
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><span class="glyphicon glyphicon-plus"></span> Tambah Data Aturan</h3>
    </div>
    <div class="panel-body">
        <form class="form-horizontal" name="form1" method="post">
            <div class="form-group">
                <label class="col-sm-2 control-label">Daftar Penyakit</label>
                <div class="col-sm-5">
                    <select class="form-control" name="CmbSolusi">
                        <option value="0"> Nama Penyakit </option>
                        <?php
                        // Menampilkan daftar penyakit
                        $sqlp = "SELECT * FROM solusi ORDER BY kd_solusi";
                        $qryp = mysqli_query($koneksi, $sqlp) or die ("SQL Error: ".mysqli_error($koneksi));
                        while ($datap = mysqli_fetch_array($qryp)) {
                            echo "<option value='$datap[kd_solusi]'>$datap[nm_solusi]</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
            
            <!-- Menampilkan daftar gejala -->
            <div class="form-group">
                <label class="col-sm-2 control-label">Daftar Gejala</label>
                <div class="col-sm-10">
                    <?php
                    $sql = "SELECT * FROM gejala ORDER BY kd_gejala";
                    $qry = mysqli_query($koneksi, $sql);
                    if (mysqli_num_rows($qry) == 0) {
                        echo "Tidak ada gejala yang ditemukan.";
                    } else {
                        while ($data = mysqli_fetch_array($qry)) {
                            echo "<label><input type='checkbox' name='CekGejala[]' value='".$data['kd_gejala']."'> ".$data['nm_gejala']."</label><br>";
                        }
                    }
                    ?>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label"></label>
                <div class="col-sm-10">
                    <button name="simpan" class="btn btn-primary"><span class="glyphicon glyphicon-ok"></span> Simpan</button>
                    <a href="?data" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span> Kembali</a>
                </div> 
            </div>
        </form>
    </div>
</div>

<?php 
// Proses penyimpanan data aturan
if (isset($_POST['simpan'])) {
    $TxtKodeH = $_POST['CmbSolusi'];
    $CekGejala = $_POST['CekGejala'];

    $jum = count($CekGejala);
    if ($jum == 0) {
        echo "Gejala Belum Dipilih";
    } else {
        // Hapus rule lama yang tidak terpilih
        $sqlpil = "SELECT * FROM rule WHERE kd_solusi='$TxtKodeH'";
        $qrypil = mysqli_query($koneksi, $sqlpil);
        while ($datapil = mysqli_fetch_array($qrypil)) {
            for ($i = 0; $i < $jum; ++$i) {
                if ($datapil['kd_gejala'] != $CekGejala[$i]) {
                    $sqldel = "DELETE FROM rule WHERE kd_solusi='$TxtKodeH' AND NOT kd_gejala IN ('$CekGejala[$i]')";
                    mysqli_query($koneksi, $sqldel);
                }
            }
        }

        // Menyimpan rule baru
        for ($i = 0; $i < $jum; ++$i) {
            $sqlr = "SELECT * FROM rule WHERE kd_solusi='$TxtKodeH' AND kd_gejala='$CekGejala[$i]'";
            $qryr = mysqli_query($koneksi, $sqlr);
            $cocok = mysqli_num_rows($qryr);
            if ($cocok == 0) {
                $sql = "INSERT INTO rule (kd_solusi, kd_gejala) VALUES ('$TxtKodeH', '$CekGejala[$i]')";
                mysqli_query($koneksi, $sql) or die ("SQL Input rule Gagal".mysqli_error($koneksi));
            }
        }

        echo '<script type="text/javascript">
                alert("Data Aturan Berhasil Disimpan");
                window.location="?data"
              </script>';
    }
}
?>
<?php 
}

// Menampilkan data aturan
if(isset($_GET['data'])) {
?>
<h2><span class="glyphicon glyphicon-refresh" aria-hidden="true"></span> Data Aturan <a class="btn btn-success btn-sm add" href="rule.php?entri"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Tambah Data</a></h2>
<hr>

<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered table-hover" id="example">
    <thead>
        <tr>
            <th style="text-align:center;">No</th>
            <th style="text-align:center;">Kode Penyakit</th>
            <th style="text-align:center;">Kode Gejala</th>
            <th style="text-align:center;">Aksi</th>
        </tr>
    </thead>
    <tbody>
    <?php
    // Menampilkan daftar aturan
    $sql = "SELECT * FROM rule ORDER BY kd_solusi";
    $rs = mysqli_query($koneksi, $sql);
    $no = 1;
    while ($row = mysqli_fetch_array($rs)) {
    ?>
        <tr class="odd gradeX">
            <td style="text-align:center;" width="50"><?php echo $no; ?></td>
            <td><?php echo $row['kd_solusi']; ?></td>
            <td><?php echo $row['kd_gejala']; ?></td>
            <td style="text-align:center;" width="80">
                <a title="Hapus Data" href="?hapus&id=<?php echo $row[0]; ?>" onclick="return confirm('Yakin Mau Hapus ?');" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash"></span> </a>
            </td>
        </tr>
    <?php 
        $no++;
    } 
    ?>
    </tbody>
</table>
<?php 
}

// Hapus aturan
if(isset($_GET['hapus'])){
    $id = $_GET['id'];
    $sql = "DELETE FROM rule WHERE kd_solusi='$id'";
    mysqli_query($koneksi, $sql);
    echo '<script type="text/javascript">
            window.location="?data"
          </script>';
}
?>

<?php include('bawah.php'); ?>
