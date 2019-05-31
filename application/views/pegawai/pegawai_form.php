<head>    
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/AdminLTE.min.css">
</head>
<?php echo form_error('nip') ?>
<?php echo form_error('nama_lengkap') ?>
<?php echo form_error('id_skpd') ?>
<div class='row'>
	<div class='col-xs-12'>
	    <div class='box box-primary'>
			<form action="<?php echo $action; ?>" method="post">
				<table class='table table-bordered'>		
					<tr>
						<td width="200px"><label for="varchar">NIP Pegawai (Tanpa Spasi)</label></td>
						<td><input type="text" class="form-control" name="nip" id="nip" placeholder="NIP Pegawai" value="<?php echo $nip; ?>" /></td>    
					</tr>
				
					<tr>
						<td><label for="varchar">Nama Lengkap</label></td>
						<td><input type="text" class="form-control" name="nama_lengkap" id="nama_lengkap" placeholder="Nama Lengkap" value="<?php echo $nama_lengkap; ?>" /></td>    
					</tr>
            
					<tr>
						<td><label for="tinyint">SKPD </label></td>
						<!-- combo dinamis -->
						<?php if (!$this->ion_auth->in_group('admin')) {  
									$id = $this->session->userdata('id_skpd');									
								} else {
									$id = $id_skpd;
								} ?>
						
						<td><?php echo cmb_dinamiss3('id_skpd','skpd','nama_skpd','id_skpd',$id,'id_skpd','id_skpd','id_skpd') ?></td>	   
						<!-- akhir combo dinamis -->						   
					</tr>            
					
					<tr>
						<td colspan='2'>
							<button id="submit" type="submit" class="btn btn-primary"><?php echo $button ?></button> 
							<a href="<?php echo site_url('Pegawai') ?>" class="btn btn-danger">Cancel</a>
						</td>	
					</tr>
				</table>
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
		$("#nip").focus();
		$('#id_skpd').select2({
			placeholder: "Pilih SKPD Asal Pegawai",
			allowClear:	true,
		});
		$("#submit").click(function(){
        $("#loading").show();
		});
	});
</script>
