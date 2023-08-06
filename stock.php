<?php include('inc/session1.php'); ?>
<?php include('inc/Connection.php') ?>
<?php include('inc/header.php'); ?>
<?php include('inc/menubar.php'); ?>


<div id="res"></div>

<div class="Entryform">
  <p>Add Item</p>
  <div class="row">
    <div class="col">
      <label>Item Name</label>
      <input class="form-control" onkeydown="return /[a-zA-Z\s]/.test(event.key)" placeholder="Item name" id="itemNm"
        required />


    </div>
    <div class="col">
      <label>Item Code </label>
      <input type="number" class="form-control" placeholder="Item code" id="itemCd" required />
    </div>

    <div class="col">
      <input type="submit" class="btn btn-info" value="ADD" id="sadd">
    </div>
  </div>



  <?php
  $sql = "SELECT * FROM item_master WHERE `status`=1";
  $res = mysqli_query($con, $sql);
  if (mysqli_num_rows($res) > 0) {
    echo '
    <table class="table table-sm myTable">
      <thead class="table-info">
        <tr>
          <th scope="col">S.No.</th>          
          <th scope="col">Item Name</th>
          <th scope="col">Item Code</th>
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
        <td>' . $row['Item_nm'] . '</td>
        <td>' . $row['item_code'] . '</td>       
        <td>
          <a class="btn btn-warning" href="stock_update.php?id=' . $row['id'] . '">UPDATE</a>
        </td>
        <td>
          <a class="btn btn-danger" onclick="confirmDeleteItems(' . $row['id'] . ')">DELETE</a>      
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
  <?php include('inc/footer.php'); ?>
</div>



<script>
  //delete Confirmation  Code  js Code
  function confirmDeleteItems(id) {
    var result = confirm("Are you sure you want to delete this item id" + ' ' + id);
    if (result) {
      window.location.href = 'stock_process.php?reqType=stockDel&id=' + id;
    }
  }
</script>