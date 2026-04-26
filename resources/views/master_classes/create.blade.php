@extends('layouts.app')

@section('content')
<div class="container-fluid" style="margin-top:13%;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-lg rounded-4 p-4">

                {{-- Header --}}
                <h3 class="fw-bold text-center mb-4">{{ __('messages.masterclass_create_title') }}</h3>

                {{-- Form --}}
                <form action="{{ route('master_class.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    {{-- Title --}}
                    <div class="mb-4">
                        <label class="form-label fw-bold">{{ __('messages.masterclass_create_title_label') }}</label>
                        <input type="text" name="title" 
                               class="form-control rounded-3 @error('title') is-invalid @enderror" 
                               value="{{ old('title') }}" 
                               placeholder="{{ __('messages.masterclass_create_title_placeholder') }}">
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Date & Image --}}
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label class="form-label fw-bold">{{ __('messages.masterclass_create_date_label') }}</label>
                            <input type="text" name="event_date" 
                                   class="form-control rounded-3 @error('event_date') is-invalid @enderror" 
                                   value="{{ old('event_date') }}" 
                                   placeholder="{{ __('messages.masterclass_create_date_placeholder') }}">
                            @error('event_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-4">
                            <label class="form-label fw-bold">{{ __('messages.masterclass_create_image_label') }}</label>
                            <input type="file" name="image" 
                                   class="form-control rounded-3 @error('image') is-invalid @enderror">
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Description --}}
                    <div class="mb-4">
                        <label class="form-label fw-bold">{{ __('messages.masterclass_create_description_label') }}</label>
                        <textarea name="description" rows="4" 
                                  class="form-control rounded-3 @error('description') is-invalid @enderror" 
                                  placeholder="{{ __('messages.masterclass_create_description_placeholder') }}">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Telegram Link --}}
                    <div class="mb-4">
                        <label class="form-label fw-bold">{{ __('messages.masterclass_create_telegram_label') }}</label>
                        <input type="url" name="telegram_link" 
                               class="form-control rounded-3 @error('telegram_link') is-invalid @enderror" 
                               value="{{ old('telegram_link', $mc->telegram_link ?? '') }}" 
                               placeholder="{{ __('messages.masterclass_create_telegram_placeholder') }}">
                        @error('telegram_link')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Buttons --}}
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary btn-lg rounded-pill shadow">
                            {{ __('messages.masterclass_create_submit_btn') }}
                        </button>
                        <a href="{{ route('master_class.admin') }}" class="btn btn-light rounded-pill">
                            {{ __('messages.masterclass_create_back_btn') }}
                        </a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection