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
    }
    .tech-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.1) !important;
        border-color: #3b82f6;
    }
    .sticky-price-card {
        border: none;
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255,255,255,0.4);
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
    .gradient-text {
        background: linear-gradient(90deg, #3b82f6, #2dd4bf);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
    
    /* Kartochkalar uchun bir xil balandlik */
    .course-card {
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 20px;
        padding: 1.5rem;
        transition: all 0.3s ease;
        height: 100%;
        display: flex;
        align-items: center;
        gap: 1rem;
    }
    .course-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 30px -10px rgba(0, 0, 0, 0.1);
        border-color: #3b82f6;
    }
    .course-icon {
        width: 70px;
        height: 70px;
        border-radius: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    .course-icon.python {
        background: linear-gradient(135deg, #e0f2fe 0%, #bae6fd 100%);
    }
    .course-icon.data {
        background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
    }
    .course-icon i {
        font-size: 36px;
    }
    .course-content h5 {
        font-size: 1.1rem;
        font-weight: 700;
        margin-bottom: 0.25rem;
        color: #1e293b;
    }
    .course-content p {
        font-size: 0.85rem;
        color: #64748b;
        margin-bottom: 0;
        line-height: 1.4;
    }
</style>
@endsection

@section('content')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const urlParams = new URLSearchParams(window.location.search);
    const scrollPos = urlParams.get('scroll');
    if (scrollPos) {
        setTimeout(function() {
            window.scrollTo(0, parseInt(scrollPos));
        }, 100);
    }
});
</script>

<div class="container py-5">
    
    <div class="course-hero p-4 p-md-5 mb-5 shadow-lg">
        <div class="row align-items-center">
            <div class="col-lg-7">
                <h1 class="display-3 fw-bold mb-3">{!! __('messages.python_title') !!}</h1>
                <p class="fs-5 opacity-75 mb-4 lh-lg">
                    {{ __('messages.python_description') }}
                </p>
                <div class="d-flex gap-3">
                    <div class="row g-4 mb-5">
                        {{-- KARTOCHKA 1: Python 3.x --}}
                        <div class="col-md-6">
                            <div class="course-card">
                                <div class="course-icon python">
                                    <i class="fa-brands fa-python" style="color: #0ea5e9;"></i>
                                </div>
                                <div class="course-content">
                                    <h5>{{ __('messages.python_tech1_title') }}</h5>
                                    <p>{{ __('messages.python_tech1_desc') }}</p>
                                </div>
                            </div>
                        </div>

                        {{-- KARTOCHKA 2: Ma'lumotlar tahlili --}}
                        <div class="col-md-6">
                            <div class="course-card">
                                <div class="course-icon data">
                                    <i class="fa-solid fa-chart-line" style="color: #ef4444;"></i>
                                </div>
                                <div class="course-content">
                                    <h5>{{ __('messages.python_tech2_title') }}</h5>
                                    <p>{{ __('messages.python_tech2_desc') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 d-none d-lg-block">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/c3/Python-logo-notext.svg/1200px-Python-logo-notext.svg.png" 
                     alt="Python Development" class="img-fluid rounded-4 shadow-2xl float-end" style="max-height: 300px;">
            </div>
        </div>
    </div>

    <div class="row g-5">
        <div class="col-lg-8">
            <h3 class="fw-bold mb-4 d-flex align-items-center">
                <span class="bg-primary p-2 rounded-3 me-3 text-white" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                    <i class="fa-solid fa-graduation-cap"></i>
                </span>
                {{ __('messages.python_learn_section') }}
            </h3>

            <div class="row g-4 mb-5">
                @php
                    $skills = [
                        ['title_key' => 'python_skill1_title', 'desc_key' => 'python_skill1_desc'],
                        ['title_key' => 'python_skill2_title', 'desc_key' => 'python_skill2_desc'],
                        ['title_key' => 'python_skill3_title', 'desc_key' => 'python_skill3_desc'],
                        ['title_key' => 'python_skill4_title', 'desc_key' => 'python_skill4_desc'],
                        ['title_key' => 'python_skill5_title', 'desc_key' => 'python_skill5_desc']
                    ];
                @endphp

                @foreach($skills as $skill)
                <div class="col-12">
                    <div class="tech-card p-4 rounded-4 shadow-sm d-flex align-items-start">
                        <div class="check-icon me-3 flex-shrink-0">
                            <i class="fa-solid fa-check"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold mb-1 text-dark">{{ __("messages.{$skill['title_key']}") }}</h5>
                            <p class="text-secondary mb-0 small">{{ __("messages.{$skill['desc_key']}") }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="bg-light p-4 rounded-4 border-start border-primary border-4">
                <h4 class="fw-bold">{{ __('messages.python_for_whom_title') }}</h4>
                <p class="text-secondary mb-0 fs-5">
                    {{ __('messages.python_for_whom_desc') }}
                </p>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card sticky-price-card shadow-lg rounded-5 p-3">
                <div class="card-body">
                    <h5 class="fw-bold mb-4 text-center">{{ __('messages.python_card_title') }}</h5>
                    
                    <div class="d-flex align-items-center mb-3">
                        <i class="fa-solid fa-calendar-day text-primary me-3 fs-4"></i>
                        <div>
                            <small class="text-muted d-block">{{ __('messages.python_duration_label') }}</small>
                            <span class="fw-bold">{{ __('messages.python_duration_value') }}</span>
                        </div>
                    </div>

                    <div class="d-flex align-items-center mb-3">
                        <i class="fa-solid fa-user-tie text-primary me-3 fs-4"></i>
                        <div>
                            <small class="text-muted d-block">{{ __('messages.python_mentor_label') }}</small>
                            <span class="fw-bold">{{ __('messages.python_mentor_value') }}</span>
                        </div>
                    </div>

                    <hr class="my-4 opacity-10">

                    <div class="text-center mb-4">
                        <h6 class="text-muted text-decoration-line-through mb-1">{{ __('messages.python_old_price') }}</h6>
                        <h2 class="fw-bold text-primary mb-0">{{ __('messages.python_new_price') }} <small class="fs-6 text-dark text-opacity-50">{{ __('messages.python_price_period') }}</small></h2>
                    </div>
                    
                    <a href="{{ url('/#contact') }}" class="btn btn-primary btn-lg w-100 rounded-pill py-3 shadow fw-bold mb-3">
                        <i class="fa-solid fa-rocket me-2"></i> {{ __('messages.python_enroll_button') }}
                    </a>
                    
                    <div class="certificate-box mt-4 p-4 rounded-4 text-center" style="background: linear-gradient(135deg, #fff9e6 0%, #fff5e0 100%); border: 1px solid #ffd966; border-radius: 20px;">
    <div class="d-flex justify-content-center gap-4 mb-3">
        <div class="text-center">
            <div class="bg-warning bg-opacity-10 p-2 rounded-circle" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center; margin: 0 auto;">
                <i class="fa-solid fa-scroll fa-2x" style="color: #b8860b;"></i>
            </div>
            <p class="small fw-bold mb-0 mt-2">Diplom</p>
            <small class="text-muted">Davlat tomonidan</small>
        </div>
        <div class="text-center">
            <div class="bg-primary bg-opacity-10 p-2 rounded-circle" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center; margin: 0 auto;">
                <i class="fa-solid fa-certificate fa-2x" style="color: #0ea5e9;"></i>
            </div>
            <p class="small fw-bold mb-0 mt-2">Sertifikat</p>
            <small class="text-muted">Xalqaro standart</small>
        </div>
        <div class="text-center">
            <div class="bg-success bg-opacity-10 p-2 rounded-circle" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center; margin: 0 auto;">
                <i class="fa-solid fa-briefcase fa-2x" style="color: #22c55e;"></i>
            </div>
            <p class="small fw-bold mb-0 mt-2">Karyera</p>
            <small class="text-muted">Ishga joylashish</small>
        </div>
    </div>
    <hr class="my-3">
    <p class="small text-muted mb-0">
        <i class="fa-solid fa-star me-1 text-warning"></i> 
        {{ __('messages.python_certificate_text') }}
    </p>
</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection