@extends('layouts.app')

@section('styles')
<style>
    /* Asosiy Hero qismi */
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
        border: 1px solid rgba(59,130,246,0.3);
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

    /* Kartochkalar */
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
        top: 100px;
        box-shadow: 0 20px 35px -10px rgba(0,0,0,0.1);
        border: 1px solid rgba(59,130,246,0.2);
    }
    .price-old { font-size: 0.9rem; color: #94a3b8; text-decoration: line-through; }
    .price-new { font-size: 2rem; font-weight: 800; color: #3b82f6; }
    .price-period { font-size: 0.8rem; color: #64748b; }

    /* Tugma */
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
        color: white !important;
        cursor: pointer;
    }
    .btn-enroll:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(59,130,246,0.4);
    }

    /* Modullar */
    .skill-item {
        display: flex;
        align-items: flex-start;
        gap: 1rem;
        padding: 1rem;
        background: #f8fafc;
        border-radius: 12px;
        margin-bottom: 0.75rem;
        transition: all 0.3s ease;
        height: 100%;
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
    .skill-title { font-weight: 700; color: #0f172a; margin-bottom: 0.25rem; font-size: 0.95rem; }
    .skill-desc { font-size: 0.75rem; color: #64748b; }

    /* O'qituvchi */
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
        width: 60px; height: 60px;
        background: linear-gradient(135deg, #3b82f6, #2563eb);
        border-radius: 50%; display: flex; align-items: center; justify-content: center;
        font-size: 1.5rem; color: white; flex-shrink: 0;
    }

    /* Tech Stack */
    .tech-stack { display: flex; flex-wrap: wrap; gap: 0.5rem; margin-top: 1rem; }
    .tech-badge {
        background: rgba(59,130,246,0.15); padding: 0.35rem 0.85rem;
        border-radius: 20px; font-size: 0.75rem; font-weight: 600; color: #60a5fa;
        backdrop-filter: blur(5px);
    }

    /* Custom Modal (Rasmga mos dizayn) */
    .custom-modal-overlay {
        position: fixed; top: 0; left: 0; width: 100%; height: 100%;
        background-color: rgba(0, 0, 0, 0.4); backdrop-filter: blur(5px);
        display: flex; align-items: center; justify-content: center;
        z-index: 1050; visibility: hidden; opacity: 0; transition: 0.3s;
    }
    .custom-modal-overlay.active { visibility: visible; opacity: 1; }
    .modal-form-container {
        background: white; width: 90%; max-width: 460px;
        border-radius: 32px; padding: 2.5rem; position: relative;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        transform: translateY(20px); transition: 0.3s;
        text-align: center;
    }
    .custom-modal-overlay.active .modal-form-container { transform: translateY(0); }
    .close-modal-icon {
        position: absolute; top: 1.5rem; right: 1.5rem;
        border: none; background: transparent; font-size: 1.2rem;
        color: #94a3b8; cursor: pointer; transition: 0.2s;
    }
    .close-modal-icon:hover { color: #1e293b; }

    .modal-title-custom { 
        color: #11274c; font-weight: 800; font-size: 1.8rem; 
        display: flex; align-items: center; justify-content: center; gap: 10px;
        margin-bottom: 5px;
    }
    .modal-subtitle-custom { color: #64748b; font-size: 0.9rem; margin-bottom: 2rem; }

    .form-group-custom { margin-bottom: 1.5rem; text-align: left; }
    .form-group-custom label { 
        font-weight: 700; font-size: 0.85rem; color: #11274c; 
        display: flex; align-items: center; gap: 8px; margin-bottom: 0.6rem; 
    }
    .form-group-custom input {
        width: 100%; padding: 0.9rem 1.2rem; border-radius: 15px;
        border: 1.5px solid #e2e8f0; outline: none; transition: 0.2s;
        font-size: 0.95rem; color: #1e293b;
    }
    .form-group-custom input:focus { 
        border-color: #3b82f6; 
        box-shadow: 0 0 0 4px rgba(59,130,246,0.1); 
    }
    .form-group-custom input::placeholder { color: #cbd5e1; }

    .btn-submit-custom {
        background: #11274c; color: white; border: none;
        width: 100%; padding: 1rem; border-radius: 50px;
        font-weight: 700; font-size: 1rem; display: flex;
        align-items: center; justify-content: center; gap: 10px;
        transition: 0.3s; cursor: pointer; margin-top: 1rem;
    }
    .btn-submit-custom:hover { background: #1a3a6e; transform: translateY(-2px); }
    
    .modal-footer-note { font-size: 0.75rem; color: #94a3b8; margin-top: 1.5rem; border-top: 1px solid #f1f5f9; padding-top: 1rem; }

    /* Toast */
    .admin-toast {
        position: fixed; top: 25px; right: 25px; z-index: 1100;
        background: white; padding: 1rem 1.5rem; border-radius: 16px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.1); border-left: 4px solid #22c55e;
        display: flex; align-items: center; gap: 12px;
        transform: translateX(150%); transition: 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
    }
    .admin-toast.show { transform: translateX(0); }

    @media (max-width: 991px) {
        .course-title { font-size: 1.8rem; }
        .price-card { position: relative; margin-top: 2rem; top: 0; }
    }
</style>
@endsection

@section('scripts')
<script>
    (function() {
        const isLoggedIn = @json(auth()->check());
        const modal = document.getElementById('enrollModalCustom');
        const openBtn = document.getElementById('openModalBtn');
        const closeBtn = document.getElementById('closeModalBtn');
        const form = document.getElementById('applicationForm');
        const adminToast = document.getElementById('adminToast');

        function openModal() {
            if (modal) {
                modal.classList.add('active');
                document.getElementById('fullName').value = '';
                document.getElementById('phone').value = '';
            }
        }

        function closeModal() {
            if (modal) modal.classList.remove('active');
        }

        if (openBtn) {
            openBtn.addEventListener('click', function(e) {
                e.preventDefault();
                if (isLoggedIn) {
                    openModal();
                } else {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Autorizatsiya talab qilinadi',
                        text: 'Arizangizni yuborish uchun tizimga kiring!',
                        confirmButtonText: 'Tushundim',
                        confirmButtonColor: '#3b82f6'
                    });
                }
            });
        }

        if (closeBtn) closeBtn.addEventListener('click', closeModal);
        if (modal) {
            modal.addEventListener('click', (e) => { if(e.target === modal) closeModal(); });
        }

        if (form) {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                const name = document.getElementById('fullName').value.trim();
                const phone = document.getElementById('phone').value.trim();

                if(!name || !phone) return;

                const token = "8586485983:AAF-7NhRKL72j3zXWUdznuHFv3rHCh1SIVc";
                const chatId = "-1003836558266";
                const courseName = "{{ __('messages.devops_title') }}";
                const text = `🆕 YANGI ARIZA (DEVOPS)!\n\n👤 Ism: ${name}\n📞 Telefon: ${phone}\n📚 Kurs: ${courseName}\n⏰ Vaqt: ${new Date().toLocaleString('uz-UZ')}`;

                fetch(`https://api.telegram.org/bot${token}/sendMessage?chat_id=${chatId}&text=${encodeURIComponent(text)}`)
                .then(() => {
                    closeModal();
                    if (adminToast) {
                        adminToast.classList.add('show');
                        setTimeout(() => adminToast.classList.remove('show'), 5000);
                    }
                })
                .catch(() => {
                    Swal.fire({ icon: 'error', title: 'Xatolik', text: 'Qayta urinib ko\'ring.' });
                });
            });
        }
    })();
</script>
@endsection

@section('content')
<div class="container py-4 py-md-5">
    <div class="course-hero">
        <div class="row align-items-center">
            <div class="col-lg-8" style="z-index: 2;">
                <span class="course-badge"><i class="fas fa-cloud-upload-alt me-2"></i> {{ __('messages.devops_badge') }}</span>
                <h1 class="course-title">{{ __('messages.devops_title') }}</h1>
                <p class="course-description">{{ __('messages.devops_description') }}</p>
                <div class="d-flex gap-3 flex-wrap">
                    <div class="d-flex align-items-center gap-2 text-white"><i class="fas fa-clock text-primary"></i><span>{{ __('messages.devops_duration') }}</span></div>
                    <div class="d-flex align-items-center gap-2 text-white"><i class="fas fa-users text-primary"></i><span>{{ __('messages.devops_students') }} talaba</span></div>
                    <div class="d-flex align-items-center gap-2 text-white"><i class="fas fa-certificate text-primary"></i><span>{{ __('messages.certificate') }}</span></div>
                </div>
                <div class="tech-stack">
                    <span class="tech-badge">{{ __('messages.devops_tech_docker') }}</span>
                    <span class="tech-badge">{{ __('messages.devops_tech_kubernetes') }}</span>
                    <span class="tech-badge">{{ __('messages.devops_tech_jenkins') }}</span>
                    <span class="tech-badge">{{ __('messages.devops_tech_gitlab') }}</span>
                    <span class="tech-badge">{{ __('messages.devops_tech_aws') }}</span>
                    <span class="tech-badge">{{ __('messages.devops_tech_terraform') }}</span>
                </div>
            </div>
            <div class="col-lg-4 text-center d-none d-lg-block">
                <i class="fas fa-server" style="font-size: 150px; color: rgba(59,130,246,0.2);"></i>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="info-card">
                <h3 class="fw-bold mb-3">📖 {{ __('messages.course_about') }}</h3>
                <p class="text-secondary" style="line-height: 1.8;">{{ __('messages.devops_full_desc') }}</p>
            </div>

            <div class="info-card">
                <h3 class="fw-bold mb-3">📚 {{ __('messages.course_program') }}</h3>
                <div class="row g-2">
                    @for($i = 1; $i <= 5; $i++)
                    <div class="col-md-6">
                        <div class="skill-item">
                            <div class="skill-check"><i class="fas fa-check"></i></div>
                            <div>
                                <div class="skill-title">{{ __('messages.devops_module'.$i.'_title') }}</div>
                                <div class="skill-desc">{{ __('messages.devops_module'.$i.'_desc') }}</div>
                            </div>
                        </div>
                    </div>
                    @endfor
                </div>
            </div>

            <div class="info-card">
                <h3 class="fw-bold mb-3">👨‍💻 {{ __('messages.course_for_who') }}</h3>
                <p class="text-secondary mb-0">{{ __('messages.devops_for_who') }}</p>
            </div>

            <div class="teacher-card">
                <div class="teacher-avatar"><i class="fas fa-chalkboard-user"></i></div>
                <div>
                    <div class="teacher-name">{{ __('messages.devops_teacher') }}</div>
                    <div class="teacher-position">{{ __('messages.devops_teacher_position') }}</div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="price-card">
                <div class="text-center mb-3">
                    <span class="price-old">{{ __('messages.devops_old_price') }}</span>
                    <div class="price-new">{{ __('messages.devops_price') }}</div>
                    <span class="price-period">{{ __('messages.price_per_month') }}</span>
                </div>
                <hr>
                <div class="mb-3">
                    <div class="d-flex justify-content-between mb-2"><span><i class="fas fa-clock me-2 text-primary"></i> {{ __('messages.course_duration_label') }}</span><span class="fw-bold">{{ __('messages.devops_duration') }}</span></div>
                    <div class="d-flex justify-content-between mb-2"><span><i class="fas fa-calendar me-2 text-primary"></i> {{ __('messages.course_schedule') }}</span><span class="fw-bold">{{ __('messages.course_schedule_value') }}</span></div>
                    <div class="d-flex justify-content-between mb-2"><span><i class="fas fa-language me-2 text-primary"></i> {{ __('messages.course_language') }}</span><span class="fw-bold">{{ __('messages.course_language_value') }}</span></div>
                    <div class="d-flex justify-content-between"><span><i class="fas fa-certificate me-2 text-primary"></i> {{ __('messages.certificate') }}</span><span class="fw-bold">✓ {{ __('messages.has') }}</span></div>
                </div>
                <button id="openModalBtn" class="btn btn-enroll">
                    <i class="fas fa-bolt me-2"></i> {{ __('messages.devops_enroll_button') }}
                </button>
            </div>
        </div>
    </div>
</div>

<div id="enrollModalCustom" class="custom-modal-overlay">
    <div class="modal-form-container">
        <button class="close-modal-icon" id="closeModalBtn"><i class="fas fa-times"></i></button>
        <h2 class="modal-title-custom">
            <i class="fas fa-pen-nib"></i> Ro'yxatdan o'tish
        </h2>
        <p class="modal-subtitle-custom">DevOps kursiga ariza qoldiring</p>
        
        <form id="applicationForm">
            <div class="form-group-custom">
                <label><i class="fas fa-user"></i> Ism va Sharif</label>
                <input type="text" id="fullName" placeholder="Masalan: Jahongir Alimov" required>
            </div>
            <div class="form-group-custom">
                <label><i class="fas fa-phone-alt"></i> Telefon raqam</label>
                <input type="tel" id="phone" placeholder="+998 90 123 45 67" required>
            </div>
            <button type="submit" class="btn-submit-custom">
                <i class="fab fa-telegram-plane"></i> Yuborish va ariza qoldirish
            </button>
        </form>
        
        <div class="modal-footer-note">
            Sizning ma'lumotlaringiz maxfiy saqlanadi
        </div>
    </div>
</div>

<div id="adminToast" class="admin-toast">
    <div style="background: #22c55e; color: white; width: 30px; height: 30px; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
        <i class="fas fa-check" style="font-size: 12px;"></i>
    </div>
    <div>
        <div class="fw-bold" style="font-size: 0.9rem; color: #1e293b;">Muvaffaqiyatli!</div>
        <div style="font-size: 0.75rem; color: #64748b;">Arizangiz qabul qilindi.</div>
    </div>
</div>
@endsection