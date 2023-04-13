<?php
    include 'koneksi.php';
    if (!isset($_SESSION['id_user'])){
        echo "<script>window.location='login.php'</script>";
    }

    $id_user = $_SESSION['id_user'];
    $data_user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM user WHERE id_user = '$id_user'"));

    $siswa = mysqli_query($conn, "SELECT * FROM siswa ORDER BY nama_siswa ASC");
?>

<html>

<head>
    <title>Siswa</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php include 'top-side-bar.php'; ?> 
    <div class="main">
        <h1>Siswa</h1>
        <a href="tambah_siswa.php" class="btn">Tambah Siswa</a>
        <br>
        <br>
        <table border="1" cellpadding="10" cellspacing="0">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama Siswa</th>
                    <th>Alamat Siswa</th>
                    <th>Tanggal Lahir</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                <?php foreach ($siswa as $data_siswa) : ?>
                    <tr>
                        <td><?= $i++ ?></td>
                        <td><?= $data_siswa['nama_siswa']; ?></td>
                        <td><?= $data_siswa['alamat_siswa']; ?></td>
                        <td><?= date("d-m-Y", strtotime($data_siswa['tgl_lahir_siswa'])); ?></td>
                        <td>
                            <a href="ubah_siswa.php?id_siswa=<?= $data_siswa['id_siswa']; ?>" class="btn margin-5px">Ubah</a>
                            <a onclick="return confirm('Apakah Anda yakin ingin menghapus siswa <?= $data_siswa['nama_siswa']; ?>?')" href="hapus_siswa.php?id_siswa=<?= $data_siswa['id_siswa']; ?>" class="btn margin-5px bg-red">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</body>
</html>