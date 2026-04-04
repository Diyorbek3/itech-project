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

    /* --- MODAL DIZAYNI --- */
    .modal-content.rounded-custom {
        border-radius: 2.5rem !important;
        border: none;
        padding: 1.5rem;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
    }
    .btn-close-custom {
        position: absolute;
        right: 20px;
        top: 20px;
        background: none;
        border: none;
        font-size: 1.3rem;
        color: #94a3b8;
        z-index: 10;
        cursor: pointer;
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
    .form-group-custom input:focus {
        border-color: #3b82f6;
        box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
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
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
    }
    .btn-submit-custom:hover {
        background: #1e4a76;
        transform: translateY(-2px);
    }

    .skill-item {
        display: flex; gap: 1rem; padding: 1rem; background: #f8fafc; border-radius: 12px; margin-bottom: 0.75rem;
    }
    .skill-check {
        width: 28px; height: 28px; background: #3b82f6; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: white; flex-shrink: 0;
    }

    /* Admin Toast style */
    .admin-toast {
        position: fixed;
        top: 20px; right: 20px;
        z-index: 1100;
        background: white;
        border-radius: 20px;
        box-shadow: 0 15px 40px rgba(0,0,0,0.15);
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
                <span class="course-badge"><i class="fas fa-child me-2"></i> {{ __('messages.digital_kids_badge') }}</span>
                <h1 class="course-title">{{ __('messages.digital_kids_title') }}</h1>
                <p class="course-description">{{ __('messages.digital_kids_description') }}</p>
                <div class="d-flex gap-3 flex-wrap text-white-50 small">
                    <span><i class="fas fa-clock text-primary me-1"></i> {{ __('messages.digital_kids_duration') }}</span>
                    <span><i class="fas fa-users text-primary me-1"></i> {{ __('messages.digital_kids_students') }} talaba</span>
                    <span><i class="fas fa-certificate text-primary me-1"></i> {{ __('messages.certificate') }}</span>
                </div>
            </div>
            <div class="col-lg-4 text-center d-none d-lg-block">
                <i class="fas fa-gamepad" style="font-size: 100px; color: rgba(59,130,246,0.3);"></i>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="info-card">
                <h3 class="fw-bold mb-3">📖 {{ __('messages.course_about') }}</h3>
                <p class="text-secondary">{{ __('messages.digital_kids_full_desc') }}</p>
            </div>

            <div class="info-card">
                <h3 class="fw-bold mb-3">📚 {{ __('messages.course_program') }}</h3>
                <div class="row g-2">
                    @for($i=1; $i<=4; $i++)
                    <div class="col-md-6">
                        <div class="skill-item">
                            <div class="skill-check"><i class="fas fa-check small"></i></div>
                            <div>
                                <div class="fw-bold text-dark small">{{ __('messages.digital_kids_module'.$i.'_title') }}</div>
                                <div class="text-muted" style="font-size: 11px;">{{ __('messages.digital_kids_module'.$i.'_desc') }}</div>
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
                    <span class="text-muted text-decoration-line-through small">{{ __('messages.digital_kids_old_price') }}</span>
                    <div class="price-new">{{ __('messages.digital_kids_price') }}</div>
                    <span class="text-muted small">{{ __('messages.price_per_month') }}</span>
                </div>
                <hr>
                {{-- Trigger ID qo'shildi --}}
                <button id="enrollBtnTrigger" class="btn btn-enroll text-white">
                    <i class="fas fa-bolt me-2"></i> {{ __('messages.digital_kids_enroll_button') }}
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
                <h5 class="modal-title-custom">
                    <i class="fas fa-rocket"></i> Ro'yxatdan o'tish
                </h5>
                <span class="modal-subtitle-custom">Kelajak texnologiyalarini biz bilan o'rganing!</span>

                <form id="tgApplicationForm">
                    @csrf
                    <div class="form-group-custom">
                        <label><i class="fas fa-user me-2 text-primary"></i> Ism va Sharif</label>
                        <input type="text" id="userName" name="name" placeholder="Masalan: Azizbek Orifov" required
                               value="{{ auth()->check() ? auth()->user()->name : '' }}">
                    </div>

                    <div class="form-group-custom">
                        <label><i class="fas fa-phone-alt me-2 text-primary"></i> Telefon raqam</label>
                        <input type="tel" id="userPhone" name="phone" placeholder="+998 90 123 45 67" required>
                    </div>

                    <div class="form-group-custom">
                        <label><i class="fas fa-envelope me-2 text-primary"></i> Email (ixtiyoriy)</label>
                        <input type="email" id="userEmail" name="email" placeholder="example@mail.com">
                    </div>

                    <button type="submit" class="btn-submit-custom">
                        <i class="fas fa-paper-plane"></i> Ariza yuborish
                    </button>
                </form>

                <hr class="my-4" style="opacity: 0.1;">
                <div class="text-muted" style="font-size: 12px;">
                    <i class="fas fa-user-shield me-1"></i> Ma'lumotlaringiz xavfsizligi kafolatlanadi
                </div>
            </div>
        </div>
    </div>
</div>

<div id="adminToast" class="admin-toast">
    <div style="background: #22c55e; color: white; border-radius: 50%; width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
        <i class="fas fa-check"></i>
    </div>
    <div>
        <div style="font-weight: 800; color: #15803d;">Ariza yuborildi!</div>
        <div style="font-size: 0.8rem; color: #64748b;">Menejerlarimiz aloqaga chiqishadi.</div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const isLoggedIn = @json(auth()->check());
        const enrollBtn = document.getElementById('enrollBtnTrigger');
        const modal = new bootstrap.Modal(document.getElementById('enrollModal'));
        const form = document.getElementById('tgApplicationForm');

        // 1. Authorization tekshiruvi
        enrollBtn.addEventListener('click', function() {
            if (isLoggedIn) {
                modal.show();
            } else {
                Swal.fire({
                    icon: 'warning',
                    title: 'Tizimga kiring',
                    text: 'Kursga yozilish uchun avval profilingizga kirishingiz kerak.',
                    confirmButtonText: 'Kirish',
                    showCancelButton: true,
                    cancelButtonText: 'Yopish',
                    confirmButtonColor: '#3b82f6'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "{{ route('login') }}";
                    }
                });
            }
        });

        // 2. Telegram Bot yuborish
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const name = document.getElementById('userName').value;
            const phone = document.getElementById('userPhone').value;
            const email = document.getElementById('userEmail').value || 'Ko\'rsatilmagan';
            
            const token = "8586485983:AAF-7NhRKL72j3zXWUdznuHFv3rHCh1SIVc";
            const chatId = "-1003836558266";
            
            const text = `🚀 DIGITAL KIDS - YANGI ARIZA\n\n👤 Ism: ${name}\n📞 Tel: ${phone}\n📧 Email: ${email}\n🆔 User: {{ auth()->check() ? 'ID: '.auth()->id() : 'Mehmon' }}`;
            const url = `https://api.telegram.org/bot${token}/sendMessage?chat_id=${chatId}&text=${encodeURIComponent(text)}&parse_mode=HTML`;

            fetch(url).then(res => {
                modal.hide();
                const toast = document.getElementById('adminToast');
                toast.classList.add('show');
                setTimeout(() => toast.classList.remove('show'), 5000);
                form.reset();
            }).catch(err => {
                Swal.fire('Xatolik', 'Ariza yuborishda muammo bo\'ldi', 'error');
            });
        });
    });
</script>
@endsection