

<!-- DETAIL LAPORAN -->

<div class='row'>
	<div class='col-xs-12'>
	    <div class='box box-primary'>
        <table class="table table-hover">
	    <tr><td width="200px"><b>Nama Lap</b></td><td><?php echo $nama_lap; ?></td></tr>
	    <tr><td width="200px"><b>Batas Waktu</b></td><td><?php echo date('d-m-Y H:i:s',strtotime($batas_waktu)).' WITA'; ?></td></tr>
	    <tr><td width="200px"><b>Status Akses</b></td>
		<?php if($status=='open'){
			$warna = "badge bg-green";
		}else if($status=='closed'){
			$warna = "badge bg-red";
		}
		?>
		<td><span class="<?php echo $warna ?>"><?php echo $status; ?></span></td></tr>
	    <tr><td colspan="2">
			<a href="<?php echo site_url('laporan') ?>" class="btn btn-danger">Kembali</a>
		</td></tr>
	</table>
        </div>
	</div>
</div>

<!-- BARIS UNTUK MENAMBAH PELAPOR -->

<div class="row">
	<div class="col-md-12">
	  <!-- Horizontal Form -->
	  <div class="box box-info">
		<div class="box-header with-border">
		  <h3 class="box-title">Tambahkan Pelapor </h3>
		  <i style="color:red; text-align:center;"><?php echo form_error('id_skpd') ?></i>
		  <i style="color:red; text-align:center;"><?php echo form_error('id_klasifikasi') ?></i>
		</div>
		<!-- /.box-header -->
		<!-- form start -->
		<form action="<?php echo $action ?>" method="post" class="form-horizontal">
		  <div class="box-body">
			<div class="form-group">
			  <label for="mediumint" class="col-sm-2 control-label">SKPD/Pelapor</label>
			  <div class="col-sm-8 text-left">
				<?php echo cmb_dinamiss2('id_skpd','skpd','nama_skpd','id_skpd','')?>
			  </div>
			  <div class="col-sm-2">
				<button type="submit" class="btn btn-info pull-left">Tambahkan</button>
			  </div>
			</div>
				<input type="hidden" name="id_lap" value="<?php echo $id_lap; ?>" />
				<input type="hidden" name="id_status" value="1" />
        <!-- CSRF TOKEN -->
        <?php
          $csrf = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
          );
        ?>
        <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
		</form>

		<form action="<?php echo $action_2 ?>" method="post" class="form-horizontal">
			<div class="form-group">
			  <label for="mediumint" class="col-sm-2 control-label">Klasifikasi</label>
			  <div class="col-sm-8 text-left">
				<?php echo cmb_dinamiss2('id_klasifikasi','klasifikasi','nama_klasifikasi','id_klasifikasi','')?>
			  </div>
			  <div class="col-sm-2">
				<button type="submit" class="btn btn-info pull-left">Tambahkan</button>
			  </div>
			</div>
				<input type="hidden" name="id_lap" value="<?php echo $id_lap; ?>" />
				<input type="hidden" name="id_status" value="1" />
        <!-- CSRF TOKEN -->
        <?php
          $csrf = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
          );
        ?>
        <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
		  </div>
		</form>
      </div>
	</div>
</div>

<!-- LIST PELAPOR -->

<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
			<div class="box-body table-responsive">
				<table class="table table-bordered table-striped" id="mytable">
				   <thead>
						<tr>
							<th width="30px">No</th>
							<!-- <th>Id Lap</th> -->
							<th>Nama SKPD</th>
							<th>Status Pelaporan</th>
							<th>Keterangan</th>
							<th>Last Upload by</th>
							<th>Last Upload on</th>
							<th style="text-align:center">Aksi</th>
						</tr>
					</thead>
					<tbody>
					<?php
						$start = 0;
						foreach ($pelaporan_data as $pelaporan){
					?>
						<tr>
							<td><?php echo ++$start ?></td>
							<!-- <td><?php echo $pelaporan->id_lap ?></td> -->
							<td><?php echo $pelaporan->nama_skpd ?></td>


							<?php
							if($pelaporan->id_status==1){ //belum lapor
								$warna = "badge bg-red";
							}else if($pelaporan->id_status==2){ //sudah lapor
								$warna = "badge bg-yellow";
							}else if($pelaporan->id_status==3){ //diminta revisi
								$warna = "badge bg-yellow";
							}else if($pelaporan->id_status==4){ //diterima
								$warna = 'badge bg-green';
							}else if($pelaporan->id_status==5){ //diterima
								$warna = "badge bg-blue";
							}
							?>

							<td><span class="<?php echo $warna ?>"><?php echo $pelaporan->status ?></td>
							<td><?php echo $pelaporan->ket ?></td>
							<td><?php echo $pelaporan->nama_jab ?></td>
							<td>
							<?php
								if ($pelaporan->tgl_upload <> null){
									echo date("d-m-Y H:i:s",strtotime($pelaporan->tgl_upload));
								}else {
									echo $pelaporan->tgl_upload;
								}
							?></td>
							 <td style="text-align:center" width="120px">

							<?php
								if($pelaporan->id_status <> 1){
									echo anchor(site_url('dashboard/hal_download/'.$pelaporan->id_pelaporan.'/'.$pelaporan->id_lap.'/'.$pelaporan->id_skpd),'<i class="fa fa-download"></i>', 'target="_blank" title="Hal Download" class="btn btn-primary btn-sm"');
								}
								echo '  ';
								echo anchor(site_url('laporan/hapus_pelapor/'.$pelaporan->id_pelaporan.'/'.$id_lap),'<i class="fa fa-trash-o"></i>', 'title="Hapus" class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Semua file yang sudah diupload juga akan terhapus, Apa Anda Yakin ?\')"');
								echo '  ';
								echo anchor(site_url('laporan/cek_akses_upload/'.$pelaporan->id_lap),'<i class="fa fa-upload"></i>', 'title="Upload File" class="btn bg-purple btn-sm"');
							?>
							</td>
							</tr>
						<?php
						}
						?>
					</tbody>
				</table>
			</div>
		 </div>
	</div>
</div>

<!-- jQuery 2.2.3 -->
<script src="<?php echo base_url();?>assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
<script type="text/javascript">
	$(document).ready(function () {
		$("#mytable").dataTable({
			"iDisplayLength": 50
		});
		$('#id_skpd').select2({
			placeholder: "Pilih SKPD/Pelapor",
			allowClear:	true,
		}).data('select2').listeners['*'].push(function(name, target) {
			if(name == 'focus') {
				$(this.$element).select2("open");
			}
		});
		$('#id_klasifikasi').select2({
			placeholder: "Pilih Klasifikasi",
			allowClear:	true,
		}).data('select2').listeners['*'].push(function(name, target) {
			if(name == 'focus') {
				$(this.$element).select2("open");
			}
		});
	});
</script>
