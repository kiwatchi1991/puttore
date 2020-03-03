@extends('layouts.app')

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
    <div class="c-messages__head__pic">
        {{ $order_type }}
    </div>
    <div class="c-messages__head__type">
        {{-- {{ $order_type }} --}}
    </div>
    <div class="c-messages__head__title">

    </div>
</div>

<div class="c-messages">
    @foreach ($messages as $message)
    @php
  //メッセージの、自分と相手の判断
  $send_userId =  $message->send_user_id;   
  @endphp
<div class="c-message @if($send_userId == $self_user_id) self @endif">{{ $message->msg }}</div>
@endforeach
</div>

<div class="c-bords__inputArea">
     {{-- : {{ $order }} --}}
    <form method="POST" action="{{ route('messages.create',$ordersId) }}">
        @csrf
        <input type="text" name="messages" value="{{ old('messages') }}">
        <input type="hidden" value="{{ $order->id }}" name="id">
        <button type="submit">
            送信
        </button>
    </form>

</div>

@endsection