<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Register Dosen SIJAD</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Segoe UI", Arial, sans-serif;
        }

        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #001f4d, #003b8f);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            position: relative;
            overflow: hidden;
        }

        body::before {
            content: "";
            position: absolute;
            width: 420px;
            height: 420px;
            background: #ffd400;
            border-radius: 50%;
            opacity: 0.16;
            top: -150px;
            right: -120px;
        }

        body::after {
            content: "";
            position: absolute;
            width: 360px;
            height: 360px;
            background: #ffffff;
            border-radius: 50%;
            opacity: 0.08;
            bottom: -140px;
            left: -120px;
        }

        .register-wrapper {
            width: 100%;
            max-width: 980px;
            display: grid;
            grid-template-columns: 1.05fr 0.95fr;
            background: white;
            border-radius: 32px;
            overflow: hidden;
            box-shadow: 0 30px 70px rgba(0, 0, 0, 0.28);
            position: relative;
            z-index: 2;
        }

        .register-left {
            background: linear-gradient(180deg, #003b8f, #001f4d);
            color: white;
            padding: 45px;
            position: relative;
            overflow: hidden;
        }

        .register-left::before {
            content: "";
            position: absolute;
            width: 230px;
            height: 230px;
            background: #ffd400;
            border-radius: 50%;
            opacity: 0.22;
            right: -80px;
            top: -80px;
        }

        .brand {
            position: relative;
            z-index: 2;
        }

        .brand img {
            width: 125px;
            height: 125px;
            object-fit: contain;
            margin-bottom: 20px;
        }

        .brand h1 {
            font-size: 56px;
            font-weight: 900;
            letter-spacing: 3px;
            margin-bottom: 10px;
        }

        .brand h2 {
            font-size: 24px;
            font-weight: 800;
            margin-bottom: 15px;
            color: #ffd400;
        }

        .brand p {
            color: #dbeafe;
            font-size: 15px;
            line-height: 1.7;
            max-width: 430px;
        }

        .feature-list {
            position: relative;
            z-index: 2;
            margin-top: 35px;
            display: grid;
            gap: 14px;
        }

        .feature-item {
            background: rgba(255, 255, 255, 0.10);
            border: 1px solid rgba(255, 255, 255, 0.15);
            padding: 14px 16px;
            border-radius: 16px;
            color: #f8fafc;
            font-size: 14px;
            font-weight: 700;
        }

        .register-right {
            padding: 45px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .register-title {
            margin-bottom: 26px;
        }

        .register-title h2 {
            font-size: 32px;
            color: #001f4d;
            font-weight: 900;
            margin-bottom: 8px;
        }

        .register-title p {
            color: #64748b;
            font-size: 15px;
            line-height: 1.6;
        }

        .error-box {
            background: #fee2e2;
            color: #b91c1c;
            padding: 13px 15px;
            border-radius: 14px;
            margin-bottom: 18px;
            font-weight: 700;
            font-size: 14px;
            border: 1px solid #fecaca;
        }

        .error-box ul {
            margin-left: 18px;
            margin-top: 8px;
        }

        .form-group {
            margin-bottom: 16px;
        }

        label {
            display: block;
            font-weight: 900;
            color: #001f4d;
            margin-bottom: 8px;
            font-size: 14px;
        }

        input {
            width: 100%;
            padding: 15px 16px;
            border-radius: 15px;
            border: 1px solid #d1d5db;
            outline: none;
            font-size: 14px;
            transition: 0.25s;
        }

        input:focus {
            border-color: #003b8f;
            box-shadow: 0 0 0 4px rgba(0, 59, 143, 0.12);
        }

        .btn-register {
            width: 100%;
            border: none;
            background: #ffd400;
            color: #001f4d;
            padding: 15px;
            border-radius: 15px;
            font-weight: 900;
            cursor: pointer;
            font-size: 15px;
            margin-top: 8px;
            transition: 0.25s;
            box-shadow: 0 12px 25px rgba(255, 212, 0, 0.28);
        }

        .btn-register:hover {
            background: #ffea70;
            transform: translateY(-2px);
        }

        .login-link {
            margin-top: 18px;
            text-align: center;
            color: #64748b;
            font-size: 14px;
        }

        .login-link a {
            color: #003b8f;
            font-weight: 900;
            text-decoration: none;
        }

        .footer {
            text-align: center;
            margin-top: 22px;
            color: #64748b;
            font-size: 13px;
        }

        @media (max-width: 850px) {
            .register-wrapper {
                grid-template-columns: 1fr;
            }

            .register-left {
                text-align: center;
                padding: 35px 25px;
            }

            .brand p {
                max-width: 100%;
            }

            .feature-list {
                display: none;
            }

            .register-right {
                padding: 35px 25px;
            }
        }
    </style>
</head>

<body>
    <div class="register-wrapper">

        <div class="register-left">
            <div class="brand">
                <img src="{{ asset('images/logo-narotama.png') }}" alt="Logo Narotama">

                <h1>SIJAD</h1>

                <h2>Registrasi Dosen</h2>

                <p>
                    Buat akun dosen untuk mengajukan jurnal akademik secara mandiri.
                    Setiap jurnal yang diajukan akan diverifikasi oleh admin SIJAD.
                </p>
            </div>

            <div class="feature-list">
                <div class="feature-item">
                    ✅ Akun otomatis terdaftar sebagai dosen
                </div>

                <div class="feature-item">
                    ✅ Dosen dapat mengunggah jurnal sendiri
                </div>

                <div class="feature-item">
                    ✅ Status jurnal dapat dipantau melalui dashboard dosen
                </div>
            </div>
        </div>

        <div class="register-right">
            <div class="register-title">
                <h2>Daftar Akun Dosen</h2>
                <p>
                    Lengkapi data berikut untuk membuat akun dosen SIJAD.
                </p>
            </div>

            @if ($errors->any())
                <div class="error-box">
                    <strong>Periksa kembali input berikut:</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('register.process') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="name">Nama Lengkap Dosen</label>
                    <input type="text"
                           id="name"
                           name="name"
                           value="{{ old('name') }}"
                           placeholder="Masukkan nama lengkap dosen"
                           required>
                </div>

                <div class="form-group">
                    <label for="email">Email Dosen</label>
                    <input type="email"
                           id="email"
                           name="email"
                           value="{{ old('email') }}"
                           placeholder="Masukkan email dosen"
                           required>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password"
                           id="password"
                           name="password"
                           placeholder="Minimal 6 karakter"
                           required>
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Konfirmasi Password</label>
                    <input type="password"
                           id="password_confirmation"
                           name="password_confirmation"
                           placeholder="Ulangi password"
                           required>
                </div>

                <button type="submit" class="btn-register">
                    Daftar Sebagai Dosen
                </button>
            </form>

            <div class="login-link">
                Sudah punya akun?
                <a href="{{ route('login') }}">Login di sini</a>
            </div>

            <div class="footer">
                © {{ date('Y') }} Universitas Narotama Surabaya
            </div>
        </div>

    </div>
</body>
</html>