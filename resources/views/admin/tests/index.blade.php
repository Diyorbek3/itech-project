@extends('admin.layouts.app')

@section('title', __('messages.test_management'))
@section('content')

<style>
    .stat-card {
        background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
        border-radius: 24px;
        padding: 24px;
        text-align: center;
        box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        transition: all 0.3s ease;
        border: 1px solid rgba(102,126,234,0.1);
    }
    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 30px rgba(102,126,234,0.15);
    }
    .stat-value {
        font-size: 2.5rem;
        font-weight: 800;
        background: linear-gradient(135deg, #667eea, #764ba2);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        margin-bottom: 8px;
    }
    .stat-label {
        color: #64748b;
        font-size: 0.85rem;
        font-weight: 500;
    }
    
    .search-bar {
        background: white;
        border-radius: 20px;
        padding: 20px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        margin-bottom: 30px;
    }
    
    .data-table {
        background: white;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0,0,0,0.05);
    }
    .data-table thead {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
    }
    .data-table th {
        padding: 16px 20px;
        font-weight: 600;
        border: none;
    }
    .data-table td {
        padding: 16px 20px;
        vertical-align: middle;
        border-bottom: 1px solid #f0f0f0;
    }
    .data-table tr {
        transition: all 0.2s;
    }
    .data-table tr:hover {
        background: #f8fafc;
    }
    
    mark {
        background: #fef08a;
        color: #1e293b;
        padding: 2px 6px;
        border-radius: 8px;
        font-weight: 600;
        animation: highlightPulse 0.3s ease;
    }
    
    @keyframes highlightPulse {
        0% { background: #fde047; transform: scale(1.02); }
        100% { background: #fef08a; transform: scale(1); }
    }
    
    .row-delete {
        animation: fadeOut 0.3s ease-out forwards;
    }
    @keyframes fadeOut {
        0% { opacity: 1; transform: translateX(0); }
        100% { opacity: 0; transform: translateX(-20px); display: none; }
    }
    
    .search-info {
        background: #e0e7ff;
        border-radius: 30px;
        padding: 6px 16px;
        margin-top: 12px;
        display: inline-block;
        font-size: 0.8rem;
        color: #4338ca;
    }
    
    .badge-active {
        background: linear-gradient(135deg, #10b981, #059669);
        color: white;
        padding: 6px 14px;
        border-radius: 30px;
        font-size: 0.75rem;
        font-weight: 600;
    }
    .badge-pending {
        background: linear-gradient(135deg, #f59e0b, #d97706);
        color: white;
        padding: 6px 14px;
        border-radius: 30px;
        font-size: 0.75rem;
        font-weight: 600;
    }
    
    .btn-gradient {
        background: linear-gradient(135deg, #667eea, #764ba2);
        border: none;
        padding: 10px 24px;
        border-radius: 30px;
        color: white;
        font-weight: 600;
        transition: all 0.3s ease;
    }
    .btn-gradient:hover {
        transform: scale(1.02);
        box-shadow: 0 5px 20px rgba(102,126,234,0.4);
    }
    
    .btn-outline-icon {
        background: transparent;
        border: 1px solid #e2e8f0;
        padding: 8px 12px;
        border-radius: 12px;
        margin: 0 4px;
        transition: all 0.2s;
    }
    .btn-outline-icon:hover {
        background: #f1f5f9;
        transform: translateY(-2px);
    }
    
    .swal2-popup {
        border-radius: 24px !important;
    }
    .swal2-confirm {
        background: linear-gradient(135deg, #ef4444, #dc2626) !important;
        box-shadow: none !important;
    }
    .swal2-cancel {
        background: #e2e8f0 !important;
        color: #1e293b !important;
    }
</style>

<div class="container mt-4">
    <div class="row mb-4">
        <div class="col-md-4 mb-3">
            <div class="stat-card">
                <div class="stat-value" id="totalTests">0</div>
                <div class="stat-label">{{ __('messages.total_tests') }}</div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="stat-card">
                <div class="stat-value" id="totalParts">0</div>
                <div class="stat-label">{{ __('messages.participants') }}</div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="stat-card">
                <div class="stat-value" id="avgScore">0%</div>
                <div class="stat-label">{{ __('messages.avg_score') }}</div>
            </div>
        </div>
    </div>

    <div class="search-bar">
        <div class="row align-items-center g-3">
            <div class="col-md-5">
                <div class="input-group">
                    <span class="input-group-text bg-transparent border-end-0">🔍</span>
                    <input type="text" class="form-control border-start-0" id="searchInput" placeholder="{{ __('messages.search') }}">
                </div>
            </div>
            <div class="col-md-3">
                <select class="form-select" id="statusFilter">
                    <option value="all">{{ __('messages.all_status') }}</option>
                    <option value="active">{{ __('messages.active') }}</option>
                    <option value="pending">{{ __('messages.pending') }}</option>
                </select>
            </div>
            <div class="col-md-4 text-end">
                <button class="btn-gradient w-100" data-bs-toggle="modal" data-bs-target="#addModal">
                    <i class="fas fa-plus me-2"></i>{{ __('messages.add_test') }}
                </button>
            </div>
        </div>
        <div id="searchInfo" class="mt-2" style="min-height: 44px;"></div>
    </div>

    <div class="data-table">
        <table class="table mb-0">
            <thead>
                <tr><th>ID</th><th>{{ __('messages.test_name') }}</th><th>{{ __('messages.category') }}</th><th>{{ __('messages.questions') }}</th><th>{{ __('messages.time') }}</th><th>{{ __('messages.participants') }}</th><th>{{ __('messages.status') }}</th><th>{{ __('messages.actions') }}</th></tr>
            </thead>
            <tbody id="tableBody"></tbody>
        </table>
    </div>
</div>

<!-- Add Modal -->
<div class="modal fade" id="addModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title"><i class="fas fa-plus me-2"></i>{{ __('messages.add_test') }}</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label fw-semibold">{{ __('messages.test_name') }}</label>
                    <input type="text" class="form-control" id="testName" placeholder="Masalan: Laravel Test">
                </div>
                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">{{ __('messages.category') }}</label>
                        <select class="form-select" id="testCat">
                            <option>Backend</option><option>Frontend</option><option>AI</option><option>Security</option><option>Digital Kids</option><option>Robototexnika</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">{{ __('messages.status') }}</label>
                        <select class="form-select" id="testStatus">
                            <option value="active">{{ __('messages.active') }}</option>
                            <option value="pending">{{ __('messages.pending') }}</option>
                        </select>
                    </div>
                </div>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">{{ __('messages.questions') }}</label>
                        <input type="number" class="form-control" id="testQ" value="20">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">{{ __('messages.time_min') }}</label>
                        <input type="number" class="form-control" id="testTime" value="30">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-light" data-bs-dismiss="modal">{{ __('messages.cancel') }}</button>
                <button class="btn-gradient" onclick="addTest()">{{ __('messages.save') }}</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
let tests = @json($tests);
let nextId = tests.length ? Math.max(...tests.map(t => t.id)) + 1 : 1;
let currentLang = '{{ app()->getLocale() }}';
let csrfToken = '{{ csrf_token() }}';

function getStatusText(status) {
    if(status == 'active') {
        if(currentLang == 'uz') return 'Faol';
        if(currentLang == 'ru') return 'Активный';
        return 'Active';
    } else {
        if(currentLang == 'uz') return 'Kutilmoqda';
        if(currentLang == 'ru') return 'Ожидание';
        return 'Pending';
    }
}

function getStatusClass(status) {
    return status == 'active' ? 'badge-active' : 'badge-pending';
}

function highlightText(text, search) {
    if (!search || search.trim() === '') return text;
    const regex = new RegExp(`(${search.replace(/[.*+?^${}()|[\]\\]/g, '\\$&')})`, 'gi');
    return text.replace(regex, '<mark>$1</mark>');
}

function renderTable() {
    let search = document.getElementById('searchInput').value;
    let searchLower = search.toLowerCase();
    let filter = document.getElementById('statusFilter').value;
    
    let filtered = tests.filter(t => t.name.toLowerCase().includes(searchLower) && (filter == 'all' || t.status == filter));
    
    let searchInfo = document.getElementById('searchInfo');
    if (search && filtered.length > 0) {
        searchInfo.innerHTML = `<div class="search-info">🔍 "${search}" bo'yicha ${filtered.length} ta test topildi</div>`;
    } else if (search && filtered.length === 0) {
        searchInfo.innerHTML = `<div class="search-info" style="background: #fee2e2; color:#dc2626;">🔍 "${search}" bo'yicha hech qanday test topilmadi</div>`;
    } else {
        searchInfo.innerHTML = '';
    }
    
    let html = '';
    filtered.forEach(t => {
        let highlightedName = highlightText(t.name, search);
        html += `<tr id="row-${t.id}">
            <td><strong>${t.id}</strong></td>
            <td><span class="fw-semibold">${highlightedName}</span></td>
            <td>${t.category}</td>
            <td>${t.questions}</td>
            <td>${t.time} min</td>
            <td>${t.participants}</td>
            <td><span class="${getStatusClass(t.status)}">${getStatusText(t.status)}</span></td>
            <td>
                <button class="btn-outline-icon" onclick="viewTest(${t.id})"><i class="fas fa-eye text-primary"></i></button>
                <button class="btn-outline-icon" onclick="editTest(${t.id})"><i class="fas fa-edit text-warning"></i></button>
                <button class="btn-outline-icon" onclick="deleteTest(${t.id})"><i class="fas fa-trash text-danger"></i></button>
            </td>
         </tr>`;
    });
    if(filtered.length == 0 && !search) {
        html = `<tr><td colspan="8" class="text-center py-4">{{ __('messages.no_data') }}</td></tr>`;
    } else if(filtered.length == 0 && search) {
        html = `<tr><td colspan="8" class="text-center py-4">😕 "${search}" bo'yicha hech narsa topilmadi</td></tr>`;
    }
    document.getElementById('tableBody').innerHTML = html;
    document.getElementById('totalTests').innerText = tests.length;
    let parts = tests.reduce((s,t) => s + (t.participants || 0), 0);
    document.getElementById('totalParts').innerText = parts;
    let avg = tests.length ? Math.round(parts / tests.length) : 0;
    document.getElementById('avgScore').innerHTML = avg + '%';
}

function addTest() {
    let name = document.getElementById('testName').value;
    if(!name) {
        Swal.fire({ icon: 'warning', title: '{{ __("messages.enter_name") }}', confirmButtonColor: '#667eea' });
        return;
    }
    
    fetch('{{ route("admin.my-tests.store") }}', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken },
        body: JSON.stringify({
            name: name,
            category: document.getElementById('testCat').value,
            questions: parseInt(document.getElementById('testQ').value) || 20,
            time: parseInt(document.getElementById('testTime').value) || 30,
            participants: 0,
            status: document.getElementById('testStatus').value
        })
    })
    .then(res => res.json())
    .then(newTest => {
        tests.push(newTest);
        nextId = Math.max(...tests.map(t => t.id)) + 1;
        renderTable();
        bootstrap.Modal.getInstance(document.getElementById('addModal')).hide();
        document.getElementById('testName').value = '';
        Swal.fire({ icon: 'success', title: '✅ {{ __("messages.added") }}', showConfirmButton: false, timer: 1500 });
    });
}

function viewTest(id) {
    let t = tests.find(t => t.id == id);
    Swal.fire({
        title: '📋 {{ __("messages.test_info") }}',
        html: `<div style="text-align:left"><p><strong>📌 {{ __("messages.test_name") }}:</strong> ${t.name}</p><p><strong>📂 {{ __("messages.category") }}:</strong> ${t.category}</p><p><strong>❓ {{ __("messages.questions") }}:</strong> ${t.questions}</p><p><strong>⏱️ {{ __("messages.time") }}:</strong> ${t.time} min</p><p><strong>👥 {{ __("messages.participants") }}:</strong> ${t.participants}</p><p><strong>🏷️ {{ __("messages.status") }}:</strong> ${getStatusText(t.status)}</p></div>`,
        icon: 'info', confirmButtonColor: '#667eea', confirmButtonText: '{{ __("messages.close") }}'
    });
}

function editTest(id) {
    let t = tests.find(t => t.id == id);
    Swal.fire({
        title: '✏️ {{ __("messages.edit_test") }}', input: 'text', inputValue: t.name,
        inputPlaceholder: '{{ __("messages.test_name") }}', showCancelButton: true,
        confirmButtonText: '{{ __("messages.save") }}', cancelButtonText: '{{ __("messages.cancel") }}',
        confirmButtonColor: '#667eea', cancelButtonColor: '#e2e8f0',
        inputValidator: (value) => { if (!value) return '{{ __("messages.enter_name") }}'; }
    }).then((result) => {
        if (result.isConfirmed && result.value) {
            fetch(`/admin/my-tests/${id}`, {
                method: 'PUT', headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken },
                body: JSON.stringify({ ...t, name: result.value.trim() })
            }).then(res => res.json()).then(updated => {
                let index = tests.findIndex(t => t.id == id);
                tests[index] = updated;
                renderTable();
                Swal.fire({ icon: 'success', title: '✅ {{ __("messages.updated") }}', showConfirmButton: false, timer: 1500 });
            });
        }
    });
}

function deleteTest(id) {
    let t = tests.find(t => t.id == id);
    Swal.fire({
        title: '⚠️ {{ __("messages.confirm_delete") }}', html: `<p>{{ __("messages.delete_warning") }}</p><p class="fw-bold text-danger">"${t.name}"</p>`,
        icon: 'warning', showCancelButton: true, confirmButtonColor: '#ef4444', cancelButtonColor: '#e2e8f0',
        confirmButtonText: '🗑️ {{ __("messages.yes_delete") }}', cancelButtonText: '{{ __("messages.cancel") }}', reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            fetch(`/admin/my-tests/${id}`, { method: 'DELETE', headers: { 'X-CSRF-TOKEN': csrfToken } })
            .then(() => {
                tests = tests.filter(t => t.id != id);
                renderTable();
                Swal.fire({ icon: 'success', title: '✅ {{ __("messages.deleted") }}', showConfirmButton: false, timer: 1500 });
            });
        }
    });
}

document.getElementById('searchInput').addEventListener('keyup', renderTable);
document.getElementById('statusFilter').addEventListener('change', renderTable);
renderTable();
</script>

@endsection