<div class='row'>
	<div class='col-xs-12'>
		<div class='box box-info'>
			<div class='box-header with-border bg-aqua'>
				<h3 class='box-title'>Form Tambah Data periode_laporan</h3>
				<a href='<?php echo site_url('Periode_laporan') ?>'>
					<span class='btn btn-danger btn-xs pull-right'><i class='fa fa-arrow-left'></i> Batal</span>
				</a>
			</div>
			<form class='form-horizontal' action="<?php echo $action; ?>" method="post">
        <div class='box-body'>

          <div class='form-group'>
            <label for="date" class='col-sm-2 control-label'>Tanggal</label>
            <div class='col-sm-9'>
              <input autofocus type='text' class='form-control' name='tanggal' id='tanggal' placeholder='Isikan Tanggal' value='<?php echo $tanggal; ?>'>
							<?php echo form_error('tanggal') ?>
            </div>
          </div>

					<input type='hidden' name='id_per_lap' value='<?php echo $tanggal ?>'>
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
		$("#tanggal").focus();
	});
</script>
