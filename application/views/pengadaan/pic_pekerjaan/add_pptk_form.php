<div class="row">
  <div class="col-xs-12">
    <div class="box box-info">
      <div class="box-header with-border bg-aqua">
        <h3 class="box-title">Tambahkan Penanggung Jawab Pekerjaan </h3>
        <a href="<?php echo site_url('pengadaan/pekerjaan/read/'.$pekerjaan_data->id_p) ?>">
          <span class="btn btn-danger btn-xs pull-right"><i class="fa fa-arrow-left"></i> Batal</span>
        </a>
      </div>
      <form class="form-horizontal" action="<?php echo site_url('pengadaan/PIC_pekerjaan/cari_pegawai/'.$pekerjaan_data->id_p) ?>" method="post">
        <div class="box-body">
          <div class="form-group">
            <label for="cari_nip" class="col-sm-2 control-label">CARI NIP PEGAWAI</label>
            <div class="col-sm-9">
              <input autofocus type="number" class="form-control" name="cari_nip" id="cari_nip" placeholder="Ketik NIP tanpa spasi" value="" <?php echo $field_cari ?>>
            </div>
          </div>
            <div class="col-xs-12 text-center">
              <input type="submit" name="cari" value="Cari" class="btn btn-info">
            </div>
        </div>
        <!-- CSRF TOKEN -->
        <?php
          $csrf = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
          );
        ?>
        <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
      </form>

      <form class="form-horizontal" action="<?php echo site_url('pengadaan/PIC_pekerjaan/simpan') ?>" method="post">
        <div class="box-body">
          <div class="form-group <?php if(form_error('nip')){echo 'has-error';} ?>">
            <label for="nip" class="col-sm-2 control-label">NIP</label>

            <div class="col-sm-9">
              <input autofocus type="number" class="form-control" name="nip" id="nip" placeholder="Ketik NIP tanpa spasi" value="<?php echo $nip ?>" <?php echo $field_pic ?>>
              <?php echo form_error('nip') ?>
            </div>
          </div>
          <div class="form-group <?php if(form_error('nama')){echo 'has-error';} ?>">
            <label for="nama" class="col-sm-2 control-label">Nama</label>

            <div class="col-sm-9">
              <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama Pegawai" value="<?php echo $nama ?>" <?php echo $field_pic ?>>
              <?php echo form_error('nama') ?>
            </div>
          </div>
          <div class="form-group <?php if(form_error('status')){echo 'has-error';} ?>">
            <label for="status" class="col-sm-2 control-label">Status</label>

            <div class="col-sm-9">
              <select class="form-control" name="status" id="status" <?php echo $field_pic ?>>
                <option value="pptk" <?php echo  set_select('status', 'pptk', TRUE); ?> >PPTK</option>
                <option value="ppk" <?php echo  set_select('status', 'ppk', TRUE); ?> >PPK</option>
                <option value="kpa" <?php echo  set_select('status', 'kpa', TRUE); ?> >KPA</option>
                <option value="pa" <?php echo  set_select('status', 'pa', TRUE); ?> >PA</option>
              </select>
              <?php echo form_error('status') ?>
            </div>
          </div>
          <div class="form-group <?php if(form_error('tmt')){echo 'has-error';} ?>">
            <label for="tmt" class="col-sm-2 control-label">Terhitung Mulai Tanggal</label>

            <div class="col-sm-9">
              <div class="input-group date">
								<div class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</div>
								<input type="text" class="form-control pull-right" name="tmt" id="tmt" placeholder="Terhitung Mulai Tanggal" value="<?php echo set_value('tmt'); ?>" autocomplete="off" <?php echo $field_pic ?>>
							</div>
              <?php echo form_error('tmt') ?>
            </div>
          </div>

          <div class="form-group <?php if(form_error('kontak')){echo 'has-error';} ?>">
            <label for="kontak" class="col-sm-2 control-label">No HP/WA</label>

            <div class="col-sm-9">
              <input type="number" class="form-control" name="kontak" id="kontak" placeholder="No HP/WA tanpa spasi" value="<?php echo $kontak ?>" <?php echo $field_pic ?>>
              <div>
                <?php echo form_error('kontak') ?>
              </div>
              <small class="form-text text-muted">Mohon diisi untuk memudahkan koordinasi, Nomor Kontak hanya akan bisa dilihat oleh Bagian Pembangunan</small>
            </div>
          </div>

          <input type="hidden" name="id_p" value="<?php echo $pekerjaan_data->id_p ?>">
          <!-- CSRF TOKEN -->
					<?php
						$csrf = array(
							'name' => $this->security->get_csrf_token_name(),
							'hash' => $this->security->get_csrf_hash()
						);
					?>
					<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />

          <div class="col-xs-12 text-center">
            <button type="submit" class="btn btn-primary" <?php echo $field_pic ?>>Simpan</button>
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
	$("#tmt").datepicker({
		autoclose:true,
		format:'yyyy-mm-dd',
		todayHighlight:true,
		todayBtn:'linked',
	});
});
</script>
