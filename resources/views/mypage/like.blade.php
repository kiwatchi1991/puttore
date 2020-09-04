@extends('layouts.app')
@section('title','お気に入り')
@section('content')

@include('mypage.nav', ['page' => 'like'])

<div class="c-mypage__products">
    <div class="c-mypage__products__title">
        <h2>お気に入り一覧</h2>
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
        @if($products->count()===0)
        <div class="c-mypage__products__nomsg">現在ありません</div>
        @endif
    </div>

</div>

@endsection