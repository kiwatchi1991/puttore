@extends('layouts.app')

@section('content')
<section class="l-product">
        <div class="l-product__wrapper">

                    <form id="form" method="POST" action="{{ route('products.create') }}" enctype="multipart/form-data" >
                        @csrf
                        {{-- 名前 --}}
                            {{-- <label for="name" class="">名前</label> --}}

                            <div class="">
                                <input id="name" type="text" class="c-product__input-area @error('name') is-invalid @enderror"
                                    name="name" value="{{ old('name') }}" autocomplete="name" placeholder="教材のタイトル（例：Twitter風アプリを作ろう）" >

                                @error('name')
                                <span class="" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        {{-- 言語選択 --}}
                        <div class="p-input__tag">
                                <ul class="p-tags">
                                    {{-- <p>1.言語を選んでね</p> --}}
                                    <li for="lang" class="c-tag__list">
                                        <div class="c-tag__title">言語</div>
                                        <ul class="c-tag__lists">
                                            @foreach ($category as $categories)
                                            <li>
                                                <label for="lang{{ $categories->id }}" class="c-tag__label">
                                                    <input id="lang{{ $categories->id }}" type="checkbox" class="c-tag__checkbox @error('lang') is-invalid @enderror"
                                                    name="lang[]" value="{{ $categories->id }}" autocomplete="lang">{{ $categories->name }}
                                                </label>
                                            </li> 
                                                @endforeach
                                        </ul>
                                     </li>
                                    {{-- <p>２.難易度を選んでね</p> --}}
                                    <li for="lang" class="c-tag__list">
                                        <div class="c-tag__title">難易度</div>
                                        <ul class="c-tag__lists">
                                            @foreach ($difficult as $difficults)
                                            <li>
                                                <label for="difficult{{ $difficults->id }}" class="c-tag__label">
                                                    <input id="difficult{{ $difficults->id }}" type="checkbox" class="c-tag__checkbox @error('difficult') is-invalid @enderror"
                                                    name="difficult[]" value="{{ $difficults->id }}" autocomplete="difficult" >{{ $difficults->name }}
                                                </label>
                                            </li> 
                                            
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

                        {{-- 説明 --}}
                            <div class="p-input__detail">
                                <input id="detail" type="text"
                                    class="c-product__input-area @error('detail') is-invalid @enderror" name="detail"
                                    value="{{ old('detail') }}" autocomplete="detail" placeholder="説明（無料で見れる部分）">

                                @error('detail')
                                <span class="" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                        {{-- レッスン内容 --}}
                                        
                        <div class="p-lesson" id="js-lesson__section">
                            <div class="c-lesson__block js-add__target">
                                {{-- レッスン１　Number --}}
                                <div class="">
                                    <div class="c-lesson__number">レッスン<input id="number" type="number" class="c-product__input-area--number @error('number') is-invalid @enderror"
                                       data-input="number" name="" value="" autocomplete="number" placeholder="Number1"></div>

                                    @error('number')
                                    <span class="" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                {{-- 　　レッスン1　title --}}
                                <div class="">
                                    <input id="title" type="text" class="c-product__input-area @error('title') is-invalid @enderror"
                                    data-input="title" name="" value="{{ old('title') }}" autocomplete="title" placeholder="レッスンのタイトル" placeholder="title１">

                                    @error('title')
                                    <span class="" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
       
                                {{-- レッスン１ lesson --}}
                                <div class="p-lesson__lesson">
                                    
                                    <div class="c-lesson__header">
                                        <div class="js-toggleTab js-toggleTab__input active" data-status="input">本文</div>
                                        <div class="js-toggleTab js-toggleTab__preview" data-status="preview">ぷれびゅー</div>
                                        <div class="js-insertImg" data-status="preview">
                                            <form method="POST" action="{{ route('products.imgupload') }}" enctype="multipart/form-data">
                                                @csrf
                                                <input class="js-uploadimg" type="file" name="lesson_pic">
                                            </form>
                                            画像を挿入
                                        </div>
                                    </div>
                                    
                                    <div class="c-lesson__lesson js-lesson__block js-lesson__block--input active">
                                        <textarea id="lesson" type="text" class="c-product__input-area c-product__input-area--textarea @error('lesson') is-invalid @enderror"
                                        data-input="lessson" name="" value="{{ old('lesson') }}" autocomplete="lesson"  placeholder="lesson１"　
                                        >{{ old('lesson') }}
                                        </textarea>

                                    </div>
                                    <div id="preview" class="c-product__input-area c-lesson__lesson c-lesson__lesson--preview js-lesson__block js-lesson__block--preview ">
                                    </div>
                                    
                                    @error('lesson')
                                    <span class="" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                             
                            </div>
                          </div>
                        <div>
                            <button class="c-addLesson__button"><i class="fas fa-plus-circle"></i>追加する</button>
                        </div>

                        {{-- 価格 --}}
                        <div class="">
                            <div class="">
                                <input id="default_price" type="text" class="c-product__input-area c-product__input-area--price @error('default_price') is-invalid @enderror"
                                    name="default_price" value="{{ old('default_price') }}" autocomplete="default_price" placeholder="価格">

                                @error('default_price')
                                <span class="" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        {{-- 画像 --}}
                        <div class="c-image__preview">
                            <ul>
                                <li>
                                    <p class="c-delete__file">消す</p>
                                    <label class="js-area__drop">
                                        <input class="c-input__file" type="file" name="pic1" >
                                        <img src="" alt=""  class="c-prev__img">
                                        ドラッグ＆ドロップ
                                    </label>
                                </li>
                                <li>
                                    <p class="c-delete__file">消す</p>
                                    <label class="js-area__drop">
                                        <input class="c-input__file" type="file" name="pic2" >
                                        <img src="" alt=""  class="c-prev__img">
                                        ドラッグ＆ドロップ
                                    </label>
                                </li>
                                <li>
                                    <p class="c-delete__file">消す</p>
                                    <label class="js-area__drop">
                                        <input class="c-input__file" type="file" name="pic3" >
                                        <img src="" alt=""  class="c-prev__img">
                                        ドラッグ＆ドロップ
                                    </label>
                                </li>
                                <li>
                                    <p class="c-delete__file">消す</p>
                                    <label class="js-area__drop">
                                        <input class="c-input__file" type="file" name="pic4" >
                                        <img src="" alt=""  class="c-prev__img">
                                        ドラッグ＆ドロップ
                                    </label>
                                </li>
                                <li>
                                    <p class="c-delete__file">消す</p>
                                    <label class="js-area__drop">
                                        <input class="c-input__file" type="file" name="pic5" >
                                        <img src="" alt=""  class="c-prev__img">
                                        ドラッグ＆ドロップ
                                    </label>
                                </li>
                            </ul>
                        </div>
                        <div class="c-submit__button">
                            <button type="submit" class="button">
                                {{ __('Register') }}
                            </button>
                        </div>
                </form>
            </div>
    </section>
<link rel="stylesheet"
      href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.18.1/styles/default.min.css">
<script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.18.1/highlight.min.js"></script>
<script>hljs.initHighlightingOnLoad();</script>
<script src="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.js"></script>

@endsection