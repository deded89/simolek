<div class='row'>
	<div class='col-xs-12'>
		<div class='box box-primary'>
			<form action="<?php echo $action; ?>" method="post">
				<table class='table table-bordered'>
					<input type="hidden" name="pekerjaan" value="1">
					<tr>
						<td><label for="tinyint">Progress saat ini <?php echo form_error('progress') ?></label></td>
						<!-- combo dinamis -->
						<?php $id = $progress; ?>
						<td><?php echo cmb_db2('progress','progress','nama','id',$id) ?></td>
						<!-- akhir combo dinamis -->
					</tr>

					<tr>
						<td><label for="date">Tanggal Progress <?php echo form_error('tgl_progress') ?></label></td>
						<td>
							<div class="input-group date">
								<div class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</div>
								<input type="text" class="form-control pull-right" name="tgl_progress" id="tgl_progress" placeholder="Tanggal Progress" value="<?php echo $tgl_progress; ?>" autocomplete="off" >
							</div>
						</td>
					</tr>

					<tr>
						<td><label for="tinyint">Rencana Berikutnya <?php echo form_error('next_progress') ?></label></td>
						<!-- combo dinamis -->
						<?php $id = $next_progress; ?>
						<td><?php echo cmb_db2('next_progress','progress','nama','id',$id) ?></td>
						<!-- akhir combo dinamis -->
					</tr>

					<tr>
						<td><label for="date">Tangal Next Progress <?php echo form_error('tgl_n_progress') ?></label></td>
						<td>
							<div class="input-group date">
								<div class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</div>
								<input type="text" class="form-control pull-right" name="tgl_n_progress" id="tgl_n_progress" placeholder="Tanggal Next Progress" value="<?php echo $tgl_n_progress; ?>" autocomplete="off" >
							</div>
						</td>
					</tr>

					<tr>
						<td><label for="varchar">Ket <?php echo form_error('ket') ?></label></td>
						<td><input type="text" class="form-control" name="ket" id="ket" placeholder="Ket" value="<?php echo $ket; ?>" /></td>
					</tr>

					<tr>
						<td><label for="decimal">Real Keuangan (Rp. kumulatif) <?php echo form_error('real_keu') ?></label></td>
						<td><input type="number" class="form-control" name="real_keu" id="real_keu" placeholder="xxx,xx" value="<?php echo $real_keu; ?>" step='any' min=0/></td>
					</tr>

					<tr>
						<td><label for="decimal">Real Fisik (% kumulatif) <?php echo form_error('real_fisik') ?></label></td>
						<td><input type="number" class="form-control" name="real_fisik" id="real_fisik" placeholder="xxx,xx" value="<?php echo $real_fisik; ?>" step='any' min=0/></td>
					</tr>

					<tr>
						<td colspan='2'>
							<button type="submit" class="btn btn-primary"><?php echo $button ?></button>
							<a href="<?php echo site_url('pengadaan/progress_pekerjaan') ?>" class="btn btn-danger">Cancel</a>
						</td>
					</tr>
					<input type="hidden" name="id_prog" value="<?php echo $id_prog; ?>" />
					<input type="hidden" name="id_p" value="<?php echo $id_p; ?>" />
				</table>
			</form>
		</div>
	</div>
</div>

<!-- jQuery 2.2.3 -->
<script src="<?php echo base_url();?>assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
<script type="text/javascript">
$(document).ready(function () {
	$("#progress").focus();
	$("#tgl_progress").datepicker({
		autoclose:true,
		format:'yyyy/mm/dd',
	});
	$("#tgl_n_progress").datepicker({
		autoclose:true,
		format:'yyyy/mm/dd',
	});
	$('#progress').select2({
		placeholder: "Pilih Tahapan Progress",
		allowClear:	true,
	});
	$('#next_progress').select2({
		placeholder: "Pilih Tahapan Progress",
		allowClear:	true,
	});
});
</script>
