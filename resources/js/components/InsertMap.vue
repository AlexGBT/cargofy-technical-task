<template>
    <div id="map">
    </div>
</template>

<script>
    export default {

        props: ['addresses', 'isShow'],

        data: function () {
            return {
                map: '',
                isMapBuilded: false,
            }
        },

        methods: {
            buildRoute: function (  ) {
                let mapHolder = this.$el;
                var directionsService = new google.maps.DirectionsService;
                var directionsDisplay = new google.maps.DirectionsRenderer;
                const options = {
                    center: new google.maps.LatLng(59.93, 30.32)
                }
                let points = this.addresses.map(function (currentAddress) {
                    return currentAddress.address;
                });
                let origin = points.shift();
                let destination = points.pop();

                let directionServiceParameters = {
                    origin: origin,
                    travelMode: 'DRIVING',
                    destination: destination,
                }

                let waypoints = points.map(function (point) {
                     return  {location:point, stopover:true}
                });
                if (waypoints.length) {
                    directionServiceParameters.waypoints = waypoints;
                }
                this.map = new google.maps.Map(mapHolder, options);
                directionsDisplay.setMap(this.map);



                directionsService.route( directionServiceParameters, function (response, status) {
                    if (status === 'OK') {
                        directionsDisplay.setDirections(response);
                    } else {
                        alert('Your destination was not found');
                    }
                });
            },


            translit: function(str) {
                var ru = {
                    'а': 'a', 'б': 'b', 'в': 'v', 'г': 'g', 'д': 'd',
                    'е': 'e', 'ё': 'e', 'ж': 'j', 'з': 'z', 'и': 'i',
                    'к': 'k', 'л': 'l', 'м': 'm', 'н': 'n', 'о': 'o',
                    'п': 'p', 'р': 'r', 'с': 's', 'т': 't', 'у': 'u',
                    'ф': 'f', 'х': 'h', 'ц': 'c', 'ч': 'ch', 'ш': 'sh',
                    'щ': 'shch', 'ы': 'y', 'э': 'e', 'ю': 'u', 'я': 'ya'
                }, n_str = [];

                str = str.replace(/[ъь]+/g, '').replace(/й/g, 'i');

                for ( var i = 0; i < str.length; ++i ) {
                    n_str.push(
                        ru[ str[i] ]
                        || ru[ str[i].toLowerCase() ] == undefined && str[i]
                        || ru[ str[i].toLowerCase() ].replace(/^(.)/, function ( match ) { return match.toUpperCase() })
                    );
                }
                return n_str.join('');
            },

        },

        watch: {
            isShow: function () {
                if (!this.isMapBuilded) {
                    this.buildRoute();
                    this.isMapBuilded = true;
                }
            }
        },
    }
</script>

<style scoped>
    #map {
        height: 400px !important;
    }
</style>





<!--buildRoute: function (  ) {-->
<!--let mapHolder = this.$el;-->
<!--var directionsService = new google.maps.DirectionsService;-->
<!--var directionsDisplay = new google.maps.DirectionsRenderer;-->
<!--const options = {-->
<!--center: new google.maps.LatLng(59.93, 30.32)-->
<!--}-->
<!--this.map = new google.maps.Map(mapHolder, options);-->
<!--directionsDisplay.setMap(this.map);-->

<!--directionsService.route({-->
<!--origin: 'Kiev',-->
<!--destination: 'Minsk',-->
<!--waypoints : [{location:'drujkovka', stopover:true},{location:'Slavyansk', stopover:true}],-->
<!--travelMode: 'DRIVING'-->
<!--}, function (response, status) {-->
<!--if (status === 'OK') {-->
<!--directionsDisplay.setDirections(response);-->
<!--} else {-->
<!--alert('Your destination was not found');-->
<!--}-->
<!--});-->
<!--},-->



<!--<template>-->
<!--    <div class="map">-->
<!--        HEloooooasha-->

<!--    </div>-->
<!--</template>-->

<!--<script>-->
<!--    export default {-->
<!--        props: ['addresses', 'isShow'],-->

<!--        mounted() {-->


<!--        },-->
<!--        //-->
<!--        data: function () {-->
<!--            return {-->
<!--                map: '',-->
<!--                title: '',-->
<!--            }-->
<!--        },-->
<!--        //-->
<!--        methods: {-->
<!--            buildRoute: function ( from, to ) {-->
<!--                let mapHolder = this.$el;-->
<!--                var directionsService = new google.maps.DirectionsService;-->
<!--                var directionsDisplay = new google.maps.DirectionsRenderer;-->
<!--                const options = {-->
<!--                    center: new google.maps.LatLng(59.93, 30.32)-->
<!--                }-->
<!--                this.map = new google.maps.Map(mapHolder, options);-->
<!--                directionsDisplay.setMap(this.map);-->

<!--                directionsService.route({-->
<!--                    origin: this.translit(from),-->
<!--                    destination: this.translit(to),-->
<!--                    travelMode: 'DRIVING'-->
<!--                }, function (response, status) {-->
<!--                    if (status === 'OK') {-->
<!--                        directionsDisplay.setDirections(response);-->
<!--                    } else {-->
<!--                        alert('Your destination was not found');-->
<!--                    }-->
<!--                });-->
<!--            },-->

<!--            translit: function(str) {-->
<!--                var ru = {-->
<!--                    'а': 'a', 'б': 'b', 'в': 'v', 'г': 'g', 'д': 'd',-->
<!--                    'е': 'e', 'ё': 'e', 'ж': 'j', 'з': 'z', 'и': 'i',-->
<!--                    'к': 'k', 'л': 'l', 'м': 'm', 'н': 'n', 'о': 'o',-->
<!--                    'п': 'p', 'р': 'r', 'с': 's', 'т': 't', 'у': 'u',-->
<!--                    'ф': 'f', 'х': 'h', 'ц': 'c', 'ч': 'ch', 'ш': 'sh',-->
<!--                    'щ': 'shch', 'ы': 'y', 'э': 'e', 'ю': 'u', 'я': 'ya'-->
<!--                }, n_str = [];-->

<!--                str = str.replace(/[ъь]+/g, '').replace(/й/g, 'i');-->

<!--                for ( var i = 0; i < str.length; ++i ) {-->
<!--                    n_str.push(-->
<!--                        ru[ str[i] ]-->
<!--                        || ru[ str[i].toLowerCase() ] == undefined && str[i]-->
<!--                        || ru[ str[i].toLowerCase() ].replace(/^(.)/, function ( match ) { return match.toUpperCase() })-->
<!--                    );-->
<!--                }-->
<!--                return n_str.join('');-->
<!--            },-->

<!--        },-->

<!--        watch: {-->
<!--            isShow: function () {-->
<!--                console.log(this.addresses);-->
<!--            }-->
<!--        },-->
<!--    }-->
<!--</script>-->

<!--<style scoped>-->
<!--    .map {-->
<!--        height: 400px !important;-->
<!--    }-->
<!--</style>-->
