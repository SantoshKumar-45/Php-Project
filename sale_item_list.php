<?php include('inc/Connection.php') ?>


<?php
$sql = "SELECT item_master.id,item_master.Item_nm, item_master.item_code, purchase_details.purchase_quantity, purchase_details.rate FROM item_master JOIN purchase_details ON item_master.id = purchase_details.item_id where STATUS=1;";
$res = mysqli_query($con, $sql);
echo '
<select id="itemList"  class="selectSaleItem form-control" name="itemName[]">
<option value="0" selected>Select Item</option>
';
if (mysqli_num_rows($res) > 0) {
    while ($row = mysqli_fetch_assoc($res)) {
        $optionValue = $row['id'] . '-' . $row['Item_nm'].'-'. $row['rate'] ;
        echo '<option value="' . $optionValue . '">' . $row['Item_nm'] . '</option>';
    }
} else {
    echo '<option value="null">No Item found</option>';
}

echo '</select>';
?>


