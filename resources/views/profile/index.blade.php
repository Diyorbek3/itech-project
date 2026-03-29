@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css">

<style>
    #myTabContent input {
        border-color: rgb(117, 188, 230) !important;
    }
    .tabs {
        padding-top: 100px;
        padding-bottom: 20px;
    }
    
    #cropperModal .modal-body {
        max-height: 75vh;
        display: flex;
        justify-content: center;
        align-items: center;
        overflow: hidden;
    }

    #cropperImage {
        width: 100%;
        height: auto;
        display: block;
        max-height: 70vh;
        object-fit: contain;
    }
    
    .cursor-pointer {
        cursor: pointer;
    }
</style>
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>
    
    <!-- Исправляем конфликт с основным JS файлом -->
    <script>
        // Останавливаем всплытие событий для табов
        document.addEventListener('DOMContentLoaded', function() {
            // Находим все табы
            const tabs = document.querySelectorAll('#myTab button');
            
            tabs.forEach(tab => {
                tab.addEventListener('click', function(e) {
                    // Предотвращаем всплытие события, чтобы основной JS не перехватил
                    e.stopPropagation();
                    
                    // Вручную переключаем таб
                    const target = this.getAttribute('data-bs-target');
                    const tabPane = document.querySelector(target);
                    const tabContent = document.querySelector('#myTabContent');
                    
                    // Убираем активный класс со всех табов и панелей
                    document.querySelectorAll('#myTab .nav-link').forEach(t => {
                        t.classList.remove('active');
                    });
                    document.querySelectorAll('#myTabContent .tab-pane').forEach(p => {
                        p.classList.remove('show', 'active');
                    });
                    
                    // Добавляем активный класс текущему табу и панели
                    this.classList.add('active');
                    tabPane.classList.add('show', 'active');
                });
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            // Переключение видимости пароля
            $(document).on('click', '.toggle-password', function() {
                const input = $(this).closest('.position-relative').find('input');
                const type = input.attr('type') === 'password' ? 'text' : 'password';
                input.attr('type', type);
                $(this).toggleClass('fa-eye fa-eye-slash');
            });

            // Проверка совпадения паролей
            function checkPasswordMatch() {
                const password = $('#password').val();
                const confirmPassword = $('#confirm-password').val();
                
                if (confirmPassword.length > 0) {
                    if (password === confirmPassword) {
                        $('#password-match').html('<i class="fas fa-check-circle text-success"></i> Пароли совпадают').removeClass('text-danger').addClass('text-success');
                        return true;
                    } else {
                        $('#password-match').html('<i class="fas fa-times-circle text-danger"></i> Пароли не совпадают').removeClass('text-success').addClass('text-danger');
                        return false;
                    }
                } else {
                    $('#password-match').html('');
                    return false;
                }
            }

            function checkPasswordStrength() {
                const password = $('#password').val();
                const strength = getPasswordStrength(password);
                
                let strengthText = '';
                let strengthClass = '';
                
                switch(strength) {
                    case 0:
                        strengthText = 'Слабый';
                        strengthClass = 'text-danger';
                        break;
                    case 1:
                        strengthText = 'Средний';
                        strengthClass = 'text-warning';
                        break;
                    case 2:
                        strengthText = 'Сильный';
                        strengthClass = 'text-success';
                        break;
                    default:
                        strengthText = '';
                        strengthClass = '';
                }
                
                if (password.length > 0) {
                    $('#password-strength').html(`<span class="${strengthClass}">${strengthText} пароль</span>`);
                    return strength >= 1;
                } else {
                    $('#password-strength').html('');
                    return false;
                }
            }

            function getPasswordStrength(password) {
                let strength = 0;
                if (password.length >= 8) strength++;
                if (password.match(/[a-z]+/)) strength++;
                if (password.match(/[A-Z]+/)) strength++;
                if (password.match(/[0-9]+/)) strength++;
                if (password.match(/[$@#&!]+/)) strength++;
                return Math.floor(strength / 2);
            }

            function toggleSavePasswordButton() {
                const oldPassword = $('input[name="old_password"]').val();
                const password = $('#password').val();
                const confirmPassword = $('#confirm-password').val();
                
                const isOldPasswordFilled = oldPassword && oldPassword.length > 0;
                const isPasswordStrong = getPasswordStrength(password) >= 1;
                const doPasswordsMatch = password === confirmPassword && password.length > 0;
                
                if (isOldPasswordFilled && isPasswordStrong && doPasswordsMatch) {
                    $('#save_pass').prop('disabled', false);
                } else {
                    $('#save_pass').prop('disabled', true);
                }
            }

            // События для полей пароля
            $('#password, #confirm-password, input[name="old_password"]').on('keyup', function() {
                checkPasswordStrength();
                checkPasswordMatch();
                toggleSavePasswordButton();
            });

            $('#confirm-password').on('keyup', function() {
                checkPasswordMatch();
            });

            // Сохранение личной информации
            $('#save_prof').on('click', function() {
                const formData = new FormData($('#personal-info form')[0]);
                
                $.ajax({
                    url: '/profile/update',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.success) {
                            Swal.fire('Успех!', 'Профиль успешно обновлен', 'success');
                            setTimeout(() => location.reload(), 1500);
                        }
                    },
                    error: function(xhr) {
                        const errors = xhr.responseJSON.errors;
                        if (errors) {
                            const errorMessages = Object.values(errors).flat().join('\n');
                            Swal.fire('Ошибка!', errorMessages, 'error');
                        }
                    }
                });
            });

            // Сохранение пароля
            $('#save_pass').on('click', function() {
                const formData = {
                    old_password: $('input[name="old_password"]').val(),
                    password: $('#password').val(),
                    password_confirmation: $('#confirm-password').val(),
                    _token: '{{ csrf_token() }}',
                    _method: 'PUT'
                };
                
                $.ajax({
                    url: '/profile/update-password',
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        if (response.success) {
                            Swal.fire('Успех!', 'Пароль успешно изменен', 'success');
                            $('input[name="old_password"], #password, #confirm-password').val('');
                            $('#save_pass').prop('disabled', true);
                            $('#password-strength, #password-match').html('');
                        }
                    },
                    error: function(xhr) {
                        const response = xhr.responseJSON;
                        let errorMessage = 'Ошибка при смене пароля';
                        if (response && response.message) {
                            errorMessage = response.message;
                        } else if (response && response.errors) {
                            errorMessage = Object.values(response.errors).flat().join('\n');
                        }
                        Swal.fire('Ошибка!', errorMessage, 'error');
                    }
                });
            });

            // Аватар с кропом
            let cropper = null;

            $('#customFile2').on('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(event) {
                        $('#cropperImage').attr('src', event.target.result);
                        $('#cropperModal').modal('show');
                        
                        setTimeout(() => {
                            if (cropper) cropper.destroy();
                            cropper = new Cropper($('#cropperImage')[0], {
                                aspectRatio: 1,
                                viewMode: 1,
                                autoCropArea: 1,
                                responsive: true
                            });
                        }, 100);
                    };
                    reader.readAsDataURL(file);
                }
            });

            $('#cropImageBtn').on('click', function() {
                if (cropper) {
                    const canvas = cropper.getCroppedCanvas({
                        width: 300,
                        height: 300
                    });
                    
                    canvas.toBlob(function(blob) {
                        const formData = new FormData();
                        formData.append('avatar', blob, 'avatar.jpg');
                        formData.append('_token', '{{ csrf_token() }}');
                        formData.append('_method', 'PUT');
                        
                        $.ajax({
                            url: '/profile/update-avatar',
                            type: 'POST',
                            data: formData,
                            processData: false,
                            contentType: false,
                            success: function(response) {
                                if (response.success) {
                                    $('#selectedAvatar').attr('src', response.avatar_url + '?t=' + new Date().getTime());
                                    $('#cropperModal').modal('hide');
                                    Swal.fire('Успех!', 'Аватар обновлен', 'success');
                                }
                            },
                            error: function() {
                                Swal.fire('Ошибка!', 'Ошибка при загрузке аватара', 'error');
                            }
                        });
                    }, 'image/jpeg', 0.9);
                }
            });

            $('#cropperModal').on('hidden.bs.modal', function() {
                if (cropper) {
                    cropper.destroy();
                    cropper = null;
                }
                $('#customFile2').val('');
            });
        });

        function openFileInput() {
            $('#customFile2').click();
        }
    </script>
@endsection

@section('content')
    <div class="container">
        <div class="tabs">
            <ul class="mx-5 nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="personal-info-tab" data-bs-target="#personal-info" type="button" role="tab" aria-controls="personal-info" aria-selected="true">{{ __("messages.personal_info") }}</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="change-password-tab" data-bs-target="#change-password" type="button" role="tab" aria-controls="change-password" aria-selected="false">{{ __("messages.change_password") }}</button>
                </li>
            </ul>

            <div class="tab-content mt-3" id="myTabContent">
                <!-- personal Info Tab -->
                <div class="tab-pane fade show active" id="personal-info" role="tabpanel" aria-labelledby="personal-info-tab">
                    <div class="row">
                        <div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">
                            <div class="container-fluid px-2 px-md-4">
                                <div class="card card-body mx-3 mx-md-4 mt-n6">
                                    <form method='POST' enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="row gx-4">
                                            <div class="col-auto">
                                                <div class="avatar position-relative mt-2 mx-3">
                                                    <div class="d-flex justify-content-center">
                                                        <img id="selectedAvatar"
                                                             src="{{ isset($data['avatar']) && $data['avatar'] ? Storage::url('avatars/' . $data['avatar']) : asset('/storage/avatars/avatar.png') }}"
                                                             class="rounded-circle shadow-sm" alt="profile_image"
                                                             onclick="openFileInput()"
                                                             style="width:75px; height:75px; object-fit: cover; cursor:pointer;" />
                                                        <div class="position-absolute bottom-0 end-0">
                                                            <i class="fas fa-pencil-alt fa-sm text-dark"
                                                               style="cursor: pointer;" onclick="openFileInput()"></i>
                                                        </div>
                                                    </div>
                                                    <input name="avatar" type="file" class="form-control d-none"
                                                           id="customFile2" accept="image/*" />
                                                    @error('avatar')
                                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-auto my-auto">
                                                <div class="h-100">
                                                    <h5 class="mb-1">{{ $data['name'] ?? '' }}</h5>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="h-100">
                                            <div class="p-3 pt-1">
                                                <div class="row">
                                                    <div class="mb-3 col-md-6">
                                                        <label class="form-label">{{ __("messages.email_address") }}</label>
                                                        <input style=" type="email"
                                                               name="email" class="form-control border border-2 p-2"
                                                               value='{{ old('email', $data['email'] ?? '') }}'>
                                                    </div>

                                                    <div class="mb-3 col-md-6">
                                                        <label class="form-label">{{ __("messages.name") }}</label>
                                                        <input id="name" type="text" name="name"
                                                               class="form-control border border-2 p-2"
                                                               value='{{ old('name', $data['name'] ?? '') }}'>
                                                        @error('name')
                                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <button type="button" class="btn btn-primary px-4" id="save_prof">{{ __("messages.save_changes") }}</button>
                                            </div>
                                        </div>
                                    </form>

                                    <!-- modal for cropping -->
                                    <div class="modal fade" data-bs-backdrop="static" id="cropperModal" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-lg modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">{{ __("messages.resize_image") }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{ __("messages.cancel") }}"></button>
                                                </div>
                                                <div class="modal-body text-center">
                                                    <img id="cropperImage" style="max-width: 100%; display:block" />
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __("messages.cancel") }}</button>
                                                    <button type="button" class="btn btn-primary" id="cropImageBtn">{{ __("messages.crop_apply") }}</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- user password form -->
                <div class="tab-pane fade" id="change-password" role="tabpanel" aria-labelledby="change-password-tab">
                    <div class="row">
                        <div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">
                            <div class="container-fluid px-2 px-md-4">
                                <div class="card card-body mx-3 mx-md-4 mt-n6">
                                    <form method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="p-3">
                                            <div class="row mx-auto">
                                                <div class="col-md-9">
                                                    <div class="mb-3 d-flex align-items-center">
                                                        <label class="col-md-3 text-start pe-3 fw-bold">{{ __("messages.old_password") }}</label>
                                                        <div class="col-md-9 position-relative">
                                                            <div class="position-relative">
                                                                <input placeholder="{{ __("messages.old_password") }}" required type="password"
                                                                       name="old_password"
                                                                       class="form-control border border-2 p-2">
                                                                <i class="fas fa-eye toggle-password position-absolute end-0 top-50 translate-middle-y me-3 cursor-pointer"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 d-flex align-items-center">
                                                        <label class="col-md-3 text-start pe-3 fw-bold">{{ __("messages.new_password") }}</label>
                                                        <div class="col-md-9 position-relative">
                                                            <div class="position-relative">
                                                                <input placeholder="{{ __("messages.new_password") }}" required type="password"
                                                                       name="password" id="password"
                                                                       class="form-control border border-2 p-2">
                                                                <i class="fas fa-eye toggle-password position-absolute end-0 top-50 translate-middle-y me-3 cursor-pointer"></i>
                                                            </div>
                                                            <span id="password-strength" class="mt-1 d-block"></span>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 d-flex align-items-center">
                                                        <label class="col-md-3 text-start pe-3 fw-bold">{{ __("messages.confirm_password") }}</label>
                                                        <div class="col-md-9 position-relative">
                                                            <div class="position-relative">
                                                                <input placeholder="{{ __("messages.confirm_password") }}" required
                                                                       type="password" name="password_confirmation"
                                                                       id="confirm-password"
                                                                       class="form-control border border-2 p-2">
                                                                <i class="fas fa-eye toggle-password position-absolute end-0 top-50 translate-middle-y me-3 cursor-pointer"></i>
                                                            </div>
                                                            <span id="password-match" class="mt-1 d-block"></span>
                                                            @error('password')
                                                            <p class='text-danger inputerror'>{{ $message }}</p>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <img src="{{ asset('/assets/images/password.png') }}"
                                                         style="height: 180px !important" class="img-fluid">
                                                </div>
                                            </div>
                                            <button type="button" id="save_pass" class="btn btn-danger px-4" disabled>{{ __("messages.save_changes") }}</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection