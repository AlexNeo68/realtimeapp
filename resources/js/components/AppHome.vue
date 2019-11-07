<template>
  <div>
    <toolbar></toolbar>
    <router-view></router-view>
    <app-footer></app-footer>
  </div>
</template>

<script>
import Toolbar from "./Toolbar";
import AppFooter from "./Footer";
export default {
  components: { Toolbar, AppFooter }
};
</script>
