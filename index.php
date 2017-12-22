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
        <p class="loading"></p>
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

    var load = true;

    function loading(){
        if (load){
            if ($(".loading").text() === "Loading"){
                $(".loading").html("Loading.");
            } else if ($(".loading").text() === "Loading."){
                $(".loading").html("Loading..");
            } else if ($(".loading").text() === "Loading.."){
                $(".loading").html("Loading...");
            } else {
                $(".loading").html("Loading");
            }
        }
        setTimeout(function(){ loading() }, 1000);
    }

    $(".ButtonGO").click(function () {
        getCoords($("#input").val());
    });


    function getCoords(address) {
        $(".loading").html("Loading");
        load = true;
        loading();
        $.get({
            url: "getPos.php",
            data: { info: address }
        })
            .done(function( msg ) {
                load = false;
                $(".loading").html("");
                console.log(msg);
                var thePath = [];

                var arr = msg.split(":");
                console.log(arr);
                for (i = 0; i < arr.length; i++){
                    thePath.push(new google.maps.LatLng(arr[i].split(",")[0], arr[i].split(",")[1]));
                }

                flightPath.setPath(thePath);
            });
    }


</script>


<div id="map"></div>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC9N5kTBPalmXtPSfvZKKiiyIdJ2sNH2d4&callback=initMap"
        async defer></script>
</body>
</html>