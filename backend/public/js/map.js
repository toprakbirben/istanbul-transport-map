const prevPositions = new Map(); // track last positions

document.addEventListener('DOMContentLoaded', () => {
    tt.setProductInfo('IstanbulTransportMap', '1.0');

    const map = tt.map({
        key: window.TOMTOM_API_KEY,
        container: 'map',
        center: [28.9784, 41.0082],
        zoom: 11,
        style: 'https://api.tomtom.com/style/2/custom/style/dG9tdG9tQEBAZ1Vsa3hnSWNta2VoWWFCNjtPmonpMEtCRZB5evq5dNfq.json'
    });

    // Animate a point in the GeoJSON layer
    function animateGeoJsonPoint(id, from, to, duration = 1500) {
        const start = performance.now();
        function frame(now) {
            const t = Math.min((now - start) / duration, 1);
            const lng = from.lng + (to.lng - from.lng) * t;
            const lat = from.lat + (to.lat - from.lat) * t;

            const source = map.getSource('buses');
            if (!source) return;

            const data = source._data;
            data.features.forEach(f => {
                if (f.properties.id === id) {
                    f.geometry.coordinates = [lng, lat];
                }
            });
            source.setData(data);

            if (t < 1) requestAnimationFrame(frame);
        }
        requestAnimationFrame(frame);
    }

    // When map is loaded
    map.on('load', () => {
        // Create GeoJSON source
        map.addSource('buses', {
            type: 'geojson',
            data: { type: 'FeatureCollection', features: [] }
        });

        // Create circle layer
        map.addLayer({
            id: 'buses-layer',
            type: 'circle',
            source: 'buses',
            paint: {
                'circle-radius': 6,
                'circle-color': '#38bdf8',
                'circle-stroke-width': 1,
                'circle-stroke-color': '#000'
            }
        });

        // Initial load + poll every 15s
        loadIettBuses(map, animateGeoJsonPoint, prevPositions);
        setInterval(() => loadIettBuses(map, animateGeoJsonPoint, prevPositions), 15000);
    });
});