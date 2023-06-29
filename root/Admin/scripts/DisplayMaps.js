  // Initialize the map
  let map = L.map('map').setView([13.77, 121.05], 15);
  // Add a tile layer from OpenStreetMap
  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: 'Map data © OpenStreetMap contributors',
  }).addTo(map);
  L.marker([13.77, 121.05]).addTo(map)
    .bindPopup('Our office is located here')
    .openPopup()