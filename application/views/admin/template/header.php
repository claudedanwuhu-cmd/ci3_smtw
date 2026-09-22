<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= isset($title) ? $title : 'Dashboard'; ?> - SMA Negeri Tawangmangu</title>

    <!-- Bootstrap 5, Font Awesome & Google Fonts -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            /* Light Theme Variables */
            --bg-body: #f8fafc;
            --sidebar-bg: #0f172a;
            --topbar-bg: #ffffff;
            --card-bg: #ffffff;
            --text-title: #0f172a;
            --text-subtitle: #64748b;
            --border-color: #e2e8f0;
            --hover-bg: rgba(0, 180, 216, 0.08);
            --active-bg: linear-gradient(135deg, #00b4d8 0%, #0077b6 100%);
            --active-text: #ffffff;
            --orb-opacity: 0.15;
            --shadow-sm: 0 4px 20px rgba(0, 0, 0, 0.05);
        }

        [data-theme="dark"] {
            /* Dark Theme Variables */
            --bg-body: #020617;
            --sidebar-bg: #0f172a;
            --topbar-bg: #0f172a;
            --card-bg: #0f172a;
            --text-title: #f8fafc;
            --text-subtitle: #94a3b8;
            --border-color: #1e293b;
            --hover-bg: rgba(255, 255, 255, 0.05);
            --active-bg: linear-gradient(135deg, #00b4d8 0%, #0077b6 100%);
            --active-text: #ffffff;
            --orb-opacity: 0.25;
            --shadow-sm: 0 4px 20px rgba(0, 0, 0, 0.3);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Plus Jakarta Sans', sans-serif;
            transition: background-color 0.3s ease, border-color 0.3s ease, color 0.3s ease, box-shadow 0.3s ease;
        }

        body {
            background: var(--bg-body);
            color: var(--text-title);
            min-height: 100vh;
            overflow-x: hidden;
            position: relative;
        }

        /* Ambient Background Orbs */
        .bg-orb {
            position: fixed;
            border-radius: 50%;
            filter: blur(100px);
            opacity: var(--orb-opacity);
            z-index: 0;
            pointer-events: none;
        }

        .bg-orb-1 {
            width: 500px;
            height: 500px;
            background: #00b4d8;
            top: -100px;
            right: -100px;
        }

        .bg-orb-2 {
            width: 400px;
            height: 400px;
            background: #7209b7;
            bottom: -100px;
            left: 200px;
        }

        /* SIDEBAR STYLING */
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            width: 260px;
            height: 100vh;
            background: var(--sidebar-bg);
            border-right: 1px solid var(--border-color);
            z-index: 1000;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            overflow: hidden;
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .sidebar-wrapper-top {
            display: flex;
            flex-direction: column;
            flex: 1;
            min-height: 0; /* Menjaga scrollbar bekerja di dalam flex container */
        }

        .sidebar-brand {
            height: 80px;
            display: flex;
            align-items: center;
            padding: 0 24px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            text-decoration: none;
            flex-shrink: 0;
        }

        .brand-icon {
            width: 44px;
            height: 44px;
            border-radius: 14px;
            background: linear-gradient(135deg, #00b4d8 0%, #0077b6 100%);
            color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            margin-right: 14px;
            box-shadow: 0 4px 15px rgba(0, 180, 216, 0.4);
            flex-shrink: 0;
        }

        .brand-text {
            font-weight: 800;
            font-size: 14px;
            line-height: 1.25;
            color: #ffffff;
            letter-spacing: 0.5px;
        }

        .brand-text small {
            display: block;
            font-size: 10px;
            font-weight: 600;
            color: #00b4d8;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-top: 2px;
        }

        .sidebar-menu {
            padding: 20px 14px;
            flex: 1;
            overflow-y: auto;
        }

        /* Custom Scrollbar Sidebar */
        .sidebar-menu::-webkit-scrollbar {
            width: 5px;
        }
        .sidebar-menu::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.15);
            border-radius: 10px;
        }
        .sidebar-menu::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.3);
        }

        .menu-title {
            font-size: 10px;
            font-weight: 700;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 1.2px;
            margin: 18px 12px 8px;
        }

        .sidebar-menu a {
            display: flex;
            align-items: center;
            padding: 12px 16px;
            margin-bottom: 5px;
            color: #94a3b8;
            text-decoration: none;
            border-radius: 12px;
            font-size: 13.5px;
            font-weight: 600;
            transition: all 0.25s ease;
        }

        .sidebar-menu a i {
            width: 26px;
            font-size: 16px;
            transition: transform 0.2s ease;
        }

        .sidebar-menu a:hover {
            background: rgba(255, 255, 255, 0.06);
            color: #ffffff;
            transform: translateX(3px);
        }

        .sidebar-menu a.active {
            background: var(--active-bg);
            color: var(--active-text);
            box-shadow: 0 6px 20px rgba(0, 180, 216, 0.35);
        }

        .sidebar-footer {
            padding: 16px;
            border-top: 1px solid rgba(255, 255, 255, 0.08);
            background: var(--sidebar-bg);
            flex-shrink: 0;
        }

        .logout-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            width: 100%;
            padding: 12px;
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.2);
            color: #ef4444;
            border-radius: 12px;
            font-size: 13px;
            font-weight: 700;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .logout-btn:hover {
            background: #ef4444;
            color: #ffffff;
            box-shadow: 0 4px 15px rgba(239, 68, 68, 0.3);
        }

        /* MAIN CONTENT & TOPBAR STYLING */
        .main-content {
            margin-left: 260px;
            min-height: 100vh;
            position: relative;
            z-index: 1;
            transition: margin-left 0.3s ease;
        }

        .top-navbar {
            height: 80px;
            background: var(--topbar-bg);
            border-bottom: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 32px;
            position: sticky;
            top: 0;
            z-index: 900;
            backdrop-filter: blur(10px);
        }

        .page-title {
            font-size: 20px;
            font-weight: 800;
            color: var(--text-title);
            margin: 0;
            letter-spacing: -0.3px;
        }

        .page-subtitle {
            font-size: 12px;
            color: var(--text-subtitle);
            margin-top: 2px;
            font-weight: 500;
        }

        .user-area {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .theme-toggle-btn {
            background: var(--hover-bg);
            border: 1px solid var(--border-color);
            color: var(--text-title);
            width: 42px;
            height: 42px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 16px;
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .theme-toggle-btn:hover {
            transform: scale(1.08) rotate(15deg);
            border-color: #00b4d8;
            color: #00b4d8;
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 6px 12px;
            background: var(--hover-bg);
            border: 1px solid var(--border-color);
            border-radius: 30px;
        }

        .user-avatar {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: linear-gradient(135deg, #00b4d8 0%, #0077b6 100%);
            color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            font-size: 14px;
            box-shadow: 0 3px 10px rgba(0, 180, 216, 0.3);
        }

        .user-info {
            line-height: 1.2;
            padding-right: 6px;
        }

        .user-name {
            font-size: 13px;
            font-weight: 700;
            color: var(--text-title);
        }

        .user-role {
            font-size: 11px;
            color: var(--text-subtitle);
            font-weight: 500;
        }

        .content-wrapper {
            padding: 32px;
        }

        .custom-card {
            background: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 20px;
            padding: 24px;
            box-shadow: var(--shadow-sm);
        }

        @media (max-width: 992px) {
            .sidebar { width: 80px; }
            .brand-text, .menu-title, .sidebar-menu a span, .user-info { display: none; }
            .sidebar-brand { justify-content: center; padding: 0; }
            .brand-icon { margin-right: 0; }
            .sidebar-menu { padding: 20px 8px; }
            .sidebar-menu a { justify-content: center; padding: 14px; }
            .sidebar-menu a i { width: auto; font-size: 18px; }
            .logout-btn { padding: 12px; }
            .logout-btn span { display: none; }
            .main-content { margin-left: 80px; }
            .top-navbar { padding: 0 20px; }
            .content-wrapper { padding: 20px; }
        }
    </style>
</head>
<body>

    <!-- Ambient Background Orbs -->
    <div class="bg-orb bg-orb-1"></div>
    <div class="bg-orb bg-orb-2"></div>

    <script>
        // Check and apply theme before rendering to avoid flash
        const savedTheme = localStorage.getItem('theme');
        if (savedTheme) {
            document.documentElement.setAttribute('data-theme', savedTheme);
        } else if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
            document.documentElement.setAttribute('data-theme', 'dark');
        }

        // Script untuk menangani penggantian tema secara dinamis
        document.addEventListener('DOMContentLoaded', function() {
            const themeToggleBtn = document.getElementById('themeToggle');
            const themeIcon = document.getElementById('themeIcon');

            function updateIcon(theme) {
                if (!themeIcon) return;
                if (theme === 'dark') {
                    themeIcon.className = 'fa-solid fa-sun';
                } else {
                    themeIcon.className = 'fa-solid fa-moon';
                }
            }

            // Sync icon dengan tema saat ini
            const currentTheme = document.documentElement.getAttribute('data-theme') || 'light';
            updateIcon(currentTheme);

            if (themeToggleBtn) {
                themeToggleBtn.addEventListener('click', function() {
                    const activeTheme = document.documentElement.getAttribute('data-theme');
                    const newTheme = activeTheme === 'dark' ? 'light' : 'dark';

                    document.documentElement.setAttribute('data-theme', newTheme);
                    localStorage.setItem('theme', newTheme);
                    updateIcon(newTheme);
                });
            }
        });
    </script>