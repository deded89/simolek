<head>
	<title>Overlay</title>
	<script src="https://cdn.rawgit.com/openlayers/openlayers.github.io/master/en/v5.3.0/build/ol.js"></script>
	<link rel="stylesheet" href="https://cdn.rawgit.com/openlayers/openlayers.github.io/master/en/v5.3.0/css/ol.css">
	<!-- The line below is only needed for old environments like Internet Explorer and Android 4.x -->
	<!-- <script src="https://cdn.polyfill.io/v2/polyfill.min.js?features=requestAnimationFrame,Element.prototype.classList,URL"></script> -->
	<!-- <script src="https://code.jquery.com/jquery-2.2.3.min.js"></script> -->
	<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> -->
</head>


<div class="row" style="margin-bottom: 10px">
	<div class="col-md-4 text-left">
		<span <?php echo $hidden_attr ?>>
			<?php echo anchor(site_url('pengadaan/lokasi/create/'.$pekerjaan_data->id_p), 'Tambah Data', 'class="btn btn-primary"'); ?>
		</span>
		<?php echo anchor(site_url('pengadaan/pekerjaan/read/'.$pekerjaan_data->id_p), 'Kembali', 'class="btn btn-danger"'); ?>
	</div>
</div>
<!-- isi halaman -->
<div class="row">
		<div class="col-md-6">
			<div class="box box-primary">
				<div id="map" class="map" style="height:75vh"></div>
			</div>
		</div>
    <div class="col-md-6">
      <div class="box box-primary">
			<div class="box-body table-responsive">
				<table class="table table-bordered table-striped" id="mytable">
				   <thead>
						<tr>
							<th width="30px">No</th>
							<th>Latitude</th>
							<th>Longitude</th>
							<th>Deskripsi</th>
							<th <?php echo $hidden_attr ?> style="text-align:center">Aksi</th>
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
							<td <?php echo $hidden_attr ?> style="text-align:center" width="120px">
							<?php
								echo anchor(site_url('pengadaan/lokasi/delete/'.$lokasi->id.'/'.$pekerjaan_data->id_p),'<i class="fa fa-trash-o"></i>', 'title="Hapus" class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Are You Sure ?\')"');
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
<!-- ################################################ -->
<!-- ################################################ -->


<!-- CREATE MARKER DIV-->
<div>
<?php foreach ($lokasi_data as $lokasi) {?>
	<p id="<?php echo "label_".$lokasi->id ?>" style="color:red;"><strong><?php echo $lokasi->deskripsi ?></strong></p>
	<div id="<?php echo "marker_".$lokasi->id ?>"><img src="<?php echo base_url('assets/images/marker.png') ?>" alt=""> </div>
<?php } ?>
</div>

<script>

	// INITIAL MAP
	var layer = new ol.layer.Tile({
		source: new ol.source.OSM()
	});

	var init_pos = ol.proj.fromLonLat([114.59105014801025, -3.3191030646576962]);

	var map = new ol.Map({
		layers: [layer],
		target: 'map',
		view: new ol.View({
			center: init_pos,
			zoom: 13
		})
	});


<?php foreach ($lokasi_data as $lokasi) {?>

var pos = ol.proj.fromLonLat([<?php echo $lokasi->longitude ?> , <?php echo $lokasi->latitude ?> ])
	// ADD MARKER
	var marker = new ol.Overlay({
		position: pos,
		positioning: 'center-center',
		element: document.getElementById('<?php echo 'marker_'.$lokasi->id ?>'),
		stopEvent: false
	});
	map.addOverlay(marker);

	//ADD LABEL
	var label = new ol.Overlay({
		position: pos,
		element: document.getElementById('<?php echo 'label_'.$lokasi->id ?>')
	});
	map.addOverlay(label);
<?php } ?>

</script>
