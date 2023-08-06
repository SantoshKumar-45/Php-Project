$(document).ready(function () {

    // login code
    $("#loginbtn").on("click", function () {
        var user = $("#user").val();
        var pass = $("#pass").val();

        $.ajax({
            url: 'login_process.php',
            type: 'POST',
            data: { username: user, password: pass },
            success: function (response) {
                if (response == 1) {
                    location.href = "home.php";
                    return false;
                }
                else {
                    alert(response);
                }
            }
        });
    });

    // stock add code here
    $("#sadd").on("click", function (e) {
        e.preventDefault();
        const rT = "stockAdd";
        const item_nm = $("#itemNm").val();
        const item_code = $("#itemCd").val();

        if (item_nm !== '' && item_code !== '') {
            $.ajax({
                url: 'stock_process.php',
                type: 'POST',
                data: { reqType: rT, item_nm: item_nm, item_code: item_code },
                success: function (response) {
                    if (response == 1) {
                        location.href = "stock.php";
                        alert('Item Save Successfully');
                    } else {
                        $("#res").html(response);
                    }
                }
            });
        } else {
            alert('Please input values Item Name and Item Code');
        }
    });


    // stock update code here
    $("#ItemUpdate").on("click", function () {
        rT = "ItemUpd";
        item_code = $("#item_code").val();
        item_nm = $("#item_nm").val();
        pId = $("#pId").val();
        $.ajax({
            url: 'stock_process.php',
            type: 'POST',
            data: { reqType: rT, item_cd: item_code, item_nm: item_nm, pId: pId },

            success: function (response) {
                if (response == 1) {
                    location.href = "stock.php";
                    alert("Updated Successfully");
                }
                else {
                    $("#res").html(response);
                }
            }
        });
    });


    // Supplier add code here
    $("#Supp_Add").on("click", function () {
        const rT = "SuppAdd";
        const Suppnm = $("#supp_nm").val();
        const SuppContact = $("#supp_contact").val();
        const SuppAdd = $("#supp_Add").val();

        if (Suppnm.trim() === '') {
            alert('Please enter the Supplier Name');
            return;
        }

        if (SuppContact.trim() === '') {
            alert('Please enter the Supplier Contact');
            return;
        }

        if (SuppAdd.trim() === '') {
            alert('Please enter the Supplier Address');
            return;
        }

        $.ajax({
            url: 'Supplier_process.php',
            type: 'POST',
            data: { reqType: rT, Suppnm: Suppnm, SuppContact: SuppContact, SuppAdd: SuppAdd },
            success: function (response) {
                if (response == 1) {
                    location.href = "Supplier.php";
                } else {
                    $("#res").html(response);
                }
            }
        });
    });



    // Supplier update code here
    $("#Supp_Upd").on("click", function () {
        rT = "SuppUpd";
        Suppnm = $("#supp_nm").val();
        SuppContact = $("#supp_contact").val();
        SuppAdd = $("#supp_Add").val();
        Sid = $("#Sid").val();
        console.log(Suppnm, SuppContact, SuppAdd);
        $.ajax({
            url: 'Supplier_process.php',
            type: 'POST',
            data: { reqType: rT, Sid: Sid, Suppnm: Suppnm, SuppContact: SuppContact, SuppAdd: SuppAdd },
            success: function (response) {
                if (response == 1) {
                    location.href = "Supplier.php";
                }
                else {
                    $("#res").html(response);
                }
            }
        });
    });



    // for Addmore Purchase && ----------------Append Feild
    var counter = 0;

    let selectedItems = [];

    // Disable the button if counter is 0
    function updateButtonStatus(counter) {
        if (counter < 1) {
            $("#saveButton").prop("disabled", true); // Disable the button
            $("#Errmsg").show();

        } else {
            $("#saveButton").prop("disabled", false); // Enable the button
            $("#Errmsg").hide();
        }
    }
    updateButtonStatus(counter);

    // if Any Items Are Select Then Disable 
    function disableSelectedItems() {
        $(".selectItem").each(function () {
            const selectedValue = $(this).val();

            if (selectedValue !== "0") {
                selectedItems.push(selectedValue);
                $(".selectItem").not(this).find(`option[value="${selectedValue}"]`).prop("disabled", true);
            }

        });
    }

    // Function to enable previously disabled items
    function enablePreviouslyDisabledItems() {
        selectedItems.forEach(function (selectedValue) {

            $(".selectItem").not(".selectItem:has(option[value='" + selectedValue + "']:not(:disabled))").find(`option[value="${selectedValue}"]`).prop("disabled", false);
        });
        // Clear the array after enabling
        selectedItems = [];
    }


    //Add button on click 
    $("#addf").click(function (e) {
        e.preventDefault();
        counter++;
        $.ajax({
            url: 'item_list.php',
            success: function (data) {
                $("#purchaseform").append('<tr class="ash' + counter + '"><td>' + data + '</td><td><input type="number" name="quantity[]" class="form-control quantity" placeholder="Quantity" required/></td><td><input type="number" name="rate[]" class="form-control rate " placeholder="Rate" required /></td><td><input type="number" name="total[]" class="form-control total" placeholder="Total" readonly/></td><td><button class="test btn btn-danger" id="' + counter + '">X</button></td></tr>');

                //enabled function 
                enablePreviouslyDisabledItems();
                //disabled Function
                disableSelectedItems();
                //counter

                updateButtonStatus(counter);
            }
        });

        //Remove Feild
        $("#purchaseform").on("click", "button.test", function () {
            var rowId = this.id;
            $(".ash" + rowId).remove();
            //Counter Decrease  Then button Disabled
            if (rowId === '1') {
                counter = 0;
                updateButtonStatus(counter);
            }




        });

        $(document).on('input', '.quantity, .rate', function () {
            var $row = $(this).closest('tr');
            var quantity = parseFloat($row.find('.quantity').val()) || 0;
            var rate = parseFloat($row.find('.rate').val()) || 0;
            var amount = quantity * rate;
            $row.find('.total').val(amount.toFixed(2));

        });

    });



    //save  Purchase Form Data
    $("#Purachase_form_data").submit(function (e) {
        e.preventDefault();

        // Get form field values
        const supplier_id = $("#suppList").val();
        const invoiceNo = $("#invoice_no").val();
        const invoiceDate = $("#Pdate").val();
        const receivingNo = $("#receiving_no").val();


        // Check if invoiceNo is blank
        if (invoiceNo.trim() === "") {
            alert("Please enter an invoice number.");
            return;
        }

        // Check if invoiceDate is blank or in an invalid format (you can add more validation if needed)
        if (invoiceDate.trim() === "") {
            alert("Please enter a valid invoice date.");
            return;
        }

        // Check if receivingNo is blank
        if (receivingNo.trim() === "") {
            alert("Please enter a receiving number.");
            return;
        }

        // Form data object
        const formData = {
            supplier_id: supplier_id,
            invoiceNo: invoiceNo,
            invoiceDate: invoiceDate,
            receivingNo: receivingNo,
            itemDetails: []
        };

        // Loop through table rows to get item details
        $("#purchaseform tr").each(function () {
            const itemsdtl = $(this).find(".selectItem").val().split('-');
            const item_id = itemsdtl[0];
            const quantity = $(this).find(".quantity").val();
            const rate = $(this).find(".rate").val();
            const amount = $(this).find(".total").val();

            const PurChase_item = {
                item_id: item_id,
                quantity: quantity,
                rate: rate,
                amount: amount
            };

            formData.itemDetails.push(PurChase_item);
        });

        // AJAX request to submit the form data
        $.ajax({
            url: 'purchase_process.php',
            type: 'POST',
            data: JSON.stringify(formData),
            contentType: 'application/json',
            success: function (response) {
                alert(response);
                location.href = "CurrentStock.php"
            },
            error: function (xhr, status, error) {
                console.error(error);
            }
        });
    });



    //  sale date JavaScript code to set the current date
    function currentDate() {
        const date = new Date().toISOString();
        const [year, month, day] = date.split('T')[0].split('-');
        let today = `${year}-${month}-${day}`;
        //input cuurent date this id       
        $('#currentDate').val(today);
        $('#start_date').val(today);
        $('#end_date').val(today);
        $('#Pdate').val(today);

    }
    //Call Current Date Function 
    currentDate();



    // jQuery code for handling dynamic content and showing item rate


    $(document).on('change', '.selectSaleItem', function () {
        let itemVal = this.value;
        let myArray = itemVal.split("-");
        $(this).closest('tr').find('.rate').val(myArray[2]);
        // console.log('ssssssssssss', myArray);
    });



    // For Sale Master Add More Feild Auto Calculation

    var saleCounter = 0;
    let selectedSaleItems = [];

    // if Any Items Are Select Then Sale Disable 
    function disableSelectedSaleItems() {
        // selectedSaleItems = [];
        $(".selectSaleItem").each(function () {
            const selectedValue = $(this).val();
            let itemName = selectedValue.split('-')[1]; // Get the itemName from the selected option value
            if (itemName !== "0") {
                selectedSaleItems.push(itemName);
                $(".selectSaleItem").not(this).find(`option[value*="${itemName}"]`).prop("disabled", true);
            }
        });
    }
    //enable Previous  Sale Item
    function enablePreviouslySelectedSaleItems() {
        selectedSaleItems.forEach(function (itemName) {
            $(".selectSaleItem").not(".selectSaleItem:has(option[value='" + itemName + "']:not(:disabled))").find(`option[value="${itemName}"]`).prop("disabled", false);
        });
    }


    // Sale Append Code
    $("#Sale_Add_feild").click(function (e) {
        e.preventDefault();
        saleCounter++;
        $.ajax({
            url: 'sale_item_list.php',
            success: function (data) {
                $("#Saleform").append('<tr class="ash' + saleCounter + '"><td>' + data + '</td><td><input type="number" name="quantity[]" class="form-control quantity" placeholder="Quantity" required/></td><td><input type="number" name="rate[]" class="form-control rate" placeholder="Rate" readonly/></td><td><input type="number" name="total[]" class="form-control total" placeholder="Total" readonly/></td><td><button class="test btn btn-danger" id="' + saleCounter + '">X</button></td></tr>');


                //Disbled  selected FUnction 
                disableSelectedSaleItems();
                //enable Previous Selected Function
                enablePreviouslySelectedSaleItems();
            }
        });

        // calculation Total Amount on this Feild 
        function calculateGrandTotal() {
            var grandTotal = 0;
            $(".total").each(function () {
                var amount = parseFloat($(this).val()) || 0;
                grandTotal += amount;
            });

            $("#totalAmount").val(grandTotal.toFixed(2));
        }

        $("#Saleform").on("click", "button.test", function () {
            var rowId = this.id;
            $(".ash" + rowId).remove();
            //SaleCounter Decrease  Then button Disabled
            if (rowId === '1') {
                saleCounter = 0;
                updateSaleButtonStatus(saleCounter);
            }
            // calculate Grand Total Function
            calculateGrandTotal();
        });

        $(document).on('input', '.quantity, .rate', function () {
            var $row = $(this).closest('tr');
            var quantity = parseFloat($row.find('.quantity').val()) || 0;
            var rate = parseFloat($row.find('.rate').val()) || 0;
            var amount = quantity * rate;
            $row.find('.total').val(amount.toFixed(2));
            calculateGrandTotal();
        });

        //send function increase value
        updateSaleButtonStatus(saleCounter);

    });


    // Disable the button if counter is 0 sale button
    function updateSaleButtonStatus(saleCounter) {
        if (saleCounter < 1) {
            $("#save_Sale_button").prop("disabled", true); // Disable the button
            $("#Err_btn_Sale").show();

        } else {
            $("#save_Sale_button").prop("disabled", false); // Enable the button
            $("#Err_btn_Sale").hide();
        }
    }
    // first value send are 0 this function 
    updateSaleButtonStatus(saleCounter);

    // Sale Data Submit Form 

    $("#Sale_item_data").submit(function (e) {
        e.preventDefault(); // Prevent default form submission behavior

        // Get form field values
        var customerName = $("#Customer_nm").val().trim();
        var contactNo = $("#Contact_no").val().trim();
        var billNo = $("#invoice_no").val().trim();
        var billDate = $("#currentDate").val().trim();

        // Check if customerName is blank
        if (customerName === "") {
            alert("Please enter a Customer Name.");
            return;
        }

        // Check if contactNo is blank
        if (contactNo === "") {
            alert("Please enter a Valid Contact Number.");
            return;
        }

        // Form data object
        var formData = {
            customerName: customerName,
            contactNo: contactNo,
            billNo: billNo,
            billDate: billDate,
            // Add more form data fields here as needed
        };

        // Get item details from the table
        var itemDetails = [];
        $("#Saleform tr").each(function () {
            //split data in id and rate 
            var itemsdtl = $(this).find(".selectItem").val().split(',');
            let item_id = itemsdtl[0];
            var quantity = $(this).find(".quantity").val();
            var rate = $(this).find(".rate").val();
            var amount = $(this).find(".total").val();

            var item = {
                item_id: item_id,
                quantity: quantity,
                rate: rate,
                amount: amount,
            };

            itemDetails.push(item);
        });

        formData.itemDetails = itemDetails;

        // Send form data to the server
        $.ajax({
            url: 'sale_process.php',
            type: 'POST',
            data: JSON.stringify(formData),
            contentType: 'application/json',
            success: function (response) {
                alert(response);
                location.href = "CurrentStock.php"
                // console.log(response);
            },
            error: function (xhr, status, error) {
                // Handle errors here (if needed)
                console.error(error);
            }
        });
    });



    //Seaarch Purchase Data

    $('#Search_purchase_Report').on('click', function () {
        // Get the start and end dates from the input fields
        let startDate = $('#start_date').val();
        let endDate = $('#end_date').val();

        // Convert the dates to the desired format (e.g., "dd/mm/yyyy")
        let formattedStartDate = formatDate(startDate);
        let formattedEndDate = formatDate(endDate);

        // Set the value of srch (assuming srch is the key to send dates to the server)
        var srch = {
            startDate: formattedStartDate,
            endDate: formattedEndDate
        };

        $.ajax({
            url: 'datewisePurchase_process.php',
            type: 'POST',
            data: srch, // Send the srch object as data
            success: function (response) {
                // console.log(response);
                $("#searchDateWisePurchase").html(response);
            }
        });
    });



    // Date Wise Sale Report    
    $('#Search_Sale_data').on('click', function () {
        // Get the start and end dates from the input fields
        let startDate = $('#start_date').val();
        let endDate = $('#end_date').val();

        // Convert the dates to the desired format (e.g., "dd/mm/yyyy")
        let formattedStartDate = formatDate(startDate);
        let formattedEndDate = formatDate(endDate);

        // Set the value of srch (assuming srch is the key to send dates to the server)
        var srch = {
            startDate: formattedStartDate,
            endDate: formattedEndDate
        };
        $.ajax({
            url: 'dateWiseSale_process.php',
            type: 'POST',
            data: srch, // Send the srch object as data
            success: function (response) {
                // console.log(response);
                $("#searchDateWiseResponse").html(response);
            }
        });
    });

    // Function to format the date in "yyyy/mm/dd" format
    function formatDate(dateString) {
        const dateObject = new Date(dateString);
        const day = dateObject.getDate().toString().padStart(2, '0');
        const month = (dateObject.getMonth() + 1).toString().padStart(2, '0');
        const year = dateObject.getFullYear();

        return `${year}/${month}/${day}`;
    }


    // Search item Name And item_id

    function SearchStockItem(srchItem) {
       
        $.ajax({
            url: 'currentStock_process.php',
            type: 'POST',
            data: { srchItem: srchItem },
            success: function (response) {
                $('#ShowStockReport').html(response);
                // console.log(response);
            }
        })
    }
    // call this function
    SearchStockItem();

    //search Data
    $('#Search_item').on('keyup', function () {
        let SearchItemName = this.value;
        SearchStockItem(this.value);
    })



});







