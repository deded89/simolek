

<!-- setting tombol tambah data -->

<div class="row" style="margin-bottom: 10px">            
	<div class="col-md-4 text-left">
		<?php echo anchor(site_url('laporan/create'), 'Tambah Data', 'class="btn btn-primary"'); ?>
		<?php echo anchor(site_url('laporan/pdf'), 'PDF', 'class="btn btn-warning"'); ?>
			
	</div>           
</div>
<!-- isi halaman -->
<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">	
			<div class="box-body table-responsive">
				<table class="table table-bordered table-striped" id="mytable">
				   <thead>
						<tr>
							<th width="30px">No</th>
							<th>Nama Laporan</th>
							<th>Batas Akhir Laporan</th>
							<th>Status Akses</th>
							<th>Koordinator</th>
							<th>Status Saya</th>
							<th>Keterangan</th>							
							<th style="text-align:center">Aksi</th>
						</tr>
					</thead>
					<tbody>
					<?php
						$start = 0;
						foreach ($laporan_data as $laporan){
					?>
						<tr>
							<td><?php echo ++$start ?></td>
							<td><?php echo $laporan->nama_lap ?></td>
							<td><?php echo date('d-m-Y H:i:s',strtotime($laporan->batas_waktu))." WITA" ?></td>
							
							<?php if($laporan->status=='open'){
								$warna = "badge bg-green";
							}else if($laporan->status=='closed'){
								$warna = "badge bg-red";
							}
							?>	
							<td><span class="<?php echo $warna ?>"><?php echo $laporan->status ?></span></td>
							<td><?php echo $laporan->nama_skpd ?></td>
							
							<!-- WARNAI STATUS -->
							
							<?php 
							if($laporan->id_status==1){ //belum lapor
								$warna = "badge bg-red";
							}else if($laporan->id_status==2){ //sudah lapor
								$warna = "badge bg-yellow";
							}else if($laporan->id_status==3){ //diminta revisi
								$warna = "badge bg-yellow";
							}else if($laporan->id_status==4){ //diterima
								$warna = 'badge bg-green';
							}else if($laporan->id_status==5){ //diterima
								$warna = "badge bg-blue";
							}else if($laporan->id_status==6){ //diterima
								$warna = "badge bg-red";
							}else if($laporan->id_status==7){ //diterima
								$warna = "badge bg-yellow";
							}
							?>							
							
							<td><span class="<?php echo $warna ?>"><?php echo $laporan->mystatus ?></td>							
							<td><?php echo $laporan->ket ?></td>							
							<td style="text-align:center" width="160px">
							<?php 
							if($laporan->status == 'open'){
								echo anchor(site_url('laporan/cek_akses_upload/'.$laporan->id_lap),'<i class="fa fa-upload"></i>', 'title="Upload File" class="btn bg-purple btn-sm"'); 
								echo '  ';
							}
							?>
							</td>
							</tr>
						<?php
						}	
						?>
					</tbody>
				</table>
			</div>
		 </div>
	</div>
</div>
		
<!-- jQuery 2.2.3 -->
<script src="<?php echo base_url();?>assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
<script type="text/javascript">
	$(document).ready(function () {
		$("#mytable").dataTable();
	});
</script>
