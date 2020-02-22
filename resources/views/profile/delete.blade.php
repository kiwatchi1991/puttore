@extends('layouts.app')

@section('content')
退会しますか？

ユーザーid : {{ $user->id }}
<form id="form" method="POST" action="{{ route('profile.deleteData',$user->id) }}" enctype="multipart/form-data" >
@csrf
    <input type="hidden" name="id" value="{{ $user->id }}" />
    <button type="submit">はい</button>
</form>

@endsection