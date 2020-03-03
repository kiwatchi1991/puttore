const marked = require('marked');

$('#lesson').keyup(function () {
    var html = marked($(this).val());
    $('#preview').html(html);
});



//画像を挿入
$('.js-insertImg').on('click',function(){
    console.log('画像を挿入ボタンクリック！！！');
})