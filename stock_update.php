<?php include('inc/session1.php');?>
<?php include('inc/Connection.php')?>
<?php include('inc/header.php');?>
<?php include('inc/menubar.php');?>

<?php
$id = $_REQUEST['id'];
$sql = "SELECT * FROM item_master WHERE `id`='$id'";
$res = mysqli_query($con,$sql);
$row = mysqli_fetch_assoc($res);
$item_nm = $row['Item_nm'];
$item_code = $row['item_code'];
?>

<div id="res"></div>

<div class="stockformclass">
    <input type="text" value="<?=$id?>" id="pId" hidden>
  <div class="row">
    <div class="col">
      <label>item name</label>
      <input type="text" class="form-control" onkeydown="return /[a-zA-Z\s]/.test(event.key)" placeholder="item name" id="item_nm" value="<?= $item_nm?>" />
    </div>
    <div class="col">
      <label>item code</label>
      <input type="text" class="form-control" placeholder="item code" id="item_code" value="<?= $item_code?>"/>
    </div>
    
    <div class="col">
      <label></label>
      <input type="submit" class="btn btn-info" value="UPDATE" id="ItemUpdate">
    </div>
  </div>
</div>


<?php include('inc/footer.php')?>