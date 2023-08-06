<?php

session_start();
include('inc/Connection.php');

if ($_REQUEST['reqType'] == 'SuppAdd') {

    $suppnm = $_REQUEST['Suppnm'];
    $suppContact = $_REQUEST['SuppContact'];
    $SuppAddr = $_REQUEST['SuppAdd'];

    $sql = "INSERT INTO `supplier_master` (supplier_nm,supplier_contact,Address1,status) VALUES ('$suppnm','$suppContact','$SuppAddr','1')";
    $res = mysqli_query($con, $sql);
    if ($res) {
        echo '1';
    } else {
        echo '
            <div class="alert alert-danger myAlert" role="alert">
                Error!
            </div>
            ';
    }

}
if ($_REQUEST['reqType'] == 'SuppUpd') {
    $id = $_REQUEST['Sid'];
    $suppnm = $_REQUEST['Suppnm'];
    $suppContact = $_REQUEST['SuppContact'];
    $SuppAddr = $_REQUEST['SuppAdd'];

    $sql = "UPDATE `supplier_master` SET `supplier_nm`='$suppnm', `supplier_contact`='$suppContact', `address1`='$SuppAddr' WHERE `id`=$id";
    if (mysqli_query($con, $sql)) {
        echo '1';
    } else {
        echo '<div class="alert alert-danger myAlert" role="alert">Error!</div>';
    }

}
if ($_REQUEST['reqType'] == 'SuppDel') {
    $id = $_REQUEST['id'];
    $sql = "UPDATE supplier_master SET `status`=0 WHERE `id`='$id'";
    $res = mysqli_query($con, $sql);
    if ($res) {
        header('location:Supplier.php');
    }
}

?>