<template>

    <v-select v-model="selectedInternal" :onChange="change" @search="search" :options="options"></v-select>

</template>

<script>
    import vSelect from "vue-select/src/components/Select.vue"

    export default {
        name: "PlaceSelect",
        props: [
            "selected"
        ],
        components: {
            "v-select": vSelect
        },
        methods: {
            change: function (value) {
                let place = null
                if (typeof value === "string") {
                    place = value
                }
                if (typeof value === "object") {
                    place = value.label
                }
                this.$emit("change", place);
            },
            search: function (string) {
                this.selectedInternal = string;
                this.$emit("change", string);
            }
        },
        data() {
            return {
                ready: false,
                options: [],
                places: [],
                selectedInternal: null
            }
        },
        computed: {

        },
        watch: {

        },
        mounted() {
            axios
                .get(laroute.route('root.place.list', {}), {params: {page: this.page, perPage: this.perPage}})
                .then((response) => {
                    response.data.forEach((item) => {
                        this.options.push({
                            label: item.name
                        })
                    });
                });
            this.selectedInternal = this.selected
        }
    }
</script>

<style scoped>

</style>