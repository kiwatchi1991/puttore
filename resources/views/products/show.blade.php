@extends('layouts.app')
@section('title','作品詳細')
@section('content')
<div class="c-productShow">
    <div class="c-productShow__inner">

        <div class="c-productShow__img">
            {{-- 画像がなかったらスライダーボタンを表示しない --}}
            @if($product_imgs[0] !== null)
            <img class="c-productShow__slider__nav prev js-slider__prev" src="/storage/images/angle-prev.png" alt="">
            <img class="c-productShow__slider__nav next js-slider__next" src="/storage/images/angle-next.png" alt="">
            @endif
            <ul class="c-productShow__slider__container js-slider__container">
                @foreach($product_imgs as $product_img)
                {{-- 画像がある分だけ表示する --}}
                @if($product_img)
                <li class="c-productShow__slider__item js-slider__item">
                    <img class="c-productShow__slider__item__img" src="/storage/{{ $product_img  }}" alt="">
                </li>
                @endif
                @endforeach

                {{-- 画像がなかったら、１枚だけnoimageを表示する --}}
                @if($product_imgs[0] == null)
                <img class="c-productShow__slider__noimage" src="/storage/images/noimage.png" alt="">
                @endif
            </ul>
        </div>
        <div class="l-productShow__wrapper">

            {{-- 自分の作品の場合は編集ボタンを表示 --}}
            @if ($product->user_id === Auth::id())

            <div class="c-productShow__editIcon js-editMenu-open">
                <i class="fas fa-ellipsis-h"></i>
            </div>

            <div class="c-productShow__editMenu js-editMenu">
                <div class="c-productShow__editMenu__list c-productShow__editMenu__list--edit">
                    <a class="" href="{{ route('products.edit',$product->id) }}">編集する</a></div>
                <div class="c-productShow__editMenu__list c-productShow__editMenu__list--delete js-editMenu-delete">
                    <form id="delete-form" method="POST" action="{{ route('products.delete',$product->id) }}">
                        @csrf
                    </form>
                    削除する
                </div>
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
                <p>更新日 : {{ $product->updated_at->format('Y-m-d') }}</p>
            </div>

            {{-- 価格 --}}
            <div class="">
                <p class="c-productShow__price @if($discount_price) is-inactive @endif">
                    ¥ {{ number_format($product->default_price) }}</p>
                <p class="c-productShow__price c-productShow__price--discount">
                    @if($discount_price)
                    ¥ {{ number_format($discount_price->discount_price) }}
                    <span class="c-productShow__price__discount">{{$discount_price->end_date}}まで</span>
                    @endif
                </p>
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

            {{-- ↓↓↓↓　お気に入り・購入ボタンはログインユーザーのみ表示 --}}
            @auth
            {{-- ↓↓↓↓　購入済みの場合はお気に入り・購入ボタン表示しない --}}
            @if(!$isOrder && $product->user_id !== Auth::id())
            {{-- ほしいものに追加する --}}
            <div class="c-productShow__like @if($liked) is-active @endif">
                <button type="submit" class="c-productShow__like__btn @if($liked) is-active @endif"
                    data-like="{{ $product->id }}">
                    @if($liked)ほしいものリストに入っています ♡@else ほしいものリストに追加する ♡@endif
                </button>
            </div>

            {{-- 今すぐ購入するボタン --}}
            <div class="c-productShow__buynow">
                <form method="post" action="{{ route('orders.create',$product->id) }}">
                    @csrf
                    <button type="submit" class="">

                        <script type="text/javascript" src="https://checkout.pay.jp/" class="payjp-button"
                            id="payjp-button" data-key="pk_test_65b86d16158dad1607ce9b69" data-on-created="onCreated"
                            data-text="今すぐ購入する" data-submit-text="支払いする"></script>
                    </button>
                </form>
            </div>
            @endif
            {{-- ↑↑↑　購入済みの場合はお気に入り・購入ボタン表示しない --}}
            @endauth
            @guest
            <div class="c-productShow__toLogin">
                <a class="c-productShow__toLogin__btn" href="{{ route('login') }}">ログインして今すぐ購入する！</a>
            </div>
            @endguest

            {{-- ↓↓↓↓　購入前の場合はLESSONページへボタンとメッセージボードへボタンを表示しない --}}
            @if($isOrder || $product->user_id === Auth::id())
            <div class="c-productShow__toLesson">
                <a class="c-productShow__toLesson__link" href="{{ route('lessons',[$product->id ,1]) }}">LESSONページへ</a>
            </div>
            <div class="c-productShow__toBord">
                <a class="c-productShow__toBord__link" href="{{ route('bords') }}">メッセージボードへ</a>
            </div>
            @endif
            {{-- ↑↑↑　購入前の場合はLESSONページへボタンとメッセージボードへボタンを表示しない --}}
        </div>
    </div>

    @endsection