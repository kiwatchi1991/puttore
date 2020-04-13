<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <style>
        .c-contactEmail {
            padding: 16px;
        }

        .c-contactEmail__footer {
            padding: 16px;
        }
    </style>
    <div class="c-contactEmail">
        <p>ぷっとれをご利用いただきありがとうございます。</p>
        お問い合わせ内容を受け付けました。<br>
        <br>
        ■メールアドレス<br>
        {!! $email !!}<br>
        <br>
        ■タイトル<br>
        {!! $title !!}<br>
        <br>
        ■お問い合わせ内容<br>
        {!! nl2br($body) !!}<br>

        <div class="c-contactEmail__footer">
            ==============================<br>
            ぷっとれ カスタマーセンター<br>
            〒130-0022<br>
            東京都墨田区江東橋３－１－１０－１３０３<br>
            HP: <a href="https://puttore.com">https://puttore.com</a><br>
            MAIL: <a href="info@puttore.com">info@puttore.com</a><br>
            ==============================<br>
        </div>
    </div>

</body>

</html>