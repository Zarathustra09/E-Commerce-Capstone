@extends('layouts.guest-app')

@section('content')

    <!-- Hero Section End -->

    <!-- About Section Begin -->
    <section class="about spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="about__text">
                        <div class="section-title">
                            <span>About Cake shop</span>
                            <h2>Cakes and bakes from the house of Queens!</h2>
                        </div>
                        <p>The "Cake Shop" is a Jordanian Brand that started as a small family business. The owners are
                            Dr. Iyad Sultan and Dr. Sereen Sharabati, supported by a staff of 80 employees.</p>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="about__bar">
                        <div class="about__bar__item">
                            <p>Cake design</p>
                            <div id="bar1" class="barfiller">
                                <div class="tipWrap"><span class="tip"></span></div>
                                <span class="fill" data-percentage="95"></span>
                            </div>
                        </div>
                        <div class="about__bar__item">
                            <p>Cake Class</p>
                            <div id="bar2" class="barfiller">
                                <div class="tipWrap"><span class="tip"></span></div>
                                <span class="fill" data-percentage="80"></span>
                            </div>
                        </div>
                        <div class="about__bar__item">
                            <p>Cake Recipes</p>
                            <div id="bar3" class="barfiller">
                                <div class="tipWrap"><span class="tip"></span></div>
                                <span class="fill" data-percentage="90"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- About Section End -->



    <!-- Product Section Begin -->
    <section class="product spad">
        <div class="container">
            <div class="row">
                @foreach($products as $product)
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="product__item">
                            <div class="product__item__pic set-bg" data-setbg="{{ asset('storage/' . $product->image) }}">
                                <div class="product__label">
                                    <span>{{ $product->category->name }}</span>
                                </div>
                            </div>
                            <div class="product__item__text">
                                <h6><a href="#">{{ $product->name }}</a></h6>
                                <div class="product__item__price">${{ $product->price }}</div>
                                <div class="cart_add">
                                    <a href="#">Add to cart</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Product Section End -->

    <!-- Class Section Begin -->

    <!-- Class Section End -->

    <!-- Team Section Begin -->

    <!-- Team Section End -->

    <!-- Testimonial Section Begin -->

    <!-- Testimonial Section End -->

    <!-- Instagram Section Begin -->

    <!-- Instagram Section End -->

    <!-- Map Begin -->
    <div class="map">
        <div class="container">
            <div class="row">
                {{--                <div class="col-lg-4 col-md-7">--}}
                {{--                    <div class="map__inner">--}}
                {{--                        <h6>COlorado</h6>--}}
                {{--                        <ul>--}}
                {{--                            <li>SM City Santa Rosa, Old National Highway, Brgy, Manila S Rd, Santa Rosa, Laguna</li>--}}
                {{--                            <li>your@email.com</li>--}}
                {{--                            <li>+1 800-786-1000</li>--}}
                {{--                        </ul>--}}
                {{--                    </div>--}}
                {{--                </div>--}}
            </div>
        </div>
        <div class="map__iframe">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3865.97640104721!2d121.09574500921148!3d14.312803586082316!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397d8186e2933c5%3A0x65167e5943b4f5d3!2sSM%20City%20Santa%20Rosa!5e0!3m2!1sen!2sph!4v1727574288292!5m2!1sen!2sph" height="300" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
        </div>
    </div>
@endsection
