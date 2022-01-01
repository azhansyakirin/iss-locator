<div id="mapid"></div>

    <!-- Javascript parts -->
        <script>
            const attribution = '&copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors';
            const mymap = L.map('mapid').setView([0, 0], 2);

            var iss_icon = L.icon({
                iconUrl: 'img/iss.png',
                iconSize: [100, 64]
            });
            const marker = L.marker([0, 0], {icon: iss_icon}).addTo(mymap);

            
            

            //const tileUrl = 'http://a.tile.openstreetmap.fr/hot/{z}/{x}/{y}.png';
            //const tileUrl =  'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png';
            const tileUrl =  'https://cartodb-basemaps-{s}.global.ssl.fastly.net/light_all/{z}/{x}/{y}.png';
            const tiles = L.tileLayer(tileUrl, { attribution });
            tiles.addTo(mymap);

            const API_URL = 'https://api.wheretheiss.at/v1/satellites/25544';
            async function getData(){
                const response = await fetch(API_URL);
                const data = await response.json();
                console.log(data)
                const { latitude, longitude } = data;

                mymap.setView([latitude, longitude], 2);
                marker.setLatLng([latitude, longitude]);

                var popup = L.popup()
                .setLatLng([latitude, longitude])
                .setContent('Latitude: ' + latitude.toFixed(2) +  '<br>longitude: ' + longitude.toFixed(2))
                .openOn(mymap);
                marker.bindPopup(popup).openPopup();
                

                document.getElementById('lat').textContent = latitude;
                document.getElementById('lon').textContent = longitude;
            }

            getData();
            //setInterval(getData, 1000);
        </script>