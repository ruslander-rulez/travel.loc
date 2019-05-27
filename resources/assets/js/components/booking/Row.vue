<template>
    <tr role="row">
        <td v-bind:style="colorBackground">
              <color-edit :id="booking.id" :colorInput="booking.color" @changeColor="changeColor"></color-edit>
        </td>
        <td>
            <div>{{ booking.ship.name }}</div>
            <div>{{ booking.group_name }}</div>
            <div>{{ booking.additional_info }}</div>
            <div v-if="booking.checklist && typeof booking.checklist.border_documents !== 'undefined' && booking.checklist.border_documents">Отправлено пограничникам</div>
        </td>
        <td>
            <ol style="padding-inline-start: 15px;">
                <li v-for="(item, index) in booking.tourticket_settings" style="border-bottom: 1px solid">
                    <table>
                        <tr>
                            <td style="vertical-align: baseline; font-weight: bold;">
                                {{ index }}
                            </td>
                            <td>
                                <ul style="list-style: disc">
                                    <li>{{ item.time.HH }}:{{ item.time.mm }} </li>
                                    <li v-if="item.eveningProgram">{{ item.eveningTime.HH }}:{{ item.eveningTime.mm }} </li>
                                </ul>
                            </td>
                        </tr>
                    </table>
                </li>
            </ol>
        </td>
        <td> {{ booking.arrival_date}}</td>
        <td> {{ booking.departure_date}}</td>
        <td>
            <ul>
                <li v-for="tourist in booking.tourists">{{ tourist.name }}</li>
            </ul>
        </td>
        <td class="actions">
            <button class="btn btn-sm btn-default" v-on:click="editPopup=true" title="Редактировать">
                <i class="fa fa-edit"></i>
            </button>
            <button class="btn btn-sm btn-warning" v-on:click="showDownloadCenterPopup=true" title="Центр загрузок">
                <i class="fa fa-download"></i>
            </button>

            <delete-button
                    @deleteItem="deleteItem"
            />


            <booking-edit v-if="editPopup" v-on:close="editPopup=false" :inputEntity="booking" v-on:updated="updated"/>

            <download-center
                v-if="showDownloadCenterPopup"
                v-on:close="showDownloadCenterPopup=false"
                :inputEntity="booking"
            >
            </download-center>
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
                showDownloadCenterPopup: false,
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
 .actions>* {
     margin: 6px 0;
 }
</style>