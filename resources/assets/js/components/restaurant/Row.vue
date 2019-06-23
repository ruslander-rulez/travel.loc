<template>
    <tr role="row">
        <td>
          {{ restaurant.id }}
        </td>
        <td> {{ restaurant.name}}</td>
        <td>
            <button class="btn btn-sm btn-default" v-on:click="editPopup=true"><i class="fa fa-edit"></i></button>

            <restaurant-edit v-if="editPopup" v-on:close="editPopup=false" :inputEntity="restaurant" v-on:updated="updated">
            </restaurant-edit>

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
                restaurant: {},
                showDeleteWarning: false,
                editPopup: false
            }
        },
        mounted() {
            this.restaurant = this.inputEntity
        },
        name: "Row",
        props: ['inputEntity'],
        methods: {
            updated: function (restaurant) {
                this.restaurant = restaurant;
                this.$emit("message", "Ресторан был обновлен")
            },
            deleteItem: function () {
                this.showDeleteWarning = false
                window.HTTP.delete(laroute.route('root.restaurant.delete', {}),{params: {
                    "id" : this.restaurant.id
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