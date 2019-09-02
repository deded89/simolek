<div class='row'>
	<div class='col-xs-12'>
		<div class='box box-info'>
			<div class='box-header with-border bg-aqua'>
				<h3 class='box-title'>Form Tambah Data real_fisik</h3>
				<a href='<?php echo site_url('Real_fisik') ?>'>
					<span class='btn btn-danger btn-xs pull-right'><i class='fa fa-arrow-left'></i> Batal</span>
				</a>
			</div>
			<form class='form-horizontal' action="<?php echo $action; ?>" method="post">
        <div class='box-body'>

          <div class='form-group'>
            <label for="decimal" class='col-sm-2 control-label'>Nilai</label>
            <div class='col-sm-9'>
              <input autofocus type='text' class='form-control' name='nilai' id='nilai' placeholder='Isikan Nilai' value='<?php echo $nilai; ?>'>
							<?php echo form_error('nilai') ?>
            </div>
          </div>

          <div class='form-group'>
            <label for="int" class='col-sm-2 control-label'>Periode</label>
            <div class='col-sm-9'>
              <input  type='text' class='form-control' name='periode' id='periode' placeholder='Isikan Periode' value='<?php echo $periode; ?>'>
							<?php echo form_error('periode') ?>
            </div>
          </div>

          <div class='form-group'>
            <label for="varchar" class='col-sm-2 control-label'>Kegiatan</label>
            <div class='col-sm-9'>
              <input  type='text' class='form-control' name='kegiatan' id='kegiatan' placeholder='Isikan Kegiatan' value='<?php echo $kegiatan; ?>'>
							<?php echo form_error('kegiatan') ?>
            </div>
          </div>

					<input type='hidden' name='id_real_fisik' value='<?php echo $kegiatan ?>'>
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
		$("#kegiatan").focus();
	});
</script>
