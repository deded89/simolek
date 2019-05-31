

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
							<td style="text-align:center" width="160px">
							<?php 							
							if($laporan->id_jab == $this->session->userdata('id_jab'))
							{	
								echo anchor(site_url('laporan/read/'.$laporan->id_lap),'<i class="fa fa-eye"></i>', 'title="Detail" class="btn btn-info btn-sm"'); 
								echo '  '; 
								echo anchor(site_url('laporan/update/'.$laporan->id_lap),'<i class="fa fa-pencil-square-o"></i>', 'title="Update" class="btn btn-warning btn-sm"'); 
								echo '  '; 
								echo anchor(site_url('laporan/delete/'.$laporan->id_lap),'<i class="fa fa-trash-o"></i>', 'title="Hapus" class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Semua Data yang Sudah Diupload Pelapor Akan Terhapus, Anda Yakin ?\')"'); 
								echo '  '; 
								echo anchor(site_url('dashboard/lihat_status_by_koordinator/'.$laporan->id_lap),'<i class="fa fa-search"></i>', 'title="Status Pelaporan" class="btn btn-primary btn-sm"'); 
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
