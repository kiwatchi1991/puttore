<template>
<div>

            <!-- 入力エリア -->
            <!-- <div class="column is-6" id="input-field-wrapper"> -->
                <!-- <h2><i class="fas fa-edit"></i> Input</h2> -->
                <input class="textarea"
                    id="lesson"
                    v-model="input"
                    
                    name="lessons[0][lesson]"
                    type="text"
                    placeholder="レッスン１"
                    @input="inputLesson"
                    />
                 <!-- <input type="hidden" name="_token" :value="csrf"> -->
                <!-- </textarea> -->
            <!-- </div> -->

            <!-- 表示エリア -->
            <!-- <div class="column is-6" id="preview-field-wrapper">
                <h2><i class="fas fa-eye"></i> Preview</h2>
                <div id="preview-field" class="content" v-html="convertMarkdown"></div>
            </div> -->
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
methods:{

},

    data() {
        return {
            input: ''// index.htmlでv-model="input"が付与されている要素と双方向データバインディングされている。
        }
    },
}
$('#edit').keyup(function() {
        var html = marked($(this).val());
        $('#preview').html(html);
    });
// $('#form').on('submit', function(e){
//      $('input[name="lessons[0][lesson]"]').val(e.target.value);
//     e.preventDefault();
//     // return false;
//     $.post( 'https://httpbin.org/post', $('#form').serialize() )
    
// .done(function( data ) {
 
//     console.log( data.form );
 
// })
</script>