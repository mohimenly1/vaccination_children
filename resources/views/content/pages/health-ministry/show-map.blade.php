@extends('layouts/contentNavbarLayout')

@section('title', 'العمليات')

@section('page-script')
<script src="{{asset('assets/js/showMap.js')}}"></script>

<link rel='stylesheet' href='https://unpkg.com/leaflet@1.8.0/dist/leaflet.css' crossorigin='' />
@endsection

@section('content')

<div class="row" dir="rtl">
    <div id="map" data-lat="{{ $user->latitude }}" data-lng="{{ $user->longitude }}"></div>

    <script src='https://unpkg.com/leaflet@1.8.0/dist/leaflet.js' crossorigin=''></script>
    <script src='https://unpkg.com/leaflet-control-geocoder@2.4.0/dist/Control.Geocoder.js'></script>
    <script>
        let map, markers = [];
        /* ----------------------------- Initialize Map ----------------------------- */
        function initMap() {
      const lat = document.getElementById('map').getAttribute('data-lat');
      const lng = document.getElementById('map').getAttribute('data-lng');

      map = L.map('map', {
          center: {
              lat: lat,
              lng: lng,
          },
          zoom: 15
      });

      L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
          attribution: '© OpenStreetMap'
      }).addTo(map);

      map.on('click', mapClicked);
      initMarkers();
      
  }
  initMap();

        /* --------------------------- Initialize Markers --------------------------- */
        function initMarkers() {
            const initialMarkers = <?php echo json_encode($initialMarkers); ?>;

            for (let index = 0; index < initialMarkers.length; index++) {

                const data = initialMarkers[index];
                const marker = generateMarker(data, index);
                marker.addTo(map).bindPopup(`<b>${data.position.lat},  ${data.position.lng}</b>`);
                map.panTo(data.position);
                markers.push(marker)
            }
        }

        function generateMarker(data, index) {
            return L.marker(data.position, {
                    draggable: data.draggable
                })
                .on('click', (event) => markerClicked(event, index))
                .on('dragend', (event) => markerDragEnd(event, index));
        }

        /* ------------------------- Handle Map Click Event ------------------------- */
        function mapClicked($event) {
            console.log(map);
            console.log($event.latlng.lat, $event.latlng.lng);
            document.getElementById('lat-input').value = $event.latlng.lat;
            document.getElementById('lng-input').value = $event.latlng.lng;
        }

        /* ------------------------ Handle Marker Click Event ----------------------- */
        function markerClicked($event, index) {
            console.log(map);
            console.log($event.latlng.lat, $event.latlng.lng);
        }

        /* ----------------------- Handle Marker DragEnd Event ---------------------- */
        function markerDragEnd($event, index) {
            console.log(map);
            console.log($event.target.getLatLng());
        }
         /* ----------------------- Handle Submit Location Event ---------------------- */
         function submitLocation() {
    const lat = document.getElementById('lat-input').value;
    const lng = document.getElementById('lng-input').value;
    const url = `{{ route('submit-location', ['id' => $user->id]) }}`;
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    fetch(url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        },
        body: JSON.stringify({
            lat: lat,
            lng: lng
        })
    })
    .then(response => response.json())
    .then(data => {
        console.log(data);
    })
    .catch(error => {
        console.error('Error submitting location:', error);
    });
}

    </script>

    <style>
            .text-center {
            text-align: center;
        }
        #map {
            width: '100%';
            height: 400px;
        }
  </style>

  <form method="POST" action="{{ route('submit-location', ['id' => $user->id]) }}">

    @csrf
    <input type="hidden" id="lat-input" name="lat" value="">
    <input type="hidden" id="lng-input" name="lng" value="">
    <div class="row justify-content-end">
    <div class="col-sm-12 text-center m-2">
    <button type="submit" class="btn btn-primary">🌍 إضافة موقع جغرافي</button>
     </div>
    </div>
  </form>
  
  </div>

@endsection
