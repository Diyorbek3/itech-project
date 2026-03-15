<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- SEO Meta Tags -->
    <meta name="description" content="@lang('messages.meta_description')">
    <meta name="author" content="@lang('messages.meta_author')">

    <!-- OG Meta Tags to improve the way the post looks when you share the page on Facebook, Twitter, LinkedIn -->
    <meta property="og:site_name" content="@lang('messages.og_site_name')" /> <!-- website name -->
    <meta property="og:site" content="@lang('messages.og_site')" /> <!-- website link -->
    <meta property="og:title" content="@lang('messages.og_title')" /> <!-- title shown in the actual shared post -->
    <meta property="og:description" content="@lang('messages.og_description')" /> <!-- description shown in the actual shared post -->
    <meta property="og:image" content="@lang('messages.og_image')" /> <!-- image link, make sure it's jpg -->
    <meta property="og:url" content="@lang('messages.og_url')" /> <!-- where do you want your post to link to -->
    <meta name="twitter:card" content="summary_large_image"> <!-- to have large image post format in Twitter -->

    <!-- Webpage Title -->
    <title>@lang('messages.contact_title')</title>

    <!-- Styles -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,400;0,600;0,700;1,400&display=swap"
        rel="stylesheet">
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/fontawesome-all.min.css" rel="stylesheet">
    <link href="/css/swiper.css" rel="stylesheet">
    <link href="/css/styles.css" rel="stylesheet">

    <!-- Favicon  -->
    <link rel="icon" href="/images/logo.png">
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
</head>

<body>
    <!-- Navigation -->
    <nav id="navbar" class="navbar navbar-expand-lg fixed-top navbar-light">
    <div class="container">

        <a class="navbar-brand" href="/">
            <img src="{{ asset('images/logo.png') }}" class='img-fluid rounded-circle'
                 style='width: 70px; height: 70px;' alt="logo">
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExampleDefault">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
            <ul class="navbar-nav mx-auto navbar-nav-scroll">
                <li class="nav-item"><a class="nav-link active" href="#header">@lang('messages.about_us')</a></li>
                <li class="nav-item"><a class="nav-link" href="#details">@lang('messages.why_us')</a></li>
                <li class="nav-item"><a class="nav-link" href="#services">@lang('messages.courses')</a></li>
                <li class="nav-item"><a class="nav-link" href="#projects">@lang('messages.projects')</a></li>
            </ul>
            
            <div class="d-flex align-items-center">
    
    <div class="dropdown me-3">
        <a class="btn-outline-sm dropdown-toggle d-flex align-items-center" href="#" role="button" id="languageDropdown" data-bs-toggle="dropdown">
            @php $locale = app()->getLocale(); @endphp
            <img src="{{ asset('flags/'.$locale.'.png') }}" alt="{{ $locale }}" class="flag-icon me-1" style="width: 20px; height: 14px; object-fit: cover;"> 
            {{ ucfirst($locale) }}
        </a>
        <ul class="dropdown-menu dropdown-menu-end">
            <li><a class="dropdown-item" href="{{ route('language.switch', 'en') }}"><img src="{{ asset('flags/en.png') }}" width="20" class="me-2"> English</a></li>
            <li><a class="dropdown-item" href="{{ route('language.switch', 'ru') }}"><img src="{{ asset('flags/ru.png') }}" width="20" class="me-2"> Russian</a></li>
            <li><a class="dropdown-item" href="{{ route('language.switch', 'uz') }}"><img src="{{ asset('flags/uz.png') }}" width="20" class="me-2"> Uzbek</a></li>
        </ul>
    </div>

    <a class="btn-outline-sm me-3 p-4" href="#contact" style="white-space: nowrap;">
        @lang('messages.contact_us')
    </a>
    
    <div class="auth-container">
        @guest
            <a class="btn-outline-sm me-2" href="{{ route('login') }}">
                <i class="fas fa-sign-in-alt"></i>
            </a>
            <a class="btn-outline-sm" href="{{ route('register') }}">
                <i class="fas fa-user-plus"></i>
            </a>
        @else
            <div class="dropdown">
                <a class="btn-outline-sm dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                    <i class="fas fa-user-circle"></i> {{ Auth::user()->name }}
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item" href="{{ route('profile.edit') }}">
                            @lang('messages.profile')
                        </a>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item text-danger border-0 bg-transparent w-100 text-start">
                                Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        @endguest
    </div>

</div>
        </div> </div> </nav>
                
                
                
            
   <!-- Language Switcher - точно такой же стиль как contact_us -->
<!-- Language Switcher - в стиле contact us -->
<span class="nav-item">
    <div class="dropdown">
        <a class="btn-outline-sm dropdown-toggle d-flex align-items-center" href="#" role="button" id="languageDropdown" data-bs-toggle="dropdown" aria-expanded="false">
            @switch(app()->getLocale())
                @case('en')
                    <img src="{{ asset('flags/en.png') }}" alt="EN" class="flag-icon me-1" style="width: 20px; height: 15px; object-fit: cover;"> En
                    @break
                @case('ru')
                    <img src="{{ asset('flags/ru.png') }}" alt="RU" class="flag-icon me-1" style="width: 20px; height: 15px; object-fit: cover;"> Ru
                    @break
                @case('uz')
                    <img src="{{ asset('flags/uz.png') }}" alt="UZ" class="flag-icon me-1" style="width: 20px; height: 15px; object-fit: cover;"> Uz
                    @break
                @default
                    <img src="{{ asset('flags/en.png') }}" alt="EN" class="flag-icon me-1" style="width: 20px; height: 15px; object-fit: cover;"> En
            @endswitch
        </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="languageDropdown" style="min-width: 120px;">
                <li>
                    <a class="dropdown-item {{ app()->getLocale() == 'en' ? 'active' : '' }}" href="{{ route('language.switch', 'en') }}">
                        <img src="{{ asset('flags/en.png') }}" alt="English" class="flag-icon me-2" style="width: 20px; height: 15px; object-fit: cover;"> 
                        <span>@lang('messages.english')</span>
                    </a>
                </li>
                <li>
                    <a class="dropdown-item {{ app()->getLocale() == 'ru' ? 'active' : '' }}" href="{{ route('language.switch', 'ru') }}">
                        <img src="{{ asset('flags/ru.png') }}" alt="Russian" class="flag-icon me-2" style="width: 20px; height: 15px; object-fit: cover;"> 
                        <span>@lang('messages.russian')</span>
                    </a>
                </li>
                <li>
                    <a class="dropdown-item {{ app()->getLocale() == 'uz' ? 'active' : '' }}" href="{{ route('language.switch', 'uz') }}">
                        <img src="{{ asset('flags/uz.png') }}" alt="Uzbek" class="flag-icon me-2" style="width: 20px; height: 15px; object-fit: cover;"> 
                        <span>@lang('messages.uzbek')</span>
                    </a>
                </li>
            </ul>
    </div>
</span>
                
<span class="nav-item ms-2">
    @guest
        {{-- Tizimga kirmaganlar uchun tugmalar --}}
        <a class="auth-btn btn-login-custom" href="{{ route('login') }}">
            {{ app()->getLocale() == 'en' ? 'Login' : __('messages.login') }}
        </a>
        <a class="auth-btn btn-signup-custom" href="{{ route('register') }}">
            {{ app()->getLocale() == 'en' ? 'Sign Up' : __('messages.sign_up') }}
        </a>
    @else
    {{-- TIZIMGA KIRGANLAR UCHUN PROFIL --}}
    <div class="dropdown d-inline-block">
        <a class="btn-outline-sm dropdown-toggle d-flex align-items-center" href="#" role="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fas fa-user-circle me-1"></i> {{ Auth::user()->name }}
        </a>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
            <li>
                <a class="dropdown-item" href="{{ route('profile.edit') }}">
                    <i class="fas fa-user-edit me-2"></i> @lang('messages.profile')
                </a>
            </li>
            <li><hr class="dropdown-divider"></li>
            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="dropdown-item text-danger border-0 bg-transparent w-100 text-start">
                        <i class="fas fa-sign-out-alt me-2"></i> @lang('messages.logout')
                    </button>
                </form>
            </li>
        </ul>
    </div>
@endguest
</span>
                
                <span class="nav-item">
                    <a class="btn-outline-sm" href="#contact">@lang('messages.contact_us')</a>
                </span>
            </div> <!-- end of navbar-collapse -->
        </div> <!-- end of container -->
    </nav> <!-- end of navbar -->
    <!-- end of navigation -->


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
                        <a class="btn-solid-reg" href="#contact">@lang('messages.start_course')</a>
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
                        <div class="card-item">
                            <div class="icon-box">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/c3/Python-logo-notext.svg/1280px-Python-logo-notext.svg.png"
                                    alt="Python logo">
                            </div>
                            <h5 class="card-title">@lang('messages.python')</h5>
                        </div>
                        <div class="card-item">
                            <div class="icon-box">
                                <img src="https://img.freepik.com/premium-vector/digital-precision-designing-modern-computer-logos-innovative-tech-branding_579306-22156.jpg?semt=ais_rp_50_assets&w=740&q=80"
                                    alt="Computer literacy logo">
                            </div>
                            <h5 class="card-title">@lang('messages.computer_literacy')</h5>
                        </div>
                        <div class="card-item">
                            <div class="icon-box">
                                <img src="https://us.123rf.com/450wm/dxinerz/dxinerz1601/dxinerz160103363/51258851-code-seo-web-symbol-vektor-bild-kann-auch-f%C3%BCr-seo-und-entwicklungsdienste-verwendet-werden.jpg?ver=6"
                                    alt="Frontend development logo">
                            </div>
                            <h5 class="card-title">@lang('messages.frontend')</h5>
                        </div>
                        <div class="card-item">
                            <div class="icon-box">
                                <img src="https://www.shutterstock.com/image-vector/backend-developer-icon-mixed-vector-600nw-2655399835.jpg"
                                    alt="Backend development logo">
                            </div>
                            <h5 class="card-title">@lang('messages.backend')</h5>
                        </div>
                        <div class="card-item">
                            <div class="icon-box">
                                <img src="https://img.icons8.com/sci-fi/1200/cyber-security.jpg"
                                    alt="Cybersecurity logo">
                            </div>
                            <h5 class="card-title">@lang('messages.cybersecurity')</h5>
                        </div>
                        <div class="card-item">
                            <div class="icon-box">
                                <img src="https://www.nicepng.com/png/full/962-9625201_ai-developer-bootcamp-circle.png"
                                    alt="AI Developer logo">
                            </div>
                            <h5 class="card-title">@lang('messages.ai_developer')</h5>
                        </div>
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
                        <a class="btn-solid-reg" href="article.html">@lang('messages.start')</a>
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



    <!-- Footer -->
    <div class="footer bg-gray">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="footer-col first">
                        <h6>@lang('messages.about_website')</h6>
                        <p class="p-small">@lang('messages.footer_description')</p>
                    </div> <!-- end of footer-col -->
                    <div class="footer-col second">
                        <h6>@lang('messages.address')</h6>
                        <ul class="list-unstyled li-space-lg p-small">
                            <li> <a style="font-size: 15px;" href="">@lang('messages.address_details')</a></li>
                        </ul>
                    </div> <!-- end of footer-col -->
                    <div class="footer-col third">
                        <span class="fa-stack">
                            <a href="#your-link">
                                <i class="fas fa-circle fa-stack-2x"></i>
                                <i class="fab fa-facebook-f fa-stack-1x"></i>
                            </a>
                        </span>
                        <span class="fa-stack">
                            <a href="#your-link">
                                <i class="fas fa-circle fa-stack-2x"></i>
                                <i class="fab fa-twitter fa-stack-1x"></i>
                            </a>
                        </span>
                        <span class="fa-stack">
                            <a href="#your-link">
                                <i class="fas fa-circle fa-stack-2x"></i>
                                <i class="fab fa-telegram fa-stack-1x"></i>
                            </a>
                        </span>
                        <span class="fa-stack">
                            <a href="#your-link">
                                <i class="fas fa-circle fa-stack-2x"></i>
                                <i class="fab fa-instagram fa-stack-1x"></i>
                            </a>
                        </span>
                        <p class="p-small">@lang('messages.follow_us') <a
                                href="mailto:contact@site.com"><strong>ITECH@site.com</strong></a></p>
                    </div> <!-- end of footer-col -->
                </div> <!-- end of col -->
            </div> <!-- end of row -->
        </div> <!-- end of container -->
    </div> <!-- end of footer -->
    <!-- end of footer -->


    <!-- Copyright -->
    <div class="copyright bg-gray">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <p class="p-small">@lang('messages.copyright', ['year' => date('Y')]) <a href="#your-link">ITECH</a></p>
                </div> <!-- end of col -->
            </div> <!-- enf of row -->

            <div class="row">
                <div class="col-lg-12">
                    <p class="p-small">@lang('messages.design_by') <a href="https://themewagon.com/">Themewagon</a></p>
                </div> <!-- end of col -->
            </div> <!-- enf of row -->
        </div> <!-- end of container -->
    </div> <!-- end of copyright -->
    <!-- end of copyright -->


    <!-- Back To Top Button -->
    <button onclick="topFunction()" id="myBtn">
        <img src="{{ asset('images/up-arrow.png') }}" alt="alternative">
    </button>
    <!-- end of back to top button -->

    <!-- Scripts -->

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script> <!-- Bootstrap framework -->
    <script src="{{ asset('js/swiper.min.js') }}"></script> <!-- Swiper for image and text sliders -->
    <script src="{{ asset('js/purecounter.min.js') }}"></script> <!-- Purecounter counter for statistics numbers -->
    <script src="{{ asset('js/scripts.js') }}"></script> <!-- Custom scripts -->
</body>

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

</html>