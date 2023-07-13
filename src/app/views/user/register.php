<div class="container">
  <div class="row">
    <div class="col-md-6 mx-auto">
      <div class="card card-body bg-grey mt-5">
        <h2>Create Account</h2>
        <p>Please register to use PostZilla</p>
        <form action="<?php echo URLROOT; ?>/user/register" method="post">
          <div class="form-group">
            <label for="name">Name<sup>*</sup></label>
            <input type="text"
              class="form-control form-control-lg 
            <?php echo (!empty($data['name_error'])) ? "is-invalid" : "" ?>"
              name="name" value="<?php echo $data['name'] ?>">
            <span class="invalid-feedback">
              <?php echo $data['name_error'] ?>
            </span>
          </div>
          <div class="form-group">
            <label for="email">E-Mail<sup>*</sup></label>
            <input type="email"
              class="form-control form-control-lg 
            <?php echo (!empty($data['email_error'])) ? "is-invalid" : "" ?>"
              name="email" value="<?php echo $data['email'] ?>">
            <span class="invalid-feedback">
              <?php echo $data['email_error'] ?>
            </span>
          </div>
          <div class="form-group">
            <label for="name">Password<sup>*</sup></label>
            <input type="password"
              class="form-control form-control-lg 
            <?php echo (!empty($data['password_error'])) ? "is-invalid" : "" ?>"
              name="password" value="<?php echo $data['password'] ?>">
            <span class="invalid-feedback">
              <?php echo $data['password_error'] ?>
            </span>
          </div>
          <div class="form-group">
            <label for="confirm_password">Confirm Password<sup>*</sup></label>
            <input type="Password"
              class="form-control form-control-lg 
            <?php echo (!empty($data['confirm_password_error'])) ? "is-invalid" : "" ?>"
              name="confirm_password"
              value="<?php echo $data['confirm_password'] ?>">
            <span class="invalid-feedback">
              <?php echo $data['confirm_password_error'] ?>
            </span>
          </div>
          <div class="row">
            <div class="col mr-auto">
              <input type="submit" value="Register" class="btn btn-success btn-block">
            </div>
            <div class="col">
              <a href="<?php echo URLROOT ?>/user/login" class="btn btn-light btn-block">Have an
                account?</a>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>