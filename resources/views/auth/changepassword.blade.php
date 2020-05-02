@extends('layouts.app')
@section('title','パスワード変更')
@section('content')
<div class="c-authChange__container">
  <p class="c-authChange__title">パスワード変更</p>
  <p class="c-authChange__title--under">Change Password</p>

  @if (session('change_password_error'))
  <div class="container mt-2">
    <div class="alert alert-danger">
      {{session('change_password_error')}}
    </div>
  </div>
  @endif

  @if (session('change_password_success'))
  <div class="container mt-2">
    <div class="alert alert-success">
      {{session('change_password_success')}}
    </div>
  </div>
  @endif

  <div class="c-authChange__form">
    <form method="POST" action="{{route('changepassword')}}" class="c-authChange__form--body">
      @csrf
      <div>
        <label for="current" class="c-authChange__form--text">
          現在のパスワード
        </label>
        <input id="current" type="password" class="c-authChange__form--input" name="current-password" required
          autofocus>
      </div>
      <div class="form-group">
        <label for="password" class="c-authChange__form--text">
          新しいパスワード
        </label>
        <div>
          <input id="password" type="password" class="c-authChange__form--input" name="new-password" required>
          @if ($errors->has('new-password'))
          <span class="help-block">
            <strong>{{ $errors->first('new-password') }}</strong>
          </span>
          @endif
        </div>
      </div>
      <div class="form-group">
        <label for="confirm" class="c-authChange__form--text">
          新しいパスワード（確認用）
        </label>
        <div>
          <input id="confirm" type="password" class="c-authChange__form--input" name="new-password_confirmation"
            required>
        </div>
      </div>
      <div class="c-authChange__form--button">
        <input type="submit" class="c-authChange__form--submit" value="変更">
      </div>
    </form>
  </div>
</div>
@endsection