$('.js-request-transfer').on('click',
 function (e) {
     e.preventDefault();
    
    //銀行口座情報が登録されていなければ、アラートを出してreturn falseで処理を終える
    const name = $('#js-bank-name').val();
    const branch = $('#js-bank-branch').val();
    const num = $('#js-bank-num').val();
     
    function bankCheck(option) {
         return (option !== '' && option !== null && option !== undefined) ? true : false;
    } 
     
    const isBankCheck = (bankCheck(name) && bankCheck(branch)) && bankCheck(num);

    if (!isBankCheck) {
        alert('マイページのアカウント設定（https://puttore.com/mypage）より、銀行口座情報の登録をしてください。');
        return false;
    }

    //銀行口座情報が登録されていた場合は確認用アラートを表示
    let confirm_result = window.confirm('振込依頼をします。よろしいですか？');
    if (confirm_result) {
        location.href = '/mypage/transfer';
    } else {
        //
    }
}

);


