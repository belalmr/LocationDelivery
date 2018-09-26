
@extends('layouts.app')
@section('content')
<div class="container card">
    <form method="POST" action="{{route('location.store')}}" >
        {{csrf_field()}}
        <div class="row form-group" style="margin: 10px">
            <label for="country" class=" col-form-label">title: </label> &nbsp;
            <input name="title" id="title" class="form-control" type="text" size="50" style="text-align: left;width:357px;direction: rtl;">
        </div>
            <div id="map_canvas" class="form-group col-md-12 col-md-offset-10" style="height: 450px;width: 90%"></div>
            {{-- <div class="form-group row">
                <label for="country" class=" col-form-label">Address: </label> &nbsp;
                <input id="searchTextField" class="form-control" type="text" size="50" style="text-align: left;width:357px;direction: rtl;">
            </div> --}}
        <div class="row form-group" style="margin: 10px">
            <label for="country" class=" col-form-label">latitude: </label> &nbsp;
            <input name="latitude" class="MapLat form-control" value="" type="text" placeholder="Latitude" style="width: 161px;" required> &nbsp;&nbsp;&nbsp;

            <label for="country" class=" col-form-label">longitude: </label> &nbsp;
            <input name="longitude" class="MapLon form-control" class="form-control" value="" type="text" placeholder="Longitude" style="width: 161px;" required>
        </div>
        <button type="submit" class="btn btn-block btn-primary" style="margin: 10px">Make Delivary </button>
    </form>
</div>
@endsection
@section('extrajs')
    <script src="http://maps.google.com/maps/api/js?libraries=places&region=uk&language=en&sensor=true"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAPQwgQSGCkZkWxv7PjbusEs9Yg9_lFjCk&libraries=places&callback=initMap"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
    <script>
     $(function () {
         var lat = 31.521928,
             lng = 34.433748,
             latlng = new google.maps.LatLng(lat, lng),
             image = 'http://www.google.com/intl/en_us/mapfiles/ms/micons/blue-dot.png';
         //zoomControl: true,
         //zoomControlOptions: google.maps.ZoomControlStyle.LARGE,
         var mapOptions = {
             center: new google.maps.LatLng(lat, lng),
             zoom: 14.5,
             mapTypeId: google.maps.MapTypeId.ROADMAP,
             panControl: true,
             panControlOptions: {
                 position: google.maps.ControlPosition.TOP_RIGHT
             },
             zoomControl: true,
             zoomControlOptions: {
                 style: google.maps.ZoomControlStyle.LARGE,
                 position: google.maps.ControlPosition.TOP_left
             }
         },
         map = new google.maps.Map(document.getElementById('map_canvas'), mapOptions),
             marker = new google.maps.Marker({
                 position: latlng,
                 map: map,
                 icon: image
             });
         var input = document.getElementById('searchTextField');
         var autocomplete = new google.maps.places.Autocomplete(input, {
             types: ["geocode"]
         });
         autocomplete.bindTo('bounds', map);
         var infowindow = new google.maps.InfoWindow();
         google.maps.event.addListener(autocomplete, 'place_changed', function (event) {
             // infowindow.close();
             var place = autocomplete.getPlace();
             if (place.geometry.viewport) {
                 map.fitBounds(place.geometry.viewport);
             } else {
                 map.setCenter(place.geometry.location);
                 map.setZoom(17);
             }

             
             moveMarker(place.name, place.geometry.location);
             $('.MapLat').val(place.geometry.location.lat());
             $('.MapLon').val(place.geometry.location.lng());

             
         });
         google.maps.event.addListener(map, 'click', function (event) {

            var from = new google.maps.LatLng(lat, lng);
            var fromName = 'Bacau';
            var dest = new google.maps.LatLng($('.MapLat').val(event.latLng.lat()), $('.MapLon').val(event.latLng.lng()));
            var destName = 'Bucuresti';

            var service = new google.maps.DistanceMatrixService();
            service.getDistanceMatrix(
                {
                    origins: [from, fromName],
                    destinations: [destName, dest],
                    travelMode: 'DRIVING'
                }, callback);

            function callback(response, status) {
                if (status == 'OK') {
                    var origins = response.originAddresses;
                    var destinations = response.destinationAddresses;
                    var results = [];
                    for (var i = 0; i < origins.length; i++) {
                        results.push(response.rows[i].elements);
                    }
                    console.log(results); 
                }
            }

             $('.MapLat').val(event.latLng.lat());
             $('.MapLon').val(event.latLng.lng());

             infowindow.close();
                var geocoder = new google.maps.Geocoder();
                geocoder.geocode({
                    "latLng":event.latLng
                }, function (results, status) {
                    console.log(results, status);
                    if (status == google.maps.GeocoderStatus.OK) {
                        // console.log(results);
                        // var lat = results[0].geometry.location.lat(),
                        //     lng = results[0].geometry.location.lng(),
                            // placeName = results[0].address_components[0].long_name,
                            // latlng = new google.maps.LatLng(lat, lng);
                        // moveMarker(placeName, latlng);
                        // $("#searchTextField").val(results[0].formatted_address);
                    }
                });
         });
        
         function moveMarker(placeName, latlng) {
             marker.setIcon(image);
             marker.setPosition(latlng);
             infowindow.setContent(placeName);
             //infowindow.open(map, marker);
         }
    });
    </script>
@endsection