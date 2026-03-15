<section>
    <header>
        <h2 class="section-title">
            {{ __('messages.security') }}
        </h2>

        <p class="section-desc">
            {{ __('messages.security_desc') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div class="max-w-xl">
            <label class="block text-sm font-semibold text-gray-700">{{ __('messages.current_password') }}</label>
            <input name="current_password" type="password" class="profile-input" autocomplete="current-password">
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div class="max-w-xl">
            <label class="block text-sm font-semibold text-gray-700">{{ __('messages.new_password') }}</label>
            <input name="password" type="password" class="profile-input" autocomplete="new-password">
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div class="max-w-xl">
            <label class="block text-sm font-semibold text-gray-700">{{ __('messages.confirm_password') }}</label>
            <input name="password_confirmation" type="password" class="profile-input" autocomplete="new-password">
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="form-actions pt-4">
            <button type="submit" class="btn-pink">
                {{ __('messages.save') }}
            </button>

            @if (session('status') === 'password-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-green-600 mt-2">
                    {{ __('messages.success') }}
                </p>
            @endif
        </div>
    </form>
</section>