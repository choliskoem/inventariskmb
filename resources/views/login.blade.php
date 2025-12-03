<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Dashboard RRI v3</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <style>
        body {
            background: #eef3ff;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Segoe UI', sans-serif;
        }

        .wrapper-box {
            width: 100%;
            max-width: 950px;
            background: #ffffff;
            border-radius: 25px;
            overflow: hidden;
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.15);
            display: grid;
            grid-template-columns: 1fr 1fr;
        }

        /* Left Blue Section */
        .left-panel {
            background: linear-gradient(180deg, #3fa9ff, #1967d2);
            color: #fff;
            padding: 60px 40px;
        }

        .left-panel h1 {
            font-size: 38px;
            font-weight: 700;
            margin-top: 20px;
        }

        .left-panel p {
            font-size: 14px;
            margin-top: 20px;
            opacity: 0.9;
        }

        /* Right Login Section */
        .right-panel {
            padding: 50px 40px;
        }

        .login-title {
            font-weight: 700;
            color: #0036A6;
            font-size: 1.6rem;
            margin-bottom: 20px;
        }

        .input-group-text {
            background: #0036A620;
            color: #0036A6;
            border: none;
        }

        .form-control:focus {
            border-color: #0036A6;
            box-shadow: 0 0 0 0.2rem rgba(0, 54, 166, 0.25);
        }

        .btn-primary {
            background-color: #0036A6;
            border-color: #0036A6;
            border-radius: 12px;
            font-weight: 600;
            padding: 10px 0;
        }

        .btn-primary:hover {
            background-color: #002B7F;
        }

        .password-wrapper {
            position: relative;
        }

        .password-wrapper input {
            padding-right: 40px;
        }

        .password-wrapper .toggle-password {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            cursor: pointer;
            color: #0036A6;
        }

        @media(max-width: 768px) {
            .wrapper-box {
                grid-template-columns: 1fr;
            }

            .left-panel {
                text-align: center;
            }
        }
    </style>
</head>

<body>

    <div class="wrapper-box">

        <!-- LEFT PANEL -->
        <div class="left-panel">
            <h4>RRI Gorontalo</h4>
            <h1>WELCOME</h1>
            <p>Silakan login untuk melanjutkan ke dashboard inventaris RRI.</p>
        </div>

        <!-- RIGHT PANEL -->
        <div class="right-panel">

            <img src="{{ asset('assets/images/rrilogo2.png') }}" class="mb-3" width="80" />

            <h3 class="login-title">Login Inventaris KMB</h3>

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form action="{{ route('login.process') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                            value="{{ old('email') }}" placeholder="Masukkan email" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3 password-wrapper">
                    <label class="form-label">Password</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa fa-lock"></i></span>
                        <input type="password" id="password"
                            class="form-control @error('password') is-invalid @enderror" name="password"
                            placeholder="Masukkan password" required>
                        <i class="fa fa-eye toggle-password"></i>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <button class="btn btn-primary w-100 mt-3" type="submit">Login</button>
            </form>

            {{-- <p class="text-center mt-3">Belum punya akun? <a href="#" class="fw-bold"
                    style="color:#0036A6;">Daftar</a></p> --}}
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        const togglePassword = document.querySelector('.toggle-password');
        const password = document.querySelector('#password');

        togglePassword.addEventListener('click', function() {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });
    </script>

</body>

</html>
