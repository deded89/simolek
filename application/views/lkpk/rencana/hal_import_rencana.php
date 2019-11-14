<div class='row'>
	<div class='col-xs-12'>
		<div class='box box-info'>
			<div class='box-header with-border bg-aqua'>
				<h3 class='box-title'>Form Import Rencana kegiatan</h3>
				<a href='<?php echo site_url('lkpk/Kegiatan') ?>'>
					<span class='btn btn-danger btn-xs pull-right'><i class='fa fa-arrow-left'></i> Batal</span>
				</a>
			</div>
			<form class='form-horizontal' action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" onsubmit="return confirm('Semua Data Sudah Benar? \nPastikan Jenis Rencana yang Dipilih Sesuai dengan Data yang Diimport !!!');">
        <div class='box-body'>
					<div class="alert alert-info" style="margin-bottom:20px;font-size:12px">
            <h4><i class="icon fa fa-info"></i> Info :</h4>
						Untuk mengimport data rencana kegiatan silakan :
            <ol>
							<li>Isi format yang telah didownload dengan data yang sesuai, kemudian simpan</li>
							<li>Pilih jenis rencana yang akan diimport</li>
							<li>Pilih dan telusuri file yang akan diimport</li>
							<li>Klik tombol Import untuk melakukan proses import data</li>
            </ul>
          </div>
					<div class='form-group'>
						<label for="varchar" class='col-sm-2 control-label'>Pilih Jenis Rencana</label>
						<div class='col-sm-9'>
							<select class="form-control" name='jenis_rencana' id='jenis_rencana'>
								<option value="keuangan">Rencana Keuangan</option>
								<option value="fisik">Rencana Fisik</option>
							</select>
							<?php echo form_error('jenis_rencana') ?>
						</div>
					</div>
          <div class='form-group'>
            <label for="varchar" class='col-sm-2 control-label'>Import File</label>
            <div class='col-sm-9'>
              <input autofocus type='file' class='form-control' name='file' id='file'>
							<?php echo form_error('kode_kegiatan') ?>
            </div>
          </div>

					<input type='hidden' name='skpd' value='<?php echo $skpd ?>'>
	        <!-- CSRF TOKEN -->
	        <?php
	          $csrf = array(
	            'name' => $this->security->get_csrf_token_name(),
	            'hash' => $this->security->get_csrf_hash()
	          );
	        ?>
	        <input type='hidden' name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
					<div class='col-xs-12 text-center'>
						<input type='submit' name='simpan' value='<?php echo $button ?>' class='btn btn-info'>
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

});
</script>
