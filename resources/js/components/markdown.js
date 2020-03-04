const marked = require('marked');

$('#lesson').keyup(function () {
    var html = marked($(this).val());
    $('#preview').html(html);
});



//画像を挿入
let $insert_btn =  $('.js-uploadimg');
$insert_btn.on('change',function(){
    console.log('画像を挿入ボタンクリック！！！ajax処理開始');
    console.log('ここまで1');
    let $this = $(this);
    console.log('ここまで2');
    // let postImgFile = $this.data('follow');

    let file = this.files[0];
    let fileReader = new FileReader();  //  ファイルを読み込むFileReaderオブジェクト
    fileReader.readAsDataURL(file);
    // let json = JSON.parse(fileReader['result']);

    fileReader.onload = function(){ 
    console.log('fileReader');
    console.log(fileReader);
    console.log('fileReader.result');
    console.log(fileReader[0]);
    console.log(fileReader['result']);
    // console.log('JSON');
    // console.log(json);
    console.log('ここまで3');

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: '/products/imgupload',
        type: 'POST',
        dataType: 'json',
        processData: false,
        data:{ 'uploadimg':fileReader['result']},
    })
    // Ajaxリクエストが成功した場合
    .done(function () {
        console.log('ここまで4');

  })
  // Ajaxリクエストが失敗した場合
  .fail(function (data) {
    console.log('エラー');
    console.log(data);
 })

}

})

let $follow = $('.c-ajaxFollow__icon');
let followPostId;
$follow.on('click', function () {
    console.log('ajaxfollow発火');
    console.log('ここまで1');
    let $this = $(this);
    console.log('ここまで2');
    followPostId = $this.data('follow');
    console.log('ここまで3');
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: '/products/ajaxfollow',
        type: 'POST',
        dataType: 'json',
        data:{ 'follow':followPostId},
    })
    // Ajaxリクエストが成功した場合
    .done(function () {
        console.log('ここまで4');
    $this.toggleClass('is-active');
  })
  // Ajaxリクエストが失敗した場合
  .fail(function (data) {
    console.log('エラー');
    console.log(data);
  });
})