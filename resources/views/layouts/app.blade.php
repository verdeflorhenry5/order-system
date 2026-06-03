<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f0f4f8;
            font-family: 'Segoe UI', sans-serif;
        }
        .sidebar {
            width: 220px;
            min-height: 100vh;
            background: linear-gradient(180deg, #0f2027, #2c5364);
            position: fixed;
            top: 0;
            left: 0;
            z-index: 100;
        }
        .sidebar .brand {
            font-size: 1.2rem;
            font-weight: 800;
            color: #fff;
            padding: 22px 20px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            display: block;
        }
        .sidebar .nav-link {
            color: rgba(255,255,255,0.7);
            padding: 11px 20px;
            font-size: 0.88rem;
            transition: all 0.2s;
            border-left: 3px solid transparent;
        }
        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background-color: rgba(255,255,255,0.1);
            color: #fff;
            border-left: 3px solid #f0c040;
        }
        .topbar {
            margin-left: 220px;
            background-color: #fff;
            border-bottom: 1px solid #e2e8f0;
            padding: 11px 24px;
            position: sticky;
            top: 0;
            z-index: 99;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .main-content {
            margin-left: 220px;
            padding: 28px;
            min-height: 100vh;
        }
        .btn-logout {
            background: linear-gradient(135deg, #0f2027, #2c5364);
            border: none;
            color: #fff;
            border-radius: 8px;
            font-size: 0.82rem;
            padding: 6px 14px;
        }
    </style>
</head>
<body>

{{-- Sidebar --}}
<div class="sidebar">
    <span class="brand">Henry</span>
    <nav class="mt-2 nav flex-column">
        <a href="{{ route('dashboard') }}"
            class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            Dashboard
        </a>
        <a href="{{ route('users.index') }}"
            class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}">
            Users
        </a>
        <a href="{{ route('orders.index') }}"
            class="nav-link {{ request()->routeIs('orders.*') ? 'active' : '' }}">
            Orders
        </a>
        <a href="{{ route('profile.edit') }}"
            class="nav-link {{ request()->routeIs('profile.*') ? 'active' : '' }}">
            Profile
        </a>
    </nav>
</div>

{{-- Topbar --}}
<div class="topbar">
    <span style="font-size:0.82rem; color:#a0aec0;">
        {{ now()->format('l, F j, Y') }}
    </span>
    <div class="gap-3 d-flex align-items-center">
        <span style="font-size:0.88rem; font-weight:600; color:#1a3a4a;">
            {{ auth()->user()->name }}
        </span>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-logout btn-sm">
                Logout
            </button>
        </form>
    </div>
</div>

{{-- Main Content --}}
<div class="main-content">
    {{ $slot }}
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    toastr.options = {
        positionClass: 'toast-top-right',
        timeOut: 3000,
        progressBar: true,
        closeButton: true,
    };

    @if(session('success'))
        toastr.success("{{ session('success') }}");
    @endif

    @if(session('error'))
        toastr.error("{{ session('error') }}");
    @endif
</script>

</body>
</html>
