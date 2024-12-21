<?php include('inc.session.php'); ?>
<?php include('atas.php'); ?>
<?php
// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "dbpakar");

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Query untuk menghitung jumlah diagnosa
$queryDiagnosa = "SELECT COUNT(*) as total FROM analisa_hasil";
$resultDiagnosa = $conn->query($queryDiagnosa);
$dataDiagnosa = $resultDiagnosa->fetch_assoc();
$totalDiagnosa = $dataDiagnosa['total'];

// Query untuk menghitung jumlah tamu
$queryTamu = "SELECT COUNT(*) as total FROM buku_tamu";
$resultTamu = $conn->query($queryTamu);
$dataTamu = $resultTamu->fetch_assoc();
$totalTamu = $dataTamu['total'];

// Query untuk menghitung jumlah artikel
$queryArtikel = "SELECT COUNT(*) as total FROM artikel";
$resultArtikel = $conn->query($queryArtikel);
$dataArtikel = $resultArtikel->fetch_assoc();
$totalArtikel = $dataArtikel['total'];

$conn->close();
?>

<?php if(isset($_GET['home'])){  ?>

<div>

<!-- Status Cards -->
<div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px;">
  <!-- Card Diagnosa -->
  <div style="background: linear-gradient(to top right, #215273, #09C69A); color: white; border-radius: 8px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); padding: 16px; height: 140px; display: flex; justify-content: space-between; align-items: center; position: relative;">
    <div style="display: flex; flex-direction: column;">
      <p style="font-size: 24px; font-weight: bold; margin-bottom: 8px;"><?php echo $totalDiagnosa; ?></p>
      <p style="font-size: 20px; font-weight: bold;">Diagnosa</p>
      <p style="font-size: 14px;">*Total Diagnosa</p>
    </div>
  </div>

  <!-- Card Data Tamu -->
  <div style="background: linear-gradient(to top right, #0B1721, #B70D0D); color: white; border-radius: 8px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); padding: 16px; height: 140px; display: flex; justify-content: space-between; align-items: center; position: relative;">
    <div style="display: flex; flex-direction: column;">
      <p style="font-size: 24px; font-weight: bold; margin-bottom: 8px;"><?php echo $totalTamu; ?></p>
      <p style="font-size: 20px; font-weight: bold;">Data Tamu</p>
      <p style="font-size: 14px;">*Total Data Tamu</p>
    </div>
  </div>

  <!-- Card Artikel -->
  <div style="background: linear-gradient(to top right, #479AFE, #91FCF3); color: white; border-radius: 8px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); padding: 16px; height: 140px; display: flex; justify-content: space-between; align-items: center; position: relative;">
    <div style="display: flex; flex-direction: column;">
      <p style="font-size: 24px; font-weight: bold; margin-bottom: 8px;"><?php echo $totalArtikel; ?></p>
      <p style="color: white; font-size: 16px; font-weight: bold; margin-bottom: 8px;">Jumlah Artikel</p>
      <a class="btn btn-success btn-sm add" href="artikel.php?entri"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Tambah Data</a>
    </div>
  </div>
</div>

</div>


<?php } ?>
<?php include('bawah.php'); ?>
