@extends('layouts.app')

@section('styles')
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
        </div>
    </div>
    <div class="row g-4">
        <div class="col-lg-8">
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
        </div>
        <div class="col-lg-4">
            <div class="price-card"><div class="text-center mb-3"><span class="price-old">950,000 so'm</span><div class="price-new">850,000 so'm</div><span class="price-period">/ oy</span></div><hr><div class="mb-3"><div class="d-flex justify-content-between mb-2"><span><i class="fas fa-clock me-2 text-primary"></i> Davomiyligi</span><span class="fw-bold">7 oy</span></div><div class="d-flex justify-content-between mb-2"><span><i class="fas fa-calendar me-2 text-primary"></i> Darslar</span><span class="fw-bold">Haftada 3 kun</span></div><div class="d-flex justify-content-between mb-2"><span><i class="fas fa-language me-2 text-primary"></i> Til</span><span class="fw-bold">O'zbek tilida</span></div><div class="d-flex justify-content-between"><span><i class="fas fa-certificate me-2 text-primary"></i> Sertifikat</span><span class="fw-bold">✓ Bor</span></div></div><hr><button class="btn btn-enroll text-white" data-bs-toggle="modal" data-bs-target="#enrollModal"><i class="fas fa-bolt me-2"></i> Hoziroq yozilish</button><div class="text-center mt-3"><small class="text-muted"><i class="fas fa-headset me-1"></i> 24/7 mentor yordami</small></div></div>
        </div>
    </div>
</div>
<div class="modal fade" id="enrollModal" tabindex="-1"><div class="modal-dialog modal-dialog-centered"><div class="modal-content rounded-4"><div class="modal-header border-0"><h5 class="modal-title fw-bold">Frontend kursiga yozilish</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div><div class="modal-body"><form>@csrf<div class="mb-3"><label class="form-label">Ismingiz</label><input type="text" class="form-control rounded-3" required></div><div class="mb-3"><label class="form-label">Telefon raqam</label><input type="tel" class="form-control rounded-3" placeholder="+998 __ ___ __ __" required></div><div class="mb-3"><label class="form-label">Email</label><input type="email" class="form-control rounded-3" required></div><button type="submit" class="btn btn-primary w-100 rounded-3 py-2"><i class="fas fa-paper-plane me-2"></i> Yuborish</button></form></div></div></div></div>
@endsection