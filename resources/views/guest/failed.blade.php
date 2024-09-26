@extends('layouts.guest-app')

@section('content')
    <!-- Single Page Header start -->
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">Transaction Failed</h1>
        {{--        <ol class="breadcrumb justify-content-center mb-0">--}}
        {{--            <li class="breadcrumb-item"><a href="#">Home</a></li>--}}
        {{--            <li class="breadcrumb-item"><a href="#">Pages</a></li>--}}
        {{--            <li class="breadcrumb-item active text-white">Transaction Failed</li>--}}
        {{--        </ol>--}}
    </div>
    <!-- Single Page Header End -->

    <!-- Transaction Failed Start -->
    <div class="container-fluid py-5">
        <div class="container py-5 text-center">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <i class="bi bi-exclamation-triangle display-1 text-danger"></i>
                    <h1 class="display-1">Failed</h1>
                    <h1 class="mb-4">Your Transaction Was Not Successful</h1>
                    <p class="mb-4">We’re sorry, but something went wrong with your transaction. Please try again or contact support for assistance.</p>
                    <a class="btn border-danger rounded-pill py-3 px-5" href="{{ url('/') }}">Go Back To Home</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Transaction Failed End -->
@endsection
