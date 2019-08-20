<!-- MENU SIDEBAR SEBELAH KIRI -->
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">


    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="<?php echo base_url();?>assets/dist/img/logo-pemko.jpg" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p>Pemerintah <br> Kota Banjarmasin </br> </p>
        <!-- <a href="#"><i class="fa fa-circle text-success"></i> Online</a>  -->

      </div>
    </div>
    <!-- MENU SAMPING KIRI -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">
      <li class="header">NAVIGASI MENU</li>

      <!-- MENU UNTUK ADMIN -->
      <?php  if ($this->ion_auth->in_group('admin')) //CEK APAKAH USER ADALAH ADMIN
      {
        ?>
        <!-- ADMIN -->
        <li class="treeview">
          <a href="#"><i class="fa fa-dashboard"></i><span>Admin</span>
          </a>
        </li>
        <!-- MENU LEVEL JABATAN -->

        <li class="treeview"><a href="#"><i class="fa fa-files-o"></i><span>Level Jabatan</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="<?php echo base_url();?>level_jabatan"><i class="fa fa-circle-o"></i> List Level Jabatan</a></li>
          <li><a href="<?php echo base_url();?>level_jabatan/create"><i class="fa fa-circle-o"></i> Tambah Level Jabatan</a></li>
        </ul>
      </li>

      <!-- AKHIR MENU LEVEL JABATAN -->

      <!-- MENU SKPD -->

      <li class="treeview"><a href="#"><i class="fa fa-files-o"></i><span>SKPD</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li><a href="<?php echo base_url();?>skpd"><i class="fa fa-circle-o"></i> List SKPD</a></li>
        <li><a href="<?php echo base_url();?>skpd/create"><i class="fa fa-circle-o"></i> Tambah SKPD</a></li>
      </ul>
    </li>

    <!-- AKHIR MENU SKPD -->

    <!-- MENU STATUS -->

    <li class="treeview"><a href="#"><i class="fa fa-files-o"></i><span>Status</span>
      <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
      </span>
    </a>
    <ul class="treeview-menu">
      <li><a href="<?php echo base_url();?>status"><i class="fa fa-circle-o"></i> List Status</a></li>
      <li><a href="<?php echo base_url();?>status/create"><i class="fa fa-circle-o"></i> Tambah Status</a></li>
    </ul>
  </li>

  <!-- AKHIR MENU SKPD -->

  <!-- MENU SET USER PEKERJAAN -->

  <li class="treeview">
    <a href="<?php echo site_url('pengadaan/user_pekerjaan/list_user_pekerjaan') ?>">
      <i class="fa fa-files-o"></i><span>Set User Pekerjaan</span>
    </a>
  </li>

  <!-- AKHIR MENU SET USER PEKERJAAN -->

  <!-- AKHIR ADMIN -->
  <?php
}
?>

<!-- MENU PENGELOLA -->
<?php  if ($this->ion_auth->in_group('admin')) //CEK APAKAH USER ADALAH PENGELOLA
{
  ?>
  <li class=" active treeview">
    <a href="#">
      <i class="fa fa-cog"></i><span>Pengelola</span>

    </a>
  </li>
  <!-- MENU PEGAWAI -->

  <li class="treeview"><a href="#"><i class="fa fa-files-o"></i><span>Pegawai</span>
    <span class="pull-right-container">
      <i class="fa fa-angle-left pull-right"></i>
    </span>
  </a>
  <ul class="treeview-menu">
    <li><a href="<?php echo base_url();?>pegawai"><i class="fa fa-circle-o"></i> List Pegawai</a></li>
    <li><a href="<?php echo base_url();?>pegawai/create"><i class="fa fa-circle-o"></i> Tambah Pegawai</a></li>
  </ul>
</li>

<!-- AKHIR MENU JABATAN -->
<!-- MENU JABATAN -->

<li class="treeview"><a href="#"><i class="fa fa-files-o"></i><span>Jabatan</span>
  <span class="pull-right-container">
    <i class="fa fa-angle-left pull-right"></i>
  </span>
</a>
<ul class="treeview-menu">
  <li><a href="<?php echo base_url();?>jabatan"><i class="fa fa-circle-o"></i> List Jabatan</a></li>
  <li><a href="<?php echo base_url();?>jabatan/create"><i class="fa fa-circle-o"></i> Tambah Jabatan</a></li>
</ul>
</li>

<!-- AKHIR MENU JABATAN -->
</li>

<?php } ?>
<!-- AKHIR MENU PENGELOLA -->

<!-- MENU DASHBOARD UNTUK USER selain PPTK-->
<?php
if ($this->ion_auth->logged_in()){
  if ($this->ion_auth->in_group('user_biasa') or $this->ion_auth->in_group('pengelola')) { ?>
    <li class="active treeview">
      <a href="<?php echo base_url();?>dashboard">
        <i class="fa fa-user"></i>
        <span>Dashboard</span>
      </a>
    </li>
      <?php
    }
  } else { ?>
    <li class="active treeview">
      <a href="<?php echo base_url();?>dashboard">
        <i class="fa fa-user"></i>
        <span>Dashboard</span>
      </a>
    </li>
    <?php } ?>
<!-- AKHIR MENU DASHBOARD UTAMA SIMOLEK-->

<?php if ($this->ion_auth->logged_in())
{
  ?>
  <?php  if ($this->ion_auth->in_group('user_biasa') or $this->ion_auth->in_group('pengelola') ) { ?>
    <!-- MENU LAPORAN -->
    <li class="treeview">
      <a href="#">
        <i class="fa fa-envelope"></i>
        <span>Laporan</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li><a href="<?php echo base_url();?>laporan"><i class="fa fa-circle-o"></i> List Laporan</a></li>
        <?php  if ($this->ion_auth->in_group('pengelola')) //CEK APAKAH USER ADALAH PENGELOLA
        {
          ?>
          <li><a href="<?php echo base_url();?>laporan/under_me"><i class="fa fa-circle-o"></i> Koordinir Laporan</a></li>
        <?php } ?>
      </ul>
    </li>
    <!-- AKHIR MENU LAPORAN -->
  <?php } ?>

  <?php  if (!$this->ion_auth->in_group('user_biasa')) { ?>
    <!-- MENU PENGENDALIAN -->
    <li class="treeview">
      <a href="#">
        <i class="fa fa-binoculars"></i>
        <span>Pengendalian</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <?php if ($this->ion_auth->in_group('guest') OR $this->ion_auth->in_group('pengelola') OR $this->ion_auth->in_group('pimskpd')) { ?>
              <li><a href="<?php echo base_url();?>pengadaan/pengendalian"><i class="fa fa-dashboard"></i> Dashbord</a></li>
        <?php }  ?>
        <?php if ($this->ion_auth->in_group('pengelola')){ ?>
              <li><a href="<?php echo base_url();?>pengadaan/report"><i class="fa fa-folder-open"></i> Laporan TEPRA</a></li>
        <?php } ?>
        <li><a href="<?php echo base_url();?>pengadaan/pekerjaan"><i class="fa fa-list-alt"></i> List Pekerjaan</a></li>
      </ul>
    </li>
    <!-- AKHIR MENU PENGENDALIAN -->
<?php } ?>

  <?php } ?>

  <!-- AKHIR MENU UNTUK USER -->
  <?php
  if ($this->ion_auth->logged_in()){
    if (!$this->ion_auth->in_group('user_biasa')) { ?>
      <li class="treeview">
        <a href="https://drive.google.com/open?id=1AWvaz670z98LHGSUW-a6O33liohMSP8y" target="_blank">
          <i class="fa fa-arrow-down"></i>
          <span>Download Manual Book</span>
        </a>
      </li>
    <?php } } ?>
</ul>
<!-- AKHIR MENU SAMPING KIRI -->
</section>
<!-- /.sidebar -->
</aside>
<!-- AKHIR MENU SIDEBAR SEBELAH KIRI -->
