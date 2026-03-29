@extends('layouts.app')

@section('styles')
<style>
    :root {
        --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        --card-shadow: 0 10px 40px rgba(0,0,0,0.08);
        --hover-shadow: 0 20px 60px rgba(0,0,0,0.12);
    }

    .courses-header {
        background: var(--primary-gradient);
        border-radius: 20px;
        padding: 2rem;
        margin-bottom: 2rem;
        color: white;
    }

    .course-card {
        background: white;
        border-radius: 16px;
        overflow: hidden;
        transition: all 0.3s ease;
        box-shadow: var(--card-shadow);
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .course-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--hover-shadow);
    }

    .course-image {
        width: 100%;
        height: 200px;
        object-fit: cover;
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    }

    .course-body {
        padding: 1.5rem;
        flex: 1;
    }

    .course-title {
        font-size: 1.25rem;
        font-weight: 600;
        margin-bottom: 0.75rem;
        color: #2d3748;
    }

    .course-description {
        color: #718096;
        font-size: 0.875rem;
        line-height: 1.5;
        margin-bottom: 1rem;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .course-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 0.75rem;
        margin-bottom: 1rem;
        font-size: 0.8rem;
    }

    .meta-badge {
        background: #edf2f7;
        padding: 0.25rem 0.75rem;
        border-radius: 20px;
        color: #4a5568;
    }

    .course-price {
        font-size: 1.5rem;
        font-weight: 700;
        color: #667eea;
        margin: 1rem 0;
    }

    .btn-gradient {
        background: var(--primary-gradient);
        color: white;
        border: none;
        padding: 0.5rem 1rem;
        border-radius: 10px;
        transition: all 0.3s ease;
    }

    .btn-gradient:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        color: white;
    }

    .btn-outline-danger:hover {
        transform: translateY(-2px);
    }

    .modal-content {
        border-radius: 20px;
        border: none;
    }

    .modal-header {
        background: var(--primary-gradient);
        color: white;
        border-radius: 20px 20px 0 0;
        padding: 1.5rem;
    }

    .modal-header .btn-close {
        filter: brightness(0) invert(1);
    }

    .form-control, .form-select {
        border-radius: 10px;
        border: 1px solid #e2e8f0;
        padding: 0.625rem 1rem;
    }

    .form-control:focus, .form-select:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    }

    .category-item {
        background: #f7fafc;
        border-radius: 10px;
        padding: 0.75rem;
        margin-bottom: 0.5rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        transition: all 0.2s ease;
    }

    .category-item:hover {
        background: #edf2f7;
    }

    .btn-icon {
        padding: 0.25rem 0.5rem;
        border-radius: 8px;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .course-card {
        animation: fadeIn 0.5s ease-out;
    }

    /* Loading spinner */
    .loading-spinner {
        display: inline-block;
        width: 20px;
        height: 20px;
        border: 3px solid rgba(255,255,255,.3);
        border-radius: 50%;
        border-top-color: white;
        animation: spin 1s ease-in-out infinite;
    }

    @keyframes spin {
        to { transform: rotate(360deg); }
    }

    /* Empty state */
    .empty-state {
        text-align: center;
        padding: 4rem;
        background: white;
        border-radius: 20px;
        box-shadow: var(--card-shadow);
    }

    .empty-state i {
        font-size: 4rem;
        color: #cbd5e0;
        margin-bottom: 1rem;
    }
</style>
@endsection

@section('content')
<div class="container py-4">
    <div class="courses-header">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div>
                <h1 class="display-5 fw-bold mb-2">Управление курсами</h1>
                <p class="mb-0 opacity-75">Создавайте, редактируйте и управляйте вашими образовательными курсами</p>
            </div>
            <button class="btn btn-light btn-lg" onclick="openCreateModal()">
                <i class="fas fa-plus me-2"></i>Создать курс
            </button>
        </div>
    </div>

    <div class="row g-4" id="coursesContainer">
        @forelse($courses as $course)
        <div class="col-md-6 col-lg-4">
            <div class="course-card">
                @if($course->img)
                <img src="{{ Storage::url($course->img) }}" class="course-image" alt="{{ $course->name }}">
                @else
                <div class="course-image d-flex align-items-center justify-content-center">
                    <i class="fas fa-graduation-cap fa-4x text-white-50"></i>
                </div>
                @endif
                <div class="course-body">
                    <h3 class="course-title">{{ $course->name }}</h3>
                    <p class="course-description">{{ Str::limit($course->description, 100) }}</p>
                    <div class="course-meta">
                        @if($course->framework_name)
                        <span class="meta-badge"><i class="fas fa-code me-1"></i>{{ $course->framework_name }}</span>
                        @endif
                        @if($course->interpretator_name)
                        <span class="meta-badge"><i class="fas fa-language me-1"></i>{{ $course->interpretator_name }}</span>
                        @endif
                        @if($course->duration_time)
                        <span class="meta-badge"><i class="fas fa-clock me-1"></i>{{ $course->duration_time }}</span>
                        @endif
                    </div>
                    @if($course->mentor_name)
                    <div class="mb-2">
                        <i class="fas fa-chalkboard-user me-2 text-muted"></i>
                        <small class="text-muted">{{ $course->mentor_name }}</small>
                    </div>
                    @endif
                    @if($course->price)
                    <div class="course-price">{{ number_format($course->price, 0, ' ', ' ') }} ₽</div>
                    @endif
                    <div class="d-flex gap-2">
                        <button class="btn btn-gradient flex-grow-1" onclick="openEditModal({{ $course->id }})">
                            <i class="fas fa-edit me-1"></i>Редактировать
                        </button>
                        <button class="btn btn-outline-danger" onclick="deleteCourse({{ $course->id }})">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="empty-state">
                <i class="fas fa-graduation-cap"></i>
                <h4 class="text-muted">Нет курсов</h4>
                <p class="text-muted">Создайте первый курс, нажав кнопку "Создать курс"</p>
            </div>
        </div>
        @endforelse
    </div>
</div>

<!-- Modal Create/Edit -->
<div class="modal fade" id="courseModal" tabindex="-1" aria-labelledby="courseModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Создание курса</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="courseForm" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="courseId" name="course_id">
                    <input type="hidden" id="_method" name="_method" value="POST">
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold">Название курса <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold">Описание</label>
                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Фреймворк</label>
                            <select class="form-select" id="id_fremwork" name="id_fremwork">
                                <option value="">Выберите фреймворк</option>
                                @foreach($frameworks as $framework)
                                <option value="{{ $framework->id }}">{{ $framework->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Интерпретатор</label>
                            <select class="form-select" id="id_interpretator" name="id_interpretator">
                                <option value="">Выберите интерпретатор</option>
                                @foreach($interpretators as $interpretator)
                                <option value="{{ $interpretator->id }}">{{ $interpretator->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Длительность</label>
                            <input type="text" class="form-control" id="duration_time" name="duration_time" placeholder="например: 3 месяца">
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Ментор</label>
                            <input type="text" class="form-control" id="mentor_name" name="mentor_name">
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Цена (₽)</label>
                            <input type="number" class="form-control" id="price" name="price" step="0.01">
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Изображение</label>
                            <input type="file" class="form-control" id="img" name="img" accept="image/*">
                            <div id="currentImage" class="mt-2" style="display: none;">
                                <small class="text-muted">Текущее изображение:</small><br>
                                <img id="currentImagePreview" src="" style="max-height: 100px;" class="rounded mt-1">
                            </div>
                        </div>
                    </div>
                    
                    <div id="categoriesSection" style="display: none;">
                        <hr>
                        <h6 class="fw-bold mb-3">Категории курса</h6>
                        <div id="categoriesList"></div>
                        <div class="input-group mt-2">
                            <input type="text" id="newCategoryName" class="form-control" placeholder="Название категории">
                            <input type="text" id="newCategoryDesc" class="form-control" placeholder="Описание (необязательно)">
                            <button type="button" class="btn btn-gradient" onclick="addCategory()">
                                <i class="fas fa-plus"></i> Добавить
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                <button type="button" class="btn btn-gradient" onclick="saveCourse()" id="saveButton">
                    <span id="saveButtonText">Сохранить</span>
                    <span id="saveButtonSpinner" class="loading-spinner" style="display: none;"></span>
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
// Дожидаемся полной загрузки DOM
document.addEventListener('DOMContentLoaded', function() {
    // Проверяем наличие Bootstrap
    if (typeof bootstrap === 'undefined') {
        console.error('Bootstrap не загружен');
        return;
    }
    
    // Инициализируем модальное окно
    window.courseModalElement = document.getElementById('courseModal');
    if (window.courseModalElement) {
        window.courseModal = new bootstrap.Modal(window.courseModalElement);
    }
});

// Глобальные переменные
let currentCourseId = null;

function openCreateModal() {
    if (!window.courseModal) {
        console.error('Модальное окно не инициализировано');
        return;
    }
    
    // Сброс формы
    const form = document.getElementById('courseForm');
    if (form) form.reset();
    
    document.getElementById('modalTitle').innerText = 'Создание курса';
    document.getElementById('courseId').value = '';
    document.getElementById('_method').value = 'POST';
    document.getElementById('categoriesSection').style.display = 'none';
    document.getElementById('currentImage').style.display = 'none';
    
    // Сброс ошибок валидации
    document.querySelectorAll('.is-invalid').forEach(el => {
        el.classList.remove('is-invalid');
    });
    document.querySelectorAll('.invalid-feedback').forEach(el => {
        el.remove();
    });
    
    currentCourseId = null;
    window.courseModal.show();
}

function openEditModal(id) {
    if (!window.courseModal) {
        console.error('Модальное окно не инициализировано');
        return;
    }
    
    // Показываем индикатор загрузки
    const saveButton = document.getElementById('saveButton');
    if (saveButton) saveButton.disabled = true;
    
    fetch(`/my-courses/${id}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Ошибка загрузки данных');
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                document.getElementById('modalTitle').innerText = 'Редактирование курса';
                document.getElementById('courseId').value = data.course.id;
                document.getElementById('_method').value = 'PUT';
                document.getElementById('name').value = data.course.name || '';
                document.getElementById('description').value = data.course.description || '';
                document.getElementById('id_fremwork').value = data.course.id_fremwork || '';
                document.getElementById('id_interpretator').value = data.course.id_interpretator || '';
                document.getElementById('duration_time').value = data.course.duration_time || '';
                document.getElementById('mentor_name').value = data.course.mentor_name || '';
                document.getElementById('price').value = data.course.price || '';
                
                if (data.course.img) {
                    const imgPreview = document.getElementById('currentImagePreview');
                    if (imgPreview) {
                        imgPreview.src = `/storage/${data.course.img}`;
                    }
                    document.getElementById('currentImage').style.display = 'block';
                } else {
                    document.getElementById('currentImage').style.display = 'none';
                }
                
                displayCategories(data.categories || []);
                document.getElementById('categoriesSection').style.display = 'block';
                currentCourseId = data.course.id;
                window.courseModal.show();
            } else {
                alert(data.message || 'Ошибка загрузки данных курса');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Ошибка загрузки данных курса: ' + error.message);
        })
        .finally(() => {
            const saveButton = document.getElementById('saveButton');
            if (saveButton) saveButton.disabled = false;
        });
}

function displayCategories(categories) {
    const container = document.getElementById('categoriesList');
    if (!container) return;
    
    container.innerHTML = '';
    
    if (!categories || categories.length === 0) {
        container.innerHTML = '<p class="text-muted text-center">Нет категорий</p>';
        return;
    }
    
    categories.forEach(cat => {
        const categoryDiv = document.createElement('div');
        categoryDiv.className = 'category-item';
        categoryDiv.innerHTML = `
            <div>
                <strong>${escapeHtml(cat.name)}</strong>
                ${cat.description ? `<br><small class="text-muted">${escapeHtml(cat.description)}</small>` : ''}
            </div>
            <button class="btn btn-sm btn-outline-danger btn-icon" onclick="deleteCategory(${cat.id})">
                <i class="fas fa-trash"></i>
            </button>
        `;
        container.appendChild(categoryDiv);
    });
}

function addCategory() {
    const nameInput = document.getElementById('newCategoryName');
    const descInput = document.getElementById('newCategoryDesc');
    
    if (!nameInput || !descInput) return;
    
    const name = nameInput.value.trim();
    const description = descInput.value.trim();
    
    if (!name) {
        alert('Введите название категории');
        return;
    }
    
    if (!currentCourseId) {
        alert('Сначала сохраните курс');
        return;
    }
    
    // Отключаем кнопку добавления
    const addButton = event.target;
    if (addButton) addButton.disabled = true;
    
    fetch(`/my-courses/${currentCourseId}/add-category`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({ name, description })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            nameInput.value = '';
            descInput.value = '';
            openEditModal(currentCourseId);
        } else {
            alert(data.message || 'Ошибка при добавлении категории');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Ошибка при добавлении категории');
    })
    .finally(() => {
        if (addButton) addButton.disabled = false;
    });
}

function deleteCategory(categoryId) {
    if (!confirm('Вы уверены, что хотите удалить эту категорию?')) return;
    
    fetch(`/my-courses/delete-category/${categoryId}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            openEditModal(currentCourseId);
        } else {
            alert(data.message || 'Ошибка при удалении категории');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Ошибка при удалении категории');
    });
}

function saveCourse() {
    const form = document.getElementById('courseForm');
    if (!form) return;
    
    const formData = new FormData(form);
    const courseId = document.getElementById('courseId').value;
    const method = document.getElementById('_method').value;
    
    let url = '/my-courses';
    if (courseId && method === 'PUT') {
        url = `/my-courses/${courseId}`;
        formData.append('_method', 'PUT');
    }
    
    // Показываем индикатор загрузки
    const saveButton = document.getElementById('saveButton');
    const saveButtonText = document.getElementById('saveButtonText');
    const saveButtonSpinner = document.getElementById('saveButtonSpinner');
    
    if (saveButton) saveButton.disabled = true;
    if (saveButtonText) saveButtonText.style.opacity = '0.5';
    if (saveButtonSpinner) saveButtonSpinner.style.display = 'inline-block';
    
    fetch(url, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            if (window.courseModal) window.courseModal.hide();
            location.reload();
        } else {
            alert(data.message || 'Ошибка при сохранении курса');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Ошибка при сохранении курса: ' + error.message);
    })
    .finally(() => {
        if (saveButton) saveButton.disabled = false;
        if (saveButtonText) saveButtonText.style.opacity = '1';
        if (saveButtonSpinner) saveButtonSpinner.style.display = 'none';
    });
}

function deleteCourse(id) {
    if (!confirm('Вы уверены, что хотите удалить этот курс? Это действие нельзя отменить.')) return;
    
    fetch(`/my-courses/${id}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload();
        } else {
            alert(data.message || 'Ошибка при удалении курса');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Ошибка при удалении курса');
    });
}

function escapeHtml(text) {
    if (!text) return '';
    const div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
}
</script>
@endsection