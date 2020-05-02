@extends('layouts.app')
@section('title','プロフィール')
@section('content')
<div class="c-product__index">
    @if ($user->id === Auth::id())
    <div class="c-mypage__nav">
        <div class="c-mypage__nav__list"><a href="/mypage">アカウント</a></div>
        <div class="c-mypage__nav__list"><a href="/mypage/like">お気に入り</a></div>
        <div class="c-mypage__nav__list"><a href="/mypage/draft">下書き</a></div>
        <div class="c-mypage__nav__list"><a href="/mypage/buy">購入作品</a></div>
        <div class="c-mypage__nav__list"><a href="/mypage/sale">出品作品</a></a></div>
        <div class="c-mypage__nav__list"><a href="/mypage/order">販売管理</a></div>
        <div class="c-mypage__nav__list"><a href="/mypage/paid">振込履歴</a></div>
    </div>
    @endif

    <div class="c-profile">

        {{-- 画像 --}}

        <div class="c-profile__img" style="background-image:url(/storage/{{$pic}})">
        </div>
        {{-- プロフィール名 --}}
        <div class="c-profile__name">
            {{ $user->account_name }}
            {{-- 自分のときはプロフィール名の後ろに編集アイコン出す --}}
            @if ($user->id === Auth::id())
            {{-- <div class=""> --}}
            <a class="c-profile__edit" href="{{ route('profile.edit',$user->id) }}">
                <i class="far fa-edit"></i>
            </a>

            {{-- </div> --}}
            @endif

        </div>
        {{-- 肩書き --}}
        <div class="c-profile__title">
            {{ $user->account_title }}
        </div>
        {{-- 自己紹介 --}}
        <div class="c-profile__detail">
            {{ $user->account_detail }}
        </div>
    </div>

    {{-- 出品作品 --}}
    <div class="c-profile__title__product">
        <h2>出品作品一覧</h2>
    </div>

    <div class="c-product__area">
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
                    <div class="c-contents__detail">{{ mb_strimwidth($product->detail, 0, 50, "...") }}</div>

                </div>
            </a>
        </div>
        @endforeach
    </div>
</div>

@endsection