<?php $this->load->view('admin/template/header'); ?>
<?php $this->load->view('admin/template/sidebar'); ?>

<div class="main-content">
    <?php $this->load->view('admin/template/navbar'); ?>

    <div class="content-wrapper">

        <!-- FLASH MESSAGE -->
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
                    <i class="fa-solid fa-square-plus"></i>
                </div>
                <div>
                    <span class="badge-header-tag">
                        <i class="fa-solid fa-plus me-1"></i> Form Input
                    </span>
                    <h2 class="page-title">Tambah Carousel</h2>
                    <p class="page-subtitle">Tambahkan banner baru untuk halaman depan sekolah.</p>
                </div>
            </div>
            <a href="<?= site_url('admin/carousel'); ?>" class="btn-back">
                <i class="fa-solid fa-arrow-left me-2"></i>
                Kembali
            </a>
        </div>

        <!-- FORM CARD -->
        <div class="custom-card">
            <div class="card-title-custom">
                <div class="title-icon">
                    <i class="fa-solid fa-plus"></i>
                </div>
                <div>
                    <h5>Data Carousel</h5>
                    <small>Isi informasi banner halaman depan.</small>
                </div>
            </div>

            <form id="carousel-form" action="<?= site_url('admin/carousel/simpan'); ?>" method="post" enctype="multipart/form-data">

                <div class="card-body-custom">
                    <div class="row g-4">

                        <!-- Judul -->
                        <div class="col-md-8">
                            <label class="form-label required">Judul</label>
                            <div class="input-icon-group">
                                <i class="fa-solid fa-heading"></i>
                                <input
                                    type="text"
                                    name="judul"
                                    class="form-control custom-input with-icon"
                                    placeholder="Masukkan judul carousel"
                                    required
                                >
                            </div>
                        </div>

                        <!-- Urutan -->
                        <div class="col-md-4">
                            <label class="form-label">Urutan</label>
                            <div class="input-icon-group">
                                <i class="fa-solid fa-arrow-down-1-9"></i>
                                <input
                                    type="number"
                                    name="urutan"
                                    class="form-control custom-input with-icon"
                                    value="0"
                                    min="0"
                                    placeholder="0"
                                >
                            </div>
                        </div>

                        <!-- Deskripsi -->
                        <div class="col-12">
                            <label class="form-label">Deskripsi</label>
                            <textarea
                                id="carousel-deskripsi"
                                name="deskripsi"
                                rows="5"
                                maxlength="500"
                                class="form-control custom-input custom-textarea"
                                placeholder="Masukkan deskripsi carousel..."
                            ></textarea>
                            <div class="textarea-hint"><span id="deskripsi-count">0</span>/500 karakter</div>
                        </div>

                        <!-- Teks Tombol -->
                        <div class="col-md-6">
                            <label class="form-label">Teks Tombol</label>
                            <div class="input-icon-group">
                                <i class="fa-solid fa-hand-pointer"></i>
                                <input
                                    type="text"
                                    name="tombol"
                                    class="form-control custom-input with-icon"
                                    value="Jelajahi Sekolah"
                                    placeholder="Contoh: Jelajahi Sekolah"
                                >
                            </div>
                        </div>

                        <!-- Link Tombol -->
                        <div class="col-md-6">
                            <label class="form-label">Link Tombol</label>
                            <div class="input-icon-group">
                                <i class="fa-solid fa-link"></i>
                                <input
                                    type="text"
                                    name="link"
                                    class="form-control custom-input with-icon"
                                    value="#tentang"
                                    placeholder="Contoh: #tentang"
                                >
                            </div>
                        </div>

                        <!-- Gambar -->
                        <div class="col-md-8">
                            <label class="form-label required">Gambar</label>

                            <div class="carousel-upload-box" id="carousel-upload-box">
                                <input
                                    type="file"
                                    name="gambar"
                                    id="carousel-gambar-input"
                                    class="file-input-hidden"
                                    accept="image/png,image/jpeg,image/webp"
                                    required
                                >
                                <div class="upload-content">
                                    <div class="upload-icon">
                                        <i class="fa-solid fa-cloud-arrow-up"></i>
                                    </div>
                                    <div>
                                        <strong id="carousel-upload-label">Klik atau seret gambar ke sini</strong>
                                        <small>JPG, PNG, WEBP &bull; Maksimal 4 MB</small>
                                    </div>
                                </div>
                            </div>

                            <!-- Preview -->
                            <div id="carousel-preview-container" class="carousel-preview-wrapper d-none">
                                <img id="carousel-gambar-preview" src="" alt="Preview" class="carousel-image-preview">
                            </div>
                        </div>

                        <!-- Status -->
                        <div class="col-md-4">
                            <label class="form-label">Status Tayang</label>

                            <div class="status-toggle-card is-active" id="status-toggle" role="switch" tabindex="0" aria-checked="true">
                                <div class="status-toggle-icon"><i class="fa-solid fa-circle-check"></i></div>
                                <div class="status-toggle-text">
                                    <strong>Aktif</strong>
                                    <span>Banner akan ditampilkan</span>
                                </div>
                                <div class="status-toggle-switch"><span class="status-toggle-knob"></span></div>
                            </div>
                            <input type="hidden" name="status" id="status-input" value="aktif">
                        </div>

                    </div>
                </div>

                <!-- Footer -->
                <div class="form-footer">
                    <a href="<?= site_url('admin/carousel'); ?>" class="btn-cancel">
                        <i class="fa-solid fa-xmark me-2"></i>
                        Batal
                    </a>
                    <button type="submit" class="btn-save">
                        <i class="fa-solid fa-floppy-disk me-2"></i>
                        Simpan Carousel
                    </button>
                </div>

            </form>
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
[data-bs-theme="dark"], [data-theme="dark"], body.dark-mode, .dark-mode {
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
    position: relative; overflow: hidden;
    background: var(--carousel-card);
    border: 1px solid var(--carousel-border);
    border-radius: 20px;
    padding: 22px 28px;
    display: flex; align-items: center; justify-content: space-between; gap: 20px;
    box-shadow: var(--carousel-shadow);
}
.page-header-custom::before {
    content: ""; position: absolute; inset: 0 auto 0 0; width: 4px;
    background: linear-gradient(180deg, var(--carousel-accent), #0369a1);
}

.page-header-left { position: relative; z-index: 1; display: flex; align-items: center; gap: 16px; }
.page-header-icon {
    width: 52px; height: 52px; border-radius: 16px;
    display: flex; align-items: center; justify-content: center;
    background: var(--carousel-soft); border: 1px solid var(--carousel-soft-border);
    color: var(--carousel-accent); font-size: 22px; flex-shrink: 0;
    transition: transform .35s ease;
}
.page-header-custom:hover .page-header-icon { transform: rotate(-6deg) scale(1.06); }

.badge-header-tag {
    display: inline-flex; align-items: center;
    padding: 4px 10px; margin-bottom: 5px; border-radius: 999px;
    background: var(--carousel-soft); color: var(--carousel-accent);
    font-size: 10.5px; font-weight: 800; letter-spacing: .5px; text-transform: uppercase;
}
.page-title { color: var(--carousel-title); font-size: 22px; font-weight: 800; letter-spacing: -.3px; margin: 0; }
.page-subtitle { color: var(--carousel-subtitle); font-size: 13px; margin: 5px 0 0; }

.btn-back {
    position: relative; z-index: 1;
    display: inline-flex; align-items: center; justify-content: center;
    min-height: 42px; padding: 0 18px; border-radius: 12px;
    text-decoration: none; font-size: 13px; font-weight: 700;
    color: var(--carousel-title); background: var(--carousel-subtle);
    border: 1px solid var(--carousel-border);
    transition: .2s ease;
}
.btn-back:hover { background: var(--carousel-hover); color: var(--carousel-accent); transform: translateX(-3px); }
.btn-back:focus-visible { outline: 2px solid var(--carousel-accent); outline-offset: 2px; }

/* CARD */
.custom-card {
    background: var(--carousel-card);
    border: 1px solid var(--carousel-border);
    border-radius: 20px;
    overflow: hidden;
    box-shadow: var(--carousel-shadow);
    animation: carouselFadeUp .4s ease both;
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
.title-icon {
    width: 42px; height: 42px; border-radius: 12px;
    display: flex; align-items: center; justify-content: center;
    background: var(--carousel-soft); border: 1px solid var(--carousel-soft-border);
    color: var(--carousel-accent); flex-shrink: 0;
}
.card-title-custom h5 { color: var(--carousel-title); font-size: 15px; font-weight: 800; margin: 0; }
.card-title-custom small { color: var(--carousel-subtitle); display: block; font-size: 12px; margin-top: 3px; }

.card-body-custom { padding: 26px 28px; }

/* FORM LABEL */
.form-label { display: block; color: var(--carousel-title); font-size: 12.5px; font-weight: 700; margin-bottom: 8px; }
.form-label.required::after { content: "*"; color: var(--carousel-danger); margin-left: 4px; }

/* INPUT */
.custom-input {
    min-height: 44px;
    background: var(--carousel-input-bg);
    border: 1px solid var(--carousel-input-border);
    color: var(--carousel-title);
    border-radius: 12px;
    font-size: 13.5px;
    transition: .2s ease;
}
.custom-input::placeholder { color: var(--carousel-icon-muted); }
.custom-input:hover { border-color: var(--carousel-accent); }
.custom-input:focus {
    background: var(--carousel-input-focus);
    color: var(--carousel-title);
    border-color: var(--carousel-accent);
    box-shadow: 0 0 0 4px var(--carousel-glow);
    outline: none;
}

.input-icon-group { position: relative; }
.input-icon-group > i {
    position: absolute; left: 14px; top: 50%; transform: translateY(-50%);
    color: var(--carousel-icon-muted); font-size: 14px; z-index: 2; pointer-events: none;
    transition: color .2s ease;
}
.input-icon-group:focus-within > i { color: var(--carousel-accent); }
.with-icon { padding-left: 42px; }

.custom-textarea { min-height: 120px; resize: vertical; padding: 12px 14px; line-height: 1.65; }
.textarea-hint { display: flex; justify-content: flex-end; margin-top: 6px; font-size: 11px; color: var(--carousel-subtitle); }

.field-hint { display: block; margin-top: 8px; font-size: 11.5px; color: var(--carousel-subtitle); }

/* UPLOAD DROPZONE */
.carousel-upload-box {
    min-height: 92px;
    border: 2px dashed var(--carousel-input-border);
    border-radius: 14px;
    background: var(--carousel-input-bg);
    display: flex; align-items: center;
    padding: 16px 18px;
    cursor: pointer;
    transition: .2s ease;
}
.carousel-upload-box:hover { border-color: var(--carousel-accent); background: var(--carousel-soft); }
.carousel-upload-box.dragover { border-color: var(--carousel-accent); background: var(--carousel-soft); box-shadow: 0 0 0 4px var(--carousel-glow); }
.file-input-hidden { display: none; }

.upload-content { display: flex; align-items: center; gap: 14px; }
.upload-icon {
    width: 44px; height: 44px; border-radius: 12px;
    display: flex; align-items: center; justify-content: center;
    background: var(--carousel-soft); color: var(--carousel-accent);
    font-size: 17px; flex-shrink: 0; transition: transform .2s ease;
}
.carousel-upload-box:hover .upload-icon { transform: translateY(-3px); }
.upload-content strong { display: block; color: var(--carousel-title); font-size: 13px; font-weight: 700; }
.upload-content small { display: block; color: var(--carousel-subtitle); font-size: 11.5px; margin-top: 3px; }

.carousel-preview-wrapper {
    margin-top: 12px; padding: 10px;
    border: 1px solid var(--carousel-border); border-radius: 14px;
    background: var(--carousel-subtle);
    display: inline-block; max-width: 100%;
}
.carousel-image-preview { display: block; width: min(560px, 100%); max-height: 230px; object-fit: cover; border-radius: 10px; }

/* STATUS TOGGLE SWITCH */
.status-toggle-card {
    display: flex; align-items: center; gap: 12px;
    padding: 14px 16px;
    border: 1px solid var(--carousel-input-border);
    border-radius: 14px;
    background: var(--carousel-input-bg);
    cursor: pointer;
    transition: .2s ease;
    outline: none;
}
.status-toggle-card:focus-visible { border-color: var(--carousel-accent); box-shadow: 0 0 0 4px var(--carousel-glow); }
.status-toggle-icon {
    width: 38px; height: 38px; border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    background: rgba(100, 116, 139, .12); color: var(--carousel-icon-muted);
    flex-shrink: 0; font-size: 15px; transition: .2s ease;
}
.status-toggle-card.is-active .status-toggle-icon { background: var(--carousel-soft); color: var(--carousel-success); }
.status-toggle-text { flex: 1; min-width: 0; }
.status-toggle-text strong { display: block; font-size: 12.5px; color: var(--carousel-title); }
.status-toggle-text span { display: block; font-size: 11.5px; color: var(--carousel-subtitle); margin-top: 2px; }
.status-toggle-switch { width: 42px; height: 24px; border-radius: 999px; background: #cbd5e1; position: relative; flex-shrink: 0; transition: .25s ease; }
.status-toggle-card.is-active .status-toggle-switch { background: var(--carousel-success); }
.status-toggle-knob { position: absolute; top: 3px; left: 3px; width: 18px; height: 18px; border-radius: 50%; background: #fff; transition: .25s ease; box-shadow: 0 1px 3px rgba(0, 0, 0, .25); }
.status-toggle-card.is-active .status-toggle-knob { transform: translateX(18px); }

/* FOOTER & BUTTONS */
.form-footer {
    padding: 18px 24px;
    background: var(--carousel-subtle);
    border-top: 1px solid var(--carousel-border);
    display: flex; justify-content: flex-end; gap: 10px;
}
.btn-cancel {
    display: inline-flex; align-items: center; justify-content: center;
    min-height: 42px; padding: 0 18px; border-radius: 12px;
    text-decoration: none; font-size: 13px; font-weight: 700;
    color: var(--carousel-title); background: var(--carousel-card);
    border: 1px solid var(--carousel-border);
    transition: .2s ease;
}
.btn-cancel:hover { color: #ef4444; border-color: #ef4444; transform: translateY(-1px); }
.btn-cancel:focus-visible { outline: 2px solid var(--carousel-accent); outline-offset: 2px; }

.btn-save {
    position: relative;
    display: inline-flex; align-items: center; justify-content: center;
    min-height: 44px; padding: 0 22px; border: 0; border-radius: 12px;
    color: #fff; background: linear-gradient(135deg, #0284c7, #0369a1);
    font-size: 13px; font-weight: 700;
    box-shadow: 0 6px 18px rgba(2, 132, 199, .28);
    transition: .2s ease;
}
.btn-save:hover { color: #fff; transform: translateY(-2px); box-shadow: 0 10px 24px rgba(2, 132, 199, .45); }
.btn-save:focus-visible { outline: 2px solid var(--carousel-accent); outline-offset: 2px; }
.btn-save.is-loading { color: transparent; pointer-events: none; }
.btn-save.is-loading::after {
    content: "";
    position: absolute;
    width: 18px; height: 18px;
    border: 2.5px solid rgba(255, 255, 255, .4);
    border-top-color: #fff;
    border-radius: 50%;
    animation: carouselSpin .7s linear infinite;
}
@keyframes carouselSpin { to { transform: rotate(360deg); } }

@media (max-width: 768px) {
    .page-header-custom { align-items: stretch; flex-direction: column; padding: 20px; }
    .page-header-left { align-items: flex-start; }
    .btn-back { width: 100%; }
    .card-body-custom { padding: 20px; }
    .form-footer { flex-direction: column-reverse; padding: 16px 20px; }
    .btn-save, .btn-cancel { width: 100%; }
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
.alert-autodismiss.is-error { background: rgba(239, 68, 68, .12); border-color: rgba(239, 68, 68, .25); }
.alert-icon-box { width: 36px; height: 36px; border-radius: 10px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; font-size: 15px; }
.is-error .alert-icon-box { background: rgba(239, 68, 68, .18); color: var(--carousel-danger); }
.alert-content { display: flex; flex-direction: column; gap: 2px; }
.alert-content strong { font-size: 13px; color: var(--carousel-title); }
.alert-content span { font-size: 12.5px; color: var(--carousel-subtitle); }
.alert-autodismiss .btn-close { position: absolute; top: 12px; right: 14px; width: 22px; height: 22px; background-size: 12px; opacity: .5; }
.alert-autodismiss .btn-close:hover { opacity: .9; }
.alert-progress-track { position: absolute; left: 0; bottom: 0; width: 100%; height: 3px; background: rgba(148, 163, 184, .2); }
.alert-progress-bar { height: 100%; width: 100%; transform-origin: left; animation: carouselProgress linear forwards; background: var(--carousel-danger); }
@keyframes carouselProgress {
    from { transform: scaleX(1); }
    to { transform: scaleX(0); }
}

@media (prefers-reduced-motion: reduce) {
    .alert-autodismiss, .custom-card, .page-header-icon, .upload-icon,
    .status-toggle-switch, .status-toggle-knob, .btn-save.is-loading::after,
    .btn-back, .btn-cancel, .btn-save {
        animation: none !important;
        transition: none !important;
    }
}
</style>

<script>
(function () {
    var uploadBox = document.getElementById('carousel-upload-box');
    var input = document.getElementById('carousel-gambar-input');
    var previewContainer = document.getElementById('carousel-preview-container');
    var preview = document.getElementById('carousel-gambar-preview');
    var label = document.getElementById('carousel-upload-label');
    var defaultLabel = label ? label.textContent : '';

    function showPreview(file) {
        if (!file) {
            if (previewContainer) previewContainer.classList.add('d-none');
            if (preview) preview.removeAttribute('src');
            if (label) label.textContent = defaultLabel;
            return;
        }

        if (!file.type.startsWith('image/')) {
            if (label) label.textContent = defaultLabel;
            return;
        }

        var reader = new FileReader();
        reader.onload = function (event) {
            if (preview) preview.src = event.target.result;
            if (previewContainer) previewContainer.classList.remove('d-none');
            if (label) label.textContent = file.name;
        };
        reader.readAsDataURL(file);
    }

    if (uploadBox && input) {
        uploadBox.addEventListener('click', function () {
            input.click();
        });

        input.addEventListener('change', function () {
            var file = this.files && this.files[0];
            showPreview(file);
        });

        ['dragenter', 'dragover'].forEach(function (evt) {
            uploadBox.addEventListener(evt, function (e) {
                e.preventDefault();
                uploadBox.classList.add('dragover');
            });
        });

        ['dragleave', 'drop'].forEach(function (evt) {
            uploadBox.addEventListener(evt, function (e) {
                e.preventDefault();
                uploadBox.classList.remove('dragover');
            });
        });

        uploadBox.addEventListener('drop', function (e) {
            if (e.dataTransfer && e.dataTransfer.files && e.dataTransfer.files.length) {
                input.files = e.dataTransfer.files;
                showPreview(input.files[0]);
            }
        });
    }

    // Penghitung karakter deskripsi
    var textarea = document.getElementById('carousel-deskripsi');
    var counter = document.getElementById('deskripsi-count');
    if (textarea && counter) {
        var updateCount = function () { counter.textContent = textarea.value.length; };
        textarea.addEventListener('input', updateCount);
        updateCount();
    }

    // Toggle status tayang
    var toggle = document.getElementById('status-toggle');
    var statusInput = document.getElementById('status-input');

    function setStatus(active) {
        if (!toggle || !statusInput) return;
        toggle.classList.toggle('is-active', active);
        toggle.setAttribute('aria-checked', active ? 'true' : 'false');
        statusInput.value = active ? 'aktif' : 'nonaktif';

        var icon = toggle.querySelector('.status-toggle-icon i');
        var titleEl = toggle.querySelector('.status-toggle-text strong');
        var descEl = toggle.querySelector('.status-toggle-text span');
        if (icon) icon.className = active ? 'fa-solid fa-circle-check' : 'fa-solid fa-circle-xmark';
        if (titleEl) titleEl.textContent = active ? 'Aktif' : 'Nonaktif';
        if (descEl) descEl.textContent = active ? 'Banner akan ditampilkan' : 'Banner tidak ditampilkan';
    }

    if (toggle) {
        toggle.addEventListener('click', function () {
            setStatus(toggle.getAttribute('aria-checked') !== 'true');
        });
        toggle.addEventListener('keydown', function (e) {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                setStatus(toggle.getAttribute('aria-checked') !== 'true');
            }
        });
    }

    // Loading state tombol simpan
    var form = document.getElementById('carousel-form');
    if (form) {
        form.addEventListener('submit', function () {
            var btn = form.querySelector('.btn-save');
            if (btn) {
                btn.classList.add('is-loading');
                btn.setAttribute('disabled', 'disabled');
            }
        });
    }
})();
</script>

<?php $this->load->view('admin/template/footer'); ?>