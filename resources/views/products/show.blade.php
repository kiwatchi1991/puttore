@extends('layouts.app')

@section('content')
{{-- @if (empty($isOrder)) --}}
    
<div class="c-productShow">

<div>
    <div class="c-product__img">
        <ul>
            @foreach($product_imgs as $product_img)
            @if($product_img)
            <li>
            <img src="/storage/{{ $product_img  }}" alt="">
            </li>
            @endif
            @endforeach
        </ul>
</div>
<div class="l-productShow__wrapper">
        @if ($product->user_id === Auth::id())

        <div class="c-edit__button">
        <a class="c-button" href="{{ route('products.edit',$product->id) }}">
            <i class="fas fa-edit"></i>
            </a>
        </div>
        @endif
        {{-- タイトル --}}
        <div class="c-productShow__title">
            <h2>{{ $product->name }}</h2>
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

        {{-- 今すぐ購入するボタン --}}
        {{-- <div class="c-productShow__buynow">
            <form method="post" action="{{ route('orders.create',$product->id) }}">
                    @csrf
                    <button type="submit" class="">

                        <script
                        type="text/javascript"
                        src="https://checkout.pay.jp/"
                        class="payjp-button"
                        id="payjp-button"
                        data-key="pk_test_65b86d16158dad1607ce9b69"
                        data-on-created="onCreated"
                        data-text="今すぐ購入する"
                        data-submit-text="pay"
                        ></script>
                </button>
            </form>
        </div> --}}
        
        {{-- カリキュラム --}}
        <div class="c-productShow__curriculum">
            <div class="c-productShow__curriculum__head"><h2>カリキュラム</h2></div>
                <div class="c-productShow__lessons">
                    @foreach ($lessons as $lesson)
                        <div class="c-productShow__lesson">
                            <div class="c-productShow__lesson__number">LESSON {{ $lesson->number }}</div>
                            <div class="c-productShow__lesson__title"> {{ $lesson->title }}</div>
                        </div>
                    @endforeach
            </div>
        </div>

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

                        <script
                        type="text/javascript"
                        src="https://checkout.pay.jp/"
                        class="payjp-button"
                        id="payjp-button"
                        data-key="pk_test_65b86d16158dad1607ce9b69"
                        data-on-created="onCreated"
                        data-text="今すぐ購入する"
                        data-submit-text="pay"
                        ></script>
                </button>
            </form>
        </div>

</div>

{{-- 購入済みの場合 --}}
{{-- @else --}}
{{-- <div class="l-productShow__wrapper">

    <div class="c-productShow__title">
        <h2>「タイトル」: {{ $product->name }}</h2>
    </div>

    <div class="c-tag__block">

        {{-- 言語表示 --}}
        @foreach ($categoryAndDifficulty->find($product->id)->categories as $category)

        <div class="c-tag c-tag--category">{{ $category->name }}</div>
        @endforeach

        {{-- 難易度表示 --}}
        @foreach ($categoryAndDifficulty->find($product->id)->difficulties as $difficulty)

        <div class="c-tag c-tag--difficulty">{{ $difficulty->name }}</div>

        @endforeach
    </div>

    <div class="c-productShow__detail">
        <p>　レッスン内容(無料部分):{{ $product->detail}}</p>
    </div>

     {{-- カリキュラム --}}
     <div class="c-productShow__curriculumBlock">
        <h2>カリキュラム</h2>
        @foreach ($lessons as $lesson)
        <div class="c-productShow__curriculum">
            <p>LESSON {{ $lesson->number }} <span> {{ $lesson->title }}</span></p>  
            <div>
                {{ $lesson->lesson }}
            </div>
        </div>
        @endforeach
    </div>



</div> --}}

{{-- @endif --}}

</div>

@endsection
