let postdraft = function () {
    console.log('postdraftイベント発生');
    $('.js-isCheck-postType').on('click', function (e) {
        e.preventDefault();
        console.log('clickイベント発生');
    
        // var that = $(this);
        let postType = $(this).data('type');
        console.log('postType');
        console.log(postType);

        if (postType == 'draft') {
            $(this).parents('.js-postType__parentDom').find('input[type=hidden]').val('draft');
        } else if (postType == 'register') {
            $(this).parents('.js-postType__parentDom').find('input[type=hidden]').val('register');
        }

        $('#form').submit();
    });
}
window.onload = postdraft();