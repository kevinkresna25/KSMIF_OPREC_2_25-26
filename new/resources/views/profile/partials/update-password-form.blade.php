<section>
    <header>
        <h2 class="text-lg font-raleway font-medium text-text-default">
            {{ __('Update Password') }}
        </h2>

        <p class="mt-1 text-sm text-gray-400 font-lato">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <label for="update_password_current_password" class="block text-sm font-raleway font-medium text-text-default mb-2">
                {{ __('Current Password') }}
            </label>
            <x-input id="update_password_current_password" name="current_password" type="password" class="mt-1 block w-full" :invalid="$errors->updatePassword->has('current_password')" autocomplete="current-password" />
            @error('current_password', 'updatePassword')
                <p class="mt-2 text-sm text-btn-danger font-lato">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="update_password_password" class="block text-sm font-raleway font-medium text-text-default mb-2">
                {{ __('New Password') }}
            </label>
            <x-input id="update_password_password" name="password" type="password" class="mt-1 block w-full" :invalid="$errors->updatePassword->has('password')" autocomplete="new-password" />
            @error('password', 'updatePassword')
                <p class="mt-2 text-sm text-btn-danger font-lato">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="update_password_password_confirmation" class="block text-sm font-raleway font-medium text-text-default mb-2">
                {{ __('Confirm Password') }}
            </label>
            <x-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" :invalid="$errors->updatePassword->has('password_confirmation')" autocomplete="new-password" />
            @error('password_confirmation', 'updatePassword')
                <p class="mt-2 text-sm text-btn-danger font-lato">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center gap-4">
            <x-button type="submit" variant="primary">{{ __('Save') }}</x-button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-btn-success font-lato"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
