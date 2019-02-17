<template>
    <div>
        <div class="col-md-5 col-sm-5">

            <div class="dataTables_info" id="sample_editable_1_info" role="status" aria-live="polite">
                Showing {{ countEntries.from }} to {{ countEntries.to }} of {{ maxCountItems }} entries
            </div>
        </div>
        <div class="col-md-7 col-sm-7">
            <uiv-pagination
                    size="md"
                    v-bind:total-page="Math.ceil(parseFloat(parseInt(this.maxCountItems ? this.maxCountItems : 1 ) / parseInt(this.perPage ? this.perPage : 1)))"
                    v-model="page"
                    v-on:change	="goToPage"
                    align="right"
            >
            </uiv-pagination>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
            }
        },
        props: ["maxCountItems", "page", "perPage", "countEntries"],
        name: "Pagination",
        methods: {
            goToPage: function () {
                this.$emit("goToPage", this.page)
            },
        }
    }
</script>

<style scoped>

</style>