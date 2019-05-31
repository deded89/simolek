<div class='row'>
	<div class='col-xs-12'>
	    <div class='box box-primary'>

        <table class="table table-hover">
				
	    <tr>
				<td width="200px"><b>Nama Paket</b></td><td><?php echo $nama; ?></td>
				<td width="200px"><b>Lokasi</b></td>
				<td>
					<a href="<?php echo "https://www.google.co.id/maps/@".$latitude.",".$longitude.",19z" ?>" target="_blank">Click Here</a>
				</td>
			</tr>
	    <tr><td width="200px"><b>Kegiatan</b></td><td><?php echo $kegiatan; ?></td></tr>
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
							Data Kontrak
						</a>
					</h4>
				</div>
				<div id="collapseOne" class="panel-collapse collapse in" aria-expanded="true" style="">
					<div class="box-body">
						<?php $this->load->view('pengadaan/kontrak/kontrak_det', $kontrak_data); ?>
					</div>
				</div>
			</div>
			<div class="panel">
				<div class="box-header with-border">
					<h4 class="box-title">
						<a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" class="collapsed" aria-expanded="false">
							Data Serah Terima
						</a>
					</h4>
				</div>
				<div id="collapseTwo" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
					<div class="box-body">
						Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3
						wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum
						eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla
						assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred
						nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer
						farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus
						labore sustainable VHS.
					</div>
				</div>
			</div>
			<div class="panel">
				<div class="box-header with-border">
					<h4 class="box-title">
						<a data-toggle="collapse" data-parent="#accordion" href="#collapseThree" class="collapsed" aria-expanded="false">
							Progress History
						</a>
					</h4>
				</div>
				<div id="collapseThree" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
					<div class="box-body">
						Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3
						wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum
						eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla
						assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred
						nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer
						farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus
						labore sustainable VHS.
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- /.box-body -->
</div>
