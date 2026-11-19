<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login | EduManage</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            min-height: 100vh;
            background: #f4f1fa;
            font-family: Arial, sans-serif;
        }

        .login-wrapper {
            min-height: 100vh;
        }

        .brand-panel {
            background: linear-gradient(135deg, #25143B, #692386);
            color: white;
            min-height: 100vh;
        }

        .login-card {
            width: 100%;
            max-width: 430px;
            border: none;
            border-radius: 20px;
        }

        .form-control {
            padding: 13px;
            border-radius: 10px;
        }

        .btn-login {
            background: #692386;
            color: white;
            padding: 13px;
        }

        .btn-login:hover {
            background: #25143B;
            color: white;
        }

        @media(max-width: 767px) {
            .brand-panel {
                display: none;
            }
        }
    </style>
</head>

<body>

    <div class="container-fluid">

        <div class="row login-wrapper">

            <!-- Branding -->
            <div class="col-md-6 brand-panel
                    d-flex flex-column justify-content-center p-5">

                <h1 class="fw-bold">EduManage</h1>

                <h4>Smarter Education Management</h4>

                <p class="text-white-50">
                    Manage students, teachers and courses
                    through one centralized platform.
                </p>

            </div>

            <!-- Login Form -->
            <div class="col-md-6 d-flex align-items-center
                    justify-content-center p-4">

                <div class="card login-card shadow-lg">

                    <div class="card-body p-4 p-md-5">

                        <h3 class="fw-bold text-center">
                            Welcome Back
                        </h3>

                        <p class="text-muted text-center">
                            Sign in to your EduManage account.
                        </p>

                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form action="{{ route('login') }}" method="POST">

                            @csrf

                            <div class="mb-3">

                                <label class="form-label">
                                    Email Address
                                </label>

                                <input type="email" name="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    value="{{ old('email') }}" placeholder="Enter your email" required>

                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                            <div class="mb-3">

                                <label class="form-label">
                                    Password
                                </label>

                                <input type="password" name="password" class="form-control" placeholder="Enter password"
                                    required>

                            </div>

                            <div class="form-check mb-4">

                                <input type="checkbox" name="remember" value="1" class="form-check-input"
                                    id="remember">

                                <label class="form-check-label" for="remember">
                                    Remember Me
                                </label>

                            </div>

                            <button type="submit" class="btn btn-login w-100">

                                Sign In

                            </button>

                        </form>

                        <p class="text-center text-muted mt-4 mb-0">
                            Authorized Personnel Only
                        </p>

                    </div>
                </div>

            </div>

        </div>

    </div>

</body>

</html>
