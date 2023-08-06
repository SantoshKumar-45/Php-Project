<?php include('inc/session1.php');?>
<?php include('inc/Connection.php')?>
<?php include('inc/header.php');?>
<?php include('inc/menubar.php');?>

<img src="assets/img/welcm.jpg" class="welcomeclass">

<?php include('inc/footer.php');?>






    <tr>
                  <td>
                    <?php
                    $sql = "SELECT * FROM `item_master` WHERE `status`=1";
                    $res = mysqli_query($con, $sql);
                    echo '
                        <select id="suppList" class="selectItem form-control" name="itemName[]">
                        <option value="0" selected>Select Item</option>
                        ';
                    if (mysqli_num_rows($res) > 0) {
                      while ($row = mysqli_fetch_assoc($res)) {
                        $optionValue = $row['id'] . '-' . $row['Item_nm'];
                        echo '<option value="' . $optionValue . '">' . $row['Item_nm'] . '</option>';
                      }
                    } else {
                      echo '<option value="null">No Item found</option>';
                    }

                    echo '</select>';
                    ?>
                  </td>
                  <td><input type="number" name="quantity[]" class="form-control quantity" placeholder="Quantity"></td>
                  <td><input type="number" name="rate[]" class="form-control rate" placeholder="Rate"></td>
                  <td><input type="number" name="total[]" class="form-control total" placeholder="Total" readonly></td>

                </tr>




                //for Sale
                <td>
                                    <?php
                                    $sql = "SELECT item_master.id,item_master.Item_nm, item_master.item_code, purchase_details.quantity, purchase_details.rate FROM item_master JOIN purchase_details ON item_master.id = purchase_details.item_id where STATUS=1;";
                                    $res = mysqli_query($con, $sql);
                                    echo '
                                   <select id="itemList" class="selectItem form-control" name="itemName[]">
                                   <option value="0" selected>Select Item</option>
                        ';
                                    if (mysqli_num_rows($res) > 0) {
                                        while ($row = mysqli_fetch_assoc($res)) {
                                            $optionValue = $row['id'] . '-' . $row['Item_nm'] . '-' . $row['rate'];
                                            echo '<option value="' . $optionValue . '">' . $row['Item_nm'] .'-' . $row['rate']. '</option>';
                                        }
                                    } else {
                                        echo '<option value="null">No Item found</option>';
                                    }

                                    echo '</select>';
                                    ?>
                                </td>
                                <td><input type="number" id='Sqty' name="quantity[]" class="form-control quantity"
                                        placeholder="Quantity"></td>

                                <td><input type="number" id="rate" name="rate[]" class="form-control rate" placeholder="Rate"
                                        readonly>
                                </td>
                                <td><input type="number" id='total' name="total[]" class="form-control total" placeholder="Total"
                                        readonly></td>
                                <!-- <td>
                                <button class="btn btn-danger remove">X</button>
                                </td> -->




                                // if ($_SERVER["REQUEST_METHOD"] === "POST") {
//     $supplier_id = $_POST["supplier_id"];
//     $invoiceNo = $_POST["invoiceNo"];
//     $invoiceDate = $_POST["invoiceDate"];
//     $receivingNo = $_POST["receivingNo"];
//     $item_id = $_POST["item_id"];
//     $quantities = $_POST["quantities"];
//     $rates = $_POST["rates"];
//     $amounts = $_POST["amounts"];

//     //insert purchase Master
//     $sql = "INSERT INTO purchase_master (invoice_no, invoice_date, receiving_no, supplier_id) VALUES ('$invoiceNo', '$invoiceDate', '$receivingNo', $supplier_id)";
//     $res = mysqli_query($con, $sql);

//     if ($res) {
//         // Insert successful, get the insert ID
//         $purchase_master_id = mysqli_insert_id($con);
//         echo "Inserted ID: " . $purchase_master_id;
//     } else {
//         // Insert failed, handle the error
//         echo "Error: " . mysqli_error($con);
//     }

//     for ($i = 0; $i < count($item_id); $i++) {

//         $sql1 = "INSERT INTO purchase_details (purchase_master_id, item_id, quantity, rate, amount) VALUES ( $purchase_master_id , $item_id[$i],  $quantities[$i], $rates[$i], $amounts[$i])";

//         $res1 = mysqli_query($con, $sql1);
//         echo $res1;
//     }
// }