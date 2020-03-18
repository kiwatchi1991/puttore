@extends('layouts.app')
@section('title','マイページ')
@section('content')

<div class="c-mypage__nav">
    <div class="c-mypage__nav__list"><a href="/mypage">作品一覧<br>（下書き / 購入 / 販売）</a></div>
    <div class="c-mypage__nav__listactive"><a href="/mypage/order">販売管理</a></div>
</div>


<div class="c-profile__title__product">
    <h2>販売履歴</h2>
    {{-- @if($drafts->count() == 0) --}}
    <p style="margin-top: 32px">現在ありません</p>
    {{-- @endif --}}
    @foreach ($sale_histories as $sale_history)
    {{ $sale_history->created_at }}

    @endforeach
</div>






<div class="c-profile__title__product">
    <h2>購入履歴</h2>
    {{-- @if($drafts->count() == 0) --}}
    <p style="margin-top: 32px">現在ありません</p>
    {{-- @endif --}}
</div>













@endsection