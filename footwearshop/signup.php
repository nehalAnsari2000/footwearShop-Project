<!-- Include Header -->
<?php  include('header.php') ?>
<!-- Include header closed -->

    <!-- Main Content -->
    <div class="row container-fluid mt-3">
      <div class="col-sm-3"></div>
      <div class="col-sm-6 border border-secondary border-1 rounded">
      <div>
      <h2 class="text-center fw-bold pt-4 pb-4 text-secondary" style="font-family: 'Ubuntu', sans-serif;">Signup</h2>
    </div>
    <form id="signupform">
                  <div class="form-group">
                    <i class="fas fa-user"></i> <label for="custname" class="pl-2 fw-bold"> Name</label><small id="nameMsg"></small><input type="text" class="form-control" placeholder="Name" name="cust_name" id="cust_name" required>
                  </div>
                  <div class="form-group mt-4">
                  <i class="fas fa-map-marker-alt"></i> <label for="custaddress" class="pl-2 fw-bold"> Shop Address</label><small id="addressMsg"></small><input type="text" class="form-control" placeholder="Shop Address" name="cust_address" id="cust_address" required>
                  </div>
                  <div class="form-group mt-4">
                    <i class="fas fa-envelope"></i>
                    <label for="custmail" class="pl-2 fw-bold">Email</label><small id="emailMsg"></small>
                    <input type="email" class="form-control" name="cust_email" id="cust_email" aria-describedby="emailHelp" placeholder="Email" required>
                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                  </div>
                  <div class="form-group mt-3">
                    <i class="fas fa-key"></i>
                    <label for="password"  class="pl-2 fw-bold">Password</label><small id="passwordMsg"></small>
                    <input type="password" class="form-control" name="cust_pass" id="cust_pass" placeholder="Password ( Atleast 6 character)" required>
                  </div>
                  <div class="modal-footer">
                    <span id="successMsg"></span>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="clearSignupFormWhileCancle()">Close</button>
                    <button type="button" id="signup" class="btn btn-primary" onclick="addCustomer()">Signup</button>
                  </div>   
                </form>
      </div>
      <div class="col-sm-3"></div>
       
    </div>
        <!-- Main Content Close -->
<?php include('footer.php')?>