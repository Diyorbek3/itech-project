@extends('layouts.app')

@section('content')
<div class="container py-5 mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-lg rounded-4 p-4">
                <h3 class="fw-bold text-center mb-4">🚀 Yangi Master-klass</h3>
                
                <form action="{{ route('master_class.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="mb-4">
                        <label class="form-label fw-bold">Sarlavha</label>
                        <input type="text" name="title" class="form-control rounded-3 @error('title') is-invalid @enderror" value="{{ old('title') }}" placeholder="Masalan: Python orqali AI yaratish">
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label class="form-label fw-bold">Sana va Vaqt</label>
                            <input type="text" name="event_date" class="form-control rounded-3 @error('event_date') is-invalid @enderror" value="{{ old('event_date') }}" placeholder="25-Aprel, 18:00">
                            @error('event_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-4">
                            <label class="form-label fw-bold">Rasm yuklash</label>
                            <input type="file" name="image" class="form-control rounded-3 @error('image') is-invalid @enderror">
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold">Tavsif</label>
                        <textarea name="description" rows="4" class="form-control rounded-3 @error('description') is-invalid @enderror" placeholder="Master-klass haqida batafsil ma'lumot...">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
      <div class="mb-3">
    <label class="form-label">Telegram Post Linki</label>
    <input type="url" name="telegram_link" class="form-control" 
           value="{{ isset($mc) ? $mc->telegram_link : '' }}" 
           placeholder="https://t.me/kanalingiz/123">
</div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary btn-lg rounded-pill shadow">Saqlash va E'lon qilish</button>
                        <a href="{{ route('master_class.admin') }}" class="btn btn-light rounded-pill">Orqaga</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection