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
						<td><label for="varchar">Nama Skpd <?php echo form_error('nama_skpd') ?></label></td>
						<td><input type="text" class="form-control" name="nama_skpd" id="nama_skpd" placeholder="Nama Skpd" value="<?php echo $nama_skpd; ?>" /></td>
					</tr>

					<tr>
						<td><label for="tinyint">Klasifikasi </label></td>
						<?php $id = $id_klasifikasi ?>
						<td><?php echo cmb_dinamiss2('id_klasifikasi','klasifikasi','nama_klasifikasi','id_klasifikasi',$id)?></td>
					</tr>
					<input type="hidden" name="id_skpd" value="<?php echo $id_skpd; ?>" />
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
							<button type="submit" id="submit" class="btn btn-primary"><?php echo $button ?></button>
							<a href="<?php echo site_url('Skpd') ?>" class="btn btn-danger">Cancel</a>
						</td>
					</tr>
				</table>
			</form>
			<div id="loading" class="overlay" style="display: none;">
              <i class="fa fa-refresh fa-spin"></i>
            </div>
		</div>
	</div>
</div>

<!-- jQuery 2.2.3 -->
<script src="<?php echo base_url();?>assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
<script type="text/javascript">
	$(document).ready(function () {
		$("#nama_skpd").focus();
		$('#id_klasifikasi').select2({
			placeholder: "Pilih Klasifikasi SKPD",
			allowClear:	true,
		}).data('select2').listeners['*'].push(function(name, target) {
			if(name == 'focus') {
				$(this.$element).select2("open");
			}
		});
		$("#submit").click(function(){
			$("#loading").show();
		});
	});
</script>
