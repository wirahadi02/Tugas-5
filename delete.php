<?php
include "config.php";

if (!isset($_GET['nim'])) {
    die("NIM tidak ditemukan");
}

$nim = $_GET['nim'];

// Ambil foto dulu agar bisa dihapus
$data = mysqli_query($conn, "SELECT gambar FROM mahasiswa WHERE nim='$nim'");
$row  = mysqli_fetch_assoc($data);

if ($row) {
    $foto = "uploads/" . $row['gambar'];

    // Hapus file foto jika ada
    if (file_exists($foto)) {
        unlink($foto);
    }

    // Hapus data di database
    mysqli_query($conn, "DELETE FROM mahasiswa WHERE nim='$nim'");
}

header("Location: index.php");
exit;
?>
