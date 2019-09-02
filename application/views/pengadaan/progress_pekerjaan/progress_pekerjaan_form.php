<div class='row'>
	<div class='col-xs-12'>
		<div class='box box-primary'>
			<form action="<?php echo $action; ?>" method="post">
				<table class='table table-bordered'>
					<input type="hidden" name="pekerjaan" value="1">
					<tr>
						<td><label for="tinyint">Progress saat ini </label></td>
						<!-- combo dinamis -->
						<?php $id = $progress; ?>
						<td><?php echo cmb_db2('progress','progress','nama','id',$id) ?><?php echo form_error('progress') ?></td>
						<!-- akhir combo dinamis -->
					</tr>

					<tr>
						<td><label for="date">Tanggal Progress </label></td>
						<td>
							<div class="input-group date">
								<div class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</div>
								<input type="text" class="form-control pull-right" name="tgl_progress" id="tgl_progress" placeholder="Tanggal Progress" value="<?php echo $tgl_progress; ?>" autocomplete="off" >
							</div>
							<?php echo form_error('tgl_progress') ?>
						</td>
					</tr>

					<tr>
						<td><label for="varchar">Keterangan </label></td>
						<td><input type="text" class="form-control" name="ket" id="ket" placeholder="Detail Progress Saat ini" value="<?php echo $ket; ?>" /><?php echo form_error('ket') ?></td>
					</tr>

					<tr>
						<td><label for="tinyint">Rencana Berikutnya</label></td>
						<!-- combo dinamis -->
						<?php $id = $next_progress; ?>
						<td><?php echo cmb_db2('next_progress','progress','nama','id',$id) ?> <?php echo form_error('next_progress') ?></td>
						<!-- akhir combo dinamis -->
					</tr>

					<tr>
						<td><label for="date">Tangal Next Progress </label></td>
						<td>
							<div class="input-group date">
								<div class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</div>
								<input type="text" class="form-control pull-right" name="tgl_n_progress" id="tgl_n_progress" placeholder="Tanggal Next Progress" value="<?php echo $tgl_n_progress; ?>" autocomplete="off" >
							</div>
							<?php echo form_error('tgl_n_progress') ?>
						</td>
					</tr>

					<tr>
						<td><label for="decimal">Real Keuangan (Rp. kumulatif) </label></td>
						<td><input type="number" class="form-control" name="real_keu" id="real_keu" placeholder="xxx,xx" value="<?php echo $real_keu; ?>" step='any' min=0/><?php echo form_error('real_keu') ?></td>
					</tr>

					<tr>
						<td><label for="decimal">Real Fisik (% kumulatif)</label></td>
						<td><input type="number" class="form-control" name="real_fisik" id="real_fisik" placeholder="xxx,xx" value="<?php echo $real_fisik; ?>" step='any' min=0/> <?php echo form_error('real_fisik') ?></td>
					</tr>

					<tr>
						<td colspan='2'>
							<button type="submit" class="btn btn-primary"><?php echo $button ?></button>
							<a href="<?php echo site_url('pengadaan/pekerjaan/read/'.$id_p) ?>" class="btn btn-danger">Cancel</a>
						</td>
					</tr>
					<input type="hidden" name="id_prog" value="<?php echo $id_prog; ?>" />
					<input type="hidden" name="id_p" value="<?php echo $id_p; ?>" />
					<!-- CSRF TOKEN -->
					<?php
						$csrf = array(
							'name' => $this->security->get_csrf_token_name(),
							'hash' => $this->security->get_csrf_hash()
						);
					?>
					<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
				</table>
			</form>
		</div>
	</div>
</div>

<!-- PANDUAN PENGISIAN -->
<div class="row">
	<div class="col-xs-12">
		<div class="box box-primary box-solid collapsed-box">
			<div class="box-header with-border bg-aqua">
				<h4 class="box-title">
					<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" class="">
						Panduan Pengisian
					</a>
				</h4>
				<div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
          </button>
        </div>
			</div>
			<div class="box-body">
				<ul>
					<li>Penjelasan Progress :</li>
						<ol>
							<li><strong>Persiapan, </strong>adalah progress ketika pekerjaan dalam proses seperti penetapan HPS, Penetapan KAK, Pengajuan ke LPSE, penyusunan rancangan kontrak dll.</li>
							<li><strong>Pemilihan Penyedia, </strong>adalah progress ketika pekerjaan dalam proses pengumuman tender/ seleksi (tayang di LPSE untuk tender dan seleksi) untuk melihat pekerjaan yang sudah diumumkan tender/ seleksi lihat pada web <a href="http://lpse.banjarmasinkota.go.id/eproc4">LPSE Kota Banjarmasin</a>.</li>
							<li><strong>Hasil Pemilihan, </strong>adalah progress penyedia sudah ditetapkan (Penetapan Surat Penunjukan Penyedia Barang/Jasa).</li>
							<li><strong>Kontrak, </strong>adalah progress ketika sudah dilakukan penandatanganan kontrak dengan penyedia.</li>
							<li><strong>Serah Terima (PHO), </strong>adalah progress ketika fisik pekerjaan sudah diselesaikan 100 % oleh penyedia dan sudah dilakukan penyerahan hasil pekerjaan kepada PPK.</li>
							<li><strong>Serah Terima Akhir (FHO), </strong>adalah progress ketika masa pemeliharaan pekerjaan (masa garansi untuk pengadaan barang) sudah berakhir.</li>
							<li><strong>Dibatalkan, </strong>adalah progress ketika pekerjaan tidak jadi dilaksanakan (mohon tambahkan alasan pembatalan di kolom keterangan).</li>
						</ol>
						<br>
					<li>Penjelasan untuk field Keterangan : </li>
						<ul>
							<li>Diisi dengan penjelasan detail dari progress saat ini.</li>
						</ul>
						<br>
					<li>Penjelasan Realisasi Keuangan : </li>
						<ul>
							<li>Diisi dengan nilai rupiah realisasi keuangan <strong>KUMULATIF</strong> dengan format pengisian adalah angka tanpa spasi, jika desimal tambahkan tanda koma (',') maksimal 2 angka desimal</li>
						</ul>
						<br>
					<li>Penjelasan Realisasi Fisik : </li>
						<ul>
							<li>Diisi dengan nilai persen realisasi fisik <strong>KUMULATIF</strong> dengan format pengisian adalah angka tanpa spasi, jika desimal tambahkan tanda koma (',') maksimal 2 angka desimal</li>
						</ul>
				</ul>
			</div>
		</div>
	</div>
</div>

<!-- jQuery 2.2.3 -->
<script src="<?php echo base_url();?>assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
<script type="text/javascript">
$(document).ready(function () {
	$("#progress").focus();

// xxxxxxxxxxxxxxxxxxxxxxxxxxxxx DATE PICKER XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX

	$("#tgl_progress").datepicker({
		autoclose:true,
		format:'yyyy-mm-dd',
		todayHighlight:true,
		todayBtn:'linked',
		endDate: 'today',
		orientation: "bottom",
	})
	.on('changeDate',function(selected){
		var mindate = new Date(selected.date.valueOf());
		$("#tgl_n_progress").datepicker('setStartDate',mindate);
	});

	$("#tgl_n_progress").datepicker({
		autoclose:true,
		format:'yyyy-mm-dd',
		todayHighlight:true,
		todayBtn:'linked',
	});

// xxxxxxxxxxxxxxxxxxxxxxx SELECT 2  XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX

	$('#progress').select2({
		placeholder: "Pilih Tahapan Progress",
		allowClear:	true,
	})
	.on('change',setNext);

	function setNext(){
		var now = $('#progress').val();
		var next = parseInt(now)+1;
		$('#next_progress').val(next.toString());
		$('#next_progress').select2().trigger('change');
	};

	$('#next_progress').select2({
		placeholder: "Pilih Tahapan Progress",
		allowClear:	true,
	});
});
</script>
