<template>
    <div v-if="ready">

    <uiv-modal v-model="showPopup" title="Редактирование Записи" size="lg" v-on:hide="close">
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
                            <i class="icon-settings">Запись</i>
                            <span style="margin-left: 15px">
                                <toggle-button v-model="book.is_canceled"
                                               :height="25"
                                               :width="125"
                                               :color="{unchecked: '#27ab27', checked: '#E7505A'}"
                                               :labels="{checked: 'Аннулировано', unchecked: 'Не аннулировано'}"/>
                            </span>
                        </div>
                        <ul class="nav nav-tabs">
                            <li v-bind:class="tab === 1 ? 'active' : ''">
                                <a href="#" v-on:click.prevent="tab=1">Основное</a>
                            </li>
                            <li v-bind:class="tab === 2 ? 'active' : ''">
                                <a href="#" v-on:click.prevent="tab=2">Программа</a>
                            </li>
                        </ul>
                    </div>
                    <div class="portlet-body">
                        <div class="div" v-if="tab===1">
                            <div class="form-group row">
                                <label class="col-md-2 control-label">Дата начала</label>
                                <div class="col-md-4" v-bind:class="errors['date_of_start'] !== undefined ? 'has-error' : ''">
                                    <date-picker
                                            v-model="book.date_of_start"
                                            confirm
                                            date-format="DD-MM-YYYY"
                                            :clearable="false"
                                            lang="ru"
                                            :first-day-of-week="1"
                                            @confirm="changeDateOfStart"
                                    ></date-picker>
                                    <error-block :errors="errors['date_of_start']" />
                                </div>

                                <label class="col-md-2 control-label">Дата окончания</label>
                                <div class="col-md-4" v-bind:class="errors['date_of_end'] !== undefined ? 'has-error' : ''">
                                    <date-picker
                                            v-model="book.date_of_end"
                                            confirm
                                            date-format="DD-MM-YYYY"
                                            :clearable="false"
                                            lang="ru"
                                            :first-day-of-week="1"
                                            @confirm="changeDateOfEnd"
                                    ></date-picker>
                                    <error-block :errors="errors['date_of_end']" />
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-2 control-label">Название группы</label>
                                <div class="col-md-8" v-bind:class="errors['group.name'] !== undefined ? 'has-error' : ''">
                                    <input type="text" class="form-control" placeholder="Название группы"
                                           v-model="book.group.name">
                                    <error-block :errors="errors['group.name']" />
                                </div>
                                <div class="col-md-2">
                                    <uiv-popover title="Выберите цвет" trigger="manual" v-model="groupChoiceColorPopup">
                                        <button class="color-picker" :style="{ 'background-color': groupChoiceColorButtonBackground}" @click="groupChoiceColorPopup = true"></button>
                                        <template slot="popover">
                                            <i
                                                    @click="groupChoiceColorPopup=false"
                                                    class="fa fa-close"
                                                    style="position: absolute; top: 0; right: 0; padding: 5px; cursor: pointer;"
                                            ></i>
                                            <div class="color-select-group">
                                                <button class="color-select-btn" style="background-color: #e6b9b8" @click="choiceColor('e6b9b8')"> </button>
                                                <button class="color-select-btn" style="background-color: #8eb4e3" @click="choiceColor('8eb4e3')"> </button>
                                                <button class="color-select-btn" style="background-color: #92d050" @click="choiceColor('92d050')"> </button>
                                                <button class="color-select-btn" style="background-color: #b3a2c7" @click="choiceColor('b3a2c7')"> </button>
                                                <button class="color-select-btn" style="background-color: #e46c0a" @click="choiceColor('e46c0a')"> </button>
                                                <button class="color-select-btn" style="background-color: #ffff00" @click="choiceColor('ffff00')"> </button>
                                                <button class="color-select-btn" style="background-color: #ffffff" @click="choiceColor('ffffff')"> </button>
                                            </div>
                                        </template>
                                    </uiv-popover>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 control-label">Лидер</label>
                                <div class="col-md-10" v-bind:class="errors['leader_name'] !== undefined ? 'has-error' : ''">
                                    <input type="text" class="form-control" placeholder="Лидер"
                                           v-model="book.leader_name">
                                    <error-block :errors="errors['leader_name']" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 control-label">Состав группы</label>
                                <div class="col-md-10" v-bind:class="errors['total_tourists'] !== undefined ? 'has-error' : ''">
                                    <table class="table total_tourists_table">
                                        <tr>
                                            <td>Взрослые</td>
                                            <td>
                                                <input type="number" class="form-control" v-model="book.total_tourists.adults">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Студенты</td>
                                            <td>
                                                <input type="number" class="form-control" v-model="book.total_tourists.students">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Школьники</td>
                                            <td>
                                                <input type="number" class="form-control" v-model="book.total_tourists.schoolchildren">

                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Дошкольники</td>
                                            <td>
                                                <input type="number" class="form-control" v-model="book.total_tourists.preschoolers">
                                                </td>
                                        </tr>
                                    </table>
                                    <error-block :errors="errors['total_tourists']" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 control-label">Водитель</label>
                                <div class="col-md-10" v-bind:class="errors['driver'] !== undefined ? 'has-error' : ''">
                                    <input type="text" class="form-control" placeholder="Водитель"
                                           v-model="book.driver">
                                    <error-block :errors="errors['driver']" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 control-label">Гид</label>
                                <div class="col-md-10" v-bind:class="errors['guide'] !== undefined ? 'has-error' : ''">
                                    <input type="text" class="form-control" placeholder="Гид"
                                           v-model="book.guide">
                                    <error-block :errors="errors['guide']" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6 row">

                                    <label class="col-md-3 control-label">Контактный телефон</label>
                                    <div class="col-md-9" v-bind:class="errors['contact_phone'] !== undefined ? 'has-error' : ''">
                                        <input type="text" class="form-control" placeholder="Контактный телефон"
                                               v-model="book.contact_phone">
                                        <error-block :errors="errors['contact_phone']"/>
                                    </div>
                                </div>
                                <div class="col-md-6 row">
                                    <label class="col-md-3 control-label">Контактный email</label>
                                    <div class="col-md-9" v-bind:class="errors['contact_email'] !== undefined ? 'has-error' : ''">
                                        <input type="text" class="form-control" placeholder="Контактный email"
                                               v-model="book.contact_email">
                                        <error-block :errors="errors['contact_email']"/>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 control-label">Заметки</label>
                                <div class="col-md-10" v-bind:class="errors['notes'] !== undefined ? 'has-error' : ''">
                                    <textarea class="form-control"  style="resize: none;" rows="7" placeholder="Заметки"
                                              v-model="book.notes"> </textarea>
                                    <error-block :errors="errors['notes']" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 control-label">
                                    <toggle-button :value="!typeIsShip"
                                                   :height="35"
                                                   :width="90"
                                                   @change="chaneTypeType"
                                                   :color="{checked: '#27ab27', unchecked: '#a5830a'}"
                                                   :labels="{checked: 'Отель', unchecked: 'Корабль'}"/>
                                </label>
                                <div class="col-md-10" v-bind:class="errors['ship_id'] !== undefined ? 'has-error' : ''">
                                    <hotel-select
                                            :selected="book.type"
                                            @change="changeType"
                                            v-if="!typeIsShip"
                                    ></hotel-select>
                                    <ship-select
                                            :selected="book.type"
                                            @change="changeType"
                                            v-if="typeIsShip"
                                    ></ship-select>
                                    <error-block :errors="errors['ship_id']" />
                                </div>
                            </div>
                            <div class="form-group row" v-if="typeIsShip">
                                <label class="col-md-2 control-label">
                                    ID бронирования
                                </label>
                                <div class="col-md-10" v-bind:class="errors['ship_id'] !== undefined ? 'has-error' : ''">
                                    <input class="form-control" type="number" min="1" v-model="book.booking_id">
                                    <error-block :errors="errors['ship_id']" />
                                </div>
                            </div>
                        </div>
                        <div class="div" v-if="tab===2">
                            <edit-program-row
                                v-for="(program, key) in book.program"
                                :key="new Date().getMilliseconds().toString() + key.toString()"
                                :program="program"
                                @remove="removeProgram(key)"
                                @date-changed="changeDefaultProgramDate"
                            ></edit-program-row>

                            <button class="btn btn-success" @click="addNewProgramItem">
                                <i class="fa fa-plus"></i> Добавить
                            </button>
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
    </div>
</template>
<script>
    import DatePicker from 'vue2-datepicker'
    import moment from 'moment'
    import VueTimepicker from 'vue2-timepicker'
    import { ToggleButton } from 'vue-js-toggle-button'

    export default {
        components: {
            DatePicker,
            VueTimepicker,
            ToggleButton
        },
        data() {
            return {
                typeIsShip: this.typeIsShipMethod(),
                showPopup: true,
                tab: 1,
                ready: false,
                file: null,
                groupChoiceColorPopup: false,
                showNewUsersFormFromFile : false,
                book: {
                },
                errors: {},
                defaultProgramDate: {
                }
            }
        },
        computed: {
            groupChoiceColorButtonBackground: function () {
                return "#" + (this.book.group.backgroundColor || "ffffff")
            }
        },
        watch: {
            book: function () {
                this.typeIsShip = this.typeIsShipMethod()
            }
        },

        name: "editBook",
        props: ["inputEntity"],
        mounted() {
            this.book = JSON.parse(JSON.stringify(this.inputEntity));

            this.book.date_of_start = (this.book.date_of_end.split(" "))[0]
            this.book.date_of_end = (this.book.date_of_end.split(" "))[0]
            this.typeIsShip = this.typeIsShipMethod();
            let lastProgram = this.book.program.slice(-1);
            if (typeof lastProgram[0] !== "undefined") {
                this.defaultProgramDate.date = lastProgram[0].date;
            }
            this.ready = true
        },
        methods: {
            choiceColor: function (color) {
                this.$set(this.book.group, "backgroundColor", color)
            },
            changeDefaultProgramDate: function (date) {
                this.defaultProgramDate.date = date;
            },
            typeIsShipMethod: function () {
                if (typeof this.book !== "undefined") {
                    return this.book.type_type === 'App\\Domain\\Ship\\Ship'
                }
                return true;
            },
            removeProgram: function (key)  {
                this.book.program.splice(key, 1);
            },
            addNewProgramItem: function ()  {
                this.book.program.push({
                    color: "",
                    date: this.defaultProgramDate.date || "",
                    time: "09:00",
                    place: {
                        dinner: false,
                        name: ""
                    }
                });
            },
            changeDateOfStart: function (date) {
                this.book.date_of_start = moment(date).format("YYYY-MM-DD");
            },
            changeDateOfEnd: function (date) {
                this.book.date_of_end = moment(date).format("YYYY-MM-DD")
            },
            changeType: function(value) {
                if (typeof value === "undefined") {
                    return
                }
                if (value) {
                    this.book.type_id = value.id
                    this.book.type = value
                }
                if (!value) {
                    this.book.type = null
                    this.book.type_id = null
                }
            },
            chaneTypeType: function(e) {
                this.book.type_type =  e.value ? "App\\Domain\\Hotel\\Hotel" : "App\\Domain\\Ship\\Ship"
                this.book.type = {};
                this.book.type_id = null;
                this.typeIsShip = this.typeIsShipMethod();
            },
            close: function () {
                this.$emit("close")
            },
            save: function (event) {
                this.errors = {};
                if (this.book.id !== null) {
                    window.HTTP.put(laroute.route('root.book.save', {}), this.book).then(response => {

                        if (response.status == 202) {
                            this.book.program = response.data.program
                            this.$emit("updated", this.book)
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
                    window.HTTP.post(laroute.route('root.book.create', {}), this.book).then(response => {
                        if (response.status == 201) {
                            this.book.program = response.data.program

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
    .total_tourists_table {
        text-align: left;
    }
    .control-label {
        margin-top: 7px;
    }
    .color-picker {
        height: 20px;
        width: 20px;
        cursor: pointer;
        background: #00FF00;
        border-radius: 20px;
    }
    .close-button{
        cursor: pointer;
        color: red;
        padding: 6px;
        font-size: medium;
        position: absolute;
        top: -12px;
        right: -5px;
    }
    .color-select-btn {
        width: 20px;
        height: 20px;
        margin: 0 5px;
    }
</style>
<style>
    .popover {
        z-index: 10020;
    }
    .popover.top.fade.in {
        z-index: 10534;
    }
     .modal-backdrop.fade.in {
         z-index: auto !important;
     }
</style>
