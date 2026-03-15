<section class="space-y-6">
    <header>
        <h2 class="section-title">{{ __('messages.delete_account') }}</h2>
        <p class="section-desc">{{ __('messages.delete_desc') }}</p>
    </header>

    <div class="form-actions">
        <form method="POST" action="{{ route('profile.destroy') }}">
            @csrf
            @method('delete')
            
            <button 
                type="button" 
                class="btn-pink" 
                style="background: #dc3545;" 
                onclick="confirmAndSubmit(this.form)"
            >
                {{ strtoupper(__('messages.delete_account')) }}
            </button>
        </form>
    </div>
</section>

<script>
function confirmAndSubmit(formElement) {
    Swal.fire({
        title: "{{ __('messages.delete_confirm_title') }}",
        text: "{{ __('messages.delete_confirm_text') }}",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
        confirmButtonText: "Ha, o'chirish!",
        cancelButtonText: "{{ __('messages.read_more') }}" // yoki 'Bekor qilish'
    }).then((result) => {
        if (result.isConfirmed) {
            formElement.submit();
        }
    });
}
</script>