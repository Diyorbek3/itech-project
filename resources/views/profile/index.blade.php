@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css">
<style>
    #myTabContent input { border-color: rgb(117, 188, 230) !important; }
    .tabs { padding-top: 100px; padding-bottom: 20px; }
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
        </ul>

        <div class="tab-content mt-3" id="myTabContent">
            <div class="tab-pane fade show active" id="personal-info" role="tabpanel">
                <div class="card card-body mx-3 mx-md-4 mt-n6">
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
                                         style="width:80px; height:80px; object-fit: cover;" />
                                    <div class="position-absolute bottom-0 end-0">
                                        <i class="fas fa-pencil-alt fa-sm text-dark cursor-pointer" onclick="openFileInput()"></i>
                                    </div>
                                    <input name="avatar" type="file" class="d-none" id="customFile2" accept="image/*" />
                                </div>
                            </div>
                            <div class="col-auto">
                                <h5 class="mb-1">{{ $data['name'] ?? '' }}</h5>
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
                            {{-- Tugma rangi btn-dangerdan btn-primaryga o'zgartirildi --}}
                            <button type="button" id="save_pass" class="btn btn-primary px-4" disabled>{{ __("messages.save_changes") }}</button>
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
                        Swal.fire({ icon: 'success', title: 'Muvaffaqiyat!', text: 'Profil yangilandi', timer: 1500 });
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
    
    // Qirqilgan rasmni blob ko'rinishida olish
    cropper.getCroppedCanvas({ width: 400, height: 400 }).toBlob((blob) => {
        let formData = new FormData();
        
        // Controllerdagi $request->file('avatar') shuni kutadi
        formData.append('avatar', blob, 'avatar.jpg');
        
        // Boshqa kerakli ma'lumotlar
        formData.append('name', $('input[name="name"]').val());
        formData.append('_token', '{{ csrf_token() }}');
        formData.append('_method', 'PUT'); // Laravelda PUT so'rovi uchun

        $.ajax({
            url: '/profile/update',
            type: 'POST', // FormData bilan POST yuboriladi, ichida _method PUT bo'ladi
            data: formData,
            processData: false,
            contentType: false,
            success: function(res) {
                if(res.success) {
                    // Rasmni darhol yangilash (brauzer keshini yengish uchun ?v= qo'shdik)
                    $('#selectedAvatar').attr('src', res.avatar_url + '?v=' + new Date().getTime());
                    $('#cropperModal').modal('hide');
                    Swal.fire({ icon: 'success', title: 'Tayyor!', text: 'Rasm saqlandi', timer: 1500 });
                }
            },
            error: function(err) {
                console.error(err.responseText);
                Swal.fire('Xato!', 'Rasmni saqlab bo\'lmadi', 'error');
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
                    '<small class="text-success">Parollar mos keldi</small>' : 
                    '<small class="text-danger">Parollar mos emas</small>');
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
                    Swal.fire('Muvaffaqiyat!', 'Parol yangilandi', 'success');
                    $('#passwordForm')[0].reset();
                    $('#save_pass').prop('disabled', true);
                    $('#password-match').html('');
                }
            });
        });
    });
</script>
@endsection