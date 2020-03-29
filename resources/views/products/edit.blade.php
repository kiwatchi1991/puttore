@extends('layouts.app')
@section('title','作品編集')
@section('content')

{{-- モーダルウインドウ --}}
<div class="modal js-modal">
    <div class="modal__bg js-modal-close"></div>
    <div class="modal__contents">
        <div class="modal__head__fixed">
            <div class="modal__title">
                Markdown記法のヒント
            </div>
            <a class="js-modal-close" href="">閉じる</a>
        </div>
        <div class="modal__contents__inner">

            <div class="modal__content__header">
                見出し
            </div>
            <div class="modal__content">
                # 見出し1<br>## 見出し2<br>### 見出し3
            </div>
            <div class="modal__content__header">
                コード
            </div>
            <div class="modal__content">
                ```hmtl
                コード
                ```
            </div>
            <div class="modal__content__header">
                リンク
            </div>
            <div class="modal__content">
                [リンク](http://...)
            </div>
            <div class="modal__content__header">
                強調
            </div>
            <div class="modal__content">
                **強調**<br>**強調**
            </div>
            <div class="modal__content__header">
                リスト
            </div>
            <div class="modal__content">
                - リスト 1<br>- リスト 2<br> - リスト 2-1
            </div>

            <div class="modal__content">
                1. 番号付きリスト 1<br>2. 番号付きリスト 2<br>3. 番号付きリスト 3
            </div>
        </div>
    </div>
</div>

<div class="c-productEdit">

    <form id="form-product" method="POST" action="{{ route('products.update',$product->id) }}"
        enctype="multipart/form-data">
        @csrf
        <div class="c-productNew__wrapper">
            {{-- 名前 --}}
            <div class="">
                <p class="c-productNew__title__label">タイトル<span class="required">必須</span></p>
                <input id="name" type="text" class="c-productEdit__input-area @error('name') is-invalid @enderror"
                    name="name" value="{{ $product->name }}" autocomplete="name"
                    placeholder="教材のタイトル（例：Twitter風アプリを作ろう）" required>

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
                        value="{{ $categories->id }}" autocomplete="lang" @if(in_array($categories->id, old('lang',
                    $product->categories->pluck('id')->toArray()))) checked @endif required>
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
                        ) checked @endif required>
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
                <p class="c-productNew__title__label">説明文<span class="required">必須</span></p>
                <textarea id="detail" type="text"
                    class="c-productEdit__input-area c-productEdit__input-area--detail @error('detail') is-invalid @enderror"
                    data-input="detail" name="detail" value="{{ old('detail') }}" rows="7"
                    required>{{ $product->detail }}</textarea>

                @error('detail')
                <span class="" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        {{-- レッスン内容 --}}
        <p class="c-productNew__lessons__head">LESSON登録</p>
        <div class="c-productNew__modal">
            マークダウン記法のヒントは<a href="" class="js-modal-open c-productNew__modal__link">こちら</a>

        </div>
        <div class="c-productNew__lessons" id="js-lesson__section">
            @foreach( $lessons as $lesson )
            <div class="c-productNew__lesson__inner js-add__target">
                {{-- ↓↓　PC用wrapperここから --}}
                <div class="c-productNew__lesson__pcWrapper">
                    <input id="hidden" type="hidden" name="" value="{{ $lesson->id }}">
                    {{-- レッスン　Number --}}
                    <div class="c-productNew__topWrapper">
                        <div class="c-productNew__number">LESSON <span id="lesson_num">{{ $lesson->number }}</span><span
                                class="required">必須</span>
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
                        <input id="title" type="text"
                            class="c-productNew__input-area @error('title') is-invalid @enderror" data-input="title"
                            name="" value="{{ $lesson->title }}" autocomplete="title" placeholder="レッスンのタイトル"
                            placeholder="title１">
                    </div>
                </div>
                {{-- ↑↑　PC用wrapperここまで --}}
                {{-- レッスン lesson --}}
                <div class="c-productNew__lesson__block js-productNew__lesson">
                    {{--↓↓　PC用wrapperここから --}}
                    <div class="c-productNew__lesson__pcWrapper">
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

                                <label for="uploadimg" class="c-productNew__header__label js-imgInputlabel">
                                    <i class="far fa-image"></i>
                                    <input id="uploadimg" class="c-productNew__lesson__header__input js-lessonUploadImg"
                                        type="file" name="lesson_pic">
                                </label>

                            </div>
                        </div>

                        <div
                            class="c-productNew__lesson c-productNew__lesson--input js-lesson__block js-lesson__block--input active">
                            <textarea type="text" id="lesson"
                                class="c-productNew__lesson--textarea js-marked__textarea @error('lesson') is-invalid @enderror"
                                data-input="lessson" name="" value="{{ old('lesson') }}" autocomplete="lesson"
                                placeholder="lessonの内容" required>{{ $lesson->lesson }}</textarea>
                        </div>
                    </div>

                    <div id="preview"
                        class="c-productNew__lesson c-productNew__lesson--preview js-lesson__block js-lesson__block--preview js-edit-preview">
                    </div>
                </div>

            </div>
            @endforeach
        </div>
        @error('lessons.*.title')
        <span class="" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
        @error('lessons.*.lesson')
        <span class="" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
        {{-- レッスン追加ボタン --}}
        <div class="c-productNew__lesson__addBtn js-addLesson__button">
            <button class="c-productNew__lesson__addBtn__btn"><i class="fas fa-plus-circle"></i>
                LESSONを追加する</button>
        </div>
        <div class="c-productNew__wrapper">
            {{-- 価格 --}}
            <div class="c-productEdit__price">
                <p class="c-productNew__title__label">価格<span class="required">必須</span></p>
                <div class="c-productNew__price--wrap">
                    <div class="c-productNew__price--icon">¥</div>
                    <input id="default_price" type="tel"
                        class="c-productNew__input-area c-productNew__input-area--price @error('default_price') is-invalid @enderror"
                        name="default_price" value="{{ $product->default_price }}" autocomplete="default_price"
                        placeholder="価格" required>

                    @error('default_price')
                    <span class="" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            {{-- 割引価格 --}}
            <div class="c-productEdit__discount-price">
                <p class="c-productNew__title__label c-productNew__title__label--discount">割引価格<span
                        class="options">任意</span></p>
                <div class="c-productNew__price--wrap">
                    <div class="c-productNew__price--icon">¥</div>
                    <input id="discount_price"
                        class="c-productNew__input-area c-productNew__input-area--discount @error('discount_price') is-invalid @enderror"
                        name="discount_price" value="@if($discount_price) {{ $discount_price->discount_price }} @endif"
                        autocomplete="discount_price">
                </div>
                <div class="c-productNew__price--wrap date">
                    <div class="c-productEdit__discount-price__date">
                        <span class="c-productEdit__discount-price__label">開始日</span><input type="text"
                            name="start_date"
                            class="c-productNew__input-area c-productNew__input-area--discount js-date_picker @error('sale_price') is-invalid @enderror"
                            value="@if($discount_price){{ $discount_price->start_date }} @endif">
                    </div>
                    <div class="c-productEdit__discount-price__date">
                        <span class="c-productEdit__discount-price__label">終了日</span><input type="text" name="end_date"
                            class="c-productNew__input-area c-productNew__input-area--discount js-date_picker @error('sale_price') is-invalid @enderror"
                            value="@if($discount_price){{ $discount_price->end_date }} @endif">
                    </div>
                </div>
                @error('sale_price')
                <span class="" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            {{-- 必要スキル --}}
            <div class="c-productNew__skills">
                <p class="c-productNew__skills__title">受講に必要なスキル<span class="required">必須</span></p>
                <textarea id="skills" type="text"
                    class="c-productNew__input-area c-productNew__input-area--skills @error('skills') is-invalid @enderror"
                    data-input="skills" name="skills" value="" rows="7" required>{{ $product->skills }}</textarea>
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
                    <label class="c-productNew__image__area area1 js-area__drop">
                        <input class="c-productNew__image__input js-input__file--product" type="file" name="pic1">
                        <img src="/storage/{{ $product->pic1 }}" alt="" class="c-productNew__image__img js-prev__img">
                    </label>
                    {{-- 画像2 --}}
                    <label class="c-productNew__image__area area2 js-area__drop">
                        <input class="c-productNew__image__input js-input__file--product" type="file" name="pic2">
                        <img src="/storage/{{ $product->pic2 }}" alt="" class="c-productNew__image__img js-prev__img">
                    </label>
                    {{-- 画像3 --}}
                    <label class="c-productNew__image__area area3 js-area__drop">
                        <input class="c-productNew__image__input js-input__file--product" type="file" name="pic3">
                        <img src="/storage/{{ $product->pic3}}" alt="" class="c-productNew__image__img js-prev__img">
                    </label>
                </div>
                @error('pic1')
                <span class="c-productNew__error" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                @error('pic2')
                <span class="c-productNew__error" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                @error('pic3')
                <span class="c-productNew__error" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                <div class="c-productNew__images__half">
                    {{-- 画像4 --}}
                    <label class="c-productNew__image__area area4 js-area__drop">
                        <input class="c-productNew__image__input js-input__file--product" type="file" name="pic4">
                        <img src="/storage/{{ $product->pic4 }}" alt="" class="c-productNew__image__img js-prev__img">
                    </label>
                    {{--画像5 --}}
                    <label class="c-productNew__image__area area5 js-area__drop">
                        <input class="c-productNew__image__input js-input__file--product" type="file" name="pic5">
                        <img src="/storage/{{ $product->pic5 }}" alt="" class="c-productNew__image__img js-prev__img">
                    </label>
                    {{--画像6 --}}
                    <label class="c-productNew__image__area area6 js-area__drop">
                        <input class="c-productNew__image__input js-input__file--product" type="file" name="pic6">
                        <img src="/storage/{{ $product->pic6 }}" alt="" class="c-productNew__image__img js-prev__img">
                    </label>
                </div>
            </div>
            @error('pic4')
            <span class="c-productNew__error" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
            @error('pic5')
            <span class="c-productNew__error" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
            @error('pic6')
            <span class="c-productNew__error" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror

            <div class="js-postType__parentDom">
                <input type="hidden" name="postType" class="js-postType" value="">
                <div class="c-productNew__submit c-productNew__submit--draft" data-type="draft">
                    <button type="submit" class="c-productNew__submit__button c-productNew__submit__button--draft"
                        name="postType" value="draft">
                        下書き保存する
                    </button>
                </div>
                <div class="c-productNew__submit" data-type="register" name="postType" value="register">
                    <button type="submit" class="c-productNew__submit__button">
                        登録する
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
<script>
    //     window.onbeforeunload = function(e){
// return "このページを離れますか？"; // Google Chrome以外
// e.returnValue = "このページを離れますか？"; // Google Chrome
// }

// $('form').on('submit', function(e){
// e.preventDefault();
// window.onbeforeunload = null; // 関数を削除
// var $this = $(this);
// $this.submit();
// });
</script>
@endsection