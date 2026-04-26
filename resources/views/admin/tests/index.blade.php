<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ __('Test Management') }} | ITECH Academy</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; background: #f0f2f5; padding-top: 80px; }
        
        /* Navigation - asosiy sayt bilan bir xil */
        .navbar { box-shadow: 0 2px 10px rgba(0,0,0,0.08); background: white !important; }
        .navbar-brand img { width: 70px; height: 70px; object-fit: cover; }
        .btn-outline-sm { border: 1px solid #e2e8f0; background: transparent; transition: all 0.3s; border-radius: 30px; text-decoration: none; color: #1e293b; font-size: 13px; display: flex; align-items: center; gap: 8px; }
        .btn-outline-sm:hover { background: linear-gradient(135deg, #667eea, #764ba2); border-color: transparent; color: white; }
        .rounded-circle-5 { border-radius: 30px; padding: 8px 18px; }
        .rounded-circle-3 { width: 42px; height: 42px; border-radius: 50%; display: flex; align-items: center; justify-content: center; }
        .nav-link { font-weight: 500; color: #1e293b; transition: all 0.3s; }
        .nav-link:hover { color: #667eea; }
        .dropdown-menu { border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); border: none; }
        .dropdown-item { font-size: 13px; padding: 8px 20px; }
        .dropdown-item:hover { background: #f1f5f9; }
        .header-avatar { width: 30px; height: 30px; object-fit: cover; }
        
        /* Test Panel */
        .test-panel { padding: 20px 30px; }
        .panel-title { margin-bottom: 25px; }
        .panel-title h1 { font-size: 1.8rem; font-weight: 600; color: #1e293b; }
        .panel-title p { color: #64748b; margin-top: 5px; }
        
        .stat-card { background: white; border-radius: 15px; padding: 20px; text-align: center; box-shadow: 0 2px 8px rgba(0,0,0,0.05); height: 100%; }
        .stat-card:hover { transform: translateY(-3px); box-shadow: 0 8px 20px rgba(0,0,0,0.1); }
        .stat-icon { width: 50px; height: 50px; border-radius: 12px; display: flex; align-items: center; justify-content: center; margin: 0 auto 15px; font-size: 1.5rem; }
        .stat-value { font-size: 1.8rem; font-weight: 700; color: #1e293b; }
        .stat-label { color: #64748b; font-size: 0.8rem; margin-top: 5px; }
        
        .weather-card { background: linear-gradient(135deg, #667eea, #764ba2); border-radius: 15px; padding: 20px; color: white; height: 100%; }
        .weather-temp { font-size: 2rem; font-weight: bold; }
        
        .search-bar { background: white; border-radius: 15px; padding: 15px 20px; margin-bottom: 25px; box-shadow: 0 2px 8px rgba(0,0,0,0.05); }
        .data-table { background: white; border-radius: 15px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.05); }
        .data-table thead { background: #f8fafc; }
        .data-table th { padding: 12px 15px; font-weight: 600; color: #1e293b; font-size: 0.85rem; }
        .data-table td { padding: 12px 15px; color: #475569; vertical-align: middle; font-size: 0.85rem; }
        
        .badge { padding: 4px 10px; border-radius: 15px; font-size: 0.7rem; font-weight: 600; }
        .badge-active { background: #10b981; color: white; }
        .badge-pending { background: #f59e0b; color: white; }
        .badge-archived { background: #ef4444; color: white; }
        
        .btn-gradient { background: linear-gradient(135deg, #667eea, #764ba2); border: none; padding: 8px 20px; border-radius: 10px; color: white; font-weight: 500; font-size: 0.85rem; transition: all 0.3s; }
        .btn-gradient:hover { transform: scale(1.02); }
        .btn-icon { background: transparent; border: none; padding: 5px; margin: 0 2px; border-radius: 6px; cursor: pointer; }
        .btn-icon:hover { background: #f1f5f9; }
        
        .form-control, .form-select { border-radius: 10px; border: 1px solid #e2e8f0; padding: 8px 12px; font-size: 0.85rem; }
        .modal-header { background: linear-gradient(135deg, #667eea, #764ba2); color: white; border-radius: 12px 12px 0 0; }
        
        footer { background: white; padding: 15px 30px; text-align: center; border-top: 1px solid #eef2f6; margin-top: 30px; color: #64748b; font-size: 12px; }
        
        @media (max-width: 768px) { .test-panel { padding: 15px; } }
    </style>
</head>
<body>

<!-- ==================== HEADER - ASOSIY SAYT BILAN BIR XIL ==================== -->
<nav class="navbar navbar-expand-lg fixed-top bg-white shadow-sm">
    <div class="container position-relative">
        <a class="navbar-brand" href="/">
            <img src="{{ asset('images/logo.png') }}" class="img-fluid rounded-circle" style="width: 70px; height: 70px;" alt="logo">
        </a>

        <!-- Mobile -->
        <div class="d-flex align-items-center gap-2 ms-auto d-lg-none">
            <div class="dropdown">
                <a class="btn-outline-sm dropdown-toggle d-flex align-items-center justify-content-center px-3 py-2" href="#" role="button" data-bs-toggle="dropdown" style="font-size: 12px; border-radius: 16px; height: 42px;">
                    <img src="{{ asset('flags/'.app()->getLocale().'.png') }}" style="width: 16px; height: 11px;"> {{ strtoupper(app()->getLocale()) }}
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="javascript:void(0)" onclick="switchLanguage('en')">🇬🇧 English</a></li>
                    <li><a class="dropdown-item" href="javascript:void(0)" onclick="switchLanguage('ru')">🇷🇺 Russian</a></li>
                    <li><a class="dropdown-item" href="javascript:void(0)" onclick="switchLanguage('uz')">🇺🇿 Uzbek</a></li>
                </ul>
            </div>
            <a class="btn-outline-sm px-3 py-2 d-flex align-items-center justify-content-center" href="/#contact" style="min-width: 110px;">{{ __('messages.contact_us') }}</a>
        </div>

        <button class="navbar-toggler ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExampleDefault">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Desktop -->
        <div class="collapse navbar-collapse justify-content-center" id="navbarsExampleDefault">
            <ul class="navbar-nav mx-auto gap-4">
                <li class="nav-item"><a class="nav-link" href="/#header">{{ __('messages.about_us') }}</a></li>
                <li class="nav-item"><a class="nav-link" href="/#details">{{ __('messages.why_us') }}</a></li>
                <li class="nav-item"><a class="nav-link" href="/#services">{{ __('messages.courses') }}</a></li>
                <li class="nav-item"><a class="nav-link" href="/#projects">{{ __('messages.projects') }}</a></li>
            </ul>

            <div class="d-none d-lg-flex align-items-center gap-3 ms-auto">
                <div class="dropdown">
                    <a class="btn-outline-sm dropdown-toggle d-flex align-items-center justify-content-center px-3 py-2" href="#" role="button" data-bs-toggle="dropdown" style="font-size: 12px; border-radius: 16px; height: 42px;">
                        <img src="{{ asset('flags/'.app()->getLocale().'.png') }}" style="width: 16px; height: 11px;"> {{ strtoupper(app()->getLocale()) }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="javascript:void(0)" onclick="switchLanguage('en')">🇬🇧 English</a></li>
                        <li><a class="dropdown-item" href="javascript:void(0)" onclick="switchLanguage('ru')">🇷🇺 Russian</a></li>
                        <li><a class="dropdown-item" href="javascript:void(0)" onclick="switchLanguage('uz')">🇺🇿 Uzbek</a></li>
                    </ul>
                </div>
                <a class="btn-outline-sm rounded-circle-5" href="/#contact">{{ __('messages.contact_us') }}</a>

                @guest
                    <a class="btn-outline-sm rounded-circle-3" href="{{ route('login') }}"><i class="fas fa-sign-in-alt"></i></a>
                    <a class="btn-outline-sm rounded-circle-3" href="{{ route('register') }}"><i class="fas fa-user-plus"></i></a>
                @else
                    <div class="dropdown">
                        <a class="btn-outline-sm dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown" style="padding: 5px 10px;">
                            <img src="{{ Auth::user()->avatar ? asset('storage/avatars/'.Auth::user()->avatar) : asset('images/avatar.png') }}" class="rounded-circle me-2 header-avatar" style="width: 30px; height: 30px; object-fit: cover;">
                            <span>{{ Auth::user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="/profile"><i class="fas fa-user me-2"></i> {{ __('messages.profile') }}</a></li>
                            <li><a class="dropdown-item" href="/test"><i class="fas fa-clipboard-list me-2"></i> Test</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><form method="POST" action="{{ route('logout') }}">@csrf<button type="submit" class="dropdown-item text-danger"><i class="fas fa-sign-out-alt me-2"></i> {{ __('messages.logout') }}</button></form></li>
                        </ul>
                    </div>
                @endguest
            </div>
        </div>
    </div>
</nav>

<!-- ==================== TEST PANEL CONTENT ==================== -->
<div class="test-panel">
    <div class="panel-title">
        <h1><i class="fas fa-flask"></i> {{ __('Test Boshqaruvi Paneli') }}</h1>
        <p>{{ __('Testlarni boshqarish, qoshish va tahrirlash') }}</p>
    </div>

    <div class="row mb-4">
        <div class="col-md-3 mb-3"><div class="stat-card"><div class="stat-icon" style="background: #667eea20; color:#667eea;"><i class="fas fa-tasks"></i></div><div class="stat-value" id="totalTests">24</div><div class="stat-label">{{ __('Jami testlar') }}</div></div></div>
        <div class="col-md-3 mb-3"><div class="stat-card"><div class="stat-icon" style="background: #10b98120; color:#10b981;"><i class="fas fa-user-check"></i></div><div class="stat-value" id="totalParts">156</div><div class="stat-label">{{ __('Qatnashchilar') }}</div></div></div>
        <div class="col-md-3 mb-3"><div class="stat-card"><div class="stat-icon" style="background: #f59e0b20; color:#f59e0b;"><i class="fas fa-chart-line"></i></div><div class="stat-value" id="avgScore">78%</div><div class="stat-label">{{ __('Uracha natija') }}</div></div></div>
        <div class="col-md-3 mb-3"><div class="weather-card"><div class="weather-temp">19°C</div><div><i class="fas fa-cloud-sun"></i> {{ __('Partly cloudy') }}</div></div></div>
    </div>

    <div class="search-bar">
        <div class="row">
            <div class="col-md-5 mb-2"><input type="text" class="form-control" id="searchInput" placeholder="{{ __('Test nomi boyicha qidirish...') }}"></div>
            <div class="col-md-3 mb-2"><select class="form-select" id="statusFilter"><option value="all">{{ __('Barcha holatlar') }}</option><option value="active">{{ __('Faol') }}</option><option value="pending">{{ __('Kutilmoqda') }}</option></select></div>
            <div class="col-md-4"><button class="btn-gradient w-100" data-bs-toggle="modal" data-bs-target="#addModal"><i class="fas fa-plus"></i> {{ __('Yangi test qoshish') }}</button></div>
        </div>
    </div>

    <div class="data-table">
        <table class="table mb-0">
            <thead><tr><th>ID</th><th>{{ __('Test nomi') }}</th><th>{{ __('Kategoriya') }}</th><th>{{ __('Savollar') }}</th><th>{{ __('Vaqt') }}</th><th>{{ __('Qatnashchilar') }}</th><th>{{ __('Holati') }}</th><th>{{ __('Harakatlar') }}</th></tr></thead>
            <tbody id="tableBody"></tbody>
        </table>
    </div>
</div>

<footer><p>© 2026 ITECH Academy. {{ __('Barcha huquqlar himoyalangan') }}</p></footer>

<!-- Modal -->
<div class="modal fade" id="addModal" tabindex="-1"><div class="modal-dialog"><div class="modal-content"><div class="modal-header"><h5 class="modal-title">{{ __('Yangi test qoshish') }}</h5><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div><div class="modal-body"><input type="text" class="form-control mb-2" id="testName" placeholder="{{ __('Test nomi') }}"><select class="form-select mb-2" id="testCat"><option>Backend</option><option>Frontend</option><option>AI</option></select><input type="number" class="form-control mb-2" id="testQ" placeholder="{{ __('Savollar') }}" value="20"><input type="number" class="form-control mb-2" id="testTime" placeholder="{{ __('Vaqt') }}" value="30"><select class="form-select" id="testStatus"><option value="active">{{ __('Faol') }}</option><option value="pending">{{ __('Kutilmoqda') }}</option></select></div><div class="modal-footer"><button class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Bekor qilish') }}</button><button class="btn-gradient" onclick="addTest()">{{ __('Saqlash') }}</button></div></div></div></div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
let tests = [
    {id:1,name:"Laravel Asoslari",cat:"Backend",q:25,time:45,parts:48,status:"active"},
    {id:2,name:"PHP Dasturlash",cat:"Backend",q:30,time:60,parts:62,status:"active"},
    {id:3,name:"React.js",cat:"Frontend",q:28,time:50,parts:41,status:"active"},
    {id:4,name:"Python AI",cat:"AI",q:35,time:75,parts:35,status:"pending"}
];
let nextId=5;

function renderTable(){
    let search=document.getElementById('searchInput').value.toLowerCase();
    let filter=document.getElementById('statusFilter').value;
    let filtered=tests.filter(t=>t.name.toLowerCase().includes(search)&&(filter=='all'||t.status==filter));
    let html='';
    filtered.forEach(t=>{
        let statusText=t.status=='active'?'Faol':'Kutilmoqda';
        let statusClass=t.status=='active'?'badge-active':'badge-pending';
        html+=`<tr><td>${t.id}</td><td><b>${t.name}</b></td><td>${t.cat}</td><td>${t.q}</td><td>${t.time} min</td><td>${t.parts}</td><td><span class="badge ${statusClass}">${statusText}</span></td><td><button class="btn-icon" onclick="view(${t.id})"><i class="fas fa-eye"></i></button> <button class="btn-icon" onclick="edit(${t.id})"><i class="fas fa-edit"></i></button> <button class="btn-icon" onclick="del(${t.id})"><i class="fas fa-trash"></i></button></td></tr>`;
    });
    if(filtered.length==0) html='<tr><td colspan="8" class="text-center">Hech qanday test topilmadi</td></tr>';
    document.getElementById('tableBody').innerHTML=html;
    document.getElementById('totalTests').innerText=tests.length;
    let parts=tests.reduce((s,t)=>s+t.parts,0);
    document.getElementById('totalParts').innerText=parts;
    document.getElementById('avgScore').innerText=tests.length?Math.round(parts/tests.length)+'%':'0%';
}

function addTest(){
    let name=document.getElementById('testName').value;
    if(!name){alert("Nomi kiriting");return;}
    tests.push({id:nextId++,name:name,cat:document.getElementById('testCat').value,q:parseInt(document.getElementById('testQ').value)||20,time:parseInt(document.getElementById('testTime').value)||30,parts:0,status:document.getElementById('testStatus').value});
    renderTable();
    bootstrap.Modal.getInstance(document.getElementById('addModal')).hide();
    document.getElementById('testName').value='';
}
function view(id){let t=tests.find(t=>t.id==id);alert(`${t.name}\n${t.cat}\nSavol:${t.q}\nVaqt:${t.time} min\nQatnash:${t.parts}`);}
function edit(id){let t=tests.find(t=>t.id==id);let newName=prompt("Yangi nom:",t.name);if(newName){t.name=newName;renderTable();}}
function del(id){if(confirm("O'chirilsinmi?")){tests=tests.filter(t=>t.id!=id);renderTable();}}
function switchLanguage(l){window.location.href='/language/'+l;}

document.getElementById('searchInput').addEventListener('keyup',renderTable);
document.getElementById('statusFilter').addEventListener('change',renderTable);
renderTable();
</script>
</body>
</html>