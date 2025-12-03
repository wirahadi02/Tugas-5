<?php 
include "config.php";

if (isset($_POST['save'])) {

    $nim    = mysqli_real_escape_string($conn, $_POST['nim']);
    $nama   = mysqli_real_escape_string($conn, $_POST['nama']);
    $prodi  = mysqli_real_escape_string($conn, $_POST['prodi']);
    $alamat = mysqli_real_escape_string($conn, $_POST['alamat']);

    // Upload foto
    if(isset($_FILES['gambar']['name']) && $_FILES['gambar']['name'] != "") {
        $foto   = $_FILES['gambar']['name'];
        $tmp    = $_FILES['gambar']['tmp_name'];
        $namaBaru = time() . "_" . $foto;

        move_uploaded_file($tmp, "uploads/" . $namaBaru);
    } else {
        $namaBaru = ""; // jika tidak ada foto
    }

    $sql = "INSERT INTO mahasiswa (nim, nama, prodi, alamat, gambar) VALUES (
        '$nim', '$nama', '$prodi', '$alamat', '$namaBaru'
    )";

    if(mysqli_query($conn, $sql)){
        header("Location: index.php");
        exit;
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Data</title>
    <style>
        body {font-family:Arial;background:#f0f0f0;}
        .card {width:400px;margin:40px auto;padding:20px;background:white;
               border-radius:10px;box-shadow:0 0 6px #aaa;}
        input,select,textarea {width:100%;padding:8px;margin:7px 0;
               border:1px solid #999;border-radius:6px;}
        button {background:#4CAF50;color:white;padding:10px;border:none;
               border-radius:6px;width:100%;cursor:pointer;}
        button:hover {background:#45a049;}
    </style>
</head>
<body>

<div class="card">
    <h2 align="center">Tambah Data Mahasiswa</h2>

    <form method="POST" enctype="multipart/form-data">
        
        <label>NIM</label>
        <input type="text" name="nim" required>

        <label>Nama</label>
        <input type="text" name="nama" required>

        <label>Prodi</label>
        <select name="prodi" required>
            <option value="">--Pilih Prodi--</option>
            <option value="TI">TI</option>
            <option value="SI">SI</option>
            <option value="RPL">RPL</option>
        </select>

        <label>Alamat</label>
        <textarea name="alamat" required></textarea>

        <label>Foto Mahasiswa</label>
        <input type="file" name="gambar" required>

        <button type="submit" name="save">Simpan</button>
    </form>

</div>

</body>
</html>
