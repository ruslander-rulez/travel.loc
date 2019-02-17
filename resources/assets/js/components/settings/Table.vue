<template>
    <div class="portlet light portlet-fit bordered">
        <!--      <div class="portlet-title">
                  <div class="caption">
                      <i class="icon-settings font-red"></i>
                      <span class="caption-subject font-red sbold uppercase">Editable Table</span>
                  </div>
                  <div class="actions">
                      <div class="btn-group btn-group-devided" data-toggle="buttons">
                          <label class="btn btn-transparent red btn-outline btn-circle btn-sm active">
                              <input type="radio" name="options" class="toggle" id="option1">Actions</label>
                          <label class="btn btn-transparent red btn-outline btn-circle btn-sm">
                              <input type="radio" name="options" class="toggle" id="option2">Settings</label>
                      </div>
                  </div>
              </div> -->
        <div class="portlet-body">
            <div class="table-toolbar">
                <div class="row">
                    <div class="col-md-6">
                        <div class="btn-group">
                            <button id="sample_editable_1_new" class="btn green" v-on:click="addNew"> Add New
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <!--        <div class="btn-group pull-right">
                                <button class="btn green btn-outline dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Tools
                                    <i class="fa fa-angle-down"></i>
                                </button>
                                <ul class="dropdown-menu pull-right">
                                    <li>
                                        <a href="javascript:;"> Print </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;"> Save as PDF </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;"> Export to Excel </a>
                                    </li>
                                </ul>
                            </div>-->
                    </div>
                </div>
            </div>
            <div id="sample_editable_1_wrapper" class="dataTables_wrapper no-footer">
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
                </div>
                <div class="table-scrollable">
                    <table class="table table-striped table-hover table-bordered dataTable no-footer"
                           id="sample_editable_1" role="grid" aria-describedby="sample_editable_1_info"
                           style="width: 1002px;">
                        <thead>
                        <tr role="row">
                            <th class="sorting_asc" tabindex="0" aria-controls="sample_editable_1" rowspan="1"
                                colspan="1" aria-label=" Username : activate to sort column descending"
                                style="width: 148px;" aria-sort="ascending">Настройка
                            </th>
                            <th tabindex="0"rowspan="1" colspan="1"
                                style="width: 167px;">
                                Значение
                            </th>

                            <th tabindex="0" aria-controls="sample_editable_1" rowspan="1" colspan="1"
                                aria-label=" Edit : activate to sort column ascending" style="width: 50px;"> Edit/Save
                            </th>
                        </tr>
                        </thead>
                        <tbody>

                        <setting-table-row
                                v-for="(setting, index) in settings"
                                v-bind:inputSetting="setting"
                                :key="index"
                                v-on:updateTable="getData"
                                v-on:showAlertMessage="showAlert"
                        ></setting-table-row>
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
                settings: [],
                alertMessage: []
            }
        },
        methods: {
            showAlert: function(message) {
                  this.alertMessage.push(message)
            },
            addNew: function () {
                this.currencies.unshift({
                    id: null,
                    code: "",
                    symbol : "",
                    countries : "",
                    delivery : ""
                })
            },
            getData: function () {
                axios
                    .get('/root/settings/list')
                    .then((response) => {
                        this.settings = response.data;
                    });
            },
        },
        mounted() {
            this.getData();
        },
        name: "setting-table"
    }
</script>

<style scoped>

</style>