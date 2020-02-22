<template>
<div>
<nav class="navbar">
            <h1 class="title">Markdown Editor</h1>
        </nav>
        <div class="columns">
            <div class="column is-6" id="input-field-wrapper">
                <h2><i class="fas fa-edit"></i> Input</h2>
                <textarea class="textarea"
                    name="lessons[0][lesson]"
                    id="input-field"
                    v-model="input">
                </textarea>
            </div>
            <div class="column is-6" id="preview-field-wrapper">
                <h2><i class="fas fa-eye"></i> Preview</h2>
                <div id="preview-field" class="content" v-html="convertMarkdown"></div>
            </div>
        </div>
</div>
</template>

<script>
import marked from 'marked'

export default {
    mounted() {
   
    console.log('Component mounted.');
  },
computed: {
        convertMarkdown: function() {
            // index.htmlでv-html="convertMarkdown"が付与されている要素（エレメント）とバイディングされている。
            // 入力されたデータをHTMLに変換して表示させる。
            return marked(this.input);
        }
    },
    data() {
        return {
            input: ''// index.htmlでv-model="input"が付与されている要素と双方向データバインディングされている。
        }
    },
}
</script>