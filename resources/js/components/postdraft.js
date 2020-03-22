let postdraft = function () {
    console.log('postdraftイベント発生');
    $('.js-isCheck-postType').on('click', function (e) {
        e.preventDefault();
        console.log('clickイベント発生');
    
        // var that = $(this);
        let postType = $(this).data('type');
        console.log('postType');
        console.log(postType);
        let $form = $('#form-product');

        if (postType == 'draft') {
            $(this).parents('.js-postType__parentDom').find('input[type=hidden]').val('draft');
        } else if (postType == 'register') {
            
            // if($form.find(':invalid').length === 0)
            // if($(input).checkValidity())
            // {
                // $(btn).prop('disabled', true);
                $(this).parents('.js-postType__parentDom').find('input[type=hidden]').val('register');
                // $form.submit();
                // }
                // else
                // {
                    //ツールチップを表示
                    // $form.find(':invalid').show();
                    // $form.reportValidity();
                // }
            }
            $form.submit();

    });
}
window.onload = postdraft();