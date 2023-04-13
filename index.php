<?php
    include 'koneksi.php';
    if (!isset($_SESSION['id_user'])){
        echo "<script>window.location='login.php'</script>";
    }

    $id_user = $_SESSION['id_user'];
    $data_user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM user WHERE id_user = '$id_user'"));
    $nominal_pembayaran = mysqli_fetch_assoc(mysqli_query($conn, "SELECT *, sum(nominal_pembayaran) as nominal_pembayaran FROM pembayaran"));
    $total_siswa = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM siswa"));
?>

<html>

<head>
    <title>Pembayaran SPP</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php include 'top-side-bar.php'; ?>
    <div class="main">
        <h1>Dashboard</h1>
        <div class="main-card">
            <div class="card">
                <h3>Total Nominal</h3>
                <h3>Rp. <?= str_replace(",", ".", number_format($nominal_pembayaran['nominal_pembayaran'])); ?></h3>
            </div>
            <div class="card">
                <h3>Total Siswa</h3>
                <h3><?= $total_siswa; ?></h3>
            </div>
        </div>
    </div>
</body>

</html>