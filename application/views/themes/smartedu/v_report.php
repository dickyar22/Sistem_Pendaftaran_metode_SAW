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
        <form class="login-form form-horizontal cmxform" method="post" id="commentForm" action="{BASE_URL}report/export/report/pdf">
          <div class="card mb-0">
            <div class="card-body">
              <div class="text-center mb-3">
                <h4 class="mb-0">{APP_NAME}</h4>
                <span class="d-block text-muted">Report</span>
              </div>

              <?php
              echo '
              <div class="form-group">
                <label>No. Registrasi</label>
                <input type="text" class="form-control" name="id" id="id" value="'.$r['id_guru'].'" readonly>
              </div>
              <div class="form-group">
                <label>Nama</label>
                <input type="text" class="form-control" value="'.$r['nama_guru'].'" readonly>
              </div>
              <div class="form-group">
                <label>NUPTK</label>
                <input type="text" class="form-control" value="'.$r['nuptk'].'" readonly>
              </div>
              <div class="form-group">
                <label>TKQ</label>
                <input type="text" class="form-control" value="'.$r['nama_tkq'].'" readonly>
              </div>';
              ?>
              
              <br>
              <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block" name="btnPrint" value="print"> Print </button>
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