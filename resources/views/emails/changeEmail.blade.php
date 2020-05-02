<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <style>
        .c-changeEmail {
            padding: 16px;
            overflow-wrap: break-word;
            word-wrap: break-word;
            word-break: break-word;
        }
    </style>
    <div class="c-changeEmail">
        <a href="{{ config('app.url') }}">ぷっとれ</a>
        <p>
            下記のURLをクリックして新しいメールアドレスを確定してください。<br>
        </p>
        <p>
            {{ $actionText }}: <a href="{{ $actionUrl }}">{{ $actionUrl }}</a>
        </p>

        <p>
            ※URLの有効期限は一時間以内です。有効期限が切れた場合は、お手数ですがもう一度最初からお手続きを行ってください。<br>
        </p>
    </div>
</body>

</html>