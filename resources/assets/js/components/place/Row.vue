<template>
    <tr role="row">
        <td>
          {{ place.id }}
        </td>
        <td> {{ place.name}}</td>
        <td>
            <button class="btn btn-sm btn-default" v-on:click="editPopup=true"><i class="fa fa-edit"></i></button>

            <place-edit v-if="editPopup" v-on:close="editPopup=false" :inputEntity="place" v-on:updated="updated">
            </place-edit>

            <delete-button
                    @deleteItem="deleteItem"
            />
        </td>
    </tr>
</template>

<script>

    import {AxiosInstance as HTTP} from "axios";

    export default {
        data() {
            return {
                bufer: {},
                place: {},
                showDeleteWarning: false,
                editPopup: false
            }
        },
        mounted() {
            this.place = this.inputEntity
        },
        name: "Row",
        props: ['inputEntity'],
        methods: {
            updated: function (place) {
                this.place = place;
                this.$emit("message", "Место было обновлено")
            },
            deleteItem: function () {
                this.showDeleteWarning = false
                window.HTTP.delete(laroute.route('root.place.delete', {}),{params: {
                    "id" : this.place.id
                }}).then(response => {
                    this.$emit('updateTable')
                }).catch( e => {
                    console.log(e)
                })
            }
        }
    }
</script>

<style scoped>

</style>