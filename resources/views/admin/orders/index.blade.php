@extends('layouts.admin')
@section('content')

<div class="c-admin__head">
    <div class="c-admin__sort">
        <p class="c-admin__sort__title">並べ替え</p>
        <div class="p-admin__sort__listWrap">
          <a class="c-admin__sort__list" href="{{ route('admin.order','sort=0')}}">id 降順</a>
          <a class="c-admin__sort__list" href="{{ route('admin.order','sort=1')}}">id 昇順</a>
        </div>
    </div>
</div>

<div class="c-admin__delete">
    <form method="POST" action="{{ route('admin.user.deletes.confirm') }}">
        @csrf
        <div class="c-admin__delete__btnWrap">
          <input class="c-admin__delete__btn" type="submit" value="一括削除">
        </div>
        <div class="c-admin__title">注文一覧</div>

        <div class="admin__users">
            <div class="c-admin__users">
                @foreach ($orders as $order)
                <div class="c-admin__user__list">
                    <div class="c-admin__user__element id">id <span>{{ $order->id}}</span></div>
                    <div class="c-admin__user__element id">購入ユーザーid <span>{{ $order->{'buy.u_id'} }}</span></div>
                    <div class="c-admin__user__element email">販売ユーザーid<span>{{ $order->{'sale.u_id'} }}</span></div>
                    <div class="c-admin__user__element">販売ユーザーid<span>{{$order->name }}</span></div>
                    <div class="c-admin__user__element name">作品タイトル<span>{{ $order->name }}</span></div>
                    <div class="c-admin__user__element name">販売価格<span>{{ $order->sale_price }}</span></div>
                    <a class="c-admin__user__edit" href="{{ route('admin.order.show',$order->id)}}">確認</a>
                </div>
                @endforeach
            </div>
        </div>
    </form>
</div>
{{-- <script src="{{ asset('js/app.js') }}"></script> --}}
@endsection
