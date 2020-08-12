import Vue from "vue";
import App from "./App.vue";
import store from "./store";
import axios from "axios";

new Vue({
    el: "#app",
    components: { App },
    store,
});
