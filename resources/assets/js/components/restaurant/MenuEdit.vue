<template>
    <uiv-modal v-model="showPopup" title="Редактирование меню" size="lg" v-on:hide="close">
        <div class="row">
            <div class="col-md-12">
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-settings">Меню</i>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="form-group row" v-bind:class="validationNameError">
                            <label class="col-md-2 control-label">Название меню</label>
                            <div class="col-md-10">
                                <input type="text" v-model="menu.name" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 control-label">Блюда</label>
                            <div class="col-md-10">
                                <table class="table table-striped table-bordered table-hover table-checkable order-column dataTable no-footer">
                                    <thead>
                                        <tr>
                                        <th>Название блюда</th>
                                        <th width="50"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(item, key) in menu.dishes">
                                        <td>
                                            <input type="text" class="form-control" v-model="item.name" />
                                        </td>
                                        <td>
                                            <button
                                                class="btn btn-danger"
                                                @click="menu.dishes.splice(key, 1)"
                                            >
                                                <i class="fa fa-trash" aria-hidden="true"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td></td>
                                            <td>
                                                <button
                                                    class="btn btn-primary"
                                                    @click="addNewMenuItem"
                                                >
                                                    Добавить
                                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div slot="footer">
            <button class="btn btn-sm green" @click="save">Применить <i class="fa fa-save"></i></button>
            <button class="btn btn-sm default" @click="close">Отмена<i class="fa fa-close"></i></button>
        </div>
    </uiv-modal>
</template>
<script>
    import { VueEditor } from 'vue2-editor'

    export default {
        components: {
            VueEditor
        },
        data() {
            return {
                showPopup: true,
                menu: {
                    name: "",
                    dishes: []
                },
                errors: {},
            }
        },
        computed: {
            validationNameError: function () {
                if (this.menu.name === "") {
                    return  "has-error"
                }
                return ""
            }
        },
        name: "editMenu",
        props: ["inputEntity"],
        mounted() {
            this.menu = JSON.parse(JSON.stringify(this.inputEntity));
        },
        methods: {
            addNewMenuItem: function () {
                this.menu.dishes.push({
                    name: "",
                })
            },
            close: function () {
                this.$emit("close")
            },
            save: function (event) {
                if (this.menu.name === "") {
                    return;
                }

                this.$emit("updated", this.menu)
                this.$emit("close")
            },
        }
    }
</script>
<style scoped>
    .modal.fade.in {
        z-index: 10300 !important;
        height: 90vh;
    }
</style>
<style>
    .modal-backdrop.fade.in {
        z-index: 100 !important;
    }
    .popover.top.fade.in {
        z-index: 10500 !important;
    }
</style>