<template>
    <div>
    <uiv-modal v-model="showPopup" title="Гинератор Документов" size="lg" v-on:hide="close">
        <tabs justified>
            <tab title="TourTickets">
                <div class="row">
                    <div class="col-md-12">
                        <div class="portlet box green">
                            <div class="portlet-body row">
                                <div class="col-md-12">
                                    <ul style="list-style: none;">
                                        <li v-for="tourist in booking.tourists">
                                            <label>
                                                <input
                                                        type="checkbox"
                                                        :checked="!(excludeIds.includes(tourist.id))"
                                                        @change="changeExcludes(tourist.id)"
                                                > {{ tourist.name }}
                                            </label>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-md-2  col-md-offset-10">
                                    <button class="btn btn-sm green" @click="downloadTourTickets">Скачать<i class="fa fa-download"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </tab>
            <tab title="Пограничные документы">
                <div class="portlet box green">
                    <div class="portlet-body row">
                        <div class="col-md-2  col-md-offset-10">
                            <button class="btn btn-sm green" @click="downloadBorderDocuments">Скачать<i class="fa fa-download"></i></button>
                        </div>
                    </div>
                </div>
            </tab>
        </tabs>
        <div slot="footer">
                     <button class="btn btn-sm default" @click="close">Закрыть <i class="fa fa-close"></i></button>
        </div>
    </uiv-modal>
    </div>
</template>
<script>
    import DatePicker from 'vue2-datepicker'
    import VueTimepicker from 'vue2-timepicker'
    import { Tabs } from 'uiv'
    import { Tab } from 'uiv'


    export default {
        components: {
            DatePicker,
            VueTimepicker,
            Tabs,
            Tab
        },
        data() {
            return {
                showPopup: true,
                excludeIds: [],
                booking: {}
            }
        },
        computed: {
        },
        name: "DownloadCenter",
        props: ["inputEntity"],
        mounted() {
            this.booking = Object.assign({}, this.inputEntity);
            this.booking.tourists = this.inputEntity.tourists.slice();

        },
        methods: {
            changeExcludes: function (clientId) {
                let index = this.excludeIds.indexOf(clientId);
                if (index > -1) {
                    this.excludeIds.splice(index, 1);
                } else {
                    this.excludeIds.push(clientId)
                }
            },
            close: function () {
                this.$emit("close")
            },
            downloadTourTickets: function (event) {
                window.HTTP.get(laroute.route('root.booking.generate-tourtickets', {}), {
                    responseType: 'blob',
                    params: {
                        bookingId: this.booking.id,
                        excludeIds: this.excludeIds
                    }
                }).then(response => {
                     const url = window.URL.createObjectURL(new Blob([response.data]));
                     const link = document.createElement('a');
                     link.href = url;
                     link.setAttribute('download', this.booking.group_name + '.pdf');
                     document.body.appendChild(link);
                     link.click();
                });
            },
            downloadBorderDocuments: function (event) {
                window.HTTP.get(laroute.route('root.booking.generate-border-documents', {}), {
                    responseType: 'blob',
                    params: {
                        bookingId: this.booking.id,
                        excludeIds: this.excludeIds
                    }
                }).then(response => {
                     const url = window.URL.createObjectURL(new Blob([response.data]));
                     const link = document.createElement('a');
                     link.href = url;
                     link.setAttribute('download', this.booking.group_name + '.xls');
                     document.body.appendChild(link);
                     link.click();
                });
            },
        },
    }
</script>
<style scoped>
    .group-item {
        border: 1px solid #c2c7d6;
        border-radius: 3px;
    }

</style>
