<?php
    include 'koneksi.php';
    if (!isset($_SESSION['id_user'])){
        echo "<script>window.location='login.php'</script>";
    }

    $id_user = $_SESSION['id_user'];
    $data_user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM user WHERE id_user = '$id_user'"));

    if (isset($_GET['btnLaporan'])) {
        $dari_tanggal = htmlspecialchars($_GET['dari_tanggal']);
        $sampai_tanggal = htmlspecialchars($_GET['sampai_tanggal']);
    
        $dari_tanggal_baru =  $dari_tanggal . ' 00:00:00';
        $sampai_tanggal_baru =  $sampai_tanggal . ' 23:59:59';
        $pembayaran = mysqli_query($conn, "SELECT * FROM pembayaran INNER JOIN siswa ON pembayaran.id_siswa = siswa.id_siswa WHERE pembayaran.tgl_pembayaran BETWEEN '$dari_tanggal_baru' AND '$sampai_tanggal_baru' AND status_pembayaran = 'Lunas'");

        $nominal_pembayaran = mysqli_fetch_assoc(mysqli_query($conn, "SELECT *, sum(nominal_pembayaran) as nominal_pembayaran FROM pembayaran WHERE pembayaran.tgl_pembayaran BETWEEN '$dari_tanggal_baru' AND '$sampai_tanggal_baru' AND status_pembayaran = 'Lunas'"));

    }
?>

<html>

<head>
    <title>Laporan</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php include 'top-side-bar.php'; ?>
    <div class="main">
        <h1>Laporan</h1>
        <form method="get" class="form-admin">
            <div class="form-group">
                <label for="dari_tanggal">Dari Tanggal</label>
                <input class="input" type="date" name="dari_tanggal"
                    value="<?= isset($_GET['btnLaporan']) ? $dari_tanggal : date('Y-m-01'); ?>">
            </div>
            <div class="form-group">
                <label for="sampai_tanggal">Sampai Tanggal</label>
                <input class="input" type="date" name="sampai_tanggal"
                    value="<?= isset($_GET['btnLaporan']) ? $sampai_tanggal : date('Y-m-d'); ?>">
            </div>
            <div class="form-group">
                <button type="submit" name="btnLaporan" class="btn">Filter</button>
            </div>
        </form>
        <br><br>
        <?php if (isset($_GET['btnLaporan'])): ?>
            <a href="print_laporan.php?dari_tanggal=<?= $dari_tanggal; ?>&sampai_tanggal=<?= $sampai_tanggal; ?>" target="_blank" class="btn">Print</a>
            <h3>Laporan Pembayaran SPP - Dari Tanggal <?= $dari_tanggal; ?> Sampai Tanggal <?= $sampai_tanggal; ?></h3>
            <h4>Total Nominal: Rp. <?= str_replace(",", ".", number_format($nominal_pembayaran['nominal_pembayaran'])); ?></h4>
            <table border="1" cellpadding="10" cellspacing="0">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Siswa</th>
                        <th>Tanggal Pembayaran</th>
                        <th>Bulan Pembayaran</th>
                        <th>Nominal Pembayaran</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($pembayaran as $data_pembayaran) : ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <td><?= $data_pembayaran['nama_siswa']; ?></td>
                            <td><?= $data_pembayaran['tgl_pembayaran']; ?></td>
                            <td><?= $data_pembayaran['bulan_pembayaran']; ?></td>
                            <td>Rp. <?= str_replace(",", ".", number_format($data_pembayaran['nominal_pembayaran'])); ?></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        <?php endif ?>
    </div>
</body>

</html>