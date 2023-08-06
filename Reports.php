<?php include('inc/session1.php'); ?>
<?php include('inc/Connection.php') ?>
<?php include('inc/header.php'); ?>
<?php include('inc/menubar.php'); ?>





<?php include('inc/footer.php'); ?>

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
$("#sadd").on("click", function () {
    rT = "stockAdd";
    item_nm = $("#proNm").val();
    item_code = $("#proCd").val();

    $.ajax({
        url: 'stock_process.php',
        type: 'POST',
        data: { reqType: rT, item_nm: item_nm, item_code: item_code },
        success: function (response) {
            if (response == 1) {
                location.href = "stock.php";
            }
            else {
                $("#res").html(response);
            }
        }
    });
});

// stock update code here
$("#stupd").on("click", function () {
    rT = "stockUpd";
    item_code = $("#item_code").val();
    pId = $("#pId").val();
    $.ajax({
        url: 'stock_process.php',
        type: 'POST',
        data: { reqType: rT, item_cd: item_code, pId: pId },

        success: function (response) {
            if (response == 1) {
                location.href = "stock.php";
            }
            else {
                $("#res").html(response);
            }
        }
    });
});


// Supplier add code here
$("#Supp_Add").on("click", function () {
    rT = "SuppAdd";
    Suppnm = $("#supp_nm").val();
    SuppContact = $("#supp_contact").val();
    SuppAdd = $("#supp_Add").val();
    $.ajax({
        url: 'Supplier_process.php',
        type: 'POST',
        data: { reqType: rT, Suppnm: Suppnm, SuppContact: SuppContact, SuppAdd: SuppAdd },
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


// Supplier update code here
$("#Supp_Upd").on("click", function () {
    rT = "SuppUpd";
    Suppnm = $("#supp_nm").val();
    SuppContact = $("#supp_contact").val();
    SuppAdd = $("#supp_Add").val();
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



// for Addmore Purchase

$('#addf').click(function (e) {
    e.preventDefault();
    var html = $('#item_data').clone(); // Clone the row
    html.removeAttr('id'); // Remove the "id" attribute to avoid duplicate IDs
    $('#form').append(html); // Append the cloned row to the table body

    // Reset the input values in the cloned row
    html.find('input').val('');
    html.find('select').val('0'); // Assuming '0' is the value of the default "Select Item" option

    // Calculate amount when quantity or rate change
    $(document).on('input', '.quantity, .rate', function () {
        var $row = $(this).closest('tr');
        var quantity = parseFloat($row.find('.quantity').val()) || 0;
        var rate = parseFloat($row.find('.rate').val()) || 0;
        var amount = quantity * rate;
        $row.find('.total').val(amount.toFixed(2));
    });

    // Remove row when remove button is clicked
    $(document).on('click', '.remove', function () {
        // Check the number of rows in the table body
        var rowCount = $('#form tr').length;
        console.log($('#form tr').length);
        // If there's only one row, don't remove it
        if (rowCount < 1) {
            alert("Cannot remove the last row.");
        } else {
            $(this).closest('tr').remove();
        }
    });

});


// Function to save the data when the "Save" button is clicked
// $("#Save_Purchase_item").click(function () {
//     // Get the values from the form
//     var supplierName = $("#suppList").val();
//     var invoiceNo = $("#invoice_no").val();
//     var invoiceDate = $("input[type='date']").val();
//     var receivingNo = $("#receiving_no").val();
//     var itemNames = [];
//     var quantities = [];
//     var rates = [];
//     var amounts = [];

//     $("select[name='itemName[]']").each(function () {
//         itemNames.push($(this).val());
//     });

//     $("input[name='quantity[]']").each(function () {
//         quantities.push($(this).val());
//     });

//     $("input[name='rate[]']").each(function () {
//         rates.push($(this).val());
//     });

//     $("input[name='total[]']").each(function () {
//         amounts.push($(this).val());
//     });

//     // Create a data object to send to the server
//     var data = {
//         supplierName: supplierName,
//         invoiceNo: invoiceNo,
//         invoiceDate: invoiceDate,
//         receivingNo: receivingNo,
//         itemNames: itemNames,
//         quantities: quantities,
//         rates: rates,
//         amounts: amounts
//     };
//     console.log(data);
//     // Send the data to the server using AJAX
//     $.ajax({
//         url: "purchase_process.php", // Replace "save_data.php" with the server-side script to handle the data
//         method: "POST",
//         data: data,
//         success: function (response) {
//             // Handle the server response if needed
//             console.log("Response from server:", response);
//             // alert("Data saved successfully!");
//             // You can redirect or perform other actions upon successful save.
//         },
//         error: function (xhr, status, error) {
//             // Handle errors if any
//             alert("Error saving data: " + error);
//         }
//     });
// });


 // form submit
 $("#Purachase_form_data").submit(function(e) {
    e.preventDefault();
    var formData = new FormData(this);
    $.ajax({
      url: "purchase_process.php",
      method: "POST",
      data: formData,
      processData: false,
      contentType: false,
      success: function(data) {
       console.log(data);
        
      }
    });
  });

//  sale date JavaScript code to set the current date
// var today = new Date().toISOString().slice(0, 10);
// document.getElementById("currentDate").value = today;


// For Sale Master Add More Feild AutoCalculation
$('#Sale_Add_feild').click(function () {
    var Salehtml = `
    <tr>
      <td>
        <select class="selectItem form-control" name="itemName[]">
          <option value="0">Please Select</option>
          <option value="a">a</option>
          <option value="b">b</option>
        </select>
      </td>     
      <td><input type="number" name="quantity[]" class="form-control quantity" placeholder="Quantity"></td>
      <td><input type="number" name="rate[]" class="form-control rate" placeholder="Rate"></td>
      <td><input type="number" name="total[]" class="form-control total" placeholder="Total" readonly></td>
      <td><button class="btn btn-danger remove">X</button></td>
      </tr>
  `;
    $('#Saleform').append(Salehtml);
});

// Calculate amount when quantity or rate change
$(document).on('input', '.quantity, .rate', function () {
    var $row = $(this).closest('tr');
    var quantity = parseFloat($row.find('.quantity').val()) || 0;
    var rate = parseFloat($row.find('.rate').val()) || 0;
    var amount = quantity * rate;
    $row.find('.total').val(amount.toFixed(2));
});

// Remove row when remove button is clicked
$(document).on('click', '.remove', function () {
    $(this).closest('tr').remove();
});


})




