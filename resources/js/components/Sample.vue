<template>
<div>

<!-- <ul> -->
 <!-- <li v-for="product in products" v-bind:key="product.id"> -->
    <p>{{ products}}</p>
<!-- </li> -->
<!-- </!--> 
<ul>
 <li v-for="product_id in products_id" v-bind:key="product_id.id">
    <p>{{product_id}}</p>
</li>
</ul>
<!-- <ul> -->
 <!-- <li v-for="product_name in products_name" v-bind:key="product_name.name"> -->
    <p>{{products_name}}</p>
<!-- </li> -->
<!-- </!--> 
 <p>aaaa</p>
</div>
</template>
<script>
export default {
  mounted() {
    console.log('Component mounted22.');
    // console.log(test);
  },
    props:[
        'products_id','products_name','products'
    ],
  methods:{
    logout: function(){
      event.preventDefault();
      document.getElementById('logout-form').submit();
    }
  }
};
</script>