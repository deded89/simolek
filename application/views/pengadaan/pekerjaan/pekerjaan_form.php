<div class='row'>
	<div class='col-xs-12'>
		<div class='box box-primary'>
			<div class="box box-body">
				<form action="<?php echo $action; ?>" method="post">
					<div class="form-group">
						<div class="row">
							<div class="col-sm-4">
								<label for="varchar">Nama Paket<?php echo form_error('nama') ?></label>
							</div>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="nama" id="nama" placeholder="Nama Paket" value="<?php echo $nama; ?>" />
							</div>
						</div>
					</div>

					<div class="form-group">
						<div class="row">
							<div class="col-sm-4">
								<label for="varchar">Kegiatan <?php echo form_error('kegiatan') ?></label>
							</div>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="kegiatan" id="kegiatan" placeholder="Kegiatan" value="<?php echo $kegiatan; ?>" />
							</div>
						</div>
					</div>

					<div class="form-group">
						<div class="row">
							<div class="col-sm-4">
								<label for="mediumint">Skpd <?php echo form_error('skpd') ?></label>
							</div>
							<div class="col-sm-8">
								<?php $id = $skpd; ?>
								<?php echo cmb_dinamiss2('skpd','skpd','nama_skpd','id_skpd',$id) ?>
							</div>
						</div>
					</div>

					<div class="form-group">
						<div class="row">
							<div class="col-sm-4">
								<label for="tinyint">Jenis Pengadaan<?php echo form_error('jenis') ?></label>
							</div>
							<div class="col-sm-8">
								<?php $id_j = $jenis; ?>
								<?php echo cmb_db2('jenis','jenis','nama','id',$id_j) ?>
							</div>
						</div>
					</div>

					<div class="form-group">
						<div class="row">
							<div class="col-sm-4">
								<label for="tinyint">Metode Pemilihan<?php echo form_error('metode') ?></label>
							</div>
							<div class="col-sm-8">
								<?php $id_m = $metode; ?>
								<?php echo cmb_db2('metode','metode','nama','id',$id_m) ?>
							</div>
						</div>
					</div>

					<div class="form-group">
						<div class="row">
							<div class="col-sm-4">
								<label for="decimal">Pagu <?php echo form_error('pagu') ?></label>
							</div>
							<div class="col-sm-8">
								<input type="number" class="form-control" name="pagu" id="pagu" placeholder="xxx,xx" value="<?php echo $pagu; ?>" step='any' min=0 />
							</div>
						</div>
					</div>

					<div class="form-group">
						<div class="row">
							<div class="col-sm-4">
								<button type="submit" class="btn btn-primary"><?php echo $button ?></button>
								<a href="<?php echo site_url('pengadaan/pekerjaan') ?>" class="btn btn-danger">Cancel</a>
							</div>
						</div>
					</div>

					<input type="hidden" name="id" value="<?php echo $id_p; ?>" />
				</form>
			</div>
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
