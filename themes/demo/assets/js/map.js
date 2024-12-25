const LOCATION = [37.525074, 55.807074];

async function initMap() {
    await ymaps3.ready;
    const {YMap, YMapDefaultSchemeLayer, YMapDefaultFeaturesLayer, YMapMarker, YMapLayer} = ymaps3;

    const map = new YMap(
        document.getElementById('yandex-map'),
        {
            location: {
                center: LOCATION,
                zoom: 17
            }
        },
        [new YMapDefaultSchemeLayer({}), new YMapDefaultFeaturesLayer({})]
    );

    map.addChild(new YMapDefaultSchemeLayer({
        zIndex: 1
    }));
    map.addChild(new YMapDefaultFeaturesLayer({
        zIndex: 2
    }));
    map.addChild(
        new YMapLayer({
            source: 'markerSource',
            type: 'markers',
            zIndex: 3
        })
    );

    const markerElement = document.createElement('img');
    markerElement.className = 'map-marker';
    markerElement.src = '/assets/img/logo.png';
    const marker = new YMapMarker(
        {
            source: 'markerSource',
            coordinates: LOCATION,
            draggable: true,
            mapFollowsOnDrag: true
        },
        markerElement
    );
    map.addChild(marker);
}

initMap();
