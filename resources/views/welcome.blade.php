<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>StaffLink</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Favicons -->
    <link href="{{ asset('assets/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">

    <!-- =======================================================
  * Template Name: QuickStart
  * Template URL: https://bootstrapmade.com/quickstart-bootstrap-startup-website-template/
  * Updated: Aug 07 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="index-page">

    <header id="header" class="header d-flex align-items-center fixed-top">
        <div class="container-fluid container-xl position-relative d-flex align-items-center">

            <a href="" class="logo d-flex align-items-center me-auto">
                <img src="{{ asset('assets/img/logo.png') }}" alt="">
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="#" class="active">Beranda</a></li>
                    <li><a href="#about">Tentang Kami</a></li>
                    <li><a href="#features">Visi & Misi</a></li>
                    <li><a href="#services">Layanan</a></li>
                    <li><a href="#contact">Hubungi Kami</a></li>
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>

            <a class="btn-getstarted" href="{{ route('login') }}">Masuk</a>

        </div>
    </header>

    <main class="main">

        <!-- Hero Section -->
        <section id="hero" class="hero section">
            <div class="hero-bg">
                <img src="{{ asset('assets/img/hero-bg-light.webp') }}" alt="">
            </div>
            <div class="container text-center">
                <div class="d-flex flex-column justify-content-center align-items-center">
                    <h1 data-aos="fade-up">YOUR SUPPORT SYSTEM</h1>
                    <p data-aos="fade-up" data-aos-delay="100">Kekuatan kami untuk dapat memberikan pelayanan yang
                        terbaik bagi kebutuhan Anda.<br></p>
                    <div class="d-flex" data-aos="fade-up" data-aos-delay="200">
                        <a href="#about" class="btn-get-started">Get Started</a>
                        <a href="https://www.youtube.com/watch?v=Y7f98aduVJ8"
                            class="glightbox btn-watch-video d-flex align-items-center"><i
                                class="bi bi-play-circle"></i><span>Watch Video</span></a>
                    </div>
                    <img src="{{ asset('assets/img/hero-services-img.webp') }}" class="img-fluid hero-img"
                        alt="" data-aos="zoom-out" data-aos-delay="300">
                </div>
            </div>

        </section><!-- /Hero Section -->


        <!-- Featured Services Section -->
        <section id="featured-services" class="featured-services section light-background">

            <div class="container">

                <div class="row gy-4">

                    <div class="col-xl-4 col-lg-6" data-aos="fade-up" data-aos-delay="100">
                        <div class="service-item d-flex">
                            <div class="icon flex-shrink-0"><i class="bi bi-briefcase"></i></div>
                            <div>
                                <h4 class="title"><a href="#" class="stretched-link">Service Excellent</a></h4>
                                <p class="description ">Berorientasi pada kebutuhan pelanggan, memberikan solusi
                                    terbaik, serta meningkatkan pelayanan untuk membangun loyalitas pelanggan.</p>
                            </div>
                        </div>
                    </div>
                    <!-- End Service Item -->

                    <div class="col-xl-4 col-lg-6" data-aos="fade-up" data-aos-delay="200">
                        <div class="service-item d-flex">
                            <div class="icon flex-shrink-0"><i class="bi bi-cpu"></i></div>
                            <div>
                                <h4 class="title"><a href="#" class="stretched-link">Modern</a></h4>
                                <p class="description">Mengedepankan teknologi digital untuk belajar, bekerja,
                                    berkomunikasi, dan berkarya untuk meningkatkan kesejahteraan pekerja.</p>
                            </div>
                        </div>
                    </div><!-- End Service Item -->

                    <div class="col-xl-4 col-lg-6" data-aos="fade-up" data-aos-delay="300">
                        <div class="service-item d-flex">
                            <div class="icon flex-shrink-0"><i class="bi bi-award"></i></div>
                            <div>
                                <h4 class="title"><a href="#" class="stretched-link">Integrity</a></h4>
                                <p class="description">Memiliki integritas adalah nilai yang kami terus pegang sampai
                                    saat ini dan terus kami tingkatkan guna mencapai mutu SDM yang berkualitas.</p>
                            </div>
                        </div>
                    </div><!-- End Service Item -->

                    <!-- Loyal and Ethics in the middle -->
                    <div class="col-xl-4 offset-xl-2 col-lg-6" data-aos="fade-up" data-aos-delay="400">
                        <div class="service-item d-flex">
                            <div class="icon flex-shrink-0"><i class="bi bi-people"></i></div>
                            <div>
                                <h4 class="title"><a href="#" class="stretched-link">Loyal</a></h4>
                                <p class="description">Meningkatkan rasa saling memiliki terhadap perusahaan dan
                                    berdedikasi tinggi untuk kemajuan perusahaan.</p>
                            </div>
                        </div>
                    </div><!-- End Service Item -->

                    <div class="col-xl-4 col-lg-6" data-aos="fade-up" data-aos-delay="500">
                        <div class="service-item d-flex">
                            <div class="icon flex-shrink-0"><i class="bi bi-shield-check"></i></div>
                            <div>
                                <h4 class="title"><a href="#" class="stretched-link">Ethics</a></h4>
                                <p class="description">Mengedepankan etika karakter yang berkualitas tinggi dalam
                                    setiap pelayanan yang kami berikan kepada mitra akan selalu kami jaga dan
                                    tingkatkan.</p>
                            </div>
                        </div>
                    </div><!-- End Service Item -->

                </div>

            </div>

        </section><!-- /Featured Services Section -->

        <!-- About Section -->
        <section id="about" class="about section">

            <div class="container">

                <div class="row gy-4">

                    <div class="col-lg-6 content" data-aos="fade-up" data-aos-delay="100">
                        <p class="who-we-are">Tentang Kami</p>
                        <h3>PT. CIPTA BUMI PRAWARA</h3>
                        <p class="text-justify">
                            Kami adalah perusahaan jasa Outsourcing (Tenaga Alih Daya) yang berkomitmen membantu
                            konsumen berfokus pada bisnis utama mereka dan mencapai efisiensi bisnis melalui layanan
                            terintegrasi. Kami menyediakan One Stop Service di berbagai lokasi seperti rumah, kantor,
                            rumah sakit, sekolah, kampus, tempat ibadah, dan lainnya. Dengan pengembangan sumber daya
                            manusia melalui pengawasan dan pelatihan, kami menawarkan solusi untuk kebutuhan Hospitality
                            Service, Facility Service, Cleaning Service, Security Service, dan Marketing Service. Dengan
                            motto kami “Support Your System”, mencerminkan dedikasi kami dalam memberikan pelayanan
                            terbaik untuk memenuhi kebutuhan Anda.
                        </p>
                        {{-- <ul>
              <li><i class="bi bi-check-circle"></i> <span>Ullamco laboris nisi ut aliquip ex ea commodo consequat.</span></li>
              <li><i class="bi bi-check-circle"></i> <span>Duis aute irure dolor in reprehenderit in voluptate velit.</span></li>
              <li><i class="bi bi-check-circle"></i> <span>Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate trideta storacalaperda mastiro dolore eu fugiat nulla pariatur.</span></li>
            </ul> --}}
                        <a href="#" class="read-more"><span>Selengkapnya</span><i
                                class="bi bi-arrow-right"></i></a>
                    </div>

                    <div class="col-lg-6 about-images" data-aos="fade-up" data-aos-delay="200">
                        <div class="row gy-4">
                            <div class="col-lg-6">
                                <img src="{{ asset('assets/img/about-company-1.jpg') }}" class="img-fluid"
                                    alt="">
                            </div>
                            <div class="col-lg-6">
                                <div class="row gy-4">
                                    <div class="col-lg-12">
                                        <img src="{{ asset('assets/img/about-company-2.jpg') }}" class="img-fluid"
                                            alt="">
                                    </div>
                                    <div class="col-lg-12">
                                        <img src="{{ asset('assets/img/about-company-3.jpg') }}" class="img-fluid"
                                            alt="">
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

            </div>
        </section><!-- /About Section -->

        <!-- Clients Section -->
        <section id="clients" class="clients section">
            <div class="container" data-aos="fade-up" data-aos-delay="100">
                <div class="swiper clients-swiper">
                    <script type="application/json" class="swiper-config">
            {
                "loop": true,
                "speed": 400,
                "autoplay": {
                    "delay": 3000
                },
                "slidesPerView": 4,
                "spaceBetween": 10,
                "pagination": {
                    "el": ".swiper-pagination",
                    "type": "bullets",
                    "clickable": true
                },
                "breakpoints": {
                    "320": { "slidesPerView": 4, "spaceBetween": 10 },
                    "480": { "slidesPerView": 5, "spaceBetween": 15 },
                    "768": { "slidesPerView": 6, "spaceBetween": 20 },
                    "992": { "slidesPerView": 7, "spaceBetween": 25 }
                }
            }
            </script>
                    <div class="swiper-wrapper align-items-center">
                        <div class="swiper-slide client-logo"><img src="assets/img/clients/client-1.webp"
                                class="img-fluid" alt="Client 1"></div>
                        <div class="swiper-slide client-logo"><img src="assets/img/clients/client-2.webp"
                                class="img-fluid" alt="Client 2"></div>
                        <div class="swiper-slide client-logo"><img src="assets/img/clients/client-3.webp"
                                class="img-fluid" alt="Client 3"></div>
                        <div class="swiper-slide client-logo"><img src="assets/img/clients/client-4.webp"
                                class="img-fluid" alt="Client 4"></div>
                        <div class="swiper-slide client-logo"><img src="assets/img/clients/client-5.webp"
                                class="img-fluid" alt="Client 5"></div>
                        <div class="swiper-slide client-logo"><img src="assets/img/clients/client-6.webp"
                                class="img-fluid" alt="Client 6"></div>
                        <div class="swiper-slide client-logo"><img src="assets/img/clients/client-7.webp"
                                class="img-fluid" alt="Client 7"></div>
                        <div class="swiper-slide client-logo"><img src="assets/img/clients/client-8.webp"
                                class="img-fluid" alt="Client 8"></div>
                        <div class="swiper-slide client-logo"><img src="assets/img/clients/client-9.webp"
                                class="img-fluid" alt="Client 9"></div>
                        <div class="swiper-slide client-logo"><img src="assets/img/clients/client-10.webp"
                                class="img-fluid" alt="Client 10"></div>
                        <div class="swiper-slide client-logo"><img src="assets/img/clients/client-11.webp"
                                class="img-fluid" alt="Client 11"></div>
                    </div>
                    <div class="swiper-pagination"></div>
                </div>

            </div>
        </section>
        <!-- /Clients Section -->

        {{-- <!-- Clients Section -->
    <section id="clients" class="clients section">

        <div class="container" data-aos="fade-up" data-aos-delay="100">

          <div class="swiper init-swiper">
            <script type="application/json" class="swiper-config">
              {
                "loop": true,
                "speed": 600,
                "autoplay": {
                  "delay": 5000
                },
                "slidesPerView": "auto",
                "pagination": {
                  "el": ".swiper-pagination",
                  "type": "bullets",
                  "clickable": false
                },
                "breakpoints": {
                  "320": {
                    "slidesPerView": 2,
                    "spaceBetween": 40
                  },
                  "480": {
                    "slidesPerView": 3,
                    "spaceBetween": 60
                  },
                  "640": {
                    "slidesPerView": 4,
                    "spaceBetween": 80
                  },
                  "992": {
                    "slidesPerView": 6,
                    "spaceBetween": 120
                  }
                }
              }
            </script>
            <div class="swiper-wrapper align-items-center">
              <div class="swiper-slide"><img src="assets/img/clients/client-1.webp" class="img-fluid" alt=""></div>
              <div class="swiper-slide"><img src="assets/img/clients/client-2.webp" class="img-fluid" alt=""></div>
              <div class="swiper-slide"><img src="assets/img/clients/client-3.webp" class="img-fluid" alt=""></div>
              <div class="swiper-slide"><img src="assets/img/clients/client-4.webp" class="img-fluid" alt=""></div>
              <div class="swiper-slide"><img src="assets/img/clients/client-5.webp" class="img-fluid" alt=""></div>
              <div class="swiper-slide"><img src="assets/img/clients/client-6.webp" class="img-fluid" alt=""></div>
              <div class="swiper-slide"><img src="assets/img/clients/client-7.webp" class="img-fluid" alt=""></div>
              <div class="swiper-slide"><img src="assets/img/clients/client-8.webp" class="img-fluid" alt=""></div>
              <div class="swiper-slide"><img src="assets/img/clients/client-9.webp" class="img-fluid" alt=""></div>
              <div class="swiper-slide"><img src="assets/img/clients/client-10.webp" class="img-fluid" alt=""></div>
              <div class="swiper-slide"><img src="assets/img/clients/client-11.webp" class="img-fluid" alt=""></div>
            </div>
            <div class="swiper-pagination"></div>
          </div>

        </div>

      </section><!-- /Clients Section --> --}}

        {{-- <!-- Clients Section -->
    <section id="clients" class="clients section">

        <div class="container" data-aos="fade-up">

          <div class="row gy-4">

            <div class="col-xl-2 col-md-3 col-6 client-logo">
              <img src="assets/img/clients/client-1.webp" class="img-fluid" alt="">
            </div><!-- End Client Item -->

            <div class="col-xl-2 col-md-3 col-6 client-logo">
              <img src="assets/img/clients/client-2.webp" class="img-fluid" alt="">
            </div><!-- End Client Item -->

            <div class="col-xl-2 col-md-3 col-6 client-logo">
              <img src="assets/img/clients/client-3.webp" class="img-fluid" alt="">
            </div><!-- End Client Item -->

            <div class="col-xl-2 col-md-3 col-6 client-logo">
              <img src="assets/img/clients/client-4.webp" class="img-fluid" alt="">
            </div><!-- End Client Item -->

            <div class="col-xl-2 col-md-3 col-6 client-logo">
              <img src="assets/img/clients/client-5.webp" class="img-fluid" alt="">
            </div><!-- End Client Item -->

            <div class="col-xl-2 col-md-3 col-6 client-logo">
              <img src="assets/img/clients/client-6.webp" class="img-fluid" alt="">
            </div><!-- End Client Item -->

            <div class="col-xl-2 col-md-3 col-6 client-logo">
                <img src="assets/img/clients/client-7.webp" class="img-fluid" alt="">
              </div><!-- End Client Item -->

            <div class="col-xl-2 col-md-3 col-6 client-logo">
              <img src="assets/img/clients/client-8.webp" class="img-fluid" alt="">
            </div><!-- End Client Item -->

            <div class="col-xl-2 col-md-3 col-6 client-logo">
                <img src="assets/img/clients/client-9.webp" class="img-fluid" alt="">
              </div><!-- End Client Item -->

            <div class="col-xl-2 col-md-3 col-6 client-logo">
                <img src="assets/img/clients/client-10.webp" class="img-fluid" alt="">
            </div><!-- End Client Item -->

            <div class="col-xl-2 col-md-3 col-6 client-logo">
                <img src="assets/img/clients/client-11.webp" class="img-fluid" alt="">
              </div><!-- End Client Item -->
          </div>

        </div>

      </section><!-- /Clients Section --> --}}

        <!-- Features Section -->
        <section id="features" class="features section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up" data-aos-delay="100"">
                <h2>Visi & Misi</h2>
            </div><!-- End Section Title -->

            <div class="container">
                <div class="row justify-content-between">

                    <div class="col-lg-5 d-flex align-items-center">

                        <ul class="nav nav-tabs" data-aos="fade-up" data-aos-delay="100">
                            <li class="nav-item">
                                <a class="nav-link active show" data-bs-toggle="tab"
                                    data-bs-target="#features-tab-1">
                                    <i class="bi bi-binoculars"></i>
                                    <div>
                                        <h4 class="d-none d-lg-block">Menjadi Perusahaan Tenaga Alih Daya Terbaik dan
                                            berkelas Dunia</h4>
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" data-bs-target="#features-tab-2">
                                    <i class="bi bi-box-seam"></i>
                                    <div>
                                        <h4 class="d-none d-lg-block">Memberikan pelayanan memuaskan kepada konsumen
                                            (Customer Satisfaction) dengan menyiapkan tim yang berkualitas.</h4>
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" data-bs-target="#features-tab-2">
                                    <i class="bi bi-box-seam"></i>
                                    <div>
                                        <h4 class="d-none d-lg-block">Bertanggung jawab dalam setiap kepercayaan dan
                                            kesempatan yang diberikan.</h4>
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" data-bs-target="#features-tab-3">
                                    <i class="bi bi-brightness-high"></i>
                                    <div>
                                        <h4 class="d-none d-lg-block">Memberikan pelayanan yang terintegrasi sehingga
                                            membantu konsumen dalam menjalankan perusahaannya.</h4>
                                    </div>
                                </a>
                            </li>
                        </ul><!-- End Tab Nav -->

                    </div>

                    <div class="col-lg-6">

                        <div class="tab-content" data-aos="fade-up" data-aos-delay="200">

                            <div class="tab-pane fade active show" id="features-tab-1">
                                <img src="{{ asset('assets/img/tabs-1.jpg') }}" alt="" class="img-fluid">
                            </div><!-- End Tab Content Item -->

                            <div class="tab-pane fade" id="features-tab-2">
                                <img src="{{ asset('assets/img/tabs-2.jpg') }}" alt="" class="img-fluid">
                            </div><!-- End Tab Content Item -->

                            <div class="tab-pane fade" id="features-tab-3">
                                <img src="{{ asset('assets/img/tabs-3.jpg') }}" alt="" class="img-fluid">
                            </div><!-- End Tab Content Item -->
                        </div>

                    </div>

                </div>

            </div>

        </section><!-- /Features Section -->

        {{-- <!-- Features Details Section -->
    <section id="features-details" class="features-details section">

      <div class="container">

        <div class="row gy-4 justify-content-between features-item">

          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
            <img src="{{asset('assets/img/features-1.jpg')}}" class="img-fluid" alt="">
          </div>

          <div class="col-lg-5 d-flex align-items-center" data-aos="fade-up" data-aos-delay="200">
            <div class="content">
              <h3>Corporis temporibus maiores provident</h3>
              <p>
                Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
                velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident.
              </p>
              <a href="#" class="btn more-btn">Learn More</a>
            </div>
          </div>

        </div><!-- Features Item -->

        <div class="row gy-4 justify-content-between features-item">

          <div class="col-lg-5 d-flex align-items-center order-2 order-lg-1" data-aos="fade-up" data-aos-delay="100">

            <div class="content">
              <h3>Neque ipsum omnis sapiente quod quia dicta</h3>
              <p>
                Quidem qui dolore incidunt aut. In assumenda harum id iusto lorena plasico mares
              </p>
              <ul>
                <li><i class="bi bi-easel flex-shrink-0"></i> Et corporis ea eveniet ducimus.</li>
                <li><i class="bi bi-patch-check flex-shrink-0"></i> Exercitationem dolorem sapiente.</li>
                <li><i class="bi bi-brightness-high flex-shrink-0"></i> Veniam quia modi magnam.</li>
              </ul>
              <p></p>
              <a href="#" class="btn more-btn">Learn More</a>
            </div>

          </div>

          <div class="col-lg-6 order-1 order-lg-2" data-aos="fade-up" data-aos-delay="200">
            <img src="{{asset('assets/img/features-2.jpg')}}" class="img-fluid" alt="">
          </div>

        </div><!-- Features Item -->

      </div>

    </section><!-- /Features Details Section --> --}}

        <!-- Services Section -->
        <section id="services" class="services section light-background">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Layanan</h2>
                <p>Kami menawarkan berbagai solusi untuk Anda yang sedang berusaha mewujudnyatakan visi misi Anda. </p>
            </div><!-- End Section Title -->

            <div class="container">

                <div class="row g-5">

                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                        <div class="service-item item-cyan position-relative">
                            <span class="material-icons icon">
                                cleaning_services
                            </span>
                            <div>
                                <h3>Kebersihan dan Keamanan</h3>
                                <p>Menyediakan seluruh sistem jasa kebersihan dan keamanan yang terencana dan teruji.
                                </p>
                                <a href="" class="read-more stretched-link">Learn More <i
                                        class="bi bi-arrow-right"></i></a>
                            </div>
                        </div>
                    </div><!-- End Service Item -->

                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
                        <div class="service-item item-orange position-relative">
                            <span class="material-icons icon">home_repair_service</span>
                            <div>
                                <h3>Penyedia Tenaga Kerja</h3>
                                <p>Menyediakan tenaga terlatih dengan sistem dan pengaturan yang dikelola secara
                                    langsung.</p>
                                <a href="" class="read-more stretched-link">Learn More <i
                                        class="bi bi-arrow-right"></i></a>
                            </div>
                        </div>
                    </div><!-- End Service Item -->

                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="300">
                        <div class="service-item item-teal position-relative">
                            <span class="material-icons icon">
                                badge
                            </span>
                            <div>
                                <h3>Patroli dan Pengawasan</h3>
                                <p>Menyediakan sistem pengawasan yang terintegrasi guna meningkatkan kualitas
                                    pengawasan.</p>
                                <a href="" class="read-more stretched-link">Learn More <i
                                        class="bi bi-arrow-right"></i></a>
                            </div>
                        </div>
                    </div><!-- End Service Item -->

                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="400">
                        <div class="service-item item-red position-relative">
                            <span class="material-icons icon">
                                supervisor_account
                            </span>
                            <div>
                                <h3>Kepemimpinan Area</h3>
                                <p>Menyediakan pemimpin lapangan (leader) sesuai dengan kebutuhan area atau wilayah
                                    dalam perjanjian yang disepakati.</p>
                                <a href="" class="read-more stretched-link">Learn More <i
                                        class="bi bi-arrow-right"></i></a>
                            </div>
                        </div>
                    </div><!-- End Service Item -->

                    <div class="col-lg-6 mx-auto" data-aos="fade-up" data-aos-delay="600">
                        <div class="service-item item-pink position-relative">
                            <span class="material-icons icon">
                                question_answer
                            </span>
                            <div>
                                <h3>Konsultasi dan Sistem Pelatihan</h3>
                                <p>Menyediakan konsultasi dan sistem pelatihan serta tenaga pelatih secara berkala dan
                                    terprogram.</p>
                                <a href="" class="read-more stretched-link">Learn More <i
                                        class="bi bi-arrow-right"></i></a>
                            </div>
                        </div>
                    </div><!-- End Service Item -->

                </div>

            </div>

        </section><!-- /Services Section -->

        {{-- <!-- More Features Section -->
    <section id="more-features" class="more-features section">

      <div class="container">

        <div class="row justify-content-around gy-4">

          <div class="col-lg-6 d-flex flex-column justify-content-center order-2 order-lg-1" data-aos="fade-up" data-aos-delay="100">
            <h3>Enim quis est voluptatibus aliquid consequatur</h3>
            <p>Esse voluptas cumque vel exercitationem. Reiciendis est hic accusamus. Non ipsam et sed minima temporibus laudantium. Soluta voluptate sed facere corporis dolores excepturi</p>

            <div class="row">

              <div class="col-lg-6 icon-box d-flex">
                <i class="bi bi-easel flex-shrink-0"></i>
                <div>
                  <h4>Lorem Ipsum</h4>
                  <p>Voluptatum deleniti atque corrupti quos dolores et quas molestias </p>
                </div>
              </div><!-- End Icon Box -->

              <div class="col-lg-6 icon-box d-flex">
                <i class="bi bi-patch-check flex-shrink-0"></i>
                <div>
                  <h4>Nemo Enim</h4>
                  <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiise</p>
                </div>
              </div><!-- End Icon Box -->

              <div class="col-lg-6 icon-box d-flex">
                <i class="bi bi-brightness-high flex-shrink-0"></i>
                <div>
                  <h4>Dine Pad</h4>
                  <p>Explicabo est voluptatum asperiores consequatur magnam. Et veritatis odit</p>
                </div>
              </div><!-- End Icon Box -->

              <div class="col-lg-6 icon-box d-flex">
                <i class="bi bi-brightness-high flex-shrink-0"></i>
                <div>
                  <h4>Tride clov</h4>
                  <p>Est voluptatem labore deleniti quis a delectus et. Saepe dolorem libero sit</p>
                </div>
              </div><!-- End Icon Box -->

            </div>

          </div>

          <div class="features-image col-lg-5 order-1 order-lg-2" data-aos="fade-up" data-aos-delay="200">
            <img src="{{asset('assets/img/features-3.jpg')}}" alt="">
          </div>

        </div>

      </div>

    </section><!-- /More Features Section --> --}}

        {{-- <!-- Pricing Section -->
    <section id="pricing" class="pricing section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Pricing</h2>
        <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row gy-4">

          <div class="col-lg-4" data-aos="zoom-in" data-aos-delay="100">
            <div class="pricing-item">
              <h3>Free Plan</h3>
              <p class="description">Ullam mollitia quasi nobis soluta in voluptatum et sint palora dex strater</p>
              <h4><sup>$</sup>0<span> / month</span></h4>
              <a href="#" class="cta-btn">Start a free trial</a>
              <p class="text-center small">No credit card required</p>
              <ul>
                <li><i class="bi bi-check"></i> <span>Quam adipiscing vitae proin</span></li>
                <li><i class="bi bi-check"></i> <span>Nec feugiat nisl pretium</span></li>
                <li><i class="bi bi-check"></i> <span>Nulla at volutpat diam uteera</span></li>
                <li class="na"><i class="bi bi-x"></i> <span>Pharetra massa massa ultricies</span></li>
                <li class="na"><i class="bi bi-x"></i> <span>Massa ultricies mi quis hendrerit</span></li>
                <li class="na"><i class="bi bi-x"></i> <span>Voluptate id voluptas qui sed aperiam rerum</span></li>
                <li class="na"><i class="bi bi-x"></i> <span>Iure nihil dolores recusandae odit voluptatibus</span></li>
              </ul>
            </div>
          </div><!-- End Pricing Item -->

          <div class="col-lg-4" data-aos="zoom-in" data-aos-delay="200">
            <div class="pricing-item featured">
              <p class="popular">Popular</p>
              <h3>Business Plan</h3>
              <p class="description">Ullam mollitia quasi nobis soluta in voluptatum et sint palora dex strater</p>
              <h4><sup>$</sup>29<span> / month</span></h4>
              <a href="#" class="cta-btn">Start a free trial</a>
              <p class="text-center small">No credit card required</p>
              <ul>
                <li><i class="bi bi-check"></i> <span>Quam adipiscing vitae proin</span></li>
                <li><i class="bi bi-check"></i> <span>Nec feugiat nisl pretium</span></li>
                <li><i class="bi bi-check"></i> <span>Nulla at volutpat diam uteera</span></li>
                <li><i class="bi bi-check"></i> <span>Pharetra massa massa ultricies</span></li>
                <li><i class="bi bi-check"></i> <span>Massa ultricies mi quis hendrerit</span></li>
                <li><i class="bi bi-check"></i> <span>Voluptate id voluptas qui sed aperiam rerum</span></li>
                <li class="na"><i class="bi bi-x"></i> <span>Iure nihil dolores recusandae odit voluptatibus</span></li>
              </ul>
            </div>
          </div><!-- End Pricing Item -->

          <div class="col-lg-4" data-aos="zoom-in" data-aos-delay="300">
            <div class="pricing-item">
              <h3>Developer Plan</h3>
              <p class="description">Ullam mollitia quasi nobis soluta in voluptatum et sint palora dex strater</p>
              <h4><sup>$</sup>49<span> / month</span></h4>
              <a href="#" class="cta-btn">Start a free trial</a>
              <p class="text-center small">No credit card required</p>
              <ul>
                <li><i class="bi bi-check"></i> <span>Quam adipiscing vitae proin</span></li>
                <li><i class="bi bi-check"></i> <span>Nec feugiat nisl pretium</span></li>
                <li><i class="bi bi-check"></i> <span>Nulla at volutpat diam uteera</span></li>
                <li><i class="bi bi-check"></i> <span>Pharetra massa massa ultricies</span></li>
                <li><i class="bi bi-check"></i> <span>Massa ultricies mi quis hendrerit</span></li>
                <li><i class="bi bi-check"></i> <span>Voluptate id voluptas qui sed aperiam rerum</span></li>
                <li><i class="bi bi-check"></i> <span>Iure nihil dolores recusandae odit voluptatibus</span></li>
              </ul>
            </div>
          </div><!-- End Pricing Item -->

        </div>

      </div>

    </section><!-- /Pricing Section --> --}}

        <!-- Faq Section -->
        <section id="faq" class="faq section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Frequently Asked Questions</h2>
            </div><!-- End Section Title -->

            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-10" data-aos="fade-up" data-aos-delay="100">

                        <div class="faq-container">

                            <div class="faq-item faq-active">
                                <h3>Apa itu StaffLink?</h3>
                                <div class="faq-content">
                                    <p>StaffLink adalah nama brand dari PT. Cipta Bumi Prawara, perusahaan penyedia
                                        tenaga alih daya (outsourcing) yang berdiri sejak 2021 dan berkomitmen
                                        menyediakan layanan terintegrasi seperti hospitality, cleaning, security,
                                        support, dan marketing service untuk berbagai sektor.</p>
                                </div>
                                <i class="faq-toggle bi bi-chevron-right"></i>
                            </div><!-- End Faq item-->

                            <div class="faq-item">
                                <h3>Layanan apa saja yang disediakan oleh StaffLink?</h3>
                                <div class="faq-content">
                                    <p>StaffLink menyediakan One Stop Service yang mencakup layanan Hospitality,
                                        Facility, Cleaning, Security, Support, dan Marketing Service untuk perkantoran,
                                        rumah sakit, perumahan, sekolah, kampus, tempat ibadah, dan lainnya.</p>
                                </div>
                                <i class="faq-toggle bi bi-chevron-right"></i>
                            </div><!-- End Faq item-->

                            <div class="faq-item">
                                <h3>Bagaimana kualitas dan keamanan tenaga kerja StaffLink?</h3>
                                <div class="faq-content">
                                    <p>StaffLink melatih tenaga kerjanya secara berkala dengan program pelatihan seperti
                                        leadership, excellent service, bela diri, dan lainnya, serta memiliki sistem
                                        pengawasan dan evaluasi rutin untuk memastikan SOP dijalankan dengan baik.</p>
                                </div>
                                <i class="faq-toggle bi bi-chevron-right"></i>
                            </div><!-- End Faq item-->

                            <div class="faq-item">
                                <h3>Apakah StaffLink menyediakan sistem digital untuk monitoring?</h3>
                                <div class="faq-content">
                                    <p>Ya, StaffLink didukung oleh sistem pengawasan dan komunikasi terpadu berbasis
                                        digital yang mempermudah pengontrolan kinerja di lapangan secara online dan
                                        real-time.</p>
                                </div>
                                <i class="faq-toggle bi bi-chevron-right"></i>
                            </div><!-- End Faq item-->

                            <div class="faq-item">
                                <h3>Apa yang membedakan StaffLink dengan penyedia jasa lainnya?</h3>
                                <div class="faq-content">
                                    <p>Keunggulan StaffLink meliputi: pelatihan rutin, pengawasan ketat, biaya
                                        kompetitif, garansi penggantian tenaga kerja dalam 1x24 jam jika tidak sesuai
                                        SOP, dan layanan terpadu yang fleksibel sesuai kebutuhan mitra.</p>
                                </div>
                                <i class="faq-toggle bi bi-chevron-right"></i>
                            </div><!-- End Faq item-->

                            <div class="faq-item">
                                <h3>Apakah StaffLink mendukung program ramah lingkungan?</h3>
                                <div class="faq-content">
                                    <p>Ya, melalui program Green World, StaffLink menggunakan bahan pembersih ramah
                                        lingkungan, hemat penggunaan plastik & kertas, serta berkomitmen terhadap
                                        keselamatan kerja dan kesehatan lingkungan kerja.</p>
                                </div>
                                <i class="faq-toggle bi bi-chevron-right"></i>
                            </div><!-- End Faq item-->

                        </div>
                    </div>
                </div>
            </div>
        </section><!-- End Faq Section -->

        <!-- Testimonials Section -->
        <section id="testimonials" class="testimonials section light-background">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Testimoni</h2>
                <p>Dengarkan apa yang dikatakan mitra kerja kami tentang pengalaman mereka dengan PT Cipta Bumi Prawara
                    (StaffLink)</p>
            </div>
            <!-- End Section Title -->
            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="swiper init-swiper">
                    <script type="application/json" class="swiper-config">
            {
              "loop": true,
              "speed": 600,
              "autoplay": {
                "delay": 5000
              },
              "slidesPerView": "auto",
              "pagination": {
                "el": ".swiper-pagination",
                "type": "bullets",
                "clickable": true
              },
              "breakpoints": {
                "320": {
                  "slidesPerView": 1,
                  "spaceBetween": 40
                },
                "1200": {
                  "slidesPerView": 3,
                  "spaceBetween": 1
                }
              }
            }
          </script>
                    <div class="swiper-wrapper">

                        <div class="swiper-slide">
                            <div class="testimonial-item">
                                <div class="stars">
                                    <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                        class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                        class="bi bi-star-fill"></i>
                                </div>
                                <p>
                                    "Layanan tenaga alih daya dari PT Cipta Bumi Prawara (StaffLink) sangat membantu
                                    kami dalam meningkatkan efisiensi operasional. Tenaga kerja mereka terlatih dan
                                    profesional, sehingga kami dapat fokus pada bisnis utama kami."
                                </p>
                                <div class="profile mt-auto">
                                    <img src="{{ asset('assets/img/testimonials/testimonials-1.jpg') }}"
                                        class="testimonial-img" alt="">
                                    <h3>Andi Prasetyo</h3>
                                    <h4>Manajer Operasional</h4>
                                </div>
                            </div>
                        </div><!-- End testimonial item -->

                        <div class="swiper-slide">
                            <div class="testimonial-item">
                                <div class="stars">
                                    <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                        class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                        class="bi bi-star-fill"></i>
                                </div>
                                <p>
                                    "Pelayanan yang diberikan oleh StaffLink sangat memuaskan. Mereka memiliki sistem
                                    yang terintegrasi dan selalu siap membantu kami dalam berbagai kebutuhan, dari
                                    kebersihan hingga keamanan."
                                </p>
                                <div class="profile mt-auto">
                                    <img src="{{ asset('assets/img/testimonials/testimonials-2.jpg') }}"
                                        class="testimonial-img" alt="">
                                    <h3>Siti Nurhaliza</h3>
                                    <h4>Direktur </h4>
                                </div>
                            </div>
                        </div><!-- End testimonial item -->

                        <div class="swiper-slide">
                            <div class="testimonial-item">
                                <div class="stars">
                                    <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                        class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                        class="bi bi-star-fill"></i>
                                </div>
                                <p>
                                    "StaffLink telah menjadi mitra yang sangat berharga bagi kami. Dengan layanan One
                                    Stop Service mereka, kami dapat menghemat waktu dan biaya, serta meningkatkan
                                    produktivitas tim kami."
                                </p>
                                <div class="profile mt-auto">
                                    <img src="{{ asset('assets/img/testimonials/testimonials-3.jpg') }}"
                                        class="testimonial-img" alt="">
                                    <h3>Budi Santoso</h3>
                                    <h4>CEO Perusahaan</h4>
                                </div>
                            </div>
                        </div><!-- End testimonial item -->


                        <div class="swiper-slide">
                            <div class="testimonial-item">
                                <div class="stars">
                                    <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                        class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                        class="bi bi-star-fill"></i>
                                </div>
                                <p>
                                    "Layanan keamanan dari StaffLink sangat memuaskan. Mereka selalu siap sedia dan
                                    memberikan rasa aman bagi karyawan dan tamu kami. Kami merasa lebih tenang dengan
                                    adanya mereka."
                                </p>
                                <div class="profile mt-auto">
                                    <img src="{{ asset('assets/img/testimonials/testimonials-4.jpg') }}"
                                        class="testimonial-img" alt="">
                                    <h3>Rina Amelia</h3>
                                    <h4>Manajer Keamanan</h4>
                                </div>
                            </div>
                        </div><!-- End testimonial item -->

                        <div class="swiper-slide">
                            <div class="testimonial-item">
                                <div class="stars">
                                    <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                        class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                        class="bi bi-star-fill"></i>
                                </div>
                                <p>
                                    "Pengalaman bekerja dengan PT Cipta Bumi Prawara (StaffLink) sangat memuaskan.
                                    Mereka selalu memberikan solusi yang tepat dan cepat dalam setiap proyek yang kami
                                    jalankan."
                                </p>
                                <div class="profile mt-auto">
                                    <img src="{{ asset('assets/img/testimonials/testimonials-5.jpg') }}"
                                        class="testimonial-img" alt="">
                                    <h3>Sarah Johnson</h3>
                                    <h4>CEO</h4>
                                </div>
                            </div>
                        </div><!-- End testimonial item -->
                    </div>
                    <div class="swiper-pagination"></div>
                </div>

            </div>

        </section><!-- /Testimonials Section -->

        <!-- Contact Section -->
        <section id="contact" class="contact section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Hubungi Kami</h2>
                <p>Silakan hubungi kami untuk informasi lebih lanjut. Kami akan dengan senang hati akan membantu!</p>
            </div><!-- End Section Title -->

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="row gy-4">

                    <div class="col-lg-6">
                        <div class="info-item d-flex flex-column justify-content-center align-items-center"
                            data-aos="fade-up" data-aos-delay="200">
                            <i class="bi bi-geo-alt"></i>
                            <h3>Alamat</h3>
                            <p>Jl. HOS COKROAMINOTO 34 Kel. Jember Kidul, Kec. Kaliwates Kab. Jember</p>
                        </div>
                    </div><!-- End Info Item -->

                    <div class="col-lg-3 col-md-6">
                        <div class="info-item d-flex flex-column justify-content-center align-items-center"
                            data-aos="fade-up" data-aos-delay="300">
                            <i class="bi bi-telephone"></i>
                            <h3>Hubungi Kami</h3>
                            <p>+62 812 31565669</p>
                        </div>
                    </div><!-- End Info Item -->

                    <div class="col-lg-3 col-md-6">
                        <div class="info-item d-flex flex-column justify-content-center align-items-center"
                            data-aos="fade-up" data-aos-delay="400">
                            <i class="bi bi-envelope"></i>
                            <h3>Email Kami</h3>
                            <p>beck.stafflink@gmail.com</p>
                        </div>
                    </div><!-- End Info Item -->

                </div>

                <div class="row gy-4 mt-1">
                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="300">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3753.8852475011786!2d113.6912753!3d-8.173211400000001!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd69418037cd403%3A0x40f23b0c8272d7e2!2sJl.%20HOS%20Cokroaminoto%20No.34%2C%20Kelurahan%20Jember%20Kidu%2C%20Jember%20Kidul%2C%20Kec.%20Kaliwates%2C%20Kabupaten%20Jember%2C%20Jawa%20Timur%2068131!5e1!3m2!1sid!2sid!4v1741915437271!5m2!1sid!2sid"
                            frameborder="0" style="border:0; width: 100%; height: 400px;" allowfullscreen=""
                            loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div><!-- End Google Maps -->

                    <div class="col-lg-6">
                        <form action="forms/contact.php" method="post" class="php-email-form" data-aos="fade-up"
                            data-aos-delay="400">
                            <div class="row gy-4">

                                <div class="col-md-6">
                                    <input type="text" name="name" class="form-control"
                                        placeholder="Your Name" required="">
                                </div>

                                <div class="col-md-6 ">
                                    <input type="email" class="form-control" name="email"
                                        placeholder="Your Email" required="">
                                </div>

                                <div class="col-md-12">
                                    <input type="text" class="form-control" name="subject" placeholder="Subject"
                                        required="">
                                </div>

                                <div class="col-md-12">
                                    <textarea class="form-control" name="message" rows="6" placeholder="Message" required=""></textarea>
                                </div>

                                <div class="col-md-12 text-center">
                                    <div class="loading">Loading</div>
                                    <div class="error-message"></div>
                                    <div class="sent-message">Your message has been sent. Thank you!</div>

                                    <button type="submit">Kirim Pesan</button>
                                </div>

                            </div>
                        </form>
                    </div><!-- End Contact Form -->

                </div>

            </div>

        </section><!-- /Contact Section -->

    </main>

    <footer id="footer" class="footer position-relative light-background">

        <div class="container footer-top">
            <div class="row gy-4">
                <div class="col-lg-4 col-md-6 footer-about">
                    <a href="index.html" class="logo d-flex align-items-center">
                        <img src="{{ asset('assets/img/logo.png') }}" alt="">
                    </a>
                    <div class="footer-contact pt-3">
                        <p>Jl. HOS COKROAMINOTO 34 Kel. Jember Kidul</p>
                        <p>Kec. Kaliwates Kab. Jember</p>
                        <p class="mt-3"><strong>Phone:</strong> <span>+62 812 31565669</span></p>
                        <p><strong>Email:</strong> <span>beck.stafflink@gmail.com</span></p>
                    </div>
                    <div class="social-links d-flex mt-4">
                        <a href=""><i class="bi bi-twitter-x"></i></a>
                        <a href=""><i class="bi bi-facebook"></i></a>
                        <a href=""><i class="bi bi-instagram"></i></a>
                        <a href=""><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>

                <div class="col-lg-2 col-md-3 footer-links">
                    <h4>Menu</h4>
                    <ul>
                        <li><a href="#" class="active">Beranda</a></li>
                        <li><a href="#about">Tentang Kami</a></li>
                        <li><a href="#features">Visi & Misi</a></li>
                        <li><a href="#services">Layanan</a></li>
                        <li><a href="#contact">Hubungi Kami</a></li>
                    </ul>
                </div>

                <div class="col-lg-2 col-md-3 footer-links">
                    <h4>Layana Kami</h4>
                    <ul>
                        <li><a href="#services">Kebersihan dan Keamanan</a></li>
                        <li><a href="#services">Penyedia Tenaga Kerja</a></li>
                        <li><a href="#services">Patroli dan Pengawasan </a></li>
                        <li><a href="#services"> Kepemimpinan Area</a></li>
                        <li><a href="#services">Konsultasi dan Sistem Pelatihan</a></li>
                    </ul>
                </div>

                <div class="col-lg-4 col-md-12 footer-newsletter">
                    <h4>Tentang StaffLink</h4>
                    <p>StaffLink merupakan sarana Outsourcing yang menyediakan layanan rekrutmen dan tenaga kerja
                        profesional di berbagai sektor. Dengan tenaga kerja terlatih dan layanan terintegrasi, kami
                        membantu bisnis lebih fokus dan efisien. “Support Your System” mencerminkan komitmen kami dalam
                        memberikan solusi tenaga kerja berkualitas.</p>
                </div>

                <div class="container copyright text-center mt-4">
                    <p>© <span>Copyright</span> <strong class="px-1 sitename">Stafflink</strong><span>All Rights
                            Reserved</span></p>
                    <div class="credits">
                        Designed by Group 4 Stafflink Politeknik Negeri Jember
                    </div>
                </div>

    </footer>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}" defer></script>
    <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('assets/vendor/aos/aos.js') }}" defer></script>
    <script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}" defer></script>

    <!-- Main JS File -->
    <script src="{{ asset('assets/js/main.js') }}"></script>

</body>

</html>
