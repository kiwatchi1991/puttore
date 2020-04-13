@extends('layouts.app')

@section('title','TOP')
@section('content')
<div class="c-top__container">
  <div class="c-top__fv">
    <div class="c-top__fvImg">
      {{-- <img class="c-top__fvImg__img" src="/storage/images/fv-image.png" alt="" width="185" height="120"> --}}
      <img class="c-top__fvImg--pc" src="/storage/images/fv-image.png" alt="">
    </div>
    <div class="c-top__fvMsg">
      <h2 class="c-top__fvMsg__head">プログラミング<br>学習中のあなたへ</h2>
      <p class="c-top__fvMsg__text">「どのくらいのレベルで作ればいいの？」<br>「アウトプットしたいけど、何を作ればいいの？」</p>

      <h3 class="c-top__fvMsg c-top__fvMsg__subject">テキスト型アウトプット教材サービス</h3>
      <h1 class="c-top__fvMsg c-top__fvMsg__title">『ぷっとれ』</h1>
      <div class="c-top__fvMsg--img--pc">
        <img src="/storage/images/logo.png" alt="ぷっとれ" width="150">
      </div>
      <div class="c-top__button--center">
        <a class="c-top__button--link" href="{{ route('products') }}">教材を見てみる</a>
      </div>

    </div>
  </div>

  <div class="c-top__output">
    <h2 class="c-top__output__head">あなたも作れるようになる！</h2>
    <p class="c-top__output__text__sample">-アウトプット例-</p>

    <div class="c-top__output__Imgs">

      <div class="c-top__output__imgContainer">
        <div class="c-top__output__Img"><img src="/storage/images/top-4.png" alt="">イラスト</div>
        <div class="c-top__output__text">
          <p class="c-top__output__text--title">Twitter風アプリ完成画面</p>
          <p class="c-top__output__text--body">ダミ「どのくらいのレベルで作ればいいの？」<br>
            「アウトプットしたいけど何を作ればいいの？」<br>
            簡単にTwitterのようなアプリを作ることが<br>
            できる教材もあります！やってみてね</p>
        </div>
      </div>

      <div class="c-top__output__imgContainer c-top__output__imgReverse">
        <div class="c-top__output__Img"><img src="/storage/images/top-5.png" alt="">イラスト</div>
        <div class="c-top__output__text">
          <p class="c-top__output__text--title">Twiiter風アプリ完成画面</p>
          <p class="c-top__output__text--body">ダミ「どのくらいのレベルで作ればいいの？」<br>
            「アウトプットしたいけど何を作ればいいの？」<br>
            簡単にTwitterのようなアプリを作ることが<br>
            できる教材もあります！やってみてね</p>
        </div>
      </div>

      <div class="c-top__output__imgContainer">
        <div class="c-top__output__Img"><img src="/storage/images/top-4.png" alt="">イラスト</div>
        <div class="c-top__output__text">
          <p class="c-top__output__text--title">Twiiter風アプリ完成画面</p>
          <p class="c-top__output__text--body">ダミ「どのくらいのレベルで作ればいいの？」<br>
            「アウトプットしたいけど何を作ればいいの？」<br>
            簡単にTwitterのようなアプリを作ることが <br>
            できる教材もあります！やってみてね</p>
        </div>
      </div>

    </div>
  </div>

  <div class="c-top__recommends">
    <h2 class="c-top__recommends__head">こんな人にオススメ</h2>

    <div class="c-top__recommend__container">
      <div class="c-top__recommend">
        <div class="c-top__recommend__Img">
          <h3 class="c-top__recommend__head">何を作ればいいの？</h3>
          <img src="/storage/images/top-1.png" alt="">
          <p class="c-top__recommend__text">たくさんの教材を用意しています<br>ので、もうアウトプットのネタに<br>困ることはありません！</p>
        </div>
      </div>

      <div class="c-top__recommend">
        <div class="c-top__recommend__Img c-top__recommend__Img--how">
          <h3 class="c-top__recommend__head">どうやって作ればいいの？</h3>
          <img src="/storage/images/top-2.png" alt="">
          <p class="c-top__recommend__text">教材に沿って進めていくだけで<br>実務レベルのアウトプットが<br>完成します。</p>
        </div>
      </div>

      <div class="c-top__recommend">
        <div class="c-top__recommend__Img">
          <h3 class="c-top__recommend__head">初心者でも大丈夫？</h3>
          <img src="/storage/images/top-3.png" alt="">
          <p class="c-top__recommend__text">実際のコードや画像を使って<br>わかりやすく説明しているので、<br>初心者でも安心。</p>
        </div>
      </div>
    </div>

  </div>

  <div id="features" class="c-top__features">
    <div class="c-top__features__inner">
      <div class="c-top__features__subject">
        <p class="c-top__features__text">これまでにない、<br>テキスト型のアウトプット教材<br class="c-top__features--br">専門のサービスです</p>
      </div>
      {{-- <div class="c-top__features__title"> --}}
      <h2 class="c-top__features__title">「ぷっとれ」の特徴</h2>
      {{-- </div> --}}
      <div class="c-top__feature">
        <h3 class="c-top__feature__title">初心者OK</h3>
        <p class="c-top__feature__text">コードだけでなく画像を交えて説明して<br>あるので、初心者でも安心して進められ<br>ます！</p>
      </div>
      <div class="c-top__feature">
        <h3 class="c-top__feature__title">現場主義</h3>
        <p class="c-top__feature__text">簡単なものを作るだけでは意味がありま<br>せん。実際の現場で使える知識が身につ<br>く質の高い教材をご用意！</p>
      </div>
      <div class="c-top__feature">
        <h3 class="c-top__feature__title">本格的なデザイン</h3>
        <p class="c-top__feature__text">そのままポートフォリオとしても使える<br>見た目にもこだわった教材で、<br>周囲と差をつけよう！</p>
      </div>
      <div class="c-top__feature">
        <h3 class="c-top__feature__title">レベル・言語ごとに豊富な教材</h3>
        <p class="c-top__feature__text">スキルレベル・言語ごとに豊富な教材を<br>用意していますので、あなたにぴったり<br>のものがきっと見つかるはずです！</p>
      </div>
    </div>
  </div>

  <div class="c-top__end">
    <div class="c-top__end__subject">
      プログラミングは、<br>アウトプットしなければ<br class="c-top__features--br">絶対に上達しません！
    </div>
    <h2 class="c-top__end__title">さあ、アウトプットしよう！</h2>
    <div class="c-top__button">
      <a class="c-top__button--link" href="{{ route('products') }}">教材を見てみる</a>
    </div>
  </div>
</div>
@endsection