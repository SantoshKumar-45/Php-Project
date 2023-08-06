<?php include('inc/session1.php'); ?>
<?php include('inc/Connection.php'); ?>
<?php include('inc/header.php'); ?>
<?php include('inc/menubar.php'); ?>

<div id="res"></div>

<div class="stockformclass">
  <form id="Purachase_form_data" method="post">
    <p>Purchase Item Details</p>
    <div class="container border">
      <div class="row py-2">
        <div class="col-md-6">
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text">Supplier Name</span>
            </div>
            <?php
            $sql = "SELECT * FROM `supplier_master` WHERE `status`=1";
            $res = mysqli_query($con, $sql);

            $options = '<option value="0"  selected>Select Supplier</option>';

            if (mysqli_num_rows($res) > 0) {
              while ($row = mysqli_fetch_assoc($res)) {
                $optionValue = $row['id'];
                $optionText = $row['supplier_nm'];
                $options .= '<option value="' . $optionValue . '">' . $optionText . '</option>';
              }
            } else {
              $options .= '<option value="null">No Supplier Found</option>';
            }

            echo '<select id="suppList" class="selectItem form-control"  name="Supplier_id">' . $options . '</select>';
            ?>

          </div>
        </div>

        <div class="col-md-6">
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text">Invoice No</span>
            </div>
            <input type="number" class="form-control" id="invoice_no" name="invoice_no" placeholder="Invoice No" required/>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" id=" ">Invoice Date</span>
            </div>
            <input type="date" name="date" id="Pdate" class="form-control" required/>
          </div>
        </div>
        <div class="col-md-6">
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" id=" ">Receiving No</span>
            </div>
            <input type="text" class="form-control" id="receiving_no" name="receiving_no"
              value="<?= rand(1111123, 9999923); ?>" readonly>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col">
          <div class="ash">
            <table class="table table-sm">
              <thead class="thead-light">
                <tr>
                  <th>Item Name</th>
                  <th scope="col">Quantity</th>
                  <th scope="col">Rate</th>
                  <th scope="col">Amount</th>
                  <th> <button id="addf" class="btn btn-primary">+</button></th>
                </tr>
              </thead>
              <tbody id="purchaseform">
                                
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="row text-center">
        <div class="col">
          <input type="submit" id="saveButton" class="btn btn-primary" value="save" />
          <small id="Errmsg" style="color:red;">Please Append Input Feild !</small>
          
        </div>
      </div>
    </div>
  </form>
</div>




<?php include('inc/footer.php'); ?>