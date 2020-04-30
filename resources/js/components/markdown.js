let marked = require('marked');
marked.setOptions({ breaks: true });
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

  for (let i = 0; i < $this.length; i++) {
    let html = marked($($this[i]).val());
    $($this[i]).parents('.js-add__target').find('.js-lesson__block--preview').html(html);
  }

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
