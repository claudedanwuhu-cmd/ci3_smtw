<?php $this->load->view('admin/template/header'); ?>
<?php $this->load->view('admin/template/sidebar'); ?>

<div class="main-content">
    <?php $this->load->view('admin/template/navbar'); ?>
    <div class="content-wrapper">
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
                <div class="page-header-icon"><i class="fa-solid fa-file-pen"></i></div>
                <div>
                    <span class="badge-header-tag"><i class="fa-solid fa-pen-to-square"></i> Form Edit</span>
                    <h2 class="page-title">Edit File Download</h2>
                    <p class="page-subtitle">Perbarui informasi dokumen yang dapat diunduh pengunjung.</p>
                </div>
            </div>
            <a href="<?= site_url('admin/download'); ?>" class="btn-back">
                <i class="fa-solid fa-arrow-left me-2"></i> Kembali
            </a>
        </div>

        <div class="custom-card">
            <div class="card-title-custom">
                <div class="title-icon"><i class="fa-solid fa-file-arrow-down"></i></div>
                <div>
                    <h5>Edit Data File</h5>
                    <small>Perbarui informasi dokumen download.</small>
                </div>
            </div>

            <form action="<?= site_url('admin/download/update/' . $download->id); ?>" method="post" enctype="multipart/form-data" data-download-form>
                <div class="card-body-custom">
                    <div class="row g-4">
                        <div class="col-md-8">
                            <label class="form-label required">Judul</label>
                            <div class="input-icon-group">
                                <i class="fa-solid fa-heading input-icon"></i>
                                <input type="text" name="judul" class="form-control with-icon" value="<?= html_escape($download->judul ?? ''); ?>" placeholder="Masukkan judul file" required>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Kategori</label>
                            <div class="input-icon-group">
                                <i class="fa-solid fa-folder input-icon"></i>
                                <input type="text" name="kategori" class="form-control with-icon" value="<?= html_escape($download->kategori ?? ''); ?>" placeholder="Contoh: Akademik">
                            </div>
                        </div>

                        <div class="col-md-8">
                            <label class="form-label">Ganti File</label>
                            <div class="download-upload-box" id="download-upload-box" role="button" tabindex="0" aria-label="Pilih file pengganti">
                                <input type="file" name="file" id="download-file-input" class="file-input-hidden" accept=".pdf,.doc,.docx,.xls,.xlsx,.zip">
                                <div class="upload-content">
                                    <div class="upload-icon"><i class="fa-solid fa-cloud-arrow-up"></i></div>
                                    <div>
                                        <strong id="download-upload-label">Klik atau seret file pengganti ke sini</strong>
                                        <small>PDF, DOC, DOCX, XLS, XLSX, ZIP • Maksimal 10 MB</small>
                                    </div>
                                </div>
                            </div>
                            <div class="upload-status" id="download-upload-status" aria-live="polite"></div>

                            <div class="current-file">
                                <div class="current-file-icon"><i class="fa-solid fa-file-lines"></i></div>
                                <div>
                                    <small>File saat ini • kosongkan jika tidak ingin mengganti</small>
                                    <strong id="current-file-name"><?= html_escape($download->file ?? '-'); ?></strong>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Tanggal</label>
                            <div class="input-icon-group">
                                <i class="fa-regular fa-calendar-days input-icon"></i>
                                <input type="date" name="tanggal" class="form-control with-icon" value="<?= html_escape($download->tanggal ?? ''); ?>">
                            </div>
                        </div>

                        <div class="col-12">
                            <label class="form-label">Keterangan</label>
                            <textarea name="keterangan" rows="6" maxlength="1000" class="form-control custom-textarea" placeholder="Masukkan keterangan file..." data-char-counter><?= html_escape($download->keterangan ?? ''); ?></textarea>
                            <div class="field-hint">
                                <span>Berikan keterangan singkat agar file mudah dikenali.</span>
                                <span><span id="keterangan-count">0</span>/1000</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-footer">
                    <a href="<?= site_url('admin/download'); ?>" class="btn-cancel">
                        <i class="fa-solid fa-xmark me-2"></i> Batal
                    </a>
                    <button type="submit" class="btn-save">
                        <span class="btn-save-content"><i class="fa-solid fa-floppy-disk me-2"></i>Simpan Perubahan</span>
                        <span class="btn-save-spinner"></span>
                    </button>
                </div>
            </form>
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
.page-header-custom::after {
    content:""; position:absolute; width:180px; height:180px; border-radius:50%;
    right:-70px; top:-90px; background:var(--download-soft); pointer-events:none;
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

.custom-table { color:var(--download-title); }
.custom-table thead th {
    background:var(--download-subtle); color:var(--download-subtitle);
    border-bottom:1px solid var(--download-border); padding:13px 18px;
    font-size:11px; font-weight:800; text-transform:uppercase; letter-spacing:.45px; white-space:nowrap;
}
.custom-table tbody td {
    padding:14px 18px; border-bottom:1px solid var(--download-border);
    color:var(--download-title); font-size:13px; vertical-align:middle;
}
.custom-table tbody tr { transition:.2s ease; animation:fadeUp .35s ease both; animation-delay:calc(var(--i,0) * .05s); }
.custom-table tbody tr:hover { background:var(--download-hover); }
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
.upload-status {
    display:none; margin-top:10px; padding:9px 12px; border-radius:10px;
    font-size:11.5px; font-weight:600; border:1px solid transparent;
}
.upload-status.is-error {
    display:block; background:rgba(239,68,68,.10); color:var(--download-danger); border-color:rgba(239,68,68,.22);
}
.upload-status.is-success {
    display:block; background:rgba(16,185,129,.10); color:var(--download-success); border-color:rgba(16,185,129,.22);
}
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
            const close = alert.querySelector('.btn-close');
            const duration = parseInt(alert.dataset.autodismiss || '4500', 10);

            const hide = function () {
                alert.classList.add('alert-hiding');
                window.setTimeout(function () { alert.remove(); }, 350);
            };

            if (close) {
                close.addEventListener('click', hide);
            }

            window.setTimeout(hide, duration);
        });
    }

    function initUpload() {
        const box = document.getElementById('download-upload-box');
        const input = document.getElementById('download-file-input');
        const label = document.getElementById('download-upload-label');
        const current = document.getElementById('current-file-name');
        const status = document.getElementById('download-upload-status');
        if (!box || !input) return;

        const maxSize = 10 * 1024 * 1024;
        const allowed = ['pdf', 'doc', 'docx', 'xls', 'xlsx', 'zip'];

        function setStatus(message, type) {
            if (!status) return;
            status.textContent = message;
            status.classList.remove('is-error', 'is-success');
            if (type) status.classList.add(type);
        }

        function validate(file) {
            if (!file) return false;
            const ext = (file.name.split('.').pop() || '').toLowerCase();
            if (!allowed.includes(ext)) {
                setStatus('Format file tidak didukung. Gunakan PDF, DOC, DOCX, XLS, XLSX, atau ZIP.', 'is-error');
                return false;
            }
            if (file.size > maxSize) {
                setStatus('Ukuran file melebihi 10 MB. Pilih file yang lebih kecil.', 'is-error');
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
            setStatus('File siap diunggah: ' + file.name, 'is-success');
        }

        box.addEventListener('click', function () { input.click(); });
        box.addEventListener('keydown', function (e) {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                input.click();
            }
        });
        ['dragenter', 'dragover'].forEach(function (evt) {
            box.addEventListener(evt, function (e) {
                e.preventDefault();
                box.classList.add('dragover');
            });
        });
        ['dragleave', 'drop'].forEach(function (evt) {
            box.addEventListener(evt, function (e) {
                e.preventDefault();
                box.classList.remove('dragover');
            });
        });
        box.addEventListener('drop', function (e) {
            const file = e.dataTransfer.files && e.dataTransfer.files[0];
            if (!file) return;
            if (!validate(file)) return;
            const dt = new DataTransfer();
            dt.items.add(file);
            input.files = dt.files;
            applyFile(file);
        });
        input.addEventListener('change', function () {
            const file = this.files && this.files[0];
            if (!file) {
                setStatus('', '');
                return;
            }
            applyFile(file);
        });
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
