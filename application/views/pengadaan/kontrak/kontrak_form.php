<div class='row'>
	<div class='col-xs-12'>
	    <div class='box box-primary'>
			<form action="<?php echo $action; ?>" method="post">
				<table class='table table-bordered'>

					<tr <?php echo $hidden ?> >
						<td><label for="varchar">Nomor <?php echo form_error('nomor') ?></label></td>
						<td><input autofocus type="text" class="form-control" name="nomor" id="nomor" placeholder="Nomor" value="<?php echo $nomor; ?>" /></td>
					</tr>

					<tr <?php echo $hidden ?> >
						<td><label for="date">Tanggal <?php echo form_error('tanggal') ?></label></td>
						<td>
							<div class="input-group date">
								<div class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</div>
								<input type="text" class="form-control pull-right" name="tanggal" id="tanggal" placeholder="Tanggal Kontrak" value="<?php echo $tanggal; ?>" autocomplete="off" >
							</div>
						</td>
					</tr>

					<tr>
						<td><label for="varchar">Penyedia <?php echo form_error('penyedia') ?></label></td>
						<td><input type="text" class="form-control" name="penyedia" id="penyedia" placeholder="Penyedia" value="<?php echo $penyedia; ?>" /></td>
					</tr>

					<tr>
						<td><label for="varchar">Nilai Kontrak <?php echo form_error('nilai') ?></label></td>
						<td><input type="number" class="form-control" name="nilai" id="nilai" placeholder="Nilai Kontrak" value="<?php echo $nilai; ?>" step='any' min=0/></td>
					</tr>

					<tr>
						<td><label for="date">Tanggal Awal <?php echo form_error('awal') ?></label></td>
						<td>
							<div class="input-group date">
								<div class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</div>
								<input type="text" tabindex="-1" class="form-control pull-right" name="awal" id="awal" placeholder="Tanggal Awal Pelaksanaan" value="<?php echo $awal; ?>" autocomplete="off" >
							</div>
						</td>
					</tr>

					<tr>
						<td><label for="date">Tanggal Akhir <?php echo form_error('akhir') ?></label></td>
						<td>
							<div class="input-group date">
								<div class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</div>
								<input type="text" class="form-control pull-right" name="akhir" id="akhir" placeholder="Tanggal Akhir Pelaksanaan" value="<?php echo $akhir; ?>" autocomplete="off" >
							</div>
						</td>
					</tr>

					<tr>
						<td><label for="varchar">Lama Pelaksanaan <?php echo form_error('lama') ?></label></td>
						<td><input type="text" class="form-control" tabindex="-1" name="lama" id="lama" placeholder="Hari" readonly value="<?php echo $lama; ?>"/></td>
					</tr>

					<tr>
						<td><label for="varchar">Keterangan <?php echo form_error('ket') ?></label></td>
						<td><input type="text" class="form-control" name="ket" id="ket" placeholder="Keterangan, misal :addendum" value="<?php echo $ket; ?>" /></td>
					</tr>

					<input type="hidden" name="id_k" value="<?php echo $id_k; ?>" />
					<input type="hidden" name="id_p" value="<?php echo $id_p; ?>" />
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
							<a href="<?php echo site_url('pengadaan/pekerjaan/read/'.$id_p) ?>" class="btn btn-danger">Cancel</a>
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


// xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
// xx                                                                             xx
// xx              SETTING DATEPICKER                                             xx
// xx                                                                             xx
// xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx

		$("#tanggal").datepicker({
			autoclose: true,
			format:'yyyy-mm-dd',
			todayHighlight: true,
			todayBtn: 'linked',
		// })
		// .on('changeDate',function(selected){
		// 	$("#awal").datepicker('setDate',selected.date);
		// 	var mindate = new Date(selected.date.valueOf());
		// 	$("#akhir").datepicker('setStartDate',mindate);
		// 	calcDiff();
		});

		$("#awal").datepicker({
			autoclose: true,
			format:'yyyy-mm-dd',
			todayHighlight: true,
			todayBtn: 'linked',
		})
		.on('changeDate',calcDiff);

		$("#akhir").datepicker({
			autoclose: true,
			format:'yyyy-mm-dd',
			todayHighlight: true,
			todayBtn: 'linked',
		})
		.on('changeDate',calcDiff);

		function calcDiff() {
			if($("#awal").val() != '' && $("#akhir").val() != '' ){
				var date1 = $('#awal').datepicker('getDate');
				var date2 = $('#akhir').datepicker('getDate');
				var diff = 0;
				if (date1 && date2) {
					diff = Math.floor((date2.getTime() - date1.getTime()) / 86400000 + 1);
				}
				if (diff >= 0 ){
					$('#lama').val(diff+" Hari Kalender");
				}else{
						$('#lama').val("Error");
				}
			}
		}

	});



</script>
