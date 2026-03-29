@extends('layouts.app')

@section('styles')
<style>
    .course-hero {
        background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
        border-radius: 30px;
        padding: 3rem;
        margin-bottom: 3rem;
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
        background: radial-gradient(circle, rgba(59,130,246,0.1) 1px, transparent 1px);
        background-size: 50px 50px;
        animation: moveGrid 20s linear infinite;
    }
    @keyframes moveGrid {
        0% { transform: translate(0, 0); }
        100% { transform: translate(50px, 50px); }
    }
    .course-badge {
        display: inline-block;
        background: rgba(59,130,246,0.2);
        backdrop-filter: blur(10px);
        padding: 0.5rem 1rem;
        border-radius: 50px;
        font-size: 0.8rem;
        font-weight: 600;
        color: #3b82f6;
        margin-bottom: 1rem;
    }
    .course-title {
        font-size: 2.5rem;
        font-weight: 800;
        margin-bottom: 1rem;
        color: white;
    }
    .course-description {
        font-size: 1rem;
        color: rgba(255,255,255,0.8);
        line-height: 1.6;
        margin-bottom: 1.5rem;
    }
    .info-card {
        background: white;
        border-radius: 20px;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        transition: all 0.3s ease;
    }
    .info-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.1);
    }
    .price-card {
        background: white;
        border-radius: 24px;
        padding: 2rem;
        position: sticky;
        top: 20px;
        box-shadow: 0 20px 35px -10px rgba(0,0,0,0.1);
        border: 1px solid rgba(59,130,246,0.2);
    }
    .price-old {
        font-size: 0.9rem;
        color: #94a3b8;
        text-decoration: line-through;
    }
    .price-new {
        font-size: 2rem;
        font-weight: 800;
        color: #3b82f6;
    }
    .price-period {
        font-size: 0.8rem;
        color: #64748b;
    }
    .btn-enroll {
        background: linear-gradient(135deg, #3b82f6, #2563eb);
        border: none;
        border-radius: 50px;
        padding: 0.9rem;
        font-weight: 700;
        font-size: 1rem;
        width: 100%;
        margin-top: 1.5rem;
        transition: all 0.3s ease;
    }
    .btn-enroll:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(59,130,246,0.4);
    }
    .skill-item {
        display: flex;
        align-items: flex-start;
        gap: 1rem;
        padding: 1rem;
        background: #f8fafc;
        border-radius: 12px;
        margin-bottom: 0.75rem;
        transition: all 0.3s ease;
    }
    .skill-item:hover {
        background: #f1f5f9;
        transform: translateX(5px);
    }
    .skill-check {
        width: 28px;
        height: 28px;
        background: #3b82f6;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 0.7rem;
        flex-shrink: 0;
    }
    .skill-title {
        font-weight: 700;
        color: #0f172a;
        margin-bottom: 0.25rem;
        font-size: 0.95rem;
    }
    .skill-desc {
        font-size: 0.75rem;
        color: #64748b;
    }
    .teacher-card {
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        border-radius: 20px;
        padding: 1.5rem;
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-top: 1.5rem;
    }
    .teacher-avatar {
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, #3b82f6, #2563eb);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        color: white;
        flex-shrink: 0;
    }
    .teacher-name {
        font-weight: 700;
        font-size: 1rem;
        color: #0f172a;
    }
    .teacher-position {
        font-size: 0.75rem;
        color: #64748b;
    }
    .tech-stack {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
        margin-top: 1rem;
    }
    .tech-badge {
        background: #f1f5f9;
        padding: 0.25rem 0.75rem;
        border-radius: 20px;
        font-size: 0.7rem;
        font-weight: 600;
        color: #3b82f6;
    }
    @media (max-width: 991px) {
        .course-title { font-size: 1.8rem; }
        .price-card { position: relative; margin-top: 2rem; }
    }
    @media (max-width: 768px) {
        .course-hero { padding: 1.5rem; }
        .course-title { font-size: 1.5rem; }
    }
</style>
@endsection

@section('content')
<div class="container py-4 py-md-5">
    <div class="course-hero">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <span class="course-badge"><i class="fas fa-robot me-2"></i> {{ __('messages.robotics_badge') }}</span>
                <h1 class="course-title">{{ __('messages.robotics_title') }}</h1>
                <p class="course-description">{{ __('messages.robotics_description') }}</p>
                <div class="d-flex gap-3 flex-wrap">
                    <div class="d-flex align-items-center gap-2"><i class="fas fa-clock text-primary"></i><span>{{ __('messages.robotics_duration') }}</span></div>
                    <div class="d-flex align-items-center gap-2"><i class="fas fa-users text-primary"></i><span>{{ __('messages.robotics_students') }} talaba</span></div>
                    <div class="d-flex align-items-center gap-2"><i class="fas fa-certificate text-primary"></i><span>{{ __('messages.certificate') }}</span></div>
                </div>
                <div class="tech-stack">
                    <span class="tech-badge">{{ __('messages.robotics_tech_arduino') }}</span>
                    <span class="tech-badge">{{ __('messages.robotics_tech_cpp') }}</span>
                    <span class="tech-badge">{{ __('messages.robotics_tech_sensors') }}</span>
                    <span class="tech-badge">{{ __('messages.robotics_tech_motors') }}</span>
                    <span class="tech-badge">{{ __('messages.robotics_tech_electronics') }}</span>
                    <span class="tech-badge">{{ __('messages.robotics_tech_iot') }}</span>
                </div>
            </div>
            <div class="col-lg-4 text-center d-none d-lg-block">
                <i class="fas fa-robot" style="font-size: 100px; color: rgba(59,130,246,0.5);"></i>
            </div>
        </div>
    </div>
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="info-card">
                <h3 class="fw-bold mb-3">📖 {{ __('messages.course_about') }}</h3>
                <p class="text-secondary">{{ __('messages.robotics_full_desc') }}</p>
            </div>
            <div class="info-card">
                <h3 class="fw-bold mb-3">📚 {{ __('messages.course_program') }}</h3>
                <div class="row g-2">
                    <div class="col-md-6">
                        <div class="skill-item">
                            <div class="skill-check"><i class="fas fa-check"></i></div>
                            <div>
                                <div class="skill-title">{{ __('messages.robotics_module1_title') }}</div>
                                <div class="skill-desc">{{ __('messages.robotics_module1_desc') }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="skill-item">
                            <div class="skill-check"><i class="fas fa-check"></i></div>
                            <div>
                                <div class="skill-title">{{ __('messages.robotics_module2_title') }}</div>
                                <div class="skill-desc">{{ __('messages.robotics_module2_desc') }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="skill-item">
                            <div class="skill-check"><i class="fas fa-check"></i></div>
                            <div>
                                <div class="skill-title">{{ __('messages.robotics_module3_title') }}</div>
                                <div class="skill-desc">{{ __('messages.robotics_module3_desc') }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="skill-item">
                            <div class="skill-check"><i class="fas fa-check"></i></div>
                            <div>
                                <div class="skill-title">{{ __('messages.robotics_module4_title') }}</div>
                                <div class="skill-desc">{{ __('messages.robotics_module4_desc') }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="skill-item">
                            <div class="skill-check"><i class="fas fa-check"></i></div>
                            <div>
                                <div class="skill-title">{{ __('messages.robotics_module5_title') }}</div>
                                <div class="skill-desc">{{ __('messages.robotics_module5_desc') }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="info-card">
                <h3 class="fw-bold mb-3">👨‍💻 {{ __('messages.course_for_who') }}</h3>
                <p class="text-secondary">{{ __('messages.robotics_for_who') }}</p>
            </div>
            <div class="teacher-card">
                <div class="teacher-avatar"><i class="fas fa-chalkboard-user"></i></div>
                <div>
                    <div class="teacher-name">{{ __('messages.robotics_teacher') }}</div>
                    <div class="teacher-position">{{ __('messages.robotics_teacher_position') }}</div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="price-card">
                <div class="text-center mb-3">
                    <span class="price-old">{{ __('messages.robotics_old_price') }}</span>
                    <div class="price-new">{{ __('messages.robotics_price') }}</div>
                    <span class="price-period">{{ __('messages.price_per_month') }}</span>
                </div>
                <hr>
                <div class="mb-3">
                    <div class="d-flex justify-content-between mb-2">
                        <span><i class="fas fa-clock me-2 text-primary"></i> {{ __('messages.course_duration_label') }}</span>
                        <span class="fw-bold">{{ __('messages.robotics_duration') }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span><i class="fas fa-calendar me-2 text-primary"></i> {{ __('messages.course_schedule') }}</span>
                        <span class="fw-bold">{{ __('messages.course_schedule_value') }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span><i class="fas fa-language me-2 text-primary"></i> {{ __('messages.course_language') }}</span>
                        <span class="fw-bold">{{ __('messages.course_language_value') }}</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span><i class="fas fa-certificate me-2 text-primary"></i> {{ __('messages.certificate') }}</span>
                        <span class="fw-bold">✓ {{ __('messages.has') }}</span>
                    </div>
                </div>
                <hr>
                <button class="btn btn-enroll text-white" data-bs-toggle="modal" data-bs-target="#enrollModal">
                    <i class="fas fa-bolt me-2"></i> {{ __('messages.robotics_enroll_button') }}
                </button>
                <div class="text-center mt-3">
                    <small class="text-muted"><i class="fas fa-headset me-1"></i> {{ __('messages.support_text') }}</small>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="enrollModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4">
            <div class="modal-header border-0">
                <h5 class="modal-title fw-bold">{{ __('messages.robotics_title') }} {{ __('messages.enroll_modal_title') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form>
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">{{ __('messages.your_name') }}</label>
                        <input type="text" class="form-control rounded-3" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ __('messages.your_phone') }}</label>
                        <input type="tel" class="form-control rounded-3" placeholder="+998 __ ___ __ __" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ __('messages.email') }}</label>
                        <input type="email" class="form-control rounded-3" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 rounded-3 py-2">
                        <i class="fas fa-paper-plane me-2"></i> {{ __('messages.send') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection