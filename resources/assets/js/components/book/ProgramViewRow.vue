<template>
    <uiv-popover title="Выберите цвет" trigger="manual" v-model="choiceColorPopup" tag="div" class="program-row">
        <div v-bind:style="style" @click="choiceColorPopup = true" v-if="program.place.dinner" v-uiv-popover.hover="{title:'Меню', content: popoverContent}">
            <div>{{program.date}} {{program.time}}</div>
            <div>
                <i class="fa fa-cutlery" aria-hidden="true"></i> {{ program.place.name}}
            </div>
        </div>
        <div v-bind:style="style" @click="choiceColorPopup = true" v-else="program.place.dinner">
            <div>{{program.date}} {{program.time}}</div>
            <div>
                {{ program.place.name}}
            </div>
        </div>
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
</template>

<script>
    export default {
        name: "ProgramViewRow",
        props: ["program"],
        data: function () {
            return {
                choiceColorPopup: false
            }
        },
        methods: {
            choiceColor: function (color) {
                this.program.color = color
                this.$emit("colorChanged")
                this.choiceColorPopup = false
            },
        },
        computed: {
            style: function () {
                let styleObj = {};
                if (this.program.color) {
                    styleObj["background-color"] = "#" + this.program.color
                }
                return styleObj;
            },
            popoverContent: function () {
                console.log(typeof  this.program.place.menu);
                if (typeof this.program.place.menu === "undefined") {
                    return ""
                }
                let result = "";
                for (var item in this.program.place.menu) {
                    console.log(this.program.place.menu[item].name);
                    result = this.program.place.menu[item].name + "; "
                }
                return result
            }
        }
    }
</script>

<style scoped>
    .program-row {
        margin-bottom: 10px;
    }
    .program-row>div {
        padding: 2px 1px 3px 5px;
    }
    :hover {
        cursor: pointer;
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