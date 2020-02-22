<template>
<div>

   <nav class="global-nav">
    <ul class="global-nav__list">
      <li class="global-nav__item"><a href="/products/new">New</a></li>
      <li class="global-nav__item"><a href="/products">index</a></li>
      <li class="global-nav__item"><a href="/products/mypage" >mypage</a></li>
      <li class="global-nav__item">
  
        <a  @click="logout" href="/logout">{{ test }}</a>
        <form action="/logout" method="POST" id="logout__form" style="display:none;"></form>
      </li>
    </ul>
  </nav>
  <div class="hamburger" id="js-hamburger">
    <span class="hamburger__line hamburger__line--1"></span>
    <span class="hamburger__line hamburger__line--2"></span>
    <span class="hamburger__line hamburger__line--3"></span>
  </div>
  <div class="black-bg" id="js-black-bg">
  </div>
  </div>
</template>
<script>
export default {
  mounted() {
   
    console.log('Hamburger mounted.');
  },
    props: {
     test: String,
        },
  methods:{
    logout: function(){
      event.preventDefault();
      document.getElementById('logout-form').submit();
    }

  },
};
</script>