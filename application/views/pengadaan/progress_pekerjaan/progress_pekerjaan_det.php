<?php if ($pp_data) { ?>
  <ul>
    <?php foreach ($pp_data as $pp){ ?>
      <li>
        <span class="label label-success"><?php echo date('d-m-Y',strtotime($pp->tgl_progress)); ?></span>
        <strong> <?php echo $pp->ket ?></strong> dalam tahapan <strong><?php echo $pp->nama ?></strong>,
        rencana pada <strong><?php echo date('d-m-Y',strtotime($pp->tgl_n_progress)); ?> </strong>
        akan masuk tahapan <strong><?php echo $pp->next_progress ?></strong>
        <span <?php echo $hidden_attr ?>>
          <?php echo anchor(site_url('pengadaan/progress_pekerjaan/delete/'.$pp->id_pp.'/'.$pp->pekerjaan),
          '<i class="fa fa-trash-o"></i>', 'title="Hapus" class="btn btn-danger btn-xs"
          onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); ?>
        </span>
          <br>Realisasi Keuangan : <?php echo "Rp " . number_format($pp->real_keu,2,',','.'); ?>    |   Realisasi Fisik :  <?php echo $pp->real_fisik ?>  %
          <br>-------------------------------------------------------------------------------
          <span <?php echo $pengelola_only ?>>Input Tanggal : <span class="label label-warning"><?php echo date('d-m-Y',strtotime($pp->create_date)) ?></span></span>
  <?php } ?>
</ul>
<?php } else { ?>
  <p>Data Progress Pekerjaan tidak tersedia  </p>
<?php } ?>
