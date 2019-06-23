<template>
    <tr role="row">
        <td>
          {{ hotel.id }}
        </td>
        <td> {{ hotel.name}}</td>
        <td>
            <button class="btn btn-sm btn-default" v-on:click="editPopup=true"><i class="fa fa-edit"></i></button>

            <hotel-edit v-if="editPopup" v-on:close="editPopup=false" :inputEntity="hotel" v-on:updated="updated">
            </hotel-edit>

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
                hotel: {},
                showDeleteWarning: false,
                editPopup: false
            }
        },
        mounted() {
            this.hotel = this.inputEntity
        },
        name: "Row",
        props: ['inputEntity'],
        methods: {
            updated: function (hotel) {
                this.hotel = hotel;
                this.$emit("message", "Отель был обновлен")
            },
            deleteItem: function () {
                this.showDeleteWarning = false
                window.HTTP.delete(laroute.route('root.hotel.delete', {}),{params: {
                    "id" : this.hotel.id
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