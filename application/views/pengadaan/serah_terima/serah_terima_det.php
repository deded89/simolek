<?php if ($st_data) { ?>  
  <?php foreach ($st_data as $st){ ?>
    <div class="box box-primary">
      <div class="row">
        <div class="col-xs-2">
          <p>Nomor</p>
        </div>
        <div class="col-xs-4">
          <p>: <?php echo $st->nomor ?></p>
        </div>
        <div class="col-xs-2">
          <p>Tanggal</p>
        </div>
        <div class="col-xs-4">
          <p>: <?php echo $st->tanggal ?></p>
        </div>
      </div>
      <div class="row">
        <div class="col-xs-2">
          <p>Penyedia</p>
        </div>        
      </div>
      <div class="row">
        <div class="col-xs-12 text-right">
          <p>
            <?php
            echo anchor(site_url('pengadaan/serah_terima/update/'.$st->id."/".$st->pekerjaan),'<i class="fa fa-pencil-square-o"></i>', 'title="Update" class="btn btn-warning btn-xs"');
            echo '  ';
            echo anchor(site_url('pengadaan/serah_terima/delete/'.$st->id."/".$st->pekerjaan),'<i class="fa fa-trash-o"></i>', 'title="Hapus" class="btn btn-danger btn-xs" onclick="javasciprt: return confirm(\'Are You Sure ?\')"');
            ?>
          </p>
        </div>
      </div>
    </div>
  <?php } ?>
<?php } else { ?>
  <p>Data Serah Terima tidak tersedia  </p>
<?php } ?>
