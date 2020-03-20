$('.js-request-transfer').on('click',
 function (e) {
    
    e.preventDefault();
    let confirm_result = window.confirm('振込依頼をします。よろしいですか？');
    if (confirm_result) {
        console.log('OK');
        location.href = '/mypage/transfer';
    } else {
        console.log('ダメ');
    }
}

);


