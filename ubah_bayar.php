<?php 
require_once 'koneksi.php';
if (!isset($_SESSION['id_user'])) {
	header("Location: login.php");
	exit;
}

$id_user = $_SESSION['id_user'];
$data_user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM user WHERE id_user = '$id_user'"));

$id_pembayaran = $_GET['id_pembayaran'];
$id_siswa = $_GET['id_siswa'];
$data_pembayaran = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM pembayaran WHERE id_pembayaran = '$id_pembayaran'"));

if (isset($_POST['btnSimpan'])) {
    $tgl_pembayaran = $_POST['tgl_pembayaran'];
    $nominal_pembayaran = $_POST['nominal_pembayaran'];
    $status_pembayaran = $_POST['status_pembayaran'];
    $bayar = mysqli_query($conn, "UPDATE pembayaran SET tgl_pembayaran = '$tgl_pembayaran', nominal_pembayaran = '$nominal_pembayaran', status_pembayaran = '$status_pembayaran' WHERE id_pembayaran = '$id_pembayaran'");
    if ($bayar) {
        echo "
            <script>
                alert('Pembayaran berhasil diubah!')
                window.location.href='pembayaran.php?id_siswa=$id_siswa'
            </script>
        ";
        exit;
    } else {
        echo "
            <script>
                alert('Pembayaran gagal diubah!')
                window.location.href='pembayaran.php?id_siswa=$id_siswa'
            </script>
        ";
        exit;
    }
}


?>

<html>

<head>
    <title>Ubah Pembayaran Bulan <?= $data_pembayaran['bulan_pembayaran']; ?></title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php include 'top-side-bar.php'; ?> 
    <div class="main">
        <h1>Ubah Pembayaran Bulan <?= $data_pembayaran['bulan_pembayaran']; ?></h1>
        <form method="post" class="form-admin">
            <div class="form-group">
                <label for="tgl_pembayaran">Tanggal Pembayaran</label>
                <input type="datetime-local" id="tgl_pembayaran" name="tgl_pembayaran" class="input" required value="<?= $data_pembayaran['tgl_pembayaran']; ?>">
            </div>
            <div class="form-group">
                <label for="nominal_pembayaran">Nominal Pembayaran</label>
                <input type="number" id="nominal_pembayaran" name="nominal_pembayaran" class="input" required value="<?= $data_pembayaran['nominal_pembayaran']; ?>">
            </div>
            <div class="form-group">
                <label for="status_pembayaran">Status Pembayaran</label>
                <select name="status_pembayaran" id="status_pembayaran" class="input">
                    <option value="<?= $data_pembayaran['status_pembayaran']; ?>"><?= $data_pembayaran['status_pembayaran']; ?></option>
                    <option value="Lunas">Lunas</option>
                    <option value="Belum">Belum</option>
                </select>
            </div>
            <button type="submit" class="btn" name="btnSimpan">Simpan</button>
        </form>
    </div>
</body>

</html>