<x-guest-layout>

    <div class="mb-4">
        <h5 class="mb-1 fw-bold" style="color:#1a3a4a;">Create your account</h5>
        <small class="text-muted">Join and start ordering today.</small>
    </div>

    @if($errors->any())
        <div class="px-3 py-2 mb-3 alert alert-danger" style="font-size:0.85rem; border-radius:10px;">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="mb-3">
            <label class="form-label small fw-semibold" style="color:#1a3a4a;">Full Name</label>
            <input type="text" name="name" value="{{ old('name') }}"
                class="form-control @error('name') is-invalid @enderror"
                placeholder=""
                autofocus required>
            @error('name')
                <div class="invalid-feedback" style="font-size:0.78rem;">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label small fw-semibold" style="color:#1a3a4a;">Email Address</label>
            <input type="email" name="email" value="{{ old('email') }}"
                class="form-control @error('email') is-invalid @enderror"
                placeholder=""
                required>
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

        <div class="mb-4">
            <label class="form-label small fw-semibold" style="color:#1a3a4a;">Confirm Password</label>
            <input type="password" name="password_confirmation"
                class="form-control"
                placeholder=""
                required>
        </div>

        <div class="mb-3 d-grid">
            <button type="submit" class="btn btn-primary-custom">
                Create Account
            </button>
        </div>

        <p class="mb-0 text-center" style="font-size:0.82rem; color:#aaa;">
            Already have an account?
            <a href="{{ route('login') }}" class="link-gold">Sign in</a>
        </p>

    </form>

</x-guest-layout>
