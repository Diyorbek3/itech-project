@extends('layouts.app')

@section('styles')
<style>
    /* ============================================================
       MODERN PREMIUM MODAL STYLING
       ============================================================ */
    :root {
        --modal-grad: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
        --modal-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.2);
        --input-focus: #6366f1;
        --input-bg: #f8fafc;
        --accent-color: #4f46e5;
    }

    /* Yangi qo'shish div uchun stil */
    .add-course-card {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 20px;
        padding: 24px 32px;
        margin-bottom: 30px;
        cursor: pointer;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 10px 30px -10px rgba(79, 70, 229, 0.4);
        border: 1px solid rgba(255, 255, 255, 0.1);
    }
    .add-course-card:hover {
        transform: translateY(-5px) scale(1.01);
        box-shadow: 0 20px 40px -10px rgba(79, 70, 229, 0.5);
    }
    .add-course-card .add-icon {
        width: 64px;
        height: 64px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 30px;
        color: white;
        margin-right: 24px;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.3);
    }
    .add-course-card .add-text h3 {
        color: white;
        font-weight: 800;
        margin: 0;
        font-size: 24px;
        letter-spacing: -0.5px;
    }
    .add-course-card .add-text p {
        color: rgba(255, 255, 255, 0.8);
        margin: 4px 0 0;
        font-size: 15px;
    }

    #courseModal .modal-content {
        border: none;
        border-radius: 32px;
        box-shadow: var(--modal-shadow);
        overflow: hidden;
        background: #ffffff;
    }

    #courseModal .modal-header {
        background: var(--modal-grad);
        padding: 40px;
        border: none;
        position: relative;
    }

    #courseModal .modal-title {
        font-weight: 800;
        font-size: 26px;
        color: #ffffff;
        letter-spacing: -0.5px;
    }

    #courseModal .btn-close-white {
        background-color: rgba(255, 255, 255, 0.15);
        padding: 12px;
        border-radius: 14px;
        opacity: 1;
        transition: all 0.3s ease;
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    #courseModal .btn-close-white:hover {
        background-color: rgba(255, 255, 255, 0.3);
        transform: rotate(90deg);
    }

    #courseModal .modal-body {
        padding: 40px;
        max-height: 80vh;
        overflow-y: auto;
        background: #fff;
    }

    #courseModal .section-label {
        display: flex;
        align-items: center;
        font-size: 13px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        color: var(--accent-color);
        margin: 35px 0 20px 0;
        gap: 12px;
    }

    .table tbody td {
        padding: 18px 20px;
        vertical-align: middle;
        border-bottom: 1px solid #f1f5f9;
        color: #334155;
    }
    .table thead th {
        vertical-align: middle;
        background: #f8fafc;
        border: none;
        padding: 20px;
        font-size: 12px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: #64748b;
    }

    #courseModal .section-label::after {
        content: "";
        flex: 1;
        height: 1px;
        background: linear-gradient(to right, #e2e8f0, transparent);
    }

    #courseModal .section-label:first-child {
        margin-top: 0;
    }

    .form-group-custom {
        margin-bottom: 24px;
    }

    .form-group-custom label {
        display: block;
        font-weight: 700;
        color: #334155;
        margin-bottom: 10px;
        font-size: 14px;
        transition: color 0.3s ease;
    }

    .form-control-modern {
        border-radius: 16px;
        padding: 14px 20px;
        border: 2px solid #f1f5f9;
        background: #f8fafc;
        font-size: 15px;
        color: #1e293b;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .form-control-modern:focus {
        border-color: var(--accent-color);
        background: #ffffff;
        box-shadow: 0 0 0 5px rgba(99, 102, 241, 0.1);
        transform: translateY(-1px);
        outline: none;
    }

    .input-icon-wrapper {
        position: relative;
    }

    .input-icon {
        position: absolute;
        left: 18px;
        top: 50%;
        transform: translateY(-50%);
        color: #94a3b8;
        font-size: 16px;
        transition: color 0.3s ease;
    }

    .with-icon {
        padding-left: 50px !important;
    }

    .form-group-custom:focus-within .input-icon {
        color: var(--accent-color);
    }

    .form-group-custom:focus-within label {
        color: var(--accent-color);
    }

    #courseModal .modal-footer {
        padding: 30px 40px;
        border-top: 1px solid #f1f5f9;
        background: #fdfdfd;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .btn-save-course {
        background: var(--modal-grad);
        border: none;
        border-radius: 18px;
        padding: 16px 45px;
        font-weight: 800;
        color: white;
        font-size: 16px;
        box-shadow: 0 10px 25px -5px rgba(79, 70, 229, 0.4);
        transition: all 0.3s ease;
    }

    .btn-save-course:hover {
        transform: translateY(-3px) scale(1.02);
        box-shadow: 0 20px 30px -5px rgba(79, 70, 229, 0.5);
        color: white;
    }

    .btn-cancel-modern {
        background: #f1f5f9;
        color: #64748b;
        border: none;
        border-radius: 18px;
        padding: 16px 30px;
        font-weight: 700;
        transition: all 0.3s ease;
    }

    .btn-cancel-modern:hover {
        background: #e2e8f0;
        color: #334155;
    }

    .image-preview-container {
        width: 100%;
        height: 180px;
        border-radius: 20px;
        border: 2px dashed #e2e8f0;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        background: #f8fafc;
        margin-top: 10px;
        position: relative;
    }

    .image-preview-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .course-img-wrapper {
        width: 80px;
        height: 48px;
        border-radius: 10px;
        overflow: hidden;
        background: #f1f5f9;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        border: 1px solid #e2e8f0;
    }
    .course-img-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    tr:hover .course-img-wrapper img {
        transform: scale(1.1);
    }

    .image-preview-placeholder {
        text-align: center;
        color: #94a3b8;
    }

    .image-preview-placeholder i {
        font-size: 40px;
        margin-bottom: 10px;
        opacity: 0.5;
    }

    /* Scrollbar */
    #courseModal .modal-body::-webkit-scrollbar {
        width: 8px;
    }
    #courseModal .modal-body::-webkit-scrollbar-track {
        background: #f8fafc;
    }
    #courseModal .modal-body::-webkit-scrollbar-thumb {
        background: #e2e8f0;
        border-radius: 10px;
    }
    #courseModal .modal-body::-webkit-scrollbar-thumb:hover {
        background: #cbd5e1;
    }

</style>
@endsection

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">📚 {{ __('messages.course_management') }}</h2>
            <p class="text-muted">{{ __('messages.course_management_desc') }}</p>
        </div>
        <!-- Eski tugma o'rniga YANGI DIV -->
        <!-- <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#courseModal" onclick="openCreateModal()"> -->
        <!--     <i class="fas fa-plus me-2"></i>{{ __('messages.add_new_course') }} -->
        <!-- </button> -->
    </div>

    <!-- ========== YANGI QO'SHISH DIVI - RASMDAGIDEK ========== -->
    <div class="add-course-card d-flex align-items-center justify-content-between" data-bs-toggle="modal" data-bs-target="#courseModal" onclick="openCreateModal()">
        <div class="d-flex align-items-center">
            <div class="add-icon">
                <i class="fas fa-graduation-cap"></i>
            </div>
            <div class="add-text">
                <h3><i class="fas fa-plus-circle me-2"></i>{{ __('messages.add_new_course') }}</h3>
                <p>Yangi kurs qo'shing, talabalar soni va boshqa ma'lumotlarni kiriting</p>
            </div>
        </div>
        <div class="plus-icon">
            <i class="fas fa-arrow-right"></i>
        </div>
    </div>
    <!-- ========== YANGI QO'SHISH DIVI TUGADI ========== -->

    <div class="course-table-container">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th style="width: 100px">{{ __('messages.image') }}</th>
                        <th>{{ __('messages.title') }}</th>
                        <th>{{ __('messages.price') }}</th>
                        <th>{{ __('messages.duration') }}</th>
                        <th>{{ __('messages.certificate') }}</th>
                        <th style="width: 150px" class="text-center">{{ __('messages.actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($courses as $course)
                    <tr>
                        <td>
                            <div class="course-img-wrapper">
                                @if($course->image)
                                    <img src="{{ asset('storage/courses/' . $course->image) }}" alt="{{ $course->title }}">
                                @else
                                    <div class="bg-light d-flex align-items-center justify-content-center h-100">
                                        <i class="fas fa-image text-muted"></i>
                                    </div>
                                @endif
                            </div>
                        </td>
                        <td class="course-title-cell">{{ $course->title }}</td>
                        <td><span class="price-badge">{{ number_format($course->price) }} {{ __('messages.price_per_month') }}</span></td>
                        <td>
                            <span class="duration-text">
                                <i class="far fa-clock text-primary"></i>
                                {{ $course->duration ?? '—' }}
                            </span>
                        </td>
                        <td>
                            @if($course->has_certificate)
                                <span class="status-badge status-has"><i class="fas fa-check-circle me-1"></i>{{ __('messages.has') }}</span>
                            @else
                                <span class="status-badge status-no"><i class="fas fa-times-circle me-1"></i>{{ __('messages.no') }}</span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex justify-content-center gap-2">
                                <button class="btn-action btn-edit-course" onclick="openEditModal({{ $course->id }})" title="{{ __('messages.edit_course') }}">
                                    <i class="fas fa-pen-nib"></i>
                                </button>
                                <button class="btn-action btn-delete-course" onclick="deleteCourse({{ $course->id }})" title="{{ __('messages.delete_course') }}">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5">
                            <i class="fas fa-layer-group fa-3x text-muted mb-3 d-block opacity-25"></i>
                            <h5 class="text-muted fw-bold">{{ __('messages.no_courses_yet') }}</h5>
                            <div class="add-course-card-small mt-3 d-inline-flex" data-bs-toggle="modal" data-bs-target="#courseModal" onclick="openCreateModal()" style="background: var(--modal-grad); border-radius: 12px; padding: 12px 24px; cursor: pointer; color: white;">
                                <i class="fas fa-plus me-2"></i>
                                <span>{{ __('messages.add_first_course') }}</span>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="courseModal" tabindex="-1" aria-labelledby="courseModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">
                    <i class="fas fa-graduation-cap me-2"></i>{{ __('messages.add_new_course') }}
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="courseForm" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="course_id" name="course_id">
                    <input type="hidden" id="_method" name="_method" value="POST">

                    <div class="row">
                        <!-- Left Column: Primary Info -->
                        <div class="col-lg-7">
                            <div class="section-label">
                                <i class="fas fa-info-circle"></i> Asosiy ma'lumotlar
                            </div>
                            
                            <div class="form-group-custom">
                                <label>{{ __('messages.course_name') }} <span class="text-danger">*</span></label>
                                <div class="input-icon-wrapper">
                                    <i class="fas fa-bookmark input-icon"></i>
                                    <input type="text" class="form-control form-control-modern with-icon" id="title" name="title" placeholder="Masalan: Python Dasturlash" required>
                                    <div class="invalid-feedback" id="title_error"></div>
                                </div>
                            </div>

                            <div class="form-group-custom">
                                <label>{{ __('messages.short_description') }}</label>
                                <div class="input-icon-wrapper">
                                    <i class="fas fa-align-left input-icon"></i>
                                    <input type="text" class="form-control form-control-modern with-icon" id="short_description" name="short_description" placeholder="Bir jumlada tavsif bering...">
                                </div>
                            </div>

                            <div class="form-group-custom">
                                <label>{{ __('messages.full_description') }}</label>
                                <textarea class="form-control form-control-modern" id="full_description" name="full_description" rows="5" placeholder="Kurs haqida batafsil ma'lumot..."></textarea>
                            </div>

                            <div class="section-label">
                                <i class="fas fa-tasks"></i> Kurs tarkibi va auditoriyasi
                            </div>

                            <div class="form-group-custom">
                                <label>{{ __('messages.curriculum') }}</label>
                                <textarea class="form-control form-control-modern" id="curriculum" name="curriculum" rows="6" placeholder="### 1-Modul..."></textarea>
                            </div>

                            <div class="form-group-custom">
                                <label>{{ __('messages.target_audience') }}</label>
                                <textarea class="form-control form-control-modern" id="target_audience" name="target_audience" rows="3" placeholder="Bu kurs kimlar uchun?"></textarea>
                            </div>
                        </div>

                        <!-- Right Column: Details & Media -->
                        <div class="col-lg-5">
                            <div class="section-label">
                                <i class="fas fa-image"></i> Media va Muqova
                            </div>

                            <div class="form-group-custom">
                                <label>{{ __('messages.image') }}</label>
                                <input type="file" class="form-control form-control-modern" id="image" name="image" accept="image/*" onchange="previewImage(this)">
                                <div class="invalid-feedback" id="image_error"></div>
                                <div class="image-preview-container mt-3" id="imagePreviewContainer">
                                    <div class="image-preview-placeholder" id="previewPlaceholder">
                                        <i class="fas fa-cloud-upload-alt"></i>
                                        <p class="mb-0">Rasm tanlanmagan</p>
                                    </div>
                                    <img id="imagePreview" src="" style="display: none;">
                                </div>
                            </div>

                            <div class="section-label">
                                <i class="fas fa-sliders-h"></i> Texnik detallar
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group-custom">
                                        <label>{{ __('messages.duration') }}</label>
                                        <div class="input-icon-wrapper">
                                            <i class="fas fa-calendar-alt input-icon"></i>
                                            <input type="text" class="form-control form-control-modern with-icon" id="duration" name="duration" placeholder="3 oy">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group-custom">
                                        <label>{{ __('messages.price') }}</label>
                                        <div class="input-icon-wrapper">
                                            <i class="fas fa-tag input-icon"></i>
                                            <input type="number" class="form-control form-control-modern with-icon" id="price" name="price" placeholder="850000">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group-custom">
                                        <label>{{ __('messages.student_count') }}</label>
                                        <div class="input-icon-wrapper">
                                            <i class="fas fa-users input-icon"></i>
                                            <input type="number" class="form-control form-control-modern with-icon" id="student_count" name="student_count" placeholder="100">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group-custom">
                                        <label>{{ __('messages.certificate') }}</label>
                                        <select class="form-select form-control-modern" id="has_certificate" name="has_certificate">
                                            <option value="1">{{ __('messages.has') }}</option>
                                            <option value="0">{{ __('messages.no') }}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group-custom">
                                <label>{{ __('messages.schedule') }}</label>
                                <div class="input-icon-wrapper">
                                    <i class="fas fa-clock input-icon"></i>
                                    <input type="text" class="form-control form-control-modern with-icon" id="schedule" name="schedule" placeholder="Haftada 3 kun">
                                </div>
                            </div>

                            <div class="form-group-custom">
                                <label>{{ __('messages.teachers') }}</label>
                                <div class="input-icon-wrapper">
                                    <i class="fas fa-user-tie input-icon"></i>
                                    <input type="text" class="form-control form-control-modern with-icon" id="teachers" name="teachers" placeholder="O'qituvchilar...">
                                </div>
                            </div>

                            <div class="section-label">
                                <i class="fas fa-link"></i> Havolalar
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group-custom">
                                        <label><i class="fab fa-microsoft-word text-primary me-1"></i> Word</label>
                                        <input type="url" class="form-control form-control-modern" id="word_link" name="word_link" placeholder="https://...">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group-custom">
                                        <label><i class="fab fa-microsoft-excel text-success me-1"></i> Excel</label>
                                        <input type="url" class="form-control form-control-modern" id="excel_link" name="excel_link" placeholder="https://...">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-cancel-modern" data-bs-dismiss="modal">{{ __('messages.cancel') }}</button>
                <button type="button" class="btn-save-course" onclick="saveCourse()">
                    <i class="fas fa-save me-2"></i>{{ __('messages.save') }}
                </button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    let currentCourseId = null;

    const trans = {
        edit_course: "{{ __('messages.edit_course') }}",
        add_new_course: "{{ __('messages.add_new_course') }}",
        success_title: "{{ __('messages.success_title') }}",
        error_title: "{{ __('messages.error_title') }}",
        validation_error: "{{ __('messages.validation_error') }}",
        delete_confirm_title: "{{ __('messages.delete_course') }}",
        delete_confirm_text: "{{ __('messages.delete_confirm_text_course') }}",
        delete_confirm_button: "{{ __('messages.delete_course') }}",
        cancel_button: "{{ __('messages.cancel') }}",
        course_added: "{{ __('messages.course_added_success') }}",
        course_updated: "{{ __('messages.course_updated_success') }}",
        course_deleted: "{{ __('messages.course_deleted_success') }}",
        error_occurred: "{{ __('messages.error_occurred') }}",
        image_not_selected: "Rasm tanlanmagan"
    };

    function previewImage(input) {
        const preview = document.getElementById('imagePreview');
        const placeholder = document.getElementById('previewPlaceholder');
        
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
                placeholder.style.display = 'none';
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    function clearErrors() {
        document.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
        document.querySelectorAll('.invalid-feedback').forEach(el => el.innerHTML = '');
    }

    function showErrors(errors) {
        for (let field in errors) {
            let input = document.getElementById(field) || document.querySelector(`[name="${field}"]`);
            let errorDiv = document.getElementById(`${field}_error`);
            if (input) input.classList.add('is-invalid');
            if (errorDiv) errorDiv.innerHTML = errors[field].join(', ');
        }
    }

    function openCreateModal() {
        clearErrors();
        document.getElementById('modalTitle').innerHTML = `<i class="fas fa-plus-circle me-2"></i>${trans.add_new_course}`;
        document.getElementById('courseForm').reset();
        document.getElementById('course_id').value = '';
        document.getElementById('_method').value = 'POST';
        
        // Reset preview
        document.getElementById('imagePreview').style.display = 'none';
        document.getElementById('previewPlaceholder').style.display = 'block';
        document.getElementById('previewPlaceholder').querySelector('p').innerText = trans.image_not_selected;
        
        currentCourseId = null;
    }

    function openEditModal(id) {
        clearErrors();
        $.get('/courses/' + id + '/edit', function(data) {
            if (data.success) {
                const course = data.course;
                document.getElementById('modalTitle').innerHTML = `<i class="fas fa-pen-nib me-2"></i>${trans.edit_course}`;
                document.getElementById('course_id').value = course.id;
                document.getElementById('_method').value = 'PUT';
                
                // Safe population
                const fields = [
                    'title', 'short_description', 'full_description', 
                    'duration', 'student_count', 'has_certificate', 
                    'price', 'schedule', 'language', 'teachers', 
                    'curriculum', 'target_audience', 'word_link', 
                    'excel_link', 'powerpoint_link', 'archive_link'
                ];

                fields.forEach(field => {
                    const el = document.getElementById(field);
                    if (el) {
                        el.value = course[field] || '';
                    }
                });

                // Image preview
                const preview = document.getElementById('imagePreview');
                const placeholder = document.getElementById('previewPlaceholder');
                if (course.image) {
                    preview.src = '/storage/courses/' + course.image;
                    preview.style.display = 'block';
                    placeholder.style.display = 'none';
                } else {
                    preview.style.display = 'none';
                    placeholder.style.display = 'block';
                }

                currentCourseId = course.id;
                $('#courseModal').modal('show');
            } else {
                Swal.fire(trans.error_title, trans.error_occurred, 'error');
            }
        });
    }

    function saveCourse() {
        clearErrors();
        
        let form = document.getElementById('courseForm');
        let formData = new FormData(form);
        let url = '/courses';
        
        if (currentCourseId) {
            url = '/courses/' + currentCourseId;
            // Method spoofing is handled by the hidden _method input, but we ensure it's set
            formData.set('_method', 'PUT');
        }

        Swal.fire({
            title: "{{ __('messages.please_wait') }}",
            allowOutsideClick: false,
            didOpen: () => { Swal.showLoading(); }
        });

        $.ajax({
            url: url,
            type: 'POST', // Always POST for FormData with method spoofing
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                Swal.close();
                if (response.success) {
                    $('#courseModal').modal('hide');
                    Swal.fire({
                        icon: 'success',
                        title: trans.success_title,
                        text: currentCourseId ? trans.course_updated : trans.course_added,
                        timer: 1500,
                        showConfirmButton: false
                    }).then(() => {
                        location.reload();
                    });
                } else {
                    Swal.fire(trans.error_title, response.message || trans.error_occurred, 'error');
                }
            },
            error: function(xhr) {
                Swal.close();
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    showErrors(errors);
                    let firstError = Object.values(errors)[0][0];
                    Swal.fire(trans.validation_error, firstError, 'error');
                } else {
                    Swal.fire(trans.error_title, trans.error_occurred, 'error');
                }
            }
        });
    }

    function deleteCourse(id) {
        Swal.fire({
            title: trans.delete_confirm_title,
            text: trans.delete_confirm_text,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#4f46e5',
            cancelButtonColor: '#64748b',
            confirmButtonText: trans.delete_confirm_button,
            cancelButtonText: trans.cancel_button,
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/courses/' + id,
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: trans.success_title,
                                text: trans.course_deleted,
                                timer: 1500,
                                showConfirmButton: false
                            }).then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire(trans.error_title, response.message || trans.error_occurred, 'error');
                        }
                    },
                    error: function() {
                        Swal.fire(trans.error_title, trans.error_occurred, 'error');
                    }
                });
            }
        });
    }
</script>
@endsection