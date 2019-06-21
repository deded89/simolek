<head>
	<title>Overlay</title>
	<script src="https://cdn.rawgit.com/openlayers/openlayers.github.io/master/en/v5.3.0/build/ol.js"></script>
	<link rel="stylesheet" href="https://cdn.rawgit.com/openlayers/openlayers.github.io/master/en/v5.3.0/css/ol.css">
	<!-- The line below is only needed for old environments like Internet Explorer and Android 4.x -->
	<!-- <script src="https://cdn.polyfill.io/v2/polyfill.min.js?features=requestAnimationFrame,Element.prototype.classList,URL"></script> -->
	<script src="https://code.jquery.com/jquery-2.2.3.min.js"></script>
	<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> -->
</head>


<div class="row" style="margin-bottom: 10px">
	<div class="col-md-4 text-left">
		<?php echo anchor(site_url('pengadaan/lokasi/create/'.$pekerjaan_data->id_p), 'Tambah Data', 'class="btn btn-primary"'); ?>
	</div>
</div>
<!-- isi halaman -->
<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
			<div class="box-body table-responsive">
				<table class="table table-bordered table-striped" id="mytable">
				   <thead>
						<tr>
							<th width="30px">No</th>
							<th>Latitude</th>
							<th>Longitude</th>
							<th>Deskripsi</th>
							<th style="text-align:center">Aksi</th>
						</tr>
					</thead>
					<tbody>
					<?php
						$start = 0;
						foreach ($lokasi_data as $lokasi){
					?>
						<tr>
							<td><?php echo ++$start ?></td>
							<td><?php echo $lokasi->latitude ?></td>
							<td><?php echo $lokasi->longitude ?></td>
							<td><?php echo $lokasi->deskripsi ?></td>
							 <td style="text-align:center" width="120px">
							<?php
								// echo anchor(site_url('pengadaan/serah_terima/read/'.$serah_terima->id),'<i class="fa fa-eye"></i>', 'title="Lihat" class="btn btn-info btn-sm"');
								// echo '  ';
								// echo anchor(site_url('pengadaan/serah_terima/update/'.$serah_terima->id),'<i class="fa fa-pencil-square-o"></i>', 'title="Update" class="btn btn-warning btn-sm"');
								// echo '  ';
								echo anchor(site_url('pengadaan/lokasi/delete/'.$lokasi->id),'<i class="fa fa-trash-o"></i>', 'title="Hapus" class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Are You Sure ?\')"');
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
		$("#mytable").dataTable();
	});
</script>


<!-- ========================================SHOW MAP================================================= -->

<div id="map" class="map"></div>

<div style="display: none;">
	<!-- Clickable label for Vienna -->
	<p id="label_id"><strong>Mesjid Sabilal Muhtadin</strong></p>
	<div id="marker" title="Marker"><img src="<?php echo base_url('assets/images/marker.png') ?>" alt=""> </div>

</div>

<script>

	// INITIAL MAP
	var layer = new ol.layer.Tile({
		source: new ol.source.OSM()
	});

	var pos = ol.proj.fromLonLat([114.59105014801025, -3.3191030646576962]);

	var map = new ol.Map({
		layers: [layer],
		target: 'map',
		view: new ol.View({
			center: pos,
			zoom: 15
		})
	});

	// ADD MARKER
	var marker = new ol.Overlay({
		position: pos,
		positioning: 'center-center',
		element: document.getElementById('marker'),
		stopEvent: false
	});
	map.addOverlay(marker);

	// Vienna label
	var vienna = new ol.Overlay({
		position: pos,
		element: document.getElementById('label_id')
	});
	map.addOverlay(vienna);


</script>
