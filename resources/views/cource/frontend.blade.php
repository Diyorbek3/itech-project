@extends('layouts.app')

@section('styles')
<<<<<<< HEAD
<style>/* same styles as above */</style>
@endsection

@section('content')
<div class="container py-4 py-md-5">
    <div class="course-hero">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <span class="course-badge"><i class="fas fa-code me-2"></i> Frontend Development</span>
                <h1 class="course-title">Frontend Dasturchi</h1>
                <p class="course-description">HTML, CSS, JavaScript va React.js bilan zamonaviy veb-saytlar yaratishni o'rganing. Foydalanuvchi interfeyslari, responsive dizayn.</p>
                <div class="d-flex gap-3 flex-wrap">
                    <div class="d-flex align-items-center gap-2"><i class="fas fa-clock text-primary"></i><span>7 oy</span></div>
                    <div class="d-flex align-items-center gap-2"><i class="fas fa-users text-primary"></i><span>180+ talaba</span></div>
                    <div class="d-flex align-items-center gap-2"><i class="fas fa-certificate text-primary"></i><span>Sertifikat beriladi</span></div>
                </div>
            </div>
            <div class="col-lg-4 text-center d-none d-lg-block"><i class="fas fa-code" style="font-size: 100px; color: rgba(59,130,246,0.5);"></i></div>
=======
<style>
    /* Frontend uslubidagi gradient sarlavha */
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
        background: rgba(255,255,255,0.9); 
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

    /* Frontend texnologiya kartalari */
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

    .course-icon i { font-size: 36px; }

    .course-content h5 { font-size: 1.1rem; font-weight: 700; margin-bottom: 0.25rem; color: #1e293b; }
    .course-content p { font-size: 0.85rem; color: #64748b; margin-bottom: 0; line-height: 1.4; }

    /* Yangi Afzalliklar Stili */
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
                <span class="badge bg-primary mb-3 px-3 py-2 rounded-pill shadow-sm">{{ __('messages.frontend_badge') }}</span>
                
                <h1 class="display-3 fw-bold mb-3">
                    <span class="title-gradient">Frontend</span><br>
                    <span class="title-secondary">Development</span>
                </h1>

                <p class="fs-5 opacity-75 mb-4 lh-lg">{{ __('messages.frontend_description') }}</p>
                
                <div class="row g-4 mb-5">
                    <div class="col-md-6">
                        <div class="course-card">
                            <div class="course-icon" style="background-color: #fff5f2 !important;">
                                <i class="fa-brands fa-html5" style="color: #e34f26;"></i>
                            </div>
                            <div class="course-content">
                                <h5>{{ __('messages.frontend_tech1_title') }}</h5>
                                <p>{{ __('messages.frontend_tech1_desc') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="course-card">
                            <div class="course-icon" style="background-color: #fffdf2 !important;">
                                <i class="fa-brands fa-js" style="color: #f7df1e;"></i>
                            </div>
                            <div class="course-content">
                                <h5>{{ __('messages.frontend_tech2_title') }}</h5>
                                <p>{{ __('messages.frontend_tech2_desc') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 d-none d-lg-block text-center">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/61/HTML5_logo_and_wordmark.svg/512px-HTML5_logo_and_wordmark.svg.png" 
                     alt="Frontend" class="img-fluid" style="max-height: 280px; filter: drop-shadow(0 0 20px rgba(59, 130, 246, 0.3));">
            </div>
>>>>>>> 0cd844a147b3f1c0c64771e012c3376b29ebf5bf
        </div>
    </div>
    <div class="row g-4">
        <div class="col-lg-8">
<<<<<<< HEAD
            <div class="info-card"><h3 class="fw-bold mb-3">📖 Kurs haqida</h3><p class="text-secondary">Frontend dasturchi kursida siz veb-saytlarning tashqi ko'rinishini yaratishni, HTML5, CSS3, JavaScript va zamonaviy frameworklar bilan ishlashni o'rganasiz.</p></div>
            <div class="info-card"><h3 class="fw-bold mb-3">📚 O'quv dasturi</h3><div class="row g-2">
                <div class="col-md-6"><div class="skill-item"><div class="skill-check"><i class="fas fa-check"></i></div><div><div class="skill-title">HTML5</div><div class="skill-desc">Veb-sahifa tuzilishi va semantic teglar</div></div></div></div>
                <div class="col-md-6"><div class="skill-item"><div class="skill-check"><i class="fas fa-check"></i></div><div><div class="skill-title">CSS3</div><div class="skill-desc">Dizayn, animatsiyalar, responsive layout</div></div></div></div>
                <div class="col-md-6"><div class="skill-item"><div class="skill-check"><i class="fas fa-check"></i></div><div><div class="skill-title">JavaScript</div><div class="skill-desc">Dinamik elementlar, eventlar, DOM</div></div></div></div>
                <div class="col-md-6"><div class="skill-item"><div class="skill-check"><i class="fas fa-check"></i></div><div><div class="skill-title">Bootstrap & Tailwind</div><div class="skill-desc">Tez va chiroyli dizayn yaratish</div></div></div></div>
                <div class="col-md-6"><div class="skill-item"><div class="skill-check"><i class="fas fa-check"></i></div><div><div class="skill-title">React.js</div><div class="skill-desc">Zamonaviy frontend framework</div></div></div></div>
            </div></div>
            <div class="info-card"><h3 class="fw-bold mb-3">👨‍💻 Kimlar uchun?</h3><p class="text-secondary">Dasturlashni boshlashni xohlovchilar, veb-dizayn va dasturlashni birga o'rganmoqchi bo'lganlar, kreativ fikrlovchilar.</p></div>
            <div class="teacher-card"><div class="teacher-avatar"><i class="fas fa-chalkboard-user"></i></div><div><div class="teacher-name">Abdugafforov Azimjon, Mirzamahmudov G', Asqarov Sh</div><div class="teacher-position">Senior Frontend Developer</div></div></div>
=======
            <h3 class="fw-bold mb-4 d-flex align-items-center">
                <span class="bg-primary p-2 rounded-3 me-3 text-white" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;"><i class="fa-solid fa-graduation-cap"></i></span>
                {{ __('messages.frontend_learn_section') }}
            </h3>
            
            <div class="row g-4 mb-5">
                @php 
                    $skills = [
                        ['frontend_skill1_title','frontend_skill1_desc'],
                        ['frontend_skill2_title','frontend_skill2_desc'],
                        ['frontend_skill3_title','frontend_skill3_desc'],
                        ['frontend_skill4_title','frontend_skill4_desc'],
                        ['frontend_skill5_title','frontend_skill5_desc']
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
                <h4 class="fw-bold">{{ __('messages.frontend_for_whom_title') }}</h4>
                <p class="text-secondary mb-0 fs-5">{{ __('messages.frontend_for_whom_desc') }}</p>
            </div>
>>>>>>> 0cd844a147b3f1c0c64771e012c3376b29ebf5bf
        </div>

        <div class="col-lg-4">
<<<<<<< HEAD
            <div class="price-card"><div class="text-center mb-3"><span class="price-old">950,000 so'm</span><div class="price-new">850,000 so'm</div><span class="price-period">/ oy</span></div><hr><div class="mb-3"><div class="d-flex justify-content-between mb-2"><span><i class="fas fa-clock me-2 text-primary"></i> Davomiyligi</span><span class="fw-bold">7 oy</span></div><div class="d-flex justify-content-between mb-2"><span><i class="fas fa-calendar me-2 text-primary"></i> Darslar</span><span class="fw-bold">Haftada 3 kun</span></div><div class="d-flex justify-content-between mb-2"><span><i class="fas fa-language me-2 text-primary"></i> Til</span><span class="fw-bold">O'zbek tilida</span></div><div class="d-flex justify-content-between"><span><i class="fas fa-certificate me-2 text-primary"></i> Sertifikat</span><span class="fw-bold">✓ Bor</span></div></div><hr><button class="btn btn-enroll text-white" data-bs-toggle="modal" data-bs-target="#enrollModal"><i class="fas fa-bolt me-2"></i> Hoziroq yozilish</button><div class="text-center mt-3"><small class="text-muted"><i class="fas fa-headset me-1"></i> 24/7 mentor yordami</small></div></div>
=======
            <div class="card sticky-price-card shadow-lg p-3">
                <div class="card-body">
                    <h5 class="fw-bold mb-4 text-center text-dark">{{ __('messages.frontend_card_title') }}</h5>
                    
                    <div class="price-item mb-3 p-3 bg-light rounded-4">
                        <div class="d-flex align-items-center mb-2">
                            <i class="fa-solid fa-calendar-day text-primary me-3 fs-5"></i>
                            <div>
                                <small class="text-muted d-block">{{ __('messages.frontend_duration_label') }}</small>
                                <span class="fw-bold text-dark">{{ __('messages.frontend_duration_value') }}</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="price-item mb-3 p-3 bg-light rounded-4">
                        <div class="d-flex align-items-center">
                            <i class="fa-solid fa-user-tie text-primary me-3 fs-5"></i>
                            <div>
                                <small class="text-muted d-block">{{ __('messages.frontend_mentor_label') }}</small>
                                <span class="fw-bold text-dark">{{ __('messages.frontend_mentor_value') }}</span>
                            </div>
                        </div>
                    </div>
                    
                    <hr class="my-4 opacity-10">
                    
                    <div class="text-center mb-4">
                        <h6 class="text-muted text-decoration-line-through mb-1">{{ __('messages.frontend_old_price') }}</h6>
                        <h2 class="fw-bold text-primary mb-0">{{ __('messages.frontend_new_price') }} <small class="fs-6 text-dark opacity-50">{{ __('messages.frontend_price_period') }}</small></h2>
                    </div>
                    
                    <a href="{{ url('/#contact') }}" class="btn btn-primary btn-lg w-100 rounded-pill py-3 shadow fw-bold mb-4">
                        <i class="fa-solid fa-bolt me-2"></i> {{ __('messages.frontend_enroll_button') }}
                    </a>
                    
                    <div class="mt-2 px-2">
                        <div class="benefit-item">
                            <span class="benefit-icon">🏆</span>
                            <p class="benefit-text">Xalqaro darajadagi sertifikat</p>
                        </div>
                        
                        <div class="benefit-item">
                            <span class="benefit-icon">💻</span>
                            <p class="benefit-text">Portfolio uchun 5 tadan ortiq real loyihalar</p>
                        </div>
                    </div>
                </div>
            </div>
>>>>>>> 0cd844a147b3f1c0c64771e012c3376b29ebf5bf
        </div>
    </div>
</div>
<div class="modal fade" id="enrollModal" tabindex="-1"><div class="modal-dialog modal-dialog-centered"><div class="modal-content rounded-4"><div class="modal-header border-0"><h5 class="modal-title fw-bold">Frontend kursiga yozilish</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div><div class="modal-body"><form>@csrf<div class="mb-3"><label class="form-label">Ismingiz</label><input type="text" class="form-control rounded-3" required></div><div class="mb-3"><label class="form-label">Telefon raqam</label><input type="tel" class="form-control rounded-3" placeholder="+998 __ ___ __ __" required></div><div class="mb-3"><label class="form-label">Email</label><input type="email" class="form-control rounded-3" required></div><button type="submit" class="btn btn-primary w-100 rounded-3 py-2"><i class="fas fa-paper-plane me-2"></i> Yuborish</button></form></div></div></div></div>
@endsection