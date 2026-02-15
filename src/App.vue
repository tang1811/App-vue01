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
        <a class="navbar-brand" href="/">Navbar</a>
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
            <li class="nav-item">
              <a class="nav-link" href="/student_crud">Student_crud</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/Contact">Contact</a>
            </li>

            <li class="nav-item dropdown">
              <a
                class="nav-link dropdown-toggle"
                href="#"
                role="button"
                data-bs-toggle="dropdown"
                aria-expanded="false"
              >Employees</a>
              <ul class="dropdown-menu">
                <li>
                  <a class="dropdown-item" href="/employees">Employees</a>
                </li>

                <li>
                  <a class="dropdown-item" href="/employees_crud">Employees_crud</a>
                </li>

                <li>
                  <a class="dropdown-item" href="/employee_crud_image">Employees crud Image</a>
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
              >Customer</a>
              <ul class="dropdown-menu">
                <li>
                  <a class="dropdown-item" href="/Customer">Customer</a>
                </li>

                <li>
                  <a class="dropdown-item" href="/customer_crud">Customer_crud</a>
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
              >Product</a>
              <ul class="dropdown-menu">
                <li>
                  <a class="dropdown-item" href="/product">product</a>
                </li>

                <li>
                  <a class="dropdown-item" href="/show_product">Show_product</a>
                </li>

                <li>
                  <a class="dropdown-item" href="/product_crud">Product Crud</a>
                </li>

                <li>
                  <a class="dropdown-item" href="/product_api">Product_api</a>
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
              >Type</a>
              <ul class="dropdown-menu">
                <li>
                  <a class="dropdown-item" href="/type">Type</a>
                </li>

                <li>
                  <a class="dropdown-item" href="/Type_crud">Type_crud</a>
                </li>
              </ul>
            </li>
          </ul>
          <form class="d-flex" role="search">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" />
            <button class="btn btn-outline-success" type="submit">Search</button>
          </form>
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
