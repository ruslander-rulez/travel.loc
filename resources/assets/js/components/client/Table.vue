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
                            <button id="sample_editable_1_new" class="btn sbold green" v-on:click="showNewForm=true"> Новый клиент
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
                <div class="row">
                    <div class="col-md-12" style="margin-top: 10px;">
                        <input
                            type="text"
                            @change="filterApply"
                            class="form-control"
                            v-model="search"
                            placeholder="Поиск"
                        >
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
                            <th class="" tabindex="0" rowspan="1" colspan="1"
                                > Имя
                            </th>
                            <th class="" tabindex="0" rowspan="1" colspan="1"
                                > email
                            </th>
                            <th class="" tabindex="0" rowspan="1" colspan="1"
                                > Телефон
                            </th>
                            <th class="" tabindex="0" rowspan="1" colspan="1"
                                > Национальность
                            </th>
                            <th tabindex="0" rowspan="1" colspan="1" width="46"
                                >
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                            <client-row
                                    v-for="(client, index ) in clients"
                                    v-bind:key="client.id"
                                    v-bind:inputEntity="client"
                                    v-on:remove="clients.splice(index, 1)"
                                    v-on:updateTable="getData"
                                    v-on:message="showAlert"
                            ></client-row>

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
        <client-edit v-if="showNewForm" v-on:close="showNewForm=false" :inputEntity="defaultClient" v-on:created="created">
        </client-edit>
    </div>
    <!-- END EXAMPLE TABLE PORTLET-->

</template>

<script>
    export default {
        data() {
            return {
                showNewForm : false,
                defaultClient: {
                    id: null,
                    birthday: ""
                },
                clients: [],
                perPage: null,
                page: 1,
                search: "",
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
                this.showAlert("Клиент был создан")
                this.getData()
            },
            filterApply: function () {
                this.page = 1;
                this.getData();
            },
            getData: function () {
                axios
                    .get(
                        laroute.route('root.client.list', {}),
                        {
                            params: {
                                page: this.page,
                                perPage: this.perPage,
                                search: this.search
                            }
                        }
                    )
                    .then((response) => {

                        this.clients = response.data;

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
        name: "ClientTable",
    }
</script>

<style scoped>

</style>