<template>
    <div>
        <form v-on:submit.prevent="onSubmit">
             <div class="row">
                <div class="col-8 offset-2">
                    <div class="form-group row">
                        <label for="date" class="col-md-2 col-form-label">дата</label>
                        <input id="date"
                               type="date"
                               class="form-control"
                               name="date"
                               v-model="date"
                               required
                        >
                    </div>
                    <div class="form-group row">
                        <label for="from" class="col-md-2 col-form-label">звідки</label>
                        <input id="from"
                               type="text"
                               class="form-control"
                               name="from"
                               v-model="fromWho"
                               required
                        >
                    </div>
                    <div class="form-group row">
                        <label for="to" class="col-md-2 col-form-label">куди</label>
                        <input id="to"
                               type="text"
                               class="form-control"
                               name="to"
                               v-model="toWhom"
                               required
                        >
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-md-2 col-form-label">назва</label>
                        <input id="name"
                               type="text"
                               class="form-control"
                               name="name"
                               v-model="name"
                               required
                        >
                    </div>
                    <div class="form-group row">
                        <label for="weight" class="col-md-2 col-form-label">вага</label>
                        <input id="weight"
                               type="number"
                               class="form-control"
                               name="weight"
                               v-model="weight"
                               required
                        >
                    </div>
                    <div class="form-group row">
                         <input type="submit" class="btn btn-primary" value="Створити">
                    </div>
                </div>
            </div>
        </form>
     </div>
</template>

<script>
    export default {
        mounted() {
             this.loadRoutes();
        },

        data: function () {
            return {
                date: '',
                fromWho:'',
                toWhom:'',
                name: '',
                weight: 0,
                loadsArray: [],
            }
        },

        methods: {
            onSubmit() {
                $('#addLoadModal').modal('hide');
                axios.post('/api/load/store', {
                    date: this.date,
                    from: this.fromWho,
                    to: this.toWhom,
                    name: this.name,
                    weight: this.weight
                })
                .then(response => {
                    if ( response.status == 201) {
                        this.saveData()
                    }
                })
                .catch(errors => {
                    alert('You enterd unknown data');
                });
            },

            saveData() {
                this.loadsArray.unshift({
                    weight: this.weight,
                    name: this.name,
                    route_way: {
                        to: this.toWhom,
                        from: this.fromWho,
                        date: this.date
                    }
                });
                this.$emit("getloads", this.loadsArray);
            },
            loadRoutes() {
                axios.get('/api/load/')
                .then(response => {
                    if (response.data) {
                        this.loadsArray = response.data;
                        this.$emit("getloads", response.data);
                    }
                })
                .catch(errors => {
                });
            }
        }
    }
</script>
