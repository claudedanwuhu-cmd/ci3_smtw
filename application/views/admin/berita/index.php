<?php $this->load->view('admin/template/header'); ?>
<?php $this->load->view('admin/template/sidebar'); ?>

<div class="main-content">
    <?php $this->load->view('admin/template/navbar'); ?>

    <div class="content-wrapper">

        <!-- FLASH SUCCESS MESSAGE -->
        <?php if ($this->session->flashdata('success')): ?>
        <div class="alert alert-custom-success alert-dismissible fade show mb-4 alert-autodismiss" role="alert" data-autodismiss="4500">
            <div class="d-flex align-items-center gap-3">
                <div class="alert-icon-box">
                    <i class="fa-solid fa-circle-check"></i>
                </div>
                <div>
                    <h6 class="alert-heading mb-0">Berhasil</h6>
                    <span class="fs-7"><?= html_escape($this->session->flashdata('success')); ?></span>
                </div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            <div class="alert-progress-track"><div class="alert-progress-bar"></div></div>
        </div>
        <?php endif; ?>

        <!-- FLASH ERROR MESSAGE -->
        <?php if ($this->session->flashdata('error')): ?>
        <div class="alert alert-custom-danger alert-dismissible fade show mb-4 alert-autodismiss" role="alert" data-autodismiss="6000">
            <div class="d-flex align-items-center gap-3">
                <div class="alert-icon-box">
                    <i class="fa-solid fa-circle-exclamation"></i>
                </div>
                <div>
                    <h6 class="alert-heading mb-0">Gagal Memproses Data</h6>
                    <span class="fs-7"><?= html_escape($this->session->flashdata('error')); ?></span>
                </div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            <div class="alert-progress-track"><div class="alert-progress-bar"></div></div>
        </div>
        <?php endif; ?>

        <!-- PAGE HEADER -->
        <div class="page-header-custom mb-4">
            <div class="d-flex align-items-center gap-3">
                <div class="page-header-icon">
                    <i class="fa-solid fa-newspaper"></i>
                </div>
                <div>
                    <span class="badge-header-tag mb-1">
                        <i class="fa-solid fa-layer-group me-1"></i> Manajemen Publikasi
                    </span>
                    <h2 class="page-title">Berita</h2>
                    <p class="page-subtitle">Kelola berita dan publikasi informasi sekolah.</p>
                </div>
            </div>
            <a href="<?= site_url('admin/berita/tambah'); ?>" class="btn-add">
                <i class="fa-solid fa-plus me-2"></i>
                Tambah Berita
            </a>
        </div>

        <!-- TABLE CARD -->
        <div class="custom-card">
            <div class="card-title-custom justify-content-between align-items-center">
                <div class="d-flex align-items-center gap-3">
                    <div class="title-icon">
                        <i class="fa-solid fa-newspaper"></i>
                    </div>
                    <div>
                        <h5>Daftar Berita</h5>
                        <small>Informasi dan publikasi terbaru sekolah</small>
                    </div>
                </div>
                <div class="d-flex align-items-center gap-3 flex-wrap toolbar-right">
                    <div class="table-search-group">
                        <i class="fa-solid fa-magnifying-glass table-search-icon"></i>
                        <input type="text" id="berita-search-input" class="table-search-input" placeholder="Cari judul, kategori...">
                    </div>
                    <div class="total-badge">
                        <i class="fa-solid fa-newspaper me-1"></i>
                        <span id="berita-count"><?= count($berita); ?></span> Data Terdaftar
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table custom-table align-middle mb-0">
                    <thead>
                        <tr>
                            <th width="70" class="text-center">No</th>
                            <th>Judul Berita</th>
                            <th>Kategori</th>
                            <th width="110">Tanggal</th>
                            <th width="100" class="text-center">Status</th>
                            <th width="120" class="text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="berita-table-body">
                        <?php if (!empty($berita)): ?>
                            <?php $no = 1; ?>
                            <?php foreach ($berita as $item): ?>
                                <tr class="berita-row" data-search="<?= htmlspecialchars(strtolower($item->judul . ' ' . ($item->kategori ?? ''))); ?>">
                                    <!-- NO -->
                                    <td class="text-center fw-semibold text-subtle"><?= $no++; ?></td>

                                    <!-- JUDUL -->
                                    <td>
                                        <div class="berita-title-wrapper">
                                            <div class="berita-icon">
                                                <i class="fa-solid fa-newspaper"></i>
                                            </div>
                                            <div>
                                                <div class="item-title"><?= html_escape($item->judul); ?></div>
                                                <small class="item-meta">
                                                    <i class="fa-solid fa-eye me-1"></i>
                                                    <?= (int) ($item->views ?? 0); ?> views
                                                </small>
                                            </div>
                                        </div>
                                    </td>

                                    <!-- KATEGORI -->
                                    <td>
                                        <span class="mapel-badge">
                                            <i class="fa-solid fa-tag me-1"></i>
                                            <?= !empty($item->kategori) ? html_escape($item->kategori) : 'Umum'; ?>
                                        </span>
                                    </td>

                                    <!-- TANGGAL -->
                                    <td class="text-subtle">
                                        <div class="date-info">
                                            <i class="fa-regular fa-calendar-days me-1"></i>
                                            <?= !empty($item->tanggal) ? date('d-m-Y', strtotime($item->tanggal)) : '-'; ?>
                                        </div>
                                    </td>

                                    <!-- STATUS -->
                                    <td class="text-center">
                                        <?php if ($item->status === 'publish'): ?>
                                            <span class="status-badge active">
                                                <i class="fa-solid fa-circle-check me-1"></i> Publish
                                            </span>
                                        <?php else: ?>
                                            <span class="status-badge inactive">
                                                <i class="fa-solid fa-clock me-1"></i> Draft
                                            </span>
                                        <?php endif; ?>
                                    </td>

                                    <!-- AKSI -->
                                    <td class="text-end">
                                        <div class="action-buttons justify-content-end">
                                            <a href="<?= site_url('admin/berita/edit/' . $item->id); ?>" class="btn-action edit" title="Edit Berita">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                            <a href="<?= site_url('admin/berita/hapus/' . $item->id); ?>" class="btn-action delete" title="Hapus Berita" onclick="return confirm('Yakin ingin menghapus berita ini?');">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            <tr id="berita-no-result" class="d-none">
                                <td colspan="6" class="empty-data">
                                    <div class="empty-icon">
                                        <i class="fa-solid fa-magnifying-glass"></i>
                                    </div>
                                    <div class="fw-bold fs-6 mb-1 text-title">Tidak ditemukan</div>
                                    <p class="text-subtle fs-7 mb-0">Tidak ada data berita yang cocok dengan pencarian.</p>
                                </td>
                            </tr>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="empty-data">
                                    <div class="empty-icon">
                                        <i class="fa-solid fa-newspaper"></i>
                                    </div>
                                    <div class="fw-bold fs-6 mb-1 text-title">Belum ada berita</div>
                                    <p class="text-subtle fs-7 mb-3">Sistem belum mencatat data publikasi berita.</p>
                                    <a href="<?= site_url('admin/berita/tambah'); ?>" class="btn-add d-inline-flex ms-0">
                                        <i class="fa-solid fa-plus me-2"></i> Tambahkan Berita Sekarang
                                    </a>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

<style>
/* -----------------------------------------------------------------
   BERITA LIST - UNIFIED THEMING
----------------------------------------------------------------- */
:root {
    --berita-bg: #f8fafc;
    --berita-card-bg: #ffffff;
    --berita-card-subtle: #f1f5f9;
    --berita-border: #e2e8f0;
    --berita-title: #0f172a;
    --berita-subtitle: #64748b;
    --berita-hover: #f8fafc;
    --berita-shadow: 0 10px 25px -5px rgba(15, 23, 42, 0.05), 0 8px 10px -6px rgba(15, 23, 42, 0.01);
    --berita-accent: #0ea5e9;
    --berita-accent-glow: rgba(14, 165, 233, 0.25);
    --berita-soft: rgba(14, 165, 233, 0.10);
    --berita-soft-border: rgba(14, 165, 233, 0.22);
    --berita-icon-muted: #94a3b8;
    --berita-success: #059669;
    --berita-danger: #dc2626;
}

/* Multi-selector support untuk dark mode */
[data-bs-theme="dark"],
[data-theme="dark"],
body.dark-mode,
.dark-mode {
    --berita-bg: #070d19;
    --berita-card-bg: #0f172a;
    --berita-card-subtle: #1e293b;
    --berita-border: rgba(255, 255, 255, 0.08);
    --berita-title: #f8fafc;
    --berita-subtitle: #94a3b8;
    --berita-hover: #1e293b;
    --berita-shadow: 0 12px 30px -5px rgba(0, 0, 0, 0.4);
    --berita-accent: #38bdf8;
    --berita-accent-glow: rgba(56, 189, 248, 0.25);
    --berita-soft: rgba(56, 189, 248, 0.10);
    --berita-soft-border: rgba(56, 189, 248, 0.22);
    --berita-icon-muted: #64748b;
    --berita-success: #34d399;
    --berita-danger: #f87171;
}

.text-title { color: var(--berita-title) !important; }
.text-subtle { color: var(--berita-subtitle) !important; }
.fs-7 { font-size: 13px; }

/* ===================== ALERT ===================== */
.alert-custom-success {
    background: rgba(16, 185, 129, 0.12) !important;
    border: 1px solid rgba(16, 185, 129, 0.25) !important;
    color: var(--berita-success) !important;
    border-radius: 16px;
    padding: 16px 20px;
    backdrop-filter: blur(8px);
}

.alert-custom-danger {
    background: rgba(239, 68, 68, 0.12) !important;
    border: 1px solid rgba(239, 68, 68, 0.25) !important;
    color: var(--berita-danger) !important;
    border-radius: 16px;
    padding: 16px 20px;
    backdrop-filter: blur(8px);
}

.alert-heading {
    font-weight: 700;
    font-size: 14px;
    margin-bottom: 0 !important;
}

.alert-icon-box {
    width: 36px;
    height: 36px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
    flex-shrink: 0;
}

.alert-custom-success .alert-icon-box {
    background: rgba(16, 185, 129, 0.2);
}

.alert-custom-danger .alert-icon-box {
    background: rgba(239, 68, 68, 0.2);
}

/* ===================== PAGE HEADER ===================== */
.page-header-custom {
    background: var(--berita-card-bg) !important;
    border: 1px solid var(--berita-border) !important;
    border-radius: 20px;
    padding: 22px 28px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    box-shadow: var(--berita-shadow);
    gap: 20px;
    position: relative;
    overflow: hidden;
}

.page-header-custom::before {
    content: "";
    position: absolute;
    inset: 0 auto 0 0;
    width: 4px;
    background: linear-gradient(180deg, var(--berita-accent), #0369a1);
}

.badge-header-tag {
    display: inline-flex;
    align-items: center;
    background: var(--berita-soft);
    color: var(--berita-accent);
    border: 1px solid var(--berita-soft-border);
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 6px;
}

.page-title {
    color: var(--berita-title) !important;
    font-size: 22px;
    font-weight: 800;
    margin: 0 0 2px;
    letter-spacing: -0.3px;
}

.page-subtitle {
    color: var(--berita-subtitle) !important;
    font-size: 13px;
    margin: 0;
}

.page-header-icon {
    width: 50px;
    height: 50px;
    border-radius: 14px;
    background: var(--berita-soft);
    border: 1px solid var(--berita-soft-border);
    color: var(--berita-accent);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 22px;
    flex-shrink: 0;
    transition: transform 0.35s ease;
}

.page-header-custom:hover .page-header-icon {
    transform: rotate(-6deg) scale(1.06);
}

.btn-add {
    display: inline-flex;
    align-items: center;
    background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%);
    color: #ffffff !important;
    text-decoration: none;
    padding: 10px 20px;
    border-radius: 12px;
    font-size: 13px;
    font-weight: 700;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(2, 132, 199, 0.3);
    cursor: pointer;
    white-space: nowrap;
}

.btn-add:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 22px rgba(2, 132, 199, 0.45);
    color: #ffffff !important;
}

/* ===================== CARD ===================== */
.custom-card {
    background: var(--berita-card-bg) !important;
    border: 1px solid var(--berita-border) !important;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: var(--berita-shadow);
    animation: beritaFadeUp 0.4s ease both;
}

@keyframes beritaFadeUp {
    from {
        opacity: 0;
        transform: translateY(12px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.custom-card:hover {
    border-color: rgba(14, 165, 233, 0.3) !important;
    box-shadow: 0 16px 34px -10px rgba(15, 23, 42, 0.12);
}

.card-title-custom {
    display: flex;
    align-items: center;
    gap: 14px;
    padding: 18px 24px;
    background: var(--berita-card-subtle) !important;
    border-bottom: 1px solid var(--berita-border) !important;
}

.card-title-custom h5 {
    margin: 0 0 2px;
    color: var(--berita-title) !important;
    font-size: 15px;
    font-weight: 700;
}

.card-title-custom small {
    color: var(--berita-subtitle) !important;
    font-size: 12px;
}

.title-icon {
    width: 40px;
    height: 40px;
    background: var(--berita-soft);
    border-radius: 12px;
    color: var(--berita-accent);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 16px;
    flex-shrink: 0;
}

.total-badge {
    display: inline-flex;
    align-items: center;
    color: var(--berita-accent);
    font-size: 12px;
    background: var(--berita-soft);
    border: 1px solid var(--berita-soft-border);
    padding: 6px 14px;
    border-radius: 20px;
    font-weight: 700;
}

/* ===================== TABLE ===================== */
.custom-table {
    --bs-table-bg: transparent !important;
    --bs-table-color: var(--berita-title) !important;
    margin-bottom: 0;
}

.custom-table th {
    background: var(--berita-card-subtle) !important;
    color: var(--berita-subtitle) !important;
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.6px;
    padding: 16px 20px;
    border-bottom: 1px solid var(--berita-border) !important;
}

.custom-table td {
    padding: 16px 20px;
    border-bottom: 1px solid var(--berita-border) !important;
    font-size: 13.5px;
    color: var(--berita-title) !important;
    background: transparent !important;
}

.custom-table tbody tr {
    transition: background-color 0.2s ease;
    animation: beritaRowIn 0.3s ease both;
}

@keyframes beritaRowIn {
    from {
        opacity: 0;
        transform: translateX(-6px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

.custom-table tbody tr:nth-child(1) { animation-delay: 0.02s; }
.custom-table tbody tr:nth-child(2) { animation-delay: 0.05s; }
.custom-table tbody tr:nth-child(3) { animation-delay: 0.08s; }
.custom-table tbody tr:nth-child(4) { animation-delay: 0.11s; }
.custom-table tbody tr:nth-child(5) { animation-delay: 0.14s; }
.custom-table tbody tr:nth-child(n+6) { animation-delay: 0.16s; }

.custom-table tbody tr:hover {
    background-color: var(--berita-hover) !important;
}

.berita-title-wrapper {
    display: flex;
    align-items: center;
    gap: 12px;
}

.berita-icon {
    width: 38px;
    height: 38px;
    min-width: 38px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 10px;
    background: var(--berita-soft);
    color: var(--berita-accent);
    font-size: 16px;
}

.item-title {
    max-width: 320px;
    color: var(--berita-title) !important;
    font-weight: 700;
    font-size: 13.5px;
    line-height: 1.4;
}

.item-meta {
    display: block;
    margin-top: 3px;
    color: var(--berita-subtitle) !important;
    font-size: 11px;
}

.mapel-badge {
    display: inline-flex;
    align-items: center;
    background: var(--berita-soft);
    color: var(--berita-accent);
    border: 1px solid var(--berita-soft-border);
    padding: 4px 10px;
    border-radius: 8px;
    font-size: 12px;
    font-weight: 600;
}

.date-info {
    display: flex;
    align-items: center;
    gap: 6px;
    white-space: nowrap;
}

.date-info i {
    color: var(--berita-accent);
}

.status-badge {
    display: inline-flex;
    align-items: center;
    padding: 5px 12px;
    border-radius: 20px;
    font-size: 11.5px;
    font-weight: 700;
}

.status-badge.active {
    background: rgba(16, 185, 129, 0.15) !important;
    color: var(--berita-success) !important;
    border: 1px solid rgba(16, 185, 129, 0.3) !important;
}

.status-badge.active::before {
    content: "";
    width: 6px;
    height: 6px;
    border-radius: 50%;
    background: var(--berita-success);
    display: inline-block;
    margin-right: 5px;
    animation: beritaPulse 1.8s ease-in-out infinite;
}

@keyframes beritaPulse {
    0%, 100% {
        opacity: 1;
        box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.5);
    }
    50% {
        opacity: 0.7;
        box-shadow: 0 0 0 3px rgba(16, 185, 129, 0);
    }
}

.status-badge.inactive {
    background: rgba(239, 68, 68, 0.15) !important;
    color: var(--berita-danger) !important;
    border: 1px solid rgba(239, 68, 68, 0.3) !important;
}

/* ===================== ACTIONS ===================== */
.action-buttons {
    display: flex;
    gap: 8px;
}

.btn-action {
    width: 36px;
    height: 36px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    font-size: 13px;
    transition: all 0.25s ease;
}

.btn-action.edit {
    background: var(--berita-soft) !important;
    color: var(--berita-accent) !important;
    border: 1px solid var(--berita-soft-border) !important;
}

.btn-action.edit:hover {
    background: var(--berita-accent) !important;
    color: #ffffff !important;
    border-color: var(--berita-accent) !important;
    transform: translateY(-2px);
}

.btn-action.delete {
    background: rgba(239, 68, 68, 0.12) !important;
    color: var(--berita-danger) !important;
    border: 1px solid rgba(239, 68, 68, 0.2) !important;
}

.btn-action.delete:hover {
    background: var(--berita-danger) !important;
    color: #ffffff !important;
    border-color: var(--berita-danger) !important;
    transform: translateY(-2px);
}

/* ===================== EMPTY STATE ===================== */
.empty-data {
    text-align: center;
    padding: 60px 20px !important;
    background: transparent !important;
}

.empty-icon {
    width: 64px;
    height: 64px;
    margin: 0 auto 16px;
    border-radius: 50%;
    background: var(--berita-card-subtle) !important;
    border: 1px solid var(--berita-border) !important;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--berita-icon-muted);
    font-size: 26px;
}

/* ===================== SEARCH ===================== */
.table-search-group {
    position: relative;
    display: flex;
    align-items: center;
}

.table-search-icon {
    position: absolute;
    left: 14px;
    color: var(--berita-subtitle);
    font-size: 13px;
    pointer-events: none;
}

.table-search-input {
    background: var(--berita-card-bg) !important;
    border: 1px solid var(--berita-border) !important;
    border-radius: 10px;
    padding: 8px 14px 8px 36px;
    font-size: 13px;
    color: var(--berita-title) !important;
    min-width: 220px;
    transition: all 0.25s ease;
}

.table-search-input::placeholder {
    color: var(--berita-subtitle);
    opacity: 0.75;
}

.table-search-input:focus {
    outline: none;
    border-color: var(--berita-accent) !important;
    box-shadow: 0 0 0 3px rgba(14, 165, 233, 0.18);
}

/* ===================== FLASH AUTO-DISMISS ===================== */
.alert-autodismiss {
    position: relative;
    overflow: hidden;
    animation: beritaAlertIn 0.35s cubic-bezier(0.34, 1.56, 0.64, 1);
}

@keyframes beritaAlertIn {
    from {
        opacity: 0;
        transform: translateY(-14px) scale(0.98);
    }
    to {
        opacity: 1;
        transform: translateY(0) scale(1);
    }
}

.alert-autodismiss.alert-hiding {
    animation: beritaAlertOut 0.35s ease forwards;
}

@keyframes beritaAlertOut {
    to {
        opacity: 0;
        transform: translateY(-10px) scale(0.98);
        margin-bottom: 0 !important;
        max-height: 0;
        padding-top: 0;
        padding-bottom: 0;
    }
}

.alert-progress-track {
    position: absolute;
    left: 0;
    right: 0;
    bottom: 0;
    height: 3px;
    background: rgba(148, 163, 184, 0.2);
}

.alert-progress-bar {
    height: 100%;
    width: 100%;
    background: #10b981;
    transform-origin: left;
    animation-name: beritaAlertProgress;
    animation-timing-function: linear;
    animation-fill-mode: forwards;
}

.alert-custom-danger .alert-progress-bar {
    background: #ef4444;
}

@keyframes beritaAlertProgress {
    from {
        transform: scaleX(1);
    }
    to {
        transform: scaleX(0);
    }
}

/* ===================== RESPONSIVE ===================== */
@media (max-width: 768px) {
    .page-header-custom {
        flex-direction: column;
        align-items: stretch;
    }

    .btn-add {
        width: 100%;
        justify-content: center;
    }

    .card-title-custom {
        flex-wrap: wrap;
    }

    .toolbar-right {
        width: 100%;
        justify-content: space-between;
        gap: 12px;
    }

    .table-search-group {
        flex: 1;
        min-width: 150px;
    }

    .table-search-input {
        min-width: auto;
    }

    .item-title {
        max-width: 220px;
    }
}

@media (prefers-reduced-motion: reduce) {
    .alert-autodismiss,
    .custom-card,
    .berita-row,
    .page-header-icon,
    .status-badge.active::before,
    .alert-progress-bar {
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
            alertEl.classList.add('alert-hiding');
            setTimeout(function () {
                if (alertEl.parentNode) alertEl.parentNode.removeChild(alertEl);
            }, 350);
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

    // Pencarian data berita secara client-side
    var searchInput = document.getElementById('berita-search-input');
    var tbody = document.getElementById('berita-table-body');
    var countEl = document.getElementById('berita-count');
    var noResultRow = document.getElementById('berita-no-result');

    if (searchInput && tbody) {
        searchInput.addEventListener('input', function () {
            var keyword = searchInput.value.trim().toLowerCase();
            var rows = tbody.querySelectorAll('.berita-row');
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