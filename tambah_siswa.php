<?php
    include 'koneksi.php';
    if (!isset($_SESSION['id_user'])){
        echo "<script>window.location='login.php'</script>";
    }

    $id_user = $_SESSION['id_user'];
    $data_user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM user WHERE id_user = '$id_user'"));

    if (isset($_POST['btnSimpan'])) {
        $nama_siswa = $_POST['nama_siswa'];
        $alamat_siswa = $_POST['alamat_siswa'];
        $tgl_lahir_siswa = $_POST['tgl_lahir_siswa'];

        $tambah_siswa = mysqli_query($conn, "INSERT INTO siswa VALUES ('', '$nama_siswa', '$alamat_siswa', '$tgl_lahir_siswa')");

        if ($tambah_siswa) {
            $id_siswa = mysqli_insert_id($conn);
            mysqli_query($conn, "INSERT INTO pembayaran VALUES('', '$id_siswa', '', 'Januari', '', 'Belum')");
            mysqli_query($conn, "INSERT INTO pembayaran VALUES('', '$id_siswa', '', 'Februari', '', 'Belum')");
            mysqli_query($conn, "INSERT INTO pembayaran VALUES('', '$id_siswa', '', 'Maret', '', 'Belum')");
            mysqli_query($conn, "INSERT INTO pembayaran VALUES('', '$id_siswa', '', 'April', '', 'Belum')");
            mysqli_query($conn, "INSERT INTO pembayaran VALUES('', '$id_siswa', '', 'Mei', '', 'Belum')");
            mysqli_query($conn, "INSERT INTO pembayaran VALUES('', '$id_siswa', '', 'Juni', '', 'Belum')");
            mysqli_query($conn, "INSERT INTO pembayaran VALUES('', '$id_siswa', '', 'Juli', '', 'Belum')");
            mysqli_query($conn, "INSERT INTO pembayaran VALUES('', '$id_siswa', '', 'Agustus', '', 'Belum')");
            mysqli_query($conn, "INSERT INTO pembayaran VALUES('', '$id_siswa', '', 'September', '', 'Belum')");
            mysqli_query($conn, "INSERT INTO pembayaran VALUES('', '$id_siswa', '', 'Oktober', '', 'Belum')");
            mysqli_query($conn, "INSERT INTO pembayaran VALUES('', '$id_siswa', '', 'November', '', 'Belum')");
            mysqli_query($conn, "INSERT INTO pembayaran VALUES('', '$id_siswa', '', 'Desember', '', 'Belum')");

            echo "
                <script>
                    alert('Siswa berhasil ditambahkan!')
                    window.location.href='siswa.php'
                </script>
            ";
            exit;
        } else {
            echo "
                <script>
                    alert('Siswa gagal ditambahkan!')
                    window.history.back()
                </script>
            ";
            exit;
        }
    }
?>

<html>

<head>
    <title>Tambah Siswa</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php include 'top-side-bar.php'; ?> 
    <div class="main">
        <h1>Tambah Siswa</h1>
        <form method="post" class="form-admin">
            <div class="form-group">
                <label for="nama_siswa">Nama Siswa</label>
                <input type="text" id="nama_siswa" name="nama_siswa" class="input" required>
            </div>
            <div class="form-group">
                <label for="alamat_siswa">Alamat Siswa</label>
                <textarea id="alamat_siswa" name="alamat_siswa" class="input" required></textarea>
            </div>
            <div class="form-group">
                <label for="tgl_lahir_siswa">Tanggal Lahir Siswa</label>
                <input type="date" id="tgl_lahir_siswa" name="tgl_lahir_siswa" class="input" required>
            </div>
            <button type="submit" class="btn" name="btnSimpan">Simpan</button>
        </form>
    </div>
</body>

</html>