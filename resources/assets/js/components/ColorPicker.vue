<template>
    <chrome v-model="color" />
</template>

<script>
    import Chrome from "vue-color/src/components/Chrome";
    export default {
        name: "ColorPicker",
        components: {Chrome},
        props: ["value"],
        data () {
            return {
                color: {hex: ""}
            }
        },
        watch:{
            color: function (color) {
                this.$emit('input', color.hex)
            }
        }
    }
</script>

<style scoped>

</style>