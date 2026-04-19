@extends('layouts.app')

@section('content')
<div class="course-detail-page">
    <!-- Hero Qismi -->
    <div class="course-hero" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
        <div class="container">
            <div class="row align-items-center py-5">
                <div class="col-lg-7 text-white">
                    <!-- Breadcrumb -->
                    <div class="mb-3">
                        <a href="{{ route('courses.index') }}" class="text-white text-decoration-none opacity-75">
                            <i class="fas fa-arrow-left me-2"></i> 
                            @lang('messages.back_to_courses')
                        </a>
                    </div>
                    
                    <h1 class="display-4 fw-bold mb-3">{{ $course->title }}</h1>
                    <p class="lead opacity-90">{{ $course->short_description ?? __('messages.professional_course') }}</p>
                    
                    <div class="d-flex flex-wrap gap-3 mt-4">
                        @if($course->has_certificate)
                            <span class="badge bg-white text-primary rounded-pill px-3 py-2">
                                <i class="fas fa-certificate me-1"></i> @lang('messages.certificate_given')
                            </span>
                        @endif
                        @if($course->has_mentor_support)
                            <span class="badge bg-warning text-dark rounded-pill px-3 py-2">
                                <i class="fas fa-headset me-1"></i> @lang('messages.mentor_support')
                            </span>
                        @endif
                    </div>
                </div>
                <div class="col-lg-5 text-center mt-4 mt-lg-0">
                    @php
                        $imageData = null;
                        if($course->image) {
                            $imagePath = storage_path('app/public/courses/' . $course->image);
                            if(file_exists($imagePath)) {
                                $extension = pathinfo($imagePath, PATHINFO_EXTENSION);
                                $base64 = base64_encode(file_get_contents($imagePath));
                                $imageData = "data:image/{$extension};base64,{$base64}";
                            }
                        }
                    @endphp

                    @if($imageData)
                        <div class="course-image-wrapper">
                            <img src="{{ $imageData }}" 
                                 alt="{{ $course->title }}" 
                                 class="img-fluid rounded-4 shadow-lg course-hero-image">
                        </div>
                    @else
                        <div class="bg-white bg-opacity-20 rounded-4 p-5 d-inline-block">
                            <i class="fas fa-graduation-cap fa-5x text-white"></i>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="container py-5">
        <div class="row g-4">
            <!-- Asosiy ma'lumotlar -->
            <div class="col-lg-8">
                <!-- Stats kartalari - Animatsiyali -->
                <div class="row g-3 mb-5">
                    <div class="col-md-3 col-6">
                        <div class="stat-card text-center p-3 rounded-4 bg-white shadow-sm" data-aos="fade-up">
                            <div class="stat-icon mb-2">
                                <i class="fas fa-clock fa-2x text-primary"></i>
                            </div>
                            <h4 class="fw-bold text-primary mb-0">{{ $course->duration ?? __('messages.not_specified') }}</h4>
                            <small class="text-muted">@lang('messages.duration')</small>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="stat-card text-center p-3 rounded-4 bg-white shadow-sm" data-aos="fade-up" data-aos-delay="100">
                            <div class="stat-icon mb-2">
                                <i class="fas fa-users fa-2x text-primary"></i>
                            </div>
                            <h4 class="fw-bold text-primary mb-0">{{ $course->student_count ?? '0' }}</h4>
                            <small class="text-muted">@lang('messages.students')</small>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="stat-card text-center p-3 rounded-4 bg-white shadow-sm" data-aos="fade-up" data-aos-delay="200">
                            <div class="stat-icon mb-2">
                                <i class="fas fa-language fa-2x text-primary"></i>
                            </div>
                            <h4 class="fw-bold text-primary mb-0">{{ $course->language ?? __('messages.uzbek') }}</h4>
                            <small class="text-muted">@lang('messages.language')</small>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="stat-card text-center p-3 rounded-4 bg-white shadow-sm" data-aos="fade-up" data-aos-delay="300">
                            <div class="stat-icon mb-2">
                                <i class="fas fa-calendar-alt fa-2x text-primary"></i>
                            </div>
                            <h4 class="fw-bold text-primary mb-0">{{ $course->schedule ?? __('messages.three_days_week') }}</h4>
                            <small class="text-muted">@lang('messages.schedule')</small>
                        </div>
                    </div>
                </div>

                <!-- Kurs haqida -->
                <div class="info-card card border-0 shadow-sm mb-4" data-aos="fade-up">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3">
                            <div class="icon-box bg-primary bg-opacity-10 rounded-3 p-2 me-3">
                                <i class="fas fa-info-circle text-primary fa-2x"></i>
                            </div>
                            <h3 class="fw-bold mb-0">@lang('messages.about_course')</h3>
                        </div>
                        <p class="text-muted fs-5 mb-0">
                            {{ $course->full_description ?? $course->short_description ?? __('messages.no_description') }}
                        </p>
                    </div>
                </div>

                <!-- O'quv dasturi -->
                @if($course->curriculum)
                <div class="info-card card border-0 shadow-sm mb-4" data-aos="fade-up">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3">
                            <div class="icon-box bg-success bg-opacity-10 rounded-3 p-2 me-3">
                                <i class="fas fa-book-open text-success fa-2x"></i>
                            </div>
                            <h3 class="fw-bold mb-0">@lang('messages.curriculum')</h3>
                        </div>
                        <div class="curriculum-content">
                            {!! nl2br(e($course->curriculum)) !!}
                        </div>
                    </div>
                </div>
                @endif

                <!-- Kimlar uchun -->
                @if($course->target_audience)
                <div class="info-card card border-0 shadow-sm mb-4" data-aos="fade-up">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3">
                            <div class="icon-box bg-warning bg-opacity-10 rounded-3 p-2 me-3">
                                <i class="fas fa-user-check text-warning fa-2x"></i>
                            </div>
                            <h3 class="fw-bold mb-0">@lang('messages.for_whom')</h3>
                        </div>
                        <p class="text-muted fs-5 mb-0">{{ $course->target_audience }}</p>
                    </div>
                </div>
                @endif

                <!-- O'qituvchilar -->
                @if($course->teachers)
                <div class="info-card card border-0 shadow-sm" data-aos="fade-up">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3">
                            <div class="icon-box bg-info bg-opacity-10 rounded-3 p-2 me-3">
                                <i class="fas fa-chalkboard-user text-info fa-2x"></i>
                            </div>
                            <h3 class="fw-bold mb-0">@lang('messages.teachers')</h3>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="teacher-avatar bg-gradient-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 70px; height: 70px;">
                                <i class="fas fa-user fa-2x"></i>
                            </div>
                            <div>
                                <h4 class="mb-1 fw-bold">{{ $course->teachers }}</h4>
                                <p class="text-muted mb-0">⭐ 4.9 @lang('messages.expert_teacher')</p>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>

            <!-- Sidebar - Narx va ro'yxatdan o'tish -->
            <div class="col-lg-4">
                <div class="price-card card border-0 shadow-lg sticky-top" style="top: 20px;" data-aos="fade-left">
                    <div class="card-body p-4">
                        <!-- Narx -->
                        <div class="text-center mb-4">
                            <span class="text-muted text-uppercase small fw-semibold">@lang('messages.course_price')</span>
                            <h2 class="text-primary fw-bold mb-0 display-5">{{ number_format($course->price) }} <small style="font-size: 1rem;">so'm</small></h2>
                            <span class="text-muted">@lang('messages.per_month')</span>
                        </div>

                        <div class="divider"></div>

                        <!-- Features -->
                        <ul class="list-unstyled mb-4">
                            <li class="mb-3 d-flex align-items-center">
                                <div class="feature-icon bg-success bg-opacity-10 rounded-circle p-2 me-3">
                                    <i class="fas fa-check-circle text-success fa-sm"></i>
                                </div>
                                <span>@lang('messages.support_24_7')</span>
                            </li>
                            <li class="mb-3 d-flex align-items-center">
                                <div class="feature-icon bg-success bg-opacity-10 rounded-circle p-2 me-3">
                                    <i class="fas fa-check-circle text-success fa-sm"></i>
                                </div>
                                <span>@lang('messages.practical_projects')</span>
                            </li>
                            <li class="mb-3 d-flex align-items-center">
                                <div class="feature-icon bg-success bg-opacity-10 rounded-circle p-2 me-3">
                                    <i class="fas fa-check-circle text-success fa-sm"></i>
                                </div>
                                <span>@lang('messages.job_assistance')</span>
                            </li>
                            <li class="mb-3 d-flex align-items-center">
                                <div class="feature-icon bg-success bg-opacity-10 rounded-circle p-2 me-3">
                                    <i class="fas fa-check-circle text-success fa-sm"></i>
                                </div>
                                <span>@lang('messages.international_certificate')</span>
                            </li>
                        </ul>

                        <!-- Register Button -->
                        <button class="btn btn-gradient w-100 py-3 rounded-pill fw-bold mb-3" onclick="registerCourse({{ $course->id }}, '{{ $course->title }}')">
                            <i class="fas fa-shopping-cart me-2"></i>@lang('messages.register_now')
                        </button>

                        <!-- Additional Info -->
                        <div class="mt-4 pt-3 border-top">
                            <div class="d-flex justify-content-between mb-3">
                                <span class="text-muted"><i class="fas fa-globe me-2"></i>@lang('messages.language'):</span>
                                <span class="fw-semibold">{{ $course->language ?? __('messages.uzbek') }}</span>
                            </div>
                            <div class="d-flex justify-content-between mb-3">
                                <span class="text-muted"><i class="fas fa-clock me-2"></i>@lang('messages.duration'):</span>
                                <span class="fw-semibold">{{ $course->duration ?? __('messages.not_specified') }}</span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span class="text-muted"><i class="fas fa-users me-2"></i>@lang('messages.seats'):</span>
                                <span class="fw-semibold text-success">@lang('messages.unlimited')</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .course-hero {
        position: relative;
        overflow: hidden;
    }
    
    .course-hero::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
        animation: pulse 10s ease-in-out infinite;
    }
    
    @keyframes pulse {
        0%, 100% { transform: scale(1); opacity: 0.5; }
        50% { transform: scale(1.1); opacity: 0.8; }
    }
    
    .course-hero-image {
        transition: transform 0.3s ease;
        max-height: 250px;
        width: auto;
    }
    
    .course-hero-image:hover {
        transform: scale(1.02);
    }
    
    .stat-card {
        transition: all 0.3s ease;
        border-radius: 20px !important;
        border: none;
    }
    
    .stat-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 35px rgba(0,0,0,0.1) !important;
    }
    
    .stat-icon {
        transition: all 0.3s ease;
    }
    
    .stat-card:hover .stat-icon {
        transform: scale(1.1);
    }
    
    .info-card {
        transition: all 0.3s ease;
        border-radius: 20px !important;
        overflow: hidden;
    }
    
    .info-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(0,0,0,0.1) !important;
    }
    
    .icon-box {
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .price-card {
        border-radius: 24px !important;
        overflow: hidden;
        transition: all 0.3s ease;
    }
    
    .price-card:hover {
        transform: translateY(-5px);
    }
    
    .divider {
        height: 2px;
        background: linear-gradient(90deg, #667eea, #764ba2, #667eea);
        margin: 20px 0;
        border-radius: 2px;
    }
    
    .feature-icon {
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .btn-gradient {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        color: white;
        transition: all 0.3s ease;
    }
    
    .btn-gradient:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
        color: white;
    }
    
    .bg-gradient-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }
    
    .teacher-avatar {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }
    
    .curriculum-content {
        line-height: 1.8;
    }
    
    .curriculum-content ul, .curriculum-content ol {
        padding-left: 1.5rem;
    }
    
    .curriculum-content li {
        margin-bottom: 0.5rem;
    }
    
    .sticky-top {
        position: sticky;
        top: 20px;
        z-index: 100;
    }
    
    .rounded-4 {
        border-radius: 1rem !important;
    }
    
    @media (max-width: 768px) {
        .course-hero h1 {
            font-size: 1.8rem;
        }
        
        .stat-card {
            margin-bottom: 1rem;
        }
        
        .display-5 {
            font-size: 1.8rem;
        }
    }
</style>

<!-- AOS Animation -->
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    AOS.init({
        duration: 800,
        once: true,
        offset: 100
    });
    
    function registerCourse(id, title) {
        Swal.fire({
            title: '@lang("messages.register_for_course")',
            html: `
                <div class="text-start">
                    <div class="mb-3">
                        <label class="form-label fw-bold">@lang("messages.full_name")</label>
                        <input type="text" id="name" class="form-control" placeholder="@lang('messages.enter_name')">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">@lang("messages.phone_number")</label>
                        <input type="tel" id="phone" class="form-control" placeholder="+998 __ ___ __ __">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">@lang("messages.email")</label>
                        <input type="email" id="email" class="form-control" placeholder="example@email.com">
                    </div>
                </div>
            `,
            confirmButtonText: '@lang("messages.submit")',
            cancelButtonText: '@lang("messages.cancel")',
            showCancelButton: true,
            preConfirm: () => {
                const name = document.getElementById('name').value;
                const phone = document.getElementById('phone').value;
                const email = document.getElementById('email').value;
                
                if (!name || !phone || !email) {
                    Swal.showValidationMessage('@lang("messages.fill_all_fields")');
                    return false;
                }
                
                if (!phone.match(/^\+998[0-9]{9}$/)) {
                    Swal.showValidationMessage('@lang("messages.valid_phone")');
                    return false;
                }
                
                return { name: name, phone: phone, email: email };
            }
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    icon: 'success',
                    title: '@lang("messages.success")',
                    text: '@lang("messages.application_accepted")',
                    timer: 3000,
                    showConfirmButton: false
                });
            }
        });
    }
</script>
@endsection