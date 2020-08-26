<div class="c-mypage__nav">
    <div class="c-mypage__nav__list {{ $page === "index" ? "active" : ""}}"><a href="/mypage">アカウント</a></div>
    <div class="c-mypage__nav__list {{ $page === "like" ? "active" : ""}}"><a href="/mypage/like">お気に入り</a></div>
    <div class="c-mypage__nav__list {{ $page === "draft" ? "active" : ""}}"><a href="/mypage/draft">下書き</a></div>
    <div class="c-mypage__nav__list {{ $page === "buy" ? "active" : ""}}"><a href="/mypage/buy">購入作品</a></div>
    <div class="c-mypage__nav__list {{ $page === "sale" ? "active" : ""}}"><a href="/mypage/sale">出品作品</a></a></div>
    <div class="c-mypage__nav__list {{ $page === "sold" ? "active" : ""}}"><a href="/mypage/sold">販売履歴</a></div>
    <div class="c-mypage__nav__list {{ $page === "order" ? "active" : ""}}"><a href="/mypage/order">売上管理</a></div>
</div>