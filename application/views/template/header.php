<!-- HEADER HALAMAN TEMPLATE -->
  <header class="main-header">

	<!-- LOGO SEBELAH KIRI -->
    <a href="#" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>SI</b>-MOLEK</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>SI</b>-MOLEK</span>
    </a>
	<!-- AKHIR LOGO SEBELAH KIRI -->

	<!-- TOMBOL TOOGLE GARIS 3 SEBELAH KIRI UNTUK MINIMIZE MENU -->
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
	<!-- AKHIR TOMBOL TOOGLE GARIS 3 SEBELAH KIRI UNTUK MINIMIZE MENU -->

	<!-- MENU DROPDOWN SEBELAH KANAN -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">

          <!-- GAMBAR USER User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu ">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo base_url();?>assets/dist/img/logo-pemko.jpg" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php
			  if (!$this->ion_auth->logged_in()){
				echo "LOGIN DISINI";
				}else{
				echo strtoupper($this->session->userdata('namauser'));
				}
				?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?php echo base_url();?>assets/dist/img/logo-pemko.jpg" class="img-circle" alt="User Image">

                <p>
                  <?php echo strtoupper($this->session->userdata('namauser'));?>
                  <small><?php echo strtoupper($this->session->userdata('jabatan'));?></small>
                </p>
              </li>
              <!-- Menu Body
              <li class="user-body">
                <div class="row">
                  <div class="col-xs-4 text-center">
                    <a href="#">Followers</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Sales</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Friends</a>
                  </div>
                </div>

              </li> -->
              <!-- Menu Footer-->
              <li class="user-footer">
				<?php
				if (!$this->ion_auth->logged_in())
				{
					$status = 'Login';
					$aksi = 'login';
				} else {
					$status = 'Log Out';
					$aksi = 'logout';
				?>
				<div class="pull-left">
                  <a href="<?php echo base_url(); ?>auth/change_password" class="btn bg-orange btn-flat">Ganti Password</a>
                </div>
				<?php
				}
				?>

                <div class="pull-right">
                  <a href="<?php echo base_url(); ?>auth/<?php echo $aksi ?>" class="btn bg-purple btn-flat"><?php echo $status ?></a>
                </div>
              </li>
            </ul>
          </li>
		  <!-- AKHIR GAMBAR USER -->

          <!-- GAMBAR SETTING Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
		  <!-- AKHIR GAMBAR SETTING -->

        </ul>
      </div>
    </nav>
	<!-- AKHIR MENU DROPDOWN SEBELAH KANAN -->
  </header>
  <!-- AKHIR HEADER HALAMAN TEMPLATE -->
