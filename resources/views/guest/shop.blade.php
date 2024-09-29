@extends('layouts.guest-app')

@section('content')
    <section class="shop spad">
        <div class="container">
            <div class="shop__option">
                <div class="row">
                    <div class="col-lg-7 col-md-7">
                        <div class="shop__option__search">
                            <form action="{{ route('shop.filter') }}" method="POST">
                                @csrf
                                <select id="categoryFilter" name="category_id">
                                    <option value="">Categories</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                <input type="text" name="search" placeholder="Search by name">
                                <button type="submit"><i class="fa fa-search"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
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
                                <div class="product__item__price">₱{{ $product->price }}</div>
                                <div class="cart_add">
                                    <form action="{{ route('cart.add') }}" method="POST" style="display: none;">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    </form>
                                    <a href="#" onclick="event.preventDefault(); this.previousElementSibling.submit();">Add to cart</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="shop__last__option">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="shop__pagination">
                            {{ $products->links() }}
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="shop__last__text">
                            <p>Showing {{ $products->firstItem() }}-{{ $products->lastItem() }} of {{ $products->total() }} results</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
