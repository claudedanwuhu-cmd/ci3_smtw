<?php
$role    = $this->session->userdata('role');
$current = $this->uri->segment(2);

function is_active($current, $segment) {
    return ($current === $segment) ? 'active' : '';
}
?>

<!-- Tombol Hamburger (Mobile/Tablet) -->
<button type="button" class="sidebar-toggle" id="sidebarToggle" aria-label="Buka menu">
    <i class="fa-solid fa-bars"></i>
</button>

<!-- Overlay saat sidebar terbuka di mobile -->
<div class="sidebar-overlay" id="sidebarOverlay"></div>

<aside class="sidebar" id="sidebar">
    <div class="sidebar-wrapper-top" id="sidebarScroll">
        <!-- Brand / Logo Header -->
        <a href="<?= site_url('admin/dashboard'); ?>" class="sidebar-brand">
            <div class="brand-icon">
                <i class="fa-solid fa-school"></i>
            </div>
            <div class="brand-text">
                SMA NEGERI
                <small>Tawangmangu</small>
            </div>
        </a>

        <!-- Navigation Menu -->
        <nav class="sidebar-menu" id="sidebarMenuNav">
            <ul id="sidebarMenu">
                <li class="menu-title">Utama</li>

                <li class="menu-item <?= ($current == 'dashboard' || $current == '') ? 'active' : ''; ?>">
                    <a href="<?= site_url('admin/dashboard'); ?>">
                        <i class="fa-solid fa-gauge-high"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="menu-item <?= is_active($current, 'panduan'); ?>">
                    <a href="<?= site_url('admin/panduan'); ?>">
                        <i class="fa-solid fa-compass"></i>
                        <span>Panduan Web</span>
                        <span class="menu-new-badge">BARU</span>
                    </a>
                </li>

                <li class="menu-title">Sekolah</li>

                <li class="menu-item <?= is_active($current, 'profil'); ?>">
                    <a href="<?= site_url('admin/profil'); ?>">
                        <i class="fa-solid fa-school"></i>
                        <span>Profil Sekolah</span>
                    </a>
                </li>

                <li class="menu-item <?= is_active($current, 'guru'); ?>">
                    <a href="<?= site_url('admin/guru'); ?>">
                        <i class="fa-solid fa-chalkboard-user"></i>
                        <span>Guru & Staff</span>
                    </a>
                </li>

                <li class="menu-item <?= is_active($current, 'prestasi'); ?>">
                    <a href="<?= site_url('admin/prestasi'); ?>">
                        <i class="fa-solid fa-trophy"></i>
                        <span>Prestasi</span>
                    </a>
                </li>

                <li class="menu-item <?= is_active($current, 'ekstrakurikuler'); ?>">
                    <a href="<?= site_url('admin/ekstrakurikuler'); ?>">
                        <i class="fa-solid fa-people-group"></i>
                        <span>Ekstrakurikuler</span>
                    </a>
                </li>

                <li class="menu-item <?= is_active($current, 'fasilitas'); ?>">
                    <a href="<?= site_url('admin/fasilitas'); ?>">
                        <i class="fa-solid fa-building"></i>
                        <span>Fasilitas</span>
                    </a>
                </li>

                <li class="menu-title">Konten</li>

                <li class="menu-item <?= is_active($current, 'berita'); ?>">
                    <a href="<?= site_url('admin/berita'); ?>">
                        <i class="fa-solid fa-newspaper"></i>
                        <span>Berita</span>
                    </a>
                </li>

                <li class="menu-item <?= is_active($current, 'pengumuman'); ?>">
                    <a href="<?= site_url('admin/pengumuman'); ?>">
                        <i class="fa-solid fa-bullhorn"></i>
                        <span>Pengumuman</span>
                    </a>
                </li>

                <li class="menu-item <?= is_active($current, 'agenda'); ?>">
                    <a href="<?= site_url('admin/agenda'); ?>">
                        <i class="fa-solid fa-calendar-days"></i>
                        <span>Agenda</span>
                    </a>
                </li>

                <li class="menu-item <?= is_active($current, 'galeri'); ?>">
                    <a href="<?= site_url('admin/galeri'); ?>">
                        <i class="fa-solid fa-images"></i>
                        <span>Galeri</span>
                    </a>
                </li>

                <li class="menu-item <?= is_active($current, 'carousel'); ?>">
                    <a href="<?= site_url('admin/carousel'); ?>">
                        <i class="fa-solid fa-panorama"></i>
                        <span>Carousel Beranda</span>
                    </a>
                </li>

                <li class="menu-item <?= is_active($current, 'download'); ?>">
                    <a href="<?= site_url('admin/download'); ?>">
                        <i class="fa-solid fa-download"></i>
                        <span>Download</span>
                    </a>
                </li>

                <li class="menu-item <?= is_active($current, 'ppdb'); ?>">
                    <a href="<?= site_url('admin/ppdb'); ?>">
                        <i class="fa-solid fa-file-signature"></i>
                        <span>PPDB</span>
                    </a>
                </li>

                <?php if ($role === 'admin'): ?>
                    <li class="menu-title">Administrasi</li>

                    <li class="menu-item <?= is_active($current, 'user'); ?>">
                        <a href="<?= site_url('admin/user'); ?>">
                            <i class="fa-solid fa-users-gear"></i>
                            <span>User</span>
                        </a>
                    </li>

                    <li class="menu-item <?= is_active($current, 'pengaturan'); ?>">
                        <a href="<?= site_url('admin/pengaturan'); ?>">
                            <i class="fa-solid fa-gear"></i>
                            <span>Pengaturan</span>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
            <!-- Indikator Meluncur Dinamis -->
            <div class="indicator" id="indicator">
                <span class="active-pill-bar"></span>
            </div>
        </nav>
    </div>

    <!-- Sidebar Footer / Logout Button -->
    <div class="sidebar-footer">
        <a href="<?= site_url('admin/auth/logout'); ?>" class="logout-btn">
            <i class="fa-solid fa-right-from-bracket"></i>
            <span>Logout</span>
        </a>
    </div>
</aside>

<style>
/* ============================================= */
/* VARIABLES                                     */
/* ============================================= */
:root {
    --sidebar-bg: #17324d;
    --white-bg: #ffffff; /* Warna putih solid 100% tanpa beda gradasi */
    --accent-color: #00b4d8; /* Warna aksen indikator & ikon menu aktif */
    --text-inactive: #8a96a3;
    --text-active: #17324d;
    --sidebar-width: 260px;
    --item-h: 48px;
    --curve: 20px;
}

* { 
    box-sizing: border-box; 
}

/* ============================================= */
/* CONTAINER SIDEBAR                             */
/* ============================================= */
.sidebar {
    width: var(--sidebar-width);
    height: 100vh;
    background-color: var(--sidebar-bg);
    position: fixed;
    top: 0;
    left: 0;
    z-index: 1000;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    padding-left: 14px;
    transition: transform 0.35s cubic-bezier(0.4, 0, 0.2, 1);
    overflow-x: hidden;
}

.sidebar-wrapper-top {
    display: flex;
    flex-direction: column;

.menu-new-badge {
    width: auto;
    margin-left: auto;
    padding: 3px 6px;
    border-radius: 5px;
    color: #cffafe;
    background: rgba(6, 182, 212, 0.2);
    font-size: 8px;
    font-weight: 800;
    letter-spacing: .5px;
}
    height: calc(100vh - 75px);
    overflow-y: auto;
    overflow-x: hidden;
}

/* Custom Scrollbar */
.sidebar-wrapper-top::-webkit-scrollbar { 
    width: 4px; 
}
.sidebar-wrapper-top::-webkit-scrollbar-thumb {
    background: rgba(255, 255, 255, 0.15);
    border-radius: 4px;
}

/* ============================================= */
/* BRAND / LOGO                                  */
/* ============================================= */
.sidebar-brand {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 20px 14px;
    text-decoration: none;
    color: #ffffff;
    flex-shrink: 0;
}

.brand-icon {
    width: 38px;
    height: 38px;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 16px;
    color: var(--accent-color);
    flex-shrink: 0;
}

.brand-text {
    font-size: 14px;
    font-weight: 700;
    line-height: 1.2;
    display: flex;
    flex-direction: column;
    white-space: nowrap;
}

.brand-text small {
    font-size: 11px;
    font-weight: 400;
    color: var(--text-inactive);
}

/* ============================================= */
/* MENU LIST                                     */
/* ============================================= */
.sidebar-menu {
    position: relative;
    padding-bottom: 10px;
}

.sidebar-menu ul {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
    flex-direction: column;
    gap: 4px;
}

.sidebar-menu .menu-title {
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.8px;
    color: rgba(255, 255, 255, 0.35);
    padding: 14px 16px 6px;
    pointer-events: none;
}

.sidebar-menu li.menu-item {
    position: relative;
    width: 100%;
    height: var(--item-h);
    z-index: 2;
}

.sidebar-menu li.menu-item a {
    display: flex;
    align-items: center;
    gap: 14px;
    height: 100%;
    width: 100%;
    padding: 0 18px;
    color: var(--text-inactive);
    text-decoration: none;
    font-size: 13.5px;
    font-weight: 600;
    white-space: nowrap;
    border-radius: 20px 0 0 20px;
    transition: color 0.3s ease;
}

.sidebar-menu li.menu-item a i {
    font-size: 16px;
    width: 20px;
    text-align: center;
    transition: transform 0.3s ease, color 0.3s ease;
}

.sidebar-menu li.menu-item:hover a i { 
    transform: translateX(4px); 
}

/* Tampilan khusus teks & ikon pada menu aktif */
.sidebar-menu li.menu-item.active a { 
    color: var(--text-active);
    font-weight: 700;
}

.sidebar-menu li.menu-item.active a i {
    color: var(--accent-color); /* Ikon menyala cyan pada halaman aktif */
}

.sidebar-menu li.menu-item a:focus-visible {
    outline: 2px solid var(--accent-color);
    outline-offset: -2px;
}

/* ============================================= */
/* INDIKATOR SWIPE PUTIH SEAMLESS & PEMBEDA      */
/* ============================================= */
#indicator {
    position: absolute;
    left: 0;
    top: 0;
    width: 100%;
    height: var(--item-h);
    background-color: var(--white-bg); /* Putih seragam total */
    border-radius: 24px 0 0 24px;
    z-index: 1;
    opacity: 0;
    pointer-events: none;
    will-change: top;
}

/* Animasi meluncur dinamis */
#indicator.animated {
    transition: top 0.35s cubic-bezier(0.34, 1.25, 0.35, 1), opacity 0.2s ease;
}

/* Dynamic Curved Cutouts (Sudut Melengkung Menyatu Total) */
#indicator::before {
    content: '';
    position: absolute;
    top: calc(var(--curve) * -1);
    right: 0;
    width: var(--curve);
    height: var(--curve);
    background: transparent;
    border-bottom-right-radius: var(--curve);
    box-shadow: 6px 6px 0 6px var(--white-bg);
}

#indicator::after {
    content: '';
    position: absolute;
    bottom: calc(var(--curve) * -1);
    right: 0;
    width: var(--curve);
    height: var(--curve);
    background: transparent;
    border-top-right-radius: var(--curve);
    box-shadow: 6px -6px 0 6px var(--white-bg);
}

/* PEMBEDA VISUAL: Garis Vertical Bar Aktif (Hanya Muncul di Menu Aktif Permanen) */
.active-pill-bar {
    position: absolute;
    left: 6px;
    top: 50%;
    transform: translateY(-50%) scaleY(0);
    width: 4.5px;
    height: 22px;
    background-color: var(--accent-color);
    border-radius: 10px;
    opacity: 0;
    transition: transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1), opacity 0.2s ease;
    box-shadow: 0 0 8px rgba(0, 180, 216, 0.6);
}

/* Aktifkan garis indikator bar ketika halaman aktif */
#indicator.is-permanent .active-pill-bar {
    transform: translateY(-50%) scaleY(1);
    opacity: 1;
}

/* ============================================= */
/* FOOTER LOGOUT                                 */
/* ============================================= */
.sidebar-footer {
    height: 65px;
    padding: 10px 14px;
    display: flex;
    align-items: center;
    flex-shrink: 0;
    background-color: var(--sidebar-bg);
    border-top: 1px solid rgba(255, 255, 255, 0.05);
}

.logout-btn {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    width: 100%;
    padding: 10px 16px;
    color: #ff6b6b;
    background: rgba(255, 107, 107, 0.08);
    border: 1px solid rgba(255, 107, 107, 0.2);
    text-decoration: none;
    font-size: 13.5px;
    font-weight: 600;
    border-radius: 10px;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    white-space: nowrap;
}

.logout-btn i {
    font-size: 15px;
    transition: transform 0.3s ease;
}

.logout-btn:hover {
    background: #ff6b6b;
    color: #ffffff;
    border-color: #ff6b6b;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(255, 107, 107, 0.35);
}

.logout-btn:hover i {
    transform: translateX(3px);
}

.logout-btn:active {
    transform: translateY(0);
    box-shadow: 0 2px 6px rgba(255, 107, 107, 0.2);
}

/* ============================================= */
/* RESPONSIF                                     */
/* ============================================= */
.sidebar-toggle {
    display: none;
    position: fixed;
    top: 14px;
    left: 14px;
    z-index: 1100;
    width: 42px;
    height: 42px;
    border: none;
    border-radius: 10px;
    background: var(--sidebar-bg);
    color: #fff;
    font-size: 18px;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.25);
}

.sidebar-overlay {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(0, 0, 0, 0.45);
    z-index: 999;
    opacity: 0;
    transition: opacity 0.3s ease;
}

@media (max-width: 992px) {
    .sidebar-toggle { display: flex; }

    .sidebar {
        transform: translateX(-100%);
        box-shadow: 0 0 30px rgba(0, 0, 0, 0.3);
    }

    .sidebar.is-open { transform: translateX(0); }

    .sidebar-overlay.is-open {
        display: block;
        opacity: 1;
    }
}

@media (max-width: 420px) {
    :root { --sidebar-width: 240px; }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
    /* ============================================= */
    /* 1) INDIKATOR GESER & KONTROL PEMBEDA ACTIVATION */
    /* ============================================= */
    const menu      = document.getElementById('sidebarMenu');
    const indicator = document.getElementById('indicator');

    if (menu && indicator) {
        const items = Array.from(menu.querySelectorAll('li.menu-item'));
        const realActive = items.find(li => li.classList.contains('active')) || null;

        function positionIndicator(targetLi, isPermanent = false) {
            if (!targetLi) {
                indicator.style.opacity = '0';
                return;
            }

            const top = targetLi.offsetTop;
            indicator.style.top = top + 'px';
            indicator.style.opacity = '1';

            // Menyalakan/mematikan aksen garis vertical bar
            if (isPermanent) {
                indicator.classList.add('is-permanent');
            } else {
                indicator.classList.remove('is-permanent');
            }
        }

        function highlight(targetLi) {
            items.forEach(i => i.classList.remove('active'));
            if (targetLi) targetLi.classList.add('active');

            const isPermanent = (targetLi === realActive);
            positionIndicator(targetLi, isPermanent);
        }

        // Posisi langsung tanpa animasi dari atas saat page dimuat pertama kali
        positionIndicator(realActive, true);

        // Aktifkan animasi meluncur smooth setelah posisi awal terkunci
        requestAnimationFrame(() => {
            setTimeout(() => {
                indicator.classList.add('animated');
            }, 50);
        });

        // Hover & Focus handler
        items.forEach(li => {
            const link = li.querySelector('a');

            li.addEventListener('mouseenter', () => highlight(li));
            if (link) link.addEventListener('focus', () => highlight(li));
        });

        // Kursor keluar dari menu -> kembalikan ke menu aktif permanen
        menu.addEventListener('mouseleave', () => highlight(realActive));

        // Penyesuaian saat resize layar
        window.addEventListener('resize', () => {
            const currentActive = items.find(li => li.classList.contains('active')) || realActive;
            positionIndicator(currentActive, currentActive === realActive);
        });
    }

    /* ============================================= */
    /* 2) TOGGLE SIDEBAR MOBILE                      */
    /* ============================================= */
    const sidebar   = document.getElementById('sidebar');
    const toggleBtn = document.getElementById('sidebarToggle');
    const overlay   = document.getElementById('sidebarOverlay');

    function openSidebar() {
        sidebar.classList.add('is-open');
        overlay.classList.add('is-open');
        document.body.style.overflow = 'hidden';
    }

    function closeSidebar() {
        sidebar.classList.remove('is-open');
        overlay.classList.remove('is-open');
        document.body.style.overflow = '';
    }

    if (toggleBtn && overlay && sidebar) {
        toggleBtn.addEventListener('click', () => {
            sidebar.classList.contains('is-open') ? closeSidebar() : openSidebar();
        });
        overlay.addEventListener('click', closeSidebar);

        document.querySelectorAll('.sidebar-menu a').forEach(a => {
            a.addEventListener('click', () => {
                if (window.innerWidth <= 992) closeSidebar();
            });
        });

        window.addEventListener('resize', () => {
            if (window.innerWidth > 992) closeSidebar();
        });
    }
});
</script>