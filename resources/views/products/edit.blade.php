@extends('layouts.app')

@section('content')
<div class="c-productNew">
        <div class="">レッスン内容登録</div>

            <form method="POST" action="{{ route('products.update',$product->id) }}" enctype="multipart/form-data" >
                @csrf
                {{-- 名前 --}}
                <div class="">
                    <input id="name" type="text" class="c-productNew__input-area @error('name') is-invalid @enderror"
                        name="name" value="{{ old('name') }}" autocomplete="name" placeholder="教材のタイトル（例：Twitter風アプリを作ろう）">

                    @error('name')
                    <span class="" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                 </div>

          <div class="c-productNew__tagbox">

                {{-- 言語選択 --}}
                <div class="c-productNew__categories">
                <p class="c-productNew__title">1. 言語を選んでね</p>

                @foreach ($category as $categories)
                <input id="c-{{ $categories->id }}" type="checkbox"
                    class="c-productNew__checkbox @error('lang') is-invalid @enderror" name="lang[]"
                    value="{{ $categories->id }}" autocomplete="lang"
                    @if(
                    $product->categories->contains(function ($category1) use ($categories) {
                        return $category1->id === $categories->id;
                    })
                    ) checked @endif>
                <label class="c-productNew__label" for="c-{{ $categories->id }}">
                    {{ $categories->name }}
                </label>
                @endforeach

                {{-- 難易度選択 --}}
            <div class="c-productNew__difficults">
                <p class="c-productNew__title">2. 難易度を選んでね</p>
                @foreach ($difficult as $difficults)
                <input id="d-{{ $difficults->id }}" type="checkbox"
                    class="c-productNew__checkbox @error('difficult') is-invalid @enderror" name="difficult[]"
                    value="{{ $difficults->id }}" autocomplete="difficult"
                    @if(
                    $product->difficulties->contains(function ($difficult1) use ($difficults) {
                        return $difficult1->id === $difficults->id;
                    })
                    ) checked @endif>
                <label class="c-productNew__label" for="d-{{ $difficults->id }}">
                    {{ $difficults->name }}
                </label>
                @endforeach
            </div>

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
                            value="{{ $product->detail }}" autocomplete="detail" autofocus>

                        @error('detail')
                        <span class="" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                {{-- レッスン --}}
                <div id="c-lesson__section">
                    @foreach( $lessons as $lesson )
                        <div class="c-lesson__block js-add__target">
                            <label for="lesson" class="">レッスン１</label>
                             <input id="hidden" type="hidden" name="" value="{{ $lesson->id }}">
                            {{-- レッスン　Number --}}
                            <div class="">
                                <input id="number" type="number" class="new__input-area @error('number') is-invalid @enderror"
                            data-input="target" name="" value="{{ $lesson->number }}" autocomplete="number" autofocus placeholder="Number1">

                                @error('number')
                                <span class="" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            {{-- 　　レッスン　title --}}
                            <div class="">
                                <input id="title" type="text" class="new__input-area @error('title') is-invalid @enderror"
                                    name="" value="{{ $lesson->title }}" autocomplete="title" autofocus placeholder="title１">

                                @error('title')
                                <span class="" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            {{-- レッスン lesson --}}
                            <div>
                                <textarea id="lesson" type="text" class="new__input-area @error('lesson') is-invalid @enderror"
                                    name="" value="{{ $lesson->lesson }}" autocomplete="lesson" autofocus placeholder="lesson１">{{ $lesson->lesson }}
                                </textarea>
                                <div id="preview">ぷれびゅー</div>

                                @error('lesson')
                                <span class="" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                        </div>
                        @endforeach
                    </div>

                {{-- レッスン追加ボタン --}}
                <div>
                    <button class="c-addLesson__button">追加する</button>
                </div>

                {{-- 価格 --}}
                <div class="">
                    <label for="default_price" class="">価格</label>

                    <div class="">
                        <input id="default_price" type="text" class="new__input-area @error('default_price') is-invalid @enderror"
                            name="default_price" value="{{ $product->default_price }}" autocomplete="default_price" autofocus>

                        @error('default_price')
                        <span class="" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                {{-- 割引価格 --}}
                <div class="">
                    <label for="default_price" class="">割引価格</label>
                    <div class="">


                        <input id="discount_price"  class="new__input-area @error('discount_price') is-invalid @enderror"
                        name="discount_price" value="@if($discount_price) {{ $discount_price->discount_price }} @endif" autocomplete="discount_price" >

                        {{-- @error('discount_price')
                          <span class="" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                          @enderror --}}

                      </div>
                    <div class="">
                        <input type="text" name="start_date" class="new__input-area js-date_picker @error('sale_price') is-invalid @enderror"
                          value="@if($discount_price){{ $discount_price->start_date }} @endif">開始日
                    </div>
                    <div>
                        <input type="text" name="end_date" class="new__input-area js-date_picker @error('sale_price') is-invalid @enderror"
                          value="@if($discount_price){{ $discount_price->end_date }} @endif">終了日
                    </div>
                </div>

                {{-- 画像 --}}
                <div class="c-image__preview">
                    <p class="js-delete__file">消す</p>
                    <label class="js-area__drop">
                        <input class="js-input__file" type="file" name="pic1" >
                        <img src="/storage/{{ $product->pic1 }}" alt=""  class="c-prev__img js-prev__img">
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
@endsection
