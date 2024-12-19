<?php include('inc.session.php'); ?>
<?php include('inc.koneksi.php'); ?>

<?php
function kdauto($tabel, $inisial) {
    $struktur = mysqli_query($koneksi, "SELECT * FROM $tabel");
    $field = mysqli_fetch_field($struktur);
    $panjang = $field->length;

    $qry = mysqli_query($koneksi, "SELECT max(" . $field->name . ") FROM $tabel");
    $row = mysqli_fetch_array($qry);
    if ($row[0] == "") {
        $angka = 0;
    } else {
        $angka = substr($row[0], strlen($inisial));
    }

    $angka++;
    $angka = strval($angka);
    $tmp = "";
    for ($i = 1; $i <= ($panjang - strlen($inisial) - strlen($angka)); $i++) {
        $tmp = $tmp . "0";
    }
    return $inisial . $tmp . $angka;
}
?>

<?php include('atas.php'); ?>

<?php if (isset($_GET['data'])) { ?>
<h2><span class="glyphicon glyphicon-tasks" aria-hidden="true"></span> Data Gejala <a class="btn btn-success btn-sm add" href="gejala.php?entri"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Tambah Data</a></h2>
<hr>

<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered table-hover" id="example">
    <thead>
        <tr>
            <th style="text-align:center;">No</th>
            <th style="text-align:center;">Kode Gejala</th>
            <th style="text-align:center;">Nama Gejala</th>
            <th style="text-align:center;">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $sql = "SELECT * FROM gejala ORDER BY kd_gejala";
        $qry = mysqli_query($koneksi, $sql) or die("SQL Error: " . mysqli_error($koneksi));
        $no = 1;
        while ($data = mysqli_fetch_array($qry)) {
        ?>
        <tr class="odd gradeX">
            <td style="text-align:center;"><?php echo $no; ?></td>
            <td><?php echo $data['kd_gejala']; ?></td>
            <td><?php echo $data['nm_gejala']; ?></td>
            <td align="center">
                <a title="Edit Data" href="?edit&id=<?php echo $data['kd_gejala']; ?>" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-pencil"></span> </a>
                <a title="Hapus Data" href="?hapus&id=<?php echo $data['kd_gejala']; ?>" onclick="return confirm('Yakin Mau Hapus ?');" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash"></span> </a>
            </td>
        </tr>
        <?php
        $no++;
        }
        ?>
    </tbody>
</table>
<?php } ?>

<?php if (isset($_GET['entri'])) {  ?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><span class="glyphicon glyphicon-plus"></span> Tambah Data Gejala</h3>
    </div>
    <div class="panel-body">
        <form class="form-horizontal" method="post" action="">
            <div class="form-group">
                <label class="col-sm-2 control-label">Kode Gejala</label>
                <div class="col-sm-4">
                    <input class="form-control" name="kode" type="text" maxlength="4" size="6" value="<?php echo kdauto('gejala', 'G'); ?>" disabled="disabled">
                    <input class="form-control" name="kode" type="hidden" value="<?php echo kdauto("gejala", "G"); ?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Nama Gejala</label>
                <div class="col-sm-10">
                    <input class="form-control" name="nmgejala" type="text"  />
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
<?php } 

if (isset($_POST['simpan'])) {
    $kode = $_POST['kode'];
    $nmgejala = $_POST['nmgejala'];
    
    $sql = "INSERT INTO gejala (kd_gejala, nm_gejala) VALUES ('$kode', '$nmgejala')";
    mysqli_query($koneksi, $sql);

    echo '<script type="text/javascript">
        alert("Data Gejala Berhasil Disimpan");
        window.location="?data"
    </script>';
}
?>

<?php
if (isset($_GET['hapus'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM gejala WHERE kd_gejala='$id'";
    mysqli_query($koneksi, $sql);
    echo '<script type="text/javascript">
        window.location="?data"
    </script>';
}
?>

<?php if (isset($_GET['edit'])) { 
    $sql = "SELECT * FROM gejala WHERE kd_gejala='$_GET[id]'";
    $rs = mysqli_query($koneksi, $sql);
    $row = mysqli_fetch_array($rs);
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><span class="glyphicon glyphicon-pencil"></span> Edit Data Gejala</h3>
    </div>
    <div class="panel-body">
        <form class="form-horizontal" method="POST" action="">
            <div class="form-group">
                <label class="col-sm-2 control-label">Kode Gejala</label>
                <div class="col-sm-4">
                    <input class="form-control" name="kd" type="text" maxlength="4" size="6" value="<?php echo $row['kd_gejala']; ?>" disabled="disabled">
                    <input class="form-control" name="id" type="hidden" value="<?php echo $row['kd_gejala']; ?>" >
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Nama Gejala</label>
                <div class="col-sm-10">
                    <input class="form-control" name="a" type="text" value="<?php echo $row['nm_gejala']; ?>" size="100" maxlength="100">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label"></label>
                <div class="col-sm-10">
                    <button name="edit" class="btn btn-primary"><span class="glyphicon glyphicon-ok"></span> Update</button>
                    <a href="?data" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span> Kembali</a>
                </div> 
            </div>
        </form>
    </div>
</div>
<?php 
    if (isset($_POST['edit'])) {
        $a = $_POST['a'];
        $id = $_POST['id'];
        
        $sql = "UPDATE gejala SET nm_gejala='$a' WHERE kd_gejala='$id'";
        mysqli_query($koneksi, $sql);

        echo '<script type="text/javascript">
            alert("Data Gejala Berhasil Diubah");
            window.location="?data"
        </script>';
    }
}
?>

<?php include('bawah.php'); ?>
