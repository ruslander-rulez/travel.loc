<template>
    <div>

    <uiv-modal v-model="showPopup" title="Редактирование Бронирования" size="lg" v-on:hide="close">
        <div class="row">
            <div class="col-md-12">
                <div
                    v-if="Object.keys(errors).length"
                    class="bg-danger"
                    style="margin-bottom: 10px; padding: 3px; border-radius: 4px"
                >
                    <p class=""><b>Ошибки валидации полей:</b></p>
                    <ul>
                        <li v-for="error in errors">{{ error[0]}}</li>
                    </ul>

                </div>
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-settings">Бронирование</i>
                        </div>
                        <ul class="nav nav-tabs">
                            <li v-bind:class="tab === 1 ? 'active' : ''">
                                <a href="#" v-on:click.prevent="tab=1">Основное</a>
                            </li>
                            <li
                                v-bind:class="tab === 2 ? 'active' : ''"
                            >
                                <a href="#"
                                   v-on:click.prevent="tab=2"
                                >Группа</a>
                            </li>
                        </ul>
                    </div>
                    <div class="portlet-body">
                        <div class="div" v-if="tab===1">
                            <div class="form-group row">
                                <label class="col-md-2 control-label">Корабль</label>
                                <div class="col-md-10" v-bind:class="errors['ship_id'] !== undefined ? 'has-error' : ''">
                                    <ship-select
                                        :selected="booking.ship"
                                        @change="changeShip"
                                    ></ship-select>
                                    <error-block :errors="errors['ship_id']" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 control-label">Название группы</label>
                                <div class="col-md-10" v-bind:class="errors['group_name'] !== undefined ? 'has-error' : ''">
                                    <input type="text" class="form-control" placeholder="Название группы"
                                           v-model="booking.group_name">
                                    <error-block :errors="errors['group_name']" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 control-label">Доп. инфо</label>
                                <div class="col-md-10" v-bind:class="errors['additional_info'] !== undefined ? 'has-error' : ''">
                                    <input type="text" class="form-control" placeholder="Доп. инфо"
                                           v-model="booking.additional_info">
                                    <error-block :errors="errors['additional_info']" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 control-label">Дата прихода</label>
                                <div class="col-md-4" v-bind:class="errors['arrival_date'] !== undefined ? 'has-error' : ''">
                                    <date-picker
                                            v-model="booking.arrival_date"
                                            confirm
                                            date-format="DD-MM-YYYY"
                                            :clearable="false"
                                            lang="ru"
                                            :first-day-of-week="1"
                                            @confirm="changeArrivalDate"
                                    ></date-picker>
                                    <error-block :errors="errors['arrival_date']" />
                                </div>

                                <label class="col-md-2 control-label">Дата отхода</label>
                                <div class="col-md-4" v-bind:class="errors['departure_date'] !== undefined ? 'has-error' : ''">
                                    <date-picker
                                            v-model="booking.departure_date"
                                            confirm
                                            date-format="DD-MM-YYYY"
                                            :clearable="false"
                                            lang="ru"
                                            :first-day-of-week="1"
                                            @confirm="changeDepartureDate"
                                    ></date-picker>
                                    <error-block :errors="errors['departure_date']" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 control-label">Вечерняя программа</label>
                                <div class="col-md-10" v-bind:class="errors['evening_program'] !== undefined ? 'has-error' : ''">
                                    <toggle-button @change="setEveningProgram"
                                                   :value="!!+booking.evening_program"
                                                   :sync="true"
                                                   :height="30"
                                                   :width="65"
                                                   :labels="{checked: 'ДА', unchecked: 'НЕТ'}"
                                    />
                                    <error-block :errors="errors['evening_program']" />
                                </div>
                            </div>
                        </div>
                        <div class="div" v-if="tab===2">
                            <div class="row">
                                <div class="col-md-12" style="margin-bottom: 15px;">
                                    <div class="btn-group">
                                        <button id="sample_editable_1_new" class="btn sbold green" v-on:click="showNewTouristForm=true">
                                            Добавить участникка
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>

                                <label class="col-md-2 control-label">Состав группы</label>
                                <div class="col-md-10">
                                    <div class="row" v-for="(tourist, index) in booking.tourists">
                                        <div class="col-md-11 group-item">
                                            <div class="row">
                                                <div class="col-md-10">
                                                    <div>Имя - <b>{{ tourist.name }}</b> </div>
                                                    <div v-if="tourist.birthday">Дата рождения - <b>{{(tourist.birthday.split(" "))[0] }}</b> </div>
                                                    <div>Паспорт - <b>{{ tourist.passport }}</b> </div>
                                                    <div>Email - <b>{{ tourist.email }}</b> </div>
                                                    <div>Телефон <b>{{ tourist.phone }}</b> </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <label class="checkbox-inline">
                                                        <input
                                                            type="checkbox"
                                                            v-model="leaderArray"
                                                            v-bind:value="tourist.id"
                                                            @change="changeLeader(tourist)"
                                                        > Лидер
                                                    </label>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-md-1">
                                            <delete-button
                                                    @deleteItem="deleteTourist(index)"
                                            />
                                        </div>
                                    </div>
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
    <new-tourist v-if="showNewTouristForm" @close="showNewTouristForm=false" @newTourist="attachTourist"></new-tourist>
    </div>
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
                booking: {},
                errors: {},
                leaderArray:[],
                showNewTouristForm: false
            }
        },
        computed: {
        },
        name: "editBooking",
        props: ["inputEntity"],
        mounted() {
            this.booking = Object.assign({}, this.inputEntity);
            this.booking.tourists = this.inputEntity.tourists.slice();
            this.booking.departure_date = (this.booking.departure_date.split(" "))[0]
            this.booking.arrival_date = (this.booking.arrival_date.split(" "))[0]
            this.leaderArray.push(this.booking.leader_id)
        },
        methods: {
            attachTourist: function(tourist) {
                this.booking.tourists.push(tourist)
            },
            deleteTourist: function (index) {
                if (this.leaderArray[0] == this.booking.tourists[index].id) {
                    alert("Нельзя удатить лидера группы")
                    return
                }
                this.booking.tourists.splice(index, 1)
            },
            changeLeader: function(leader) {
                this.leaderArray = [leader.id]
                this.booking.leader = leader
                this.booking.leader_id = leader.id
            },
            changeArrivalDate: function (date) {
                this.booking.arrival_date = moment(date).format("YYYY-MM-DD")
            },
            changeDepartureDate: function (date) {
                this.booking.departure_date = moment(date).format("YYYY-MM-DD")
            },
            changeShip: function(value) {
                if (typeof value === "undefined") {
                    return
                }
                if (value) {
                    this.booking.ship_id = value.id
                    this.booking.ship = value
                }
                if (!value) {
                    this.booking.ship = null
                    this.booking.ship_id = null
                }
            },
            setEveningProgram: function(val) {
                this.booking.evening_program = val.value
            },
            close: function () {
                this.$emit("close")
            },
            save: function (event) {
                this.errors = {};
                if (this.booking.id !== null) {
                    window.HTTP.put(laroute.route('root.booking.save', {}), this.booking).then(response => {
                        if (response.status == 202) {
                            this.$emit("updated", this.booking)
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
                    window.HTTP.post(laroute.route('root.booking.create', {}), this.booking).then(response => {
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
    .group-item {
        border: 1px solid #c2c7d6;
        border-radius: 3px;
    }

</style>
<style>
    .popover.top.fade.in {
        z-index: 10534;
    }
     .modal-backdrop.fade.in {
         z-index: auto !important;
     }
</style>