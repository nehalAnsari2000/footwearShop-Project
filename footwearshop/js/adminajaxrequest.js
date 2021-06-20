$(document).ready(function(){
  //Ajax call for checking email alredy exist or not verification creating customer
  $('#cust_email_admin').on('keypress blur', function(){
    console.log("Press");
    var reg = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
    var cust_email = $('#cust_email_admin').val();
    $.ajax({
      url: './admin_ajax_response.php',
      method: "POST",
      dataType: "json",
      data:{
        checkmail: "checkmail",
        cust_email: cust_email
      } ,
      success: function(data){
        if(data != 0){
          $('#emailMsgAdmin').html('<small class="text-danger">  Email already used !</small>');      
          $('#cust_btn').attr("disabled", true);
        }else if(data == 0 && reg.test(cust_email)){
          $('#emailMsgAdmin').html('<small class="text-success">  There you go !</small>');      
          $('#cust_btn').attr("disabled", false);
        }else if(!reg.test(cust_email)){
          $('#emailMsgAdmin').html('<small class="text-danger">  Please enter valid email e.g example@gmail.com !</small>');
          $('#cust_btn').attr("disabled", true);
        }
      }
    });
  });

  // Checking length of password as 6
  $('#cust_password').on('keypress blur', function(){
    var cust_password = $('#cust_password').val();
    var len = cust_password.length; 
    if(len < 5){
      $('#passwordMsgAdmin').html("<small class='text-danger'>  Length must contain atleast 6 characters !<small>");
      $('#cust_btn').attr("disabled", true);
    }
    else{
      $('#passwordMsgAdmin').html("<small class='text-success'>  There you go !<small>");
      $('#cust_btn').attr("disabled", false);
    }       
  });

  // Checking length of phone as 10
  $('#cust_phone').on('keypress blur', function(){
    var cust_phone = $('#cust_phone').val();
    var len = cust_phone.length; 
    if(len < 9){
      $('#phoneMsgAdmin').html("<small class='text-danger'>  Phone must contain atleast 10 digits !<small>");
      $('#cust_btn').attr("disabled", true);
    }
    else{
      $('#phoneMsgAdmin').html("<small class='text-success'>  There you go !<small>");
      $('#cust_btn').attr("disabled", false);
    }       
  });
//---------------------------------------------------------------------------------------------


  //--------------------------------------------------------------------------------------
  //Ajax call for checking email alredy exist or not for creating admin verification 
  $('#create_admin_email').on('keypress blur', function(){
    var reg = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
    var create_admin_email = $('#create_admin_email').val();
    $.ajax({
      url: 'admin_ajax_response.php', 
      method: "POST",
      dataType: "json",
      data:{
        checkmail: "checkmail",
        create_admin_email: create_admin_email
      } ,
      success: function(data){
        if(data != 0){
          $('#create_admin_email_msg').html('<small class="text-danger">  Email already used !</small>');      
          $('#create_admin_btn').attr("disabled", true);
        }else if(data == 0 && reg.test(create_admin_email)){
          $('#create_admin_email_msg').html('<small class="text-success">  There you go !</small>');      
          $('#create_admin_btn').attr("disabled", false);
        }else if(!reg.test(create_admin_email)){
          $('#create_admin_email_msg').html('<small class="text-danger">  Please enter valid email e.g example@gmail.com !</small>');
          $('#create_admin_btn').attr("disabled", true);
        }
      }
    });
  });

  // Checking length of password as 6
  $('#create_admin_password').on('keypress blur', function(){
    var create_admin_password = $('#create_admin_password').val();
    var len = create_admin_password.length; 
    if(len < 5){
      $('#create_admin_password_msg').html("<small class='text-danger'>  Length must contain atleast 6 characters !<small>");
      $('#create_admin_btn').attr("disabled", true);
    }
    else{
      $('#create_admin_password_msg').html("<small class='text-success'>  There you go !<small>");
      $('#create_admin_btn').attr("disabled", false);
    }       
  });

  // Checking length of phone as 10
  $('#create_admin_phone').on('keypress blur', function(){
    var create_admin_phone = $('#create_admin_phone').val();
    var len = create_admin_phone.length; 
    if(len < 9){
      $('#create_admin_phone_msg').html("<small class='text-danger'>  Phone must contain atleast 10 digits !<small>");
      $('#create_admin_btn').attr("disabled", true);
    }
    else{
      $('#create_admin_phone_msg').html("<small class='text-success'>  There you go !<small>");
      $('#create_admin_btn').attr("disabled", false);
    }       
  });


  // Checking for -ve price of item while addding item
  $('#item_price').on('blur', function(){
    var price = $('#item_price').val();
    if(price<1){
      $('#item_price_msg').html("<small class='text-danger'>Price Can't be negative or zero</small>");
      $('#AddItemBtn').attr("disabled", true);
    }else{
      $('#item_price_msg').html(" ");
      $('#AddItemBtn').attr("disabled", false);
    }
  });

  // Checking for -ve selling price price of item while addding item
  $('#item_s_price').on('blur', function(){
    var s_price = $('#item_s_price').val();
    if(s_price<1){
      $('#item_s_price_msg').html("<small class='text-danger'>Price Can't be negative or zero</small>");
      $('#AddItemBtn').attr("disabled", true);
    }else{
      $('#item_s_price_msg').html(" ");
      $('#AddItemBtn').attr("disabled", false);
    }
  });

  // Checking for quantity more than 1
  $('#item_quantity').on('blur', function(){
    var qty = $('#item_quantity').val();
    if(qty<2){
      $('#item_qty_msg').html("<small class='text-danger'>Quantity must be more than 1</small>");
      $('#AddItemBtn').attr("disabled", true);
    }else{
      $('#item_qty_msg').html(" ");
      $('#AddItemBtn').attr("disabled", false);
    }
  });

});
//-----------------------------------------------------------------------------------------

// Admin SignIn function starts here-------------------------------------------------------
function adminSignin(){
  var admin_email = $('#admin_email').val();
  var admin_pass = $('#admin_pass').val();
  $.ajax({
    url: 'Admin/admin.php',
    method: 'POST',
    dataType : "json",
    data: {
      admin_signin: "admin_signin",
      admin_email: admin_email,
      admin_pass: admin_pass
    },
    success: function(data){
      if(data == 0){
        $('#adminMsg').html("<small class='alert alert-danger'>Invalid Email ID or Password !</small>");
      }else if(data == 1){
        $('#adminMsg').html("<div class='spinner-border text-success' role='status'></div>");
        setTimeout(()=>{
          window.location.href = 'Admin/adminindex.php';
        },1000);
      }
    }
  });
}
// Admin SignIn function ends here--------------------------------------------------------------

// Functions for clearing forms--------------------------------------------------------------
  // Clear Admin signin form while pressing cancel
  function clearAdminSigninForm(){
    $('#admin_signin').trigger('reset');
    $('#adminMsg').html(" ");
  }

    // Clear creat admin Admin form while pressing cancel
    function clearCreateAdminForm(){
      $('#create_admin_form').trigger('reset');
      $('#create_admin_msg').html(" ");
      $('#create_admin_email_msg').html(" ");
      $('#create_admin_password_msg').html(" ");
      $('#create_admin_phone_msg').html(" ");
    }

    // Clear create customer form while pressing cancel
    function clearCreateCustomerFormWhileCancle(){
      $('#createCustomerForm').trigger('reset');
      $('#createCustomerMsg').html(" ");
      $('#emailMsgAdmin').html(" ");
      $('#passwordMsgAdmin').html(" ");
      $('#phoneMsgAdmin').html(" ");
    }

    // clear add item form while pressing cancel
    function clearAddItemFormWhileCancel(){
      $('#add_item_form').trigger('reset');
      $('#item_msg').html(" ");
      $('#item_price_msg').html(" ");
      $('#item_s_price_msg').html(" ");
      $('#item_qty_msg').html(" ");
    }