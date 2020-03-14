@extends('layouts.app')

@section('content')
<div class="c-searchBox">
    <div class="c-searchBox__inner">
        <form method="POST" action="{{ route('products') }}" enctype="multipart/form-data">
            @csrf

            {{-- 言語選択 --}}
            <div class="c-searchBox__categories">
                <p class="c-searchBox__title">1. 言語を選んでね</p>
                @foreach ($category as $categories)

                <input id="c-{{ $categories->id }}" type="checkbox"
                    class="c-searchBox__checkbox @error('lang') is-invalid @enderror" name="lang[]"
                    value="{{ $categories->id }}" autocompplete="lang" @if(!$categorieIds==null)
                    @if(in_array($categories->id,
                $categorieIds))checked @endif @endif>
                <label class="c-searchBox__label" for="c-{{ $categories->id }}">
                    {{ $categories->name }}
                </label>
                @endforeach
            </div>

            {{-- 難易度選択 --}}
            <div class="c-searchBox__difficults">
                <p class="c-searchBox__title">2. 難易度を選んでね</p>
                @foreach ($difficult as $difficults)
                <input id="d-{{ $difficults->id }}" type="checkbox"
                    class="c-searchBox__checkbox @error('difficult') is-invalid @enderror" name="difficult[]"
                    value="{{ $difficults->id }}" autocomplete="difficult" autofocus>
                <label class="c-searchBox__label" for="d-{{ $difficults->id }}">
                    {{ $difficults->name }}
                </label>
                @endforeach
            </div>

            {{-- 送信ボタン --}}
            <div class="c-searchBox__submit">
                <button type="submit" class="c-searchBox__button">
                    検索する
                </button>
            </div>
        </form>
    </div>
</div>
<div class="c-product__title">
    <h2>一覧 / 検索結果</h2>
</div>
<div class="c-pagination">
    {{ $products->appends(request()->input())->links('vendor.pagination.simple-default') }}
</div>
{{-- <div class="c-paging">{{ $pageNum_from }} - {{ $pageNum_to }} /<span
    class="c-paging__totalNum">{{ $products->count() }}</span></div> --}}
<div class="p-product__area">
    @foreach ($products as $product)
    <div class="c-product__block">

        <a class="c-product__link" href="{{ route('products.show', $product->id) }}">

            <div class="c-image__block">
                <img class="c-image" src="/storage/{{ $product->pic1 }}">
            </div>
            <div class="c-tag__block">

                {{-- 言語表示 --}}
                @foreach ($product_categories->find($product->id)->categories as $category)

                <div class="c-tag c-tag--category {{ $category->class_name }}">{{ $category->name }}</div>
                @endforeach

                {{-- 難易度表示 --}}
                @foreach ($product_difficulties->find($product->id)->difficulties as $difficulty)

                <div class="c-tag c-tag--difficulty {{ $difficulty->class_name }}">{{ $difficulty->name }}</div>

                @endforeach
            </div>
            <div class="c-contents__block">

                <div class="c-contents__title">{{ $product->name }}</div>
                <div class="c-contents__price">¥ {{ number_format($product->default_price) }}</div>
                <div class="c-contents__detail">{{ $product->detail }}</div>

            </div>
        </a>
    </div>
    @endforeach
</div>

<div class="c-pagination">
    {{ $products->links('vendor.pagination.simple-default') }}
</div>
@endsection