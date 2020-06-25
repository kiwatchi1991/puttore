@extends('layouts.app')

@section('title','TOP')
@section('content')

<div class="c-home__wrap">

  <div class="c-home">
    <h2 class="c-home__title">特定商取引法に基づく表示</h2>

    <table class="c-home__table">
      <tbody>
        <tr>
          <th class="c-home__table__th">販売事業者名</th>
          <td class="c-home__table__td">合同会社ゼロワン</td>
        </tr>
        <tr>
          <th class="c-home__table__th">代表者</th>
          <td class="c-home__table__td">齊藤　和樹</td>
        </tr>
        <tr>
          <th class="c-home__table__th">所在地</th>
          <td class="c-home__table__td">〒106-0032　 東京都港区六本木７丁目８番地６号　AXALL ROPPONGI 6F</td>
        </tr>
        <tr>
          <th class="c-home__table__th">顧問弁護士</th>
          <td class="c-home__table__td">弁護士法人アークレスト法律事務所</td>
        </tr>
        <tr>
          <th class="c-home__table__th">お問合わせメールアドレス</th>
          <td class="c-home__table__td">info@puttore.com</td>
        </tr>
        <tr>
          <th class="c-home__table__th">電話番号</th>
          <td class="c-home__table__td">043-488-4609</td>
        </tr>
        <tr>
          <th class="c-home__table__th">商品代金</th>
          <td class="c-home__table__td">各商品の料金に基づく</td>
        </tr>
        <tr>
          <th class="c-home__table__th">商品代金以外の必要料金</th>
          <td class="c-home__table__td">「銀行振込」にてお支払い頂く際は、別途振り込み手数料をご負担ください。</td>
        </tr>
        <tr>
          <th class="c-home__table__th">販売数量</th>
          <td class="c-home__table__td">特に制限はございません。</td>
        </tr>
        <tr>
          <th class="c-home__table__th">商品代金の支払時期</th>
          <td class="c-home__table__td">銀行振込：お申し込み後7日以内、クレジットカード決済：お申込み時</td>
        </tr>
        <tr>
          <th class="c-home__table__th">引き渡し時期</th>
          <td class="c-home__table__td">決済完了後、即時</td>
        </tr>
        <tr>
          <th class="c-home__table__th">引き渡し方法</th>
          <td class="c-home__table__td">本サイトにて</td>
        </tr>
        <tr>
          <th class="c-home__table__th">お支払い方法</th>
          <td class="c-home__table__td">銀行振込、クレジット決済にてお支払いください。</td>
        </tr>
        <tr>
          <th class="c-home__table__th">領収書について</th>
          <td class="c-home__table__td">領収書は各金融機関が発行するお支払明細にて替えさせていただきます。</td>
        </tr>
        <tr>
          <th class="c-home__table__th">ご返品について</th>
          <td class="c-home__table__td">商品の性質上解約はできません。また、差額の返金は致しません。</td>
        </tr>
        <tr>
          <th class="c-home__table__th">ご解約について</th>
          <td class="c-home__table__td">解約（退会）は必ずログイン後に<a href="{{route('mypage')}}"
              class=“global-nav__item__link”>コチラ</a>から行なってください。銀行振込みや前納をされた場合、途中解約をされても差額分の返金は致しません。
          </td>
        </tr>
      </tbody>

    </table>


  </div>
</div>
@endsection