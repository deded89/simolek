<div class="row">
  <div class="col-xs-12">
    <div class="box box-info">
      <div class="box-header with-border bg-aqua">
        <h3 class="box-title">Tambahkan Penanggung Jawab Pekerjaan </h3>
        <a href="<?php echo site_url('pengadaan/pekerjaan/read/'.$pekerjaan_data->id_p) ?>">
          <span class="btn btn-danger btn-xs pull-right"><i class="fa fa-arrow-left"></i> Batal</span>
        </a>
      </div>
      <form class="form-horizontal" action="<?php echo site_url('pengadaan/pic_pekerjaan/simpan') ?>" method="post">
        <div class="box-body">
          <div class="form-group">
            <label for="nip" class="col-sm-2 control-label">NIP</label>

            <div class="col-sm-9">
              <input autofocus type="number" class="form-control" name="nip" id="nip" placeholder="Ketik NIP tanpa spasi" value="">
              <?php echo form_error('nip') ?>
            </div>
          </div>
          <div class="form-group">
            <label for="nama" class="col-sm-2 control-label">Nama</label>

            <div class="col-sm-9">
              <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama Pegawai" value="">
              <?php echo form_error('nama') ?>
            </div>
          </div>
          <div class="form-group">
            <label for="status" class="col-sm-2 control-label">Status</label>

            <div class="col-sm-9">
              <select class="form-control" name="status" id="status">
                <option value="pptk" selected>PPTK</option>
                <option value="ppk">PPK</option>
                <option value="kpa">KPA</option>
                <option value="pa">PA</option>
              </select>
              <?php echo form_error('status') ?>
            </div>
          </div>
          <div class="form-group">
            <label for="tmt" class="col-sm-2 control-label">Terhitung Mulai Tanggal</label>

            <div class="col-sm-9">
              <div class="input-group date">
								<div class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</div>
								<input type="text" class="form-control pull-right" name="tmt" id="tmt" placeholder="Terhitung Mulai Tanggal" value="" autocomplete="off" >
							</div>
              <?php echo form_error('tmt') ?>
            </div>
          </div>

          <input type="hidden" name="id_p" value="<?php echo $pekerjaan_data->id_p ?>">

          <div class="col-xs-12 text-center">
            <button type="submit" class="btn btn-primary">Simpan</button>
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
