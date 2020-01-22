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
                                    <h5>Груз</h5>
                                    <div class="form-group row" v-bind:class="{'has-error': errorMessages.name}">
                                        <label for="name" class="col-md-2 col-form-label">назва</label>
                                        <input id="name"
                                               type="text"
                                               class="form-control"
                                               name="name"
                                               v-model="name"
                                        >
                                        <span class="alert alert-danger" v-if="errorMessages.name">
                                            {{errorMessages.name[0]}}
                                        </span>
                                    </div>

                                    <div class="form-group row" v-bind:class="{'has-error': errorMessages.weight}">
                                        <label for="weight" class="col-md-2 col-form-label">вага</label>
                                        <input id="weight"
                                               type="number"
                                               class="form-control"
                                               name="weight"
                                               v-model="weight"
                                        >
                                        <span class="alert alert-danger" v-if="errorMessages.weight">
                                            {{errorMessages.weight[0]}}
                                        </span>
                                    </div>
                                    <h5>Адреси: {{addresses.length}}</h5>
                                    <ul>
                                        <li v-for="addr in addresses">
                                           {{addr.address}}; {{addr.date}}
                                        </li>
                                    </ul>

                                    <div class="form-group row" v-bind:class="{hasError: formValidation.address.is_error}">
                                        <label for="address" class="col-md-2 col-form-label">адреса</label>
                                        <input id="address"
                                               type="text"
                                               class="form-control"
                                               name="address"
                                               v-model="address"
                                        >
                                        <span class="alert alert-danger" v-if="formValidation.address.is_error">
                                            {{formValidation.address.message}}
                                        </span>
                                    </div>

                                    <div class="form-group row" v-bind:class="{hasError: errorMessages.date}">
                                        <label for="date" class="col-md-2 col-form-label">дата</label>
                                        <input id="date"
                                               type="date"
                                               class="form-control"
                                               name="date"
                                               v-model="date"

                                        >
                                        <span class="alert alert-danger" v-if="errorMessages.date">
                                            {{errorMessages.date[0]}}
                                        </span>
                                    </div>

                                    <div class="form-group">
                                        <button type="button" class="btn btn-secondary" @click="addAddress">Додати адресу</button>
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
                date: this.getCurrentDate(),
                address:'',
                name: '',
                weight: 0,
                addresses: [],
                errorMessages:{},
                formValidation:{
                    address: {message:'',is_error:false},
                }
            }
        },

        methods: {
            onSubmit() {
                if (this.addresses.length < 2) {
                    alert ('Повиннi бути хоча б 2 адреси');
                    return
                }

                axios.post('/api/load', {
                    name: this.name,
                    weight: this.weight,
                    addresses: this.addresses,
                })
                .then(response => {
                    this.addresses =[];
                    this.errorMessages = {};
                    this.$emit("getlastload", response.data.data);
                },  (error) => {
                    this.errorMessages = error.response.data.errors;
                });
            },

            addAddress() {
                 if (this.ValidateForm()) {
                     this.addresses.push( {address:this.address, date:this.date } );
                 }
                this.address = '';
             },

            getCurrentDate() {
                let today = new Date();
                let dd = today.getDate();

                let mm = today.getMonth()+1;
                let yyyy = today.getFullYear();
                if(dd<10)
                        {
                        dd='0'+dd;
                    }
                if(mm<10)
                    {
                        mm='0'+mm;
                    }
                let currentDate =  yyyy+'-'+mm+'-'+dd;

                return currentDate;
            },

            ValidateForm() {
                if ( this.address == '' ) {
                    this.formValidation.address.is_error = true;
                    this.formValidation.address.message = 'Enter point name';
                    return false
                }

                if (this.address.length < 3) {
                    this.formValidation.address.is_error = true;
                    this.formValidation.address.message = 'Enter at least 3 symbols';
                    return false
                }

                this.formValidation.address.is_error = false;

                return true
            }
        }
    }
</script>

<style scoped>
    .has-error input  {
        border-color: #a94442;
        -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
        box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
    }
    .has-error input:focus {
        border-color: #843534;
        -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075), 0 0 6px #ce8483;
        box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075), 0 0 6px #ce8483;
    }
</style>
