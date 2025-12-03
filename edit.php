<?php
include "config.php";

$nim = $_GET['nim'];
$data = mysqli_query($conn, "SELECT * FROM mahasiswa WHERE nim='$nim'");
$mhs  = mysqli_fetch_assoc($data);

if (!$mhs) {
    die("Data tidak ditemukan");
}

if (isset($_POST['update'])) {

    $nama   = $_POST['nama'];
    $prodi  = $_POST['prodi'];
    $alamat = $_POST['alamat'];
    $gambar_lama = $mhs['gambar'];

    // Upload jika ada foto baru
    if ($_FILES['gambar']['name'] != '') {
        $namaFile = time() . "_" . $_FILES['gambar']['name'];
        move_uploaded_file($_FILES['gambar']['tmp_name'], "uploads/" . $namaFile);
    } else {
        $namaFile = $gambar_lama;
    }

    $query = "UPDATE mahasiswa SET 
                nama='$nama', 
                prodi='$prodi', 
                alamat='$alamat',
                gambar='$namaFile'
              WHERE nim='$nim'";

    mysqli_query($conn, $query);

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Data</title>
    <style>
        body {font-family: Arial; background: #f5f5f5;}
        .card {width: 420px; margin: 40px auto; background: white; padding: 25px; border-radius: 12px; box-shadow:0 0 8px #ccc;}
        input,select,textarea {width:100%; padding:8px; margin:6px 0; border-radius:6px; border:1px solid #888;}
        button {padding:8px 14px; border:none; border-radius:6px; background:#4CAF50; color:white; cursor:pointer;}
        img {border-radius:6px; margin: 10px 0;}
    </style>
</head>
<body>

<div class="card">
    <h2>Edit Data Mahasiswa</h2>

    <form method="POST" enctype="multipart/form-data">

        <label>NIM</label>
        <input type="text" value="<?= $mhs['nim']; ?>" disabled>

        <label>Nama</label>
        <input type="text" name="nama" value="<?= $mhs['nama']; ?>" required>

        <label>Prodi</label>
        <select name="prodi" required>
            <option <?= ($mhs['prodi']=="TI")?"selected":"" ?>>TI</option>
            <option <?= ($mhs['prodi']=="SI")?"selected":"" ?>>SI</option>
            <option <?= ($mhs['prodi']=="RPL")?"selected":"" ?>>RPL</option>
        </select>

        <label>Alamat</label>
        <textarea name="alamat" required><?= $mhs['alamat']; ?></textarea>

        <label>Foto Sekarang</label><br>
        <img src="uploads/<?= $mhs['gambar']; ?>" width="120">

        <label>Ganti Foto</label>
        <input type="file" name="gambar">

        <button type="submit" name="update">Simpan Perubahan</button>
    </form>
</div>

</body>
</html>
