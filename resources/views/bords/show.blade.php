@extends('layouts.app')
@section('title','トークルーム')
@section('content')
@php

//購入販売の判断
$buy_userId = $bord->{'o.u_id'};
$sell_userId = $bord->{'p.u_id'};
$order_type = ($buy_userId == $self_user_id) ? "購入" : "販売";
$class_order_type = ($buy_userId == $self_user_id) ? "buy" : "sell";

if($order_type == "購入"){
$pic = $user->find($sell_userId)->pic;
}else{
$pic = $user->find($buy_userId)->pic;
}



@endphp

<div class="c-messages__head">
    {{-- <div class="c-messages__head__order {{$class_order_type}}">
    {{ $order_type }}
</div> --}}
<div class="c-messages__head__userImg__wrapper">
    <img src="/storage/{{ $pic }}" alt="" class="c-messages__head__userImg">
</div>
<div class="c-messages__head__title">
    @php echo mb_strimwidth( $bord->name, 0, 20, '…', 'UTF-8' ); @endphp
</div>
</div>

<div class="c-messages__inner">
    @foreach ($messages as $message)
    @php
    //メッセージの、自分と相手の判断
    $recieve_userId = $message->recieve_user_id;
    @endphp
    <div class="c-message">
        @if($recieve_userId == $self_user_id)
        <div class="c-message__userImg__wrapper">
            <img src="/storage/{{ $pic }}" alt="" class="c-message__userImg">
        </div>
        @endif
        <div class="c-message__msg @if($recieve_userId == $self_user_id) inself @endif">
            {{ $message->msg }}
        </div>
    </div>
    @endforeach
</div>

{{-- : {{ $order }} --}}
<form class="c-messages__form" method="POST" action="{{ route('messages.create',$ordersId) }}">
    <div class="c-messages__inputArea">
        @csrf
        <input class="c-messages__input" type="text" name="messages" placeholder="ここにメッセージを入力してください"
            value="{{ old('messages') }}">
        <input type="hidden" value="{{ $order->id }}" name="id">
        <button type="submit" class="c-messages__button">
            送信
        </button>
    </div>
</form>
@endsection