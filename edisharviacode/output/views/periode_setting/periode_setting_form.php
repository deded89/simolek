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

          <div class='form-group'>
            <label for="smallint" class='col-sm-2 control-label'>Tahun</label>
            <div class='col-sm-9'>
              <input autofocus type='text' class='form-control' name='tahun' id='tahun' placeholder='Isikan Tahun' value='<?php echo $tahun; ?>'>
							<?php echo form_error('tahun') ?>
            </div>
          </div>

          <div class='form-group'>
            <label for="mediumint" class='col-sm-2 control-label'>Skpd</label>
            <div class='col-sm-9'>
              <input  type='text' class='form-control' name='skpd' id='skpd' placeholder='Isikan Skpd' value='<?php echo $skpd; ?>'>
							<?php echo form_error('skpd') ?>
            </div>
          </div>

          <div class='form-group'>
            <label for="tinyint" class='col-sm-2 control-label'>B01</label>
            <div class='col-sm-9'>
              <input  type='text' class='form-control' name='b01' id='b01' placeholder='Isikan B01' value='<?php echo $b01; ?>'>
							<?php echo form_error('b01') ?>
            </div>
          </div>

          <div class='form-group'>
            <label for="tinyint" class='col-sm-2 control-label'>B02</label>
            <div class='col-sm-9'>
              <input  type='text' class='form-control' name='b02' id='b02' placeholder='Isikan B02' value='<?php echo $b02; ?>'>
							<?php echo form_error('b02') ?>
            </div>
          </div>

          <div class='form-group'>
            <label for="tinyint" class='col-sm-2 control-label'>B03</label>
            <div class='col-sm-9'>
              <input  type='text' class='form-control' name='b03' id='b03' placeholder='Isikan B03' value='<?php echo $b03; ?>'>
							<?php echo form_error('b03') ?>
            </div>
          </div>

          <div class='form-group'>
            <label for="tinyint" class='col-sm-2 control-label'>B04</label>
            <div class='col-sm-9'>
              <input  type='text' class='form-control' name='b04' id='b04' placeholder='Isikan B04' value='<?php echo $b04; ?>'>
							<?php echo form_error('b04') ?>
            </div>
          </div>

          <div class='form-group'>
            <label for="tinyint" class='col-sm-2 control-label'>B05</label>
            <div class='col-sm-9'>
              <input  type='text' class='form-control' name='b05' id='b05' placeholder='Isikan B05' value='<?php echo $b05; ?>'>
							<?php echo form_error('b05') ?>
            </div>
          </div>

          <div class='form-group'>
            <label for="tinyint" class='col-sm-2 control-label'>B06</label>
            <div class='col-sm-9'>
              <input  type='text' class='form-control' name='b06' id='b06' placeholder='Isikan B06' value='<?php echo $b06; ?>'>
							<?php echo form_error('b06') ?>
            </div>
          </div>

          <div class='form-group'>
            <label for="tinyint" class='col-sm-2 control-label'>B07</label>
            <div class='col-sm-9'>
              <input  type='text' class='form-control' name='b07' id='b07' placeholder='Isikan B07' value='<?php echo $b07; ?>'>
							<?php echo form_error('b07') ?>
            </div>
          </div>

          <div class='form-group'>
            <label for="tinyint" class='col-sm-2 control-label'>B08</label>
            <div class='col-sm-9'>
              <input  type='text' class='form-control' name='b08' id='b08' placeholder='Isikan B08' value='<?php echo $b08; ?>'>
							<?php echo form_error('b08') ?>
            </div>
          </div>

          <div class='form-group'>
            <label for="tinyint" class='col-sm-2 control-label'>B09</label>
            <div class='col-sm-9'>
              <input  type='text' class='form-control' name='b09' id='b09' placeholder='Isikan B09' value='<?php echo $b09; ?>'>
							<?php echo form_error('b09') ?>
            </div>
          </div>

          <div class='form-group'>
            <label for="tinyint" class='col-sm-2 control-label'>B10</label>
            <div class='col-sm-9'>
              <input  type='text' class='form-control' name='b10' id='b10' placeholder='Isikan B10' value='<?php echo $b10; ?>'>
							<?php echo form_error('b10') ?>
            </div>
          </div>

          <div class='form-group'>
            <label for="tinyint" class='col-sm-2 control-label'>B11</label>
            <div class='col-sm-9'>
              <input  type='text' class='form-control' name='b11' id='b11' placeholder='Isikan B11' value='<?php echo $b11; ?>'>
							<?php echo form_error('b11') ?>
            </div>
          </div>

          <div class='form-group'>
            <label for="tinyint" class='col-sm-2 control-label'>B12</label>
            <div class='col-sm-9'>
              <input  type='text' class='form-control' name='b12' id='b12' placeholder='Isikan B12' value='<?php echo $b12; ?>'>
							<?php echo form_error('b12') ?>
            </div>
          </div>

					<input type='hidden' name='id_per_setting' value='<?php echo $b12 ?>'>
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

</script>
