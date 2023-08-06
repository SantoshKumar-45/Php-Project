<?php
include('inc/Connection.php'); 
$sql="SELECT username FROM login_tb";
$res=mysqli_query($con,$sql);
$row=mysqli_fetch_assoc($res);
$username=$row['username'];
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="home.php">Welcome  <?=$username?> </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="home.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="stock.php">Item Master</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="supplier.php">Supplier Master</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="purchase.php">Purchase</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="sale.php">Sale</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="Reports.php" id="navbarDropdown" role="button" data-toggle="dropdown"
          aria-haspopup="true" aria-expanded="false">
          Reports
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="CurrentStock.php">Current Stock</a>
          <a class="dropdown-item" href="dateWisePurchase.php">DateWise Purchase</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="dateWiseSale.php">DateWise Sale</a>
        </div>
      </li>
    
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <a class="btn btn-outline-danger my-2 my-sm-0" href="inc/logout.php">logout</a>
      
    </form>
  </div>
</nav>