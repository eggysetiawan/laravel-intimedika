@extends('layouts.guest.app')

@section('content')
    <!-- ======= Hero Section ======= -->
    <section id="hero" class="d-flex align-items-center">


        <div class="container-fluid pd-home">
            <div class="row">
                <div class="col-lg-6 pt-5 pt-lg-0 order-2 order-lg-1 d-flex flex-column justify-content-center">
                    <h1 data-aos="fade-up">The Leading Medical Device Distribution in Indonesia</h1>
                    <h2 data-aos="fade-up" data-aos-delay="400">We provide medical solution to major hospital and
                        healthcare institutions in Indonesia</h2>
                    <div data-aos="fade-up" data-aos-delay="800">
                        <a href="{{ route('login') }}" class="btn-get-started scrollto">Go to Login</a>
                    </div>
                </div>


                <div class="col-lg-6 order-1 order-lg-2 hero-img">
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <a href="{{ route('products.index') }}"><img class="d-block w-100"
                                        src="{{ asset('assets/img/hero/hero-4.png') }}" alt="First slide"></a>
                            </div>
                            <div class="carousel-item">
                                <a href="{{ route('products.show', 'agfa-modality-film') }}"><img class="d-block w-100"
                                        src="{{ asset('assets/img/hero/hero-2.png') }}" alt="Second slide"></a>
                            </div>
                            <div class="carousel-item">
                                <a href="{{ route('products.show', 'agfa-modality-film') }}"><img class="d-block w-100"
                                        src="{{ asset('assets/img/hero/hero-3.png') }}" alt="Third slide"></a>
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                    <!-- <img src="assets/img/hero-radiology.svg" class="img-fluid animated" alt=""> -->

                </div>



            </div>
        </div>

    </section><!-- End Hero -->

    <main id="main">

        <!-- ======= Clients Section ======= -->
        <section id="clients" class="clients clients">
            <div class="container-fluid">

                <div class="row">

                    <div class="col-lg-2 col-md-4 col-6">
                        <a href="{{ route('products.show', 'intiwid-ris-pacs') }}">
                            <img src="{{ asset('assets/img/clients/client1.png') }}" class="img-fluid" alt=""
                                data-aos="zoom-in">
                        </a>
                    </div>

                    <div class="col-lg-2 col-md-4 col-6">
                        <a href="{{ route('products.show', 'agfa-modality-film') }}">
                            <img src="{{ asset('assets/img/clients/client2.png') }}" class="img-fluid" alt=""
                                data-aos="zoom-in" data-aos-delay="100">
                        </a>
                    </div>

                    <div class="col-lg-2 col-md-4 col-6">
                        <a href="{{ route('products.show', 'bayer-modality-bhp') }}">
                            <img src="{{ asset('assets/img/clients/client3.png') }}" class="img-fluid" alt=""
                                data-aos="zoom-in" data-aos-delay="200">
                        </a>
                    </div>

                    <div class="col-lg-2 col-md-4 col-6">
                        <a href="{{ route('products.show', 'careray-dr') }}">
                            <img src="{{ asset('assets/img/clients/client4.png') }}" class="img-fluid" alt=""
                                data-aos="zoom-in" data-aos-delay="300">
                        </a>
                    </div>

                    <div class="col-lg-2 col-md-4 col-6">
                        <a href="{{ route('products.show', 'clear-printer-dry-film') }}">
                            <img src="{{ asset('assets/img/clients/client5.png') }}" class="img-fluid" alt=""
                                data-aos="zoom-in" data-aos-delay="400">
                        </a>
                    </div>

                    <div class="col-lg-2 col-md-4 col-6">
                        <a href="{{ route('products.show', 'iradimed-modality') }}">
                            <img src="{{ asset('assets/img/clients/client6.png') }}" class="img-fluid" alt=""
                                data-aos="zoom-in" data-aos-delay="500">
                        </a>
                    </div>

                </div>

            </div>
        </section><!-- End Clients Section -->



        <!-- ======= Counts Section ======= -->
        <!-- <section id="counts" class="counts">
                                                                                                                                          <div class="container">

                                                                                                                                            <div class="row">
                                                                                                                                              <div class="image col-xl-5 d-flex align-items-stretch justify-content-center justify-content-xl-start" data-aos="fade-right" data-aos-delay="150">
                                                                                                                                                <img src="assets/img/counts-img.svg" alt="" class="img-fluid">
                                                                                                                                              </div>

                                                                                                                                              <div class="col-xl-7 d-flex align-items-stretch pt-4 pt-xl-0" data-aos="fade-left" data-aos-delay="300">
                                                                                                                                                <div class="content d-flex flex-column justify-content-center">
                                                                                                                                                  <div class="row">
                                                                                                                                                    <div class="col-md-6 d-md-flex align-items-md-stretch">
                                                                                                                                                      <div class="count-box">
                                                                                                                                                        <i class="icofont-simple-smile"></i>
                                                                                                                                                        <span data-toggle="counter-up">65</span>
                                                                                                                                                        <p><strong>Happy Clients</strong> consequuntur voluptas nostrum aliquid ipsam architecto ut.</p>
                                                                                                                                                      </div>
                                                                                                                                                    </div>

                                                                                                                                                    <div class="col-md-6 d-md-flex align-items-md-stretch">
                                                                                                                                                      <div class="count-box">
                                                                                                                                                        <i class="icofont-document-folder"></i>
                                                                                                                                                        <span data-toggle="counter-up">85</span>
                                                                                                                                                        <p><strong>Projects</strong> adipisci atque cum quia aspernatur totam laudantium et quia dere tan</p>
                                                                                                                                                      </div>
                                                                                                                                                    </div>

                                                                                                                                                    <div class="col-md-6 d-md-flex align-items-md-stretch">
                                                                                                                                                      <div class="count-box">
                                                                                                                                                        <i class="icofont-clock-time"></i>
                                                                                                                                                        <span data-toggle="counter-up">12</span>
                                                                                                                                                        <p><strong>Years of experience</strong> aut commodi quaerat modi aliquam nam ducimus aut voluptate non vel</p>
                                                                                                                                                      </div>
                                                                                                                                                    </div>

                                                                                                                                                    <div class="col-md-6 d-md-flex align-items-md-stretch">
                                                                                                                                                      <div class="count-box">
                                                                                                                                                        <i class="icofont-award"></i>
                                                                                                                                                        <span data-toggle="counter-up">15</span>
                                                                                                                                                        <p><strong>Awards</strong> rerum asperiores dolor alias quo reprehenderit eum et nemo pad der</p>
                                                                                                                                                      </div>
                                                                                                                                                    </div>
                                                                                                                                                  </div>
                                                                                                                                                </div>
                                                                                                                                              </div>
                                                                                                                                            </div>

                                                                                                                                          </div>
                                                                                                                                        </section> -->
        <!-- End Counts Section -->

        @include('layouts.guest.service')


        <?php
        // include('features.php');
        ?>

        <?php
        // include('portofolio.php');
        ?>

        <?php
        // include('team.php');
        ?>

        <?php
        // include('pricing.php');
        ?>

        <?php
        // include('faq.php');
        ?>









        <!-- ======= About Us Section ======= -->
        <section id="about" class="about">
            <div class="container">
                <div class="section-title" data-aos="fade-up">
                    <h2>About Us</h2>
                </div>
                <div class="row content">
                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="150">
                        <p>
                            PT. Intimedika Puspa Indah is the leading medical devices distributor for pharmaceutical and
                            healthcare institutions. The devices we provide are used in many fields, including
                            pharmaceutical laboratory, medicine, midwifery, nursing, physiotherapy, clinical
                            laboratories.</p>
                        <p>We serve mainly Indonesian customers either directly or through (future) online transactions.
                            We believe that excellent service is a combination of the quality of goods we provide,
                            affordable prices of goods along with maintenance and excellent consulting services that you
                            can trust. With our established experience and happy costumers, we are delighted to provide
                            the solution of your medical devices needs.
                        </p>
                        <!--  <ul>
                                                                                                                                                  <li><i class="ri-check-double-line"></i> Ullamco laboris nisi ut aliquip ex ea commodo consequat</li>
                                                                                                                                                  <li><i class="ri-check-double-line"></i> Duis aute irure dolor in reprehenderit in voluptate velit</li>
                                                                                                                                                  <li><i class="ri-check-double-line"></i> Ullamco laboris nisi ut aliquip ex ea commodo consequat</li>
                                                                                                                                                </ul> -->
                    </div>
                    <div class="col-lg-6 pt-4 pt-lg-0" data-aos="fade-up" data-aos-delay="300">
                        <p>
                            Kindly use this website as a reference of our company, the products we have for your medical
                            devices needs, and the information on several devices from our healthcare manufacturing
                            partners. If you’re interested in getting certain products that is not found on our website,
                            do not hesitate to contact our costumer service. We would be glad to help!</p>
                        <p>We hope that our strong commitment to provide best quality and affordable goods can help meet
                            your needs.
                        </p>
                        <!-- <a href="#" class="btn-learn-more">Learn More</a>   -->
                    </div>
                </div>
            </div>
        </section><!-- End About Us Section -->



    </main><!-- End #main -->
@endsection
