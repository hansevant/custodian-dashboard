<?php

include '../../function.php';
session_start();

// fungsi logout
if (isset($_GET['logout'])) {
    session_destroy();
    echo "<script>alert('Bye, See u again :)'); 
                location.href='../' </script>";
}

// fungsi ganti password
if (isset($_POST['submit_cp'])) {

    $oldpass    =  mysqli_real_escape_string($conn, $_POST['oldpassword']);
    $newpass    =  mysqli_real_escape_string($conn, $_POST['newpassword']);
    $cpass    =  mysqli_real_escape_string($conn, $_POST['newpassword2']);

    $rpass = mysqli_fetch_row(mysqli_query($conn, "SELECT `password` FROM users where id = '$_SESSION[id]'"));

    // cek apakah password yang dimasukan sama dengan password di database
    if (password_verify($oldpass, $rpass[0])) {

        // Ketentuan passwordnya
        $uppercase = preg_match('@[A-Z]@', $newpass);
        $lowercase = preg_match('@[a-z]@', $newpass);
        $number    = preg_match('@[0-9]@', $newpass);
        $specialChars = preg_match('@[^\w]@', $newpass);

        // cek apakah sudah sesuai ketentuan password yang dibuat
        if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($newpass) < 8) {

            echo "<script>alert('Sorry, password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.'); 
            location.href='../account.php?failed=1' </script>";
        } else {
            // cek apakah password baru sama dengan konfirmasi passnya
            if ($newpass == $cpass) {

                $pass = password_hash($newpass, PASSWORD_DEFAULT);
                $query = mysqli_query($conn, "UPDATE users 
                                SET `password` = '$pass',
                                    reset_pass = 0
                                WHERE id = '$_SESSION[id]' ");
                if ($query) {
                    echo "<script>alert('successfully changed password'); 
                                            location.href='../account.php?success=1' </script>";
                } else {
                    echo "<script>alert('Failed to change password'); 
                                            location.href='../account.php?failed=1' </script>";
                }
            } else {
                echo "<script>alert('The new password is not the same, please try again'); 
                    location.href='../account.php?failed=1' </script>";
            }
        }
    } else {
        echo "<script>alert('Your old password is wrong, please enter the correct one'); 
                    location.href='../account.php?failed=1' </script>";
    }
}
