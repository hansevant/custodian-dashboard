<?php
if(isset($_POST["departemen_id"]) && !empty($_POST["departemen_id"])){
    // Koneksi ke database
    $servername = "127.0.0.1";
    $username = "root";
    $password = "";
    $dbname = "db_brimost"; // Ganti dengan nama database Anda

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Cek koneksi
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Query untuk mengambil tim berdasarkan departemen_id
    $sql_tim = "SELECT id, name FROM teams WHERE departemen_id = ".$_POST['departemen_id'];
    $result_tim = $conn->query($sql_tim);

    if($result_tim->num_rows > 0){
        echo '<option value="">--Pilih Tim--</option>';
        while($row_tim = $result_tim->fetch_assoc()){
            echo '<option value="'.$row_tim['id'].'">'.$row_tim['name'].'</option>';
        }
    }else{
        echo '<option value="">Tim tidak tersedia</option>';
    }

    $conn->close();
}
?>
