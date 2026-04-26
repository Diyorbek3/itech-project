<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Boshqaruvi | Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #f0f2f5;
            overflow-x: hidden;
        }

        /* Sidebar */
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            width: 280px;
            height: 100%;
            background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
            transition: all 0.3s;
            z-index: 1000;
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
        }

        .sidebar-header {
            padding: 30px 20px;
            text-align: center;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        .sidebar-header h3 {
            color: white;
            font-size: 1.5rem;
            margin-top: 10px;
            font-weight: 600;
        }

        .sidebar-header p {
            color: rgba(255,255,255,0.6);
            font-size: 0.8rem;
        }

        .sidebar-menu {
            padding: 20px 15px;
        }

        .sidebar-item {
            padding: 12px 18px;
            margin: 5px 0;
            border-radius: 12px;
            transition: all 0.3s;
            cursor: pointer;
            color: rgba(255,255,255,0.8);
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .sidebar-item:hover {
            background: rgba(255,255,255,0.1);
            transform: translateX(5px);
        }

        .sidebar-item.active {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
        }

        .sidebar-item i {
            width: 24px;
        }

        /* Main Content */
        .main-content {
            margin-left: 280px;
            min-height: 100vh;
        }

        /* Top Bar */
        .top-bar {
            background: white;
            padding: 18px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            position: sticky;
            top: 0;
            z-index: 999;
        }

        .page-title {
            font-size: 1.6rem;
            font-weight: 700;
            background: linear-gradient(135deg, #667eea, #764ba2);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .avatar {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea, #764ba2);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
        }

        /* Content */
        .content-area {
            padding: 30px;
        }

        /* Stat Cards */
        .stat-card {
            background: white;
            border-radius: 20px;
            padding: 25px;
            transition: all 0.3s;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            height: 100%;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }

        .stat-icon {
            width: 55px;
            height: 55px;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
            font-size: 1.8rem;
        }

        .stat-value {
            font-size: 2rem;
            font-weight: 800;
            color: #1e293b;
        }

        .stat-label {
            color: #64748b;
            font-size: 0.85rem;
            margin-top: 5px;
        }

        /* Weather Card */
        .weather-card {
            background: linear-gradient(135deg, #667eea, #764ba2);
            border-radius: 20px;
            padding: 25px;
            color: white;
            height: 100%;
        }

        .temp {
            font-size: 3rem;
            font-weight: bold;
        }

        /* Table */
        .data-table {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .data-table thead {
            background: #f8fafc;
        }

        .data-table th {
            padding: 15px 20px;
            font-weight: 600;
            color: #1e293b;
        }

        .data-table td {
            padding: 15px 20px;
            color: #475569;
            vertical-align: middle;
        }

        .badge {
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .badge-active {
            background: #10b981;
            color: white;
        }

        .badge-pending {
            background: #f59e0b;
            color: white;
        }

        .badge-inactive {
            background: #ef4444;
            color: white;
        }

        .btn-gradient {
            background: linear-gradient(135deg, #667eea, #764ba2);
            border: none;
            padding: 10px 24px;
            border-radius: 12px;
            color: white;
            font-weight: 600;
            transition: all 0.3s;
        }

        .btn-gradient:hover {
            transform: scale(1.05);
            box-shadow: 0 5px 15px rgba(102,126,234,0.4);
            color: white;
        }

        .btn-icon {
            background: transparent;
            border: none;
            padding: 8px;
            margin: 0 3px;
            border-radius: 8px;
            transition: all 0.2s;
            cursor: pointer;
        }

        .btn-icon:hover {
            background: #f1f5f9;
        }

        .form-control, .form-select {
            border-radius: 12px;
            border: 1px solid #e2e8f0;
            padding: 10px 15px;
        }

        .form-control:focus, .form-select:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102,126,234,0.25);
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fadeInUp {
            animation: fadeInUp 0.5s ease-out;
        }

        @media (max-width: 768px) {
            .sidebar {
                left: -280px;
            }
            .main-content {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
    <div class="sidebar-header">
        <i class="fas fa-chalkboard-user" style="font-size: 45px; color: #667eea;"></i>
        <h3>ITech Admin</h3>
        <p>Test Boshqaruv Tizimi</p>
    </div>
    <div class="sidebar-menu">
        <div class="sidebar-item" onclick="window.location.href='/dashboard'">
            <i class="fas fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </div>
        <div class="sidebar-item active">
            <i class="fas fa-flask"></i>
            <span>Testlar</span>
        </div>
        <div class="sidebar-item">
            <i class="fas fa-chart-line"></i>
            <span>Natijalar</span>
        </div>
        <div class="sidebar-item">
            <i class="fas fa-users"></i>
            <span>Foydalanuvchilar</span>
        </div>
        <div class="sidebar-item">
            <i class="fas fa-cog"></i>
            <span>Sozlamalar</span>
        </div>
    </div>
</div>

<!-- Main Content -->
<div class="main-content">
    <div class="top-bar">
        <h1 class="page-title">
            <i class="fas fa-flask"></i> Test Boshqaruvi
        </h1>
        <div class="user-info">
            <i class="fas fa-bell" style="font-size: 1.2rem; color: #64748b; cursor: pointer;"></i>
            <div class="avatar">
                <span>AD</span>
            </div>
        </div>
    </div>

    <div class="content-area animate-fadeInUp">
        <!-- Statistics Row -->
        <div class="row mb-4">
            <div class="col-md-3 mb-3">
                <div class="stat-card">
                    <div class="stat-icon" style="background: #667eea20; color: #667eea;">
                        <i class="fas fa-tasks"></i>
                    </div>
                    <div class="stat-value">24</div>
                    <div class="stat-label">Jami testlar</div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="stat-card">
                    <div class="stat-icon" style="background: #10b98120; color: #10b981;">
                        <i class="fas fa-user-check"></i>
                    </div>
                    <div class="stat-value">156</div>
                    <div class="stat-label">Qatnashchilar</div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="stat-card">
                    <div class="stat-icon" style="background: #f59e0b20; color: #f59e0b;">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <div class="stat-value">78%</div>
                    <div class="stat-label">O'rtacha natija</div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="weather-card">
                    <i class="fas fa-cloud-rain" style="font-size: 30px;"></i>
                    <div class="temp">28°C</div>
                    <div style="font-size: 0.9rem;">Rainy days ahead</div>
                    <div style="font-size: 0.75rem; opacity: 0.8;">Toshkent, O'zbekiston</div>
                </div>
            </div>
        </div>

        <!-- Search & Add -->
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="stat-card">
                    <div class="row align-items-center">
                        <div class="col-md-5 mb-2 mb-md-0">
                            <input type="text" class="form-control" placeholder="🔍 Test nomi bo'yicha qidirish...">
                        </div>
                        <div class="col-md-3 mb-2 mb-md-0">
                            <select class="form-select">
                                <option>Barcha holatlar</option>
                                <option>Faol</option>
                                <option>Kutilmoqda</option>
                                <option>Arxiv</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <button class="btn-gradient w-100" data-bs-toggle="modal" data-bs-target="#addTestModal">
                                <i class="fas fa-plus"></i> Yangi test qo'shish
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tests Table -->
        <div class="data-table">
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Test nomi</th>
                        <th>Kategoriya</th>
                        <th>Savollar</th>
                        <th>Vaqt</th>
                        <th>Qatnashchilar</th>
                        <th>Holati</th>
                        <th>Harakatlar</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td><strong>Laravel Asoslari</strong></td>
                        <td>Backend</td>
                        <td>25</td>
                        <td>45 min</td>
                        <td>48</td>
                        <td><span class="badge badge-active">Faol</span></td>
                        <td>
                            <button class="btn-icon" onclick="viewTest(1)" title="Ko'rish"><i class="fas fa-eye" style="color: #667eea;"></i></button>
                            <button class="btn-icon" onclick="editTest(1)" title="Tahrirlash"><i class="fas fa-edit" style="color: #f59e0b;"></i></button>
                            <button class="btn-icon" onclick="deleteTest(1)" title="O'chirish"><i class="fas fa-trash" style="color: #ef4444;"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td><strong>PHP Dasturlash</strong></td>
                        <td>Backend</td>
                        <td>30</td>
                        <td>60 min</td>
                        <td>62</td>
                        <td><span class="badge badge-active">Faol</span></td>
                        <td>
                            <button class="btn-icon"><i class="fas fa-eye" style="color: #667eea;"></i></button>
                            <button class="btn-icon"><i class="fas fa-edit" style="color: #f59e0b;"></i></button>
                            <button class="btn-icon"><i class="fas fa-trash" style="color: #ef4444;"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td><strong>React.js</strong></td>
                        <td>Frontend</td>
                        <td>28</td>
                        <td>50 min</td>
                        <td>41</td>
                        <td><span class="badge badge-active">Faol</span></td>
                        <td>
                            <button class="btn-icon"><i class="fas fa-eye" style="color: #667eea;"></i></button>
                            <button class="btn-icon"><i class="fas fa-edit" style="color: #f59e0b;"></i></button>
                            <button class="btn-icon"><i class="fas fa-trash" style="color: #ef4444;"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td><strong>Python AI</strong></td>
                        <td>Sun'iy Intellekt</td>
                        <td>35</td>
                        <td>75 min</td>
                        <td>35</td>
                        <td><span class="badge badge-pending">Kutilmoqda</span></td>
                        <td>
                            <button class="btn-icon"><i class="fas fa-eye" style="color: #667eea;"></i></button>
                            <button class="btn-icon"><i class="fas fa-edit" style="color: #f59e0b;"></i></button>
                            <button class="btn-icon"><i class="fas fa-trash" style="color: #ef4444;"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td><strong>Cybersecurity</strong></td>
                        <td>Xavfsizlik</td>
                        <td>40</td>
                        <td>90 min</td>
                        <td>28</td>
                        <td><span class="badge badge-inactive">Arxiv</span></td>
                        <td>
                            <button class="btn-icon"><i class="fas fa-eye" style="color: #667eea;"></i></button>
                            <button class="btn-icon"><i class="fas fa-edit" style="color: #f59e0b;"></i></button>
                            <button class="btn-icon"><i class="fas fa-trash" style="color: #ef4444;"></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Add Test Modal -->
<div class="modal fade" id="addTestModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background: linear-gradient(135deg, #667eea, #764ba2); color: white;">
                <h5 class="modal-title"><i class="fas fa-plus"></i> Yangi test qo'shish</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" style="padding: 25px;">
                <form>
                    <div class="mb-3">
                        <label class="form-label">Test nomi</label>
                        <input type="text" class="form-control" placeholder="Masalan: Laravel bo'yicha test">
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Kategoriya</label>
                            <select class="form-select">
                                <option>Backend</option>
                                <option>Frontend</option>
                                <option>Sun'iy Intellekt</option>
                                <option>Xavfsizlik</option>
                                <option>Ma'lumotlar bazasi</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Holati</label>
                            <select class="form-select">
                                <option>Faol</option>
                                <option>Kutilmoqda</option>
                                <option>Arxiv</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Savollar soni</label>
                            <input type="number" class="form-control" value="20">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Vaqt (minut)</label>
                            <input type="number" class="form-control" value="30">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Test tavsifi</label>
                        <textarea class="form-control" rows="3" placeholder="Test haqida qisqacha ma'lumot..."></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Bekor qilish</button>
                <button type="button" class="btn-gradient" onclick="alert('Test muvaffaqiyatli qo\'shildi!')">Saqlash</button>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    function viewTest(id) {
        alert('Test #' + id + ' ko\'rish');
    }
    
    function editTest(id) {
        alert('Test #' + id + ' tahrirlash');
    }
    
    function deleteTest(id) {
        if(confirm('Haqiqatan ham bu testni o\'chirmoqchimisiz?')) {
            alert('Test #' + id + ' o\'chirildi');
        }
    }
    
    // Sidebar active state
    document.querySelectorAll('.sidebar-item').forEach(item => {
        item.addEventListener('click', function() {
            document.querySelectorAll('.sidebar-item').forEach(i => i.classList.remove('active'));
            this.classList.add('active');
        });
    });
</script>

</body>
</html>