<div class='row'>
	<div class='col-xs-12'>
	    <div class='box box-primary'>
			<form action="<?php echo $action; ?>" method="post">
				<table class='table table-bordered'>		
		
					<tr>
						<td><label for="varchar">Nama Klasifikasi <?php echo form_error('nama_klasifikasi') ?></label></td>
						<td><input type="text" class="form-control" name="nama_klasifikasi" id="nama_klasifikasi" placeholder="Nama Klasifikasi" value="<?php echo $nama_klasifikasi; ?>" /></td>    
					</tr>
            
					<input type="hidden" name="id_klasifikasi" value="<?php echo $id_klasifikasi; ?>" /> 
					<tr>
						<td colspan='2'>
							<button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
							<a href="<?php echo site_url('Klasifikasi') ?>" class="btn btn-danger">Cancel</a>
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
		$("#nama_klasifikasi").focus();
	});
</script>
