<template>
    <tr role="row">
        <td>
            {{ value.id }}
        </td>
        <td>
            {{ value.name}}
        </td>
        <td>
            <button class="btn btn-sm btn-default" v-on:click="editPopup=true"><i class="fa fa-edit"></i></button>

            <menu-edit v-if="editPopup" v-on:close="editPopup=false" :inputEntity="value" v-on:updated="updated">
            </menu-edit>

            <delete-button
                    @deleteItem="deleteItem"
            />
        </td>
    </tr>
</template>

<script>

    import {AxiosInstance as HTTP} from "axios";

    export default {
        data() {
            return {
                bufer: {},
                menu: {},
                showDeleteWarning: false,
                editPopup: false
            }
        },
        mounted() {
        },
        name: "Row",
        props: ['value'],
        methods: {
            updated: function (menu) {
                this.value.name = menu.name;
                this.value.dishes = menu.dishes;
                this.value.id = menu.id;
                this.$emit("message", "Меню обновлено")
            },
            deleteItem: function () {
                this.$emit('remove')
            }
        }
    }
</script>

<style scoped>

</style>