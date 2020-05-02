<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="">
    <title>Document</title>
</head>

<body>

    <style>
        .c-passresetMail {
            padding: 16px;
        }

        .c-passresetMail__title {
            font-size: 24px;
        }
    </style>

    <div class="c-passresetMail">
        <h1 class="c-passresetMail__title">
            パスワードリセット
        </h1>
        <p>
            以下のボタンを押下し、パスワードリセットの手続きを行ってください。
        </p>
        <p id="button">
            <a href="{{$reset_url}}">パスワードリセット</a>
        </p>
    </div>
</body>

</html>