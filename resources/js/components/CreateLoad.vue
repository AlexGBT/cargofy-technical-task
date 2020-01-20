<template>
    <div>
        <div class="modal fade" id="addLoadModal" tabindex="-1" role="dialog" aria-labelledby="addLoadModal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" >Додати</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
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
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                date: '',
                fromWho:'',
                toWhom:'',
                name: '',
                weight: 0,
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
                    this.$emit("getlastload", response.data.data);
                    setTimeout(function () {
                        document.getElementsByTagName('table')[0].lastChild.lastChild.scrollIntoView({block: "center", behavior: "smooth"});
                    },100);
                })
                .catch(errors => {
                    alert('You enterd unknown data');
                });
            },
        }
    }
</script>
