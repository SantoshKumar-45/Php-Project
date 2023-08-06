<?php include('inc/session1.php'); ?>
<?php include('inc/Connection.php') ?>
<?php include('inc/header.php'); ?>
<?php include('inc/menubar.php'); ?>


<div id="res"></div>

<div class="Entryform">
<p>Add Supplier</p>
  <div class="row">
    <div class="col">
      <label>Supplier Name</label>
      <input type="text" class="form-control" onkeydown="return /[a-zA-Z\s]/.test(event.key)" placeholder="Supplier Name" id="supp_nm" required/>
    </div>
    <div class="col">
      <label>Contact No</label>
      <input type="number"  oninput="this.value = this.value.slice(0, 10)"  class="form-control" placeholder="+91*********" id="supp_contact" maxlength="10" required/>
    </div>
    <div class="col">
      <label>Address </label>
      <input type="text" class="form-control" onkeydown="return /[a-zA-Z\s]/.test(event.key)" placeholder="Address*****" id="supp_Add" required/>
    </div>
    <div class="col">
      <input type="submit" class="btn btn-info" value="ADD" id="Supp_Add">
    </div>
  </div>

  <?php
  $sql = "SELECT * FROM supplier_master WHERE `status`=1";
  $res = mysqli_query($con, $sql);
  if (mysqli_num_rows($res) > 0) {
    echo '
    <table class="table  table-sm myTable">
      <thead class="table-info">
        <tr>
          <th scope="col">S.No.</th>
          <th scope="col">Supplier Name</th>
          <th scope="col">Contact</th>
          <th scope="col">Address</th>
          <th scope="col">Edit</th>
          <th scope="col">Delete</th>
        </tr>
      </thead>
    <tbody>
  ';

    $x = 1;
    while ($row = mysqli_fetch_assoc($res)) {
      echo '
      <tr>
        <th scope="row">' . $x . '</th>
        <td>' . $row['supplier_nm'] . '</td>
        <td>' . $row['supplier_contact'] . '</td>
        <td>' . $row['address1'] . '</td>
        <td>
          <a class="btn btn-warning" href="Supplier_update.php?id='. $row['id'] . '">UPDATE</a>
        </td>
        <td><a class="btn btn-danger" onclick="confirmDeleteSuppliers(' . $row['id'] . ')">DELETE</a>      
        
        
</td>
      </tr>
    ';
      $x++;
    }


    echo '
    </tbody>
  </table>
  ';
  } else {
    echo '
    <div class="alert alert-primary myAlert" role="alert">
        No Stock Found!
    </div>
  ';
  }
  ?>

</div>
<?php include('inc/footer.php'); ?>



<script>
  //delete Confirmation  Code 
  function confirmDeleteSuppliers(id) {
    var result = confirm("Are you sure you want to delete this item id" + ' ' + id);
    if (result) {
      window.location.href ='Supplier_process.php?reqType=SuppDel&id=' + id;
    }
  }
</script>

