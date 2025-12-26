// Fetch buses and update GeoJSON layer + animate
async function loadIettBuses(map, animateGeoJsonPoint, prevPositions) {
    try {
        const res = await fetch('/api/iett/buses');
        const buses = await res.json();

        const features = buses
            .filter(bus => bus.lat && bus.lng)
            .map(bus => ({
                type: 'Feature',
                geometry: { type: 'Point', coordinates: [parseFloat(bus.lng), parseFloat(bus.lat)] },
                properties: {
                    id: bus.id,
                    line: bus.line || bus.HatKodu || 'UNKNOWN',
                    speed: bus.speed,
                    time: bus.time
                }
            }));

        const source = map.getSource('buses');
        if (source) {
            source.setData({ type: 'FeatureCollection', features });
        }

        // Animate all buses
        buses.forEach(bus => {
            if (!bus.lat || !bus.lng) return;

            const id = bus.id;
            const newPos = { lat: parseFloat(bus.lat), lng: parseFloat(bus.lng) };

            if (prevPositions.has(id)) {
                const oldPos = prevPositions.get(id);
                animateGeoJsonPoint(id, oldPos, newPos);
            }

            prevPositions.set(id, newPos);
        });

    } catch (err) {
        console.error('Error loading buses:', err);
    }
}