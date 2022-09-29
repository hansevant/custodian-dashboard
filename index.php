<!DOCTYPE html>
<html dir="ltr">

<?php
session_start();
$server = "localhost";
$username = "root";
$pw = "";
$db = "cutodi";

$conn = mysqli_connect($server, $username, $pw, $db);
error_reporting(0);
if ($_SESSION['id']) {
    echo "<script>
    location.href = 'dashboard/template.php';
  </script>";
}

if (isset($_POST["login"])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    //to prevent from mysqli injection  
    // $username = stripcslashes($username);
    // $password = stripcslashes($password);
    // $username = mysqli_real_escape_string($conn, $username);
    // $password = mysqli_real_escape_string($conn, $password);

    $sql = "select * from users where username = '$username' and `password` = md5('$password')";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);

    if ($count == 1) {
        $_SESSION['role'] = $row['role'];
        $_SESSION['id'] = $row['id'];
        $_SESSION['name'] = $row['name'];

        echo "<script> alert('Login successful')
        location.href='dashboard/index.php'</script>";
    } else {
        echo "<script> alert('Login failed. Invalid username or password.')</script>";
    }

    // otorisasi
    // if ($row['role'] == 'RM') {
    //     echo 'anda adalah rm';
    // } else if ($row['role'] == 'C') {
    //     echo 'anda adalah Compliance';
    // } else {
    //     echo "anda bukan siapa siapa";
    // }
}
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="center">
        <h1>Please Login</h1>
        <form action="" method="post">
            <div class="txt_field">
                <input type="text" name="username" id="uname" required>
                <span></span>
                <label for="uname">Username</label>
            </div>
            <div class="txt_field">
                <input type="password" name="password" id="pass" required>
                <span></span>
                <label for="pass">Password</label>
            </div>
            <input type="submit" value="Login" name="login">
        </form>
    </div>
</body>

</html>