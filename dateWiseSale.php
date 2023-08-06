<?php include('inc/session1.php'); ?>
<?php include('inc/Connection.php'); ?>
<?php include('inc/header.php'); ?>
<?php include('inc/menubar.php'); ?>


<div class="container py-4">
    <p>Search Date Wise Sale Report</p>
    <div class="row">
        <div class="col-md-3">
            <label for="start_date">Start Date</label>
            <input type="date" class="form-control" name="start_date" id="start_date">
        </div>
        <div class="col-md-3">
            <label for="end_date">End Date</label>
            <input type="date" class="form-control" name="end_date" id="end_date">
        </div>
        <div class="col-md-6">
            <button type="submit" class="btn btn-info" id="Search_Sale_data">Search</button>
        </div>
    </div>
</div>

<div class="container">
    <div id="searchDateWiseResponse">
        
    </div>
</div>
<?php include('inc/footer.php'); ?>






