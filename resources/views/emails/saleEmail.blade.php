<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <style>
        .c-saleEmail {
            padding: 16px;
        }

        .c-saleEmail__title {
            font-size: 18px;
            margin-top: 32px;
        }

        .c-saleEmail__contents {
            margin-top: 40px;
        }

        .c-saleEmail__footer {
            margin-top: 40px;
        }

        .c-saleEmail__link {
            font-size: 14px;
        }
    </style>
    <div class="c-saleEmail">
        <p>本メールは送信専用です。</p>
        <div class="c-saleEmail__title">
            <p class="c">{{ $user_name }} 様</p>
        </div>
        <p>ぷっとれをご利用いただきありがとうございます。</p>
        <p>出品中の商品が購入されましたのでご連絡差し上げます。</p>
        <div class="c-saleEmail__contents">
            <p>◻️ 購入された商品の情報</p>
            商品名 : {{ $order->name }}<br>
            商品説明 : {{ $order->detail }}<br>
            購入者 : {{ $order->account_name }}<br>
            <span class="c-saleEmail__link">(購入された商品は <a
                    href="{{ route('products.show',$order->id) }}">こちら</a>)</span><br>
            購入金額 : {{ number_format($order->sale_price)}}<br>
            購入日時 : {{ $order->created_at }}<br>
        </div>
        <div class="c-saleEmail__footer">
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