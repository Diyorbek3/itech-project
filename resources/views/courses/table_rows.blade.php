@forelse($courses as $course)
<tr>
    <td>
        @if($course->image)
            <img src="{{ asset('storage/courses/' . $course->image) }}" class="course-image-preview" alt="{{ $course->title }}">
        @else
            <div class="course-image-preview bg-gradient d-flex align-items-center justify-content-center" style="background: linear-gradient(135deg, #e0e7ff, #c7d2fe);">
                <i class="fas fa-graduation-cap fa-2x text-primary" style="opacity: 0.6;"></i>
            </div>
        @endif
    </td>
    <td class="course-title">{{ $course->title }}</td>
    <td class="price-text">{{ number_format($course->price) }} so'm</td>
    <td><span class="duration-badge"><i class="far fa-clock me-1"></i>{{ $course->duration ?? '—' }}</span></td>
    <td>
        <span class="certificate-badge {{ $course->has_certificate ? 'yes' : 'no' }}">
            {{ $course->has_certificate ? 'Bor' : 'Yo\'q' }}
        </span>
    </td>
    <td>
        <div class="action-btns">
            <button class="btn btn-sm btn-outline-warning" onclick="openEditModal({{ $course->id }})" title="Tahrirlash">
                <i class="fas fa-edit"></i>
            </button>
            <button class="btn btn-sm btn-outline-danger" onclick="confirmDelete({{ $course->id }}, '{{ $course->title }}')" title="O'chirish">
                <i class="fas fa-trash-alt"></i>
            </button>
        </div>
    </td>
</tr>
@empty
<tr>
    <td colspan="6" class="empty-state">
        <i class="fas fa-book-open"></i>
        <h5>Hozircha kurslar mavjud emas</h5>
        <button class="btn btn-primary mt-2" onclick="openCreateModal()">
            <i class="fas fa-plus me-2"></i>Birinchi kursni qo'shing
        </button>
    </td>
</tr>
@endforelse