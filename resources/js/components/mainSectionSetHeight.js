let setMainHeight = function () {
    let footerHeight = $('#footer')[0].clientHeight;

    //高さ計算
    $('#js-setHeight').removeClass('height');
    
    let getMainHeight = $('#js-setHeight').height();
    let setMainHeight = window.innerHeight - footerHeight;
    if (setMainHeight > getMainHeight) {
        console.log('if分岐');
        $('#js-setHeight').css('height', setMainHeight);
    }
};

$(window).on('load resize', setMainHeight);