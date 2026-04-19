@extends('layouts.app')

@section('styles')
    <style>
        @keyframes fadeInScale {
            0% {
                opacity: 0;
                transform: scale(0.9);
            }

            100% {
                opacity: 1;
                transform: scale(1);
            }
        }

        .feedback-rotator:hover {
            transform: scale(1.02);
            box-shadow: 0 30px 50px rgba(0, 0, 0, 0.3);
        }

        /* Modern Card Styles */
        .modern-card {
            background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
            border-radius: 20px;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            position: relative;
        }

        .modern-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
            transform: scaleX(0);
            transition: transform 0.4s ease;
        }

        .modern-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        .modern-card:hover::before {
            transform: scaleX(1);
        }

        .card-img-wrapper {
            position: relative;
            overflow: hidden;
            height: 240px;
        }

        .card-img-top {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.6s ease;
        }

        .modern-card:hover .card-img-top {
            transform: scale(1.1);
        }

        .card-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.8);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .modern-card:hover .card-overlay {
            opacity: 1;
        }

        .overlay-link {
            color: white;
            text-decoration: none;
            padding: 12px 24px;
            border: 2px solid white;
            border-radius: 50px;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .overlay-link:hover {
            background: white;
            color: #333;
            transform: scale(1.05);
        }

        .card-body {
            padding: 1.5rem;
        }

        .project-icon {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
        }

        .card-title {
            font-size: 1.35rem;
            font-weight: 700;
            margin-bottom: 0.75rem;
            color: #2d3748;
        }

        .card-text {
            color: #718096;
            line-height: 1.6;
            margin-bottom: 1.25rem;
        }

        .btn-link {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
        }

        .btn-link i {
            transition: transform 0.3s ease;
        }

        .btn-link:hover {
            color: #764ba2;
            gap: 12px;
        }

        .btn-link:hover i {
            transform: translateX(5px);
        }

        .gradient-text {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .divider {
            width: 60px;
            height: 3px;
            background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
            border-radius: 3px;
        }

        @media (max-width: 768px) {
            .card-img-wrapper {
                height: 200px;
            }

            .card-body {
                padding: 1.25rem;
            }

            .card-title {
                font-size: 1.2rem;
            }
        }
    </style>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

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

        .cards-2 .col-md-6,
        .cards-2 .col-lg-4 {
            margin-bottom: 2rem !important;
            padding-left: 15px !important;
            padding-right: 15px !important;
            max-width: 33.333% !important;
            flex: 0 0 33.333% !important;
        }

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

        .spinner-border-sm {
            animation-duration: 1s;
        }

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

        #contact .image-container img {
            width: 100%;
            max-width: 520px;
            height: auto;
            border-radius: 30px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
            transition: all 0.4s ease;
            object-fit: cover;
        }

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

        .registration-modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.75);
            backdrop-filter: blur(8px);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1070;
            visibility: hidden;
            opacity: 0;
            transition: all 0.3s ease;
        }

        .registration-modal-overlay.active {
            visibility: visible;
            opacity: 1;
        }

        .registration-modal {
            background: linear-gradient(145deg, #ffffff, #f8fafc);
            max-width: 450px;
            width: 90%;
            border-radius: 32px;
            padding: 2rem;
            text-align: center;
            position: relative;
            transform: scale(0.9);
            transition: transform 0.3s ease;
            box-shadow: 0 30px 50px rgba(0, 0, 0, 0.3);
        }

        .registration-modal-overlay.active .registration-modal {
            transform: scale(1);
        }

        .registration-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #f59e0b, #ef4444);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.2rem auto;
        }

        .registration-icon i {
            font-size: 2.5rem;
            color: white;
        }

        .registration-modal h3 {
            font-size: 1.6rem;
            font-weight: 800;
            color: #1e293b;
            margin-bottom: 0.75rem;
        }

        .registration-modal p {
            color: #64748b;
            font-size: 0.95rem;
            margin-bottom: 1.5rem;
            line-height: 1.5;
        }

        .registration-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn-register-redirect {
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            border: none;
            padding: 12px 28px;
            border-radius: 50px;
            color: white;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
        }

        .btn-register-redirect:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(59, 130, 246, 0.3);
            color: white;
        }

        .btn-register-close {
            background: transparent;
            border: 1px solid #cbd5e1;
            padding: 12px 28px;
            border-radius: 50px;
            color: #64748b;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-register-close:hover {
            background: #f1f5f9;
            border-color: #94a3b8;
        }

        /* About Section Styles */
        .about-section {
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            padding: 4rem 0;
        }

        .about-text {
            font-size: 1.05rem;
            line-height: 1.8;
            color: #334155;
            max-width: 900px;
            margin: 0 auto;
        }
    </style>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // ========== REGISTRATION MODAL ==========
        function showRegistrationModal() {
            let modal = document.getElementById('registrationModal');
            if (modal) {
                modal.classList.add('active');
                if (window.regModalTimeout) clearTimeout(window.regModalTimeout);
                window.regModalTimeout = setTimeout(function () {
                    closeRegistrationModal();
                }, 5000);
            }
        }

        function closeRegistrationModal() {
            const modal = document.getElementById('registrationModal');
            if (modal) {
                modal.classList.remove('active');
                if (window.regModalTimeout) {
                    clearTimeout(window.regModalTimeout);
                    window.regModalTimeout = null;
                }
            }
        }

        // ========== APPLICATION SUCCESS MODAL ==========
        function showApplicationSuccessModal() {
            let modal = document.getElementById('applicationSuccessModal');
            if (modal) {
                updateModalLanguage();
                modal.classList.add('active');
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

        // ========== TELEFON MASK ==========
        const phoneField = document.getElementById('phone');
        if (phoneField) {
            phoneField.addEventListener('input', function (e) {
                let x = e.target.value.replace(/\D/g, '').match(/(\d{0,3})(\d{0,2})(\d{0,3})(\d{0,2})(\d{0,2})/);
                if (x) {
                    let result = '';
                    if (x[1]) result = '+' + x[1];
                    if (x[2]) result += ' (' + x[2];
                    if (x[3]) result += ') ' + x[3];
                    if (x[4]) result += '-' + x[4];
                    if (x[5]) result += '-' + x[5];
                    e.target.value = result;
                }
            });

            phoneField.addEventListener('focus', function (e) {
                if (e.target.value === '') {
                    e.target.value = '+998 ';
                }
            });

            phoneField.addEventListener('blur', function (e) {
                if (e.target.value === '+998 ' || e.target.value === '+998' || e.target.value === '+998 () ') {
                    e.target.value = '';
                }
            });
        }

        // ========== ESCAPE TUGMASI ==========
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') {
                closeRegistrationModal();
                closeApplicationModal();
            }
        });

        // ========== FEEDBACK ROTATOR (BARABAN) ==========
        let rotatorInterval = null;

        function loadFeedbacksForRotator() {
            console.log('Loading feedbacks...');
            $.ajax({
                url: '/feedbacks',
                type: 'GET',
                dataType: 'json',
                success: function (feedbacks) {
                    console.log('Feedbacks received:', feedbacks.length);
                    if (!feedbacks || feedbacks.length === 0) {
                        $('#rotatingFeedbackContent').html(`
                                                                                        <i class="fas fa-comment-dots fa-2x mb-2"></i>
                                                                                        <p>Hozircha fikr yo‘q.<br>Birinchi bo‘lib fikr qoldiring!</p>
                                                                                    `);
                        return;
                    }
                    startRotator(feedbacks);
                },
                error: function (xhr, status, error) {
                    console.error('Error:', status, error);
                    $('#rotatingFeedbackContent').html('<i class="fas fa-exclamation-triangle"></i> Xatolik yuz berdi');
                }
            });
        }

        function startRotator(feedbacks) {
            if (rotatorInterval) clearInterval(rotatorInterval);

            let index = 0;

            function rotate() {
                if (!feedbacks[index]) return;

                const fb = feedbacks[index];
                let message = fb.message || '';
                if (message.length > 120) message = message.substring(0, 117) + '...';

                $('#rotatingFeedbackContent').html(`
                                                                                <div style="animation: fadeInScale 0.4s ease;">
                                                                                    <i class="fas fa-quote-left fa-2x mb-3 opacity-50"></i>
                                                                                    <p style="font-size: 1rem; font-style: italic; margin-bottom: 15px;">“${escapeHtml(message)}”</p>
                                                                                    <div style="font-weight: bold; font-size: 1rem;">— ${escapeHtml(fb.name)}</div>
                                                                                    <i class="fas fa-quote-right fa-2x mt-2 opacity-50"></i>
                                                                                </div>
                                                                            `);

                index = (index + 1) % feedbacks.length;
            }

            rotate();
            rotatorInterval = setInterval(rotate, 5000);
        }

        function escapeHtml(str) {
            if (!str) return '';
            return String(str).replace(/[&<>]/g, function (m) {
                if (m === '&') return '&amp;';
                if (m === '<') return '&lt;';
                if (m === '>') return '&gt;';
                return m;
            });
        }

        // ========== FORM SUBMIT ==========
        $(document).ready(function () {
            loadFeedbacksForRotator();

            $("#contactForm").submit(function (e) {
                e.preventDefault();

                const isLoggedIn = @json(auth()->check());

                if (!isLoggedIn) {
                    showRegistrationModal();
                    return;
                }

                const submitBtn = document.getElementById('submitBtn');
                const btnText = document.getElementById('btnText');
                const btnSpinner = document.getElementById('btnSpinner');

                submitBtn.disabled = true;
                btnText.style.display = 'none';
                btnSpinner.style.display = 'inline-block';

                var form = $(this);

                $.ajax({
                    url: '/contact-send',
                    type: "POST",
                    data: form.serialize(),
                    success: function (result) {
                        showApplicationSuccessModal();
                        form[0].reset();
                        loadFeedbacksForRotator();
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
                        submitBtn.disabled = false;
                        btnText.style.display = 'inline';
                        btnSpinner.style.display = 'none';
                    }
                });
            });
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

    <!-- About Section (iTech haqida) -->
    <div class="about-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="display-5 fw-bold mb-4 gradient-text">iTech haqida</h2>
                    <div class="divider mx-auto mb-4"></div>
                    <p class="about-text">
                        iTech o‘quv markazi dasturlash va IT sohasida amaliy bilim berishga ixtisoslashgan.
                        O‘quv dasturlarimiz real loyiha tajribasiga asoslangan bo‘lib, talabalarni ish bozoriga
                        tayyor mutaxassis sifatida shakllantirishga qaratilgan. Har bir kurs zamonaviy texnologiyalar,
                        mentorlik yordami va amaliy topshiriqlar bilan olib boriladi. Maqsadimiz — kuchli,
                        mustaqil va talabgir dasturchilarni yetishtirish.
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
                        @foreach($courses as $course)
                            <a href="{{ route('courses.show', $course->id) }}" class="card-link">
                                <div class="card-item">
                                    <div class="icon-box">
                                        @if($course->image)
                                            <img src="{{ asset('storage/courses/' . $course->image) }}" alt="{{ $course->title }}">
                                        @else
                                            <i class="fas fa-graduation-cap fa-3x text-primary"></i>
                                        @endif
                                    </div>
                                    <h5 class="card-title">{{ $course->title }}</h5>
                                </div>
                            </a>
                        @endforeach
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
    <div id="projects" class="cards-2 py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center mb-5">
                    <h2 class="display-5 fw-bold mb-3 gradient-text">{{ __('messages.projects_title') }}</h2>
                    <div class="divider mx-auto"></div>
                    <p class="text-muted fs-5">Инновационные решения для современного бизнеса</p>
                </div>
            </div>
            <div class="row g-4 justify-content-center">
                <div class="col-md-6 col-lg-4">
                    <div class="modern-card h-100">
                        <div class="card-img-wrapper">
                            <img class="card-img-top" src="{{ asset('images/iqro.png') }}" alt="Iqro">
                            <div class="card-overlay">
                                <a href="https://iqroagency.uz/uz" class="overlay-link" target="_blank">
                                    <i class="fas fa-external-link-alt"></i> Посмотреть проект
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="project-icon mb-3"><i class="fas fa-rocket"></i></div>
                            <h5 class="card-title">@lang('messages.project1_title')</h5>
                            <p class="card-text">@lang('messages.project1_desc')</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="modern-card h-100">
                        <div class="card-img-wrapper">
                            <img class="card-img-top" src="{{ asset('images/delever.png') }}" alt="Delever">
                            <div class="card-overlay">
                                <a href="https://www.delever.uz/" class="overlay-link" target="_blank">
                                    <i class="fas fa-external-link-alt"></i> Посмотреть проект
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="project-icon mb-3"><i class="fas fa-chart-line"></i></div>
                            <h5 class="card-title">@lang('messages.project2_title')</h5>
                            <p class="card-text">@lang('messages.project2_desc')</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="modern-card h-100">
                        <div class="card-img-wrapper">
                            <img class="card-img-top" src="{{ asset('images/kidi.png') }}" alt="Kidi">
                            <div class="card-overlay">
                                <a href="https://kidi.uz/" class="overlay-link" target="_blank">
                                    <i class="fas fa-external-link-alt"></i> Посмотреть проект
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="project-icon mb-3"><i class="fas fa-child"></i></div>
                            <h5 class="card-title">@lang('messages.project3_title')</h5>
                            <p class="card-text">@lang('messages.project3_desc')</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="modern-card h-100">
                        <div class="card-img-wrapper">
                            <img class="card-img-top" src="{{ asset('images/growz.png') }}" alt="Growz">
                            <div class="card-overlay">
                                <a href="https://admin.growz.io/login" class="overlay-link" target="_blank">
                                    <i class="fas fa-external-link-alt"></i> Посмотреть проект
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="project-icon mb-3"><i class="fas fa-seedling"></i></div>
                            <h5 class="card-title">@lang('messages.project4_title')</h5>
                            <p class="card-text">@lang('messages.project4_desc')</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="modern-card h-100">
                        <div class="card-img-wrapper">
                            <img class="card-img-top" src="{{ asset('images/wasteles.png') }}" alt="Wasteless">
                            <div class="card-overlay">
                                <a href="https://admin.wasteless.uz/login" class="overlay-link" target="_blank">
                                    <i class="fas fa-external-link-alt"></i> Посмотреть проект
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="project-icon mb-3"><i class="fas fa-recycle"></i></div>
                            <h5 class="card-title">@lang('messages.project5_title')</h5>
                            <p class="card-text">@lang('messages.project5_desc')</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="modern-card h-100">
                        <div class="card-img-wrapper">
                            <img class="card-img-top" src="{{ asset('images/urecruit.png') }}" alt="Urecruit">
                            <div class="card-overlay">
                                <a href="https://test.admin.urecruit.udevs.io/auth/login" class="overlay-link"
                                    target="_blank">
                                    <i class="fas fa-external-link-alt"></i> Посмотреть проект
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="project-icon mb-3"><i class="fas fa-users"></i></div>
                            <h5 class="card-title">@lang('messages.project6_title')</h5>
                            <p class="card-text">@lang('messages.project6_desc')</p>
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

                                @foreach($feedbacks as $feedback)
                                    <div class="swiper-slide">

                                        <img class="testimonial-image"
                                            src="{{ $feedback->avatar ?? asset('images/testimonial-1.jpg') }}" alt="user">

                                        <p class="testimonial-text">
                                            “{{ $feedback->message }}”
                                        </p>

                                        <div class="testimonial-author">
                                            {{ $feedback->name }}
                                        </div>

                                        <div class="testimonial-position">
                                            {{ $feedback->date }}
                                        </div>

                                    </div>
                                @endforeach

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
                                    placeholder="{{ __('messages.your_name') }}"
                                    value="{{ old('name', auth()->check() ? auth()->user()->name : '') }}" required>
                            </div>
                            <div class="form-group">
                                <input type="email" name="email" class="form-control-input"
                                    placeholder="{{ __('messages.email') }}"
                                    value="{{ old('email', auth()->check() ? auth()->user()->email : '') }}" required>
                            </div>
                            <div class="form-group">
                                <input type="tel" name="phone" id="phone" class="form-control-input" placeholder=""
                                    value="+(998) ">
                            </div>
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
    <!-- Feedback Carousel (Kartochka shaklida) -->


    <!-- Modals -->
    <div id="registrationModal" class="registration-modal-overlay">
        <div class="registration-modal">
            <div class="registration-icon"><i class="fas fa-user-plus"></i></div>
            <h3><i class="fas fa-sign-in-alt me-2"></i>Registratsiya talab qilinadi!</h3>
            <p>Ariza qoldirish uchun avval tizimda ro'yxatdan o'tishingiz kerak!</p>
            <div class="registration-buttons">
                <a href="{{ route('register') }}" class="btn-register-redirect"><i class="fas fa-user-plus me-2"></i>
                    Ro'yxatdan o'tish</a>
                <a href="{{ route('login') }}" class="btn-register-redirect"
                    style="background: linear-gradient(135deg, #10b981, #059669);"><i class="fas fa-sign-in-alt me-2"></i>
                    Kirish</a>
                <button class="btn-register-close" onclick="closeRegistrationModal()"><i class="fas fa-times me-2"></i>
                    Yopish</button>
            </div>
            <hr style="margin: 1.5rem 0 1rem;">
            <div style="font-size: 12px; color: #6c757d; text-align: center;">Ro'yxatdan o'ting va barcha imkoniyatlardan
                foydalaning</div>
        </div>
    </div>

    <div id="applicationSuccessModal" class="application-modal-overlay">
        <div class="application-modal-container">
            <div class="application-success-icon"><i class="fas fa-check-circle"></i></div>
            <h3><i class="fas fa-graduation-cap me-2"></i><span
                    id="modalTitle">{{ __('messages.application_received') }}</span></h3>
            <div class="course-name-badge"><i class="fas fa-book-open me-1"></i> <span
                    id="modalCourse">{{ __('messages.courses') }}</span></div>
            <p style="margin-top: 15px;" id="modalMessage">{{ __('messages.we_will_contact') }}</p>
            <div style="background: #f0f9ff; border-radius: 12px; padding: 10px; margin: 15px 0;">
                <small style="color: #1e4a76;"><i class="fas fa-phone-alt me-1"></i> <span
                        id="modalPhone">{{ __('messages.contact_phone') }}</span></small><br>
                <small style="color: #1e4a76;"><i class="fab fa-telegram me-1"></i> <span
                        id="modalTelegram">{{ __('messages.contact_telegram') }}</span></small>
            </div>
            <button class="application-close-btn" onclick="closeApplicationModal()"><i class="fas fa-check me-2"></i> <span
                    id="modalBtnText">{{ __('messages.understand') }}</span></button>
        </div>
    </div>
@endsection