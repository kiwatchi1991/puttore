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
        #button {
            width: 200px;
            text-align: center;
        }

        #button a {
            padding: 10px 20px;
            display: block;
            background-color: #7DD4BB;
            border-radius: 10px;
            color: white;
            text-decoration: none;
        }

        #button a:hover {
            background-color: #2a88bd;
            color: #FFFFFF;
        }
    </style>

    <h1>
        パスワードリセット
    </h1>
    <p>
        以下のボタンを押下し、パスワードリセットの手続きを行ってください。
    </p>
    <p id="button">
        <a href="{{$reset_url}}">パスワードリセット</a>
    </p>

</body>

</html>