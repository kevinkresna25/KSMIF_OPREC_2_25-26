<section>
    <header>
        <h2 class="text-lg font-raleway font-medium text-text-default">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-400 font-lato">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <label for="name" class="block text-sm font-raleway font-medium text-text-default mb-2">
                {{ __('Name') }}
            </label>
            <x-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" :invalid="$errors->has('name')" required autofocus autocomplete="name" />
            @error('name')
                <p class="mt-2 text-sm text-btn-danger font-lato">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="email" class="block text-sm font-raleway font-medium text-text-default mb-2">
                {{ __('Email') }}
            </label>
            <x-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" :invalid="$errors->has('email')" required autocomplete="username" />
            @error('email')
                <p class="mt-2 text-sm text-btn-danger font-lato">{{ $message }}</p>
            @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-400 font-lato">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-text-glow hover:text-text-glow/80 rounded-none focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-btn-submit">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-btn-success font-lato">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-button type="submit" variant="primary">{{ __('Save') }}</x-button>

            @if (session('status') === 'profile-updated')
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
