@extends('layouts.app')

@section('content')
<div class="c-top__fv">
    <div class="c-top__fvImg">
        <img src="" alt="">FVイラスト
    </div>
    <div class="c-top__fvMsg">
        <h2 class="c-top__text">プログラミング<br>学習中のあなたへ</h2>
        <p class="c-top__text c-top__text--fvMsg">「どのくらいのレベルで作ればいいの？」</p>
        <p class="c-top__text c-top__text--fvMsg">「アウトプットしたいけど、何を作ればいいの？」</p>
        
        <h3 class="c-top__text c-top__text--subject">テキスト型アウトプット教材サービス</h3>
        <h1 class="c-top__text c-top__text--title">『ぷっとれ』</h1>

        <div class="c-top__button">
            <a class="c-top__button--link" href="{{ route('products') }}" >教材を見てみる</a>
        </div>

    </div>
</div>
<div class="c-top__outputSample">
    <h2>あなたも作れるようになる！</h2>
    <p>-アウトプット例-</p>

    <div class="c-top__outputImgs">
        <div class="c-top__outputImg"><img src="" alt="">イラスト</div>
        <div class="c-top__outputImg"><img src="" alt="">イラスト</div>
        <div class="c-top__outputImg"><img src="" alt="">イラスト</div>
    </div>
</div>
<div class="c-top__recommends">
    <h2>こんな人にオススメ</h2>

    <div class="c-top__recommend">
        <h3>何を作ればいいの？</h3>
        <div class="c-top__recommendImg"><img src="" alt="">イラスト</div>
        <p class="c-top__text c-top__text--recommend">たくさんの教材を用意していますので、<br>もうアウトプットのネタに<br>困ることはありません！</p>
    </div>
    <div class="c-top__recommend">
        <h3>どうやって作ればいいの？</h3>
        <div class="c-top__recommendImg"><img src="" alt="">イラスト</div>
        <p class="c-top__text c-top__text--recommend">教材に沿って進めていくだけで<br>実務レベルのアウトプットが完成します。</p>
    </div>
    <div class="c-top__recommend">
        <h3>初心者でも大丈夫？</h3>
        <div class="c-top__recommendImg"><img src="" alt="">イラスト</div>
        <p class="c-top__text c-top__text--recommend">実際のコードや画像を使ってわかりやすく<br>説明しているので、初心者でも安心</p>
    </div>
</div>
<div class="c-top__features">
    <div class="c-top__features__subject">
        <p>これまでにない、<br>テキスト型のアウトプット教材<br>専門のサービスです</p>
    </div>
    <div class="c-top__features__title">

    <h2>『ぷっとれ』の特徴</h2>
    </div>
    <div class="c-top__feature">
        <h3 class="c-top__feature__title">初心者OK</h3>
        <p class="c-top__text c-top__text--feature">コードだけでなく画像を交えて<br>説明してるので、初心者でも安心して<br>進められます！</p>
    </div>
    <div class="c-top__feature">
        <h3 class="c-top__feature__title">現場主義</h3>
        <p class="c-top__text c-top__text--feature">簡単なものを作るだけでは意味がありません。<br>実際の現場で使える知識が身に付く<br>質の高い教材をご用意！</p>
    </div>
    <div class="c-top__feature">
        <h3 class="c-top__feature__title">本格的なデザイン</h3>
        <p class="c-top__text c-top__text--feature">そのままポートフォリオとしても使える<br>見た目にもこだわった教材で、周囲と差をつけよう！</p>
    </div>
    <div class="c-top__feature">
        <h3 class="c-top__feature__title">レベル・言語ごとに豊富な教材</h3>
        <p class="c-top__text c-top__text--feature">スキルレベル・言語ごとに豊富な教材を用意<br>していますので、あなたにぴったりのものが<br>きっと見つかるはずです！</p>
    </div>
</div>

<div class="c-top__last">
    <div class="c-top__last__subject">
        プログラミングは、<br>アウトプットしなければ<br>絶対に上達しません！
    </div>
    <div class="c-top__last__title">
        <h2>さあ、アウトプットしよう！</h2>
    </div>
    <div class="c-top__button">
        <a class="c-top__button--link" href="{{ route('products') }}" >教材を見てみる</a>
    </div>
</div>
@section('content')
