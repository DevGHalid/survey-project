import Vue from "vue";
import Axios from "axios";
import store from "./store/index";
import router from "./router/index";

import App from "./components/App";
import Master from "./layouts/Master";
import Draggable from "vuedraggable";
import { library } from "@fortawesome/fontawesome-svg-core";
import {
  faPlus,
  faTrashAlt,
  faPencilAlt,
  faTimes,
  faTimesCircle,
  faSave,
  faEye,
  faCopy
} from "@fortawesome/free-solid-svg-icons";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";

library.add(faPlus);
library.add(faTimes);
library.add(faTimesCircle);
library.add(faTrashAlt);
library.add(faPencilAlt);
library.add(faEye);
library.add(faSave);
library.add(faCopy);

Vue.component("Master", Master);
Vue.component("Draggable", Draggable);
Vue.component("FontAwesomeIcon", FontAwesomeIcon);

Vue.prototype.$http = Axios;

const app = new Vue({
  el: "#app",
  render: h => h(App),
  store,
  router,

  created() {
    const token = localStorage.getItem("accessToken");

    if (token) {
      const bearer = `Bearer ${token}`;
      this.$http.defaults.headers.common["Authorization"] = bearer;
    }
  }
});

//.btn-cyan
