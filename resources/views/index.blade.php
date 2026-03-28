@extends('layouts.app')

@section('styles')
    <style>
        .custom-shape {
            border-top-left-radius: 120px;
            border-bottom-right-radius: 120px;
            border-top-right-radius: 20px;
            border-bottom-left-radius: 20px;
            object-fit: cover;
            width: 100%;
            max-width: 400px;
            height: auto;
        }

        .cards-1 {
            padding-top: 5rem;
            padding-bottom: 5rem;
        }

        .cards-1 .text-container h2 {
            margin-bottom: 1.5rem;
        }

        .cards-1 .list-unstyled .fas {
            color: #007bff;
            font-size: 0.875rem;
            line-height: 1.75rem;
            margin-right: 0.5rem;
        }

        .cards-1 .card-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1.5rem;
        }

        .cards-1 .card-item {
            background-color: #fff;
            padding: 1.5rem 1rem;
            border-radius: 0.5rem;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease-out;
            cursor: pointer;
            height: 100%;
        }

        .cards-1 .card-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .cards-1 .icon-box {
            width: 70px;
            height: 70px;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .cards-1 .icon-box img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }

        .cards-1 .card-title {
            margin-bottom: 0;
            font-size: 0.9rem;
            line-height: 1.3rem;
            font-weight: 600;
            color: #1e293b;
        }

        @media (max-width: 1200px) {
            .cards-1 .card-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        @media (max-width: 991px) {
            .cards-1 .card-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 767px) {
            .cards-1 .card-grid {
                grid-template-columns: 1fr;
            }
        }

        .flag-icon {
            display: inline-block;
            border-radius: 3px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        a.btn-outline-sm.dropdown-toggle {
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .dropdown-toggle::after {
            display: inline-block;
            margin-left: 0.5em;
            vertical-align: middle;
            content: "";
            border-top: 0.3em solid;
            border-right: 0.3em solid transparent;
            border-bottom: 0;
            border-left: 0.3em solid transparent;
            opacity: 0.7;
        }

        .dropdown-item.active {
            background-color: #f8f9fa;
            color: #0d6efd;
            font-weight: 500;
        }

        .dropdown-item:hover {
            background-color: #f8f9fa;
        }

        .dropdown-item {
            display: flex;
            align-items: center;
            padding: 0.5rem 1rem;
            font-size: 0.9rem;
        }

        .dropdown-item .flag-icon {
            margin-right: 8px;
        }

        .auth-container {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-wrap: nowrap;
        }

        .auth-btn {
            padding: 8px 16px !important;
            font-size: 13px !important;
            font-weight: 600;
            border-radius: 20px !important;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            min-width: fit-content;
            white-space: nowrap;
            transition: all 0.3s ease;
            text-decoration: none !important;
        }

        [lang="uz"] .auth-btn {
            font-size: 10px !important;
            padding: 7px 10px !important;
        }

        @media (max-width: 991px) {
            .auth-container {
                flex-direction: column;
                align-items: stretch;
            }

            .auth-btn {
                margin: 4px 0;
                width: 100%;
            }
        }

        .btn-login-custom {
            border: 1px solid #eb427e !important;
            color: #ffffff !important;
            background-color: #eb427e !important;
        }

        .btn-login-custom:hover,
        .btn-login-custom:active {
            background-color: #ffffff !important;
            color: #eb427e !important;
            text-decoration: none !important;
        }

        .btn-signup-custom {
            background-color: #eb427e !important;
            border: 1px solid #eb427e !important;
            color: #fff !important;
        }

        .btn-signup-custom:hover,
        .btn-signup-custom:active {
            background-color: transparent !important;
            color: #eb427e !important;
            text-decoration: none !important;
        }

        .navbar-nav .nav-link {
            padding-right: 0.8rem !important;
            padding-left: 0.8rem !important;
        }

        .auth-btn {
            min-width: 80px !important;
            padding: 6px 12px !important;
            font-size: 12px !important;
        }

        @media (min-width: 1200px) {
            .container {
                max-width: 1300px;
            }
        }

        [lang="uz"] .auth-btn {
            font-size: 11px !important;
        }

        @media (min-width: 1200px) {
            .container {
                max-width: 1350px !important;
            }
        }

        .navbar-nav .nav-link {
            padding-right: 12px !important;
            padding-left: 12px !important;
            font-size: 15px;
        }

        .auth-container {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .auth-btn {
            min-width: 85px !important;
            padding: 6px 12px !important;
            font-size: 13px !important;
            white-space: nowrap;
        }

        .navbar-collapse {
            justify-content: space-between;
        }

        .card-link {
            text-decoration: none;
            color: inherit;
            display: block;
            cursor: pointer;
        }
    </style>
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/swiper.min.js') }}"></script>
    <script src="{{ asset('js/purecounter.min.js') }}"></script>
    <script src="{{ asset('js/scripts.js') }}"></script>
    <script>
        $(document).ready(function () {
            $("#contactForm").submit(function (e) {
                e.preventDefault()
                var form = $(this)
                $.ajax({
                    url: '/contact-send',
                    type: "POST",
                    data: form.serialize(),
                    success: function (result) {
                        Swal.fire({
                            icon: 'success',
                            toast: true,
                            position: 'top-end',
                            title: result.message,
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            background: '#d3fddd',
                            color: '#000000'
                        })
                        form[0].reset();
                    },
                    error: function (data) {
                        let message = "Xatolik yuz berdi!";
                        if (data.responseJSON && data.responseJSON.message) {
                            message = data.responseJSON.message;
                        }
                        Swal.fire({
                            icon: 'error',
                            toast: true,
                            position: 'top-end',
                            title: message,
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            background: '#fdd3d6',
                            color: '#000000'
                        })
                    }
                })
            })
        })
    </script>
@endsection

@section('content')
    <!-- Header -->
    <header id="header" class="header">
        <img class="decoration-star" src="{{ asset('images/decoration-star.svg') }}" alt="alternative">
        <img class="decoration-star-2" src="{{ asset('images/decoration-star.svg') }}" alt="alternative">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-xl-5">
                    <div class="text-container">
                        <h1 class="h1-large">{{ __('messages.header_title') }}</h1>
                        <p class="p-large">{{ __('messages.header_description') }}</p>
                        <a class="btn-solid-lg" href="#introduction">{{ __('messages.learn_more') }}</a>
                        <a class="btn-outline-lg" href="#contact">{{ __('messages.contact') }}</a>
                    </div>
                </div>
                <div class="col-lg-5 col-xl-7">
                    <div class="image-container">
                        <img class="img-fluid rounded-img p-5" src="{{ asset('images/menu1.png') }}" alt="alternative">
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Statistics -->
    <div class="counter">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="counter-container">
                        <div class="counter-cell">
                            <div data-purecounter-start="0" data-purecounter-end="1200" data-purecounter-duration="3"
                                class="purecounter">0</div>
                            <div class="counter-info">{{ __('messages.graduates') }}</div>
                        </div>
                        <div class="counter-cell">
                            <div data-purecounter-start="0" data-purecounter-end="45" data-purecounter-duration="2"
                                class="purecounter">0</div>
                            <div class="counter-info">{{ __('messages.active_courses') }}</div>
                        </div>
                        <div class="counter-cell">
                            <div data-purecounter-start="0" data-purecounter-end="320" data-purecounter-duration="3"
                                class="purecounter">0</div>
                            <div class="counter-info">{{ __('messages.employed_students') }}</div>
                        </div>
                        <div class="counter-cell">
                            <div data-purecounter-start="0" data-purecounter-end="5" data-purecounter-duration="2"
                                class="purecounter">0</div>
                            <div class="counter-info">{{ __('messages.years_experience') }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Introduction -->
    <div id="introduction" class="basic-1 bg-gray">
        <div class="container">
            <div class="row">
                <div class="col-xl-9">
                    <h2>{{ __('messages.intro_title') }}</h2>
                    <p>{{ __('messages.intro_description') }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Details 1 -->
    <div id="details" class="basic-2">
        <img class="decoration-star" src="{{ asset('images/decoration-star.svg') }}" alt="alternative">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-xl-5">
                    <div class="image-container">
                        <img class="img-fluid rounded-img" src="{{ asset('images/itech.jpg') }}" alt="iTech o'quv jarayoni">
                    </div>
                </div>
                <div class="col-lg-6 col-xl-7">
                    <div class="text-container">
                        <h2>{{ __('messages.details1_title') }}</h2>
                        <ul class="list-unstyled li-space-lg">
                            <li class="d-flex"><i class="fas fa-square"></i>
                                <div class="flex-grow-1">{{ __('messages.details1_item1') }}</div>
                            </li>
                            <li class="d-flex"><i class="fas fa-square"></i>
                                <div class="flex-grow-1">{{ __('messages.details1_item2') }}</div>
                            </li>
                            <li class="d-flex"><i class="fas fa-square"></i>
                                <div class="flex-grow-1">{{ __('messages.details1_item3') }}</div>
                            </li>
                            <li class="d-flex"><i class="fas fa-square"></i>
                                <div class="flex-grow-1">{{ __('messages.details1_item4') }}</div>
                            </li>
                        </ul>
                        <a class="btn-solid-reg" href="#services">{{ __('messages.start_course') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Services / Courses - 12 TA KURS -->
    <div id="services" class="cards-1 bg-gray">
        <div class="container">
            <div class="row align-items-start">
                <div class="col-lg-5">
                    <div class="text-container">
                        <h2>{{ __('messages.our_courses') }}</h2>
                        <p>{{ __('messages.courses_desc1') }}</p>
                        <p>{{ __('messages.courses_desc2') }}</p>
                        <ul class="list-unstyled li-space-lg">
                            <li class="d-flex"><i class="fas fa-square"></i>
                                <div class="flex-grow-1">{{ __('messages.courses_item1') }}</div>
                            </li>
                            <li class="d-flex"><i class="fas fa-square"></i>
                                <div class="flex-grow-1">{{ __('messages.courses_item2') }}</div>
                            </li>
                            <li class="d-flex"><i class="fas fa-square"></i>
                                <div class="flex-grow-1">{{ __('messages.courses_item3') }}</div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="card-grid">
                        <!-- 1. Ofis menejerligi -->
                        <a href="/courses/office" class="card-link">
                            <div class="card-item">
                                <div class="icon-box"><img src="https://cdn-icons-png.flaticon.com/512/2721/2721292.png"
                                        alt="Ofis menejerligi"></div>
                                <h5 class="card-title">Ofis menejerligi</h5>
                            </div>
                        </a>
                        <!-- 2. Algoritm asoslari -->
                        <a href="/courses/algorithm" class="card-link">
                            <div class="card-item">
                                <div class="icon-box"><img src="https://cdn-icons-png.flaticon.com/512/1995/1995530.png"
                                        alt="Algoritm"></div>
                                <h5 class="card-title">Algoritm asoslari</h5>
                            </div>
                        </a>
                        <!-- 3. Frontend -->
                        <a href="{{ route('courses.frontend') }}" class="card-link">
                            <div class="card-item">
                                <div class="icon-box"><img
                                        src="https://us.123rf.com/450wm/dxinerz/dxinerz1601/dxinerz160103363/51258851-code-seo-web-symbol-vektor-bild-kann-auch-f%C3%BCr-seo-und-entwicklungsdienste-verwendet-werden.jpg?ver=6"
                                        alt="Frontend"></div>
                                <h5 class="card-title">Frontend</h5>
                            </div>
                        </a>
                        <!-- 4. Backend -->
                        <a href="{{ route('courses.backend') }}" class="card-link">
                            <div class="card-item">
                                <div class="icon-box"><img
                                        src="https://www.shutterstock.com/image-vector/backend-developer-icon-mixed-vector-600nw-2655399835.jpg"
                                        alt="Backend"></div>
                                <h5 class="card-title">Backend</h5>
                            </div>
                        </a>
                        <!-- 5. Python -->
                        <a href="{{ route('courses.python') }}" class="card-link">
                            <div class="card-item">
                                <div class="icon-box"><img
                                        src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/c3/Python-logo-notext.svg/1280px-Python-logo-notext.svg.png"
                                        alt="Python"></div>
                                <h5 class="card-title">Python</h5>
                            </div>
                        </a>
                        <!-- 6. Robototexnika -->
                        <a href="/courses/robotics" class="card-link">
                            <div class="card-item">
                                <div class="icon-box"><img src="https://cdn-icons-png.flaticon.com/512/1998/1998178.png"
                                        alt="Robototexnika"></div>
                                <h5 class="card-title">Robototexnika</h5>
                            </div>
                        </a>
                        <!-- 7. Raqamli bolalar -->
                        <a href="/courses/digital-kids" class="card-link">
                            <div class="card-item">
                                <div class="icon-box"><img src="https://cdn-icons-png.flaticon.com/512/3688/3688127.png"
                                        alt="Raqamli bolalar"></div>
                                <h5 class="card-title">Raqamli bolalar</h5>
                            </div>
                        </a>
                        <!-- 8. Tizim muhandisligi -->
                        <a href="/courses/system-engineering" class="card-link">
                            <div class="card-item">
                                <div class="icon-box"><img src="https://cdn-icons-png.flaticon.com/512/1055/1055687.png"
                                        alt="Tizim muhandisligi"></div>
                                <h5 class="card-title">Tizim muhandisligi</h5>
                            </div>
                        </a>
                        <!-- 9. DevOps asoslari -->
                        <a href="/courses/devops" class="card-link">
                            <div class="card-item">
                                <div class="icon-box"><img src="https://cdn-icons-png.flaticon.com/512/919/919851.png"
                                        alt="DevOps"></div>
                                <h5 class="card-title">DevOps asoslari</h5>
                            </div>
                        </a>
                        <!-- 10. Data analitika -->
                        <a href="/courses/data-analytics" class="card-link">
                            <div class="card-item">
                                <div class="icon-box"><img src="https://cdn-icons-png.flaticon.com/512/1055/1055685.png"
                                        alt="Data analitika"></div>
                                <h5 class="card-title">Data analitika</h5>
                            </div>
                        </a>
                        <!-- 11. Tarmoq administratorligi -->
                        <a href="/courses/network-admin" class="card-link">
                            <div class="card-item">
                                <div class="icon-box"><img src="https://cdn-icons-png.flaticon.com/512/2240/2240419.png"
                                        alt="Tarmoq"></div>
                                <h5 class="card-title">Tarmoq administratorligi</h5>
                            </div>
                        </a>
                        <!-- 12. Buxgalteriya -->
                        <a href="/courses/accounting" class="card-link">
                            <div class="card-item">
                                <div class="icon-box"><img src="https://cdn-icons-png.flaticon.com/512/2331/2331966.png"
                                        alt="Buxgalteriya"></div>
                                <h5 class="card-title">Buxgalteriya</h5>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Details 2 -->
    <div class="basic-3">
        <img class="decoration-star" src="{{ asset('images/decoration-star.svg') }}" alt="alternative">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-xl-7">
                    <div class="text-container">
                        <h2>{{ __('messages.details2_title') }}</h2>
                        <p>{{ __('messages.details2_description') }}</p>
                        <a class="btn-solid-reg" href="{{ route('career.index') }}">{{ __('messages.start') }}</a>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-5">
                    <div class="image-container">
                        <img class="img-fluid custom-shape" src="{{ asset('images/human1.png') }}" alt="alternative">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Invitation -->
    <div class="basic-4 bg-gray">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h4>{{ __('messages.invitation_text') }}</h4>
                    <a class="btn-solid-lg" href="#contact">{{ __('messages.learn_more') }}</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Projects -->
    <div id="projects" class="cards-2">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="h2-heading">{{ __('messages.projects_title') }}</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                   <div class="card" style="border: 2px solid #000; border-radius: 12px; overflow: hidden;"> <img
                            class="img-fluid w-100" src="{{ asset('images/wasteles.png') }}" alt="Delever">
                        <div class="card-body p-4">
                            <h5 class="card-title fw-bold mb-2"> @lang('messages.project5_title') </h5>
                            <p class="card-text text-secondary"> @lang('messages.project5_desc') <a
                                    class="text-primary text-decoration-none fw-semibold" href="article.html">
                                    @lang('messages.read_more') </a> </p>
                        </div>
                    </div>
                    <div class="card" style="border: 2px solid #000; border-radius: 12px; overflow: hidden;"> <img
                            class="img-fluid w-100" src="{{ asset('images/delever.png') }}" alt="Delever">
                        <div class="card-body p-4">
                            <h5 class="card-title fw-bold mb-2"> @lang('messages.project2_title') </h5>
                            <p class="card-text text-secondary"> @lang('messages.project2_desc') <a
                                    class="text-primary text-decoration-none fw-semibold" href="article.html">
                                    @lang('messages.read_more') </a> </p>
                        </div>
                    </div>
                    <div class="card" style="border: 2px solid #000; border-radius: 12px; overflow: hidden;"> <img
                            class="img-fluid w-100" src="{{ asset('images/kidi.png') }}" alt="Delever">
                        <div class="card-body p-4">
                            <h5 class="card-title fw-bold mb-2"> @lang('messages.project3_title') </h5>
                            <p class="card-text text-secondary"> @lang('messages.project3_desc') <a
                                    class="text-primary text-decoration-none fw-semibold" href="article.html">
                                    @lang('messages.read_more') </a> </p>
                        </div>
                    </div>
                    <div class="card" style="border: 2px solid #000; border-radius: 12px; overflow: hidden;"> <img
                            class="img-fluid w-100" src="{{ asset('images/growz.png') }}" alt="Delever">
                        <div class="card-body p-4">
                            <h5 class="card-title fw-bold mb-2"> @lang('messages.project4_title') </h5>
                            <p class="card-text text-secondary"> @lang('messages.project4_desc') <a
                                    class="text-primary text-decoration-none fw-semibold" href="article.html">
                                    @lang('messages.read_more') </a> </p>
                        </div>
                    </div>
                   <div class="card" style="border: 2px solid #000; border-radius: 12px; overflow: hidden;"> <img
                            class="img-fluid w-100" src="{{ asset('images/iqro.png') }}" alt="Delever">
                        <div class="card-body p-4">
                            <h5 class="card-title fw-bold mb-2"> @lang('messages.project1_title') </h5>
                            <p class="card-text text-secondary"> @lang('messages.project1_desc') <a
                                    class="text-primary text-decoration-none fw-semibold" href="article.html">
                                    @lang('messages.read_more') </a> </p>
                        </div>
                    </div>
                    <div class="card" style="border: 2px solid #000; border-radius: 12px; overflow: hidden;"> <img
                            class="img-fluid w-100" src="{{ asset('images/urecruit.png') }}" alt="Delever">
                        <div class="card-body p-4">
                            <h5 class="card-title fw-bold mb-2"> @lang('messages.project6_title') </h5>
                            <p class="card-text text-secondary"> @lang('messages.project6_desc') <a
                                    class="text-primary text-decoration-none fw-semibold" href="article.html">
                                    @lang('messages.read_more') </a> </p>
                        </div>
                    </div>\
                </div>
            </div>
        </div>
    </div>

    <!-- Testimonials -->
    <div class="slider-1 bg-gray">
        <img class="quotes-decoration" src="{{ asset('images/quotes.svg') }}" alt="alternative">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="slider-container">
                        <div class="swiper-container card-slider">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide"><img class="testimonial-image"
                                        src="{{ asset('images/testimonial-1.jpg') }}" alt="alternative">
                                    <p class="testimonial-text">“Expense bed any sister depend changer off piqued one.
                                        Contented continued any happiness instantly objection yet her allowance. Use correct
                                        day new brought tedious. By come this been in. Kept easy or sons my it how about
                                        some words here done”</p>
                                    <div class="testimonial-author">{{ __('messages.testimonial_author1') }}</div>
                                    <div class="testimonial-position">{{ __('messages.testimonial_position1') }}</div>
                                </div>
                                <div class="swiper-slide"><img class="testimonial-image"
                                        src="{{ asset('images/testimonial-2.jpg') }}" alt="alternative">
                                    <p class="testimonial-text">“Expense bed any sister depend changer off piqued one.
                                        Contented continued any happiness instantly objection yet her allowance. Use correct
                                        day new brought tedious. By come this been in. Kept easy or sons my it how about
                                        some words here done”</p>
                                    <div class="testimonial-author">{{ __('messages.testimonial_author2') }}</div>
                                    <div class="testimonial-position">{{ __('messages.testimonial_position2') }}</div>
                                </div>
                                <div class="swiper-slide"><img class="testimonial-image"
                                        src="{{ asset('images/testimonial-3.jpg') }}" alt="alternative">
                                    <p class="testimonial-text">“Expense bed any sister depend changer off piqued one.
                                        Contented continued any happiness instantly objection yet her allowance. Use correct
                                        day new brought tedious. By come this been in. Kept easy or sons my it how about
                                        some words here done”</p>
                                    <div class="testimonial-author">{{ __('messages.testimonial_author3') }}</div>
                                    <div class="testimonial-position">{{ __('messages.testimonial_position3') }}</div>
                                </div>
                            </div>
                            <div class="swiper-button-next"></div>
                            <div class="swiper-button-prev"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Contact -->
    <div id="contact" class="form-1">
        <img class="decoration-star" src="{{ asset('images/decoration-star.svg') }}" alt="alternative">
        <img class="decoration-star-2" src="{{ asset('images/decoration-star.svg') }}" alt="alternative">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="image-container"><img class="img-fluid" src="{{ asset('images/contact.png') }}"
                            alt="alternative"></div>
                </div>
                <div class="col-lg-6">
                    <div class="text-container">
                        <h2>{{ __('messages.contact_title') }}</h2>
                        <form id="contactForm">
                            @csrf
                            <div class="form-group"><input type="text" name="name" class="form-control-input"
                                    placeholder="{{ __('messages.your_name') }}" required></div>
                            <div class="form-group"><input type="email" name="email" class="form-control-input"
                                    placeholder="{{ __('messages.email') }}" required></div>
                            <div class="form-group"><textarea name="message" class="form-control-textarea"
                                    placeholder="{{ __('messages.message') }}" required></textarea></div>
                            @if(session('success'))
                                <div
                                    style="background-color: #d4edda; color: #155724; padding: 15px; border-radius: 5px; margin-bottom: 20px;">
                            {{ session('success') }}</div>@endif
                            <div class="form-group"><button type="submit"
                                    class="form-control-submit-button">{{ __('messages.send') }}</button></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection