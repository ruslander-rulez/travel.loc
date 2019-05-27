<template>
    <div v-if="ready">

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
                            <li
                                v-bind:class="tab === 3 ? 'active' : ''"
                            >
                                <a href="#"
                                   v-on:click.prevent="tab=3"
                                >Настройка туртикетов</a>
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
                                <div class="col-md-4">
                                    <toggle-button
                                            v-model="booking.checklist.border_documents"
                                            :height="30"
                                            :width="65"
                                            :labels="{checked: 'ДА', unchecked: 'НЕТ'}"
                                    />
                                    <label class="control-label">
                                        Документы пограничникам
                                    </label>
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
                                    <div class="btn-group">
                                        <button id="user-from-file" class="btn sbold green" v-on:click="">
                                            Добавить участникков из файла
                                            <i class="fa fa-plus"></i>
                                        </button>
                                        <uiv-popover
                                                title="Прикреите файл"
                                                target="#user-from-file"
                                                v-model="showNewUsersFormFromFile"
                                        >
                                            <template slot="popover">
                                                <label>Файл
                                                    <input type="file" id="file" ref="file" v-on:change="handleFileUpload()"/>
                                                </label>
                                                <button v-on:click="submitFile()">Отправить</button>
                                            </template>
                                        </uiv-popover>
                                    </div>
                                </div>

                                <label class="col-md-2 control-label">Состав группы</label>
                                <div class="col-md-10">
                                    <div class="row" v-for="(tourist, index) in booking.tourists">
                                        <div class="col-md-10 group-item">
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
                                                    <br>
                                                    <br>
                                                    <button v-on:click="openEditClientForm(index, tourist)" title="Редактировать Клиента" class="btn btn-sm btn-default"><i class="fa fa-edit"></i></button>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-md-2">
                                            <delete-button
                                                    @deleteItem="deleteTourist(index)"
                                            />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="div" v-if="tab===3">
                            <div
                                v-for="setting in tourTicketSettings"
                                class="row"
                                style="margin-bottom: 10px;"
                            >
                                <div class="col-md-3">
                                    <p style="text-decoration: underline">
                                        {{ setting.date }}
                                    </p>
                                    <p class="form-group">
                                        <label>Вемя выхода</label>
                                        <vue-timepicker
                                                format="HH:mm"
                                                :minute-interval="5"
                                                hide-clear-button
                                                v-model='setting.time'>
                                        </vue-timepicker>
                                    </p>
                                    <p class="form-group">
                                        <label>Название программы</label>
                                        <input
                                            class="form-control"
                                            type="text"
                                            v-model='setting.programName'
                                        />
                                    </p>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group row">
                                        <label class="col-md-12 control-label">Вечерняя программа</label>
                                        <div class="col-md-12">
                                            <toggle-button
                                                    v-model="setting.eveningProgram"
                                                    :height="30"
                                                    :width="65"
                                                    :labels="{checked: 'ДА', unchecked: 'НЕТ'}"
                                            />
                                        </div>
                                    </div>
                                <div v-if="setting.eveningProgram">
                                    <p class="form-group">
                                        <label>Вемя выхода вечером</label>
                                        <vue-timepicker
                                                format="HH:mm"
                                                :minute-interval="5"
                                                hide-clear-button
                                                v-model='setting.eveningTime'>
                                        </vue-timepicker>
                                    </p>
                                    <p class="form-group">
                                        <label>Название вечерней программы</label>
                                        <input
                                                class="form-control"
                                                type="text"
                                                v-model='setting.eveningProgramName'
                                        />
                                    </p>
                                </div>

                                </div>
                                <div class="col-md-6 group-item" style="min-height: 112px;">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p style="margin: 5px">Основной выход</p>
                                            <ul style="list-style: none; padding-inline-start: 0px;">
                                            <li v-for="tourist in booking.tourists">
                                                <label>
                                                    <input
                                                            type="checkbox"
                                                            :checked="!(setting.excludeIds.includes(tourist.id))"
                                                            @change="changeExcludes(setting, tourist.id)"
                                                    > {{ tourist.name }}
                                                </label>
                                            </li>
                                        </ul>
                                        </div>

                                        <div class="col-md-6" v-if="setting.eveningProgram">
                                            <p style="margin: 5px">Вечерний выход</p>
                                            <ul style="list-style: none; padding-inline-start: 0px;">
                                            <li v-for="tourist in booking.tourists">
                                                <label>
                                                    <input
                                                            type="checkbox"
                                                            :checked="!(setting.excludeEveningIds.includes(tourist.id))"
                                                            @change="changeExcludes(setting, tourist.id, true)"
                                                    > {{ tourist.name }}
                                                </label>
                                            </li>
                                        </ul>
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

        <client-edit v-if="editClientPopup" v-on:close="editClientPopup=false" :inputEntity="clientForUpdate.tourist" v-on:updated="clientUpdated">
        </client-edit>
    <new-tourist v-if="showNewTouristForm" @close="showNewTouristForm=false" @newTourist="attachTourist"></new-tourist>
    </div>
</template>
<script>
    import DatePicker from 'vue2-datepicker'
    import moment from 'moment'
    import VueTimepicker from 'vue2-timepicker'

    export default {
        components: {
            DatePicker,
            VueTimepicker
        },
        data() {
            return {
                showPopup: true,
                tab: 1,
                ready: false,
                file: null,
                showNewUsersFormFromFile : false,
                booking: {
                    checklist: {}
                },
                errors: {},
                clientForUpdate: {
                    index: null,
                    object: {}
                },
                tourTicketSettings: [],
                leaderArray:[],
                editClientPopup: false,
                showNewTouristForm: false
            }
        },
        computed: {
        },
        name: "editBooking",
        props: ["inputEntity"],
        mounted() {
            this.booking = JSON.parse(JSON.stringify(this.inputEntity));
            if (typeof this.booking.checklist === "undefined" || !this.booking.checklist) {
                this.booking.checklist = {}
            }
            this.booking.tourists = this.inputEntity.tourists.slice();
            this.booking.departure_date = (this.booking.departure_date.split(" "))[0]
            this.booking.arrival_date = (this.booking.arrival_date.split(" "))[0]
            this.leaderArray.push(this.booking.leader_id)

            this.calculateTourTicketSettings()
            this.ready = true

            this.$watch('booking.checklist', (newVal, oldVal) => {
                if (newVal.border_documents === true) {
                    this.booking.color = "#75c791"
                }
            }, {
                deep: true
            })
        },
        methods: {
            openEditClientForm: function(index, tourist) {
                this.clientForUpdate.index = index;
                this.clientForUpdate.tourist = tourist;
                this.editClientPopup = true;
            },
            clientUpdated: function (tourist) {
                this.booking.tourists[this.clientForUpdate.index] = tourist
                this.clientForUpdate = {
                    index: null,
                    object: {}
                }
            },
            changeExcludes: function (setting, clientId, evening = false) {
            if (evening) {
                let index = setting.excludeEveningIds.indexOf(clientId);
                if (index > -1) {
                    setting.excludeEveningIds.splice(index, 1);
                } else {
                    setting.excludeEveningIds.push(clientId)
                }
            } else {
                let index = setting.excludeIds.indexOf(clientId);
                if (index > -1) {
                    setting.excludeIds.splice(index, 1);
                } else {
                    setting.excludeIds.push(clientId)
                }
            }

            },
            calculateTourTicketSettings: function() {
                let tourtiketArray = [];
                let momentArrival = moment(this.booking.arrival_date, "YYYY-MM-DD");
                let momentDeparture = moment(this.booking.departure_date, "YYYY-MM-DD");
                let settings = this.booking.tourticket_settings
                if (!this.booking.tourticket_settings) {
                    settings = []
                }
                while (momentArrival <= momentDeparture) {

                    let time = {
                        HH: "09",
                        mm: "00"
                    }
                    let excludeIds = [];
                    let excludeEveningIds = [];
                    let programName = "";
                    let eveningProgram = false;
                    let eveningProgramName = "";
                    let eveningTime = {
                        HH: "17",
                        mm: "00"
                    };

                    if (typeof settings[ momentArrival.format("YYYY-MM-DD")] !== "undefined") {
                        time = settings[ momentArrival.format("YYYY-MM-DD")].time
                        eveningTime = settings[ momentArrival.format("YYYY-MM-DD")].eveningTime
                        excludeIds = settings[ momentArrival.format("YYYY-MM-DD")].excludeIds
                        excludeEveningIds = settings[ momentArrival.format("YYYY-MM-DD")].excludeEveningIds
                        programName = settings[ momentArrival.format("YYYY-MM-DD")].programName;
                        eveningProgram = settings[ momentArrival.format("YYYY-MM-DD")].eveningProgram;
                        eveningProgramName = settings[ momentArrival.format("YYYY-MM-DD")].eveningProgramName;
                    }

                    tourtiketArray.push({
                        date: momentArrival.format("YYYY-MM-DD"),
                        time: {
                            HH: time.HH,
                            mm: time.mm
                        },
                        eveningTime: {
                            HH: eveningTime.HH,
                            mm: eveningTime.mm
                        },
                        excludeIds: excludeIds,
                        programName: programName,
                        eveningProgram: eveningProgram,
                        eveningProgramName: eveningProgramName,
                        excludeEveningIds: excludeEveningIds
                    })
                    momentArrival = momentArrival.add(1, 'days')
                }
                this.tourTicketSettings = tourtiketArray;
            },
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
                this.booking.arrival_date = moment(date).format("YYYY-MM-DD");
                this.calculateTourTicketSettings()
            },
            changeDepartureDate: function (date) {
                this.booking.departure_date = moment(date).format("YYYY-MM-DD")
                this.calculateTourTicketSettings()
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
            /*
              Handles a change on the file upload
            */
            handleFileUpload(){
                this.file = this.$refs.file.files[0];
            },

            submitFile(){
                /*
                        Initialize the form data
                    */
                let formData = new FormData();

                /*
                    Add the form data we need to submit
                */
                formData.append('file', this.file);

                /*
                  Make the request to the POST /single-file URL
                */
                axios.post( 'client/from-file',
                    formData,
                    {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    }
                ).then((response) => {
                    response.data.forEach((client) => {
                        this.attachTourist(client)
                    });
                    this.showNewUsersFormFromFile = false;
                    this.file = null;
                })
                    .catch(function(){
                        console.log('FAILURE!!');
                    });
            },
            prepareBookingForSave: function() {
                let settings = {};
                this.tourTicketSettings.forEach((element) => {
                    settings[element.date] = {
                        time: element.time,
                        eveningTime: element.eveningTime,
                        excludeIds: element.excludeIds,
                        programName:  element.programName,
                        eveningProgram: element.eveningProgram,
                        eveningProgramName: element.eveningProgramName,
                        excludeEveningIds: element.excludeEveningIds,
                    }
                })
                this.booking.tourticket_settings = settings
            },
            close: function () {
                this.$emit("close")
            },
            save: function (event) {
                this.errors = {};
                this.prepareBookingForSave();
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