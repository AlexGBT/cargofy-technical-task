<template>
        <div>
            <table class="table">
                <thead>
                </thead>
            <tbody>
                <div v-for="load in loads">
                    <tr @click="showMap($event)">
                        <td>{{load.route_way.date.slice(5)}}</td>
                        <td>{{load.route_way.from}} - {{load.route_way.to}}</td>
                        <td>{{load.name}}</td>
                        <td class="td4">{{load.weight}} т</td>
                     </tr>
                    <insert-map :from="load.route_way.from" :to="load.route_way.to" ></insert-map>
                 </div>
            </tbody>
        </table>
        </div>
</template>

<script>
    export default {
        props: ['load'],
        mounted() {
            this.loadRoutes();
        },
        data: function () {
            return {
                loads: [],
                isMapCreated: false,
                map: '',
            }
        },
        methods: {
            loadRoutes() {
                axios.get('/api/load/')
                    .then(response => {
                        if (response.data) {
                             this.loads = response.data.data;
                        }
                    })
                    .catch(errors => {
                });
            },

            showMap( event ) {
                let mapHolder = event.target.parentElement.nextElementSibling;
                mapHolder.classList.toggle('show-map-holder');
            }
        },
        watch: {
            load: function() {
                this.load.id = this.loads.length;
                this.load.route_way.id = this.loads.length;
                this.loads.push(this.load);
            },
        }
    }


</script>

<style scoped>
    .show-map-holder {
         height: 400px !important;
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


