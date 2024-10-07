function initAutocomplete() {
    var input = document.getElementById('pac-input');
    var searchBox = new google.maps.places.SearchBox(input);

    document.getElementById('search-button').addEventListener('click', function() {
        var places = searchBox.getPlaces();

        if (!places || places.length == 0) {
            console.log("No places found");
            return;
        }

        var place = places[0];

        if (!place.geometry) {
            console.log("Returned place contains no geometry");
            return;
        }

        var lat = place.geometry.location.lat();
        var lng = place.geometry.location.lng();
        window.location.href = `inicio.html?lat=${lat}&lng=${lng}`;
    });

    // Adicionar um listener ao campo de pesquisa para funcionar quando pressionar Enter
    input.addEventListener('keypress', function(event) {
        if (event.key === 'Enter') {
            event.preventDefault(); // Impedir o envio do formulário
            var places = searchBox.getPlaces();

            if (!places || places.length == 0) {
                console.log("No places found");
                return;
            }

            var place = places[0];

            if (!place.geometry) {
                console.log("Returned place contains no geometry");
                return;
            }

            var lat = place.geometry.location.lat();
            var lng = place.geometry.location.lng();
            window.location.href = `inicio.html?lat=${lat}&lng=${lng}`;
        }
    });
}

// Espera a API do Google Maps carregar antes de chamar initAutocomplete
window.addEventListener('load', function() {
    if (typeof google !== 'undefined' && google.maps && google.maps.places) {
        initAutocomplete();
    }
});