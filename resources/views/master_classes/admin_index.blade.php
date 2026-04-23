@extends('layouts.app')

@section('content')
<div class="container py-5 mt-5" style="min-height: 80vh;">
    <div style="padding-top: 60px;"> <div class="d-flex justify-content-between align-items-center mb-5 p-4 rounded-4 shadow-sm bg-white border-start border-primary border-5">
        <div>
            <h2 class="fw-bold mb-0 text-dark">🎓 Master-klass Boshqaruvi</h2>
            <p class="text-muted mb-0">Tizimdagi barcha master-klasslarni shu yerdan nazorat qiling.</p>
        </div>
        <a href="{{ route('master_class.create') }}" class="btn btn-primary btn-lg rounded-pill px-4 shadow">
            <i class="fas fa-plus-circle me-2"></i> Yangi qo'shish
        </a>
        </div>
    </div>
           

    <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
        <div class="card-body p-0">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-4 py-3 text-uppercase fs-7 fw-bold text-secondary">Rasm</th>
                        <th class="py-3 text-uppercase fs-7 fw-bold text-secondary">Sarlavha</th>
                        <th class="py-3 text-uppercase fs-7 fw-bold text-secondary">Sana</th>
                        <th class="pe-4 py-3 text-end text-uppercase fs-7 fw-bold text-secondary">Amallar</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($masterClasses as $mc)
                    <tr class="transition-all">
                        <td class="ps-4">
                            <div class="position-relative d-inline-block">
                                <img src="{{ asset('storage/' . $mc->image) }}" class="rounded-3 shadow-sm border" width="100" height="65" style="object-fit: cover;">
                            </div>
                        </td>
                        <td>
                            <div class="fw-bold text-dark fs-5">{{ $mc->title }}</div>
                            <small class="text-muted"><i class="far fa-file-alt me-1"></i> {{ Str::limit($mc->description, 40) }}</small>
                        </td>
                        <td>
                            <span class="badge bg-soft-primary text-primary px-3 py-2 rounded-pill border border-primary border-opacity-25">
                                <i class="far fa-calendar-alt me-1"></i> {{ $mc->event_date }}
                            </span>
                        </td>
                        <td class="pe-4 text-end">
                            <div class="btn-group shadow-sm rounded-pill overflow-hidden border">
                                <a href="{{ route('master_class.edit', $mc->id) }}" class="btn btn-white text-warning px-3 py-2 border-end" title="Tahrirlash">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <button type="button" onclick="deleteConfirm('{{ $mc->id }}')" class="btn btn-white text-danger px-3 py-2" title="O'chirish">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                                
                                <form id="delete-form-{{ $mc->id }}" action="{{ route('master_class.destroy', $mc->id) }}" method="POST" class="d-none">
                                    @csrf 
                                    @method('DELETE')
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center py-5">
                            <img src="https://cdn-icons-png.flaticon.com/512/7486/7486744.png" width="80" class="mb-3 opacity-25">
                            <p class="text-muted fs-5">Hozircha hech qanday master-klass mavjud emas.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-4">
        {{ $masterClasses->links() }}
    </div>
</div>

<style>
    .bg-soft-primary { background-color: #e7f1ff; }
    .fs-7 { font-size: 0.8rem; }
    .transition-all:hover { background-color: #f8fbff; transform: scale(1.005); transition: 0.3s; }
    /* Tugmalar dizayni yaxshilandi */
    .btn-white { background: #fff; border: none; transition: 0.2s; }
    .btn-white:hover { background: #f8f9fa; }
    .btn-white.text-warning:hover { color: #ffc107 !important; }
    .btn-white.text-danger:hover { color: #dc3545 !important; }
</style>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // Muvaffaqiyat xabari
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Muvaffaqiyat!',
            text: "{{ session('success') }}",
            timer: 3000,
            showConfirmButton: false
        });
    @endif

    function deleteConfirm(id) {
        Swal.fire({
            title: 'Ishonchingiz komilmi?',
            text: "Bu amalni ortga qaytarib bo'lmaydi!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6e7881',
            confirmButtonText: 'Ha, o‘chirish!',
            cancelButtonText: 'Bekor qilish'
        }).then((result) => {
            if (result.isConfirmed) {
                const form = document.getElementById('delete-form-' + id);
                if (form) form.submit();
            }
        });
    }
</script>
@endsection