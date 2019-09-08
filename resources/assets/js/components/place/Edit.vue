<template>
    <uiv-modal v-model="showPopup" title="Редактирование места" size="lg" v-on:hide="close">
        <div class="row">
            <div class="col-md-12">
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-settings">Место</i>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="form-group row">
                            <label class="col-md-2 control-label">Название</label>
                            <div class="col-md-10" v-bind:class="errors['name'] !== undefined ? 'has-error' : ''">
                                <input type="text" class="form-control" placeholder="Название"
                                       v-model="place.name">
                                <error-block :errors="errors['name']" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div slot="footer">
            <button class="btn btn-sm green" @click="save">Сохранить <i class="fa fa-save"></i></button>
            <button class="btn btn-sm default" @click="close">Закрыть <i class="fa fa-close"></i></button>
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
                place: {},
                errors: {},
            }
        },
        computed: {
        },
        name: "editPlace",
        props: ["inputEntity"],
        mounted() {
            this.place = Object.assign({}, this.inputEntity);
        },
        methods: {
            close: function () {
                this.$emit("close")
            },
            save: function (event) {
                this.errors = {};
                if (this.place.id !== null) {
                    window.HTTP.put(laroute.route('root.place.save', {}), this.place).then(response => {
                        if (response.status == 202) {
                            this.$emit("updated", this.place)
                            this.$emit("close")
                        }
                    }).catch(e => {
                        let responseErrors = e.response.data.errors;
                        Object.keys(responseErrors).map((item, index2) => {
                            this.errors[item] = responseErrors[item]
                        });
                        this.errors = Object.assign({}, this.errors);
                    });
                }
                else {
                    window.HTTP.post(laroute.route('root.place.create', {}), this.place).then(response => {
                        if (response.status == 201) {
                            this.$emit("created")
                            this.$emit("close")
                        }
                    }).catch(e => {
                        var responseErrors = e.response.data.errors;
                        Object.keys(responseErrors).map((item, index2) => {
                            this.errors[item] = responseErrors[item]
                        })
                        this.errors = Object.assign({}, this.errors);
                    });
                }

            },
        }
    }
</script>
<style scoped>
</style>