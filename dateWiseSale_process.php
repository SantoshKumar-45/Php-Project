<?php

include('inc/Connection.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $start_date = $_POST["startDate"];
  $end_date = $_POST["endDate"];

  $sql = "SELECT im.id, im.Item_nm,sm.customer_nm, sd.sale_quantity, sd.rate, sd.amount, sd.Sale_date FROM item_master im JOIN sale_details sd ON im.id = sd.item_id JOIN sale_master sm ON sm.id = sd.sale_master_id WHERE im.STATUS = 1 AND sd.Sale_date BETWEEN '$start_date' AND '$end_date'";
  $res = mysqli_query($con, $sql);
  if (mysqli_num_rows($res) > 0) {
    echo '
    <table class="table table-sm myTable">
      <thead class="table-info">
        <tr>
          <th scope="col">S.No.</th>
           <th scope="col">Item Name</th>
           <th scope="col">Customer Name</th>
           <th scope="col">Quantity</th>
           <th scope="col">Rate</th>
           <th scope="col">Amount</th>
          <th scope="col">Date</th>
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
      <td>' . $row['customer_nm'] . '</td>
      <td>' . $row['sale_quantity'] . '</td>
      <td>₹' . $row['rate'] . '/-</td> 
      <td>₹' . $row['amount'] . '/-</td>
      <td>' . $row['Sale_date'] . '</td>
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
        No Sale Data Found In This Date!
    </div>
  ';
  }
}

?>
