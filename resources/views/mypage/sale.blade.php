@extends('layouts.app')
@section('title','出品作品')
@section('content')

<div class="c-mypage__nav">
    <div class="c-mypage__nav__list"><a href="/mypage">アカウント</a></div>
    <div class="c-mypage__nav__list"><a href="/mypage/like">お気に入り</a></div>
    <div class="c-mypage__nav__list"><a href="/mypage/draft">下書き</a></div>
    <div class="c-mypage__nav__list"><a href="/mypage/buy">購入作品</a></div>
    <div class="c-mypage__nav__list active"><a href="/mypage/sale">出品作品</a></a></div>
    <div class="c-mypage__nav__list"><a href="/mypage/order">販売管理</a></div>
    <div class="c-mypage__nav__list"><a href="/mypage/paid">振込履歴</a></div>
</div>

<div class="c-mypage__products">
    <div class="c-mypage__products__title">
        <h2>出品作品一覧</h2>
    </div>

    <div class="c-product__area">
        @foreach ($products as $product)
        <div class="c-product__block">

            <a class="c-product__link" href="{{ route('products.show', $product->id) }}">

                <div class="c-image__block">
                    <img class="c-image" src="/storage/{{($product->pic1)?$product->pic1:"images/noimage.png"}}">
                </div>
                <div class="c-tag__block">

                    {{-- 言語表示 --}}
                    @foreach ($product_categories->find($product->id)->categories as $category)

                    <div class="c-tag c-tag--category {{ $category->class_name }}">{{ $category->name }}</div>
                    @endforeach

                    {{-- 難易度表示 --}}
                    @foreach ($product_difficulties->find($product->id)->difficulties as $difficulty)

                    <div class="c-tag c-tag--difficulty {{ $difficulty->class_name }}">{{ $difficulty->name }}</div>

                    @endforeach
                </div>
                <div class="c-contents__block">

                    <div class="c-contents__title">{{ $product->name }}</div>
                    <div class="c-contents__price">¥ {{ number_format($product->default_price) }}</div>
                    <div class="c-contents__detail">{{ mb_strimwidth($product->detail, 0, 50, "...") }}</div>

                </div>
            </a>
        </div>
        @endforeach
    </div>

</div>

@endsection