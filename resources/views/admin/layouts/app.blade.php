<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Panel - @yield('title', 'Dashboard')</title>

    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,400;0,600;0,700;1,400&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <link href="/css/swiper.css" rel="stylesheet">
    <link href="/css/styles.css" rel="stylesheet">
    <link rel="icon" href="/images/logo.png">
    
    <style>
        .course-hero { margin-top: 130px !important; }
        .test-panel-container { padding: 20px; margin-top: 100px; }
        .stat-card { background: white; border-radius: 15px; padding: 20px; text-align: center; box-shadow: 0 2px 10px rgba(0,0,0,0.05); }
        .stat-value { font-size: 2rem; font-weight: 800; color: #1e293b; }
        .stat-label { color: #64748b; font-size: 0.9rem; }
        .badge-active { background: #10b981; color: white; padding: 5px 12px; border-radius: 20px; font-size: 12px; }
        .badge-pending { background: #f59e0b; color: white; padding: 5px 12px; border-radius: 20px; font-size: 12px; }
        .btn-gradient { background: linear-gradient(135deg, #667eea, #764ba2); border: none; color: white; padding: 8px 20px; border-radius: 10px; }
        .data-table { background: white; border-radius: 15px; overflow: hidden; box-shadow: 0 2px 10px rgba(0,0,0,0.05); }
        .data-table th { background: #f8fafc; padding: 15px; }
        .data-table td { padding: 15px; border-bottom: 1px solid #eef2f6; }
    </style>
    
    @yield('styles')
</head>

<body>
    <script>
        function changeLanguage(locale) {
            window.location.href = '/language/' + locale;
        }
    </script>

    @include('components.header')

    <main>
        <div class="test-panel-container">
            @yield('content')
        </div>
    </main>

    @include('components.footer')

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/swiper.min.js') }}"></script>
    <script src="{{ asset('js/purecounter.min.js') }}"></script>
    <script src="{{ asset('js/scripts.js') }}"></script>

    @yield('scripts')

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
</body>
</html>