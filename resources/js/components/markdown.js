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
// let setLessonUploadImg = function () {
  
//   let $insert_btn = document.getElementsByClassName('js-lessonUploadImg');
//   for (let i = 0; i < $insert_btn.length; i++){
//     $insert_btn[i].addEventListener('change',function () {
//       let target = $(this);
//       lessonUploadImg(target);
//     })
//   }



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
