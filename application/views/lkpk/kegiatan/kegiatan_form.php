<div class='row'>
	<div class='col-xs-12'>
		<div class='box box-info'>
			<div class='box-header with-border bg-aqua'>
				<h3 class='box-title'>Form Tambah Data kegiatan</h3>
				<a href='<?php echo site_url('lkpk/Kegiatan') ?>'>
					<span class='btn btn-danger btn-xs pull-right'><i class='fa fa-arrow-left'></i> Batal</span>
				</a>
			</div>
			<form class='form-horizontal' action="<?php echo $action; ?>" method="post">
        <div class='box-body'>

          <div class='form-group'>
            <label for="varchar" class='col-sm-2 control-label'>Kode Kegiatan</label>
            <div class='col-sm-9'>
              <input autofocus type='text' class='form-control' name='kode_kegiatan' id='kode_kegiatan' placeholder='Isikan Kode Kegiatan' value='<?php echo $kode_kegiatan; ?>'>
							<?php echo form_error('kode_kegiatan') ?>
            </div>
          </div>

          <div class='form-group'>
            <label for="varchar" class='col-sm-2 control-label'>Nama Kegiatan</label>
            <div class='col-sm-9'>
              <input  type='text' class='form-control' name='nama_kegiatan' id='nama_kegiatan' placeholder='Isikan Nama Kegiatan' value='<?php echo $nama_kegiatan; ?>'>
							<?php echo form_error('nama_kegiatan') ?>
            </div>
          </div>

          <div class='form-group'>
            <label for="varchar" class='col-sm-2 control-label'>Sumber Dana</label>
            <div class='col-sm-9'>
							<select class="form-control" name='sumber_dana' id='sumber_dana'>
                    <option value="apbd" <?php echo $sumber_dana == 'apbd' ? 'selected' : ''?>  >APBD</option>
                    <option value="dak" <?php echo $sumber_dana == 'dak'   ?  'selected' : ''?> > APBN DAK</option>
              </select>
							<?php echo form_error('sumber_dana') ?>
            </div>
          </div>

          <div class='form-group'>
            <label for="smallint" class='col-sm-2 control-label'>Tahun Anggaran</label>
            <div class='col-sm-9'>
							<select class="form-control" name='tahun_anggaran' id='tahun_anggaran'>
								<option value="2019" <?php echo $tahun_anggaran == '2019'   ?  'selected' : ''?> >TA 2019</option>
								<option value="2020" <?php echo $tahun_anggaran == '2020'   ?  'selected' : ''?> >TA 2020</option>
							</select>
							<?php echo form_error('tahun_anggaran') ?>
            </div>
          </div>

          <div class='form-group'>
            <label for="mediumint" class='col-sm-2 control-label'>SKPD Pelaksana</label>
            <div class='col-sm-9'>
							<?php $id = $skpd; ?>
							<?php echo cmb_dinamiss2('skpd','skpd','nama_skpd','id_skpd',$id) ?>
							<?php echo form_error('skpd') ?>
            </div>
          </div>

					<input type='hidden' name='id_kegiatan' value='<?php echo $id_kegiatan ?>'>
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
	$('#skpd').select2({
		placeholder: "Pilih SKPD",
		allowClear:	true,
	});
});
</script>
