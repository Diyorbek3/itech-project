@extends('layouts.app')

@section('styles')
<style>
    /* Python uslubidagi gradient sarlavha */
    .title-gradient {
        background: linear-gradient(90deg, #3b82f6, #2dd4bf);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        font-weight: 800;
    }

    /* Ikkinchi so'z oq rangda */
    .title-secondary {
        color: #ffffff !important;
        font-weight: 800;
        text-shadow: 0 0 15px rgba(255, 255, 255, 0.2);
    }

    .course-hero {
        background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
        color: white;
        border-radius: 30px;
        overflow: hidden;
        position: relative;
    }

    .tech-card {
        transition: all 0.3s ease;
        border: none !important;
        background: #ffffff;
        border-radius: 20px !important;
    }

    .tech-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.1) !important;
    }

    .sticky-price-card {
        position: sticky;
        top: 20px;
        border: none;
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255,255,255,0.4);
        border-radius: 30px !important;
        box-shadow: 0 20px 35px -10px rgba(0,0,0,0.1);
    }

    .check-icon {
        width: 35px;
        height: 35px;
        background: #dcfce7;
        color: #16a34a;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        flex-shrink: 0;
    }

    .course-card {
        background: white;
        border: none !important;
        border-radius: 20px;
        padding: 1.5rem;
        transition: all 0.3s ease;
        height: 100%;
        display: flex;
        align-items: center;
        gap: 1rem;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    }

    .course-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 30px -10px rgba(0,0,0,0.1) !important;
    }

    .course-icon {
        width: 70px;
        height: 70px;
        border-radius: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        background: #f8fafc;
    }

    .course-icon i {
        font-size: 36px;
    }

    .skill-title {
        font-size: 1.1rem;
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
        padding: 0.35rem 1rem;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        margin-bottom: 1rem;
    }

    .info-box {
        background: #f8fafc;
        border-radius: 24px;
        padding: 1.5rem;
        border-left: 5px solid #10b981;
    }

    .price-box {
        background: #f1f5f9;
        border-radius: 16px;
        padding: 1rem;
        margin-bottom: 1rem;
    }

    /* Modal Styles */
    .enroll-modal .modal-content {
        border-radius: 30px;
        border: none;
    }

    .enroll-modal .modal-header {
        background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
        color: white;
        padding: 1.5rem 2rem;
    }

    .course-stats {
        background: #f8fafc;
        border-radius: 20px;
        padding: 1.25rem;
        text-align: center;
    }

    .course-stats i { font-size: 2rem; color: #3b82f6; margin-bottom: 0.5rem; }

    @media (max-width: 991.98px) {
        .sticky-price-card { position: relative; top: 0; margin-top: 2rem; }
    }
</style>
@endsection

@section('content')
<div class="container py-5">
    <div class="course-hero p-4 p-md-5 mb-5 shadow-lg">
        <div class="row align-items-center">
            <div class="col-lg-7">
                <span class="section-badge shadow-sm">{{ __('messages.backend_course_badge') }}</span>
                <h1 class="display-3 fw-bold mb-3">
                    <span class="title-gradient">Backend</span><br>
                    <span class="title-secondary">Development</span>
                </h1>
                <p class="fs-5 mb-4 opacity-75 lh-lg">
                    {{ __('messages.backend_course_description') }}
                </p>
                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <div class="course-card">
                            <div class="course-icon" style="background: #f0f7ff !important;">
                                <i class="fab fa-php" style="color: #4f5b93;"></i>
                            </div>
                            <div class="course-content">
                                <h5>{{ __('messages.backend_course_tech1_title') }}</h5>
                                <p>{{ __('messages.backend_course_tech1_desc') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="course-card">
                            <div class="course-icon" style="background: #fff1f2 !important;">
                                <i class="fab fa-laravel" style="color: #ff2d20;"></i>
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
                <img src="https://kitapp.pro/wp-content/uploads/2025/03/backend-server-to-blocks.webp" 
                     alt="{{ __('messages.backend_course_hero_alt') }}"
                     class="img-fluid" style="max-height: 280px; filter: drop-shadow(0 0 25px rgba(59, 130, 246, 0.4));">
            </div>
        </div>
    </div>

    <div class="row g-5">
        <div class="col-lg-8">
            <div class="mb-5">
                <h3 class="fw-bold mb-4 d-flex align-items-center">
                    <span class="bg-primary p-2 rounded-3 me-3 text-white" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;"><i class="fa-solid fa-graduation-cap"></i></span>
                    {{ __('messages.backend_course_learn_section') }}
                </h3>

                <div class="row g-3">
                    @php
                        $skills = [
                            ['backend_course_skill1_title', 'backend_course_skill1_desc'],
                            ['backend_course_skill2_title', 'backend_course_skill2_desc'],
                            ['backend_course_skill3_title', 'backend_course_skill3_desc'],
                            ['backend_course_skill4_title', 'backend_course_skill4_desc'],
                            ['backend_course_skill5_title', 'backend_course_skill5_desc']
                        ];
                    @endphp

                    @foreach($skills as $skill)
                    <div class="col-12">
                        <div class="tech-card p-4 d-flex align-items-start gap-3 shadow-sm">
                            <div class="check-icon">
                                <i class="fas fa-check"></i>
                            </div>
                            <div>
                                <h5 class="skill-title">{{ __("messages.{$skill[0]}") }}</h5>
                                <p class="skill-desc">{{ __("messages.{$skill[1]}") }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="info-box shadow-sm mb-5">
                <div class="d-flex gap-3 align-items-start">
                    <div class="check-icon" style="background: #d1fae5; color: #059669;">
                        <i class="fas fa-users"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-2">{{ __('messages.backend_course_for_whom_title') }}</h5>
                        <p class="mb-0 fs-5 text-secondary">{{ __('messages.backend_course_for_whom_desc') }}</p>
                    </div>
                </div>
            </div>
        </div>

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

                    <hr class="my-4 opacity-10">

                    <div class="text-center mb-4">
                        <small class="text-muted text-decoration-line-through d-block mb-1">{{ __('messages.backend_course_old_price') }}</small>
                        <h2 class="fw-bold text-primary mb-0">{{ __('messages.backend_course_new_price') }}</h2>
                        <small class="text-muted">{{ __('messages.backend_course_price_period') }}</small>
                    </div>
                    
                    <button type="button" class="btn btn-primary w-100 rounded-pill py-3 fw-bold mb-3 shadow" data-bs-toggle="modal" data-bs-target="#enrollModal">
                        <i class="fas fa-bolt me-2"></i> {{ __('messages.backend_course_enroll_button') }}
                    </button>
                    
                    <div class="text-center pt-3">
                        <div class="d-flex justify-content-center gap-3 mb-2 fs-4">📜 🎓 💼</div>
                        <p class="small text-muted mb-0">✨ {{ __('messages.backend_course_certificate_text') }}</p>
                        <p class="small text-muted mt-2 mb-0"><i class="fas fa-headset me-1"></i> {{ __('messages.backend_course_support_text') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade enroll-modal" id="enrollModal" tabindex="-1" aria-labelledby="enrollModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content shadow-2xl">
            <div class="modal-header">
                <h4 class="modal-title fw-bold" id="enrollModalLabel"><i class="fas fa-graduation-cap me-2"></i> {{ __('messages.enroll_modal_title') }}</h4>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4 p-md-5">
                <div class="row g-4 mb-5">
                    <div class="col-4">
                        <div class="course-stats">
                            <i class="fas fa-layer-group"></i>
                            <h3 class="fw-bold">12</h3>
                            <p class="small text-muted">{{ __('messages.enroll_modules_count') }}</p>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="course-stats">
                            <i class="fas fa-video"></i>
                            <h3 class="fw-bold">48</h3>
                            <p class="small text-muted">{{ __('messages.enroll_video_count') }}</p>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="course-stats">
                            <i class="fas fa-clock"></i>
                            <h3 class="fw-bold">2 oy</h3>
                            <p class="small text-muted">{{ __('messages.enroll_duration') }}</p>
                        </div>
                    </div>
                </div>

                <h5 class="fw-bold text-center mb-4">{{ __('messages.enroll_form_title') }}</h5>
                
                <form action="{{ route('enroll.submit') }}" method="POST" class="enroll-form">
                    @csrf
                    <input type="hidden" name="course_name" value="Backend Dasturchi kursi">
                    <div class="mb-3">
                        <label class="form-label fw-bold">{{ __('messages.your_name') }} *</label>
                        <input type="text" class="form-control rounded-3 p-3" name="name" placeholder="Masalan: Shavkat" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">{{ __('messages.your_phone') }} *</label>
                        <input type="tel" class="form-control rounded-3 p-3" name="phone" placeholder="+998 90 123 45 67" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">{{ __('messages.email') }} *</label>
                        <input type="email" class="form-control rounded-3 p-3" name="email" placeholder="example@gmail.com" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-bold">{{ __('messages.message') }}</label>
                        <textarea class="form-control rounded-3 p-3" name="message" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 rounded-pill py-3 fw-bold shadow-lg">
                        <i class="fas fa-paper-plane me-2"></i> {{ __('messages.send') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection