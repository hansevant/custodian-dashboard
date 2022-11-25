<!DOCTYPE html>
<html dir="ltr">

<?php
session_start();
$server = "localhost";
$username = "root";
$pw = "";
$db = "cutodi";

error_reporting(0);

$conn = mysqli_connect($server, $username, $pw, $db);
// error_reporting(0)   ;
if (isset($_SESSION['id'])) {
    echo "<script>
    location.href = 'dashboard/';
  </script>";
}

if (isset($_POST["login"])) {

    $username = $_POST['username'];
    $userpass = $_POST['password'];

    //to prevent from mysqli injection  
    // $username = stripcslashes($username);
    // $password = stripcslashes($password);
    // $username = mysqli_real_escape_string($conn, $username);
    // $password = mysqli_real_escape_string($conn, $password)

    // $sql = mysqli_query($conn, "SELECT * from users where username = '$username' and `password` = md5('$password')");
    $sql2 = mysqli_query($conn, "SELECT * from users where username = '$username'");
    // $row = mysqli_fetch_array($sql, MYSQLI_ASSOC);
    $row2 = mysqli_fetch_array($sql2, MYSQLI_ASSOC);
    // $count = mysqli_num_rows($sql);
    $count2 = mysqli_num_rows($sql2);
    $approve = $row2['is_approved'];
    $status = $row2['status'];
    $password = $row2['password'];
    $role = $row2['role'];

    // cek username terdaftar tidak atau akunya terkunci atau sudah tidak aktif 
    if (mysqli_num_rows($sql2) == 0) {
        echo "<script> alert('Login failed. Invalid username or password.')
        location.href='index.php?f=true'</script>";
    } elseif ($approve != 1) {
        echo "<script> alert('Login failed. Your Account needs to be approved by admin')
        location.href='index.php'</script>";
    } elseif ($status == 0) {
        echo "<script> alert('Login failed. Your Account has been deactivated by admin.')
        location.href='index.php'</script>";
    } elseif ($status == 2) {
        echo "<script> alert('Sorry Your Account has been locked after failed to login for a few times, please contact the admin.')
        location.href='index.php'</script>";
    } else {
        // cek apakah kredensial yang disubmit sesuai tidak 
        if (password_verify($userpass, $password)) {
            $_SESSION['login'] = true;
            $_SESSION['role'] = $row2['role'];
            $_SESSION['id'] = $row2['id'];
            $_SESSION['name'] = $row2['name'];
            $resetpass = $row2['reset_pass'];
            // reset login time ke 0
            mysqli_query($conn, "UPDATE users SET login_time = 0 where username = '$username' ");
            if ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'superadmin') {
                echo "<script> alert('Login successful')
            location.href='dashboard/accounts.php'</script>";
                exit;
            } elseif ($resetpass == 1) {
                echo "<script> alert('Login successful')
            location.href='dashboard/account.php'</script>";
                exit;
            } else {
                echo "<script> alert('Login successful')
            location.href='dashboard/index.php'</script>";
                exit;
            }
        } else {
            $logintimes = $row2['login_time'];
            if ($role == 'admin') {
                echo "<script> alert('Login failed. Invalid password.')
                location.href='index.php'</script>";
                exit;
            }
            if ($logintimes > 2) {
                $sql4 = "UPDATE users SET `status` = 2 where username = '$username'";
                mysqli_query($conn, $sql4);
                echo "<script> alert('Sorry Your Account has been locked after failed to login for a few times, please contact the admin.')</script>";
            } elseif ($logintimes < 3) {
                $trylogin = mysqli_query($conn, "UPDATE users SET login_time = login_time + 1 where username = '$username' ");
                echo "<script> alert('Login failed. Invalid username or password.')
                location.href='index.php?f=true'</script>";
            }
        }
    }
}
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="src/assets/css/style.css">
    <link rel="icon" type="image/png" sizes="16x16" href="partials/logo-icon.png">
</head>

<body>
    <div class="center">
        <img src="src/assets/img/logo.png" alt="">
        <h1>Please Login</h1>
        <form action="" method="post">
            <div class="txt_field">
                <input type="text" name="username" id="uname" autofocus required>
                <span></span>
                <label for="uname">Username</label>
            </div>
            <div class="txt_field">
                <input type="password" name="password" id="pass" required>
                <span></span>
                <label for="pass">Password</label>
            </div>
            <?php if (isset($_GET['f'])) { ?>
                <p style="color: orangered;">Login failed. Invalid username or password.</p>
            <?php } ?>
            <input type="submit" value="Login" name="login">
        </form>
    </div>
</body>

</html>