<div class='row'>
	<div class='col-xs-12'>
	    <div class='box box-primary'  style="padding:20px">
        <form action="<?php base_url('pengadaan/kondisi_img/add') ?>" method="post" enctype="multipart/form-data" >
					<div class="form-group <?php echo form_error('kondisi') ? 'has-error':'' ?>">
						<label for="kondisi">Kondisi*</label>
						<input class="form-control <?php echo form_error('kondisi') ? 'is-invalid':'' ?>"
						 type="number" min=0 max=100 name="kondisi" placeholder="Persentase kondisi tanpa desimal" />
						<div class="help-block">
							<?php echo form_error('kondisi') ?>
						</div>
					</div>

					<div class="form-group <?php echo form_error('filename') ? 'has-error':'' ?>">
						<label for="filename">Photo</label>
						<input class="form-control-file"
						 type="file" name="filename" />
						 <div class="help-block"><?php echo form_error('filename') ?></div>
						 <div  style="margin-top:10px"
						 	<small class="form-text text-muted">File yang diupload hanya format jpg|png|bmp dengan max ukuran file 2 MB</small>
						 </div>
					</div>

					<div class="form-group <?php echo form_error('deskripsi_gambar') ? 'has-error':'' ?>">
						<label for="deskripsi_gambar">Deskripsi Foto</label>
						<input class="form-control <?php echo form_error('deskripsi_gambar') ? 'is-invalid':'' ?>"
						type="text" name="deskripsi_gambar" placeholder="Deskripsi Singkat Foto yang Diupload " />
						<div class="help-block">
							<?php echo form_error('deskripsi_gambar') ?>
						</div>
					</div>
					<input class="btn btn-primary" type="submit" id="submit" name="btn" value="Simpan" />
          <a href="<?php echo site_url('pengadaan/pekerjaan/read/'.$id_p) ?>" class="btn btn-danger">Cancel</a>

          <input type="hidden" name="id_p" value="<?php echo $id_p ?>">
					<!-- CSRF TOKEN -->
					<?php
						$csrf = array(
							'name' => $this->security->get_csrf_token_name(),
							'hash' => $this->security->get_csrf_hash()
						);
					?>
					<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
  		</form>
			<div id="loading" class="overlay" style="display: none;">
        <i class="fa fa-refresh fa-spin"></i>
      </div>
		</div>
	</div>
</div>

<!-- jQuery 2.2.3 -->
<script src="<?php echo base_url();?>assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
<script type="text/javascript">
	$(document).ready(function () {
		$("#nama").focus();
		$("#submit").click(function(){
			$("#loading").show();
		});
	});
</script>
