@extends('layouts.app')
@section('title','メッセージ')
@section('content')

<div class="c-messages__title">メッセージルーム</div>


@php

//購入販売の判断
$buy_userId = $bord->{'o.u_id'};
$sell_userId = $bord->{'p.u_id'};
$order_type = ($buy_userId == $self_user_id) ? "buy" : "sale";
// $class_order_type = ($buy_userId == $self_user_id) ? "buy" : "sell";
$partnerId = ($order_type == "buy") ? $sell_userId : $buy_userId;

if($order_type == "buy"){
$pic = ($user->find($sell_userId)->pic)?$user->find($sell_userId)->pic:'images/noavatar.png';
}else{
$pic = ($user->find($buy_userId)->pic)?$user->find($buy_userId)->pic:'images/noavatar.png';
}



@endphp
<div class="footer-none"></div>

<div class="c-messages__wrapper">
    <div class="c-messages__head">

        <a href="{{ route('bords') }}" class="c-message__userImg__item"></a>
        <div class="c-messages__head__userImg__wrapper" style="background-image:url(/storage/{{$pic}})">
            <a class="c-messages__head__userImg__link" href="{{ route('profile.show',$partnerId) }}">
            </a>
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
        <div class="c-message @if($recieve_userId == $self_user_id ) inself @endif">
            @if($recieve_userId == $self_user_id)
            <a href="{{ route('profile.show',$message->send_user_id)}}">
                <div class="c-message__userImg__wrapper">
                    <img src="/storage/{{ $pic }}" alt="" class="c-message__userImg">
                </div>
            </a>
            @endif
            <div>

                <div class="c-message__msg @if($recieve_userId == $self_user_id) inself @endif">
                    {{ $message->msg }}
                </div>
                <div class="c-message__postDate @if($recieve_userId == $self_user_id) inself @endif">
                    {{ $message->created_at }}
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <form id="form-msg" class="c-messages__form" method="POST" action="{{ route('messages.create',$ordersId) }}">
        <div class="c-messages__inputArea">
            @csrf
            <textarea class="c-messages__input js-msg-textarea" name="messages" rows="4"
                placeholder="ここにメッセージを入力してください"></textarea>
            <input type="hidden" value="{{ $order->id }}" name="id">
            @error('messages')
            <span class="c-productNew__error" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
            <button type="submit" class="c-messages__button js-submit-btn" disabled>
                送信
            </button>
        </div>
    </form>
</div>

@endsection