

<!-- setting tombol tambah data -->

<div class="row" style="margin-bottom: 10px">
	<div class="col-md-4 text-left">
		<?php echo anchor(site_url('lkpk/periode_setting/create'), 'Tambah Data', 'class="btn btn-primary"'); ?>

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
							<th>Tahun</th>
							<th>Skpd</th>
							<th>B01</th>
							<th>B02</th>
							<th>B03</th>
							<th>B04</th>
							<th>B05</th>
							<th>B06</th>
							<th>B07</th>
							<th>B08</th>
							<th>B09</th>
							<th>B10</th>
							<th>B11</th>
							<th>B12</th>
							<th style="text-align:center">Aksi</th>
						</tr>
					</thead>
					<tbody>
					<?php
						$start = 0;
						foreach ($periode_setting_data as $periode_setting){
					?>
						<tr>
							<td><?php echo ++$start ?></td>
							<td><?php echo $periode_setting->tahun ?></td>
							<td><?php echo $periode_setting->nama_skpd ?></td>
							<td><?php echo $periode_setting->keterangan1 ?></td>
							<td><?php echo $periode_setting->keterangan2 ?></td>
							<td><?php echo $periode_setting->keterangan3 ?></td>
							<td><?php echo $periode_setting->keterangan4 ?></td>
							<td><?php echo $periode_setting->keterangan5 ?></td>
							<td><?php echo $periode_setting->keterangan6 ?></td>
							<td><?php echo $periode_setting->keterangan7 ?></td>
							<td><?php echo $periode_setting->keterangan8 ?></td>
							<td><?php echo $periode_setting->keterangan9 ?></td>
							<td><?php echo $periode_setting->keterangan10 ?></td>
							<td><?php echo $periode_setting->keterangan11 ?></td>
							<td><?php echo $periode_setting->keterangan12 ?></td>
							 <td style="text-align:center" width="120px">
							<?php
								echo anchor(site_url('lkpk/periode_setting/read/'.$periode_setting->id_per_setting),'<i class="fa fa-eye"></i>', 'title="Lihat" class="btn btn-info btn-sm"');
								echo '  ';
								echo anchor(site_url('lkpk/periode_setting/update/'.$periode_setting->id_per_setting),'<i class="fa fa-pencil-square-o"></i>', 'title="Update" class="btn btn-warning btn-sm"');
								echo '  ';
								echo anchor(site_url('lkpk/periode_setting/delete/'.$periode_setting->id_per_setting),'<i class="fa fa-trash-o"></i>', 'title="Hapus" class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Are You Sure ?\')"');
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
