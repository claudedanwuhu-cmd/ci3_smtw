<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? $title : 'Login Portal - SMA Negeri Tawangmangu'; ?></title>

    <!-- Font Awesome & Google Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            /* Light Theme Variables */
            --bg-body: #0f172a;
            --card-bg: #ffffff;
            --text-title: #0f172a;
            --text-subtitle: #64748b;
            --input-bg: #f8fafc;
            --input-border: #e2e8f0;
            --input-text: #1e293b;
            --input-label: #94a3b8;
            --icon-color: #94a3b8;
            --footer-text: #94a3b8;
            --orb-opacity: 0.35;
        }

        [data-theme="dark"] {
            /* Dark Theme Variables */
            --bg-body: #020617;
            --card-bg: #0f172a;
            --text-title: #f8fafc;
            --text-subtitle: #94a3b8;
            --input-bg: #1e293b;
            --input-border: #334155;
            --input-text: #f8fafc;
            --input-label: #64748b;
            --icon-color: #64748b;
            --footer-text: #64748b;
            --orb-opacity: 0.2;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Plus Jakarta Sans', sans-serif;
            transition: background-color 0.4s ease, border-color 0.4s ease, color 0.4s ease, box-shadow 0.4s ease;
        }

        body {
            background: var(--bg-body);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            position: relative;
        }

        /* Ambient Background Orbs */
        .bg-orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(90px);
            opacity: var(--orb-opacity);
            z-index: 1;
        }

        .bg-orb-1 {
            width: 400px;
            height: 400px;
            background: #00b4d8;
            top: -80px;
            left: -80px;
        }

        .bg-orb-2 {
            width: 350px;
            height: 350px;
            background: #7209b7;
            bottom: -80px;
            right: -80px;
        }

        /* -------------------------------------------------------------
           THEME TOGGLE BUTTON
           ------------------------------------------------------------- */
        .theme-toggle-btn {
            position: fixed;
            top: 24px;
            right: 24px;
            z-index: 100;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: #ffffff;
            width: 44px;
            height: 44px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 18px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .theme-toggle-btn:hover {
            transform: scale(1.1) rotate(15deg);
            background: rgba(255, 255, 255, 0.2);
        }

        /* -------------------------------------------------------------
           MAIN CARD CONTAINER
           ------------------------------------------------------------- */
        .wrapper {
            position: relative;
            z-index: 10;
        }

        .container {
            position: relative;
            width: 850px;
            height: 520px;
            background: var(--card-bg);
            border-radius: 30px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.35), 0 0 35px rgba(0, 180, 216, 0.15);
            overflow: hidden;
            isolation: isolate;
            transform: translateZ(0);
            backface-visibility: hidden;
            display: flex;
            opacity: 0;
        }

        /* Saat animasi diaktifkan */
        body.animated .container {
            transition: opacity 0.6s cubic-bezier(0.16, 1, 0.3, 1);
        }

        body.loaded .container {
            opacity: 1;
        }

        /* -------------------------------------------------------------
           PANEL BIRU (LEFT COVER)
           ------------------------------------------------------------- */
        .curved-cover {
            position: absolute;
            left: 0;
            top: 0;
            width: 45%;
            height: 100%;
            background: linear-gradient(135deg, #00b4d8 0%, #0077b6 50%, #03045e 100%);
            border-radius: 30px 130px 130px 30px; 
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 5;
            will-change: transform, opacity;
            backface-visibility: hidden;
            transform: translate3d(-100%, 0, 0); 
            opacity: 0;
        }

        body.animated .curved-cover {
            transition: transform 0.9s cubic-bezier(0.16, 1, 0.3, 1), opacity 0.8s ease;
        }

        body.loaded .curved-cover {
            transform: translate3d(0, 0, 0);
            opacity: 1;
        }

        .cover-content {
            padding: 0 40px;
            text-align: center;
            color: #ffffff;
            width: 100%;
            position: relative;
            z-index: 6;
            will-change: transform, opacity;
            opacity: 0;
            transform: translate3d(0, 15px, 0);
        }

        body.animated .cover-content {
            transition: transform 0.8s cubic-bezier(0.16, 1, 0.3, 1) 0.2s, opacity 0.8s ease 0.2s;
        }

        body.loaded .cover-content {
            opacity: 1;
            transform: translate3d(0, 0, 0);
        }

        .cover-content .school-icon {
            font-size: 52px;
            margin-bottom: 16px;
            display: inline-block;
        }

        .cover-content h2 {
            font-size: 24px;
            font-weight: 800;
            margin-bottom: 10px;
            line-height: 1.25;
            letter-spacing: 0.5px;
        }

        .cover-content p {
            font-size: 12.5px;
            font-weight: 400;
            margin-bottom: 28px;
            opacity: 0.9;
            line-height: 1.5;
        }

        .btn-ghost {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(255, 255, 255, 0.12);
            border: 2px solid rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(6px);
            color: #ffffff;
            font-weight: 700;
            border-radius: 12px;
            padding: 11px 28px;
            font-size: 12.5px;
            text-decoration: none;
            cursor: pointer;
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .btn-ghost:hover {
            background: #ffffff;
            color: #0077b6;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        .btn-ghost i { transition: transform 0.3s ease; }
        .btn-ghost:hover i { transform: translateX(-4px); }

        /* -------------------------------------------------------------
           RIGHT PANEL & FORM
           ------------------------------------------------------------- */
        .form-box {
            position: relative;
            width: 55%;
            height: 100%;
            margin-left: auto;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 0 45px;
            z-index: 2;
        }

        form {
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .stagger-item {
            opacity: 0;
            transform: translate3d(0, 14px, 0);
            will-change: transform, opacity;
            backface-visibility: hidden;
        }

        body.animated .stagger-item {
            transition: transform 0.7s cubic-bezier(0.16, 1, 0.3, 1), opacity 0.7s cubic-bezier(0.16, 1, 0.3, 1);
        }

        body.loaded .stagger-item {
            opacity: 1;
            transform: translate3d(0, 0, 0);
        }

        /* Stagger Delay HANYA AKTIF jika body memiliki class 'animated' */
        body.animated.loaded .stagger-item:nth-of-type(1) { transition-delay: 0.20s; }
        body.animated.loaded .stagger-item:nth-of-type(2) { transition-delay: 0.27s; }
        body.animated.loaded .stagger-item:nth-of-type(3) { transition-delay: 0.34s; }
        body.animated.loaded .stagger-item:nth-of-type(4) { transition-delay: 0.41s; }
        body.animated.loaded .stagger-item:nth-of-type(5) { transition-delay: 0.48s; }
        body.animated.loaded .stagger-item:nth-of-type(6) { transition-delay: 0.55s; }
        body.animated.loaded .stagger-item:nth-of-type(7) { transition-delay: 0.62s; }

        .school-badge {
            display: flex;
            align-items: center;
            gap: 8px;
            background: rgba(0, 180, 216, 0.12);
            color: #00b4d8;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 700;
            margin-bottom: 12px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        h1 {
            font-size: 26px;
            font-weight: 800;
            color: var(--text-title);
            margin-bottom: 4px;
        }

        .subtitle {
            color: var(--text-subtitle);
            font-size: 12px;
            margin-bottom: 20px;
            text-align: center;
        }

        /* -------------------------------------------------------------
           ALERT ERROR
           ------------------------------------------------------------- */
        .alert-error {
            width: 100%;
            display: flex;
            align-items: center;
            gap: 12px;
            background: rgba(239, 68, 68, 0.08);
            border: 1.5px solid rgba(239, 68, 68, 0.25);
            color: #ef4444;
            border-radius: 12px;
            padding: 12px 16px;
            font-size: 12.5px;
            font-weight: 600;
            margin-bottom: 16px;
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.08);
            max-height: 80px;
            opacity: 1;
            transition: all 0.5s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .alert-error i {
            font-size: 16px;
            flex-shrink: 0;
        }

        .alert-error.fade-out {
            opacity: 0;
            max-height: 0;
            padding-top: 0;
            padding-bottom: 0;
            margin-bottom: 0;
            border-width: 0;
            overflow: hidden;
        }

        /* -------------------------------------------------------------
           INPUT GROUP
           ------------------------------------------------------------- */
        .input-group {
            position: relative;
            width: 100%;
            margin-bottom: 18px;
        }

        .input-group input {
            width: 100%;
            height: 54px;
            padding: 18px 45px 6px 45px;
            background: var(--input-bg);
            border: 1.5px solid var(--input-border);
            border-radius: 14px;
            outline: none;
            color: var(--input-text);
            font-size: 13.5px;
            font-weight: 600;
            transition: all 0.3s cubic-bezier(0.25, 1, 0.5, 1);
        }

        .input-group label {
            position: absolute;
            left: 45px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--input-label);
            font-size: 13px;
            font-weight: 500;
            pointer-events: none;
            transition: all 0.25s cubic-bezier(0.25, 1, 0.5, 1);
        }

        .input-group .icon-left {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--icon-color);
            font-size: 15px;
            transition: color 0.3s ease;
        }

        .input-group .toggle-pass {
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--icon-color);
            cursor: pointer;
            font-size: 14px;
            transition: color 0.2s ease;
        }

        .input-group .toggle-pass:hover { color: #00b4d8; }

        .input-group input:focus,
        .input-group input:not(:placeholder-shown) {
            border-color: #00b4d8;
            background: var(--card-bg);
            box-shadow: 0 0 0 4px rgba(0, 180, 216, 0.15);
        }

        .input-group input:focus ~ label,
        .input-group input:not(:placeholder-shown) ~ label {
            top: 8px;
            transform: translateY(0);
            left: 45px;
            font-size: 10px;
            color: #00b4d8;
            font-weight: 700;
            letter-spacing: 0.3px;
        }

        .input-group input:focus ~ .icon-left,
        .input-group input:not(:placeholder-shown) ~ .icon-left {
            color: #00b4d8;
        }

        .btn-main {
            position: relative;
            border-radius: 12px;
            border: none;
            background: linear-gradient(135deg, #00b4d8 0%, #0077b6 100%);
            color: #ffffff;
            font-size: 13.5px;
            font-weight: 700;
            padding: 14px 45px;
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
            cursor: pointer;
            width: 100%;
            box-shadow: 0 6px 20px rgba(0, 180, 216, 0.35);
            margin-top: 4px;
            display: block;
        }

        .btn-main:hover {
            background: linear-gradient(135deg, #0096c7 0%, #03045e 100%);
            box-shadow: 0 10px 25px rgba(0, 180, 216, 0.5);
            transform: translateY(-2px);
        }

        .school-footer {
            margin-top: 20px;
            font-size: 11px;
            color: var(--footer-text);
            text-align: center;
        }

        @media (max-width: 768px) {
            .container {
                width: 90%;
                flex-direction: column;
                height: auto;
            }
            .curved-cover {
                position: relative;
                width: 100%;
                border-radius: 30px 30px 0 0;
                padding: 35px 0;
                transform: translate3d(0, -100%, 0);
            }
            .form-box {
                width: 100%;
                padding: 30px 20px;
            }
            .theme-toggle-btn {
                top: 16px;
                right: 16px;
            }
        }
    </style>
</head>
<body>

    <!-- Ambient Background Orbs -->
    <div class="bg-orb bg-orb-1"></div>
    <div class="bg-orb bg-orb-2"></div>

    <!-- SAKELAR TEMA GELAP / TERANG -->
    <button type="button" class="theme-toggle-btn" id="theme-toggle" title="Ubah Tema">
        <i class="fa-solid fa-moon" id="theme-icon"></i>
    </button>

    <div class="wrapper">
        <div class="container">
            
            <!-- PANEL BIRU -->
            <div class="curved-cover">
                <div class="cover-content">
                    <i class="fa-solid fa-graduation-cap school-icon"></i>
                    <h2>SMA NEGERI TAWANGMANGU</h2>
                    <p>Sistem Informasi Akademik & Portal Terpadu Sekolah.</p>
                    
                    <a href="<?= site_url('home'); ?>" class="btn-ghost">
                        <i class="fa-solid fa-arrow-left"></i> Kembali ke Beranda
                    </a>
                </div>
            </div>

            <!-- FORM PANEL -->
            <div class="form-box">
                <!-- Tambahkan ID login-form untuk mendeteksi submit -->
                <form id="login-form" action="<?= site_url('admin/auth/login'); ?>" method="POST">
                    
                    <div class="school-badge stagger-item">
                        <i class="fa-solid fa-building-columns"></i> SMAN Tawangmangu
                    </div>
                    
                    <h1 class="stagger-item">Masuk Akun</h1>
                    <div class="subtitle stagger-item">Silakan isi kredensial untuk melanjutkan</div>

                    <?php if (isset($this) && $this->session->flashdata('error')): ?>
                        <div class="alert-error stagger-item" id="alert-notification">
                            <i class="fa-solid fa-circle-exclamation"></i>
                            <span><?= $this->session->flashdata('error'); ?></span>
                        </div>
                    <?php endif; ?>

                    <div class="input-group stagger-item">
                        <input type="text" name="username" id="username" placeholder=" " required autocomplete="username">
                        <label for="username">NISN / NIP / Username</label>
                        <i class="fa-solid fa-user icon-left"></i>
                    </div>

                    <div class="input-group stagger-item">
                        <input type="password" name="password" id="login-password" placeholder=" " required autocomplete="current-password">
                        <label for="login-password">Kata Sandi</label>
                        <i class="fa-solid fa-lock icon-left"></i>
                        <i class="fa-solid fa-eye toggle-pass" onclick="togglePass('login-password', this)"></i>
                    </div>
                    
                    <button type="submit" class="btn-main stagger-item">Masuk Portal</button>

                    <div class="school-footer stagger-item">
                        &copy; <?= date('Y'); ?> SMAN Tawangmangu. All rights reserved.
                    </div>
                </form>
            </div>

        </div>
    </div>

    <script>
        window.addEventListener('DOMContentLoaded', () => {
            // Cek Navigasi Jenis Apa (Reload/First Load vs Submit Form Error)
            const isSubmitted = sessionStorage.getItem('login_submitted');

            if (!isSubmitted) {
                // KONDISI 1: Pertama kali buka web / Refresh halaman manual
                // Jalankan Animasi Masuk
                document.body.classList.add('animated');
                requestAnimationFrame(() => {
                    document.body.classList.add('loaded');
                });
            } else {
                // KONDISI 2: Halaman dimuat ulang karena Validasi/Login Gagal
                // Langsung tampilkan TANPA Animasi Masuk
                document.body.classList.add('loaded');
                // Reset flag setelah dimuat agar jika user men-refresh browser nanti, animasi jalan kembali
                sessionStorage.removeItem('login_submitted');
            }

            // Tandai saat user menekan submit tombol Login
            const loginForm = document.getElementById('login-form');
            if (loginForm) {
                loginForm.addEventListener('submit', () => {
                    sessionStorage.setItem('login_submitted', 'true');
                });
            }

            // Auto Hide Notification Error setelah 4 detik
            const alertNotif = document.getElementById('alert-notification');
            if (alertNotif) {
                setTimeout(() => {
                    alertNotif.classList.add('fade-out');
                    setTimeout(() => {
                        alertNotif.remove();
                    }, 500); 
                }, 4000); 
            }
        });

        // Show/Hide Password Toggle
        function togglePass(inputId, icon) {
            const input = document.getElementById(inputId);
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }

        // Dark / Light Theme Logic
        const themeToggleBtn = document.getElementById('theme-toggle');
        const themeIcon = document.getElementById('theme-icon');

        const savedTheme = localStorage.getItem('theme');
        if (savedTheme) {
            document.documentElement.setAttribute('data-theme', savedTheme);
            updateThemeIcon(savedTheme);
        } else if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
            document.documentElement.setAttribute('data-theme', 'dark');
            updateThemeIcon('dark');
        }

        themeToggleBtn.addEventListener('click', () => {
            const currentTheme = document.documentElement.getAttribute('data-theme');
            let targetTheme = 'dark';

            if (currentTheme === 'dark') {
                targetTheme = 'light';
            }

            document.documentElement.setAttribute('data-theme', targetTheme);
            localStorage.setItem('theme', targetTheme);
            updateThemeIcon(targetTheme);
        });

        function updateThemeIcon(theme) {
            if (theme === 'dark') {
                themeIcon.classList.remove('fa-moon');
                themeIcon.classList.add('fa-sun');
            } else {
                themeIcon.classList.remove('fa-sun');
                themeIcon.classList.add('fa-moon');
            }
        }
    </script>
</body>
</html>