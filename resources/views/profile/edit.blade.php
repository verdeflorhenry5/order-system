<x-app-layout>

    <div class="mb-4">
        <h4>My Profile</h4>
        <p class="text-muted">View and update your account details.</p>
    </div>

    <div class="row g-4">

        {{-- Left Side --}}
        <div class="col-md-4">
            <div class="p-4 text-center card" style="border-radius:16px; border-top: 4px solid #2c5364;">

                @if(auth()->user()->avatar)
                    <img src="{{ asset('storage/' . auth()->user()->avatar) }}"
                        class="mx-auto mb-3 rounded-circle d-block"
                        width="90" height="90"
                        style="object-fit:cover; border:3px solid #2c5364;">
                @else
                    <div class="mx-auto mb-3 d-flex align-items-center justify-content-center"
                        style="width:90px; height:90px; border-radius:50%; background:#e8f4f8; border:3px solid #2c5364; font-size:2rem;">
                        👤
                    </div>
                @endif

                <h5 class="mb-0 fw-bold">{{ auth()->user()->name }}</h5>
                <small class="text-muted">{{ auth()->user()->email }}</small>

                <hr>

                <table class="table table-sm text-start">
                    <tr>
                        <td class="text-muted" style="font-size:0.82rem;">Address</td>
                        <td style="font-size:0.82rem;">{{ auth()->user()->address ?? '—' }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted" style="font-size:0.82rem;">Gender</td>
                        <td style="font-size:0.82rem;">{{ auth()->user()->gender ?? '—' }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted" style="font-size:0.82rem;">Joined</td>
                        <td style="font-size:0.82rem;">{{ auth()->user()->created_at->format('M Y') }}</td>
                    </tr>
                </table>

            </div>
        </div>

        {{-- Right Side --}}
        <div class="col-md-8">
            <div class="p-4 card" style="border-radius:16px; border-top: 4px solid #f0c040;">
                <h6 class="mb-4 fw-bold">Edit Profile</h6>

                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold">Full Name</label>
                            <input type="text" name="name" value="{{ auth()->user()->name }}"
                                class="form-control form-control-sm @error('name') is-invalid @enderror"
                                required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label small fw-semibold">Email Address</label>
                            <input type="email" name="email" value="{{ auth()->user()->email }}"
                                class="form-control form-control-sm @error('email') is-invalid @enderror"
                                required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label small fw-semibold">Address</label>
                            <input type="text" name="address" value="{{ auth()->user()->address }}"
                                class="form-control form-control-sm"
                                placeholder="e.g. Dasmariñas, Cavite">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label small fw-semibold">Gender</label>
                            <select name="gender" class="form-select form-select-sm">
                                <option value="">-- Select --</option>
                                <option value="Male" {{ auth()->user()->gender === 'Male' ? 'selected' : '' }}>Male</option>
                                <option value="Female" {{ auth()->user()->gender === 'Female' ? 'selected' : '' }}>Female</option>
                                <option value="Other" {{ auth()->user()->gender === 'Other' ? 'selected' : '' }}>Other</option>
                            </select>
                        </div>

                        <div class="col-12">
                            <label class="form-label small fw-semibold">Profile Picture</label>
                            <input type="file" name="avatar" accept="image/*" class="form-control form-control-sm">
                            <small class="text-muted">JPG, PNG up to 2MB</small>
                        </div>

                        <div class="col-12">
                            <button type="submit" class="text-white btn btn-sm w-100"
                                style="background: linear-gradient(135deg, #0f2027, #2c5364); border-radius:8px;">
                                Save Changes
                            </button>
                        </div>
                    </div>

                </form>
            </div>
        </div>

    </div>

</x-app-layout>
