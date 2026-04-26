<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <title>{{ __('messages.reset_password_title') }} | ITech Academy</title>

    <link href="/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #0d1117;
            color: #ffffff;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Helvetica, Arial, sans-serif;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
        }
        .reset-container {
            width: 100%;
            max-width: 400px;
        }
        .brand-logo {
            display: block;
            margin: 0 auto 25px;
            width: 60px;
            border-radius: 50%;
        }
        .reset-card {
            background-color: #161b22;
            border: 1px solid #30363d;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 8px 24px rgba(0,0,0,0.5);
        }
        .form-label {
            font-size: 14px;
            color: #8b949e;
            display: block;
            margin-bottom: 8px;
        }
        .question-text {
            font-size: 18px;
            font-weight: 600;
            color: #58a6ff;
            margin-bottom: 20px;
            padding: 15px;
            background: rgba(88, 166, 255, 0.1);
            border-radius: 8px;
            border-left: 4px solid #58a6ff;
        }
        .form-control {
            background-color: #0d1117 !important;
            border: 1px solid #30363d !important;
            color: #ffffff !important;
            padding: 12px;
            font-size: 15px;
            border-radius: 8px;
        }
        .form-control:focus {
            border-color: #58a6ff !important;
            box-shadow: 0 0 0 3px rgba(31, 111, 235, 0.3) !important;
            outline: none;
        }
        .btn-verify {
            background: linear-gradient(135deg, #238636 0%, #2ea043 100%);
            color: white;
            width: 100%;
            border: none;
            border-radius: 8px;
            padding: 12px;
            font-weight: 600;
            margin-top: 20px;
            transition: transform 0.2s;
        }
        .btn-verify:hover {
            transform: translateY(-2px);
            background: linear-gradient(135deg, #2ea043 0%, #3fb950 100%);
        }
        .back-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #8b949e;
            text-decoration: none;
            font-size: 14px;
        }
        .back-link:hover {
            color: #58a6ff;
        }
    </style>
</head>
<body>

<div class="reset-container">
    <a href="/">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="brand-logo">
    </a>
    
    <div class="reset-card">
        <h4 class="text-center mb-4">{{ __('messages.security_verification') }}</h4>
        <p class="text-center text-muted mb-4" style="font-size: 14px;">
            {{ __('messages.verify_question_intro') }}
        </p>

        <div class="question-text">
            {{ $question }}
        </div>

        <form method="POST" action="{{ route('password.verify-question') }}">
            @csrf
            
            <div class="mb-3">
                <label class="form-label">{{ __('messages.your_answer') }}</label>
                <input type="text" name="answer" class="form-control" required autofocus autocomplete="off" placeholder="{{ __('messages.answer_placeholder') }}">
                @error('answer')
                    <span class="text-danger" style="font-size: 12px;">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn btn-verify">
                {{ __('messages.verify_and_continue') }}
            </button>
        </form>

        <a href="{{ route('login') }}" class="back-link">
            ← {{ __('messages.back_to_signin') }}
        </a>
    </div>
</div>

</body>
</html>
