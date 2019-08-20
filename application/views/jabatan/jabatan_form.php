<head>
  <!-- Theme style -->
<link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/AdminLTE.min.css">
</head>
<?php echo form_error('nama_jab') ?>
<?php echo form_error('id_level') ?>
<?php echo form_error('id_skpd') ?>
<?php echo form_error('nip') ?>
<div class='row'>
	<div class='col-xs-12'>
	    <div class='box box-primary'>
			<form action="<?php echo $action; ?>" method="post">
				<table class='table table-bordered'>
					<tr>
						<td width="200px"><label for="varchar">Nama Jabatan </label></td>
						<td><input type="text" class="form-control" name="nama_jab" id="nama_jab" placeholder="Nama Jab" value="<?php echo $nama_jab; ?>" /></td>
					</tr>
					<tr>
						<td><label for="tinyint">Level Jabatan </label></td>
						<!-- combo dinamis -->
						<?php $id = $id_level; ?>
						<td><?php echo cmb_dinamiss2('id_level','level_jabatan','nama_level','id_level',$id) ?></td>
						<!-- akhir combo dinamis -->
					</tr>
					<tr>
						<td><label for="tinyint">Nama SKPD </label></td>
						<!-- combo dinamis -->
						<?php if (!$this->ion_auth->in_group('admin')) {
									$id = $this->session->userdata('id_skpd');
								} else {
									$id = $id_skpd;
								} ?>
						<td><?php echo cmb_dinamiss3('id_skpd','skpd','nama_skpd','id_skpd',$id,'id_skpd','id_skpd','id_skpd') ?></td>
						<!-- akhir combo dinamis -->
					</tr>
					<tr>
						<td><label for="tinyint">Nama Pegawai </label></td>
						<!-- combo dinamis -->
						<?php $id = $nip; ?>
						<td><?php echo cmb_dinamiss3('nip','pegawai','nama_lengkap','nip',$id,'id_skpd','id_skpd','id_skpd
						') ?></td>
						<!-- akhir combo dinamis -->
					</tr>

					<input type="hidden" name="id_jab" value="<?php echo $id_jab; ?>" />
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
							<a href="<?php echo site_url('Jabatan') ?>" class="btn btn-danger">Cancel</a>
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
		$("#nama_jab").focus();
		$('#id_level').select2({
			placeholder: "Pilih Level Jabatan",
			allowClear:	true,
		});
		$('#id_skpd').select2({
			placeholder: "Pilih SKPD Jabatan",
			allowClear:	true,
		});
		$('#nip').select2({
			placeholder: "Pilih Pegawai",
			allowClear:	true,
		});
});

</script>
