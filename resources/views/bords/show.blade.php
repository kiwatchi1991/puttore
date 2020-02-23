@extends('layouts.app')

@section('content')

連絡掲示板
トークルームです。

<div class="c-bords__inputArea">
    $bords->id : {{ $orders }}
    <form method="POST" action="{{ route('messages.create',$ordersId) }}">
        @csrf
        <input type="text" name="messages" value="{{ old('messages') }}">
        <input type="hidden" value="{{ $orders->id }}" name="id">
        <button type="submit">
            送信
        </button>
    </form>
</div>
<div class="c-bords__messageArea">

</div>

@endsection