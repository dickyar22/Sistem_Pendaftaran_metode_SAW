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
                <input type="text" class="form-control" name="nama_lengkap" id="nama_lengkap" placeholder="Nama Peserta" required>
              </div>

              <div class="form-group">
                <select class="form-control select2" data-placeholder="Jenis Kelamin" name="jenkel" id="jenkel" required>
                  <option value="">Select ...</option>
                  <option value="Laki-laki" >Laki-laki</option>
                  <option value="Perempuan" >Perempuan</option>
                </select>
              </div>

              <div class="form-group">
                <input type="text" data-date-format="dd-mm-yyyy" class="form-control datepicker" name="tgl_lahir" id="tgl_lahir" placeholder="Tgl Lahir" required>
              </div>

              <div class="form-group">
                <select class="form-control select2" data-placeholder="Pendidikan Terakhir" name="pend_terakhir" id="pend_terakhir"  required>
                  <option value="">Select ...</option>
                  <option value="S3" >S3</option>
                  <option value="S2" >S2</option>
                  <option value="S1" >S1</option>
                  <option value="D3" >D3</option>
                  <option value="SMA/SMK" >SMA/SMK</option>
                  <option value="SMP" >SMP</option>
                  <option value="SD" >SD</option>
                </select>
              </div>

              <div class="form-group">
                <input type="text" class="form-control" name="pekerjaan" id="pekerjaan" maxlength="100" value="" placeholder="Pekerjaan" onkeypress="return string(event)" required>
              </div>

              <div class="form-group form-group-feedback form-group-feedback-left">
                <input type="text" class="form-control" name="username" id="username" placeholder="Username" onkeypress="return string(event)" required>
                <div class="form-control-feedback">
                  <i class="icon-user text-muted"></i>
                </div>
              </div>

              <div class="form-group form-group-feedback form-group-feedback-left">
                <input type="password" class="form-control" name="password" id="password" placeholder="Password" onkeypress="return string(event)" required>
                <div class="form-control-feedback">
                  <i class="icon-lock2 text-muted"></i>
                </div>
              </div>

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