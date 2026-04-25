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
            max-width: 340px;
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
            border-radius: 6px;
            padding: 20px;
        }
        .form-label {
            font-size: 14px;
            display: block;
            margin-bottom: 8px;
        }
        .form-control {
            background-color: #0d1117 !important;
            border: 1px solid #30363d !important;
            color: #ffffff !important;
            padding: 5px 12px;
            font-size: 14px;
            border-radius: 6px;
        }
        .form-control:focus {
            border-color: #58a6ff !important;
            box-shadow: 0 0 0 3px rgba(31, 111, 235, 0.3) !important;
            outline: none;
        }
        .btn-reset {
            background-color: #238636;
            color: white;
            width: 100%;
            border: 1px solid rgba(240, 246, 252, 0.1);
            border-radius: 6px;
            padding: 8px;
            font-weight: 600;
            margin-top: 15px;
        }
        .btn-reset:hover {
            background-color: #2ea043;
        }
    </style>
</head>
<body>

<div class="reset-container">
    <a href="/">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="brand-logo">
    </a>
    
    <div class="reset-card">
        <h5 class="text-center mb-4">{{ __('messages.reset_password_title') }}</h5>

        <form method="POST" action="{{ route('password.store') }}">
            @csrf
            
            <div class="mb-3">
                <label class="form-label">{{ __('messages.new_password') }}</label>
                <input type="password" name="password" class="form-control" required autocomplete="new-password" autofocus>
                @error('password')
                    <span class="text-danger" style="font-size: 12px;">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">{{ __('messages.confirm_password') }}</label>
                <input type="password" name="password_confirmation" class="form-control" required autocomplete="new-password">
                @error('password_confirmation')
                    <span class="text-danger" style="font-size: 12px;">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn btn-reset">
                {{ __('messages.reset_password') }}
            </button>
        </form>
    </div>
</div>

</body>
</html>
