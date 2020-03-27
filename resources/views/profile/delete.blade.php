@extends('layouts.app')
@section('title','退会')
@section('content')

<div class="c-profileDelete">
    <h2 class="c-profileDelete__title">退会しますか？</h2>

    <div class="c-profileDelete__form">

        <form id="form" method="POST" action="{{ route('profile.deleteData',$user->id) }}"
            enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{ $user->id }}" />
            <div class="c-profileDelete__submit">

                <button class="c-profileDelete__submit__btn" type="submit">はい</button>
            </div>
        </form>
    </div>

</div>
@endsection