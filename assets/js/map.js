let map, markerSource, markerDest;

function initMap() {
    map = L.map('map').setView([20.5937, 78.9629], 5); // Default view: India

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    markerSource = L.marker([20.5937, 78.9629]).addTo(map);
    markerDest = L.marker([20.5937, 78.9629]).addTo(map);

    setupAutocomplete('source', 'source_lat', 'source_lon', markerSource);
    setupAutocomplete('destination', 'dest_lat', 'dest_lon', markerDest);
}

function setupAutocomplete(inputId, latId, lonId, marker) {
    const input = document.getElementById(inputId);
    input.addEventListener('input', debounce(function() {
        const query = input.value;
        if (query.length < 3) return;

        fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(query)}&addressdetails=1&limit=5`)
            .then(response => response.json())
            .then(data => {
                if (data.length > 0) {
                    const suggestions = data.map(item => {
                        const address = item.address;
                        const displayName = `${address.city || ''}, ${address.state || ''}, ${address.country || ''}`.replace(/,,/g, ',').trim();
                        return { displayName, lat: item.lat, lon: item.lon };
                    }).filter(item => item.displayName !== ',');

                    const suggestionBox = document.createElement('div');
                    suggestionBox.className = 'suggestions';
                    suggestionBox.style.position = 'absolute';
                    suggestionBox.style.background = 'white';
                    suggestionBox.style.border = '1px solid #ccc';
                    suggestionBox.style.zIndex = '1000';
                    suggestionBox.style.width = input.offsetWidth + 'px';

                    suggestions.forEach(suggestion => {
                        const div = document.createElement('div');
                        div.style.padding = '5px';
                        div.style.cursor = 'pointer';
                        div.textContent = suggestion.displayName;
                        div.addEventListener('click', () => {
                            input.value = suggestion.displayName;
                            document.getElementById(latId).value = suggestion.lat;
                            document.getElementById(lonId).value = suggestion.lon;
                            marker.setLatLng([suggestion.lat, suggestion.lon]);
                            map.setView([suggestion.lat, suggestion.lon], 10);
                            suggestionBox.remove();
                        });
                        suggestionBox.appendChild(div);
                    });

                    input.parentNode.appendChild(suggestionBox);
                }
            });
    }, 500));
}

function debounce(func, wait) {
    let timeout;
    return function(...args) {
        clearTimeout(timeout);
        timeout = setTimeout(() => func.apply(this, args), wait);
    };
}

document.addEventListener('DOMContentLoaded', initMap);