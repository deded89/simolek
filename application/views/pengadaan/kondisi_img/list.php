<style>
  .gallery
  {
    display: inline-block;
    margin-top: 20px;

  }
</style>

<div class="row" style="margin-bottom: 10px">
	<div class="col-md-4 text-left">
		<span <?php echo $hidden_attr ?>>
      <?php echo anchor(site_url('pengadaan/kondisi_img/add/'.$id_p), 'Tambah Data', 'class="btn btn-primary"'); ?>
    </span>
		<?php echo anchor(site_url('pengadaan/pekerjaan/read/'.$id_p), 'Kembali', 'class="btn btn-danger"'); ?>
	</div>
</div>

<div class="row">
<div class="col-xs-12">
  <div class="box box-primary">
    <?php if ($kondisi_img_data) { ?>
		<div class='list-group gallery'>
          <?php foreach ($kondisi_img_data as $data) {?>
            <div class='col-md-3' style="margin-bottom:10px; width:250px;">
                <a data-fancybox="mygallery" data-caption="Kondisi <?php echo $data->kondisi ?> % Deskripsi: <?php echo $data->deskripsi_gambar?>"
                    href="<?php echo base_url("images/pekerjaan/".$data->pekerjaan."/".$data->filename) ?>">
                    <img class="img-thumbnail" style="height : 200px; width:200px;" alt="" src="<?php echo base_url("images/pekerjaan/".$data->pekerjaan."/".$data->filename) ?>" />
                    <div class='text-center'>
                      <small class='text-muted'>Kondisi <?php echo $data->kondisi ?> %</small>
                    </div>
                </a>
                <span <?php echo $hidden_attr ?>>
                  <?php
                  echo anchor(site_url('pengadaan/kondisi_img/delete/'.$data->id."/".$id_p),
                  '<i class="fa fa-trash-o"></i>', 'title="Hapus" class="btn btn-danger btn-xs"
                  onclick="javasciprt: return confirm(\'Are You Sure ?\')"');
                  echo ' ';
                  echo anchor(site_url('pengadaan/kondisi_img/update/'.$data->id."/".$id_p),
                  '<i class="fa fa-pencil"></i>', 'title="Edit Deskripsi" class="btn btn-warning btn-xs" ');
                  ?>
                </span>
            </div>
          <?php } ?>
        </div>
      <?php } else { ?>
        <h2 class="text-center">Gambar Tidak Ditemukan</h2><br>
      <?php } ?>
      </div> <!-- list-group / end -->
    </div> <!-- list-group / end -->
	</div> <!-- row / end -->
</div> <!-- container / end -->
