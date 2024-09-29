<!-- Page Preloader -->
<div id="preloder">
    <div class="loader"></div>
</div>

<!-- Offcanvas Menu Begin -->
<div class="offcanvas-menu-overlay"></div>
<div class="offcanvas-menu-wrapper">
    <div class="offcanvas__cart">
        <div class="offcanvas__cart__links">
            <a href="#" class="search-switch">
                <img src="{{ asset('img/icon/search.png') }}" alt="Search Icon">
            </a>
            <a href="#">
                <img src="{{ asset('img/icon/heart.png') }}" alt="Favorites">
            </a>
        </div>
        <div class="offcanvas__cart__item">
            <a href="#">
                <img src="{{ asset('img/icon/cart.png') }}" alt="Cart Icon"> <span>0</span>
            </a>
            <div class="cart__price">Cart: <span>$0.00</span></div>
        </div>
    </div>
    <div class="offcanvas__logo">
        <a href="{{ url('/') }}">
            <img src="{{ asset('img/logo.png') }}" alt="Logo">
        </a>
    </div>
    <div id="mobile-menu-wrap"></div>
    <div class="offcanvas__option">
        <ul class="list-unstyled">
            <li>USD <span class="arrow_carrot-down"></span>
                <ul>
                    <li>EUR</li>
                    <li>USD</li>
                </ul>
            </li>
            <li>ENG <span class="arrow_carrot-down"></span>
                <ul>
                    <li>Spanish</li>
                    <li>ENG</li>
                </ul>
            </li>
            <li><a href="#">Sign in</a> <span class="arrow_carrot-down"></span></li>
        </ul>
    </div>
</div>

<!-- Header -->
<header class="header">
    <div class="header__top">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="header__top__inner d-flex justify-content-between">
                        <div class="header__top__left">
                            <ul class="list-unstyled">
                                <li><a href="#">Sign in</a> <span class="arrow_carrot-down"></span></li>
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
                                <a href="#">
                                    <img src="{{ asset('img/icon/cart.png') }}" alt="Cart Icon"> <span>0</span>
                                </a>
                                <div class="cart__price">Cart: <span>$0.00</span></div>
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
                        <li class="active"><a href="{{ url('/') }}">Home</a></li>
                        <li><a href="{{ url('/about') }}">About</a></li>
                        <li><a href="{{ url('/shop') }}">Shop</a></li>
                        <li><a href="{{ url('/contact') }}">Contact</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</header>
