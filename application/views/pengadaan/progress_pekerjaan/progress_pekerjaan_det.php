<?php if ($pp_data) { ?>
  <ul>
    <?php foreach ($pp_data as $pp){ ?>
      <li>
        Tanggal <strong><?php echo date('d-m-Y',strtotime($pp->tgl_progress)); ?></strong>
        dalam tahap <strong><?php echo $pp->nama ?> ( <?php echo $pp->ket ?> )</strong>,
        rencana pada <strong><?php echo date('F Y',strtotime($pp->tgl_n_progress)); ?> </strong>
        akan masuk tahapan <strong><?php echo $pp->next_progress ?></strong>
        <?php echo anchor(site_url('pengadaan/progress_pekerjaan/delete/'.$pp->id_pp),
        '<i class="fa fa-trash-o"></i>', 'title="Hapus" class="btn btn-danger btn-xs"
        onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); ?>
          <br>Realisasi Keuangan : <?php echo "Rp " . number_format($pp->real_keu,2,',','.'); ?>    |   Realisasi Fisik :  <?php echo $pp->real_fisik ?>  %
          <br>-------------------------------------------------------------------------------
  <?php } ?>
</ul>
<?php } else { ?>
  <p>Data Progress Pekerjaan tidak tersedia  </p>
<?php } ?>