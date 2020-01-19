<template>
        <div>
            <table class="table">
                <thead>
                </thead>
            <tbody>
                <div v-for="load in loads">
                    <tr v-on:click="showMap($event, load.route_way.from, load.route_way.to)">
                        <td>{{load.route_way.date.slice(5)}}</td>
                        <td>{{load.route_way.from}} - {{load.route_way.to}}</td>
                        <td>{{load.name}}</td>
                        <td class="td4">{{load.weight}} т</td>
                     </tr>
                    <div class="mapa">
                    </div>
                 </div>
            </tbody>
        </table>
        </div>
</template>

<script>
    export default {
        props: ['loads'],
        data: function () {
            return {
                map: '',
            }
        },
        methods: {
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
            buildRoute: function(from,to,mapHolder) {
                var directionsService = new google.maps.DirectionsService;
                var directionsDisplay = new google.maps.DirectionsRenderer;
                const options = {
                    center: new google.maps.LatLng(59.93, 30.32)
                }
                this.map = new google.maps.Map(mapHolder, options);
                directionsDisplay.setMap(this.map);

                directionsService.route({
                    origin: this.translit(from),
                    destination: this.translit(to),
                    travelMode: 'DRIVING'
                },function (response,status) {
                    if (status === 'OK') {
                        directionsDisplay.setDirections(response);
                    } else {
                        alert('Your destination was not found');
                    }
                });
            },
            showMap(event,from,to) {
                let mapHolder = event.target.parentElement.nextElementSibling;
                mapHolder.classList.toggle('show-map-holder');
                if(mapHolder.classList.contains('show-map-holder')) {
                    this.buildRoute(from, to, mapHolder);
                }
            }
        },
        watch: {
            loads: function() {
                console.log(this.loads);

                let mapHolder = this.$el.querySelectorAll('.mapa');
                mapHolder.forEach(function (el) {
                    el.classList.remove('show-map-holder');
                    if (el.firstChild) {
                        el.removeChild(el.firstChild);
                    }
                })
            },
        }
    }


</script>

<style scoped>
    .show-map-holder {
         height: 400px !important;
    }
    .mapa {
         height: 0px;
         transition: height 1s;
     }
    table {
        border: 1px solid orange;
     }
    table td{
        cursor: pointer;
        width: 200px;
    }
    table .td4{
        width: 70px !important;
    }
</style>


