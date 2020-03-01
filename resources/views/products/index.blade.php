@extends('layouts.app')

@section('content')
<h2 class="c-pageTitle">作品一覧ページ</h2>
<div>

</div>
{{-- @if (session('flash_message'))
<div class="alert alert-success">
    {{ session('flash_message') }}
</div>
@endif --}}
<div class="c-searchBox">
    <div class="c-searchBox__inner">
        <form method="POST" action="{{ route('products') }}" enctype="multipart/form-data" >
            @csrf

            {{-- 言語選択 --}}
            <div class="c-searchBox__categories">
                <p>1. 言語を選んでね</p>
                @foreach ($category as $categories)
                <input id="lang" type="checkbox" class="new__input-area @error('lang') is-invalid @enderror"
                name="lang[]" value="{{ $categories->id }}" autocomplete="lang" autofocus>{{ $categories->name }}
                @endforeach
            </div>

            {{-- 難易度選択 --}}
            <div class="c-searchBox__difficults">
                <p>2. 難易度を選んでね</p>
            @foreach ($difficult as $difficults)
                <input id="difficult" type="checkbox" class="new__input-area @error('difficult') is-invalid @enderror"
                name="difficult[]" value="{{ $difficults->id }}" autocomplete="difficult" autofocus>{{ $difficults->name }}
                @endforeach
            </div>

            {{-- 送信ボタン --}}
            <div class="c-searchBox__submit">
                <button type="submit" class="">
                    検索する
                </button>
            </div>
            </form>
    </div>
</div>
    
    <div class="c-pageNum"> 全 <span class="c-totalNum">{{ $products->count() }}</span> 件中 {{ $pageNum_from }} 〜 {{ $pageNum_to }} 件</div>
    <div class="p-product__area">
        @foreach ($products as $product)
        <div class="p-product__block">
            
            <a class="c-product__link" href="{{ route('products.show', $product->id) }}">
                {{-- プロダクトID {{ $product->id }} --}}
               
                        {{-- <h3 class="">{{ $product->name }}</h3> --}}
                        {{-- <a href="#" class="btn btn-primary">{{ __('Go Practice')  }}</a> --}}
                        {{-- <a href="{{ route('products.edit',$product->id ) }}" --}}
                            {{-- class="">{{ __('Go Practice')  }}</a> --}}
                        <div class="c-image__block">
                            {{-- 画像     --}}
                            {{-- @if ($is_image) --}}
                                <img class="c-image" src="/storage/{{ $product->pic1 }}">
                            {{-- @endif --}}
                        </div>
                        <div class="c-tag__block">
                            
                            {{-- 言語表示 --}}
                            @foreach ($product_categories->find($product->id)->categories as $category)
            
                            <div class="c-tag c-tag--category">{{ $category->name }}</div>
                            @endforeach 
                            
                            {{-- 難易度表示 --}}
                            @foreach ($product_difficulties->find($product->id)->difficulties as $difficulty)
                            
                            <div class="c-tag c-tag--difficulty">{{ $difficulty->name }}</div>
            
                            @endforeach
                        </div>
                        <div class="c-contents__block"> 
            
                            <div class="c-contents__title">{{ $product->name }}</div>
                            <div class="c-contents__detail">{{ $product->detail }}</div>
                            {{-- <div class="c-contents__price">¥ {{ $product->default_price }}</div> --}}
                            <div class="c-contents__price">¥ {{ number_format($product->default_price) }}</div>

                            
                            {{-- <form action="{{ route('products.delete',$product->id ) }}" method="post" class="">
                                @csrf
                                <button class=""
                                onclick='return confirm("削除しますか？");'>{{ __('Go Delete')  }}</button>
                            </form> --}}
                        </div>
                    </a>
                    <div class="c-ajaxLike__icon" data-like="{{ $product->id }}">お気に入り</div>
                    <i class="fas fa-heart"></i>
                    {{-- farにする --}}
        </div>
        </div>
        @endforeach
        <div class="c-pagination">
            {{ $products->links() }}
        </div>
</div>
@endsection