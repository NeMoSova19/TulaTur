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

        ymaps.geolocation.get({provider:"yandex",enableHighAccuracy: true,timeout: 5000,maximumAge: 0,})
            .then(function(res){
                console.log(res);
                currentPlace = res.geoObjects.get(0).properties.get('text')
                console.log("CurrentPlace = " + currentPlace)

                toPlace = "Тула, " + document.querySelector(".adress-map").innerHTML;
                console.log("ToPlace: " + toPlace);

                control.routePanel.state.set({
                    type: 'masstransit',
                    fromEnabled: true,
                    from: currentPlace,
                    toEnabled: false,
                    to: `${city}, ${toPlace}`,
                });
            
        })
        .catch(function(err){
            console.warn(`ERROR(${err.code}): ${err.message}`);
        });
    }