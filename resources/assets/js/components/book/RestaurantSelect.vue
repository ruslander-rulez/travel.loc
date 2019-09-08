<template>
    <div>
        <popover title="Выберите меню:" trigger="manual" v-model="showMenus" >
            <v-select v-model="selectedInternal" :onChange="change" @search="search" :options="options"></v-select>
            <div class="row" v-if="menuInternal.length">
                <div class="col-md-1">
                    Меню:
                </div>
                <div class="col-md-11">
                    <ul>
                        <li v-for="menu_item in menuInternal">
                            {{ menu_item.name }}
                        </li>
                    </ul>
                </div>
            </div>
            <template slot="popover">
                <div v-if="selectedRestaurantId">
                    <i
                        @click="showMenus=false"
                        class="fa fa-close"
                        style="position: absolute; top: -5px; right: -5px; padding: 5px; cursor: pointer;"></i>
                    <div class="menu-row"  v-for="menu in restaurants[selectedRestaurantId].menus" @click="selectMenu(menu.dishes)">
                        {{ menu.name }}
                    </div>
                </div>
            </template>
        </popover>

    </div>
</template>

<script>
    import vSelect from "vue-select/src/components/Select.vue"
    import { Popover } from 'uiv'

    export default {
        name: "RestaurantSelect",
        props: [
            "selected",
            "menu"
        ],
        components: {
            "v-select": vSelect,
            "popover": Popover
        },
        methods: {
            change: function (value) {
               if (value.label) {
                   this.selectedInternal = value.label;
               }
               if (value.id) {
                   this.selectedRestaurantId = value.id;
                   this.showMenus = true
               }
            },
            search: function (string) {
                this.selectedInternal = string;
                let place = {
                    name: string,
                    menu: this.menu
                }
                this.$emit("change", place);
            },
            selectMenu: function (dishes) {
                this.showMenus = false
                this.menuInternal = dishes
                let place = {
                    name: this.selectedInternal,
                    menu: dishes
                }
                this.$emit("change", place);
            }
        },
        data() {
            return {
                ready: false,
                options: [],
                showMenus: false,
                selectedRestaurantId: null,
                restaurants: [],
                menuInternal: [],
                selectedInternal: null
            }
        },
        computed: {

        },
        watch: {

        },
        mounted() {
            axios
                .get(laroute.route('root.restaurant.list', {}), {params: {page: this.page, perPage: this.perPage}})
                .then((response) => {
                    response.data.forEach((item) => {
                        this.restaurants[item.id] = item;

                        this.options.push({
                            id: item.id,
                            label: item.name
                        })
                    });
                });
            this.selectedInternal = this.selected
            this.menuInternal = this.menu
        }
    }
</script>

<style scoped>
    .menu-row{
        cursor: pointer;
        padding: 4px;
    }
    .menu-row:hover{
        background-color: #f3f3f3;
    }
</style>