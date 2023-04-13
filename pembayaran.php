<?php
    include 'koneksi.php';
    if (!isset($_SESSION['id_user'])){
        echo "<script>window.location='login.php'</script>";
    }

    $id_user = $_SESSION['id_user'];
    $data_user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM user WHERE id_user = '$id_user'"));

    $siswa = mysqli_query($conn, "SELECT * FROM siswa ORDER BY nama_siswa ASC");

    if (isset($_GET['id_siswa'])) {
        $id_siswa = $_GET['id_siswa'];
        $data_siswa = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM siswa WHERE id_siswa = '$id_siswa'"));
        $pembayaran = mysqli_query($conn, "SELECT * FROM pembayaran WHERE id_siswa = '$id_siswa'");
    }
?>

<html>

<head>
    <title>Pembayaran</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php include 'top-side-bar.php'; ?> 
    <div class="main">
        <h1>Pembayaran</h1>
        <form method="get" class="form-admin">
            <div class="form-group">
                <label for="id_siswa">Pilih Siswa</label>
                <select id="id_siswa" name="id_siswa" class="input">
                    <?php if (isset($data_siswa)): ?>
                        <option value="<?= $data_siswa['id_siswa']; ?>"><?= $data_siswa['nama_siswa'] ?></option>
                        <?php foreach ($siswa as $ds) : ?>
                            <?php if ($data_siswa['id_siswa'] != $ds['id_siswa']): ?>
                                <option value="<?= $ds['id_siswa']; ?>"><?= $ds['nama_siswa']; ?></option>
                            <?php endif ?>
                        <?php endforeach ?>
                    <?php else: ?>
                        <?php foreach ($siswa as $ds) : ?>
                            <option value="<?= $ds['id_siswa']; ?>"><?= $ds['nama_siswa']; ?></option>
                        <?php endforeach ?>
                    <?php endif ?>
                </select>
            </div>
            <button type="submit" class="btn" name="btnLanjut">Lanjut</button>
        </form>
        <hr><br>
        <?php if (isset($_GET['id_siswa'])) : ?>
            <h1><?= $data_siswa['nama_siswa']; ?></h1>
            <table border="1" cellpadding="10" cellspacing="0">
                <thead>
                    <tr>
                        <th>Bulan Pembayaran</th>
                        <th>Tanggal Pembayaran</th>
                        <th>Nominal Pembayaran</th>
                        <th>Status Pembayaran</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pembayaran as $data_pembayaran) : ?>
                        <tr>
                            <td><?= $data_pembayaran['bulan_pembayaran']; ?></td>
                            <?php if ($data_pembayaran['tgl_pembayaran'] == '0000-00-00 00:00:00') : ?>
                                <td>-</td>
                            <?php else: ?>
                                <td><?= date("d-m-Y, H:i", strtotime($data_pembayaran['tgl_pembayaran'])); ?></td>
                            <?php endif ?>
                            <td>Rp. <?= str_replace(",", ".", number_format($data_pembayaran['nominal_pembayaran'])); ?></td>
                            <?php if ($data_pembayaran['status_pembayaran'] == 'Belum') : ?>
                                <td><span class="bg-status-belum"><?= $data_pembayaran['status_pembayaran']; ?></span></td>
                            <?php else: ?>
                                <td><span class="bg-status-lunas"><?= $data_pembayaran['status_pembayaran']; ?></span></td>
                            <?php endif ?>
                            <td>
                                <?php if ($data_pembayaran['status_pembayaran'] == 'Belum' && $data_pembayaran['nominal_pembayaran'] == '0') : ?>
                                    <a href="bayar.php?id_pembayaran=<?= $data_pembayaran['id_pembayaran']; ?>&id_siswa=<?= $id_siswa; ?>" class="btn">Bayar</a>
                                <?php else: ?>
                                    <a href="ubah_bayar.php?id_pembayaran=<?= $data_pembayaran['id_pembayaran']; ?>&id_siswa=<?= $id_siswa; ?>" class="btn">Ubah</a>
                                <?php endif ?>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        <?php endif ?>
    </div>
</body>
</html>