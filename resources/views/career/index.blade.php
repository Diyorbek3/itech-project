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
        background: linear-gradient(90deg, #4a90e2, #9b59b6);
        border-radius: 2px;
    }
    
    /* История компании */
    .history-section {
        background: linear-gradient(135deg, #9b8c9d 0%, #764ba2 100%);
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
        height: 300px;
        object-fit: cover;
    }
    
    .team-info {
        padding: 20px;
        text-align: center;
    }
    
    .team-name {
        font-size: 1.2rem;
        font-weight: 600;
        margin-bottom: 5px;
    }
    
    .team-position {
        color: #6c757d;
        margin-bottom: 10px;
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
    
    .quiz-result {
        margin-top: 20px;
        padding: 15px;
        border-radius: 10px;
        display: none;
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
    
    .masterclass-icon {
        width: 80px;
        height: 80px;
        margin-bottom: 20px;
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
    $('#contactForm').on('submit', function(e) {
        e.preventDefault();
        
        // Disable submit button
        $('#submitBtn').prop('disabled', true).text('Отправка...');
        $('#feedbackAlert').hide().removeClass('alert-success alert-danger');
        
        $.ajax({
            url: '{{ route("feedback.store") }}',
            type: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                if (response.success) {
                    $('#feedbackAlert')
                        .removeClass('alert-danger')
                        .addClass('alert-success')
                        .html('<i class="fas fa-check-circle"></i> ' + response.message)
                        .show();
                    
                    // Clear form fields for guests
                    @if(!auth()->check())
                        $('#contactForm')[0].reset();
                    @else
                        $('#message').val('');
                    @endif
                } else {
                    $('#feedbackAlert')
                        .removeClass('alert-success')
                        .addClass('alert-danger')
                        .html('<i class="fas fa-exclamation-circle"></i> ' + response.message)
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
                
                // Auto hide alert after 5 seconds
                setTimeout(function() {
                    $('#feedbackAlert').fadeOut();
                }, 5000);
            }
        });
    });
});
</script>

<script>
    // Quiz functionality
    let currentQuestion = 0;
    let score = 0;
    let userAnswers = [];
    
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
        userAnswers = [];
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
        
        userAnswers.push(parseInt(selected));
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
    
    // Feedback form submission
    $('#contactForm').on('submit', function(e) {
        e.preventDefault();
        
        const formData = {
            name: $('input[name="name"]').val(),
            email: $('input[name="email"]').val(),
            message: $('textarea[name="message"]').val(),
            _token: $('input[name="_token"]').val()
        };
        
        $.ajax({
            url: '/submit-feedback',
            method: 'POST',
            data: formData,
            success: function(response) {
                alert('Спасибо за ваш отзыв!');
                $('#contactForm')[0].reset();
            },
            error: function(xhr) {
                alert('Произошла ошибка. Пожалуйста, попробуйте позже.');
            }
        });
    });
    
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
                            <p>Talabalarni real loyihalar va ish bilan bog‘lash tizimi yo‘lga qo‘yildi..</p>
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

<!-- 2. Наша команда с пагинацией -->

<section class="team-section section">
    <div class="container">
        <h2 class="section-title">Наша команда</h2>
        <div class="row" id="teamContainer">
            @php
            $teamMembers = [
                ['name' => 'Mustafo Qodirov', 'position' => 'CEO', 'image' => 'team1.jpg'],
                ['name' => 'Azamatjon Ergashev', 'position' => 'Operation Director', 'image' => 'team6.jpg'],
                ['name' => 'Gayratjon Mirzamahmudov', 'position' => 'Frontend Engineer', 'image' => 'team7.jpg'],
                ['name' => 'Eljahon Normominov', 'position' => 'Software Engineer', 'image' => 'team8.jpg'],
                ['name' => 'Voldia Tadjimuratova', 'position' => 'Finance Manager', 'image' => 'team3.jpg'],
                ['name' => 'Biloliddin Madiyorov', 'position' => 'Backend Engineer', 'image' => 'team4.jpg']
            ];
            @endphp

            @foreach($teamMembers as $member)
            <div class="col-lg-4 col-md-6">
                <div class="team-card">
                    <img src="{{ asset('images/team/' . $member['image']) }}" alt="{{ $member['name'] }}" class="team-image">
                    <h3 class="team-name">{{ $member['name'] }}</h3>
                    <p class="team-position">{{ $member['position'] }}</p>
                    <div class="social-links">
                        <a href="#" class="text-muted mx-1">FB</a>
                        <a href="#" class="text-muted mx-1">IG</a>
                        <a href="#" class="text-muted mx-1">LI</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Пагинация для команды -->
        <nav aria-label="Team pagination">
            <ul class="pagination">
                <li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1">Предыдущая</a>
                </li>
                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                    <a class="page-link" href="#">Следующая</a>
                </li>
            </ul>
        </nav>
    </div>
</section>

<!-- 3. Quiz от ITech Academy -->
<section class="quiz-section section">
    <div class="container">
        <h2 class="section-title">IT-квиз от ITech Academy</h2>
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="quiz-card">
                    <div id="quizStart" class="text-center">
                        <h3>Проверьте свои знания в IT!</h3>
                        <p>Пройдите наш тест и узнайте, насколько хорошо вы разбираетесь в IT-сфере</p>
                        <button class="btn btn-primary btn-lg" onclick="startQuiz()">Начать тест</button>
                    </div>
                    <div id="quizContent" style="display: none;">
                        <div id="quizQuestions"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 4. Мастер классы -->
<section class="masterclass-section section">
    <div class="container">
        <h2 class="section-title">Мастер-классы</h2>
        <div class="row">
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="masterclass-card">
                    <img src="{{ asset('images/masterclass1.jpg') }}" alt="Web Development" class="masterclass-icon">
                    <h3 class="masterclass-title">Веб-разработка с нуля</h3>
                    <p class="masterclass-date">15 ноября 2024 | 15:00</p>
                    <p>Научитесь создавать современные веб-приложения с использованием React и Node.js</p>
                    <button class="btn-masterclass" onclick="registerMasterclass(1)">Зарегистрироваться</button>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="masterclass-card">
                    <img src="{{ asset('images/masterclass-icon-2.svg') }}" alt="Data Science" class="masterclass-icon">
                    <h3 class="masterclass-title">Data Science: Введение</h3>
                    <p class="masterclass-date">22 ноября 2024 | 14:00</p>
                    <p>Познакомьтесь с основами анализа данных и машинного обучения</p>
                    <button class="btn-masterclass" onclick="registerMasterclass(2)">Зарегистрироваться</button>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="masterclass-card">
                    <img src="{{ asset('images/masterclass-icon-3.svg') }}" alt="Mobile Development" class="masterclass-icon">
                    <h3 class="masterclass-title">Мобильная разработка</h3>
                    <p class="masterclass-date">29 ноября 2024 | 16:00</p>
                    <p>Создайте свое первое мобильное приложение на Flutter</p>
                    <button class="btn-masterclass" onclick="registerMasterclass(3)">Зарегистрироваться</button>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 5. Форма обратной связи -->
<div id="contact" class="form-1 section">
    <div class="container">
        <h2 class="section-title">Оставьте свой отзыв</h2>
        <div class="row">
            <div class="col-lg-6">
                <div class="image-container">
                    <img class="img-fluid" src="{{ asset('images/contact.png') }}" alt="alternative">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="text-container">
                    @if(auth()->check())
                        <div class="alert alert-info mb-3">
                            <i class="fas fa-user-check"></i> Вы оставляете отзыв как: <strong>{{ auth()->user()->name }}</strong>
                            @if(auth()->user()->email)
                                <br><small>Email: {{ auth()->user()->email }}</small>
                            @endif
                        </div>
                    @endif
                    
                    <div id="feedbackAlert" style="display: none;" class="alert"></div>
                    
                    <form id="contactForm">
                        @csrf
                        <div class="form-group">
                            <input type="text" name="name" id="name" class="form-control-input" 
                                   placeholder="Ваше имя" 
                                   @if(auth()->check()) value="{{ auth()->user()->name }}" readonly @endif
                                   required>
                        </div>
                        <div class="form-group">
                            <input type="email" name="email" id="email" class="form-control-input" 
                                   placeholder="Email"
                                   @if(auth()->check()) value="{{ auth()->user()->email }}" readonly @endif
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