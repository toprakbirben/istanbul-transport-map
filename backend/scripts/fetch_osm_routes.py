import requests
import json

# Overpass API endpoint
url = "https://overpass-api.de/api/interpreter"

# Query from above
query = """
[out:json];
area[name="İstanbul"]->.a;
(
  relation["route"="bus"](area.a);
);
out geom;
"""

# Send POST request
r = requests.post(url, data={'data': query})
r.raise_for_status()

data = r.json()

# Convert to GeoJSON format (simple conversion)
geojson = {
    "type": "FeatureCollection",
    "features": []
}

for element in data.get('elements', []):
    if element['type'] != 'relation' or 'members' not in element:
        continue

    coords = []
    for m in element['members']:
        if m['type'] == 'way' and 'geometry' in m:
            coords.extend([[pt['lon'], pt['lat']] for pt in m['geometry']])

    if not coords:
        continue

    feature = {
        "type": "Feature",
        "properties": {
            "name": element.get('tags', {}).get('name', None),
            "ref": element.get('tags', {}).get('ref', None)
        },
        "geometry": {
            "type": "LineString",
            "coordinates": coords
        }
    }
    geojson["features"].append(feature)

# Save to file for Laravel
with open("storage/app/routes/istanbul_bus_routes.geojson", "w", encoding="utf-8") as f:
    json.dump(geojson, f, ensure_ascii=False, indent=2)

print("GeoJSON saved with", len(geojson["features"]), "routes")