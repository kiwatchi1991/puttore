$(function () {
    $('.js-editMenu-open').on('click', function () {
        $('.js-editMenu').toggle();
        return false;
    });
});

$('.js-editMenu-delete').on('click',function (e) {
    
    e.preventDefault();
    let confirm_result = window.confirm('この作品を削除します。よろしいですか？');
    if (confirm_result) {
         
        console.log('OK');
        $('#delete-form').submit();
    } else {
        console.log('ダメ');
    }
}

);

 if($('.js-popup').length){
    $('.js-popup').click(function() {
    $(window).off('beforeunload');
    });
     $(window).on('beforeunload', function (e) {
         return 'このページを離れますか？'; // Google Chrome以外
     });
  
}