<!DOCTYPE html>
<html lang="bn">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bar Association & Lawyer Directory </title>

    <link rel="icon" type="image/png" href="{{ asset('frontend/images/favicon.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('frontend/images/logo.png') }}">

    <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link href="{{ asset('frontend/css/style.css') }}" rel="stylesheet">

    <!-- +++++++++++++++++++++++++++++++++++++++++++
        Design and Development by Ali Hasan
        Contact: 01723629080
        softqry.com
        +++++++++++++++++++++++++++++++++++++++ -->
</head>


<body>

    <nav class="navbar navbar-expand-lg navbar-dark sticky-top shadow">
        <div class="container">
            <!-- <a class="navbar-brand fw-bold logo" href="#">
                <img src="/assets/images/logo.png" alt="">
            </a> -->
            <a class="navbar-brand fw-bold fs-3" href="/" style="font-family: 'Playfair Display', serif;">
                <i class="fas fa-gavel me-2" style="color:#eaedf0;"></i>Lawyers
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link px-3" href="/">Home</a></li>
                    <li class="nav-item"><a class="nav-link px-3" href="/org.html">ORG</a></li>
                    <li class="nav-item"><a class="nav-link px-3" href="/lawyers.html">Lawyers</a></li>
                    <li class="nav-item"><a class="nav-link px-3" href="/payments.html">Payments</a></li>
                    <li class="nav-item"><a class="nav-link px-3" href="/notices.html">Notice</a></li>
                    <li class="nav-item"><a class="nav-link px-3" href="/contact.html">Contact</a></li>
                    <li class="nav-item ms-lg-3"><a class="btn btn-custom" href="#"><i
                                class="fa-solid fa-user-plus me-1"></i> Join Association</a></li>
                </ul>
            </div>
        </div>
    </nav>


    {{-- ------------content part-------------- --}}
    @yield('content')
    {{-- ------------content part-------------- --}}

    <footer class="main-footer" id="footer">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-4">
                    <h4 class="footer-title mb-4">Contacts</h4>jaleswaritola, Bogra Sadar, Bogra</p>
                    <p><i class="fa-solid fa-envelope me-2 text-warning"></i> Email: info@layers.org.bd</p>
                    <p><i class="fa-solid fa-phone me-2 text-warning"></i> Helpline: 01700 000000</p>
                    <div class="social-icons mt-4">
                        <a href="#" class="me-3"><i class="fa-brands fa-facebook"></i></a>
                        <a href="#" class="me-3"><i class="fa-brands fa-youtube"></i></a>
                        <a href="#"><i class="fa-brands fa-whatsapp"></i></a>
                    </div>
                </div>

                <div class="col-md-2">
                    <h4 class="footer-title mb-4">Services</h4>
                    <ul class="list-unstyled">
                        <li><a href="#"><i class="fa-solid fa-chevron-right small me-2 text-warning"></i>Legal
                                Assistance</a></li>
                        <li><a href="#"><i class="fa-solid fa-chevron-right small me-2 text-warning"></i>Application</a>
                        </li>
                        <li><a href="#"><i class="fa-solid fa-chevron-right small me-2 text-warning"></i>Welfare
                                Fund</a></li>
                    </ul>
                </div>

                <div class="col-md-2">
                    <h4 class="footer-title mb-4">Info</h4>
                    <ul class="list-unstyled">
                        <li><a href="#"><i class="fa-solid fa-chevron-right small me-2 text-warning"></i>Our Mission</a>
                        </li>
                        <li><a href="#"><i class="fa-solid fa-chevron-right small me-2 text-warning"></i>Contact</a>
                        </li>
                        <li><a href="#"><i
                                    class="fa-solid fa-chevron-right small me-2 text-warning"></i>Constitution</a></li>
                    </ul>
                </div>

                <div class="col-md-4">
                    <h4 class="footer-title mb-4">Location (Map)</h4>
                    <div class="map-container shadow-sm">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3618.944646549247!2d89.3614!3d24.8481!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39fc54e604f385c7%3A0xc39352e698e69888!2sBogra%20Central%20Bus%20Terminal!5e0!3m2!1sen!2sbd!4v1700000000000!5m2!1sen!2sbd"
                            width="100%" height="180" allowfullscreen="" loading="lazy">
                        </iframe>
                    </div>
                </div>
            </div>
            <hr class="mt-5 opacity-25">
            <p class="text-center mb-0 mt-4 small text-secondary">
                &copy; 2026 Bogura Bar Association। Development by <b><a href="https://softqry.com/">SOFT
                        QUERY</a></b>
            </p>
        </div>
    </footer>

    <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('jquery/jquery-3.7.1.min.js') }} "></script>
</body>

</html>
