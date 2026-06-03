<x-guest-layout>

    <div class="mb-4">
        <h5 class="mb-1 fw-bold" style="color:#1a3a4a;">Welcome back!</h5>
        <small class="text-muted">Sign in to your account.</small>
    </div>

    @if($errors->any())
        <div class="px-3 py-2 mb-3 alert alert-danger" style="font-size:0.85rem; border-radius:10px;">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-3">
            <label class="form-label small fw-semibold" style="color:#1a3a4a;">Email Address</label>
            <input type="email" name="email" value="{{ old('email') }}"
                class="form-control @error('email') is-invalid @enderror"
                placeholder=""
                autofocus required>
            @error('email')
                <div class="invalid-feedback" style="font-size:0.78rem;">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label small fw-semibold" style="color:#1a3a4a;">Password</label>
            <input type="password" name="password"
                class="form-control @error('password') is-invalid @enderror"
                placeholder=""
                required>
            @error('password')
                <div class="invalid-feedback" style="font-size:0.78rem;">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4 d-flex justify-content-between align-items-center">
            <div class="mb-0 form-check">
                <input type="checkbox" name="remember" class="form-check-input" id="remember">
                <label class="form-check-label" for="remember"
                    style="font-size:0.82rem; color:#888;">Remember me</label>
            </div>
            @if(Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="link-gold" style="font-size:0.82rem;">
                    Forgot password?
                </a>
            @endif
        </div>

        <div class="mb-3 d-grid">
            <button type="submit" class="btn btn-primary-custom">
                Sign In
            </button>
        </div>

        <p class="mb-0 text-center" style="font-size:0.82rem; color:#aaa;">
            Don't have an account?
            <a href="{{ route('register') }}" class="link-gold">Register here</a>
        </p>

    </form>

</x-guest-layout>
