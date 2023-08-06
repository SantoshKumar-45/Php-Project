<?php
session_start();
include('inc/Connection.php');

// item  add
// Validate the request type to  access
if ($_REQUEST['reqType'] === 'stockAdd') {

    // Check if the required fields are present and not empty
    if (isset($_REQUEST['item_nm']) && isset($_REQUEST['item_code']) && !empty($_REQUEST['item_nm']) && !empty($_REQUEST['item_code'])) {
        $item_nm = $_REQUEST['item_nm'];
        $item_code = $_REQUEST['item_code'];



        $sql = "INSERT INTO `item_master` (item_code, Item_nm, status) VALUES ('$item_code', '$item_nm', '1')";
        $res = mysqli_query($con, $sql);

        if ($res) {

            echo '1';
        } else {

            echo '<div class="alert alert-danger myAlert" role="alert">Error!</div>';
        }
    } else {
        // Required fields are missing or empty
        echo '<div class="alert alert-danger myAlert" role="alert">Please provide item name and item code.</div>';
    }
}




// item update 
if ($_REQUEST['reqType'] == 'ItemUpd') {
    //validate check id and item Nmae Set or Not
    if (isset($_REQUEST['pId']) && isset($_REQUEST['item_nm'])) {

        $id = $_REQUEST['pId'];
        $item_code = $_REQUEST['item_cd'];
        $item_nm = $_REQUEST['item_nm'];
        $sql = "UPDATE item_master SET `item_code`='$item_code',`Item_nm`='$item_nm' WHERE `id`='$id'";
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
}



// item delete
if ($_REQUEST['reqType'] == 'stockDel') {

    $id = $_REQUEST['id'];
    $sql = "UPDATE item_master SET `status`=0 WHERE `id`='$id'";
    $res = mysqli_query($con, $sql);
    if ($res) {
        header('location:stock.php');
    }
}