@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css">
<style>
    #myTabContent input { border-color: rgb(117, 188, 230) !important; }
    .tabs { padding-top: 160px; padding-bottom: 20px; }
    #cropperModal .modal-body { 
        max-height: 75vh; 
        display: flex; 
        justify-content: center; 
        align-items: center; 
        overflow: hidden; 
    }
    #cropperImage { max-width: 100%; display: block; }
    .cursor-pointer { cursor: pointer; }
    .avatar img { border: 2px solid #eee; transition: 0.3s; }
    .avatar img:hover { opacity: 0.8; }
</style>
@endsection

@section('content')
<div class="container">
    <div class="tabs">
        <ul class="mx-5 nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="personal-info-tab" data-bs-toggle="tab" data-bs-target="#personal-info" type="button" role="tab">{{ __("messages.personal_info") }}</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="change-password-tab" data-bs-toggle="tab" data-bs-target="#change-password" type="button" role="tab">{{ __("messages.change_password") }}</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="security-question-tab" data-bs-toggle="tab" data-bs-target="#security-question" type="button" role="tab">{{ __("messages.security_question") }}</button>
            </li>
        </ul>

        <div class="tab-content mt-3" id="myTabContent">
            <div class="tab-pane fade show active" id="personal-info" role="tabpanel">
                <div class="card card-body mx-3 mx-md-4 mt-4">
                    <form id="profileForm" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row gx-4 align-items-center">
                            <div class="col-auto">
                                <div class="avatar position-relative mt-2 mx-3">
                                    <img id="selectedAvatar"
                                         src="{{ $data['avatar'] ? Storage::url('avatars/' . $data['avatar']) : asset('images/avatar.png') }}"

                                         class="rounded-circle shadow-sm cursor-pointer" 
                                         onclick="openFileInput()"
                                         style="width:80px; height:80px; object-fit: cover;"
                                         onerror="this.onerror=null; this.src='{{ asset('images/avatar.png') }}';" />
                                    <div class="position-absolute bottom-0 end-0">
                                        <i class="fas fa-pencil-alt fa-sm text-dark cursor-pointer" onclick="openFileInput()"></i>
                                    </div>
                                    <input name="avatar" type="file" class="d-none" id="customFile2" accept="image/*" />
                                </div>
                            </div>
                            <div class="col-auto">
                                <h5 class="mb-1">{{ $data['name'] ?? '' }}</h5>
                                @if($data['avatar'])
                                    <button type="button" class="btn btn-sm btn-outline-danger mt-2" id="deleteAvatarBtn">
                                        <i class="fas fa-trash-alt me-1"></i> {{ __('messages.delete_avatar') }}
                                    </button>
                                @endif
                            </div>
                        </div>

                        <div class="row mt-4 p-3">
                            <div class="mb-3 col-md-6">
                                <label class="form-label">{{ __("messages.email_address") }}</label>
                                <input type="email" name="email" class="form-control border p-2" value="{{ old('email', $data['email'] ?? '') }}">
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">{{ __("messages.name") }}</label>
                                <input type="text" name="name" class="form-control border p-2" value="{{ old('name', $data['name'] ?? '') }}">
                            </div>
                        </div>
                        <div class="px-3">
                            <button type="button" class="btn btn-primary px-4" id="save_prof">{{ __("messages.save_changes") }}</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="tab-pane fade" id="change-password" role="tabpanel">
                <div class="card card-body mx-3 mx-md-4 mt-n6">
                    <form id="passwordForm">
                        @csrf
                        @method('PUT')
                        <div class="row p-3">
                            <div class="col-md-9">
                                <div class="mb-3 row align-items-center">
                                    <label class="col-md-3 fw-bold">{{ __("messages.old_password") }}</label>
                                    <div class="col-md-9 position-relative">
                                        <input type="password" name="old_password" class="form-control border p-2">
                                        <i class="fas fa-eye toggle-password position-absolute end-0 top-50 translate-middle-y me-3 cursor-pointer"></i>
                                    </div>
                                </div>
                                <div class="mb-3 row align-items-center">
                                    <label class="col-md-3 fw-bold">{{ __("messages.new_password") }}</label>
                                    <div class="col-md-9 position-relative">
                                        <input type="password" name="password" id="password" class="form-control border p-2">
                                        <i class="fas fa-eye toggle-password position-absolute end-0 top-50 translate-middle-y me-3 cursor-pointer"></i>
                                    </div>
                                </div>
                                <div class="mb-3 row align-items-center">
                                    <label class="col-md-3 fw-bold">{{ __("messages.confirm_password") }}</label>
                                    <div class="col-md-9 position-relative">
                                        <input type="password" name="password_confirmation" id="confirm-password" class="form-control border p-2">
                                        <i class="fas fa-eye toggle-password position-absolute end-0 top-50 translate-middle-y me-3 cursor-pointer"></i>
                                        <span id="password-match" class="mt-1 d-block"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="px-3">
                            <button type="button" id="save_pass" class="btn btn-primary px-4" disabled>{{ __("messages.save_changes") }}</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="tab-pane fade" id="security-question" role="tabpanel">
                <div class="card card-body mx-3 mx-md-4 mt-n6">
                    <form id="securityQuestionForm">
                        @csrf
                        @method('PUT')
                        <div class="row p-3">
                            <div class="col-md-9">
                                <div class="mb-3">
                                    <label class="fw-bold mb-2">{{ __("messages.security_question") }}</label>
                                    <select name="security_question" class="form-select border p-2" id="security_question_select">
                                        <option value="" disabled {{ !($data['security_question'] ?? '') ? 'selected' : '' }}>{{ __("messages.select_question") }}</option>
                                        <option value="Sizning birinchi maktabingiz raqami?" {{ ($data['security_question'] ?? '') == 'Sizning birinchi maktabingiz raqami?' ? 'selected' : '' }}>Sizning birinchi maktabingiz raqami?</option>
                                        <option value="Sizning birinchi uy hayvoningiz ismi?" {{ ($data['security_question'] ?? '') == 'Sizning birinchi uy hayvoningiz ismi?' ? 'selected' : '' }}>Sizning birinchi uy hayvoningiz ismi?</option>
                                        <option value="Onangizning qizlik familiyasi nima?" {{ ($data['security_question'] ?? '') == 'Onangizning qizlik familiyasi nima?' ? 'selected' : '' }}>Onangizning qizlik familiyasi nima?</option>
                                        <option value="Siz tug'ilgan shahar nomi?" {{ ($data['security_question'] ?? '') == 'Siz tug\'ilgan shahar nomi?' ? 'selected' : '' }}>Siz tug'ilgan shahar nomi?</option>
                                        <option value="custom">{{ __("messages.custom_question") }}</option>
                                    </select>
                                </div>
                                <div class="mb-3 d-none" id="custom_question_container">
                                    <label class="fw-bold mb-2">{{ __("messages.custom_question_label") }}</label>
                                    <input type="text" name="custom_question" class="form-control border p-2" placeholder="{{ __("messages.custom_question_placeholder") }}">
                                </div>
                                <div class="mb-3">
                                    <label class="fw-bold mb-2">{{ __("messages.security_answer") }}</label>
                                    <input type="password" name="security_answer" class="form-control border p-2" placeholder="{{ __("messages.security_answer_placeholder") }}">
                                    <small class="text-muted">{{ __("messages.security_answer_hint") }}</small>
                                </div>
                            </div>
                        </div>
                        <div class="px-3">
                            <button type="button" id="save_security" class="btn btn-primary px-4">{{ __("messages.save_changes") }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Cropper Modal --}}
<div class="modal fade" data-bs-backdrop="static" id="cropperModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __("messages.resize_image") }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <img id="cropperImage" src="" />
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __("messages.cancel") }}</button>
                <button type="button" class="btn btn-primary" id="cropImageBtn">{{ __("messages.crop_apply") }}</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    function openFileInput() { $('#customFile2').click(); }

    $(document).ready(function() {
        const trans = {
            success_title: "{{ __('messages.success_title') }}",
            error_title: "{{ __('messages.error_title') }}",
            profile_updated: "{{ __('messages.profile_updated') }}",
            image_updated: "{{ __('messages.image_updated') }}",
            password_updated: "{{ __('messages.password_updated') }}",
            ready: "{{ __('messages.ready') }}",
            passwords_match: "{{ __('messages.passwords_match') }}",
            passwords_dont_match: "{{ __('messages.passwords_dont_match') }}",
            error_occurred: "{{ __('messages.error_occurred') }}"
        };

        // 1. Password Visibility
        $(document).on('click', '.toggle-password', function() {
            const input = $(this).siblings('input');
            const type = input.attr('type') === 'password' ? 'text' : 'password';
            input.attr('type', type);
            $(this).toggleClass('fa-eye fa-eye-slash');
        });

        // 2. Profile Update
        $('#save_prof').on('click', function() {
            let formData = new FormData($('#profileForm')[0]);
            $.ajax({
                url: '/profile/update',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                success: function(res) {
                    if(res.success) {
                        Swal.fire({ icon: 'success', title: trans.success_title, text: trans.profile_updated, timer: 1500 });
                        setTimeout(() => location.reload(), 1500);

                    }
                }
            });
        });

        // 3. Cropper Logic
        let cropper;
        $('#customFile2').on('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = (event) => {
                    $('#cropperImage').attr('src', event.target.result);
                    $('#cropperModal').modal('show');
                };
                reader.readAsDataURL(file);
            }
        });

        $('#cropperModal').on('shown.bs.modal', function() {
            cropper = new Cropper(document.getElementById('cropperImage'), {
                aspectRatio: 1,
                viewMode: 1
            });
        }).on('hidden.bs.modal', function() {
            if(cropper) cropper.destroy();
            $('#customFile2').val('');
        });

        $('#cropImageBtn').on('click', function() {
            if (!cropper) return;
            cropper.getCroppedCanvas({ width: 400, height: 400 }).toBlob((blob) => {
                let formData = new FormData();
                formData.append('avatar', blob, 'avatar.jpg');
                formData.append('name', $('input[name="name"]').val());
                formData.append('email', $('input[name="email"]').val());
                formData.append('_token', '{{ csrf_token() }}');
                formData.append('_method', 'PUT');

                $.ajax({
                    url: '/profile/update',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(res) {
                        if(res.success) {
                            $('#selectedAvatar').attr('src', res.avatar_url + '?v=' + new Date().getTime());
                            $('#cropperModal').modal('hide');
                            Swal.fire({ icon: 'success', title: trans.ready, text: trans.image_updated, timer: 1500 });
                        }
                    },
                    error: function(err) {
                        Swal.fire(trans.error_title, trans.error_occurred, 'error');
                    }
                });
            }, 'image/jpeg');

        });

        // 4. Password Validation
        $('#password, #confirm-password, input[name="old_password"]').on('keyup', function() {
            const pass = $('#password').val();
            const conf = $('#confirm-password').val();
            const old = $('input[name="old_password"]').val();

            if (conf.length > 0) {
                $('#password-match').html(pass === conf ? 
                    `<small class="text-success">${trans.passwords_match}</small>` : 
                    `<small class="text-danger">${trans.passwords_dont_match}</small>`);
            }

            $('#save_pass').prop('disabled', !(pass === conf && pass.length >= 8 && old.length > 0));
        });

        // 5. Password Save
        $('#save_pass').on('click', function() {
            const data = {
                old_password: $('input[name="old_password"]').val(),
                password: $('#password').val(),
                password_confirmation: $('#confirm-password').val(),
                _token: '{{ csrf_token() }}',
                _method: 'PUT'
            };
            $.post('/profile/update-password', data, function(res) {
                if(res.success) {
                    Swal.fire(trans.success_title, trans.password_updated, 'success');
                    $('#passwordForm')[0].reset();
                    $('#save_pass').prop('disabled', true);
                    $('#password-match').html('');
                } else {
                    Swal.fire(trans.error_title, res.message || trans.error_occurred, 'error');
                }
            });
        });
        // 6. Delete Avatar
        $('#deleteAvatarBtn').on('click', function() {
            Swal.fire({
                title: "{{ __('messages.delete_confirm_title') }}",
                text: "{{ __('messages.delete_confirm_text') }}",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: "{{ __('messages.delete_confirm_text') }}",
                cancelButtonText: "{{ __('messages.cancel') }}"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/profile/avatar',
                        type: 'DELETE',
                        data: { _token: '{{ csrf_token() }}' },
                        success: function(res) {
                            if(res.success) {
                                Swal.fire("{{ __('messages.ready') }}", res.message, 'success');
                                $('#selectedAvatar').attr('src', res.default_url);
                                $('#deleteAvatarBtn').fadeOut();
                                // Barcha header avatarlarini yangilash
                                $('.header-avatar').attr('src', res.default_url);
                            }
                        }
                    });
                }
            });
        });
        // 7. Security Question Save
        $('#security_question_select').on('change', function() {
            if ($(this).val() === 'custom') {
                $('#custom_question_container').removeClass('d-none');
            } else {
                $('#custom_question_container').addClass('d-none');
            }
        });

        $('#save_security').on('click', function() {
            const data = {
                security_question: $('#security_question_select').val() === 'custom' ? $('input[name="custom_question"]').val() : $('#security_question_select').val(),
                security_answer: $('input[name="security_answer"]').val(),
                _token: '{{ csrf_token() }}',
                _method: 'PUT'
            };

            if (!data.security_question || !data.security_answer) {
                Swal.fire("{{ __('messages.error_title') }}", "{{ __('messages.fill_fields_error') }}", 'error');
                return;
            }

            $.post('/profile/update-security', data, function(res) {
                if(res.success) {
                    Swal.fire("{{ __('messages.success_title') }}", "{{ __('messages.security_saved_success') }}", 'success');
                    $('input[name="security_answer"]').val('');
                } else {
                    Swal.fire("{{ __('messages.error_title') }}", res.message || "{{ __('messages.error_occurred') }}", 'error');
                }
            });
        });
    });
</script>
@endsection