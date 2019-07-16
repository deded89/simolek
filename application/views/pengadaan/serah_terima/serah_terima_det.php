<?php if ($st_data) { ?>
  <?php foreach ($st_data as $st){ ?>
    <div class="box box-primary box-solid">
      <div class="box-header with-border bg-aqua">
        <h4 class="box-title">
            Nomor BAST: <?php echo $st->nomor ?>
        </h4>
      </div>
      <div class="box-body">
        <div class="row">
          <div class="col-xs-2">
            <p>Penyedia</p>
          </div>
          <div class="col-xs-4">
            <p>: <?php echo $st->penyedia ?></p>
          </div>
          <div class="col-xs-2">
            <p>Tanggal</p>
          </div>
          <div class="col-xs-4">
            <p>: <?php echo $st->tanggal ?></p>
          </div>
        </div>
        <div class="row">
          <div class="col-xs-12 text-right">
            <p <?php echo $hidden_attr ?>>
              <?php
              echo anchor(site_url('pengadaan/serah_terima/delete/'.$st->id."/".$st->pekerjaan),'<i class="fa fa-trash-o"></i>', 'title="Hapus" class="btn btn-danger btn-xs" onclick="javasciprt: return confirm(\'Are You Sure ?\')"');
              ?>
            </p>
          </div>
        </div>
      </div>
    </div>
  <?php } ?>
<?php } else { ?>
  <p>Data Serah Terima tidak tersedia  </p>
<?php } ?>
