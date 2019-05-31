<div class='row'>
	<div class='col-xs-12'>
	    <div class='box box-primary'>
			<form action="<?php echo $action; ?>" method="post">
				<table class='table table-bordered'>		
		
					<tr>
						<td><label for="int">Pekerjaan <?php echo form_error('pekerjaan') ?></label></td>
						<td><input type="text" class="form-control" name="pekerjaan" id="pekerjaan" placeholder="Pekerjaan" value="<?php echo $pekerjaan; ?>" /></td>    
					</tr>
            
					<tr>
						<td><label for="tinyint">Progress <?php echo form_error('progress') ?></label></td>
						<td><input type="text" class="form-control" name="progress" id="progress" placeholder="Progress" value="<?php echo $progress; ?>" /></td>    
					</tr>
            
					<tr>
						<td><label for="date">Tgl Progress <?php echo form_error('tgl_progress') ?></label></td>
						<td><input type="text" class="form-control" name="tgl_progress" id="tgl_progress" placeholder="Tgl Progress" value="<?php echo $tgl_progress; ?>" /></td>    
					</tr>
            
					<tr>
						<td><label for="tinyint">Next Progress <?php echo form_error('next_progress') ?></label></td>
						<td><input type="text" class="form-control" name="next_progress" id="next_progress" placeholder="Next Progress" value="<?php echo $next_progress; ?>" /></td>    
					</tr>
            
					<tr>
						<td><label for="date">Tgl N Progress <?php echo form_error('tgl_n_progress') ?></label></td>
						<td><input type="text" class="form-control" name="tgl_n_progress" id="tgl_n_progress" placeholder="Tgl N Progress" value="<?php echo $tgl_n_progress; ?>" /></td>    
					</tr>
            
					<tr>
						<td><label for="varchar">Ket <?php echo form_error('ket') ?></label></td>
						<td><input type="text" class="form-control" name="ket" id="ket" placeholder="Ket" value="<?php echo $ket; ?>" /></td>    
					</tr>
            
					<input type="hidden" name="id" value="<?php echo $id; ?>" /> 
					<tr>
						<td colspan='2'>
							<button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
							<a href="<?php echo site_url('Progress_pekerjaan') ?>" class="btn btn-danger">Cancel</a>
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
		$("#ket").focus();
	});
</script>
