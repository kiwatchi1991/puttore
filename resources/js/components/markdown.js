let marked = require('marked');
//==========================================
//==========   マークダウンプレビューイベント
//==========================================
$(document).on('keyup', '.js-marked__textarea', function () {
    var html = marked($(this).val());
    $(this).parents('.js-add__target').find('.js-lesson__block--preview').html(html);
});

//編集画面では、最初から表示
let editMarkdown = function () {
  let $this = $('.js-marked__textarea');
  var html = marked($this.val());
  $this.parents('.js-add__target').find('.js-lesson__block--preview').html(html);
}
if ($('.js-edit-preview').length) {
  window.load = editMarkdown();
}


//レッスン詳細のマークダウンをプレビューする

let lessonPreview = function () {
  let $getData = $('#js-lessonShow__getText');
  if ($getData.length) {
    let lessonhtml = marked($getData.val());
    $('#js-lessonShow__preview').html(lessonhtml);
 }
}
window.load = lessonPreview();

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
