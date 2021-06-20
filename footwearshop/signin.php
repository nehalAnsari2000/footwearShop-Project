<!-- Include Header -->
<?php  include('header.php') ?>
<!-- Include header closed -->

    <!-- Main Content -->
    <div class="row container-fluid mt-3">
      <div class="col-sm-3"></div>
      <div class="col-sm-6 border border-secondary border-1 rounded">
      <div>
      <h2 class="text-center fw-bold pt-4 pb-4 text-secondary" style="font-family: 'Ubuntu', sans-serif;">Signin</h2>
    </div>
      <form id="signinform">
                  <div class="form-group mt-4">
                    <i class="fas fa-envelope"></i>
                    <label for="custmail" class="pl-2 fw-bold">Email</label><small id=""></small>
                    <input type="email" name="cust_email_signin" id="cust_email_signin" class="form-control" aria-describedby="emailHelp" placeholder="Email" required>
                  </div>
                  <div class="form-group mt-3">
                    <i class="fas fa-key"></i>
                    <label for="password"  class="pl-2 fw-bold">Password</label><small id=""></small>
                    <input type="password" class="form-control" name="cust_pass_signin" id="cust_pass_signin" placeholder="Password" required>
                  </div>
                  <div class="modal-footer mt-2">
                    <small class="ml-3" id="signinMsg"></small>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="clearSigninForm()">Close</button>
                    <button type="button" onclick="singinCustomer()" class="btn btn-primary">Signin</button>
                  </div>
                </form>
      </div>
      <div class="col-sm-3"></div>
       
    </div>
    <!-- Main Content Close -->

    
<?php include('footer.php')?>