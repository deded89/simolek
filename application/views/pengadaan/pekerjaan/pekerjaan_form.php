<div class='row'>
	<div class='col-xs-12'>
	    <div class='box box-primary'>
			<form action="<?php echo $action; ?>" method="post">
				<table class='table table-bordered'>

					<tr>
						<td><label for="varchar">Nama Paket<?php echo form_error('nama') ?></label></td>
						<td><input type="text" class="form-control" name="nama" id="nama" placeholder="Nama Paket" value="<?php echo $nama; ?>" /></td>
					</tr>

					<tr>
						<td><label for="varchar">Kegiatan <?php echo form_error('kegiatan') ?></label></td>
						<td><input type="text" class="form-control" name="kegiatan" id="kegiatan" placeholder="Kegiatan" value="<?php echo $kegiatan; ?>" /></td>
					</tr>

					<tr>
						<td><label for="mediumint">Skpd <?php echo form_error('skpd') ?></label></td>
						<!-- <td><input type="text" class="form-control" name="skpd" id="skpd" placeholder="Skpd" value="<?php //echo $skpd; ?>" /></td>     -->
						<!-- combo dinamis -->
						<?php $id = $skpd; ?>
						<td><?php echo cmb_dinamiss2('skpd','skpd','nama_skpd','id_skpd',$id) ?></td>
						<!-- akhir combo dinamis -->
					</tr>

					<tr>
						<td><label for="tinyint">Jenis Pengadaan<?php echo form_error('jenis') ?></label></td>
						<!-- <td><input type="text" class="form-control" name="jenis" id="jenis" placeholder="Jenis" value="<?php echo $jenis; ?>" /></td> -->
						<!-- combo dinamis -->
						<?php $id_j = $jenis; ?>
						<td><?php echo cmb_db2('jenis','jenis','nama','id',$id_j) ?></td>
						<!-- akhir combo dinamis -->
					</tr>

					<tr>
						<td><label for="tinyint">Metode Pemilihan<?php echo form_error('metode') ?></label></td>
						<!-- <td><input type="text" class="form-control" name="metode" id="metode" placeholder="Metode" value="<?php echo $metode; ?>" /></td> -->
						<!-- combo dinamis -->
						<?php $id_m = $metode; ?>
						<td><?php echo cmb_db2('metode','metode','nama','id',$id_m) ?></td>
						<!-- akhir combo dinamis -->
					</tr>

					<tr>
						<td><label for="decimal">Pagu <?php echo form_error('pagu') ?></label></td>
						<td><input type="number" class="form-control" name="pagu" id="pagu" placeholder="xxx,xx" value="<?php echo $pagu; ?>" step='any' min=0 /></td>
					</tr>

					<input type="hidden" name="id" value="<?php echo $id_p; ?>" />
					<tr>
						<td colspan='2'>
							<button type="submit" class="btn btn-primary"><?php echo $button ?></button>
							<a href="<?php echo site_url('pengadaan/pekerjaan') ?>" class="btn btn-danger">Cancel</a>
						</td>
					</tr>
				</table>
			</form>
		</div>
	</div>
</div>

<!-- jQuery 2.2.3 -->
<script src="<?php echo base_url();?>assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
<script type="text/javascript">
	$(document).ready(function () {
		$("#nama").focus();
		$('select').on(
    'select2:close',
    function () {
        $(this).focus();
    }
	);
		$('#skpd').select2({
			placeholder: "Pilih SKPD",
			allowClear:	true,
		});
		$('#jenis').select2({
			placeholder: "Pilih Jenis Pengadaan",
			allowClear:	true,
		});
		$('#metode').select2({
			placeholder: "Pilih Metode Pengadaan",
			allowClear:	true,
		});
	});
</script>
