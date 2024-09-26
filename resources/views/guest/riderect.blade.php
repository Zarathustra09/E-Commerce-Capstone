@extends('layouts.guest-app')

@section('content')
    <!-- Single Page Header start -->
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">Redirecting...</h1>
        {{--        <ol class="breadcrumb justify-content-center mb-0">--}}
        {{--            <li class="breadcrumb-item"><a href="#">Home</a></li>--}}
        {{--            <li class="breadcrumb-item"><a href="#">Pages</a></li>--}}
        {{--            <li class="breadcrumb-item active text-white">Redirecting</li>--}}
        {{--        </ol>--}}
    </div>
    <!-- Single Page Header End -->

    <!-- Redirecting Start -->
    <div class="container-fluid py-5">
        <div class="container py-5 text-center">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <i class="bi bi-arrow-repeat display-1 text-warning"></i>
                    <h1 class="display-1">Redirecting</h1>
                    <h1 class="mb-4">You Will Be Redirected Shortly</h1>
                    <p class="mb-4">Please wait while we take you to the appropriate page. If you are not redirected, click the button below.</p>
                    <a class="btn border-warning rounded-pill py-3 px-5" href="{{ url('/') }}">Go Back To Home</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Redirecting End -->
@endsection
