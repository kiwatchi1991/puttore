@extends('layouts.app')

@section('content')
<div class="c-top__fv">
    <div class="c-top__fiImg">
        <img src="" alt="">FVイラスト
    </div>
    <div class="c-top__fvMsg">
        <h2 class="c-top__text">プログラミング<br>学習中のあなたへ</h2>
        <p class="c-top__text">「どのくらいのレベルで作ればいいの？」</p>
        <p class="c-top__text">「アウトプットしたいけど、何を作ればいいの？」</p>
        <p class="c-top__text">テキスト型アウトプット教材サービス</p>
        <h1 class="c-top__text">『ぷっとれ』</h1>

        <div class="c-top__button">
            <a href="{{ route('products') }}">教材を見てみる</a>
        </div>

    </div>
</div>
<div class="c-top__outputSample">
    <h2>あなたも作れるようになる！</h2>
    <p>-アウトプット例-</p>

    <div class="c-top__outputImgs">
        <div class="c-top__outputImg">イラスト</div>
        <div class="c-top__outputImg">イラスト</div>
        <div class="c-top__outputImg">イラスト</div>
    </div>
</div>
<div class="c-top__recommend">
    <h2>こんな人にオススメ</h2>

    <div class="c-top__recommends">
        <div class="c-top__recommend">
            <h3>何を作ればいいの？</h3>
            <div class="c-top__reccomendImg"><img src="" alt=""></div>
            <p class="c-top__text">たくさんの教材を用意していますので、<br>もうアウトプットのネタに<br>困ることはありません！</p>
        </div>
    </div>
    <div class="c-top__recommends">
        <div class="c-top__recommend">
            <h3></h3>
            <div class="c-top__reccomendImg"><img src="" alt=""></div>
            <p class="c-top__text"></p>
        </div>
    </div>
    <div class="c-top__recommends">
        <div class="c-top__recommend">
            <h3></h3>
            <div class="c-top__reccomendImg"><img src="" alt=""></div>
            <p class="c-top__text"></p>
        </div>
    </div>
</div>
.c-top__feature
@section('content')
