<?php $this->load->view('admin/template/header'); ?>
<?php $this->load->view('admin/template/sidebar'); ?>

<div class="main-content">
    <?php $this->load->view('admin/template/navbar'); ?>

    <div class="content-wrapper">

        <!-- FLASH MESSAGE -->
        <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-autodismiss is-success mb-4" role="alert" data-autodismiss="4500">
                <div class="alert-icon-box"><i class="fa-solid fa-circle-check"></i></div>
                <div class="alert-content">
                    <strong>Berhasil</strong>
                    <span><?= html_escape($this->session->flashdata('success')); ?></span>
                </div>
                <button type="button" class="btn-close" aria-label="Tutup notifikasi"></button>
                <div class="alert-progress-track"><div class="alert-progress-bar"></div></div>
            </div>
        <?php endif; ?>

        <?php if ($this->session->flashdata('error')): ?>
            <div class="alert alert-autodismiss is-error mb-4" role="alert" data-autodismiss="6000">
                <div class="alert-icon-box"><i class="fa-solid fa-circle-exclamation"></i></div>
                <div class="alert-content">
                    <strong>Gagal memproses data</strong>
                    <span><?= html_escape($this->session->flashdata('error')); ?></span>
                </div>
                <button type="button" class="btn-close" aria-label="Tutup notifikasi"></button>
                <div class="alert-progress-track"><div class="alert-progress-bar"></div></div>
            </div>
        <?php endif; ?>

        <!-- PAGE HEADER -->
        <div class="page-header-custom mb-4">
            <div class="page-header-left">
                <div class="page-header-icon">
                    <i class="fa-solid fa-images"></i>
                </div>
                <div>
                    <span class="badge-header-tag">
                        <i class="fa-solid fa-layer-group me-1"></i> Tampilan Beranda
                    </span>
                    <h2 class="page-title">Carousel Beranda</h2>
                    <p class="page-subtitle">Kelola banner utama yang tampil pada halaman depan sekolah.</p>
                </div>
            </div>
            <a href="<?= site_url('admin/carousel/tambah'); ?>" class="btn-add">
                <i class="fa-solid fa-plus me-2"></i>
                Tambah Carousel
            </a>
        </div>

        <!-- LIST CARD -->
        <div class="custom-card">
            <div class="card-title-custom justify-content-between align-items-center flex-wrap gap-3">
                <div class="card-title-left">
                    <div class="title-icon">
                        <i class="fa-solid fa-layer-group"></i>
                    </div>
                    <div>
                        <h5>Daftar Carousel</h5>
                        <small>Banner halaman depan sekolah</small>
                    </div>
                </div>
                <div class="d-flex align-items-center gap-3 flex-wrap toolbar-right">
                    <div class="table-search-group">
                        <i class="fa-solid fa-magnifying-glass table-search-icon"></i>
                        <input type="text" id="carousel-search-input" class="table-search-input" placeholder="Cari judul, deskripsi...">
                    </div>
                    <div class="total-badge">
                        <i class="fa-solid fa-images me-1"></i>
                        <span id="carousel-count"><?= count($carousel); ?></span> Data
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table custom-table align-middle mb-0">
                    <thead>
                        <tr>
                            <th width="60" class="text-center">No</th>
                            <th width="180">Gambar</th>
                            <th>Konten</th>
                            <th width="90" class="text-center">Urutan</th>
                            <th width="130" class="text-center">Status</th>
                            <th width="110" class="text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="carousel-table-body">
                        <?php if (!empty($carousel)): ?>
                            <?php $no = 1; ?>
                            <?php foreach ($carousel as $item): ?>
                                <tr class="carousel-row" style="--i:<?= min($no, 8); ?>" data-search="<?= html_escape(strtolower($item->judul . ' ' . ($item->deskripsi ?? ''))); ?>">
                                    <!-- NO -->
                                    <td class="text-center fw-semibold text-subtle"><?= $no++; ?></td>

                                    <!-- GAMBAR -->
                                    <td>
                                        <div class="carousel-list-image">
                                            <?php if (!empty($item->gambar)): ?>
                                                <img src="<?= base_url('assets/img/' . ltrim($item->gambar, '/')); ?>" alt="<?= html_escape($item->judul); ?>">
                                            <?php else: ?>
                                                <div class="carousel-list-image-placeholder">
                                                    <i class="fa-solid fa-image"></i>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </td>

                                    <!-- KONTEN -->
                                    <td>
                                        <div class="item-title"><?= html_escape($item->judul); ?></div>
                                        <?php if (!empty($item->deskripsi)): ?>
                                            <small class="item-description"><?= html_escape($item->deskripsi); ?></small>
                                        <?php else: ?>
                                            <small class="item-description">Tidak ada deskripsi</small>
                                        <?php endif; ?>
                                        <?php if (!empty($item->tombol)): ?>
                                            <div class="carousel-button-info">
                                                <i class="fa-solid fa-hand-pointer"></i>
                                                <?= html_escape($item->tombol); ?>
                                            </div>
                                        <?php endif; ?>
                                    </td>

                                    <!-- URUTAN -->
                                    <td class="text-center">
                                        <span class="order-badge"><?= (int) $item->urutan; ?></span>
                                    </td>

                                    <!-- STATUS -->
                                    <td class="text-center">
                                        <?php if ($item->status === 'aktif'): ?>
                                            <span class="status-badge active"><span class="status-dot"></span> Aktif</span>
                                        <?php else: ?>
                                            <span class="status-badge inactive"><span class="status-dot"></span> Nonaktif</span>
                                        <?php endif; ?>
                                    </td>

                                    <!-- AKSI -->
                                    <td class="text-end">
                                        <div class="action-buttons justify-content-end">
                                            <a href="<?= site_url('admin/carousel/edit/' . $item->id); ?>" class="btn-action edit" title="Edit Carousel" aria-label="Edit carousel <?= html_escape($item->judul); ?>">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                            <a href="<?= site_url('admin/carousel/hapus/' . $item->id); ?>" class="btn-action delete" title="Hapus Carousel" aria-label="Hapus carousel <?= html_escape($item->judul); ?>" onclick="return confirm('Yakin ingin menghapus carousel ini?');">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="empty-data">
                                    <div class="empty-icon"><i class="fa-solid fa-images"></i></div>
                                    <strong>Belum ada carousel</strong>
                                    <small>Tambahkan gambar pertama untuk halaman depan sekolah.</small>
                                    <a href="<?= site_url('admin/carousel/tambah'); ?>" class="btn-add mt-3">
                                        <i class="fa-solid fa-plus me-2"></i> Tambah Carousel
                                    </a>
                                </td>
                            </tr>
                        <?php endif; ?>
                        <tr id="carousel-no-result" class="d-none">
                            <td colspan="6" class="empty-data">
                                <div class="empty-icon"><i class="fa-solid fa-magnifying-glass"></i></div>
                                <strong>Tidak ditemukan</strong>
                                <small>Coba kata kunci pencarian lain.</small>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

<style>
/* ================================
   CAROUSEL - DESIGN TOKENS
================================ */
:root {
    --carousel-card: #ffffff;        --carousel-subtle: #f8fafc;
    --carousel-input-bg: #f8fafc;    --carousel-input-focus: #ffffff;
    --carousel-input-border: #cbd5e1;
    --carousel-border: rgba(226, 232, 240, .8);
    --carousel-title: #0f172a;       --carousel-subtitle: #64748b;
    --carousel-hover: #f1f5f9;
    --carousel-accent: #0ea5e9;      --carousel-glow: rgba(14, 165, 233, .25);
    --carousel-soft: rgba(14, 165, 233, .10); --carousel-soft-border: rgba(14, 165, 233, .22);
    --carousel-icon-muted: #94a3b8;
    --carousel-success: #059669;     --carousel-danger: #dc2626;
    --carousel-shadow: 0 10px 25px -5px rgba(15, 23, 42, .05), 0 8px 10px -6px rgba(15, 23, 42, .02);
}
html[data-theme="dark"], [data-bs-theme="dark"], [data-theme="dark"], body.dark-mode, .dark-mode {
    --carousel-card: #0f172a;        --carousel-subtle: #1e293b;
    --carousel-input-bg: #1e293b;    --carousel-input-focus: #111827;
    --carousel-input-border: rgba(255, 255, 255, .12);
    --carousel-border: rgba(255, 255, 255, .08);
    --carousel-title: #f8fafc;       --carousel-subtitle: #94a3b8;
    --carousel-hover: #1e293b;
    --carousel-accent: #38bdf8;      --carousel-glow: rgba(56, 189, 248, .25);
    --carousel-soft: rgba(56, 189, 248, .10); --carousel-soft-border: rgba(56, 189, 248, .22);
    --carousel-icon-muted: #64748b;
    --carousel-success: #34d399;     --carousel-danger: #f87171;
    --carousel-shadow: 0 12px 30px -5px rgba(0, 0, 0, .4);
}

/* PAGE HEADER */
.page-header-custom {
    position: relative;
    overflow: hidden;
    background: var(--carousel-card);
    border: 1px solid var(--carousel-border);
    border-radius: 20px;
    padding: 22px 28px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 20px;
    box-shadow: var(--carousel-shadow);
}
.page-header-custom::before {
    content: "";
    position: absolute; inset: 0 auto 0 0;
    width: 4px;
    background: linear-gradient(180deg, var(--carousel-accent), #0369a1);
}

.page-header-left { position: relative; z-index: 1; display: flex; align-items: center; gap: 16px; }
.page-header-icon {
    width: 52px; height: 52px; border-radius: 16px;
    display: flex; align-items: center; justify-content: center;
    background: var(--carousel-soft);
    border: 1px solid var(--carousel-soft-border);
    color: var(--carousel-accent);
    font-size: 22px; flex-shrink: 0;
    transition: transform .35s ease;
}
.page-header-custom:hover .page-header-icon { transform: rotate(-6deg) scale(1.06); }

.badge-header-tag {
    display: inline-flex; align-items: center;
    padding: 4px 10px; margin-bottom: 5px;
    border-radius: 999px;
    background: var(--carousel-soft);
    color: var(--carousel-accent);
    font-size: 10.5px; font-weight: 800; letter-spacing: .5px; text-transform: uppercase;
}
.page-title { color: var(--carousel-title); font-size: 22px; font-weight: 800; letter-spacing: -.3px; margin: 0; }
.page-subtitle { color: var(--carousel-subtitle); font-size: 13px; margin: 5px 0 0; }

.btn-add {
    position: relative; z-index: 1;
    display: inline-flex; align-items: center; justify-content: center;
    min-height: 42px; padding: 0 20px; border-radius: 12px;
    background: linear-gradient(135deg, #0284c7, #0369a1);
    color: #fff; text-decoration: none;
    font-size: 12.5px; font-weight: 700; border: 0;
    box-shadow: 0 6px 18px rgba(2, 132, 199, .28);
    transition: .2s ease;
}
.btn-add:hover { color: #fff; transform: translateY(-2px); box-shadow: 0 10px 24px rgba(2, 132, 199, .45); }
.btn-add:focus-visible { outline: 2px solid var(--carousel-accent); outline-offset: 2px; }

/* CARD */
.custom-card {
    background: var(--carousel-card);
    border: 1px solid var(--carousel-border);
    border-radius: 20px;
    overflow: hidden;
    box-shadow: var(--carousel-shadow);
    animation: carouselFadeUp .4s ease both;
    transition: box-shadow .3s ease, border-color .3s ease;
}
@keyframes carouselFadeUp {
    from { opacity: 0; transform: translateY(12px); }
    to { opacity: 1; transform: translateY(0); }
}

.card-title-custom {
    display: flex; align-items: center; gap: 14px;
    padding: 18px 24px;
    background: var(--carousel-subtle);
    border-bottom: 1px solid var(--carousel-border);
}
.card-title-left { display: flex; align-items: center; gap: 14px; }
.title-icon {
    width: 42px; height: 42px; border-radius: 12px;
    display: flex; align-items: center; justify-content: center;
    background: var(--carousel-soft);
    border: 1px solid var(--carousel-soft-border);
    color: var(--carousel-accent);
    flex-shrink: 0;
}
.card-title-custom h5 { color: var(--carousel-title); font-size: 15px; font-weight: 800; margin: 0; }
.card-title-custom small { display: block; color: var(--carousel-subtitle); font-size: 12px; margin-top: 3px; }

.total-badge {
    display: inline-flex; align-items: center;
    padding: 6px 12px; border-radius: 999px;
    background: var(--carousel-soft);
    color: var(--carousel-accent);
    font-size: 11.5px; font-weight: 800;
}

/* SEARCH */
.table-search-group { position: relative; display: flex; align-items: center; }
.table-search-icon { position: absolute; left: 14px; color: var(--carousel-subtitle); font-size: 13px; pointer-events: none; }
.table-search-input {
    background: var(--carousel-input-bg);
    border: 1px solid var(--carousel-input-border);
    border-radius: 10px;
    padding: 8px 14px 8px 36px;
    font-size: 13px;
    color: var(--carousel-title);
    min-width: 220px;
    transition: .2s ease;
}
.table-search-input::placeholder { color: var(--carousel-subtitle); opacity: .75; }
.table-search-input:focus {
    outline: none;
    border-color: var(--carousel-accent);
    box-shadow: 0 0 0 3px var(--carousel-glow);
    background: var(--carousel-input-focus);
}

/* TABLE */
.custom-table {
    --bs-table-bg: var(--carousel-card);
    --bs-table-color: var(--carousel-title);
    --bs-table-border-color: var(--carousel-border);
    --bs-table-hover-bg: var(--carousel-hover);
    --bs-table-hover-color: var(--carousel-title);
    color: var(--carousel-title);
    background-color: var(--carousel-card);
    margin: 0;
}
.custom-table > :not(caption) > * > * {
    background-color: var(--carousel-card);
    color: var(--carousel-title);
    box-shadow: inset 0 -1px 0 var(--carousel-border);
}
.custom-table thead th {
    background: var(--carousel-subtle);
    color: var(--carousel-subtitle);
    border-bottom: 1px solid var(--carousel-border);
    padding: 13px 18px;
    font-size: 10.5px; font-weight: 800; text-transform: uppercase; letter-spacing: .4px;
    white-space: nowrap;
}
.custom-table tbody td { padding: 14px 18px; border-bottom: 1px solid var(--carousel-border); color: var(--carousel-title); font-size: 13px; vertical-align: middle; }
.custom-table tbody tr { transition: .15s ease; }
.custom-table tbody tr:hover { background: var(--carousel-hover); }
.custom-table tbody tr:hover > * { background-color: var(--carousel-hover); color: var(--carousel-title); }
.custom-table tbody tr:last-child td { border-bottom: 0; }

html[data-theme="dark"] .card-title-custom,
html[data-theme="dark"] .custom-table thead th,
html[data-theme="dark"] .custom-table tbody td,
html[data-theme="dark"] .custom-table tbody tr,
html[data-theme="dark"] .custom-table,
body.dark-mode .card-title-custom,
body.dark-mode .custom-table thead th,
body.dark-mode .custom-table tbody td,
body.dark-mode .custom-table tbody tr,
body.dark-mode .custom-table {
    background-color: var(--carousel-card);
    color: var(--carousel-title);
}

html[data-theme="dark"] .custom-table thead th,
body.dark-mode .custom-table thead th {
    background-color: var(--carousel-subtle);
    color: var(--carousel-subtitle);
}

.carousel-row { animation: carouselRowIn .3s ease both; animation-delay: calc(var(--i, 1) * .05s); }
@keyframes carouselRowIn {
    from { opacity: 0; transform: translateX(-6px); }
    to { opacity: 1; transform: translateX(0); }
}

.carousel-list-image { width: 150px; height: 82px; overflow: hidden; border-radius: 11px; border: 1px solid var(--carousel-border); background: var(--carousel-subtle); display: flex; align-items: center; justify-content: center; }
.carousel-list-image img { width: 100%; height: 100%; object-fit: cover; display: block; transition: .25s ease; }
.carousel-list-image-placeholder { color: var(--carousel-icon-muted); font-size: 20px; }
.custom-table tbody tr:hover .carousel-list-image img { transform: scale(1.03); }

.item-title { color: var(--carousel-title); font-size: 13.5px; font-weight: 700; margin-bottom: 4px; }
.item-description { display: block; max-width: 430px; color: var(--carousel-subtitle); font-size: 11.5px; line-height: 1.5; }
.carousel-button-info {
    display: inline-flex; align-items: center; gap: 5px;
    margin-top: 7px; padding: 4px 8px; border-radius: 7px;
    background: var(--carousel-soft); color: var(--carousel-accent);
    font-size: 10.5px; font-weight: 700;
}

.order-badge {
    display: inline-flex; align-items: center; justify-content: center;
    min-width: 30px; height: 28px; padding: 0 8px; border-radius: 8px;
    background: var(--carousel-subtle); border: 1px solid var(--carousel-border);
    color: var(--carousel-title); font-size: 12px; font-weight: 700;
}

/* STATUS BADGE (satu indikator: titik) */
.status-badge { display: inline-flex; align-items: center; gap: 6px; padding: 6px 10px; border-radius: 999px; font-size: 11px; font-weight: 700; }
.status-badge.active { color: var(--carousel-success); background: rgba(5, 150, 105, .12); }
.status-badge.inactive { color: var(--carousel-danger); background: rgba(220, 38, 38, .12); }
.status-dot { width: 6px; height: 6px; border-radius: 50%; background: currentColor; display: inline-block; }
.status-badge.active .status-dot { animation: carouselPulse 1.8s ease-in-out infinite; }
@keyframes carouselPulse {
    0%, 100% { opacity: 1; box-shadow: 0 0 0 0 rgba(5, 150, 105, .5); }
    50% { opacity: .7; box-shadow: 0 0 0 3px rgba(5, 150, 105, 0); }
}

/* ACTION BUTTONS */
.action-buttons { display: flex; align-items: center; gap: 7px; }
.btn-action {
    width: 36px; height: 36px; border-radius: 10px;
    display: inline-flex; align-items: center; justify-content: center;
    text-decoration: none; transition: .2s ease;
}
.btn-action.edit { color: var(--carousel-accent); background: var(--carousel-soft); }
.btn-action.edit:hover { color: #fff; background: var(--carousel-accent); transform: translateY(-2px); }
.btn-action.delete { color: #dc2626; background: rgba(239, 68, 68, .10); }
.btn-action.delete:hover { color: #fff; background: #ef4444; transform: translateY(-2px); }
.btn-action:focus-visible { outline: 2px solid var(--carousel-accent); outline-offset: 2px; }

/* EMPTY STATE */
.empty-data { padding: 60px 20px !important; text-align: center; color: var(--carousel-subtitle) !important; }
.empty-icon {
    width: 64px; height: 64px; margin: 0 auto 14px; border-radius: 18px;
    display: flex; align-items: center; justify-content: center;
    background: var(--carousel-soft); color: var(--carousel-accent); font-size: 24px;
}
.empty-data strong { display: block; color: var(--carousel-title); font-size: 14px; }
.empty-data small { display: block; margin-top: 4px; color: var(--carousel-subtitle); font-size: 12px; }
.empty-data .btn-add { display: inline-flex; }

@media (max-width: 768px) {
    .page-header-custom { align-items: stretch; flex-direction: column; padding: 20px; }
    .page-header-left { align-items: flex-start; }
    .btn-add { width: 100%; }
    .toolbar-right { width: 100%; }
    .table-search-group { flex: 1; }
    .table-search-input { min-width: 0; width: 100%; }
    .carousel-list-image { width: 120px; height: 68px; }
    .custom-table thead th, .custom-table tbody td { padding: 12px; }
}

/* ALERT AUTODISMISS */
.alert.alert-autodismiss {
    position: relative; overflow: hidden;
    display: flex; align-items: flex-start; gap: 12px;
    padding: 14px 44px 14px 16px;
    border-radius: 14px; border: 1px solid transparent;
    animation: carouselAlertIn .45s cubic-bezier(.34, 1.56, .64, 1) both;
}
.alert-autodismiss.alert-hiding {
    opacity: 0; transform: translateY(-8px); max-height: 0;
    padding-top: 0; padding-bottom: 0; margin-bottom: 0 !important; overflow: hidden;
    transition: opacity .35s ease, transform .35s ease, max-height .35s ease, padding .35s ease, margin .35s ease;
}
@keyframes carouselAlertIn {
    from { opacity: 0; transform: translateY(-14px) scale(.98); }
    to { opacity: 1; transform: translateY(0) scale(1); }
}
.alert-autodismiss.is-success { background: rgba(16, 185, 129, .12); border-color: rgba(16, 185, 129, .25); }
.alert-autodismiss.is-error { background: rgba(239, 68, 68, .12); border-color: rgba(239, 68, 68, .25); }
.alert-icon-box { width: 36px; height: 36px; border-radius: 10px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; font-size: 15px; }
.is-success .alert-icon-box { background: rgba(16, 185, 129, .18); color: var(--carousel-success); }
.is-error .alert-icon-box { background: rgba(239, 68, 68, .18); color: var(--carousel-danger); }
.alert-content { display: flex; flex-direction: column; gap: 2px; }
.alert-content strong { font-size: 13px; color: var(--carousel-title); }
.alert-content span { font-size: 12.5px; color: var(--carousel-subtitle); }
.alert-autodismiss .btn-close { position: absolute; top: 12px; right: 14px; width: 22px; height: 22px; background-size: 12px; opacity: .5; }
.alert-autodismiss .btn-close:hover { opacity: .9; }
.alert-progress-track { position: absolute; left: 0; bottom: 0; width: 100%; height: 3px; background: rgba(148, 163, 184, .2); }
.alert-progress-bar { height: 100%; width: 100%; transform-origin: left; animation: carouselProgress linear forwards; }
.is-success .alert-progress-bar { background: var(--carousel-success); }
.is-error .alert-progress-bar { background: var(--carousel-danger); }
@keyframes carouselProgress {
    from { transform: scaleX(1); }
    to { transform: scaleX(0); }
}

@media (prefers-reduced-motion: reduce) {
    .alert-autodismiss, .custom-card, .carousel-row, .page-header-icon,
    .carousel-list-image img, .status-badge.active .status-dot,
    .btn-add, .btn-action {
        animation: none !important;
        transition: none !important;
    }
}
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Auto-dismiss notifikasi flash message
        document.querySelectorAll('.alert-autodismiss').forEach(function (alertEl) {
            var duration = parseInt(alertEl.getAttribute('data-autodismiss'), 10) || 4500;
            var bar = alertEl.querySelector('.alert-progress-bar');
            if (bar) bar.style.animationDuration = duration + 'ms';

            var dismissed = false;
            function closeAlert() {
                if (dismissed) return;
                dismissed = true;
                alertEl.style.maxHeight = alertEl.scrollHeight + 'px';
                requestAnimationFrame(function () {
                    alertEl.classList.add('alert-hiding');
                });
                setTimeout(function () {
                    if (alertEl.parentNode) alertEl.parentNode.removeChild(alertEl);
                }, 380);
            }

            var remaining = duration;
            var startedAt = Date.now();
            var timer = setTimeout(closeAlert, remaining);

            alertEl.addEventListener('mouseenter', function () {
                clearTimeout(timer);
                remaining -= (Date.now() - startedAt);
                if (bar) bar.style.animationPlayState = 'paused';
            });
            alertEl.addEventListener('mouseleave', function () {
                if (bar) bar.style.animationPlayState = 'running';
                startedAt = Date.now();
                timer = setTimeout(closeAlert, Math.max(remaining, 800));
            });

            var closeBtn = alertEl.querySelector('.btn-close');
            if (closeBtn) {
                closeBtn.addEventListener('click', function (e) {
                    e.preventDefault();
                    clearTimeout(timer);
                    closeAlert();
                });
            }
        });

        // Pencarian carousel secara langsung (client-side)
        var searchInput = document.getElementById('carousel-search-input');
        var tbody = document.getElementById('carousel-table-body');
        var countEl = document.getElementById('carousel-count');
        var noResultRow = document.getElementById('carousel-no-result');

        if (searchInput && tbody) {
            searchInput.addEventListener('input', function () {
                var keyword = searchInput.value.trim().toLowerCase();
                var rows = tbody.querySelectorAll('.carousel-row');
                var visibleCount = 0;

                rows.forEach(function (row) {
                    var match = row.getAttribute('data-search').indexOf(keyword) !== -1;
                    row.classList.toggle('d-none', !match);
                    if (match) visibleCount++;
                });

                if (countEl) countEl.textContent = visibleCount;
                if (noResultRow) noResultRow.classList.toggle('d-none', visibleCount !== 0 || rows.length === 0);
            });
        }
    });
</script>

<?php $this->load->view('admin/template/footer'); ?>