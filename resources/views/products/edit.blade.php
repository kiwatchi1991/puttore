@extends('layouts.app')
@section('title','作品編集')
@section('content')
<div class="c-productEdit">

    <form id="form" method="POST" action="{{ route('products.update',$product->id) }}" enctype="multipart/form-data">
        @csrf
        {{-- 名前 --}}
        <div class="">
            <p class="c-productNew__title__label">タイトル</p>
            <input id="name" type="text" class="c-productEdit__input-area @error('name') is-invalid @enderror"
                name="name" value="{{ $product->name }}" autocomplete="name" placeholder="教材のタイトル（例：Twitter風アプリを作ろう）">

            @error('name')
            <span class="" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <p class="c-productNew__title__label c-productNew__title__label--tags">言語・難易度選択</p>
        <div class="c-productEdit__tagbox">

            {{-- 言語選択 --}}
            <div class="c-productEdit__categories">
                <p class="c-productEdit__title">1. 言語を選んでね</p>

                @foreach ($category as $categories)
                <input id="c-{{ $categories->id }}" type="checkbox"
                    class="c-productEdit__checkbox @error('lang') is-invalid @enderror" name="lang[]"
                    value="{{ $categories->id }}" autocomplete="lang" @if( // $product->categories->contains(function
                // ($category1) use ($categories) {
                // return $category1->id === $categories->id;
                // })
                in_array($categories->id, old('lang', $product->categories->pluck('id')->toArray()))

                ) checked @endif>
                <label class="c-productEdit__label" for="c-{{ $categories->id }}">
                    {{ $categories->name }}
                </label>
                @endforeach

                {{-- 難易度選択 --}}
                <div class="c-productEdit__difficults">
                    <p class="c-productEdit__title">2. 難易度を選んでね</p>
                    @foreach ($difficult as $difficults)
                    <input id="d-{{ $difficults->id }}" type="checkbox"
                        class="c-productEdit__checkbox @error('difficult') is-invalid @enderror" name="difficult[]"
                        value="{{ $difficults->id }}" autocomplete="difficult" @if(
                        $product->difficulties->contains(function ($difficult1) use ($difficults) {
                    return $difficult1->id === $difficults->id;
                    })
                    ) checked @endif>
                    <label class="c-productEdit__label" for="d-{{ $difficults->id }}">
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
        {{-- 説明 --}}
        <div class="c-productEdit__detail">
            <p class="c-productNew__title__label">説明文</p>
            <textarea id="detail" type="text"
                class="c-productEdit__input-area c-productEdit__input-area--detail @error('detail') is-invalid @enderror"
                data-input="detail" name="detail" value="{{ old('detail') }}" rows="7">{{ $product->detail }}
                    </textarea>
            <div class="c-productEdit__modal">
                書き方のヒントは<span>こちら</span>
            </div>
            @error('detail')
            <span class="" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        {{-- レッスン --}}
        <div id="c-productNew__lessons">
            @foreach( $lessons as $lesson )
            <div class="c-productNew__lesson__inner js-add__target">
                <input id="hidden" type="hidden" name="" value="{{ $lesson->id }}">
                {{-- レッスン　Number --}}
                <div class="c-productNew__topWrapper">
                    <div class="c-productNew__number">LESSON <span id="lesson_num">{{ $lesson->number }}</span>
                        <input id="number" type="hidden"
                            class="c-productNew__input-area--number @error('number') is-invalid @enderror"
                            data-input="number" name="" value="" autocomplete="number" placeholder="Number1"></div>
                    <div class="c-productNew__deleteLesson js-deleteIcon"><i class="far fa-trash-alt"></i></div>

                    @error('number')
                    <span class="" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                {{-- 　　レッスン　title --}}
                <div class="">
                    {{-- <input id="title" type="text" class="new__input-area @error('title') is-invalid @enderror" name=""
                        value="{{ $lesson->title }}" autocomplete="title" autofocus placeholder="title１"> --}}

                    <input id="title" type="text" class="c-productNew__input-area @error('title') is-invalid @enderror"
                        data-input="title" name="" value="{{ $lesson->title }}" autocomplete="title"
                        placeholder="レッスンのタイトル" placeholder="title１">

                    @error('title')
                    <span class="" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                {{-- レッスン lesson --}}
                <div class="c-productNew__lesson__block js-productNew__lesson">

                    <div class="c-productNew__lesson__header">
                        <p class="c-productNew__lesson__header__title">本文</p>
                        {{-- 編集アイコン --}}
                        <div class="c-productNew__lesson__header__toggleIcon js-toggleTab js-toggleTab__input"
                            data-status="input">
                            <i class="far fa-edit"></i>
                        </div>
                        {{-- プレビューアイコン --}}
                        <div class="c-productNew__lesson__header__toggleIcon js-toggleTab js-toggleTab__preview active"
                            data-status="preview">
                            <i class="far fa-eye"></i>
                        </div>
                        {{-- 画像アイコン --}}
                        <div class="c-productNew__lesson__header__imgIcon js-insertImg" data-status="preview">

                            <label for="uploadimg" class="c-productNew__header__label">
                                <i class="far fa-image"></i>
                                <input id="uploadimg" class="c-productNew__lesson__header__input js-uploadimg"
                                    type="file" name="lesson_pic">
                            </label>

                        </div>
                    </div>

                    <div
                        class="c-productNew__lesson c-productNew__lesson--input js-lesson__block js-lesson__block--input active">
                        <textarea type="text" id="lesson"
                            class="c-productNew__lesson--textarea js-marked__textarea @error('lesson') is-invalid @enderror"
                            data-input="lessson" name="" value="{{ old('lesson') }}" autocomplete="lesson"
                            placeholder="lesson１" 　>{{ $lesson->lesson }}
                                            </textarea>
                    </div>

                    <div id="preview"
                        class="c-productNew__lesson c-productNew__lesson--preview js-lesson__block js-lesson__block--preview ">
                    </div>

                    {{-- <textarea id="lesson" type="text" class="new__input-area @error('lesson') is-invalid @enderror"
                        name="" value="{{ $lesson->lesson }}" autocomplete="lesson" autofocus
                    placeholder="lesson１">{{ $lesson->lesson }}
                    </textarea>
                    <div id="preview">ぷれびゅー</div> --}}

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
        <div class="c-productNew__lesson__addBtn">
            <button class="c-productNew__lesson__addBtn__btn"><i class="fas fa-plus-circle"></i> LESSONを追加する</button>
        </div>

        {{-- 価格 --}}
        <div class="">
            <p class="c-productNew__title__label">価格</p>
            <input id="default_price" type="text"
                class="c-productNew__input-area c-productNew__input-area--price @error('default_price') is-invalid @enderror"
                name="default_price" value="{{ $product->default_price }}" autocomplete="default_price"
                placeholder="価格">

            {{-- <input id="default_price" type="text" class="new__input-area @error('default_price') is-invalid @enderror"
                name="default_price" value="{{ $product->default_price }}" autocomplete="default_price" autofocus> --}}

            @error('default_price')
            <span class="" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        {{-- 割引価格 --}}
        <div class="">
            <p class="c-productNew__title__label">割引価格</p>
            <div class="">


                <input id="discount_price" class="new__input-area @error('discount_price') is-invalid @enderror"
                    name="discount_price" value="@if($discount_price) {{ $discount_price->discount_price }} @endif"
                    autocomplete="discount_price">

                {{-- @error('discount_price')
        <span class="" role="alert">
            <strong>{{ $message }}</strong>
                </span>
                @enderror --}}

            </div>
            <div class="">
                開始日<input type="text" name="start_date"
                    class="new__input-area js-date_picker @error('sale_price') is-invalid @enderror"
                    value="@if($discount_price){{ $discount_price->start_date }} @endif">
            </div>
            <div>
                終了日<input type="text" name="end_date"
                    class="new__input-area js-date_picker @error('sale_price') is-invalid @enderror"
                    value="@if($discount_price){{ $discount_price->end_date }} @endif">
            </div>
        </div>

        {{-- 必要スキル --}}
        <div class="c-productNew__skills">
            <p class="c-productNew__skills__title">受講に必要なスキル</p>
            <textarea id="skills" type="text"
                class="c-productNew__input-area c-productNew__input-area--skills @error('skills') is-invalid @enderror"
                data-input="skills" name="skills" value="" rows="7">{{ $product->skills }}
</textarea>
            @error('skills')
            <span class="" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        {{-- 画像 --}}
        <div class="c-productNew__images">
            <div class="c-productNew__images__half">
                {{-- 画像1 --}}
                <label class="c-productNew__image__area js-area__drop">
                    <input class="c-productNew__image__input js-input__file--product" type="file" name="pic1">
                    <img src="/storage/{{ $product->pic1 }}" alt="" class="c-productNew__image__img js-prev__img">
                </label>
                {{-- 画像2 --}}
                <label class="c-productNew__image__area js-area__drop">
                    <input class="c-productNew__image__input js-input__file--product" type="file" name="pic2">
                    <img src="/storage/{{ $product->pic2 }}" alt="" class="c-productNew__image__img js-prev__img">
                </label>
                {{-- 画像3 --}}
                <label class="c-productNew__image__area js-area__drop">
                    <input class="c-productNew__image__input js-input__file--product" type="file" name="pic3">
                    <img src="/storage/{{ $product->pic3}}" alt="" class="c-productNew__image__img js-prev__img">
                </label>
            </div>

            <div class="c-productNew__images__half">
                {{-- 画像4 --}}
                <label class="c-productNew__image__area js-area__drop">
                    <input class="c-productNew__image__input js-input__file--product" type="file" name="pic4">
                    <img src="/storage/{{ $product->pic4 }}" alt="" class="c-productNew__image__img js-prev__img">
                </label>
                {{--画像5 --}}
                <label class="c-productNew__image__area js-area__drop">
                    <input class="c-productNew__image__input js-input__file--product" type="file" name="pic5">
                    <img src="/storage/{{ $product->pic5 }}" alt="" class="c-productNew__image__img js-prev__img">
                </label>
                {{--画像6 --}}
                <label class="c-productNew__image__area js-area__drop">
                    <input class="c-productNew__image__input js-input__file--product" type="file" name="pic6">
                    <img src="/storage/{{ $product->pic6 }}" alt="" class="c-productNew__image__img js-prev__img">
                </label>
            </div>
        </div>


        <div class="js-postType__parentDom">
            <input type="hidden" name="postType" class="js-postType" value="">
            <div class="c-productNew__submit c-productNew__submit--draft js-isCheck-postType" data-type="draft">
                <button type="submit" class="c-productNew__submit__button c-productNew__submit__button--draft">
                    下書き保存する
                </button>
            </div>
            <div class="c-productNew__submit js-isCheck-postType" data-type="register">
                <button type="submit" class="c-productNew__submit__button">
                    登録する
                </button>
            </div>
        </div>
    </form>
</div>
@endsection