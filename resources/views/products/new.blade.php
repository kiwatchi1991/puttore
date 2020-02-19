@extends('layouts.app')

@section('content')
<div class="">
    <div class="">
        <div class="new">
            <section class="new__wrapper">
                <div class="">レッスン内容登録</div>

                <div class="">
                    <form method="POST" action="{{ route('products.create') }}" enctype="multipart/form-data" >
                        @csrf
                        {{-- 名前 --}}
                        <div class="">
                            <label for="name" class="">名前</label>

                            <div class="">
                                <input id="name" type="text" class="new__input-area @error('name') is-invalid @enderror"
                                    name="name" value="{{ old('name') }}" autocomplete="name" autofocus>

                                @error('name')
                                <span class="" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        {{-- 言語選択 --}}
                        <div class="searchbox">
                            <div class="serchbox__inner">
                                <ul>
                                    {{-- <p>1.言語を選んでね</p> --}}
                                <li for="lang" class="c-tag__title">言語

                                    <ul class="c-tag__list">
                                        @foreach ($category as $categories)
                                        <li><input id="lang" type="checkbox" class="new__input-area @error('lang') is-invalid @enderror"
                                            name="lang[]" value="{{ $categories->id }}" autocomplete="lang" autofocus>{{ $categories->name }}</li> 
                                            @endforeach
                                        </ul>
                                </li>
                                {{-- <p>２.難易度を選んでね</p> --}}
                                <li for="lang" class="c-tag__title">難易度
                                    <ul class="c-tag__list">
                                        @foreach ($difficult as $difficults)
                                        <li><input id="difficult" type="checkbox" class="new__input-area @error('difficult') is-invalid @enderror"
                                        name="difficult[]" value="{{ $difficults->id }}" autocomplete="difficult" autofocus>{{ $difficults->name }}</li> 
                                        @endforeach
                                    </ul>  
                                </li> 
                                </ul> 
                                    @error('name')
                                    <span class="" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                
                            </div>
                            </div>
                        </div>

                        {{-- 説明 --}}
                        <div class="">
                            <label for="detail"
                                class="">説明</label>

                            <div class="">
                                <input id="detail" type="text"
                                    class="new__input-area @error('detail') is-invalid @enderror" name="detail"
                                    value="{{ old('detail') }}" autocomplete="detail" autofocus>

                                @error('detail')
                                <span class="" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        {{-- レッスン内容 --}}
                        <div class="">
                            <label for="lesson" class="">レッスン１</label>
                            {{-- レッスン１　Number --}}
                            <div class="">
                                <input id="lesson" type="text" class="new__input-area @error('lesson') is-invalid @enderror"
                                    name="lesson" value="{{ old('lesson') }}" autocomplete="lesson" autofocus placeholder="Number1">

                                @error('lesson')
                                <span class="" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            {{-- 　　レッスン1　title --}}
                            <div class="">
                                <input id="lesson" type="text" class="new__input-area @error('lesson') is-invalid @enderror"
                                    name="lesson" value="{{ old('lesson') }}" autocomplete="lesson" autofocus placeholder="title１">

                                @error('lesson')
                                <span class="" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            {{-- レッスン１ lesson --}}
                            <div class="">
                                <input id="lesson" type="text" class="new__input-area @error('lesson') is-invalid @enderror"
                                    name="lesson" value="{{ old('lesson') }}" autocomplete="lesson" autofocus placeholder="lesson１">

                                @error('lesson')
                                <span class="" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>




                        <div class="">
                            <label for="lesson" class="">レッスン２</label>

                            <div class="">
                                <input id="lesson" type="text" class="new__input-area @error('lesson') is-invalid @enderror"
                                    name="lesson" value="{{ old('lesson') }}" autocomplete="lesson" autofocus placeholder="レッスン２">

                                @error('lesson')
                                <span class="" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="">
                            <label for="lesson" class="">レッスン３</label>

                            <div class="">
                                <input id="lesson" type="text" class="new__input-area @error('lesson') is-invalid @enderror"
                                    name="lesson" value="{{ old('lesson') }}" autocomplete="lesson" autofocus placeholder="レッスン３">

                                @error('lesson')
                                <span class="" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        {{-- 価格 --}}
                        <div class="">
                            <label for="default_price" class="">価格</label>

                            <div class="">
                                <input id="default_price" type="text" class="new__input-area @error('default_price') is-invalid @enderror"
                                    name="default_price" value="{{ old('default_price') }}" autocomplete="default_price" autofocus>

                                @error('default_price')
                                <span class="" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        {{-- 画像 --}}
                        <div class="c-image__preview">
                            <p class="c-delete__file">消す</p>
                            <label class="c-area__drop">
                                <input class="c-input__file" type="file" name="pic1" >
                                <img src="" alt=""  class="c-prev__img">
                            ドラッグ＆ドロップ
                            </label>
                        </div>

                        {{-- @for ($i = 1; $i <= 10; $i++) <div class="form-group row">
                            <label for="problem0"
                                class="col-md-4 col-form-label text-md-right">{{ __('Problem').$i }}</label>

                        <div class="col-md-6">
                            <input id="problem{{$i - 1}}" type="text"
                                class="form-control @error('problem'.($i - 1)) is-invalid @enderror"
                                name="problem{{$i - 1}}" value="{{ old('title') }}" autocomplete="problem{{$i - 1}}"
                                autofocus>

                            @error('problem'.($i - 1))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                </div>
                @endfor --}}


                        <button type="submit" class="">
                            {{ __('Register') }}
                        </button>
                </form>
            </div>
        </section>
    </div>
</div>
</div>
@endsection