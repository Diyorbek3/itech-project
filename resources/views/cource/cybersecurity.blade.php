@extends('layouts.app')

@section('styles')
<style>
    /* Kiberxavfsizlik uchun maxsus gradient */
    .title-gradient {
        background: linear-gradient(90deg, #3b82f6, #2dd4bf);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        font-weight: 800;
    }

    .title-secondary {
        color: #ffffff !important;
        font-weight: 800;
        text-shadow: 0 0 15px rgba(59, 130, 246, 0.3);
    }

    .course-hero {
        background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
        color: white;
        border-radius: 30px;
        position: relative;
        overflow: hidden;
    }

    .tech-card {
        transition: all 0.3s ease;
        border: none !important;
        background: #ffffff;
        border-radius: 20px !important;
    }

    .tech-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.08) !important;
    }

    .sticky-price-card {
        border: none;
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(15px);
        border: 1px solid rgba(255,255,255,0.5);
        border-radius: 30px !important;
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

    .info-box-cyber {
        background: #f8fafc;
        border-radius: 24px;
        padding: 1.5rem;
        border-left: 5px solid #3b82f6;
    }

    .price-item {
        background: #f1f5f9;
        border-radius: 16px;
        padding: 1.2rem;
        margin-bottom: 0.8rem;
    }

    .feature-badge {
        background: white;
        border-radius: 20px;
        padding: 1.2rem;
        height: 100%;
        display: flex;
        align-items: center;
        box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        transition: transform 0.3s ease;
    }

    .feature-badge:hover {
        transform: scale(1.02);
    }

    /* Minimalist Afzalliklar Stili */
    .benefit-item {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        margin-bottom: 15px;
        text-align: left;
    }
    .benefit-icon {
        font-size: 1.3rem;
        flex-shrink: 0;
    }
    .benefit-text {
        font-size: 0.9rem;
        color: #475569;
        line-height: 1.4;
        font-weight: 500;
        margin-bottom: 0;
    }
</style>
@endsection

@section('content')
<div class="container py-5">
    <div class="course-hero p-4 p-md-5 mb-5 shadow-lg">
        <div class="row align-items-center">
            <div class="col-lg-7">
                <span class="badge bg-primary mb-3 px-3 py-2 rounded-pill shadow-sm">{{ __('messages.cybersecurity_badge') }}</span>
                <h1 class="display-3 fw-bold mb-3">
                    <span class="title-gradient">Kiber</span><br>
                    <span class="title-secondary">Xavfsizlik</span>
                </h1>
                <p class="fs-5 opacity-75 mb-4 lh-lg">
                    {{ __('messages.cybersecurity_description') }}
                </p>
                
                <div class="row g-4 mb-4">
                    <div class="col-md-6">
                        <div class="feature-badge">
                            <div class="p-3 rounded-3 me-3 d-flex align-items-center justify-content-center" style="background-color: #f0f9ff !important; width: 60px; height: 60px;">
                                <i class="fa-solid fa-shield-halved" style="color: #0ea5e9 !important; font-size: 30px !important;"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-1 text-dark">{{ __('messages.cybersecurity_tech1_title') }}</h6>
                                <p class="text-secondary mb-0 small">{{ __('messages.cybersecurity_tech1_desc') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="feature-badge">
                            <div class="p-3 rounded-3 me-3 d-flex align-items-center justify-content-center" style="background-color: #fff1f2 !important; width: 60px; height: 60px;">
                                <i class="fa-solid fa-laptop-code" style="color: #ef4444 !important; font-size: 30px !important;"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-1 text-dark">{{ __('messages.cybersecurity_tech2_title') }}</h6>
                                <p class="text-secondary mb-0 small">{{ __('messages.cybersecurity_tech2_desc') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 d-none d-lg-block text-end">
                <img src="https://img.icons8.com/sci-fi/1200/cyber-security.jpg" 
                     alt="Kiberxavfsizlik" 
                     class="img-fluid rounded-4" 
                     style="max-height: 320px; filter: drop-shadow(0 0 30px rgba(59, 130, 246, 0.4));">
            </div>
        </div>
    </div>

    <div class="row g-5">
        <div class="col-lg-8">
            <h3 class="fw-bold mb-4 d-flex align-items-center">
                <span class="bg-primary p-2 rounded-3 me-3 text-white" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                    <i class="fa-solid fa-graduation-cap"></i>
                </span>
                {{ __('messages.cybersecurity_learn_section') }}
            </h3>

            <div class="row g-3 mb-5">
                @php 
                    $skills = [
                        ['cybersecurity_skill1_title','cybersecurity_skill1_desc'],
                        ['cybersecurity_skill2_title','cybersecurity_skill2_desc'],
                        ['cybersecurity_skill3_title','cybersecurity_skill3_desc'],
                        ['cybersecurity_skill4_title','cybersecurity_skill4_desc'],
                        ['cybersecurity_skill5_title','cybersecurity_skill5_desc']
                    ]; 
                @endphp
                @foreach($skills as $skill)
                <div class="col-12">
                    <div class="tech-card p-4 shadow-sm d-flex align-items-start gap-3">
                        <div class="check-icon">
                            <i class="fa-solid fa-check"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold mb-1 text-dark">{{ __("messages.{$skill[0]}") }}</h5>
                            <p class="text-secondary mb-0 small">{{ __("messages.{$skill[1]}") }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="info-box-cyber shadow-sm mb-5">
                <h4 class="fw-bold mb-2 text-dark">{{ __('messages.cybersecurity_for_whom_title') }}</h4>
                <p class="text-secondary mb-0 fs-5 lh-base">{{ __('messages.cybersecurity_for_whom_desc') }}</p>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card sticky-price-card shadow-lg p-3">
                <div class="card-body">
                    <h5 class="fw-bold mb-4 text-center text-dark">{{ __('messages.cybersecurity_card_title') }}</h5>
                    
                    <div class="price-item">
                        <div class="d-flex align-items-center">
                            <i class="fa-solid fa-calendar-day text-primary me-3 fs-4"></i>
                            <div>
                                <small class="text-muted d-block">{{ __('messages.cybersecurity_duration_label') }}</small>
                                <span class="fw-bold text-dark">{{ __('messages.cybersecurity_duration_value') }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="price-item">
                        <div class="d-flex align-items-center">
                            <i class="fa-solid fa-user-tie text-primary me-3 fs-4"></i>
                            <div>
                                <small class="text-muted d-block">{{ __('messages.cybersecurity_mentor_label') }}</small>
                                <span class="fw-bold text-dark">{{ __('messages.cybersecurity_mentor_value') }}</span>
                            </div>
                        </div>
                    </div>

                    <hr class="my-4 opacity-10">

                    <div class="text-center mb-4">
                        <h6 class="text-muted text-decoration-line-through mb-1 small">{{ __('messages.cybersecurity_old_price') }}</h6>
                        <h2 class="fw-bold text-primary mb-0">
                            {{ __('messages.cybersecurity_new_price') }} 
                            <small class="fs-6 text-muted">{{ __('messages.cybersecurity_price_period') }}</small>
                        </h2>
                    </div>

                    <a href="{{ url('/#contact') }}" class="btn btn-primary btn-lg w-100 rounded-pill py-3 shadow-sm fw-bold mb-4">
                        <i class="fa-solid fa-bolt me-2"></i> {{ __('messages.cybersecurity_enroll_button') }}
                    </a>

                    <div class="mt-2 px-2">
                        <div class="benefit-item">
                            <span class="benefit-icon">🛡️</span>
                            <p class="benefit-text">Kursni tamomlagach, rasmiy sertifikat bilan taqdirlanasiz</p>
                        </div>
                        <div class="benefit-item">
                            <span class="benefit-icon">🚀</span>
                            <p class="benefit-text">24/7 mentor yordami va amaliy loyihalar</p>
                        </div>
                        <div class="benefit-item">
                            <span class="benefit-icon">🛡️</span>
                            <p class="benefit-text">Xalqaro standartlar asosida o'qitish</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection