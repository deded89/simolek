<style>
  .gallery
  {
    display: inline-block;
    margin-top: 20px;
  }
</style>

<div class="row" style="margin-bottom: 10px">
	<div class="col-md-4 text-left">
		<?php echo anchor(site_url('pengadaan/kondisi_img/add/'.$id_p), 'Tambah Data', 'class="btn btn-primary"'); ?>
	</div>
</div>

<div class="row">
<div class="col-xs-12">
  <div class="box box-primary">
    <?php if ($kondisi_img_data) { ?>
		<div class='list-group gallery'>
          <?php foreach ($kondisi_img_data as $data) {?>
            <div class='col-md-3'>
                <a data-fancybox="gallery" data-caption="Kondisi <?php echo $data->kondisi ?> %"
                    href="<?php echo base_url("images/pekerjaan/".$data->pekerjaan."/".$data->filename) ?>">
                    <img class="img-responsive" alt="" src="<?php echo base_url("images/pekerjaan/".$data->pekerjaan."/".$data->filename) ?>" />
                    <div class="small-text text-center">
                      <p>Kondisi <?php echo $data->kondisi ?> %</p>
                    </div>
                </a>
            </div>
          <?php } ?>
        </div>
      <?php } else { ?>
        <p>Gambar Tidak Ditemukan</p>
      <?php } ?>
      </div> <!-- list-group / end -->
    </div> <!-- list-group / end -->
	</div> <!-- row / end -->
</div> <!-- container / end -->
