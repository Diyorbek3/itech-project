<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>iTech Academy</title>

    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,400;0,600;0,700;1,400&display=swap" rel="stylesheet">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <link href="/css/swiper.css" rel="stylesheet">
    <link href="/css/styles.css" rel="stylesheet">
    <link rel="icon" href="/images/logo.png">
    <style>
        .course-hero {
            margin-top: 130px !important;
        }

    </style>

    @yield('styles')
</head>

<body>
    <script>
        function changeLanguage(locale) {
            window.location.href = '/language/' + locale;
        }
    </script>

    @include('components.header')

    <main> <div class="container">
        @yield('content')
    </div>
</main>

    @include('components.footer')

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script src="{{ asset('js/swiper.min.js') }}"></script>
    <script src="{{ asset('js/purecounter.min.js') }}"></script>
    <script src="{{ asset('js/scripts.js') }}"></script>

    @auth
        @if(!auth()->user()->security_question)
        <!-- Security Question Setup Modal -->
        <div class="modal fade" id="securitySetupModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 shadow-lg" style="background: #161b22; border-radius: 15px;">
                    <div class="modal-header border-bottom border-secondary py-3">
                        <h5 class="modal-title text-white fw-bold">
                            <i class="fas fa-shield-alt text-primary me-2"></i> {{ __("messages.security_setup_title") }}
                        </h5>
                    </div>
                    <div class="modal-body p-4">
                        <div class="alert alert-info border-0 shadow-sm mb-4" style="background: rgba(13, 110, 253, 0.1); color: #8dc6ff; border-radius: 10px;">
                            <i class="fas fa-info-circle me-2"></i> {{ __("messages.security_setup_info") }}
                        </div>
                        
                        <form id="setupSecurityForm">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label class="text-white-50 small mb-2">{{ __("messages.security_question") }}</label>
                                <select name="security_question" class="form-select border-secondary text-white" id="modal_security_select" style="background: #0d1117;">
                                    <option value="" disabled selected>{{ __("messages.select_question") }}</option>
                                    <option value="Sizning birinchi maktabingiz raqami?">Sizning birinchi maktabingiz raqami?</option>
                                    <option value="Sizning birinchi uy hayvoningiz ismi?">Sizning birinchi uy hayvoningiz ismi?</option>
                                    <option value="Onangizning qizlik familiyasi nima?">Onangizning qizlik familiyasi nima?</option>
                                    <option value="Siz tug'ilgan shahar nomi?">Siz tug'ilgan shahar nomi?</option>
                                    <option value="custom">{{ __("messages.custom_question") }}</option>
                                </select>
                            </div>

                            <div class="mb-3 d-none" id="modal_custom_container">
                                <label class="text-white-50 small mb-2">{{ __("messages.custom_question_label") }}</label>
                                <input type="text" name="custom_question" class="form-control border-secondary text-white" style="background: #0d1117;" placeholder="{{ __("messages.custom_question_placeholder") }}">
                            </div>

                            <div class="mb-4">
                                <label class="text-white-50 small mb-2">{{ __("messages.security_answer") }}</label>
                                <input type="text" name="security_answer" class="form-control border-secondary text-white" style="background: #0d1117;" placeholder="{{ __("messages.security_answer_placeholder") }}" autocomplete="off">
                                <small class="text-white-50 mt-1 d-block" style="font-size: 11px;">{{ __("messages.security_answer_hint") }}</small>
                            </div>

                            <button type="button" id="btnSaveSecurityModal" class="btn btn-primary w-100 py-2 fw-bold" style="border-radius: 8px;">
                                {{ __("messages.save_changes") }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script>
            $(document).ready(function() {
                var securityModal = new bootstrap.Modal(document.getElementById('securitySetupModal'));
                securityModal.show();

                $('#modal_security_select').on('change', function() {
                    if ($(this).val() === 'custom') {
                        $('#modal_custom_container').removeClass('d-none');
                    } else {
                        $('#modal_custom_container').addClass('d-none');
                    }
                });

                $('#btnSaveSecurityModal').on('click', function() {
                    const data = {
                        security_question: $('#modal_security_select').val() === 'custom' ? $('input[name="custom_question"]').val() : $('#modal_security_select').val(),
                        security_answer: $('input[name="security_answer"]').val(),
                        _token: '{{ csrf_token() }}',
                        _method: 'PUT'
                    };

                    if (!data.security_question || !data.security_answer) {
                        Swal.fire({
                            icon: 'error',
                            title: "{{ __('messages.error_title') }}",
                            text: "{{ __('messages.fill_fields_error') }}",
                            background: '#161b22',
                            color: '#fff'
                        });
                        return;
                    }

                    $.ajax({
                        url: '{{ route("profile.update-security") }}',
                        type: 'POST',
                        data: data,
                        success: function(res) {
                            if(res.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: "{{ __('messages.success_title') }}",
                                    text: "{{ __('messages.security_saved_success') }}",
                                    background: '#161b22',
                                    color: '#fff',
                                    timer: 2000
                                }).then(() => {
                                    securityModal.hide();
                                });
                            }
                        }
                    });
                });
            });
        </script>
        @endif
    @endauth

    @yield('scripts')

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
</body>
</html>