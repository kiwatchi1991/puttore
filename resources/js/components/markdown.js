let marked = require('marked');

//レッスン詳細のマークダウンをプレビューする
let $getData = $('#js-lessonShow__getText');
if (!$getData == null && !$getData == undefined) {
  var html = marked($getData.val());
  console.log(html);
  $('#js-lessonShow__preview').html(html);
}



//画像を挿入
let $insert_btn =  $('.js-uploadimg');
$insert_btn.on('change',function(){
    console.log('画像を挿入ボタンクリック！！！ajax処理開始');
    console.log('ここまで1');
    console.log('ここまで2');
    // let postImgFile = $this.data('follow');

    let file = this.files[0];
    let formData = new FormData();
    console.log('formData append前');
    console.log(...formData.entries());
    formData.append('file',file);
    // let json = JSON.parse(formData['result']);

    // formData.onload = function(){
    console.log('file');
    console.log(file);
    console.log('file.val');
    // console.log(file.prop('files'));
    console.log('formData append後');
    console.log(...formData.entries());
    console.log('ここまで3');

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: '/products/imgupload',
        type: 'POST',
        dataType: 'json',
        processData: false,
        contentType : false,
        data:formData,
    })
    // Ajaxリクエストが成功した場合
    .done(function (data) {
      let target = $('#lesson');
        console.log('ここまで4');
        console.log(data);
        target.val(target.val() + '\n\n![代替テキスト](/storage/' + data + ')\n\n');
        target.trigger('keyup'); //keyupイベントを強制的に発生させて、プレビューできるようにする

  })
  // Ajaxリクエストが失敗した場合
  .fail(function (data) {
    console.log('エラー');
    console.log(data);
 })

// }

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
