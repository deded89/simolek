

<!-- setting tombol tambah data -->

<div class="row" style="margin-bottom: 10px">
	<div class="col-md-4 text-left">
		<?php echo anchor(site_url('jabatan/create'), 'Tambah Data', 'class="btn btn-primary"'); ?>
		<?php echo anchor(site_url('jabatan/pdf'), 'PDF', 'class="btn btn-warning"'); ?>

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
							<th>Level Jabatan</th>
							<th>Nama Jabatan</th>
							<th>SKPD</th>
							<th>Nama Pegawai</th>
							<th>Username</th>
							<th style="text-align:center">Aksi</th>
						</tr>
					</thead>
					<tbody>
					<?php
						$start = 0;
						foreach ($jabatan_data as $jabatan){
					?>
						<tr>
							<td><?php echo ++$start ?></td>
							<td><?php echo $jabatan->nama_level ?></td>
							<td><?php echo $jabatan->nama_jab ?></td>
							<td><?php echo $jabatan->nama_skpd ?></td>
							<td><?php echo $jabatan->nama_lengkap ?></td>
							<td><?php echo $jabatan->username ?></td>
							<td style="text-align:center" width="160px">
							<?php

								echo anchor(site_url('jabatan/read/'.$jabatan->id_jab),'<i class="fa fa-eye"></i>', 'title="Lihat" class="btn btn-info btn-sm"');
								echo '  ';
								echo anchor(site_url('jabatan/update/'.$jabatan->id_jab),'<i class="fa fa-pencil-square-o"></i>', 'title="Update" class="btn btn-warning btn-sm"');
								echo '  ';
								echo anchor(site_url('jabatan/delete/'.$jabatan->id_jab),'<i class="fa fa-trash-o"></i>', 'title="Hapus" class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Are You Sure ?\')"');
								if ($jabatan->id <>''){
								echo ' ';
								echo anchor(site_url("auth/my_reset_pass/".$jabatan->id),'<i class="fa fa-recycle"></i>', 'title="Reset Password" class="btn btn-success btn-sm" onclick="javasciprt: return confirm(\'Are You Sure ?\')"');
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
