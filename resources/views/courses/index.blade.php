@extends('layouts.app')

@section('styles')
<style>
    .course-image-preview {
        width: 50px;
        height: 50px;
        object-fit: cover;
        border-radius: 8px;
    }
    .action-btns {
        display: flex;
        gap: 8px;
    }
    .action-btns .btn {
        padding: 4px 8px;
        font-size: 12px;
    }
    .modal-backdrop {
        z-index: 1040 !important;
    }
    .modal {
        z-index: 1050 !important;
    }
    .is-invalid {
        border-color: #dc2626 !important;
    }
    .invalid-feedback {
        color: #dc2626;
        font-size: 12px;
        margin-top: 5px;
        display: block;
    }
    
    /* Yangi qo'shish div uchun stil */
    .add-course-card {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 16px;
        padding: 20px 30px;
        margin-bottom: 30px;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 10px 25px -5px rgba(102, 126, 234, 0.3);
    }
    .add-course-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 20px 35px -8px rgba(102, 126, 234, 0.4);
    }
    .add-course-card .add-icon {
        width: 60px;
        height: 60px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
        color: white;
        margin-right: 20px;
        backdrop-filter: blur(5px);
    }
    .add-course-card .add-text h3 {
        color: white;
        font-weight: 700;
        margin: 0;
        font-size: 22px;
    }
    .add-course-card .add-text p {
        color: rgba(255, 255, 255, 0.85);
        margin: 5px 0 0;
        font-size: 14px;
    }
    .add-course-card .plus-icon {
        font-size: 32px;
        color: white;
        opacity: 0.8;
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

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 80px">{{ __('messages.image') }}</th>
                            <th>{{ __('messages.title') }}</th>
                            <th>{{ __('messages.price') }}</th>
                            <th>{{ __('messages.duration') }}</th>
                            <th>{{ __('messages.certificate') }}</th>
                            <th style="width: 120px">{{ __('messages.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($courses as $course)
                        <tr>
                            <td>
                                @if($course->image)
                                    <img src="{{ asset('storage/courses/' . $course->image) }}" class="course-image-preview" alt="{{ $course->title }}">
                                @else
                                    <div class="course-image-preview bg-light d-flex align-items-center justify-content-center">
                                        <i class="fas fa-image text-muted"></i>
                                    </div>
                                @endif
                            </td>
                            <td class="fw-semibold">{{ $course->title }}</td>
                            <td>{{ number_format($course->price) }} {{ __('messages.price_per_month') }}</td>
                            <td>{{ $course->duration ?? '—' }}</td>
                            <td>
                                @if($course->has_certificate)
                                    <span class="badge bg-success">{{ __('messages.has') }}</span>
                                @else
                                    <span class="badge bg-secondary">{{ __('messages.no') }}</span>
                                @endif
                            </td>
                            <td>
                                <div class="action-btns">
                                    <button class="btn btn-sm btn-outline-warning" onclick="openEditModal({{ $course->id }})" title="{{ __('messages.edit_course') }}">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger" onclick="deleteCourse({{ $course->id }})" title="{{ __('messages.delete_course') }}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <i class="fas fa-book-open fa-3x text-muted mb-3 d-block"></i>
                                <h5 class="text-muted">{{ __('messages.no_courses_yet') }}</h5>
                                <div class="add-course-card-small mt-3 d-inline-flex" data-bs-toggle="modal" data-bs-target="#courseModal" onclick="openCreateModal()" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 12px; padding: 12px 24px; cursor: pointer;">
                                    <i class="fas fa-plus me-2 text-white"></i>
                                    <span class="text-white">{{ __('messages.add_first_course') }}</span>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal (o'zgarishsiz qoladi) -->
<div class="modal fade" id="courseModal" tabindex="-1" aria-labelledby="courseModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="modalTitle">{{ __('messages.add_new_course') }}</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="courseForm" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="course_id" name="course_id">
                    <input type="hidden" id="_method" name="_method" value="POST">

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">{{ __('messages.course_name') }} <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="title" name="title">
                            <div class="invalid-feedback" id="title_error"></div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">{{ __('messages.image') }}</label>
                            <input type="file" class="form-control" id="image" name="image" accept="image/*">
                            <div class="invalid-feedback" id="image_error"></div>
                            <div id="currentImage" class="mt-2" style="display: none;">
                                <small class="text-muted">Joriy rasm:</small>
                                <img id="currentImagePreview" src="" style="max-height: 60px;" class="rounded mt-1">
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">{{ __('messages.short_description') }}</label>
                        <input type="text" class="form-control" id="short_description" name="short_description">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">{{ __('messages.full_description') }}</label>
                        <textarea class="form-control" id="full_description" name="full_description" rows="3"></textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold">{{ __('messages.duration') }}</label>
                            <input type="text" class="form-control" id="duration" name="duration">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold">{{ __('messages.student_count') }}</label>
                            <input type="number" class="form-control" id="student_count" name="student_count">
                            <div class="invalid-feedback" id="student_count_error"></div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold">{{ __('messages.certificate') }}</label>
                            <select class="form-select" id="has_certificate" name="has_certificate">
                                <option value="1">{{ __('messages.has') }}</option>
                                <option value="0">{{ __('messages.no') }}</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold">{{ __('messages.price') }}</label>
                            <input type="number" class="form-control" id="price" name="price">
                            <div class="invalid-feedback" id="price_error"></div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold">{{ __('messages.schedule') }}</label>
                            <input type="text" class="form-control" id="schedule" name="schedule">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold">{{ __('messages.language') }}</label>
                            <input type="text" class="form-control" id="language" name="language">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">{{ __('messages.teachers') }}</label>
                            <input type="text" class="form-control" id="teachers" name="teachers">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">{{ __('messages.support_text') }}</label>
                            <select class="form-select" id="has_mentor_support" name="has_mentor_support">
                                <option value="1">{{ __('messages.has') }}</option>
                                <option value="0">{{ __('messages.no') }}</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">{{ __('messages.curriculum') }}</label>
                        <textarea class="form-control" id="curriculum" name="curriculum" rows="4"></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">{{ __('messages.target_audience') }}</label>
                        <textarea class="form-control" id="target_audience" name="target_audience" rows="2"></textarea>
                    </div>

                    <hr>
                    <h6 class="fw-bold mb-3">{{ __('messages.links_optional') }}</h6>
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <label>{{ __('messages.word_link') }}</label>
                            <input type="url" class="form-control" id="word_link" name="word_link" placeholder="https://...">
                            <div class="invalid-feedback" id="word_link_error"></div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label>{{ __('messages.excel_link') }}</label>
                            <input type="url" class="form-control" id="excel_link" name="excel_link" placeholder="https://...">
                            <div class="invalid-feedback" id="excel_link_error"></div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label>{{ __('messages.powerpoint_link') }}</label>
                            <input type="url" class="form-control" id="powerpoint_link" name="powerpoint_link" placeholder="https://...">
                            <div class="invalid-feedback" id="powerpoint_link_error"></div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label>{{ __('messages.archive_link') }}</label>
                            <input type="url" class="form-control" id="archive_link" name="archive_link" placeholder="https://...">
                            <div class="invalid-feedback" id="archive_link_error"></div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('messages.cancel') }}</button>
                <button type="button" class="btn btn-primary" onclick="saveCourse()">{{ __('messages.save') }}</button>
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
        error_occurred: "{{ __('messages.error_occurred') }}"
    };

    function clearErrors() {
        document.querySelectorAll('.is-invalid').forEach(el => {
            el.classList.remove('is-invalid');
        });
        document.querySelectorAll('.invalid-feedback').forEach(el => {
            el.innerHTML = '';
        });
    }

    function showErrors(errors) {
        for (let field in errors) {
            let input = document.querySelector(`[name="${field}"]`);
            let errorDiv = document.getElementById(`${field}_error`);
            if (input) {
                input.classList.add('is-invalid');
            }
            if (errorDiv) {
                errorDiv.innerHTML = errors[field].join(', ');
            }
        }
    }

    function openCreateModal() {
        clearErrors();
        document.getElementById('modalTitle').innerText = trans.add_new_course;
        document.getElementById('courseForm').reset();
        document.getElementById('course_id').value = '';
        document.getElementById('_method').value = 'POST';
        document.getElementById('currentImage').style.display = 'none';
        currentCourseId = null;
    }

    function openEditModal(id) {
        clearErrors();
        $.get('/courses/' + id + '/edit', function(data) {
            if (data.success) {
                const course = data.course;
                document.getElementById('modalTitle').innerText = trans.edit_course;
                document.getElementById('course_id').value = course.id;
                document.getElementById('_method').value = 'PUT';
                document.getElementById('title').value = course.title || '';
                document.getElementById('short_description').value = course.short_description || '';
                document.getElementById('full_description').value = course.full_description || '';
                document.getElementById('duration').value = course.duration || '';
                document.getElementById('student_count').value = course.student_count || '';
                document.getElementById('has_certificate').value = course.has_certificate ? 1 : 0;
                document.getElementById('price').value = course.price || '';
                document.getElementById('schedule').value = course.schedule || '';
                document.getElementById('language').value = course.language || '';
                document.getElementById('teachers').value = course.teachers || '';
                document.getElementById('has_mentor_support').value = course.has_mentor_support ? 1 : 0;
                document.getElementById('curriculum').value = course.curriculum || '';
                document.getElementById('target_audience').value = course.target_audience || '';
                document.getElementById('word_link').value = course.word_link || '';
                document.getElementById('excel_link').value = course.excel_link || '';
                document.getElementById('powerpoint_link').value = course.powerpoint_link || '';
                document.getElementById('archive_link').value = course.archive_link || '';

                if (course.image) {
                    document.getElementById('currentImagePreview').src = '/storage/courses/' + course.image;
                    document.getElementById('currentImage').style.display = 'block';
                } else {
                    document.getElementById('currentImage').style.display = 'none';
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

        let formData = new FormData(document.getElementById('courseForm'));
        let url = '/courses';
        let isEdit = !!currentCourseId;

        if (currentCourseId) {
            url = '/courses/' + currentCourseId;
            formData.append('_method', 'PUT');
        }

        $.ajax({
            url: url,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.success) {
                    $('#courseModal').modal('hide');
                    let message = isEdit ? trans.course_updated : trans.course_added;
                    Swal.fire({
                        icon: 'success',
                        title: trans.success_title,
                        text: message,
                        timer: 2000,
                        showConfirmButton: false
                    });
                    setTimeout(function() {
                        location.reload();
                    }, 2000);
                } else {
                    Swal.fire(trans.error_title, response.message || trans.error_occurred, 'error');
                }
            },
            error: function(xhr) {
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    if (errors) {
                        showErrors(errors);
                        let firstError = Object.values(errors)[0][0];
                        Swal.fire(trans.validation_error, firstError, 'error');
                    }
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
            confirmButtonColor: '#dc2626',
            cancelButtonColor: '#64748b',
            confirmButtonText: trans.delete_confirm_button,
            cancelButtonText: trans.cancel_button
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
                                timer: 2000,
                                showConfirmButton: false
                            });
                            setTimeout(function() {
                                location.reload();
                            }, 2000);
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