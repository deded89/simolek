<div class='row'>
	<div class='col-xs-12'>
		<div class='box box-info'>
			<div class='box-header with-border bg-aqua'>
				<h3 class='box-title'>Form Tambah Data nilai_pagu</h3>
				<a href='<?php echo site_url('lkpk/kegiatan/read/'.$kegiatan) ?>'>
					<span class='btn btn-danger btn-xs pull-right'><i class='fa fa-arrow-left'></i> Batal</span>
				</a>
			</div>
			<form class='form-horizontal' action="<?php echo $action; ?>" method="post">
        <div class='box-body'>

          <div class='form-group'>
						<div class='form-group'>
							<label for="tinyint" class='col-sm-2 control-label'>Periode Pagu</label>
							<div class='col-sm-9'>
								<?php $id = $periode_pagu; ?>
								<?php echo cmb_db3('periode_pagu','periode_pagu','keterangan','id_per_pagu',$id) ?>
								<?php echo form_error('periode_pagu') ?>
							</div>
						</div>

					<div class='form-group'>
            <label for="decimal" class='col-sm-2 control-label'>Nilai</label>
            <div class='col-sm-9'>
              <input type='number' class='form-control' name='nilai' id='nilai' placeholder='Isikan Nilai Pagu' value='<?php echo $nilai; ?>'  step="0.01" max="any" min="0">
							<?php echo form_error('nilai') ?>
            </div>
          </div>

					<input type='hidden' name='id_nilai_pagu' value='<?php echo $id_nilai_pagu ?>'>
					<input type='hidden' name='kegiatan' value='<?php echo $kegiatan ?>'>
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
	$('#periode_pagu').select2({
		placeholder: "Pilih Periode Pagu",
		allowClear:	true,
	});
});
</script>
