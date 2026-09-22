<?php $this->load->view('admin/template/header'); ?>
<?php $this->load->view('admin/template/sidebar'); ?>

<div class="main-content">
    <?php $this->load->view('admin/template/navbar'); ?>

    <div class="content-wrapper">
        <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-autodismiss is-success" data-autodismiss="4500" role="status">
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
            <div class="alert alert-autodismiss is-error" data-autodismiss="6000" role="alert">
                <div class="alert-icon-box"><i class="fa-solid fa-circle-exclamation"></i></div>
                <div class="alert-content">
                    <strong>Gagal memproses data</strong>
                    <span><?= html_escape($this->session->flashdata('error')); ?></span>
                </div>
                <button type="button" class="btn-close" aria-label="Tutup notifikasi"></button>
                <div class="alert-progress-track"><div class="alert-progress-bar"></div></div>
            </div>
        <?php endif; ?>

        <div class="page-header-custom mb-4">
            <div class="page-header-left">
                <div class="page-header-icon"><i class="fa-solid fa-file-arrow-down"></i></div>
                <div>
                    <span class="badge-header-tag"><i class="fa-solid fa-layer-group"></i> Download</span>
                    <h2 class="page-title">Download</h2>
                    <p class="page-subtitle">Kelola dokumen yang dapat diunduh oleh pengunjung.</p>
                </div>
            </div>
            <a href="<?= site_url('admin/download/tambah'); ?>" class="btn-add">
                <i class="fa-solid fa-plus me-2"></i> Tambah File
            </a>
        </div>

        <div class="custom-card">
            <div class="card-title-custom justify-content-between flex-wrap">
                <div class="card-title-left">
                    <div class="title-icon"><i class="fa-solid fa-file-arrow-down"></i></div>
                    <div>
                        <h5>Daftar File</h5>
                        <small>Dokumen publikasi sekolah</small>
                    </div>
                </div>
                <div class="d-flex align-items-center gap-3 flex-wrap toolbar-right">
                    <div class="table-search-group">
                        <i class="fa-solid fa-magnifying-glass table-search-icon"></i>
                        <input type="text" id="download-search-input" class="table-search-input" placeholder="Cari judul, kategori, file...">
                    </div>
                    <span class="total-badge">
                        <i class="fa-solid fa-file-lines"></i>
                        <span id="download-count"><?= count($download); ?></span> Data
                    </span>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table custom-table align-middle mb-0">
                    <thead>
                        <tr>
                            <th width="70">No</th>
                            <th>Judul</th>
                            <th width="150">Kategori</th>
                            <th width="280">File</th>
                            <th width="130">Tanggal</th>
                            <th width="110" class="text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($download)): ?>
                            <?php $no = 1; ?>
                            <?php foreach ($download as $item): ?>
                                <?php
                                    $searchText = strtolower(
                                        ($item->judul ?? '') . ' ' .
                                        ($item->kategori ?? '') . ' ' .
                                        ($item->file ?? '') . ' ' .
                                        ($item->keterangan ?? '')
                                    );
                                ?>
                                <tr class="download-row" data-search="<?= html_escape($searchText); ?>" style="--i:<?= min($no - 1, 8); ?>">
                                    <td><?= $no++; ?></td>
                                    <td>
                                        <div class="item-title"><?= html_escape($item->judul ?? ''); ?></div>
                                        <?php if (!empty($item->keterangan)): ?>
                                            <small class="item-description"><?= html_escape($item->keterangan); ?></small>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <span class="badge-category"><?= !empty($item->kategori) ? html_escape($item->kategori) : 'Umum'; ?></span>
                                    </td>
                                    <td>
                                        <div class="file-info">
                                            <div class="file-icon"><i class="fa-solid fa-file-lines"></i></div>
                                            <div>
                                                <span class="file-name"><?= html_escape($item->file ?? '-'); ?></span>
                                                <small>File download</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <?php if (!empty($item->tanggal)): ?>
                                            <div class="date-info">
                                                <i class="fa-regular fa-calendar-days"></i>
                                                <?= html_escape(date('d-m-Y', strtotime($item->tanggal))); ?>
                                            </div>
                                        <?php else: ?>
                                            <span style="color:var(--download-subtitle)">-</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-end">
                                        <div class="action-buttons justify-content-end">
                                            <a href="<?= site_url('admin/download/edit/' . $item->id); ?>" class="btn-action edit" title="Edit data" aria-label="Edit data">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                            <a href="<?= site_url('admin/download/hapus/' . $item->id); ?>" class="btn-action delete" title="Hapus data" aria-label="Hapus data" onclick="return confirm('Yakin ingin menghapus file ini?');">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            <tr id="download-no-result" class="d-none">
                                <td colspan="6" class="empty-data">
                                    <div class="empty-icon"><i class="fa-solid fa-magnifying-glass"></i></div>
                                    <strong>Tidak ditemukan</strong>
                                    <small>Tidak ada file yang cocok dengan pencarian.</small>
                                </td>
                            </tr>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="empty-data">
                                    <div class="empty-icon"><i class="fa-solid fa-file-circle-plus"></i></div>
                                    <strong>Belum ada file</strong>
                                    <small>Tambahkan dokumen pertama yang dapat diunduh pengunjung.</small>
                                    <a href="<?= site_url('admin/download/tambah'); ?>" class="btn-add mt-3">
                                        <i class="fa-solid fa-plus me-2"></i> Tambah File
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
:root {
    --download-card: #ffffff;
    --download-subtle: #f8fafc;
    --download-input-bg: #f8fafc;
    --download-input-focus: #ffffff;
    --download-input-border: #cbd5e1;
    --download-border: rgba(226,232,240,.8);
    --download-title: #0f172a;
    --download-subtitle: #64748b;
    --download-hover: #f1f5f9;
    --download-accent: #0ea5e9;
    --download-glow: rgba(14,165,233,.25);
    --download-soft: rgba(14,165,233,.10);
    --download-soft-border: rgba(14,165,233,.22);
    --download-icon-muted: #94a3b8;
    --download-success: #059669;
    --download-danger: #dc2626;
    --download-shadow: 0 10px 25px -5px rgba(15,23,42,.05), 0 8px 10px -6px rgba(15,23,42,.02);
}
[data-bs-theme="dark"], [data-theme="dark"], body.dark-mode, .dark-mode {
    --download-card: #0f172a;
    --download-subtle: #1e293b;
    --download-input-bg: #1e293b;
    --download-input-focus: #111827;
    --download-input-border: rgba(255,255,255,.12);
    --download-border: rgba(255,255,255,.08);
    --download-title: #f8fafc;
    --download-subtitle: #94a3b8;
    --download-hover: #1e293b;
    --download-accent: #38bdf8;
    --download-glow: rgba(56,189,248,.25);
    --download-soft: rgba(56,189,248,.10);
    --download-soft-border: rgba(56,189,248,.22);
    --download-icon-muted: #64748b;
    --download-success: #34d399;
    --download-danger: #f87171;
    --download-shadow: 0 12px 30px -5px rgba(0,0,0,.4);
}
.page-header-custom {
    position: relative; overflow: hidden;
    background: var(--download-card);
    border: 1px solid var(--download-border);
    border-radius: 20px;
    padding: 22px 28px;
    display: flex; align-items: center; justify-content: space-between; gap: 20px;
    box-shadow: var(--download-shadow);
    animation: fadeUp .4s ease both;
}
.page-header-custom::before {
    content:""; position:absolute; inset:0 auto 0 0; width:4px;
    background: linear-gradient(180deg, var(--download-accent), #0369a1);
}

.page-header-left { display:flex; align-items:center; gap:16px; position:relative; z-index:1; }
.page-header-icon {
    width:52px; height:52px; border-radius:16px; flex-shrink:0;
    display:flex; align-items:center; justify-content:center;
    background:var(--download-soft); border:1px solid var(--download-soft-border);
    color:var(--download-accent); font-size:22px; transition:.25s ease;
}
.page-header-custom:hover .page-header-icon { transform:rotate(-6deg) scale(1.06); }
.badge-header-tag {
    display:inline-flex; align-items:center; gap:5px;
    margin-bottom:4px; padding:4px 10px; border-radius:999px;
    background:var(--download-soft); color:var(--download-accent);
    border:1px solid var(--download-soft-border);
    font-size:10.5px; font-weight:800; text-transform:uppercase; letter-spacing:.5px;
}
.page-title { color:var(--download-title); font-size:22px; font-weight:800; letter-spacing:-.3px; margin:0 0 2px; }
.page-subtitle { color:var(--download-subtitle); font-size:13px; margin:0; }

.btn-add, .btn-save {
    position:relative;
    display:inline-flex; align-items:center; justify-content:center;
    min-height:42px; padding:11px 20px; border:0; border-radius:12px;
    background:linear-gradient(135deg,#0284c7,#0369a1); color:#fff !important;
    text-decoration:none; font-size:12.5px; font-weight:700;
    box-shadow:0 6px 18px rgba(2,132,199,.28); transition:.25s ease;
}
.btn-add:hover, .btn-save:hover { transform:translateY(-2px); box-shadow:0 10px 24px rgba(2,132,199,.45); }
.btn-back, .btn-cancel {
    display:inline-flex; align-items:center; justify-content:center;
    min-height:42px; padding:11px 18px; border-radius:12px;
    text-decoration:none; color:var(--download-title);
    background:var(--download-subtle); border:1px solid var(--download-border);
    font-size:12.5px; font-weight:700; transition:.2s ease;
}
.btn-back:hover { background:var(--download-hover); color:var(--download-accent); transform:translateX(-3px); }
.btn-cancel { background:var(--download-card); }
.btn-cancel:hover { color:var(--download-danger); transform:translateY(-1px); }

.alert-autodismiss {
    position:relative; overflow:hidden; display:flex; align-items:center; gap:12px;
    border-radius:16px; padding:14px 48px 14px 16px; margin-bottom:24px;
    border:1px solid var(--download-border); animation:alertIn .42s cubic-bezier(.34,1.56,.64,1) both;
    transition:opacity .35s ease, transform .35s ease, max-height .35s ease, padding .35s ease, margin .35s ease;
}
.alert-autodismiss.is-success { background:rgba(16,185,129,.12); color:var(--download-success); border-color:rgba(16,185,129,.25); }
.alert-autodismiss.is-error { background:rgba(239,68,68,.12); color:var(--download-danger); border-color:rgba(239,68,68,.25); }
.alert-icon-box {
    width:36px; height:36px; border-radius:10px; flex-shrink:0;
    display:flex; align-items:center; justify-content:center; background:currentColor;
}
.alert-icon-box i { color:var(--download-card); }
.alert-content { display:flex; flex-direction:column; line-height:1.35; min-width:0; }
.alert-content strong { font-size:13px; font-weight:800; color:currentColor; }
.alert-content span { font-size:12.5px; color:var(--download-title); }
.alert-autodismiss .btn-close { position:absolute; right:14px; top:50%; transform:translateY(-50%); }
.alert-progress-track { position:absolute; left:0; right:0; bottom:0; height:3px; background:rgba(148,163,184,.16); }
.alert-progress-bar { height:100%; background:currentColor; transform-origin:left; transform:scaleX(1); }
.alert-hiding { opacity:0; transform:translateY(-10px); max-height:0 !important; padding-top:0; padding-bottom:0; margin-bottom:0; }

.custom-card {
    background:var(--download-card); border:1px solid var(--download-border);
    border-radius:20px; overflow:hidden; box-shadow:var(--download-shadow);
    animation:fadeUp .4s ease both;
}
.card-title-custom {
    padding:18px 24px; background:var(--download-subtle); border-bottom:1px solid var(--download-border);
    display:flex; align-items:center; gap:14px;
}
.card-title-left { display:flex; align-items:center; gap:14px; }
.title-icon {
    width:42px; height:42px; border-radius:12px; flex-shrink:0;
    display:flex; align-items:center; justify-content:center;
    background:var(--download-soft); border:1px solid var(--download-soft-border); color:var(--download-accent);
}
.card-title-custom h5 { margin:0; color:var(--download-title); font-size:15px; font-weight:700; }
.card-title-custom small { display:block; margin-top:2px; color:var(--download-subtitle); font-size:12px; }
.total-badge {
    display:inline-flex; align-items:center; gap:6px; padding:6px 11px; border-radius:999px;
    background:var(--download-soft); border:1px solid var(--download-soft-border);
    color:var(--download-accent); font-size:12px; font-weight:700;
}
.table-search-group { position:relative; }
.table-search-icon {
    position:absolute; left:12px; top:50%; transform:translateY(-50%);
    color:var(--download-icon-muted); font-size:13px; pointer-events:none;
}
.table-search-input {
    min-width:220px; height:38px; padding:8px 12px 8px 36px;
    border-radius:10px; background:var(--download-input-bg);
    border:1px solid var(--download-input-border); color:var(--download-title);
    font-size:12.5px; outline:none; transition:.2s ease;
}
.table-search-input:focus { border-color:var(--download-accent); box-shadow:0 0 0 3px var(--download-glow); }
.table-search-input::placeholder { color:var(--download-icon-muted); }

.custom-table {
    --bs-table-bg: transparent !important;
    --bs-table-color: var(--download-title) !important;
    --bs-table-hover-bg: var(--download-hover) !important;
    --bs-table-hover-color: var(--download-title) !important;
    color:var(--download-title) !important;
    margin-bottom:0;
}
.custom-table thead th {
    background:var(--download-subtle) !important; color:var(--download-subtitle) !important;
    border-bottom:1px solid var(--download-border) !important; padding:16px 20px;
    font-size:11px; font-weight:800; text-transform:uppercase; letter-spacing:.45px; white-space:nowrap;
}
.custom-table tbody td {
    padding:16px 20px; border-bottom:1px solid var(--download-border) !important;
    color:var(--download-title) !important; background:transparent !important;
    font-size:13.5px; vertical-align:middle;
}
.custom-table tbody tr { transition:.2s ease; animation:fadeUp .35s ease both; animation-delay:calc(var(--i,0) * .05s); }
.custom-table tbody tr:hover { background:var(--download-hover) !important; }
.custom-table tbody tr:last-child td { border-bottom:0; }
.item-title { color:var(--download-title); font-size:13.5px; font-weight:700; margin-bottom:3px; }
.item-description { display:block; max-width:360px; color:var(--download-subtitle); font-size:11.5px; line-height:1.5; }
.badge-category {
    display:inline-flex; align-items:center; padding:5px 9px; border-radius:999px;
    background:var(--download-soft); border:1px solid var(--download-soft-border);
    color:var(--download-accent); font-size:10.5px; font-weight:700;
}
.file-info { display:flex; align-items:center; gap:10px; }
.file-icon {
    width:38px; height:38px; border-radius:10px; flex-shrink:0;
    display:flex; align-items:center; justify-content:center;
    background:var(--download-soft); color:var(--download-accent);
}
.file-name { display:block; max-width:210px; color:var(--download-title); font-size:12.5px; font-weight:700; word-break:break-word; }
.file-info small { display:block; margin-top:2px; color:var(--download-subtitle); font-size:10.5px; }
.date-info { display:inline-flex; align-items:center; gap:7px; color:var(--download-subtitle); font-size:12px; white-space:nowrap; }
.date-info i { color:var(--download-accent); }
.action-buttons { display:flex; align-items:center; gap:7px; }
.btn-action {
    width:36px; height:36px; border-radius:10px; display:inline-flex; align-items:center; justify-content:center;
    text-decoration:none; transition:.2s ease; border:1px solid transparent;
}
.btn-action.edit { color:var(--download-accent); background:var(--download-subtle); border-color:var(--download-border); }
.btn-action.edit:hover { color:#fff; background:var(--download-accent); border-color:var(--download-accent); transform:translateY(-2px); }
.btn-action.delete { color:#f87171; background:rgba(239,68,68,.10); }
.btn-action.delete:hover { color:#fff; background:#ef4444; transform:translateY(-2px); }
.empty-data { padding:56px 20px !important; text-align:center; color:var(--download-subtitle) !important; }
.empty-icon {
    width:64px; height:64px; margin:0 auto 14px; border-radius:18px;
    display:flex; align-items:center; justify-content:center; background:var(--download-soft); color:var(--download-accent); font-size:24px;
}
.empty-data strong { display:block; color:var(--download-title); font-size:14px; }
.empty-data small { display:block; margin-top:4px; color:var(--download-subtitle); font-size:12.5px; }

.card-body-custom { padding:26px 28px; }
.form-label { display:block; color:var(--download-title); font-size:12.5px; font-weight:700; margin-bottom:8px; }
.form-label.required::after { content:" *"; color:var(--download-danger); }
.input-icon-group { position:relative; }
.input-icon {
    position:absolute; left:14px; top:50%; transform:translateY(-50%);
    color:var(--download-icon-muted); font-size:14px; z-index:2; pointer-events:none; transition:.2s ease;
}
.input-icon-group:focus-within .input-icon { color:var(--download-accent); }
.form-control, .form-select {
    min-height:44px; background:var(--download-input-bg); border:1px solid var(--download-input-border);
    color:var(--download-title); border-radius:12px; font-size:13.5px; transition:.2s ease;
}
.form-control:hover, .form-select:hover { border-color:var(--download-accent); }
.form-control:focus, .form-select:focus {
    background:var(--download-input-focus); color:var(--download-title);
    border-color:var(--download-accent); box-shadow:0 0 0 4px var(--download-glow);
}
.form-control::placeholder { color:var(--download-icon-muted); }
.with-icon { padding-left:42px; }
.form-control[type="date"] { color-scheme:light; }
[data-bs-theme="dark"] .form-control[type="date"],
[data-theme="dark"] .form-control[type="date"],
body.dark-mode .form-control[type="date"],
.dark-mode .form-control[type="date"] { color-scheme:dark; }
.custom-textarea { min-height:130px; padding:12px 14px; resize:vertical; line-height:1.65; }
.field-hint { display:flex; justify-content:space-between; gap:12px; margin-top:7px; color:var(--download-subtitle); font-size:11.5px; }

.download-upload-box {
    min-height:104px; border:2px dashed var(--download-input-border); border-radius:16px;
    background:var(--download-input-bg); display:flex; align-items:center; padding:16px 18px;
    cursor:pointer; transition:.2s ease; outline:none;
}
.download-upload-box:hover, .download-upload-box.dragover {
    border-color:var(--download-accent); background:var(--download-soft); box-shadow:0 0 0 4px var(--download-glow);
}
.download-upload-box:focus-visible { border-color:var(--download-accent); box-shadow:0 0 0 4px var(--download-glow); }
.file-input-hidden { display:none; }
.upload-content { display:flex; align-items:center; gap:14px; }
.upload-icon {
    width:44px; height:44px; border-radius:12px; flex-shrink:0;
    display:flex; align-items:center; justify-content:center; background:var(--download-soft); color:var(--download-accent);
    transition:.2s ease;
}
.download-upload-box:hover .upload-icon { transform:translateY(-3px); }
.upload-content strong { display:block; color:var(--download-title); font-size:13px; font-weight:700; }
.upload-content small { display:block; color:var(--download-subtitle); font-size:11.5px; margin-top:3px; }
.current-file {
    display:flex; align-items:center; gap:11px; padding:11px 13px; margin-top:12px;
    border:1px solid var(--download-border); border-radius:12px; background:var(--download-subtle);
}
.current-file-icon {
    width:36px; height:36px; border-radius:10px; display:flex; align-items:center; justify-content:center;
    background:var(--download-soft); color:var(--download-accent);
}
.current-file small { display:block; color:var(--download-subtitle); font-size:10.5px; }
.current-file strong { display:block; color:var(--download-title); font-size:12px; margin-top:2px; word-break:break-all; }
.form-footer {
    padding:18px 24px; background:var(--download-subtle); border-top:1px solid var(--download-border);
    display:flex; justify-content:flex-end; gap:10px;
}
.btn-save-content { transition:opacity .2s ease; }
.btn-save-spinner {
    position:absolute; width:18px; height:18px; border:2.5px solid rgba(255,255,255,.45);
    border-top-color:#fff; border-radius:50%; opacity:0; animation:spin .7s linear infinite;
}
.btn-save.is-loading { pointer-events:none; }
.btn-save.is-loading .btn-save-content { opacity:0; }
.btn-save.is-loading .btn-save-spinner { opacity:1; }

@keyframes fadeUp { from { opacity:0; transform:translateY(12px); } to { opacity:1; transform:none; } }
@keyframes alertIn { from { opacity:0; transform:translateY(-10px) scale(.98); } to { opacity:1; transform:none; } }
@keyframes spin { to { transform:rotate(360deg); } }

@media (max-width:768px) {
    .page-header-custom { flex-direction:column; align-items:stretch; padding:18px; }
    .page-header-left { align-items:flex-start; }
    .btn-add, .btn-back { width:100%; }
    .card-title-custom { padding:16px 18px; }
    .toolbar-right { width:100%; }
    .table-search-group, .table-search-input { width:100%; min-width:0; }
    .card-body-custom { padding:20px 18px; }
    .form-footer { flex-direction:column-reverse; padding:16px 18px; }
    .btn-save, .btn-cancel { width:100%; }
    .custom-table thead th, .custom-table tbody td { padding:12px; }
}
@media (prefers-reduced-motion:reduce) {
    *, *::before, *::after { animation:none !important; transition:none !important; scroll-behavior:auto !important; }
}
</style>

<script>
(function () {
    function initAlerts() {
        document.querySelectorAll('.alert-autodismiss').forEach(function (alert) {
            const total = parseInt(alert.dataset.autodismiss || '4500', 10);
            const bar = alert.querySelector('.alert-progress-bar');
            const close = alert.querySelector('.btn-close');
            let remaining = total;
            let startedAt = Date.now();
            let timer;

            function start(ms) {
                remaining = Math.max(800, ms);
                startedAt = Date.now();
                if (bar) {
                    bar.style.animation = 'none';
                    bar.offsetHeight;
                    bar.style.transform = 'scaleX(1)';
                    bar.style.transition = 'transform ' + remaining + 'ms linear';
                    requestAnimationFrame(function () { bar.style.transform = 'scaleX(0)'; });
                }
                timer = setTimeout(hide, remaining);
            }

            function pause() {
                clearTimeout(timer);
                remaining -= Date.now() - startedAt;
                if (bar) {
                    const cs = getComputedStyle(bar);
                    const matrix = new DOMMatrixReadOnly(cs.transform);
                    const scaleX = matrix.a || 0;
                    bar.style.transition = 'none';
                    bar.style.transform = 'scaleX(' + scaleX + ')';
                }
            }

            function hide() {
                clearTimeout(timer);
                alert.style.maxHeight = alert.offsetHeight + 'px';
                requestAnimationFrame(function () { alert.classList.add('alert-hiding'); });
                setTimeout(function () { alert.remove(); }, 380);
            }

            alert.addEventListener('mouseenter', pause);
            alert.addEventListener('mouseleave', function () { start(remaining); });
            if (close) close.addEventListener('click', hide);
            start(total);
        });
    }

    function initUpload() {
        const box = document.getElementById('download-upload-box');
        const input = document.getElementById('download-file-input');
        const label = document.getElementById('download-upload-label');
        const current = document.getElementById('current-file-name');
        if (!box || !input) return;

        const maxSize = 10 * 1024 * 1024;
        const allowed = ['pdf','doc','docx','xls','xlsx','zip'];

        function validate(file) {
            if (!file) return false;
            const ext = (file.name.split('.').pop() || '').toLowerCase();
            if (!allowed.includes(ext)) {
                alert('Format file tidak didukung.');
                return false;
            }
            if (file.size > maxSize) {
                alert('Ukuran file maksimal 10 MB.');
                return false;
            }
            return true;
        }

        function applyFile(file) {
            if (!validate(file)) {
                input.value = '';
                return;
            }
            if (label) label.textContent = file.name;
            if (current) current.textContent = file.name;
        }

        box.addEventListener('click', function () { input.click(); });
        box.addEventListener('keydown', function (e) {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                input.click();
            }
        });
        ['dragenter','dragover'].forEach(function (evt) {
            box.addEventListener(evt, function (e) { e.preventDefault(); box.classList.add('dragover'); });
        });
        ['dragleave','drop'].forEach(function (evt) {
            box.addEventListener(evt, function (e) { e.preventDefault(); box.classList.remove('dragover'); });
        });
        box.addEventListener('drop', function (e) {
            const file = e.dataTransfer.files && e.dataTransfer.files[0];
            if (!file || !validate(file)) return;
            const dt = new DataTransfer();
            dt.items.add(file);
            input.files = dt.files;
            applyFile(file);
        });
        input.addEventListener('change', function () { applyFile(this.files && this.files[0]); });
    }

    function initForm() {
        document.querySelectorAll('form[data-download-form]').forEach(function (form) {
            const button = form.querySelector('.btn-save');
            form.addEventListener('submit', function () {
                if (button) button.classList.add('is-loading');
            });
        });
        const textarea = document.querySelector('[data-char-counter]');
        const count = document.getElementById('keterangan-count');
        if (textarea && count) {
            const update = function () { count.textContent = textarea.value.length; };
            textarea.addEventListener('input', update);
            update();
        }
    }

    function initSearch() {
        const input = document.getElementById('download-search-input');
        const rows = Array.from(document.querySelectorAll('.download-row'));
        const noResult = document.getElementById('download-no-result');
        const count = document.getElementById('download-count');
        if (!input) return;

        function filter() {
            const q = input.value.trim().toLowerCase();
            let visible = 0;
            rows.forEach(function (row) {
                const match = (row.dataset.search || '').includes(q);
                row.classList.toggle('d-none', !match);
                if (match) visible++;
            });
            if (count) count.textContent = visible;
            if (noResult) noResult.classList.toggle('d-none', visible !== 0);
        }
        input.addEventListener('input', filter);
    }

    document.addEventListener('DOMContentLoaded', function () {
        initAlerts();
        initUpload();
        initForm();
        initSearch();
    });
})();
</script>

<?php $this->load->view('admin/template/footer'); ?>
