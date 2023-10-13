var fn = {
    timestamp: '',
    index: 12,
    point: [
        [40.39852202631353, -4.000077577483683],
        [40.40058058942735, -4.002363571504287],
        [40.40190845636247, -4.00535872432245],
        [40.40183221591893, -4.010306149443927],
        [40.401031685957335, -4.014335839735763],
        [40.400320095755205, -4.019658701807124],
        [40.39998335849247, -4.024080515169095],
        [40.39976098390548, -4.028485642432094],
        [40.399926176524644, -4.032256698355719],
        [40.39878888066595, -4.035977695996014],
        [40.39761979669923, -4.039031250125638],
        [40.39639350750894, -4.042577043770735],
        [40.3973719991359, -4.045572196615887],
        [40.398344122832995, -4.04897615851518],
        [40.39984993381581, -4.051812793556449],
        [40.40124134947912, -4.054273991573252],
        [40.40259461657761, -4.056993823944689],
        [40.40389703104488, -4.05979708673841],
        [40.4062794312767, -4.0610151711435485],
        [40.40825517131699, -4.060781565877964],
        [40.41044684076308, -4.061232090234082],
        [40.41311486373797, -4.058745863131248],
        [40.415160276394225, -4.058337053964486],
        [40.41743429573262, -4.058286995698082],
        [40.41973364495206, -4.057452691293404],
        [40.42189318314917, -4.056601700804335],
        [40.42406535458663, -4.056092775110119],
    ],
    flightPlanCoordinates: [],

    currentLocation: $("#currentLocation"),

    initMap: function () {
        console.log('Index', fn.index)
        const map = new google.maps.Map(document.getElementById("map"), {
            zoom: 14,
            center: { lat: fn.point[fn.index][0], lng: fn.point[fn.index][1] },
            // mapTypeId: "terrain",
        });
        new google.maps.Marker({
            position: { lat: fn.point[fn.index][0], lng: fn.point[fn.index][1] },
            map,
            title: "Current Position",
        });
        const new_point = { lat: fn.point[fn.index][0], lng: fn.point[fn.index][1] };
        fn.flightPlanCoordinates.push(new_point);
        const flightPath = new google.maps.Polyline({
            path: fn.flightPlanCoordinates,
            geodesic: true,
            strokeColor: "#FF0000",
            strokeOpacity: 1.0,
            strokeWeight: 2,
        });

        flightPath.setMap(map);





        $.ajax({
            url: 'https://maps.googleapis.com/maps/api/geocode/json?latlng='+fn.point[fn.index][0]+','+fn.point[fn.index][1]+'&key=AIzaSyDiZWS8nBscbzohPYAuyaPQx-ADDgt9ujI',
            method: 'GET',
            success: function (response) {
                App.setToasterSuccess("Location Updated: " + response.results[0].formatted_address);
                fn.currentLocation.text(response.results[0].formatted_address);
            }
        });

        if (fn.index == fn.point.length-1) clearInterval(fn.timestamp);
        fn.index++;
    },


    // Initialize application
    init: function() {
        // if (fn.alert[0].innerText.trim()) {
        //     App.setToasterSuccess(fn.alert[0].innerText.trim());
        // };

        for (let i=0; i<fn.index; i++) {
            const new_point = { lat: fn.point[i][0], lng: fn.point[i][1] };
            fn.flightPlanCoordinates.push(new_point);
        };

        window.initMap = fn.initMap;

        fn.timestamp = setInterval(window.initMap, 10000);
    }
}

// fn.init();
