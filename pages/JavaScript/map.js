

let map = L.map('map').setView([-12.7927948,28.2455356], 13)

L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png',{
    maxZoom: 29,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
}).addTo(map)

let marker = L.marker([-12.792,28.2455356]).addTo(map)

marker.bindPopup("<br>Your truck is here</br>")
marker.onclick = openPopup()