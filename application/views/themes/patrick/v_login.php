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
        <form class="login-form form-horizontal cmxform" method="post" id="commentForm" action="{BASE_URL}pages/login">
          <div class="card mb-0">
            <i class="border-slate-300 border-3 p-3 mb-3 mt-1">
            <img src="{BASE_URL}img/logo.png" class="card-img-top" alt="Image" width="150px" height="250px">
            </i>
            <div class="card-body">
              <div class="text-center mb-3">
                <h4 class="mb-0">{APP_NAME}</h4>
                <span class="d-block text-muted">Enter your credentials below</span>
              </div>

              <div class="form-group form-group-feedback form-group-feedback-left">
                <input type="text" class="form-control" name="user" id="user" placeholder="Username" required>
                <div class="form-control-feedback">
                  <i class="icon-user text-muted"></i>
                </div>
              </div>

              <div class="form-group form-group-feedback form-group-feedback-left">
                <input type="password" class="form-control" name="pass" id="pass" placeholder="Password" required>
                <div class="form-control-feedback">
                  <i class="icon-lock2 text-muted"></i>
                </div>
              </div>

              <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block" name="btnLogin" value="login"> Login <i class="icon-circle-right2 ml-2"></i></button>
                <!-- <a href="{BASE_URL}pages/register" class="btn btn-success btn-block"> Register <i class="icon-circle-right2 ml-2"></i></a> -->
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