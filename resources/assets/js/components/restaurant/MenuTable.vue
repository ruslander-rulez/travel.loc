<template>
    <div class="table-scrollable">
        <table class="table table-striped table-bordered table-hover table-checkable order-column dataTable no-footer"
               id="sample_1" role="grid" aria-describedby="sample_1_info">
            <thead>
            <tr role="row">

                <th tabindex="0" rowspan="1" colspan="1"
                > #
                </th>
                <th tabindex="0" rowspan="1" colspan="1"
                > Имя
                </th>
                <th tabindex="0" rowspan="1" colspan="1" width="46"
                >
                </th>
            </tr>
            </thead>
            <tbody>

            <menu-row
                    v-for="(menuItem, index ) in value"
                    v-bind:key="menuItem.name+menuItem.id+index"
                    v-model="value[index]"
                    v-on:remove="value.splice(index, 1)"
            ></menu-row>
                <tr>
                    <td></td>
                    <td></td>
                    <td>
                        <button id="sample_editable_1_new" class="btn bold btn-primary" v-on:click="showNewForm=true"> Добавить
                            <i class="fa fa-plus"></i>
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
        <menu-edit v-if="showNewForm" v-on:close="showNewForm=false" :inputEntity="defaultMenu" v-on:updated="created">
        </menu-edit>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                showNewForm : false,
                defaultMenu: {
                    id: null,
                    name: "",
                    dishes: []
                },
                menus: [],
                alertMessage: []
            }
        },
        props: ["value"],
        methods: {
            showAlert: function(message) {
                this.alertMessage.push(message)
            },
            created: function(menu) {
                this.showAlert("Меню было добавлено")
                this.value.push(menu)
            },
        },
        watch: {

        },
        mounted() {
        },
        name: "MenuTable",
    }
</script>

<style scoped>
</style>
