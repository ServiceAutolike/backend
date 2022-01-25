<template>
    <div class="d-flex flex-column mb-8 fv-row">
        <label class="fs-6 fw-bold mb-2 required">Nội dung bài viết</label>
        <vue-editor v-model="editorContent"></vue-editor>
    </div>
</template>

<script>
import { VueEditor } from 'vue2-editor';

export default {
    name: "Editor",
    props: {
        content: String
    },
    computed: {
        editorContent: {
            get() { return this.content},
            set(updatedContent) { this.$emit('update:content', updatedContent) }
        },
    },
    components: {
        VueEditor
    }
};
</script>
