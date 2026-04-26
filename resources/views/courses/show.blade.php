@extends('layouts.app')

@section('content')
    <div class="course-detail-page">
        <!-- Hero Section -->
        <div class="course-hero">
            <div class="hero-bg-shapes">
                <div class="shape shape-1"></div>
                <div class="shape shape-2"></div>
                <div class="shape shape-3"></div>
            </div>
            <div class="container position-relative">
                <div class="row align-items-center p-5">
                    <div class="col-lg-7 text-white">
                        <div class="hero-badge mb-3">
                            <span
                                class="badge-glow">{{ app()->getLocale() == 'uz' ? '🚀 Eng ko\'p sotilgan kurs' : (app()->getLocale() == 'ru' ? '🚀 Бестселлер' : '🚀 Bestseller') }}</span>
                        </div>

                        <h1 class="hero-title mb-3">{{ $course->title }}</h1>
                        <p class="hero-subtitle" style="color: black;">
                            {{ $course->short_description ?? (app()->getLocale() == 'uz' ? 'Professional kurs bilan kelajagingizni quring' : (app()->getLocale() == 'ru' ? 'Постройте свое будущее с профессиональным курсом' : 'Build your future with professional course')) }}
                        </p>

                        <div class="hero-badges mt-4">
                            @if($course->has_certificate)
                                <span class="hero-tag">
                                    <i class="fas fa-certificate"></i>
                                    {{ app()->getLocale() == 'uz' ? 'Sertifikat beriladi' : (app()->getLocale() == 'ru' ? 'Сертификат выдается' : 'Certificate given') }}
                                </span>
                            @endif
                            @if($course->has_mentor_support)
                                <span class="hero-tag highlight">
                                    <i class="fas fa-headset"></i>
                                    {{ app()->getLocale() == 'uz' ? '24/7 Mentor yordami' : (app()->getLocale() == 'ru' ? 'Поддержка ментора 24/7' : '24/7 Mentor support') }}
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-5 text-center mt-4 mt-lg-0">
                        @php
                            $imageData = null;
                            if ($course->image) {
                                $imagePath = storage_path('app/public/courses/' . $course->image);
                                if (file_exists($imagePath)) {
                                    $extension = pathinfo($imagePath, PATHINFO_EXTENSION);
                                    $base64 = base64_encode(file_get_contents($imagePath));
                                    $imageData = "data:image/{$extension};base64,{$base64}";
                                }
                            }
                        @endphp

                        @if($imageData)
                            <div class="hero-image-wrapper">
                                <img src="{{ $imageData }}" alt="{{ $course->title }}" class="hero-image">
                            </div>
                        @else
                            <div clasds="hero-icon-box">
                                <i class="fas fa-graduation-cap"></i>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="container py-5">
            <div class="row g-4">
                <div class="col-lg-8">
                    <!-- Stats Cards -->
                    <div class="stats-grid mb-5">
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div class="stat-content">
                                <h4>{{ $course->duration ?? '—' }}</h4>
                                <span>{{ app()->getLocale() == 'uz' ? 'Davomiyligi' : (app()->getLocale() == 'ru' ? 'Длительность' : 'Duration') }}</span>
                            </div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-icon purple">
                                <i class="fas fa-users"></i>
                            </div>
                            <div class="stat-content">
                                <h4>{{ $course->student_count ?? '0' }}+</h4>
                                <span>{{ app()->getLocale() == 'uz' ? 'Talabalar' : (app()->getLocale() == 'ru' ? 'Студенты' : 'Students') }}</span>
                            </div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-icon green">
                                <i class="fas fa-language"></i>
                            </div>
                            <div class="stat-content">
                                <h4>{{ $course->language ?? (app()->getLocale() == 'uz' ? 'O\'zbek' : (app()->getLocale() == 'ru' ? 'Узбекский' : 'Uzbek')) }}
                                </h4>
                                <span>{{ app()->getLocale() == 'uz' ? 'Tili' : (app()->getLocale() == 'ru' ? 'Язык' : 'Language') }}</span>
                            </div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-icon orange">
                                <i class="fas fa-calendar-alt"></i>
                            </div>
                            <div class="stat-content">
                                <h4>{{ $course->schedule ?? (app()->getLocale() == 'uz' ? '3 kun' : (app()->getLocale() == 'ru' ? '3 дня' : '3 days')) }}
                                </h4>
                                <span>{{ app()->getLocale() == 'uz' ? 'Haftada' : (app()->getLocale() == 'ru' ? 'В неделю' : 'Per week') }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Kurs haqida -->
                    <div class="content-card mb-4">
                        <div class="card-header-custom">
                            <div class="header-icon">
                                <i class="fas fa-info-circle"></i>
                            </div>
                            <h3>{{ app()->getLocale() == 'uz' ? 'Kurs haqida' : (app()->getLocale() == 'ru' ? 'О курсе' : 'About course') }}
                            </h3>
                        </div>
                        <p class="card-text">
                            {{ $course->full_description ?? $course->short_description ?? (app()->getLocale() == 'uz' ? 'Kurs haqida batafsil ma\'lumot mavjud emas' : (app()->getLocale() == 'ru' ? 'Нет подробного описания курса' : 'No description available')) }}
                        </p>
                    </div>

                    <!-- O'quv dasturi -->
                    @if($course->curriculum)
                        <div class="content-card mb-4">
                            <div class="card-header-custom">
                                <div class="header-icon purple">
                                    <i class="fas fa-list-alt"></i>
                                </div>
                                <h3>{{ app()->getLocale() == 'uz' ? 'O\'quv dasturi' : (app()->getLocale() == 'ru' ? 'Учебная программа' : 'Curriculum') }}
                                </h3>
                            </div>
                            <div class="curriculum-content">
                                {!! nl2br(e($course->curriculum)) !!}
                            </div>
                        </div>
                    @endif

                    <!-- Kimlar uchun -->
                    @if($course->target_audience)
                        <div class="content-card mb-4">
                            <div class="card-header-custom">
                                <div class="header-icon green">
                                    <i class="fas fa-user-friends"></i>
                                </div>
                                <h3>{{ app()->getLocale() == 'uz' ? 'Kimlar uchun?' : (app()->getLocale() == 'ru' ? 'Для кого?' : 'For whom?') }}
                                </h3>
                            </div>
                            <p class="card-text">{{ $course->target_audience }}</p>
                        </div>
                    @endif

                    <!-- O'qituvchilar -->
                    @if($course->teachers)
                        <div class="content-card">
                            <div class="card-header-custom">
                                <div class="header-icon orange">
                                    <i class="fas fa-chalkboard-teacher"></i>
                                </div>
                                <h3>{{ app()->getLocale() == 'uz' ? 'O\'qituvchilar' : (app()->getLocale() == 'ru' ? 'Преподаватели' : 'Teachers') }}
                                </h3>
                            </div>
                            <div class="teacher-card">
                                <div class="teacher-avatar">
                                    <i class="fas fa-user"></i>
                                </div>
                                <div class="teacher-info">
                                    <h4>{{ $course->teachers }}</h4>
                                    <div class="teacher-rating">
                                        <span class="stars">⭐⭐⭐⭐⭐</span>
                                        <span class="rating-text">4.9 -
                                            {{ app()->getLocale() == 'uz' ? 'Mutaxassis o\'qituvchi' : (app()->getLocale() == 'ru' ? 'Опытный преподаватель' : 'Expert teacher') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Sidebar -->
                <div class="col-lg-4">
                    <div class="price-card sticky-sidebar">
                        <div class="price-header">
                            <span
                                class="price-label">{{ app()->getLocale() == 'uz' ? 'Kurs narxi' : (app()->getLocale() == 'ru' ? 'Цена курса' : 'Course price') }}</span>
                            <div class="price-amount">
                                <span class="price">{{ number_format($course->price) }}</span>
                                <span class="currency">so'm</span>
                            </div>
                            <span
                                class="price-period">{{ app()->getLocale() == 'uz' ? '/oyiga' : (app()->getLocale() == 'ru' ? '/месяц' : '/month') }}</span>
                        </div>

                        <div class="price-features">
                            <div class="feature-item">
                                <i class="fas fa-check-circle"></i>
                                <span>{{ app()->getLocale() == 'uz' ? '24/7 Onlayn qo\'llab-quvvatlash' : (app()->getLocale() == 'ru' ? 'Круглосуточная поддержка' : '24/7 Online support') }}</span>
                            </div>
                            <div class="feature-item">
                                <i class="fas fa-check-circle"></i>
                                <span>{{ app()->getLocale() == 'uz' ? 'Amaliy loyihalar' : (app()->getLocale() == 'ru' ? 'Практические проекты' : 'Practical projects') }}</span>
                            </div>
                            <div class="feature-item">
                                <i class="fas fa-check-circle"></i>
                                <span>{{ app()->getLocale() == 'uz' ? 'Ishga joylashish yordami' : (app()->getLocale() == 'ru' ? 'Помощь в трудоустройстве' : 'Job assistance') }}</span>
                            </div>
                            <div class="feature-item">
                                <i class="fas fa-check-circle"></i>
                                <span>{{ app()->getLocale() == 'uz' ? 'Xalqaro sertifikat' : (app()->getLocale() == 'ru' ? 'Международный сертификат' : 'International certificate') }}</span>
                            </div>
                        </div>

                        <button class="register-btn" onclick="registerCourse({{ $course->id }}, '{{ $course->title }}')">
                            <span class="btn-text">
                                <i class="fas fa-rocket"></i>
                                {{ app()->getLocale() == 'uz' ? 'Ro\'yxatdan o\'tish' : (app()->getLocale() == 'ru' ? 'Записаться' : 'Register now') }}
                            </span>
                            <span class="btn-shine"></span>
                        </button>

                        <div class="price-details">
                            <div class="detail-row">
                                <span
                                    class="detail-label">{{ app()->getLocale() == 'uz' ? 'Tili' : (app()->getLocale() == 'ru' ? 'Язык' : 'Language') }}</span>
                                <span
                                    class="detail-value">{{ $course->language ?? (app()->getLocale() == 'uz' ? 'O\'zbek' : (app()->getLocale() == 'ru' ? 'Узбекский' : 'Uzbek')) }}</span>
                            </div>
                            <div class="detail-row">
                                <span
                                    class="detail-label">{{ app()->getLocale() == 'uz' ? 'Davomiylik' : (app()->getLocale() == 'ru' ? 'Длительность' : 'Duration') }}</span>
                                <span class="detail-value">{{ $course->duration ?? '—' }}</span>
                            </div>
                            <div class="detail-row">
                                <span
                                    class="detail-label">{{ app()->getLocale() == 'uz' ? 'Joylar' : (app()->getLocale() == 'ru' ? 'Места' : 'Seats') }}</span>
                                <span
                                    class="detail-value success">{{ app()->getLocale() == 'uz' ? 'Mavjud ✓' : (app()->getLocale() == 'ru' ? 'Есть ✓' : 'Available ✓') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <style>
        :root {
            --primary: #6366f1;
            --primary-dark: #4f46e5;
            --secondary: #8b5cf6;
            --accent: #a855f7;
            --success: #10b981;
            --warning: #f59e0b;
            --danger: #ef4444;
            --dark: #1e293b;
            --gray: #64748b;
            --light: #f1f5f9;
            --white: #ffffff;
            --gradient: linear-gradient(135deg, var(--primary) 0%, var(--accent) 100%);
            --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
            --shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1);
            --shadow-lg: 0 20px 40px -15px rgb(0 0 0 / 0.15);
            --shadow-xl: 0 25px 50px -12px rgb(0 0 0 / 0.25);
            --radius: 16px;
            --radius-lg: 24px;
        }

        /* Hero Section */
        .course-hero {
            position: relative;
            background: var(--gradient);
            overflow: hidden;
            min-height: 400px;
        }

        .hero-bg-shapes {
            position: absolute;
            inset: 0;
            overflow: hidden;
            pointer-events: none;
        }

        .shape {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            animation: float 20s infinite ease-in-out;
        }

        .shape-1 {
            width: 400px;
            height: 400px;
            top: -200px;
            right: -100px;
            animation-delay: 0s;
        }

        .shape-2 {
            width: 300px;
            height: 300px;
            bottom: -150px;
            left: -50px;
            animation-delay: -5s;
        }

        .shape-3 {
            width: 200px;
            height: 200px;
            top: 50%;
            left: 50%;
            animation-delay: -10s;
        }

        @keyframes float {

            0%,
            100% {
                transform: translate(0, 0) scale(1);
            }

            25% {
                transform: translate(20px, -20px) scale(1.05);
            }

            50% {
                transform: translate(-10px, 20px) scale(0.95);
            }

            75% {
                transform: translate(-20px, -10px) scale(1.02);
            }
        }

        .hero-badge {
            display: inline-block;
        }

        .badge-glow {
            display: inline-block;
            padding: 8px 20px;
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            border-radius: 50px;
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--white);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .hero-title {
            font-size: clamp(2rem, 5vw, 3.5rem);
            font-weight: 800;
            line-height: 1.1;
            text-shadow: 0 2px 20px rgba(0, 0, 0, 0.1);
        }

        .hero-subtitle {
            font-size: 1.2rem;
            opacity: 0.9;
            max-width: 500px;
        }

        .hero-badges {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
        }

        .hero-tag {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            background: rgba(255, 255, 255, 0.95);
            color: var(--primary);
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.9rem;
            box-shadow: var(--shadow);
            transition: transform 0.3s ease;
        }

        .hero-tag:hover {
            transform: translateY(-2px);
        }

        .hero-tag.highlight {
            background: var(--warning);
            color: var(--dark);
        }

        /* Hero Image - TUZATILGAN (rasm siqilmasligi uchun) */
        /* Hero Image - TUZATILGAN (rasm siqilmasligi va fon ramkada bo'lishi uchun) */
.hero-image-wrapper {
    position: relative;
    display: inline-block;
    max-width: 100%;
    border-radius: var(--radius-lg);
    background: linear-gradient(135deg, rgba(99, 102, 241, 0.2), rgba(168, 85, 247, 0.2));
    padding: 12px;
    box-shadow: var(--shadow-xl);
}

        .hero-image {
            width: auto;
            max-width: 100%;
            height: auto;
            max-height: 300px;
            object-fit: contain;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-xl);
            border: 3px solid rgba(255, 255, 255, 0.2);
            background: rgba(255, 255, 255, 0.1);
        }

        /* Responsive rasm */
        @media (max-width: 768px) {
            .hero-image {
                max-height: 220px;
            }
        }

        @media (max-width: 576px) {
            .hero-image {
                max-height: 180px;
            }
        }

        .image-glow {
            position: absolute;
            inset: -20px;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.3) 0%, transparent 70%);
            border-radius: var(--radius-lg);
            z-index: -1;
            animation: pulse 3s infinite ease-in-out;
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 0.5;
                transform: scale(1);
            }

            50% {
                opacity: 0.8;
                transform: scale(1.05);
            }
        }

        .hero-icon-box {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 180px;
    height: 180px;
    background: linear-gradient(135deg, rgba(99, 102, 241, 0.2), rgba(168, 85, 247, 0.2));
    backdrop-filter: blur(10px);
    border-radius: var(--radius-lg);
    border: 2px solid rgba(255, 255, 255, 0.2);
    padding: 12px;
}

        .hero-icon-box i {
            font-size: 5rem;
            color: var(--white);
        }

        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 16px;
        }

        @media (max-width: 768px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        .stat-card {
            background: var(--white);
            border-radius: var(--radius);
            padding: 24px 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            gap: 12px;
            box-shadow: var(--shadow);
            border: 1px solid rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-lg);
        }

        .stat-icon {
            width: 56px;
            height: 56px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #6366f1 0%, #818cf8 100%);
            color: var(--white);
            font-size: 1.5rem;
        }

        .stat-icon.purple {
            background: linear-gradient(135deg, #8b5cf6 0%, #a78bfa 100%);
        }

        .stat-icon.green {
            background: linear-gradient(135deg, #10b981 0%, #34d399 100%);
        }

        .stat-icon.orange {
            background: linear-gradient(135deg, #f59e0b 0%, #fbbf24 100%);
        }

        .stat-content h4 {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--dark);
            margin: 0;
        }

        .stat-content span {
            font-size: 0.85rem;
            color: var(--gray);
        }

        /* Content Cards */
        .content-card {
            background: var(--white);
            border-radius: var(--radius-lg);
            padding: 32px;
            box-shadow: var(--shadow);
            border: 1px solid rgba(0, 0, 0, 0.05);
            transition: box-shadow 0.3s ease;
        }

        .content-card:hover {
            box-shadow: var(--shadow-lg);
        }

        .card-header-custom {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-bottom: 20px;
        }

        .header-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #6366f1 0%, #818cf8 100%);
            color: var(--white);
            font-size: 1.2rem;
        }

        .header-icon.purple {
            background: linear-gradient(135deg, #8b5cf6 0%, #a78bfa 100%);
        }

        .header-icon.green {
            background: linear-gradient(135deg, #10b981 0%, #34d399 100%);
        }

        .header-icon.orange {
            background: linear-gradient(135deg, #f59e0b 0%, #fbbf24 100%);
        }

        .card-header-custom h3 {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--dark);
            margin: 0;
        }

        .card-text {
            font-size: 1.1rem;
            line-height: 1.8;
            color: var(--gray);
            margin: 0;
        }

        .curriculum-content {
            font-size: 1rem;
            line-height: 2;
            color: var(--gray);
        }

        /* Teacher Card */
        .teacher-card {
            display: flex;
            align-items: center;
            gap: 20px;
            padding: 20px;
            background: var(--light);
            border-radius: var(--radius);
        }

        .teacher-avatar {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--gradient);
            color: var(--white);
            font-size: 1.8rem;
        }

        .teacher-info h4 {
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--dark);
            margin: 0 0 8px 0;
        }

        .teacher-rating {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .stars {
            font-size: 0.9rem;
        }

        .rating-text {
            font-size: 0.9rem;
            color: var(--gray);
        }

        /* Price Card */
        .price-card {
            background: var(--white);
            border-radius: var(--radius-lg);
            padding: 32px;
            box-shadow: var(--shadow-xl);
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        .sticky-sidebar {
            position: sticky;
            top: 24px;
        }

        .price-header {
            text-align: center;
            margin-bottom: 28px;
        }

        .price-label {
            font-size: 0.9rem;
            color: var(--gray);
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .price-amount {
            margin: 12px 0 4px 0;
        }

        .price {
            font-size: 3rem;
            font-weight: 800;
            background: var(--gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .currency {
            font-size: 1rem;
            color: var(--gray);
            font-weight: 500;
        }

        .price-period {
            font-size: 0.9rem;
            color: var(--gray);
        }

        .price-features {
            margin-bottom: 28px;
        }

        .feature-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 0;
            border-bottom: 1px solid var(--light);
        }

        .feature-item:last-child {
            border-bottom: none;
        }

        .feature-item i {
            color: var(--success);
            font-size: 1.1rem;
        }

        .feature-item span {
            font-size: 0.95rem;
            color: var(--dark);
        }

        .register-btn {
            width: 100%;
            padding: 18px 32px;
            border: none;
            border-radius: 50px;
            background: var(--gradient);
            color: var(--white);
            font-size: 1.1rem;
            font-weight: 700;
            cursor: pointer;
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
            box-shadow: 0 10px 30px -10px rgba(99, 102, 241, 0.5);
        }

        .register-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 35px -10px rgba(99, 102, 241, 0.6);
        }

        .register-btn:active {
            transform: translateY(-1px);
        }

        .btn-text {
            position: relative;
            z-index: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .btn-shine {
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            animation: shine 3s infinite;
        }

        @keyframes shine {
            0% {
                left: -100%;
            }

            50%,
            100% {
                left: 100%;
            }
        }

        .price-details {
            margin-top: 24px;
            padding-top: 24px;
            border-top: 1px solid var(--light);
        }

        .detail-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
        }

        .detail-label {
            font-size: 0.9rem;
            color: var(--gray);
        }

        .detail-value {
            font-size: 0.95rem;
            font-weight: 600;
            color: var(--dark);
        }

        .detail-value.success {
            color: var(--success);
        }

        /* Responsive */
        @media (max-width: 992px) {
            .sticky-sidebar {
                position: relative;
                top: 0;
            }

            .content-card {
                padding: 24px;
            }

            .price-card {
                padding: 24px;
            }
        }

        @media (max-width: 768px) {
            .hero-title {
                font-size: 1.8rem;
            }

            .hero-subtitle {
                font-size: 1rem;
            }

            .price {
                font-size: 2.5rem;
            }

            .teacher-card {
                flex-direction: column;
                text-align: center;
            }
        }
    </style>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function registerCourse(id, title) {
            let lang = '{{ app()->getLocale() }}';

            Swal.fire({
                title: lang == 'uz' ? 'Kursga yozilish' : (lang == 'ru' ? 'Запись на курс' : 'Register for course'),
                html: `
                <p style="color: #64748b; margin-bottom: 24px;">${title}</p>
                <div style="text-align: left;">
                    <div style="margin-bottom: 16px;">
                        <label style="display: block; font-weight: 600; margin-bottom: 6px; color: #1e293b;">${lang == 'uz' ? 'To\'liq ism' : (lang == 'ru' ? 'Полное имя' : 'Full name')}</label>
                        <input type="text" id="name" class="swal2-input" style="margin: 0; width: 100%;" placeholder="${lang == 'uz' ? 'Ismingizni kiriting' : (lang == 'ru' ? 'Введите ваше имя' : 'Enter your name')}" value="{{ auth()->check() ? auth()->user()->name : '' }}">
                    </div>
                    <div style="margin-bottom: 16px;">
                        <label style="display: block; font-weight: 600; margin-bottom: 6px; color: #1e293b;">${lang == 'uz' ? 'Telefon raqam' : (lang == 'ru' ? 'Номер телефона' : 'Phone number')}</label>
                        <input type="tel" id="phone" class="swal2-input" style="margin: 0; width: 100%;" placeholder="+998991234567">
                    </div>
                    <div style="margin-bottom: 8px;">
                        <label style="display: block; font-weight: 600; margin-bottom: 6px; color: #1e293b;">Email</label>
                        <input type="email" id="email" class="swal2-input" style="margin: 0; width: 100%;" placeholder="example@email.com" value="{{ auth()->check() ? auth()->user()->email : '' }}">
                    </div>
                </div>
            `,
                confirmButtonText: lang == 'uz' ? 'Yuborish' : (lang == 'ru' ? 'Отправить' : 'Submit'),
                cancelButtonText: lang == 'uz' ? 'Bekor qilish' : (lang == 'ru' ? 'Отмена' : 'Cancel'),
                showCancelButton: true,
                confirmButtonColor: '#6366f1',
                cancelButtonColor: '#64748b',
                preConfirm: () => {
                    const name = document.getElementById('name').value;
                    const phone = document.getElementById('phone').value;
                    const email = document.getElementById('email').value;

                    if (!name) {
                        Swal.showValidationMessage(lang == 'uz' ? 'Ismni kiriting' : (lang == 'ru' ? 'Введите имя' : 'Enter name'));
                        return false;
                    }
                    if (!phone) {
                        Swal.showValidationMessage(lang == 'uz' ? 'Telefon raqamni kiriting' : (lang == 'ru' ? 'Введите номер' : 'Enter phone'));
                        return false;
                    }
                    if (!email) {
                        Swal.showValidationMessage(lang == 'uz' ? 'Emailni kiriting' : (lang == 'ru' ? 'Введите email' : 'Enter email'));
                        return false;
                    }
                    return { name, phone, email, course_id: id, course_name: title };
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    const data = result.value;

                    // Loading state
                    Swal.fire({
                        title: lang == 'uz' ? 'Yuborilmoqda...' : (lang == 'ru' ? 'Отправка...' : 'Sending...'),
                        allowOutsideClick: false,
                        didOpen: () => { Swal.showLoading(); }
                    });

                    // ========== SERVERGA SO'ROV YUBORISH ==========
                    fetch('/course-enroll', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify(data)
                    })
                        .then(response => response.json())
                        .then(response => {
                            if (response.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: lang == 'uz' ? 'Muvaffaqiyatli! 🎉' : (lang == 'ru' ? 'Успешно! 🎉' : 'Success! 🎉'),
                                    text: response.message || (lang == 'uz' ? 'Arizangiz qabul qilindi. Tez orada bog\'lanamiz' : (lang == 'ru' ? 'Заявка принята. Мы свяжемся с вами' : 'Application accepted. We will contact you')),
                                    timer: 3000,
                                    timerProgressBar: true,
                                    showConfirmButton: false
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: lang == 'uz' ? 'Xatolik' : (lang == 'ru' ? 'Ошибка' : 'Error'),
                                    text: response.message || (lang == 'uz' ? 'Xatolik yuz berdi' : (lang == 'ru' ? 'Произошла ошибка' : 'An error occurred')),
                                    confirmButtonColor: '#6366f1'
                                });
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            Swal.fire({
                                icon: 'error',
                                title: lang == 'uz' ? 'Xatolik' : (lang == 'ru' ? 'Ошибка' : 'Error'),
                                text: lang == 'uz' ? 'Serverda xatolik yuz berdi' : (lang == 'ru' ? 'Ошибка сервера' : 'Server error'),
                                confirmButtonColor: '#6366f1'
                            });
                        });
                }
            });
        }
    </script>
@endsection