<template>
    <tr
            role="row"
            class="odd"
            v-if="editProcess !== true"
    >
        <td class="sorting_1"> {{ setting.title }}</td>
        <td> {{ setting.value}}</td>
        <td>
            <a
                class="edit" href="javascript:;"
                v-on:click="edit"
            > Edit </a>
        </td>
    </tr>
    <tr
        v-else
    >
        <td class="sorting_1"> {{ setting.title }}</td>

        <td class="center"  v-bind:class="this.errors['code'] !== undefined ? 'has-error' : ''">
            <input type="text" class="form-control input-large" v-model="setting.value">
        </td>

        <td>
            <a class="edit" href="javascript:;" v-on:click="save">Save</a>
            <a class="cancel" href="javascript:;" v-on:click="cancel">Cancel</a>
        </td>
    </tr>

</template>

<script>

    import {AxiosInstance as HTTP} from "axios";

    export default {
        data() {
            return {
                editProcess: false,
                errors:{},
                bufer: {},
                setting: {}
            }
        },
        mounted() {
            this.setting = this.inputSetting
        },
        name: "Row",
        props: ['inputSetting'],
        methods: {
            save: function (event) {
                this.errors = {};
                window.HTTP.put("/settings", this.setting).then(response => {
                    if (response.status == 202) {
                        this.editProcess = false;
                        this.$emit("showAlertMessage", "Настройка была обновлена");
                    }
                }).catch( e => {
                    let responseErrors = e.response.data.errors;
                    Object.keys(responseErrors).map((item, index2) => {
                            this.errors[item] = responseErrors[item]
                    });
                    this.errors = Object.assign({}, this.errors);
                });
            },
            edit: function (event) {
                this.bufer = Object.assign({}, this.setting);
                this.editProcess = true
            },
            cancel: function () {
                this.errors = []

                this.setting = Object.assign({}, this.bufer);
                this.editProcess = false
            }
        }
    }
</script>

<style scoped>

</style>