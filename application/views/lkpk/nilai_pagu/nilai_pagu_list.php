<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<h3 class="box-title">Nilai Pagu Kegiatan Berdasarkan Periode</h3>
			</div>
			<div class="box-body table-responsive no-padding">
				<table class="table table-hover">
					<tbody>
					<tr>
						<th>No</th>
						<th>Keterangan</th>
						<th>Periode</th>
						<th>Nilai</th>
						<th style="text-align:center">Aksi</th>
					</tr>
					<tr>
						<?php
						$start = 0;
						foreach ($nilai_pagu_data as $nilai_pagu){
							?>
							<tr>
								<td><?php echo ++$start ?></td>
								<td><?php echo $nilai_pagu->keterangan ?></td>
								<td><?php echo $nilai_pagu->tanggal ?></td>
								<td><?php echo "Rp " . number_format($nilai_pagu->nilai,2,',','.');  ?></td>
								<td style="text-align:center" width="150px">
									<?php
									echo anchor(site_url('lkpk/nilai_pagu/update/'.$nilai_pagu->id_nilai_pagu),'<i class="fa fa-pencil-square-o"></i>', 'title="Update" class="btn btn-warning btn-sm"');
									echo '  ';
									echo anchor(site_url('lkpk/nilai_pagu/delete/'.$nilai_pagu->id_nilai_pagu."/".$nilai_pagu->kegiatan),'<i class="fa fa-trash-o"></i>', 'title="Hapus" class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Are You Sure ?\')"');
									echo '  ';
									echo anchor(site_url('lkpk/ren_real/perkegiatan/'.$nilai_pagu->kegiatan."/".$nilai_pagu->periode_pagu),'<i class="fa fa-eye"></i>', 'title="Rencana dan Realisasi" class="btn btn-info btn-sm"');
									?>
								</td>
							</tr>
							<?php
						}
						?>
					</tr>
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
	});
</script>
