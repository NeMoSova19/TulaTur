ymaps.ready(init);
    var myMap, currentPlace, toPlace, coord;
    let city = 'Тула';

    function init(){     
        myMap = new ymaps.Map ("map", {
            center: [54.193122, 37.617348],
            zoom: 12,
            controls: ['routePanelControl']
        });

        let control = myMap.controls.get('routePanelControl');

        const options = {
            enableHighAccuracy: true,
            timeout: 5000,
            maximumAge: 0,
        };

        function success(pos) {
            const crd = pos.coords;
            let reverseGeocoder = ymaps.geocode([crd.latitude, crd.longitude]);

            reverseGeocoder.then(function (res) {
                currentPlace = res.geoObjects.get(0).properties.get('text')
                console.log(currentPlace)

                toPlace = "Тула, " + document.querySelector(".adress-map").innerHTML;
                console.log("ToPlace: " + toPlace);

                control.routePanel.state.set({
                    type: 'masstransit',
                    fromEnabled: true,
                    from: currentPlace,
                    toEnabled: false,
                    to: `${city}, ${toPlace}`,
                });
            });


            control.routePanel.options.set({
                types: {
                    masstransit: true,
                    auto: true,
                    pedestrian: true,
                    taxi: true
                }
            });
        }

        

        function error(err) {
            console.warn(`ERROR(${err.code}): ${err.message}`);
        }

        navigator.geolocation.getCurrentPosition(success, error, options);
    }