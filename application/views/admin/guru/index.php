<?php $this->load->view('admin/template/header'); ?>
<?php $this->load->view('admin/template/sidebar'); ?>

<div class="main-content">
    <?php $this->load->view('admin/template/navbar'); ?>

    <div class="content-wrapper">

        <!-- FLASH MESSAGE -->
        <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-custom-success alert-dismissible fade show mb-4 alert-autodismiss" role="alert" data-autodismiss="4500">
                <div class="d-flex align-items-center gap-2">
                    <i class="fa-solid fa-circle-check fs-5"></i>
                    <span><?= $this->session->flashdata('success'); ?></span>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <div class="alert-progress-track"><div class="alert-progress-bar"></div></div>
            </div>
        <?php endif; ?>

        <?php if ($this->session->flashdata('error')): ?>
            <div class="alert alert-custom-danger alert-dismissible fade show mb-4 alert-autodismiss" role="alert" data-autodismiss="5500">
                <div class="d-flex align-items-center gap-2">
                    <i class="fa-solid fa-circle-exclamation fs-5"></i>
                    <span><?= $this->session->flashdata('error'); ?></span>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <div class="alert-progress-track"><div class="alert-progress-bar alert-progress-bar-error"></div></div>
            </div>
        <?php endif; ?>

        <!-- HEADER HALAMAN -->
        <div class="page-header-custom mb-4">
            <div class="d-flex align-items-center gap-3">
                <div class="page-header-icon">
                    <i class="fa-solid fa-chalkboard-user"></i>
                </div>
                <div>
                    <span class="badge-header-tag mb-1">
                        <i class="fa-solid fa-users-gear me-1"></i> Manajemen SDM
                    </span>
                    <h2 class="page-title">Guru & Staff</h2>
                    <p class="page-subtitle">Kelola data tenaga pendidik dan kependidikan SMA Negeri Tawangmangu.</p>
                </div>
            </div>
            <a href="<?= site_url('admin/guru/tambah'); ?>" class="btn-add">
                <i class="fa-solid fa-plus me-2"></i>
                Tambah Guru
            </a>
        </div>

        <!-- DATA GURU TABLE CARD -->
        <div class="custom-card">
            <div class="card-title-custom justify-content-between align-items-center">
                <div class="d-flex align-items-center gap-3">
                    <div class="title-icon">
                        <i class="fa-solid fa-address-card"></i>
                    </div>
                    <div>
                        <h5>Data Guru & Staff</h5>
                        <small>Daftar seluruh civitas sekolah yang terdaftar aktif</small>
                    </div>
                </div>
                <div class="d-flex align-items-center gap-3 flex-wrap toolbar-right">
                    <div class="table-search-group">
                        <i class="fa-solid fa-magnifying-glass table-search-icon"></i>
                        <input type="text" id="guru-search-input" class="table-search-input" placeholder="Cari nama, NIP, jabatan...">
                    </div>
                    <div class="total-badge">
                        <i class="fa-solid fa-user-group me-1"></i>
                        <span id="guru-count"><?= count($guru); ?></span> Data Terdaftar
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table custom-table align-middle mb-0">
                    <thead>
                        <tr>
                            <th width="60" class="text-center">No</th>
                            <th width="80" class="text-center">Foto</th>
                            <th>Nama Lengkap</th>
                            <th>NIP</th>
                            <th>Jabatan</th>
                            <th>Mata Pelajaran</th>
                            <th class="text-center">Status</th>
                            <th width="120" class="text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="guru-table-body">
                        <?php if (!empty($guru)): ?>
                            <?php $no = 1; ?>
                            <?php foreach ($guru as $item): ?>
                                <tr class="guru-row" data-search="<?= htmlspecialchars(strtolower($item->nama . ' ' . ($item->nip ?? '') . ' ' . ($item->jabatan ?? '') . ' ' . ($item->mata_pelajaran ?? ''))); ?>">
                                    <!-- NO -->
                                    <td class="text-center fw-semibold text-subtle"><?= $no++; ?></td>

                                    <!-- FOTO -->
                                    <td class="text-center">
                                        <?php if (!empty($item->foto)): ?>
                                            <?php $guru_foto = (strpos($item->foto, '/') !== false || strpos($item->foto, '\\') !== false) ? $item->foto : 'guru/' . $item->foto; ?>
                                            <img src="<?= base_url('assets/img/' . ltrim($guru_foto, '/')); ?>" class="guru-photo" alt="<?= htmlspecialchars($item->nama); ?>">
                                        <?php else: ?>
                                            <div class="guru-photo-placeholder mx-auto">
                                                <i class="fa-solid fa-user"></i>
                                            </div>
                                        <?php endif; ?>
                                    </td>

                                    <!-- NAMA -->
                                    <td>
                                        <div class="guru-name"><?= htmlspecialchars($item->nama); ?></div>
                                        <div class="guru-gender">
                                            <?php if ($item->jenis_kelamin == 'L'): ?>
                                                <i class="fa-solid fa-mars me-1 text-primary"></i>Laki-laki
                                            <?php elseif ($item->jenis_kelamin == 'P'): ?>
                                                <i class="fa-solid fa-venus me-1 text-danger"></i>Perempuan
                                            <?php else: ?>
                                                <span class="text-subtle">-</span>
                                            <?php endif; ?>
                                        </div>
                                    </td>

                                    <!-- NIP -->
                                    <td class="font-monospace text-subtle"><?= !empty($item->nip) ? htmlspecialchars($item->nip) : '-'; ?></td>

                                    <!-- JABATAN -->
                                    <td class="fw-medium text-title"><?= !empty($item->jabatan) ? htmlspecialchars($item->jabatan) : '-'; ?></td>

                                    <!-- MAPEL -->
                                    <td>
                                        <?php if (!empty($item->mata_pelajaran)): ?>
                                            <span class="mapel-badge"><?= htmlspecialchars($item->mata_pelajaran); ?></span>
                                        <?php else: ?>
                                            <span class="text-subtle">-</span>
                                        <?php endif; ?>
                                    </td>

                                    <!-- STATUS -->
                                    <td class="text-center">
                                        <?php if ($item->status == 'aktif'): ?>
                                            <span class="status-badge active">
                                                <i class="fa-solid fa-circle-check me-1"></i> Aktif
                                            </span>
                                        <?php else: ?>
                                            <span class="status-badge inactive">
                                                <i class="fa-solid fa-circle-xmark me-1"></i> Nonaktif
                                            </span>
                                        <?php endif; ?>
                                    </td>

                                    <!-- AKSI -->
                                    <td class="text-end">
                                        <div class="action-buttons justify-content-end">
                                            <a href="<?= site_url('admin/guru/edit/' . $item->id); ?>" class="btn-action edit" title="Edit Data">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                            <a href="<?= site_url('admin/guru/hapus/' . $item->id); ?>" class="btn-action delete" title="Hapus Data" onclick="return confirm('Apakah Anda yakin ingin menghapus data guru ini?');">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            <tr id="guru-no-result" class="d-none">
                                <td colspan="8" class="empty-data">
                                    <div class="empty-icon">
                                        <i class="fa-solid fa-magnifying-glass"></i>
                                    </div>
                                    <div class="fw-bold fs-6 mb-1 text-title">Tidak ditemukan</div>
                                    <p class="text-subtle fs-7 mb-0">Tidak ada data guru yang cocok dengan pencarian.</p>
                                </td>
                            </tr>
                        <?php else: ?>
                            <tr>
                                <td colspan="8" class="empty-data">
                                    <div class="empty-icon">
                                        <i class="fa-solid fa-users-slash"></i>
                                    </div>
                                    <div class="fw-bold fs-6 mb-1 text-title">Belum ada data guru</div>
                                    <p class="text-subtle fs-7 mb-3">Sistem belum mencatat data tenaga pendidik atau staff.</p>
                                    <a href="<?= site_url('admin/guru/tambah'); ?>" class="btn-add d-inline-flex ms-0">
                                        <i class="fa-solid fa-plus me-2"></i> Tambahkan Guru Sekarang
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

<!-- STYLES KUSTOM DENGAN UNIFIED DARK MODE FIX -->
<style>
/* -----------------------------------------------------------------
   GLOBAL THEMING & VARIABLES
----------------------------------------------------------------- */
:root {
    --guru-bg: #f8fafc;
    --guru-card-bg: #ffffff;
    --guru-card-subtle: #f1f5f9;
    --guru-border: #e2e8f0;
    --guru-title: #0f172a;
    --guru-subtitle: #64748b;
    --guru-hover: #f8fafc;
    --guru-shadow: 0 10px 30px -5px rgba(15, 23, 42, 0.05);
    --guru-accent: #00b4d8;
}

/* Multi-selector Support untuk Dark Mode (Bootstrap 5.3+, HTML Class, body Class) */
[data-bs-theme="dark"],
[data-theme="dark"],
body.dark-mode,
.dark-mode {
    --guru-bg: #070d19;
    --guru-card-bg: #0f172a;
    --guru-card-subtle: #1e293b;
    --guru-border: rgba(255, 255, 255, 0.1);
    --guru-title: #f8fafc;
    --guru-subtitle: #94a3b8;
    --guru-hover: #1e293b;
    --guru-shadow: 0 10px 30px -5px rgba(0, 0, 0, 0.5);
    --guru-accent: #38bdf8;
}

.text-title { color: var(--guru-title) !important; }
.text-subtle { color: var(--guru-subtitle) !important; }
.fs-7 { font-size: 12px; }

/* Alert Success Custom */
.alert-custom-success {
    background: rgba(16, 185, 129, 0.15) !important;
    border: 1px solid rgba(16, 185, 129, 0.3) !important;
    color: #34d399 !important;
    border-radius: 16px;
    padding: 16px 20px;
}

/* Page Header */
.page-header-custom {
    background: var(--guru-card-bg) !important;
    border: 1px solid var(--guru-border) !important;
    border-radius: 20px;
    padding: 24px 28px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    box-shadow: var(--guru-shadow);
    gap: 20px;
}

.badge-header-tag {
    display: inline-flex;
    align-items: center;
    background: rgba(56, 189, 248, 0.12);
    color: var(--guru-accent);
    border: 1px solid rgba(56, 189, 248, 0.25);
    padding: 4px 10px;
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
    width: 52px;
    height: 52px;
    border-radius: 16px;
    background: var(--guru-card-subtle) !important;
    border: 1px solid var(--guru-border) !important;
    color: var(--guru-accent);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 22px;
    flex-shrink: 0;
}

/* Button Tambah */
.btn-add {
    display: inline-flex;
    align-items: center;
    background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%);
    color: #ffffff !important;
    text-decoration: none;
    padding: 12px 22px;
    border-radius: 12px;
    font-size: 13px;
    font-weight: 700;
    transition: all 0.3s ease;
    box-shadow: 0 6px 18px rgba(2, 132, 199, 0.3);
    white-space: nowrap;
}

.btn-add:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 24px rgba(2, 132, 199, 0.45);
}

/* Custom Card Container */
.custom-card {
    background: var(--guru-card-bg) !important;
    border: 1px solid var(--guru-border) !important;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: var(--guru-shadow);
}

.card-title-custom {
    display: flex;
    padding: 20px 24px;
    background: var(--guru-card-subtle) !important;
    border-bottom: 1px solid var(--guru-border) !important;
}

.title-icon {
    width: 42px;
    height: 42px;
    background: rgba(56, 189, 248, 0.12);
    border: 1px solid rgba(56, 189, 248, 0.25);
    color: var(--guru-accent);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 16px;
    flex-shrink: 0;
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

.total-badge {
    color: var(--guru-accent);
    font-size: 12px;
    background: rgba(56, 189, 248, 0.12);
    border: 1px solid rgba(56, 189, 248, 0.25);
    padding: 6px 14px;
    border-radius: 20px;
    font-weight: 700;
}

/* Table Design Overrides */
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

.custom-table tbody tr {
    transition: background-color 0.2s ease;
}

.custom-table tbody tr:hover {
    background-color: var(--guru-hover) !important;
}

/* Foto & Badges */
.guru-photo,
.guru-photo-placeholder {
    width: 44px;
    height: 44px;
    border-radius: 12px;
    object-fit: cover;
}

.guru-photo {
    border: 1px solid var(--guru-border);
}

.guru-photo-placeholder {
    background: var(--guru-card-subtle) !important;
    border: 1px solid var(--guru-border) !important;
    color: var(--guru-accent);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
}

.guru-name {
    color: var(--guru-title) !important;
    font-weight: 700;
    font-size: 14px;
}

.guru-gender {
    color: var(--guru-subtitle) !important;
    font-size: 11.5px;
    margin-top: 2px;
}

.mapel-badge {
    background: var(--guru-card-subtle) !important;
    color: var(--guru-title) !important;
    border: 1px solid var(--guru-border) !important;
    padding: 4px 10px;
    border-radius: 8px;
    font-size: 12px;
    font-weight: 600;
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
    color: #34d399 !important;
    border: 1px solid rgba(16, 185, 129, 0.3) !important;
}

.status-badge.inactive {
    background: rgba(239, 68, 68, 0.15) !important;
    color: #f87171 !important;
    border: 1px solid rgba(239, 68, 68, 0.3) !important;
}

/* Action Buttons */
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
    background: rgba(239, 68, 68, 0.12) !important;
    color: #f87171 !important;
    border: 1px solid rgba(239, 68, 68, 0.2) !important;
}

.btn-action.delete:hover {
    background: #ef4444 !important;
    color: #ffffff !important;
    border-color: #ef4444 !important;
    transform: translateY(-2px);
}

/* Empty State */
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
    .page-header-custom {
        flex-direction: column;
        align-items: stretch;
    }

    .btn-add {
        justify-content: center;
    }

    .card-title-custom {
        flex-direction: column;
        align-items: flex-start !important;
        gap: 12px;
    }

    .toolbar-right {
        width: 100%;
        justify-content: space-between;
    }

    .table-search-group {
        flex: 1;
    }
}

/* ===================== POLISH: FLASH ALERT (AUTO-DISMISS) ===================== */
.alert-autodismiss {
    position: relative;
    overflow: hidden;
    animation: guruAlertIn 0.35s cubic-bezier(0.34, 1.56, 0.64, 1);
}

@keyframes guruAlertIn {
    from { opacity: 0; transform: translateY(-14px) scale(0.98); }
    to { opacity: 1; transform: translateY(0) scale(1); }
}

.alert-autodismiss.alert-hiding {
    animation: guruAlertOut 0.35s ease forwards;
}

@keyframes guruAlertOut {
    to { opacity: 0; transform: translateY(-10px) scale(0.98); margin-bottom: 0 !important; max-height: 0; padding-top: 0; padding-bottom: 0; }
}

.alert-custom-danger {
    background: rgba(239, 68, 68, 0.12) !important;
    border: 1px solid rgba(239, 68, 68, 0.3) !important;
    color: #f87171 !important;
    border-radius: 16px;
    padding: 16px 20px;
}

.alert-progress-track {
    position: absolute;
    left: 0; right: 0; bottom: 0;
    height: 3px;
    background: rgba(148, 163, 184, 0.2);
}

.alert-progress-bar {
    height: 100%;
    width: 100%;
    background: #10b981;
    transform-origin: left;
    animation-name: guruAlertProgress;
    animation-timing-function: linear;
    animation-fill-mode: forwards;
}

.alert-progress-bar-error { background: #ef4444; }

@keyframes guruAlertProgress {
    from { transform: scaleX(1); }
    to { transform: scaleX(0); }
}

/* ===================== POLISH: PAGE HEADER ===================== */
.page-header-custom { position: relative; overflow: hidden; }
.page-header-custom::before {
    content: "";
    position: absolute; inset: 0 auto 0 0;
    width: 4px;
    background: linear-gradient(180deg, var(--guru-accent), #0369a1);
}
.page-header-icon { transition: transform 0.35s ease; }
.page-header-custom:hover .page-header-icon { transform: rotate(-6deg) scale(1.06); }

/* ===================== POLISH: CARD & ROW ENTRANCE ===================== */
.custom-card { animation: guruFadeUp 0.4s ease both; transition: box-shadow 0.3s ease, border-color 0.3s ease; }
@keyframes guruFadeUp {
    from { opacity: 0; transform: translateY(12px); }
    to { opacity: 1; transform: translateY(0); }
}
.custom-card:hover {
    border-color: rgba(56, 189, 248, 0.3) !important;
    box-shadow: 0 16px 34px -10px rgba(15, 23, 42, 0.12);
}

.custom-table tbody tr.guru-row {
    animation: guruRowIn 0.3s ease both;
}
.custom-table tbody tr.guru-row:nth-child(1) { animation-delay: 0.02s; }
.custom-table tbody tr.guru-row:nth-child(2) { animation-delay: 0.05s; }
.custom-table tbody tr.guru-row:nth-child(3) { animation-delay: 0.08s; }
.custom-table tbody tr.guru-row:nth-child(4) { animation-delay: 0.11s; }
.custom-table tbody tr.guru-row:nth-child(5) { animation-delay: 0.14s; }
.custom-table tbody tr.guru-row:nth-child(n+6) { animation-delay: 0.16s; }

@keyframes guruRowIn {
    from { opacity: 0; transform: translateX(-6px); }
    to { opacity: 1; transform: translateX(0); }
}

.guru-photo { transition: transform 0.25s ease; }
.custom-table tbody tr:hover .guru-photo { transform: scale(1.08); }

.status-badge.active {
    position: relative;
}
.status-badge.active::before {
    content: "";
    width: 6px; height: 6px; border-radius: 50%;
    background: #10b981;
    display: inline-block;
    margin-right: 5px;
    animation: guruPulse 1.8s ease-in-out infinite;
}

@keyframes guruPulse {
    0%, 100% { opacity: 1; box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.5); }
    50% { opacity: 0.7; box-shadow: 0 0 0 3px rgba(16, 185, 129, 0); }
}

/* ===================== POLISH: TABLE SEARCH BOX ===================== */
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
    box-shadow: 0 0 0 3px rgba(56, 189, 248, 0.18);
}

@media (prefers-reduced-motion: reduce) {
    .alert-autodismiss, .custom-card, .guru-row, .page-header-icon,
    .guru-photo, .status-badge.active::before { animation: none !important; transition: none !important; }
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

        // Pencarian data guru secara langsung (client-side)
        var searchInput = document.getElementById('guru-search-input');
        var tbody = document.getElementById('guru-table-body');
        var countEl = document.getElementById('guru-count');
        var noResultRow = document.getElementById('guru-no-result');

        if (searchInput && tbody) {
            searchInput.addEventListener('input', function () {
                var keyword = searchInput.value.trim().toLowerCase();
                var rows = tbody.querySelectorAll('.guru-row');
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