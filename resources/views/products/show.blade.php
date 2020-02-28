@extends('layouts.app')

@section('content')
<div>
    <button class="">
        @if ($product->user_id === Auth::id())

        <div class="c-button__block">
        <a class="c-button" href="{{ route('products.edit',$product->id) }}">
                （自分の作品の場合は）編集する
            </a>
        </div>
        @endif
        <div class="">
            <h2>「タイトル」:{{ $product->name }}</h2>
        </div>
        <div class="">
            <p>　レッスン内容(無料部分):{{ $product->detail}}</p>
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
        <div class="">
            <p>　出品者:{{ $user[0]->account_name }}</p>
        </div>
        <button type="submit" class="c-button c-ajaxFollow__icon @if($follow) is-active  @endif" data-follow="{{ $user[0]->id }}">
            フォローする
        </button>
        <div class="">
            <p>　最終更新日:{{ $product->updated_at }}</p>
        </div>
        <div class="">
          <p class="c-price @if($discount_price) is-inactive　@endif">
            ¥ {{ $product->default_price }}</p>
          @if($discount_price)
                {{ $discount_price->discount_price }}
          @else
          @endif
        </div>
        <div class="c-button__block">
        <form method="post" action="{{ route('orders.create',$product->id) }}">
                @csrf
                <button type="submit" class="c-button">

                    <script
            type="text/javascript"
            src="https://checkout.pay.jp/"
            class="payjp-button"
            id="payjp-button"
            data-key="pk_test_65b86d16158dad1607ce9b69"
            data-on-created="onCreated"
            data-text="pay"
            data-submit-text="pay"
            ></script>
                </button>
            </form>
        </div>
        <div class="c-button__block">
            <button type="submit" class="c-button c-ajaxLike__icon @if($liked) is-active  @endif" data-like="{{ $product->id }}">
               ほしいものリストに追加する
            </button>
        </div>
        <div class="c-button__block">
            <button type="submit" class="c-button c-ajaxCart__icon @if($cart) is-inCart  @endif" data-cart="{{ $product->id }}">
               カートに追加する
            </button>
        </div>
        <div class="">
            <p>　¥ {{ $product->default_price }}</p>
        </div>
    </div>

    「出品ユーザーの顔」:{{ $user[0]->account_name }}
</div>
@endsection
