<template>
    <div>
        <table class="table">
            <thead>
            </thead>
            <tbody>
                <div v-for="load in loads">
                    <tr @click="showMap(loads.indexOf(load))" class="tr1" >
                        <td>{{load.name}}</td>
                        <td class="td4">{{load.weight}} т</td>
                    </tr>
                    <ol>
                        <li v-for="currentRoute in load.route_ways">
                            {{currentRoute.address}}:  {{currentRoute.date}}
                        </li>
                    </ol>
                    <insert-map :addresses="load.route_ways"  :isShow="loads[loads.indexOf(load)].is_show" v-show="loads[loads.indexOf(load)].is_show"  ></insert-map>
                </div>
                <create-load @getlastload="getlastload"></create-load>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        created() {
            this.loadRoutes();
        },

        data: function () {
            return {
                loads: [],
                is_show_map: '',
             }
        },

        methods: {
            loadRoutes() {
                axios.get('/api/load/')
                    .then(response => {
                        if (response.data) {
                            this.loads = response.data.data.map( load => {
                                load.is_show = false;
                                return load
                            });
                        }
                    })
                    .catch(errors => {
                        alert("Server does not work");
                    });
            },

            showMap( loadId ) {
                 this.loads[loadId].is_show = !this.loads[loadId].is_show;
            },

            getlastload(lastLoad) {
                lastLoad.is_show = false;
                this.loads.push(lastLoad);
                $('#addLoadModal').modal('hide');
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
        width: 30vw;
        background: #bdffaf;
    }
</style>










<!--<template>-->
<!--    <div>-->
<!--        <table class="table">-->
<!--            <thead>-->
<!--            </thead>-->
<!--            <tbody>-->
<!--            <div v-for="load in loads">-->
<!--                <tr @click="showMap(loads.indexOf(load))" class="tr1" >-->
<!--                    <td>{{load.name}}</td>-->
<!--                    <td class="td4">{{load.weight}} т</td>-->
<!--                </tr>-->
<!--                <ol>-->
<!--                    <li v-for="currentRoute in load.route_ways">-->
<!--                        {{currentRoute.address}}:  {{currentRoute.date}}-->
<!--                    </li>-->
<!--                </ol>-->
<!--                <insert-map :addresses="load.route_ways"  v-show="loads[loads.indexOf(load)].is_show" ></insert-map>-->
<!--                &lt;!&ndash;                    v-show="loadsVShow[loads.indexOf(load)].is_show"&ndash;&gt;-->
<!--            </div>-->
<!--            <create-load @getlastload="getlastload"></create-load>-->
<!--            </tbody>-->
<!--        </table>-->
<!--    </div>-->
<!--</template>-->

<!--<script>-->
<!--    export default {-->
<!--        created() {-->
<!--            this.loadRoutes();-->
<!--        },-->

<!--        data: function () {-->
<!--            return {-->
<!--                loads: [],-->
<!--                is_show_map: '',-->
<!--                // loadsVShow: [{id:1,is_show:true},{id:2,is_show:false},{id:3,is_show:true},{id:4,is_show:true},{id:5,is_show:true},{id:1,is_show:true},{is_show:true}]-->
<!--                loadsVShow:  [],-->
<!--            }-->
<!--        },-->

<!--        methods: {-->
<!--            loadRoutes() {-->

<!--                axios.get('/api/load/')-->
<!--                    .then(response => {-->
<!--                        if (response.data) {-->
<!--                            // this.loads = response.data.data;-->
<!--                            // this.loads.forEach( load => {-->
<!--                            //     load.is_show = true;-->
<!--                            // });-->

<!--                            this.loads = response.data.data.map( load => {-->
<!--                                load.is_show = true;-->
<!--                                return load-->
<!--                            });-->

<!--                            this.loadsVShow = this.loads.map( load => {-->
<!--                                return { id:load.id, is_show:true }-->
<!--                            });-->
<!--                            console.log(this.loads);-->
<!--                            console.log(this.loadsVShow);-->
<!--                        }-->
<!--                    })-->
<!--                    .catch(errors => {-->
<!--                    });-->
<!--            },-->

<!--            showMap( loadId ) {-->

<!--                this.loads[loadId].is_show = !this.loads[loadId].is_show;-->
<!--                console.log(loadId);-->
<!--                // this.is_show = !this.is_show;-->
<!--                // let mapHolder = event.target.parentElement.nextElementSibling;-->
<!--                // mapHolder.classList.toggle('show-map-holder');-->
<!--            },-->

<!--            getlastload(lastLoad) {-->
<!--                this.loads.unshift(lastLoad);-->
<!--            },-->

<!--        },-->
<!--    }-->


<!--</script>-->

<!--<style scoped>-->
<!--    .show-map-holder {-->
<!--        height: 400px !important;-->
<!--    }-->

<!--    table {-->
<!--        border: 1px solid orange;-->
<!--    }-->
<!--    table td{-->
<!--        cursor: pointer;-->
<!--        width: 30vw;-->
<!--        background: #bdffaf;-->
<!--    }-->
<!--</style>-->



