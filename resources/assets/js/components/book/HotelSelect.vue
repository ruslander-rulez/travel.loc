<template>
    <v-select v-model="selectedInternal" :onChange="change" :options="options"></v-select>
</template>

<script>
    import vSelect from "vue-select/src/components/Select.vue"

    export default {
        name: "HotelSelect",
        props: {
            selected: Object
        },
        components: {
            "v-select": vSelect
        },
        methods: {
            change: function (value) {
                let hotel = null
                if (value) {
                    hotel = this.hotels[value.id]
                }
                this.$emit("change", hotel);
            }
        },
        data() {
            return {
                ready: false,
                options: [],
                hotels: [],
                selectedInternal: null
            }
        },
        computed: {
            defaultSelected: function () {
                if (!this.selected) {
                    return null
                }
                return {
                    id: this.selected.id,
                    label: this.selected.name
                }
            }
        },
        watch: {
            selected:function () {
                this.selectedInternal = this.defaultSelected
            }
        },
        mounted() {
            axios
                .get(laroute.route('root.hotel.list', {}), {params: {page: this.page, perPage: this.perPage}})
                .then((response) => {
                    response.data.forEach((item) => {
                        this.hotels[item.id] = item
                        this.options.push({
                            id: item.id,
                            label: item.name
                        })
                    });
                });
            this.selectedInternal = this.defaultSelected
        }
    }
</script>

<style scoped>
</style>