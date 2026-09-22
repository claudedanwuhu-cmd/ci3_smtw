<?php $this->load->view('admin/template/header'); ?>
<?php $this->load->view('admin/template/sidebar'); ?>

<div class="main-content">

    <?php $this->load->view('admin/template/navbar'); ?>

    <div class="content-wrapper">

        <!-- FLASH MESSAGE -->
        <?php if ($this->session->flashdata('error')): ?>
            <div class="alert alert-custom-danger alert-dismissible fade show mb-4 alert-autodismiss"
                 role="alert"
                 data-autodismiss="6000">

                <div class="d-flex align-items-center gap-3">
                    <div class="alert-icon-box">
                        <i class="fa-solid fa-circle-exclamation"></i>
                    </div>

                    <div>
                        <h6 class="alert-heading mb-0">
                            Gagal Memproses Data
                        </h6>

                        <span class="fs-7">
                            <?= html_escape($this->session->flashdata('error')); ?>
                        </span>
                    </div>
                </div>

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="alert"
                        aria-label="Close"></button>

                <div class="alert-progress-track">
                    <div class="alert-progress-bar"></div>
                </div>

            </div>
        <?php endif; ?>

        <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-custom-success alert-dismissible fade show mb-4 alert-autodismiss"
                 role="alert"
                 data-autodismiss="6000">

                <div class="d-flex align-items-center gap-3">
                    <div class="alert-icon-box">
                        <i class="fa-solid fa-circle-check"></i>
                    </div>

                    <div>
                        <h6 class="alert-heading mb-0">
                            Berhasil
                        </h6>

                        <span class="fs-7">
                            <?= html_escape($this->session->flashdata('success')); ?>
                        </span>
                    </div>
                </div>

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="alert"
                        aria-label="Close"></button>

                <div class="alert-progress-track">
                    <div class="alert-progress-bar"></div>
                </div>

            </div>
        <?php endif; ?>

        <!-- PAGE HEADER -->
        <div class="page-header-custom mb-4">

            <div class="d-flex align-items-center gap-3">

                <div class="page-header-icon">
                    <i class="fa-solid fa-building-circle-check"></i>
                </div>

                <div>

                    <span class="badge-header-tag mb-1">
                        <i class="fa-solid fa-pen-to-square me-1"></i>
                        Form Edit
                    </span>

                    <h2 class="page-title">
                        Edit Fasilitas
                    </h2>

                    <p class="page-subtitle">
                        Perbarui informasi fasilitas sekolah yang telah terdaftar.
                    </p>

                </div>

            </div>

            <a href="<?= site_url('admin/fasilitas'); ?>"
               class="btn-back">

                <i class="fa-solid fa-arrow-left me-2"></i>
                Kembali

            </a>

        </div>

        <!-- FORM -->
        <form
            id="form-edit-fasilitas"
            action="<?= site_url('admin/fasilitas/update/' . (int) $fasilitas->id); ?>"
            method="POST"
            enctype="multipart/form-data"
        >

            <div class="custom-card mb-4">

                <!-- CARD HEADER -->
                <div class="card-title-custom">

                    <div class="title-icon">
                        <i class="fa-solid fa-building"></i>
                    </div>

                    <div>

                        <h5>Informasi Fasilitas</h5>

                        <small>
                            Perbarui data fasilitas sesuai informasi terbaru.
                        </small>

                    </div>

                </div>

                <!-- CARD BODY -->
                <div class="card-body-custom">

                    <div class="row g-4">

                        <!-- NAMA FASILITAS -->
                        <div class="col-md-8">

                            <label
                                for="nama_fasilitas"
                                class="form-label required"
                            >
                                Nama Fasilitas
                            </label>

                            <div class="input-icon-group">

                                <i class="fa-solid fa-building input-icon"></i>

                                <input
                                    type="text"
                                    name="nama_fasilitas"
                                    id="nama_fasilitas"
                                    class="form-control with-icon"
                                    value="<?= html_escape($fasilitas->nama_fasilitas ?? ''); ?>"
                                    placeholder="Masukkan nama fasilitas..."
                                    required
                                >

                            </div>

                        </div>

                        <!-- STATUS -->
                        <div class="col-md-4">

                            <label
                                for="status"
                                class="form-label"
                            >
                                Status Fasilitas
                            </label>

                            <select
                                name="status"
                                id="status"
                                class="form-select custom-select"
                            >

                                <option
                                    value="aktif"
                                    <?= ($fasilitas->status ?? '') === 'aktif' ? 'selected' : ''; ?>
                                >
                                    🟢 Aktif
                                </option>

                                <option
                                    value="nonaktif"
                                    <?= ($fasilitas->status ?? '') === 'nonaktif' ? 'selected' : ''; ?>
                                >
                                    🔴 Nonaktif
                                </option>

                            </select>

                        </div>

                        <!-- FOTO -->
                        <div class="col-md-12">

                            <label class="form-label">

                                Upload Foto Fasilitas

                                <small class="text-muted fw-normal">
                                    (Kosongkan jika tidak ingin mengganti)
                                </small>

                            </label>

                            <div
                                class="upload-dropzone"
                                id="facility-dropzone"
                                role="button"
                                tabindex="0"
                                aria-label="Pilih foto fasilitas"
                            >

                                <input
                                    type="file"
                                    name="foto"
                                    id="facility-foto-input"
                                    class="d-none"
                                    accept="image/png,image/jpeg,image/jpg,image/webp,image/avif"
                                >

                                <input
                                    type="hidden"
                                    name="foto_lama"
                                    value="<?= html_escape($fasilitas->foto ?? ''); ?>"
                                >

                                <!-- PLACEHOLDER -->
                                <div
                                    class="upload-content text-center <?= !empty($fasilitas->foto) ? 'd-none' : ''; ?>"
                                    id="facility-upload-placeholder"
                                >

                                    <div class="upload-icon-circle mb-2">
                                        <i class="fa-solid fa-cloud-arrow-up"></i>
                                    </div>

                                    <p class="upload-text mb-1">
                                        <strong>
                                            Klik atau seret file ke sini untuk mengunggah
                                        </strong>
                                    </p>

                                    <span class="upload-subtext">
                                        PNG, JPG, JPEG, WEBP, atau AVIF
                                        (Maksimal 10MB)
                                    </span>

                                </div>

                                <?php
                                    $foto_src = '#';

                                    if (!empty($fasilitas->foto)) {
                                        $foto_src = base_url(
                                            'assets/img/fasilitas/' .
                                            rawurlencode(basename($fasilitas->foto))
                                        );
                                    }
                                ?>

                                <!-- PREVIEW -->
                                <div
                                    class="preview-container text-center <?= empty($fasilitas->foto) ? 'd-none' : ''; ?>"
                                    id="facility-preview-wrapper"
                                >

                                    <img
                                        id="facility-img-preview"
                                        src="<?= $foto_src; ?>"
                                        alt="Preview Foto Fasilitas"
                                        class="preview-avatar mb-2"
                                    >

                                    <div class="d-flex align-items-center justify-content-center gap-2">

                                        <span
                                            class="preview-filename text-truncate d-inline-block"
                                            style="max-width: 250px;"
                                            id="facility-preview-filename"
                                        >
                                            <?= html_escape(basename($fasilitas->foto ?? 'foto.jpg')); ?>
                                        </span>

                                        <span class="badge bg-primary fs-8">
                                            Ganti Foto
                                        </span>

                                    </div>

                                </div>

                            </div>

                        </div>

                        <!-- DESKRIPSI -->
                        <div class="col-md-12">

                            <label
                                for="deskripsi"
                                class="form-label"
                            >
                                Deskripsi Fasilitas
                            </label>

                            <textarea
                                name="deskripsi"
                                id="deskripsi"
                                class="form-control custom-textarea"
                                rows="4"
                                placeholder="Tuliskan informasi mengenai fasilitas..."
                            ><?= html_escape($fasilitas->deskripsi ?? ''); ?></textarea>

                        </div>

                    </div>

                </div>

                <!-- FOOTER -->
                <div class="form-footer">

                    <a
                        href="<?= site_url('admin/fasilitas'); ?>"
                        class="btn-cancel"
                    >
                        <i class="fa-solid fa-xmark me-2"></i>
                        Batal
                    </a>

                    <button
                        type="submit"
                        id="btn-submit-fasilitas"
                        class="btn-save"
                    >

                        <span class="btn-save-content">
                            <i class="fa-solid fa-floppy-disk me-2"></i>
                            Simpan Perubahan
                        </span>

                        <span class="btn-save-spinner"></span>

                    </button>

                </div>

            </div>

        </form>

    </div>

</div>

<style>

:root {

    --facility-bg: #f8fafc;
    --facility-card-bg: #ffffff;
    --facility-card-subtle: #f8fafc;
    --facility-input-bg: #f8fafc;
    --facility-input-border: #cbd5e1;
    --facility-input-color: #0f172a;
    --facility-input-focus-bg: #ffffff;
    --facility-border: rgba(226, 232, 240, .8);
    --facility-title: #0f172a;
    --facility-subtitle: #64748b;
    --facility-hover: #f1f5f9;
    --facility-shadow:
        0 10px 25px -5px rgba(15, 23, 42, .05),
        0 8px 10px -6px rgba(15, 23, 42, .01);
    --facility-accent: #0ea5e9;
    --facility-accent-glow: rgba(14, 165, 233, .25);
    --facility-icon-muted: #94a3b8;
    --facility-dropzone-bg: #f1f5f9;
    --facility-dropzone-border: #cbd5e1;

}

[data-bs-theme="dark"],
[data-theme="dark"],
body.dark-mode,
.dark-mode {

    --facility-bg: #070d19;
    --facility-card-bg: #0f172a;
    --facility-card-subtle: #1e293b;
    --facility-input-bg: #1e293b;
    --facility-input-border: rgba(255, 255, 255, .12);
    --facility-input-color: #f1f5f9;
    --facility-input-focus-bg: #111827;
    --facility-border: rgba(255, 255, 255, .08);
    --facility-title: #f8fafc;
    --facility-subtitle: #94a3b8;
    --facility-hover: #1e293b;
    --facility-shadow: 0 12px 30px -5px rgba(0, 0, 0, .4);
    --facility-accent: #38bdf8;
    --facility-accent-glow: rgba(56, 189, 248, .25);
    --facility-icon-muted: #64748b;
    --facility-dropzone-bg: #111827;
    --facility-dropzone-border: rgba(255, 255, 255, .15);

}

.fs-7 {
    font-size: 13px;
}

.fs-8 {
    font-size: 11px;
}

/* ALERT */

.alert-custom-danger,
.alert-custom-success {

    position: relative;
    overflow: hidden;
    border-radius: 16px;
    padding: 16px 20px;
    backdrop-filter: blur(8px);

}

.alert-custom-danger {

    background: rgba(239, 68, 68, .12);
    border: 1px solid rgba(239, 68, 68, .25);
    color: #ef4444;

}

.alert-custom-success {

    background: rgba(16, 185, 129, .12);
    border: 1px solid rgba(16, 185, 129, .25);
    color: #10b981;

}

.alert-icon-box {

    width: 36px;
    height: 36px;
    border-radius: 10px;
    background: rgba(239, 68, 68, .2);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
    flex-shrink: 0;

}

.alert-progress-track {

    position: absolute;
    left: 0;
    right: 0;
    bottom: 0;
    height: 3px;
    background: rgba(148, 163, 184, .2);

}

.alert-progress-bar {

    height: 100%;
    width: 100%;
    background: currentColor;
    transform-origin: left;
    animation: facilityAlertProgress linear forwards;

}

@keyframes facilityAlertProgress {

    from {
        transform: scaleX(1);
    }

    to {
        transform: scaleX(0);
    }

}

/* HEADER */

.page-header-custom {

    position: relative;
    overflow: hidden;
    background: var(--facility-card-bg);
    border: 1px solid var(--facility-border);
    border-radius: 20px;
    padding: 22px 28px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    box-shadow: var(--facility-shadow);
    gap: 20px;

}

.page-header-custom::before {

    content: "";
    position: absolute;
    inset: 0 auto 0 0;
    width: 4px;
    background: linear-gradient(
        180deg,
        var(--facility-accent),
        #0369a1
    );

}

.page-header-icon {

    width: 50px;
    height: 50px;
    border-radius: 14px;
    background: var(--facility-card-subtle);
    border: 1px solid var(--facility-border);
    color: var(--facility-accent);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 22px;
    flex-shrink: 0;
    transition: transform .35s ease;

}

.page-header-custom:hover .page-header-icon {

    transform: rotate(-6deg) scale(1.06);

}

.badge-header-tag {

    display: inline-flex;
    align-items: center;
    background: rgba(14, 165, 233, .1);
    color: var(--facility-accent);
    border: 1px solid rgba(14, 165, 233, .2);
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: .5px;

}

.page-title {

    color: var(--facility-title);
    font-size: 22px;
    font-weight: 800;
    margin: 0 0 2px;
    letter-spacing: -.3px;

}

.page-subtitle {

    color: var(--facility-subtitle);
    font-size: 13px;
    margin: 0;

}

.btn-back {

    display: inline-flex;
    align-items: center;
    background: var(--facility-card-subtle);
    color: var(--facility-title);
    border: 1px solid var(--facility-border);
    text-decoration: none;
    padding: 10px 20px;
    border-radius: 12px;
    font-size: 13px;
    font-weight: 600;
    transition: all .25s ease;

}

.btn-back:hover {

    background: var(--facility-hover);
    color: var(--facility-accent);
    transform: translateX(-3px);

}

/* CARD */

.custom-card {

    background: var(--facility-card-bg);
    border: 1px solid var(--facility-border);
    border-radius: 20px;
    overflow: hidden;
    box-shadow: var(--facility-shadow);
    animation: facilityFadeUp .4s ease both;

}

@keyframes facilityFadeUp {

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
    background: var(--facility-card-subtle);
    border-bottom: 1px solid var(--facility-border);

}

.title-icon {

    width: 40px;
    height: 40px;
    background: rgba(14, 165, 233, .12);
    border-radius: 12px;
    color: var(--facility-accent);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 16px;
    flex-shrink: 0;

}

.card-title-custom h5 {

    margin: 0 0 2px;
    color: var(--facility-title);
    font-size: 15px;
    font-weight: 700;

}

.card-title-custom small {

    color: var(--facility-subtitle);
    font-size: 12px;

}

.card-body-custom {

    padding: 24px;

}

/* FORM */

.form-label {

    color: var(--facility-title);
    font-size: 12.5px;
    font-weight: 700;
    margin-bottom: 8px;

}

.form-label.required::after {

    content: " *";
    color: #ef4444;

}

.input-icon-group {

    position: relative;
    display: flex;
    align-items: center;

}

.input-icon-group .input-icon {

    position: absolute;
    left: 14px;
    color: var(--facility-icon-muted);
    font-size: 14px;
    pointer-events: none;
    transition: color .25s ease;

}

.form-control,
.form-select {

    background-color: var(--facility-input-bg);
    border: 1px solid var(--facility-input-border);
    border-radius: 12px;
    font-size: 13.5px;
    color: var(--facility-input-color);
    padding: 10px 16px;
    transition: all .25s cubic-bezier(.4, 0, .2, 1);

}

.form-control.with-icon {

    padding-left: 42px;

}

.form-control:focus,
.form-select:focus {

    background-color: var(--facility-input-focus-bg);
    border-color: var(--facility-accent);
    color: var(--facility-input-color);
    box-shadow: 0 0 0 4px var(--facility-accent-glow);
    outline: none;

}

.form-control::placeholder {

    color: var(--facility-subtitle);
    opacity: .6;

}

.input-icon-group:focus-within .input-icon {

    color: var(--facility-accent);

}

.form-control:hover:not(:focus),
.form-select:hover:not(:focus) {

    border-color: var(--facility-accent);

}

.custom-textarea {

    resize: vertical;
    min-height: 90px;
    line-height: 1.6;

}

.custom-select {

    cursor: pointer;

}

/* DROPZONE */

.upload-dropzone {

    border: 2px dashed var(--facility-dropzone-border);
    background-color: var(--facility-dropzone-bg);
    border-radius: 16px;
    padding: 24px;
    cursor: pointer;
    transition: all .25s ease;

}

.upload-dropzone:hover,
.upload-dropzone.dragover {

    border-color: var(--facility-accent);
    background-color: var(--facility-card-subtle);
    box-shadow: 0 0 0 4px var(--facility-accent-glow);

}

.upload-dropzone:focus-visible {

    outline: none;
    border-color: var(--facility-accent);
    box-shadow: 0 0 0 4px var(--facility-accent-glow);

}

.upload-icon-circle {

    width: 44px;
    height: 44px;
    border-radius: 50%;
    background: rgba(14, 165, 233, .12);
    color: var(--facility-accent);
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
    transition: transform .3s ease;

}

.upload-dropzone:hover .upload-icon-circle {

    transform: translateY(-3px);

}

.upload-text {

    color: var(--facility-title);
    font-size: 13.5px;

}

.upload-subtext {

    color: var(--facility-subtitle);
    font-size: 11.5px;

}

.preview-avatar {

    width: 90px;
    height: 90px;
    object-fit: cover;
    border-radius: 14px;
    border: 3px solid var(--facility-accent);
    box-shadow: 0 4px 12px rgba(0, 0, 0, .15);

}

.preview-filename {

    font-size: 12px;
    color: var(--facility-title);

}

/* FOOTER */

.form-footer {

    padding: 18px 24px;
    background: var(--facility-card-subtle);
    border-top: 1px solid var(--facility-border);
    display: flex;
    align-items: center;
    justify-content: flex-end;
    gap: 12px;

}

.btn-cancel {

    background: var(--facility-card-bg);
    border: 1px solid var(--facility-border);
    color: var(--facility-title);
    text-decoration: none;
    border-radius: 12px;
    padding: 11px 22px;
    font-size: 13px;
    font-weight: 600;
    transition: all .2s ease;

}

.btn-cancel:hover {

    background: var(--facility-hover);
    color: #ef4444;

}

.btn-save {

    position: relative;
    overflow: hidden;
    border: none;
    background: linear-gradient(
        135deg,
        #0284c7 0%,
        #0369a1 100%
    );
    color: #ffffff;
    border-radius: 12px;
    padding: 11px 26px;
    font-size: 13px;
    font-weight: 700;
    transition: all .3s ease;
    box-shadow: 0 4px 15px rgba(2, 132, 199, .3);
    cursor: pointer;

}

.btn-save:hover {

    transform: translateY(-2px);
    box-shadow: 0 8px 22px rgba(2, 132, 199, .45);
    color: #ffffff;

}

.btn-save-content {

    display: inline-flex;
    align-items: center;
    transition: opacity .2s ease;

}

.btn-save-spinner {

    position: absolute;
    top: 50%;
    left: 50%;
    width: 18px;
    height: 18px;
    margin: -9px 0 0 -9px;
    border: 2.5px solid rgba(255, 255, 255, .35);
    border-top-color: #ffffff;
    border-radius: 50%;
    opacity: 0;
    animation: facilitySpin .7s linear infinite;

}

.btn-save.is-loading {

    pointer-events: none;

}

.btn-save.is-loading .btn-save-content {

    opacity: 0;

}

.btn-save.is-loading .btn-save-spinner {

    opacity: 1;

}

@keyframes facilitySpin {

    to {
        transform: rotate(360deg);
    }

}

/* RESPONSIVE */

@media (max-width: 768px) {

    .page-header-custom {

        flex-direction: column;
        align-items: stretch;

    }

    .btn-back {

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
        display: flex;
        justify-content: center;
        text-align: center;

    }

}

@media (prefers-reduced-motion: reduce) {

    *,
    *::before,
    *::after {

        animation: none !important;
        transition: none !important;

    }

}

</style>

<script>

document.addEventListener('DOMContentLoaded', function () {

    'use strict';

    /* PREVIEW FOTO */

    const fotoInput = document.getElementById('facility-foto-input');
    const imgPreview = document.getElementById('facility-img-preview');
    const previewFilename = document.getElementById('facility-preview-filename');
    const uploadPlaceholder = document.getElementById('facility-upload-placeholder');
    const previewWrapper = document.getElementById('facility-preview-wrapper');
    const dropzone = document.getElementById('facility-dropzone');

    const allowedTypes = [
        'image/png',
        'image/jpeg',
        'image/jpg',
        'image/webp',
        'image/avif'
    ];

    const maxFileSize = 10 * 1024 * 1024;

    function showPreview(file) {

        if (!file) {
            return;
        }

        if (!allowedTypes.includes(file.type)) {

            alert(
                'Format file tidak valid. Gunakan PNG, JPG, JPEG, WEBP, atau AVIF.'
            );

            fotoInput.value = '';
            return;

        }

        if (file.size > maxFileSize) {

            alert('Ukuran foto maksimal 10MB.');

            fotoInput.value = '';
            return;

        }

        const reader = new FileReader();

        reader.onload = function (event) {

            imgPreview.src = event.target.result;
            imgPreview.alt = 'Preview ' + file.name;
            previewFilename.textContent = file.name;

            uploadPlaceholder.classList.add('d-none');
            previewWrapper.classList.remove('d-none');

        };

        reader.readAsDataURL(file);

    }

    if (fotoInput) {

        fotoInput.addEventListener('change', function () {

            showPreview(this.files[0]);

        });

    }

    if (dropzone && fotoInput) {

        dropzone.addEventListener('click', function (event) {

            if (event.target !== fotoInput) {
                fotoInput.click();
            }

        });

        dropzone.addEventListener('keydown', function (event) {

            if (
                event.key === 'Enter' ||
                event.key === ' '
            ) {

                event.preventDefault();
                fotoInput.click();

            }

        });

        ['dragenter', 'dragover'].forEach(function (eventName) {

            dropzone.addEventListener(eventName, function (event) {

                event.preventDefault();
                event.stopPropagation();

                dropzone.classList.add('dragover');

            });

        });

        ['dragleave', 'drop'].forEach(function (eventName) {

            dropzone.addEventListener(eventName, function (event) {

                event.preventDefault();
                event.stopPropagation();

                dropzone.classList.remove('dragover');

            });

        });

        dropzone.addEventListener('drop', function (event) {

            const files = event.dataTransfer.files;

            if (!files || !files.length) {
                return;
            }

            try {
                fotoInput.files = files;
            } catch (error) {
                // Browser tertentu membatasi assignment input.files.
            }

            showPreview(files[0]);

        });

    }

    /* AUTO DISMISS ALERT */

    document.querySelectorAll('.alert-autodismiss').forEach(function (alertEl) {

        const duration =
            parseInt(alertEl.getAttribute('data-autodismiss'), 10) || 5000;

        const progressBar =
            alertEl.querySelector('.alert-progress-bar');

        if (progressBar) {
            progressBar.style.animationDuration = duration + 'ms';
        }

        let dismissed = false;
        let remaining = duration;
        let startedAt = Date.now();

        let timer = setTimeout(closeAlert, remaining);

        function closeAlert() {

            if (dismissed) {
                return;
            }

            dismissed = true;

            alertEl.classList.add('alert-hiding');

            setTimeout(function () {

                if (alertEl.parentNode) {
                    alertEl.parentNode.removeChild(alertEl);
                }

            }, 350);

        }

        alertEl.addEventListener('mouseenter', function () {

            clearTimeout(timer);

            remaining -= Date.now() - startedAt;

            if (progressBar) {
                progressBar.style.animationPlayState = 'paused';
            }

        });

        alertEl.addEventListener('mouseleave', function () {

            if (progressBar) {
                progressBar.style.animationPlayState = 'running';
            }

            startedAt = Date.now();

            timer = setTimeout(
                closeAlert,
                Math.max(remaining, 800)
            );

        });

    });

    /* SUBMIT LOADING */

    const formEdit =
        document.getElementById('form-edit-fasilitas');

    const btnSubmit =
        document.getElementById('btn-submit-fasilitas');

    if (formEdit && btnSubmit) {

        formEdit.addEventListener('submit', function (event) {

            if (!formEdit.checkValidity()) {

                event.preventDefault();
                formEdit.reportValidity();

                return;

            }

            if (btnSubmit.classList.contains('is-loading')) {

                event.preventDefault();
                return;

            }

            btnSubmit.classList.add('is-loading');
            btnSubmit.setAttribute('disabled', 'disabled');

        });

    }

});

</script>

<?php $this->load->view('admin/template/footer'); ?>