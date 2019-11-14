<div class='row'>
	<div class='col-xs-12'>
		<div class='box box-primary'>
			<table class="table table-hover">
				<tr><td width="200px"><b>Kode Kegiatan</b></td><td><?php echo $kode_kegiatan; ?></td></tr>
				<tr><td width="200px"><b>Nama Kegiatan</b></td><td><?php echo $nama_kegiatan; ?></td></tr>
				<tr><td width="200px"><b>Sumber Dana</b></td><td><?php echo $sumber_dana; ?></td></tr>
				<tr><td width="200px"><b>Tahun Anggaran</b></td><td><?php echo $tahun_anggaran; ?></td></tr>
				<tr><td width="200px"><b>SKPD</b></td><td><?php echo $nama_skpd; ?></td></tr>
				<tr><td colspan="2" class="text-right"><a href="<?php echo site_url('lkpk/kegiatan') ?>" class="btn btn-danger">Kembali</a></td></tr>
			</table>
		</div>
	</div>
</div>
<?php $this->load->view('lkpk/nilai_pagu/nilai_pagu_list') ?>
