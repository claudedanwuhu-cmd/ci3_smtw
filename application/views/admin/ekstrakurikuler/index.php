<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$this->load->view('admin/template/header');
$this->load->view('admin/template/sidebar');

/* ---------- DATA PREP ---------- */
$ekstra_list    = !empty($ekstrakurikuler) ? $ekstrakurikuler : [];
$total_all      = count($ekstra_list);
$total_aktif    = 0;
foreach ($ekstra_list as $e) {
    if (($e->status ?? '') === 'aktif') $total_aktif++;
}
$total_nonaktif = $total_all - $total_aktif;
$foto_dir       = 'uploads/ekstrakurikuler/';

$cell = function ($val) {
    return ($val !== null && trim((string) $val) !== '')
        ? html_escape($val)
        : '<span class="text-subtle">-</span>';
};
?>

<div class="main-content">
    <?php $this->load->view('admin/template/navbar'); ?>

    <div class="content-wrapper">

        <!-- FLASH MESSAGE -->
        <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-custom-success alert-dismissible fade show mb-4 alert-autodismiss" role="alert" data-autodismiss="4500">
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
                    <i class="fa-solid fa-people-group"></i>
                </div>
                <div>
                    <span class="badge-header-tag mb-1">
                        <i class="fa-solid fa-layer-group me-1"></i> Data Kegiatan
                    </span>
                    <h2 class="page-title">Ekstrakurikuler</h2>
                    <p class="page-subtitle">Kelola daftar kegiatan pengembangan minat dan bakat siswa SMA Negeri Tawangmangu.</p>
                </div>
            </div>
            <a href="<?= site_url('admin/ekstrakurikuler/tambah'); ?>" class="btn-add">
                <i class="fa-solid fa-plus me-2"></i>
                Tambah Ekstrakurikuler
            </a>
        </div>

        <!-- TABLE CARD -->
        <div class="custom-card">
            <div class="card-title-custom justify-content-between align-items-center">
                <div class="d-flex align-items-center gap-3">
                    <div class="title-icon">
                        <i class="fa-solid fa-list-check"></i>
                    </div>
                    <div>
                        <h5>Daftar Ekstrakurikuler</h5>
                        <small>Kegiatan aktif dan nonaktif yang terdaftar</small>
                    </div>
                </div>
                <div class="d-flex align-items-center gap-3 flex-wrap toolbar-right">
                    <div class="table-search-group">
                        <i class="fa-solid fa-magnifying-glass table-search-icon"></i>
                        <input type="text" id="ekstra-search-input" class="table-search-input"
                               placeholder="Cari nama, pembina, jadwal, tempat..."
                               autocomplete="off" aria-label="Cari ekstrakurikuler">
                    </div>
                    <div class="total-badge">
                        <i class="fa-solid fa-user-group me-1"></i>
                        <span id="ekstra-count"><?= $total_all; ?></span> Data Terdaftar
                    </div>
                </div>
            </div>

            <?php if ($total_all > 0): ?>
            <!-- FILTER STATUS -->
            <div class="filter-strip">
                <span class="filter-label"><i class="fa-solid fa-filter me-1"></i> Tampilkan</span>
                <div class="filter-chips" role="group" aria-label="Filter status">
                    <button type="button" class="filter-chip active" data-filter="all" aria-pressed="true">
                        <i class="fa-solid fa-layer-group"></i> Semua
                        <span class="chip-count"><?= $total_all; ?></span>
                    </button>
                    <button type="button" class="filter-chip" data-filter="aktif" aria-pressed="false">
                        <i class="fa-solid fa-circle-check"></i> Aktif
                        <span class="chip-count"><?= $total_aktif; ?></span>
                    </button>
                    <button type="button" class="filter-chip" data-filter="nonaktif" aria-pressed="false">
                        <i class="fa-solid fa-circle-xmark"></i> Nonaktif
                        <span class="chip-count"><?= $total_nonaktif; ?></span>
                    </button>
                </div>
            </div>
            <?php endif; ?>

            <div class="table-responsive">
                <table class="table custom-table align-middle mb-0">
                    <thead>
                        <tr>
                            <th width="60" class="text-center">No</th>
                            <th width="80" class="text-center">Foto</th>
                            <th>Nama Kegiatan</th>
                            <th>Pembina</th>
                            <th>Jadwal</th>
                            <th>Tempat</th>
                            <th class="text-center">Status</th>
                            <th width="120" class="text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="ekstra-table-body">
                        <?php if ($total_all > 0): ?>
                            <?php $no = 1; ?>
                            <?php foreach ($ekstra_list as $item): ?>
                                <?php
                                    $is_aktif   = (($item->status ?? '') === 'aktif');
                                    $foto_ok    = !empty($item->foto);
                                    $deskripsi  = trim(strip_tags((string) ($item->deskripsi ?? '')));
                                    $ringkas    = ($deskripsi !== '') ? mb_strimwidth($deskripsi, 0, 52, '…', 'UTF-8') : 'Kegiatan Siswa';
                                    $search_str = mb_strtolower(
                                        ($item->nama ?? '') . ' ' . ($item->pembina ?? '') . ' ' .
                                        ($item->jadwal ?? '') . ' ' . ($item->tempat ?? ''), 'UTF-8'
                                    );
                                ?>
                                <tr class="ekstra-row"
                                    data-status="<?= $is_aktif ? 'aktif' : 'nonaktif'; ?>"
                                    data-search="<?= html_escape($search_str); ?>">

                                    <!-- NO -->
                                    <td class="text-center fw-semibold text-subtle"><?= $no++; ?></td>

                                    <!-- FOTO -->
                                    <td class="text-center">
                                        <?php if ($foto_ok): ?>
                                            <img src="<?= base_url($foto_dir . rawurlencode(basename($item->foto))); ?>"
                                                 alt="<?= html_escape($item->nama); ?>"
                                                 class="ekstra-photo"
                                                 loading="lazy"
                                                 onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                            <div class="ekstra-photo-placeholder mx-auto" style="display:none;">
                                                <i class="fa-solid fa-people-group"></i>
                                            </div>
                                        <?php else: ?>
                                            <div class="ekstra-photo-placeholder mx-auto">
                                                <i class="fa-solid fa-people-group"></i>
                                            </div>
                                        <?php endif; ?>
                                    </td>

                                    <!-- NAMA -->
                                    <td>
                                        <div class="ekstra-name"><?= html_escape($item->nama); ?></div>
                                        <div class="ekstra-desc"><?= html_escape($ringkas); ?></div>
                                    </td>

                                    <!-- PEMBINA -->
                                    <td>
                                        <div class="table-info-cell">
                                            <span class="table-info-icon"><i class="fa-solid fa-user-tie"></i></span>
                                            <span class="fw-medium text-title"><?= $cell($item->pembina ?? null); ?></span>
                                        </div>
                                    </td>

                                    <!-- JADWAL -->
                                    <td>
                                        <div class="table-info-cell">
                                            <span class="table-info-icon"><i class="fa-solid fa-clock"></i></span>
                                            <span><?= $cell($item->jadwal ?? null); ?></span>
                                        </div>
                                    </td>

                                    <!-- TEMPAT -->
                                    <td>
                                        <div class="table-info-cell">
                                            <span class="table-info-icon"><i class="fa-solid fa-location-dot"></i></span>
                                            <span><?= $cell($item->tempat ?? null); ?></span>
                                        </div>
                                    </td>

                                    <!-- STATUS -->
                                    <td class="text-center">
                                        <?php if ($is_aktif): ?>
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
                                            <a href="<?= site_url('admin/ekstrakurikuler/edit/' . $item->id); ?>"
                                               class="btn-action edit" title="Edit Data"
                                               aria-label="Edit <?= html_escape($item->nama); ?>">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                            <button type="button" class="btn-action delete" title="Hapus Data"
                                                    data-url="<?= site_url('admin/ekstrakurikuler/hapus/' . $item->id); ?>"
                                                    data-nama="<?= html_escape($item->nama); ?>"
                                                    aria-label="Hapus <?= html_escape($item->nama); ?>">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>

                            <tr id="ekstra-no-result" class="d-none">
                                <td colspan="8" class="empty-data">
                                    <div class="empty-icon"><i class="fa-solid fa-magnifying-glass"></i></div>
                                    <div class="fw-bold fs-6 mb-1 text-title">Tidak ditemukan</div>
                                    <p class="text-subtle fs-7 mb-0">Tidak ada ekstrakurikuler yang cocok dengan pencarian atau filter.</p>
                                </td>
                            </tr>
                        <?php else: ?>
                            <tr>
                                <td colspan="8" class="empty-data">
                                    <div class="empty-icon"><i class="fa-solid fa-people-group"></i></div>
                                    <div class="fw-bold fs-6 mb-1 text-title">Belum ada data ekstrakurikuler</div>
                                    <p class="text-subtle fs-7 mb-3">Belum ada kegiatan yang terdaftar di sistem.</p>
                                    <a href="<?= site_url('admin/ekstrakurikuler/tambah'); ?>" class="btn-add d-inline-flex ms-0">
                                        <i class="fa-solid fa-plus me-2"></i> Tambahkan Kegiatan Sekarang
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

<!-- MODAL KONFIRMASI HAPUS -->
<div class="confirm-overlay" id="delete-modal" aria-hidden="true">
    <div class="confirm-dialog" role="alertdialog" aria-modal="true" aria-labelledby="delete-title" aria-describedby="delete-desc">
        <div class="confirm-icon"><i class="fa-solid fa-trash-can"></i></div>
        <h5 id="delete-title" class="confirm-title">Hapus ekstrakurikuler?</h5>
        <p id="delete-desc" class="confirm-text">
            Data <strong id="delete-name">-</strong> akan dihapus permanen dan tidak dapat dikembalikan.
        </p>
        <div class="confirm-actions">
            <button type="button" class="btn-cancel-modal" id="delete-cancel">
                <i class="fa-solid fa-xmark me-2"></i> Batal
            </button>
            <button type="button" class="btn-danger-confirm" id="delete-confirm">
                <span class="btn-save-content"><i class="fa-solid fa-trash-can me-2"></i> Ya, Hapus</span>
                <span class="btn-save-spinner" aria-hidden="true"></span>
            </button>
        </div>
    </div>
</div>

<form id="delete-form" action="#" method="POST" class="d-none">
    <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
</form>

<style>
/* =============================================================
   DESIGN SYSTEM — konsisten dengan halaman Guru & Staff
   Prefix: --ekstra (menggantikan --guru di halaman ini)
============================================================= */
:root {
    --ekstra-card-bg:       #ffffff;
    --ekstra-card-subtle:   #f8fafc;
    --ekstra-border:        rgba(226, 232, 240, 0.8);
    --ekstra-title:         #0f172a;
    --ekstra-subtitle:      #64748b;
    --ekstra-hover:         #f8fafc;
    --ekstra-shadow:        0 10px 30px -5px rgba(15, 23, 42, 0.05);
    --ekstra-accent:        #00b4d8;
    --ekstra-accent-soft:   rgba(0, 180, 216, 0.12);
    --ekstra-accent-border: rgba(0, 180, 216, 0.25);
    --ekstra-overlay:       rgba(15, 23, 42, 0.55);
}

[data-bs-theme="dark"],
[data-theme="dark"],
body.dark-mode,
.dark-mode {
    --ekstra-card-bg:       #0f172a;
    --ekstra-card-subtle:   #1e293b;
    --ekstra-border:        rgba(255, 255, 255, 0.1);
    --ekstra-title:         #f8fafc;
    --ekstra-subtitle:      #94a3b8;
    --ekstra-hover:         #1e293b;
    --ekstra-shadow:        0 10px 30px -5px rgba(0, 0, 0, 0.5);
    --ekstra-accent:        #38bdf8;
    --ekstra-accent-soft:   rgba(56, 189, 248, 0.12);
    --ekstra-accent-border: rgba(56, 189, 248, 0.25);
    --ekstra-overlay:       rgba(2, 6, 23, 0.72);
}

.text-title  { color: var(--ekstra-title) !important; }
.text-subtle { color: var(--ekstra-subtitle) !important; }
.fs-7 { font-size: 12px; }

[data-theme="dark"] .btn-close,
body.dark-mode .btn-close,
.dark-mode .btn-close { filter: invert(1) grayscale(100%) brightness(200%); }

/* ----- ALERT ----- */
.alert-custom-success {
    background: rgba(16, 185, 129, 0.15) !important;
    border: 1px solid rgba(16, 185, 129, 0.3) !important;
    color: #34d399 !important;
    border-radius: 16px; padding: 16px 20px;
}
.alert-custom-danger {
    background: rgba(239, 68, 68, 0.12) !important;
    border: 1px solid rgba(239, 68, 68, 0.3) !important;
    color: #f87171 !important;
    border-radius: 16px; padding: 16px 20px;
}
.alert-autodismiss {
    position: relative; overflow: hidden;
    animation: ekstraAlertIn 0.35s cubic-bezier(0.34, 1.56, 0.64, 1);
}
.alert-autodismiss.alert-hiding {
    animation: ekstraAlertOut 0.35s ease forwards;
}
@keyframes ekstraAlertIn  { from { opacity:0; transform:translateY(-14px) scale(0.98); } to { opacity:1; transform:translateY(0) scale(1); } }
@keyframes ekstraAlertOut { to { opacity:0; transform:translateY(-10px) scale(0.98); max-height:0; margin-bottom:0!important; padding-top:0; padding-bottom:0; border-width:0; } }
.alert-progress-track { position:absolute; left:0; right:0; bottom:0; height:3px; background:rgba(148,163,184,0.2); }
.alert-progress-bar { height:100%; width:100%; background:#10b981; transform-origin:left; animation-name:ekstraAlertProgress; animation-timing-function:linear; animation-fill-mode:forwards; }
.alert-progress-bar-error { background:#ef4444; }
@keyframes ekstraAlertProgress { from{transform:scaleX(1);} to{transform:scaleX(0);} }

/* ----- PAGE HEADER ----- */
.page-header-custom {
    position: relative; overflow: hidden;
    background: var(--ekstra-card-bg) !important;
    border: 1px solid var(--ekstra-border) !important;
    border-radius: 20px; padding: 24px 28px;
    display: flex; align-items: center; justify-content: space-between; gap: 20px;
    box-shadow: var(--ekstra-shadow);
}
.page-header-custom::before {
    content:""; position:absolute; inset:0 auto 0 0; width:4px;
    background: linear-gradient(180deg, var(--ekstra-accent), #0369a1);
}
.page-header-icon {
    width:52px; height:52px; border-radius:16px;
    background: var(--ekstra-card-subtle) !important;
    border: 1px solid var(--ekstra-border) !important;
    color: var(--ekstra-accent);
    display:flex; align-items:center; justify-content:center;
    font-size:22px; flex-shrink:0;
    transition: transform 0.35s ease;
}
.page-header-custom:hover .page-header-icon { transform: rotate(-6deg) scale(1.06); }
.badge-header-tag {
    display:inline-flex; align-items:center;
    background: var(--ekstra-accent-soft); color: var(--ekstra-accent);
    border: 1px solid var(--ekstra-accent-border);
    padding:4px 10px; border-radius:20px;
    font-size:11px; font-weight:700; text-transform:uppercase; letter-spacing:0.5px;
}
.page-title   { color: var(--ekstra-title)!important; font-size:22px; font-weight:800; margin:0 0 2px; letter-spacing:-0.3px; }
.page-subtitle{ color: var(--ekstra-subtitle)!important; font-size:13px; margin:0; }

/* ----- BTN ADD ----- */
.btn-add {
    display:inline-flex; align-items:center;
    background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%);
    color:#ffffff!important; text-decoration:none;
    padding:12px 22px; border-radius:12px; font-size:13px; font-weight:700;
    transition:all 0.3s ease;
    box-shadow: 0 6px 18px rgba(2,132,199,0.3); white-space:nowrap;
}
.btn-add:hover { transform:translateY(-2px); box-shadow:0 10px 24px rgba(2,132,199,0.45); }

/* ----- CUSTOM CARD ----- */
.custom-card {
    background: var(--ekstra-card-bg) !important;
    border: 1px solid var(--ekstra-border) !important;
    border-radius:20px; overflow:hidden;
    box-shadow: var(--ekstra-shadow);
    animation: ekstraFadeUp 0.4s ease both;
    transition: box-shadow 0.3s ease, border-color 0.3s ease;
}
.custom-card:hover { border-color: var(--ekstra-accent-border) !important; box-shadow: 0 16px 34px -10px rgba(15,23,42,0.12); }
@keyframes ekstraFadeUp { from{opacity:0;transform:translateY(12px);} to{opacity:1;transform:translateY(0);} }

.card-title-custom {
    display:flex; padding:20px 24px;
    background: var(--ekstra-card-subtle) !important;
    border-bottom: 1px solid var(--ekstra-border) !important;
}
.title-icon {
    width:42px; height:42px;
    background: var(--ekstra-accent-soft);
    border: 1px solid var(--ekstra-accent-border);
    color: var(--ekstra-accent); border-radius:12px;
    display:flex; align-items:center; justify-content:center; font-size:16px; flex-shrink:0;
}
.card-title-custom h5 { margin:0 0 2px; color:var(--ekstra-title)!important; font-size:15px; font-weight:700; }
.card-title-custom small { color:var(--ekstra-subtitle)!important; font-size:12px; }
.total-badge {
    color:var(--ekstra-accent); font-size:12px; font-weight:700;
    background:var(--ekstra-accent-soft);
    border:1px solid var(--ekstra-accent-border);
    padding:6px 14px; border-radius:20px; white-space:nowrap;
}

/* Search */
.table-search-group { position:relative; display:flex; align-items:center; }
.table-search-icon  { position:absolute; left:14px; color:var(--ekstra-subtitle); font-size:13px; pointer-events:none; }
.table-search-input {
    background: var(--ekstra-card-bg) !important;
    border: 1px solid var(--ekstra-border) !important;
    border-radius:10px; padding:8px 14px 8px 36px;
    font-size:13px; color:var(--ekstra-title)!important; min-width:260px;
    transition:all 0.25s ease;
}
.table-search-input::placeholder { color:var(--ekstra-subtitle); opacity:0.75; }
.table-search-input:focus { outline:none; border-color:var(--ekstra-accent)!important; box-shadow:0 0 0 3px var(--ekstra-accent-soft); }

/* Filter chips */
.filter-strip {
    display:flex; align-items:center; gap:12px; flex-wrap:wrap;
    padding:12px 24px; border-bottom:1px solid var(--ekstra-border);
}
.filter-label { color:var(--ekstra-subtitle); font-size:12px; font-weight:600; }
.filter-chips { display:flex; gap:8px; flex-wrap:wrap; }
.filter-chip {
    display:inline-flex; align-items:center; gap:7px;
    padding:6px 12px; border-radius:999px;
    border:1px solid var(--ekstra-border);
    background:var(--ekstra-card-bg);
    color:var(--ekstra-subtitle);
    font-size:12px; font-weight:700; font-family:inherit; cursor:pointer;
    transition:all 0.2s ease;
}
.filter-chip:hover { color:var(--ekstra-accent); border-color:var(--ekstra-accent-border); }
.filter-chip.active { background:var(--ekstra-accent-soft); border-color:var(--ekstra-accent-border); color:var(--ekstra-accent); }
.chip-count {
    min-width:20px; padding:1px 6px; border-radius:999px;
    background:var(--ekstra-card-subtle); font-size:11px; text-align:center;
}
.filter-chip.active .chip-count { background:var(--ekstra-accent); color:#fff; }

/* ----- TABLE ----- */
.custom-table {
    --bs-table-bg: transparent !important;
    --bs-table-color: var(--ekstra-title) !important;
    color:var(--ekstra-title)!important; margin-bottom:0;
}
.custom-table th {
    background:var(--ekstra-card-subtle)!important;
    color:var(--ekstra-subtitle)!important;
    font-size:11px; font-weight:700; text-transform:uppercase; letter-spacing:0.6px;
    padding:16px 20px; border-bottom:1px solid var(--ekstra-border)!important;
    white-space:nowrap;
}
.custom-table td {
    padding:16px 20px;
    border-bottom:1px solid var(--ekstra-border)!important;
    font-size:13.5px; color:var(--ekstra-title)!important; background:transparent!important;
    vertical-align:middle;
}
.custom-table tbody tr { transition:background-color 0.2s ease; }
.custom-table tbody tr:hover { background-color:var(--ekstra-hover)!important; }
.custom-table tbody tr:last-child td { border-bottom:none!important; }

/* Row entrance animation */
.custom-table tbody tr.ekstra-row { animation:ekstraRowIn 0.3s ease both; }
.custom-table tbody tr.ekstra-row:nth-child(1) { animation-delay:0.02s; }
.custom-table tbody tr.ekstra-row:nth-child(2) { animation-delay:0.05s; }
.custom-table tbody tr.ekstra-row:nth-child(3) { animation-delay:0.08s; }
.custom-table tbody tr.ekstra-row:nth-child(4) { animation-delay:0.11s; }
.custom-table tbody tr.ekstra-row:nth-child(5) { animation-delay:0.14s; }
.custom-table tbody tr.ekstra-row:nth-child(n+6) { animation-delay:0.16s; }
@keyframes ekstraRowIn { from{opacity:0;transform:translateX(-6px);} to{opacity:1;transform:translateX(0);} }

/* Photo */
.ekstra-photo,
.ekstra-photo-placeholder {
    width:44px; height:44px; border-radius:12px; object-fit:cover;
}
.ekstra-photo { border:1px solid var(--ekstra-border); transition:transform 0.25s ease; }
.custom-table tbody tr:hover .ekstra-photo { transform:scale(1.08); }
.ekstra-photo-placeholder {
    background:var(--ekstra-card-subtle)!important;
    border:1px solid var(--ekstra-border)!important;
    color:var(--ekstra-accent);
    display:flex; align-items:center; justify-content:center; font-size:18px;
}
.ekstra-name { color:var(--ekstra-title)!important; font-weight:700; font-size:14px; }
.ekstra-desc { color:var(--ekstra-subtitle)!important; font-size:11.5px; margin-top:2px; }

/* Info cell */
.table-info-cell { display:flex; align-items:center; gap:10px; }
.table-info-icon {
    width:28px; height:28px; border-radius:8px;
    background:var(--ekstra-card-subtle);
    border:1px solid var(--ekstra-border);
    color:var(--ekstra-subtitle);
    display:inline-flex; align-items:center; justify-content:center;
    font-size:11px; flex-shrink:0;
}

/* Status badge */
.status-badge {
    display:inline-flex; align-items:center;
    padding:5px 12px; border-radius:20px; font-size:11.5px; font-weight:700; white-space:nowrap;
}
.status-badge.active {
    background:rgba(16,185,129,0.15)!important;
    color:#34d399!important;
    border:1px solid rgba(16,185,129,0.3)!important;
    position:relative;
}
.status-badge.active::before {
    content:""; width:6px; height:6px; border-radius:50%;
    background:#10b981; display:inline-block; margin-right:5px;
    animation: ekstraPulse 1.8s ease-in-out infinite;
}
.status-badge.active i { display:none; }
.status-badge.inactive {
    background:rgba(239,68,68,0.15)!important;
    color:#f87171!important;
    border:1px solid rgba(239,68,68,0.3)!important;
}
@keyframes ekstraPulse {
    0%,100% { opacity:1; box-shadow:0 0 0 0 rgba(16,185,129,0.5); }
    50% { opacity:0.7; box-shadow:0 0 0 3px rgba(16,185,129,0); }
}

/* Action buttons */
.action-buttons { display:flex; gap:8px; }
.btn-action {
    width:36px; height:36px; border-radius:10px;
    display:inline-flex; align-items:center; justify-content:center;
    text-decoration:none; font-size:13px; padding:0; cursor:pointer;
    transition:all 0.25s ease; border:none;
}
.btn-action.edit {
    background:var(--ekstra-card-subtle)!important;
    color:var(--ekstra-title)!important;
    border:1px solid var(--ekstra-border)!important;
}
.btn-action.edit:hover { background:var(--ekstra-accent)!important; color:#fff!important; border-color:var(--ekstra-accent)!important; transform:translateY(-2px); }
.btn-action.delete {
    background:rgba(239,68,68,0.12)!important;
    color:#f87171!important;
    border:1px solid rgba(239,68,68,0.2)!important;
}
.btn-action.delete:hover { background:#ef4444!important; color:#fff!important; border-color:#ef4444!important; transform:translateY(-2px); }

/* Empty state */
.empty-data { text-align:center; padding:60px 20px!important; background:transparent!important; }
.empty-icon {
    width:64px; height:64px; margin:0 auto 16px; border-radius:50%;
    background:var(--ekstra-card-subtle)!important; border:1px solid var(--ekstra-border)!important;
    display:flex; align-items:center; justify-content:center; color:var(--ekstra-subtitle); font-size:26px;
}

/* ----- MODAL HAPUS ----- */
.confirm-overlay {
    position:fixed; inset:0; z-index:2050;
    display:flex; align-items:center; justify-content:center; padding:20px;
    background:var(--ekstra-overlay); backdrop-filter:blur(4px);
    opacity:0; visibility:hidden; transition:opacity 0.25s ease, visibility 0.25s ease;
}
.confirm-overlay.show { opacity:1; visibility:visible; }
.confirm-dialog {
    width:100%; max-width:400px;
    background:var(--ekstra-card-bg); border:1px solid var(--ekstra-border);
    border-radius:20px; padding:28px 26px 22px; text-align:center;
    box-shadow:0 25px 60px -12px rgba(0,0,0,0.45);
    transform:translateY(16px) scale(0.96);
    transition:transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
}
.confirm-overlay.show .confirm-dialog { transform:none; }
.confirm-icon {
    width:60px; height:60px; margin:0 auto 16px; border-radius:18px;
    background:rgba(239,68,68,0.12); border:1px solid rgba(239,68,68,0.25);
    color:#f87171; display:flex; align-items:center; justify-content:center; font-size:24px;
}
.confirm-title { color:var(--ekstra-title); font-size:17px; font-weight:800; margin:0 0 6px; }
.confirm-text  { color:var(--ekstra-subtitle); font-size:13px; line-height:1.6; margin:0; }
.confirm-text strong { color:var(--ekstra-title); }
.confirm-actions { display:flex; gap:10px; margin-top:22px; }
.confirm-actions > * { flex:1; }

.btn-cancel-modal {
    display:inline-flex; align-items:center; justify-content:center;
    background:var(--ekstra-card-subtle); border:1px solid var(--ekstra-border);
    color:var(--ekstra-title); border-radius:12px; padding:11px 22px;
    font-size:13px; font-weight:600; font-family:inherit; cursor:pointer; transition:all 0.2s ease;
}
.btn-cancel-modal:hover { background:var(--ekstra-hover); color:#ef4444; }

.btn-danger-confirm {
    position:relative; overflow:hidden;
    display:inline-flex; align-items:center; justify-content:center;
    border:none; background:linear-gradient(135deg, #ef4444 0%, #b91c1c 100%);
    color:#fff; border-radius:12px; padding:11px 22px;
    font-size:13px; font-weight:700; font-family:inherit; cursor:pointer;
    transition:all 0.3s ease; box-shadow:0 4px 15px rgba(239,68,68,0.3);
}
.btn-danger-confirm:hover { transform:translateY(-2px); box-shadow:0 8px 22px rgba(239,68,68,0.45); }
.btn-save-content { display:inline-flex; align-items:center; transition:opacity 0.2s ease; }
.btn-save-spinner {
    position:absolute; top:50%; left:50%;
    width:18px; height:18px; margin:-9px 0 0 -9px;
    border:2.5px solid rgba(255,255,255,0.35); border-top-color:#fff;
    border-radius:50%; opacity:0; animation:ekstraSpin 0.7s linear infinite;
}
.is-loading { pointer-events:none!important; }
.is-loading .btn-save-content { opacity:0!important; }
.is-loading .btn-save-spinner { opacity:1!important; }
@keyframes ekstraSpin { to { transform:rotate(360deg); } }

/* Focus visible */
.btn-add:focus-visible, .btn-action:focus-visible, .filter-chip:focus-visible,
.btn-cancel-modal:focus-visible, .btn-danger-confirm:focus-visible {
    outline:2px solid var(--ekstra-accent); outline-offset:2px;
}

/* ----- RESPONSIVE ----- */
@media (max-width: 768px) {
    .page-header-custom { flex-direction:column; align-items:stretch; }
    .btn-add { justify-content:center; }
    .card-title-custom { flex-direction:column; align-items:flex-start!important; }
    .toolbar-right { width:100%; justify-content:space-between; }
    .table-search-input { width:100%; min-width:0; }
    .filter-strip { padding:12px 18px; }
}

@media (prefers-reduced-motion: reduce) {
    .alert-autodismiss, .custom-card, .ekstra-row, .page-header-icon,
    .ekstra-photo, .confirm-dialog { animation:none!important; transition:none!important; }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {

    /* ---- Auto-dismiss alert ---- */
    document.querySelectorAll('.alert-autodismiss').forEach(function (el) {
        var duration = parseInt(el.getAttribute('data-autodismiss'), 10) || 5000;
        var bar = el.querySelector('.alert-progress-bar');
        if (bar) bar.style.animationDuration = duration + 'ms';

        var done = false, remaining = duration, startedAt = Date.now(), timer;

        function closeAlert() {
            if (done) return; done = true;
            clearTimeout(timer);
            el.classList.add('alert-hiding');
            setTimeout(function () { if (el.parentNode) el.parentNode.removeChild(el); }, 400);
        }

        timer = setTimeout(closeAlert, remaining);

        el.addEventListener('mouseenter', function () {
            clearTimeout(timer); remaining -= (Date.now() - startedAt);
            if (bar) bar.style.animationPlayState = 'paused';
        });
        el.addEventListener('mouseleave', function () {
            if (bar) bar.style.animationPlayState = 'running';
            startedAt = Date.now(); timer = setTimeout(closeAlert, Math.max(remaining, 800));
        });

        var closeBtn = el.querySelector('.btn-close');
        if (closeBtn) closeBtn.addEventListener('click', function (e) { e.preventDefault(); closeAlert(); });
    });

    /* ---- Search + filter ---- */
    var searchInput  = document.getElementById('ekstra-search-input');
    var tbody        = document.getElementById('ekstra-table-body');
    var countEl      = document.getElementById('ekstra-count');
    var noResultRow  = document.getElementById('ekstra-no-result');
    var chips        = document.querySelectorAll('.filter-chip');
    var activeFilter = 'all';

    function applyFilter() {
        if (!tbody) return;
        var keyword = (searchInput ? searchInput.value : '').trim().toLowerCase();
        var rows    = tbody.querySelectorAll('.ekstra-row');
        var visible = 0;

        rows.forEach(function (row) {
            var okStatus = activeFilter === 'all' || row.getAttribute('data-status') === activeFilter;
            var okText   = (row.getAttribute('data-search') || '').indexOf(keyword) !== -1;
            var show     = okStatus && okText;
            row.classList.toggle('d-none', !show);
            if (show) visible++;
        });

        if (countEl) countEl.textContent = visible;
        if (noResultRow) noResultRow.classList.toggle('d-none', visible !== 0 || rows.length === 0);
    }

    if (searchInput) {
        searchInput.addEventListener('input', applyFilter);
        searchInput.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && searchInput.value) { searchInput.value = ''; applyFilter(); }
        });
        document.addEventListener('keydown', function (e) {
            var tag = (document.activeElement && document.activeElement.tagName) || '';
            if (e.key === '/' && !/INPUT|TEXTAREA|SELECT/.test(tag) && !e.ctrlKey && !e.metaKey) {
                e.preventDefault(); searchInput.focus();
            }
        });
    }

    chips.forEach(function (chip) {
        chip.addEventListener('click', function () {
            activeFilter = chip.getAttribute('data-filter');
            chips.forEach(function (c) {
                var on = c === chip;
                c.classList.toggle('active', on);
                c.setAttribute('aria-pressed', on ? 'true' : 'false');
            });
            applyFilter();
        });
    });

    /* ---- Modal hapus ---- */
    var modal      = document.getElementById('delete-modal');
    var deleteForm = document.getElementById('delete-form');
    var nameEl     = document.getElementById('delete-name');
    var btnCancel  = document.getElementById('delete-cancel');
    var btnConfirm = document.getElementById('delete-confirm');
    var lastFocus  = null;

    function openModal(url, nama) {
        lastFocus = document.activeElement;
        deleteForm.setAttribute('action', url);
        nameEl.textContent = nama;
        btnConfirm.classList.remove('is-loading');
        modal.classList.add('show');
        modal.setAttribute('aria-hidden', 'false');
        document.body.style.overflow = 'hidden';
        setTimeout(function () { btnCancel.focus(); }, 60);
    }

    function closeModal() {
        modal.classList.remove('show');
        modal.setAttribute('aria-hidden', 'true');
        document.body.style.overflow = '';
        if (lastFocus && lastFocus.focus) lastFocus.focus();
    }

    if (tbody && modal) {
        tbody.addEventListener('click', function (e) {
            var btn = e.target.closest('.btn-action.delete');
            if (!btn) return;
            openModal(btn.getAttribute('data-url'), btn.getAttribute('data-nama'));
        });

        btnCancel.addEventListener('click', closeModal);
        modal.addEventListener('click', function (e) { if (e.target === modal) closeModal(); });

        btnConfirm.addEventListener('click', function () {
            btnConfirm.classList.add('is-loading');
            deleteForm.submit();
        });

        document.addEventListener('keydown', function (e) {
            if (!modal.classList.contains('show')) return;
            if (e.key === 'Escape') { closeModal(); return; }
            if (e.key === 'Tab') {
                var first = btnCancel, last = btnConfirm;
                if (e.shiftKey && document.activeElement === first) { e.preventDefault(); last.focus(); }
                else if (!e.shiftKey && document.activeElement === last) { e.preventDefault(); first.focus(); }
            }
        });

        window.addEventListener('pageshow', function (e) {
            if (e.persisted) { btnConfirm.classList.remove('is-loading'); closeModal(); }
        });
    }
});
</script>

<?php $this->load->view('admin/template/footer'); ?>