<template>
    <div style="margin-top: 5px; margin-bottom: 30px; border-bottom: dashed #a3a3a3; position: relative">
        <div class="form-group row">
            <div class="col-md-1">
                <uiv-popover title="Выберите цвет" trigger="manual" v-model="choiceColorPopup">
                    <button class="color-picker" :style="{ 'background-color': backgroundColor}" @click="choiceColorPopup = true"></button>
                    <template slot="popover">
                        <i
                            @click="choiceColorPopup=false"
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
            <label class="col-md-1 control-label">Дата</label>
            <div class="col-md-4">
                <date-picker
                        :value="formattedDate"
                        confirm
                        date-format="DD-MM-YYYY"
                        :clearable="false"
                        lang="ru"
                        :first-day-of-week="1"
                        @confirm="changeDate"
                ></date-picker>
            </div>

            <label class="col-md-1 control-label">Время</label>
            <div class="col-md-3" >
                <vue-timepicker
                        format="HH:mm"
                        :minute-interval="5"
                        hide-clear-button
                        v-model='formattedTime'>
                </vue-timepicker>

            </div>
            <i class="fa fa-close close-button" @click="removeRow"></i>
        </div>

        <div class="form-group row">
            <div class="col-md-1 form-group">
                <label for="">
                    Обед
                    <input type="checkbox" class="" v-model="program.place.dinner">
                </label>
            </div>
            <label class="col-md-1 control-label">Место</label>
            <div class="col-md-10">
                <place-select
                    v-if="!program.place.dinner"
                    :selected="program.place.name"
                    @change="changePlace"
                >
                </place-select>
                <restaurant-select
                    v-if="program.place.dinner"
                    :selected="program.place.name"
                    :menu="program.place.menu || []"
                    @change="changeRestaurant"
                >
                </restaurant-select>
            </div>
        </div>
    </div>
</template>

<script>
    import VueTimepicker from 'vue2-timepicker'
    import moment from "moment"

    export default {
        components: {
            VueTimepicker
        },
        data: function() {
            return {
                choiceColorPopup: false
            }
        },
        methods: {
            choiceColor: function (color) {
                this.program.color = color
                this.choiceColorPopup = false
            },
            changeDate: function (date) {
                this.program.date = moment(date).format("DD.MM.YYYY");
                this.$emit("date-changed", moment(date).format("DD.MM.YYYY"))
            },
            changePlace: function (place) {
                this.program.place.name = place
            },
            changeRestaurant: function (place) {
                this.program.place.name = place.name
                this.program.place.menu = place.menu
            },
            removeRow: function () {
                this.$emit("remove")
            }
        },
        computed: {
            "formattedDate": function () {
                return moment(this.program.date, "DD.MM.YYYY")
            },
            "formattedTime": {
                get: function() {
                    let parts = this.program.time.split(":");
                    return {
                        HH: parts[0],
                        mm: parts[1]
                    }
                },
                set: function(time) {
                    this.program.time = time.HH + ":" + time.mm;
                }
            },
            "backgroundColor": function () {
                    if (this.program.color) {
                        return "#" + this.program.color;
                    }
                    return "#ffffff"
            }
        },
        name: "EditProgramRow",
        props: ["program"],
    }
</script>

<style scoped>
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
</style>