<div class='row'>
	<div class='col-xs-12'>
	    <div class='box box-primary'>
			<form action="<?php echo $action; ?>" method="post">
				<table class='table table-bordered'>		
					<!-- 
					<tr>
						<td><label for="int">Id Lap <?php echo form_error('id_lap') ?></label></td>
						<td><input type="text" class="form-control" name="id_lap" id="id_lap" placeholder="Id Lap" value="<?php echo $id_lap; ?>" /></td>    
					</tr>
            
					<tr>
						<td><label for="mediumint">Id Skpd <?php echo form_error('id_skpd') ?></label></td>
						<td><input type="text" class="form-control" name="id_skpd" id="id_skpd" placeholder="Id Skpd" value="<?php echo $id_skpd; ?>" /></td>    
					</tr>
            
					<tr>
						<td><label for="tinyint">Id Status <?php echo form_error('id_status') ?></label></td>
						<td><input type="text" class="form-control" name="id_status" id="id_status" placeholder="Id Status" value="<?php echo $id_status; ?>" /></td>    
					</tr>
            
					<tr>
						<td><label for="mediumint">Id Jab <?php echo form_error('id_jab') ?></label></td>
						<td><input type="text" class="form-control" name="id_jab" id="id_jab" placeholder="Id Jab" value="<?php echo $id_jab; ?>" /></td>    
					</tr>
            
					<tr>
						<td><label for="date">Tgl Upload <?php echo form_error('tgl_upload') ?></label></td>
						<td><input type="text" class="form-control" name="tgl_upload" id="tgl_upload" placeholder="Tgl Upload" value="<?php echo $tgl_upload; ?>" /></td>    
					</tr>
					 -->
					<?php if (!isset($ket)){
						$ket = '';
					} ?> 
					<tr>
						<td><label for="text">Keterangan <?php echo form_error('ket') ?></label></td>
						<td><textarea rows="4" class="form-control" name="ket" id="ket" placeholder="Tambahkan Keterangan"><?php echo $ket; ?> </textarea> </td>    
					</tr>
            
					<input type="hidden" name="id_pelaporan" value="<?php echo $id_pelaporan; ?>" /> 
					<tr>
						<td colspan='2'>
							<button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
							<a href="<?php echo site_url('Pelaporan') ?>" class="btn btn-danger">Cancel</a>
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
		$("#tgl_upload").focus();
	});
</script>
