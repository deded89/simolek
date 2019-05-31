

<!-- setting tombol tambah data -->


<!-- isi halaman -->
<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
			<div class="box-body table-responsive">
				<table class="table table-bordered table-striped" id="kontrak_table">
				   <thead>
						<tr>
							<th width="30px">No</th>
							<th>Nomor</th>
							<th>Tanggal</th>
							<th>Penyedia</th>
							<th>Lama</th>
							<th>Awal</th>
							<th>Akhir</th>
							<th>Ket</th>
							<th style="text-align:center">Aksi</th>
						</tr>
					</thead>
					<tbody>
					<?php
						$start = 0;
						foreach ($kontrak_data as $kontrak){
					?>
						<tr>
							<td><?php echo ++$start ?></td>
							<td><?php echo $kontrak->nomor ?></td>
							<td><?php echo $kontrak->tanggal ?></td>
							<td><?php echo $kontrak->penyedia ?></td>
							<td><?php echo $kontrak->lama ?></td>
							<td><?php echo $kontrak->awal ?></td>
							<td><?php echo $kontrak->akhir ?></td>
							<td><?php echo $kontrak->ket ?></td>
							 <td style="text-align:center" width="120px">
							<?php
								// echo anchor(site_url('pengadaan/kontrak/read/'.$kontrak->id),'<i class="fa fa-eye"></i>', 'title="Lihat" class="btn btn-info btn-sm"');
								// echo '  ';
								echo anchor(site_url('pengadaan/kontrak/update/'.$kontrak->id),'<i class="fa fa-pencil-square-o"></i>', 'title="Update" class="btn btn-warning btn-sm"');
								echo '  ';
								echo anchor(site_url('pengadaan/kontrak/delete/'.$kontrak->id),'<i class="fa fa-trash-o"></i>', 'title="Hapus" class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Are You Sure ?\')"');
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
<div class="row" style="margin-bottom: 10px">
	<div class="col-md-4 text-left">
		<?php echo anchor(site_url('pengadaan/kontrak/pdf'), 'Cetak PDF', 'class="btn btn-sm btn-warning"'); ?>

	</div>
</div>
<!-- jQuery 2.2.3 -->
<script src="<?php echo base_url();?>assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
<script type="text/javascript">
	$(document).ready(function () {
		$("#kontrak_table").dataTable();
	});
</script>
