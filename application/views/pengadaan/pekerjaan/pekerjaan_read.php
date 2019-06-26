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
	    <tr><td width="200px"><b>SKPD</b></td><td><?php echo $skpd; ?></td></tr>
	    <tr>
				<td width="200px"><b>Jenis Pengadaan</b></td><td><?php echo $jenis; ?></td>
	    	<td width="200px"><b>Metode Pemilihan</b></td><td><?php echo $metode; ?></td>
			</tr>
	    <tr>
				<td width="200px"><b>Pagu</b></td><td><?php echo "Rp " . number_format($pagu,2,',','.'); ?></td>
	    	<td width="200px"><b>Nilai Kontrak</b></td><td><?php echo "Rp " . number_format($realisasi,2,',','.'); ?></td>
			</tr>
	    <tr>
				<td colspan="4">
					<!-- <a href="<?php// echo site_url('pengadaan/progress/create/'.$id_p) ?>"><button type="button" class="btn btn-info btn-xs" name="add_progress">Add Progress</button> </a> -->
	    		<a href="<?php echo site_url('pengadaan/kontrak/create/'.$id_p) ?>"><button type="button" class="btn btn-info btn-xs" name="add_kontrak">Add Kontrak</button> </a>
	    		<a href="<?php echo site_url('pengadaan/serah_terima/create/'.$id_p) ?>"><button type="button" class="btn btn-info btn-xs" name="add_st">Add Serah Terima</button> </a>
	    		<a href="<?php echo site_url('pengadaan/progress_pekerjaan/create/'.$id_p) ?>"><button type="button" class="btn btn-info btn-xs" name="add_st">Add Progress</button> </a>
	    		<a href="<?php echo site_url('pengadaan/lokasi/create/'.$id_p) ?>"><button type="button" class="btn btn-info btn-xs" name="add_st">Add Lokasi</button> </a>
				</td>
			</tr>

			<input type="hidden" name="id_p" value="<?php echo $id_p ?>">
	    <tr><td colspan="4"><a href="<?php echo site_url('pengadaan/pekerjaan') ?>" class="btn btn-danger pull-right">Kembali</a></td></tr>
	</table>
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
