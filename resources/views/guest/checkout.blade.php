@extends('layouts.guest-app')

@section('content')

    <section class="shopping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="shopping__cart__table">
                        <table>
                            <thead>
                            <tr>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($cartItems as $item)
                                <tr>
                                    <td class="product__cart__item">
                                        <div class="product__cart__item__pic">
                                            @php
                                                $imageUrl = $item->product->image ? asset('storage/' . $item->product->image) : 'https://placehold.co/500x500';
                                            @endphp
                                            <img src="{{ $imageUrl }}" alt="{{ $item->product->name }}" width="100px">
                                        </div>
                                        <div class="product__cart__item__text">
                                            <h6>{{ $item->product->name }}</h6>
                                            <h5>${{ $item->product->price }}</h5>
                                        </div>
                                    </td>
                                    <td class="quantity__item">
                                        <div class="quantity">
                                            <button class="dec qtybtn">-</button>
                                            <input type="text" value="{{ $item->quantity }}" readonly>
                                            <button class="inc qtybtn">+</button>
                                        </div>
                                    </td>
                                    <td class="cart__price">${{ $item->product->price * $item->quantity }}</td>
                                    <td class="cart__close"><span class="icon_close"></span></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="continue__btn">
                                <a href="{{url('/shop')}}">Continue Shopping</a>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="continue__btn update__btn">
                                <a href="#"><i class="fa fa-spinner"></i> Update cart</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="cart__discount">
                        <h6>Discount codes</h6>
                        <form action="#">
                            <input type="text" placeholder="Coupon code">
                            <button type="submit">Apply</button>
                        </form>
                    </div>
                    <div class="cart__total">
                        <h6>Cart total</h6>
                        <ul>
                            <li>Subtotal <span>${{ $cartItems->sum(fn($item) => $item->product->price * $item->quantity) }}</span></li>
                            <li>Total <span>${{ $cartItems->sum(fn($item) => $item->product->price * $item->quantity) }}</span></li>
                        </ul>
                        <a href="#" class="primary-btn">Proceed to checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.qtybtn').forEach(function (button) {
                button.addEventListener('click', function () {
                    var input = this.parentElement.querySelector('input');
                    var oldValue = parseInt(input.value);
                    var newVal;

                    if (this.classList.contains('inc')) {
                        newVal = oldValue + 1;
                    } else {
                        newVal = oldValue > 1 ? oldValue - 1 : 1;
                    }

                    input.value = newVal;

                    // Log the new quantity value
                    console.log('New quantity value:', newVal);

                    // Update the total price for the item
                    var priceElement = this.closest('tr').querySelector('.cart__price');
                    var pricePerItem = parseFloat(this.closest('tr').querySelector('.product__cart__item__text h5').innerText.replace('$', ''));
                    priceElement.innerText = '$' + (pricePerItem * newVal).toFixed(2);

                    // Log the updated price for the item
                    console.log('Updated price for the item:', priceElement.innerText);

                    // Update the overall cart total
                    updateCartTotal();
                });
            });

            function updateCartTotal() {
                var total = 0;
                document.querySelectorAll('.cart__price').forEach(function (priceElement) {
                    var price = parseFloat(priceElement.innerText.replace('$', ''));
                    console.log('Parsed price:', price); // Log each parsed price
                    if (!isNaN(price)) {
                        total += price;
                    } else {
                        console.error('Invalid price detected:', priceElement.innerText);
                    }
                });
                var subtotalElement = document.querySelector('.cart__total ul li span');
                var totalElement = document.querySelector('.cart__total ul li:last-child span');
                subtotalElement.innerText = '$' + total.toFixed(2);
                totalElement.innerText = '$' + total.toFixed(2);

                // Log the updated cart total
                console.log('Updated cart total:', totalElement.innerText);
            }
        });
    </script>
@endpush
