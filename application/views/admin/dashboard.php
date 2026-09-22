<?php $this->load->view('admin/template/header'); ?>
<?php $this->load->view('admin/template/sidebar'); ?>

<div class="main-content">
    <?php $this->load->view('admin/template/navbar'); ?>

    <div class="content-wrapper">

        <!-- HERO WELCOME BANNER -->
        <div class="welcome-banner mb-4">
            <div class="welcome-orb orb-1"></div>
            <div class="welcome-orb orb-2"></div>
            <div class="welcome-grid-pattern"></div>
            
            <div class="row align-items-center position-relative" style="z-index: 2;">
                <div class="col-lg-8 col-md-9">
                    <div class="welcome-badge">
                        <span class="pulse-dot"></span>
                        <i class="fa-solid fa-building-columns"></i> Portal Utama SMAN Tawangmangu
                    </div>
                    <h2 class="welcome-title">
                        Selamat Datang Kembali, <span class="text-highlight"><?= htmlspecialchars($this->session->userdata('nama')); ?></span> 👋
                    </h2>
                    <p class="welcome-sub">
                        Kelola informasi, data akademik, serta publikasi konten portal sekolah secara efisien dan terpadu melalui dashboard ini.
                    </p>
                    <div class="welcome-actions mt-3">
                        <a href="<?= site_url('admin/berita/tambah'); ?>" class="btn btn-welcome-primary">
                            <i class="fa-solid fa-plus me-1"></i> Buat Konten Baru
                        </a>
                        <span class="system-time-badge ms-2 d-none d-sm-inline-flex">
                            <i class="fa-regular fa-clock me-1"></i> <?= date('l, d F Y'); ?>
                        </span>
                    </div>
                </div>
                <div class="col-lg-4 col-md-3 text-end d-none d-md-block position-relative">
                    <div class="hero-illustration-wrapper">
                        <i class="fa-solid fa-graduation-cap welcome-icon"></i>
                        <i class="fa-solid fa-award floating-icon icon-1"></i>
                        <i class="fa-solid fa-book-open floating-icon icon-2"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- STATS CARDS GRID -->
        <div class="row g-3 mb-4">
            <?php 
            $stats = [
                ['label' => 'Guru & Staff', 'num' => $jumlah_guru, 'icon' => 'fa-chalkboard-user', 'class' => 'icon-cyan', 'grow' => 'Aktif'],
                ['label' => 'Berita Sekolah', 'num' => $jumlah_berita, 'icon' => 'fa-newspaper', 'class' => 'icon-blue', 'grow' => 'Publikasi'],
                ['label' => 'Pengumuman', 'num' => $jumlah_pengumuman, 'icon' => 'fa-bullhorn', 'class' => 'icon-purple', 'grow' => 'Info'],
                ['label' => 'Agenda Kegiatan', 'num' => $jumlah_agenda, 'icon' => 'fa-calendar-days', 'class' => 'icon-amber', 'grow' => 'Jadwal'],
                ['label' => 'Prestasi Siswa', 'num' => $jumlah_prestasi, 'icon' => 'fa-trophy', 'class' => 'icon-emerald', 'grow' => 'Capaian'],
                ['label' => 'Ekstrakurikuler', 'num' => $jumlah_ekstrakurikuler, 'icon' => 'fa-people-group', 'class' => 'icon-indigo', 'grow' => 'Klub'],
                ['label' => 'Galeri Foto', 'num' => $jumlah_galeri, 'icon' => 'fa-images', 'class' => 'icon-pink', 'grow' => 'Media'],
                ['label' => 'File Download', 'num' => $jumlah_download, 'icon' => 'fa-cloud-arrow-down', 'class' => 'icon-rose', 'grow' => 'Dokumen']
            ];
            foreach ($stats as $st): 
            ?>
            <div class="col-xl-3 col-lg-4 col-md-6">
                <div class="stat-card">
                    <div class="stat-card-inner">
                        <div class="stat-icon <?= $st['class']; ?>">
                            <i class="fa-solid <?= $st['icon']; ?>"></i>
                        </div>
                        <div class="stat-info">
                            <div class="stat-header">
                                <span class="stat-label"><?= $st['label']; ?></span>
                                <span class="stat-tag"><?= $st['grow']; ?></span>
                            </div>
                            <div class="stat-number"><?= number_format($st['num']); ?></div>
                        </div>
                    </div>
                    <div class="stat-hover-indicator"></div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <!-- MAIN CONTENT SECTION -->
        <div class="row g-4 mb-4">
            <!-- BERITA TERBARU TABLE -->
            <div class="col-xl-7 col-lg-12">
                <div class="dashboard-card h-100">
                    <div class="card-header-custom">
                        <div class="d-flex align-items-center gap-2">
                            <div class="header-icon-box">
                                <i class="fa-solid fa-newspaper text-primary"></i>
                            </div>
                            <div>
                                <h5 class="mb-0">Berita & Artikel Terbaru</h5>
                                <small class="text-subtle">Pantau status publikasi artikel sekolah</small>
                            </div>
                        </div>
                        <a href="<?= site_url('admin/berita'); ?>" class="btn-action-outline">
                            Lihat Semua <i class="fa-solid fa-arrow-right-long ms-1"></i>
                        </a>
                    </div>

                    <div class="table-responsive">
                        <table class="table custom-table align-middle mb-0">
                            <thead>
                                <tr>
                                    <th>Artikel / Judul</th>
                                    <th>Tanggal Publikasi</th>
                                    <th class="text-end">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($berita_terbaru)): ?>
                                    <?php foreach ($berita_terbaru as $item): ?>
                                        <tr>
                                            <td>
                                                <div class="news-item-wrapper">
                                                    <div class="news-avatar-icon">
                                                        <i class="fa-regular fa-file-lines"></i>
                                                    </div>
                                                    <div class="news-title-text" title="<?= htmlspecialchars($item->judul); ?>">
                                                        <?= htmlspecialchars($item->judul); ?>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-nowrap text-subtle fs-12">
                                                <i class="fa-regular fa-clock me-1"></i><?= date('d M Y', strtotime($item->tanggal)); ?>
                                            </td>
                                            <td class="text-end">
                                                <?php if ($item->status == 'publish'): ?>
                                                    <span class="badge-status success"><span class="badge-dot"></span> Publish</span>
                                                <?php else: ?>
                                                    <span class="badge-status warning"><span class="badge-dot"></span> Draft</span>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="3" class="empty-state py-5 text-center">
                                            <i class="fa-regular fa-folder-open d-block fs-2 mb-2 text-subtle opacity-50"></i>
                                            <span class="text-subtle">Belum ada data berita yang dipublikasikan.</span>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- AGENDA TERBARU -->
            <div class="col-xl-5 col-lg-12">
                <div class="dashboard-card h-100">
                    <div class="card-header-custom">
                        <div class="d-flex align-items-center gap-2">
                            <div class="header-icon-box">
                                <i class="fa-solid fa-calendar-day text-warning"></i>
                            </div>
                            <div>
                                <h5 class="mb-0">Agenda Mendatang</h5>
                                <small class="text-subtle">Jadwal kegiatan SMA Negeri Tawangmangu</small>
                            </div>
                        </div>
                        <a href="<?= site_url('admin/agenda'); ?>" class="btn-action-outline">
                            Semua <i class="fa-solid fa-arrow-right-long ms-1"></i>
                        </a>
                    </div>

                    <div class="agenda-list p-3">
                        <?php if (!empty($agenda_terbaru)): ?>
                            <?php foreach ($agenda_terbaru as $item): ?>
                                <div class="agenda-item">
                                    <div class="agenda-date">
                                        <strong class="day-num"><?= date('d', strtotime($item->tanggal)); ?></strong>
                                        <span class="month-name"><?= date('M', strtotime($item->tanggal)); ?></span>
                                    </div>
                                    <div class="agenda-info ms-3 flex-grow-1">
                                        <div class="agenda-title" title="<?= htmlspecialchars($item->judul); ?>">
                                            <?= htmlspecialchars($item->judul); ?>
                                        </div>
                                        <div class="agenda-sub">
                                            <i class="fa-solid fa-location-dot text-danger"></i> 
                                            <span><?= htmlspecialchars($item->lokasi ?: 'Lokasi belum ditentukan'); ?></span>
                                        </div>
                                    </div>
                                    <div class="agenda-arrow">
                                        <i class="fa-solid fa-chevron-right fs-12"></i>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="empty-state py-5 text-center">
                                <i class="fa-regular fa-calendar-xmark d-block fs-2 mb-2 text-subtle opacity-50"></i>
                                <span class="text-subtle">Belum ada agenda mendatang.</span>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- QUICK ACTION MENU -->
        <div class="dashboard-card mb-4">
            <div class="card-header-custom">
                <div class="d-flex align-items-center gap-2">
                    <div class="header-icon-box">
                        <i class="fa-solid fa-bolt text-info"></i>
                    </div>
                    <div>
                        <h5 class="mb-0">Akses Cepat Pintasan</h5>
                        <small class="text-subtle">Pintasan praktis untuk penambahan data</small>
                    </div>
                </div>
            </div>

            <div class="row g-3 p-3">
                <div class="col-xl-3 col-md-6">
                    <a href="<?= site_url('admin/berita/tambah'); ?>" class="quick-menu">
                        <div class="quick-icon icon-blue"><i class="fa-solid fa-plus"></i></div>
                        <div class="quick-text">
                            <strong>Tambah Berita</strong>
                            <span>Tulis artikel baru</span>
                        </div>
                    </a>
                </div>

                <div class="col-xl-3 col-md-6">
                    <a href="<?= site_url('admin/guru/tambah'); ?>" class="quick-menu">
                        <div class="quick-icon icon-cyan"><i class="fa-solid fa-user-plus"></i></div>
                        <div class="quick-text">
                            <strong>Tambah Guru</strong>
                            <span>Data pengajar baru</span>
                        </div>
                    </a>
                </div>

                <div class="col-xl-3 col-md-6">
                    <a href="<?= site_url('admin/agenda/tambah'); ?>" class="quick-menu">
                        <div class="quick-icon icon-amber"><i class="fa-solid fa-calendar-plus"></i></div>
                        <div class="quick-text">
                            <strong>Tambah Agenda</strong>
                            <span>Buat jadwal kegiatan</span>
                        </div>
                    </a>
                </div>

                <div class="col-xl-3 col-md-6">
                    <a href="<?= site_url('admin/pengumuman/tambah'); ?>" class="quick-menu">
                        <div class="quick-icon icon-purple"><i class="fa-solid fa-bullhorn"></i></div>
                        <div class="quick-text">
                            <strong>Pengumuman</strong>
                            <span>Siarkan informasi</span>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <!-- FOOTER -->
        <div class="school-footer d-flex flex-column flex-sm-row justify-content-between align-items-center py-3 border-top border-opacity-10">
            <div>
                &copy; <?= date('Y'); ?> <strong class="text-primary">SMA Negeri Tawangmangu</strong>. All rights reserved.
            </div>
            <div class="fs-12 text-subtle mt-2 mt-sm-0">
                System Version 2.4 • Admin Portal
            </div>
        </div>

    </div>
</div>

<style>
/* -----------------------------------------------------------------
   CSS VARIABLES & GLOBAL THEME CONFIGURATION
----------------------------------------------------------------- */
:root {
    --dash-card-bg: #ffffff;
    --dash-card-subtle: #f8fafc;
    --dash-border: rgba(226, 232, 240, 0.8);
    --dash-title: #0f172a;
    --dash-subtitle: #64748b;
    --dash-table-th: #f8fafc;
    --dash-table-border: #f1f5f9;
    --dash-quick-bg: #f8fafc;
    --dash-shadow: 0 10px 30px -5px rgba(15, 23, 42, 0.04);
    --dash-accent: #00b4d8;
    --dash-hover-bg: #f1f5f9;
}

/* Dark Mode Theme Overrides */
[data-theme="dark"], body.dark-mode {
    --dash-card-bg: #0b1329;
    --dash-card-subtle: #131d38;
    --dash-border: rgba(255, 255, 255, 0.08);
    --dash-title: #f8fafc;
    --dash-subtitle: #94a3b8;
    --dash-table-th: #0f172a;
    --dash-table-border: rgba(255, 255, 255, 0.05);
    --dash-quick-bg: #111a33;
    --dash-shadow: 0 10px 30px -5px rgba(0, 0, 0, 0.5);
    --dash-accent: #38bdf8;
    --dash-hover-bg: #172347;
}

.fs-12 { font-size: 12px; }
.text-subtle { color: var(--dash-subtitle) !important; }

/* Reset Bootstrap Table Override for Dark Mode */
.custom-table {
    --bs-table-bg: transparent;
    --bs-table-color: var(--dash-title);
    background-color: transparent !important;
}

/* -----------------------------------------------------------------
   WELCOME HERO BANNER
----------------------------------------------------------------- */
.welcome-banner {
    position: relative;
    background: linear-gradient(135deg, #0284c7 0%, #0369a1 40%, #0f172a 100%);
    border-radius: 24px;
    padding: 36px 38px;
    color: #ffffff;
    overflow: hidden;
    box-shadow: 0 20px 40px -15px rgba(2, 132, 199, 0.35);
}

.welcome-orb {
    position: absolute;
    border-radius: 50%;
    filter: blur(60px);
    pointer-events: none;
}
.orb-1 {
    width: 250px;
    height: 250px;
    background: rgba(56, 189, 248, 0.25);
    top: -80px;
    right: 15%;
}
.orb-2 {
    width: 180px;
    height: 180px;
    background: rgba(129, 140, 248, 0.2);
    bottom: -60px;
    left: -40px;
}

.welcome-grid-pattern {
    position: absolute;
    inset: 0;
    background-image: radial-gradient(rgba(255, 255, 255, 0.1) 1px, transparent 1px);
    background-size: 20px 20px;
    opacity: 0.6;
}

.welcome-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: rgba(255, 255, 255, 0.12);
    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    padding: 6px 14px;
    border-radius: 30px;
    font-size: 11px;
    font-weight: 700;
    margin-bottom: 14px;
    text-transform: uppercase;
    letter-spacing: 0.6px;
}

.pulse-dot {
    width: 7px;
    height: 7px;
    background-color: #38ef7d;
    border-radius: 50%;
    box-shadow: 0 0 8px #38ef7d;
}

.welcome-title {
    font-size: 26px;
    font-weight: 800;
    margin-bottom: 10px;
    letter-spacing: -0.4px;
    line-height: 1.25;
}

.welcome-title .text-highlight {
    background: linear-gradient(120deg, #ffffff, #bae6fd);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.welcome-sub {
    margin: 0;
    font-size: 14px;
    opacity: 0.9;
    max-width: 620px;
    line-height: 1.6;
    font-weight: 400;
}

.btn-welcome-primary {
    background: #ffffff;
    color: #0369a1;
    font-weight: 700;
    font-size: 13px;
    padding: 10px 20px;
    border-radius: 12px;
    border: none;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
}

.btn-welcome-primary:hover {
    background: #f0f9ff;
    color: #0284c7;
    transform: translateY(-2px);
    box-shadow: 0 12px 24px rgba(0, 0, 0, 0.2);
}

.system-time-badge {
    background: rgba(0, 0, 0, 0.2);
    padding: 9px 16px;
    border-radius: 12px;
    font-size: 12px;
    font-weight: 600;
    backdrop-filter: blur(8px);
    border: 1px solid rgba(255, 255, 255, 0.1);
}

.hero-illustration-wrapper {
    position: relative;
    height: 120px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.welcome-icon {
    font-size: 110px;
    opacity: 0.18;
    transform: rotate(-12deg);
    color: #ffffff;
}

.floating-icon {
    position: absolute;
    color: rgba(255, 255, 255, 0.3);
    animation: floatAnim 4s infinite ease-in-out;
}
.floating-icon.icon-1 { font-size: 28px; top: 10px; right: 20px; animation-delay: 0s; }
.floating-icon.icon-2 { font-size: 22px; bottom: 10px; left: 40px; animation-delay: 2s; }

@keyframes floatAnim {
    0%, 100% { transform: translateY(0px) rotate(0deg); }
    50% { transform: translateY(-10px) rotate(5deg); }
}

/* -----------------------------------------------------------------
   STATISTICS CARDS GRID
----------------------------------------------------------------- */
.stat-card {
    background: var(--dash-card-bg);
    border-radius: 20px;
    border: 1px solid var(--dash-border);
    position: relative;
    overflow: hidden;
    transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
    box-shadow: var(--dash-shadow);
    height: 100%;
}

.stat-card-inner {
    padding: 20px;
    display: flex;
    align-items: center;
    gap: 16px;
    position: relative;
    z-index: 2;
}

.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 16px 32px -10px rgba(0, 0, 0, 0.3);
    border-color: rgba(56, 189, 248, 0.4);
}

.stat-hover-indicator {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 3px;
    background: linear-gradient(90deg, transparent, var(--dash-accent), transparent);
    opacity: 0;
    transition: opacity 0.3s ease;
}

.stat-card:hover .stat-hover-indicator {
    opacity: 1;
}

.stat-icon {
    width: 52px;
    height: 52px;
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    flex-shrink: 0;
    transition: transform 0.3s ease;
}

.stat-card:hover .stat-icon {
    transform: scale(1.08) rotate(4deg);
}

/* Vibrant Icon Themes */
.icon-cyan { background: rgba(6, 182, 212, 0.15); color: #38bdf8; }
.icon-blue { background: rgba(37, 99, 235, 0.15); color: #60a5fa; }
.icon-purple { background: rgba(147, 51, 234, 0.15); color: #c084fc; }
.icon-amber { background: rgba(217, 119, 6, 0.15); color: #fbbf24; }
.icon-emerald { background: rgba(5, 150, 105, 0.15); color: #34d399; }
.icon-indigo { background: rgba(79, 70, 229, 0.15); color: #818cf8; }
.icon-pink { background: rgba(219, 39, 119, 0.15); color: #f472b6; }
.icon-rose { background: rgba(225, 29, 72, 0.15); color: #fb7185; }

.stat-info {
    flex-grow: 1;
    min-width: 0;
}

.stat-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 4px;
}

.stat-label {
    font-size: 12px;
    font-weight: 600;
    color: var(--dash-subtitle);
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.stat-tag {
    font-size: 10px;
    font-weight: 700;
    padding: 2px 6px;
    border-radius: 6px;
    background: var(--dash-card-subtle);
    color: var(--dash-subtitle);
    text-transform: uppercase;
    border: 1px solid var(--dash-border);
}

.stat-number {
    font-size: 24px;
    font-weight: 800;
    color: var(--dash-title);
    letter-spacing: -0.5px;
    line-height: 1;
}

/* -----------------------------------------------------------------
   DASHBOARD CONTENT CARDS
----------------------------------------------------------------- */
.dashboard-card {
    background: var(--dash-card-bg);
    border-radius: 20px;
    border: 1px solid var(--dash-border);
    overflow: hidden;
    box-shadow: var(--dash-shadow);
}

.card-header-custom {
    padding: 20px 24px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-bottom: 1px solid var(--dash-border);
}

.header-icon-box {
    width: 36px;
    height: 36px;
    border-radius: 10px;
    background: var(--dash-card-subtle);
    border: 1px solid var(--dash-border);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 15px;
}

.card-header-custom h5 {
    font-size: 16px;
    font-weight: 700;
    color: var(--dash-title);
    letter-spacing: -0.2px;
}

.btn-action-outline {
    display: inline-flex;
    align-items: center;
    padding: 7px 14px;
    border-radius: 10px;
    font-size: 12px;
    font-weight: 700;
    color: var(--dash-accent);
    border: 1px solid rgba(56, 189, 248, 0.3);
    background: rgba(56, 189, 248, 0.05);
    text-decoration: none;
    transition: all 0.25s ease;
}

.btn-action-outline:hover {
    background: var(--dash-accent);
    color: #ffffff;
    box-shadow: 0 4px 12px rgba(56, 189, 248, 0.3);
    transform: translateY(-1px);
}

/* -----------------------------------------------------------------
   TABLE STYLING
----------------------------------------------------------------- */
.custom-table th {
    background: var(--dash-table-th);
    border-bottom: 1px solid var(--dash-border);
    color: var(--dash-subtitle);
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.6px;
    padding: 14px 24px;
}

.custom-table td {
    padding: 16px 24px;
    font-size: 13px;
    color: var(--dash-title);
    border-bottom: 1px solid var(--dash-table-border);
    background-color: transparent !important;
}

.custom-table tbody tr {
    transition: background-color 0.2s ease;
}

.custom-table tbody tr:hover {
    background-color: var(--dash-hover-bg) !important;
}

.custom-table tbody tr:last-child td {
    border-bottom: none;
}

.news-item-wrapper {
    display: flex;
    align-items: center;
    gap: 12px;
}

.news-avatar-icon {
    width: 32px;
    height: 32px;
    border-radius: 8px;
    background: rgba(56, 189, 248, 0.12);
    color: var(--dash-accent);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 13px;
    flex-shrink: 0;
}

.news-title-text {
    font-weight: 600;
    color: var(--dash-title);
    display: -webkit-box;
    -webkit-line-clamp: 1;
    -webkit-box-orient: vertical;
    overflow: hidden;
    max-width: 340px;
}

/* Badges */
.badge-status {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 5px 12px;
    border-radius: 30px;
    font-size: 11px;
    font-weight: 700;
}

.badge-dot {
    width: 6px;
    height: 6px;
    border-radius: 50%;
}

.badge-status.success {
    background: rgba(16, 185, 129, 0.15);
    color: #34d399;
}
.badge-status.success .badge-dot { background-color: #10b981; }

.badge-status.warning {
    background: rgba(245, 158, 11, 0.15);
    color: #fbbf24;
}
.badge-status.warning .badge-dot { background-color: #f59e0b; }

/* -----------------------------------------------------------------
   AGENDA LIST
----------------------------------------------------------------- */
.agenda-item {
    display: flex;
    align-items: center;
    padding: 14px 16px;
    border-radius: 14px;
    transition: all 0.25s ease;
    border: 1px solid transparent;
}

.agenda-item:hover {
    background: var(--dash-hover-bg);
    border-color: var(--dash-border);
    transform: translateX(3px);
}

.agenda-date {
    width: 50px;
    height: 52px;
    border-radius: 14px;
    background: rgba(56, 189, 248, 0.12);
    border: 1px solid rgba(56, 189, 248, 0.2);
    color: var(--dash-accent);
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.agenda-date .day-num {
    font-size: 18px;
    line-height: 1;
    font-weight: 800;
}

.agenda-date .month-name {
    font-size: 10px;
    text-transform: uppercase;
    font-weight: 700;
    margin-top: 2px;
}

.agenda-title {
    color: var(--dash-title);
    font-size: 13px;
    font-weight: 700;
    margin-bottom: 4px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    max-width: 220px;
}

.agenda-sub {
    color: var(--dash-subtitle);
    font-size: 11px;
    display: flex;
    align-items: center;
    gap: 6px;
}

.agenda-arrow {
    color: var(--dash-subtitle);
    opacity: 0.5;
    transition: transform 0.2s ease, opacity 0.2s ease;
}

.agenda-item:hover .agenda-arrow {
    opacity: 1;
    transform: translateX(3px);
    color: var(--dash-accent);
}

/* -----------------------------------------------------------------
   QUICK MENU BUTTONS
----------------------------------------------------------------- */
.quick-menu {
    display: flex;
    align-items: center;
    gap: 16px;
    text-decoration: none;
    color: var(--dash-title);
    background: var(--dash-quick-bg);
    border: 1px solid var(--dash-border);
    border-radius: 16px;
    padding: 16px 20px;
    transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
}

.quick-menu:hover {
    background: var(--dash-hover-bg);
    border-color: var(--dash-accent);
    transform: translateY(-4px);
    box-shadow: 0 12px 24px -6px rgba(0, 0, 0, 0.2);
}

.quick-icon {
    width: 44px;
    height: 44px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 16px;
    flex-shrink: 0;
    transition: transform 0.3s ease;
}

.quick-menu:hover .quick-icon {
    transform: scale(1.1);
}

.quick-text {
    display: flex;
    flex-direction: column;
}

.quick-text strong {
    font-size: 13px;
    font-weight: 700;
    color: var(--dash-title);
    line-height: 1.2;
}

.quick-text span {
    font-size: 11px;
    color: var(--dash-subtitle);
    margin-top: 2px;
}

/* -----------------------------------------------------------------
   FOOTER
----------------------------------------------------------------- */
.school-footer {
    font-size: 12px;
    color: var(--dash-subtitle);
}
</style>

<?php $this->load->view('admin/template/footer'); ?>