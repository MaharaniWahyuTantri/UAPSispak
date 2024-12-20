<?php
include "conf/inc.koneksi.php";


if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']); // Validasi input sebagai integer

    $sql = "SELECT * FROM artikel WHERE id = ?";
    $stmt = $conn->prepare($sql); // Gunakan prepared statement
    $stmt->bind_param("i", $id); // Bind parameter
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) { ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><?php echo htmlspecialchars($row['judul']); ?></h3>
            </div>
            <div class="panel-body">
                <p style="text-align:center;">
                    <img src="news/<?php echo htmlspecialchars($row['foto']); ?>" class="image-rounded" width="400" height="300" />
                </p>
                <p><?php echo nl2br(htmlspecialchars($row['isi'])); ?></p>
            </div>
        </div>
    <?php
    } else {
        echo "<div class='alert alert-warning'>Artikel tidak ditemukan.</div>";
    }

    $stmt->close();
} else {
    echo "<div class='alert alert-danger'>ID artikel tidak valid.</div>";
}

$conn->close(); // Tutup koneksi
?>
