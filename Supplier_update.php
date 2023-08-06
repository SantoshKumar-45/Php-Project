<?php include('inc/session1.php'); ?>
<?php include('inc/Connection.php') ?>
<?php include('inc/header.php'); ?>
<?php include('inc/menubar.php'); ?>


<?php   
$id = $_REQUEST['id'];
$sql = "SELECT * FROM supplier_master WHERE `id`='$id'";
$res = mysqli_query($con,$sql);
$row = mysqli_fetch_assoc($res);
$suppnm = $row['supplier_nm'];
$suppContact = $row['supplier_contact'];
$suppaddr = $row['address1'];

?>

<div id="res"></div>
<input type="text" id="Sid" value="<?=$id?>" hidden>
<div class="Entryform">
    <p>Supplier Update</p>
    <div class="row">
        <div class="col">
            <label>Supplier Name</label>
            <input type="text" class="form-control"  onkeydown="return /[a-zA-Z\s]/.test(event.key)" value="<?=$suppnm?>" placeholder="Supplier Name" id="supp_nm">
        </div>
        <div class="col">
            <label>Contact </label>
            <input type="number" class="form-control" oninput="this.value = this.value.slice(0, 10)" value="<?=$suppContact?>" placeholder="+91*********" id="supp_contact">
        </div>
        <div class="col">
            <label>Address </label>
            <input type="text" class="form-control"  value="<?=$suppaddr?>" onkeydown="return /[a-zA-Z\s]/.test(event.key)" placeholder="Address*****" id="supp_Add">
        </div>
        <div class="col">
            <input type="submit" class="btn btn-info" value="Update" id="Supp_Upd">
        </div>
    </div>





    <?php include('inc/footer.php'); ?>