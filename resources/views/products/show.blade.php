@extends('layouts.app')
@section('title','作品詳細')
@section('content')
{{-- @if (empty($isOrder)) --}}

<div class="c-productShow">

    <div class="c-productShow__img">
        <img class="c-productShow__slider__nav prev js-slider__prev" src="/storage/images/angle-prev.png" alt="">
        <img class="c-productShow__slider__nav next js-slider__next" src="/storage/images/angle-next.png" alt="">
        <ul class="c-productShow__slider__container js-slider__container">
            @foreach($product_imgs as $product_img)
            @if($product_img)
            <li class="c-productShow__slider__item js-slider__item">

                <img class="c-productShow__slider__item__img" src="/storage/{{ $product_img  }}" alt="">
            </li>
            @endif
            @endforeach
        </ul>
    </div>
    <div class="l-productShow__wrapper">

        {{-- 自分の作品の場合は編集ボタンを表示 --}}
        @if ($product->user_id === Auth::id())

        <div class="c-productShow__editIcon">
            <a class="" href="{{ route('products.edit',$product->id) }}">
                <i class="fas fa-edit"></i>
            </a>
        </div>
        @endif

        {{-- タイトル --}}
        <div class="c-productShow__title">
            <h2 class="c-productShow__title__text">{{ $product->name }} @if($product->open_flg == 1) <span
                    class="c-productShow__draft">下書き保存中</span>@endif
            </h2>
        </div>

        {{--　更新日  --}}
        <div class="c-productShow__updated">
            <p>{{ $product->updated_at }}</p>
        </div>

        {{-- 価格 --}}
        <div class="">
            <p class="c-productShow__price @if($discount_price) is-inactive @endif">
                ¥ {{ $product->default_price }}</p>
            @if($discount_price)
            {{ $discount_price->discount_price }}
            @else
            @endif
        </div>

        {{-- タグ --}}
        <div class="c-tag__block">

            {{-- 言語表示 --}}
            @foreach ($categoryAndDifficulty->find($product->id)->categories as $category)

            <div class="c-tag c-tag--category {{ $category->class_name }}">{{ $category->name }}</div>
            @endforeach

            {{-- 難易度表示 --}}
            @foreach ($categoryAndDifficulty->find($product->id)->difficulties as $difficulty)

            <div class="c-tag c-tag--difficulty {{ $difficulty->class_name }}">{{ $difficulty->name }}</div>

            @endforeach
        </div>

        {{-- 出品者 --}}
        <div class="c-productShow__user">
            <div class="c-productShow__userimg">
                <img src="/storage/{{ $user[0]->pic }}" alt="">
            </div>
            <div class="c-productShow__username">
                <p>{{ $user[0]->account_name }}</p>
            </div>
        </div>
        {{-- レッスン内容 --}}
        <div class="c-productShow__detail">
            <p>{{ $product->detail}}</p>
        </div>

        {{-- カリキュラム --}}
        <div class="c-productShow__curriculum">
            <div class="c-productShow__curriculum__head">
                <h2>カリキュラム</h2>
            </div>
            <div class="c-productShow__lessons">
                @foreach ($lessons as $lesson)
                <div class="c-productShow__lesson">
                    <div class="c-productShow__lesson__number">LESSON {{ $lesson->number }}</div>
                    <div class="c-productShow__lesson__title"> {{ $lesson->title }}</div>
                </div>
                @endforeach
            </div>
        </div>

        {{-- 受講における必要スキル --}}
        <div class="c-productShow__requireSkills">
            <div class="c-productShow__requireSkills__head">
                <h2>受講に必要なスキル</h2>
            </div>
            <div class="c-productShow__requireSkills__text">{{ $product->skills }}</div>
        </div>

        {{-- ↓↓↓↓　購入済みの場合はお気に入り・購入ボタン表示しない --}}
        @if(!$isOrder && !$product->user_id === Auth::id())
        {{-- ほしいものに追加する --}}
        <div class="c-productShow__like">
            <button type="submit" class="c-ajaxLike__icon @if($liked) is-active  @endif" data-like="{{ $product->id }}">
                ほしいものリストに追加する
            </button>
        </div>

        {{-- 今すぐ購入するボタン --}}
        <div class="c-productShow__buynow">
            <form method="post" action="{{ route('orders.create',$product->id) }}">
                @csrf
                <button type="submit" class="">

                    <script type="text/javascript" src="https://checkout.pay.jp/" class="payjp-button" id="payjp-button"
                        data-key="pk_test_65b86d16158dad1607ce9b69" data-on-created="onCreated" data-text="今すぐ購入する"
                        data-submit-text="pay"></script>
                </button>
            </form>
        </div>
        @endif
        {{-- ↑↑↑　購入済みの場合はお気に入り・購入ボタン表示しない --}}

        {{-- ↓↓↓↓　購入前の場合はLESSONページへボタンとメッセージボードへボタンを表示しない --}}
        @if($isOrder || $product->user_id === Auth::id())
        <div class="c-productShow__toLesson">
            <a href="{{ route('lessons',[$product->id ,1]) }}">LESSONページへ</a>
        </div>
        <div class="c-productShow__toBord">
            <a href="{{ route('bords') }}">メッセージボードへ</a>
        </div>
        @endif
        {{-- ↑↑↑　購入前の場合はLESSONページへボタンとメッセージボードへボタンを表示しない --}}

        {{-- <div class="l-productShow__toLessonPages">

            @foreach ($lessons as $lesson)

            <div class="c-productShow__toLessonPage">
                <a>LESSON {{ $lesson->number }}</a>
    </div>
    @endforeach

</div> --}}

</div>

@endsection