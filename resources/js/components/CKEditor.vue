<template>
    <div>
        <textarea v-model.lazy="editorData"
                  style="visibility: hidden; display: none;"
                  name="content"></textarea>
        <ckeditor v-model="editorData"
                  :config="editorConfig">
        </ckeditor>
    </div>
</template>

<script>
    export default {
        name: 'ckeditor-component',
        props: {
            value: String
        },
        data() {
            return {
                editorConfig: {
                    filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
                    filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
                    filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
                    filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token=',
                },
                editorData: this.value
            };
        },
    }
</script>
