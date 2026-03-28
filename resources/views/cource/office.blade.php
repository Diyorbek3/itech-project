@extends('layouts.app')
@section('styles')
<style>
    .course-hero { background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%); border-radius: 30px; padding: 3rem; margin-bottom: 3rem; position: relative; overflow: hidden; }
    .course-hero::before { content: ''; position: absolute; top: -50%; right: -50%; width: 200%; height: 200%; background: radial-gradient(circle, rgba(59,130,246,0.1) 1px, transparent 1px); background-size: 50px 50px; animation: moveGrid 20s linear infinite; }
    @keyframes moveGrid { 0% { transform: translate(0, 0); } 100% { transform: translate(50px, 50px); } }
    .course-badge { display: inline-block; background: rgba(59,130,246,0.2); backdrop-filter: blur(10px); padding: 0.5rem 1rem; border-radius: 50px; font-size: 0.8rem; font-weight: 600; color: #3b82f6; margin-bottom: 1rem; }
    .course-title { font-size: 2.5rem; font-weight: 800; margin-bottom: 1rem; color: white; }
    .course-description { font-size: 1rem; color: rgba(255,255,255,0.8); line-height: 1.6; margin-bottom: 1.5rem; }
    .info-card { background: white; border-radius: 20px; padding: 1.5rem; margin-bottom: 1.5rem; box-shadow: 0 5px 15px rgba(0,0,0,0.05); transition: all 0.3s ease; }
    .info-card:hover { transform: translateY(-5px); box-shadow: 0 15px 30px rgba(0,0,0,0.1); }
    .price-card { background: white; border-radius: 24px; padding: 2rem; position: sticky; top: 20px; box-shadow: 0 20px 35px -10px rgba(0,0,0,0.1); border: 1px solid rgba(59,130,246,0.2); }
    .price-old { font-size: 0.9rem; color: #94a3b8; text-decoration: line-through; }
    .price-new { font-size: 2rem; font-weight: 800; color: #3b82f6; }
    .price-period { font-size: 0.8rem; color: #64748b; }
    .btn-enroll { background: linear-gradient(135deg, #3b82f6, #2563eb); border: none; border-radius: 50px; padding: 0.9rem; font-weight: 700; font-size: 1rem; width: 100%; margin-top: 1.5rem; transition: all 0.3s ease; }
    .btn-enroll:hover { transform: translateY(-2px); box-shadow: 0 10px 25px rgba(59,130,246,0.4); }
    .skill-item { display: flex; align-items: flex-start; gap: 1rem; padding: 1rem; background: #f8fafc; border-radius: 12px; margin-bottom: 0.75rem; transition: all 0.3s ease; }
    .skill-item:hover { background: #f1f5f9; transform: translateX(5px); }
    .skill-check { width: 28px; height: 28px; background: #22c55e; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: white; font-size: 0.7rem; flex-shrink: 0; }
    .skill-title { font-weight: 700; color: #0f172a; margin-bottom: 0.25rem; font-size: 0.95rem; }
    .skill-desc { font-size: 0.75rem; color: #64748b; }
    .teacher-card { background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%); border-radius: 20px; padding: 1.5rem; display: flex; align-items: center; gap: 1rem; margin-top: 1.5rem; }
    .teacher-avatar { width: 60px; height: 60px; background: linear-gradient(135deg, #3b82f6, #2563eb); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; color: white; flex-shrink: 0; }
    .teacher-name { font-weight: 700; font-size: 1rem; color: #0f172a; }
    .teacher-position { font-size: 0.75rem; color: #64748b; }
    .success-toast { background: #dcfce7; border-radius: 50px; padding: 0.75rem 1.5rem; color: #15803d; font-weight: 500; text-align: center; margin-top: 1rem; display: none; }
    .modal-custom { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.6); backdrop-filter: blur(5px); display: flex; align-items: center; justify-content: center; z-index: 9999; visibility: hidden; opacity: 0; transition: all 0.3s ease; }
    .modal-custom.active { visibility: visible; opacity: 1; }
    .modal-custom .modal-container { background: white; max-width: 450px; width: 90%; border-radius: 28px; padding: 2rem; position: relative; transform: scale(0.9); transition: transform 0.3s ease; }
    .modal-custom.active .modal-container { transform: scale(1); }
    .modal-custom .close-modal { position: absolute; top: 1rem; right: 1.5rem; font-size: 1.5rem; cursor: pointer; color: #94a3b8; background: none; border: none; }
    .modal-custom .close-modal:hover { color: #1e293b; }
    .modal-custom h3 { font-size: 1.6rem; font-weight: 800; background: linear-gradient(135deg, #0f2b3d, #1e4a76); -webkit-background-clip: text; background-clip: text; color: transparent; text-align: center; margin-bottom: 0.5rem; }
    .modal-custom p { text-align: center; color: #64748b; margin-bottom: 1.5rem; }
    .modal-custom .form-group { margin-bottom: 1.2rem; }
    .modal-custom .form-group label { display: block; font-weight: 600; margin-bottom: 0.4rem; color: #1e293b; }
    .modal-custom .form-group input { width: 100%; padding: 0.8rem 1rem; border: 1.5px solid #e2edf7; border-radius: 20px; font-size: 1rem; outline: none; transition: 0.2s; }
    .modal-custom .form-group input:focus { border-color: #3b82f6; box-shadow: 0 0 0 3px rgba(59,130,246,0.2); }
    .modal-custom .submit-btn { background: linear-gradient(135deg, #0f3b5c, #1e5a7c); width: 100%; border: none; padding: 0.8rem; border-radius: 40px; font-weight: bold; font-size: 1rem; color: white; transition: 0.2s; margin-top: 0.5rem; }
    .modal-custom .submit-btn:hover { transform: scale(0.98); }
    @media (max-width: 991px) { .course-title { font-size: 1.8rem; } .price-card { position: relative; margin-top: 2rem; } }
    @media (max-width: 768px) { .course-hero { padding: 1.5rem; } .course-title { font-size: 1.5rem; } }
</style>
@endsection
@section('content')
<div class="container py-4 py-md-5">
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
                    <div class="col-md-6"><div class="skill-item"><div class="skill-check"><i class="fas fa-check"></i></div><div><div class="skill-title">Python asoslari</div><div class="skill-desc">Sintaksis, o'zgaruvchilar, sikllar, funksiyalar</div></div></div></div>
                    <div class="col-md-6"><div class="skill-item"><div class="skill-check"><i class="fas fa-check"></i></div><div><div class="skill-title">OOP</div><div class="skill-desc">Klasslar, obyektlar, meros, polimorfizm</div></div></div></div>
                    <div class="col-md-6"><div class="skill-item"><div class="skill-check"><i class="fas fa-check"></i></div><div><div class="skill-title">Data Science</div><div class="skill-desc">Pandas, NumPy, Matplotlib</div></div></div></div>
                    <div class="col-md-6"><div class="skill-item"><div class="skill-check"><i class="fas fa-check"></i></div><div><div class="skill-title">Django</div><div class="skill-desc">Backend dasturlash, REST API</div></div></div></div>
                </div>
            </div>
            <div class="info-card">
                <h3 class="fw-bold mb-3">👨‍💻 Kimlar uchun?</h3>
                <p class="text-secondary">Dasturlashga yangi boshlovchilar, ma'lumotlar tahlili va backend dasturlashni o'rganmoqchi bo'lganlar.</p>
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
                    <div class="d-flex justify-content-between mb-2"><span><i class="fas fa-language me-2 text-primary"></i> Til</span><span class="fw-bold">O'zbek tilida</span></div>
                    <div class="d-flex justify-content-between"><span><i class="fas fa-certificate me-2 text-primary"></i> Sertifikat</span><span class="fw-bold">✓ Bor</span></div>
                </div>
                <hr>
                <button class="btn btn-enroll text-white" id="openModalBtn"><i class="fas fa-bolt me-2"></i> Hoziroq qo'shilish</button>
                <div class="text-center mt-3"><small class="text-muted"><i class="fas fa-headset me-1"></i> 24/7 mentor yordami</small></div>
            </div>
        </div>
    </div>
</div>

<!-- Custom Modal -->
<div id="enrollModal" class="modal-custom">
    <div class="modal-container">
        <button class="close-modal" id="closeModalBtn">&times;</button>
        <h3><i class="fas fa-pen-alt me-2"></i> Ro'yxatdan o'tish</h3>
        <p>Python va Data Science kursiga ariza qoldiring</p>
        <form id="enrollForm">
            <div class="form-group">
                <label>Ism va Sharif</label>
                <input type="text" id="fullName" placeholder="Masalan: Jahongir Alimov" required>
            </div>
            <div class="form-group">
                <label>Telefon raqam</label>
                <input type="tel" id="phone" placeholder="+998 90 123 45 67" required>
            </div>
            <div id="successMsg" class="success-toast">✅ Ariza muvaffaqiyatli qabul qilindi!</div>
            <button type="submit" class="submit-btn"><i class="fas fa-paper-plane me-2"></i> Yuborish va ariza qoldirish</button>
        </form>
        <hr>
        <div style="font-size: 12px; color: #6c757d; text-align: center;">Sizning ma'lumotlaringiz maxfiy saqlanadi</div>
    </div>
</div>

<script>
    (function() {
        const modal = document.getElementById('enrollModal');
        const openBtn = document.getElementById('openModalBtn');
        const closeBtn = document.getElementById('closeModalBtn');
        const form = document.getElementById('enrollForm');
        const fullnameField = document.getElementById('fullName');
        const phoneField = document.getElementById('phone');
        const successMsg = document.getElementById('successMsg');
        
        function openModal() { modal.classList.add('active'); }
        function closeModal() { modal.classList.remove('active'); successMsg.style.display = 'none'; }
        
        if (openBtn) openBtn.addEventListener('click', openModal);
        if (closeBtn) closeBtn.addEventListener('click', closeModal);
        modal.addEventListener('click', function(e) { if (e.target === modal) closeModal(); });
        
        if (form) {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                const fullname = fullnameField.value.trim();
                const phone = phoneField.value.trim();
                
                if (!fullname) { alert("Iltimos, Ism va Sharifni kiriting!"); return; }
                if (!phone) { alert("Telefon raqamni kiriting!"); return; }
                
                const token = "8586485983:AAF-7NhRKL72j3zXWUdznuHFv3rHCh1SIVc";
                const chatId = "-1003836558266";
                const text = `🆕 YANGI ARIZA!\n\n📚 Kurs: Python va Data Science\n👤 Ism: ${fullname}\n📞 Telefon: ${phone}\n⏰ Vaqt: ${new Date().toLocaleString('uz-UZ')}`;
                const url = `https://api.telegram.org/bot${token}/sendMessage?chat_id=${chatId}&text=${encodeURIComponent(text)}`;
                
                fetch(url).then(() => {
                    successMsg.style.display = 'block';
                    fullnameField.value = '';
                    phoneField.value = '';
                    setTimeout(() => { closeModal(); }, 2000);
                }).catch(() => alert("Xatolik yuz berdi! Iltimos, qayta urinib ko'ring."));
            });
        }
    })();
</script>
@endsection