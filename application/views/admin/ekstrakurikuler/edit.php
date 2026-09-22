<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('admin/template/header');
$this->load->view('admin/template/sidebar');

/* Bangun URL foto lama */
$foto_src = '';
if (!empty($ekstrakurikuler->foto)) {
    $foto_src = base_url('uploads/ekstrakurikuler/' . rawurlencode(basename($ekstrakurikuler->foto)));
}
?>

<div class="main-content">
    <?php $this->load->view('admin/template/navbar'); ?>

    <div class="content-wrapper">

        <!-- FLASH ERROR -->
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
                        <i class="fa-solid fa-pen-to-square me-1"></i> Edit Data
                    </span>
                    <h2 class="page-title">Edit Ekstrakurikuler</h2>
                    <p class="page-subtitle">Perbarui informasi dan dokumentasi kegiatan ekstrakurikuler.</p>
                </div>
            </div>
            <a href="<?= site_url('admin/ekstrakurikuler'); ?>" class="btn-back">
                <i class="fa-solid fa-arrow-left me-2"></i>
                Kembali
            </a>
        </div>

        <!-- FORM -->
        <form id="form-edit-ekstra" action="<?= site_url('admin/ekstrakurikuler/update/' . $ekstrakurikuler->id); ?>"
              method="POST" enctype="multipart/form-data">

            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
                   value="<?= $this->security->get_csrf_hash(); ?>">

            <div class="custom-card mb-4">

                <!-- SECTION: INFORMASI KEGIATAN -->
                <div class="card-title-custom">
                    <div class="title-icon">
                        <i class="fa-solid fa-address-card"></i>
                    </div>
                    <div>
                        <h5>Informasi Kegiatan</h5>
                        <small>Perbarui informasi utama ekstrakurikuler</small>
                    </div>
                </div>

                <div class="card-body-custom">
                    <div class="row g-4">

                        <!-- NAMA -->
                        <div class="col-md-8">
                            <label class="form-label required">Nama Ekstrakurikuler</label>
                            <div class="input-icon-group">
                                <i class="fa-solid fa-people-group input-icon"></i>
                                <input type="text" name="nama" class="form-control with-icon"
                                    value="<?= html_escape($ekstrakurikuler->nama); ?>"
                                    placeholder="Contoh: Pramuka / Basket" required>
                            </div>
                        </div>

                        <!-- PEMBINA -->
                        <div class="col-md-4">
                            <label class="form-label">Pembina Ekstrakurikuler</label>
                            <div class="input-icon-group">
                                <i class="fa-solid fa-user-tie input-icon"></i>
                                <input type="text" name="pembina" class="form-control with-icon"
                                    value="<?= html_escape($ekstrakurikuler->pembina); ?>"
                                    placeholder="Nama pembina / pelatih">
                            </div>
                        </div>

                        <!-- JADWAL -->
                        <div class="col-md-6">
                            <label class="form-label">Jadwal Kegiatan</label>
                            <div class="input-icon-group">
                                <i class="fa-solid fa-calendar-days input-icon"></i>
                                <input type="text" name="jadwal" class="form-control with-icon"
                                    value="<?= html_escape($ekstrakurikuler->jadwal); ?>"
                                    placeholder="Contoh: Setiap Jumat, 15:00 WIB">
                            </div>
                        </div>

                        <!-- TEMPAT -->
                        <div class="col-md-6">
                            <label class="form-label">Lokasi / Tempat</label>
                            <div class="input-icon-group">
                                <i class="fa-solid fa-location-dot input-icon"></i>
                                <input type="text" name="tempat" class="form-control with-icon"
                                    value="<?= html_escape($ekstrakurikuler->tempat); ?>"
                                    placeholder="Contoh: Lapangan Utama">
                            </div>
                        </div>

                        <!-- STATUS -->
                        <div class="col-md-4">
                            <label class="form-label">Status Kegiatan</label>
                            <div class="input-icon-group">
                                <i class="fa-solid fa-toggle-on input-icon"></i>
                                <select name="status" class="form-select with-icon">
                                    <option value="aktif"    <?= $ekstrakurikuler->status === 'aktif'    ? 'selected' : ''; ?>>🟢 Aktif</option>
                                    <option value="nonaktif" <?= $ekstrakurikuler->status === 'nonaktif' ? 'selected' : ''; ?>>🔴 Nonaktif</option>
                                </select>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- SECTION: FOTO -->
                <div class="section-divider">
                    <div class="section-heading">
                        <div class="title-icon">
                            <i class="fa-solid fa-image"></i>
                        </div>
                        <div>
                            <h5>Dokumentasi / Foto Sampul</h5>
                            <small>Pilih foto baru jika ingin mengganti foto saat ini <span class="optional-label">(Opsional)</span></small>
                        </div>
                    </div>

                    <div class="upload-dropzone" id="dropzone-area">
                        <input type="file" name="foto" id="fotoInput" class="d-none"
                               accept="image/png, image/jpeg, image/jpg, image/webp">

                        <input type="hidden" name="foto_lama" value="<?= html_escape($ekstrakurikuler->foto ?? ''); ?>">

                        <!-- Placeholder (kosong / tidak ada foto) -->
                        <div class="upload-content text-center <?= !empty($ekstrakurikuler->foto) ? 'd-none' : ''; ?>" id="uploadPlaceholder">
                            <div class="upload-icon-circle mb-2">
                                <i class="fa-solid fa-cloud-arrow-up"></i>
                            </div>
                            <p class="upload-text mb-1"><strong>Klik atau seret file ke sini untuk mengunggah</strong></p>
                            <span class="upload-subtext">PNG, JPG, JPEG, atau WEBP (Maksimal 2MB)</span>
                        </div>

                        <!-- Preview foto -->
                        <div class="preview-container <?= empty($ekstrakurikuler->foto) ? 'd-none' : ''; ?> text-center" id="previewWrapper">
                            <img id="imgPreview"
                                 src="<?= $foto_src; ?>"
                                 alt="Preview Foto" class="preview-avatar mb-2"
                                 onerror="this.src='https://via.placeholder.com/150?text=No+Image';">
                            <div class="d-flex align-items-center justify-content-center gap-2 mt-1">
                                <span class="preview-filename text-truncate d-inline-block" style="max-width:260px;" id="previewFilename">
                                    <?= basename($ekstrakurikuler->foto ?? 'foto.jpg'); ?>
                                </span>
                                <button type="button" class="btn-change-photo" id="btn-change-photo">
                                    <i class="fa-solid fa-rotate me-1"></i> Ganti Foto
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- SECTION: DESKRIPSI -->
                <div class="description-section">
                    <div class="section-heading">
                        <div class="title-icon">
                            <i class="fa-solid fa-align-left"></i>
                        </div>
                        <div>
                            <h5>Deskripsi Kegiatan</h5>
                            <small>Penjelasan mengenai aktivitas dan profil ekstrakurikuler</small>
                        </div>
                    </div>

                    <label class="form-label">Deskripsi Lengkap</label>
                    <textarea name="deskripsi" class="form-control custom-textarea" rows="4"
                        placeholder="Tuliskan deskripsi kegiatan ekstrakurikuler..."><?= html_escape($ekstrakurikuler->deskripsi); ?></textarea>
                </div>

                <!-- FOOTER FORM -->
                <div class="form-footer">
                    <a href="<?= site_url('admin/ekstrakurikuler'); ?>" class="btn-cancel">
                        <i class="fa-solid fa-xmark me-2"></i> Batal
                    </a>
                    <button type="submit" id="btn-submit-ekstra" class="btn-save">
                        <span class="btn-save-content">
                            <i class="fa-solid fa-floppy-disk me-2"></i>
                            Simpan Perubahan
                        </span>
                        <span class="btn-save-spinner" aria-hidden="true"></span>
                    </button>
                </div>

            </div>
        </form>

    </div>
</div>

<style>
/* =============================================================
   FORM EDIT EKSTRAKURIKULER — Design System Guru (konsisten)
============================================================= */
:root {
    --ekstra-card-bg:       #ffffff;
    --ekstra-card-subtle:   #f8fafc;
    --ekstra-input-bg:      #f8fafc;
    --ekstra-input-border:  #cbd5e1;
    --ekstra-input-color:   #0f172a;
    --ekstra-input-focus-bg:#ffffff;
    --ekstra-border:        rgba(226, 232, 240, 0.8);
    --ekstra-title:         #0f172a;
    --ekstra-subtitle:      #64748b;
    --ekstra-hover:         #f1f5f9;
    --ekstra-shadow:        0 10px 25px -5px rgba(15,23,42,0.05), 0 8px 10px -6px rgba(15,23,42,0.01);
    --ekstra-accent:        #0ea5e9;
    --ekstra-accent-glow:   rgba(14, 165, 233, 0.25);
    --ekstra-accent-soft:   rgba(14, 165, 233, 0.12);
    --ekstra-icon-muted:    #94a3b8;
    --dropzone-bg:          #f1f5f9;
    --dropzone-border:      #cbd5e1;
}

[data-bs-theme="dark"],
[data-theme="dark"],
body.dark-mode,
.dark-mode {
    --ekstra-card-bg:       #0f172a;
    --ekstra-card-subtle:   #1e293b;
    --ekstra-input-bg:      #1e293b;
    --ekstra-input-border:  rgba(255,255,255,0.12);
    --ekstra-input-color:   #f1f5f9;
    --ekstra-input-focus-bg:#111827;
    --ekstra-border:        rgba(255,255,255,0.08);
    --ekstra-title:         #f8fafc;
    --ekstra-subtitle:      #94a3b8;
    --ekstra-hover:         #1e293b;
    --ekstra-shadow:        0 12px 30px -5px rgba(0,0,0,0.4);
    --ekstra-accent:        #38bdf8;
    --ekstra-accent-glow:   rgba(56,189,248,0.25);
    --ekstra-accent-soft:   rgba(56,189,248,0.12);
    --ekstra-icon-muted:    #64748b;
    --dropzone-bg:          #111827;
    --dropzone-border:      rgba(255,255,255,0.15);
}

.fs-7 { font-size: 13px; }

[data-theme="dark"] .btn-close,
body.dark-mode .btn-close,
.dark-mode .btn-close { filter: invert(1) grayscale(100%) brightness(200%); }

/* Alert */
.alert-custom-danger {
    background:rgba(239,68,68,0.12); border:1px solid rgba(239,68,68,0.25); color:#ef4444;
    border-radius:16px; padding:16px 20px; backdrop-filter:blur(8px);
}
[data-theme="dark"] .alert-custom-danger,
body.dark-mode .alert-custom-danger { color:#f87171; }
.alert-icon-box {
    width:36px; height:36px; border-radius:10px;
    display:flex; align-items:center; justify-content:center; font-size:18px; flex-shrink:0;
}
.alert-custom-danger .alert-icon-box { background:rgba(239,68,68,0.2); }
.alert-autodismiss { position:relative; overflow:hidden; animation:ekstraAlertIn 0.35s cubic-bezier(0.34,1.56,0.64,1); }
.alert-autodismiss.alert-hiding { animation:ekstraAlertOut 0.35s ease forwards; }
@keyframes ekstraAlertIn  { from{opacity:0;transform:translateY(-14px) scale(0.98);}to{opacity:1;transform:translateY(0) scale(1);} }
@keyframes ekstraAlertOut { to{opacity:0;transform:translateY(-10px) scale(0.98);max-height:0;margin-bottom:0!important;padding-top:0;padding-bottom:0;border-width:0;} }
.alert-progress-track { position:absolute; left:0; right:0; bottom:0; height:3px; background:rgba(148,163,184,0.2); }
.alert-progress-bar { height:100%; width:100%; transform-origin:left; animation-name:ekstraAlertProgress; animation-timing-function:linear; animation-fill-mode:forwards; }
.alert-progress-bar-error { background:#ef4444; }
@keyframes ekstraAlertProgress { from{transform:scaleX(1);}to{transform:scaleX(0);} }

/* Page Header */
.page-header-custom {
    position:relative; overflow:hidden;
    background:var(--ekstra-card-bg); border:1px solid var(--ekstra-border);
    border-radius:20px; padding:22px 28px;
    display:flex; align-items:center; justify-content:space-between; gap:20px;
    box-shadow:var(--ekstra-shadow);
}
.page-header-custom::before {
    content:""; position:absolute; inset:0 auto 0 0; width:4px;
    background:linear-gradient(180deg, var(--ekstra-accent), #0369a1);
}
.page-header-icon {
    width:50px; height:50px; border-radius:14px;
    background:var(--ekstra-card-subtle); border:1px solid var(--ekstra-border);
    color:var(--ekstra-accent);
    display:flex; align-items:center; justify-content:center; font-size:22px; flex-shrink:0;
    transition:transform 0.35s ease;
}
.page-header-custom:hover .page-header-icon { transform:rotate(-6deg) scale(1.06); }
.badge-header-tag {
    display:inline-flex; align-items:center;
    background:var(--ekstra-accent-soft); color:var(--ekstra-accent);
    border:1px solid rgba(14,165,233,0.2);
    padding:4px 12px; border-radius:20px;
    font-size:11px; font-weight:700; text-transform:uppercase; letter-spacing:0.5px;
}
.page-title   { color:var(--ekstra-title); font-size:22px; font-weight:800; margin:0 0 2px; letter-spacing:-0.3px; }
.page-subtitle{ color:var(--ekstra-subtitle); font-size:13px; margin:0; }

.btn-back {
    display:inline-flex; align-items:center;
    background:var(--ekstra-card-subtle); color:var(--ekstra-title);
    border:1px solid var(--ekstra-border);
    text-decoration:none; padding:10px 20px; border-radius:12px;
    font-size:13px; font-weight:600; transition:all 0.25s ease;
}
.btn-back:hover { background:var(--ekstra-hover); color:var(--ekstra-accent); transform:translateX(-3px); }

/* Card */
.custom-card {
    background:var(--ekstra-card-bg); border:1px solid var(--ekstra-border);
    border-radius:20px; overflow:hidden; box-shadow:var(--ekstra-shadow);
    animation:ekstraFadeUp 0.4s ease both;
}
@keyframes ekstraFadeUp { from{opacity:0;transform:translateY(12px);}to{opacity:1;transform:translateY(0);} }

.card-title-custom {
    display:flex; align-items:center; gap:14px;
    padding:18px 24px; background:var(--ekstra-card-subtle); border-bottom:1px solid var(--ekstra-border);
}
.title-icon {
    width:40px; height:40px; background:var(--ekstra-accent-soft); border-radius:12px;
    color:var(--ekstra-accent); display:flex; align-items:center; justify-content:center;
    font-size:16px; flex-shrink:0;
}
.card-title-custom h5,
.section-heading h5 { margin:0 0 2px; color:var(--ekstra-title); font-size:15px; font-weight:700; }
.card-title-custom small,
.section-heading small { color:var(--ekstra-subtitle); font-size:12px; }
.optional-label { color:var(--ekstra-subtitle); font-weight:500; }

.card-body-custom { padding:24px; }

/* Form */
.form-label { color:var(--ekstra-title); font-size:12.5px; font-weight:700; margin-bottom:8px; }
.form-label.required::after { content:" *"; color:#ef4444; }
.input-icon-group { position:relative; display:flex; align-items:center; }
.input-icon {
    position:absolute; left:14px; color:var(--ekstra-icon-muted);
    font-size:14px; z-index:2; pointer-events:none; transition:color 0.25s ease;
}
.form-control,
.form-select {
    background-color:var(--ekstra-input-bg)!important;
    border:1px solid var(--ekstra-input-border)!important;
    border-radius:12px; font-size:13.5px; color:var(--ekstra-input-color)!important;
    padding:10px 16px; min-height:43px; transition:all 0.25s ease;
}
.form-control.with-icon,
.form-select.with-icon { padding-left:42px!important; }
.form-control:focus,
.form-select:focus {
    background-color:var(--ekstra-input-focus-bg)!important;
    border-color:var(--ekstra-accent)!important; color:var(--ekstra-input-color)!important;
    box-shadow:0 0 0 4px var(--ekstra-accent-glow); outline:none;
}
.form-control:hover:not(:focus),
.form-select:hover:not(:focus) { border-color:var(--ekstra-accent)!important; }
.input-icon-group:focus-within .input-icon { color:var(--ekstra-accent); }
.form-control::placeholder { color:var(--ekstra-subtitle); opacity:0.6; }
.custom-textarea { resize:vertical; min-height:110px; line-height:1.6; }

/* Sections */
.section-divider { border-top:1px solid var(--ekstra-border); padding:24px; }
.description-section { border-top:1px solid var(--ekstra-border); padding:24px; }
.section-heading { display:flex; align-items:center; gap:14px; margin-bottom:20px; }

/* Dropzone */
.upload-dropzone {
    border:2px dashed var(--dropzone-border); background:var(--dropzone-bg);
    border-radius:16px; padding:26px; cursor:pointer; transition:all 0.25s ease;
}
.upload-dropzone:hover { border-color:var(--ekstra-accent); background:var(--ekstra-card-subtle); }
.upload-dropzone.dragover { border-color:var(--ekstra-accent); background:var(--ekstra-card-subtle); box-shadow:0 0 0 4px var(--ekstra-accent-glow); }
.upload-icon-circle {
    width:44px; height:44px; border-radius:50%;
    background:var(--ekstra-accent-soft); color:var(--ekstra-accent);
    display:inline-flex; align-items:center; justify-content:center; font-size:18px;
    transition:transform 0.3s ease;
}
.upload-dropzone:hover .upload-icon-circle { transform:translateY(-3px); }
.upload-text   { color:var(--ekstra-title); font-size:13.5px; }
.upload-subtext{ color:var(--ekstra-subtitle); font-size:11.5px; }

/* Preview */
.preview-avatar {
    width:90px; height:90px; object-fit:cover; border-radius:12px;
    border:3px solid var(--ekstra-accent); box-shadow:0 4px 12px rgba(0,0,0,0.12);
}
.preview-filename { font-size:12px; font-weight:700; color:var(--ekstra-title); }
.btn-change-photo {
    border:1px solid var(--ekstra-accent-soft); background:var(--ekstra-accent-soft);
    color:var(--ekstra-accent); border-radius:10px; padding:6px 12px;
    font-size:11px; font-weight:700; cursor:pointer; transition:all 0.2s ease;
}
.btn-change-photo:hover { background:var(--ekstra-accent); color:#fff; }

/* Form Footer */
.form-footer {
    padding:18px 24px; background:var(--ekstra-card-subtle); border-top:1px solid var(--ekstra-border);
    display:flex; align-items:center; justify-content:flex-end; gap:12px;
}
.btn-cancel {
    background:var(--ekstra-card-bg); border:1px solid var(--ekstra-border); color:var(--ekstra-title);
    text-decoration:none; border-radius:12px; padding:11px 22px; font-size:13px; font-weight:600; transition:all 0.2s ease;
}
.btn-cancel:hover { background:var(--ekstra-hover); color:#ef4444; }
.btn-save {
    position:relative; overflow:hidden; border:none;
    background:linear-gradient(135deg, #0284c7 0%, #0369a1 100%);
    color:#fff; border-radius:12px; padding:11px 26px;
    font-size:13px; font-weight:700; cursor:pointer; transition:all 0.3s ease;
    box-shadow:0 4px 15px rgba(2,132,199,0.3);
}
.btn-save:hover { transform:translateY(-2px); box-shadow:0 8px 22px rgba(2,132,199,0.45); color:#fff; }
.btn-save-content { display:inline-flex; align-items:center; transition:opacity 0.2s ease; }
.btn-save-spinner {
    position:absolute; top:50%; left:50%;
    width:18px; height:18px; margin:-9px 0 0 -9px;
    border:2.5px solid rgba(255,255,255,0.35); border-top-color:#fff;
    border-radius:50%; opacity:0; animation:ekstraSpin 0.7s linear infinite;
}
.btn-save.is-loading { pointer-events:none; }
.btn-save.is-loading .btn-save-content { opacity:0; }
.btn-save.is-loading .btn-save-spinner { opacity:1; }
@keyframes ekstraSpin { to{transform:rotate(360deg);} }

/* Responsive */
@media (max-width: 768px) {
    .page-header-custom { flex-direction:column; align-items:stretch; }
    .btn-back { justify-content:center; width:100%; }
    .card-body-custom, .section-divider, .description-section, .card-title-custom, .form-footer { padding:20px 18px; }
    .form-footer { flex-direction:column-reverse; align-items:stretch; }
    .btn-cancel, .btn-save { width:100%; text-align:center; justify-content:center; }
}

@media (prefers-reduced-motion: reduce) {
    .alert-autodismiss, .custom-card, .page-header-icon, .upload-icon-circle, .btn-save-spinner { animation:none!important; transition:none!important; }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var fotoInput        = document.getElementById('fotoInput');
    var imgPreview       = document.getElementById('imgPreview');
    var previewFilename  = document.getElementById('previewFilename');
    var uploadPlaceholder= document.getElementById('uploadPlaceholder');
    var previewWrapper   = document.getElementById('previewWrapper');
    var dropzone         = document.getElementById('dropzone-area');
    var btnChange        = document.getElementById('btn-change-photo');

    function showPreview(file) {
        if (!file) return;
        var reader = new FileReader();
        reader.onload = function (e) {
            imgPreview.src = e.target.result;
            previewFilename.textContent = file.name;
            uploadPlaceholder.classList.add('d-none');
            previewWrapper.classList.remove('d-none');
        };
        reader.readAsDataURL(file);
    }

    /* Klik dropzone → buka file picker (kecuali klik di tombol ganti) */
    if (dropzone) {
        dropzone.addEventListener('click', function (e) {
            if (e.target.closest('#btn-change-photo')) return;
            fotoInput.click();
        });
    }

    if (fotoInput) {
        fotoInput.addEventListener('change', function () {
            var file = this.files[0];
            if (file) showPreview(file);
        });
    }

    /* Tombol "Ganti Foto" */
    if (btnChange) {
        btnChange.addEventListener('click', function (e) {
            e.stopPropagation();
            fotoInput.click();
        });
    }

    /* Drag & drop */
    if (dropzone && fotoInput) {
        ['dragenter','dragover'].forEach(function(evt) {
            dropzone.addEventListener(evt, function(e){ e.preventDefault(); dropzone.classList.add('dragover'); });
        });
        ['dragleave','drop'].forEach(function(evt) {
            dropzone.addEventListener(evt, function(e){ e.preventDefault(); dropzone.classList.remove('dragover'); });
        });
        dropzone.addEventListener('drop', function(e) {
            if (e.dataTransfer && e.dataTransfer.files && e.dataTransfer.files.length) {
                fotoInput.files = e.dataTransfer.files;
                showPreview(e.dataTransfer.files[0]);
            }
        });
    }

    /* Auto-dismiss alert */
    document.querySelectorAll('.alert-autodismiss').forEach(function (el) {
        var duration = parseInt(el.getAttribute('data-autodismiss'), 10) || 5000;
        var bar = el.querySelector('.alert-progress-bar');
        if (bar) bar.style.animationDuration = duration + 'ms';
        var done = false, remaining = duration, startedAt = Date.now(), timer;
        function closeAlert() {
            if (done) return; done = true; clearTimeout(timer);
            el.classList.add('alert-hiding');
            setTimeout(function(){ if(el.parentNode) el.parentNode.removeChild(el); }, 400);
        }
        timer = setTimeout(closeAlert, remaining);
        el.addEventListener('mouseenter', function(){ clearTimeout(timer); remaining -= (Date.now()-startedAt); if(bar) bar.style.animationPlayState='paused'; });
        el.addEventListener('mouseleave', function(){ if(bar) bar.style.animationPlayState='running'; startedAt=Date.now(); timer=setTimeout(closeAlert,Math.max(remaining,800)); });
        var closeBtn = el.querySelector('.btn-close');
        if (closeBtn) closeBtn.addEventListener('click', function(e){ e.preventDefault(); closeAlert(); });
    });

    /* Loading state saat submit */
    var form   = document.getElementById('form-edit-ekstra');
    var btnSub = document.getElementById('btn-submit-ekstra');
    if (form && btnSub) {
        form.addEventListener('submit', function () { btnSub.classList.add('is-loading'); });
    }

    window.addEventListener('pageshow', function(e) {
        if (e.persisted && btnSub) btnSub.classList.remove('is-loading');
    });
});
</script>

<?php $this->load->view('admin/template/footer'); ?>