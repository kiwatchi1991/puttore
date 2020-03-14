let marked = require('marked');

//レッスン詳細のマークダウンをプレビューする

let lessonPreview = function () {
  let $getData = $('#js-lessonShow__getText');
  if ($getData.length) {
    let lessonhtml = marked($getData.val());
    $('#js-lessonShow__preview').html(lessonhtml);
 }
}
window.load = lessonPreview();


//画像を挿入
let $insert_btn =  $('.js-uploadimg');
$insert_btn.on('change',function(){
    console.log('画像を挿入ボタンクリック！！！ajax処理開始');
    console.log('ここまで1');

    let file = this.files[0];
    let formData = new FormData();
    formData.append('file',file);
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
        target.val(target.val() + '\n\n![代替テキスト](/storage/' + data + ')\n\n');
        target.trigger('keyup'); //keyupイベントを強制的に発生させて、プレビューできるようにする

  })
  // Ajaxリクエストが失敗した場合
  .fail(function (data) {
    console.log('エラー');
    console.log(data);
 })
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
