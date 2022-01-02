<section class="issmap">

   <div id="mapid"></div>     

        <!-- Javascript parts -->
            <script>
                const attribution = '&copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors';
                const peta = L.map('mapid').setView([0, 0], 2);

                var iss_icon = L.icon({
                    iconUrl: 'img/iss2.png',
                    iconSize: [100, 64]
                });
                const marker = L.marker([0, 0], {icon: iss_icon}).addTo(peta);

                const tileUrl =  'https://cartodb-basemaps-{s}.global.ssl.fastly.net/light_all/{z}/{x}/{y}.png';
                const tiles = L.tileLayer(tileUrl, { attribution });
                tiles.addTo(peta);

                const API_URL = 'https://api.wheretheiss.at/v1/satellites/25544';

                async function getData(){
                    const response = await fetch(API_URL);
                    const data = await response.json();
                    console.log(data)
                    const { latitude, longitude, footprint } = data;

                    peta.setView([latitude, longitude, footprint], 3);
                    marker.setLatLng([latitude, longitude, footprint]);

                    var popup = L.popup()
                    .setLatLng([latitude, longitude, footprint])
                    .setContent('Latitude: ' + latitude.toFixed(3) +  '<br>Longitude: ' + longitude.toFixed(3) + '<br>Footprint: ' + footprint.toFixed(3))
                    .openOn(peta);
                    marker.bindPopup(popup).openPopup();
                    
                }

                getData();

                setInterval(getData, 1000);

            </script>

</section>