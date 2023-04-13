<?php
    include 'koneksi.php';
    if (!isset($_SESSION['id_user'])){
        echo "<script>window.location='login.php'</script>";
    }

    $id_user = $_SESSION['id_user'];
    $data_user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM user WHERE id_user = '$id_user'"));

    $id_siswa = $_GET['id_siswa'];
    $data_siswa = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM siswa WHERE id_siswa = '$id_siswa'"));

    if (isset($_POST['btnSimpan'])) {
        $nama_siswa = $_POST['nama_siswa'];
        $alamat_siswa = $_POST['alamat_siswa'];
        $tgl_lahir_siswa = $_POST['tgl_lahir_siswa'];

        $ubah_siswa = mysqli_query($conn, "UPDATE siswa SET nama_siswa = '$nama_siswa', alamat_siswa = '$alamat_siswa', tgl_lahir_siswa = '$tgl_lahir_siswa' WHERE id_siswa = '$id_siswa'");

        if ($ubah_siswa) {
            echo "
                <script>
                    alert('Siswa berhasil diubah!')
                    window.location.href='siswa.php'
                </script>
            ";
            exit;
        } else {
            echo "
                <script>
                    alert('Siswa gagal diubah!')
                    window.history.back()
                </script>
            ";
            exit;
        }
    }
?>

<html>

<head>
    <title>Ubah Siswa - <?= $data_siswa['nama_siswa']; ?></title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php include 'top-side-bar.php'; ?> 
    <div class="main">
        <h1>Ubah Siswa - <?= $data_siswa['nama_siswa']; ?></h1>
        <form method="post" class="form-admin">
            <div class="form-group">
                <label for="nama_siswa">Nama Siswa</label>
                <input type="text" id="nama_siswa" name="nama_siswa" class="input" required value="<?= $data_siswa['nama_siswa']; ?>">
            </div>
            <div class="form-group">
                <label for="alamat_siswa">Alamat Siswa</label>
                <textarea id="alamat_siswa" name="alamat_siswa" class="input" required><?= $data_siswa['alamat_siswa']; ?></textarea>
            </div>
            <div class="form-group">
                <label for="tgl_lahir_siswa">Tanggal Lahir Siswa</label>
                <input type="date" id="tgl_lahir_siswa" name="tgl_lahir_siswa" class="input" required value="<?= $data_siswa['tgl_lahir_siswa']; ?>">
            </div>
            <button type="submit" class="btn" name="btnSimpan">Simpan</button>
        </form>
    </div>
</body>

</html>