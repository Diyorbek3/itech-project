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
</style>
@endsection

@section('content')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const urlParams = new URLSearchParams(window.location.search);
    const scrollPos = urlParams.get('scroll');
    if (scrollPos) {
        setTimeout(function() { window.scrollTo(0, parseInt(scrollPos)); }, 100);
    }
});
</script>

<div class="container py-5">
    <div class="course-hero p-4 p-md-5 mb-5 shadow-lg">
        <div class="row align-items-center">
            <div class="col-lg-7">
                <span class="badge bg-primary mb-3 px-3 py-2 rounded-pill shadow-sm">{{ __('messages.ai_badge') }}</span>
                <h1 class="display-3 fw-bold mb-3">{!! __('messages.ai_title') !!}</h1>
                <p class="fs-5 opacity-75 mb-4 lh-lg">{{ __('messages.ai_description') }}</p>
                <div class="d-flex gap-3">
                    <div class="row g-4 mb-5">
                        <div class="col-md-6">
                            <div class="p-4 rounded-4 shadow-sm border bg-white d-flex align-items-center">
                                <div class="p-3 rounded-3 me-3 d-flex align-items-center justify-content-center" style="background-color: #e0f2fe !important; width: 70px; height: 70px;">
                                    <i class="fa-solid fa-brain" style="color: #0ea5e9 !important; font-size: 40px !important;"></i>
                                </div>
                                <div>
                                    <h5 class="fw-bold mb-1">{{ __('messages.ai_tech1_title') }}</h5>
                                    <p class="text-secondary mb-0 small">{{ __('messages.ai_tech1_desc') }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-4 rounded-4 shadow-sm border bg-white d-flex align-items-center">
                                <div class="p-3 rounded-3 me-3 d-flex align-items-center justify-content-center" style="background-color: #fee2e2 !important; width: 70px; height: 70px;">
                                    <i class="fa-solid fa-microchip" style="color: #ef4444 !important; font-size: 40px !important;"></i>
                                </div>
                                <div>
                                    <h5 class="fw-bold mb-1">{{ __('messages.ai_tech2_title') }}</h5>
                                    <p class="text-secondary mb-0 small">{{ __('messages.ai_tech2_desc') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 d-none d-lg-block">
                <img src="https://www.nicepng.com/png/full/962-9625201_ai-developer-bootcamp-circle.png" alt="AI Developer" class="img-fluid rounded-4 shadow-2xl float-end" style="max-height: 300px;">
            </div>
        </div>
    </div>

    <div class="row g-5">
        <div class="col-lg-8">
            <h3 class="fw-bold mb-4 d-flex align-items-center">
                <span class="bg-primary p-2 rounded-3 me-3 text-white" style="width: 40px; height: 40px;"><i class="fa-solid fa-graduation-cap"></i></span>
                {{ __('messages.ai_learn_section') }}
            </h3>
            <div class="row g-4 mb-5">
                @php $skills = [['ai_skill1_title','ai_skill1_desc'],['ai_skill2_title','ai_skill2_desc'],['ai_skill3_title','ai_skill3_desc'],['ai_skill4_title','ai_skill4_desc'],['ai_skill5_title','ai_skill5_desc']]; @endphp
                @foreach($skills as $skill)
                <div class="col-12"><div class="tech-card p-4 rounded-4 shadow-sm d-flex align-items-start"><div class="check-icon me-3"><i class="fa-solid fa-check"></i></div><div><h5 class="fw-bold mb-1 text-dark">{{ __("messages.{$skill[0]}") }}</h5><p class="text-secondary mb-0 small">{{ __("messages.{$skill[1]}") }}</p></div></div></div>
                @endforeach
            </div>
            <div class="bg-light p-4 rounded-4 border-start border-primary border-4"><h4 class="fw-bold">{{ __('messages.ai_for_whom_title') }}</h4><p class="text-secondary mb-0 fs-5">{{ __('messages.ai_for_whom_desc') }}</p></div>
        </div>
        <div class="col-lg-4">
            <div class="card sticky-price-card shadow-lg rounded-5 p-3"><div class="card-body"><h5 class="fw-bold mb-4 text-center">{{ __('messages.ai_card_title') }}</h5><div class="d-flex align-items-center mb-3"><i class="fa-solid fa-calendar-day text-primary me-3 fs-4"></i><div><small class="text-muted d-block">{{ __('messages.ai_duration_label') }}</small><span class="fw-bold">{{ __('messages.ai_duration_value') }}</span></div></div><div class="d-flex align-items-center mb-3"><i class="fa-solid fa-user-tie text-primary me-3 fs-4"></i><div><small class="text-muted d-block">{{ __('messages.ai_mentor_label') }}</small><span class="fw-bold">{{ __('messages.ai_mentor_value') }}</span></div></div><hr><div class="text-center mb-4"><h6 class="text-muted text-decoration-line-through mb-1">{{ __('messages.ai_old_price') }}</h6><h2 class="fw-bold text-primary mb-0">{{ __('messages.ai_new_price') }} <small class="fs-6">{{ __('messages.ai_price_period') }}</small></h2></div><a href="{{ url('/#contact') }}" class="btn btn-primary btn-lg w-100 rounded-pill py-3 shadow fw-bold mb-3"><i class="fa-solid fa-bolt me-2"></i> {{ __('messages.ai_enroll_button') }}</a><p class="text-center small text-muted mb-0"><i class="fa-solid fa-shield-halved me-1 text-success"></i> {{ __('messages.ai_certificate_text') }}</p></div></div>
        </div>
    </div>
</div>
@endsection