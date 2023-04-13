<?php
    include 'koneksi.php';
    if (isset($_SESSION['id_user'])) {
        echo "<script>window.location='index.php'</script> ";
        exit;
    }

    if (isset($_POST['btnLogin'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $query_login = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");
        if ($data_user = mysqli_fetch_assoc($query_login)) {
            if (password_verify($password, $data_user['password'])) {
                $_SESSION['id_user'] = $data_user['id_user'];
                header("Location: index.php");
                exit;
            } else {
                echo "
                    <script>
                        alert('gagal username atau password salah!')
                        window.history.back()
                    </script>
                ";
                exit;
            }
        } else {
            echo "
                <script>
                    alert('gagal username atau password salah!')
                    window.history.back()
                </script>
            ";
            exit;
        }
    }
?>

<html>
<head>
    <title>Pembayaran SPP</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <form method="post">
            <h2>Login</h2>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" class="input" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" class="input" required>
            </div>
            <button type="submit" class="btn" name="btnLogin">Login</button>
        </form>
    </div>
</body>

</html>