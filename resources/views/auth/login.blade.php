<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login SIJAD</title>
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

        .login-wrapper {
            width: 100%;
            max-width: 980px;
            display: grid;
            grid-template-columns: 1.1fr 0.9fr;
            background: white;
            border-radius: 32px;
            overflow: hidden;
            box-shadow: 0 30px 70px rgba(0, 0, 0, 0.28);
            position: relative;
            z-index: 2;
        }

        .login-left {
            background: linear-gradient(180deg, #003b8f, #001f4d);
            color: white;
            padding: 45px;
            position: relative;
            overflow: hidden;
        }

        .login-left::before {
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

        .login-left::after {
            content: "";
            position: absolute;
            width: 170px;
            height: 170px;
            background: white;
            border-radius: 50%;
            opacity: 0.08;
            left: -70px;
            bottom: -70px;
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
            max-width: 420px;
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

        .login-right {
            padding: 45px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .login-title {
            margin-bottom: 28px;
        }

        .login-title h2 {
            font-size: 32px;
            color: #001f4d;
            font-weight: 900;
            margin-bottom: 8px;
        }

        .login-title p {
            color: #64748b;
            font-size: 15px;
            line-height: 1.6;
        }

        .error {
            background: #fee2e2;
            color: #b91c1c;
            padding: 13px 15px;
            border-radius: 14px;
            margin-bottom: 18px;
            font-weight: 800;
            font-size: 14px;
            border: 1px solid #fecaca;
        }

        .form-group {
            margin-bottom: 18px;
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

        .btn-login {
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

        .btn-login:hover {
            background: #ffea70;
            transform: translateY(-2px);
        }

        .login-note {
            margin-top: 18px;
            background: #eaf2ff;
            color: #003b8f;
            padding: 13px 15px;
            border-radius: 14px;
            font-size: 13px;
            font-weight: 700;
            line-height: 1.6;
        }

        .footer {
            text-align: center;
            margin-top: 24px;
            color: #64748b;
            font-size: 13px;
        }

        @media (max-width: 850px) {
            .login-wrapper {
                grid-template-columns: 1fr;
            }

            .login-left {
                text-align: center;
                padding: 35px 25px;
            }

            .brand p {
                max-width: 100%;
            }

            .feature-list {
                display: none;
            }

            .login-right {
                padding: 35px 25px;
            }
        }
    </style>
</head>

<body>
    <div class="login-wrapper">

        <div class="login-left">
            <div class="brand">
                <img src="{{ asset('images/logo-narotama.png') }}" alt="Logo Narotama">

                <h1>SIJAD</h1>

                <h2>Sistem Informasi Jurnal Akademik Dosen</h2>

                <p>
                    Platform pengelolaan repository jurnal akademik dosen Universitas Narotama
                    untuk proses pengajuan, verifikasi, pelaporan, dan dokumentasi publikasi ilmiah.
                </p>
            </div>

            <div class="feature-list">
                <div class="feature-item">
                    ✅ Dosen dapat mengajukan jurnal secara mandiri
                </div>

                <div class="feature-item">
                    ✅ Admin dapat memverifikasi jurnal dosen
                </div>

                <div class="feature-item">
                    ✅ Data jurnal tersimpan dan dapat dibuat laporan
                </div>
            </div>
        </div>

        <div class="login-right">
            <div class="login-title">
                <h2>Masuk Akun</h2>
                <p>
                    Silakan login menggunakan akun yang sudah terdaftar sebagai admin atau dosen.
                </p>
            </div>

            @if ($errors->any())
                <div class="error">
                    Email atau password salah.
                </div>
            @endif

            <form action="{{ route('login.process') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email"
                           id="email"
                           name="email"
                           value="{{ old('email') }}"
                           placeholder="Masukkan email"
                           required>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password"
                           id="password"
                           name="password"
                           placeholder="Masukkan password"
                           required>
                </div>

                <button type="submit" class="btn-login">
                    Masuk ke SIJAD
                </button>
            </form>

            <div class="login-note">
                Admin akan diarahkan ke dashboard admin. Dosen akan diarahkan ke dashboard dosen untuk mengunggah jurnal.
            </div>
            <div class="login-note">
                Belum punya akun dosen?
                <a href="{{ route('register') }}" style="color:#003b8f; font-weight:900; text-decoration:none;">
                    Daftar di sini
                </a>
            </div>
            <div class="footer">
                © {{ date('Y') }} Universitas Narotama Surabaya
            </div>
        </div>

    </div>
</body>
</html>