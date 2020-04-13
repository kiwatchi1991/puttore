<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <style>
        .c-buyEmail {
            padding: 16px;
        }

        .c-buyEmail__title {
            font-size: 18px;
            margin-top: 32px;
        }

        .c-buyEmail__contents {
            margin-top: 40px;
        }

        .c-buyEmail__footer {
            margin-top: 40px;
        }

        .c-buyEmail__link {
            font-size: 14px;
        }
    </style>
    <div class="c-buyEmail">
        <p>本メールは送信専用です。</p>
        <div class="c-buyEmail__title">
            <p class="c">{{ $user_name }} 様</p>
        </div>
        <p>ぷっとれをご利用いただきありがとうございます。</p>
        <p>以下の商品を購入しました。</p>
        <div class="c-buyEmail__contents">
            <p>◻️ 購入商品情報</p>
            商品名 : {{ $order->name }}<br>
            商品説明 : {{ $order->detail }}<br>
            出品者 : {{ $order->account_name }}<br>
            <span class="c-buyEmail__link">(購入した商品は <a
                    href="{{ route('products.show',$order->id) }}">こちら</a>)</span><br>
            購入金額 : {{ number_format($order->sale_price)}}<br>
            購入日時 : {{ $order->created_at }}<br>
        </div>
        <div class="c-buyEmail__footer">
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