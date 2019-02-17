<template>
    <uiv-modal v-model="showPopup" title="Новый участник группы" size="lg" v-on:hide="close">
        <div class="row">
            <div class="col-md-12">
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-settings">Бронирование</i>
                        </div>
                        <ul class="nav nav-tabs">
                            <li v-bind:class="tab === 1 ? 'active' : ''">
                                <a href="#" v-on:click.prevent="tab=1">Поиск</a>
                            </li>
                            <li
                                v-bind:class="tab === 2 ? 'active' : ''"
                            >
                                <a href="#"
                                   v-on:click.prevent="tab=2"
                                >Создание</a>
                            </li>
                        </ul>
                    </div>
                    <div class="portlet-body">
                        <div class="div" v-if="tab===1">
                            <div class="form-group row">
                                <label class="col-md-2 control-label">Поиск</label>
                                <div class="col-md-10" v-bind:class="errors['group_name'] !== undefined ? 'has-error' : ''">
                                    <input type="text" class="form-control" placeholder="Email or passport"
                                           v-model="search">
                                </div>
                            </div>
                            <div class="form-group row" v-if="clients.length">
                                <label class="col-md-2 control-label">Пользователи</label>
                                <div class="col-md-10">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Имя</th>
                                                <th>Email</th>
                                                <th>Паспорт</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <tr
                                                v-for="(clientrow, index) in clients"
                                                style="cursor:pointer;"
                                                @click="selectTourist(clientrow)"
                                            >
                                                <td>{{clientrow.name}}</td>
                                                <td>{{clientrow.email}}</td>
                                                <td>{{clientrow.passport}}</td>
                                            </tr>
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="div" v-if="tab===2">
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
                tab: 1,
                search: "",
                clients:[],
                client: {
                    id: null
                },
                errors: {},
            }
        },
        computed: {
        },
        watch: {
            search: function (search) {
                window.HTTP.get(laroute.route('root.client.search', {}), { params: {search: search}}).then(response => {
                        this.clients = response.data
                }).catch(e => {
                });
            }
        },
        name: "NewTourist",
        mounted() {
        },
        methods: {
            selectTourist: function (tourist) {
                this.client = tourist
                this.save()
            },
            changeClientBirthday: function (date) {
                this.client.birthday = moment(date).format("YYYY-MM-DD")
            },
            close: function () {
                this.$emit("close")
            },
            save: function (event) {
                this.errors = {};
                if (this.client.id === null) {
                    window.HTTP.post(laroute.route('root.client.save', {}), this.client).then(response => {
                        if (response.status == 201) {
                            this.$emit("newTourist", response.data)
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
                    this.$emit("newTourist", this.client)
                    this.$emit("close")
                }

            },
        },
    }
</script>
<style scoped>
    .group-item {
        border: 1px solid #c2c7d6;
        border-radius: 3px;
    }

</style>
<style>
    .popover.top.fade.in {
        z-index: 10534;
    }
</style>