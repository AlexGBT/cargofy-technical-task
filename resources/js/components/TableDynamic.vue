<template>
        <div>
            <table class="table">
                <thead>
                </thead>
            <tbody>
                <div v-for="load in loads">
                    <div v-for="currentRoute in load.route_way">
                        <tr @click="showMap($event)" >
                            <td>{{currentRoute.date.slice(5)}}</td>
                            <td>{{currentRoute.from}} - {{currentRoute.to}}</td>
                            <td>{{load.name}}</td>
                            <td class="td4">{{load.weight}} т</td>
                        </tr>
                        <insert-map :from="currentRoute.from" :to="currentRoute.to"  ></insert-map>
                    </div>
                 </div>
                <create-load @getlastload="getlastload"></create-load>
            </tbody>
        </table>
        </div>
</template>

<script>
    export default {
        mounted() {
            this.loadRoutes();
        },

        data: function () {
            return {
                loads: [],
                isMapCreated: false,
                map: '',
                lastLoad: this.$lastLoad,
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
            },

            getlastload(lastLoad) {
                this.loads.push(lastLoad);
            },

        },
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


