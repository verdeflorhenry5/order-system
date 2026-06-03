<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
            min-height: 100vh;
            font-family: 'Segoe UI', sans-serif;
        }
        .auth-card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.4);
            background: #ffffff;
        }
        .auth-brand {
            font-size: 2rem;
            font-weight: 800;
            color: #ffffff;
            letter-spacing: 1px;
        }
        .auth-brand span {
            color: #f0c040;
        }
        .form-control {
            border-radius: 10px;
            border: 1.5px solid #dee2e6;
            padding: 10px 14px;
            font-size: 0.88rem;
        }
        .form-control:focus {
            border-color: #203a43;
            box-shadow: 0 0 0 3px rgba(32,58,67,0.15);
        }
        .btn-primary-custom {
            background: linear-gradient(135deg, #203a43, #2c5364);
            border: none;
            border-radius: 10px;
            color: #fff;
            padding: 10px;
            font-weight: 600;
            font-size: 0.88rem;
            letter-spacing: 0.4px;
            transition: all 0.2s;
        }
        .btn-primary-custom:hover {
            background: linear-gradient(135deg, #0f2027, #203a43);
            color: #f0c040;
        }
        .link-gold {
            color: #c9922a;
            font-weight: 600;
            text-decoration: none;
        }
        .link-gold:hover {
            color: #a0721a;
        }
    </style>
</head>
<body>

<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="w-100" style="max-width: 440px;">

        <div class="mb-4 text-center">
            <div class="auth-brand">Henry</div>
            <p style="font-size:0.82rem; color:rgba(255,255,255,0.6); margin-top:6px;">
                Fresh food, delivered to your door.
            </p>
        </div>

        <div class="p-4 card auth-card">
            {{ $slot }}
        </div>

    </div>
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
