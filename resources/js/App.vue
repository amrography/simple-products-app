<template>
  <div id="nav">
    <router-link :to="{name: 'Products'}">Home</router-link> |
    <router-link :to="{name: 'AddProduct'}">Add new product</router-link>
  </div>
  <router-view />
</template>
