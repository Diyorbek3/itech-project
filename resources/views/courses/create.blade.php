@extends('layouts.app')

@section('styles')
<style>
    :root {
        --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        --accent-color: #667eea;
        --text-main: #2d3748;
        --text-muted: #718096;
        --bg-soft: #f8fafc;
    }

    .creation-container {
        animation: fadeIn 0.6s ease-out;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .modern-card {
        border: none;
        border-radius: 24px;
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.08);
        overflow: hidden;
        background: #ffffff;
    }

    .modern-header {
        background: var(--primary-gradient);
        padding: 40px 30px;
        border: none;
        text-align: center;
        position: relative;
    }

    .modern-header h3 {
        color: white;
        font-weight: 800;
        margin: 0;
        font-size: 28px;
        letter-spacing: -0.5px;
    }

    .modern-header .header-icon {
        font-size: 40px;
        color: rgba(255, 255, 255, 0.3);
        position: absolute;
        top: 20px;
        right: 30px;
    }

    .modern-body {
        padding: 40px;
        background: #ffffff;
    }

    .form-section {
        margin-bottom: 35px;
    }

    .section-label {
        display: flex;
        align-items: center;
        font-size: 14px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: var(--accent-color);
        margin-bottom: 20px;
        gap: 10px;
    }

    .section-label::after {
        content: "";
        flex: 1;
        height: 1px;
        background: linear-gradient(to right, #e2e8f0, transparent);
    }

    .form-group-custom {
        margin-bottom: 20px;
    }

    .form-group-custom label {
        display: block;
        font-weight: 600;
        color: var(--text-main);
        margin-bottom: 8px;
        font-size: 15px;
    }

    .form-control-modern {
        border-radius: 14px;
        padding: 12px 18px;
        border: 2px solid #edf2f7;
        background: var(--bg-soft);
        font-size: 15px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        color: var(--text-main);
    }

    .form-control-modern:focus {
        border-color: var(--accent-color);
        background: #fff;
        box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
        outline: none;
    }

    .input-icon-wrapper {
        position: relative;
    }

    .input-icon {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--text-muted);
    }

    .with-icon {
        padding-left: 45px !important;
    }

    .btn-modern-save {
        background: var(--primary-gradient);
        color: white;
        border: none;
        border-radius: 14px;
        padding: 14px 40px;
        font-weight: 700;
        font-size: 16px;
        transition: all 0.3s ease;
        box-shadow: 0 10px 20px rgba(102, 126, 234, 0.2);
    }

    .btn-modern-save:hover {
        transform: translateY(-2px);
        box-shadow: 0 15px 30px rgba(102, 126, 234, 0.3);
        color: white;
    }

    .btn-modern-back {
        background: #f1f5f9;
        color: #64748b;
        border: none;
        border-radius: 14px;
        padding: 14px 30px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-modern-back:hover {
        background: #e2e8f0;
        color: #475569;
    }

    .file-upload-wrapper {
        position: relative;
        overflow: hidden;
    }

    .markdown-badge {
        font-size: 11px;
        background: #ebf4ff;
        color: #3182ce;
        padding: 2px 8px;
        border-radius: 6px;
        font-weight: 600;
        margin-left: 10px;
    }

    /* Input focus animation */
    .form-group-custom:focus-within label {
        color: var(--accent-color);
    }

    @media (max-width: 768px) {
        .modern-body {
            padding: 25px;
        }
    }
</style>
@endsection

@section('content')
<div class="container py-5 creation-container">
    <div class="row justify-content-center">
        <div class="col-lg-10 col-xl-9">
            <div class="modern-card">
                <div class="modern-header">
                    <i class="fas fa-graduation-cap header-icon"></i>
                    <h3><i class="fas fa-plus-circle me-2"></i>Yangi kurs qo'shish</h3>
                    <p class="text-white-50 mt-2">Barcha ma'lumotlarni to'ldirib, yangi kursni ommaga taqdim eting</p>
                </div>
                
                <div class="modern-body">
                    <form action="{{ route('courses.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- ASOSIY MA'LUMOTLAR -->
                        <div class="form-section">
                            <div class="section-label">
                                <i class="fas fa-info-circle"></i> Asosiy ma'lumotlar
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group-custom">
                                        <label>Kurs nomi <span class="text-danger">*</span></label>
                                        <div class="input-icon-wrapper">
                                            <i class="fas fa-book input-icon"></i>
                                            <input type="text" name="title" class="form-control form-control-modern with-icon" required placeholder="Masalan: Python Dasturlash">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group-custom">
                                        <label>Muqova rasmi</label>
                                        <div class="input-icon-wrapper">
                                            <i class="fas fa-image input-icon"></i>
                                            <input type="file" name="image" class="form-control form-control-modern with-icon" accept="image/*">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group-custom">
                                <label>Qisqacha tavsif</label>
                                <input type="text" name="short_description" class="form-control form-control-modern" placeholder="Kurs haqida bir jumlada... Masalan: Ofis ishlarini boshqarish">
                            </div>

                            <div class="form-group-custom">
                                <label>Kurs haqida (to'liq)</label>
                                <textarea name="full_description" class="form-control form-control-modern" rows="4" placeholder="Kurs mazmuni va afzalliklari haqida batafsil yozing..."></textarea>
                            </div>
                        </div>

                        <!-- TEXNIK MA'LUMOTLAR -->
                        <div class="form-section">
                            <div class="section-label">
                                <i class="fas fa-cog"></i> Texnik ma'lumotlar
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group-custom">
                                        <label>Davomiyligi</label>
                                        <div class="input-icon-wrapper">
                                            <i class="fas fa-calendar-alt input-icon"></i>
                                            <input type="text" name="duration" class="form-control form-control-modern with-icon" placeholder="2 oy">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group-custom">
                                        <label>Talabalar soni</label>
                                        <div class="input-icon-wrapper">
                                            <i class="fas fa-users input-icon"></i>
                                            <input type="number" name="student_count" class="form-control form-control-modern with-icon" placeholder="100">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group-custom">
                                        <label>Sertifikat</label>
                                        <select name="has_certificate" class="form-select form-control-modern">
                                            <option value="1">Bor (Beriladi)</option>
                                            <option value="0">Yo'q</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-2">
                                <div class="col-md-4">
                                    <div class="form-group-custom">
                                        <label>Narxi (so'm)</label>
                                        <div class="input-icon-wrapper">
                                            <i class="fas fa-tag input-icon"></i>
                                            <input type="number" name="price" class="form-control form-control-modern with-icon" placeholder="850 000">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group-custom">
                                        <label>Darslar vaqti</label>
                                        <div class="input-icon-wrapper">
                                            <i class="fas fa-clock input-icon"></i>
                                            <input type="text" name="schedule" class="form-control form-control-modern with-icon" placeholder="Haftada 3 kun">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group-custom">
                                        <label>O'qituvchilar</label>
                                        <div class="input-icon-wrapper">
                                            <i class="fas fa-user-tie input-icon"></i>
                                            <input type="text" name="teachers" class="form-control form-control-modern with-icon" placeholder="Ism familiyalar...">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- QO'SHIMCHA MA'LUMOTLAR -->
                        <div class="form-section">
                            <div class="section-label">
                                <i class="fas fa-list-ul"></i> Dastur va auditoriya
                            </div>
                            <div class="form-group-custom">
                                <label>O'quv dasturi <span class="markdown-badge">Markdown qo'llab-quvvatlanadi</span></label>
                                <textarea name="curriculum" class="form-control form-control-modern" rows="5" placeholder="### Birinchi modul&#10;- Kirish qismi..."></textarea>
                            </div>

                            <div class="form-group-custom">
                                <label>Kimlar uchun?</label>
                                <textarea name="target_audience" class="form-control form-control-modern" rows="2" placeholder="Kurs kimlar uchun mo'ljallangan?"></textarea>
                            </div>
                        </div>

                        <!-- HAVOLALAR -->
                        <div class="form-section">
                            <div class="section-label">
                                <i class="fas fa-link"></i> Havolalar (Ixtiyoriy)
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group-custom">
                                        <label><i class="fab fa-microsoft-word text-primary me-1"></i> Word</label>
                                        <input type="url" name="word_link" class="form-control form-control-modern" placeholder="https://...">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group-custom">
                                        <label><i class="fab fa-microsoft-excel text-success me-1"></i> Excel</label>
                                        <input type="url" name="excel_link" class="form-control form-control-modern" placeholder="https://...">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group-custom">
                                        <label><i class="fab fa-microsoft-powerpoint text-danger me-1"></i> PowerPoint</label>
                                        <input type="url" name="powerpoint_link" class="form-control form-control-modern" placeholder="https://...">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mt-5">
                            <a href="{{ route('courses.index') }}" class="btn btn-modern-back">
                                <i class="fas fa-arrow-left me-2"></i>Orqaga
                            </a>
                            <button type="submit" class="btn btn-modern-save">
                                <i class="fas fa-save me-2"></i>Kursni saqlash
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection