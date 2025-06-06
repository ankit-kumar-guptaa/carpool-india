let map, markerSource, markerDest;

function initMap() {
    try {
        // Initialize map with default view (India)
        map = L.map('map').setView([20.5937, 78.9629], 5);
        
        // Add OpenStreetMap tiles
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        // Initialize markers
        markerSource = L.marker([20.5937, 78.9629]).addTo(map);
        markerDest = L.marker([20.5937, 78.9629]).addTo(map);

        // Setup autocomplete for source and destination inputs
        setupAutocomplete('source', 'source_lat', 'source_lon', markerSource);
        setupAutocomplete('destination', 'dest_lat', 'dest_lon', markerDest);

        console.log("Map initialized successfully");
    } catch (error) {
        console.error("Error initializing map:", error);
    }
}

function setupAutocomplete(inputId, latId, lonId, marker) {
    const input = document.getElementById(inputId);
    if (!input) {
        console.error(`Input element with ID ${inputId} not found`);
        return;
    }

    input.addEventListener('input', debounce(function() {
        const query = input.value.trim();
        if (query.length < 3) return;

        // Use proxy to avoid CORS issue
        fetch(`/proxy.php?q=${encodeURIComponent(query)}`)
            .then(response => {
                if (!response.ok) throw new Error('Network response was not ok');
                return response.json();
            })
            .then(data => {
                console.log("Nominatim API response:", data);
                if (data.length > 0) {
                    const suggestions = data.map(item => {
                        const address = item.address;
                        const displayName = `${address.city || ''}, ${address.state || ''}, ${address.country || ''}`
                            .replace(/,,/g, ',')
                            .trim()
                            .replace(/^,|,$/g, '');
                        return { displayName, lat: item.lat, lon: item.lon };
                    }).filter(item => item.displayName);

                    // Remove existing suggestion box if any
                    const existingBox = document.querySelector('.suggestions');
                    if (existingBox) existingBox.remove();

                    // Create new suggestion box
                    const suggestionBox = document.createElement('div');
                    suggestionBox.className = 'suggestions';
                    suggestionBox.style.position = 'absolute';
                    suggestionBox.style.background = 'white';
                    suggestionBox.style.border = '1px solid #ccc';
                    suggestionBox.style.zIndex = '1000';
                    suggestionBox.style.width = input.offsetWidth + 'px';
                    suggestionBox.style.maxHeight = '200px';
                    suggestionBox.style.overflowY = 'auto';
                    suggestionBox.style.boxShadow = '0 2px 5px rgba(0,0,0,0.2)';

                    suggestions.forEach(suggestion => {
                        const div = document.createElement('div');
                        div.style.padding = '8px 10px';
                        div.style.cursor = 'pointer';
                        div.style.borderBottom = '1px solid #eee';
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

                    // Position the suggestion box below the input
                    const inputRect = input.getBoundingClientRect();
                    suggestionBox.style.top = (inputRect.bottom + window.scrollY) + 'px';
                    suggestionBox.style.left = (inputRect.left + window.scrollX) + 'px';
                    document.body.appendChild(suggestionBox);

                    // Remove suggestion box when clicking outside
                    document.addEventListener('click', function handler(e) {
                        if (!suggestionBox.contains(e.target) && e.target !== input) {
                            suggestionBox.remove();
                            document.removeEventListener('click', handler);
                        }
                    });
                }
            })
            .catch(error => {
                console.error("Error fetching suggestions:", error);
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

// Initialize map when DOM is fully loaded
document.addEventListener('DOMContentLoaded', () => {
    console.log("DOM loaded, initializing map...");
    initMap();
});