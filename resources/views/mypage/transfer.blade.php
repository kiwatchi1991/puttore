@extends('layouts.app')
@section('title','マイページ')
@section('content')

<div class="c-mypage__nav">
    <div class="c-mypage__nav__list"><a href="/mypage">アカウント</a></div>
    <div class="c-mypage__nav__list"><a href="/mypage">お気に入り</a></div>
    <div class="c-mypage__nav__list"><a href="/mypage">下書き</a></div>
    <div class="c-mypage__nav__list"><a href="/mypage">購入作品</a></div>
    <div class="c-mypage__nav__list"><a href="/mypage">出品作品</a></a></div>
    <div class="c-mypage__nav__list active"><a href="/mypage/order">販売管理</a></div>
    <div class="c-mypage__nav__list"><a href="/mypage/paid">振込履歴</a></div>
</div>

<div class="c-mypage__order">
    <div class="c-mypage__sale">
        <div class="c-mypage__products__title">
            <h2>{{$transfer->created_at->format('Y年m月d日')}} <br>振込依頼の売上一覧</h2>
        </div>

        <div class="c-mypage__sale__month">
            <table>
                <thead>
                    <tr>
                        <th class="c-mypage__sale__list c-mypage__sale__list--day">購入日</th>
                        <th class="c-mypage__sale__list c-mypage__sale__list--title">タイトル</th>
                        <th class="c-mypage__sale__list c-mypage__sale__list--price">価格</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                    <tr>
                        <td class="c-mypage__sale__list c-mypage__sale__list--day">
                            {{$order->created_at->format('Y年m月d日')}}</td>
                        <td class="c-mypage__sale__list c-mypage__sale__list--title">{{mb_strimwidth($order->name,0,10,'...')}}</td>
                        <td class="c-mypage__sale__list c-mypage__sale__list--price">¥
                            {{number_format($order->sale_price)}}</td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
            <div class="c-mypage__sale__nothing">
                @if ($orders->count() == 0)
                ありません
                @endif
            </div>
        </div>

    </div>
</div>


@endsection
