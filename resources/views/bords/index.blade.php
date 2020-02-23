@extends('layouts.app')

@section('content')

連絡掲示板
メッセージ一覧です。

<div class="p-product__area">
    @foreach ($bords as $bord)
    <a href="{{ route('bords.show',$bord->id) }}">

        <div class="p-product__block">
            <img src="/storage/{{ $bord->pic }}" alt="">
        </div>
        <div class="p-product__block">
           販売者ユーザー名： {{ $bord->name }}
        </div>
    </a>
    @endforeach
</div>

@endsection