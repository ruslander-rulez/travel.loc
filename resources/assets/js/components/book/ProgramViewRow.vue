<template>
    <div v-bind:style="style" v-if="program.place.dinner" v-uiv-popover.hover="{title:'Меню', content: popoverContent}">
        <div>{{program.date}} {{program.time}}</div>
        <div>
                <i class="fa fa-cutlery" aria-hidden="true"></i> {{ program.place.name}}
        </div>
        <hr>
    </div>
    <div v-bind:style="style" v-else="program.place.dinner">
        <div>{{program.date}} {{program.time}}</div>
        <div>
            {{ program.place.name}}
        </div>
        <hr>
    </div>
</template>

<script>
    export default {
        name: "ProgramViewRow",
        props: ["program"],
        computed: {
            style: function () {
                let styleObj = {};
                if (this.program.color) {
                    styleObj["background-color"] = "#" + this.program.color
                }
                return styleObj;
            },
            popoverContent: function () {
                console.log(typeof  this.program.place.menu);
                if (typeof this.program.place.menu === "undefined") {
                    return ""
                }
                let result = "";
                console.log(this.program.place.menu);
                for (var item in this.program.place.menu) {
                    console.log(this.program.place.menu[item].name);
                    result = this.program.place.menu[item].name + "; "
                }
                return result
            }
        }
    }
</script>

<style scoped>

</style>