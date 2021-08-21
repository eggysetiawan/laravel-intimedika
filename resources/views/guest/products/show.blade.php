@extends('layouts.guest.app')
@section('content')
    <main id="main">

        <!-- ======= Breadcrumbs ======= -->
        <section id="breadcrumbs" class="breadcrumbs">
            <div class="container">

                <div class="d-flex justify-content-between align-items-center">
                    <h2>Details Product</h2>
                    <ol>
                        <li><a href="{{ route('landingpage.home') }}">Home</a></li>
                        <li>Details Product</li>
                        <li>{{ ucfirst($product->title) }}</li>
                    </ol>
                </div>

            </div>
        </section><!-- End Breadcrumbs -->

        <!-- ======= Portfolio Details Section ======= -->
        <section id="portfolio-details" class="portfolio-details">
            <div class="container">

                <div class="row">

                    <div class="col-lg-8">
                        <h2 class="portfolio-title">{{ strtoupper($product->title) }}</h2>
                        <div class="owl-carousel portfolio-details-carousel">
                            {{-- <img src="{{ asset('assets/img/product/intiwid-1.png') }}" class="img-fluid" alt="">
                            <img src="{{ asset('assets/img/product/intiwid-2.png') }}" class="img-fluid" alt="">
                            <img src="{{ asset('assets/img/product/intiwid-3.png') }}" class="img-fluid" alt=""> --}}
                            @foreach ($product->getMedia($product->title) as $media)
                                <img src="{{ $media->getFullUrl() }}" class="img-fluid" alt="">
                            @endforeach
                        </div>
                    </div>

                    <div class="col-lg-4 portfolio-info">
                        <h3>Product information</h3>
                        <hr>
                        <ul>
                            <li><strong>Category</strong>: {{ strtoupper($product->category) }}</li>
                            <li><strong>Country</strong>: {{ $product->origin }}</li>
                            <li><strong>Product</strong>: {{ ucfirst($product->product) }}</li>
                            <li><strong>Contact Us</strong>: {{ $product->contact }}</li>
                        </ul>

                        <p>{{ $product->description }}</p>
                    </div>

                </div>

            </div>
        </section><!-- End Portfolio Details Section -->

    </main><!-- End #main -->
@endsection
