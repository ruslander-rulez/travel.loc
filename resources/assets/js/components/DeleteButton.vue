<template>
    <uiv-popover title="Вы уверены?" trigger="manual" v-model="showDeleteWarning">
        <button class="bnt btn-md btn-danger" v-on:click="showDeleteWarning=true"><i class="fa fa-trash"></i></button>
        <template slot="popover">
            <button type="button" class="btn green-haze" v-on:click="deleteItem">ДА</button>
            <button type="button" class="btn red-mint" v-on:click="showDeleteWarning=false">НЕТ</button>
        </template>
    </uiv-popover>
</template>

<script>
    export default {
        name: "DeleteButton",
        data() {
            return {
                showDeleteWarning: false,
            }
        },
        methods: {
            deleteItem: function () {
                this.$emit("deleteItem")
            }
        }
    }
</script>

<style scoped>

</style>