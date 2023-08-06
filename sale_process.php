<?php
include('inc/Connection.php');


$data = json_decode(file_get_contents("php://input"), true);

// Extract general sale information
$customerName = $data['customerName'];
$contactNo = $data['contactNo'];
$billNo = $data['billNo'];
$billDate = $data['billDate'];

// Prepare and execute query to insert into the salemaster table
$sql_salemaster ="INSERT INTO sale_master (customer_nm,customer_contact,bill_no, bill_date) 
                   VALUES ('$customerName', '$contactNo', '$billNo', '$billDate')";
$res = mysqli_query($con, $sql_salemaster);

if ($res) {
    //  Insert successful, get the insert ID
    $sale_master_id = mysqli_insert_id($con);
    //  echo "Inserted ID: " . $sale_master_id;
} else {
    // Insert failed, handle the error
    echo "Error: " . mysqli_error($con);
}

// Extract item details
$itemDetails = $data['itemDetails'];

// Prepare and execute query to insert into the sale_details table
foreach ($itemDetails as $item) {
    $item_id = $item['item_id'];
    $quantity = $item['quantity'];
    $rate = $item['rate'];
    $amount = $item['amount'];

    // echo 'quqntity-------------->',$quantity . '-' . $item;
    $sql_sale_details ="INSERT INTO sale_details (sale_master_id, item_id, rate,sale_quantity, amount) 
                         VALUES ('$sale_master_id', '$item_id','$rate','$quantity', '$amount')";
    $res = mysqli_query($con, $sql_sale_details);

    if ($res) {
        echo 'Data Saved Successfully';
            
    } else {
        echo '
        <div class="alert alert-danger myAlert" role="alert">
            Error!
        </div>
        ';
    }
}





?>