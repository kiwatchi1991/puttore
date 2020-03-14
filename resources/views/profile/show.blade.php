@extends('layouts.app')
@section('title','プロフィール')
@section('content')

<div class="c-profile">

    {{-- 画像 --}}
    <div class="c-profile__img">
        <img src="/storage/{{ $user->pic }}" alt="">
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


{{-- 購入作品 --}}
@if ($user->id === Auth::id())
<div class="c-profile__title__product">
    <h2>購入作品一覧</h2>
</div>

<div class="c-profile__buy">
    <ul class="c-profile__buy__container js-buy__container">
        <li class="c-profile__buy__list js-buy__item">
            <div class="c-profile__buy__item">

            </div>
        </li>
        <li class="c-profile__buy__list js-buy__item">
            <div class="c-profile__buy__item">

            </div>
        </li>
        <li class="c-profile__buy__list js-buy__item">
            <div class="c-profile__buy__item">

            </div>
        </li>
        <li class="c-profile__buy__list js-buy__item">
            <div class="c-profile__buy__item">

            </div>
        </li>
        <li class="c-profile__buy__list js-buy__item">
            <div class="c-profile__buy__item">

            </div>
        </li>
        <li class="c-profile__buy__list js-buy__item">
            <div class="c-profile__buy__item">

            </div>
        </li>
    </ul>
</div>
@endif

{{-- 下書き --}}
<div class="c-profile__title__product">
    <h2>下書き保存中の作品</h2>
</div>
@if ($drafts)

<div class="c-profile__draft">
    <ul class="c-profile__draft__container js-draft__container">
        @foreach ($drafts as $draft)
        <li class="c-profile__draft__list js-draft__item">
            <a href="{{ route('products.show', $draft->id) }}">
                <div class="c-profile__draft__item">
                    <div class="c-profile__draft__img__container">
                        @if($draft->pic1)
                        <img src="/storage/{{ $draft->pic1 }}" alt="">
                        @else
                        <img src="/storage/images/noimage.png" alt="">
                        @endif
                    </div>
                    <p>{{ $draft->name }}</p>
                    <p class="c-profile__draft__update">更新日</p>
                    <p class="c-profile__draft__update">{{ $draft->updated_at->format('Y年m月d日 H時i分')}}</p>
                </div>
            </a>
        </li>
        @endforeach
    </ul>
</div>
@endif



{{-- 出品作品 --}}
<div class="c-profile__title__product">
    <h2>出品作品一覧</h2>
</div>

<div class="c-pagination">
    {{ $products->appends(request()->input())->links('vendor.pagination.simple-default') }}
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