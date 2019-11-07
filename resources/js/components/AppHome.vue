<template>
  <div>
    <toolbar></toolbar>
    <v-container>
      <router-view></router-view>
    </v-container>

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
