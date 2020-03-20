@extends('layouts.app')

@section('content')
<div class="container">
  <div class="">
    <div class="">
      <!-- フラッシュメッセージ -->
      @if (session('flash_message'))
      <div class="flash_message alert-success text-center py-3 my-2">
        {{ session('flash_message') }}
      </div>
      @endif

      <div class="c-authChange__container">
        <div class="c-authChange__title">メールアドレス変更</div>

        <div class="card-body">
          @if (session('status'))
          <div class="alert alert-success" role="alert">
            {{ session('status') }}
          </div>
          @endif
          {{-- You are logged in! --}}
        </div>

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

    </div>
  </div>
</div>
@endsection
