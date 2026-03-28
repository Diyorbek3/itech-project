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
                <span class="course-badge"><i class="fas fa-network-wired me-2"></i> Network Administration</span>
                <h1 class="course-title">Tarmoq administratorligi</h1>
                <p class="course-description">Cisco, tarmoq protokollari, router va switch sozlash, tarmoq xavfsizligi va monitoring. CCNA asoslari va amaliy ko'nikmalar.</p>
                <div class="d-flex gap-3 flex-wrap">
                    <div class="d-flex align-items-center gap-2"><i class="fas fa-clock text-primary"></i><span>4 oy</span></div>
                    <div class="d-flex align-items-center gap-2"><i class="fas fa-users text-primary"></i><span>90+ talaba</span></div>
                    <div class="d-flex align-items-center gap-2"><i class="fas fa-certificate text-primary"></i><span>Sertifikat beriladi</span></div>
                </div>
                <div class="tech-stack">
                    <span class="tech-badge">Cisco</span>
                    <span class="tech-badge">TCP/IP</span>
                    <span class="tech-badge">Router</span>
                    <span class="tech-badge">Switch</span>
                    <span class="tech-badge">Firewall</span>
                    <span class="tech-badge">Wireshark</span>
                </div>
            </div>
            <div class="col-lg-4 text-center d-none d-lg-block">
                <i class="fas fa-network-wired" style="font-size: 100px; color: rgba(59,130,246,0.5);"></i>
            </div>
        </div>
    </div>
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="info-card">
                <h3 class="fw-bold mb-3">📖 Kurs haqida</h3>
                <p class="text-secondary">Tarmoq administratorligi kursida siz tarmoq asoslari, Cisco router va switchlarni sozlash, tarmoq protokollari, tarmoq xavfsizligi va monitoringni o'rganasiz. Kurs yakunida siz CCNA darajasidagi bilimlarga ega bo'lasiz va real tarmoq infratuzilmalarini boshqara olasiz.</p>
            </div>
            <div class="info-card">
                <h3 class="fw-bold mb-3">📚 O'quv dasturi</h3>
                <div class="row g-2">
                    <div class="col-md-6"><div class="skill-item"><div class="skill-check"><i class="fas fa-check"></i></div><div><div class="skill-title">Tarmoq asoslari</div><div class="skill-desc">OSI model, TCP/IP, IP manzillash, subnetting, VLAN</div></div></div></div>
                    <div class="col-md-6"><div class="skill-item"><div class="skill-check"><i class="fas fa-check"></i></div><div><div class="skill-title">Cisco router sozlash</div><div class="skill-desc">Static routing, OSPF, EIGRP, BGP asoslari</div></div></div></div>
                    <div class="col-md-6"><div class="skill-item"><div class="skill-check"><i class="fas fa-check"></i></div><div><div class="skill-title">Switch sozlash</div><div class="skill-desc">STP, VLAN, trunk, port security, EtherChannel</div></div></div></div>
                    <div class="col-md-6"><div class="skill-item"><div class="skill-check"><i class="fas fa-check"></i></div><div><div class="skill-title">Tarmoq xavfsizligi</div><div class="skill-desc">Firewall, ACL, VPN, AAA, 802.1X</div></div></div></div>
                    <div class="col-md-6"><div class="skill-item"><div class="skill-check"><i class="fas fa-check"></i></div><div><div class="skill-title">Monitoring va troubleshooting</div><div class="skill-desc">Wireshark, SNMP, syslog, ping, traceroute</div></div></div></div>
                    <div class="col-md-6"><div class="skill-item"><div class="skill-check"><i class="fas fa-check"></i></div><div><div class="skill-title">Simulyatsiya</div><div class="skill-desc">Cisco Packet Tracer, GNS3 bilan ishlash</div></div></div></div>
                </div>
            </div>
            <div class="info-card">
                <h3 class="fw-bold mb-3">👨‍💻 Kimlar uchun?</h3>
                <p class="text-secondary">IT sohasiga qiziqqanlar, tarmoq administratori bo'lishni xohlovchilar, Cisco sertifikatiga tayyorlanayotganlar, sistem administratorlar, tarmoq xavfsizligiga qiziqadiganlar.</p>
            </div>
            <div class="teacher-card">
                <div class="teacher-avatar"><i class="fas fa-chalkboard-user"></i></div>
                <div>
                    <div class="teacher-name">Qodirov Shohijahon</div>
                    <div class="teacher-position">Network Engineer, CCNA Certified</div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="price-card">
                <div class="text-center mb-3">
                    <span class="price-old">1,200,000 so'm</span>
                    <div class="price-new">1,000,000 so'm</div>
                    <span class="price-period">/ oy</span>
                </div>
                <hr>
                <div class="mb-3">
                    <div class="d-flex justify-content-between mb-2"><span><i class="fas fa-clock me-2 text-primary"></i> Davomiyligi</span><span class="fw-bold">4 oy</span></div>
                    <div class="d-flex justify-content-between mb-2"><span><i class="fas fa-calendar me-2 text-primary"></i> Darslar</span><span class="fw-bold">Haftada 3 kun</span></div>
                    <div class="d-flex justify-content-between mb-2"><span><i class="fas fa-language me-2 text-primary"></i> Til</span><span class="fw-bold">O'zbek tilida</span></div>
                    <div class="d-flex justify-content-between"><span><i class="fas fa-certificate me-2 text-primary"></i> Sertifikat</span><span class="fw-bold">✓ Bor</span></div>
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

<div class="modal fade" id="enrollModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4">
            <div class="modal-header border-0">
                <h5 class="modal-title fw-bold">Tarmoq administratorligi kursiga yozilish</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form>
                    @csrf
                    <div class="mb-3"><label class="form-label">Ismingiz</label><input type="text" class="form-control rounded-3" required></div>
                    <div class="mb-3"><label class="form-label">Telefon raqam</label><input type="tel" class="form-control rounded-3" placeholder="+998 __ ___ __ __" required></div>
                    <div class="mb-3"><label class="form-label">Email</label><input type="email" class="form-control rounded-3" required></div>
                    <button type="submit" class="btn btn-primary w-100 rounded-3 py-2"><i class="fas fa-paper-plane me-2"></i> Yuborish</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection