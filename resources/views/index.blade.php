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
            /* Yoki o'z rangizgizni tanlang */
            font-size: 0.875rem;
            line-height: 1.75rem;
            margin-right: 0.5rem;
        }

        /* Karta panjarasi (Grid) - 3 ta ustun */
        .cards-1 .card-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            /* 3 ta teng ustun */
            gap: 2rem;
            /* Kartalar orasidagi masofa */
        }

        /* Har bir karta elementi */
        .cards-1 .card-item {
            background-color: #fff;
            padding: 2.5rem 1.5rem;
            border-radius: 0.5rem;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            /* Yumshoq soya */
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        /* Belgilar qutisi (Icon box) */
        .cards-1 .icon-box {
            width: 80px;
            /* Barcha ikonalar uchun yagona kenglik */
            height: 80px;
            /* Barcha ikonalar uchun yagona balandlik */
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
            /* Tasvir formatini buzmasdan sig'diradi */
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
            box-shadow: ...;
        }

        /* Kichik ekranlar uchun moslashuvchanlik */
        @media (max-width: 991px) {
            .cards-1 .card-grid {
                grid-template-columns: repeat(2, 1fr);
                /* 2 ta ustun */
            }
        }

        @media (max-width: 767px) {
            .cards-1 .card-grid {
                grid-template-columns: 1fr;
                /* 1 ta ustun */
            }
        }
        
    /* Language Switcher Styles */
.flag-icon {
    display: inline-block;
    border-radius: 3px;
    box-shadow: 0 1px 3px rgba(0,0,0,0.1);
}

/* Стиль для кнопки переключателя */
a.btn-outline-sm.dropdown-toggle {
    display: flex;
    align-items: center;
    gap: 4px;
}

/* Убираем стандартную стрелку Bootstrap и добавляем свою */
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

/* Стиль для активного языка в выпадающем списке */
.dropdown-item.active {
    background-color: #f8f9fa;
    color: #0d6efd;
    font-weight: 500;
}

/* Ховер эффект для элементов списка */
.dropdown-item:hover {
    background-color: #f8f9fa;
}

/* Выравнивание флага и текста в выпадающем списке */
.dropdown-item {
    display: flex;
    align-items: center;
    padding: 0.5rem 1rem;
    font-size: 0.9rem;
}

/* Отступ между флагом и текстом */
.dropdown-item .flag-icon {
    margin-right: 8px;
}


/* Login va Sign Up uchun maxsus kichik uslub */
/* Auth konteyneri uchun */
.auth-container {
    display: flex;
    align-items: center;
    gap: 8px; /* Tugmalar orasidagi masofa */
    flex-wrap: nowrap; /* Tugmalarni bitta qatorda saqlaydi */
}

.auth-btn {
    padding: 8px 16px !important; /* Bo'yiga balandroq, eniga yetarli joy */
    font-size: 13px !important;
    font-weight: 600;
    border-radius: 20px !important;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    min-width: fit-content; /* Matn sig'ishiga qarab kengayadi */
    white-space: nowrap; /* Matnni pastga tushirmaydi */
    transition: all 0.3s ease;
    text-decoration: none !important;
}

/* O'zbek tili uchun maxsus: agar matn juda uzun bo'lsa shriftni biroz kichraytiramiz */
[lang="uz"] .auth-btn {
    font-size: 10px !important;
    padding: 7px 10px !important;
}

/* Mobil qurilmalarda tugmalar bir-birining ostiga tushishi uchun */
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

/* Mobil qurilmalar uchun tugmalar yopishib qolmasligi uchun */
@media (max-width: 991px) {
    .auth-btn {
        display: block;
        margin: 5px auto;
        max-width: 150px;
    }
}

.btn-login-custom {
    border: 1px solid #eb427e;
    color: #eb427e;
    background: transparent;
}

.btn-signup-custom {
    background-color: #eb427e;
    border: 1px solid #eb427e;
    color: #fff !important;
}

/* Kursor olib borilganda ham chiziqcha chiqmasligi uchun */
.auth-btn:hover {
    text-decoration: none !important;
    opacity: 0.9;
}
.auth-btn {
    padding: 6px 18px !important;
    font-size: 13px !important;
    font-weight: 600;
    border-radius: 20px !important;
    display: inline-block;
    text-align: center;
    min-width: 90px;
    margin: 0 4px;
    transition: all 0.3s ease; /* Silliq o'tish */
    text-decoration: none !important;
}

/* Login tugmasi (Dastlab ramkali) */
.btn-login-custom {
    border: 1px solid #eb427e !important;
    color: #ffffff !important;
    background-color: #eb427e !important;
}

/* Sichqoncha ustiga kelganda yoki bosilganda */
.btn-login-custom:hover, .btn-login-custom:active {
    background-color: #ffffff !important;
    color: #eb427e !important;
    text-decoration: none !important;
}

/* Sign Up tugmasi (Dastlab to'la rangli) */
.btn-signup-custom {
    background-color: #eb427e !important;
    border: 1px solid #eb427e !important;
    color: #fff !important;
}

/* Sichqoncha ustiga kelganda yoki bosilganda */
.btn-signup-custom:hover, .btn-signup-custom:active {
    background-color: transparent !important;
    color: #eb427e !important;
    text-decoration: none !important;
}
/* Menyu elementlari orasidagi masofani biroz kamaytiramiz */
.navbar-nav .nav-link {
    padding-right: 0.8rem !important;
    padding-left: 0.8rem !important;
}

/* Auth tugmalarining o'lchamini jilovlaymiz */
.auth-btn {
    min-width: 80px !important;
    padding: 6px 12px !important;
    font-size: 12px !important;
}

/* Katta ekranlarda hamma narsa sig'ishi uchun konteynerni kengaytiramiz */
@media (min-width: 1200px) {
    .container {
        max-width: 1300px;
    }
}

/* O'zbek tili uchun shriftni kichraytirish qoidasini biroz yumshatamiz */
[lang="uz"] .auth-btn {
    font-size: 11px !important;
}       
/* Konteynerni kengaytiramiz */
@media (min-width: 1200px) {
    .container {
        max-width: 1350px !important;
    }
}

/* Navigatsiya elementlari orasidagi masofani qisqartiramiz */
.navbar-nav .nav-link {
    padding-right: 12px !important;
    padding-left: 12px !important;
    font-size: 15px;
}

/* Tugmalar siqilib qolmasligi uchun */
.auth-container {
    display: flex;
    align-items: center;
    gap: 5px; /* Tugmalar orasidagi masofa */
}

.auth-btn {
    min-width: 85px !important;
    padding: 6px 12px !important;
    font-size: 13px !important;
    white-space: nowrap; /* Matn pastga tushib ketmasligi uchun */
}

/* Logotip va menyu orasidagi bo'shliq */
.navbar-collapse {
    justify-content: space-between;
}
    </style>

    <style>
/* Стили для ссылок карточек */
.card-link {
    text-decoration: none;
    color: inherit;
    display: block;
    cursor: pointer; /* Курсор-указатель при наведении */
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.card-link:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.1);
}

/* Сохраняем исходные стили для card-item */
.card-item {
    /* ваши существующие стили */
    background: #fff;
    border-radius: 8px;
    padding: 20px;
    text-align: center;
    height: 100%;
}

/* Стили для иконок */
.icon-box {
    margin-bottom: 15px;
}

.icon-box img {
    width: 80px;
    height: 80px;
    object-fit: contain;
}

/* Стили для сетки карточек */
.card-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
}

/* Адаптивность */
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

/* Дополнительный стиль для курсора при наведении на картинки */
.icon-box img {
    cursor: pointer;
}
</style>

@endsection

@section('scripts')
 <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script> <!-- Bootstrap framework -->
    <script src="{{ asset('js/swiper.min.js') }}"></script> <!-- Swiper for image and text sliders -->
    <script src="{{ asset('js/purecounter.min.js') }}"></script> <!-- Purecounter counter for statistics numbers -->
    <script src="{{ asset('js/scripts.js') }}"></script> <!-- Custom scripts -->
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
                        
                        // Formani tozalash
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
                        <h1 class="h1-large">@lang('messages.header_title')</h1>
                        <p class="p-large">
                            @lang('messages.header_description')
                        </p>
                        <a class="btn-solid-lg" href="#introduction">@lang('messages.learn_more')</a>
                        <a class="btn-outline-lg" href="#contact">@lang('messages.contact')</a>
                    </div>
                </div> <!-- end of col -->
                <div class="col-lg-5 col-xl-7">
                    <div class="image-container">
                        <img class="img-fluid rounded-img p-5" src="{{ asset('images/menu1.png') }}" alt="alternative">
                    </div> <!-- end of image-container -->
                </div> <!-- end of col -->
            </div> <!-- end of row -->
        </div> <!-- end of container -->
    </header> <!-- end of header -->
    <!-- end of header -->


    <!-- Statistics -->
    <div class="counter">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">

                    <!-- Counter -->
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
                            <div class="counter-info">@lang('messages.employed_students')</div>
                        </div>

                        <div class="counter-cell">
                            <div data-purecounter-start="0" data-purecounter-end="5" data-purecounter-duration="2"
                                class="purecounter">0</div>
                            <div class="counter-info">@lang('messages.years_experience')</div>
                        </div>

                    </div>
                    <!-- end of counter -->

                </div> <!-- end of col -->
            </div> <!-- end of row -->
        </div> <!-- end of container -->
    </div> <!-- end of counter -->
    <!-- end of statistics -->


    <!-- Introduction -->
    <div id="introduction" class="basic-1 bg-gray">
        <div class="container">
            <div class="row">
                <div class="col-xl-9">
                    <h2>@lang('messages.intro_title')</h2>
                    <p>
                        @lang('messages.intro_description')
                    </p>
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
                        <h2>@lang('messages.details1_title')</h2>
                        <ul class="list-unstyled li-space-lg">
                            <li class="d-flex">
                                <i class="fas fa-square"></i>
                                <div class="flex-grow-1">
                                    @lang('messages.details1_item1')
                                </div>  
                            </li>
                            <li class="d-flex">
                                <i class="fas fa-square"></i>
                                <div class="flex-grow-1">
                                    @lang('messages.details1_item2')
                                </div>
                            </li>
                            <li class="d-flex">
                                <i class="fas fa-square"></i>
                                <div class="flex-grow-1">
                                    @lang('messages.details1_item3')
                                </div>
                            </li>
                            <li class="d-flex">
                                <i class="fas fa-square"></i>
                                <div class="flex-grow-1">
                                    @lang('messages.details1_item4')
                                </div>
                            </li>
                        </ul>
                        <a class="btn-solid-reg" href="#services">@lang('messages.start_course')</a>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div id="services" class="cards-1 bg-gray">
    <div class="container">
        <div class="row align-items-start">
            <div class="col-lg-5">
                <div class="text-container">
                    <h2>@lang('messages.our_courses')</h2>
                    <p>@lang('messages.courses_desc1')</p>
                    <p>@lang('messages.courses_desc2')</p>
                    <ul class="list-unstyled li-space-lg">
                        <li class="d-flex">
                            <i class="fas fa-square"></i>
                            <div class="flex-grow-1">@lang('messages.courses_item1')</div>
                        </li>
                        <li class="d-flex">
                            <i class="fas fa-square"></i>
                            <div class="flex-grow-1">@lang('messages.courses_item2')</div>
                        </li>
                        <li class="d-flex">
                            <i class="fas fa-square"></i>
                            <div class="flex-grow-1">@lang('messages.courses_item3')</div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="card-grid">
                    <a href="{{ route('cources.python') }}" class="card-link">
                        <div class="card-item">
                            <div class="icon-box">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/c3/Python-logo-notext.svg/1280px-Python-logo-notext.svg.png"
                                    alt="Python logo">
                            </div>
                            <h5 class="card-title">@lang('messages.python')</h5>
                        </div>
                    </a>
                    <a href="/courses/computer-literacy" class="card-link">
                        <div class="card-item">
                            <div class="icon-box">
                                <img src="https://img.freepik.com/premium-vector/digital-precision-designing-modern-computer-logos-innovative-tech-branding_579306-22156.jpg?semt=ais_rp_50_assets&w=740&q=80"
                                    alt="Computer literacy logo">
                            </div>
                            <h5 class="card-title">@lang('messages.computer_literacy')</h5>
                        </div>
                    </a>
                    <a href="{{ route('cources.frontend') }}" class="card-link">
                        <div class="card-item">
                            <div class="icon-box">
                                <img src="https://us.123rf.com/450wm/dxinerz/dxinerz1601/dxinerz160103363/51258851-code-seo-web-symbol-vektor-bild-kann-auch-f%C3%BCr-seo-und-entwicklungsdienste-verwendet-werden.jpg?ver=6"
                                    alt="Frontend development logo">
                            </div>
                            <h5 class="card-title">@lang('messages.frontend')</h5>
                        </div>
                    </a>
                    <a href="/courses/backend" class="card-link">
                        <div class="card-item">
                            <div class="icon-box">
                                <img src="https://www.shutterstock.com/image-vector/backend-developer-icon-mixed-vector-600nw-2655399835.jpg"
                                    alt="Backend development logo">
                            </div>
                            <h5 class="card-title">@lang('messages.backend')</h5>
                        </div>
                    </a>
                    <a href="/courses/cybersecurity" class="card-link">
                        <div class="card-item">
                            <div class="icon-box">
                                <img src="https://img.icons8.com/sci-fi/1200/cyber-security.jpg"
                                    alt="Cybersecurity logo">
                            </div>
                            <h5 class="card-title">@lang('messages.cybersecurity')</h5>
                        </div>
                    </a>
                    <a href="/courses/ai-developer" class="card-link">
                        <div class="card-item">
                            <div class="icon-box">
                                <img src="https://www.nicepng.com/png/full/962-9625201_ai-developer-bootcamp-circle.png"
                                    alt="AI Developer logo">
                            </div>
                            <h5 class="card-title">@lang('messages.ai_developer')</h5>
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
                        <h2>@lang('messages.details2_title')</h2>
                        <p>@lang('messages.details2_description')</p>
                        <a class="btn-solid-reg" href="{{ route('career.index') }}">@lang('messages.start')</a>
                    </div> <!-- end of text-container -->
                </div> <!-- end of col -->
                <div class="col-lg-6 col-xl-5">
                    <div class="image-container">
                        <img class="img-fluid custom-shape" src="{{ asset('images/human1.png') }}" alt="alternative">
                    </div> <!-- end of image-container -->
                </div> <!-- end of col -->
            </div> <!-- end of row -->
        </div> <!-- end of container -->
    </div> <!-- end of basic-3 -->
    <!-- end of details 2 -->


    <!-- Invitation -->
    <div class="basic-4 bg-gray">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h4>@lang('messages.invitation_text')</h4>
                    <a class="btn-solid-lg" href="#contact">@lang('messages.learn_more')</a>
                </div> <!-- end of col -->
            </div> <!-- end of row -->
        </div> <!-- end of container -->
    </div> <!-- end of basic-4 -->
    <!-- end of invitation -->


    <!-- Projects -->
    <div id="projects" class="cards-2">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="h2-heading">@lang('messages.projects_title')</h2>
                </div> <!-- end of col -->
            </div> <!-- end of row -->
            <div class="row">
                <div class="col-lg-12">

                    <!-- Card -->
                    <div class="card">
                        <img class="img-fluid" src="{{ asset('images/project-1.jpg') }}" alt="alternative">
                        <div class="card-body">
                            <h5 class="card-title">@lang('messages.project1_title')</h5>
                            <p class="card-text">@lang('messages.project1_desc')<a class="blue no-line" href="article.html"> @lang('messages.read_more')</a></p>
                        </div>
                    </div>
                    <!-- end of card -->

                    <!-- Card -->
                    <div class="card">
                        <img class="img-fluid" src="{{ asset('images/project-2.jpg') }}" alt="alternative">
                        <div class="card-body">
                            <h5 class="card-title">@lang('messages.project2_title')</h5>
                            <p class="card-text">@lang('messages.project2_desc') <a class="blue no-line" href="article.html"> @lang('messages.read_more')</a></p>
                        </div>
                    </div>
                    <!-- end of card -->

                    <!-- Card -->
                    <div class="card">
                        <img class="img-fluid" src="{{ asset('images/project-3.jpg') }}" alt="alternative">
                        <div class="card-body">
                            <h5 class="card-title">@lang('messages.project3_title')</h5>
                            <p class="card-text">@lang('messages.project3_desc')<a class="blue no-line" href="article.html"> @lang('messages.read_more')</a></p>
                        </div>
                    </div>
                    <!-- end of card -->

                    <!-- Card -->
                    <div class="card">
                        <img class="img-fluid" src="{{ asset('images/project-4.jpg') }}" alt="alternative">
                        <div class="card-body">
                            <h5 class="card-title">@lang('messages.project4_title')</h5>
                            <p class="card-text">@lang('messages.project4_desc') <a class="blue no-line" href="article.html"> @lang('messages.read_more')</a></p>
                        </div>
                    </div>
                    <!-- end of card -->

                    <!-- Card -->
                    <div class="card">
                        <img class="img-fluid" src="{{ asset('images/project-5.jpg') }}" alt="alternative">
                        <div class="card-body">
                            <h5 class="card-title">@lang('messages.project5_title')</h5>
                            <p class="card-text">@lang('messages.project5_desc')<a class="blue no-line" href="article.html"> @lang('messages.read_more')</a></p>
                        </div>
                    </div>
                    <!-- end of card -->

                    <!-- Card -->
                    <div class="card">
                        <img class="img-fluid" src="{{ asset('images/project-6.jpg') }}" alt="alternative">
                        <div class="card-body">
                            <h5 class="card-title">@lang('messages.project6_title')</h5>
                            <p class="card-text">@lang('messages.project6_desc') <a class="blue no-line" href="article.html"> @lang('messages.read_more')</a></p>
                        </div>
                    </div>
                    <!-- end of card -->

                </div> <!-- end of col -->
            </div> <!-- end of row -->
        </div> <!-- end of container -->
    </div> <!-- end of cards-2 -->
    <!-- end of projects -->


    <!-- Testimonials -->
    <div class="slider-1 bg-gray">
        <img class="quotes-decoration" src="{{ asset('images/quotes.svg') }}" alt="alternative">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">

                    <!-- Card Slider -->
                    <div class="slider-container">
                        <div class="swiper-container card-slider">
                            <div class="swiper-wrapper">

                                <!-- Slide -->
                                <div class="swiper-slide">
                                    <img class="testimonial-image" src="{{ asset('images/testimonial-1.jpg') }}" alt="alternative">
                                    <p class="testimonial-text">“Expense bed any sister depend changer off piqued one.
                                        Contented continued any happiness instantly objection yet her allowance. Use
                                        correct day new brought tedious. By come this been in. Kept easy or sons my it
                                        how about some words here done”</p>
                                    <div class="testimonial-author">@lang('messages.testimonial_author1')</div>
                                    <div class="testimonial-position">@lang('messages.testimonial_position1')</div>
                                </div> <!-- end of swiper-slide -->
                                <!-- end of slide -->

                                <!-- Slide -->
                                <div class="swiper-slide">
                                    <img class="testimonial-image" src="{{ asset('images/testimonial-2.jpg') }}" alt="alternative">
                                    <p class="testimonial-text">“Expense bed any sister depend changer off piqued one.
                                        Contented continued any happiness instantly objection yet her allowance. Use
                                        correct day new brought tedious. By come this been in. Kept easy or sons my it
                                        how about some words here done”</p>
                                    <div class="testimonial-author">@lang('messages.testimonial_author2')</div>
                                    <div class="testimonial-position">@lang('messages.testimonial_position2')</div>
                                </div> <!-- end of swiper-slide -->
                                <!-- end of slide -->

                                <!-- Slide -->
                                <div class="swiper-slide">
                                    <img class="testimonial-image" src="{{ asset('images/testimonial-3.jpg') }}" alt="alternative">
                                    <p class="testimonial-text">“Expense bed any sister depend changer off piqued one.
                                        Contented continued any happiness instantly objection yet her allowance. Use
                                        correct day new brought tedious. By come this been in. Kept easy or sons my it
                                        how about some words here done”</p>
                                    <div class="testimonial-author">@lang('messages.testimonial_author3')</div>
                                    <div class="testimonial-position">@lang('messages.testimonial_position3')</div>
                                </div> <!-- end of swiper-slide -->
                                <!-- end of slide -->

                            </div> <!-- end of swiper-wrapper -->

                            <!-- Add Arrows -->
                            <div class="swiper-button-next"></div>
                            <div class="swiper-button-prev"></div>
                            <!-- end of add arrows -->

                        </div> <!-- end of swiper-container -->
                    </div> <!-- end of slider-container -->
                    <!-- end of card slider -->

                </div> <!-- end of col -->
            </div> <!-- end of row -->
        </div> <!-- end of container -->
    </div> <!-- end of slider-1 -->
    <!-- end of testimonials -->


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
                        <h2>@lang('messages.contact_title')</h2>


                        <form id="contactForm">
                            @csrf

                            <div class="form-group">
                                <input type="text" name="name" class="form-control-input" placeholder="@lang('messages.your_name')" required>
                            </div>
                            <div class="form-group">
                                <input type="email" name="email" class="form-control-input" placeholder="@lang('messages.email')" required>
                            </div>
                            <div class="form-group">
                                <textarea name="message" class="form-control-textarea" placeholder="@lang('messages.message')" required></textarea>
                            </div>
                            @if(session('success'))
                                <div
                                    style="background-color: #d4edda; color: #155724; padding: 15px; border-radius: 5px; margin-bottom: 20px;">
                                    {{ session('success') }}
                                </div>
                            @endif

                            <div class="form-group">
                                <button type="submit" class="form-control-submit-button">@lang('messages.send')</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection