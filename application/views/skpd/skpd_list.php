

<!-- setting tombol tambah data -->

<div class="row" style="margin-bottom: 10px">            
	<div class="col-md-4 text-left">
		<?php echo anchor(site_url('skpd/create'), 'Tambah Data', 'class="btn btn-primary"'); ?>
		<?php echo anchor(site_url('skpd/pdf'), 'PDF', 'class="btn btn-warning"'); ?>
			
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
							<th>Nama Skpd</th>
							<th>Klasifikasi</th>
							<th style="text-align:center">Aksi</th>
						</tr>
					</thead>
					<tbody>
					<?php
						$start = 0;
						foreach ($skpd_data as $skpd){
					?>
						<tr>
							<td><?php echo ++$start ?></td>
							<td><?php echo $skpd->nama_skpd ?></td>
							<td><?php echo $skpd->nama_klasifikasi ?></td>
							 <td style="text-align:center" width="120px">
							<?php 
								echo anchor(site_url('skpd/read/'.$skpd->id_skpd),'<i class="fa fa-eye"></i>', 'title="Lihat" class="btn btn-info btn-sm"'); 
								echo '  '; 
								echo anchor(site_url('skpd/update/'.$skpd->id_skpd),'<i class="fa fa-pencil-square-o"></i>', 'title="Update" class="btn btn-warning btn-sm"'); 
								echo '  '; 
								echo anchor(site_url('skpd/delete/'.$skpd->id_skpd),'<i class="fa fa-trash-o"></i>', 'title="Hapus" class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
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
