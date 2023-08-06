<?php include('inc/Connection.php') ?>


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

