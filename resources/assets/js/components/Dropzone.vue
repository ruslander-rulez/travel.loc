<template>
    <vue-dropzone
            ref="myVueDropzone"
            :id="id"
            :options="dropzoneOptions"
            @vdropzone-success="uploadSuccess"
    ></vue-dropzone>
</template>

<script>

    import vue2Dropzone from 'vue2-dropzone'
    import 'vue2-dropzone/dist/vue2Dropzone.min.css'

    export default {
        name: "Dropzone",
        components: {
            vueDropzone: vue2Dropzone
        },
        props: {
            id: {
                type: String,
                default: "dropzone"

            },
            multiple: {
                default: false,
                type: Boolean
            },
            acceptedFiles: {
                default: null,
                type: String
            }
        },
        methods: {
            uploadSuccess: function (file, response) {
                this.$emit("uploadSuccess", file, response);
            },
            disableDropZone: function() {
                this.$refs.myVueDropzone.disable()
            },
            enableDropzone: function () {
                this.$refs.myVueDropzone.enable()
            }
        },
        data: function () {
            return {
                dropzoneOptions: {
                    url: '/root/attachment',
                    uploadMultiple: this.multiple,

                    headers: {
                        "X-CSRF-TOKEN": document.head.querySelector("[name=csrf-token]").content
                    }
                }
            }
        }
    }
</script>

<style scoped>

</style>