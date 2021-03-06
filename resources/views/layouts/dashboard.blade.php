<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>@yield('title')</title>
    @stack('prepend-style')
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
    <link href="/style/main.css" rel="stylesheet" />
    @stack('addon-style')
  </head>

  <body>
    <div class="page-dashboard">
      <div class="d-flex" id="wrapper" data-aos="fade-right">
        <!--Side bar-->
        <div class="border-right" id="sidebar-wrapper">
          <div class="sidebar-heading text-center">
            <img src="/images/logo-dashboard.svg" class="my-4" alt="" />
          </div>
          <div class="list-group list-group-flush">
            <a
              href="{{ route('dashboard') }}"
              class="list-group-item list-group-item-action {{ (request()->is('dashboard')) ? 'active' : '' }}"
            >
              Dashboard
            </a>
            <a
              href="{{ route('dashboard-product') }}"
              class="list-group-item list-group-item-action {{ (request()->is('dashboard/products*')) ? 'active' : '' }}"
            >
              My Product
            </a>
            <a
              href="{{ route('dashboard-transactions') }}"
              class="list-group-item list-group-item-action {{ (request()->is('dashboard/transactions*')) ? 'active' : '' }}"
            >
              Transaction
            </a>
            <a
              href="{{ route('dashboard-settings-store') }}"
              class="list-group-item list-group-item-action {{ (request()->is('dashboard/settings')) ? 'active' : '' }}"
            >
              Store Settings </a
            ><a
              href="{{ route('dashboard-settings-account') }}"
              class="list-group-item list-group-item-action {{ (request()->is('dashboard/account')) ? 'active' : '' }}"
            >
              My Account
            </a>
            <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                          @csrf
                      </form>
          </div>
        </div>
        <!-- Page Content-->
        <div id="page-content-wrapper">
 <nav
class="
  navbar navbar-expand-lg navbar-light navbar-store
  fixed-top
  navbar-fixed-top
"
data-aos="fade-down"
>

<div class="container">
  <button
    class="navbar-toggler"
    type="button"
    data-toggle="collapse"
    data-target="#navbarResponsive"
  >
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarResponsive">
    @auth
        <ul class="navbar-nav d-none d-lg-flex ml-auto">
                  <li class="nav-item dropdown">
                    <a
                      href="#"
                      class="nav-link"
                      id="navbarDropdown"
                      role="button"
                      data-toggle="dropdown"
                    >
                      <img
                        src="/images/icon-user.jpg"
                        alt=""
                        class="rounded-circle mr-2 profile-picture"
                      />Hi, {{ Auth::user()->name }}
                      <div class="dropdown-menu">
                        <a href="{{ route('dashboard') }}" class="dropdown-item"
                          >Dashboard</a
                        >
                        <a href="{{ route('dashboard-settings-account') }}" class="dropdown-item"
                          >Settings</a
                        >
                        <div class="dropdown-divider"></div>
                        {{-- <a href="/index.html" class="dropdown-item">Logout</a> --}}
                        <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                          @csrf
                      </form>
                      </div>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('cart') }}" class="nav-link d-inline-block mt-2">
                      @php
                      $carts = \App\Models\Cart::where('users_id', Auth::user()->id)->count();
                      @endphp
                      @if ($carts>0)
                      <img src="/images/shopping-cart-filled.svg" alt="" />
                      <div class="card-badge">{{ $carts }}</div>
                      @else
                        <img src="/images/shopping-cart-empty.svg" alt="" />
                      @endif
                    </a>
                  </li>
                </ul>
                <ul class="navbar-nav d-block d-lg-none">
                  <li class="nav-item">
                    <a href="#" class="nav-link">Hi, {{ Auth::user()->name }}</a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('cart') }}" class="nav-link">Cart</a>
                  </li>
                </ul>
    @endauth
  </div>
</div>
</nav>
          @yield('content')
        </div>
      </div>
    </div>
    <!-- Bootstrap core JavaScript -->
    @include('includes.footer')
    {{-- script --}}
    @stack('prepend-script')
    @include('includes.script')
    @stack('addon-script')
  </body>
</html>
