<?php  if (!$this->ion_auth->in_group('pengelola')) { ?>
  <!-- MENU PENGENDALIAN -->
  <li class="treeview">
    <a href="#">
      <i class="fa fa-binoculars"></i>
      <span>LKPK</span>
      <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
      </span>
    </a>
    <ul class="treeview-menu">
      <li><a href="<?php echo base_url();?>lkpk/kegiatan"><i class="fa fa-fa-list-alt"></i> List Kegiatan</a></li>
      <li><a href="<?php echo base_url();?>lkpk/ren_real/rfk_pemko"><i class="fa fa-folder-open"></i> Laporan RFK Pemko</a></li>
      <li><a href="<?php echo base_url();?>lkpk/ren_real/"><i class="fa fa-folder-open"></i> Laporan RFK Per SKPD</a></li>
      <li><a href="<?php echo base_url();?>lkpk/kegiatan/grafik_pemko_keu"><i class="fa fa-list-alt"></i> Grafik Keuangan Pemko</a></li>
      <li><a href="<?php echo base_url();?>lkpk/kegiatan/grafik_pemko_fisik"><i class="fa fa-list-alt"></i> Grafik Fisik Pemko</a></li>
    </ul>
  </li>
  <!-- AKHIR MENU PENGENDALIAN -->
<?php } ?>
