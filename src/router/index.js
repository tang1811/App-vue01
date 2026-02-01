import { createRouter, createWebHistory } from "vue-router";
import HomeView from "../views/HomeView.vue";

const routes = [
  {
    path: "/",
    name: "home",
    component: HomeView,
  },
  {
    path: "/Customer",
    name: "Customer",
    component: () =>
      import(/* webpackChunkName: "about" */ "../views/Customer.vue"),
  },
  {
    path: "/Contact",
    name: "Comtact",
    component: () =>
      import(/* webpackChunkName: "about" */ "../views/Contact.vue"),
  },
  {
    path: "/type",
    name: "tpye",
    component: () => import(/* webpackChunkName: "type" */ "../views/type.vue"),
  },
  {
    path: "/employees",
    name: "employees",
    component: () =>
      import(/* webpackChunkName: "type" */ "../views/employees.vue"),
  },
  {
    path: "/add_customer",
    name: "add_customer",
    component: () =>
      import(/* webpackChunkName: "type" */ "../views/Add_customer.vue"),
  },
  {
    path: "/add_employees",
    name: "add_employees",
    component: () =>
      import(/* webpackChunkName: "type" */ "../views/Add_employees.vue"),
  },
  {
    path: "/product",
    name: "product",
    component: () =>
      import(/* webpackChunkName: "type" */ "../views/Product.vue"),
  },
  {
    path: "/product_api",
    name: "product_api",
    component: () =>
      import(/* webpackChunkName: "type" */ "../views/Product_api.vue"),
  },
  {
    path: "/show_product",
    name: "show_product",
    component: () =>
      import(/* webpackChunkName: "type" */ "../views/Show_product.vue"),
  },
  {
    path: "/customer_crud",
    name: "customer_crud",
    component: () =>
      import(/* webpackChunkName: "type" */ "../views/Customer_crud.vue"),
  },
  {
    path: "/employees_crud",
    name: "employees_crud",
    component: () =>
      import(/* webpackChunkName: "type" */ "../views/Employees_crud.vue"),
  },
];

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes,
});

export default router;
