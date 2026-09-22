<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$this->load->view('admin/template/header');
$this->load->view('admin/template/sidebar');

/**
 * Helper lokal: bentuk URL foto prestasi (dipakai juga di edit.php dengan logika yang sama).
 * - URL penuh (http/https)  -> dipakai apa adanya
 * - berisi folder ("a/b.jpg") -> relatif terhadap base_url()
 * - nama file saja           -> uploads/prestasi/<nama file>
 */
if (!function_exists('prestasi_foto_url')) {
    function prestasi_foto_url($foto)
    {
        $foto = trim((string) $foto);
        if ($foto === '') {
            return '';
        }
        if (preg_match('#^https?://#i', $foto)) {
            return $foto;
        }
        $foto = str_replace('\\', '/', ltrim($foto, '/'));
        if (strpos($foto, '/') !== false) {
            return base_url($foto);
        }
        return base_url('uploads/prestasi/' . rawurlencode($foto));
    }
}
?>

<div class="main-content">
    <?php $this->load->view('admin/template/navbar'); ?>

    <div class="content-wrapper">

        <!-- FLASH MESSAGE -->
        <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-custom-success alert-dismissible fade show mb-4 alert-autodismiss" role="status" data-autodismiss="4500">
                <div class="d-flex align-items-center gap-2">
                    <i class="fa-solid fa-circle-check fs-5"></i>
                    <span><?= html_escape($this->session->flashdata('success')); ?></span>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
                <div class="alert-progress-track"><div class="alert-progress-bar"></div></div>
            </div>
        <?php endif; ?>

        <?php if ($this->session->flashdata('error')): ?>
            <div class="alert alert-custom-danger alert-dismissible fade show mb-4 alert-autodismiss" role="alert" data-autodismiss="5500">
                <div class="d-flex align-items-center gap-2">
                    <i class="fa-solid fa-circle-exclamation fs-5"></i>
                    <span><?= html_escape($this->session->flashdata('error')); ?></span>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
                <div class="alert-progress-track"><div class="alert-progress-bar alert-progress-bar-error"></div></div>
            </div>
        <?php endif; ?>

        <!-- HEADER HALAMAN -->
        <div class="page-header-custom mb-4">
            <div class="d-flex align-items-center gap-3">
                <div class="page-header-icon">
                    <i class="fa-solid fa-trophy"></i>
                </div>
                <div>
                    <span class="badge-header-tag mb-1">
                        <i class="fa-solid fa-star me-1"></i> Rekam Jejak Juara
                    </span>
                    <h2 class="page-title">Data Prestasi</h2>
                    <p class="page-subtitle">Kelola daftar pencapaian, penghargaan, dan kejuaraan sekolah.</p>
                </div>
            </div>
            <a href="<?= site_url('admin/prestasi/tambah'); ?>" class="btn-add">
                <i class="fa-solid fa-plus me-2"></i>
                Tambah Prestasi
            </a>
        </div>

        <!-- DATA PRESTASI TABLE CARD -->
        <div class="custom-card card-hover">
            <div class="card-title-custom justify-content-between align-items-center">
                <div class="d-flex align-items-center gap-3">
                    <div class="title-icon">
                        <i class="fa-solid fa-list-check"></i>
                    </div>
                    <div>
                        <h5>Daftar Prestasi</h5>
                        <small>Rekapitulasi capaian dan kejuaraan siswa/sekolah</small>
                    </div>
                </div>
                <div class="d-flex align-items-center gap-3 flex-wrap toolbar-right">
                    <div class="table-search-group">
                        <i class="fa-solid fa-magnifying-glass table-search-icon"></i>
                        <input type="text" id="prestasi-search-input" class="table-search-input" placeholder="Cari judul, kategori, pemenang..." aria-label="Cari data prestasi">
                    </div>
                    <div class="total-badge">
                        <i class="fa-solid fa-ribbon me-1"></i>
                        <span id="prestasi-count"><?= count($prestasi ?? []); ?></span> Data Terdaftar
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table custom-table align-middle mb-0">
                    <thead>
                        <tr>
                            <th width="60" class="text-center">No</th>
                            <th width="80" class="text-center">Gambar</th>
                            <th>Judul Prestasi</th>
                            <th>Kategori / Tingkat</th>
                            <th>Pemenang</th>
                            <th width="90" class="text-center">Tahun</th>
                            <th width="120" class="text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="prestasi-table-body">
                        <?php if (!empty($prestasi)): ?>
                            <?php $no = 1; ?>
                            <?php foreach ($prestasi as $p): ?>
                                <?php
                                    $foto_url = prestasi_foto_url($p->foto ?? '');
                                    $ts = (!empty($p->tanggal) && strpos($p->tanggal, '0000') !== 0) ? strtotime($p->tanggal) : false;
                                ?>
                                <tr class="prestasi-row" data-search="<?= html_escape(strtolower(($p->nama_prestasi ?? '') . ' ' . ($p->tingkat ?? '') . ' ' . ($p->nama_siswa ?? '') . ' ' . ($p->juara ?? ''))); ?>">
                                    <!-- NO -->
                                    <td class="text-center fw-semibold text-subtle"><?= $no++; ?></td>

                                    <!-- GAMBAR -->
                                    <td class="text-center">
                                        <?php if ($foto_url !== ''): ?>
                                            <img src="<?= $foto_url; ?>" class="item-photo" alt="<?= html_escape($p->nama_prestasi ?? ''); ?>" loading="lazy">
                                        <?php else: ?>
                                            <div class="item-photo-placeholder mx-auto">
                                                <i class="fa-solid fa-image"></i>
                                            </div>
                                        <?php endif; ?>
                                    </td>

                                    <!-- JUDUL -->
                                    <td>
                                        <div class="item-name"><?= html_escape($p->nama_prestasi ?? ''); ?></div>
                                        <?php if (!empty($p->juara)): ?>
                                            <div class="item-sub">
                                                <i class="fa-solid fa-medal me-1"></i><?= html_escape($p->juara); ?>
                                            </div>
                                        <?php endif; ?>
                                    </td>

                                    <!-- TINGKAT -->
                                    <td>
                                        <?php if (!empty($p->tingkat)): ?>
                                            <span class="info-badge"><i class="fa-solid fa-layer-group me-1"></i><?= html_escape($p->tingkat); ?></span>
                                        <?php else: ?>
                                            <span class="text-subtle">-</span>
                                        <?php endif; ?>
                                    </td>

                                    <!-- PEMENANG -->
                                    <td class="fw-medium text-title">
                                        <?php if (!empty($p->nama_siswa)): ?>
                                            <i class="fa-solid fa-user-graduate me-2 text-subtle"></i><?= html_escape($p->nama_siswa); ?>
                                        <?php else: ?>
                                            <span class="text-subtle">-</span>
                                        <?php endif; ?>
                                    </td>

                                    <!-- TAHUN -->
                                    <td class="text-center">
                                        <?php if ($ts): ?>
                                            <span class="info-badge year"><?= date('Y', $ts); ?></span>
                                        <?php else: ?>
                                            <span class="text-subtle">-</span>
                                        <?php endif; ?>
                                    </td>

                                    <!-- AKSI -->
                                    <td class="text-end">
                                        <div class="action-buttons justify-content-end">
                                            <a href="<?= site_url('admin/prestasi/edit/' . $p->id); ?>" class="btn-action edit" title="Edit Data" aria-label="Edit data prestasi">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                            <a href="<?= site_url('admin/prestasi/hapus/' . $p->id); ?>" class="btn-action delete" title="Hapus Data" aria-label="Hapus data prestasi" onclick="return confirm('Apakah Anda yakin ingin menghapus data prestasi ini?');">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            <tr id="prestasi-no-result" class="d-none">
                                <td colspan="7" class="empty-data">
                                    <div class="empty-icon">
                                        <i class="fa-solid fa-magnifying-glass"></i>
                                    </div>
                                    <div class="fw-bold fs-6 mb-1 text-title">Tidak ditemukan</div>
                                    <p class="text-subtle fs-7 mb-0">Tidak ada data prestasi yang cocok dengan pencarian.</p>
                                </td>
                            </tr>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" class="empty-data">
                                    <div class="empty-icon">
                                        <i class="fa-solid fa-trophy"></i>
                                    </div>
                                    <div class="fw-bold fs-6 mb-1 text-title">Belum ada data prestasi</div>
                                    <p class="text-subtle fs-7 mb-3">Sistem belum mencatat pencapaian atau kejuaraan sekolah.</p>
                                    <a href="<?= site_url('admin/prestasi/tambah'); ?>" class="btn-add d-inline-flex">
                                        <i class="fa-solid fa-plus me-2"></i> Tambahkan Prestasi Sekarang
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
/* =====================================================================
   DESIGN SYSTEM ADMIN (SHARED) - identik dengan halaman Guru & Staff.
   Blok ini sama persis di index.php, tambah.php, dan edit.php.
===================================================================== */
:root {
    --guru-bg: #f8fafc;
    --guru-card-bg: #ffffff;
    --guru-card-subtle: #f8fafc;
    --guru-input-bg: #f8fafc;
    --guru-input-border: #cbd5e1;
    --guru-input-color: #0f172a;
    --guru-input-focus-bg: #ffffff;
    --guru-border: rgba(226, 232, 240, 0.8);
    --guru-title: #0f172a;
    --guru-subtitle: #64748b;
    --guru-hover: #f1f5f9;
    --guru-shadow: 0 10px 25px -5px rgba(15, 23, 42, 0.05), 0 8px 10px -6px rgba(15, 23, 42, 0.01);
    --guru-accent: #0ea5e9;
    --guru-accent-glow: rgba(14, 165, 233, 0.25);
    --guru-accent-soft: rgba(14, 165, 233, 0.12);
    --guru-accent-ring: rgba(14, 165, 233, 0.25);
    --guru-icon-muted: #94a3b8;
    --dropzone-bg: #f1f5f9;
    --dropzone-border: #cbd5e1;
    --guru-success: #059669;
    --guru-success-soft: rgba(16, 185, 129, 0.15);
    --guru-success-ring: rgba(16, 185, 129, 0.3);
    --guru-danger: #ef4444;
    --guru-danger-soft: rgba(239, 68, 68, 0.12);
    --guru-danger-ring: rgba(239, 68, 68, 0.28);
    --guru-btn-from: #0284c7;
    --guru-btn-to: #0369a1;
    --guru-scheme: light;
}

/* Dukungan semua selector dark mode (Bootstrap 5.3, data-theme, class body/html) */
[data-bs-theme="dark"],
[data-theme="dark"],
body.dark-mode,
.dark-mode {
    --guru-bg: #070d19;
    --guru-card-bg: #0f172a;
    --guru-card-subtle: #1e293b;
    --guru-input-bg: #1e293b;
    --guru-input-border: rgba(255, 255, 255, 0.12);
    --guru-input-color: #f1f5f9;
    --guru-input-focus-bg: #111827;
    --guru-border: rgba(255, 255, 255, 0.08);
    --guru-title: #f8fafc;
    --guru-subtitle: #94a3b8;
    --guru-hover: #1e293b;
    --guru-shadow: 0 12px 30px -5px rgba(0, 0, 0, 0.4);
    --guru-accent: #38bdf8;
    --guru-accent-glow: rgba(56, 189, 248, 0.25);
    --guru-accent-soft: rgba(56, 189, 248, 0.12);
    --guru-accent-ring: rgba(56, 189, 248, 0.25);
    --guru-icon-muted: #64748b;
    --dropzone-bg: #111827;
    --dropzone-border: rgba(255, 255, 255, 0.15);
    --guru-success: #34d399;
    --guru-danger: #f87171;
    --guru-scheme: dark;
}

.text-title { color: var(--guru-title) !important; }
.text-subtle { color: var(--guru-subtitle) !important; }
.fs-7 { font-size: 13px; }
.fs-8 { font-size: 11px; }

/* ===================== FLASH ALERT (AUTO-DISMISS) ===================== */
.alert-custom-success,
.alert-custom-danger {
    position: relative;
    overflow: hidden;
    border-radius: 16px;
    padding: 16px 52px 16px 20px;
    backdrop-filter: blur(8px);
    animation: guruAlertIn 0.35s cubic-bezier(0.34, 1.56, 0.64, 1);
}

.alert-custom-success {
    background: var(--guru-success-soft) !important;
    border: 1px solid var(--guru-success-ring) !important;
    color: var(--guru-success) !important;
}

.alert-custom-danger {
    background: var(--guru-danger-soft) !important;
    border: 1px solid var(--guru-danger-ring) !important;
    color: var(--guru-danger) !important;
}

.alert-custom-success .btn-close,
.alert-custom-danger .btn-close {
    position: absolute;
    top: 50%;
    right: 14px;
    margin: 0;
    padding: 8px;
    transform: translateY(-50%);
    opacity: 0.6;
    z-index: 2;
}

.alert-custom-success .btn-close:hover,
.alert-custom-danger .btn-close:hover { opacity: 1; }

[data-theme="dark"] .alert .btn-close,
body.dark-mode .alert .btn-close,
.dark-mode .alert .btn-close { filter: invert(1) grayscale(100%) brightness(200%); }

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

.alert-custom-success .alert-icon-box { background: rgba(16, 185, 129, 0.2); }
.alert-custom-danger .alert-icon-box { background: rgba(239, 68, 68, 0.2); }

.alert-heading {
    color: inherit;
    font-size: 14px;
    font-weight: 700;
}

.alert-autodismiss.alert-hiding { animation: guruAlertOut 0.35s ease forwards; }

.alert-progress-track {
    position: absolute;
    left: 0; right: 0; bottom: 0;
    height: 3px;
    background: rgba(148, 163, 184, 0.2);
}

.alert-progress-bar {
    height: 100%;
    width: 100%;
    background: var(--guru-success);
    transform-origin: left;
    animation-name: guruAlertProgress;
    animation-timing-function: linear;
    animation-fill-mode: forwards;
}

.alert-progress-bar-error { background: var(--guru-danger); }

/* ===================== PAGE HEADER ===================== */
.page-header-custom {
    position: relative;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 20px;
    padding: 22px 28px;
    background: var(--guru-card-bg) !important;
    border: 1px solid var(--guru-border) !important;
    border-radius: 20px;
    box-shadow: var(--guru-shadow);
}

.page-header-custom::before {
    content: "";
    position: absolute;
    inset: 0 auto 0 0;
    width: 4px;
    background: linear-gradient(180deg, var(--guru-accent), var(--guru-btn-to));
}

.badge-header-tag {
    display: inline-flex;
    align-items: center;
    background: var(--guru-accent-soft);
    color: var(--guru-accent);
    border: 1px solid var(--guru-accent-ring);
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.page-title {
    color: var(--guru-title) !important;
    font-size: 22px;
    font-weight: 800;
    margin: 0 0 2px;
    letter-spacing: -0.3px;
}

.page-subtitle {
    color: var(--guru-subtitle) !important;
    font-size: 13px;
    margin: 0;
}

.page-header-icon {
    width: 50px;
    height: 50px;
    border-radius: 14px;
    background: var(--guru-card-subtle);
    border: 1px solid var(--guru-border);
    color: var(--guru-accent);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 22px;
    flex-shrink: 0;
    transition: transform 0.35s ease;
}

.page-header-custom:hover .page-header-icon { transform: rotate(-6deg) scale(1.06); }

/* ===================== PRIMARY BUTTON (Tambah / Simpan) ===================== */
.btn-add,
.btn-save {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border: 1px solid transparent;
    background: linear-gradient(135deg, var(--guru-btn-from) 0%, var(--guru-btn-to) 100%);
    background-origin: border-box;
    color: #ffffff !important;
    text-decoration: none;
    padding: 11px 24px;
    border-radius: 12px;
    font-size: 13px;
    font-weight: 700;
    white-space: nowrap;
    cursor: pointer;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    box-shadow: 0 6px 18px rgba(2, 132, 199, 0.3);
}

.btn-add:hover,
.btn-save:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 24px rgba(2, 132, 199, 0.45);
}

.btn-add:focus-visible,
.btn-save:focus-visible {
    outline: none;
    box-shadow: 0 0 0 4px var(--guru-accent-glow);
}

/* ===================== CARD ===================== */
.custom-card {
    background: var(--guru-card-bg) !important;
    border: 1px solid var(--guru-border) !important;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: var(--guru-shadow);
    animation: guruFadeUp 0.4s ease both;
    transition: box-shadow 0.3s ease, border-color 0.3s ease;
}

.custom-card.card-hover:hover {
    border-color: var(--guru-accent-ring) !important;
    box-shadow: 0 16px 34px -10px rgba(15, 23, 42, 0.12);
}

.card-title-custom {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: 14px;
    padding: 18px 24px;
    background: var(--guru-card-subtle) !important;
    border-bottom: 1px solid var(--guru-border) !important;
}

.card-title-custom h5 {
    margin: 0 0 2px;
    color: var(--guru-title) !important;
    font-size: 15px;
    font-weight: 700;
}

.card-title-custom small {
    color: var(--guru-subtitle) !important;
    font-size: 12px;
}

.title-icon {
    width: 40px;
    height: 40px;
    background: var(--guru-accent-soft);
    border: 1px solid var(--guru-accent-ring);
    border-radius: 12px;
    color: var(--guru-accent);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 16px;
    flex-shrink: 0;
}

.card-body-custom { padding: 24px; }
.card-body-custom + .card-title-custom { border-top: 1px solid var(--guru-border); }

/* ===================== KEYFRAMES ===================== */
@keyframes guruAlertIn {
    from { opacity: 0; transform: translateY(-14px) scale(0.98); }
    to { opacity: 1; transform: translateY(0) scale(1); }
}

@keyframes guruAlertOut {
    from { opacity: 1; max-height: 200px; }
    to { opacity: 0; transform: translateY(-10px) scale(0.98); margin-bottom: 0 !important; max-height: 0; padding-top: 0; padding-bottom: 0; border-width: 0; }
}

@keyframes guruAlertProgress {
    from { transform: scaleX(1); }
    to { transform: scaleX(0); }
}

@keyframes guruFadeUp {
    from { opacity: 0; transform: translateY(12px); }
    to { opacity: 1; transform: translateY(0); }
}

/* ===================== RESPONSIVE (SHARED) ===================== */
@media (max-width: 768px) {
    .page-header-custom { flex-direction: column; align-items: stretch; }
    .btn-add { justify-content: center; }
}

/* =====================================================================
   HALAMAN INDEX: TABEL, PENCARIAN, BADGE, AKSI, EMPTY STATE
===================================================================== */
.total-badge {
    color: var(--guru-accent);
    font-size: 12px;
    background: var(--guru-accent-soft);
    border: 1px solid var(--guru-accent-ring);
    padding: 6px 14px;
    border-radius: 20px;
    font-weight: 700;
}

/* Kotak pencarian */
.table-search-group {
    position: relative;
    display: flex;
    align-items: center;
}

.table-search-icon {
    position: absolute;
    left: 14px;
    color: var(--guru-subtitle);
    font-size: 13px;
    pointer-events: none;
}

.table-search-input {
    background: var(--guru-card-bg) !important;
    border: 1px solid var(--guru-border) !important;
    border-radius: 10px;
    padding: 8px 14px 8px 36px;
    font-size: 13px;
    color: var(--guru-title) !important;
    min-width: 220px;
    transition: all 0.25s ease;
}

.table-search-input::placeholder { color: var(--guru-subtitle); opacity: 0.75; }

.table-search-input:focus {
    outline: none;
    border-color: var(--guru-accent) !important;
    box-shadow: 0 0 0 3px var(--guru-accent-glow);
}

/* Tabel */
.custom-table {
    --bs-table-bg: transparent !important;
    --bs-table-color: var(--guru-title) !important;
    color: var(--guru-title) !important;
    margin-bottom: 0;
}

.custom-table th {
    background: var(--guru-card-subtle) !important;
    color: var(--guru-subtitle) !important;
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.6px;
    padding: 16px 20px;
    border-bottom: 1px solid var(--guru-border) !important;
}

.custom-table td {
    padding: 16px 20px;
    border-bottom: 1px solid var(--guru-border) !important;
    font-size: 13.5px;
    color: var(--guru-title) !important;
    background: transparent !important;
}

.custom-table tbody tr { transition: background-color 0.2s ease; }
.custom-table tbody tr:hover { background-color: var(--guru-hover) !important; }

.custom-table tbody tr.prestasi-row { animation: guruRowIn 0.3s ease both; }
.custom-table tbody tr.prestasi-row:nth-child(1) { animation-delay: 0.02s; }
.custom-table tbody tr.prestasi-row:nth-child(2) { animation-delay: 0.05s; }
.custom-table tbody tr.prestasi-row:nth-child(3) { animation-delay: 0.08s; }
.custom-table tbody tr.prestasi-row:nth-child(4) { animation-delay: 0.11s; }
.custom-table tbody tr.prestasi-row:nth-child(5) { animation-delay: 0.14s; }
.custom-table tbody tr.prestasi-row:nth-child(n+6) { animation-delay: 0.16s; }

@keyframes guruRowIn {
    from { opacity: 0; transform: translateX(-6px); }
    to { opacity: 1; transform: translateX(0); }
}

/* Gambar */
.item-photo,
.item-photo-placeholder {
    width: 44px;
    height: 44px;
    border-radius: 12px;
    object-fit: cover;
}

.item-photo {
    border: 1px solid var(--guru-border);
    transition: transform 0.25s ease;
}

.custom-table tbody tr:hover .item-photo { transform: scale(1.08); }

.item-photo-placeholder {
    background: var(--guru-card-subtle) !important;
    border: 1px solid var(--guru-border) !important;
    color: var(--guru-accent);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
}

/* Teks & badge */
.item-name {
    color: var(--guru-title) !important;
    font-weight: 700;
    font-size: 14px;
}

.item-sub {
    color: var(--guru-accent) !important;
    font-size: 11.5px;
    margin-top: 2px;
}

.info-badge {
    display: inline-flex;
    align-items: center;
    background: var(--guru-card-subtle) !important;
    color: var(--guru-title) !important;
    border: 1px solid var(--guru-border) !important;
    padding: 4px 10px;
    border-radius: 8px;
    font-size: 12px;
    font-weight: 600;
}

.info-badge.year { font-weight: 700; letter-spacing: 0.3px; }

/* Tombol aksi */
.action-buttons { display: flex; gap: 8px; }

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
    background: var(--guru-card-subtle) !important;
    color: var(--guru-title) !important;
    border: 1px solid var(--guru-border) !important;
}

.btn-action.edit:hover {
    background: var(--guru-accent) !important;
    color: #ffffff !important;
    border-color: var(--guru-accent) !important;
    transform: translateY(-2px);
}

.btn-action.delete {
    background: var(--guru-danger-soft) !important;
    color: var(--guru-danger) !important;
    border: 1px solid var(--guru-danger-ring) !important;
}

.btn-action.delete:hover {
    background: #ef4444 !important;
    color: #ffffff !important;
    border-color: #ef4444 !important;
    transform: translateY(-2px);
}

.btn-action:focus-visible {
    outline: none;
    box-shadow: 0 0 0 4px var(--guru-accent-glow);
}

/* Empty state */
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
    background: var(--guru-card-subtle) !important;
    border: 1px solid var(--guru-border) !important;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--guru-subtitle);
    font-size: 26px;
}

@media (max-width: 768px) {
    .card-title-custom {
        flex-direction: column;
        align-items: flex-start !important;
        gap: 12px;
    }

    .toolbar-right {
        width: 100%;
        justify-content: space-between;
    }

    .table-search-group { flex: 1; }
    .table-search-input { width: 100%; min-width: 0; }
}

@media (prefers-reduced-motion: reduce) {
    .alert-custom-success, .alert-custom-danger, .custom-card, .prestasi-row,
    .page-header-icon, .item-photo { animation: none !important; transition: none !important; }
}
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // ---- Flash alert: auto-dismiss, pause saat di-hover, tutup manual
        document.querySelectorAll('.alert-autodismiss').forEach(function (alertEl) {
            var duration = parseInt(alertEl.getAttribute('data-autodismiss'), 10) || 5000;
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

        // ---- Pencarian data prestasi secara langsung (client-side)
        var searchInput = document.getElementById('prestasi-search-input');
        var tbody = document.getElementById('prestasi-table-body');
        var countEl = document.getElementById('prestasi-count');
        var noResultRow = document.getElementById('prestasi-no-result');

        if (searchInput && tbody) {
            searchInput.addEventListener('input', function () {
                var keyword = searchInput.value.trim().toLowerCase();
                var rows = tbody.querySelectorAll('.prestasi-row');
                var visibleCount = 0;

                rows.forEach(function (row) {
                    var haystack = (row.getAttribute('data-search') || '').toLowerCase();
                    var match = haystack.indexOf(keyword) !== -1;
                    row.classList.toggle('d-none', !match);
                    if (match) visibleCount++;
                });

                if (countEl) countEl.textContent = visibleCount;
                if (noResultRow) noResultRow.classList.toggle('d-none', visibleCount !== 0 || rows.length === 0);
            });
        }

        // ---- Gambar gagal dimuat -> ganti dengan placeholder ikon
        function swapToPlaceholder(img) {
            var ph = document.createElement('div');
            ph.className = 'item-photo-placeholder mx-auto';
            ph.innerHTML = '<i class="fa-solid fa-image"></i>';
            if (img.parentNode) img.parentNode.replaceChild(ph, img);
        }
        document.querySelectorAll('.item-photo').forEach(function (img) {
            img.addEventListener('error', function () { swapToPlaceholder(img); });
            if (img.complete && img.naturalWidth === 0) swapToPlaceholder(img);
        });
    });
</script>

<?php $this->load->view('admin/template/footer'); ?>