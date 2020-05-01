$(function () {
    $('.js-modal-open').on('click', function () {
        $('.js-modal').fadeIn();
        return false;
    });
    $('.js-modal-close').on('click', function () {
        $('.js-modal').fadeOut();
        return false;
    });
});

//画像のモーダル表示〜削除まで
$(function () {
    const $modal = $('.js-imgModal');
    const $modalImg = $('.js-img-insert-target');

    //モーダル開く
    $(document).on('click', '.js-imgModal-open', function () {
        const $targetBtn = $(this);

        imgPrev($targetBtn);
        $modal.fadeIn();
        $('body').css('overflow', 'hidden');
        return false;
    });

    //キャンセルして閉じる
    $(document).on('click', '.js-imgModal-close', function () {
        $modal.fadeOut();
        $('body').css('overflow', 'visible');
        return false;
    });

    //削除する
    $(document).on('click', '.js-imgModal-delete', function () {
        const dataModal = $modalImg.attr('data-modal');
        const $deleteTarget = $('.js-prev__img[data-modal="' + dataModal + '"]');
        const $deleteBtn = $deleteTarget.parents('.js-image-parents').find('.js-imgModal-open')

        $deleteTarget.prop('src', '');
        $deleteTarget.siblings('.js-flg-delete').val(1);
        $modal.fadeOut();
        $('body').css('overflow', 'visible');
        $deleteBtn.hide();

        
        return false;
    });
    
    //モーダルへ画像表示する関数
    function imgPrev(option) {
        const $targetBtn = option;
        
        const $img = $targetBtn.parents('.js-image-parents').find('.js-prev__img');
        const src = $img.attr('src');
        const dataModal = $img.attr('data-modal');

        $modalImg.attr('src',src);
        $modalImg.attr('data-modal',dataModal);
    }
})