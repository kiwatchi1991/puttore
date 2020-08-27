@extends('layouts.app')
@section('title','作品詳細')
@section('content')

{{-- ↓↓↓　購入後のローディング画面 --}}
<div id="loader-bg">
    <div id="loader">
        <img src="/storage/images/loading.gif" width="80" height="80" alt="Now Loading..." />
        <p class="loader__text">購入処理を行っています...</p>
    </div>
</div>
{{-- ↑↑↑　購入後のローディング画面 --}}
<div id="load-after">
    <div class="c-productShow">
        <div class="c-productShow__inner">

            <div class="c-productShow__img">
                {{-- 画像がなかったらスライダーボタンを表示しない --}}
                @if($product_imgs !== [])
                <img class="c-productShow__slider__nav prev js-slider__prev" src="/storage/images/angle-prev.png"
                    alt="">
                <img class="c-productShow__slider__nav next js-slider__next" src="/storage/images/angle-next.png"
                    alt="">
                @endif
                <ul class="c-productShow__slider__container js-slider__container">
                    @if($product_imgs)
                    @foreach($product_imgs as $product_img)
                    @if($product_img != null)
                    {{-- 画像がある分だけ表示する --}}
                    <li class="c-productShow__slider__item js-slider__item">
                        <img class="c-productShow__slider__item__img" src="/storage/{{ $product_img  }}" alt="">
                    </li>
                    @endif
                    @endforeach
                    @endif

                    {{-- 画像がなかったら、１枚だけnoimageを表示する --}}
                    @if($product_imgs === [])
                    <img class="c-productShow__slider__noimage" src="/storage/images/noimage.png" alt="">
                    @endif
                </ul>
            </div>
            <div class="l-productShow__wrapper">

                {{-- 自分の作品の場合は編集ボタンを表示 --}}
                @if ($product->user_id === Auth::id())

                {{-- @if($product->open_flg == 1) <div class="c-productShow__draft">下書き保存中</div>@endif --}}
                <div class="c-productShow__editMenu js-editMenu">
                    @if($product->open_flg == 1) <div class="c-productShow__draft">下書き保存中</div>@endif
                    <div class="c-productShow__editMenu__list c-productShow__editMenu__list--delete js-editMenu-delete">
                        <form id="delete-form" method="POST" action="{{ route('products.delete',$product->id) }}">
                            @csrf
                        </form>
                        <i class="far fa-trash-alt"></i>
                    </div>
                    <div id="js-bank_confirm-edit"
                        class="c-productShow__editMenu__list c-productShow__editMenu__list--edit">
                        <a class="" href="{{ route('products.edit',$product->id) }}"><i class="far fa-edit"></i></a>
                    </div>
                </div>

                @endif

                {{-- タイトル --}}
                <div class="c-productShow__title">
                    <h2 class="c-productShow__title__text">{{ $product->name }}
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
                    <a href="{{ route('profile.show',$user[0]->id)}}">
                        <div class="c-productShow__userimg"
                            style="background-image:url(/storage/{{($user[0]->pic)?$user[0]->pic:'images/noavatar.png'}})">
                        </div>
                    </a>
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
                {{-- お気に入りに追加する --}}
                <div class="c-productShow__like @if($liked) is-active @endif">
                    <button type="submit" class="c-productShow__like__btn js-ajaxLike__btn @if($liked) is-active @endif"
                        data-like="{{ $product->id }}">
                        @if($liked)お気に入りに入っています ♡@else お気に入りに追加する ♡@endif
                    </button>
                </div>

                {{-- 今すぐ購入するボタン --}}
                <div class="c-productShow__buynow" id="js-loading">
                    <form id="js-loading-form" method="post" action="{{ route('orders.create',$product->id) }}">
                        @csrf
                        <button type="submit" class="" style="pointer-events: none"></button>
                        {{-- トークン発行に成功した時に実行される　ローディング画面 --}}
                        <script type="text/javascript">
                            function loading(options){
                                var h = $(window).height();
                                
                                $('#load-after').css('display', 'none');
                                $('#loader-bg ,#loader').height(h).css('display', 'block');
                                
                                $(window).on('load',function () { 
                                    $('#loader-bg').delay(900).fadeOut(800);
                                    $('#loader').delay(600).fadeOut(300);
                                $('#load-after').css('display', 'block');
                            });
                        }
                        </script>
                        <script type="text/javascript" src="https://checkout.pay.jp/" class="payjp-button"
                            id="payjp-button" data-key="{{ $payjp_pk }}" data-on-created="loading" data-text="今すぐ購入する"
                            data-submit-text="支払いする"></script>
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
                    <a class="c-productShow__toLesson__link"
                        href="{{ route('lessons',[$product->id ,1]) }}">LESSONページへ</a>
                </div>
                <div class="c-productShow__toBord">
                    <a class="c-productShow__toBord__link" href="{{ route('bords') }}">メッセージボードへ</a>
                </div>
                @endif
                {{-- ↑↑↑　購入前の場合はLESSONページへボタンとメッセージボードへボタンを表示しない --}}
            </div>
        </div>
    </div>
</div>
@endsection