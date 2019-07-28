<div class='row'>
	<div class='col-xs-12'>
	    <div class='box box-primary'>
			<form action="<?php echo $action; ?>" method="post">
				<table class='table table-bordered'>

					<tr>
						<td><label for="varchar">Nama <?php echo form_error('nama') ?></label></td>
						<td><input type="text" class="form-control" name="nama" id="nama" placeholder="Nama" value="<?php echo $nama; ?>" /></td>
					</tr>

					<input type="hidden" name="id" value="<?php echo $id; ?>" />
					<!-- CSRF TOKEN -->
					<?php
						$csrf = array(
							'name' => $this->security->get_csrf_token_name(),
							'hash' => $this->security->get_csrf_hash()
						);
					?>
					<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
					<tr>
						<td colspan='2'>
							<button type="submit" class="btn btn-primary"><?php echo $button ?></button>
							<a href="<?php echo site_url('pengadaan/progress') ?>" class="btn btn-danger">Cancel</a>
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
		$("#nama").focus();
	});
</script>
