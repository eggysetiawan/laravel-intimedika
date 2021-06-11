@extends('layouts.guest.app')

@section('content')
    <main id="main">

        <!-- ======= Breadcrumbs ======= -->
        <section id="breadcrumbs" class="breadcrumbs">
            <div class="container">

                <div class="d-flex justify-content-between align-items-center">
                    <h2>Contact Us</h2>
                    <ol>
                        <li><a href="{{ route('landingpage.home') }}#">Home</a></li>
                        <li>Contact Us</li>
                    </ol>
                </div>

            </div>
        </section><!-- End Breadcrumbs -->

        <section id="contact">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5 mt-5 mt-lg-0">
                        <div class="info1">
                            <div class="address1">
                                <i class='bx bx-current-location'></i>
                                <h4>Locations :</h4>
                                <p>Blok E10 No.32 | Jl. Gading Kirana Utara | RT.10/RW.8, Klp. Gading Bar. | Kec. Klp.
                                    Gading | Kota Jkt Utara | Daerah Khusus Ibukota Jakarta 14240</p>
                            </div>
                            <div class="phone1">
                                <i class='bx bxs-phone'></i>
                                <h4>Phone :</h4>
                                <p>(+62)-21-4530583/45877231</p>
                            </div>
                            <div class="fax1">
                                <i class='bx bxs-printer'></i>
                                <h4>Fax :</h4>
                                <p>(+62)-21-4532648</p>
                            </div>
                            <div class="email1">
                                <i class='bx bx-mail-send'></i>
                                <h4>Email :</h4>
                                <p>sales@intimedika.co </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-7 mt-2">

                        <form action="forms/contact.php" method="post" role="form" class="php-email-form">
                            <div class="form-group">
                                <input type="text" name="name" class="form-control" id="name" placeholder="Your Name"
                                    data-rule="minlen:4" data-msg="Please enter at least 4 chars">
                                <div class="validate"></div>
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" name="email" id="email" placeholder="Your Email"
                                    data-rule="email" data-msg="Please enter a valid email">
                                <div class="validate"></div>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject"
                                    data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject">
                                <div class="validate"></div>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" name="message" rows="5" data-rule="required"
                                    data-msg="Please write something for us" placeholder="Message"></textarea>
                                <div class="validate"></div>
                            </div>
                            <!-- <div class="mb-3">
                                    <div class="loading">Loading</div>
                                    <div class="error-message"></div>
                                    <div class="sent-message">Your message has been sent. Thank you!</div>
                                  </div> -->
                            <div class="float-right"><button type="submit" class="btn btn-info">Send Message</button></div>
                        </form>

                    </div>
                </div>
            </div>
        </section>
        <br><br><br>

    </main>
@endsection
