<template>
    <div>
    <uiv-modal v-model="showPopup" title="Гинератор Документов" size="lg" v-on:hide="close">
        <tabs justified>
            <tab title="Программа">
                <div class="row">
                    <div class="col-md-12">
                        <div class="portlet box green">
                            <div class="portlet-body row">
                                <div class="col-md-2  col-md-offset-10">
                                    <button class="btn btn-sm green" @click="downloadProgram">Скачать<i class="fa fa-download"></i></button>
                                </div>
                            </div>
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
                book: {}
            }
        },
        computed: {
        },
        name: "DownloadCenter",
        props: ["inputEntity"],
        mounted() {
            this.book = Object.assign({}, this.inputEntity);
        },
        methods: {
            close: function () {
                this.$emit("close")
            },
            downloadProgram: function (event) {
                window.HTTP.get(laroute.route('root.book.generate-program', {}), {
                    responseType: 'blob',
                    params: {
                        bookId: this.book.id,
                    }
                }).then(response => {
                     const url = window.URL.createObjectURL(new Blob([response.data]));
                     const link = document.createElement('a');
                     link.href = url;
                     link.setAttribute('download', this.book.group.name + '.pdf');
                     document.body.appendChild(link);
                     link.click();
                });
            },
        },
    }
</script>
<style scoped>
</style>
