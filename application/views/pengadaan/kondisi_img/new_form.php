<div class='row'>
	<div class='col-xs-12'>
	    <div class='box box-primary'  style="padding:20px">
        <form action="<?php base_url('pengadaan/kondisi_img/add') ?>" method="post" enctype="multipart/form-data" >
					<div class="form-group">
						<label for="kondisi">Kondisi*</label>
						<input class="form-control <?php echo form_error('kondisi') ? 'is-invalid':'' ?>"
						 type="number" min=0 max=100 name="kondisi" placeholder="Persentase kondisi tanpa desimal" />
						<div class="invalid-feedback">
							<?php echo form_error('kondisi') ?>
						</div>
					</div>

					<div class="form-group">
						<label for="filename">Photo</label>
						<input class="form-control-file <?php echo form_error('filename') ? 'is-invalid':'' ?>"
						 type="file" name="filename" />
						<div class="invalid-feedback">
							<?php echo form_error('filename') ?>
						</div>
					</div>
					<input class="btn btn-primary" type="submit" name="btn" value="Simpan" />
          <a href="<?php echo site_url('pengadaan/kondisi_img/index/'.$id_p) ?>" class="btn btn-danger">Cancel</a>

          <input type="hidden" name="id_p" value="<?php echo $id_p ?>">

  		</form>
		</div>
	</div>
</div>

<!-- jQuery 2.2.3 -->
<script src="<?php echo base_url();?>assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
<script type="text/javascript">
	$(document).ready(function () {
		$("#nama").focus();
	});
</script>
