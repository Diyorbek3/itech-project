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
        color: white;
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
    }
    .course-description {
        font-size: 1.1rem;
        color: rgba(255,255,255,0.8);
        line-height: 1.6;
        margin-bottom: 2rem;
        max-width: 800px;
    }

    /* Kartochkalar */
    .info-card {
        background: white;
        border-radius: 24px;
        padding: 2rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 4px 20px rgba(0,0,0,0.03);
        border: 1px solid #f1f5f9;
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
        box-shadow: 0 20px 40px rgba(0,0,0,0.08);
        border: 1px solid rgba(59,130,246,0.1);
    }

    /* Skill/Module dizayni */
    .skill-item {
        display: flex;
        gap: 1rem;
        padding: 1.2rem;
        background: #f8fafc;
        border-radius: 16px;
        height: 100%;
        transition: 0.3s;
    }
    .skill-item:hover {
        background: #f1f5f9;
        transform: translateX(5px);
    }
    .skill-icon {
        width: 32px;
        height: 32px;
        background: #3b82f6;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        flex-shrink: 0;
    }

    /* Tugma */
    .btn-enroll {
        background: linear-gradient(135deg, #3b82f6, #2563eb);
        color: white !important;
        border: none;
        border-radius: 50px;
        padding: 1rem;
        font-weight: 700;
        width: 100%;
        transition: 0.3s;
        box-shadow: 0 10px 20px rgba(59,130,246,0.3);
        cursor: pointer;
    }
    .btn-enroll:hover {
        transform: translateY(-2px);
        box-shadow: 0 15px 30px rgba(59,130,246,0.4);
    }

    /* Custom Modal */
    .custom-modal-overlay {
        position: fixed;
        top: 0; left: 0; width: 100%; height: 100%;
        background-color: rgba(0, 0, 0, 0.65);
        backdrop-filter: blur(6px);
        display: flex; align-items: center; justify-content: center;
        z-index: 1050; visibility: hidden; opacity: 0;
        transition: visibility 0.2s, opacity 0.2s ease;
    }
    .custom-modal-overlay.active { visibility: visible; opacity: 1; }
    .modal-form-container {
        background: #ffffff; max-width: 480px; width: 90%;
        border-radius: 2rem; padding: 2.5rem 2rem;
        box-shadow: 0 30px 45px rgba(0, 0, 0, 0.3);
        transform: scale(0.96); transition: transform 0.2s ease;
        text-align: center; position: relative;
    }
    .custom-modal-overlay.active .modal-form-container { transform: scale(1); }
    .modal-form-container h3 {
        font-size: 1.8rem; font-weight: 800;
        background: linear-gradient(145deg, #0f2b3d, #1e4a76);
        -webkit-background-clip: text; background-clip: text; color: transparent;
        margin-bottom: 0.5rem;
    }
    .close-modal-icon {
        position: absolute; top: 1rem; right: 1.4rem;
        background: none; border: none; font-size: 1.8rem;
        cursor: pointer; color: #94a3b8; transition: 0.2s;
    }
    .close-modal-icon:hover { color: #1e293b; }

    .form-group-custom { margin-bottom: 1.3rem; text-align: left; }
    .form-group-custom label { font-weight: 600; color: #1e293b; display: block; margin-bottom: 0.5rem; font-size: 0.9rem; }
    .form-group-custom input {
        width: 100%; padding: 0.85rem 1.2rem;
        border: 1.5px solid #e2edf7; border-radius: 1.2rem;
        outline: none; transition: 0.2s; background: #fefefe;
    }
    .form-group-custom input:focus { border-color: #3b82f6; box-shadow: 0 0 0 3px rgba(59,130,246,0.1); }

    /* Admin Toast Notification */
    .admin-toast {
        position: fixed; top: 20px; right: 20px; z-index: 1100;
        min-width: 280px; max-width: 360px; background: white;
        border-radius: 20px; box-shadow: 0 15px 40px rgba(0,0,0,0.2);
        border-left: 5px solid #22c55e; padding: 1rem 1.2rem;
        display: flex; align-items: center; gap: 14px;
        transform: translateX(120%); transition: transform 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        backdrop-filter: blur(8px); background: rgba(255,255,255,0.98);
    }
    .admin-toast.show { transform: translateX(0); }
    .admin-toast-icon {
        width: 44px; height: 44px; background: linear-gradient(135deg, #22c55e, #16a34a);
        border-radius: 50%; display: flex; align-items: center; justify-content: center;
        color: white; font-size: 1.4rem; flex-shrink: 0;
    }
    .admin-toast-title { font-weight: 800; font-size: 0.9rem; color: #15803d; margin-bottom: 4px; }
    .admin-toast-note {
        font-size: 0.8rem; color: #eab308; background: #fef9e3;
        padding: 5px 10px; border-radius: 12px; display: inline-block; font-weight: 600;
    }

    @media (max-width: 991px) {
        .course-title { font-size: 2rem; }
        .price-card { position: static; margin-top: 2rem; }
    }
</style>
@endsection

@section('scripts')
<script>
    (function() {
        // PHP orqali autorizatsiya holatini tekshirish
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
                        text: 'Iltimos, avval tizimga kiring yoki ro\'yxatdan o\'ting!',
                        confirmButtonText: 'Tushundim',
                        confirmButtonColor: '#3b82f6',
                        backdrop: true
                    });
                }
            });
        }

        if (closeBtn) {
            closeBtn.addEventListener('click', closeModal);
        }

        if (modal) {
            modal.addEventListener('click', function(e) {
                if (e.target === modal) closeModal();
            });
        }

        if (form) {
            form.addEventListener('submit', function(event) {
                event.preventDefault();

                const name = document.getElementById('fullName').value.trim();
                const phone = document.getElementById('phone').value.trim();

                if (!name || !phone) {
                    Swal.fire({ icon: 'error', title: 'Xatolik', text: 'Barcha maydonlarni to\'ldiring!' });
                    return;
                }

                // Telegram botga yuborish
                const token = "8586485983:AAF-7NhRKL72j3zXWUdznuHFv3rHCh1SIVc";
                const chatId = "-1003836558266";
                const courseName = "{{ __('messages.system_engineering_title') }}";
                const text = `🆕 YANGI ARIZA!\n\n📚 Kurs: ${courseName}\n👤 Ism: ${name}\n📞 Telefon: ${phone}\n⏰ Vaqt: ${new Date().toLocaleString('uz-UZ')}\n\n📌 Holat: Tez orada ko'rib chiqiladi`;

                fetch(`https://api.telegram.org/bot${token}/sendMessage?chat_id=${chatId}&text=${encodeURIComponent(text)}`)
                .then(function() {
                    closeModal();
                    if (adminToast) {
                        adminToast.classList.add('show');
                        setTimeout(() => {
                            adminToast.classList.remove('show');
                        }, 5000);
                    }
                })
                .catch(function() {
                    Swal.fire({ icon: 'error', title: 'Xatolik', text: 'Xatolik yuz berdi. Qayta urinib ko\'ring.' });
                });
            });
        }
    })();
</script>
@endsection

@section('content')
<div class="container py-5">
    <div class="course-hero">
        <div class="row align-items-center position-relative" style="z-index: 2;">
            <div class="col-lg-8">
                <span class="course-badge">
                    <i class="fas fa-server me-2"></i> {{ __('messages.system_engineering_badge') }}
                </span>
                <h1 class="course-title">{{ __('messages.system_engineering_title') }}</h1>
                <p class="course-description">{{ __('messages.system_engineering_description') }}</p>
                
                <div class="d-flex gap-4 flex-wrap mb-4">
                    <div class="d-flex align-items-center gap-2">
                        <i class="fas fa-calendar-alt text-primary"></i>
                        <span>{{ __('messages.system_engineering_duration') }}</span>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <i class="fas fa-user-graduate text-primary"></i>
                        <span>{{ __('messages.system_engineering_students') }} talaba</span>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <i class="fas fa-award text-primary"></i>
                        <span>{{ __('messages.certificate') }}</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 text-center d-none d-lg-block">
                <div class="opacity-25">
                    <i class="fas fa-network-wired" style="font-size: 150px;"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="info-card">
                <h4 class="fw-bold mb-4"><i class="fas fa-info-circle text-primary me-2"></i> {{ __('messages.course_about') }}</h4>
                <p class="text-secondary" style="line-height: 1.8;">
                    {{ __('messages.system_engineering_full_desc') }}
                </p>
            </div>

            <div class="info-card">
                <h4 class="fw-bold mb-4"><i class="fas fa-list-ul text-primary me-2"></i> {{ __('messages.course_program') }}</h4>
                <div class="row g-3">
                    @php $modules = [1, 2, 3, 4, 5]; @endphp
                    @foreach($modules as $m)
                    <div class="col-md-6">
                        <div class="skill-item">
                            <div class="skill-icon"><i class="fas fa-terminal"></i></div>
                            <div>
                                <h6 class="fw-bold mb-1 text-dark">{{ __('messages.system_engineering_module'.$m.'_title') }}</h6>
                                <p class="text-muted mb-0 small">{{ __('messages.system_engineering_module'.$m.'_desc') }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="info-card">
                <h4 class="fw-bold mb-3"><i class="fas fa-users text-primary me-2"></i> {{ __('messages.course_for_who') }}</h4>
                <p class="text-secondary mb-0">{{ __('messages.system_engineering_for_who') }}</p>
            </div>

            <div class="info-card bg-light border-0">
                <div class="d-flex align-items-center gap-3">
                    <div class="bg-white p-3 rounded-circle shadow-sm">
                        <i class="fas fa-user-tie fa-2x text-primary"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-0">{{ __('messages.system_engineering_teacher') }}</h5>
                        <p class="text-muted mb-0">{{ __('messages.system_engineering_teacher_position') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="price-card">
                <div class="text-center mb-4">
                    <span class="text-muted text-decoration-line-through">{{ __('messages.system_engineering_old_price') }}</span>
                    <div class="display-6 fw-bold text-primary my-2">{{ __('messages.system_engineering_price') }}</div>
                    <span class="badge bg-soft-primary text-primary px-3 py-2" style="background: #eef2ff;">
                        {{ __('messages.price_per_month') }}
                    </span>
                </div>

                <div class="space-y-3 mb-4">
                    <div class="d-flex justify-content-between py-2 border-bottom">
                        <span class="text-muted small"><i class="fas fa-globe me-2"></i> Til:</span>
                        <span class="fw-bold small">{{ __('messages.course_language_value') }}</span>
                    </div>
                    <div class="d-flex justify-content-between py-2 border-bottom">
                        <span class="text-muted small"><i class="fas fa-calendar-check me-2"></i> Grafik:</span>
                        <span class="fw-bold small">{{ __('messages.course_schedule_value') }}</span>
                    </div>
                </div>

                <button id="openModalBtn" class="btn btn-enroll">
                    <i class="fas fa-bolt me-2"></i> {{ __('messages.system_engineering_enroll_button') }}
                </button>
            </div>
        </div>
    </div>
</div>

<div id="enrollModalCustom" class="custom-modal-overlay">
    <div class="modal-form-container">
        <button class="close-modal-icon" id="closeModalBtn"><i class="fas fa-times"></i></button>
        <h3><i class="fas fa-pen-alt me-2" style="color:#1e4a76;"></i> Ro'yxatdan o'tish</h3>
        <p>Tizim muhandisligi kursiga ariza qoldiring</p>
        
        <form id="applicationForm">
            <div class="form-group-custom">
                <label><i class="fas fa-user me-1"></i> Ism va Sharif</label>
                <input type="text" id="fullName" placeholder="Masalan: Solijonov Avazbek" required>
            </div>
            <div class="form-group-custom">
                <label><i class="fas fa-phone-alt me-1"></i> Telefon raqam</label>
                <input type="tel" id="phone" placeholder="+998 90 123 45 67" required>
            </div>
            <button type="submit" class="btn-enroll mt-2">
                <i class="fas fa-paper-plane me-2"></i> Yuborish va ariza qoldirish
            </button>
        </form>
        <hr>
        <div style="font-size: 12px; color: #6c757d; text-align: center;">Ma'lumotlaringiz maxfiy saqlanadi</div>
    </div>
</div>

<div id="adminToast" class="admin-toast">
    <div class="admin-toast-icon">
        <i class="fas fa-check-circle"></i>
    </div>
    <div class="admin-toast-content">
        <div class="admin-toast-title">
            <i class="fas fa-bell" style="font-size: 12px;"></i> ✅ Ariza qabul qilindi
        </div>
        <div class="admin-toast-note">
            <i class="fas fa-clock me-1"></i> Tez orada ko'rib chiqiladi
        </div>
    </div>
</div>

@endsection