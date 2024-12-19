<?php
$koneksi = new mysqli("localhost", "root", "", "dbpakar");

if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

include('inc.session.php');
include('inc.koneksi.php');
include('atas.php');

if (isset($_GET['data'])) {
?>
    <h2><span class="glyphicon glyphicon-book" aria-hidden="true"></span> Data Artikel <a class="btn btn-success btn-sm add" href="artikel.php?entri"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Tambah Data</a></h2>
    <hr>
    <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-hover table-striped" id="example">
        <thead>
            <tr>
                <th style="text-align:center;">No</th>
                <th style="text-align:center;">Judul</th>
                <th style="text-align:center;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM artikel ORDER BY id DESC";
            $rs = $koneksi->query($sql);
            $no = 1;
            while ($row = $rs->fetch_assoc()) {
            ?>
                <tr class="odd gradeX">
                    <td style="text-align:center;"><?php echo $no; ?></td>
                    <td><?php echo $row['judul']; ?></td>
                    <td style="text-align:center;">
                        <a title="Edit Data" href="?edit&id=<?php echo $row['id']; ?>&nm=<?php echo $row['foto']; ?>" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-pencil"></span> </a>
                        <a title="Hapus Data" href="?hapus&id=<?php echo $row['id']; ?>&nm=<?php echo $row['foto']; ?>" onclick="return confirm('Yakin Mau Hapus ?');" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash"></span> </a>
                    </td>
                </tr>
            <?php $no++; } ?>
        </tbody>
    </table>
<?php
}

if (isset($_GET['entri'])) {
?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"><span class="glyphicon glyphicon-plus"></span> Tambah Data Artikel</h3>
        </div>
        <div class="panel-body">
            <form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
                <div class="form-group">
                    <label class="col-sm-2 control-label">Judul Artikel</label>
                    <div class="col-sm-4">
                        <input class="form-control" required type="text" name="a" value="" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Isi Artikel</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" name="isi" required>Isi Artikel</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Gambar</label>
                    <div class="col-sm-4">
                        <input class="form-control" required type="file" name="userfile" value="" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Keyword</label>
                    <div class="col-sm-4">
                        <input class="form-control" required type="text" name="c" value="" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Deskripsi</label>
                    <div class="col-sm-4">
                        <input class="form-control" required type="text" name="d" value="" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Status</label>
                    <div class="col-sm-4">
                        <select class="form-control" name="e" required>
                            <option value="">Status Artikel</option>
                            <option value="Y">Aktif</option>
                            <option value="T">Tidak Aktfi</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label"></label>
                    <div class="col-sm-10">
                        <button name="save" class="btn btn-primary"><span class="glyphicon glyphicon-ok"></span> Simpan</button>
                        <a href="?data" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span> Kembali</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php
    if (isset($_POST['save'])) {
        function bersih($koneksi, $a)
        {
            return $koneksi ? mysqli_real_escape_string($koneksi, $a) : '';
        }
        $a = bersih($koneksi, $_POST['a']);
        $c = bersih($koneksi, $_POST['c']);
        $d = bersih($koneksi, $_POST['d']);
        $e = bersih($koneksi, $_POST['e']);
        $isi = bersih($koneksi, $_POST['isi']);
        $tgl = date('Y-m-d');
        $uploaddir = '../news/';
        $fileName = $_FILES['userfile']['name'];
        $tmpName = $_FILES['userfile']['tmp_name'];
        $uploadfile = $uploaddir . $fileName;
        if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
            $sql = "INSERT INTO artikel (idadmin, tgl, judul, isi, foto, ket, keyword, deskripsi) VALUES ('$_SESSION[SES_USER]', '$tgl', '$a', '$isi', '$fileName', '$e', '$c', '$d')";
            $koneksi->query($sql);
            echo '<script type="text/javascript">
                    alert("Data Artikel Berhasil Disimpan");
                    window.location="?data"
                  </script>';
        } else {
            echo '<script type="text/javascript">
                    alert("Data Artikel Gagal Disimpan");
                  </script>';
        }
    }
}

if (isset($_GET['edit'])) {
    $sql = "SELECT * FROM artikel WHERE id='$_GET[id]'";
    $rs = $koneksi->query($sql);
    $row = $rs->fetch_assoc();
    if ($row) {
?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><span class="glyphicon glyphicon-pencil"></span> Edit Data Artikel</h3>
            </div>
            <div class="panel-body">
                <form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Judul Artikel</label>
                        <div class="col-sm-4">
                            <input required type="text" class="form-control" name="a" value="<?php echo $row['judul']; ?>" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Isi Artikel</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" name="isi" required><?php echo $row['isi']; ?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Gambar</label>
                        <div class="col-sm-4">
                            <input type="file" class="form-control" name="userfile" value="" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Keyword</label>
                        <div class="col-sm-4">
                            <input required type="text" class="form-control" name="c" value="<?php echo $row['keyword']; ?>" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Deskripsi</label>
                        <div class="col-sm-4">
                            <input required type="text" class="form-control" name="d" value="<?php echo $row['deskripsi']; ?>" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Status</label>
                        <div class="col-sm-4">
                            <select class="form-control" name="e" required>
                                <option value="Y" <?php echo $row['ket'] == "Y" ? "selected" : ""; ?>>Aktif</option>
                                <option value="T" <?php echo $row['ket'] == "T" ? "selected" : ""; ?>>Tidak Aktif</option>
                            </select>
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
    }
    if (isset($_POST['edit'])) {
        function bersih($koneksi, $a)
        {
            return $koneksi ? mysqli_real_escape_string($koneksi, $a) : '';
        }
        $a = bersih($koneksi, $_POST['a']);
        $c = bersih($koneksi, $_POST['c']);
        $d = bersih($koneksi, $_POST['d']);
        $e = bersih($koneksi, $_POST['e']);
        $isi = bersih($koneksi, $_POST['isi']);
        $tgl = date('Y-m-d');
        $uploaddir = '../news/';
        $fileName = $_FILES['userfile']['name'];
        $tmpName = $_FILES['userfile']['tmp_name'];
        if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
            $sql = "UPDATE artikel SET idadmin='$_SESSION[SES_USER]', tgl='$tgl', judul='$a', isi='$isi', foto='$fileName', ket='$e', keyword='$c', deskripsi='$d' WHERE id='$_GET[id]'";
            $koneksi->query($sql);
            if (!empty($fileName)) {
                $nm = $_GET['nm'];
                unlink("../news/$nm");
            }
            echo '<script type="text/javascript">
                    alert("Berhasil Edit");
                    window.location="?data"
                  </script>';
        } else {
            $sql = "UPDATE artikel SET idadmin='$_SESSION[SES_USER]', tgl='$tgl', judul='$a', isi='$isi', ket='$e', keyword='$c', deskripsi='$d' WHERE id='$_GET[id]'";
            $koneksi->query($sql);
            echo '<script type="text/javascript">
                    alert("Data Artikel Berhasil Diubah");
                    window.location="?data"
                  </script>';
        }
    }
}

if (isset($_GET['hapus'])) {
    $id = $_GET['id'];
    $nm = $_GET['nm'];
    unlink("../news/$nm");
    $sql = "DELETE FROM artikel WHERE id='$id'";
    $koneksi->query($sql);
    echo '<script type="text/javascript">
            window.location="?data"
          </script>';
}

include('bawah.php');
?>
