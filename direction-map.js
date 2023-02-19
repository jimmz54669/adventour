// TO MAKE THE MAP APPEAR YOU MUST
	// ADD YOUR ACCESS TOKEN FROM
	// https://account.mapbox.com
    mapboxgl.accessToken = 'pk.eyJ1IjoiamltbXo1NDY2OSIsImEiOiJjbGRxMXZ6dWIwcjEzM3JudmF6ajlkMzBxIn0.ok5-05NpYOFRXpXR_o670w';
    const map = new mapboxgl.Map({
        container: 'direction-map',
        // Choose from Mapbox's core styles, or make your own style with Mapbox Studio
        style: 'mapbox://styles/jimmz54669/cldq3242t000b01o636z0k6gc',
        
    });
        
        map.addControl(
            new MapboxDirections({
            accessToken: mapboxgl.accessToken
            }),
            'top-left'
        );

        //Add Fullscreen Control to map.
        map.addControl(new mapboxgl.FullscreenControl());
        
        // Add geolocate control to the map.
        map.addControl(
        new mapboxgl.GeolocateControl({
            positionOptions: {
            enableHighAccuracy: true
            },
            // When active the map will receive updates to the device's location as it changes.
            trackUserLocation: true,
            // Draw an arrow next to the location dot to indicate which direction the device is heading.
            showUserHeading: true
            })
        );

        // Add zoom and rotation controls to the map.
        map.addControl(new mapboxgl.NavigationControl());
