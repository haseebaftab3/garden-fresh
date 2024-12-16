<div class="axil-dashboard-account">
    <form method="post" action="{{ route('password.update') }}" class="account-details-form">
        @csrf
        @method('put')

        <div class="row">
            <!-- Current Password -->
            <div class="col-lg-12">
                <div class="form-group">
                    <label for="update_password_current_password">{{ __('Current Password') }}</label>
                    <input type="password" id="update_password_current_password" name="current_password"
                        class="form-control" autocomplete="current-password">
                    @if ($errors->updatePassword->has('current_password'))
                        <span class="text-danger">{{ $errors->updatePassword->first('current_password') }}</span>
                    @endif
                </div>
            </div>

            <!-- New Password -->
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="update_password_password">{{ __('New Password') }}</label>
                    <input type="password" id="update_password_password" name="password" class="form-control"
                        autocomplete="new-password">
                    @if ($errors->updatePassword->has('password'))
                        <span class="text-danger">{{ $errors->updatePassword->first('password') }}</span>
                    @endif
                </div>
            </div>

            <!-- Confirm New Password -->
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="update_password_password_confirmation">{{ __('Confirm Password') }}</label>
                    <input type="password" id="update_password_password_confirmation" name="password_confirmation"
                        class="form-control" autocomplete="new-password">
                    @if ($errors->updatePassword->has('password_confirmation'))
                        <span class="text-danger">{{ $errors->updatePassword->first('password_confirmation') }}</span>
                    @endif
                </div>
            </div>

            <!-- Save Button -->
            <div class="form-group mb--0 d-flex align-items-center gap-3">
                <!-- Save Button -->
                <input type="submit" class="axil-btn btn-bg-primary" value="Save Changes">

                @if (session('status') === 'password-updated')
                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                        class="text-sm text-success ms-2">{{ __('Saved.') }}</p>
                @endif

            </div>
        </div>
    </form>
</div>
