<template>
    <tr role="row">
        <td>
          {{ ship.id }}
        </td>
        <td> {{ ship.name}}</td>
        <td>
            <button class="bnt btn-md btn-default" v-on:click="editPopup=true"><i class="fa fa-edit"></i></button>

            <ship-edit v-if="editPopup" v-on:close="editPopup=false" :inputEntity="ship" v-on:updated="updated">
            </ship-edit>

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
                ship: {},
                showDeleteWarning: false,
                editPopup: false
            }
        },
        mounted() {
            this.ship = this.inputEntity
        },
        name: "Row",
        props: ['inputEntity'],
        methods: {
            updated: function (ship) {
                this.ship = ship;
                this.$emit("message", "Корабль был обновлен")
            },
            deleteItem: function () {
                this.showDeleteWarning = false
                window.HTTP.delete(laroute.route('root.ship.delete', {}),{params: {
                    "id" : this.ship.id
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