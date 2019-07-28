<div class='row'>
	<div class='col-xs-12'>
	    <div class='box box-primary'  style="padding:20px">
        <form action="<?php echo site_url('pengadaan/kondisi_img/update_action') ?>" method="post">
					<div class="form-group <?php echo form_error('deskripsi_gambar') ? 'has-error':'' ?>">
						<label for="deskripsi_gambar">Deskripsi Foto</label>
						<input autofocus class="form-control <?php echo form_error('deskripsi_gambar') ? 'is-invalid':'' ?>"
						type="text" name="deskripsi_gambar" placeholder="Deskripsi Singkat Foto yang Diupload" value="<?php echo $kondisi_img_data->deskripsi_gambar ?>" />
						<div class="help-block">
							<?php echo form_error('deskripsi_gambar') ?>
						</div>
					</div>
					<input class="btn btn-primary" type="submit" name="btn" value="Simpan" />
          <a href="<?php echo site_url('pengadaan/kondisi_img/index/'.$id_p) ?>" class="btn btn-danger">Cancel</a>

          <input type="hidden" name="id" value="<?php echo $kondisi_img_data->id ?>">
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
		</div>
	</div>
</div>
