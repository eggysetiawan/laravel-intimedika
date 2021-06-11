  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center header-color">
      <div class="container d-flex align-items-center">

          <div class="logo mr-auto">
              <a href="{{ route('landingpage.home') }}"><img
                      src="{{ asset('assets/img/LogoIntimedika-1-2.png') }}"></a>
              <!-- Uncomment below if you prefer to use an image logo -->
              <!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
          </div>

          <nav class="nav-menu d-none d-lg-block">
              <ul>
                  <li class="active"><a href="#">Home</a></li>

                  <li><a href="#services">Services</a></li>
                  <li class="drop-down"><a href="products.php">Products</a>
                      <ul>
                          @foreach ($products as $product)
                              <li><a
                                      href="{{ route('products.show', $product->slug) }}">{{ ucfirst($product->title) }}</a>
                              </li>
                          @endforeach

                      </ul>
                  </li>
                  <li><a href="#about">About</a></li>
                  <li><a href="contactus.php">Contact Us</a></li>

                  <!-- <li class="get-started"><a href="#about">Login</a></li> -->
              </ul>
          </nav><!-- .nav-menu -->

      </div>
  </header><!-- End Header -->
