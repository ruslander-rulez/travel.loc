<template>
    <!-- BEGIN EXAMPLE TABLE PORTLET-->
    <div class="portlet light bordered">
      <!--  <div class="portlet-title">
            <div class="caption font-dark">
                <i class="icon-settings font-dark"></i>
                <span class="caption-subject bold uppercase"> Managed Table</span>
            </div>
            <div class="actions">
                <div class="btn-group btn-group-devided" data-toggle="buttons">
                    <label class="btn btn-transparent dark btn-outline btn-circle btn-sm active">
                        <input type="radio" name="options" class="toggle" id="option1">Actions</label>
                    <label class="btn btn-transparent dark btn-outline btn-circle btn-sm">
                        <input type="radio" name="options" class="toggle" id="option2">Settings</label>
                </div>
            </div>
        </div>-->
        <div class="portlet-body">
            <div class="table-toolbar">
                <div class="row">
                    <div class="col-md-12">
                        <uiv-alert
                                v-for="(item, index) in alertMessage"
                                :duration="10000"
                                :key="index"
                                dismissible
                                @dismissed="alertMessage.splice(index, 1)"
                                type="success"
                        >
                            {{item}}
                        </uiv-alert>
                    </div>
                     <div class="col-md-6">
                        <div class="btn-group">
                            <button id="sample_editable_1_new" class="btn sbold green" v-on:click="showNewForm=true">
                                Новая запись
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="col-md-5 button-type-line">
                            <range-datepicker
                                    :inputDate="[this.filter.dateFrom, this.filter.dateTo]"
                                    v-on:change="applyDateFilter"
                            ></range-datepicker>
                        </div>
             <!--           <div class="btn-group pull-right">
                            <button class="btn green  btn-outline dropdown-toggle" data-toggle="dropdown">Tools
                                <i class="fa fa-angle-down"></i>
                            </button>
                            <ul class="dropdown-menu pull-right">
                                <li>
                                    <a href="javascript:;">
                                        <i class="fa fa-print"></i> Print </a>
                                </li>
                                <li>
                                    <a href="javascript:;">
                                        <i class="fa fa-file-pdf-o"></i> Save as PDF </a>
                                </li>
                                <li>
                                    <a href="javascript:;">
                                        <i class="fa fa-file-excel-o"></i> Export to Excel </a>
                                </li>
                            </ul>
                        </div>-->
                    </div>
                </div>
            </div>
            <div id="sample_1_wrapper" class="dataTables_wrapper no-footer">
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <div class="dataTables_length" id="sample_1_length">
                            <label>Показать
                                <select
                                        name="sample_editable_1_length" aria-controls="sample_editable_1"
                                        class="form-control input-sm input-xsmall input-inline"
                                        v-model="perPage" v-on:change="getData">
                                    <option v-for="perPage in perPageVariables" v-bind:value="perPage.val">
                                        {{ perPage.val }}
                                    </option>
                                </select> записей
                            </label>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                    <!--    <div id="sample_1_filter" class="dataTables_filter">
                            <label>Search:
                                <input type="search"
                                       class="form-control input-sm input-small input-inline"
                                       placeholder=""
                                       aria-controls="sample_1"></label>
                        </div>-->
                    </div>
                </div>
                <div class="table-scrollable">
                    <table class="table table-striped table-bordered table-hover table-checkable order-column dataTable no-footer"
                           id="sample_1" role="grid" aria-describedby="sample_1_info">
                        <thead>
                        <tr role="row">

                            <th
                                tabindex="0"
                                rowspan="1"
                                colspan="1"

                                v-bind:class="sortingField('id')"
                                v-on:click="changeSort('id')"
                            >
                            </th>
                            <th
                                class=""
                                tabindex="0"
                                rowspan="1"
                                colspan="1"
                                style="width: 212px"
                                v-bind:class="sortingField('date_of_start')"
                                v-on:click="changeSort('date_of_start')"
                                > Даты начала / окончания
                            </th>
                            <th class="" tabindex="0" rowspan="1" colspan="1"
                                > Группа
                            </th>
                            <th
                                tabindex="0"
                                rowspan="1"
                                colspan="1"
                                style="width: 117px"
                            > Отель / Круиз
                            </th>
                            <th
                                tabindex="0"
                                rowspan="1"
                                colspan="1"
                            > Программма
                            </th>
                            <th
                                class="" tabindex="0" rowspan="1" colspan="1"
                                > Заметки
                            </th>
                            <th tabindex="0" rowspan="1" colspan="1" width="46"
                                >
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                            <book-row
                                    v-for="(booking, index ) in book"
                                    v-bind:key="booking.id"
                                    v-bind:inputEntity="booking"
                                    v-on:remove="book.splice(index, 1)"
                                    v-on:updateTable="getData"
                                    v-on:message="showAlert"
                            ></book-row>

                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <pagination
                            v-bind:maxCountItems="maxCountItems"
                            v-bind:page="page"
                            v-bind:countEntries="countEntries"
                            v-bind:perPage="perPage"
                            v-on:goToPage="goToPage"
                    >
                    </pagination>
                </div>
            </div>
        </div>
        <book-edit v-if="showNewForm"  v-on:close="showNewForm=false" :inputEntity="defaultBook" v-on:created="created">
        </book-edit>
    </div>
    <!-- END EXAMPLE TABLE PORTLET-->

</template>

<script>

    import * as helper from "../../helper.js"

    export default {
        data() {
            return {
                file: '',
                showNewForm : false,
                showNewFormFromFile : false,
                filter: {
                    dateFrom: null,
                    dateTo: null,
                    search: null
                },
                defaultBook: {
                    id: null,
                    date_of_start: "",
                    date_of_end: "",
                    program: [],
                    group: {
                        name: "",
                        backgroundColor: "ffffff"
                    },
                    total_tourists: {},
                    type_type: "App\\Domain\\Hotel\\Hotel"
                },
                book: [],
                perPage: null,
                page: 1,
                maxCountItems: 0,
                countEntries: {
                    to: 0,
                    from: 0
                },
                perPageVariables: [
                    {
                        val: 20
                    },
                    {
                        val: 50
                    },
                    {
                        val: 100
                    }
                ],
                sort: {
                    field: "date_of_start",
                    direction: "ASC"
                },
                alertMessage: []
            }
        },
        methods: {

            /*
              Handles a change on the file upload
            */
            handleFileUpload(){
                this.file = this.$refs.file.files[0];
            },

            submitFile(){
                /*
                        Initialize the form data
                    */
                let formData = new FormData();

                /*
                    Add the form data we need to submit
                */
                formData.append('file', this.file);

                /*
                  Make the request to the POST /single-file URL
                */
                axios.post( 'booking/from-file',
                    formData,
                    {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    }
                ).then((response) => {
                    this.defaultBooking = response.data;
                    this.showNewForm = true;
                    this.showNewFormFromFile = false;

                    setTimeout(() => {
                        this.defaultBooking = {
                            id: null,
                            arrival_date: "",
                            departure_date: "",
                            evening_program: false,
                            tourists: []
                        }
                    })
                })
                .catch(function(){
                    console.log('FAILURE!!');
                });
            },

            applyDateFilter: function (params) {
                this.filter.dateFrom = params[0]
                this.filter.dateTo = params[1]
                this.filter.dateTo.setHours(23,59,59,59);
                this.page = 1;
                this.getData();
            },
            changeSort: function (field) {
                if (this.sort.field == field) {
                    if (this.sort.direction == "ASC") {
                        this.sort.direction = "DESC"
                    } else {
                        this.sort.direction = "ASC"
                    }
                } else {
                    this.sort = {
                        field: field,
                        direction: "ASC"
                    }
                }
                this.getData();
            },
            sortingField: function (field) {
                if (this.sort.field == field) {
                    if (this.sort.direction == "ASC") {
                        return "sorting_asc"
                    }
                    return "sorting_desc"
                }
                return "sorting"
            },
            showAlert: function(message) {
                this.alertMessage.push(message)
            },
            created: function() {
                this.showAlert("Запись создана успешно")
                this.getData()
            },
            getData: function () {
                axios
                    .get(laroute.route('root.book.list', {}), {params: {
                        page: this.page,
                        sortField: this.sort.field,
                        dateFrom: helper.presentDateToString(this.filter.dateFrom),
                        dateTo: helper.presentDateToString(this.filter.dateTo),
                        sortDirection: this.sort.direction,
                        perPage: this.perPage
                    }})
                    .then((response) => {

                        this.book = response.data;

                        this.maxCountItems = parseInt(response.headers.maxcountitems);
                        this.countEntries.from = (this.page * this.perPage) - (this.perPage - 1);
                        this.countEntries.to = this.page * this.perPage;
                        if (this.countEntries.to > this.maxCountItems) {
                            this.countEntries.to = this.maxCountItems
                        }
                    });
            },
            goToPage: function (page) {
                this.page = page;
                this.getData()
            }
        },
        mounted() {
            this.perPage = this.perPageVariables[this.perPageVariables.length - 1].val;
            this.filter.dateTo = new Date();
            this.filter.dateTo.setMonth(new Date().getMonth() + 12);

            this.filter.dateTo.setHours(23,59,59);
            this.filter.dateFrom = new Date();
            this.filter.dateFrom.setHours(0, 0, 0, 0);
            this.getData();
        },
        name: "BookTable",
    }
</script>

<style scoped>

</style>