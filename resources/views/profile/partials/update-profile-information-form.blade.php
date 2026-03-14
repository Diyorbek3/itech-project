<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">{{ __('Profile Information') }}</h2>
        <p class="mt-1 text-sm text-gray-600">{{ __("Update your account's profile information and email address.") }}</p>
    </header>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <label class="block text-sm font-medium text-gray-700">{{ __('Full Name') }}</label>
            <input name="name" type="text" class="profile-input" value="{{ old('name', $user->name) }}" required autofocus>
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">{{ __('Email Address') }}</label>
            <input name="email" type="email" class="profile-input" value="{{ old('email', $user->email) }}" required>
            <x-input-error class="mt-2" :messages="$errors->get('email')" />
        </div>

        <div class="pt-4">
            <button type="submit" class="btn-pink">{{ __('Save Changes') }}</button>
        </div>
    </form>
</section>