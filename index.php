<?php include('inc/header.php')?>

<h2 class="headerh2">Inventory Management System</h2>

<form class="loginForm">
<div class="alert alert-danger" role="alert" hidden>
  Check username or password !
</div>
  <div class="form-group">
    <label>Username</label>
    <input type="text" class="form-control" id="user" placeholder="Enter username">
  </div>
  <div class="form-group">
    <label>Password</label>
    <input type="password" class="form-control" id="pass" placeholder="Enter Password">
  </div>
  <button type="submit" class="btn btn-primary" id="loginbtn">LOGIN</button>
</form>

<?php include('inc/footer.php')?>