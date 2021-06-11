@extends('layouts.guest.app')

@section('content')
    <main id="main">

        <!-- ======= Breadcrumbs ======= -->
        <section id="breadcrumbs" class="breadcrumbs">
            <div class="container">

                <div class="d-flex justify-content-between align-items-center">
                    <h2>Products</h2>
                    <ol>
                        <li><a href="{{ route('landingpage.home') }}">Home</a></li>
                        <li>Products</li>
                        <!-- <li><a href="input-products.php">Add Product Here</a></li> -->
                    </ol>
                </div>

            </div>
        </section><!-- End Breadcrumbs -->

        <!-- ======= Portfolio Section ======= -->
        <section id="portfolio" class="portfolio">
            <div class="container">

                <div class="section-title" data-aos="fade-up">
                    <h2>Products</h2>
                </div>

                <div class="row" data-aos="fade-up" data-aos-delay="200">
                    <div class="col-lg-12 d-flex justify-content-center">
                        <ul id="portfolio-flters">
                            <li data-filter="*" class="filter-active">All</li>
                            @foreach ($modalitySelects as $modality)
                                <li data-filter=".filter-{{ str_replace('BAYER MEDRAD', 'BAYER', $modality->brand) }}">
                                    {{ str_replace('BAYER MEDRAD', 'BAYER', $modality->brand) }}</li>
                            @endforeach
                            {{-- <li data-filter=".filter-INTIWID">Intiwid</li>
                            <li data-filter=".filter-AGFA">Agfa</li>
                            <li data-filter=".filter-BAYER">Bayer</li>
                            <li data-filter=".filter-Careray">Careray</li>
                            <li data-filter=".filter-CLEAR">Clear</li>
                            <li data-filter=".filter-IRadimed">Iradimed</li> --}}
                        </ul>
                    </div>
                </div>






                <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="400">
                    <!-- --------------------- intiwid----------------------------------------- -->
                    @foreach ($modalities as $modality)
                        <div
                            class="col-lg-4 col-md-6 portfolio-item filter-{{ str_replace('BAYER MEDRAD', 'BAYER', $modality->brand) }}">
                            <!-- filter-(merk product) -->
                            <div class="portfolio-wrap">
                                <img src="{{ $modality->getFirstMediaUrl('product') }}" class="img-fluid" alt="">
                                <!-- image -->
                                <a href="#!" title="More Details" data-toggle="modal">
                                    <div class="portfolio-info">
                                        <h4>{{ $modality->model }}</h4> <!-- type product -->
                                        <p>{{ str_replace('BAYER MEDRAD', 'BAYER', $modality->brand) }}</p>
                                        <!-- merk product -->

                                        <div class="portfolio-links">
                                            <i class="bx bx-plus"></i>
                                            @include('guest.modals.spec')
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>


                    @endforeach


                    <!-- ------------------------------BAYER---------------------------------- -->







                </div>

            </div>
        </section><!-- End Portfolio Section -->

        <!-- Central Modal Products -->

        <!-- Central Modal Products -->

    </main><!-- End #main -->

@endsection
