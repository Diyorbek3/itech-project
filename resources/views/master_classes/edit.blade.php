@extends('layouts.app')

@section('content')
<div class="container py-5 mt-5 ">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-lg rounded-4 p-4 pt-5">  {{-- pt-5 qo'shildi --}}

                {{-- Header --}}
                <h3 class="fw-bold text-center mb-4">{{ __('messages.masterclass_edit_title') }}</h3>

                {{-- Form --}}
                <form action="{{ route('master_class.update', $mc->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="fw-bold">{{ __('messages.masterclass_edit_title_label') }}</label>
                        <input type="text" name="title" value="{{ old('title', $mc->title) }}" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="fw-bold">{{ __('messages.masterclass_edit_date_label') }}</label>
                        <input type="text" name="event_date" value="{{ old('event_date', $mc->event_date) }}" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="fw-bold">{{ __('messages.masterclass_edit_image_label') }}</label>
                        <input type="file" name="image" class="form-control">
                        @if($mc->image)
                            <img src="{{ asset('storage/' . $mc->image) }}" width="100" class="mt-2 rounded shadow-sm">
                        @endif
                    </div>

                    <div class="mb-3">
                        <label class="fw-bold">{{ __('messages.masterclass_edit_description_label') }}</label>
                        <textarea name="description" class="form-control" rows="4" required>{{ old('description', $mc->description) }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">{{ __('messages.masterclass_edit_telegram_label') }}</label>
                        <input type="url" name="telegram_link"
                               class="form-control @error('telegram_link') is-invalid @enderror"
                               value="{{ old('telegram_link', $mc->telegram_link) }}"
                               placeholder="{{ __('messages.masterclass_edit_telegram_placeholder') }}">
                        @error('telegram_link')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">{{ __('messages.masterclass_edit_telegram_hint') }}</small>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-lg rounded-3">
                            {{ __('messages.masterclass_edit_update_btn') }}
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection