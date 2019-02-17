<template>
    <div v-on:click="showColorEditor=true" class="id">
    <div v-if="showColorEditor" style="position: absolute; height: 100%; left: 0; top: 0; width: 100%; z-index: 10001;">

    </div>
        <uiv-popover title="Изменить цвет" trigger="manual" v-model="showColorEditor" >
            <div style="text-shadow: -1px 0 white, 0 1px white, 2px 0 white, 0 -1px white;">
                {{ id }}
            </div>

            <template slot="popover">
                <color-picker v-model="color"></color-picker>
                <div style="display: flex; justify-content: space-between; margin-top: 8px">
                    <button type="button" class="btn green-haze" v-on:click="changeColor">Сохранить</button>
                    <button type="button" class="btn red-mint" v-on:click="showColorEditor=false">Отмена</button>
                </div>
            </template>
        </uiv-popover>
    </div>
</template>

<script>
    export default {
        name: "EditColor",
        data() {
            return {
                color: "",
                showColorEditor: false,
            }
        },
        props: ["colorInput", "id"],
        methods: {
            changeColor: function () {
                this.showColorEditor = false
                this.$emit("changeColor", this.color)
            }
        },
        mounted() {
            this.color = this.colorInput
        }
    }
</script>

<style>
 .popover {
     z-index: 10020;
 }
</style>
<style scoped>
    .id {
        padding: 16px 0px;
        cursor: pointer;
    }
</style>