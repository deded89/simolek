<div class="row">
  <div class="col-md-6 ">
    <div class="box box-info box-solid">
      <div class="box-header with-border bg-aqua">
        <h3 class="box-title"><i class="icon fa fa-info"></i>&nbsp&nbsp&nbsp Pagu Belanja Langsung APBD 2019 Pemkot Banjarmasin</h3>
      </div>
      <div class="box-body">
        <h4>
          <?php echo "Rp. " . number_format($pagu_bl,2,',','.'); ?>
        </h4>
      </div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="box box-warning box-solid">
      <div class="box-header with-border bg-yellow">
        <h3 class="box-title"><i class="icon fa fa-info"></i>&nbsp&nbsp&nbsp Pagu Pekerjaan Strategis ( Paket Pekerjaan >200 Jt Rupiah)</h3>
      </div>
      <div class="box-body">
        <h4>
          <?php echo "Rp. " . number_format($pagu_pekerjaan,2,',','.'); ?>
          <?php echo "  ( ".number_format($persen_pagu_pekerjaan,2,',','.')." %) dari Pagu Belanja Langsung" ?>
        </h4>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-xs-12">
    <div class="box box-info box-solid collapsed-box">
      <div class="box-header with-border">
        <h3 class="box-title">Pagu Pekerjaan Strategis per SKPD</h3>
        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
          </button>
        </div>
      </div>
      <div class="box-body table-responsive no-padding">
        <table class="table table-hover">
          <tbody>
          <tr>
            <th></th>
            <th>Nama SKPD</th>
            <th>Jumlah Paket</th>
            <th>Nilai</th>
          </tr>
          <?php foreach ($count_skpd as $pekerjaan_skpd) { ?>
            <tr>
              <td>
                <a href="<?php echo site_url('pengadaan/pengendalian/index/'.$pekerjaan_skpd->skpd) ?>"class="btn btn-warning btn-xs" title="Lihat Dashboar SKPD">
                  <i class="fa fa-tv"></i>
                </a>
                <a href="<?php echo site_url('pengadaan/pengendalian/filter_skpd/'.$pekerjaan_skpd->skpd) ?>"class="btn btn-info btn-xs" title="Lihat Detail Pekerjaan">
                  <i class="fa fa-eye"></i>
                </a>
              </td>
              <td><?php echo $pekerjaan_skpd->nama_skpd ?></td>
              <td><span class="label label-default"><?php echo $pekerjaan_skpd->c_skpd ?></span></td>
              <td><?php echo "Rp. " . number_format($pekerjaan_skpd->sum_pagu,2,',','.'); ?></td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-4">
    <div class="box box-widget widget-user-2">
      <!-- Add the bg color to the header using any of the bg-* classes -->
      <div class="widget-user-header bg-aqua">
        <div class="widget-user-image">
          <img class="img-circle" src="<?php echo base_url(); ?>assets/images/opt-icon.png" alt="User Avatar">
        </div>
        <!-- /.widget-user-image -->
        <h5 class="widget-user-desc">Jumlah Pekerjaan Berdasarkan</h3>
        <h3 class="widget-user-username"><strong>Jenis Pengadaan</strong> </h5>
      </div>
      <div class="box-footer no-padding">
        <ul class="nav nav-stacked">
          <?php foreach ($count_jenis as $cj) { ?>
            <li><a href="<?php echo site_url('pengadaan/pengendalian/filter_jenis_metode/jenis/'.$cj->jenis.'/'.$id_skpd) ?>"> <?php echo $cj->nama ?> <span class="pull-right badge bg-gray"><?php echo $cj->c_jenis ?></span></a></li>
          <?php } ?>
          <li><a href="<?php echo site_url('pengadaan/pengendalian/filter_skpd/'.$id_skpd) ?>"><strong> Total</strong> <span class="pull-right badge bg-green"><?php echo $total_pekerjaan ?></span></a></li>
        </ul>
      </div>
    </div>
  </div>

  <div class="col-md-4">
    <div class="box box-widget widget-user-2">
      <!-- Add the bg color to the header using any of the bg-* classes -->
      <div class="widget-user-header bg-aqua">
        <div class="widget-user-image">
          <img class="img-circle" src="<?php echo base_url(); ?>assets/images/opt-icon.png" alt="User Avatar">
        </div>
        <!-- /.widget-user-image -->
        <h5 class="widget-user-desc">Jumlah Pekerjaan Berdasarkan</h3>
        <h3 class="widget-user-username"><strong>Metode Pemilihan</strong> </h5>
      </div>
      <div class="box-footer no-padding">
        <ul class="nav nav-stacked">
          <?php foreach ($count_metode as $cm) { ?>
            <li><a href="<?php echo site_url('pengadaan/pengendalian/filter_jenis_metode/metode/'.$cm->metode.'/'.$id_skpd) ?>"> <?php echo $cm->nama ?> <span class="pull-right badge bg-gray"><?php echo $cm->c_metode ?></span></a></li>
          <?php } ?>
          <li><a href="<?php echo site_url('pengadaan/pengendalian/filter_skpd/'.$id_skpd) ?>"><strong> Total</strong> <span class="pull-right badge bg-green"><?php echo $total_pekerjaan ?></span></a></li>
        </ul>
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="box box-widget widget-user-2">
      <!-- Add the bg color to the header using any of the bg-* classes -->
      <div class="widget-user-header bg-yellow">
        <div class="widget-user-image">
          <img class="img-circle" src="<?php echo base_url(); ?>assets/images/money-icon.png" alt="User Avatar">
        </div>
        <!-- /.widget-user-image -->
        <h5 class="widget-user-desc">Jumlah Pekerjaan Berdasarkan</h3>
        <h3 class="widget-user-username"><strong>Jumlah Pagu</strong> </h5>
      </div>
      <div class="box-footer no-padding">
        <ul class="nav nav-stacked">
          <li><a href="<?php echo site_url('pengadaan/pengendalian/filter_pagu/200000000/0/'.$id_skpd) ?>"> < 200 JT <span class="pull-right badge bg-gray"><?php echo $ck200 ?></span></a></li>
          <li><a href="<?php echo site_url('pengadaan/pengendalian/filter_pagu/2500000000/200000000/'.$id_skpd) ?>"> > 200jt s.d 2,5M <span class="pull-right badge bg-gray"><?php echo $c200 ?></span></a></li>
          <li><a href="<?php echo site_url('pengadaan/pengendalian/filter_pagu/50000000000/2500000000/'.$id_skpd) ?>"> > 2,5M s.d 50M <span class="pull-right badge bg-gray"><?php echo $c25 ?></span></a></li>
          <li><a href="<?php echo site_url('pengadaan/pengendalian/filter_pagu/1000000000000/50000000000/'.$id_skpd) ?>"> > 50M <span class="pull-right badge bg-gray"><?php echo $c50 ?></span></a></li>
          <li><a href="<?php echo site_url('pengadaan/pengendalian/filter_skpd/'.$id_skpd) ?>"><strong> Total</strong> <span class="pull-right badge bg-green"><?php echo $ck200+$c200+$c25+$c50 ?></span></a></li>
        </ul>
      </div>
    </div>
  </div>
</div>

<!-- ROW KEDUA -->
<div class="row">
  <div class="col-md-4">
    <div class="box box-widget widget-user-2">
      <!-- Add the bg color to the header using any of the bg-* classes -->
      <div class="widget-user-header bg-aqua">
        <div class="widget-user-image">
          <img class="img-circle" src="<?php echo base_url(); ?>assets/images/work-icon.png" alt="User Avatar">
        </div>
        <!-- /.widget-user-image -->
        <h5 class="widget-user-desc">Kondisi Pekerjaan Pagu Bernilai</h3>
        <h3 class="widget-user-username"><strong> >200 JT s.d 2,5 M</strong> </h5>
      </div>
      <div class="box-footer no-padding">
        <ul class="nav nav-stacked">
          <?php foreach ($tahapan_200 as $tahapan){  ?>
            <li><a href="<?php echo site_url('pengadaan/pengendalian/filter_pagu_progress/2500000000/200000000/'.$tahapan->progress_now.'/'.$id_skpd) ?>"> <?php echo $tahapan->nama ?> <span class="pull-right badge bg-gray"><?php echo $tahapan->c_progress ?></span></a></li>
          <?php } ?>
          <li><a href="<?php echo site_url('pengadaan/pengendalian/filter_pagu/2500000000/200000000/'.$id_skpd) ?>"><strong> Total</strong> <span class="pull-right badge bg-green"><?php echo $c200 ?></span></a></li>
        </ul>
      </div>
    </div>
  </div>

  <div class="col-md-4">
    <div class="box box-widget widget-user-2">
      <!-- Add the bg color to the header using any of the bg-* classes -->
      <div class="widget-user-header bg-aqua">
        <div class="widget-user-image">
          <img class="img-circle" src="<?php echo base_url(); ?>assets/images/work-icon.png" alt="User Avatar">
        </div>
        <!-- /.widget-user-image -->
        <h5 class="widget-user-desc">Kondisi Pekerjaan Pagu Bernilai</h3>
        <h3 class="widget-user-username"><strong> > 2,5 M s.d 50 M</strong> </h5>
      </div>
      <div class="box-footer no-padding">
        <ul class="nav nav-stacked">
          <?php foreach ($tahapan_25 as $tahapan){  ?>
            <li><a href="<?php echo site_url('pengadaan/pengendalian/filter_pagu_progress/5000000000/2500000000/'.$tahapan->progress_now.'/'.$id_skpd) ?>"> <?php echo $tahapan->nama ?> <span class="pull-right badge bg-gray"><?php echo $tahapan->c_progress ?></span></a></li>
          <?php } ?>
          <li><a href="<?php echo site_url('pengadaan/pengendalian/filter_pagu/50000000000/2500000000/'.$id_skpd) ?>"><strong> Total</strong> <span class="pull-right badge bg-green"><?php echo $c25 ?></span></a></li>
        </ul>
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="box box-widget widget-user-2">
      <!-- Add the bg color to the header using any of the bg-* classes -->
      <div class="widget-user-header bg-yellow">
        <div class="widget-user-image">
          <img class="img-circle" src="<?php echo base_url(); ?>assets/images/work-icon.png" alt="User Avatar">
        </div>
        <!-- /.widget-user-image -->
        <h5 class="widget-user-desc">Kondisi Pekerjaan Pagu Bernilai</h3>
        <h3 class="widget-user-username"><strong> > 50 M</strong> </h5>
      </div>
      <div class="box-footer no-padding">
        <ul class="nav nav-stacked">
          <?php foreach ($tahapan_50 as $tahapan){  ?>
            <li><a href="<?php echo site_url('pengadaan/pengendalian/filter_pagu_progress/1000000000000/50000000000/'.$tahapan->progress_now.'/'.$id_skpd) ?>"> <?php echo $tahapan->nama ?> <span class="pull-right badge bg-gray"><?php echo $tahapan->c_progress ?></span></a></li>
          <?php } ?>
          <li><a href="<?php echo site_url('pengadaan/pengendalian/filter_pagu/1000000000000/50000000000/'.$id_skpd) ?>"><strong> Total</strong> <span class="pull-right badge bg-green"><?php echo $c50 ?></span></a></li>
        </ul>
      </div>
    </div>
  </div>
</div>

<!-- PEKERJAAN TIDAK SESUAI RENCANA -->

<div <?php echo $pengelola_only ?> class="row">
  <div class="col-xs-12">
    <div class="box box-danger box-solid collapsed-box">
      <div class="box-header with-border">
        <h3 class="box-title">Pekerjaan tidak sesuai rencana</h3>
        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
          </button>
        </div>
      </div>
      <div class="box-body table-responsive no-padding">
        <table class="table table-hover">
          <tbody>
          <tr>
            <th></th>
            <th>Nama Pekerjaan</th>
            <th>Kegiatan</th>
            <th>SKPD</th>
          </tr>
          <?php foreach ($pekerjaan_next_last_month as $pekerjaan){ ?>
            <tr>
              <td>
                <a href="<?php echo site_url('pengadaan/pekerjaan/read/'.$pekerjaan->id_p) ?>"class="btn btn-info btn-xs">
                  <i class="fa fa-eye"></i>
                </a>
              </td>
              <td><?php echo $pekerjaan->nama ?></td>
              <td><?php echo $pekerjaan->kegiatan ?></td>
              <td><?php echo $pekerjaan->nama_skpd ?></td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
