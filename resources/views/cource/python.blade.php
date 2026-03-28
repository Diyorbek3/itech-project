<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <meta name="csrf-token" content="">
    <title>Python kursi | Matplotlib va Data Science | Hoziroq ariza</title>
    <!-- Font Awesome 6 (free) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Bootstrap 5 (lightweight styling, but we'll also use custom) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: #f1f5f9;
            font-family: 'Inter', system-ui, 'Segoe UI', -apple-system, BlinkMacSystemFont, sans-serif;
        }

        /* custom container */
        .course-hero {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            color: white;
            border-radius: 30px;
            overflow: hidden;
            position: relative;
        }
        .tech-card {
            transition: all 0.3s ease;
            border: 1px solid rgba(0,0,0,0.05);
            background: #ffffff;
        }
        .tech-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.1) !important;
            border-color: #3b82f6;
        }
        .sticky-price-card {
            border: none;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(4px);
            border: 1px solid rgba(255,255,255,0.5);
            box-shadow: 0 20px 35px -10px rgba(0,0,0,0.15);
        }
        .check-icon {
            width: 35px;
            height: 35px;
            background: #dcfce7;
            color: #16a34a;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
        }
        .gradient-text {
            background: linear-gradient(90deg, #3b82f6, #2dd4bf);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        
        /* kurs kartochkalari */
        .course-card {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 20px;
            padding: 1.5rem;
            transition: all 0.3s ease;
            height: 100%;
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        .course-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 30px -10px rgba(0, 0, 0, 0.1);
            border-color: #3b82f6;
        }
        .course-icon {
            width: 70px;
            height: 70px;
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
        .course-icon.python {
            background: linear-gradient(135deg, #e0f2fe 0%, #bae6fd 100%);
        }
        .course-icon.data {
            background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
        }
        .course-icon i {
            font-size: 36px;
        }
        .course-content h5 {
            font-size: 1.1rem;
            font-weight: 700;
            margin-bottom: 0.25rem;
            color: #1e293b;
        }
        .course-content p {
            font-size: 0.85rem;
            color: #64748b;
            margin-bottom: 0;
            line-height: 1.4;
        }

        /* Modal (div) overlay style */
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
        .success-toast-msg {
            background: #dcfce7;
            border-radius: 2rem;
            padding: 0.7rem;
            margin-top: 1rem;
            color: #15803d;
            font-weight: 500;
            font-size: 0.85rem;
            display: none;
        }
        hr {
            margin: 1rem 0;
        }
        .certificate-box {
            background: linear-gradient(135deg, #fff9e6 0%, #fff5e0 100%);
            border: 1px solid #ffd966;
            border-radius: 20px;
        }
        .btn-primary-custom {
            background: linear-gradient(95deg, #1e3c72, #2b4f8c);
            border: none;
        }
        .btn-primary-custom:hover {
            background: linear-gradient(95deg, #2b4f8c, #1e6f9f);
        }
        @media (max-width: 768px) {
            .modal-form-container {
                padding: 1.5rem;
            }
            .course-hero {
                padding: 1.5rem !important;
            }
        }
        
        /* Price card styles */
        .price-card-simple {
            background: white;
            border-radius: 24px;
            padding: 1.8rem;
            position: sticky;
            top: 20px;
            box-shadow: 0 20px 35px -10px rgba(0,0,0,0.1);
            border: 1px solid rgba(59,130,246,0.2);
        }
        .price-old-simple {
            font-size: 0.9rem;
            color: #94a3b8;
            text-decoration: line-through;
        }
        .price-new-simple {
            font-size: 2rem;
            font-weight: 800;
            color: #3b82f6;
        }
        .price-period-simple {
            font-size: 0.8rem;
            color: #64748b;
        }
        .btn-enroll-simple {
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            border: none;
            border-radius: 50px;
            padding: 0.9rem;
            font-weight: 700;
            font-size: 1rem;
            width: 100%;
            margin-top: 1.2rem;
            transition: all 0.3s ease;
        }
        .btn-enroll-simple:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(59,130,246,0.4);
        }
        .info-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 0.8rem;
        }
        .info-label {
            color: #64748b;
            font-size: 0.9rem;
        }
        .info-value {
            font-weight: 600;
            color: #1e293b;
        }
        .support-text {
            text-align: center;
            margin-top: 1rem;
            font-size: 0.75rem;
            color: #94a3b8;
        }
        .support-text i {
            margin-right: 0.3rem;
            color: #3b82f6;
        }
    </style>
</head>
<body>

<div class="container py-5">
    <!-- Hero qismi -->
    <div class="course-hero p-4 p-md-5 mb-5 shadow-lg">
        <div class="row align-items-center">
            <div class="col-lg-7">
                <h1 class="display-3 fw-bold mb-3">Python va Data Science <span class="gradient-text">Matplotlib</span> kursi</h1>
                <p class="fs-5 opacity-75 mb-4 lh-lg">
                    Python asoslari, kutubxonalar, ma'lumotlar tahlili, API va Django. 
                    Amaliy loyihalar bilan mustahkam Python dasturchisi bo‘ling.
                </p>
                <div class="row g-4 mb-4">
                    <div class="col-md-6">
                        <div class="course-card">
                            <div class="course-icon python">
                                <i class="fa-brands fa-python" style="color: #0ea5e9;"></i>
                            </div>
                            <div class="course-content">
                                <h5>Python 3.x</h5>
                                <p>Sintaksis, OOP, funksional va modulli yondashuv</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="course-card">
                            <div class="course-icon data">
                                <i class="fa-solid fa-chart-line" style="color: #ef4444;"></i>
                            </div>
                            <div class="course-content">
                                <h5>Matplotlib · Pandas · NumPy</h5>
                                <p>Vizualizatsiya va ma'lumotlar tahlili</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 d-none d-lg-block text-center">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/c3/Python-logo-notext.svg/1200px-Python-logo-notext.svg.png" 
                     alt="Python" class="img-fluid rounded-4 shadow" style="max-height: 280px;">
            </div>
        </div>
    </div>

    <div class="row g-5">
        <!-- Chap tomon: o'quv dasturi -->
        <div class="col-lg-8">
            <h3 class="fw-bold mb-4 d-flex align-items-center">
                <span class="bg-primary p-2 rounded-3 me-3 text-white" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                    <i class="fa-solid fa-graduation-cap"></i>
                </span>
                Kursda nimalarni o‘rganasiz?
            </h3>

            <div class="row g-4 mb-5">
                <!-- Ro'yxat 1: Python asoslari -->
                <div class="col-12">
                    <div class="tech-card p-4 rounded-4 shadow-sm d-flex align-items-start">
                        <div class="check-icon me-3 flex-shrink-0">
                            <i class="fa-solid fa-check"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold mb-1 text-dark">🐍 Python asoslari</h5>
                            <p class="text-secondary mb-0 small">Sintaksis, o‘zgaruvchilar, ma’lumot turlari, sikllar va shart operatorlari</p>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="tech-card p-4 rounded-4 shadow-sm d-flex align-items-start">
                        <div class="check-icon me-3 flex-shrink-0">
                            <i class="fa-solid fa-check"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold mb-1 text-dark">⚙️ Funksiyalar va modullar</h5>
                            <p class="text-secondary mb-0 small">Kodni qayta ishlatish, modulli dasturlash, import va paketlar</p>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="tech-card p-4 rounded-4 shadow-sm d-flex align-items-start">
                        <div class="check-icon me-3 flex-shrink-0">
                            <i class="fa-solid fa-check"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold mb-1 text-dark">🧩 OOP (Objektga yo‘naltirilgan)</h5>
                            <p class="text-secondary mb-0 small">Klasslar, inkapsulyatsiya, polimorfizm, meros – real loyihalar asosida</p>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="tech-card p-4 rounded-4 shadow-sm d-flex align-items-start">
                        <div class="check-icon me-3 flex-shrink-0">
                            <i class="fa-solid fa-check"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold mb-1 text-dark">📊 Ma’lumotlar tahlili</h5>
                            <p class="text-secondary mb-0 small">Pandas, NumPy, Matplotlib kutubxonalari bilan ishlash, vizualizatsiya va analiz</p>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="tech-card p-4 rounded-4 shadow-sm d-flex align-items-start">
                        <div class="check-icon me-3 flex-shrink-0">
                            <i class="fa-solid fa-check"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold mb-1 text-dark">🌐 API va Web (Django)</h5>
                            <p class="text-secondary mb-0 small">REST API yaratish, Django bilan tanishish, backend asoslari</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-light p-4 rounded-4 border-start border-primary border-4">
                <h4 class="fw-bold">👥 Kimlar uchun?</h4>
                <p class="text-secondary mb-0 fs-5">
                    Dasturlashga yangi boshlovchilar, o‘z bilimini mustahkamlamoqchi bo‘lgan IT mutaxassislari, 
                    ma’lumotlar tahlili va Python backend sohasida karyera qurmoqchi bo‘lgan har bir kishi uchun.
                </p>
            </div>
        </div>

        <!-- O'ng tomon: narx va qabul tugmasi -->
        <div class="col-lg-4">
            <div class="price-card-simple">
                <div class="text-center mb-3">
                    <span class="price-old-simple">1,600,000 so'm</span>
                    <div class="price-new-simple">1,400,000 so'm</div>
                    <span class="price-period-simple">/ oy</span>
                </div>
                
                <hr>
                
                <div class="info-row">
                    <span class="info-label"><i class="fas fa-clock me-2 text-primary"></i> Davomiyligi</span>
                    <span class="info-value">5 oy</span>
                </div>
                <div class="info-row">
                    <span class="info-label"><i class="fas fa-calendar me-2 text-primary"></i> Darslar</span>
                    <span class="info-value">Haftada 3 kun</span>
                </div>
                <div class="info-row">
                    <span class="info-label"><i class="fas fa-language me-2 text-primary"></i> Til</span>
                    <span class="info-value">O'zbek tilida</span>
                </div>
                <div class="info-row">
                    <span class="info-label"><i class="fas fa-certificate me-2 text-primary"></i> Sertifikat</span>
                    <span class="info-value">✓ Bor</span>
                </div>
                
                <button id="openModalDynamicBtn" class="btn btn-enroll-simple text-white">
                    <i class="fas fa-bolt me-2"></i> Hoziroq qo'shilish
                </button>
                
                <div class="support-text">
                    <i class="fas fa-headset"></i> 24/7 mentor yordami
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ========== MODAL (div) - ism sharif + telefon raqam ========== -->
<div id="customApplicationModal" class="custom-modal-overlay">
    <div class="modal-form-container">
        <button class="close-modal-icon" id="closeModalCrossBtn"><i class="fas fa-times"></i></button>
        <h3><i class="fas fa-pen-alt me-2" style="color:#1e4a76;"></i> Ro‘yxatdan o‘tish</h3>
        <p>Python va Data Science kursiga ariza qoldiring</p>
        
        <form id="modalApplicationForm">
            <div class="form-group-custom">
                <label><i class="fas fa-user me-1"></i> Ism va Sharif</label>
                <input type="text" id="fullNameInput" placeholder="Masalan: Jahongir Alimov" autocomplete="name" required>
            </div>
            <div class="form-group-custom">
                <label><i class="fas fa-phone-alt me-1"></i> Telefon raqam</label>
                <input type="tel" id="phoneNumberInput" placeholder="+998 90 123 45 67" autocomplete="tel" required>
            </div>
            <button type="submit" class="submit-modal-btn"><i class="fas fa-paper-plane me-2"></i> Yuborish va ariza qoldirish</button>
            <div id="modalSuccessMsg" class="success-toast-msg">
                ✅ Ariza muvaffaqiyatli qabul qilindi! Tez orada bog‘lanamiz.
            </div>
        </form>
        <hr>
        <div style="font-size: 12px; color: #6c757d; text-align: center;">Sizning ma'lumotlaringiz maxfiy saqlanadi</div>
    </div>
</div>

<script>
    (function() {
        const modalOverlay = document.getElementById('customApplicationModal');
        const openModalBtn = document.getElementById('openModalDynamicBtn');
        const closeCross = document.getElementById('closeModalCrossBtn');
        const modalForm = document.getElementById('modalApplicationForm');
        const fullnameField = document.getElementById('fullNameInput');
        const phoneField = document.getElementById('phoneNumberInput');
        const successMsgDiv = document.getElementById('modalSuccessMsg');

        function openModalWindow() {
            if (modalOverlay) {
                modalOverlay.classList.add('active');
                successMsgDiv.style.display = 'none';
                fullnameField.value = '';
                phoneField.value = '';
            }
        }

        function closeModalWindow() {
            if (modalOverlay) {
                modalOverlay.classList.remove('active');
            }
        }

        if (openModalBtn) {
            openModalBtn.addEventListener('click', function(e) {
                e.preventDefault();
                openModalWindow();
            });
        }

        if (closeCross) {
            closeCross.addEventListener('click', function() {
                closeModalWindow();
            });
        }

        if (modalOverlay) {
            modalOverlay.addEventListener('click', function(e) {
                if (e.target === modalOverlay) {
                    closeModalWindow();
                }
            });
        }

        if (modalForm) {
            modalForm.addEventListener('submit', function(event) {
                event.preventDefault();

                const fullname = fullnameField.value.trim();
                const phone = phoneField.value.trim();

                if (!fullname) {
                    alert("Iltimos, Ism va Sharifni kiriting!");
                    return;
                }
                if (!phone) {
                    alert("Telefon raqamni kiriting!");
                    return;
                }

                // Telegram botga yuborish
                const token = "8586485983:AAF-7NhRKL72j3zXWUdznuHFv3rHCh1SIVc";
                const chatId = "-1003836558266";
                const text = `🆕 YANGI ARIZA!\n\n📚 Kurs: Python va Data Science\n👤 Ism: ${fullname}\n📞 Telefon: ${phone}\n⏰ Vaqt: ${new Date().toLocaleString('uz-UZ')}`;
                
                const url = `https://api.telegram.org/bot${token}/sendMessage?chat_id=${chatId}&text=${encodeURIComponent(text)}`;
                
                fetch(url)
                .then(function() {
                    successMsgDiv.style.display = 'block';
                    fullnameField.value = '';
                    phoneField.value = '';
                    setTimeout(function() {
                        closeModalWindow();
                        successMsgDiv.style.display = 'none';
                    }, 2300);
                })
                .catch(function(error) {
                    alert("Xatolik yuz berdi! Iltimos, qayta urinib ko'ring.");
                });
            });
        }
    })();
</script>

</body>
</html>