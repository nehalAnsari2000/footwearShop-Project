<!-- Include Header -->
<?php  include('header.php') ?>
<!-- Include header closed -->

    <!-- Main Content -->
    <div class="row container-fluid mt-3">
      <div class="col-sm-3"></div>
      <div class="col-sm-6 border border-secondary border-1 rounded">
      <div>
      <h2 class="text-center fw-bold pt-4 pb-4 text-secondary" style="font-family: 'Ubuntu', sans-serif;">Admin Signin</h2>
    </div>
    <form id="admin_signin">
                  <div class="form-group mt-4">
                    <i class="fas fa-envelope"></i>
                    <label for="adminemail" class="pl-2 fw-bold">Admin Email</label><small id=""></small>
                    <input type="email" class="form-control" id="admin_email" aria-describedby="emailHelp" name="admin_email" placeholder="Admin Email" required>
                  </div>
                  <div class="form-group mt-3">
                    <i class="fas fa-key"></i>
                    <label for="password"  class="pl-2 fw-bold">Admin Password</label><small id=""></small>
                    <input type="password" class="form-control" name="admin_pass" id="admin_pass" placeholder="Admin Password" required>
                  </div>
                  <div class="modal-footer mt-2">
                    <small id="adminMsg"></small>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="clearAdminSigninForm()">Close</button>
                    <button type="button" class="btn btn-primary" id="admin_signin" onclick="adminSignin()">Signin</button>
                  </div>
                </form>

      </div>
      <div class="col-sm-3"></div>
       
    </div>
        <!-- Main Content Close -->

    
<?php include('footer.php')?>