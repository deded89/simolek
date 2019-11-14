<div class="row">
  <div class='col-xs-12'>
    <div class='box box-info'>
      <div class='box-header with-border bg-aqua'>
        <h3 class='box-title'>Rekap Pemerintah Kota</h3>
      </div>
      <div class="box-body">
        <form  class='form-horizontal' action="<?php echo $action; ?>" method="post">
					<div class='form-group'>
            <label for="varchar" class='col-sm-2 control-label'>Pilih Periode</label>
            <div class='col-sm-9'>
							<?php $id = $periode; ?>
							<?php echo cmb_db3('periode','periode_pagu','keterangan','id_per_pagu',$id) ?>
							<?php echo form_error('periode') ?>
            </div>
          </div>
          <div class='form-group'>
            <label for="varchar" class='col-sm-2 control-label'>Pilih Tahun Anggaran</label>
            <div class='col-sm-9'>
							<select class="form-control" name='tahun_anggaran' id='tahun_anggaran'>
								<option value="2019">2019</option>
								<option value="2020">2020</option>
							</select>
							<?php echo form_error('tahun_anggaran') ?>
            </div>
          </div>
          <div class='form-group'>
						<label for="varchar" class='col-sm-2 control-label'>Pilih Bulan Laporan</label>
						<div class='col-sm-9'>
							<select class="form-control" name='bulan_laporan' id='bulan_laporan'>
								<option value="0">Januari</option>
								<option value="1">Pebruari</option>
								<option value="2">Maret</option>
								<option value="3">April</option>
								<option value="4">Mei</option>
								<option value="5">Juni</option>
								<option value="6">Juli</option>
								<option value="7">Agustus</option>
								<option value="8">September</option>
								<option value="9">Oktober</option>
								<option value="10">Nopember</option>
								<option value="11">Desember</option>
							</select>
							<?php echo form_error('bulan_laporan') ?>
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
            <input type='submit' name='tampilkan' id="tampilkan" value='Tampilkan' class='btn btn-success'>
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
	});
  $('#periode').select2({
    placeholder: "Pilih Periode",
  });
});
</script>
