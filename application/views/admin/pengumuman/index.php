<?php
/**
 * Helper lokal: format tile tanggal (hari besar, bulan singkat ID, tahun)
 */
if (!function_exists('peng_format_tanggal')) {
    function peng_format_tanggal($tgl)
    {
        $bulan = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
        $ts = !empty($tgl) ? strtotime($tgl) : false;
        if (!$ts) {
            return ['day' => '--', 'month' => '---', 'year' => '----'];
        }
        return [
            'day'   => date('d', $ts),
            'month' => $bulan[(int) date('n', $ts) - 1],
            'year'  => date('Y', $ts),
        ];
    }
}
?>
<?php $this->load->view('admin/template/header'); ?>
<?php $this->load->view('admin/template/sidebar'); ?>

<div class="main-content">
    <?php $this->load->view('admin/template/navbar'); ?>

    <div class="content-wrapper">

        <!-- FLASH MESSAGE: SUCCESS -->
        <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-autodismiss is-success" role="alert" data-autodismiss="4500">
                <div class="alert-icon-box"><i class="fa-solid fa-circle-check"></i></div>
                <div class="alert-content">
                    <strong>Berhasil</strong>
                    <span><?= html_escape($this->session->flashdata('success')); ?></span>
                </div>
                <button type="button" class="btn-close" aria-label="Tutup notifikasi"></button>
                <div class="alert-progress-track"><div class="alert-progress-bar"></div></div>
            </div>
        <?php endif; ?>

        <!-- FLASH MESSAGE: ERROR -->
        <?php if ($this->session->flashdata('error')): ?>
            <div class="alert alert-autodismiss is-error" role="alert" data-autodismiss="6000">
                <div class="alert-icon-box"><i class="fa-solid fa-circle-exclamation"></i></div>
                <div class="alert-content">
                    <strong>Gagal memproses data</strong>
                    <span><?= html_escape($this->session->flashdata('error')); ?></span>
                </div>
                <button type="button" class="btn-close" aria-label="Tutup notifikasi"></button>
                <div class="alert-progress-track"><div class="alert-progress-bar"></div></div>
            </div>
        <?php endif; ?>

        <!-- HEADER HALAMAN -->
        <div class="page-header-custom mb-4">
            <div class="d-flex align-items-center gap-3">
                <div class="page-header-icon">
                    <i class="fa-solid fa-bullhorn"></i>
                </div>
                <div>
                    <span class="badge-header-tag mb-1">
                        <i class="fa-solid fa-layer-group me-1"></i> Manajemen Konten
                    </span>
                    <h2 class="page-title">Pengumuman</h2>
                    <p class="page-subtitle">Kelola pengumuman resmi SMA Negeri Tawangmangu.</p>
                </div>
            </div>
            <a href="<?= site_url('admin/pengumuman/tambah'); ?>" class="btn-add">
                <i class="fa-solid fa-plus me-2"></i>
                Tambah Pengumuman
            </a>
        </div>

        <!-- DATA PENGUMUMAN -->
        <div class="custom-card">
            <div class="card-title-custom justify-content-between align-items-center">
                <div class="d-flex align-items-center gap-3">
                    <div class="title-icon">
                        <i class="fa-solid fa-bullhorn"></i>
                    </div>
                    <div>
                        <h5>Daftar Pengumuman</h5>
                        <small>Seluruh pengumuman yang tercatat di sistem</small>
                    </div>
                </div>
                <div class="d-flex align-items-center gap-3 flex-wrap toolbar-right">
                    <div class="filter-chip-group" role="group" aria-label="Filter status pengumuman">
                        <button type="button" class="filter-chip is-active" data-filter="semua">Semua</button>
                        <button type="button" class="filter-chip" data-filter="aktif">Aktif</button>
                        <button type="button" class="filter-chip" data-filter="nonaktif">Nonaktif</button>
                    </div>
                    <div class="table-search-group">
                        <i class="fa-solid fa-magnifying-glass table-search-icon"></i>
                        <input type="text" id="peng-search-input" class="table-search-input" placeholder="Cari judul atau isi...">
                    </div>
                    <div class="total-badge">
                        <i class="fa-solid fa-bullhorn me-1"></i>
                        <span id="peng-count"><?= count($pengumuman); ?></span> Pengumuman
                    </div>
                </div>
            </div>

            <div class="peng-list-body" id="peng-list-body">
                <?php if (!empty($pengumuman)): ?>
                    <?php $i = 0; ?>
                    <?php foreach ($pengumuman as $item): ?>
                        <?php
                            $tgl = peng_format_tanggal($item->tanggal ?? null);
                            $status_raw = strtolower(trim((string) ($item->status ?? 'draft')));
                            $status_val = in_array($status_raw, array('aktif', 'publish', '1'), TRUE) ? 'aktif' : 'nonaktif';
                            $isi_plain  = trim(strip_tags($item->isi ?? ''));
                            $search_str = strtolower(($item->judul ?? '') . ' ' . $isi_plain);
                            $i++;
                        ?>
                        <div class="peng-item"
                             style="--i:<?= min($i, 8); ?>;"
                             data-status="<?= html_escape($status_val); ?>"
                             data-search="<?= html_escape($search_str); ?>">

                            <!-- TILE TANGGAL -->
                            <div class="peng-date-tile">
                                <span class="peng-date-day"><?= html_escape($tgl['day']); ?></span>
                                <span class="peng-date-month"><?= html_escape($tgl['month']); ?></span>
                                <span class="peng-date-year"><?= html_escape($tgl['year']); ?></span>
                            </div>

                            <!-- KONTEN -->
                            <div class="peng-content">
                                <div class="peng-content-top">
                                    <h3 class="peng-title"><?= html_escape($item->judul ?? '-'); ?></h3>
                                    <?php if ($status_val === 'aktif'): ?>
                                        <span class="status-badge active">
                                            <i class="fa-solid fa-circle-check me-1"></i> Aktif
                                        </span>
                                    <?php else: ?>
                                        <span class="status-badge inactive">
                                            <i class="fa-solid fa-circle-xmark me-1"></i> Nonaktif
                                        </span>
                                    <?php endif; ?>
                                </div>
                                <p class="peng-excerpt">
                                    <?= !empty($isi_plain) ? html_escape($isi_plain) : '<span class="text-subtle">Tidak ada isi pengumuman.</span>'; ?>
                                </p>
                                <div class="peng-footer">
                                    <div class="action-buttons">
                                        <a href="<?= site_url('admin/pengumuman/edit/' . $item->id); ?>" class="btn-action edit" title="Edit Pengumuman" aria-label="Edit pengumuman <?= html_escape($item->judul ?? ''); ?>">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        <a href="<?= site_url('admin/pengumuman/hapus/' . $item->id); ?>" class="btn-action delete" title="Hapus Pengumuman" aria-label="Hapus pengumuman <?= html_escape($item->judul ?? ''); ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus pengumuman ini?');">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>

                    <div id="peng-no-result" class="empty-data d-none">
                        <div class="empty-icon"><i class="fa-solid fa-magnifying-glass"></i></div>
                        <div class="fw-bold fs-6 mb-1 text-title">Tidak ditemukan</div>
                        <p class="text-subtle fs-7 mb-0">Tidak ada pengumuman yang cocok dengan pencarian atau filter.</p>
                    </div>
                <?php else: ?>
                    <div class="empty-data">
                        <div class="empty-icon"><i class="fa-solid fa-bullhorn"></i></div>
                        <div class="fw-bold fs-6 mb-1 text-title">Belum ada pengumuman</div>
                        <p class="text-subtle fs-7 mb-3">Sistem belum mencatat pengumuman apa pun.</p>
                        <a href="<?= site_url('admin/pengumuman/tambah'); ?>" class="btn-add d-inline-flex ms-0">
                            <i class="fa-solid fa-plus me-2"></i> Tambahkan Pengumuman Sekarang
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>

    </div>
</div>

<style>
/* =====================================================================
   DESIGN TOKENS
===================================================================== */
:root {
    --peng-card: #ffffff;
    --peng-subtle: #f8fafc;
    --peng-input-bg: #f8fafc;
    --peng-input-focus: #ffffff;
    --peng-input-border: #cbd5e1;
    --peng-border: rgba(226, 232, 240, .8);
    --peng-title: #0f172a;
    --peng-subtitle: #64748b;
    --peng-hover: #f1f5f9;
    --peng-accent: #0ea5e9;
    --peng-glow: rgba(14, 165, 233, .25);
    --peng-soft: rgba(14, 165, 233, .10);
    --peng-soft-border: rgba(14, 165, 233, .22);
    --peng-icon-muted: #94a3b8;
    --peng-success: #059669;
    --peng-danger: #dc2626;
    --peng-shadow: 0 10px 25px -5px rgba(15, 23, 42, .05), 0 8px 10px -6px rgba(15, 23, 42, .02);
}

[data-bs-theme="dark"], [data-theme="dark"], body.dark-mode, .dark-mode {
    --peng-card: #0f172a;
    --peng-subtle: #1e293b;
    --peng-input-bg: #1e293b;
    --peng-input-focus: #111827;
    --peng-input-border: rgba(255, 255, 255, .12);
    --peng-border: rgba(255, 255, 255, .08);
    --peng-title: #f8fafc;
    --peng-subtitle: #94a3b8;
    --peng-hover: #1e293b;
    --peng-accent: #38bdf8;
    --peng-glow: rgba(56, 189, 248, .25);
    --peng-soft: rgba(56, 189, 248, .10);
    --peng-soft-border: rgba(56, 189, 248, .22);
    --peng-icon-muted: #64748b;
    --peng-success: #34d399;
    --peng-danger: #f87171;
    --peng-shadow: 0 12px 30px -5px rgba(0, 0, 0, .4);
}

.text-title { color: var(--peng-title) !important; }
.text-subtle { color: var(--peng-subtitle) !important; }
.fs-7 { font-size: 12px; }

/* =====================================================================
   FLASH MESSAGE (AUTO-DISMISS)
===================================================================== */
.alert.alert-autodismiss {
    position: relative;
    display: flex;
    align-items: flex-start;
    gap: 14px;
    overflow: hidden;
    border-radius: 16px;
    padding: 16px 44px 16px 18px;
    margin-bottom: 20px;
    border: 1px solid transparent;
    animation: pengAlertIn .35s cubic-bezier(.34, 1.56, .64, 1);
}
.alert-autodismiss.is-success {
    background: rgba(16, 185, 129, .12);
    border-color: rgba(16, 185, 129, .3);
    color: var(--peng-success);
}
.alert-autodismiss.is-error {
    background: rgba(239, 68, 68, .12);
    border-color: rgba(239, 68, 68, .3);
    color: var(--peng-danger);
}
@keyframes pengAlertIn {
    from { opacity: 0; transform: translateY(-14px) scale(.98); }
    to { opacity: 1; transform: translateY(0) scale(1); }
}
.alert-autodismiss.alert-hiding {
    animation: pengAlertOut .35s ease forwards;
}
@keyframes pengAlertOut {
    to { opacity: 0; transform: translateY(-10px) scale(.98); margin-bottom: 0 !important; max-height: 0; padding-top: 0; padding-bottom: 0; }
}
.alert-icon-box {
    width: 36px; height: 36px; flex-shrink: 0;
    border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    font-size: 17px;
    background: currentColor;
}
.alert-icon-box i { color: var(--peng-card); }
.alert-content { display: flex; flex-direction: column; gap: 2px; }
.alert-content strong { font-size: 13.5px; font-weight: 800; }
.alert-content span { font-size: 13px; color: var(--peng-title); opacity: .85; }
.alert-autodismiss .btn-close {
    position: absolute; top: 14px; right: 14px;
    width: 22px; height: 22px;
    border: none; background: transparent;
    opacity: .6; cursor: pointer;
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23000'%3e%3cpath d='M.293.293a1 1 0 011.414 0L8 6.586 14.293.293a1 1 0 111.414 1.414L9.414 8l6.293 6.293a1 1 0 01-1.414 1.414L8 9.414l-6.293 6.293a1 1 0 01-1.414-1.414L6.586 8 .293 1.707a1 1 0 010-1.414z'/%3e%3c/svg%3e");
    background-repeat: no-repeat; background-position: center; background-size: 12px;
    filter: var(--peng-close-filter, none);
}
[data-bs-theme="dark"] .alert-autodismiss .btn-close,
[data-theme="dark"] .alert-autodismiss .btn-close,
body.dark-mode .alert-autodismiss .btn-close,
.dark-mode .alert-autodismiss .btn-close { filter: invert(1); }
.alert-autodismiss .btn-close:hover { opacity: 1; }
.alert-progress-track {
    position: absolute; left: 0; right: 0; bottom: 0;
    height: 3px; background: rgba(148, 163, 184, .2);
}
.alert-progress-bar {
    height: 100%; width: 100%;
    background: currentColor;
    transform-origin: left;
    animation-name: pengAlertProgress;
    animation-timing-function: linear;
    animation-fill-mode: forwards;
}
@keyframes pengAlertProgress { from { transform: scaleX(1); } to { transform: scaleX(0); } }

/* =====================================================================
   PAGE HEADER
===================================================================== */
.page-header-custom {
    position: relative;
    overflow: hidden;
    background: var(--peng-card);
    border: 1px solid var(--peng-border);
    border-radius: 20px;
    padding: 22px 28px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    box-shadow: var(--peng-shadow);
    gap: 20px;
}
.page-header-custom::before {
    content: "";
    position: absolute; inset: 0 auto 0 0;
    width: 4px;
    background: linear-gradient(180deg, var(--peng-accent), #0369a1);
}

.page-header-icon {
    width: 52px; height: 52px; border-radius: 16px;
    background: var(--peng-soft);
    border: 1px solid var(--peng-soft-border);
    color: var(--peng-accent);
    display: flex; align-items: center; justify-content: center;
    font-size: 22px; flex-shrink: 0;
    transition: transform .35s ease;
}
.page-header-custom:hover .page-header-icon { transform: rotate(-6deg) scale(1.06); }
.badge-header-tag {
    display: inline-flex; align-items: center;
    background: var(--peng-soft);
    color: var(--peng-accent);
    border: 1px solid var(--peng-soft-border);
    padding: 4px 10px; border-radius: 20px;
    font-size: 10.5px; font-weight: 800; text-transform: uppercase; letter-spacing: .5px;
}
.page-title { color: var(--peng-title); font-size: 22px; font-weight: 800; margin: 0 0 2px; letter-spacing: -.3px; }
.page-subtitle { color: var(--peng-subtitle); font-size: 13px; margin: 0; }

/* =====================================================================
   BUTTONS
===================================================================== */
.btn-add {
    display: inline-flex; align-items: center;
    background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%);
    color: #ffffff; text-decoration: none;
    padding: 11px 20px; border-radius: 12px;
    font-size: 12.5px; font-weight: 700;
    transition: all .3s ease;
    box-shadow: 0 6px 18px rgba(2, 132, 199, .28);
    white-space: nowrap; position: relative; z-index: 1;
}
.btn-add:hover { transform: translateY(-2px); box-shadow: 0 10px 24px rgba(2, 132, 199, .45); color: #fff; }

.btn-action {
    width: 36px; height: 36px; border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    text-decoration: none; font-size: 13px;
    transition: all .25s ease;
}
.btn-action.edit { background: var(--peng-subtle); color: var(--peng-title); border: 1px solid var(--peng-border); }
.btn-action.edit:hover { background: var(--peng-accent); color: #fff; border-color: var(--peng-accent); transform: translateY(-2px); }
.btn-action.delete { background: rgba(239, 68, 68, .10); color: var(--peng-danger); border: 1px solid rgba(239, 68, 68, .2); }
.btn-action.delete:hover { background: #ef4444; color: #fff; border-color: #ef4444; transform: translateY(-2px); }
.action-buttons { display: flex; gap: 8px; }

/* =====================================================================
   CARD
===================================================================== */
.custom-card {
    background: var(--peng-card);
    border: 1px solid var(--peng-border);
    border-radius: 20px;
    overflow: hidden;
    box-shadow: var(--peng-shadow);
    animation: pengFadeUp .4s ease both;
}
@keyframes pengFadeUp { from { opacity: 0; transform: translateY(12px); } to { opacity: 1; transform: translateY(0); } }
.card-title-custom { display: flex; padding: 20px 24px; background: var(--peng-subtle); border-bottom: 1px solid var(--peng-border); }
.title-icon {
    width: 42px; height: 42px; background: var(--peng-soft); border: 1px solid var(--peng-soft-border);
    color: var(--peng-accent); border-radius: 12px;
    display: flex; align-items: center; justify-content: center; font-size: 16px; flex-shrink: 0;
}
.card-title-custom h5 { margin: 0 0 2px; color: var(--peng-title); font-size: 15px; font-weight: 700; }
.card-title-custom small { color: var(--peng-subtitle); font-size: 12px; }
.total-badge {
    color: var(--peng-accent); font-size: 12px; background: var(--peng-soft);
    border: 1px solid var(--peng-soft-border); padding: 6px 14px; border-radius: 20px; font-weight: 700; white-space: nowrap;
}

/* =====================================================================
   SEARCH & FILTER TOOLBAR
===================================================================== */
.table-search-group { position: relative; display: flex; align-items: center; }
.table-search-icon { position: absolute; left: 14px; color: var(--peng-subtitle); font-size: 13px; pointer-events: none; }
.table-search-input {
    background: var(--peng-input-bg); border: 1px solid var(--peng-input-border);
    border-radius: 10px; padding: 8px 14px 8px 36px; font-size: 13px; color: var(--peng-title);
    min-width: 220px; transition: all .25s ease;
}
.table-search-input::placeholder { color: var(--peng-subtitle); opacity: .75; }
.table-search-input:focus { outline: none; border-color: var(--peng-accent); box-shadow: 0 0 0 3px var(--peng-glow); background: var(--peng-input-focus); }

.filter-chip-group { display: inline-flex; align-items: center; gap: 4px; padding: 4px; border: 1px solid var(--peng-border); border-radius: 999px; background: var(--peng-input-bg); }
.filter-chip {
    border: none; background: transparent; color: var(--peng-subtitle);
    font-size: 12px; font-weight: 700; padding: 6px 14px; border-radius: 999px;
    cursor: pointer; transition: all .2s ease;
}
.filter-chip:hover { color: var(--peng-title); }
.filter-chip.is-active { background: var(--peng-soft); color: var(--peng-accent); box-shadow: inset 0 0 0 1px var(--peng-soft-border); }

/* =====================================================================
   STATUS BADGE
===================================================================== */
.status-badge { display: inline-flex; align-items: center; padding: 5px 12px; border-radius: 20px; font-size: 11.5px; font-weight: 700; white-space: nowrap; }
.status-badge.active { background: rgba(16, 185, 129, .15); color: #10b981; border: 1px solid rgba(16, 185, 129, .3); }
.status-badge.inactive { background: rgba(239, 68, 68, .15); color: var(--peng-danger); border: 1px solid rgba(239, 68, 68, .3); }
.status-badge.active i, .status-badge.inactive i { font-size: 10px; }

/* =====================================================================
   DAFTAR KARTU VERTIKAL (LIST)
===================================================================== */
.peng-list-body { padding: 10px 16px 16px; display: flex; flex-direction: column; }
.peng-item {
    display: flex; gap: 18px;
    padding: 18px 8px;
    border-bottom: 1px solid var(--peng-border);
    animation: pengRowIn .3s ease both;
    animation-delay: calc(var(--i, 1) * .05s);
    transition: background-color .2s ease;
}
.peng-item:last-child { border-bottom: none; }
.peng-item:hover { background: var(--peng-hover); border-radius: 14px; }
@keyframes pengRowIn { from { opacity: 0; transform: translateX(-6px); } to { opacity: 1; transform: translateX(0); } }

.peng-date-tile {
    flex-shrink: 0;
    width: 66px; height: 74px;
    border-radius: 14px;
    background: var(--peng-soft);
    border: 1px solid var(--peng-soft-border);
    display: flex; flex-direction: column; align-items: center; justify-content: center;
    color: var(--peng-accent);
}
.peng-date-day { font-size: 20px; font-weight: 800; line-height: 1.1; }
.peng-date-month { font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: .4px; }
.peng-date-year { font-size: 10px; color: var(--peng-subtitle); }

.peng-content { flex: 1; min-width: 0; display: flex; flex-direction: column; gap: 8px; }
.peng-content-top { display: flex; align-items: flex-start; justify-content: space-between; gap: 12px; flex-wrap: wrap; }
.peng-title { margin: 0; font-size: 15px; font-weight: 700; color: var(--peng-title); }
.peng-excerpt {
    margin: 0; font-size: 13px; line-height: 1.6; color: var(--peng-subtitle);
    display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;
}
.peng-footer { display: flex; justify-content: flex-end; padding-top: 4px; border-top: 1px dashed var(--peng-border); margin-top: 2px; }

/* =====================================================================
   EMPTY STATE
===================================================================== */
.empty-data { text-align: center; padding: 60px 20px; }
.empty-icon {
    width: 64px; height: 64px; margin: 0 auto 16px; border-radius: 18px;
    background: var(--peng-soft); border: 1px solid var(--peng-soft-border);
    display: flex; align-items: center; justify-content: center;
    color: var(--peng-accent); font-size: 26px;
}

/* =====================================================================
   RESPONSIVE
===================================================================== */
@media (max-width: 768px) {
    .page-header-custom { flex-direction: column; align-items: stretch; }
    .btn-add { justify-content: center; }
    .card-title-custom { flex-direction: column; align-items: flex-start !important; gap: 12px; }
    .toolbar-right { width: 100%; flex-direction: column; align-items: stretch !important; }
    .table-search-group, .filter-chip-group { width: 100%; justify-content: center; }
    .table-search-input { min-width: 0; width: 100%; }
    .peng-item { flex-direction: column; }
    .peng-date-tile { flex-direction: row; width: fit-content; height: auto; padding: 6px 12px; gap: 6px; }
}

@media (prefers-reduced-motion: reduce) {
    .alert-autodismiss, .custom-card, .peng-item, .page-header-icon { animation: none !important; transition: none !important; }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // ---------- AUTO-DISMISS FLASH MESSAGE ----------
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

    // ---------- SEARCH + FILTER ----------
    var searchInput = document.getElementById('peng-search-input');
    var listBody = document.getElementById('peng-list-body');
    var countEl = document.getElementById('peng-count');
    var noResultEl = document.getElementById('peng-no-result');
    var chips = document.querySelectorAll('.filter-chip');
    var activeFilter = 'semua';

    function applyFilter() {
        if (!listBody) return;
        var keyword = (searchInput ? searchInput.value.trim().toLowerCase() : '');
        var items = listBody.querySelectorAll('.peng-item');
        var visibleCount = 0;

        items.forEach(function (item) {
            var matchSearch = item.getAttribute('data-search').indexOf(keyword) !== -1;
            var matchFilter = (activeFilter === 'semua') || (item.getAttribute('data-status') === activeFilter);
            var show = matchSearch && matchFilter;
            item.classList.toggle('d-none', !show);
            if (show) visibleCount++;
        });

        if (countEl) countEl.textContent = visibleCount;
        if (noResultEl) noResultEl.classList.toggle('d-none', visibleCount !== 0 || items.length === 0);
    }

    if (searchInput) searchInput.addEventListener('input', applyFilter);

    chips.forEach(function (chip) {
        chip.addEventListener('click', function () {
            chips.forEach(function (c) { c.classList.remove('is-active'); });
            chip.classList.add('is-active');
            activeFilter = chip.getAttribute('data-filter');
            applyFilter();
        });
    });
});
</script>

<?php $this->load->view('admin/template/footer'); ?>