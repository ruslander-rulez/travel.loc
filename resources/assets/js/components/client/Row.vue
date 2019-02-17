<template>
    <tr role="row">
        <td>
          {{ client.id }}
        </td>
        <td> {{ client.name}}</td>
        <td> {{ client.email}}</td>
        <td> {{ client.phone}}</td>
        <td> {{ client.nationality}}</td>
        <td>
            <button class="bnt btn-md btn-default" v-on:click="editPopup=true"><i class="fa fa-edit"></i></button>

            <client-edit v-if="editPopup" v-on:close="editPopup=false" :inputEntity="client" v-on:updated="updated">
            </client-edit>

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
                client: {},
                editPopup: false
            }
        },
        mounted() {
            this.client = this.inputEntity
        },
        name: "Row",
        props: ['inputEntity'],
        methods: {
            updated: function (client) {
                this.client = client;
                this.$emit("message", "Клиент был обновлен")
            },
            deleteItem: function () {
                this.showDeleteWarning = false
                window.HTTP.delete(laroute.route('root.client.delete', {}),{params: {
                    "id" : this.client.id
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