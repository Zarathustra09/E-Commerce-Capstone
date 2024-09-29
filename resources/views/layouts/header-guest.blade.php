<!-- Header -->
<header class="header">
    <div class="header__top">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="header__top__inner d-flex justify-content-between">
                        <div class="header__top__left">
                            <ul class="list-unstyled">
                                @if(Auth::check())
                                    <li>
                                        <a href="#">
                                            {{ Auth::user()->name }} <span class="arrow_carrot-down"></span>
                                        </a>
                                        <ul>
                                            <li>
                                                <a href="{{ route('logout') }}"
                                                   onclick="event.preventDefault();
                                                             document.getElementById('logout-form').submit();">
                                                    Logout
                                                </a>
                                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                    @csrf
                                                </form>
                                            </li>
                                        </ul>
                                    </li>
                                @else
                                    <li>
                                        <a href="{{ route('login') }}">Sign in</a> <span class="arrow_carrot-down"></span>
                                    </li>
                                @endif
                            </ul>
                        </div>
                        <div class="header__logo">
                            <a href="{{ url('/') }}">
                                <img src="{{ asset('img/logo.png') }}" alt="Logo">
                            </a>
                        </div>
                        <div class="header__top__right">
                            <div class="header__top__right__links">
                                <a href="#" class="search-switch">
                                    <img src="{{ asset('img/icon/search.png') }}" alt="Search Icon">
                                </a>
                            </div>
                            <div class="header__top__right__cart">
                                <a href="{{ url('/checkout') }}">
                                    <img src="{{ asset('img/icon/cart.png') }}" alt="Cart Icon">
                                    <span>{{ Auth::check() ? Auth::user()->cartItems->count() : 0 }}</span>
                                </a>
                                <div class="cart__price">
                                    Cart: <span>₱{{ Auth::check() ? Auth::user()->cartItems->sum(fn($item) => $item->product->price * $item->quantity) : '0.00' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="canvas__open">
                <i class="fa fa-bars"></i>
            </div>
        </div>
    </div>

    <!-- Navigation Menu -->
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <nav class="header__menu mobile-menu">
                    <ul class="list-unstyled">
                        <li class="{{ request()->is('/') ? 'active' : '' }}">
                            <a href="{{ url('/') }}">Home</a>
                        </li>
                        <li class="{{ request()->is('shop*') ? 'active' : '' }}">
                            <a href="{{ url('/shop') }}">Shop</a>
                        </li>
                        <li>
                            <a href="{{ url('/about') }}">About</a>
                        </li>
                        <li>
                            <a href="{{ url('/contact') }}">Contact</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</header>
