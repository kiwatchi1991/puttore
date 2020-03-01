@extends('layouts.app')

@section('content')

カートに{{ $carts->count() }}件の商品が入っています。

@foreach ($carts as $cart)
<div class="c-cart__block">
    {{-- カート中身{{ $cart }} --}}
    <div class="c-cart__img">
        画像<img src="/storage{{ asset($cart->pic1) }}" alt="">
    </div>
    <div class="c-cart__title">
        タイトル{{ $cart->name }}

    </div>
    <div class="c-cart__price">
        価格{{ $cart->default_price }}

    </div>

    {{-- カートに追加する --}}
    <div class="c-button__block">
        <form method="POST" action="{{ route('ajaxcarts') }}">

            @csrf
            <input type="hidden" name="product_id" value="{{ $cart->id }}">
            <input type="hidden" name="type" value="delete">
            <button type="submit" class="c-button c-ajaxCart__icon js-ajaxCart__delete @if($cart) is-inCart @endif">
                カートから削除する
            </button>
        </form>
    </div>

    
</div>
@endforeach
{{-- 今すぐ購入するボタン --}}
<div class="c-button__block">
    <form method="post" action="{{ route('orders.create',$carts) }}">
            @csrf
            <button type="submit" class="c-button">

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
 
@endsection