<template>
    <!-- BEGIN EXAMPLE TABLE PORTLET-->
    <div class="portlet light bordered">

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
                            <button id="sample_editable_1_new" class="btn sbold green" v-on:click="showNewForm=true"> Новый ресторан
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="col-md-6">
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

                            <th tabindex="0" rowspan="1" colspan="1"
                                > #
                            </th>
                            <th class="sorting_asc" tabindex="0" rowspan="1" colspan="1"
                                > Имя
                            </th>
                            <th tabindex="0" rowspan="1" colspan="1" width="46"
                                >
                            </th>
                        </tr>
                        </thead>
                        <tbody>

                            <restaurant-row
                                    v-for="(restaurant, index ) in restaurants"
                                    v-bind:key="restaurant.id"
                                    v-bind:inputEntity="restaurant"
                                    v-on:remove="restaurants.splice(index, 1)"
                                    v-on:updateTable="getData"
                                    v-on:message="showAlert"
                            ></restaurant-row>

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
        <restaurant-edit v-if="showNewForm" v-on:close="showNewForm=false" :inputEntity="defaultRestaurant" v-on:created="created">
        </restaurant-edit>
    </div>
    <!-- END EXAMPLE TABLE PORTLET-->

</template>

<script>
    export default {
        data() {
            return {
                showNewForm : false,
                defaultRestaurant: {
                    id: null,
                    name: "",
                },
                restaurants: [],
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
                alertMessage: []
            }
        },
        methods: {
            showAlert: function(message) {
                this.alertMessage.push(message)
            },
            created: function() {
                this.showAlert("Ресторан был создан")
                this.getData()
            },
            getData: function () {
                axios
                    .get(laroute.route('root.restaurant.list', {}), {params: {page: this.page, perPage: this.perPage}})
                    .then((response) => {

                        this.restaurants = response.data;

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
            this.getData();
        },
        name: "RestaurantTable",
    }
</script>

<style scoped>

</style>