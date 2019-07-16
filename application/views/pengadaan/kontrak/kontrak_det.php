<?php if ($kontrak_data) { ?>
  <?php foreach ($kontrak_data as $kontrak){ ?>
    <div class="box box-primary box-solid">
      <div class="box-header with-border bg-aqua">
        <h4 class="box-title">
            Nomor Kontrak : <?php echo $kontrak->nomor ?>
        </h4>
      </div>
      <div class="box-body">
        <div class="row">
          <div class="col-xs-2">
            <p>Penyedia</p>
          </div>
          <div class="col-xs-4">
            <p>: <?php echo $kontrak->penyedia ?></p>
          </div>
          <div class="col-xs-2">
            <p>Tanggal</p>
          </div>
          <div class="col-xs-4">
            <p>: <?php echo $kontrak->tanggal ?></p>
          </div>
        </div>
        <div class="row">
          <div class="col-xs-2">
            <p>Nilai Kontrak</p>
          </div>
          <div class="col-xs-4">
            <p>: <?php echo "Rp " . number_format($kontrak->nilai,2,',','.'); ?></p>
          </div>
          <div class="col-xs-2">
            <p>Masa Kontrak</p>
          </div>
          <div class="col-xs-4">
            <p>: <?php echo $kontrak->awal." s.d ".$kontrak->akhir." (".$kontrak->lama.")" ?></p>
          </div>
        </div>
        <div class="row">
          <div class="col-xs-2">
            <p>Keterangan</p>
          </div>
          <div class="col-xs-10">
            <p>: <?php echo $kontrak->ket ?></p>
          </div>
        </div>
        <div class="row">
          <div class="col-xs-12 text-right">
            <p <?php echo $hidden_attr ?>>
              <?php
              echo anchor(site_url('pengadaan/kontrak/update/'.$kontrak->id."/".$kontrak->pekerjaan),'<i class="fa fa-pencil-square-o"></i>', 'title="Update" class="btn btn-warning btn-xs"');
              echo '  ';
              echo anchor(site_url('pengadaan/kontrak/delete/'.$kontrak->id."/".$kontrak->pekerjaan),'<i class="fa fa-trash-o"></i>', 'title="Hapus" class="btn btn-danger btn-xs" onclick="javasciprt: return confirm(\'Are You Sure ?\')"');
              ?>
            </p>
          </div>
        </div>
      </div>
    </div>
  <?php } ?>
<?php } else { ?>
  <p>Data Kontrak tidak tersedia  </p>
<?php } ?>
