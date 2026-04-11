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

        /* Projects bo'limini siqish */
        .cards-2 {
            padding-top: 1.5rem !important;
            padding-bottom: 1rem !important;
        }

        .cards-2 .container {
            padding-left: 0.5rem !important;
            padding-right: 0.5rem !important;
            max-width: 100% !important;
        }

        .cards-2 .h2-heading {
            margin-bottom: 0.5rem !important;
            font-size: 2.5rem !important;
            font-weight: 700 !important;
        }

        .cards-2 .row {
            margin-left: -4px !important;
            margin-right: -4px !important;
            display: flex !important;
            justify-content: center !important;
        }

        .cards-2 .card {
            display: flex;
            flex-direction: column;
            height: auto !important;
            min-height: auto !important;
            margin-bottom: 0 !important;
            width: 100% !important;
            max-width: 100% !important;
        }

        .cards-2 .card-body {
            padding: 0.75rem !important;
            flex: 0 0 auto !important;
        }

        .cards-2 .card-title {
            margin-bottom: 0.5rem !important;
            font-size: 1.5rem !important;
            font-weight: 700 !important;
        }

        .cards-2 .card-text {
            font-size: 1.1rem !important;
            line-height: 1.4 !important;
            margin-bottom: 0 !important;
            padding-bottom: 0 !important;
            font-weight: 500 !important;
        }

        .cards-2 .card-text a {
            display: block !important;
            margin-top: 6px;
            margin-bottom: 0 !important;
            font-size: 1rem !important;
            font-weight: 600 !important;
        }

        /* Yon tomondan siqish - kartalar orasidagi gorizontal masofa minimal */
        .cards-2 .col-md-6,
        .cards-2 .col-lg-4 {
            margin-bottom: 2rem !important;
            padding-left: 15px !important;
            padding-right: 15px !important;
            max-width: 33.333% !important;
            flex: 0 0 33.333% !important;
        }

        /* Responsive */
        @media (max-width: 991px) {
            .cards-2 .col-md-6 {
                max-width: 50% !important;
                flex: 0 0 50% !important;
            }

            .cards-2 .card-title {
                font-size: 1.3rem !important;
            }

            .cards-2 .card-text {
                font-size: 1rem !important;
            }
        }

        @media (max-width: 768px) {
            .cards-2 .col-md-6 {
                max-width: 100% !important;
                flex: 0 0 100% !important;
            }

            .cards-2 .container {
                padding-left: 0.5rem !important;
                padding-right: 0.5rem !important;
            }

            .cards-2 .card-title {
                font-size: 1.2rem !important;
            }

            .cards-2 .card-text {
                font-size: 0.95rem !important;
            }
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

        /* Projects bo'limi */
        /* Projects bo'limi */


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
            padding: 8px 16px;
            font-size: 13px;
            font-weight: 600;
            border-radius: 20px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            min-width: fit-content;
            white-space: nowrap;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        [lang="uz"] .auth-btn {
            font-size: 10px;
            padding: 7px 10px;
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
            border: 1px solid #eb427e;
            color: #ffffff;
            background-color: #eb427e;
        }

        .btn-login-custom:hover,
        .btn-login-custom:active {
            background-color: #ffffff;
            color: #eb427e;
            text-decoration: none;
        }

        .btn-signup-custom {
            background-color: #eb427e;
            border: 1px solid #eb427e;
            color: #fff;
        }

        .btn-signup-custom:hover,
        .btn-signup-custom:active {
            background-color: transparent;
            color: #eb427e;
            text-decoration: none;
        }

        .navbar-nav .nav-link {
            padding-right: 0.8rem;
            padding-left: 0.8rem;
        }

        .auth-btn {
            min-width: 80px;
            padding: 6px 12px;
            font-size: 12px;
        }

        @media (min-width: 1200px) {
            .container {
                max-width: 1300px;
            }
        }

        [lang="uz"] .auth-btn {
            font-size: 11px;
        }

        @media (min-width: 1200px) {
            .container {
                max-width: 1350px;
            }
        }

        .navbar-nav .nav-link {
            padding-right: 12px;
            padding-left: 12px;
            font-size: 15px;
        }

        .auth-container {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .auth-btn {
            min-width: 85px;
            padding: 6px 12px;
            font-size: 13px;
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

        /* Loading animatsiyasi 1 sekund */
        .spinner-border-sm {
            animation-duration: 1s;
        }

        /* Tugmaga silliq o'tish effekti */
        .form-control-submit-button {
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .form-control-submit-button:disabled {
            transform: scale(0.98);
            opacity: 0.7;
            cursor: not-allowed;
        }

        /* Alert xabarlar uchun */
        .alert {
            padding: 12px 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        /* Application Modal (ariza popup) */
        .application-modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.65);
            backdrop-filter: blur(6px);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1050;
            visibility: hidden;
            opacity: 0;
            transition: visibility 0.2s, opacity 0.2s ease;
        }

        .application-modal-overlay.active {
            visibility: visible;
            opacity: 1;
        }

        .application-modal-container {
            background: #ffffff;
            max-width: 420px;
            width: 90%;
            border-radius: 2rem;
            padding: 2rem 1.8rem;
            box-shadow: 0 30px 45px rgba(0, 0, 0, 0.3);
            transform: scale(0.96);
            transition: transform 0.2s ease;
            text-align: center;
            position: relative;
        }

        .application-modal-overlay.active .application-modal-container {
            transform: scale(1);
        }

        .application-modal-container h3 {
            font-size: 1.8rem;
            font-weight: 800;
            background: linear-gradient(145deg, #0f2b3d, #1e4a76);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            margin-bottom: 0.5rem;
        }

        .application-modal-container p {
            color: #4a5568;
            font-size: 0.9rem;
            margin-bottom: 1rem;
        }

        .application-success-icon {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, #22c55e, #16a34a);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem auto;
        }

        .application-success-icon i {
            font-size: 2.5rem;
            color: white;
        }

        .application-modal-container .course-name-badge {
            background: #e2edf7;
            display: inline-block;
            padding: 0.3rem 1rem;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 600;
            color: #1e4a76;
            margin: 0.5rem 0;
        }

        .application-close-btn {
            background: #0f3b5c;
            border: none;
            padding: 0.75rem 1.8rem;
            border-radius: 3rem;
            font-weight: bold;
            font-size: 1rem;
            color: white;
            transition: 0.2s;
            margin-top: 1rem;
            cursor: pointer;
        }

        .application-close-btn:hover {
            background: #1e5a7c;
            transform: scale(0.98);
        }

        /* Contact bo'limidagi rasm uchun chiroyli style */
        #contact .image-container img {
            width: 100%;
            max-width: 520px;
            /* o'lchamni biroz kattalashtirdim */
            height: auto;
            border-radius: 30px;
            /* yumshoqroq va chiroyli */
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
            transition: all 0.4s ease;
            object-fit: cover;
        }

        /* Hover effekti qo'shdim */


        /* Qo'shimcha premium ko'rinish uchun */
        #contact .image-container {
            position: relative;
        }

        #contact .image-container::after {
            content: '';
            position: absolute;
            inset: 0;
            border-radius: 30px;
            background: linear-gradient(145deg,
                    rgba(255, 255, 255, 0.08) 0%,
                    rgba(255, 255, 255, 0) 50%);
            pointer-events: none;
            z-index: 1;
        }

        /* Neumorphism Cards */
        .project-card-neo {
            background: #e0e5ec;
            border-radius: 40px;
            box-shadow: 9px 9px 16px #a3b1c6, -9px -9px 16px #ffffff;
            transition: all 0.3s ease;
            height: 100%;
            overflow: hidden;
        }

        .project-card-neo:hover {
            box-shadow: 4px 4px 8px #a3b1c6, -4px -4px 8px #ffffff;
            transform: translateY(-5px);
        }

        .project-card-neo img {
            width: 100%;
            height: 220px;
            object-fit: cover;
            border-radius: 40px 40px 0 0;
        }

        .project-card-neo .card-body {
            padding: 1.5rem;
        }

        .project-card-neo .card-title {
            font-size: 1.35rem;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 0.75rem;
        }

        .project-card-neo .card-text {
            color: #5a6e7e;
            font-size: 0.9rem;
            line-height: 1.5;
            margin-bottom: 1rem;
        }

        .project-card-neo .btn-neo {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #e0e5ec;
            padding: 10px 20px;
            border-radius: 30px;
            text-decoration: none;
            color: #2c3e50;
            font-weight: 600;
            font-size: 0.85rem;
            box-shadow: 5px 5px 10px #a3b1c6, -5px -5px 10px #ffffff;
            transition: all 0.2s ease;
        }

        .project-card-neo .btn-neo:hover {
            box-shadow: inset 5px 5px 10px #a3b1c6, inset -5px -5px 10px #ffffff;
            gap: 12px;
        }
    </style>
@endsection

@section('scripts')

    <script>
        $(document).ready(function () {
            $("#contactForm").submit(function (e) {
                e.preventDefault();

                const submitBtn = document.getElementById('submitBtn');
                const btnText = document.getElementById('btnText');
                const btnSpinner = document.getElementById('btnSpinner');

                // Loading holatiga o'tkazish
                submitBtn.disabled = true;
                btnText.style.display = 'none';
                btnSpinner.style.display = 'inline-block';

                var form = $(this);

                $.ajax({
                    url: '/contact-send',
                    type: "POST",
                    data: form.serialize(),
                    success: function (result) {
                        // Modal popup chiqarish
                        showApplicationSuccessModal();
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
                        });
                    },
                    complete: function () {
                        // Tugmani qayta tiklash
                        submitBtn.disabled = false;
                        btnText.style.display = 'inline';
                        btnSpinner.style.display = 'none';
                    }
                });
            });
        });

        // Application Success Modal funksiyasi
        function showApplicationSuccessModal() {
            let modal = document.getElementById('applicationSuccessModal');
            if (modal) {
                updateModalLanguage();
                modal.classList.add('active');

                // 5 sekunddan keyin avtomatik yopilish
                if (window.modalTimeout) clearTimeout(window.modalTimeout);
                window.modalTimeout = setTimeout(function () {
                    closeApplicationModal();
                }, 5000);
            }
        }

        function updateModalLanguage() {
            const modalTitle = document.getElementById('modalTitle');
            const modalCourse = document.getElementById('modalCourse');
            const modalMessage = document.getElementById('modalMessage');
            const modalPhone = document.getElementById('modalPhone');
            const modalTelegram = document.getElementById('modalTelegram');
            const modalBtnText = document.getElementById('modalBtnText');

            if (modalTitle) modalTitle.textContent = '{{ __("messages.application_received") }}';
            if (modalCourse) modalCourse.textContent = '{{ __("messages.courses") }}';
            if (modalMessage) modalMessage.textContent = '{{ __("messages.we_will_contact") }}';
            if (modalPhone) modalPhone.textContent = '{{ __("messages.contact_phone") }}';
            if (modalTelegram) modalTelegram.textContent = '{{ __("messages.contact_telegram") }}';
            if (modalBtnText) modalBtnText.textContent = '{{ __("messages.understand") }}';
        }

        function closeApplicationModal() {
            const modal = document.getElementById('applicationSuccessModal');
            if (modal) {
                modal.classList.remove('active');
                if (window.modalTimeout) {
                    clearTimeout(window.modalTimeout);
                    window.modalTimeout = null;
                }
            }
        }

        // Escape tugmasi bilan yopish
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') {
                closeApplicationModal();
            }
        });
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
                                <div class="icon-box">
                                    <img src="https://cdn-icons-png.flaticon.com/512/3200/3200650.png"
                                        alt="Ofis menejerligi">
                                </div>
                                <h5 class="card-title">Ofis menejerligi</h5>
                            </div>
                        </a>

                        <!-- 2. Algoritm asoslari -->
                        <a href="/courses/algorithm" class="card-link">
                            <div class="card-item">
                                <div class="icon-box">
                                    <img src="https://cdn-icons-png.flaticon.com/512/11068/11068779.png"
                                        alt="Algoritm asoslari">
                                </div>
                                <h5 class="card-title">Algoritm asoslari</h5>
                            </div>
                        </a>

                        <!-- 3. Frontend -->
                        <a href="{{ route('courses.frontend') }}" class="card-link">
                            <div class="card-item">
                                <div class="icon-box">
                                    <img src="https://us.123rf.com/450wm/dxinerz/dxinerz1601/dxinerz160103363/51258851-code-seo-web-symbol-vektor-bild-kann-auch-f%C3%BCr-seo-und-entwicklungsdienste-verwendet-werden.jpg?ver=6"
                                        alt="Frontend">
                                </div>
                                <h5 class="card-title">Frontend</h5>
                            </div>
                        </a>

                        <!-- 4. Backend -->
                        <a href="{{ route('courses.backend') }}" class="card-link">
                            <div class="card-item">
                                <div class="icon-box">
                                    <img src="https://www.shutterstock.com/image-vector/backend-developer-icon-mixed-vector-600nw-2655399835.jpg"
                                        alt="Backend">
                                </div>
                                <h5 class="card-title">Backend</h5>
                            </div>
                        </a>

                        <!-- 5. Python -->
                        <a href="{{ route('courses.python') }}" class="card-link">
                            <div class="card-item">
                                <div class="icon-box">
                                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/c3/Python-logo-notext.svg/1280px-Python-logo-notext.svg.png"
                                        alt="Python">
                                </div>
                                <h5 class="card-title">Python</h5>
                            </div>
                        </a>

                        <!-- 6. Robototexnika -->
                        <a href="/courses/robotics" class="card-link">
                            <div class="card-item">
                                <div class="icon-box">
                                    <img src="https://cdn-icons-png.flaticon.com/512/4727/4727488.png" alt="Robototexnika">
                                </div>
                                <h5 class="card-title">Robototexnika</h5>
                            </div>
                        </a>

                        <!-- 7. Raqamli bolalar (YANGI - bola + laptop raqamli o'qish) -->
                        <a href="/courses/digital-kids" class="card-link">
                            <div class="card-item">
                                <div class="icon-box">
                                    <img src="https://cdn-icons-png.flaticon.com/512/3688/3688127.png"
                                        alt="Raqamli bolalar">
                                </div>
                                <h5 class="card-title">Raqamli bolalar</h5>
                            </div>
                        </a>

                        <!-- 8. Tizim muhandisligi -->
                        <a href="/courses/system-engineering" class="card-link">
                            <div class="card-item">
                                <div class="icon-box">
                                    <img src="https://cdn-icons-png.flaticon.com/512/1055/1055687.png"
                                        alt="Tizim muhandisligi">
                                </div>
                                <h5 class="card-title">Tizim muhandisligi</h5>
                            </div>
                        </a>

                        <!-- 9. DevOps asoslari -->
                        <a href="/courses/devops" class="card-link">
                            <div class="card-item">
                                <div class="icon-box">
                                    <img src="https://cdn-icons-png.flaticon.com/512/5115/5115293.png"
                                        alt="DevOps asoslari">
                                </div>
                                <h5 class="card-title">DevOps asoslari</h5>
                            </div>
                        </a>

                        <!-- 10. Data analitika -->
                        <a href="/courses/data-analytics" class="card-link">
                            <div class="card-item">
                                <div class="icon-box">
                                    <img src="https://cdn-icons-png.flaticon.com/512/1055/1055685.png" alt="Data analitika">
                                </div>
                                <h5 class="card-title">Data analitika</h5>
                            </div>
                        </a>

                        <!-- 11. Tarmoq administratorligi -->
                        <a href="/courses/network-admin" class="card-link">
                            <div class="card-item">
                                <div class="icon-box">
                                    <img src="https://cdn-icons-png.flaticon.com/512/14357/14357432.png"
                                        alt="Tarmoq administratorligi">
                                </div>
                                <h5 class="card-title">Tarmoq administratorligi</h5>
                            </div>
                        </a>

                        <!-- 12. Buxgalteriya -->
                        <a href="/courses/accounting" class="card-link">
                            <div class="card-item">
                                <div class="icon-box">
                                    <img src="https://cdn-icons-png.flaticon.com/512/9703/9703558.png" alt="Buxgalteriya">
                                </div>
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

    <div id="projects" class="cards-2">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="h2-heading">{{ __('messages.projects_title') }}</h2>
                    <p class="text-muted mb-4" style="font-size: 1rem;">
                        <i class="fas fa-rocket me-2"></i> Bizning eng yaxshi loyihalarimiz
                    </p>
                </div>
            </div>

            <div class="row justify-content-center mt-4 g-4">
                <!-- 1. Iqro Agency -->
                <div class="col-md-6 col-lg-4 mb-4 d-flex justify-content-center">
                    <div class="project-card-neo">
                        <img class="img-fluid w-100" src="{{ asset('images/iqro.png') }}" alt="Iqro">
                        <div class="card-body">
                            <h5 class="card-title">@lang('messages.project1_title')</h5>
                            <p class="card-text">@lang('messages.project1_desc')</p>
                            <a href="https://iqroagency.uz/uz" class="btn-neo" target="_blank">
                                @lang('messages.read_more') <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- 2. Delever -->
                <div class="col-md-6 col-lg-4 mb-4 d-flex justify-content-center">
                    <div class="project-card-neo">
                        <img class="img-fluid w-100" src="{{ asset('images/delever.png') }}" alt="Delever">
                        <div class="card-body">
                            <h5 class="card-title">@lang('messages.project2_title')</h5>
                            <p class="card-text">@lang('messages.project2_desc')</p>
                            <a href="https://www.delever.uz/" class="btn-neo" target="_blank">
                                @lang('messages.read_more') <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- 3. KIDI -->
                <div class="col-md-6 col-lg-4 mb-4 d-flex justify-content-center">
                    <div class="project-card-neo">
                        <img class="img-fluid w-100" src="{{ asset('images/kidi.png') }}" alt="Kidi">
                        <div class="card-body">
                            <h5 class="card-title">@lang('messages.project3_title')</h5>
                            <p class="card-text">@lang('messages.project3_desc')</p>
                            <a href="https://kidi.uz/" class="btn-neo" target="_blank">
                                @lang('messages.read_more') <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- 4. Growz -->
                <div class="col-md-6 col-lg-4 mb-4 d-flex justify-content-center">
                    <div class="project-card-neo">
                        <img class="img-fluid w-100" src="{{ asset('images/growz.png') }}" alt="Growz">
                        <div class="card-body">
                            <h5 class="card-title">@lang('messages.project4_title')</h5>
                            <p class="card-text">@lang('messages.project4_desc')</p>
                            <a href="https://admin.growz.io/login" class="btn-neo" target="_blank">
                                @lang('messages.read_more') <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- 5. Wasteless -->
                <div class="col-md-6 col-lg-4 mb-4 d-flex justify-content-center">
                    <div class="project-card-neo">
                        <img class="img-fluid w-100" src="{{ asset('images/wasteles.png') }}" alt="Wasteless">
                        <div class="card-body">
                            <h5 class="card-title">@lang('messages.project5_title')</h5>
                            <p class="card-text">@lang('messages.project5_desc')</p>
                            <a href="https://admin.wasteless.uz/login" class="btn-neo" target="_blank">
                                @lang('messages.read_more') <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- 6. Urecruit -->
                <div class="col-md-6 col-lg-4 mb-4 d-flex justify-content-center">
                    <div class="project-card-neo">
                        <img class="img-fluid w-100" src="{{ asset('images/urecruit.png') }}" alt="Urecruit">
                        <div class="card-body">
                            <h5 class="card-title">@lang('messages.project6_title')</h5>
                            <p class="card-text">@lang('messages.project6_desc')</p>
                            <a href="https://test.admin.urecruit.udevs.io/auth/login" class="btn-neo" target="_blank">
                                @lang('messages.read_more') <i class="fas fa-arrow-right"></i>
                            </a>
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
    <!-- Contact -->
    <div id="contact" class="form-1">
        <img class="decoration-star" src="{{ asset('images/decoration-star.svg') }}" alt="alternative">
        <img class="decoration-star-2" src="{{ asset('images/decoration-star.svg') }}" alt="alternative">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="image-container text-center">
                        <img class="img-fluid" src="images/itech.png" alt="support">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="text-container">
                        <h2>{{ __('messages.contact_title') }}</h2>
                        <form id="contactForm">
                            @csrf
                            <div class="form-group">
                                <input type="text" name="name" class="form-control-input"
                                    placeholder="{{ __('messages.your_name') }}" required>
                            </div>
                            <div class="form-group">
                                <input type="email" name="email" class="form-control-input"
                                    placeholder="{{ __('messages.email') }}" required>
                            </div>
                            <!-- Xabar maydoni olib tashlandi -->

                            <div id="alertMessage"></div>

                            <div class="form-group">
                                <button type="submit" id="submitBtn" class="form-control-submit-button">
                                    <span id="btnText">{{ __('messages.send') }}</span>
                                    <span id="btnSpinner" class="spinner-border spinner-border-sm" style="display: none;"
                                        role="status" aria-hidden="true"></span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Application Success Modal (ariza uchun popup) -->
    <!-- Application Success Modal (ariza uchun popup) -->
    <div id="applicationSuccessModal" class="application-modal-overlay">
        <div class="application-modal-container">
            <div class="application-success-icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <h3><i class="fas fa-graduation-cap me-2"></i><span
                    id="modalTitle">{{ __('messages.application_received') }}</span></h3>
            <div class="course-name-badge">
                <i class="fas fa-book-open me-1"></i> <span id="modalCourse">{{ __('messages.courses') }}</span>
            </div>
            <p style="margin-top: 15px;" id="modalMessage">{{ __('messages.we_will_contact') }}</p>
            <div style="background: #f0f9ff; border-radius: 12px; padding: 10px; margin: 15px 0;">
                <small style="color: #1e4a76;">
                    <i class="fas fa-phone-alt me-1"></i> <span id="modalPhone">{{ __('messages.contact_phone') }}</span>
                </small>
                <br>
                <small style="color: #1e4a76;">
                    <i class="fab fa-telegram me-1"></i> <span
                        id="modalTelegram">{{ __('messages.contact_telegram') }}</span>
                </small>
            </div>
            <button class="application-close-btn" onclick="closeApplicationModal()">
                <i class="fas fa-check me-2"></i> <span id="modalBtnText">{{ __('messages.understand') }}</span>
            </button>
        </div>
    </div>
@endsection