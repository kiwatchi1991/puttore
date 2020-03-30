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

 if($('.c-productEdit').length){
        console.log('あるよ');
        $('.js-postType').click(function() {
    $(window).off('beforeunload');
    });
     $(window).on('beforeunload', function (e) {
         return 'このページを離れますか？'; // Google Chrome以外
         // e.returnValue = 'このページを離れますか？'; // Google Chrome
     });
    
    // $('#form-product').on('submit', function(e){
    //     e.preventDefault();
    //     window.onbeforeunload = null; // 関数を削除
    //     var $this = $(this);
    //     $this.submit();
    // });
}