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
</style>
@endsection

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">📚 Kurslar Boshqaruvi</h2>
            <p class="text-muted">Tizimdagi barcha kurslarni shu yerdan nazorat qiling.</p>
        </div>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#courseModal" onclick="openCreateModal()">
            <i class="fas fa-plus me-2"></i>Yangi kurs qo'shish
        </button>
    </div>

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 80px">Rasm</th>
                            <th>Sarlavha</th>
                            <th>Narxi</th>
                            <th>Davomiyligi</th>
                            <th>Sertifikat</th>
                            <th style="width: 120px">Amallar</th>
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
                            <td>{{ number_format($course->price) }} so'm</td>
                            <td>{{ $course->duration ?? '—' }}</td>
                            <td>
                                @if($course->has_certificate)
                                    <span class="badge bg-success">Bor</span>
                                @else
                                    <span class="badge bg-secondary">Yo'q</span>
                                @endif
                            </td>
                            <td>
                                <div class="action-btns">
                                    <button class="btn btn-sm btn-outline-warning" onclick="openEditModal({{ $course->id }})" title="Tahrirlash">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger" onclick="deleteCourse({{ $course->id }})" title="O'chirish">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <i class="fas fa-book-open fa-3x text-muted mb-3 d-block"></i>
                                <h5 class="text-muted">Hozircha kurslar mavjud emas</h5>
                                <button class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#courseModal" onclick="openCreateModal()">
                                    <i class="fas fa-plus me-2"></i>Birinchi kursni qo'shing
                                </button>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="courseModal" tabindex="-1" aria-labelledby="courseModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="modalTitle">Yangi kurs qo'shish</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="courseForm" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="course_id" name="course_id">
                    <input type="hidden" id="_method" name="_method" value="POST">

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Kurs nomi <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="Masalan: Python dasturlash">
                            <div class="invalid-feedback" id="title_error"></div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Rasm</label>
                            <input type="file" class="form-control" id="image" name="image" accept="image/*">
                            <div class="invalid-feedback" id="image_error"></div>
                            <div id="currentImage" class="mt-2" style="display: none;">
                                <small class="text-muted">Joriy rasm:</small>
                                <img id="currentImagePreview" src="" style="max-height: 60px;" class="rounded mt-1">
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Qisqacha tavsif</label>
                        <input type="text" class="form-control" id="short_description" name="short_description" placeholder="Kurs haqida qisqacha">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">To'liq tavsif</label>
                        <textarea class="form-control" id="full_description" name="full_description" rows="3" placeholder="Kurs haqida batafsil ma'lumot..."></textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold">Davomiyligi</label>
                            <input type="text" class="form-control" id="duration" name="duration" placeholder="3 oy">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold">Talabalar soni</label>
                            <input type="number" class="form-control" id="student_count" name="student_count" placeholder="100">
                            <div class="invalid-feedback" id="student_count_error"></div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold">Sertifikat</label>
                            <select class="form-select" id="has_certificate" name="has_certificate">
                                <option value="1">Bor</option>
                                <option value="0">Yo'q</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold">Narxi (so'm)</label>
                            <input type="number" class="form-control" id="price" name="price" placeholder="850000">
                            <div class="invalid-feedback" id="price_error"></div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold">Darslar chastotasi</label>
                            <input type="text" class="form-control" id="schedule" name="schedule" placeholder="Haftada 3 kun">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold">Tili</label>
                            <input type="text" class="form-control" id="language" name="language" placeholder="O'zbek tilida">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">O'qituvchilar</label>
                            <input type="text" class="form-control" id="teachers" name="teachers" placeholder="Ism Familya">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">24/7 Mentor yordami</label>
                            <select class="form-select" id="has_mentor_support" name="has_mentor_support">
                                <option value="1">Bor</option>
                                <option value="0">Yo'q</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">O'quv dasturi</label>
                        <textarea class="form-control" id="curriculum" name="curriculum" rows="4" placeholder="Kurs dasturini yozing..."></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Kimlar uchun?</label>
                        <textarea class="form-control" id="target_audience" name="target_audience" rows="2" placeholder="Bu kurs kimlar uchun?"></textarea>
                    </div>

                    <hr>
                    <h6 class="fw-bold mb-3">Havolalar (ixtiyoriy)</h6>
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <label>Word havolasi</label>
                            <input type="url" class="form-control" id="word_link" name="word_link" placeholder="https://...">
                            <div class="invalid-feedback" id="word_link_error"></div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label>Excel havolasi</label>
                            <input type="url" class="form-control" id="excel_link" name="excel_link" placeholder="https://...">
                            <div class="invalid-feedback" id="excel_link_error"></div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label>PowerPoint havolasi</label>
                            <input type="url" class="form-control" id="powerpoint_link" name="powerpoint_link" placeholder="https://...">
                            <div class="invalid-feedback" id="powerpoint_link_error"></div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label>Arxiv havolasi</label>
                            <input type="url" class="form-control" id="archive_link" name="archive_link" placeholder="https://...">
                            <div class="invalid-feedback" id="archive_link_error"></div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Bekor qilish</button>
                <button type="button" class="btn btn-primary" onclick="saveCourse()">Saqlash</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    let currentCourseId = null;

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
        document.getElementById('modalTitle').innerText = 'Yangi kurs qo\'shish';
        document.getElementById('courseForm').reset();
        document.getElementById('course_id').value = '';
        document.getElementById('_method').value = 'POST';
        document.getElementById('currentImage').style.display = 'none';
        currentCourseId = null;
        $('#courseModal').modal('show');
    }

    function openEditModal(id) {
        clearErrors();
        $.get('/courses/' + id + '/edit', function(data) {
            if (data.success) {
                const course = data.course;
                document.getElementById('modalTitle').innerText = 'Kursni tahrirlash';
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
                Swal.fire('Xatolik', 'Kurs topilmadi', 'error');
            }
        });
    }

    function saveCourse() {
        clearErrors();

        let title = document.getElementById('title').value.trim();
        if (!title) {
            Swal.fire('Xatolik', 'Kurs nomini kiriting!', 'warning');
            return;
        }

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
                    
                    let message = isEdit ? '✅ Kurs muvaffaqiyatli yangilandi!' : '✅ Kurs muvaffaqiyatli qo\'shildi!';
                    Swal.fire({
                        icon: 'success',
                        title: 'Muvaffaqiyatli!',
                        text: message,
                        timer: 2000,
                        showConfirmButton: false
                    });
                    
                    setTimeout(function() {
                        location.reload();
                    }, 2000);
                } else {
                    Swal.fire('Xatolik', response.message || 'Xatolik yuz berdi', 'error');
                }
            },
            error: function(xhr) {
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    if (errors) {
                        showErrors(errors);
                        let firstError = Object.values(errors)[0][0];
                        Swal.fire('Validatsiya xatosi', firstError, 'error');
                    }
                } else {
                    Swal.fire('Xatolik', 'Saqlashda xatolik yuz berdi', 'error');
                }
            }
        });
    }

    function deleteCourse(id) {
        Swal.fire({
            title: 'O\'chirish',
            text: 'Haqiqatan ham ushbu kursni o\'chirmoqchimisiz?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc2626',
            cancelButtonColor: '#64748b',
            confirmButtonText: 'Ha, o\'chirish!',
            cancelButtonText: 'Bekor qilish'
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
                                title: 'O\'chirildi!',
                                text: '✅ Kurs muvaffaqiyatli o\'chirildi!',
                                timer: 2000,
                                showConfirmButton: false
                            });
                            setTimeout(function() {
                                location.reload();
                            }, 2000);
                        } else {
                            Swal.fire('Xatolik', response.message || 'Xatolik yuz berdi', 'error');
                        }
                    },
                    error: function() {
                        Swal.fire('Xatolik', 'O\'chirishda xatolik yuz berdi', 'error');
                    }
                });
            }
        });
    }
</script>
@endsection