<?php
include_once "inc.koneksi.php";

$TxtUser = $_REQUEST['TxtUser'];
$TxtPasswd = $_REQUEST['TxtPasswd'];

if (trim($TxtUser) == "") {
    echo "<script>alert('Data User Kosong !')</script>";
    echo "<meta http-equiv='refresh' content='0; url=index.php'>";
} else if (trim($TxtPasswd) == "") {
    echo "<script>alert('Data Password Kosong !')</script>";
    echo "<meta http-equiv='refresh' content='0; url=index.php'>";
} else {
    // Gunakan mysqli untuk menjalankan query
    $sql_cek = "SELECT * FROM admin WHERE nmlogin='$TxtUser' AND pslogin=md5('$TxtPasswd')";
    $qry_cek = mysqli_query($koneksi, $sql_cek) or die("Gagal Cek: " . mysqli_error($koneksi));
    $ada_cek = mysqli_num_rows($qry_cek);

    if ($ada_cek > 0) {
        session_start();
        $SES_USER = $TxtUser;
        $_SESSION['SES_USER'] = $SES_USER;
        header("location: admin.php?home");
    } else {
        echo "<script>alert('User Atau Password Salah !')</script>";
        echo "<meta http-equiv='refresh' content='0; url=index.php'>";
    }
}
?>
