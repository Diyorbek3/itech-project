@extends('layouts.app')

@section('styles')
<style>
    :root {
        --primary: #4a90e2;
        --secondary: #9b59b6;
        --dark: #2c3e50;
        --light: #f8f9fa;
        --gradient: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
        --gradient-horizontal: linear-gradient(90deg, var(--primary), var(--secondary));
    }

    /* ========== TYPOGRAPHY & UTILITIES ========== */
    .section {
        margin-top:65px !important;
        padding: 80px 0;
        position: relative;
        overflow: hidden;
    }

    .section-title {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 3rem;
        text-align: center;
        position: relative;
        color: var(--dark);
    }

    .section-title:after {
        content: '';
        position: absolute;
        bottom: -15px;
        left: 50%;
        transform: translateX(-50%);
        width: 80px;
        height: 4px;
        background: var(--gradient-horizontal);
        border-radius: 2px;
    }

    .bg-gradient {
        background: var(--gradient);
        color: white;
    }

    .bg-gradient .section-title {
        color: white;
    }

    /* ========== MODAL & FORM STYLES ========== */
    .modal-content {
        border-radius: 20px;
        border: none;
        box-shadow: 0 15px 35px rgba(0,0,0,0.2);
    }
    .modal-header-custom {
        background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
        color: white;
        padding: 20px;
        border-top-left-radius: 20px;
        border-top-right-radius: 20px;
    }
    .btn-submit-custom {
        background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
        border: none;
        padding: 12px;
        border-radius: 10px;
        font-weight: bold;
        transition: transform 0.3s ease;
    }
    .btn-submit-custom:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(37, 117, 252, 0.4);
    }

    /* ========== HISTORY TIMELINE ========== */
    .timeline {
        position: relative;
        padding: 20px 0;
    }

    .timeline::before {
        content: '';
        position: absolute;
        left: 50%;
        top: 0;
        transform: translateX(-50%);
        width: 2px;
        height: 100%;
        background: rgba(255, 255, 255, 0.3);
    }

    .timeline-item {
        position: relative;
        margin-bottom: 40px;
    }

    .timeline-item:nth-child(odd) .timeline-content {
        margin-left: auto;
    }

    .timeline-content {
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(10px);
        padding: 25px;
        border-radius: 20px;
        width: 80%;
        transition: all 0.3s ease;
    }

    .timeline-content:hover {
        background: rgba(255, 255, 255, 0.25);
        transform: scale(1.02);
    }

    .timeline-year {
        font-size: 1.8rem;
        font-weight: 800;
        color: #ffd700;
        margin-bottom: 10px;
        display: inline-block;
        background: rgba(0, 0, 0, 0.3);
        padding: 5px 15px;
        border-radius: 30px;
    }

    @media (max-width: 768px) {
        .timeline::before {
            left: 20px;
        }
        .timeline-content {
            width: calc(100% - 50px);
            margin-left: 50px !important;
        }
        .timeline-item:nth-child(odd) .timeline-content {
            margin-left: 50px;
        }
    }

    /* ========== ANIMATIONS ========== */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .fade-in-up {
        animation: fadeInUp 0.6s ease-out forwards;
    }

    .hover-lift {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .hover-lift:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    }

    /* Jamoa bo'limi foni */
    .team-section {
        background: #f8f9fa;
        padding: 80px 0;
    }

    /* Karta umumiy ko'rinishi */
    .team-card {
        background: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        margin-bottom: 30px;
    }

    /* Karta ustiga borganda effekt */
    .team-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.15);
    }

    /* Rasm dizayni */
    .team-image {
        width: 100%;
        height: 350px;
        object-fit: cover;
        object-position: top;
    }

    /* Ma'lumotlar qismi */
    .team-info {
        padding: 20px;
        text-align: center;
    }

    .team-name {
        font-size: 1.2rem;
        font-weight: 600;
        margin-bottom: 5px;
        color: #333;
    }

    .team-position {
        color: #6c757d;
        margin-bottom: 15px;
        font-size: 0.9rem;
    }

    /* ========== QUIZ SECTION ========== */
    .quiz-card {
        background: white;
        border-radius: 20px;
        padding: 35px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
    }

    .quiz-question {
        font-size: 1.3rem;
        font-weight: 600;
        margin-bottom: 25px;
        color: var(--dark);
    }

    .quiz-option {
        background: #98bfe7;
        padding: 12px 20px;
        border-radius: 12px;
        margin-bottom: 12px;
        cursor: pointer;
        transition: all 0.2s ease;
        border: 2px solid transparent;
    }

    .quiz-option:hover {
        background: #b0ceec;
        transform: translateX(5px);
    }

    .quiz-option.selected {
        background: var(--gradient-horizontal);
        color: white;
        border-color: white;
    }

    .quiz-option input {
        margin-right: 12px;
        transform: scale(1.1);
    }

    /* ========== MASTERCLASS CARDS ========== */
    .masterclass-card {
        background: white;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        height: 100%;
    }

    .masterclass-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    }

    .masterclass-img {
        height: 220px;
        width: 100%;
        object-fit: cover;
    }

    .masterclass-body {
        padding: 25px;
    }

    .masterclass-title {
        font-size: 1.3rem;
        font-weight: 700;
        margin-bottom: 10px;
    }

    .masterclass-date {
        color: var(--primary);
        font-weight: 600;
        margin-bottom: 12px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    /* Yangilangan tugma stili - MASTER KLASSGA YOZILISH */
    .btn-masterclass-register {
        background: var(--gradient-horizontal);
        color: white;
        padding: 12px 25px;
        border-radius: 30px;
        border: none;
        font-weight: 600;
        transition: all 0.3s ease;
        width: 100%;
        cursor: pointer;
        display: inline-block;
        text-align: center;
    }

    .btn-masterclass-register:hover {
        transform: scale(1.02);
        box-shadow: 0 5px 15px rgba(74, 144, 226, 0.4);
        color: white;
    }

    /* ========== FEEDBACK FORM ========== */
    .feedback-form {
        background: white;
        padding: 40px;
        border-radius: 20px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
    }

    .form-control-custom {
        width: 100%;
        padding: 14px 20px;
        border: 2px solid #e9ecef;
        border-radius: 12px;
        transition: all 0.3s ease;
        margin-bottom: 20px;
    }

    .form-control-custom:focus {
        border-color: var(--primary);
        outline: none;
        box-shadow: 0 0 0 3px rgba(74, 144, 226, 0.2);
    }

    .btn-submit {
        background: var(--gradient-horizontal);
        color: white;
        padding: 14px;
        border-radius: 12px;
        font-weight: 700;
        width: 100%;
        border: none;
        transition: all 0.3s ease;
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(74, 144, 226, 0.3);
    }

    /* Modal ichidagi forma stillari */
    .modal-body .form-control {
        border-radius: 10px;
        padding: 12px 15px;
        border: 1px solid #e0e0e0;
        transition: all 0.3s ease;
    }

    .modal-body .form-control:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(74, 144, 226, 0.1);
    }

    .masterclass-detail-img {
        width: 100%;
        border-radius: 15px;
        margin-bottom: 15px;
    }

    .masterclass-detail-title {
        font-size: 1.4rem;
        font-weight: 700;
        margin-bottom: 10px;
        color: var(--dark);
    }

    .masterclass-detail-date {
        color: var(--primary);
        margin-bottom: 15px;
        font-weight: 500;
    }

    /* Pagination */
    .pagination {
        justify-content: center;
        margin-top: 30px;
    }
    
    .page-item.active .page-link {
        background: linear-gradient(90deg, #4a90e2, #9b59b6);
        border-color: #4a90e2;
    }
    
    .page-link {
        color: #4a90e2;
        }
    /* Validatsiya uchun CSS */
    .is-valid {
        border-color: #28a745 !important;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3e%3cpath fill='%2328a745' d='M2.3 6.73L.6 4.53c-.4-1.04.46-1.4 1.1-.8l1.1 1.4 3.4-3.8c.6-.63 1.6-.27 1.2.7l-4 4.6c-.43.5-.8.4-1.1.1z'/%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: right 10px center;
        background-size: 20px;
        padding-right: 35px !important;
    }

    .is-invalid {
        border-color: #dc3545 !important;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12' height='12' fill='none' stroke='%23dc3545'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/%3e%3ccircle cx='6' cy='8.2' r='.6' fill='%23dc3545' stroke='none'/%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: right 10px center;
        background-size: 20px;
        padding-right: 35px !important;
    }

    /* Modal ichidagi forma inputlari */
    .modal-body .form-control {
      border-radius: 10px;
      padding: 12px 15px;
      border: 1px solid #e0e0e0;
      transition: all 0.3s ease;
    }

    .modal-body .form-control:focus {
     border-color: var(--primary);
     box-shadow: 0 0 0 3px rgba(74, 144, 226, 0.1);
    }

/* Alert xabarlari */
    .alert {
        border-radius: 12px;
        padding: 12px 20px;
        margin-bottom: 20px;
    }

    .alert-danger {
        background: linear-gradient(135deg, #fdd3d6, #f8d7da);
        color: #721c24;
        border: none;
    }

    .alert-success {
        background: linear-gradient(135deg, #d1e7dd, #d4edda);
        color: #0f5132;
        border: none;
    }
</style>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    // ========== 1. FEEDBACK FORM VALIDATION & SUBMISSION ==========
    $('#contactForm').on('submit', function(e) {
        e.preventDefault();
        
        // Validatsiya
        let isValid = true;
        let errors = [];
        
        const name = $('#name').val().trim();
        if (!name) {
            isValid = false;
            errors.push('❌ Iltimos, ismingizni kiriting!');
            $('#name').addClass('is-invalid');
        } else if (name.length < 2) {
            isValid = false;
            errors.push('❌ Ism 2 harfdan kam bo\'lmasligi kerak!');
            $('#name').addClass('is-invalid');
        } else {
            $('#name').removeClass('is-invalid').addClass('is-valid');
        }
        
        const email = $('#email').val().trim();
        const emailPattern = /^[^\s@]+@([^\s@]+\.)+[^\s@]+$/;
        if (!email) {
            isValid = false;
            errors.push('❌ Iltimos, email manzilingizni kiriting!');
            $('#email').addClass('is-invalid');
        } else if (!emailPattern.test(email)) {
            isValid = false;
            errors.push('❌ Noto\'g\'ri email format! Masalan: example@gmail.com');
            $('#email').addClass('is-invalid');
        } else {
            $('#email').removeClass('is-invalid').addClass('is-valid');
        }
        
        const message = $('#message').val().trim();
        if (!message) {
            isValid = false;
            errors.push('❌ Iltimos, fikringizni yozing!');
            $('#message').addClass('is-invalid');
        } else if (message.length < 5) {
            isValid = false;
            errors.push('❌ Fikringiz 5 harfdan kam bo\'lmasligi kerak!');
            $('#message').addClass('is-invalid');
        } else {
            $('#message').removeClass('is-invalid').addClass('is-valid');
        }
        
        // Xatoliklar bo'lsa
        if (!isValid) {
            $('#feedbackAlert').removeClass('alert-success').addClass('alert-danger')
                .html('<i class="fas fa-exclamation-triangle me-2"></i> ' + errors.join('<br>')).show();
            setTimeout(() => $('#feedbackAlert').fadeOut(), 4000);
            
            // 3 sekunddan keyin invalid classlarni olib tashlash
            setTimeout(() => {
                $('.is-invalid').removeClass('is-invalid');
                $('.is-valid').removeClass('is-valid');
            }, 3000);
            return;
        }
        
        const $btn = $('#submitBtn');
        const originalText = $btn.html();
        
        $btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Yuborilmoqda...');

        @if(!auth()->check())
        Swal.fire({
            icon: 'warning',
            title: 'Avtorizatsiya kerak!',
            text: 'Fikr qoldirish uchun tizimga kiring yoki ro\'yxatdan o\'ting.',
            confirmButtonText: 'Kirish',
            showCancelButton: true,
            cancelButtonText: 'Bekor qilish',
            confirmButtonColor: '#2575fc',
            cancelButtonColor: '#6c757d'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '{{ route("login") }}';
            }
        });
        $btn.prop('disabled', false).html(originalText);
        return;
        @endif

        $.ajax({
            url: '{{ route("feedback.store") }}',
            type: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                $('#feedbackAlert').removeClass('alert-danger').addClass('alert-success')
                    .html('<i class="fas fa-check-circle me-2"></i> ' + response.message).show();
                $('#contactForm')[0].reset();
                $('.is-valid').removeClass('is-valid');
                
                // SweetAlert bilan muvaffaqiyatli xabar
                Swal.fire({
                    icon: 'success',
                    title: 'Rahmat!',
                    text: 'Fikringiz qabul qilindi.',
                    timer: 2000,
                    showConfirmButton: false,
                    position: 'top-end',
                    toast: true
                });
            },
            error: function(xhr) {
                let errorMsg = 'Xatolik yuz berdi.';
                if (xhr.status === 422 && xhr.responseJSON.errors) {
                    errorMsg = '<ul class="mb-0">';
                    $.each(xhr.responseJSON.errors, function(k, v) {
                        errorMsg += '<li>' + v[0] + '</li>';
                    });
                    errorMsg += '</ul>';
                } else if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMsg = xhr.responseJSON.message;
                }
                $('#feedbackAlert').removeClass('alert-success').addClass('alert-danger').html(errorMsg).show();
            },
            complete: function() {
                $btn.prop('disabled', false).html(originalText);
                setTimeout(() => $('#feedbackAlert').fadeOut(), 5000);
            }
        });
    });
    
    // Input maydonlarida yozishni boshlaganda validatsiya classlarini yangilash
    $('#name, #email, #message').on('input', function() {
        $(this).removeClass('is-invalid is-valid');
        $('#feedbackAlert').fadeOut();
    });

    // ========== 2. MASTERCLASS REGISTRATION VALIDATION ==========
    window.openMasterclassModal = function(masterclassId) {
        @if(!auth()->check())
            Swal.fire({
                icon: 'warning',
                title: 'Avtorizatsiya kerak!',
                text: 'Masterclassga yozilish uchun tizimga kiring yoki ro\'yxatdan o\'ting.',
                confirmButtonText: 'Kirish',
                showCancelButton: true,
                cancelButtonText: 'Bekor qilish',
                confirmButtonColor: '#2575fc',
                cancelButtonColor: '#6c757d'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '{{ route("login") }}';
                }
            });
            return;
        @endif

        $('#register_masterclass_id').val(masterclassId);
        $('#register_name').val('{{ auth()->check() ? auth()->user()->name : '' }}');
        $('#register_phone').val('');
        $('#register_name').removeClass('is-invalid is-valid');
        $('#register_phone').removeClass('is-invalid is-valid');
        
        $('#masterclassDetailInfo').html('<div class="text-center py-4"><div class="spinner-border text-primary"></div><p class="mt-2">Ma\'lumot yuklanmoqda...</p></div>');
        
        $.ajax({
            url: '/masterclass/' + masterclassId,
            type: 'GET',
            success: function(data) {
                $('#masterclassDetailInfo').html(`
                    <div class="row align-items-center">
                        <div class="col-md-5">
                            <img src="${data.image ? '/storage/' + data.image : '/images/default-masterclass.jpg'}" 
                                 class="masterclass-detail-img w-100 rounded" 
                                 alt="${data.title}"
                                 style="height: 150px; object-fit: cover;"
                                 onerror="this.src='https://via.placeholder.com/400x250?text=Masterclass'">
                        </div>
                        <div class="col-md-7">
                            <h4 class="masterclass-detail-title fs-5 fw-bold">${escapeHtml(data.title)}</h4>
                            <p class="masterclass-detail-date text-muted small">
                                <i class="far fa-calendar-alt text-primary me-1"></i> ${data.event_date || data.date || 'Sana aniqlanmagan'}
                            </p>
                            <p class="text-muted small">${escapeHtml(data.description || 'Batafsil ma\'lumot tez kunda.')}</p>
                        </div>
                    </div>
                `);
            },
            error: function() {
                $('#masterclassDetailInfo').html('<div class="alert alert-danger">Ma\'lumotni yuklab bo\'lmadi. Iltimos, qaytadan urinib ko\'ring.</div>');
            }
        });
        
        $('#masterclassRegisterModal').modal('show');
    };

    // Masterclassga ro'yxatdan o'tish formasi validatsiyasi
    $('#masterclassRegFormSubmit').on('click', function(e) {
        e.preventDefault();
        
        let isValid = true;
        let errors = [];
        
        const masterclassId = $('#register_masterclass_id').val();
        const name = $('#register_name').val().trim();
        const phone = $('#register_phone').val().trim();
        const $btn = $(this);
        
        // Masterclass ID tekshiruvi
        if (!masterclassId) {
            isValid = false;
            errors.push('❌ Masterclass ma\'lumoti topilmadi!');
        }
        
        // Ism validatsiyasi
        if (!name) {
            isValid = false;
            errors.push('❌ Iltimos, ismingizni kiriting!');
            $('#register_name').addClass('is-invalid');
        } else if (name.length < 2) {
            isValid = false;
            errors.push('❌ Ism 2 harfdan kam bo\'lmasligi kerak!');
            $('#register_name').addClass('is-invalid');
        } else if (name.length > 50) {
            isValid = false;
            errors.push('❌ Ism 50 harfdan oshmasligi kerak!');
            $('#register_name').addClass('is-invalid');
        } else {
            $('#register_name').removeClass('is-invalid').addClass('is-valid');
        }
        
        // Telefon validatsiyasi (O'zbekiston formatida)
        const phonePattern = /^\+998\s?\(?\d{2}\)?\s?\d{3}[-\s]?\d{2}[-\s]?\d{2}$/;
        const simplePhonePattern = /^\+998\d{9}$/;
        const cleanedPhone = phone.replace(/\s/g, '').replace(/[()-]/g, '');
        
        if (!phone) {
            isValid = false;
            errors.push('❌ Iltimos, telefon raqamingizni kiriting!');
            $('#register_phone').addClass('is-invalid');
        } else if (!phonePattern.test(phone) && !simplePhonePattern.test(cleanedPhone)) {
            isValid = false;
            errors.push('❌ Noto\'g\'ri telefon format! Masalan: +998 90 123 45 67 yoki +998901234567');
            $('#register_phone').addClass('is-invalid');
        } else if (cleanedPhone.replace('+998', '').length !== 9) {
            isValid = false;
            errors.push('❌ Telefon raqam 9 raqamdan iborat bo\'lishi kerak!');
            $('#register_phone').addClass('is-invalid');
        } else {
            $('#register_phone').removeClass('is-invalid').addClass('is-valid');
            // Telefonni formatlash
            let formatted = formatPhoneNumber(cleanedPhone);
            if (formatted !== phone) {
                $('#register_phone').val(formatted);
            }
        }
        
        // Xatoliklar bo'lsa
        if (!isValid) {
            Swal.fire({
                icon: 'error',
                title: 'Validatsiya xatosi!',
                html: errors.join('<br>'),
                confirmButtonColor: '#dc3545'
            });
            
            setTimeout(() => {
                $('.is-invalid').removeClass('is-invalid');
                $('.is-valid').removeClass('is-valid');
            }, 3000);
            return;
        }
        
        $btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Yuborilmoqda...');
        
        $.ajax({
            url: '{{ route("masterclass.register") }}',
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                masterclass_id: masterclassId,
                name: name,
                phone: cleanedPhone
            },
            success: function(response) {
                $('#masterclassRegisterModal').modal('hide');
                Swal.fire({
                    icon: 'success',
                    title: 'Ariza qabul qilindi! 🎉',
                    text: response.message || 'Siz muvaffaqiyatli ro\'yxatdan o\'tdingiz. Tez orada siz bilan bog\'lanamiz.',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#28a745'
                });
                $('#masterclassRegForm')[0].reset();
                $('.is-valid').removeClass('is-valid');
            },
            error: function(xhr) {
                let errorMsg = 'Tizimda xatolik yuz berdi.';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMsg = xhr.responseJSON.message;
                } else if (xhr.status === 422 && xhr.responseJSON && xhr.responseJSON.errors) {
                    errorMsg = Object.values(xhr.responseJSON.errors).flat().join('<br>');
                }
                Swal.fire({
                    icon: 'error',
                    title: 'Xatolik!',
                    html: errorMsg,
                    confirmButtonColor: '#dc3545'
                });
            },
            complete: function() {
                $btn.prop('disabled', false).html('<i class="fas fa-paper-plane me-2"></i> Yuborish');
            }
        });
    });
    
    // Telefon formatlash funksiyasi
    function formatPhoneNumber(phone) {
        let cleaned = phone.replace(/\D/g, '');
        if (cleaned.startsWith('998')) {
            cleaned = '+' + cleaned;
        } else if (cleaned.startsWith('+998')) {
            cleaned = cleaned;
        } else if (cleaned.length === 9) {
            cleaned = '+998' + cleaned;
        }
        
        if (cleaned.length === 13) {
            return `${cleaned.slice(0, 4)} ${cleaned.slice(4, 6)} ${cleaned.slice(6, 9)} ${cleaned.slice(9, 11)} ${cleaned.slice(11, 13)}`;
        }
        return phone;
    }
    
    // Telefon inputida real-time formatlash
    $('#register_phone').on('input', function() {
        let val = $(this).val().replace(/\D/g, '');
        if (val.length > 12) val = val.slice(0, 12);
        
        if (val.length === 0) {
            $(this).val('');
        } else if (val.length <= 3) {
            $(this).val('+' + val);
        } else if (val.length <= 5) {
            $(this).val('+' + val.slice(0, 3) + ' ' + val.slice(3));
        } else if (val.length <= 8) {
            $(this).val('+' + val.slice(0, 3) + ' ' + val.slice(3, 5) + ' ' + val.slice(5));
        } else if (val.length <= 10) {
            $(this).val('+' + val.slice(0, 3) + ' ' + val.slice(3, 5) + ' ' + val.slice(5, 8) + ' ' + val.slice(8));
        } else {
            $(this).val('+' + val.slice(0, 3) + ' ' + val.slice(3, 5) + ' ' + val.slice(5, 8) + ' ' + val.slice(8, 10) + ' ' + val.slice(10, 12));
        }
        
        $(this).removeClass('is-invalid is-valid');
    });
    
    // Escape HTML funksiyasi
    function escapeHtml(str) {
        if (!str) return '';
        return String(str).replace(/[&<>]/g, function(m) {
            if (m === '&') return '&amp;';
            if (m === '<') return '&lt;';
            if (m === '>') return '&gt;';
            return m;
        });
    }
    
    // Modal yopilganda validatsiya classlarini tozalash
    $('#masterclassRegisterModal').on('hidden.bs.modal', function() {
        $('#register_name, #register_phone').removeClass('is-invalid is-valid');
        $('#masterclassRegForm')[0].reset();
    });
    
    // Quiz funksiyalari
    let currentQuestion = 0;
    let score = 0;
    let userAnswers = [];

    const quizQuestions = [
        { question: "Veb-dasturlashda eng mashhur dasturlash tili qaysi?", options: ["Python", "Java", "JavaScript", "C++"], correct: 2 },
        { question: "HTML so'zining ma'nosi nima?", options: ["Hyper Text Markup Language", "High Tech Modern Language", "Hyper Transfer Markup Language", "Home Tool Markup Language"], correct: 0 },
        { question: "Python uchun eng mashhur framework?", options: ["React", "Angular", "Django", "Vue.js"], correct: 2 }
    ];

    window.startQuiz = function() {
        currentQuestion = 0;
        score = 0;
        userAnswers = [];
        $('#quizStart').fadeOut(400, function() {
            $('#quizContent').fadeIn();
            renderQuestion();
        });
    };

    function renderQuestion() {
        if (currentQuestion < quizQuestions.length) {
            const q = quizQuestions[currentQuestion];
            let html = `<div class="quiz-question">${currentQuestion + 1}. ${q.question}</div>`;
            
            q.options.forEach((opt, idx) => {
                const isChecked = userAnswers[currentQuestion] == idx;
                html += `
                    <div class="quiz-option ${isChecked ? 'selected' : ''}" data-value="${idx}">
                        <input type="radio" name="quizOption" value="${idx}" id="opt${idx}" ${isChecked ? 'checked' : ''}>
                        <label for="opt${idx}" style="cursor:pointer; width:90%;">${escapeHtml(opt)}</label>
                    </div>
                `;
            });

            html += `<button class="btn btn-primary mt-4 px-5" onclick="nextQuestion()">Keyingi savol <i class="fas fa-arrow-right"></i></button>`;
            $('#quizQuestions').html(html);
            
            $('.quiz-option').off('click').on('click', function() {
                $(this).find('input').prop('checked', true);
                $('.quiz-option').removeClass('selected');
                $(this).addClass('selected');
                userAnswers[currentQuestion] = parseInt($(this).data('value'));
            });
        } else {
            showResults();
        }
    }

    window.nextQuestion = function() {
        if (userAnswers[currentQuestion] === undefined) {
            Swal.fire({
                icon: 'warning',
                title: 'Javob tanlanmagan',
                text: 'Iltimos, javob variantini tanlang!',
                confirmButtonColor: '#2575fc'
            });
            return;
        }
        if (userAnswers[currentQuestion] === quizQuestions[currentQuestion].correct) score++;
        currentQuestion++;
        renderQuestion();
    };

    function showResults() {
        const percent = (score / quizQuestions.length) * 100;
        let message = percent >= 80 ? "Ajoyib! Siz haqiqiy IT mutaxassissiz! 🎉" : 
                      (percent >= 60 ? "Yaxshi natija! O'rganishni davom eting! 👍" : 
                      "Yaxshi, ammo o'sish uchun joy bor. 💪");
        
        $('#quizQuestions').html(`
            <div class="text-center py-4">
                <i class="fas fa-chart-line fa-4x text-primary mb-3"></i>
                <h3>Natijangiz: ${score} / ${quizQuestions.length}</h3>
                <p class="lead">${message}</p>
                <button class="btn btn-success btn-lg mt-3" onclick="startQuiz()">
                    <i class="fas fa-redo-alt"></i> Qayta ishlash
                </button>
            </div>
        `);
    }
});
</script>
@endsection

@section('content')
<!-- ========== 1. HISTORY SECTION ========== -->
<section class="section bg-gradient text-white">
    <div class="container-fluid">
        <h2 class="section-title text-black">ITech Academy haqida</h2>
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="text-white text-center p-3">
                    <i class="fas fa-rocket fa-3x mb-3"></i>
                    <h4>Tajribamiz</h4>
                    <p>Bir necha yillik tajriba va izlanishlar. 2022-yil 23-sentyabr (va 2021-yil norasmiy tashkil etilgan).</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="text-white text-center p-3">
                    <i class="fas fa-users fa-3x mb-3"></i>
                    <h4>Natijalarimiz</h4>
                    <p>2000+ bitiruvchi, 90% ish bilan ta'minlangan (o'quv markaz yordamida).</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="text-white text-center p-3">
                    <i class="fas fa-code fa-3x mb-3"></i>
                    <h4>Maqsadimiz</h4>
                    <p>Yangi texnologiya asosida innovatsion yechimlar yaratib, yoshlarni ilmga va axborot texnologiyalarga qiziqtirish hamda global bozorga chiqa oladigan kadrlar yetkazishib berish.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 2. Наша команда -->
<section class="team-section">
    <div class="container-fluid">
        <h2 class="section-title">Bizning jamoa</h2>
        <div class="row">
            <!-- Mustafo Qodirov - team1.jpg -->
            <div class="col-lg-4 col-md-6">
                <div class="team-card">
                    <img src="{{ asset('images/team1.jpg') }}" 
                         alt="Mustafo Qodirov" 
                         class="team-image">
                    <div class="team-info">
                        <h3 class="team-name">Mustafo Qodirov</h3>
                        <p class="team-position">CEO</p>
                        <div class="social-links">
                            <a href="https://t.me/itechacademy_uz"><i class="fab fa-telegram"></i></a>
                            <a href="https://www.instagram.com/itechacademy_uz?igsh=aWZ5anU4ZWN2MjI5"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Azamatjon Ergashev - team6.jpg -->
            <div class="col-lg-4 col-md-6">
                <div class="team-card">
                    <img src="{{ asset('images/team6.jpg') }}" 
                         alt="Azamatjon Ergashev" 
                         class="team-image">
                    <div class="team-info">
                        <h3 class="team-name">Azamatjon Ergashev</h3>
                        <p class="team-position">Operation Director</p>
                        <div class="social-links">
                           <a href="https://t.me/itechacademy_uz"><i class="fab fa-telegram"></i></a>
                           <a href="https://www.instagram.com/itechacademy_uz?igsh=aWZ5anU4ZWN2MjI5"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Gayratjon Mirzamahmudov - team7.jpg -->
            <div class="col-lg-4 col-md-6">
                <div class="team-card">
                    <img src="{{ asset('images/team7.jpg') }}" 
                         alt="Gayratjon Mirzamahmudov" 
                         class="team-image">
                    <div class="team-info">
                        <h3 class="team-name">Gayratjon Mirzamahmudov</h3>
                        <p class="team-position">Frontend Engineer</p>
                        <div class="social-links">
                            <a href="https://t.me/itechacademy_uz"><i class="fab fa-telegram"></i></a>
                            <a href="https://www.instagram.com/itechacademy_uz?igsh=aWZ5anU4ZWN2MjI5"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Eljahon Normominov - team8.jpg -->
            <div class="col-lg-4 col-md-6">
                <div class="team-card">
                    <img src="{{ asset('images/team8.jpg') }}" 
                         alt="Eljahon Normominov" 
                         class="team-image">
                    <div class="team-info">
                        <h3 class="team-name">Eljahon Normominov</h3>
                        <p class="team-position">Software Engineer</p>
                        <div class="social-links">
                            <a href="https://t.me/itechacademy_uz"><i class="fab fa-telegram"></i></a>
                            <a href="https://www.instagram.com/itechacademy_uz?igsh=aWZ5anU4ZWN2MjI5"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Voldia Tadjimuratova - team3.jpg -->
            <div class="col-lg-4 col-md-6">
                <div class="team-card">
                    <img src="{{ asset('images/team3.jpg') }}" 
                         alt="Voldia Tadjimuratova" 
                         class="team-image">
                    <div class="team-info">
                        <h3 class="team-name">Voldia Tadjimuratova</h3>
                        <p class="team-position">Finance Manager</p>
                        <div class="social-links">
                            <a href="https://t.me/itechacademy_uz"><i class="fab fa-telegram"></i></a>
                            <a href="https://www.instagram.com/itechacademy_uz?igsh=aWZ5anU4ZWN2MjI5"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Biloliddin Madiyorov - team4.jpg -->
            <div class="col-lg-4 col-md-6">
                <div class="team-card">
                    <img src="{{ asset('images/team4.jpg') }}" 
                         alt="Biloliddin Madiyorov" 
                         class="team-image">
                    <div class="team-info">
                        <h3 class="team-name">Biloliddin Madiyorov</h3>
                        <p class="team-position">Backend Engineer</p>
                        <div class="social-links">
                            <a href="https://t.me/itechacademy_uz"><i class="fab fa-telegram"></i></a>
                            <a href="https://www.instagram.com/itechacademy_uz?igsh=aWZ5anU4ZWN2MjI5"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ========== 3. QUIZ SECTION ========== -->
<section class="section bg-light">
    <div class="container">
        <h2 class="section-title">IT bilimingizni sinab ko'ring</h2>
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="quiz-card" id="quizStart">
                    <div class="text-center">
                        <i class="fas fa-brain fa-5x mb-4" style="color: var(--primary);"></i>
                        <h3>Qiziqarli test</h3>
                        <p>3 ta savol orqali bilimingizni aniqlang</p>
                        <button class="btn btn-primary btn-lg px-5" onclick="startQuiz()">Testni boshlash <i class="fas fa-arrow-right"></i></button>
                    </div>
                </div>
                <div class="quiz-card" id="quizContent" style="display: none;">
                    <div id="quizQuestions"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 4. MASTER CLASSES - Yangilangan tugma bilan -->
<section class="masterclass-section section">
    <div class="container">
        <h2 class="section-title text-center mb-5">Master class</h2>
        <div class="row g-4">
            @forelse($masterClasses as $mc)
                <div class="col-lg-4 col-md-6">
                    <div class="masterclass-card h-100 shadow-sm">
                        <div class="masterclass-image-wrapper position-relative">
                            <div class="date-badge position-absolute top-0 end-0 bg-white rounded-3 px-3 py-2 m-2 shadow-sm">
                                <i class="far fa-calendar-alt text-primary"></i> {{ $mc->event_date ?? $mc->date ?? 'Sana belgilanmagan' }}
                            </div>
                            <img src="{{ asset('storage/' . ($mc->image ?? 'default-masterclass.jpg')) }}" 
                                 alt="{{ $mc->title }}" 
                                 class="masterclass-img w-100"
                                 style="height: 220px; object-fit: cover;"
                                 onerror="this.src='https://via.placeholder.com/400x200?text=ITech+Masterclass'">
                        </div>
                        
                        <div class="masterclass-body p-4 d-flex flex-column">
                            <h3 class="masterclass-title h5 fw-bold mb-3" style="color: #333;">{{ $mc->title }}</h3>
                            <p class="masterclass-description text-muted mb-4" style="font-size: 0.9rem; line-height: 1.6;">
                                {{ Str::limit($mc->description ?? 'Masterclass haqida batafsil ma\'lumot tez kunda...', 100) }}
                            </p>
                            
                            <div class="mt-auto">
                                <!-- O'ZGARTIRILGAN: "Ройхатдан отищ" -> "Мастер классга ёзилиш" -->
                                <button type="button" class="btn-masterclass-register" onclick="openMasterclassModal({{ $mc->id }})">
                                    <i class="fas fa-pen-alt me-2"></i> Мастер классга ёзилиш
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <img src="https://cdn-icons-png.flaticon.com/512/7486/7486744.png" width="80" class="opacity-50 mb-3">
                    <p class="text-muted fs-5">Hozircha yangi master-klasslar yo'q.</p>
                </div>
            @endforelse
        </div>
        
        <div class="d-flex justify-content-center mt-5">
            {{ $masterClasses->links() }}
        </div>
    </div>
</section>

<!-- ========== MASTERCLASS REGISTRATION MODAL (YANGI) ========== -->
<div class="modal fade" id="masterclassRegisterModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header-custom d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="fas fa-chalkboard-teacher me-2"></i> Masterclassga ro'yxatdan o'tish</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <!-- Masterclass haqida qisqacha ma'lumot -->
                <div id="masterclassDetailInfo" class="mb-4"></div>
                
                <hr>
                
                <!-- Ro'yxatdan o'tish formasi -->
                <h5 class="mb-3"><i class="fas fa-user-plus text-primary me-2"></i> Shaxsiy ma'lumotlar</h5>
                <form id="masterclassRegForm">
                    @csrf
                    <input type="hidden" name="masterclass_id" id="register_masterclass_id">
                    
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Ismingiz *</label>
                        <input type="text" name="name" id="register_name" class="form-control" 
                               placeholder="To'liq ismingiz" required>
                        <small class="text-muted">Ismingizni o'zgartirishingiz mumkin</small>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Telefon raqam *</label>
                        <input type="tel" name="phone" id="register_phone" class="form-control" 
                               placeholder="+998 __ ___ __ __" required>
                        <small class="text-muted">Iltimos, faol telefon raqamingizni kiriting</small>
                    </div>
                    
                    
                    <button type="button" id="masterclassRegFormSubmit" class="btn btn-primary w-100 btn-submit-custom text-white py-3">
                        <i class="fas fa-paper-plane me-2"></i> Yuborish
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- 5. Форма обратной связи -->
<div id="contact" class="form-1 section bg-light">
    <div class="container">
        <h2 class="section-title">Fikringizni qoldiring</h2>
        <div class="row align-items-center">
            <div class="col-lg-6">
                @if(file_exists(public_path('images/Fikr-mulohaza.png')))
                    <img class="img-fluid" src="{{ asset('images/Fikr-mulohaza.png') }}" alt="alternative">
                @else
                    <div class="text-center p-5 bg-white rounded shadow-sm">
                        <i class="fas fa-comments fa-5x" style="color: #4a90e2;"></i>
                        <p class="mt-3">Fikr-mulohazalaringiz biz uchun muhim</p>
                    </div>
                @endif
            </div>
            <div class="col-lg-6">
                <div class="text-container">
                    <div id="feedbackAlert" style="display: none;" class="alert"></div>
                    
                    <form id="contactForm">
                        @csrf
                        <div class="mb-3">
                            <input type="text" name="name" id="name" class="form-control form-control-custom" 
                                   placeholder="Ismingiz" 
                                   @if(auth()->check()) value="{{ auth()->user()->name }}" @endif
                                   required>
                        </div>
                        <div class="mb-3">
                            <input type="email" name="email" id="email" class="form-control form-control-custom" 
                                   placeholder="Email manzilingiz"
                                   @if(auth()->check()) value="{{ auth()->user()->email }}" @endif
                                   required>
                        </div>
                        <div class="mb-3">
                            <textarea name="message" id="message" class="form-control form-control-custom" 
                                      placeholder="Fikringiz yoki takliflaringiz" required rows="5"></textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" id="submitBtn" class="btn-submit">
                                <i class="fas fa-paper-plane me-2"></i> Yuborish
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection