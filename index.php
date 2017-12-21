<!DOCTYPE html>
<html>
<head>

    <script
            src="https://code.jquery.com/jquery-3.2.1.min.js"
            integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
            crossorigin="anonymous"></script>

    <title>Simple Map</title>
    <meta name="viewport" content="initial-scale=1.0">
    <meta charset="utf-8">
    <style>
        /* Always set the map height explicitly to define the size of the div
         * element that contains the map. */
        #map {
            height: 100%;
        }
        /* Optional: Makes the sample page fill the window. */
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }
    </style>
</head>
<body>

<div class="form-group required">
    <div class="col-sm-4 buttonwrapper">
        <input type="text" class="form-control" id="input" name="IP" value='0.0.0.0' />
        <button class="ButtonGO">GO</button>
    </div>
</div>


<script>
    var map;
    var flightPath;
    function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 3,
            center: {lat: 0, lng: -180},
            mapTypeId: 'terrain'
        });

        var flightPlanCoordinates = [
            {lat: 37.772, lng: -122.214},
            {lat: 21.291, lng: -157.821},
            {lat: -18.142, lng: 178.431},
            {lat: -27.467, lng: 153.027}
        ];

        //flightPlanCoordinates.push({lat: 51.5033640, lng: -0.1276250});

        flightPath = new google.maps.Polyline({
            path: flightPlanCoordinates,
            geodesic: true,
            strokeColor: '#FF0000',
            strokeOpacity: 1.0,
            strokeWeight: 2
        });

        flightPath.setMap(map);
    }
</script>


<script>

    $(".ButtonGO").click(function () {
        getCoords($("#input").val());
    })


    function getCoords(address) {
        $.get({
            url: "getPos.php",
            data: { info: address }
        })
            .done(function( msg ) {
                console.log(msg);
                //need to add parsing for this and a for loop to add on the coords
                var thePath = flightPath.getPath();
                thePath.push(new google.maps.LatLng(51.5033640, -0.1276250));
                flightPath.setPath(thePath);
            });
    }


</script>


<div id="map"></div>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC9N5kTBPalmXtPSfvZKKiiyIdJ2sNH2d4&callback=initMap"
        async defer></script>
</body>
</html>