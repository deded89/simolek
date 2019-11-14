<div class='row'>
	<div class='col-xs-12'>
		<div class='box box-info'>
			<div class='box-header with-border bg-aqua'>
				<h3 class='box-title'>Download Format</h3>
				<a href='<?php echo site_url('lkpk/Kegiatan') ?>'>
					<span class='btn btn-danger btn-xs pull-right'><i class='fa fa-arrow-left'></i> Batal</span>
				</a>
			</div>
			<form class='form-horizontal' action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
        <div class='box-body'>
					<div class="alert alert-info" style="margin-bottom:20px;font-size:12px">
            <h4><i class="icon fa fa-info"></i> Info :</h4>
						Untuk menambahkan banyak kegiatan sekaligus silakan :
            <ol>
							<li>Download format import data dalam bentuk Ms.Excel dengan klik Tombol Download Format</li>
							<li>Isi sesuai dengan format yang telah di download, kemudian simpan</li>
							<li>Klik tombol Import untuk masuk ke halaman Import dan ikuti petunjuk pada halaman tersebut</li>
            </ul>
          </div>
          <div class='form-group'>
            <label for="varchar" class='col-sm-2 control-label'>Pilih SKPD</label>
            <div class='col-sm-9'>
							<?php $id = $skpd; ?>
							<?php echo cmb_dinamiss2('skpd','skpd','nama_skpd','id_skpd',$id) ?>
							<?php echo form_error('skpd') ?>
            </div>
          </div>
	        <!-- CSRF TOKEN -->
	        <?php
	          $csrf = array(
	            'name' => $this->security->get_csrf_token_name(),
	            'hash' => $this->security->get_csrf_hash()
	          );
	        ?>
	        <input type='hidden' name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
					<div class='col-xs-12 text-center'>
						<input type='submit' name='download' id="download" value='Download Format' class='btn btn-success'>
						<a href="<?php echo site_url('lkpk/kegiatan/hal_import') ?>"><input type='button' name='hal_import' id="hal_import" value='Import' class='btn btn-info'></a>
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
	$('#skpd').select2({
		placeholder: "Pilih SKPD",
		allowClear:	true,
	});
});
</script>
