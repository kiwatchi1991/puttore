@extends('layouts.app')
@section('title','マイページ')
@section('content')

<div class="c-mypage__nav">
    <div class="c-mypage__nav__list active"><a href="/mypage">作品一覧<br>（下書き / 購入 / 販売）</a></div>
    <div class="c-mypage__nav__list"><a href="/mypage/order">販売管理</a></div>
</div>

<div class="c-profile__title__product">
    <h2>下書き作品一覧</h2>
    @if($drafts->count() == 0)
    <p style="margin-top: 32px">現在ありません</p>
    @endif
</div>

<div class="p-product__area">
    @foreach ($drafts as $draft)
    <div class="c-product__block">

        <a class="c-product__link" href="{{ route('products.show', $draft->id) }}">
            <div class="c-image__block">
                @if($draft->pic1)
                <img class="c-image" src="/storage/{{ $draft->pic1 }}">
                @else
                <img class="c-image" src="/storage/images/noimage.png">
                @endif
            </div>
            <div class="c-tag__block">

                {{-- 言語表示 --}}
                @foreach ($product_categories->find($draft->id)->categories as $category)

                <div class="c-tag c-tag--category {{ $category->class_name }}">{{ $category->name }}</div>
                @endforeach

                {{-- 難易度表示 --}}
                @foreach ($product_difficulties->find($draft->id)->difficulties as $difficulty)

                <div class="c-tag c-tag--difficulty {{ $difficulty->class_name }}">{{ $difficulty->name }}</div>

                @endforeach
            </div>
            <div class="c-contents__block">

                <div class="c-contents__title">{{ $draft->name }}</div>
                <div class="c-contents__price">¥ {{ number_format($draft->default_price) }}</div>
                <div class="c-contents__detail">{{ $draft->detail }}</div>

            </div>
        </a>
    </div>
    @endforeach
</div>

{{-- 購入作品一覧 --}}
<div class="c-profile__title__product">
    <h2>購入作品一覧</h2>
    @if($buy_products->count() == 0)
    <p style="margin-top: 32px">現在ありません</p>
    @endif
</div>

<div class="p-product__area">
    @foreach ($buy_products as $buy_product)
    <div class="c-product__block">

        <a class="c-product__link" href="{{ route('products.show', $buy_product->id) }}">
            <div class="c-image__block">
                @if($buy_product->pic1)
                <img class="c-image" src="/storage/{{ $buy_product->pic1 }}">
                @else
                <img class="c-image" src="/storage/images/noimage.png">
                @endif
            </div>
            <div class="c-tag__block">

                {{-- 言語表示 --}}
                @foreach ($product_categories->find($buy_product->id)->categories as $category)

                <div class="c-tag c-tag--category {{ $category->class_name }}">{{ $category->name }}</div>
                @endforeach

                {{-- 難易度表示 --}}
                @foreach ($product_difficulties->find($buy_product->id)->difficulties as $difficulty)

                <div class="c-tag c-tag--difficulty {{ $difficulty->class_name }}">{{ $difficulty->name }}</div>

                @endforeach
            </div>
            <div class="c-contents__block">

                <div class="c-contents__title">{{ $buy_product->name }}</div>
                <div class="c-contents__price">¥ {{ number_format($buy_product->default_price) }}</div>
                <div class="c-contents__detail">{{ $buy_product->detail }}</div>

            </div>
        </a>
    </div>
    @endforeach
</div>


{{-- 出品作品 --}}
<div class="c-profile__title__product">
    <h2>出品作品一覧</h2>
    @if($products->count() == 0)
    <p style="margin-top: 32px">現在ありません</p>
    @endif
</div>
<div class="p-product__area">
    @foreach ($products as $product)
    <div class="c-product__block">

        <a class="c-product__link" href="{{ route('products.show', $product->id) }}">
            <div class="c-image__block">
                @if($product->pic1)
                <img class="c-image" src="/storage/{{ $product->pic1 }}">
                @else
                <img class="c-image" src="/storage/images/noimage.png">
                @endif
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
                <div class="c-contents__detail">{{ $product->detail }}</div>

            </div>
        </a>
    </div>
    @endforeach
</div>

</div>







@endsection