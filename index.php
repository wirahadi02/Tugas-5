<?php include "config.php"; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Data Mahasiswa</title>
    <style>
        body{
    font-family: Arial;
    background:#e9eef5;
    margin:0;
}
h2{
    text-align:center;
    margin:20px 0;
    color:#333;
    font-size:22px;
}
.container{
    width:70%;
    margin:auto;
    background:#fff;
    padding:15px;
    border-radius:10px;
    box-shadow:0 5px 15px rgba(0,0,0,0.1);
}
table{
    width:100%;
    border-collapse:collapse;
    margin-top:10px;
}
th{
    background:#2563eb;
    color:white;
    padding:8px;
    font-size:12px;
}
td{
    padding:8px;
    border-bottom:1px solid #ddd;
    text-align:center;
    font-size:12px;
}
tr:hover{
    background:#f1f5ff;
}
img {
    width:60px;
    height:60px;
    object-fit: cover; 
    border-radius: 6px;
}
.btn{
    padding:5px 10px;
    background:#2563eb;
    color:white;
    text-decoration:none;
    border-radius:6px;
    font-size:12px;
}
.btn:hover{ background:#1e40af; }
.del{ background:#dc2626; }
.del:hover{ background:#991b1b; }
.top-btn{
    margin-bottom:8px;
    display:inline-block;
    font-size:12px;
}

    </style>
</head>
<body>

<h2>DATA MAHASISWA</h2>

<div class="container">
    <a href="create.php" class="btn top-btn">+ Tambah Data</a>

    <table>
        <tr>
            <th>Foto</th><th>NIM</th><th>Nama</th><th>Prodi</th><th>Alamat</th><th>Aksi</th>
        </tr>

        <?php
        $q = mysqli_query($conn, "SELECT * FROM mahasiswa");
        while($m = mysqli_fetch_assoc($q)){
        ?>
        <tr>
            <td><img src="uploads/<?= $m['gambar'] ?>" class="foto"></td>
            <td><?= $m['nim'] ?></td>
            <td><?= $m['nama'] ?></td>
            <td><?= $m['prodi'] ?></td>
            <td><?= $m['alamat'] ?></td>
            <td>
                <a class="btn" href="edit.php?nim=<?= $m['nim'] ?>">Edit</a>
                <a class="btn del" onclick="return confirm('Hapus?')" href="delete.php?nim=<?= $m['nim'] ?>">Del</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</div>

</body>
</html>
