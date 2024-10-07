function initMap() {
    function getQueryParams() {
        var params = {};
        var queryString = window.location.search.substring(1);
        var regex = /([^&=]+)=([^&]*)/g;
        var m;
        while (m = regex.exec(queryString)) {
            params[decodeURIComponent(m[1])] = decodeURIComponent(m[2]);
        }
        return params;
    }

    var params = getQueryParams();
    var lat = parseFloat(params.lat);
    var lng = parseFloat(params.lng);

    if (!isNaN(lat) && !isNaN(lng)) {
        var location = { lat: lat, lng: lng };

        var panorama = new google.maps.StreetViewPanorama(
            document.getElementById('street-view'), {
                position: location,
                pov: {
                    heading: 165,
                    pitch: 0
                },
                zoom: 1,
                enableCloseButton: false
            });

        var vrMode = false;

        document.getElementById('toggle-vr').addEventListener('click', function() {
            vrMode = !vrMode;
            panorama.setOptions({
                enableCloseButton: !vrMode,
                motionTracking: vrMode,
                motionTrackingControl: vrMode
            });
            if (vrMode) {
                panorama.requestMotionTracking();
            }
        });
    } else {
        console.error("Invalid coordinates");
    }
}

window.addEventListener('load', initMap);
