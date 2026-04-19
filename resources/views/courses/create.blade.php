@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h3>Yangi kurs qo'shish</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('courses.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Kurs nomi <span class="text-danger">*</span></label>
                                <input type="text" name="title" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Rasm</label>
                                <input type="file" name="image" class="form-control" accept="image/*">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label>Qisqacha tavsif</label>
                            <input type="text" name="short_description" class="form-control" placeholder="Ofis ishinini boshqarish va hujjat aylanishini tashkil qilish">
                        </div>

                        <div class="mb-3">
                            <label>Kurs haqida (to'liq)</label>
                            <textarea name="full_description" class="form-control" rows="4"></textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label>Davomiyligi</label>
                                <input type="text" name="duration" class="form-control" placeholder="2 ay">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label>Talabalar soni</label>
                                <input type="number" name="student_count" class="form-control" placeholder="100">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label>Sertifikat</label>
                                <select name="has_certificate" class="form-control">
                                    <option value="1">Bor</option>
                                    <option value="0">Yo'q</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="fw-bold">Havolalar:</label>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-2">
                                <label>Word havolasi</label>
                                <input type="url" name="word_link" class="form-control" placeholder="https://...">
                            </div>
                            <div class="col-md-4 mb-2">
                                <label>Excel havolasi</label>
                                <input type="url" name="excel_link" class="form-control" placeholder="https://...">
                            </div>
                            <div class="col-md-4 mb-2">
                                <label>PowerPoint havolasi</label>
                                <input type="url" name="powerpoint_link" class="form-control" placeholder="https://...">
                            </div>
                            <div class="col-md-6 mb-2">
                                <label>Arxiv havolasi</label>
                                <input type="url" name="archive_link" class="form-control" placeholder="https://...">
                            </div>
                            <div class="col-md-6 mb-2">
                                <label>Hujjat havolasi</label>
                                <input type="url" name="document_link" class="form-control" placeholder="https://...">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label>O'quv dasturi</label>
                            <textarea name="curriculum" class="form-control" rows="5" placeholder="### Office dasturlari&#10;- Word, Excel, PowerPoint&#10;&#10;### Hujjat aylanishi&#10;- Hujjatlarni tashkil qilish"></textarea>
                            <small class="text-muted">Markdown formatida yozishingiz mumkin</small>
                        </div>

                        <div class="mb-3">
                            <label>Kimlar uchun?</label>
                            <textarea name="target_audience" class="form-control" rows="3" placeholder="Ofis xodimlari, yangi boshlovchilar"></textarea>
                        </div>

                        <div class="mb-3">
                            <label>O'qituvchilar</label>
                            <input type="text" name="teachers" class="form-control" placeholder="Haydarova Zulayho, Avalov Mirabbos">
                        </div>

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label>Narxi (so'm)</label>
                                <input type="number" name="price" class="form-control" placeholder="850000">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label>Boshlanishi</label>
                                <input type="text" name="start_in" class="form-control" placeholder="1 ay">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label>Darslar chastotasi</label>
                                <input type="text" name="schedule" class="form-control" placeholder="Haftada 3 kun">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Tili</label>
                                <input type="text" name="language" class="form-control" value="O'zbek tilida">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>24/7 Mentor yordami</label>
                                <select name="has_mentor_support" class="form-control">
                                    <option value="1">Bor</option>
                                    <option value="0">Yo'q</option>
                                </select>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('courses.index') }}" class="btn btn-secondary">Orqaga</a>
                            <button type="submit" class="btn btn-primary">Saqlash</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection