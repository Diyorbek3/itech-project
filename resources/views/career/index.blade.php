@extends('layouts.app')

@section('styles')
<style>
    /* Общие стили */
    .section {
        padding: 80px 0;
        position: relative;
    }
    
    .section-title {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 3rem;
        text-align: center;
        position: relative;
    }
    
    .section-title:after {
        content: '';
        position: absolute;
        bottom: -15px;
        left: 50%;
        transform: translateX(-50%);
        width: 80px;
        height: 4px;
        background: linear-gradient(90deg, #ced4db, #9b59b6);
        border-radius: 2px;
    }
    
    /* История компании */
    .history-section {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }
    
    .timeline {
        position: relative;
        padding: 20px 0;
    }
    
    .timeline-item {
        margin-bottom: 40px;
        position: relative;
        padding-left: 30px;
    }
    
    .timeline-year {
        font-size: 1.5rem;
        font-weight: 700;
        color: #ffd700;
        margin-bottom: 10px;
    }
    
    .timeline-content {
        background: rgba(255,255,255,0.1);
        padding: 20px;
        border-radius: 10px;
        backdrop-filter: blur(10px);
    }
    
    /* Команда */
    .team-section {
        background: #f8f9fa;
    }
    
    .team-card {
        background: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        transition: transform 0.3s ease;
        margin-bottom: 30px;
    }
    
    .team-card:hover {
        transform: translateY(-10px);
    }
    
    .team-image {
        width: 100%;
        height: 350px;
        object-fit: cover;
        object-position: top;
    }
    
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
    
    .social-links a {
        display: inline-block;
        width: 35px;
        height: 35px;
        line-height: 35px;
        border-radius: 50%;
        background: #f0f0f0;
        color: #4a90e2;
        transition: all 0.3s ease;
        margin: 0 5px;
    }
    
    .social-links a:hover {
        background: linear-gradient(90deg, #4a90e2, #9b59b6);
        color: white;
        transform: translateY(-3px);
    }
    
    /* Quiz секция */
    .quiz-section {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }
    
    .quiz-card {
        background: white;
        border-radius: 15px;
        padding: 30px;
        color: #333;
        box-shadow: 0 10px 30px rgba(0,0,0,0.2);
    }
    
    .quiz-question {
        font-size: 1.3rem;
        margin-bottom: 20px;
        font-weight: 600;
    }
    
    .quiz-option {
        margin-bottom: 10px;
    }
    
    .quiz-option input {
        margin-right: 10px;
    }
    
    /* Мастер класс */
    .masterclass-section {
        background: #f8f9fa;
    }
    
    .masterclass-card {
        background: white;
        border-radius: 15px;
        padding: 30px;
        text-align: center;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        transition: transform 0.3s ease;
        height: 100%;
    }
    
    .masterclass-card:hover {
        transform: translateY(-5px);
    }
    
    .masterclass-image {
        width: 100%;
        height: 200px;
        object-fit: cover;
        border-radius: 10px;
        margin-bottom: 20px;
    }
    
    .masterclass-icon {
        width: 80px;
        height: 80px;
        margin-bottom: 20px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 50%;
        color: white;
    }
    
    .masterclass-title {
        font-size: 1.5rem;
        font-weight: 600;
        margin-bottom: 15px;
    }
    
    .masterclass-date {
        color: #4a90e2;
        font-weight: 600;
        margin-bottom: 10px;
    }
    
    .masterclass-description {
        color: #666;
        margin-bottom: 20px;
    }
    
    .btn-masterclass {
        background: linear-gradient(90deg, #4a90e2, #9b59b6);
        color: white;
        padding: 10px 30px;
        border-radius: 25px;
        border: none;
        margin-top: 15px;
        transition: transform 0.3s ease;
    }
    
    .btn-masterclass:hover {
        transform: scale(1.05);
        color: white;
    }
    
    /* Feedback form */
    .form-1 {
        padding: 80px 0;
        background: white;
    }
    
    .form-control-input,
    .form-control-textarea {
        width: 100%;
        padding: 12px 20px;
        margin-bottom: 20px;
        border: 1px solid #ddd;
        border-radius: 8px;
        transition: all 0.3s ease;
    }
    
    .form-control-input:focus,
    .form-control-textarea:focus {
        border-color: #4a90e2;
        outline: none;
        box-shadow: 0 0 5px rgba(74, 144, 226, 0.3);
    }
    
    .form-control-submit-button {
        width: 100%;
        padding: 12px;
        background: linear-gradient(90deg, #4a90e2, #9b59b6);
        color: white;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        transition: transform 0.3s ease;
    }
    
    .form-control-submit-button:hover {
        transform: translateY(-2px);
    }
    
    /* Пагинация */
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
    
    /* Анимации */
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
        animation: fadeInUp 0.6s ease-out;
    }
</style>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    // Feedback form submission
    $('#contactForm').on('submit', function(e) {
        e.preventDefault();
        
        $('#submitBtn').prop('disabled', true).text('Отправка...');
        $('#feedbackAlert').hide().removeClass('alert-success alert-danger');
        
        $.ajax({
            url: '{{ route("feedback.store") }}',
            type: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                if (response.success) {
                    let message = response.message;
                    
                    $('#feedbackAlert')
                        .removeClass('alert-danger')
                        .addClass('alert-success')
                        .html('<i class="fas fa-check-circle"></i> ' + message)
                        .show();
                    
                    // Очищаем форму только для гостей
                    @if(!auth()->check())
                        $('#contactForm')[0].reset();
                    @else
                        $('#message').val('');
                    @endif
                    
                    // Дополнительное уведомление о статусе отправки в Telegram
                    if (!response.telegram_sent && response.telegram_error) {
                        console.log('Telegram error:', response.telegram_error);
                    }
                } else {
                    let errorMessage = response.message || 'Произошла ошибка';
                    
                    if (response.errors) {
                        errorMessage = '<ul class="mb-0">';
                        $.each(response.errors, function(key, value) {
                            errorMessage += '<li>' + value[0] + '</li>';
                        });
                        errorMessage += '</ul>';
                    }
                    
                    $('#feedbackAlert')
                        .removeClass('alert-success')
                        .addClass('alert-danger')
                        .html('<i class="fas fa-exclamation-circle"></i> ' + errorMessage)
                        .show();
                }
            },
            error: function(xhr) {
                let errorMessage = 'Произошла ошибка при отправке отзыва';
                
                if (xhr.status === 422 && xhr.responseJSON.errors) {
                    let errors = xhr.responseJSON.errors;
                    errorMessage = '<ul class="mb-0">';
                    $.each(errors, function(key, value) {
                        errorMessage += '<li>' + value[0] + '</li>';
                    });
                    errorMessage += '</ul>';
                } else if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMessage = xhr.responseJSON.message;
                }
                
                $('#feedbackAlert')
                    .removeClass('alert-success')
                    .addClass('alert-danger')
                    .html('<i class="fas fa-exclamation-circle"></i> ' + errorMessage)
                    .show();
            },
            complete: function() {
                $('#submitBtn').prop('disabled', false).text('Отправить отзыв');
                
                setTimeout(function() {
                    $('#feedbackAlert').fadeOut();
                }, 5000);
            }
        });
    });
});
// Quiz functionality
let currentQuestion = 0;
let score = 0;

const quizQuestions = [
    {
        question: "Какой язык программирования считается самым популярным для веб-разработки?",
        options: ["Python", "Java", "JavaScript", "C++"],
        correct: 2
    },
    {
        question: "Что означает аббревиатура HTML?",
        options: [
            "Hyper Text Markup Language",
            "High Tech Modern Language", 
            "Hyper Transfer Markup Language",
            "Home Tool Markup Language"
        ],
        correct: 0
    },
    {
        question: "Какой фреймворк используется для разработки на Python?",
        options: ["React", "Angular", "Django", "Vue.js"],
        correct: 2
    }
];

function startQuiz() {
    currentQuestion = 0;
    score = 0;
    showQuestion();
    $('#quizStart').hide();
    $('#quizContent').show();
}

function showQuestion() {
    if (currentQuestion < quizQuestions.length) {
        const q = quizQuestions[currentQuestion];
        let html = `
            <div class="quiz-question">${currentQuestion + 1}. ${q.question}</div>
            <div class="quiz-options">
        `;
        
        q.options.forEach((option, index) => {
            html += `
                <div class="quiz-option">
                    <input type="radio" name="quizOption" value="${index}" id="option${index}">
                    <label for="option${index}">${option}</label>
                </div>
            `;
        });
        
        html += `
            </div>
            <button class="btn btn-primary mt-3" onclick="nextQuestion()">Следующий вопрос</button>
        `;
        
        $('#quizQuestions').html(html);
    } else {
        showResults();
    }
}

function nextQuestion() {
    const selected = $('input[name="quizOption"]:checked').val();
    if (selected === undefined) {
        alert('Пожалуйста, выберите ответ');
        return;
    }
    
    if (parseInt(selected) === quizQuestions[currentQuestion].correct) {
        score++;
    }
    
    currentQuestion++;
    showQuestion();
}

function showResults() {
    const percentage = (score / quizQuestions.length) * 100;
    let message = '';
    
    if (percentage >= 80) {
        message = 'Отлично! Вы настоящий IT-специалист! 🎉';
    } else if (percentage >= 60) {
        message = 'Хороший результат! Продолжайте учиться! 👍';
    } else {
        message = 'Неплохо, но есть куда расти. Приходите на курсы ITech Academy! 💪';
    }
    
    $('#quizQuestions').html(`
        <div class="text-center">
            <h4>Ваш результат: ${score} из ${quizQuestions.length}</h4>
            <p>${message}</p>
            <button class="btn btn-success" onclick="startQuiz()">Пройти тест заново</button>
        </div>
    `);
}

// Master class registration
function registerMasterclass(masterclassId) {
    alert('Функция регистрации на мастер-класс будет доступна в ближайшее время!');
}
</script>
@endsection

@section('content')
<!-- 1. История ITech Academy -->
<section class="history-section section">
    <div class="container">
        <h2 class="section-title">Biz haqimizda</h2>
        <div class="timeline">
            <div class="row">
                <div class="col-md-6">
                    <div class="timeline-item">
                        <div class="timeline-year">2015</div>
                        <div class="timeline-content">
                            <h4>Boshlanish nuqtasi ITech Academy</h4>
                            <p>ITech Academy kichik jamoa bilan katta maqsad sari ilk qadamini tashladi.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="timeline-item">
                        <div class="timeline-year">2017</div>
                        <div class="timeline-content">
                            <h4>Tez rivojlanish</h4>
                            <p>Yangi kurslar ochilib, talabalar soni bir necha barobar oshdi.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="timeline-item">
                        <div class="timeline-year">2019</div>
                        <div class="timeline-content">
                            <h4>Ishga yo‘naltirish</h4>
                            <p>Talabalarni real loyihalar va ish bilan bog‘lash tizimi yo‘lga qo‘yildi.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="timeline-item">
                        <div class="timeline-year">2024</div>
                        <div class="timeline-content">
                            <h4>Natija va ishonch</h4>
                            <p>2000+ bitiruvchi va yuzlab muvaffaqiyatli karyeralar.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 2. Наша команда -->
<section class="team-section section">
    <div class="container">
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
                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                            <a href="#"><i class="fab fa-instagram"></i></a>
                            <a href="#"><i class="fab fa-linkedin-in"></i></a>
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
                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                            <a href="#"><i class="fab fa-instagram"></i></a>
                            <a href="#"><i class="fab fa-linkedin-in"></i></a>
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
                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                            <a href="#"><i class="fab fa-instagram"></i></a>
                            <a href="#"><i class="fab fa-linkedin-in"></i></a>
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
                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                            <a href="#"><i class="fab fa-instagram"></i></a>
                            <a href="#"><i class="fab fa-linkedin-in"></i></a>
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
                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                            <a href="#"><i class="fab fa-instagram"></i></a>
                            <a href="#"><i class="fab fa-linkedin-in"></i></a>
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
                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                            <a href="#"><i class="fab fa-instagram"></i></a>
                            <a href="#"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>


<<!-- 4. Мастер классы - RASMLAR BILAN -->
<section class="masterclass-section section">
    <div class="container">
        <h2 class="section-title">Master class</h2>
        <div class="row">
            <!-- Master class 1 - class1.jpg -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="masterclass-card">
                    <img src="{{ asset('images/class1.jpg') }}" 
                         alt="Web Development" 
                         class="masterclass-image"
                         onerror="this.src='https://via.placeholder.com/400x200?text=Web+Development'">
                    <h3 class="masterclass-title">Veb-dasturlash noldan boshlab</h3>
                    <p class="masterclass-date">19 aprel 2024 | 16:00</p>
                    <p class="masterclass-description">Veb-dasturlash boyicha savollar.</p>
                    <button class="btn-masterclass" onclick="showMasterclassModal(1)">Ro‘yxatdan o‘tish</button>
                </div>
            </div>

            <!-- Master class 2 - class2.jpg -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="masterclass-card">
                    <img src="{{ asset('images/class2.jpg') }}" 
                         alt="Data Science" 
                         class="masterclass-image"
                         onerror="this.src='https://via.placeholder.com/400x200?text=Data+Science'">
                    <h3 class="masterclass-title">Telegram bot masterclass</h3>
                    <p class="masterclass-date">28 avgust 2025 | 18:00</p>
                    <p class="masterclass-description">Telegram bot haqida savollar</p>
                    <button class="btn-masterclass" onclick="showMasterclassModal(2)">Ro‘yxatdan o‘tish</button>
                </div>
            </div>

            <!-- Master class 3 - class3.jpg -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="masterclass-card">
                    <img src="{{ asset('images/class3.jpg') }}" 
                         alt="Mobile Development" 
                         class="masterclass-image"
                         onerror="this.src='https://via.placeholder.com/400x200?text=Mobile+Development'">
                    <h3 class="masterclass-title">Mobilografiya bilan san'at asari yaratish</h3>
                    <p class="masterclass-date">10 iyun 2025 | 16:00</p>
                    <p class="masterclass-description">Mobilografiya va san'at asari boyicha savollar</p>
                    <button class="btn-masterclass" onclick="showMasterclassModal(3)">Ro‘yxatdan o‘tish</button>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Masterclass Modal -->
<div class="modal fade" id="masterclassModal" tabindex="-1" aria-labelledby="masterclassModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
                <h5 class="modal-title" id="masterclassModalLabel">
                    <i class="fas fa-graduation-cap"></i> Masterclass haqida ma'lumot
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="masterclassInfo">
                    <!-- AJAX orqali ma'lumotlar keladi -->
                    <div class="text-center py-5">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <p class="mt-2">Ma'lumotlar yuklanmoqda...</p>
                    </div>
                </div>
                
                <hr>
                
                <!-- Registratsiya formasi -->
                <h5 class="mt-3 mb-3">
                    <i class="fas fa-user-plus"></i> Ro'yxatdan o'tish
                </h5>
                <form id="masterclassRegisterForm">
                    @csrf
                    <input type="hidden" name="masterclass_id" id="masterclass_id">
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">To'liq ism *</label>
                            <input type="text" name="full_name" id="full_name" class="form-control" 
                                   value="{{ auth()->check() ? auth()->user()->name : '' }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Email *</label>
                            <input type="email" name="email" id="email" class="form-control"
                                   value="{{ auth()->check() ? auth()->user()->email : '' }}" required>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Telefon raqam *</label>
                        <input type="tel" name="phone" id="phone" class="form-control" 
                               placeholder="+998 xx xxx xx xx" required>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Sizning tajribangiz</label>
                        <textarea name="experience" id="experience" class="form-control" rows="2" 
                                  placeholder="IT sohasidagi tajribangiz haqida qisqacha..."></textarea>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Savollaringiz</label>
                        <textarea name="questions" id="questions" class="form-control" rows="2" 
                                  placeholder="Masterclass davomida qiziqtirgan savollaringiz..."></textarea>
                    </div>
                    
                    <button type="submit" class="btn btn-primary w-100" id="registerSubmitBtn">
                        <i class="fas fa-paper-plane"></i> Ro'yxatdan o'tish
                    </button>
                </form>
                
                <div id="registerMessage" class="mt-3" style="display: none;"></div>
            </div>
        </div>
    </div>
</div>

<!-- Success Modal -->
<div class="modal fade" id="successModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title">
                    <i class="fas fa-check-circle"></i> Ro'yxatdan o'tish muvaffaqiyatli!
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <i class="fas fa-envelope-open-text fa-5x text-success mb-3"></i>
                <h4>Rahmat!</h4>
                <p id="successMessage">Siz muvaffaqiyatli ro'yxatdan o'tdingiz. Tez orada siz bilan bog'lanamiz.</p>
                <hr>
                <div class="event-reminder">
                    <i class="fas fa-calendar-alt text-primary"></i>
                    <span id="reminderDate"></span>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-bs-dismiss="modal">Yopish</button>
            </div>
        </div>
    </div>
</div>

<!-- 5. Форма обратной связи -->
<div id="contact" class="form-1 section">
    <div class="container">
        <h2 class="section-title">Fikringizni qoldiring</h2>
        <div class="row align-items-center">
            <div class="col-lg-6">
                @if(file_exists(public_path('images/contact.png')))
                    <img class="img-fluid" src="{{ asset('images/contact.png') }}" alt="alternative">
                @else
                    <div class="text-center p-5 bg-light rounded">
                        <i class="fas fa-comments fa-5x" style="color: #4a90e2;"></i>
                        <p class="mt-3">Поделитесь своим мнением с нами</p>
                    </div>
                @endif
            </div>
            <div class="col-lg-6">
                <div class="text-container">
                    <div id="feedbackAlert" style="display: none;" class="alert"></div>
                    
                    <form id="contactForm">
                        @csrf
                        <div class="form-group">
                            <input type="text" name="name" id="name" class="form-control-input" 
                                   placeholder="Ваше имя" 
                                   @if(auth()->check()) value="{{ auth()->user()->name }}"  @endif
                                   required>
                        </div>
                        <div class="form-group">
                            <input type="email" name="email" id="email" class="form-control-input" 
                                   placeholder="Email"
                                   @if(auth()->check()) value="{{ auth()->user()->email }}"  @endif
                                   required>
                        </div>
                        <div class="form-group">
                            <textarea name="message" id="message" class="form-control-textarea" 
                                      placeholder="Ваш отзыв или предложение" required rows="5"></textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" id="submitBtn" class="form-control-submit-button">
                                Отправить отзыв
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection