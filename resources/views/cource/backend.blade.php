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
        border-radius: 30px;
        padding: 3rem;
        margin-bottom: 3rem;
        position: relative;
        overflow: hidden;
    }
<<<<<<< HEAD
    
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
=======

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
>>>>>>> 0cd844a147b3f1c0c64771e012c3376b29ebf5bf
        box-shadow: 0 20px 35px -10px rgba(0,0,0,0.1);
        border: 1px solid rgba(59,130,246,0.2);
    }
<<<<<<< HEAD
    
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
        background: #22c55e;
        border-radius: 8px;
=======

    .check-icon {
        width: 35px;
        height: 35px;
        background: #dcfce7;
        color: #16a34a;
>>>>>>> 0cd844a147b3f1c0c64771e012c3376b29ebf5bf
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 0.7rem;
        flex-shrink: 0;
    }
<<<<<<< HEAD
    
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
=======

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
>>>>>>> 0cd844a147b3f1c0c64771e012c3376b29ebf5bf
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        color: white;
        flex-shrink: 0;
<<<<<<< HEAD
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
    
    @media (max-width: 991px) {
        .course-title {
            font-size: 1.8rem;
        }
        .price-card {
            position: relative;
            margin-top: 2rem;
        }
=======
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
>>>>>>> 0cd844a147b3f1c0c64771e012c3376b29ebf5bf
    }
    
    @media (max-width: 768px) {
        .course-hero {
            padding: 1.5rem;
        }
        .course-title {
            font-size: 1.5rem;
        }
    }
</style>
@endsection

@section('content')
<<<<<<< HEAD
<div class="container py-4 py-md-5">
    <div class="course-hero">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <span class="course-badge">
                    <i class="fas fa-graduation-cap me-2"></i> Backend Development
                </span>
                <h1 class="course-title">Backend Dasturchi</h1>
                <p class="course-description">PHP, Laravel va MySQL bilan server tomon dasturlashni o'rganing. API, ma'lumotlar bazasi va autentifikatsiya kabi muhim mavzularni amaliy loyihalar bilan mustahkamlang.</p>
                <div class="d-flex gap-3 flex-wrap">
                    <div class="d-flex align-items-center gap-2">
                        <i class="fas fa-clock text-primary"></i>
                        <span>5 oy</span>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <i class="fas fa-users text-primary"></i>
                        <span>200+ talaba</span>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <i class="fas fa-certificate text-primary"></i>
                        <span>Sertifikat beriladi</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 text-center d-none d-lg-block">
                <i class="fas fa-server" style="font-size: 100px; color: rgba(59,130,246,0.5);"></i>
            </div>
        </div>
    </div>
    
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="info-card">
                <h3 class="fw-bold mb-3">📖 Kurs haqida</h3>
                <p class="text-secondary">Backend dasturchi kursida siz PHP dasturlash tilini, Laravel frameworkini, MySQL ma'lumotlar bazasini va REST API yaratishni o'rganasiz. Kurs davomida real loyihalar ustida ishlaysiz va bitiruv portfoliyo tayyorlaysiz.</p>
            </div>
            
            <div class="info-card">
                <h3 class="fw-bold mb-3">📚 O'quv dasturi</h3>
                <div class="row g-2">
                    <div class="col-md-6">
                        <div class="skill-item">
                            <div class="skill-check"><i class="fas fa-check"></i></div>
                            <div>
                                <div class="skill-title">PHP asoslari va OOP</div>
                                <div class="skill-desc">PHP sintaksisi, obyektga yo'naltirilgan dasturlash</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="skill-item">
                            <div class="skill-check"><i class="fas fa-check"></i></div>
                            <div>
                                <div class="skill-title">Laravel Framework</div>
                                <div class="skill-desc">Eloquent ORM, Blade, Middleware, Service Provider</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="skill-item">
                            <div class="skill-check"><i class="fas fa-check"></i></div>
                            <div>
                                <div class="skill-title">MySQL va ma'lumotlar bazasi</div>
                                <div class="skill-desc">Murakkab so'rovlar, indekslash, optimizatsiya</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="skill-item">
                            <div class="skill-check"><i class="fas fa-check"></i></div>
                            <div>
                                <div class="skill-title">RESTful API yaratish</div>
                                <div class="skill-desc">API dizayn, autentifikatsiya, API resurslari</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="skill-item">
                            <div class="skill-check"><i class="fas fa-check"></i></div>
                            <div>
                                <div class="skill-title">Deployment va DevOps</div>
                                <div class="skill-desc">Git, CI/CD, server sozlamalari</div>
=======
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
>>>>>>> 0cd844a147b3f1c0c64771e012c3376b29ebf5bf
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
<<<<<<< HEAD
            
            <div class="info-card">
                <h3 class="fw-bold mb-3">👨‍💻 Kimlar uchun?</h3>
                <p class="text-secondary">Frontend dasturchilar, yangi boshlovchilar, o'z bilimini mustahkamoqchi bo'lgan dasturchilar va backend sohasiga kirishni xohlovchilar uchun.</p>
            </div>
            
            <div class="teacher-card">
                <div class="teacher-avatar"><i class="fas fa-chalkboard-user"></i></div>
                <div>
                    <div class="teacher-name">Ergashev Sardor, Madiyarov Bilol</div>
                    <div class="teacher-position">Senior Backend Developer</div>
                </div>
            </div>
        </div>
        
=======

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

>>>>>>> 0cd844a147b3f1c0c64771e012c3376b29ebf5bf
        <div class="col-lg-4">
            <div class="price-card">
                <div class="text-center mb-3">
                    <span class="price-old">750,000 so'm</span>
                    <div class="price-new">600,000 so'm</div>
                    <span class="price-period">/ oy</span>
                </div>
                <hr>
                <div class="mb-3">
                    <div class="d-flex justify-content-between mb-2">
                        <span><i class="fas fa-clock me-2 text-primary"></i> Davomiyligi</span>
                        <span class="fw-bold">5 oy</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span><i class="fas fa-calendar me-2 text-primary"></i> Darslar</span>
                        <span class="fw-bold">Haftada 3 kun</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span><i class="fas fa-language me-2 text-primary"></i> Til</span>
                        <span class="fw-bold">O'zbek tilida</span>
                    </div>
<<<<<<< HEAD
                    <div class="d-flex justify-content-between">
                        <span><i class="fas fa-certificate me-2 text-primary"></i> Sertifikat</span>
                        <span class="fw-bold">✓ Bor</span>
=======

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
>>>>>>> 0cd844a147b3f1c0c64771e012c3376b29ebf5bf
                    </div>
                </div>
                <hr>
                <button class="btn btn-enroll text-white" data-bs-toggle="modal" data-bs-target="#enrollModal">
                    <i class="fas fa-bolt me-2"></i> Hoziroq yozilish
                </button>
                <div class="text-center mt-3">
                    <small class="text-muted"><i class="fas fa-headset me-1"></i> 24/7 mentor yordami</small>
                </div>
            </div>
        </div>
    </div>
</div>

<<<<<<< HEAD
<!-- Modal -->
<div class="modal fade" id="enrollModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4">
            <div class="modal-header border-0">
                <h5 class="modal-title fw-bold">Backend kursiga yozilish</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form>
=======
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
>>>>>>> 0cd844a147b3f1c0c64771e012c3376b29ebf5bf
                    @csrf
                    <div class="mb-3">
<<<<<<< HEAD
                        <label class="form-label">Ismingiz</label>
                        <input type="text" class="form-control rounded-3" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Telefon raqam</label>
                        <input type="tel" class="form-control rounded-3" placeholder="+998 __ ___ __ __" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control rounded-3" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 rounded-3 py-2">
                        <i class="fas fa-paper-plane me-2"></i> Yuborish
=======
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
>>>>>>> 0cd844a147b3f1c0c64771e012c3376b29ebf5bf
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection