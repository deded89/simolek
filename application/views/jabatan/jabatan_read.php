<div class='row'>
	<div class='col-xs-12'>
	    <div class='box box-primary'>      
        <table class="table table-hover">
	    <tr><td width="200px">Level Jabatan</td><td><?php echo $nama_level; ?></td></tr>
	    <tr><td width="200px">Nama Jabatan</td><td><?php echo $nama_jab; ?></td></tr>
	    <tr><td width="200px">Nama SKPD</td><td><?php echo $nama_skpd; ?></td></tr>
		<tr><td width="200px">Nama Pegawai</td><td><?php echo $nama_lengkap; ?></td></tr>
	    <tr><td colspan="2">
		<a href="<?php echo site_url('jabatan') ?>" class="btn btn-danger">Kembali</a>
		<?php  if ($this->ion_auth->in_group('admin')){ ?> <!-- CEK APAKAH USER ADALAH ADMIN -->
		<a href="<?php echo site_url('auth/create_user/'.$id_jab) ?>" class="btn btn-success">Buat User</a>
		<?php } ?>
		</td></tr>
	</table>
        </div>
	</div>
</div>