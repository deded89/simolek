<head>
	<title>Overlay</title>
	<script src="https://cdn.rawgit.com/openlayers/openlayers.github.io/master/en/v5.3.0/build/ol.js"></script>
	<link rel="stylesheet" href="https://cdn.rawgit.com/openlayers/openlayers.github.io/master/en/v5.3.0/css/ol.css">
	<!-- The line below is only needed for old environments like Internet Explorer and Android 4.x -->
	<!-- <script src="https://cdn.polyfill.io/v2/polyfill.min.js?features=requestAnimationFrame,Element.prototype.classList,URL"></script> -->
	<!-- <script src="https://code.jquery.com/jquery-2.2.3.min.js"></script> -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>

<div class='row'>
	<div class="col-md-8">
		<div class='box box-primary' >
			<div id="map" class="map" style="height:80vh"></div>
			<div id="popup" title="Koordinat Lokasi"></div>
		</div>
	</div>
	<div class='col-md-4'>
	    <div class='box box-primary'>
			<form action="<?php echo $action; ?>" method="post">
				<table class='table table-bordered'>

					<tr>
						<td><label for="varchar">Latitude <?php echo form_error('latitude') ?></label></td>
						<td><input type="text" class="form-control" name="latitude" id="latitude" placeholder="Latitude" readonly value="<?php echo $latitude; ?>" /></td>
					</tr>

					<tr>
						<td><label for="varchar">Longitude <?php echo form_error('longitude') ?></label></td>
						<td><input type="text" class="form-control" name="longitude" id="longitude" placeholder="Longitude" readonly value="<?php echo $longitude ?>" /></td>
					</tr>

					<tr>
						<td><label for="varchar">Deskripsi <?php echo form_error('deskripsi') ?></label></td>
						<td><input type="text" class="form-control" name="deskripsi" id="deskripsi" placeholder="Deskripsi" value="<?php echo $deskripsi; ?>" /></td>
					</tr>


					<input type="hidden" name="id_l" value="<?php echo $id_l; ?>" />
					<input type="hidden" name="id_p" value="<?php echo $id_p; ?>" />
					<!-- CSRF TOKEN -->
					<?php
						$csrf = array(
							'name' => $this->security->get_csrf_token_name(),
							'hash' => $this->security->get_csrf_hash()
						);
					?>
					<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
					<tr>
						<td colspan='2'>
							<button type="submit" class="btn btn-primary"><?php echo $button ?></button>
							<a href="<?php echo site_url('pengadaan/pekerjaan/read/'.$id_p) ?>" class="btn btn-danger">Cancel</a>
						</td>
					</tr>
				</table>
			</form>
		</div>
	</div>
</div>

<!-- jQuery 2.2.3 -->
<script src="<?php echo base_url();?>assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
<script type="text/javascript">
	$(document).ready(function () {
		$("#deskripsi").focus();
	});
</script>

<!-- ========================================SHOW MAP================================================= -->
<!-- ################################################ -->
<!-- ################################################ -->

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

	// Popup showing the position the user clicked
	var popup = new ol.Overlay({
		element: document.getElementById('popup')
	});
	map.addOverlay(popup);

// GET CLICK position
map.on('click', function(evt) {
	var element = popup.getElement();
	var coord = evt.coordinate;
	var coordinate = ol.proj.toLonLat(coord);

	$('#latitude').val(coordinate[1]);
	$('#longitude').val(coordinate[0]);

	$(element).popover('destroy');
	popup.setPosition(coord);
	$(element).popover({
		placement: 'top',
		animation: false,
		html: true,
		content: '<code>' + coordinate[1] + '</code> <br> <code>' + coordinate[0] + '</code>'
	});
	$(element).popover('show');
});

	</script>
