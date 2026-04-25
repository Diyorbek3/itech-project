<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">

    <title>{{ __('messages.create_account') }} | ITech Academy</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
            background: linear-gradient(rgba(13, 17, 23, 0.7), rgba(13, 17, 23, 0.7)), 
                        url('{{ asset('images/AP2.jpg') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            color: #ffffff;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Helvetica, Arial, sans-serif;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
        }
        .register-container {
            width: 100%;
            max-width: 360px;
            z-index: 10;
            text-align: center;
        }
        .brand-logo {
            display: block;
            margin: 0 auto 15px;
            width: 75px;
            border-radius: 50%;
            box-shadow: 0 4px 15px rgba(0,0,0,0.5);
        }
        .register-card {
            background: none;
            border: none;
            padding: 10px;
            text-align: left;
        }
        .form-label {
            color: #ffffff !important;
            font-size: 14px;
            margin-bottom: 5px;
            display: block;
            text-shadow: 1px 1px 3px rgba(0,0,0,0.8);
            font-weight: 500;
        }
        .form-control {
            background-color: rgba(13, 17, 23, 0.7) !important;
            border: 1px solid rgba(255, 255, 255, 0.3) !important;
            color: #ffffff !important;
            height: 40px;
            font-size: 14px;
            border-radius: 6px;
            transition: 0.2s;
        }
        .form-control:focus {
            background-color: rgba(13, 17, 23, 0.9) !important;
            border-color: #58a6ff !important;
            box-shadow: 0 0 0 3px rgba(31, 111, 235, 0.3) !important;
            outline: none;
        }
        .btn-register-style {
            background-color: #238636;
            color: #ffffff;
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 6px;
            font-weight: 600;
            margin-top: 15px;
            cursor: pointer;
            transition: all 0.2s;
        }
        .btn-register-style:hover {
            background-color: #2ea043;
            transform: translateY(-1px);
        }
        .login-callout {
            margin-top: 20px;
            text-align: center;
            font-size: 14px;
            text-shadow: 1px 1px 3px rgba(0,0,0,0.8);
        }
        .login-callout a {
            color: #58a6ff;
            text-decoration: none;
            font-weight: 600;
        }
        h3 {
            text-shadow: 2px 2px 5px rgba(0,0,0,0.9);
            margin-bottom: 15px;
            font-size: 24px;
            font-weight: 300;
        }
        .toggle-password {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #8b949e;
            cursor: pointer;
            z-index: 20;
        }
        .position-relative {
            position: relative;
        }
        .swal2-popup {
            border-radius: 16px !important;
        }
        .swal2-timer-progress-bar {
            background: #f85149 !important;
        }
    </style>
</head>
<body>

<div class="register-container">
    <a href="/">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="brand-logo">
    </a>
    
    <h3>{{ __('messages.create_account') }}</h3>

    <div class="register-card">
        <form method="POST" action="{{ route('register') }}" id="registerForm">
            @csrf

            <div>
                <label class="form-label">{{ __('messages.full_name') }}</label>
                <input type="text" name="name" id="name" class="form-control" 
                       placeholder="{{ __('messages.name_placeholder') }}" value="{{ old('name') }}" required autofocus>
            </div>

            <div class="mt-3">
                <label class="form-label">{{ __('messages.email_address') }}</label>
                <input type="email" name="email" id="email" class="form-control" 
                       placeholder="example@gmail.com" value="{{ old('email') }}" required>
            </div>

            <div class="mt-3">
                <label class="form-label">{{ __('messages.password') }}</label>
                <div class="position-relative">
                    <input type="password" id="password" name="password" class="form-control" 
                           placeholder="••••••••" required>
                    <i class="fas fa-eye toggle-password" data-target="password"></i>
                </div>
            </div>

            <div class="mt-3">
                <label class="form-label">{{ __('messages.confirm_password') }}</label>
                <div class="position-relative">
                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" 
                           placeholder="••••••••" required>
                    <i class="fas fa-eye toggle-password" data-target="password_confirmation"></i>
                </div>
            </div>

            <div class="mt-3">
                <label class="form-label">{{ __('messages.security_question') }}</label>
                <select name="security_question" id="security_question" class="form-control" required>
                    <option value="" disabled selected>{{ __('messages.select_question') }}</option>
                    <option value="Sizning birinchi maktabingiz raqami?">Sizning birinchi maktabingiz raqami?</option>
                    <option value="Sizning birinchi uy hayvoningiz ismi?">Sizning birinchi uy hayvoningiz ismi?</option>
                    <option value="Onangizning qizlik familiyasi nima?">Onangizning qizlik familiyasi nima?</option>
                    <option value="Siz tug'ilgan shahar nomi?">Siz tug'ilgan shahar nomi?</option>
                    <option value="custom">{{ __('messages.custom_question') }}</option>
                </select>
            </div>

            <div class="mt-3 d-none" id="custom_question_container">
                <label class="form-label">{{ __('messages.custom_question_label') }}</label>
                <input type="text" name="custom_question" id="custom_question" class="form-control" 
                       placeholder="{{ __('messages.custom_question_placeholder') }}">
            </div>

            <div class="mt-3">
                <label class="form-label">{{ __('messages.security_answer') }}</label>
                <input type="text" name="security_answer" id="security_answer" class="form-control" 
                       placeholder="{{ __('messages.security_answer_placeholder') }}" required>
                <small class="text-white-50" style="font-size: 11px;">{{ __('messages.security_answer_hint') }}</small>
            </div>

            <button type="submit" class="btn-register-style">
                {{ __('messages.sign_up') }}
            </button>
        </form>
    </div>

    <div class="login-callout">
        {{ __('messages.already_have_account') }} <a href="{{ route('login') }}">→ {{ __('messages.log_in') }}</a>
    </div>
</div>

<script>
    document.querySelectorAll('.toggle-password').forEach(icon => {
        icon.addEventListener('click', function() {
            const targetId = this.getAttribute('data-target');
            const input = document.getElementById(targetId);
            if (input.type === 'password') {
                input.type = 'text';
                this.classList.remove('fa-eye');
                this.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                this.classList.remove('fa-eye-slash');
                this.classList.add('fa-eye');
            }
        });
    });

    document.getElementById('security_question').addEventListener('change', function() {
        const customContainer = document.getElementById('custom_question_container');
        if (this.value === 'custom') {
            customContainer.classList.remove('d-none');
            document.getElementById('custom_question').setAttribute('required', 'required');
        } else {
            customContainer.classList.add('d-none');
            document.getElementById('custom_question').removeAttribute('required');
        }
    });

    document.getElementById('registerForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        let errors = [];
        const name = document.getElementById('name').value.trim();
        const email = document.getElementById('email').value.trim();
        const password = document.getElementById('password').value;
        const passwordConfirm = document.getElementById('password_confirmation').value;
        const securityQuestion = document.getElementById('security_question').value;
        const customQuestion = document.getElementById('custom_question').value.trim();
        const securityAnswer = document.getElementById('security_answer').value.trim();
        
        const trans = {
            name_required: "{{ __('messages.name_required') }}",
            name_min: "{{ __('messages.name_min') }}",
            email_required: "{{ __('messages.email_required') }}",
            email_invalid: "{{ __('messages.email_invalid') }}",
            password_required: "{{ __('messages.password_required') }}",
            password_min: "{{ __('messages.password_min') }}",
            password_mismatch: "{{ __('messages.password_mismatch') }}",
            error_title: "{{ __('messages.error_title') }}"
        };

        if (name === '') {
            errors.push(trans.name_required);
        } else if (name.length < 3) {
            errors.push(trans.name_min);
        }
        
        if (email === '') {
            errors.push(trans.email_required);
        } else if (!email.includes('@') || !email.includes('.')) {
            errors.push(trans.email_invalid);
        }
        
        if (password === '') {
            errors.push(trans.password_required);
        } else if (password.length < 8) {
            errors.push(trans.password_min);
        }
        
        if (password !== passwordConfirm) {
            errors.push(trans.password_mismatch);
        }

        if (securityQuestion === '') {
            errors.push("{{ __('messages.select_question') }}");
        } else if (securityQuestion === 'custom' && customQuestion === '') {
            errors.push("{{ __('messages.custom_question_label') }}");
        }

        if (securityAnswer === '') {
            errors.push("{{ __('messages.security_answer_placeholder') }}");
        }
        
        if (errors.length > 0) {
            Swal.fire({
                title: trans.error_title,
                html: errors.map(err => `• ${err}`).join('<br>'),
                icon: 'error',
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 5000,
                timerProgressBar: true,
                background: '#1e1e2e',
                color: '#fff',
                iconColor: '#f85149'
            });
        } else {
            this.submit();
        }
    });
    
    @if($errors->any())
        let serverErrors = [];
        @foreach($errors->all() as $error)
            serverErrors.push('{{ $error }}');
        @endforeach
        Swal.fire({
            title: "{{ __('messages.error_title') }}",
            html: serverErrors.map(err => `• ${err}`).join('<br>'),
            icon: 'error',
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 5000,
            timerProgressBar: true,
            background: '#1e1e2e',
            color: '#fff',
            iconColor: '#f85149'
        });
    @endif
</script>

</body>
</html>