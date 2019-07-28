<div class="visible-xs-block">
	<div class="alert alert-info alert-dismissible">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<p>Untuk tampilan yang nyaman putar HP anda menjadi landscape.</p>
	</div>
</div>

<div class='row'>
	<div class='col-xs-12'>
		<div class='box box-primary box-solid'>
			<div class="box-header with-border bg-aqua">
				<h4 class="box-title">
					<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" class="">
						Detail Pekerjaan
					</a>
				</h4>
			</div>
			<div class="box-body">
				<!-- ROW 1 -->
				<div class="row bottom-row-margin">
					<div class="col-xs-8 no-left-right-padding">
						<div class="col-xs-4">
							<b>Nama Pekerjaan</b>
						</div>
						<div class="col-xs-8">
							<?php echo $nama; ?>
						</div>
					</div>
					<div class="col-xs-4 no-left-right-padding">
						<div class="col-xs-4">
							<b>Lokasi</b>
						</div>
						<div class="col-xs-8">
							<a href="<?php echo site_url('pengadaan/lokasi/index/'.$id_p) ?>" >Tampilkan Peta</a>
						</div>
					</div>
				</div>

				<!-- ROW 2 -->
				<div class="row bottom-row-margin">
					<div class="col-xs-8 no-left-right-padding">
						<div class="col-xs-4">
							<b>Kegiatan</b>
						</div>
						<div class="col-xs-8">
							<?php echo $kegiatan; ?>
						</div>
					</div>
					<div class="col-xs-4 no-left-right-padding">
						<div class="col-xs-4">
							<b>Foto</b>
						</div>
						<div class="col-xs-8">
							<a href="<?php echo site_url('pengadaan/kondisi_img/index/'.$id_p) ?>" >Tampilkan Foto Kondisi</a>
						</div>
					</div>
				</div>

				<!-- ROW 3 -->
				<div class="row bottom-row-margin">
					<div class="col-xs-8 no-left-right-padding">
						<div class="col-xs-4">
							<b>Deskripsi  <br>Singkat</b>
						</div>
						<div class="col-xs-8">
							<textarea style="background-color:white;border:0;padding:0;" name="deskripsi" class="form-control" rows="6" readonly><?php echo $deskripsi; ?></textarea>
						</div>
					</div>
				</div>

				<!-- ROW 4 -->
				<div class="row bottom-row-margin">
					<div class="col-xs-8 no-left-right-padding">
						<div class="col-xs-4">
							<b>SKPD Pelaksana</b>
						</div>
						<div class="col-xs-8">
							<?php echo $skpd; ?>
						</div>
					</div>
				</div>

				<!-- ROW 5 -->
				<div class="row bottom-row-margin">
					<div class="col-xs-8 no-left-right-padding">
						<div class="col-xs-4">
							<b>Jenis Pengadaan</b>
						</div>
						<div class="col-xs-8">
							<?php echo $jenis; ?>
						</div>
					</div>
					<div class="col-xs-4 no-left-right-padding">
						<div class="col-xs-4">
							<b>Metode Pemilihan</b>
						</div>
						<div class="col-xs-8">
							<?php echo $metode; ?>
						</div>
					</div>
				</div>

				<!-- ROW 6 -->
				<div class="row bottom-row-margin">
					<div class="col-xs-8 no-left-right-padding">
						<div class="col-xs-4">
							<b>Pagu Pekerjaan</b>
						</div>
						<div class="col-xs-8">
							<?php echo "Rp " . number_format($pagu,2,',','.'); ?>
						</div>
					</div>
					<div class="col-xs-4 no-left-right-padding">
						<div class="col-xs-4">
							<b>Tahapan</b>
						</div>
						<div class="col-xs-8">
							<?php echo $progress_now ?>
						</div>
					</div>
				</div>

				<!-- ROW 7 -->
				<div class="row bottom-row-margin">
					<div class="col-xs-8 no-left-right-padding">
						<div class="col-xs-4">
							<b>Total Kontrak</b>
						</div>
						<div class="col-xs-8">
							<?php echo "Rp " . number_format($nilai_kontrak,2,',','.'); ?>
						</div>
					</div>
					<div class="col-xs-4 no-left-right-padding">
						<div class="col-xs-4">
							<b>ID SiRUP</b>
						</div>
						<div class="col-xs-8">
							<a href="<?php echo $link_rup ?>" target="_blank"><?php echo $id_rup ?></a>
						</div>
					</div>
				</div>

				<!-- ROW 8 -->
				<div class="row bottom-row-margin">
					<div class="col-xs-8 no-left-right-padding">
						<div class="col-xs-4">
							<b>Realisasi Keuangan (Kumulatif)</b>
						</div>
						<div class="col-xs-8">
							<?php echo "Rp " . number_format($now_real_keu,2,',','.')."   dari Total Kontrak" ?>
						</div>
					</div>
					<div class="col-xs-4 no-left-right-padding">
						<div class="col-xs-4">
							<b>ID LPSE</b>
						</div>
						<div class="col-xs-8">
							<a href="<?php echo $link_lpse ?>" target="_blank"><?php echo $id_lpse ?></a>
						</div>
					</div>
				</div>

				<!-- ROW 9 -->
				<div <?php echo $hidden_attr ?> class="row bottom-row-margin">
					<div class="col-xs-12 no-left-right-padding">
						<div class="col-xs-2">
							<a href="<?php echo site_url('pengadaan/progress_pekerjaan/create/'.$id_p) ?>"><button type="button" class="btn btn-warning btn-xs" name="add_st">Add Progress</button> </a>
						</div>
						<div class="col-xs-9">
							<a href="<?php echo site_url('pengadaan/pekerjaan/update_id_pengadaan/'.$id_p) ?>"><button type="button" class="btn btn-info btn-xs" name="add_id_rup_lpse">Add Deskripsi & ID Pengadaan</button> </a>
							<a href="<?php echo site_url('pengadaan/lokasi/create/'.$id_p) ?>"><button type="button" class="btn btn-info btn-xs" name="add_lokasi">Add Lokasi</button> </a>
							<a href="<?php echo site_url('pengadaan/PIC_pekerjaan/add_pic/'.$id_p) ?>"><button type="button" class="btn btn-info btn-xs" name="add_pic">Add PIC</button> </a>
							<a href="<?php echo site_url('pengadaan/kondisi_img/add/'.$id_p) ?>"><button type="button" class="btn btn-info btn-xs" name="add_kondisi_img">Add Foto Kondisi</button> </a>
							<a href="<?php echo site_url('pengadaan/kontrak/create/'.$id_p) ?>"><button type="button" class="btn btn-info btn-xs" name="add_kontrak">Add Kontrak</button> </a>
							<a href="<?php echo site_url('pengadaan/serah_terima/create/'.$id_p) ?>"><button type="button" class="btn btn-info btn-xs" name="add_st">Add Serah Terima</button> </a>
						</div>
					</div>
				</div>

				<table class="table table-hover">
					<input type="hidden" name="id_p" value="<?php echo $id_p ?>">
					<tr><td colspan="4"><a href="<?php echo site_url('pengadaan/pekerjaan') ?>" class="btn btn-danger pull-right">Kembali</a></td></tr>
				</table>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-xs-12">
		<div class="box box-primary box-solid">
			<div class="box-header with-border bg-aqua">
				<h4 class="box-title">
					<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" class="">
						Realisasi Keuangan dan Fisik Pekerjaan
					</a>
				</h4>
			</div>
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

<div class="box box-primary box-solid">
	<div class="box-body">
		<div class="box-group" id="accordion">
			<div class="panel">
				<div class="box-header">
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
				<div class="box-header">
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
				<div class="box-header">
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
			<div class="panel">
				<div class="box-header">
					<h4 class="box-title">
						<a data-toggle="collapse" data-parent="#accordion" href="#collapseFour" class="collapsed" aria-expanded="false">
							Data Penanggung Jawab
						</a>
					</h4>
				</div>
				<div id="collapseFour" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
					<div class="box-body">
						<?php $this->load->view('pengadaan/pic_pekerjaan/pic_det', $pic_data); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- /.box-body -->
</div>
