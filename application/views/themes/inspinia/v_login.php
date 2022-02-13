<!DOCTYPE html>
<html lang="en">
  <head>
  <?php 
    $this->load->view("themes/v_title");
    $this->load->view("themes/$THEMES/v_head"); 
    $this->load->view("themes/assets/v_head",$ASSETS);
  ?>
  </head>
  <body class="">
    {MESSAGE}
    <div class="middle-box text-center loginscreen animated fadeInDown">
      <div>
          <h1 class="logo-name">
            <center><img src="{BASE_URL}img/logo2.png" alt="Logo" width="250px" height="80px"></center>
          </h1>
          <!-- <h3 class="text-white">{APP_NAME}</h3> <br> -->
          <form class="form-horizontal m-t-40 cmxform tasi-form" method="post" action="" id="commentForm" novalidate="novalidate" action="{BASE_URL}pages/login">               
            <div class="form-group">
                <div class="col-xs-12">
                  <input class="form-control" type="text" name="user" id="user" placeholder="Username / Email" required="">
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-12">
                  <input class="form-control" type="password" name="pass" id="pass" placeholder="Password" required="">
                </div>
            </div>
            <!-- <div class="form-group">
                <div class="col-xs-12">
                  <label>Captcha</label>
                  <img src="{BASE_URL}themes/assets/captcha/generate-captcha.php" alt="Captcha Image" id="captcha-image">
                  <img src="{BASE_URL}themes/assets/captcha/img/refresh.png" alt="Refresh Captcha" title="Refresh Captcha" id="refresh-captcha">
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-12">
                  <input class="form-control" type="text" name="captcha" id="captcha" required>
                </div>
            </div> -->
            
            <div class="form-group" align="center">
                <div class="col-xs-12">
                  <button class="btn btn-primary w-md" type="submit" name="btnLogin" value="login">Login</button>
                </div>
            </div>
        </form>
      </div>
    </div>
    <?php 
      $this->load->view("themes/$THEMES/v_js"); 
      $this->load->view("themes/assets/v_js",$ASSETS); 
    ?>
  </body>
</html>