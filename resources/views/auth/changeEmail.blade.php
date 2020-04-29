@extends('layouts.app')
@section('content')

<div class="c-authChange__container">
  <div class="c-authChange__title">メールアドレス変更</div>

  <div class="c-authChange__form">
    <p class="c-authChange__form--text">新しいメールアドレスを入力してください。</p>
    <form action="/email" method="POST" class="c-authChange__form--body">
      {{ csrf_field() }}
      <input type="email" name="new_email" class="c-authChange__form--input">
      <div class="c-authChange__form--button">
        <input type="submit" class="c-authChange__form--submit" value="変更">
      </div>
    </form>
  </div>
</div>
@endsection