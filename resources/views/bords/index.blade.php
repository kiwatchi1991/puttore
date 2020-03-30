@extends('layouts.app')
@section('title','メッセージボード')
@section('content')

<div class="c-bords__head">メッセージボード</div>



<div class="c-bords">
    @foreach ($bords as $bord)

    @php

    $buy_userId = $bord->user_id;
    $sell_userId = $bord->{'p.user_id'};
    $order_type = ($buy_userId == $id) ? "購入" : "販売";
    $class_order_type = ($buy_userId == $id) ? "buy" : "sell";

    if($order_type == "購入"){
    $pic = $user->find($sell_userId);
    }else{
    $pic = $user->find($buy_userId);
    }

    $firstmsg = $messages->where('order_id',$bord->id)->first();
    @endphp



    <a class="c-bord__list {{$class_order_type}}" href="{{ route('bords.show',$bord->id) }}">
        <div class="c-bord__inner">

            <div class="c-bord__half--left">
                <div class="c-bord__userImg__wrapper">
                    <img src="/storage/{{($pic->pic)?$pic->pic:'images/noavatar.png'}}" alt="" class="c-bord__userImg">
                </div>
            </div>

            <div class="c-bord__half--right">
                <div class="c-bord__half--top">
                    <div class="c-bord__order {{$class_order_type}}">
                        {{ $order_type }}
                    </div>
                    <div class="c-bord__title">
                        @php echo mb_strimwidth( $bord->name, 0, 20, '…', 'UTF-8' ); @endphp
                    </div>
                </div>
                <div class="c-bord__half--bottom">
                    <p class="c-bord__latestMsg">
                        {{ ($firstmsg)? mb_strimwidth($firstmsg->msg, 0, 30, '…', 'UTF-8'):'メッセージはありません' }}</p>
                    <p class="c-bord__created">{{ $bord->msg_updated_at->format('Y-m-d H:i') }}</p>
                </div>
            </div>
        </div>
    </a>
    @endforeach



</div>
@endsection