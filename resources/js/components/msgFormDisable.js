// ==================================
// メッセージの空チェック 空なら非活性
// ==================================

if ($('#form-msg')) {
    $(document).on('keyup','.js-msg-textarea',function () {
        if ($('.js-msg-textarea').val().length > 0) {
            $('.js-submit-btn').prop('disabled', false);
        } else {
            $('.js-submit-btn').prop('disabled', true);
        }
    })
 
}