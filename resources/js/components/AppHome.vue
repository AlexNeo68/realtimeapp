<template>
  <div>
    <toolbar></toolbar>
    <v-container v-if="route!=='/'">

      <router-view></router-view>
    </v-container>
      <router-view v-else></router-view>


      <app-footer></app-footer>
  </div>
</template>

<script>
import Toolbar from "./Toolbar";
import AppFooter from "./Footer";
export default {
  components: { Toolbar, AppFooter },
    computed: {
      route(){
          return this.$route.path
      }
    }
};
</script>
