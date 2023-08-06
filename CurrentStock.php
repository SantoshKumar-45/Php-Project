<?php include('inc/session1.php'); ?>
<?php include('inc/Connection.php') ?>
<?php include('inc/header.php'); ?>
<?php include('inc/menubar.php'); ?>


<div class="container">
  <p>Stock Item</p>
  <div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4"></div>
    <div class="col-md-4">
      <label for="">Search by Item Name & Item Code</label>
      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" id="Search_item" placeholder="Search by Item Name and Item_Code"
          aria-label="Search by Item Name and Item_Code">
      </form>
    </div>
  </div>


  <div id="ShowStockReport">

  </div>


  

</div>
<?php include('inc/footer.php'); ?>