<?php
 include('inc/Connection.php');

  $srchItem = "";
  if (isset($_REQUEST['srchItem'])) {
    $srchItem = $_REQUEST['srchItem']; // Assigning  Value
       
    // $srchItem = " WHERE (im.STATUS = 1) AND (`Item_nm` LIKE '%$srchItem%' OR `item_code` LIKE '%$srchItem%')";
  }

  $sql = "SELECT im.id, im.Item_nm, im.item_code, pd.purchase_quantity, sd.sale_quantity
   FROM item_master AS im
   LEFT JOIN purchase_details AS pd ON im.id = pd.item_id
   LEFT JOIN sale_details AS sd ON im.id = sd.item_id WHERE (im.STATUS = 1) AND (`Item_nm` LIKE '%$srchItem%' OR  `item_code` LIKE '%$srchItem%') ";

  $res = mysqli_query($con, $sql);
  if (mysqli_num_rows($res) > 0) {
    echo '
    
    <table class="table table-sm myTable">
      <thead class="table-info">      
        <tr>
          <th scope="col">S.No.</th>
          <th scope="col">Item Code</th>
          <th scope="col">Item Name</th>
          <th scope="col">Purchase Quantity</th>
          <th scope="col">Sale Quantity</th>
          <th scope="col">Stock</th>
        </tr>
      </thead>
    <tbody>
    
  ';

    $AvlQty = 0;

    $x = 1;
    while ($row = mysqli_fetch_assoc($res)) {

      //Availlable Quatity
      $AvlQty = $row['purchase_quantity'] - $row['sale_quantity'];
      $purchase_qty = $row['purchase_quantity'] ?? 0;
      $sale_qty = $row['sale_quantity'] ?? 0;

      echo '
      <tr>
        <th scope="row">' . $x . '</th>
        <td>' . $row['item_code'] . '</td>
        <td>' . $row['Item_nm'] . '</td>
        <td> ' . $purchase_qty . '    Pcs</td>
        <td> ' . $sale_qty . '    Pcs    </td>
        <td>' . $AvlQty . '  Pcs</td>
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