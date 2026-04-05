@extends('layouts.app')

@section('styles')
<style>
    /* Asosiy dizayn elementlari */
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

    /* Modal custom style */
    .custom-modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.65);
        backdrop-filter: blur(6px);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 1050;
        visibility: hidden;
        opacity: 0;
        transition: visibility 0.2s, opacity 0.2s ease;
    }
    .custom-modal-overlay.active {
        visibility: visible;
        opacity: 1;
    }
    .modal-form-container {
        background: #ffffff;
        max-width: 480px;
        width: 90%;
        border-radius: 2rem;
        padding: 2rem 1.8rem 2rem 1.8rem;
        box-shadow: 0 30px 45px rgba(0, 0, 0, 0.3);
        transform: scale(0.96);
        transition: transform 0.2s ease;
        text-align: center;
        position: relative;
    }
    .custom-modal-overlay.active .modal-form-container {
        transform: scale(1);
    }
    .modal-form-container h3 {
        font-size: 1.9rem;
        font-weight: 800;
        background: linear-gradient(145deg, #0f2b3d, #1e4a76);
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
        margin-bottom: 0.4rem;
    }
    .modal-form-container p {
        color: #4a5568;
        font-size: 0.9rem;
        margin-bottom: 1.5rem;
    }
    .form-group-custom {
        margin-bottom: 1.3rem;
        text-align: left;
    }
    .form-group-custom label {
        font-weight: 600;
        color: #1e293b;
        margin-bottom: 0.4rem;
        display: block;
        font-size: 0.9rem;
    }
    .form-group-custom input {
        width: 100%;
        padding: 0.85rem 1rem;
        border: 1.5px solid #e2edf7;
        border-radius: 1.5rem;
        font-size: 1rem;
        transition: 0.2s;
        outline: none;
        background: #fefefe;
    }
    .form-group-custom input:focus {
        border-color: #1e6f9f;
        box-shadow: 0 0 0 3px rgba(30, 111, 159, 0.2);
    }
    .submit-modal-btn {
        background: #0f3b5c;
        width: 100%;
        border: none;
        padding: 0.9rem;
        border-radius: 3rem;
        font-weight: bold;
        font-size: 1.05rem;
        color: white;
        transition: 0.2s;
        margin-top: 0.5rem;
    }
    .submit-modal-btn:hover {
        background: #1e5a7c;
        transform: scale(0.98);
    }
    .close-modal-icon {
        position: absolute;
        top: 1rem;
        right: 1.4rem;
        background: none;
        border: none;
        font-size: 1.9rem;
        cursor: pointer;
        color: #94a3b8;
        transition: 0.2s;
    }
    .close-modal-icon:hover {
        color: #1e293b;
    }

    /* ========= O'NG TARAF TEPASIDAGI NOTIFICATION ========= */
    .admin-toast {
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 1100;
        min-width: 280px;
        max-width: 360px;
        background: white;
        border-radius: 20px;
        box-shadow: 0 15px 40px rgba(0,0,0,0.2);
        border-left: 5px solid #22c55e;
        padding: 1rem 1.2rem;
        display: flex;
        align-items: center;
        gap: 14px;
        transform: translateX(120%);
        transition: transform 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        backdrop-filter: blur(8px);
        background: rgba(255,255,255,0.98);
    }
    .admin-toast.show {
        transform: translateX(0);
    }
    .admin-toast-icon {
        width: 48px;
        height: 48px;
        background: linear-gradient(135deg, #22c55e, #16a34a);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.6rem;
        flex-shrink: 0;
        box-shadow: 0 4px 10px rgba(34,197,94,0.3);
    }
    .admin-toast-content {
        flex: 1;
    }
    .admin-toast-title {
        font-weight: 800;
        font-size: 0.9rem;
        color: #15803d;
        margin-bottom: 6px;
        display: flex;
        align-items: center;
        gap: 6px;
    }
    .admin-toast-note {
        font-size: 0.8rem;
        color: #eab308;
        margin-top: 6px;
        background: #fef9e3;
        padding: 6px 10px;
        border-radius: 12px;
        display: inline-block;
        font-weight: 600;
    }
    @keyframes toastPulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.05); }
        100% { transform: scale(1); }
    }
    .admin-toast.show .admin-toast-icon {
        animation: toastPulse 0.5s ease;
    }

    @media (max-width: 991px) {
        .course-title { font-size: 1.8rem; }
        .price-card { position: relative; margin-top: 2rem; }
    }
    @media (max-width: 768px) {
        .course-hero { padding: 1.5rem; }
        .course-title { font-size: 1.5rem; }
        .modal-form-container { padding: 1.5rem; }
        .admin-toast { left: 20px; right: 20px; min-width: auto; }
    }
</style>
@endsection

@section('scripts')
<script>
    (function() {
        // 1. Autorizatsiya holatini tekshirish
        const isLoggedIn = @json(auth()->check());
        
        const modal = document.getElementById('customModal');
        const openBtn = document.getElementById('openModalBtn');
        const closeBtn = document.getElementById('closeModalBtn');
        const form = document.getElementById('applicationForm');
        const fullnameField = document.getElementById('fullName');
        const phoneField = document.getElementById('phone');
        const adminToast = document.getElementById('adminToast');

        function openModal() {
            if (modal) {
                modal.classList.add('active');
                fullnameField.value = '';
                phoneField.value = '';
            }
        }

        function closeModal() {
            if (modal) {
                modal.classList.remove('active');
            }
        }
        
        // 2. Autorizatsiya tekshiruvi va SweetAlert
        function checkAuthAndOpenModal() {
            if (isLoggedIn) {
                openModal();
            } else {
                Swal.fire({
                    icon: 'warning',
                    title: 'Autorizatsiya talab qilinadi',
                    text: 'Iltimos, ariza qoldirish uchun avval tizimga kiring!',
                    confirmButtonText: 'Tushundim',
                    confirmButtonColor: '#3b82f6',
                    backdrop: true
                });
            }
        }
        
        function showAdminNotification() {
            if (adminToast) {
                adminToast.classList.add('show');
                setTimeout(() => {
                    adminToast.classList.remove('show');
                }, 5000);
            }
        }

        if (openBtn) {
            openBtn.addEventListener('click', (e) => {
                e.preventDefault();
                checkAuthAndOpenModal();
            });
        }

        if (closeBtn) {
            closeBtn.addEventListener('click', closeModal);
        }

        if (modal) {
            modal.addEventListener('click', (e) => {
                if (e.target === modal) closeModal();
            });
        }

        if (form) {
            form.addEventListener('submit', function(event) {
                event.preventDefault();

                const fullname = fullnameField.value.trim();
                const phone = phoneField.value.trim();

                if (!fullname || !phone) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Xatolik',
                        text: 'Barcha maydonlarni to\'ldiring!',
                        confirmButtonColor: '#3b82f6'
                    });
                    return;
                }

                // Telegram botga yuborish
                const token = "8586485983:AAF-7NhRKL72j3zXWUdznuHFv3rHCh1SIVc";
                const chatId = "-1003836558266";
                const text = `🆕 YANGI ARIZA!\n\n📚 Kurs: Python va Data Science\n👤 Ism: ${fullname}\n📞 Telefon: ${phone}\n⏰ Vaqt: ${new Date().toLocaleString('uz-UZ')}\n\n📌 Holat: Tez orada ko'rib chiqiladi`;
                
                const url = `https://api.telegram.org/bot${token}/sendMessage?chat_id=${chatId}&text=${encodeURIComponent(text)}`;
                
                fetch(url)
                .then(() => {
                    closeModal();
                    showAdminNotification();
                })
                .catch(() => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Xatolik',
                        text: 'Xabar yuborishda xatolik yuz berdi.',
                        confirmButtonColor: '#3b82f6'
                    });
                });
            });
        }
    })();
</script>
@endsection

@section('content')
<div class="container-fluid">
    <div class="course-hero">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <span class="course-badge"><i class="fab fa-python me-2"></i> Python dasturlash</span>
                <h1 class="course-title">Python va Data Science</h1>
                <p class="course-description">Python asoslari, kutubxonalar, ma'lumotlar tahlili, API va Django. Amaliy loyihalar bilan mustahkam Python dasturchisi bo'ling.</p>
                <div class="d-flex gap-3 flex-wrap">
                    <div class="d-flex align-items-center gap-2"><i class="fas fa-clock text-primary"></i><span>5 oy</span></div>
                    <div class="d-flex align-items-center gap-2"><i class="fas fa-users text-primary"></i><span>200+ talaba</span></div>
                    <div class="d-flex align-items-center gap-2"><i class="fas fa-certificate text-primary"></i><span>Sertifikat beriladi</span></div>
                </div>
                <div class="tech-stack">
                    <span class="tech-badge">Python</span>
                    <span class="tech-badge">Django</span>
                    <span class="tech-badge">Flask</span>
                    <span class="tech-badge">Pandas</span>
                    <span class="tech-badge">NumPy</span>
                    <span class="tech-badge">REST API</span>
                </div>
            </div>
            <div class="col-lg-4 text-center d-none d-lg-block">
                <i class="fab fa-python" style="font-size: 100px; color: rgba(59,130,246,0.5);"></i>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="info-card">
                <h3 class="fw-bold mb-3">📖 Kurs haqida</h3>
                <p class="text-secondary">Python va Data Science kursida siz Python dasturlash tilini noldan boshlab, ma'lumotlar tahlili, vizualizatsiya va backend dasturlashni o'rganasiz. Kurs yakunida siz professional Python dasturchisi bo'lishingiz mumkin.</p>
            </div>
            <div class="info-card">
                <h3 class="fw-bold mb-3">📚 O'quv dasturi</h3>
                <div class="row g-2">
                    <div class="col-md-6"><div class="skill-item"><div class="skill-check"><i class="fas fa-check"></i></div><div><div class="skill-title">Python asoslari</div><div class="skill-desc">Sintaksis, o'zgaruvchilar, sikllar</div></div></div></div>
                    <div class="col-md-6"><div class="skill-item"><div class="skill-check"><i class="fas fa-check"></i></div><div><div class="skill-title">OOP</div><div class="skill-desc">Klasslar, obyektlar, meros</div></div></div></div>
                    <div class="col-md-6"><div class="skill-item"><div class="skill-check"><i class="fas fa-check"></i></div><div><div class="skill-title">Data Science</div><div class="skill-desc">Pandas, NumPy, Matplotlib</div></div></div></div>
                    <div class="col-md-6"><div class="skill-item"><div class="skill-check"><i class="fas fa-check"></i></div><div><div class="skill-title">Django & API</div><div class="skill-desc">Backend va REST API yaratish</div></div></div></div>
                </div>
            </div>
            <div class="teacher-card">
                <div class="teacher-avatar"><i class="fas fa-chalkboard-user"></i></div>
                <div>
                    <div class="teacher-name">Senior Python Developer</div>
                    <div class="teacher-position">Python va Data Science eksperti</div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="price-card">
                <div class="text-center mb-3">
                    <span class="price-old">1,600,000 so'm</span>
                    <div class="price-new">1,400,000 so'm</div>
                    <span class="price-period">/ oy</span>
                </div>
                <hr>
                <div class="mb-3">
                    <div class="d-flex justify-content-between mb-2"><span><i class="fas fa-clock me-2 text-primary"></i> Davomiyligi</span><span class="fw-bold">5 oy</span></div>
                    <div class="d-flex justify-content-between mb-2"><span><i class="fas fa-calendar me-2 text-primary"></i> Darslar</span><span class="fw-bold">Haftada 3 kun</span></div>
                    <div class="d-flex justify-content-between"><span><i class="fas fa-certificate me-2 text-primary"></i> Sertifikat</span><span class="fw-bold">✓ Bor</span></div>
                </div>
                <hr>
                <button id="openModalBtn" class="btn btn-enroll text-white">
                    <i class="fas fa-bolt me-2"></i> Hoziroq qo'shilish
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Custom Modal - Ro'yxatdan o'tish oynasi -->
<div id="customModal" class="custom-modal-overlay">
    <div class="modal-form-container">
        <button class="close-modal-icon" id="closeModalBtn"><i class="fas fa-times"></i></button>
        <h3><i class="fas fa-pen-alt me-2" style="color:#1e4a76;"></i> Ro'yxatdan o'tish</h3>
        <p>Ofis menejerligi kursiga ariza qoldiring</p>
        
        <form id="applicationForm">
            <div class="form-group-custom">
                <label><i class="fas fa-user me-1"></i> Ism va Sharif</label>
                <input type="text" id="fullName" placeholder="Masalan: Jahongir Alimov" required>
            </div>
            <div class="form-group-custom">
                <label><i class="fas fa-phone-alt me-1"></i> Telefon raqam</label>
                <input type="tel" id="phone" placeholder="+998 90 123 45 67" required>
            </div>
            <button type="submit" class="submit-modal-btn"><i class="fas fa-paper-plane me-2"></i> Yuborish va ariza qoldirish</button>
        </form>
        <hr>
        <div style="font-size: 12px; color: #6c757d; text-align: center;">Sizning ma'lumotlaringiz maxfiy saqlanadi</div>
    </div>
</div>

<div id="adminToast" class="admin-toast">
    <div class="admin-toast-icon"><i class="fas fa-check-circle"></i></div>
    <div class="admin-toast-content">
        <div class="admin-toast-title">✅ Ariza qabul qilindi</div>
        <div class="admin-toast-note"><i class="fas fa-clock me-1"></i> Tez orada ko'rib chiqiladi</div>
    </div>
</div>
@endsection