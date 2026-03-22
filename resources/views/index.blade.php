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

    /* Kartaning umumiy ko'rinishi */
    .cards-1 {
        padding-top: 5rem;
        padding-bottom: 5rem;
    }

    /* Matn qismi uchun */
    .cards-1 .text-container h2 {
        margin-bottom: 1.5rem;
    }

    .cards-1 .list-unstyled .fas {
        color: #007bff;
        font-size: 0.875rem;
        line-height: 1.75rem;
        margin-right: 0.5rem;
    }

    /* Karta panjarasi (Grid) - 3 ta ustun */
    .cards-1 .card-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 2rem;
    }

    /* Har bir karta elementi */
    .cards-1 .card-item {
        background-color: #fff;
        padding: 2.5rem 1.5rem;
        border-radius: 0.5rem;
        text-align: center;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    /* Belgilar qutisi (Icon box) */
    .cards-1 .icon-box {
        width: 80px;
        height: 80px;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* Ikonalar tasvirlari */
    .cards-1 .icon-box img {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
    }

    /* Karta sarlavhasi */
    .cards-1 .card-title {
        margin-bottom: 0;
        font-size: 1.125rem;
        line-height: 1.5rem;
    }

    .cards-1 .card-item {
        transition: all 0.3s ease-out;
    }

    .cards-1 .card-item:hover {
        transform: scale(1.05);
    }

    /* Kichik ekranlar uchun moslashuvchanlik */
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
    
    /* Language Switcher Styles */
    .flag-icon {
        display: inline-block;
        border-radius: 3px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
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

    /* Auth konteyneri uchun */
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

    .btn-login-custom:hover, .btn-login-custom:active {
        background-color: #ffffff !important;
        color: #eb427e !important;
        text-decoration: none !important;
    }

    .btn-signup-custom {
        background-color: #eb427e !important;
        border: 1px solid #eb427e !important;
        color: #fff !important;
    }

    .btn-signup-custom:hover, .btn-signup-custom:active {
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

    /* Стили для ссылок карточек */
    .card-link {
        text-decoration: none;
        color: inherit;
        display: block;
        cursor: pointer;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card-link:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }

    .card-item {
        background: #fff;
        border-radius: 8px;
        padding: 20px;
        text-align: center;
        height: 100%;
    }

    .icon-box {
        margin-bottom: 15px;
    }

    .icon-box img {
        width: 80px;
        height: 80px;
        object-fit: contain;
        cursor: pointer;
    }

    .card-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
    }

    @media (max-width: 768px) {
        .card-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 480px) {
        .card-grid {
            grid-template-columns: 1fr;
        }
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
            var url = form.attr("action")

            $.ajax({
                url: '/contact-send',
                type: "POST",
                data: form.serialize(),
                success: function (result) {
                    console.log(result)
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
                    <p class="p-large">
                        {{ __('messages.header_description') }}
                    </p>
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
                        <li class="d-flex">
                            <i class="fas fa-square"></i>
                            <div class="flex-grow-1">{{ __('messages.details1_item1') }}</div>  
                        </li>
                        <li class="d-flex">
                            <i class="fas fa-square"></i>
                            <div class="flex-grow-1">{{ __('messages.details1_item2') }}</div>
                        </li>
                        <li class="d-flex">
                            <i class="fas fa-square"></i>
                            <div class="flex-grow-1">{{ __('messages.details1_item3') }}</div>
                        </li>
                        <li class="d-flex">
                            <i class="fas fa-square"></i>
                            <div class="flex-grow-1">{{ __('messages.details1_item4') }}</div>
                        </li>
                    </ul>
                    <a class="btn-solid-reg" href="#services">{{ __('messages.start_course') }}</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Services / Courses -->
<div id="services" class="cards-1 bg-gray">
    <div class="container">
        <div class="row align-items-start">
            <div class="col-lg-5">
                <div class="text-container">
                    <h2>{{ __('messages.our_courses') }}</h2>
                    <p>{{ __('messages.courses_desc1') }}</p>
                    <p>{{ __('messages.courses_desc2') }}</p>
                    <ul class="list-unstyled li-space-lg">
                        <li class="d-flex">
                            <i class="fas fa-square"></i>
                            <div class="flex-grow-1">{{ __('messages.courses_item1') }}</div>
                        </li>
                        <li class="d-flex">
                            <i class="fas fa-square"></i>
                            <div class="flex-grow-1">{{ __('messages.courses_item2') }}</div>
                        </li>
                        <li class="d-flex">
                            <i class="fas fa-square"></i>
                            <div class="flex-grow-1">{{ __('messages.courses_item3') }}</div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="card-grid">
                    <a href="{{ route('courses.python') }}" class="card-link">
                        <div class="card-item">
                            <div class="icon-box">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/c3/Python-logo-notext.svg/1280px-Python-logo-notext.svg.png" alt="Python logo">
                            </div>
                            <h5 class="card-title">{{ __('messages.python') }}</h5>
                        </div>
                    </a>

                    <a href="/courses/computer-literacy" class="card-link">
                        <div class="card-item">
                            <div class="icon-box">
                                <img src="https://img.freepik.com/premium-vector/digital-precision-designing-modern-computer-logos-innovative-tech-branding_579306-22156.jpg?semt=ais_rp_50_assets&w=740&q=80" alt="Computer literacy logo">
                            </div>
                            <h5 class="card-title">{{ __('messages.computer_literacy') }}</h5>
                        </div>
                    </a>

                    <a href="{{ route('courses.frontend') }}" class="card-link">
                        <div class="card-item">
                            <div class="icon-box">
                                <img src="https://us.123rf.com/450wm/dxinerz/dxinerz1601/dxinerz160103363/51258851-code-seo-web-symbol-vektor-bild-kann-auch-f%C3%BCr-seo-und-entwicklungsdienste-verwendet-werden.jpg?ver=6" alt="Frontend development logo">
                            </div>
                            <h5 class="card-title">{{ __('messages.frontend') }}</h5>
                        </div>
                    </a>

                    <a href="/courses/backend" class="card-link">
                        <div class="card-item">
                            <div class="icon-box">
                                <img src="https://www.shutterstock.com/image-vector/backend-developer-icon-mixed-vector-600nw-2655399835.jpg" alt="Backend development logo">
                            </div>
                            <h5 class="card-title">{{ __('messages.backend') }}</h5>
                        </div>
                    </a>

                    <a href="/courses/cybersecurity" class="card-link">
                        <div class="card-item">
                            <div class="icon-box">
                                <img src="https://img.icons8.com/sci-fi/1200/cyber-security.jpg" alt="Cybersecurity logo">
                            </div>
                            <h5 class="card-title">{{ __('messages.cybersecurity') }}</h5>
                        </div>
                    </a>

                    <a href="/courses/ai-developer" class="card-link">
                        <div class="card-item">
                            <div class="icon-box">
                                <img src="https://www.nicepng.com/png/full/962-9625201_ai-developer-bootcamp-circle.png" alt="AI Developer logo">
                            </div>
                            <h5 class="card-title">{{ __('messages.ai_developer') }}</h5>
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
                <div class="card">
                    <img class="img-fluid" src="{{ asset('images/project-1.jpg') }}" alt="alternative">
                    <div class="card-body">
                        <h5 class="card-title">{{ __('messages.project1_title') }}</h5>
                        <p class="card-text">{{ __('messages.project1_desc') }}<a class="blue no-line" href="article.html"> {{ __('messages.read_more') }}</a></p>
                    </div>
                </div>
                <div class="card">
                    <img class="img-fluid" src="{{ asset('images/project-2.jpg') }}" alt="alternative">
                    <div class="card-body">
                        <h5 class="card-title">{{ __('messages.project2_title') }}</h5>
                        <p class="card-text">{{ __('messages.project2_desc') }} <a class="blue no-line" href="article.html"> {{ __('messages.read_more') }}</a></p>
                    </div>
                </div>
                <div class="card">
                    <img class="img-fluid" src="{{ asset('images/project-3.jpg') }}" alt="alternative">
                    <div class="card-body">
                        <h5 class="card-title">{{ __('messages.project3_title') }}</h5>
                        <p class="card-text">{{ __('messages.project3_desc') }}<a class="blue no-line" href="article.html"> {{ __('messages.read_more') }}</a></p>
                    </div>
                </div>
                <div class="card">
                    <img class="img-fluid" src="{{ asset('images/project-4.jpg') }}" alt="alternative">
                    <div class="card-body">
                        <h5 class="card-title">{{ __('messages.project4_title') }}</h5>
                        <p class="card-text">{{ __('messages.project4_desc') }} <a class="blue no-line" href="article.html"> {{ __('messages.read_more') }}</a></p>
                    </div>
                </div>
                <div class="card">
                    <img class="img-fluid" src="{{ asset('images/project-5.jpg') }}" alt="alternative">
                    <div class="card-body">
                        <h5 class="card-title">{{ __('messages.project5_title') }}</h5>
                        <p class="card-text">{{ __('messages.project5_desc') }}<a class="blue no-line" href="article.html"> {{ __('messages.read_more') }}</a></p>
                    </div>
                </div>
                <div class="card">
                    <img class="img-fluid" src="{{ asset('images/project-6.jpg') }}" alt="alternative">
                    <div class="card-body">
                        <h5 class="card-title">{{ __('messages.project6_title') }}</h5>
                        <p class="card-text">{{ __('messages.project6_desc') }} <a class="blue no-line" href="article.html"> {{ __('messages.read_more') }}</a></p>
                    </div>
                </div>
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
                            <div class="swiper-slide">
                                <img class="testimonial-image" src="{{ asset('images/testimonial-1.jpg') }}" alt="alternative">
                                <p class="testimonial-text">“Expense bed any sister depend changer off piqued one. Contented continued any happiness instantly objection yet her allowance. Use correct day new brought tedious. By come this been in. Kept easy or sons my it how about some words here done”</p>
                                <div class="testimonial-author">{{ __('messages.testimonial_author1') }}</div>
                                <div class="testimonial-position">{{ __('messages.testimonial_position1') }}</div>
                            </div>
                            <div class="swiper-slide">
                                <img class="testimonial-image" src="{{ asset('images/testimonial-2.jpg') }}" alt="alternative">
                                <p class="testimonial-text">“Expense bed any sister depend changer off piqued one. Contented continued any happiness instantly objection yet her allowance. Use correct day new brought tedious. By come this been in. Kept easy or sons my it how about some words here done”</p>
                                <div class="testimonial-author">{{ __('messages.testimonial_author2') }}</div>
                                <div class="testimonial-position">{{ __('messages.testimonial_position2') }}</div>
                            </div>
                            <div class="swiper-slide">
                                <img class="testimonial-image" src="{{ asset('images/testimonial-3.jpg') }}" alt="alternative">
                                <p class="testimonial-text">“Expense bed any sister depend changer off piqued one. Contented continued any happiness instantly objection yet her allowance. Use correct day new brought tedious. By come this been in. Kept easy or sons my it how about some words here done”</p>
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
                <div class="image-container">
                    <img class="img-fluid" src="{{ asset('images/contact.png') }}" alt="alternative">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="text-container">
                    <h2>{{ __('messages.contact_title') }}</h2>
                    <form id="contactForm">
                        @csrf
                        <div class="form-group">
                            <input type="text" name="name" class="form-control-input" placeholder="{{ __('messages.your_name') }}" required>
                        </div>
                        <div class="form-group">
                            <input type="email" name="email" class="form-control-input" placeholder="{{ __('messages.email') }}" required>
                        </div>
                        <div class="form-group">
                            <textarea name="message" class="form-control-textarea" placeholder="{{ __('messages.message') }}" required></textarea>
                        </div>
                        @if(session('success'))
                            <div style="background-color: #d4edda; color: #155724; padding: 15px; border-radius: 5px; margin-bottom: 20px;">
                                {{ session('success') }}
                            </div>
                        @endif
                        <div class="form-group">
                            <button type="submit" class="form-control-submit-button">{{ __('messages.send') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection