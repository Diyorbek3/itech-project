<section>
    <header>
        <h2 class="section-title">{{ __('messages.profile_info') }}</h2>
        <p class="section-desc">{{ __('messages.profile_desc') }}</p>
    </header>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <label class="block text-sm font-medium text-gray-700">{{ __('messages.full_name') }}</label>
            <input name="name" type="text" class="profile-input" value="{{ old('name', $user->name) }}" required autofocus>
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">{{ __('messages.email') }}</label>
            <input name="email" type="email" class="profile-input" value="{{ old('email', $user->email) }}" required>
            <x-input-error class="mt-2" :messages="$errors->get('email')" />
        </div>

        <div class="pt-4">
            <button type="submit" class="btn-pink">{{ __('messages.save') }}</button>
        </div>
    </form>
</section>