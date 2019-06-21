<div class='row'>
	<div class='col-xs-12'>
	    <div class='box box-primary'>
			<form action="<?php echo $action; ?>" method="post">
				<table class='table table-bordered'>

					<tr>
						<td><label for="varchar">Latitude <?php echo form_error('latitude') ?></label></td>
						<td><input type="text" class="form-control" name="latitude" id="latitude" placeholder="Latitude" value="<?php echo $latitude; ?>" /></td>
					</tr>

					<tr>
						<td><label for="varchar">Longitude <?php echo form_error('longitude') ?></label></td>
						<td><input type="text" class="form-control" name="longitude" id="longitude" placeholder="Longitude" value="<?php echo $longitude ?>" /></td>
					</tr>

					<tr>
						<td><label for="varchar">Deskripsi <?php echo form_error('deskripsi') ?></label></td>
						<td><input type="text" class="form-control" name="deskripsi" id="deskripsi" placeholder="Deskripsi" value="<?php echo $deskripsi; ?>" /></td>
					</tr>


					<input type="hidden" name="id_l" value="<?php echo $id_l; ?>" />
					<input type="hidden" name="id_p" value="<?php echo $id_p; ?>" />
					<tr>
						<td colspan='2'>
							<button type="submit" class="btn btn-primary"><?php echo $button ?></button>
							<a href="<?php echo site_url('pengadaan/lokasi/index/'.$id_p) ?>" class="btn btn-danger">Cancel</a>
						</td>
					</tr>
				</table>
			</form>
		</div>
	</div>
</div>

<!-- jQuery 2.2.3 -->
<script src="<?php echo base_url();?>assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
<script type="text/javascript">
	$(document).ready(function () {
		$("#deskripsi").focus();
	});
</script>
