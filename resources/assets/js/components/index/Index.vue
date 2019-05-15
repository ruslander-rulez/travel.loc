<template>
    <div class="div">
        <div class="portlet box red-sunglo">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-ship"></i>Ближайшие отправки</div>
                <div class="tools">
                    <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
                    <a href="javascript:;" class="reload" data-original-title="" title=""> </a>
                    <a href="" class="fullscreen" data-original-title="" title=""> </a>
                    <a href="javascript:;" class="remove" data-original-title="" title=""> </a>
                </div>
            </div>
            <div class="portlet-body">
                <div class="table-scrollable">
                    <table class="table table-striped table-bordered table-hover table-checkable order-column dataTable no-footer"
                           id="sample_1" role="grid" aria-describedby="sample_1_info">
                        <thead>
                        <tr role="row">

                            <th
                                    tabindex="0"
                                    rowspan="1"
                                    colspan="1"
                            >
                            </th>
                            <th class="" tabindex="0" rowspan="1" colspan="1"
                            > Информация
                            </th>
                            <th class="" tabindex="0" rowspan="1" colspan="1"
                            >
                            </th>
                            <th
                                    tabindex="0"
                                    rowspan="1"
                                    colspan="1"
                            > Дата прихода
                            </th>
                            <th
                                    class="" tabindex="0" rowspan="1" colspan="1"
                            > Дата отправки
                            </th>
                            <th class="" tabindex="0" rowspan="1" colspan="1"
                            > Список группы
                            </th>
                            <th tabindex="0" rowspan="1" colspan="1" width="46"
                            >
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <booking-row
                                v-for="(booking, index ) in bookings"
                                v-bind:key="booking.id"
                                v-bind:inputEntity="booking"
                        ></booking-row>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                bookings: []
            }
        },
        methods: {
            nearestBookings: function () {
                axios
                    .get(laroute.route('root.booking.nearestBookingList', {}), {params: {
                          /*  page: this.page,
                            sortField: this.sort.field,
                            dateFrom: helper.presentDateToString(this.filter.dateFrom),
                            dateTo: helper.presentDateToString(this.filter.dateTo),
                            sortDirection: this.sort.direction,
                            perPage: this.perPage*/
                        }})
                    .then((response) => {
                        this.bookings = response.data;
                    });
            }
        },
        mounted() {
            this.nearestBookings();
        },
        name: "IndexComponent",
    }
</script>

<style scoped>

</style>