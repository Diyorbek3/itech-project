@extends('admin.layouts.app')

@section('title', __('test.test_management'))
@section('page-title', __('test.test_panel'))

@section('content')
<div class="container-fluid">
    <!-- Statistikalar -->
    <div class="row mb-4">
        <div class="col-md-4 mb-3">
            <div class="stat-card">
                <div class="stat-icon" style="background: #667eea20; color: #667eea;">
                    <i class="fas fa-tasks"></i>
                </div>
                <div class="stat-value" id="totalTests">0</div>
                <div class="stat-label">{{ __('test.total_tests') }}</div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="stat-card">
                <div class="stat-icon" style="background: #10b98120; color: #10b981;">
                    <i class="fas fa-user-check"></i>
                </div>
                <div class="stat-value" id="totalParts">0</div>
                <div class="stat-label">{{ __('test.participants') }}</div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="stat-card">
                <div class="stat-icon" style="background: #f59e0b20; color: #f59e0b;">
                    <i class="fas fa-chart-line"></i>
                </div>
                <div class="stat-value" id="avgScore">0%</div>
                <div class="stat-label">{{ __('test.avg_score') }}</div>
            </div>
        </div>
    </div>
    
    <!-- Qidiruv va filter -->
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="stat-card">
                <div class="row">
                    <div class="col-md-5">
                        <input type="text" class="form-control" id="searchInput" placeholder="{{ __('test.search') }}">
                    </div>
                    <div class="col-md-3">
                        <select class="form-select" id="statusFilter">
                            <option value="all">{{ __('test.all_status') }}</option>
                            <option value="active">{{ __('test.active') }}</option>
                            <option value="pending">{{ __('test.pending') }}</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <button class="btn-gradient w-100" data-bs-toggle="modal" data-bs-target="#addTestModal">
                            <i class="fas fa-plus"></i> {{ __('test.add_test') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Testlar jadvali -->
    <div class="data-table">
        <table class="table mb-0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>{{ __('test.test_name') }}</th>
                    <th>{{ __('test.category') }}</th>
                    <th>{{ __('test.questions') }}</th>
                    <th>{{ __('test.time') }}</th>
                    <th>{{ __('test.participants') }}</th>
                    <th>{{ __('test.status') }}</th>
                    <th>{{ __('test.actions') }}</th>
                </tr>
            </thead>
            <tbody id="tableBody"></tbody>
        </table>
    </div>
</div>

<!-- Add Test Modal -->
<div class="modal fade" id="addTestModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-plus"></i> {{ __('test.add_test') }}</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">{{ __('test.test_name') }}</label>
                    <input type="text" class="form-control" id="testName" placeholder="{{ __('test.test_name') }}">
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">{{ __('test.category') }}</label>
                        <select class="form-select" id="testCat">
                            <option>Backend</option>
                            <option>Frontend</option>
                            <option>AI</option>
                            <option>Security</option>
                            <option>Digital Kids</option>
                            <option>Robototexnika</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">{{ __('test.status') }}</label>
                        <select class="form-select" id="testStatus">
                            <option value="active">{{ __('test.active') }}</option>
                            <option value="pending">{{ __('test.pending') }}</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">{{ __('test.questions') }}</label>
                        <input type="number" class="form-control" id="testQ" value="20">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">{{ __('test.time_min') }}</label>
                        <input type="number" class="form-control" id="testTime" value="30">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-gradient" data-bs-dismiss="modal">{{ __('test.cancel') }}</button>
                <button type="button" class="btn-gradient" onclick="addTest()">{{ __('test.save') }}</button>
            </div>
        </div>
    </div>
</div>

<script>
let tests = [
    {id:1, name:"Laravel Asoslari", cat:"Backend", q:25, time:45, parts:48, status:"active"},
    {id:2, name:"PHP Dasturlash", cat:"Backend", q:30, time:60, parts:62, status:"active"},
    {id:3, name:"React.js", cat:"Frontend", q:28, time:50, parts:41, status:"active"},
    {id:4, name:"Python AI", cat:"AI", q:35, time:75, parts:35, status:"pending"}
];
let nextId = 5;

function getStatusText(status) {
    let lang = '{{ app()->getLocale() }}';
    if(status == 'active') return lang == 'uz' ? 'Faol' : (lang == 'ru' ? 'Активный' : 'Active');
    return lang == 'uz' ? 'Kutilmoqda' : (lang == 'ru' ? 'Ожидание' : 'Pending');
}

function getStatusClass(status) {
    return status == 'active' ? 'badge-active' : 'badge-pending';
}

function renderTable() {
    let search = document.getElementById('searchInput').value.toLowerCase();
    let filter = document.getElementById('statusFilter').value;
    let filtered = tests.filter(t => t.name.toLowerCase().includes(search) && (filter == 'all' || t.status == filter));
    let html = '';
    filtered.forEach(t => {
        html += `<tr>
            <td>${t.id}</td>
            <td><strong>${t.name}</strong></td>
            <td>${t.cat}</td>
            <td>${t.q}</td>
            <td>${t.time} min</td>
            <td>${t.parts}</td>
            <td><span class="badge ${getStatusClass(t.status)}">${getStatusText(t.status)}</span></td>
            <td>
                <button class="btn btn-sm btn-outline-gradient" onclick="viewTest(${t.id})"><i class="fas fa-eye"></i></button>
                <button class="btn btn-sm btn-outline-gradient" onclick="editTest(${t.id})"><i class="fas fa-edit"></i></button>
                <button class="btn btn-sm btn-outline-gradient" onclick="deleteTest(${t.id})"><i class="fas fa-trash"></i></button>
            </td>
        </tr>`;
    });
    if(filtered.length == 0) html = `<tr><td colspan="8" class="text-center">{{ __('test.no_data') }}</td></tr>`;
    document.getElementById('tableBody').innerHTML = html;
    
    document.getElementById('totalTests').innerText = tests.length;
    let parts = tests.reduce((s,t)=>s+t.parts,0);
    document.getElementById('totalParts').innerText = parts;
    document.getElementById('avgScore').innerText = (tests.length ? Math.round(parts/tests.length) : 0) + '%';
}

function addTest() {
    let name = document.getElementById('testName').value;
    if(!name) { alert('{{ __("test.enter_name") }}'); return; }
    tests.push({
        id: nextId++, 
        name: name, 
        cat: document.getElementById('testCat').value, 
        q: parseInt(document.getElementById('testQ').value) || 20, 
        time: parseInt(document.getElementById('testTime').value) || 30, 
        parts: 0, 
        status: document.getElementById('testStatus').value
    });
    renderTable();
    bootstrap.Modal.getInstance(document.getElementById('addTestModal')).hide();
    document.getElementById('testName').value = '';
    alert('{{ __("test.added") }}');
}

function viewTest(id) {
    let t = tests.find(t => t.id == id);
    alert('{{ __("test.test_info") }}\n{{ __("test.test_name") }}: ' + t.name + '\n{{ __("test.category") }}: ' + t.cat + '\n{{ __("test.questions") }}: ' + t.q + '\n{{ __("test.time") }}: ' + t.time + ' min\n{{ __("test.participants") }}: ' + t.parts);
}

function editTest(id) {
    let t = tests.find(t => t.id == id);
    let newName = prompt('{{ __("test.new_name") }}', t.name);
    if(newName) { t.name = newName; renderTable(); alert('{{ __("test.updated") }}'); }
}

function deleteTest(id) {
    if(confirm('{{ __("test.confirm_delete") }}')) {
        tests = tests.filter(t => t.id != id);
        renderTable();
        alert('{{ __("test.deleted") }}');
    }
}

document.getElementById('searchInput').addEventListener('keyup', renderTable);
document.getElementById('statusFilter').addEventListener('change', renderTable);
renderTable();
</script>
@endsection