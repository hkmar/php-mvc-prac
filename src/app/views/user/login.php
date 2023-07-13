<div class="container">
  <div class="row">
    <div class="col-md-6 mx-auto">
      <div class="card card-body bg-grey mt-5">
        <?php flash_msg('register_success') ?>
        <h2>Login to your Account</h2>
        <p>Welcome back. Login to your account</p>
        <form action="<?php echo URLROOT; ?>/user/login" method="post">
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
          <div class="row">
            <div class="col">
              <input type="submit" value="Login" class="btn btn-success btn-block">
            </div>
            <div class="col">
              <a href="<?php echo URLROOT ?>/user/register" class="btn btn-light btn-block">Don't
                Have an account?</a>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>