<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">

    <title>{{ __('messages.log_in') }} | ITech Academy</title>

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
        .login-container {
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
        .login-card {
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
        .btn-login-style {
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
        .btn-login-style:hover {
            background-color: #2ea043;
            transform: translateY(-1px);
        }
        .register-callout {
            margin-top: 20px;
            text-align: center;
            font-size: 14px;
            text-shadow: 1px 1px 3px rgba(0,0,0,0.8);
        }
        .register-callout a {
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

<div class="login-container">
    <a href="/">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="brand-logo">
    </a>
    
    <h3>{{ __('messages.log_in') }}</h3>

    <div class="login-card">
        <form method="POST" action="{{ route('login') }}" id="loginForm">
            @csrf

            <div>
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

            <div class="mt-2 text-end">
                <a href="{{ route('password.request') }}" style="color: #58a6ff; font-size: 12px; text-decoration: none;">
                    {{ __('messages.forgot_password') }}?
                </a>
            </div>

            <button type="submit" class="btn btn-login-style">
                {{ __('messages.log_in') }}
            </button>
        </form>
    </div>

    <div class="register-callout">
        {{ __('messages.new_to_academy') }} <a href="{{ route('register') }}">→ {{ __('messages.sign_up') }}</a>
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

    document.getElementById('loginForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        let errors = [];
        const email = document.getElementById('email').value.trim();
        const password = document.getElementById('password').value;
        
        if (email === '') {
            errors.push('Email manzilini kiriting');
        } else if (!email.includes('@')) {
            errors.push('Email manzilida "@" belgisi bo\'lishi kerak');
        } else if (!email.includes('.')) {
            errors.push('Email manzilida "." belgisi bo\'lishi kerak');
        } 
        
        if (password === '') {
            errors.push('Parolni kiriting');
        } else if (password.length < 8) {
            errors.push('Parol kamida 8 ta belgidan iborat bo\'lishi kerak');
        }
        
        if (errors.length > 0) {
            Swal.fire({
                title: 'Xatolik!',
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
            title: 'Kirishda xatolik!',
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