@extends('admin.layouts.app')

@section('title', 'Testlar ro\'yxati')
@section('page-title', 'Testlar Boshqaruvi')

@section('content')
<div class="container-fluid">
    <!-- Statistikalar -->
    <div class="row mb-4">
        <div class="col-md-3 mb-3">
            <div class="stat-card">
                <div class="stat-icon" style="background: linear-gradient(135deg, #667eea20, #764ba220); color: #667eea;">
                    <i class="fas fa-tasks"></i>
                </div>
                <div class="stat-value">24</div>
                <div class="stat-label">Jami testlar</div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="stat-card">
                <div class="stat-icon" style="background: linear-gradient(135deg, #10b98120, #05966920); color: #10b981;">
                    <i class="fas fa-user-check"></i>
                </div>
                <div class="stat-value">156</div>
                <div class="stat-label">Qatnashchilar</div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="stat-card">
                <div class="stat-icon" style="background: linear-gradient(135deg, #f59e0b20, #d9770620); color: #f59e0b;">
                    <i class="fas fa-chart-line"></i>
                </div>
                <div class="stat-value">78%</div>
                <div class="stat-label">O'rtacha natija</div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="stat-card">
                <div class="stat-icon" style="background: linear-gradient(135deg, #ef444420, #dc262620); color: #ef4444;">
                    <i class="fas fa-hourglass-half"></i>
                </div>
                <div class="stat-value">12</div>
                <div class="stat-label">Faol testlar</div>
            </div>
        </div>
    </div>
    
    <!-- Qidiruv va filter -->
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="stat-card">
                <div class="row">
                    <div class="col-md-6">
                        <input type="text" class="form-control" placeholder="🔍 Test nomi bo'yicha qidirish...">
                    </div>
                    <div class="col-md-3">
                        <select class="form-select">
                            <option>Barcha holatlar</option>
                            <option>Faol</option>
                            <option>Kutilmoqda</option>
                            <option>Arxiv</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <button class="btn-gradient w-100" data-bs-toggle="modal" data-bs-target="#addTestModal">
                            <i class="fas fa-plus"></i> Yangi test qo'shish
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
                    <th>Test nomi</th>
                    <th>Kategoriya</th>
                    <th>Savollar</th>
                    <th>Vaqt (min)</th>
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
                    <td>45</td>
                    <td>48</td>
                    <td><span class="badge badge-active">Faol</span></td>
                    <td>
                        <button class="btn btn-sm btn-outline-gradient" onclick="viewTest(1)">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button class="btn btn-sm btn-outline-gradient" onclick="editTest(1)">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn btn-sm btn-outline-gradient" onclick="deleteTest(1)">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td><strong>PHP Dasturlash</strong></td>
                    <td>Backend</td>
                    <td>30</td>
                    <td>60</td>
                    <td>62</td>
                    <td><span class="badge badge-active">Faol</span></td>
                    <td>
                        <button class="btn btn-sm btn-outline-gradient"><i class="fas fa-eye"></i></button>
                        <button class="btn btn-sm btn-outline-gradient"><i class="fas fa-edit"></i></button>
                        <button class="btn btn-sm btn-outline-gradient"><i class="fas fa-trash"></i></button>
                    </td>
                </tr>
                <tr>
                    <td>3</td>
                    <td><strong>Frontend (React)</strong></td>
                    <td>Frontend</td>
                    <td>28</td>
                    <td>50</td>
                    <td>41</td>
                    <td><span class="badge badge-active">Faol</span></td>
                    <td>
                        <button class="btn btn-sm btn-outline-gradient"><i class="fas fa-eye"></i></button>
                        <button class="btn btn-sm btn-outline-gradient"><i class="fas fa-edit"></i></button>
                        <button class="btn btn-sm btn-outline-gradient"><i class="fas fa-trash"></i></button>
                    </td>
                </tr>
                <tr>
                    <td>4</td>
                    <td><strong>Python AI</strong></td>
                    <td>Sun'iy Intellekt</td>
                    <td>35</td>
                    <td>75</td>
                    <td>35</td>
                    <td><span class="badge badge-pending">Kutilmoqda</span></td>
                    <td>
                        <button class="btn btn-sm btn-outline-gradient"><i class="fas fa-eye"></i></button>
                        <button class="btn btn-sm btn-outline-gradient"><i class="fas fa-edit"></i></button>
                        <button class="btn btn-sm btn-outline-gradient"><i class="fas fa-trash"></i></button>
                    </td>
                </tr>
                <tr>
                    <td>5</td>
                    <td><strong>Cybersecurity</strong></td>
                    <td>Xavfsizlik</td>
                    <td>40</td>
                    <td>90</td>
                    <td>28</td>
                    <td><span class="badge badge-inactive">Arxiv</span></td>
                    <td>
                        <button class="btn btn-sm btn-outline-gradient"><i class="fas fa-eye"></i></button>
                        <button class="btn btn-sm btn-outline-gradient"><i class="fas fa-edit"></i></button>
                        <button class="btn btn-sm btn-outline-gradient"><i class="fas fa-trash"></i></button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<!-- Add Test Modal -->
<div class="modal fade" id="addTestModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-plus"></i> Yangi test qo'shish</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
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
                                <option>Ma'lumotlar bazasi</option>
                                <option>DevOps</option>
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
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-gradient" data-bs-dismiss="modal">Bekor qilish</button>
                <button type="button" class="btn-gradient" onclick="alert('Test qo\'shildi!')">Saqlash</button>
            </div>
        </div>
    </div>
</div>

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
</script>
@endsection