@extends('layouts.guest.app')

@section('content')
    <main id="main">

        <!-- ======= Breadcrumbs ======= -->
        <section id="breadcrumbs" class="breadcrumbs">
            <div class="container">

                <div class="d-flex justify-content-between align-items-center">
                    <h2>Products</h2>
                    <ol>
                        <li><a href="index.php">Home</a></li>
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
                            <li data-filter=".filter-INTIWID">Intiwid</li>
                            <li data-filter=".filter-AGFA">Agfa</li>
                            <li data-filter=".filter-BAYER">Bayer</li>
                            <li data-filter=".filter-Careray">Careray</li>
                            <li data-filter=".filter-CLEAR">Clear</li>
                            <li data-filter=".filter-IRadimed">Iradimed</li>
                        </ul>
                    </div>
                </div>





                <?php $r = mysqli_query(
                $conn,
                'SELECT * FROM products INNER JOIN sales_modality ON
                products.fk_mod = sales_modality.pk_mod GROUP BY fk_mod ORDER BY pk_product ASC',
                ); ?>
                <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="400">
                    <!-- --------------------- intiwid----------------------------------------- -->
                    <?php while ($pr = mysqli_fetch_assoc($r)): ?>
                    <div class="col-lg-4 col-md-6 portfolio-item filter-<?= $pr['merk_mod'] ?>">
                              <!-- filter-(merk product) -->
                              <div class="portfolio-wrap">
                                <img src="image/modality/<?= $pr['images'] ?>" class="img-fluid" alt=""> <!-- image -->
                                <a href="#" title="More Details" data-toggle="modal" data-id="<?= $pr['pk_mod'] ?>" class="spec">
                                  <div class="portfolio-info">
                                    <h4><?= $pr['model_mod'] ?></h4> <!-- type product -->
                                    <p><?= $pr['merk_mod'] ?></p> <!-- merk product -->

                                    <div class="portfolio-links">
                                      <i class="bx bx-plus"></i>
                                      <!-- data-target (setiap product beda)-->
                                    </div>
                                  </div>
                                </a>
                              </div>
                            </div>
                          <?php endwhile; ?>


                          <!-- ------------------------------BAYER---------------------------------- -->







                        </div>

                      </div>
                    </section><!-- End Portfolio Section -->

                    <!-- Central Modal Products -->
                    <div class="modal fade" id="specMod" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

                      <!-- Change class .modal-sm to change the size of the modal -->
                      <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h4 class="modal-title w-100" id="myModalLabel">Spesification</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body spek-mod">


                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- Central Modal Products -->

                  </main><!-- End #main -->

  @endsection
