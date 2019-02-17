<template>
    <tr role="row">
        <td v-bind:style="colorBackground">
              <color-edit :id="booking.id" :colorInput="booking.color" @changeColor="changeColor"></color-edit>
        </td>
        <td>
            <div>{{ booking.ship.name }}</div>
            <div>{{ booking.group_name }}</div>
            <div>{{ booking.additional_info }}</div>
        </td>
        <td> {{ booking.arrival_date}}</td>
        <td> {{ booking.departure_date}}</td>
        <td>
            <div v-for="tourist in booking.tourists">{{ tourist.name }}</div>
        </td>
        <td>
            <button class="bnt btn-md btn-default" v-on:click="editPopup=true"><i class="fa fa-edit"></i></button>

            <booking-edit v-if="editPopup" v-on:close="editPopup=false" :inputEntity="booking" v-on:updated="updated">
            </booking-edit>

            <delete-button
                    @deleteItem="deleteItem"
            />
        </td>
    </tr>
</template>

<script>

    import {AxiosInstance as HTTP} from "axios";
    import Chrome from "vue-color/src/components/Chrome";

    export default {
        components: {Chrome},
        data() {
            return {
                bufer: {},
                booking: {
                    color: "#322332",
                    ship: {}
                },
                editPopup: false
            }
        },
        mounted() {
            this.booking = this.inputEntity
        },
        computed: {
            colorBackground: function () {
                return {
                    "background-color": this.booking.color + "!important"
                }
            }
        },
        name: "Row",
        props: ['inputEntity'],
        methods: {
            updated: function (booking) {
                this.booking = booking;
                this.$emit("message", "Бронирование было обновлено")
            },
            changeColor: function (color) {
                this.booking.color = color;
                window.HTTP.put(laroute.route('root.booking.set-color', {}),{
                        "id" : this.booking.id,
                        "color" : this.booking.color
                    }).then(response => {
                }).catch( e => {
                    console.log(e)
                })
            },
            deleteItem: function () {
                this.showDeleteWarning = false
                window.HTTP.delete(laroute.route('root.booking.delete', {}),{params: {
                    "id" : this.booking.id
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