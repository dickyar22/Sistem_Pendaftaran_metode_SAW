<!DOCTYPE html>
<html lang="en">
  <head>
  <?php 
    $this->load->view("themes/v_title");
    $this->load->view("themes/$THEMES/v_head"); 
    $this->load->view("themes/assets/v_head",$ASSETS);
  ?>
  </head>
  <body>
  {MESSAGE}
  <!-- Page content -->
  <div class="page-content">
    <!-- Main content -->
    <div class="content-wrapper">
      <!-- Content area -->
			<div class="content d-flex justify-content-center align-items-center">
        <!-- Login form -->
        <form class="login-form form-horizontal cmxform" method="post" id="commentForm" action="{BASE_URL}pages/content/user/action/add">
          <div class="card mb-0">
            <div class="card-body">
              <div class="text-center mb-3">
                <h4 class="mb-0">{APP_NAME}</h4>
                <span class="d-block text-muted">Account Register</span>
              </div>
              
              <div class="form-group">
                <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama" onkeypress="return string(event)" required>
              </div>

              <div class="form-group">
                <input type="text" class="form-control" name="nuptk" id="nuptk" maxlength="30" value="" placeholder="NUPTK" onkeypress="return string(event)" required>
              </div>

              <div class="form-group">
                <input type="text" class="form-control" name="nama_tkq" id="nama_tkq" placeholder="Nama TKQ" onkeypress="return string(event)" required>
              </div>

              <div class="form-group form-group-feedback form-group-feedback-left">
                <input type="text" class="form-control" name="username" id="username" placeholder="Username" onkeypress="return string(event)" onkeyup="unique('user/unique',this.id,this.value)" required>
                <div class="form-control-feedback">
                  <i class="icon-user text-muted"></i>
                </div>
                <span id="username_message" style="color: #A00;"><span>
              </div>

              <div class="form-group form-group-feedback form-group-feedback-left">
                <input type="password" class="form-control" name="password" id="password" placeholder="Password" onkeypress="return string(event)" required>
                <div class="form-control-feedback">
                  <i class="icon-lock2 text-muted"></i>
                </div>
              </div>

              <?php
              if(in_array('g-recaptcha',$ASSETS)){
              ?>
                <div class="g-recaptcha" data-sitekey="6Lf7WCUTAAAAANJ2ZMQ1Xvum9wXMo_6tGcl_rYej" style="transform: scale(0.9); transform-origin: 0 0;"></div>
              <?php
              }
              ?>
              
              <br>
              <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block" name="btnLogin" value="login"> Submit </button>
              </div>
            </div>
          </div>
        </form>
        <!-- /login form -->
      </div>
      <!-- /content area -->
    </div>
    <!-- /main content -->
  </div>
  <!-- /page content -->
  <?php 
    $this->load->view("themes/$THEMES/v_js"); 
    $this->load->view("themes/assets/v_js",$ASSETS);
  ?>
  </body>
</html>