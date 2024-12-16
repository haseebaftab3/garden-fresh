<section>
    {{-- <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header> --}}

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>
    <div class="axil-dashboard-account">
        <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
            @csrf
            @method('patch')
            <div class="row">
                <!-- Name Input Section -->
                <div class="col-lg-12">
                    <div class="form-group mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" id="name" name="name" class="form-control"
                            value="{{ old('name', $user->name) }}" placeholder="Enter your name" required autofocus
                            autocomplete="name">
                        @if ($errors->get('name'))
                            <small class="text-danger">{{ $errors->first('name') }}</small>
                        @endif
                    </div>
                </div>
            </div>


            <div class="row">
                <!-- Email Input Section -->
                <div class="col-lg-12">
                    <div class="form-group mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" name="email" class="form-control"
                            value="{{ old('email', $user->email) }}" placeholder="Enter your email" required
                            autocomplete="username">
                        @if ($errors->get('email'))
                            <small class="text-danger">{{ $errors->first('email') }}</small>
                        @endif
                    </div>
                </div>

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                    <div class="col-lg-12">
                        <p class="text-muted mt-2">
                            {{ __('Your email address is unverified.') }}
                        </p>
                        <button form="send-verification" class="axil-btn btn-bg-primary submit-btn">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                        @if (session('status') === 'verification-link-sent')
                            <p class="text-success mt-2">
                                {{ __('A new verification link has been sent to your email address.') }}
                            </p>
                        @endif
                    </div>
                @endif
            </div>


            <div class="form-group mb--0 d-flex align-items-center gap-3">
                <!-- Save Button -->
                <input type="submit" class="axil-btn btn-bg-primary" value="Save Changes">

                <!-- Status Message -->
                @if (session('status') === 'profile-updated')
                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                        class="text-sm text-success ms-2">
                        {{ __('Saved.') }}
                    </p>
                @endif
            </div>

        </form>
    </div>
</section>
