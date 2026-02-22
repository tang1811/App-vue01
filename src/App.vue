<template>
  <div>
    <!-- menu
    <nav>
      <router-link to="/">Home</router-link> |
      <router-link to="/about">About</router-link> |
      <router-link to="/Contact">Contact</router-link>
    </nav>
    -->

    <nav class="navbar navbar-expand-lg bg-body-tertiary" data-bs-theme="dark">
      <div class="container">
        <a class="navbar-brand" href="/">Tang Shop</a>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="/">Home</a>
            </li>
            <li v-if="isLoggedIn" class="nav-item">
              <a class="nav-link" href="/student_crud">Student_crud</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/Contact">Contact</a>
            </li>

            <li v-if="isLoggedIn" class="nav-item dropdown">
              <a
                class="nav-link dropdown-toggle"
                href="#"
                role="button"
                data-bs-toggle="dropdown"
                aria-expanded="false"
                >Employees</a
              >
              <ul class="dropdown-menu">
                <li v-if="isLoggedIn">
                  <a class="dropdown-item" href="/employees">Employees</a>
                </li>

                <li v-if="isLoggedIn">
                  <a class="dropdown-item" href="/employees_crud"
                    >Employees_crud</a
                  >
                </li>

                <li v-if="isLoggedIn">
                  <a class="dropdown-item" href="/employee_crud_image"
                    >Employees crud Image</a>
                </li>
              </ul>
            </li>

            <li v-if="isLoggedIn" class="nav-item dropdown">
              <a
                class="nav-link dropdown-toggle"
                href="#"
                role="button"
                data-bs-toggle="dropdown"
                aria-expanded="false"
                >Customer</a
              >
              <ul class="dropdown-menu">
                <li v-if="isLoggedIn">
                  <a class="dropdown-item" href="/Customer">Customer</a>
                </li>

                <li v-if="isLoggedIn">
                  <a class="dropdown-item" href="/customer_crud"
                    >Customer_crud</a
                  >
                </li>
              </ul>
            </li>

            <li class="nav-item dropdown">
              <a
                class="nav-link dropdown-toggle"
                href="#"
                role="button"
                data-bs-toggle="dropdown"
                aria-expanded="false"
                >Product</a
              >
              <ul class="dropdown-menu">
                <li>
                  <a class="dropdown-item" href="/product">product</a>
                </li>

                <li v-if="isLoggedIn">
                  <a class="dropdown-item" href="/show_product">Show_product</a>
                </li>

                <li v-if="isLoggedIn">
                  <a class="dropdown-item" href="/product_crud">Product Crud</a>
                </li>

                <li v-if="isLoggedIn">
                  <a class="dropdown-item" href="/product_api">Product_api</a>
                </li>
              </ul>
            </li>

            <li v-if="isLoggedIn" class="nav-item dropdown">
              <a
                class="nav-link dropdown-toggle"
                href="#"
                role="button"
                data-bs-toggle="dropdown"
                aria-expanded="false"
                >Type</a
              >
              <ul class="dropdown-menu">
                <li v-if="isLoggedIn">
                  <a class="dropdown-item" href="/type">Type</a>
                </li>

                <li v-if="isLoggedIn">
                  <a class="dropdown-item" href="/Type_crud">Type_crud</a>
                </li>
              </ul>
            </li>
          </ul>
          

          <!-- ✅ ส่วนแสดงสถานะ Login -->
          <div class="d-flex align-items-center">
            <!-- แสดงชื่อผู้ใช้ -->
            <span v-if="isLoggedIn" class="me-3">
              👤 <span class="badge bg-success">{{ userName }}</span>
            </span>

            <!-- ปุ่ม Login (ถ้ายังไม่ Login) -->
            <router-link v-if="!isLoggedIn" to="/login" class="btn btn-primary">
              Login
            </router-link>

            <!-- ปุ่ม Logout (ถ้า Login แล้ว) -->
            <button v-if="isLoggedIn" @click="logout" class="btn btn-danger">
              Logout
            </button>
          </div>
        </div>
      </div>
    </nav>

    <router-view />
  </div>
</template>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  color: #2c3e50;
}

nav {
  padding: 30px;
}

nav a {
  font-weight: bold;
  color: #2c3e50;
}

nav a.router-link-exact-active {
  color: #251c9e;
}
</style>

<script>
export default {
  data() {
    return {
      // ✅ ตัวแปรเก็บสถานะ Login
      isLoggedIn: false,

      // ✅ ตัวแปรเก็บชื่อผู้ใช้
      userName: "",
    };
  },

  // ✅ ทำงานทันทีเมื่อโหลด Component
  mounted() {
    this.checkLogin();
  },

  methods: {
    // ✅ ตรวจสอบสถานะ Login จาก localStorage
    checkLogin() {
      // ถ้ามี adminLogin → ถือว่า Login แล้ว
      this.isLoggedIn = !!localStorage.getItem("adminLogin");

      if (this.isLoggedIn) {
        // ดึงข้อมูล user
        const user = JSON.parse(localStorage.getItem("user"));

        // แสดงชื่อ ถ้าไม่มีใช้ "Admin"
        this.userName = user?.name || "Admin";
      }
    },

    // ✅ Logout
    logout() {
      // ลบข้อมูล Login
      localStorage.removeItem("adminLogin");
      localStorage.removeItem("user");

      // รีเซ็ตค่า
      this.isLoggedIn = false;
      this.userName = "";

      // ไปหน้า Login
      this.$router.push("/login");
    },
  },

  // ✅ ถ้าเปลี่ยนหน้า → เช็ค Login ใหม่
  watch: {
    $route() {
      this.checkLogin();
    },
  },
};
</script>
