<?php include('inc/session1.php'); ?>
<?php include('inc/header.php'); ?>
<?php include('inc/menubar.php'); ?>

<div id="res"></div>

<div class="stockformclass">
    <p>Sale Item Details</p>
    <form id="Sale_item_data" method="post">
        <div class="container border">
            <div class="row py-2">
                <div class="col-md-6">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="">Customer Name</span>
                        </div>
                        <input type="text" class="form-control" onkeydown="return /[a-zA-Z\s]/.test(event.key)" id="Customer_nm" placeholder=" Customer Name">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id=" ">Contact No</span>
                        </div>
                        <input type="Number" class="form-control" oninput="this.value = this.value.slice(0, 10)" id="Contact_no" placeholder="+91************">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id=" ">Bill No</span>
                        </div>
                        <input type="text" class="form-control" id="invoice_no"
                            value="<?= 'MShop' . rand(11111, 99999); ?>" readonly>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id=" ">Bill Date</span>
                        </div>
                        <input type="date" name="" id="currentDate" class="form-control">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="ash">
                        <table class="table">
                            <thead class="thead-light">
                                <tr>
                                    <th>Item Name</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Rate</th>
                                    <th scope="col">Amount</th>
                                    <th> <button id="Sale_Add_feild" class="btn btn-primary">+</button></th>
                                </tr>
                            </thead>
                            <tbody id="Saleform">
                            </tbody>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>Grand total</td>
                                <td><input type="number" id="totalAmount" name="totalAmount"
                                        class="form-control totalAmount" readonly /></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <div class="row text-center">
                <div class="col">
                    <input type="submit" value="Save" id="save_Sale_button" class="btn btn-primary">
                    <small id="Err_btn_Sale" style="color:red;">Please Append Sale Input Feild!</small>
                   
                </div>
            </div>
        </div>
    </form>
</div>


<?php include('inc/footer.php'); ?>