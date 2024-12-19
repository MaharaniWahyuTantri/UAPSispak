<?php
$koneksi = mysqli_connect("localhost", "root", "", "dbpakar");

if (!$koneksi) {
    die("Connection failed: " . mysqli_connect_error());
} else {
    // Debug message to check if the connection is successful
    echo "Connected to the database successfully!";
}
?>
