<?php include('inc/session1.php'); ?>
<?php include('inc/Connection.php'); ?>
<?php include('inc/header.php'); ?>
<?php include('inc/menubar.php'); ?>

<div class="container py-4">
    <div class="row">
        <div class="col-md-3">
            <label for="">Date</label>
            <input type="date" class="form-control" name="" id="start_date">
        </div>
        <div class="col-md-3">
            <label for="">Date</label>
            <input type="date" class="form-control" name="" id="end_date">
        </div>
        <div class="col-md-6">
            <button type="submit" id="Search_purchase_Report" class="btn btn-info">Search</button>
        </div>
    </div>


    
    <div id="searchDateWisePurchase">

    </div>
</div>
<?php include('inc/footer.php'); ?>


