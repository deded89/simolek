<div class='row'>
	<div class='col-xs-12'>
		<div class='box box-info'>
			<div class='box-header with-border bg-aqua'>
				<h3 class='box-title'>Form Tambah Data periode_setting</h3>
				<a href='<?php echo site_url('lkpk/Periode_setting') ?>'>
					<span class='btn btn-danger btn-xs pull-right'><i class='fa fa-arrow-left'></i> Batal</span>
				</a>
			</div>
			<form class='form-horizontal' action="<?php echo $action; ?>" method="post">
        <div class='box-body'>

					<div class="form-group">
						<label for="varchar" class="col-sm-2 control-label">Pilih Tahun Anggaran</label>
						<div class="col-sm-9">
							<select class="form-control" name="tahun" id="tahun">
								<option value="2019">2019</option>
								<option value="2020">2020</option>
							</select>
						</div>
					</div>

					<div class='form-group'>
						<label for="varchar" class='col-sm-2 control-label'>Pilih SKPD</label>
						<div class='col-sm-9'>
							<?php $id = $skpd; ?>
							<?php echo cmb_dinamiss2('skpd','skpd','nama_skpd','id_skpd',$id) ?>
							<?php echo form_error('skpd') ?>
						</div>
					</div>

					<div class='form-group'>
						<label for="varchar" class='col-sm-2 control-label'>Januari</label>
						<div class='col-sm-9'>
							<?php $id = $b01; ?>
							<?php echo cmb_db3('b01','periode_pagu','keterangan','id_per_pagu',$b01) ?>
							<?php echo form_error('b01') ?>
						</div>
					</div>

					<div class='form-group'>
						<label for="varchar" class='col-sm-2 control-label'>Pebruari</label>
						<div class='col-sm-9'>
							<?php $id = $b02; ?>
							<?php echo cmb_db3('b02','periode_pagu','keterangan','id_per_pagu',$b02) ?>
							<?php echo form_error('b02') ?>
						</div>
					</div>

					<div class='form-group'>
						<label for="varchar" class='col-sm-2 control-label'>Maret</label>
						<div class='col-sm-9'>
							<?php $id = $b03; ?>
							<?php echo cmb_db3('b03','periode_pagu','keterangan','id_per_pagu',$b03) ?>
							<?php echo form_error('b03') ?>
						</div>
					</div>

					<div class='form-group'>
						<label for="varchar" class='col-sm-2 control-label'>April</label>
						<div class='col-sm-9'>
							<?php $id = $b04; ?>
							<?php echo cmb_db3('b04','periode_pagu','keterangan','id_per_pagu',$b04) ?>
							<?php echo form_error('b04') ?>
						</div>
					</div>

					<div class='form-group'>
						<label for="varchar" class='col-sm-2 control-label'>Mei</label>
						<div class='col-sm-9'>
							<?php $id = $b05; ?>
							<?php echo cmb_db3('b05','periode_pagu','keterangan','id_per_pagu',$b05) ?>
							<?php echo form_error('b05') ?>
						</div>
					</div>

					<div class='form-group'>
						<label for="varchar" class='col-sm-2 control-label'>Juni</label>
						<div class='col-sm-9'>
							<?php $id = $b06; ?>
							<?php echo cmb_db3('b06','periode_pagu','keterangan','id_per_pagu',$b06) ?>
							<?php echo form_error('b06') ?>
						</div>
					</div>

					<div class='form-group'>
						<label for="varchar" class='col-sm-2 control-label'>Juli</label>
						<div class='col-sm-9'>
							<?php $id = $b07; ?>
							<?php echo cmb_db3('b07','periode_pagu','keterangan','id_per_pagu',$b07) ?>
							<?php echo form_error('b07') ?>
						</div>
					</div>

					<div class='form-group'>
						<label for="varchar" class='col-sm-2 control-label'>Agustus</label>
						<div class='col-sm-9'>
							<?php $id = $b08; ?>
							<?php echo cmb_db3('b08','periode_pagu','keterangan','id_per_pagu',$b08) ?>
							<?php echo form_error('b08') ?>
						</div>
					</div>

					<div class='form-group'>
						<label for="varchar" class='col-sm-2 control-label'>September</label>
						<div class='col-sm-9'>
							<?php $id = $b09; ?>
							<?php echo cmb_db3('b09','periode_pagu','keterangan','id_per_pagu',$b09) ?>
							<?php echo form_error('b09') ?>
						</div>
					</div>

					<div class='form-group'>
						<label for="varchar" class='col-sm-2 control-label'>Oktober</label>
						<div class='col-sm-9'>
							<?php $id = $b10; ?>
							<?php echo cmb_db3('b10','periode_pagu','keterangan','id_per_pagu',$b10) ?>
							<?php echo form_error('b10') ?>
						</div>
					</div>

					<div class='form-group'>
						<label for="varchar" class='col-sm-2 control-label'>Nopember</label>
						<div class='col-sm-9'>
							<?php $id = $b11; ?>
							<?php echo cmb_db3('b11','periode_pagu','keterangan','id_per_pagu',$b11) ?>
							<?php echo form_error('b11') ?>
						</div>
					</div>

					<div class='form-group'>
						<label for="varchar" class='col-sm-2 control-label'>Desember</label>
						<div class='col-sm-9'>
							<?php $id = $b12; ?>
							<?php echo cmb_db3('b12','periode_pagu','keterangan','id_per_pagu',$b12) ?>
							<?php echo form_error('b12') ?>
						</div>
					</div>


					<input type='hidden' name='id_per_setting' value='<?php echo $id_per_setting ?>'>
	        <!-- CSRF TOKEN -->
	        <?php
	          $csrf = array(
	            'name' => $this->security->get_csrf_token_name(),
	            'hash' => $this->security->get_csrf_hash()
	          );
	        ?>
	        <input type='hidden' name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
					<div class='col-xs-12 text-center'>
						<input type='submit' name='simpan' value='Simpan' class='btn btn-info'>
					</div>
				</div>
    	</form>
		</div>
	</div>
</div>

<!-- jQuery 2.2.3 -->
<script src="<?php echo base_url();?>assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
<script type="text/javascript">
$(document).ready(function () {
	$('#skpd').select2({
		placeholder: "Pilih SKPD",
		allowClear:	true,
	});
	$('#tahun').select2({
		placeholder: "Pilih Tahun Anggaran",
		allowClear:	true,
	});
	$('#b01').select2({
		placeholder: "Pilih Tahun Anggaran",
		allowClear:	true,
	});
	$('#b02').select2({
		placeholder: "Pilih Tahun Anggaran",
		allowClear:	true,
	});
	$('#b03').select2({
		placeholder: "Pilih Tahun Anggaran",
		allowClear:	true,
	});
	$('#b04').select2({
		placeholder: "Pilih Tahun Anggaran",
		allowClear:	true,
	});
	$('#b05').select2({
		placeholder: "Pilih Tahun Anggaran",
		allowClear:	true,
	});
	$('#b06').select2({
		placeholder: "Pilih Tahun Anggaran",
		allowClear:	true,
	});
	$('#b07').select2({
		placeholder: "Pilih Tahun Anggaran",
		allowClear:	true,
	});
	$('#b08').select2({
		placeholder: "Pilih Tahun Anggaran",
		allowClear:	true,
	});
	$('#b09').select2({
		placeholder: "Pilih Tahun Anggaran",
		allowClear:	true,
	});
	$('#b10').select2({
		placeholder: "Pilih Tahun Anggaran",
		allowClear:	true,
	});
	$('#b11').select2({
		placeholder: "Pilih Tahun Anggaran",
		allowClear:	true,
	});
	$('#b12').select2({
		placeholder: "Pilih Tahun Anggaran",
		allowClear:	true,
	});

});
</script>
