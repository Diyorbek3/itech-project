@extends('layouts.app')

@section('styles')
<style>
    /* ========== ROOT & GLOBAL STYLES ========== */
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

    /* ========== TEAM CARDS ========== */
    .team-card {
        background: white;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        transition: all 0.4s ease;
        margin-bottom: 30px;
    }

    .team-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
    }

    .team-image-wrapper {
        position: relative;
        overflow: hidden;
        height: 350px;
    }

    .team-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .team-card:hover .team-image {
        transform: scale(1.1);
    }

    .team-social {
        position: absolute;
        bottom: -50px;
        left: 0;
        right: 0;
        text-align: center;
        padding: 15px;
        background: linear-gradient(to top, rgba(0,0,0,0.8), transparent);
        transition: bottom 0.3s ease;
    }

    .team-card:hover .team-social {
        bottom: 0;
    }

    .team-social a {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 36px;
        height: 36px;
        background: white;
        border-radius: 50%;
        margin: 0 5px;
        color: var(--primary);
        transition: all 0.3s ease;
    }

    .team-social a:hover {
        background: var(--gradient-horizontal);
        color: white;
        transform: translateY(-3px);
    }

    .team-info {
        padding: 20px;
        text-align: center;
    }

    .team-name {
        font-size: 1.2rem;
        font-weight: 700;
        margin-bottom: 5px;
    }

    .team-position {
        color: #6c757d;
        font-size: 0.85rem;
        margin-bottom: 0;
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
        background: #f8f9fa;
        padding: 12px 20px;
        border-radius: 12px;
        margin-bottom: 12px;
        cursor: pointer;
        transition: all 0.2s ease;
        border: 2px solid transparent;
    }

    .quiz-option:hover {
        background: #e9ecef;
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

    .btn-masterclass {
        background: var(--gradient-horizontal);
        color: white;
        padding: 10px 25px;
        border-radius: 30px;
        border: none;
        font-weight: 600;
        transition: all 0.3s ease;
        width: 100%;
    }

    .btn-masterclass:hover {
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

    /* ========== MODAL STYLES ========== */
    .modal-content {
        border-radius: 20px;
        overflow: hidden;
    }

    .modal-header-custom {
        background: var(--gradient);
        color: white;
        padding: 20px;
    }
</style>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    // ========== FEEDBACK FORM SUBMISSION ==========
    $('#contactForm').on('submit', function(e) {
        e.preventDefault();
        const $btn = $('#submitBtn');
        const $alert = $('#feedbackAlert');
        
        $btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Yuborilmoqda...');
        $alert.hide().removeClass('alert-success alert-danger');
        
        $.ajax({
            url: '{{ route("feedback.store") }}',
            type: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                $alert.removeClass('alert-danger').addClass('alert-success')
                    .html('<i class="fas fa-check-circle"></i> ' + response.message).show();
                @if(!auth()->check())
                    $('#contactForm')[0].reset();
                @else
                    $('#message').val('');
                @endif
            },
            error: function(xhr) {
                let errorMsg = 'Xatolik yuz berdi.';
                if (xhr.status === 422 && xhr.responseJSON.errors) {
                    errorMsg = '<ul class="mb-0">';
                    $.each(xhr.responseJSON.errors, function(k, v) {
                        errorMsg += '<li>' + v[0] + '</li>';
                    });
                    errorMsg += '</ul>';
                } else if (xhr.responseJSON?.message) {
                    errorMsg = xhr.responseJSON.message;
                }
                $alert.removeClass('alert-success').addClass('alert-danger')
                    .html('<i class="fas fa-exclamation-circle"></i> ' + errorMsg).show();
            },
            complete: function() {
                $btn.prop('disabled', false).html('<i class="fas fa-paper-plane"></i> Fikr qoldirish');
                setTimeout(() => $alert.fadeOut(), 5000);
            }
        });
    });

    // ========== QUIZ SYSTEM ==========
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
        $('#quizStart').fadeOut(() => {
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
                    <div class="quiz-option" data-value="${idx}">
                        <input type="radio" name="quizOption" value="${idx}" id="opt${idx}" ${isChecked ? 'checked' : ''}>
                        <label for="opt${idx}" style="cursor:pointer; width:90%;">${opt}</label>
                    </div>
                `;
            });
            html += `<button class="btn btn-primary mt-4 px-5" onclick="nextQuestion()">Keyingi savol <i class="fas fa-arrow-right"></i></button>`;
            $('#quizQuestions').html(html);
            
            $('.quiz-option').click(function() {
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
            alert("Iltimos, javobni tanlang!");
            return;
        }
        if (userAnswers[currentQuestion] === quizQuestions[currentQuestion].correct) score++;
        currentQuestion++;
        renderQuestion();
    };

    function showResults() {
        const percent = (score / quizQuestions.length) * 100;
        let message = '';
        if (percent >= 80) message = "Ajoyib! Siz haqiqiy IT mutaxassissiz! 🎉";
        else if (percent >= 60) message = "Yaxshi natija! O'rganishni davom eting! 👍";
        else message = "Yaxshi, ammo o'sish uchun joy bor. ITech Academy kurslariga marhamat! 💪";
        
        $('#quizQuestions').html(`
            <div class="text-center py-4">
                <i class="fas fa-chart-line fa-4x text-primary mb-3"></i>
                <h3>Natijangiz: ${score} / ${quizQuestions.length}</h3>
                <p class="lead">${message}</p>
                <button class="btn btn-success btn-lg mt-3" onclick="startQuiz()">
                    <i class="fas fa-redo-alt"></i> Testni qayta ishlash
                </button>
            </div>
        `);
    }

    // ========== MASTERCLASS MODAL ==========
    window.showMasterclassModal = function(id) {
        $('#masterclass_id').val(id);
        $('#masterclassInfo').html(`
            <div class="text-center py-4">
                <div class="spinner-border text-primary"></div>
                <p class="mt-2">Ma'lumot yuklanmoqda...</p>
            </div>
        `);
        
        $.ajax({
            url: '/masterclass/' + id,
            type: 'GET',
            success: function(data) {
                $('#masterclassInfo').html(`
                    <div class="row">
                        <div class="col-md-5">
                            <img src="${data.image || '/images/default-masterclass.jpg'}" class="img-fluid rounded" alt="${data.title}">
                        </div>
                        <div class="col-md-7">
                            <h4>${data.title}</h4>
                            <p><i class="far fa-calendar-alt text-primary"></i> ${data.date}</p>
                            <p><i class="far fa-clock text-primary"></i> ${data.time}</p>
                            <p><i class="fas fa-map-marker-alt text-primary"></i> ${data.location || 'Online / Toshkent'}</p>
                            <p>${data.description || 'Masterclass haqida batafsil ma\'lumot.'}</p>
                        </div>
                    </div>
                `);
            },
            error: function() {
                $('#masterclassInfo').html('<div class="alert alert-danger">Ma\'lumot yuklanmadi. Iltimos, keyinroq urinib ko\'ring.</div>');
            }
        });
        
        $('#masterclassModal').modal('show');
    };

    // Masterclass registration
    $('#masterclassRegisterForm').on('submit', function(e) {
        e.preventDefault();
        const $btn = $('#registerSubmitBtn');
        $btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Yuborilmoqda...');
        
        $.ajax({
            url: '{{ route("masterclass.register") }}',
            type: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                $('#masterclassModal').modal('hide');
                $('#successMessage').text(response.message || "Siz muvaffaqiyatli ro'yxatdan o'tdingiz!");
                $('#reminderDate').text($('#masterclass_id').val() == 1 ? "19 aprel 2024, 16:00" : 
                                        ($('#masterclass_id').val() == 2 ? "28 avgust 2025, 18:00" : "10 iyun 2025, 16:00"));
                $('#successModal').modal('show');
                $('#masterclassRegisterForm')[0].reset();
            },
            error: function(xhr) {
                alert(xhr.responseJSON?.message || "Ro'yxatdan o'tishda xatolik!");
            },
            complete: function() {
                $btn.prop('disabled', false).html('<i class="fas fa-paper-plane"></i> Ro\'yxatdan o\'tish');
            }
        });
    });
});
</script>
@endsection

@section('content')
<!-- ===== ========== 1. TARIX QISMI (QISQA MATNLI) ========== -->
<section  class="section bg-gradient">
    <div class="container">
        <h2 class="section-title">ITech Academy haqida</h2>
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="text-white text-center p-3">
                    <i class="fas fa-rocket fa-3x mb-3"></i>
                    <h4>Tajribamiz</h4>
                    <p> Bir necha yillik tajriba va izlanishlar. 2022-yil 23-sentyabr (va 2021-yil norasmiy tashkil etilgan).</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="text-white text-center p-3">
                    <i class="fas fa-users fa-3x mb-3"></i>
                    <h4>Natijalarimiz</h4>
                    <p>2000+ bitiruvchi, 90% ish bilan ta'minlangan(o'quv markaz yordamida). </p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="text-white text-center p-3">
                    <i class="fas fa-code fa-3x mb-3"></i>
                    <h4>Maqsadimiz</h4>
                    <p>Yangi texnologiya asosida innovatsion yechimlar yaratib, yoshlarni ilmga va axborot texnologiyalarga qiziqtirish hamda global bozorga chiqa oladigan kadrlar yetkazishib berish  .</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ========== 2. TEAM SECTION ========== -->
<section class="section bg-light">
    <div class="container">
        <h2 class="section-title">Bizning jamoa</h2>
        <div class="row">
            @php
                $team = [
                    ['name' => 'Mustafo Qodirov', 'position' => 'CEO & Asoschi', 'image' => 'team1.jpg'],
                    ['name' => 'Azamatjon Ergashev', 'position' => 'Operatsion Direktor', 'image' => 'team6.jpg'],
                    ['name' => 'Gayratjon Mirzamahmudov', 'position' => 'Frontend Muhandis', 'image' => 'team7.jpg'],
                    ['name' => 'Eljahon Normominov', 'position' => 'Software Muhandis', 'image' => 'team8.jpg'],
                    ['name' => 'Voldia Tadjimuratova', 'position' => 'Moliya bo\'limi rahbari', 'image' => 'team3.jpg'],
                    ['name' => 'Biloliddin Madiyorov', 'position' => 'Backend Muhandis', 'image' => 'team4.jpg'],
                ];
            @endphp
            @foreach($team as $member)
            <div class="col-lg-4 col-md-6">
                <div class="team-card">
                    <div class="team-image-wrapper">
                        <img src="{{ asset('images/'.$member['image']) }}" alt="{{ $member['name'] }}" class="team-image" 
                             onerror="this.src='https://placehold.co/400x500?text='+encodeURIComponent('{{ $member['name'] }}')">
                        <div class="team-social">
                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                            <a href="#"><i class="fab fa-instagram"></i></a>
                            <a href="#"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                    <div class="team-info">
                        <h3 class="team-name">{{ $member['name'] }}</h3>
                        <p class="team-position">{{ $member['position'] }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- ========== 3. QUIZ SECTION ========== -->
<section class="section bg-gradient">
    <div class="container">
        <h2 class="section-title">IT bilimingizni sinab ko'ring</h2>
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="quiz-card" id="quizStart">
                    <div class="text-center">
                        <i class="fas fa-brain fa-5x mb-4" style="color: var(--primary);"></i>
                        <h3>Qiziqarli test</h3>
                        <p>{{ count($quizQuestions ?? []) }} ta savol orqali bilimingizni aniqlang</p>
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

<!-- ========== 4. MASTERCLASS SECTION ========== -->
<section class="section bg-light">
    <div class="container">
        <h2 class="section-title">Master-klasslar</h2>
        <div class="row">
            @php
                $masterclasses = [
                    ['id' => 1, 'title' => 'Veb-dasturlash: 0 dan boshlab', 'date' => '19 aprel 2024', 'time' => '16:00', 'image' => 'class1.jpg', 'desc' => 'Veb-dasturlash asoslari va zamonaviy texnologiyalar'],
                    ['id' => 2, 'title' => 'Telegram bot yaratish', 'date' => '28 avgust 2025', 'time' => '18:00', 'image' => 'class2.jpg', 'desc' => 'Python va Aiogram yordamida botlar yasash'],
                    ['id' => 3, 'title' => 'Mobilografiya: san\'at asari', 'date' => '10 iyun 2025', 'time' => '16:00', 'image' => 'class3.jpg', 'desc' => 'Mobil suratga olish va rasm tahrirlash sirlari'],
                ];
            @endphp
            @foreach($masterclasses as $mc)
            <div class="col-lg-4 col-md-6">
                <div class="masterclass-card">
                    <img src="{{ asset('images/'.$mc['image']) }}" alt="{{ $mc['title'] }}" class="masterclass-img"
                         onerror="this.src='https://placehold.co/400x220?text=Masterclass'">
                    <div class="masterclass-body">
                        <h3 class="masterclass-title">{{ $mc['title'] }}</h3>
                        <div class="masterclass-date">
                            <i class="far fa-calendar-alt"></i> {{ $mc['date'] }} | <i class="far fa-clock"></i> {{ $mc['time'] }}
                        </div>
                        <p class="text-muted">{{ $mc['desc'] }}</p>
                        <button class="btn-masterclass" onclick="showMasterclassModal({{ $mc['id'] }})">
                            <i class="fas fa-ticket-alt"></i> Ro'yxatdan o'tish
                        </button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- ========== 5. FEEDBACK SECTION ========== -->
<section class="section" id="contact">
    <div class="container">
        <h2 class="section-title">Fikr-mulohazalar</h2>
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="feedback-form">
                    @if(auth()->check())
                        <div class="alert alert-info mb-4">
                            <i class="fas fa-user-check"></i> Siz <strong>{{ auth()->user()->name }}</strong> sifatida fikr qoldiryapsiz.
                        </div>
                    @endif
                    <div id="feedbackAlert" style="display: none;" class="alert mb-4"></div>
                    <form id="contactForm">
                        @csrf
                        <input type="text" name="name" class="form-control-custom" placeholder="Ismingiz" 
                               value="{{ auth()->check() ? auth()->user()->name : '' }}" {{ auth()->check() ? 'readonly' : '' }} required>
                        <input type="email" name="email" class="form-control-custom" placeholder="Email manzilingiz"
                               value="{{ auth()->check() ? auth()->user()->email : '' }}" {{ auth()->check() ? 'readonly' : '' }} required>
                        <textarea name="message" class="form-control-custom" rows="5" placeholder="Sizning fikringiz..." required></textarea>
                        <button type="submit" id="submitBtn" class="btn-submit">
                            <i class="fas fa-paper-plane"></i> Fikr qoldirish
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ========== MODALS ========== -->
<div class="modal fade" id="masterclassModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header-custom">
                <h5 class="modal-title"><i class="fas fa-chalkboard-user"></i> Masterclass haqida</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div id="masterclassInfo"></div>
                <hr>
                <h5><i class="fas fa-user-plus"></i> Ro'yxatdan o'tish</h5>
                <form id="masterclassRegisterForm">
                    @csrf
                    <input type="hidden" name="masterclass_id" id="masterclass_id">
                    <input type="text" name="full_name" class="form-control mb-3" placeholder="To'liq ismingiz" 
                           value="{{ auth()->check() ? auth()->user()->name : '' }}" required>
                    <input type="email" name="email" class="form-control mb-3" placeholder="Email" 
                           value="{{ auth()->check() ? auth()->user()->email : '' }}" required>
                    <input type="tel" name="phone" class="form-control mb-3" placeholder="Telefon raqam (+998 xx xxx xx xx)" required>
                    <textarea name="questions" class="form-control mb-3" rows="2" placeholder="Savollaringiz..."></textarea>
                    <button type="submit" id="registerSubmitBtn" class="btn-masterclass w-100">Ro'yxatdan o'tish</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="successModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title"><i class="fas fa-check-circle"></i> Tabriklaymiz!</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center">
                <i class="fas fa-envelope-open-text fa-5x text-success mb-3"></i>
                <h4>Muvaffaqiyatli ro'yxatdan o'tdingiz!</h4>
                <p id="successMessage">Siz bilan tez orada bog'lanamiz.</p>
                <hr>
                <p><i class="far fa-calendar-alt text-primary"></i> <span id="reminderDate"></span></p>
            </div>
        </div>
    </div>
</div>
@endsection