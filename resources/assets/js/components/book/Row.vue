<template>
    <tr role="row" v-if="ready">
        <td :class="canceledBook">
            {{ book.id }}
        </td>
        <td>
            <div> {{ book.date_of_start.split(" ")[0]}}</div>
            -----------------
            <div> {{ book.date_of_end.split(" ")[0]}}</div>
        </td>
        <td class="group">
            <div>
                Название группы: {{ book.group_name }}
            </div>
            <div>
                Имя лидера: {{ book.leader_name }}
            </div>
            <div>
                Cостав:
                <table class="total-tourists">
                    <tr>
                        <td>Взрослые:</td>
                        <td>{{ book.total_tourists.adults }}</td>
                    </tr>
                    <tr>
                        <td>Студенты:</td>
                        <td>{{ book.total_tourists.students }}</td>
                    </tr>
                    <tr>
                        <td>Школьники:</td>
                        <td>{{ book.total_tourists.schoolchildren }}</td>
                    </tr>
                    <tr>
                        <td>Дошкольники:</td>
                        <td>{{ book.total_tourists.preschoolers }}</td>
                    </tr>
                    <tr>
                        <td><b>ВСЕГО:</b></td>
                        <td>{{  parseInt(book.total_tourists.adults) + parseInt(book.total_tourists.preschoolers) + parseInt(book.total_tourists.students) + parseInt(book.total_tourists.schoolchildren)}}</td>
                    </tr>
                </table>
            </div>
            <div>
                Водитель: {{ book.driver }}
            </div>
            <div>
                Гид: {{ book.guide }}
            </div>
        </td>
        <td>
            <span v-if="book.type_type === 'App\\Domain\\Ship\\Ship'">Круиз: <br>- {{ book.type.name }}</span>
            <span v-if="book.type_type === 'App\\Domain\\Hotel\\Hotel'">Отель: <br>- {{ book.type.name }}</span>
        </td>
        <td>
            <program_view_row
                v-for="(programRow, index) in book.program"
                :program="programRow"
                :key="index"
                @colorChanged="changeProgramColor(index, programRow)"
            ></program_view_row>
        </td>
        <td>
            {{ book.notes }}
        </td>
        <td class="actions">
            <button class="btn btn-sm btn-default" v-on:click="editPopup=true" title="Редактировать">
                <i class="fa fa-edit"></i>
            </button>
            <button class="btn btn-sm btn-warning" v-on:click="showDownloadCenterPopup=true" title="Центр загрузок">
                <i class="fa fa-download"></i>
            </button>

            <delete-button
                    @deleteItem="deleteItem"
            />


            <book-edit v-if="editPopup" v-on:close="editPopup=false" :inputEntity="book" v-on:updated="updated"/>

            <download-center
                v-if="showDownloadCenterPopup"
                v-on:close="showDownloadCenterPopup=false"
                :inputEntity="book"
            >
            </download-center>
        </td>
    </tr>
</template>

<script>

    import {AxiosInstance as HTTP} from "axios";

    export default {
        data() {
            return {
                bufer: {},
                ready: false,
                showDownloadCenterPopup: false,
                book: {
                    ship: {}
                },
                editPopup: false
            }
        },
        mounted() {
            this.book = this.inputEntity
            this.ready = true
        },
        name: "Row",
        props: ['inputEntity'],
        methods: {
            changeProgramColor: function (index, program) {
                window.HTTP.put(laroute.route('root.book.change-program-color', {}), {
                    bookId: this.book.id,
                    programIndex: index,
                    color: this.book.program[index].color
                }).then(response => {
                }).catch(e => {
                    let responseErrors = e.response.data.errors;
                    Object.keys(responseErrors).map((item, index2) => {
                        this.errors[item] = responseErrors[item]
                    });
                    this.errors = Object.assign({}, this.errors);
                });
            },
            updated: function (book) {
                this.book = book;
                this.$emit("message", "Запись была обновлена")
            },
            deleteItem: function () {
                this.showDeleteWarning = false
                window.HTTP.delete(laroute.route('root.book.delete', {}),{params: {
                    "id" : this.book.id
                }}).then(response => {
                    this.$emit('updateTable')
                }).catch( e => {
                    console.log(e)
                })
            }
        },
        computed: {
            canceledBook: function () {
                if (this.book.is_canceled) {
                    return "canceled-book"
                }
                return ""
            }
        }
    }
</script>

<style scoped>
    .canceled-book {
        background-color: #e7505a;
    }
    tr:hover .canceled-book {
        background-color: #e7505a !important;
    }
     .actions>* {
         margin: 6px 0;
     }
    .group > div:nth-child(2n) {
        background-color: #f3f3f3;
    }
    .group > div:nth-child(2n -1) {
        background-color: #d8d8d8;
    }
    .total-tourists {
        margin-left: 15px;
    }
    .total-tourists td {
        text-align: left !important;
    }
    .total-tourists tr>td:first-child{
        max-width: none;
        padding-right: 5px;
    }
    .total-tourists tr>td:first-child:before{
        content: "- ";
    }
</style>