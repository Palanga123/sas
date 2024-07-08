// Initialize map api, Leaflet JS

let map = L.map('map').setView([-12.806087840744508, 28.239504844034045], 13)

L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 29,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
}).addTo(map)

let marker



let id = document.getElementById("user_id").value

let data = new FormData()
data.append("id", id)


// Get map coordinates from the database using the id as a query factor. Response is the coordinates of the trunk in JSON format
function get() {
    fetch("../pages/gps_track.php", { method: 'post', body: data })
        .then(res =>
            res.json()
        )
        .then(txt => {
            // console.log(txt)
            if (txt) {

                if (Object.keys(txt).length === 0) {

                    console.log("No gps coordinates found for trunk:", id)
                    

                } else {

                    const latitude = txt.latitude || 0
                    const longitude = txt.longitude || 0
                    console.log("Received data Longitude:", longitude)
                    console.log("Received data Latitude:", latitude)

                    if (marker) {
                        map.removeLayer(marker)
                    }

                    marker = L.marker([latitude, longitude]).addTo(map)
                    map.setView([latitude, longitude])

                    marker.bindPopup("<b>Here is your truck</b>")

                }

            } else {
                console.error("Error:", txt)
            }
        })
        .catch(error => {
            console.error("An error has occured", error)
        })

}
setInterval(get, 5000)