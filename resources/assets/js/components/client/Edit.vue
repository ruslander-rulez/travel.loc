<template>
    <uiv-modal v-model="showPopup" title="Редактирование Клиента" size="lg" v-on:hide="close">
        <div class="row">
            <div class="col-md-12">
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-settings">Клиент</i>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="form-group row">
                            <label class="col-md-2 control-label">Имя</label>
                            <div class="col-md-10" v-bind:class="errors['name'] !== undefined ? 'has-error' : ''">
                                <input type="text" class="form-control" placeholder="Имя"
                                       v-model="client.name">
                                <error-block :errors="errors['name']" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 control-label">Email</label>
                            <div class="col-md-10" v-bind:class="errors['email'] !== undefined ? 'has-error' : ''">
                                <input type="text" class="form-control" placeholder="Email"
                                       v-model="client.email">
                                <error-block :errors="errors['email']" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 control-label">Телефон</label>
                            <div class="col-md-10" v-bind:class="errors['phone'] !== undefined ? 'has-error' : ''">
                                <input type="text" class="form-control" placeholder="Телефон"
                                       v-model="client.phone">
                                <error-block :errors="errors['phone']" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 control-label">Паспорт</label>
                            <div class="col-md-10" v-bind:class="errors['passport'] !== undefined ? 'has-error' : ''">
                                <input type="text" class="form-control" placeholder="Паспорт"
                                       v-model="client.passport">
                                <error-block :errors="errors['passport']" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 control-label">Гражданство</label>
                            <div class="col-md-10" v-bind:class="errors['nationality'] !== undefined ? 'has-error' : ''">
                                <input type="text" class="form-control" placeholder="Гражданство"
                                       v-model="client.nationality">
                                <error-block :errors="errors['nationality']" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 control-label">Дата рождения</label>
                            <div class="col-md-10" v-bind:class="errors['birthday'] !== undefined ? 'has-error' : ''">
                                <date-picker
                                        v-model="client.birthday"
                                        confirm
                                        date-format="DD-MM-YYYY"
                                        :clearable="false"
                                        lang="ru"
                                        :first-day-of-week="1"
                                        @confirm="changeClientBirthday"
                                ></date-picker>
                                <error-block :errors="errors['birthday']" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div slot="footer">
            <button class="btn btn-sm green" @click="save">Сохранить <i class="fa fa-save"></i></button>
            <button class="btn btn-sm default" @click="close">Закрыть <i class="fa fa-close"></i></button>
        </div>
    </uiv-modal>
</template>
<script>
    import DatePicker from 'vue2-datepicker'
    import moment from 'moment'

    export default {
        components: {
            DatePicker
        },
        data() {
            return {
                showPopup: true,
                client: {},
                errors: {},
            }
        },
        computed: {
        },
        name: "editClient",
        props: ["inputEntity"],
        mounted() {
            this.client = Object.assign({}, this.inputEntity);
            this.client.birthday = (this.client.birthday.split(" "))[0]
        },
        methods: {
            changeClientBirthday: function (date) {
                this.client.birthday = moment(date).format("YYYY-MM-DD")
            },
            close: function () {
                this.$emit("close")
            },
            save: function (event) {
                this.errors = {};
                if (this.client.id !== null) {
                    window.HTTP.put(laroute.route('root.client.save', {}), this.client).then(response => {
                        if (response.status == 202) {
                            this.$emit("updated", this.client)
                            this.$emit("close")
                        }
                    }).catch(e => {
                        let responseErrors = e.response.data.errors;
                        Object.keys(responseErrors).map((item, index2) => {
                            this.errors[item] = responseErrors[item]
                        });
                        this.errors = Object.assign({}, this.errors);
                    });
                }
                else {
                    window.HTTP.post(laroute.route('root.client.create', {}), this.client).then(response => {
                        if (response.status == 201) {
                            this.$emit("created")
                            this.$emit("close")
                        }
                    }).catch(e => {
                        var responseErrors = e.response.data.errors;
                        Object.keys(responseErrors).map((item, index2) => {
                            this.errors[item] = responseErrors[item]
                        })
                        this.errors = Object.assign({}, this.errors);
                    });
                }

            },
        },
    }
</script>
<style scoped>
</style>