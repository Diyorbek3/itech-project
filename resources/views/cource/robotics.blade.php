@extends('layouts.app')

@section('styles')
<style>
    /* Sahifa asosi */
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
        top: -50%; right: -50%;
        width: 200%; height: 200%;
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
    .price-new {
        font-size: 2rem;
        font-weight: 800;
        color: #3b82f6;
    }
    .btn-enroll {
        background: linear-gradient(135deg, #3b82f6, #2563eb);
        border: none;
        border-radius: 50px;
        padding: 0.9rem;
        font-weight: 700;
        width: 100%;
        margin-top: 1.5rem;
        transition: 0.3s;
    }
    .btn-enroll:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(59,130,246,0.4);
    }

    /* Modul elementlari */
    .skill-item {
        display: flex;
        gap: 1rem;
        padding: 1rem;
        background: #f8fafc;
        border-radius: 12px;
        margin-bottom: 0.75rem;
    }
    .skill-check {
        width: 28px; height: 28px;
        background: #3b82f6;
        border-radius: 8px;
        display: flex; align-items: center; justify-content: center;
        color: white; flex-shrink: 0;
    }

    /* --- MODAL DIZAYNI --- */
    .modal-content.rounded-custom {
        border-radius: 2.5rem !important;
        border: none;
        padding: 1.5rem;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
    }
    .btn-close-custom {
        position: absolute;
        right: 20px; top: 20px;
        background: none; border: none;
        font-size: 1.3rem; color: #94a3b8;
        z-index: 10;
    }
    .modal-title-custom {
        color: #0f3b5c;
        font-weight: 800;
        font-size: 1.8rem;
        margin-top: 1rem;
    }
    .modal-subtitle-custom {
        color: #64748b;
        font-size: 0.95rem;
        margin-bottom: 2rem;
        display: block;
    }
    .form-group-custom {
        margin-bottom: 1.2rem;
        text-align: left;
    }
    .form-group-custom label {
        display: block;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 0.5rem;
        font-size: 0.85rem;
        padding-left: 1rem;
    }
    .form-group-custom input {
        width: 100%;
        padding: 0.85rem 1.5rem;
        border: 1.5px solid #e2edf7;
        border-radius: 3rem;
        font-size: 1rem;
        outline: none;
        transition: 0.3s;
    }
    .btn-submit-custom {
        background: #0f3b5c;
        color: white;
        border: none;
        border-radius: 3rem;
        padding: 1rem;
        font-weight: 700;
        width: 100%;
        margin-top: 1rem;
        transition: 0.3s;
        display: flex; align-items: center; justify-content: center;
        gap: 10px;
    }

    /* Admin Notification Toast */
    .admin-toast {
        position: fixed;
        top: 20px; right: 20px;
        z-index: 1100;
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(8px);
        border-radius: 20px;
        box-shadow: 0 15px 40px rgba(0,0,0,0.2);
        border-left: 5px solid #22c55e;
        padding: 1rem 1.2rem;
        display: flex; align-items: center; gap: 14px;
        transform: translateX(120%);
        transition: transform 0.5s cubic-bezier(0.68, -0.55, 0.265, 1.55);
    }
    .admin-toast.show { transform: translateX(0); }

    @media (max-width: 991px) {
        .course-title { font-size: 1.8rem; }
        .price-card { position: relative; margin-top: 2rem; }
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
                <div class="d-flex gap-3 flex-wrap text-white-50 small">
                    <span><i class="fas fa-clock text-primary me-1"></i> {{ __('messages.robotics_duration') }}</span>
                    <span><i class="fas fa-users text-primary me-1"></i> {{ __('messages.robotics_students') }} talaba</span>
                    <span><i class="fas fa-certificate text-primary me-1"></i> {{ __('messages.certificate') }}</span>
                </div>
            </div>
            <div class="col-lg-4 text-center d-none d-lg-block">
                <i class="fas fa-robot" style="font-size: 100px; color: rgba(59,130,246,0.3);"></i>
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
                    @for($i=1; $i<=4; $i++)
                    <div class="col-md-6">
                        <div class="skill-item">
                            <div class="skill-check"><i class="fas fa-check small"></i></div>
                            <div>
                                <div class="fw-bold text-dark small">{{ __('messages.robotics_module'.$i.'_title') }}</div>
                                <div class="text-muted" style="font-size: 11px;">{{ __('messages.robotics_module'.$i.'_desc') }}</div>
                            </div>
                        </div>
                    </div>
                    @endfor
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="price-card">
                <div class="text-center mb-3">
                    <span class="text-muted text-decoration-line-through small">{{ __('messages.robotics_old_price') }}</span>
                    <div class="price-new">{{ __('messages.robotics_price') }}</div>
                    <span class="text-muted small">{{ __('messages.price_per_month') }}</span>
                </div>
                <hr>
                <div class="mb-3">
                    <div class="d-flex justify-content-between mb-2"><span><i class="fas fa-clock me-2 text-primary"></i> Davomiyligi</span><span class="fw-bold">4 oy</span></div>
                    <div class="d-flex justify-content-between"><span><i class="fas fa-certificate me-2 text-primary"></i> Sertifikat</span><span class="fw-bold">✓ Bor</span></div>
                </div>
                <hr>
                <button id="enrollBtnTrigger" class="btn btn-enroll text-white">
                    <i class="fas fa-bolt me-2"></i> {{ __('messages.robotics_enroll_button') }}
                </button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="enrollModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-custom">
            <button type="button" class="btn-close-custom" data-bs-dismiss="modal">
                <i class="fas fa-times"></i>
            </button>
            <div class="modal-body text-center p-0">
                <h5 class="modal-title-custom"><i class="fas fa-pen-alt"></i> Ro'yxatdan o'tish</h5>
                <span class="modal-subtitle-custom">Kursga ariza qoldirish uchun ma'lumotlarni to'ldiring</span>

                <form id="tgApplicationForm">
                    @csrf
                    <div class="form-group-custom">
                        <label><i class="fas fa-user me-2 text-primary"></i> Ism va Sharif</label>
                        <input type="text" id="userName" name="name" placeholder="Masalan: Jahongir Alimov" required 
                               value="{{ auth()->check() ? auth()->user()->name : '' }}">
                    </div>
                    <div class="form-group-custom">
                        <label><i class="fas fa-phone-alt me-2 text-primary"></i> Telefon raqam</label>
                        <input type="tel" id="userPhone" name="phone" placeholder="+998 90 123 45 67" required>
                    </div>
                    <button type="submit" class="btn-submit-custom">
                        <i class="fas fa-paper-plane"></i> Yuborish va ariza qoldirish
                    </button>
                </form>
                <hr class="my-4" style="opacity: 0.1;">
                <div class="text-muted" style="font-size: 11px;">
                    <i class="fas fa-shield-alt me-1"></i> Sizning ma'lumotlaringiz maxfiy saqlanadi
                </div>
            </div>
        </div>
    </div>
</div>

<div id="adminToast" class="admin-toast">
    <div style="background: linear-gradient(135deg, #22c55e, #16a34a); color: white; border-radius: 50%; width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 10px rgba(34,197,94,0.3);">
        <i class="fas fa-check"></i>
    </div>
    <div>
        <div style="font-weight: 800; color: #15803d; font-size: 0.9rem;">Ariza qabul qilindi!</div>
        <div style="font-size: 0.75rem; color: #64748b;">Tez orada menejerlarimiz bog'lanishadi.</div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Laravel'dan autorizatsiya holatini olamiz
        const isLoggedIn = @json(auth()->check());
        const enrollBtn = document.getElementById('enrollBtnTrigger');
        const enrollModal = new bootstrap.Modal(document.getElementById('enrollModal'));
        const form = document.getElementById('tgApplicationForm');

        // 1. Tugma bosilganda autorizatsiyani tekshirish
        enrollBtn.addEventListener('click', function() {
            if (isLoggedIn) {
                enrollModal.show();
            } else {
                Swal.fire({
                    icon: 'warning',
                    title: 'Tizimga kiring',
                    text: 'Kursga yozilish uchun avval o\'z akkauntingizga kirishingiz kerak.',
                    confirmButtonText: 'Kirish sahifasiga o\'tish',
                    showCancelButton: true,
                    cancelButtonText: 'Yopish',
                    confirmButtonColor: '#3b82f6',
                    cancelButtonColor: '#64748b'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "{{ route('login') }}";
                    }
                });
            }
        });

        // 2. Telegramga yuborish (Form Submit)
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const name = document.getElementById('userName').value.trim();
            const phone = document.getElementById('userPhone').value.trim();
            
            // Bot ma'lumotlari
            const token = "8586485983:AAF-7NhRKL72j3zXWUdznuHFv3rHCh1SIVc";
            const chatId = "-1003836558266";
            const courseName = "{{ __('messages.robotics_title') }}";
            
            const message = `🆕 YANGI ARIZA\n\n📚 Kurs: ${courseName}\n👤 Ism: ${name}\n📞 Tel: ${phone}\n🆔 User: {{ auth()->check() ? 'ID: '.auth()->id() : 'Mehmon' }}\n⏰ Vaqt: ${new Date().toLocaleString('uz-UZ')}`;

            const url = `https://api.telegram.org/bot${token}/sendMessage`;
            const params = {
                chat_id: chatId,
                text: message,
                parse_mode: 'HTML'
            };

            // Fetch orqali yuborish
            fetch(url, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(params)
            })
            .then(response => {
                if (response.ok) {
                    enrollModal.hide(); // Modalni yopish
                    
                    // Toast ko'rsatish
                    const toast = document.getElementById('adminToast');
                    toast.classList.add('show');
                    setTimeout(() => toast.classList.remove('show'), 5000);
                    
                    form.reset(); // Formani tozalash
                } else {
                    throw new Error();
                }
            })
            .catch(() => {
                Swal.fire('Xatolik', 'Xabar yuborishda muammo yuz berdi. Iltimos qaytadan urinib ko\'ring.', 'error');
            });
        });
    });
</script>
@endsection