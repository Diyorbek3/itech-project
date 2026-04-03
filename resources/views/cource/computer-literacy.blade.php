@extends('layouts.app')

@section('styles')
<style>
    /* Gradient matn effekti */
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
        border: none;
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255,255,255,0.4);
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
    }

    /* Minimalist Afzalliklar Ro'yxati */
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
                <span class="badge bg-primary mb-3 px-3 py-2 rounded-pill shadow-sm">{{ __('messages.computer_badge') }}</span>
                
                <h1 class="display-3 fw-bold mb-3">
                    <span class="title-gradient">Kompyuter</span><br>
                    <span class="title-secondary">savodxonligi</span>
                </h1>

                <p class="fs-5 opacity-75 mb-4 lh-lg">{{ __('messages.computer_description') }}</p>
                
                <div class="row g-4 mb-5 d-flex align-items-stretch">
                    <div class="col-md-6 d-flex">
                        <div class="p-4 tech-card shadow-sm d-flex align-items-center flex-fill">
                            <div class="p-3 rounded-3 me-3 d-flex align-items-center justify-content-center flex-shrink-0" 
                                style="background-color: #e0f2fe !important; width: 70px; height: 70px;">
                                <i class="fa-brands fa-windows" style="color: #0ea5e9 !important; font-size: 40px !important;"></i>
                            </div>
                            <div class="flex-grow-1">
                                <h5 class="fw-bold mb-1 text-dark">{{ __('messages.computer_tech1_title') }}</h5>
                                <p class="text-secondary mb-0 small" style="line-height: 1.2;">{{ __('messages.computer_tech1_desc') }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 d-flex">
                        <div class="p-4 tech-card shadow-sm d-flex align-items-center flex-fill">
                            <div class="p-3 rounded-3 me-3 d-flex align-items-center justify-content-center flex-shrink-0" 
                                style="background-color: #fee2e2 !important; width: 70px; height: 70px;">
                                <i class="fa-solid fa-file-excel" style="color: #ef4444 !important; font-size: 40px !important;"></i>
                            </div>
                            <div class="flex-grow-1">
                                <h5 class="fw-bold mb-1 text-dark">{{ __('messages.computer_tech2_title') }}</h5>
                                <p class="text-secondary mb-0 small" style="line-height: 1.2;">{{ __('messages.computer_tech2_desc') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-5 d-none d-lg-block">
                <img src="https://img.icons8.com/color/480/windows-11.png" alt="Computer Literacy" class="img-fluid float-end" style="max-height: 300px; filter: drop-shadow(0 0 20px rgba(59, 130, 246, 0.3));">
            </div>
        </div>
    </div>

    <div class="row g-5">
        <div class="col-lg-8">
            <h3 class="fw-bold mb-4 d-flex align-items-center">
                <span class="bg-primary p-2 rounded-3 me-3 text-white" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;"><i class="fa-solid fa-graduation-cap"></i></span>
                {{ __('messages.computer_learn_section') }}
            </h3>
            
            <div class="row g-4 mb-5">
                @php
                    $skills = [
                        ['computer_skill1_title', 'computer_skill1_desc'],
                        ['computer_skill2_title', 'computer_skill2_desc'],
                        ['computer_skill3_title', 'computer_skill3_desc'],
                        ['computer_skill4_title', 'computer_skill4_desc'],
                        ['computer_skill5_title', 'computer_skill5_desc']
                    ];
                @endphp

                @foreach($skills as $skill)
                <div class="col-12">
                    <div class="tech-card p-4 shadow-sm d-flex align-items-start">
                        <div class="check-icon me-3">
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

            <div class="bg-light p-4 rounded-4 border-start border-primary border-4">
                <h4 class="fw-bold">{{ __('messages.computer_for_whom_title') }}</h4>
                <p class="text-secondary mb-0 fs-5">{{ __('messages.computer_for_whom_desc') }}</p>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card sticky-price-card shadow-lg p-3">
                <div class="card-body">
                    <h5 class="fw-bold mb-4 text-center">{{ __('messages.computer_card_title') }}</h5>
                    
                    <div class="d-flex align-items-center mb-3">
                        <i class="fa-solid fa-calendar-day text-primary me-3 fs-4"></i>
                        <div>
                            <small class="text-muted d-block">{{ __('messages.computer_duration_label') }}</small>
                            <span class="fw-bold text-dark">{{ __('messages.computer_duration_value') }}</span>
                        </div>
                    </div>

                    <div class="d-flex align-items-center mb-3">
                        <i class="fa-solid fa-user-tie text-primary me-3 fs-4"></i>
                        <div>
                            <small class="text-muted d-block">{{ __('messages.computer_mentor_label') }}</small>
                            <span class="fw-bold text-dark">{{ __('messages.computer_mentor_value') }}</span>
                        </div>
                    </div>

                    <hr class="my-4 opacity-10">

                    <div class="text-center mb-4">
                        <h6 class="text-muted text-decoration-line-through mb-1">{{ __('messages.computer_old_price') }}</h6>
                        <h2 class="fw-bold text-primary mb-0">{{ __('messages.computer_new_price') }} <small class="fs-6 text-dark opacity-50">{{ __('messages.computer_price_period') }}</small></h2>
                    </div>
                    
                    <a href="{{ url('/#contact') }}" class="btn btn-primary btn-lg w-100 rounded-pill py-3 shadow fw-bold mb-4">
                        <i class="fa-solid fa-bolt me-2"></i> {{ __('messages.computer_enroll_button') }}
                    </a>
                    
                    <div class="mt-2 px-2">
                        <div class="benefit-item">
                            <span class="benefit-icon">🎓</span>
                            <p class="benefit-text">{{ __('messages.computer_certificate_text') }}</p>
                        </div>
                        <div class="benefit-item">
                            <span class="benefit-icon">🖱️</span>
                            <p class="benefit-text">Noldan professional darajagacha amaliy mashqlar</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection