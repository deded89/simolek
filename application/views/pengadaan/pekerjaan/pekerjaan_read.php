<div class='row'>
	<div class='col-xs-12'>
	    <div class='box box-primary'>
        <table class="table table-hover">
	    <tr>
				<td width="200px"><b>Nama Paket</b></td><td><?php echo $nama; ?></td>
				<td width="200px"><b>Lokasi</b></td>
				<td>
					<a href="<?php echo site_url('pengadaan/lokasi/index/'.$id_p) ?>" >Tampilkan Peta</a>
				</td>
			</tr>
	    <tr>
				<td width="200px"><b>Kegiatan</b></td><td><?php echo $kegiatan; ?></td>
				<td width="200px"><b>Photo</b></td>
				<td>
					<a href="<?php echo site_url('pengadaan/kondisi_img/index/'.$id_p) ?>" >Tampilkan Gambar Kondisi</a>
				</td>
			</tr>
	    <tr><td width="200px"><b>Deskripsi Singkat Pekerjaan</b></td>
					<td colspan="3">
						<textarea style="background-color:white;border:0;padding:0;" name="deskripsi" class="form-control" rows="3" readonly><?php echo $deskripsi; ?></textarea>
					</td>
			</tr>
	    <tr><td width="200px"><b>SKPD</b></td><td><?php echo $skpd; ?></td></tr>
	    <tr>
				<td width="200px"><b>Jenis Pengadaan</b></td><td><?php echo $jenis; ?></td>
	    	<td width="200px"><b>Metode Pemilihan</b></td><td><?php echo $metode; ?></td>
			</tr>
	    <tr>
				<td width="200px"><b>Pagu</b></td><td><?php echo "Rp " . number_format($pagu,2,',','.'); ?></td>
				<td width="200px"><b>Total Kontrak</b></td><td><?php echo "Rp " . number_format($nilai_kontrak->total_kontrak,2,',','.'); ?></td>
			</tr>
			<tr>
				<td width="200px"><b>Progress saat ini</b></td><td><?php echo $progress_now ?></td>
				<td width="200px"><b>ID SiRUP</b></td><td><a href="<?php echo $link_rup ?>" target="_blank"><?php echo $id_rup ?></a></td>
			</tr>
			<tr>
				<td width="200px"><b>Realisasi Keuangan (Kumulatif)</b></td>
					<td><?php echo "Rp " . number_format($now_real_keu,2,',','.')."   dari Total Kontrak" ?></td>
					<td width="200px"><b>ID LPSE</b></td><td><a href="<?php echo $link_lpse ?>" target="_blank"><?php echo $id_lpse ?></a></td>
			</tr>
	    <tr <?php echo $hidden_attr ?>>
				<td>
					<a href="<?php echo site_url('pengadaan/progress_pekerjaan/create/'.$id_p) ?>"><button type="button" class="btn btn-warning btn-xs" name="add_st">Add Progress</button> </a>
				</td>
				<td colspan="4">
					<a href="<?php echo site_url('pengadaan/pekerjaan/update_id_pengadaan/'.$id_p) ?>"><button type="button" class="btn btn-info btn-xs" name="add_id_rup_lpse">Add Deskripsi Singkat</button> </a>
					<a href="<?php echo site_url('pengadaan/pekerjaan/update_id_pengadaan/'.$id_p) ?>"><button type="button" class="btn btn-info btn-xs" name="add_id_rup_lpse">Add ID Pengadaan</button> </a>
					<a href="<?php echo site_url('pengadaan/lokasi/create/'.$id_p) ?>"><button type="button" class="btn btn-info btn-xs" name="add_st">Add Lokasi</button> </a>
	    		<a href="<?php echo site_url('pengadaan/kontrak/create/'.$id_p) ?>"><button type="button" class="btn btn-info btn-xs" name="add_kontrak">Add Kontrak</button> </a>
	    		<a href="<?php echo site_url('pengadaan/serah_terima/create/'.$id_p) ?>"><button type="button" class="btn btn-info btn-xs" name="add_st">Add Serah Terima</button> </a>
				</td>
			</tr>

			<input type="hidden" name="id_p" value="<?php echo $id_p ?>">
	    <tr><td colspan="4"><a href="<?php echo site_url('pengadaan/pekerjaan') ?>" class="btn btn-danger pull-right">Kembali</a></td></tr>
	</table>
        </div>
	</div>
</div>

<div class="row">
	<div class="col-xs-12">
		<div class="box box-primary">
			<div class="box-body">
				<div class="progress-group">
					<span class="progress-text">Realisasi Keuangan</span>
					<span class="progress-number"><b><?php echo number_format($persen_real_keu,2) ?></b> %</span>
					<div class="progress">
						<div class="progress-bar progress-bar-striped progress-bar-success" style="width: <?php echo number_format($persen_real_keu,2) ?>%"></div>
					</div>
				</div>
				<div class="progress-group">
					<span class="progress-text">Realisasi Fisik</span>
					<span class="progress-number"><b><?php echo $now_real_fisik ?></b> %</span>
					<div class="progress">
						<div class="progress-bar progress-bar-striped progress-bar-aqua" style="width: <?php echo $now_real_fisik ?>%"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="box box-solid">
	<div class="box-body">
		<div class="box-group" id="accordion">
			<div class="panel">
				<div class="box-header with-border">
					<h4 class="box-title">
						<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" class="">
							Progress History
						</a>
					</h4>
				</div>
				<div id="collapseOne" class="panel-collapse collapse in" aria-expanded="true" style="">
					<div class="box-body">
						<?php $this->load->view('pengadaan/progress_pekerjaan/progress_pekerjaan_det', $pp_data); ?>
					</div>
				</div>
			</div>
			<div class="panel">
				<div class="box-header with-border">
					<h4 class="box-title">
						<a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" class="collapsed" aria-expanded="false">
							Data Kontrak
						</a>
					</h4>
				</div>
				<div id="collapseTwo" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
					<div class="box-body">
						<?php $this->load->view('pengadaan/kontrak/kontrak_det', $kontrak_data); ?>
					</div>
				</div>
			</div>
			<div class="panel">
				<div class="box-header with-border">
					<h4 class="box-title">
						<a data-toggle="collapse" data-parent="#accordion" href="#collapseThree" class="collapsed" aria-expanded="false">
							Data Serah Terima
						</a>
					</h4>
				</div>
				<div id="collapseThree" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
					<div class="box-body">
						<?php $this->load->view('pengadaan/serah_terima/serah_terima_det', $st_data); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- /.box-body -->
</div>
