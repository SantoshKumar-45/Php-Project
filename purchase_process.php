<?php include('inc/Connection.php');


$data = json_decode(file_get_contents("php://input"), true);

// Extract general sale information
$supplier_id = $data["supplier_id"];
$invoiceNo = $data["invoiceNo"];
$invoiceDate = $data["invoiceDate"];
$receivingNo = $data["receivingNo"];

// Insert purchase master
$sql = "INSERT INTO purchase_master (invoice_no, invoice_date, receiving_no, supplier_id) VALUES (?, ?, ?, ?)";
$stmt = $con->prepare($sql);
$stmt->bind_param("sssi", $invoiceNo, $invoiceDate, $receivingNo, $supplier_id);
$res = $stmt->execute();

if ($res) {
    // Insert successful, get the insert ID
    $purchase_master_id = mysqli_insert_id($con);
    // echo 'purchasemaster is',$purchase_master_id;
    // Extract item details
    $purchaseitemDetails = $data['itemDetails'];


    foreach ($purchaseitemDetails as $item) {
        $item_id = $item['item_id'];
        $quantity = $item['quantity'];
        $rate = $item['rate'];
        $amount = $item['amount'];

        // Get the current purchase_quantity for the item from the database
        $sqlQty = "SELECT purchase_quantity, amount FROM purchase_details WHERE `item_id`='$item_id'";
        $resQty = mysqli_query($con, $sqlQty);

        if ($resQty && mysqli_num_rows($resQty) > 0) {
            // If purchase_quantity exists for the item, update it
            $row = mysqli_fetch_assoc($resQty);
            $current_quantity = (int) $row['purchase_quantity'];
            $current_amount = (int) $row['amount'];
            $totalAmount = $current_amount + $amount;
            $new_quantity = $current_quantity + $quantity;
            // echo $rate, $totalAmount, $new_quantity;

            // Prepare and execute query to update the purchase_details table
            $sqlUpd = "UPDATE purchase_details SET `purchase_quantity`='$new_quantity', `rate`='$rate', `amount`='$totalAmount' WHERE `item_id`='$item_id'";
            $UpdRes = mysqli_query($con, $sqlUpd);
        } else {
            // If purchase_quantity does not exist, insert a new row
            $sql1 = "INSERT INTO purchase_details (purchase_master_id, item_id, purchase_quantity, rate, amount) VALUES (?, ?, ?, ?, ?)";
            $stmt1 = $con->prepare($sql1);
            $stmt1->bind_param("iiddd", $purchase_master_id, $item_id, $quantity, $rate, $amount);
            $stmt1->execute();
        }
    }


    $con->close();

    echo "Data Purchased successfully!";
} else {
    echo 'Error Occured in Insert Purchase Master !', mysqli_error($con);
}






// Get the JSON data sent from the client-side
// $data = json_decode(file_get_contents("php://input"), true);

// // Extract general sale information
// $supplier_id =$data["supplier_id"];
// $invoiceNo =$data["invoiceNo"];
// $invoiceDate =$data["invoiceDate"];
// $receivingNo =$data["receivingNo"];

// //insert purchase Master
// $sql = "INSERT INTO purchase_master (invoice_no, invoice_date, receiving_no, supplier_id) VALUES ('$invoiceNo', '$invoiceDate', '$receivingNo', $supplier_id)";
// $res = mysqli_query($con, $sql);

// if ($res) {
//     // Insert successful, get the insert ID
//     $purchase_master_id = mysqli_insert_id($con);
//     echo "Inserted ID: " . $purchase_master_id;
// } else {
//     // Insert failed, handle the error
//     echo "Error: " . mysqli_error($con);
// }

// // Extract item details
// $purchaseitemDetails = $data['purchaseitemDetails'];

// // Prepare and execute query to insert into the purchase_details table

//     // echo 'quqntity-------------->',$quantity . '-' . $item;
//     for ($i = 0; $i < count($purchaseitemDetails); $i++) {

//                 $sql1 = "INSERT INTO purchase_details (purchase_master_id, item_id, quantity, rate, amount) VALUES ( $purchase_master_id , $item_id[$i],  $quantities[$i], $rates[$i], $amounts[$i])";

//                 $res1 = mysqli_query($con, $sql1);
//                 echo $res1;
//             }
//     if ($res) {
//         $sql1 = "SELECT `quantity` FROM `purchase_details` WHERE `item_id`='$item_id'";
//         $res1 = mysqli_query($con, $sql1);
//         $row = mysqli_fetch_assoc($res1);
//         $oldQty = $row['quantity'];
//         $newQty = (int) $oldQty - (int) $quantity;


//         $sql2 = "UPDATE `purchase_details` SET `quantity`='$newQty' WHERE `item_id`='$item_id'";
//         $res2 = mysqli_query($con, $sql2);
//         if ($res2) {
//             echo '1';
//         } else {
//             echo '
//             <div class="alert alert-danger myAlert" role="alert">
//                 Error!
//             </div>
//             ';
//         }
//     } else {
//         echo '
//         <div class="alert alert-danger myAlert" role="alert">
//             Error!
//         </div>
//         ';
//     }




// $con->close();

// // Send a success message back to the frontend (optional)
// echo "Data Purchased successfully!";



?>