<?php 
require_once 'koneksi.php';
if (!isset($_SESSION['id_user'])) {
	header("Location: login.php");
	exit;
}

$id_user = $_SESSION['id_user'];
$data_user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM user WHERE id_user = '$id_user'"));

$id_siswa = $_GET['id_siswa'];
$hapus_siswa = mysqli_query($conn, "DELETE FROM siswa WHERE id_siswa = '$id_siswa'");

if ($hapus_siswa) {
	echo "
		<script>
			alert('siswa berhasil dihapus!')
			window.location.href='siswa.php'
		</script>
	";
	exit;
} else {
	echo "
		<script>
			alert('siswa gagal dihapus!')
			window.location.href='siswa.php'
		</script>
	";
	exit;
}

?>