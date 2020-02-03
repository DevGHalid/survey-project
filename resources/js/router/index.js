import Vue from "vue";
import VueRouter from "vue-router";
import store from "../store";

// components
import Login from "../pages/Login";
import Home from "../pages/Home";
import Users from "../pages/Users";
import FormList from "../pages/form/FormList";
import FormEdit from "../pages/form/FormEdit";

Vue.use(VueRouter);

const router = new VueRouter({
  mode: "history",
  routes: [
    {
      path: "/login",
      name: "login",
      component: Login
    },
    {
      path: "/",
      name: "home",
      component: Home,
      meta: {
        requiresAuth: true
      }
    },
    {
      path: "/users",
      name: "users",
      component: Users,
      meta: {
        requiresAuth: true
      }
    },
    {
      path: "/forms",
      name: "forms",
      component: FormList,
      meta: {
        requiresAuth: true
      }
    },
    {
      path: "/forms/:id/edit",
      name: "forms.edit",
      component: FormEdit,
      meta: {
        requiresAuth: true
      }
    }
  ]
});

router.beforeEach((to, from, next) => {
  if (!store.getters.isAuthenticated && to.meta.requiresAuth) {
    next("/login");
  } else {
    next();
  }
});

export default router;
