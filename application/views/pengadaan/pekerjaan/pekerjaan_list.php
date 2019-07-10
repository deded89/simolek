

<!-- setting tombol tambah data -->

<div class="row" style="margin-bottom: 10px">
	<div <?php echo $hidden_attr ?> class="col-md-4 text-left">
		<?php echo anchor(site_url('pengadaan/pekerjaan/create'), 'Tambah Data', 'class="btn btn-primary"'); ?>
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
							<th>Nama</th>
							<th>Kegiatan</th>
							<th>Skpd</th>
							<th>Jenis</th>
							<th>Metode</th>
							<th>Pagu</th>
							<th style="text-align:center">Aksi</th>
						</tr>
					</thead>
					<tbody>
					<?php
						$start = 0;
						foreach ($pekerjaan_data as $pekerjaan){
					?>
						<tr>
							<td><?php echo ++$start ?></td>
							<td><?php echo $pekerjaan->nama ?></td>
							<td><?php echo $pekerjaan->kegiatan ?></td>
							<td><?php echo $pekerjaan->nama_skpd ?></td>
							<td><?php echo $pekerjaan->jenis ?></td>
							<td><?php echo $pekerjaan->metode ?></td>
							<td class="text-right" nowrap><?php echo "Rp " . number_format($pekerjaan->pagu,2,',','.'); ?></td>
							<td style="text-align:center" width="160px">
								<span>
									<a href="<?php echo site_url('pengadaan/pekerjaan/read/'.$pekerjaan->id) ?>" title="Lihat" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>
								</span>
								<span <?php echo $hidden_attr ?>>
									<a href="<?php echo site_url('pengadaan/pekerjaan/update/'.$pekerjaan->id) ?>" title="Update" class="btn btn-warning btn-sm"><i class="fa fa-pencil-square-o"></i></a>
									<a href="<?php echo site_url('pengadaan/pekerjaan/delete/'.$pekerjaan->id) ?>" title="Hapus" class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Are You Sure ?\')"><i class="fa fa-trash-o"></i></i></a>
								</span>
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
	var groupColumn = 3;
	var table = $('#mytable').DataTable({
		"columnDefs": [
			{ "visible": false, "targets": groupColumn }
		],
		// "order": [[ groupColumn, 'asc' ]],
		// "displayLength": 25,
		"drawCallback": function ( settings ) {
			var api = this.api();
			var rows = api.rows( {page:'current'} ).nodes();
			var last=null;

			api.column(groupColumn, {page:'current'} ).data().each( function ( group, i ) {
				if ( last !== group ) {
					$(rows).eq( i ).before(
						'<tr class="group"><td colspan="5"><strong> '+group+' </strong></td></tr>'
					);

					last = group;
				}
			} );
		}
	});
});
</script>
