// 購入後のロード画面
$(document).on('click', '#js-loading', function(){
  
    var h = $(window).height();
    
    $('#load-after').css('display', 'none');
    $('#loader-bg ,#loader').height(h).css('display', 'block');

        $(window).load(function () { //全ての読み込みが完了したら実行
            $('#loader-bg').delay(900).fadeOut(800);
            $('#loader').delay(600).fadeOut(300);
            $('#load-after').css('display', 'block');
        });
    $('#payjp_close').on('click', function () {
        console.log('ばつボタンおした！');
        return false;
    })
})

    
// $('#js-loading').on('click', function () {
        
//         var h = $(window).height();
        
//         $('#load-after').css('display', 'none');
//         $('#loader-bg ,#loader').height(h).css('display', 'block');
        
//         $(window).load(function () { //全ての読み込みが完了したら実行
//             $('#loader-bg').delay(900).fadeOut(800);
//             $('#loader').delay(600).fadeOut(300);
//             $('#load-after').css('display', 'block');
//         });
//     })