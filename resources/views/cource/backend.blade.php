@extends('layouts.app')

@section('styles')
<style>
    .course-hero {
        background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
        color: white;
        border-radius: 30px;
        overflow: hidden;
        position: relative;
    }
    .tech-card {
        transition: all 0.3s ease;
        border: 1px solid rgba(0,0,0,0.05);
        background: #ffffff;
        border-radius: 16px;
    }
    .tech-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.1) !important;
        border-color: #3b82f6;
    }
    .sticky-price-card {
        position: sticky;
        top: 20px;
        border: none;
        background: white;
        border-radius: 24px;
        box-shadow: 0 20px 35px -10px rgba(0,0,0,0.1);
    }
    .check-icon {
        width: 32px;
        height: 32px;
        background: #3b82f6;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        flex-shrink: 0;
    }
    .gradient-text {
        background: linear-gradient(90deg, #3b82f6, #06b6d4);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    .course-card {
        background: white;
        border: none;
        border-radius: 20px;
        padding: 1.25rem;
        transition: all 0.3s ease;
        height: 100%;
        display: flex;
        align-items: center;
        gap: 1rem;
        box-shadow: 0 5px 15px rgba(0,0,0,0.08);
    }
    .course-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.12);
    }
    .course-icon {
        width: 55px;
        height: 55px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        background: #3b82f6;
    }
    .course-icon i {
        font-size: 28px;
        color: white;
    }
    .course-content h5 {
        font-size: 1rem;
        font-weight: 700;
        margin-bottom: 0.25rem;
        color: #0f172a;
    }
    .course-content p {
        font-size: 0.8rem;
        color: #64748b;
        margin-bottom: 0;
    }
    .skill-title {
        font-size: 1rem;
        font-weight: 700;
        color: #0f172a;
        margin-bottom: 0.25rem;
    }
    .skill-desc {
        font-size: 0.85rem;
        color: #64748b;
        line-height: 1.4;
        margin-bottom: 0;
    }
    .section-badge {
        display: inline-block;
        background: #3b82f6;
        color: white;
        padding: 0.25rem 0.75rem;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
        margin-bottom: 1rem;
    }
    .info-box {
        background: #f8fafc;
        border-radius: 20px;
        padding: 1.5rem;
        border-left: 4px solid #3b82f6;
    }
    .price-box {
        background: #f8fafc;
        border-radius: 16px;
        padding: 1rem;
        margin-bottom: 1rem;
    }
    .hero-title {
        font-size: 2.2rem;
        font-weight: 700;
        margin-bottom: 1rem;
    }
    
    /* Modal Styles */
    .enroll-modal .modal-content {
        border-radius: 24px;
        border: none;
        overflow: hidden;
    }
    .enroll-modal .modal-header {
        background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
        color: white;
        border-bottom: none;
        padding: 1.5rem;
    }
    .enroll-modal .modal-header .btn-close {
        background-color: white;
        opacity: 0.8;
    }
    .enroll-modal .modal-body {
        padding: 2rem;
    }
    .course-stats {
        background: #f8fafc;
        border-radius: 20px;
        padding: 1.25rem;
        text-align: center;
        transition: all 0.3s ease;
    }
    .course-stats:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    }
    .course-stats i {
        font-size: 2rem;
        color: #3b82f6;
        margin-bottom: 0.75rem;
    }
    .course-stats h3 {
        font-size: 1.75rem;
        font-weight: 800;
        color: #0f172a;
        margin-bottom: 0.25rem;
    }
    .course-stats p {
        font-size: 0.8rem;
        color: #64748b;
        margin-bottom: 0;
    }
    .enroll-form .form-control {
        border-radius: 12px;
        border: 1px solid #e2e8f0;
        padding: 0.75rem 1rem;
        transition: all 0.3s ease;
    }
    .enroll-form .form-control:focus {
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59,130,246,0.1);
        outline: none;
    }
    .enroll-form label {
        font-weight: 600;
        margin-bottom: 0.5rem;
        color: #0f172a;
    }
    .btn-submit {
        background: linear-gradient(135deg, #3b82f6, #2563eb);
        border: none;
        border-radius: 12px;
        padding: 0.875rem;
        font-weight: 600;
        font-size: 1rem;
        transition: all 0.3s ease;
    }
    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(59,130,246,0.3);
    }
    
    @media (min-width: 768px) {
        .hero-title {
            font-size: 2.8rem;
        }
    }
    @media (min-width: 992px) {
        .hero-title {
            font-size: 3.2rem;
        }
    }
    @media (max-width: 991.98px) {
        .sticky-price-card {
            position: relative;
            top: 0;
            margin-top: 2rem;
        }
    }
</style>
@endsection

@section('content')
<div class="container py-5">
    <!-- Hero Section -->
    <div class="course-hero p-4 p-md-5 mb-5">
        <div class="row align-items-center">
            <div class="col-lg-7">
                <span class="section-badge">{{ __('messages.backend_course_badge') }}</span>
                <h1 class="hero-title">
                    {!! __('messages.backend_course_title') !!}
                </h1>
                <p class="fs-5 mb-4 opacity-75">
                    {{ __('messages.backend_course_description') }}
                </p>
                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <div class="course-card">
                            <div class="course-icon">
                                <i class="fab fa-php"></i>
                            </div>
                            <div class="course-content">
                                <h5>{{ __('messages.backend_course_tech1_title') }}</h5>
                                <p>{{ __('messages.backend_course_tech1_desc') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="course-card">
                            <div class="course-icon">
                                <i class="fab fa-laravel"></i>
                            </div>
                            <div class="course-content">
                                <h5>{{ __('messages.backend_course_tech2_title') }}</h5>
                                <p>{{ __('messages.backend_course_tech2_desc') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 d-none d-lg-block text-end">
                <img 
                    src="https://kitapp.pro/wp-content/uploads/2025/03/backend-server-to-blocks.webp" 
                    alt="{{ __('messages.backend_course_hero_alt') }}"
                    class="img-fluid"
                    style="max-height: 280px;"
                >
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="row g-5">
        <div class="col-lg-8">
            <!-- Learning Section -->
            <div class="mb-5">
                <span class="section-badge">{{ __('messages.backend_course_learn_badge') }}</span>
                <h3 class="fw-bold mb-4">{{ __('messages.backend_course_learn_section') }}</h3>

                <div class="row g-3">
                    <div class="col-12">
                        <div class="tech-card p-3 d-flex align-items-start gap-3">
                            <div class="check-icon">
                                <i class="fas fa-check"></i>
                            </div>
                            <div>
                                <h5 class="skill-title">{{ __('messages.backend_course_skill1_title') }}</h5>
                                <p class="skill-desc">{{ __('messages.backend_course_skill1_desc') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="tech-card p-3 d-flex align-items-start gap-3">
                            <div class="check-icon">
                                <i class="fas fa-check"></i>
                            </div>
                            <div>
                                <h5 class="skill-title">{{ __('messages.backend_course_skill2_title') }}</h5>
                                <p class="skill-desc">{{ __('messages.backend_course_skill2_desc') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="tech-card p-3 d-flex align-items-start gap-3">
                            <div class="check-icon">
                                <i class="fas fa-check"></i>
                            </div>
                            <div>
                                <h5 class="skill-title">{{ __('messages.backend_course_skill3_title') }}</h5>
                                <p class="skill-desc">{{ __('messages.backend_course_skill3_desc') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="tech-card p-3 d-flex align-items-start gap-3">
                            <div class="check-icon">
                                <i class="fas fa-check"></i>
                            </div>
                            <div>
                                <h5 class="skill-title">{{ __('messages.backend_course_skill4_title') }}</h5>
                                <p class="skill-desc">{{ __('messages.backend_course_skill4_desc') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="tech-card p-3 d-flex align-items-start gap-3">
                            <div class="check-icon">
                                <i class="fas fa-check"></i>
                            </div>
                            <div>
                                <h5 class="skill-title">{{ __('messages.backend_course_skill5_title') }}</h5>
                                <p class="skill-desc">{{ __('messages.backend_course_skill5_desc') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Who Is This For Section -->
            <div class="info-box">
                <div class="d-flex gap-3 align-items-start">
                    <div class="check-icon" style="background: #10b981;">
                        <i class="fas fa-users"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-2">{{ __('messages.backend_course_for_whom_title') }}</h5>
                        <p class="mb-0" style="color: #475569;">
                            {{ __('messages.backend_course_for_whom_desc') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Price Card -->
        <div class="col-lg-4">
            <div class="card sticky-price-card p-4">
                <div class="card-body p-0">
                    <h5 class="fw-bold text-center mb-4">{{ __('messages.backend_course_card_title') }}</h5>
                    
                    <div class="price-box">
                        <div class="d-flex align-items-center gap-3">
                            <i class="fas fa-calendar-day text-primary fs-4"></i>
                            <div>
                                <small class="text-muted d-block">{{ __('messages.backend_course_duration_label') }}</small>
                                <span class="fw-bold">{{ __('messages.backend_course_duration_value') }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="price-box">
                        <div class="d-flex align-items-center gap-3">
                            <i class="fas fa-user-tie text-primary fs-4"></i>
                            <div>
                                <small class="text-muted d-block">{{ __('messages.backend_course_mentor_label') }}</small>
                                <span class="fw-bold">{{ __('messages.backend_course_mentor_value') }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="price-box">
                        <div class="d-flex align-items-center gap-3">
                            <i class="fas fa-language text-primary fs-4"></i>
                            <div>
                                <small class="text-muted d-block">{{ __('messages.backend_course_language_label') }}</small>
                                <span class="fw-bold">{{ __('messages.backend_course_language_value') }}</span>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="text-center mb-4">
                        <small class="text-muted text-decoration-line-through d-block mb-1">{{ __('messages.backend_course_old_price') }}</small>
                        <h2 class="fw-bold text-primary mb-0">{{ __('messages.backend_course_new_price') }}</h2>
                        <small class="text-muted">{{ __('messages.backend_course_price_period') }}</small>
                    </div>
                    
                    <!-- Modal trigger button -->
                    <button type="button" class="btn btn-primary w-100 rounded-pill py-3 fw-bold mb-3" style="background: #3b82f6; border: none;" data-bs-toggle="modal" data-bs-target="#enrollModal">
                        <i class="fas fa-bolt me-2"></i> {{ __('messages.backend_course_enroll_button') }}
                    </button>
                    
                    <div class="text-center pt-3">
                        <div class="d-flex justify-content-center gap-3 mb-2 fs-4">
                            📜 🎓 💼
                        </div>
                        <p class="small text-muted mb-0">
                            ✨ {{ __('messages.backend_course_certificate_text') }}
                        </p>
                        <p class="small text-muted mt-2 mb-0">
                            <i class="fas fa-headset me-1"></i> {{ __('messages.backend_course_support_text') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade enroll-modal" id="enrollModal" tabindex="-1" aria-labelledby="enrollModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title fw-bold" id="enrollModalLabel">
                    <i class="fas fa-graduation-cap me-2"></i> {{ __('messages.enroll_modal_title') }}
                </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Kurs statistikasi -->
                <div class="row g-4 mb-5">
                    <div class="col-4">
                        <div class="course-stats">
                            <i class="fas fa-layer-group"></i>
                            <h3>12</h3>
                            <p>{{ __('messages.enroll_modules_count') }}</p>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="course-stats">
                            <i class="fas fa-video"></i>
                            <h3>48</h3>
                            <p>{{ __('messages.enroll_video_count') }}</p>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="course-stats">
                            <i class="fas fa-clock"></i>
                            <h3>2 {{ __('messages.months') }}</h3>
                            <p>{{ __('messages.enroll_duration') }}</p>
                        </div>
                    </div>
                </div>

                <!-- Ro'yxatdan o'tish formasi -->
                <h5 class="fw-bold text-center mb-4">{{ __('messages.enroll_form_title') }}</h5>
                
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                
                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <form action="{{ route('enroll.submit') }}" method="POST" class="enroll-form">
                    @csrf
                    <input type="hidden" name="course_name" value="Backend Dasturchi kursi">
                    <div class="mb-3">
                        <label for="name" class="form-label">{{ __('messages.your_name') }} <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                               id="name" name="name" value="{{ old('name') }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">{{ __('messages.your_phone') }} <span class="text-danger">*</span></label>
                        <input type="tel" class="form-control @error('phone') is-invalid @enderror" 
                               id="phone" name="phone" value="{{ old('phone') }}" required>
                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">{{ __('messages.email') }} <span class="text-danger">*</span></label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" 
                               id="email" name="email" value="{{ old('email') }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="message" class="form-label">{{ __('messages.message') }}</label>
                        <textarea class="form-control" id="message" name="message" rows="3">{{ old('message') }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-submit w-100 text-white">
                        <i class="fas fa-paper-plane me-2"></i> {{ __('messages.send') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection