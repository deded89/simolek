<!DOCTYPE html>
<html>
  <head>
    <title>Overlay</title>
    <script src="https://cdn.rawgit.com/openlayers/openlayers.github.io/master/en/v5.3.0/build/ol.js"></script>
<link rel="stylesheet" href="https://cdn.rawgit.com/openlayers/openlayers.github.io/master/en/v5.3.0/css/ol.css">
    <!-- The line below is only needed for old environments like Internet Explorer and Android 4.x -->
    <!-- <script src="https://cdn.polyfill.io/v2/polyfill.min.js?features=requestAnimationFrame,Element.prototype.classList,URL"></script> -->
    <script src="https://code.jquery.com/jquery-2.2.3.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <style>

      #vienna {
        text-decoration: none;
        color: red;
        font-size: 11pt;
        font-weight: bold;
        text-shadow: black 0.1em 0.1em 0.2em;
      }
      .popover-content {
        min-width: 400px;
      }
    </style>
  </head>
  <body>
    <div class="row">
      <div class="col-md-8">
        <div id="map" class="map"></div>
      </div>
      <div class="col-md-4">
        <input type="text" id="lat" name="lat" value=""> <br>
        <input type="text" id="lon" name="lon" value="">
      </div>
    </div>

    <div style="display: none;">
      <!-- Clickable label for Vienna -->
      <a class="overlay" id="vienna" target="_blank" href="http://en.wikipedia.org/wiki/Vienna">Mesjid Sabilal Muhtadin</a>
      <div id="marker" title="Marker"><img src="<?php echo base_url('assets/images/marker.png') ?>" alt=""> </div>
      <!-- Popup -->
      <div id="popup" title="Welcome to OpenLayers"></div>

    </div>
    <script>

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

      // Vienna marker
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
        element: document.getElementById('vienna')
      });
      map.addOverlay(vienna);

      // Popup showing the position the user clicked
      var popup = new ol.Overlay({
        element: document.getElementById('popup')
      });
      map.addOverlay(popup);

      map.on('click', function(evt) {
        var element = popup.getElement();
        var coord = evt.coordinate;
        var coordinate = ol.proj.toLonLat(coord);
        var hdms = ol.coordinate.toStringHDMS(ol.proj.toLonLat(coordinate));

        $('#lat').val(coordinate[0]);
        $('#lon').val(coordinate[1]);

        $(element).popover('destroy');
        popup.setPosition(coord);
        $(element).popover({
          placement: 'top',
          animation: false,
          html: true,
          content: '<p>The location you clicked was:</p><code>' + coordinate + '</code>'
        });
        $(element).popover('show');
      });
    </script>
  </body>
</html>
