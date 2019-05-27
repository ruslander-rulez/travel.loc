<template>
    <tr role="row" v-if="ready">
        <td v-bind:style="colorBackground">
              {{ booking.id}}
        </td>
        <td>
            <div>{{ booking.ship.name }}</div>
            <div>{{ booking.group_name }}</div>
            <div>{{ booking.additional_info }}</div>
            <div v-if="booking.checklist && typeof booking.checklist.border_documents !== 'undefined' && booking.checklist.border_documents">Отправлено пограничникам</div>
        </td>
        <td> {{ booking.arrival_date}}</td>
        <td> {{ booking.departure_date}}</td>
        <td class="actions">
            <button class="btn btn-sm btn-default" v-on:click="editPopup=true" title="Редактировать">
                <i class="fa fa-edit"></i>
            </button>
            <button class="btn btn-sm btn-warning" v-on:click="showDownloadCenterPopup=true" title="Центр загрузок">
                <i class="fa fa-download"></i>
            </button>

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
                ready: false,
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
            if (!this.booking.checklist) {
                this.booking.checklist = {}
            }
            this.ready = true;
        },
        computed: {
            colorBackground: function () {
                if (!this.booking.checklist.border_documents) {
                    return {
                        "background-color": "red !important"
                    }
                }
                 return {
                    "background-color": "#75c791 !important"
                }
            }
        },
        name: "Row",
        props: ['inputEntity'],
        methods: {
            updated: function (booking) {
                this.booking = booking;
                // this.booking = JSON.parse(JSON.stringify(booking));
            },
        }
    }
</script>

<style scoped>
 .actions>* {
     margin: 6px 0;
 }
</style>