<?php include('inc.session.php'); ?>
<?php include 'inc.koneksi.php'; ?>

<?php
// Connection to the database using mysqli
$koneksi = new mysqli('localhost', 'root', '', 'dbpakar');

// Check if the connection was successful
if ($koneksi->connect_error) {
    die("Connection failed: " . $koneksi->connect_error);
}

if (isset($_GET['gejala'])) {
?>
<body onload="window.print();" Layout="Portrait">
    <font color="#d1ad2e"><center><h3>LAPORAN DATA GEJALA</h3></center></font><br>
    <table border="1" cellpadding="8" width="100%">
    <thead>
        <tr>
            <th>No</th>
            <th>Kode Gejala</th>
            <th>Nama Gejala</th>
        </tr>
    </thead>
    <tbody>
    <?php
        $sql = "SELECT * FROM gejala ORDER BY kd_gejala";
        $qry = $koneksi->query($sql);
        if ($qry) {
            $no = 1;
            while ($data = $qry->fetch_assoc()) {
    ?>
    <tr class="odd gradeX">
        <td style="text-align:center"><?php echo $no; ?></td>
        <td><?php echo $data['kd_gejala']; ?></td>
        <td><?php echo $data['nm_gejala']; ?></td>
    </tr>
    <?php
            $no++;
            }
        } else {
            echo "Error: " . $koneksi->error;
        }
    ?>
    </tbody>
    </table>
</body>
<?php } ?>

<?php
if (isset($_GET['solusi'])) {
?>
<body onload="window.print();" Layout="Portrait">
    <font color="#d1ad2e"><center><h3>LAPORAN DATA PENYAKIT DAN SOLUSI</h3></center></font>
    <br>
    <table border="1" cellpadding="8" width="100%">
    <thead>
        <tr>
            <th>No</th>
            <th>Kode Solusi</th>
            <th>Nama Solusi</th>
            <th>Solusi</th>
        </tr>
    </thead>
    <tbody>
    <?php
        $sql = "SELECT * FROM solusi ORDER BY kd_solusi";
        $qry = $koneksi->query($sql);
        if ($qry) {
            $no = 1;
            while ($data = $qry->fetch_assoc()) {
    ?>
    <tr class="odd gradeX">
        <td style="text-align:center"><?php echo $no; ?></td>
        <td><?php echo $data['kd_solusi']; ?></td>
        <td><?php echo $data['nm_solusi']; ?></td>
        <td><?php echo $data['solusi']; ?></td>
    </tr>
    <?php
            $no++;
            }
        } else {
            echo "Error: " . $koneksi->error;
        }
    ?>
    </tbody>
    </table>
</body>
<?php } ?>


<?php
if (isset($_GET['diagnosa'])) {
?>
<body onload="window.print();" Layout="Landscape">
    <font color="#d1ad2e"><center><h3>LAPORAN DATA DIAGNOSIS PENYAKIT</h3></center></font>
    <br>
    <table border="1" cellpadding="8" width="100%">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Jenis Kelamin</th>
            <th>Alamat</th>
            <th>Pekerjaan</th>
            <th>Tanggal Diagnosa</th>
            <th>Penyakit</th>
        </tr>
    </thead>
    <tbody>
    <?php
        $sql = "SELECT analisa_hasil.nama, analisa_hasil.kelamin, analisa_hasil.alamat, analisa_hasil.pekerjaan,
        analisa_hasil.tanggal, solusi.nm_solusi 
        FROM analisa_hasil 
        INNER JOIN solusi ON analisa_hasil.kd_solusi = solusi.kd_solusi 
        ORDER BY analisa_hasil.id DESC";
        $qry = $koneksi->query($sql);
        if ($qry) {
            $no = 1;
            while ($data = $qry->fetch_assoc()) {
    ?>
    <tr class="odd gradeX">
        <td style="text-align:center"><?php echo $no; ?></td>
        <td><?php echo $data['nama']; ?></td>
        <td><?php echo ($data['kelamin'] == "P") ? "Laki-laki" : "Perempuan"; ?></td>
        <td><?php echo $data['alamat']; ?></td>
        <td><?php echo $data['pekerjaan']; ?></td>
        <td><?php echo $data['tanggal']; ?></td>
        <td style="text-align:center"><?php echo $data['nm_solusi']; ?></td>
    </tr>
    <?php
            $no++;
            }
        } else {
            echo "Error: " . $koneksi->error;
        }
    ?>
    </tbody>
    </table>
</body>
<?php } ?>

<?php
// Close the connection when done
$koneksi->close();
?>
