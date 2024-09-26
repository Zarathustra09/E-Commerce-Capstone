@extends('layouts.guest-app')

@section('content')

    <div class="container-fluid py-5">
        <div class="container py-5">
            <h1 class="mb-4">Billing details</h1>
            <form id="checkout-form">
                @csrf
                <div class="row g-5">
                    <div class="col-md-12 col-lg-6 col-xl-5">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">Products</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Total</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <th scope="row">
                                        <div class="d-flex align-items-center mt-2">
                                            <img src="img/1.png" class="img-fluid rounded-circle" style="width: 90px; height: 90px;" alt="">
                                        </div>
                                    </th>
                                    <td class="py-5">Awesome Broccoli</td>
                                    <td class="py-5">₱69.00</td>
                                    <td class="py-5">2</td>
                                    <td class="py-5">₱138.00</td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                        <div class="d-flex align-items-center mt-2">
                                            <img src="img/2.png" class="img-fluid rounded-circle" style="width: 90px; height: 90px;" alt="">
                                        </div>
                                    </th>
                                    <td class="py-5">Potatoes</td>
                                    <td class="py-5">₱69.00</td>
                                    <td class="py-5">2</td>
                                    <td class="py-5">₱138.00</td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                        <div class="d-flex align-items-center mt-2">
                                            <img src="img/3.png" class="img-fluid rounded-circle" style="width: 90px; height: 90px;" alt="">
                                        </div>
                                    </th>
                                    <td class="py-5">Big Banana</td>
                                    <td class="py-5">₱69.00</td>
                                    <td class="py-5">2</td>
                                    <td class="py-5">₱138.00</td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                    </th>
                                    <td class="py-5"></td>
                                    <td class="py-5"></td>
                                    <td class="py-5">
                                        <p class="mb-0 text-dark py-3">Subtotal</p>
                                    </td>
                                    <td class="py-5">
                                        <div class="py-3 border-bottom border-top">
                                            <p class="mb-0 text-dark">₱414.00</p>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                    </th>
                                    <td class="py-5">
                                        <p class="mb-0 text-dark text-uppercase py-3">TOTAL</p>
                                    </td>
                                    <td class="py-5"></td>
                                    <td class="py-5"></td>
                                    <td class="py-5">
                                        <div class="py-3 border-bottom border-top">
                                            <p class="mb-0 text-dark">₱135.00</p>
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-primary text-white w-100" type="submit">Place Order</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('checkout-form').addEventListener('submit', function(event) {
            event.preventDefault();

            const data = {
                external_id: 'Vanilla Cake',
                total: 1000,
                _token: '{{ csrf_token() }}'
            };

            fetch('{{ url('/api/payments') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify(data)
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.invoice_url) {
                        window.location.href = data.invoice_url;
                    } else {
                        console.error('Error:', data);
                    }
                })
                .catch((error) => {
                    console.error('Error:', error);
                });
        });
    </script>

@endsection
