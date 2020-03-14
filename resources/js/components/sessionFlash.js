// フラッシュメッセージのfadeout
$(function(){
    let $sessionFlash = $('.js-sessionMessage');
    if ($sessionFlash) {
        $sessionFlash.slideToggle('slow');
        setTimeout(function(){ $sessionFlash.slideToggle('slow'); }, 5000);
    }
});