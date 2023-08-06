<?php
session_start();
include('inc/Connection.php');

$username = $_REQUEST['username'];
$password = $_REQUEST['password'];

$sql = "SELECT id,password FROM login_tb WHERE `username` = '$username'";
$res = mysqli_query($con, $sql);
if (mysqli_num_rows($res) > 0) {
    $row = mysqli_fetch_assoc($res);
    if ($row['password'] == $password) {
        $_SESSION['id'] = $row['id'];
        echo '1';
       
    } else {
        echo 'Check Password';
    }
} else {
    echo 'No User Found';
}
?>