<?php $this->load->view('admin/template/header'); ?>
<?php $this->load->view('admin/template/sidebar'); ?>

<div class="main-content">
    <?php $this->load->view('admin/template/navbar'); ?>

    <div class="content-wrapper">

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
                    <i class="fa-solid fa-file-pen"></i>
                </div>
                <div>
                    <span class="badge-header-tag mb-1">
                        <i class="fa-solid fa-pen-to-square me-1"></i> Form Edit
                    </span>
                    <h2 class="page-title">Edit Berita</h2>
                    <p class="page-subtitle">Perbarui informasi dan publikasi berita sekolah.</p>
                </div>
            </div>
            <a href="<?= site_url('admin/berita'); ?>" class="btn-back">
                <i class="fa-solid fa-arrow-left me-2"></i>
                Kembali
            </a>
        </div>

        <!-- FORM CARD -->
        <div class="custom-card mb-4">

            <div class="card-title-custom">
                <div class="title-icon">
                    <i class="fa-solid fa-newspaper"></i>
                </div>
                <div>
                    <h5>Informasi Berita</h5>
                    <small>Perbarui data berita sekolah</small>
                </div>
            </div>

            <div class="card-body-custom">
                <form action="<?= site_url('admin/berita/update/' . $berita->id); ?>" method="POST" enctype="multipart/form-data">

                    <div class="row g-4">

                        <!-- JUDUL -->
                        <div class="col-md-12">
                            <label class="form-label required">Judul Berita</label>
                            <div class="input-icon-group">
                                <i class="fa-solid fa-heading input-icon"></i>
                                <input type="text" name="judul" class="form-control with-icon" value="<?= html_escape($berita->judul); ?>" placeholder="Masukkan judul berita" required>
                            </div>
                        </div>

                        <!-- KATEGORI -->
                        <div class="col-md-6">
                            <label class="form-label">Kategori</label>
                            <div class="input-icon-group">
                                <i class="fa-solid fa-layer-group input-icon"></i>
                                <select name="kategori_id" class="form-select custom-select with-icon">
                                    <option value="">Umum</option>
                                    <?php foreach ($kategori as $item): ?>
                                        <option value="<?= $item->id; ?>" <?= (string) $berita->kategori_id === (string) $item->id ? 'selected' : ''; ?>>
                                            <?= html_escape($item->nama); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <!-- TANGGAL -->
                        <div class="col-md-6">
                            <label class="form-label">Tanggal</label>
                            <div class="input-icon-group">
                                <i class="fa-solid fa-calendar-days input-icon"></i>
                                <input type="date" name="tanggal" class="form-control with-icon" value="<?= html_escape($berita->tanggal); ?>">
                            </div>
                        </div>

                        <!-- THUMBNAIL -->
                        <div class="col-12">
                            <label class="form-label">Thumbnail Berita <small class="text-muted fw-normal">(Biarkan kosong jika tidak ingin mengganti)</small></label>
                            <div class="upload-dropzone" id="berita-thumbnail-upload" role="button" tabindex="0" aria-label="Pilih thumbnail berita">
                                <input type="file" name="thumbnail" id="berita-thumbnail-input" class="d-none" accept="image/png, image/jpeg, image/jpg, image/webp">
                                <input type="hidden" name="thumbnail_lama" value="<?= html_escape($berita->thumbnail ?? ''); ?>">

                                <?php 
                                    $foto_src = '#';
                                    if (!empty($berita->thumbnail)) {
                                        if (strpos($berita->thumbnail, 'uploads/') !== false || strpos($berita->thumbnail, 'assets/') !== false) {
                                            $foto_src = base_url($berita->thumbnail);
                                        } else {
                                            $foto_src = base_url('assets/img/' . ltrim($berita->thumbnail, '/'));
                                        }
                                    }
                                ?>

                                <div class="upload-content text-center <?= (!empty($berita->thumbnail)) ? 'd-none' : ''; ?>" id="uploadPlaceholder">
                                    <div class="upload-icon-circle mb-2">
                                        <i class="fa-solid fa-cloud-arrow-up"></i>
                                    </div>
                                    <p class="upload-text mb-1"><strong>Klik atau seret file ke sini untuk mengunggah</strong></p>
                                    <span class="upload-subtext">PNG, JPG, JPEG, atau WEBP (Maksimal 2MB)</span>
                                </div>

                                <div class="preview-container <?= (empty($berita->thumbnail)) ? 'd-none' : ''; ?> text-center" id="previewWrapper">
                                    <img id="imgPreview" src="<?= $foto_src; ?>" alt="Preview Foto" class="preview-avatar mb-2" onerror="this.src='https://via.placeholder.com/150?text=No+Image';">
                                    <div class="d-flex align-items-center justify-content-center gap-2">
                                        <span class="preview-filename text-truncate d-inline-block" style="max-width: 250px;" id="previewFilename">
                                            <?= basename($berita->thumbnail ?? 'thumbnail.jpg'); ?>
                                        </span>
                                        <span class="badge bg-primary fs-8">Ganti Foto</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- STATUS -->
                        <div class="col-md-6">
                            <label class="form-label">Status Publikasi</label>
                            <div class="gender-selector">
                                <label class="gender-option">
                                    <input type="radio" name="status" value="publish" <?= (isset($berita->status) && $berita->status == 'publish') ? 'checked' : ''; ?>>
                                    <div class="gender-box status-publish">
                                        <i class="fa-solid fa-circle-check"></i>
                                        <span>Publish</span>
                                    </div>
                                </label>
                                <label class="gender-option">
                                    <input type="radio" name="status" value="draft" <?= (isset($berita->status) && $berita->status == 'draft') ? 'checked' : ''; ?>>
                                    <div class="gender-box status-draft">
                                        <i class="fa-solid fa-clock"></i>
                                        <span>Draft</span>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <!-- ISI BERITA -->
                        <div class="col-12">
                            <label class="form-label">Isi Berita</label>
                            <div class="input-icon-group">
                                <i class="fa-solid fa-align-left input-icon textarea-icon"></i>
                                <textarea name="isi" class="form-control custom-textarea with-icon" rows="6" placeholder="Tuliskan isi berita di sini..."><?= html_escape($berita->isi ?? ''); ?></textarea>
                            </div>
                        </div>

                    </div>

                    <!-- FOOTER -->
                    <div class="form-footer mt-4">
                        <a href="<?= site_url('admin/berita'); ?>" class="btn-cancel">
                            <i class="fa-solid fa-xmark me-2"></i> Batal
                        </a>
                        <button type="submit" class="btn-save">
                            <span class="btn-save-content">
                                <i class="fa-solid fa-floppy-disk me-2"></i>
                                Simpan Perubahan
                            </span>
                            <span class="btn-save-spinner"></span>
                        </button>
                    </div>

                </form>
            </div>

        </div>

    </div>
</div>

<style>
/* -----------------------------------------------------------------
   BERITA EDIT - UNIFIED THEMING
----------------------------------------------------------------- */
:root {
    --berita-bg: #f8fafc;
    --berita-card-bg: #ffffff;
    --berita-card-subtle: #f1f5f9;
    --berita-input-bg: #f8fafc;
    --berita-input-focus-bg: #ffffff;
    --berita-input-border: #cbd5e1;
    --berita-input-color: #0f172a;
    --berita-border: rgba(226, 232, 240, 0.8);
    --berita-title: #0f172a;
    --berita-subtitle: #64748b;
    --berita-hover: #f1f5f9;
    --berita-shadow: 0 10px 25px -5px rgba(15, 23, 42, 0.05), 0 8px 10px -6px rgba(15, 23, 42, 0.01);
    --berita-accent: #0ea5e9;
    --berita-accent-glow: rgba(14, 165, 233, 0.25);
    --berita-soft: rgba(14, 165, 233, 0.10);
    --berita-soft-border: rgba(14, 165, 233, 0.22);
    --berita-icon-muted: #94a3b8;
    --berita-danger: #dc2626;
    --dropzone-bg: #f1f5f9;
    --dropzone-border: #cbd5e1;
}

[data-bs-theme="dark"],
[data-theme="dark"],
body.dark-mode,
.dark-mode {
    --berita-bg: #070d19;
    --berita-card-bg: #0f172a;
    --berita-card-subtle: #1e293b;
    --berita-input-bg: #1e293b;
    --berita-input-focus-bg: #111827;
    --berita-input-border: rgba(255, 255, 255, 0.12);
    --berita-input-color: #f1f5f9;
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
    --dropzone-bg: #111827;
    --dropzone-border: rgba(255, 255, 255, 0.15);
}

.fs-7 { font-size: 13px; }
.fs-8 { font-size: 11px; }
.text-muted { color: var(--berita-subtitle) !important; }

/* ===================== ALERT ===================== */
.alert-custom-danger {
    background: rgba(239, 68, 68, 0.12);
    border: 1px solid rgba(239, 68, 68, 0.25);
    color: #ef4444;
    border-radius: 16px;
    padding: 16px 20px;
    backdrop-filter: blur(8px);
}

.alert-heading {
    font-weight: 700;
    margin-bottom: 0 !important;
}

.alert-icon-box {
    width: 36px;
    height: 36px;
    border-radius: 10px;
    background: rgba(239, 68, 68, 0.2);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
    flex-shrink: 0;
}

/* ===================== PAGE HEADER ===================== */
.page-header-custom {
    background: var(--berita-card-bg);
    border: 1px solid var(--berita-border);
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
    color: var(--berita-title);
    font-size: 22px;
    font-weight: 800;
    margin: 0 0 2px;
    letter-spacing: -0.3px;
}

.page-subtitle {
    color: var(--berita-subtitle);
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

.btn-back {
    display: inline-flex;
    align-items: center;
    background: var(--berita-card-subtle);
    color: var(--berita-title);
    border: 1px solid var(--berita-border);
    text-decoration: none;
    padding: 10px 20px;
    border-radius: 12px;
    font-size: 13px;
    font-weight: 600;
    transition: all 0.25s ease;
}

.btn-back:hover {
    background: var(--berita-hover);
    color: var(--berita-accent);
    transform: translateX(-3px);
}

/* ===================== CARD ===================== */
.custom-card {
    background: var(--berita-card-bg);
    border: 1px solid var(--berita-border);
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

.card-title-custom {
    display: flex;
    align-items: center;
    gap: 14px;
    padding: 18px 24px;
    background: var(--berita-card-subtle);
    border-bottom: 1px solid var(--berita-border);
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

.card-title-custom h5 {
    margin: 0 0 2px;
    color: var(--berita-title);
    font-size: 15px;
    font-weight: 700;
}

.card-title-custom small {
    color: var(--berita-subtitle);
    font-size: 12px;
}

.card-body-custom {
    padding: 24px;
}

/* ===================== FORM ELEMENTS ===================== */
.form-label {
    color: var(--berita-title);
    font-size: 12.5px;
    font-weight: 700;
    margin-bottom: 8px;
}

.form-label.required::after {
    content: " *";
    color: #ef4444;
}

.form-label small {
    font-weight: 400;
}

.input-icon-group {
    position: relative;
    display: flex;
    align-items: center;
}

.input-icon-group .input-icon {
    position: absolute;
    left: 14px;
    color: var(--berita-icon-muted);
    font-size: 14px;
    pointer-events: none;
    transition: color 0.25s ease;
}

.form-control,
.form-select {
    background-color: var(--berita-input-bg);
    border: 1px solid var(--berita-input-border);
    border-radius: 12px;
    font-size: 13.5px;
    color: var(--berita-input-color);
    padding: 10px 16px;
    transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
}

.form-control.with-icon {
    padding-left: 42px;
}

.form-control:focus,
.form-select:focus {
    background-color: var(--berita-input-focus-bg);
    border-color: var(--berita-accent);
    color: var(--berita-input-color);
    box-shadow: 0 0 0 4px var(--berita-accent-glow);
    outline: none;
}

.input-icon-group:focus-within .input-icon {
    color: var(--berita-accent);
}

.form-control::placeholder {
    color: var(--berita-subtitle);
    opacity: 0.6;
}

.custom-select {
    cursor: pointer;
}

.custom-textarea {
    resize: vertical;
    min-height: 120px;
    line-height: 1.6;
}

.textarea-icon {
    top: 18px;
    transform: none;
}

/* ===================== DROPZONE ===================== */
.upload-dropzone {
    border: 2px dashed var(--dropzone-border);
    background-color: var(--dropzone-bg);
    border-radius: 16px;
    padding: 24px;
    cursor: pointer;
    transition: all 0.25s ease;
}

.upload-dropzone:hover {
    border-color: var(--berita-accent);
    background-color: var(--berita-card-subtle);
}

.upload-icon-circle {
    width: 44px;
    height: 44px;
    border-radius: 50%;
    background: var(--berita-soft);
    color: var(--berita-accent);
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
    transition: transform 0.3s ease;
}

.upload-dropzone:hover .upload-icon-circle {
    transform: translateY(-3px);
}

.upload-text {
    color: var(--berita-title);
    font-size: 13.5px;
}

.upload-subtext {
    color: var(--berita-subtitle);
    font-size: 11.5px;
}

.preview-avatar {
    width: 90px;
    height: 90px;
    object-fit: cover;
    border-radius: 50%;
    border: 3px solid var(--berita-accent);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}

.preview-filename {
    font-size: 12px;
    color: var(--berita-title);
}

/* ===================== GENDER SELECTOR (STATUS) ===================== */
.gender-selector {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 10px;
}

.gender-option input {
    display: none;
}

.gender-box {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    padding: 10px 14px;
    background: var(--berita-input-bg);
    border: 1px solid var(--berita-input-border);
    border-radius: 12px;
    cursor: pointer;
    font-size: 13px;
    font-weight: 600;
    color: var(--berita-subtitle);
    transition: all 0.2s ease;
}

.gender-option input:checked + .gender-box {
    background: var(--berita-soft);
    border-color: var(--berita-accent);
    color: var(--berita-accent);
}

.status-publish {
    color: #10b981;
}

.gender-option input:checked + .status-publish {
    color: #10b981;
}

.status-draft {
    color: #f59e0b;
}

.gender-option input:checked + .status-draft {
    color: #f59e0b;
}

/* ===================== FOOTER ===================== */
.form-footer {
    padding: 18px 24px;
    background: var(--berita-card-subtle);
    border-top: 1px solid var(--berita-border);
    display: flex;
    align-items: center;
    justify-content: flex-end;
    gap: 12px;
}

.btn-cancel {
    background: var(--berita-card-bg);
    border: 1px solid var(--berita-border);
    color: var(--berita-title);
    text-decoration: none;
    border-radius: 12px;
    padding: 11px 22px;
    font-size: 13px;
    font-weight: 600;
    transition: all 0.2s ease;
}

.btn-cancel:hover {
    background: var(--berita-hover);
    color: #ef4444;
}

.btn-save {
    border: none;
    background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%);
    color: #ffffff;
    border-radius: 12px;
    padding: 11px 26px;
    font-size: 13px;
    font-weight: 700;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(2, 132, 199, 0.3);
    cursor: pointer;
    position: relative;
    overflow: hidden;
}

.btn-save:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 22px rgba(2, 132, 199, 0.45);
    color: #ffffff;
}

.btn-save-content {
    display: inline-flex;
    align-items: center;
    transition: opacity 0.2s ease;
}

.btn-save.is-loading .btn-save-content {
    opacity: 0;
}

.btn-save.is-loading {
    pointer-events: none;
}

.btn-save-spinner {
    position: absolute;
    top: 50%;
    left: 50%;
    width: 18px;
    height: 18px;
    margin: -9px 0 0 -9px;
    border: 2.5px solid rgba(255, 255, 255, 0.35);
    border-top-color: #ffffff;
    border-radius: 50%;
    opacity: 0;
    animation: beritaSpin 0.7s linear infinite;
}

.btn-save.is-loading .btn-save-spinner {
    opacity: 1;
}

@keyframes beritaSpin {
    to {
        transform: rotate(360deg);
    }
}

/* ===================== RESPONSIVE ===================== */
@media (max-width: 768px) {
    .page-header-custom {
        flex-direction: column;
        align-items: stretch;
    }

    .btn-back {
        width: 100%;
        justify-content: center;
    }

    .card-body-custom,
    .card-title-custom,
    .form-footer {
        padding: 20px 18px;
    }

    .form-footer {
        flex-direction: column-reverse;
        align-items: stretch;
    }

    .btn-cancel,
    .btn-save {
        width: 100%;
        justify-content: center;
        text-align: center;
    }

    .gender-selector {
        grid-template-columns: 1fr;
    }
}

/* ===================== AUTO-DISMISS ALERT ===================== */
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
    background: #ef4444;
    transform-origin: left;
    animation-name: beritaAlertProgress;
    animation-timing-function: linear;
    animation-fill-mode: forwards;
}

@keyframes beritaAlertProgress {
    from {
        transform: scaleX(1);
    }
    to {
        transform: scaleX(0);
    }
}

@media (prefers-reduced-motion: reduce) {
    .alert-autodismiss,
    .custom-card,
    .page-header-icon,
    .upload-icon-circle,
    .btn-save-spinner {
        animation: none !important;
        transition: none !important;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const fotoInput = document.getElementById('berita-thumbnail-input');
    const imgPreview = document.getElementById('imgPreview');
    const previewFilename = document.getElementById('previewFilename');
    const uploadPlaceholder = document.getElementById('uploadPlaceholder');
    const previewWrapper = document.getElementById('previewWrapper');
    const dropzone = document.getElementById('berita-thumbnail-upload');

    function showPreview(file) {
        if (!file) return;
        const reader = new FileReader();
        reader.onload = function (event) {
            imgPreview.src = event.target.result;
            previewFilename.textContent = file.name;
            uploadPlaceholder.classList.add('d-none');
            previewWrapper.classList.remove('d-none');
        };
        reader.readAsDataURL(file);
    }

    if (fotoInput && dropzone) {
        dropzone.addEventListener('click', function (event) {
            if (event.target !== fotoInput) fotoInput.click();
        });
        dropzone.addEventListener('keydown', function (event) {
            if (event.key === 'Enter' || event.key === ' ') {
                event.preventDefault();
                fotoInput.click();
            }
        });
        fotoInput.addEventListener('change', function (e) {
            const file = e.target.files[0];
            if (file) showPreview(file);
        });
    }

    if (dropzone && fotoInput) {
        ['dragenter', 'dragover'].forEach(function (evt) {
            dropzone.addEventListener(evt, function (e) {
                e.preventDefault();
                dropzone.classList.add('dragover');
            });
        });
        ['dragleave', 'drop'].forEach(function (evt) {
            dropzone.addEventListener(evt, function (e) {
                e.preventDefault();
                dropzone.classList.remove('dragover');
            });
        });
        dropzone.addEventListener('drop', function (e) {
            if (e.dataTransfer && e.dataTransfer.files && e.dataTransfer.files.length) {
                fotoInput.files = e.dataTransfer.files;
                showPreview(e.dataTransfer.files[0]);
            }
        });
    }

    // Auto-dismiss notifikasi error
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

    // Loading state saat form disimpan
    var form = document.querySelector('form');
    var btnSubmit = document.querySelector('.btn-save');
    if (form && btnSubmit) {
        form.addEventListener('submit', function () {
            btnSubmit.classList.add('is-loading');
        });
    }
});
</script>

<?php $this->load->view('admin/template/footer'); ?>