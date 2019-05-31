

<!-- MENAMPILKAN LIST FILE YANG SUDAH DIUPLOAD -->
<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">	
			<div class="box-body table-responsive">
				<div class="box-header with-border">
				  <h3 class="box-title"><strong><?php echo $nama_lap ?> </strong></h3> <br>
				  <h3 style="text-align: right"><strong><?php echo $nama_skpd ?> </strong></h3>
				</div>
				
				<div class="box-body">
				<table class="table table-bordered table-striped" id="mytable">
					<thead>
						<tr>	
							<th>Uploaded Files</th>
							<th>Waktu Upload</th>
							<th>Uploader</th>
							<th width="120px" style="text-align:center">Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($uploaded_files as $file): ?>
						<tr>
							<td><?php echo $file->nama_file ?></td>
							<td><?php echo date('d-m-Y H:i:s',strtotime($file->tgl_upload))." WITA" ?></td>
							<td><?php echo $file->nama_jab ?></td>
							<td style="text-align:center">
							<?php 
							echo anchor(site_url('upload/download/'.$id_lap.'/'.$id_skpd.'/'.$file->nama_file),'<i class="fa fa-download"></i>', 'title="Download" class="btn btn-info btn-sm"'); 
							?>
							</td>
						</tr>
						<?php endforeach ?>
					</tbody>					
				</table>
				
				<div>
					<?php 	
					echo anchor(site_url('upload/download_all/'.$id_lap.'/'.$id_skpd),'Download All as Zip', 'title="Download All" class="btn btn-primary"'); 
					echo '  ';
					echo anchor(site_url('dashboard/terima_laporan/'.$id_pelaporan.'/'.$id_lap),'Terima Laporan', 'title="Terima" class="btn btn-success"'); 
					echo '  ';
					echo anchor(site_url('pelaporan/update/'.$id_pelaporan.'/'.$id_lap),'Minta Perbaikan', 'title="Minta Revisi" class="btn btn-danger"'); 					
					/* echo anchor(site_url('dashboard/minta_perbaikan/'.$id_pelaporan.'/'.$id_lap),'Minta Perbaikan', 'title="Minta Revisi" class="btn btn-danger"'); */ 					
					?>
				</div>
				
				</div>
			</div>			
		</div>		
	</div>	
</div> 


<!-- jQuery 2.2.3 -->
<script src="<?php echo base_url();?>assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
<script>
jQuery(document).ready(function() {
	$("#mytable").dataTable({
		"aaSorting": [],
	});
});
</script>