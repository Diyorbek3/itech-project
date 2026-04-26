<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
            background-color: #f4f7f9;
        }
        .container {
            max-width: 600px;
            margin: 40px auto;
            background: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(0,0,0,0.05);
        }
        .header {
            background: linear-gradient(135deg, #161b22 0%, #0d1117 100%);
            padding: 30px;
            text-align: center;
        }
        .header img {
            width: 60px;
            border-radius: 50%;
        }
        .content {
            padding: 40px;
            text-align: center;
        }
        h1 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #111;
        }
        p {
            font-size: 16px;
            color: #666;
            margin-bottom: 30px;
        }
        .otp-code {
            font-size: 42px;
            font-weight: 800;
            letter-spacing: 10px;
            color: #238636;
            background: #f0fdf4;
            padding: 20px;
            border-radius: 8px;
            display: inline-block;
            border: 1px dashed #238636;
            margin-bottom: 30px;
        }
        .footer {
            background: #f9fafb;
            padding: 20px;
            text-align: center;
            font-size: 12px;
            color: #999;
            border-top: 1px solid #eee;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="{{ $message->embed(public_path('images/logo.png')) }}" alt="ITech Academy">
        </div>
        <div class="content">
            <h1>{{ __('messages.reset_password_title') }}</h1>
            <p>{{ __('messages.otp_mail_instruction') }}</p>
            <div class="otp-code">{{ $otp }}</div>
            <p>{{ __('messages.otp_mail_expiry', ['minutes' => 60]) }}</p>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} ITech Academy. All rights reserved.
        </div>
    </div>
</body>
</html>
