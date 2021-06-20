$(document).ready(function(){
  //Ajax call for checking email alredy exist or not verification 
  $('#cust_email').on('keypress blur', function(){
    var reg = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
    var cust_email = $('#cust_email').val();
    $.ajax({
      url: 'Customer/signup_customer.php',
      method: "POST",
      dataType: "json",
      data:{
        checkmail: "checkmail",
        cust_email: cust_email
      } ,
      success: function(data){
        if(data != 0){
          $('#emailMsg').html('<small class="text-danger">  Email already used !</small>');      
          $('#signup').attr("disabled", true);
        }else if(data == 0 && reg.test(cust_email)){
          $('#emailMsg').html('<small class="text-success">  There you go !</small>');      
          $('#signup').attr("disabled", false);
        }else if(!reg.test(cust_email)){
          $('#emailMsg').html('<small class="text-danger">  Please enter valid email e.g example@gmail.com !</small>');
          $('#signup').attr("disabled", true);
        }
      }
    });
  });

  // Checking length of password as 6
  $('#cust_pass').on('keypress blur', function(){
    var cust_pass = $('#cust_pass').val();
    var len = cust_pass.length; 
    if(len < 5){
      $('#passwordMsg').html("<small class='text-danger'>  Length must contain atleast 6 characters !<small>");
      $('#signup').attr("disabled", true);
    }
    else{
      $('#passwordMsg').html("<small class='text-success'>  There you go !<small>");
      $('#signup').attr("disabled", false);
    }       
  });
  
  // checking for how many pairs entered by customer
  $('#qty_entered').on('blur',function(){
    var qty_entered = parseInt($('#qty_entered').val());
    var qty_avl = parseInt($('#qty_avl').val());
  
    if(qty_entered < 2){
      $('#qtyMsg').html("<small class='text-danger'>  Select More Than 1 Pair...!<small>");
      $('#addcart').attr("disabled", true);
    }else if(qty_entered <= qty_avl){
      $('#qtyMsg').html("<small class='text-success'>  There You Go... <small>");
      $('#addcart').attr("disabled", false);
    }else{
      $('#qtyMsg').html("<small class='text-danger'>  Sorry, Exceeding Pair Limit...! <small>");
      $('#addcart').attr("disabled", true);
    }
  });

  // checking for positive rating
  $('#item_rating').on('blur',function(){
    var item_rating = parseInt($('#item_rating').val());  
    if(item_rating < 1){
      $('#ratingMsg').html("<small class='text-danger'>  Rating can't be less than 1 ...!<small>");
      $('#review_btn').attr("disabled", true);
    }else{
      $('#ratingMsg').html("<small class='text-success'>  There You Go... <small>");
      $('#review_btn').attr("disabled", false);
    }
  });
  
  

});

 

// Function for login customer starts here
function singinCustomer(){
  var cust_email_signin = $('#cust_email_signin').val();
  var cust_pass_signin = $('#cust_pass_signin').val();
  $.ajax({
    url: 'customer/signup_customer.php',
    method: 'POST',
    dataType : "json",
    data: {
      cust_signin: "cust_signin",
      cust_email_signin: cust_email_signin,
      cust_pass_signin: cust_pass_signin
    },
    success: function(data){
      if(data == 0){
        $('#signinMsg').html("<small class='alert alert-danger'>Invalid Email ID or Password !</small>");
      }else if(data == 1){
        $('#signinMsg').html("<div class='spinner-border text-success' role='status'></div>");
        setTimeout(()=>{
          window.location.href = 'index.php';
        },1000);
      }
    }
  });
}
// Function for login customer ends here


// Function when signup button get clicked starts here
function addCustomer(){
  var reg = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
  var cust_name = $("#cust_name").val();
  var cust_address = $("#cust_address").val();
  var cust_email = $("#cust_email").val();
  var cust_pass = $("#cust_pass").val();

  // Checking form fields while signing up
  if(cust_name.trim() == ""){
    $('#nameMsg').html('<small class="text-danger">  Please enter name !</small>');
    $('#cust_name').focus();
    return false;
  }else if(cust_address.trim() == ""){
    $('#addressMsg').html('<small class="text-danger">  Please enter address !</small>');
    $('#cust_address').focus();
    return false;
  }else if(cust_email.trim() == ""){
    $('#emailMsg').html('<small class="text-danger">  Please enter email !</small>');
    $('#cust_email').focus();
    return false;
  }else if(cust_email.trim() != "" && !reg.test(cust_email)){
    $('#emailMsg').html('<small class="text-danger">  Please enter valid email e.g example@gmail.com !</small>');
    $('#cust_email').focus();
    return false;
  }else if(cust_pass.trim() == ""){
    $('#passwordMsg').html('<small class="text-danger">  Please enter password !</small>');
    $('#cust_pass').focus();
    return false;
  }else{
    $.ajax({
      url: 'customer/signup_customer.php',
      method: 'POST',
      dataType : "json",
      data: {
        cust_signup : "cust_signup",
        cust_name : cust_name,
        cust_address : cust_address,
        cust_email : cust_email,
        cust_pass : cust_pass  
      },
      success : function(data){
        if(data == "OK"){
          $('#successMsg').html('<span class="alert alert-success">Registration successful ! </span>');
          clearSignupForm();
        }  
        else if(data  == "Failed"){
          $('#successMsg').html('<span class="alert alert-danger">Registration Failed ! </span>');
        }
      }
    });
  }  
} 
// Function when signup button get clicked ends here



// Functions for  Clear/Empty all form fileds after submission starts here
function clearSignupForm(){
  $('#signupform').trigger('reset');
  $('#nameMsg').html(" "); 
  $('#emailMsg').html(" ");
  $('#addressMsg').html(" ");
  $('#passwordMsg').html(" ");
}

  //Clear signup form while pressing cancel
function clearSignupFormWhileCancle(){
  $('#signupform').trigger('reset');
  $('#nameMsg').html(" ");
  $('#emailMsg').html(" ");
  $('#addressMsg').html(" ");
  $('#passwordMsg').html(" ");
  $('#successMsg').html(" ");
}

  //Clear signin form while pressing cancle
function clearSigninForm(){
  $('#signinform').trigger('reset');
  $('#signinMsg').html(" ");
}
// Clear/Empty all form fileds after submission Ends here