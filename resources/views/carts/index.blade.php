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

</div>
@endforeach
 
@endsection