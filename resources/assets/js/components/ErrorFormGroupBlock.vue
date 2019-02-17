<template>
    <div v-if="errors !== undefined">
        <div v-for="error in errors">
            <span class="help-block help-block-error">{{ error }}</span>
        </div>
    </div>
</template>

<script>
    export default {
        props: ["errors"],
        name: "ErrorFormGroupBlock"
    }
</script>

<style scoped>

</style>