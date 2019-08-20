<head>
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/AdminLTE.min.css">
</head>

<div class='row'>
	<div class='col-xs-12'>
	    <div class='box box-primary'>
			<form action="<?php echo $action; ?>" method="post">
				<table class='table table-bordered'>

					<tr>
						<td><label for="varchar">Nama Lap <?php echo form_error('nama_lap') ?></label></td>
						<td colspan="2"><input type="text" class="form-control" name="nama_lap" id="nama_lap" placeholder="Nama Lap" value="<?php echo $nama_lap; ?>" /></td>
					</tr>

					<tr>
						<td><label for="date">Batas Waktu <?php echo form_error('batas_waktu') ?></label></td>
						<td>
							<!-- DATEPICKER -->
							<div class="input-group date">
								<div class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</div>
									<input type="text" class="form-control pull-right" name="batas_waktu" id="batas_waktu" placeholder="Batas Waktu" value="<?php echo $batas_waktu; ?>" />
							</div>
							<!-- AKHIR DATEPICKER -->
						</td>
						<td>
							<!-- TIME PICKER -->
							<div class="bootstrap-timepicker">
								  <div class="input-group">
									<input type="text" name="batas_jam" class="form-control timepicker" placeholder="Batas Jam" value="<?php echo $batas_jam; ?>">
									<div class="input-group-addon">
									  <i class="fa fa-clock-o"></i>
									</div>
								  </div>
							</div>
							<!-- AKHIR TIME PICKER -->
						</td>
					</tr>
					<tr>
						<td><label for="tinyint">Koordinator </label></td>
						<?php $id = $id_jab ?>
						<!-- combo dinamis 		     $name,    $table,   $field,    $pk,     $selected,$w1,      $w2,      $sort -->
						<td colspan="2"><?php echo cmb_dinamiss3('id_jab','jabatan','nama_jab','id_jab',$id      ,'id_skpd','id_skpd','id_jab') ?></td>
						<!-- akhir combo dinamis -->
					</tr>
					<input type="hidden" name="status" value="<?php echo $status; ?>" />
					<input type="hidden" name="id_lap" value="<?php echo $id_lap; ?>" />
          <!-- CSRF TOKEN -->
          <?php
            $csrf = array(
              'name' => $this->security->get_csrf_token_name(),
              'hash' => $this->security->get_csrf_hash()
            );
          ?>
          <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
					<tr>
						<td colspan='2'>
							<button type="submit" class="btn btn-primary"><?php echo $button ?></button>
							<a href="<?php echo site_url('Laporan') ?>" class="btn btn-danger">Cancel</a>
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
		$("#nama_lap").focus();
		$('#id_jab').select2({
			placeholder: "Pilih PIC Koordinator Laporan",
			allowClear:	true,
		}).data('select2').listeners['*'].push(function(name, target) {
			if(name == 'focus') {
				$(this.$element).select2("open");
			}
		});
		//Timepicker
		$(".timepicker").timepicker({
			showInputs: false,
			showMeridian:false,
			defaultTime:false,
			showSeconds:true,
		});
	});
	document.getElementById("batas_waktu").onfocusin = function() {getBatasWaktu()};
	function getBatasWaktu() {
		//Date picker tgl_surat
		$('#batas_waktu').datepicker({
			autoclose: true,
			format: 'dd-mm-yyyy',
			startDate: '+0d',
			todayHighlight: true,
			todayBtn: 'linked'
		});
	}
</script>
