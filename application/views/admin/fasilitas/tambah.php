<?php $this->load->view('admin/template/header'); ?>
<?php $this->load->view('admin/template/sidebar'); ?>

<div class="main-content">
    <?php $this->load->view('admin/template/navbar'); ?>

    <div class="content-wrapper">

        <!-- FLASH MESSAGE -->
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
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup notifikasi"></button>
                <div class="alert-progress-track"><div class="alert-progress-bar"></div></div>
            </div>
        <?php endif; ?>

        <!-- PAGE HEADER -->
        <div class="page-header-custom mb-4">
            <div class="d-flex align-items-center gap-3">
                <div class="page-header-icon">
                    <i class="fa-solid fa-folder-plus"></i>
                </div>
                <div>
                    <span class="badge-header-tag mb-1">
                        <i class="fa-solid fa-plus me-1"></i>Form Input
                    </span>
                    <h2 class="page-title">Tambah Fasilitas</h2>
                    <p class="page-subtitle">Tambahkan data sarana atau prasarana baru ke dalam sistem.</p>
                </div>
            </div>
            <a href="<?= site_url('admin/fasilitas'); ?>" class="btn-back" title="Kembali ke halaman fasilitas">
                <i class="fa-solid fa-arrow-left me-2"></i>
                Kembali
            </a>
        </div>

        <!-- FORM -->
        <form action="<?= site_url('admin/fasilitas/simpan'); ?>" method="post" enctype="multipart/form-data" id="form-tambah-fasilitas">

            <div class="custom-card mb-4">

                <!-- CARD HEADER -->
                <div class="card-title-custom">
                    <div class="d-flex align-items-center gap-3">
                        <div class="title-icon">
                            <i class="fa-solid fa-building"></i>
                        </div>
                        <div>
                            <h5>Informasi Fasilitas</h5>
                            <small>Lengkapi informasi fasilitas sekolah dengan benar.</small>
                        </div>
                    </div>
                </div>

                <!-- CARD BODY -->
                <div class="card-body-custom">
                    <div class="row g-4">

                        <!-- NAMA FASILITAS -->
                        <div class="col-md-8">
                            <label class="form-label required">Nama Fasilitas</label>
                            <div class="input-icon-group">
                                <i class="fa-solid fa-building input-icon"></i>
                                <input 
                                    type="text" 
                                    name="nama_fasilitas" 
                                    class="form-control with-icon" 
                                    placeholder="Contoh: Laboratorium Komputer" 
                                    maxlength="150" 
                                    required
                                >
                            </div>
                        </div>

                        <!-- STATUS KEAKTIFAN -->
                        <div class="col-md-4">
                            <label class="form-label"><i class="fa-solid fa-toggle-on me-1 text-primary"></i> Status Keaktifan</label>
                            <div class="status-toggle-card" id="statusToggle" role="switch" tabindex="0" aria-pressed="true">
                                <input type="hidden" name="status" id="statusInput" value="aktif">
                                <div class="status-toggle-info">
                                    <div class="status-toggle-icon active" id="statusIcon">
                                        <i class="fa-solid fa-circle-check"></i>
                                    </div>
                                    <div>
                                        <strong id="statusLabel">Aktif</strong>
                                        <small id="statusDescription">Fasilitas tersedia dan dapat digunakan.</small>
                                    </div>
                                </div>
                                <div class="custom-switch active" id="customSwitch">
                                    <div class="switch-knob">
                                        <i class="fa-solid fa-check"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- FOTO FASILITAS -->
                        <div class="col-12">
                            <label class="form-label">Foto Fasilitas</label>
                            <div class="upload-dropzone" id="facility-dropzone" role="button" tabindex="0" aria-label="Unggah foto fasilitas">
                                <input 
                                    type="file" 
                                    name="foto" 
                                    id="facility-foto-input" 
                                    class="d-none" 
                                    accept="image/png,image/jpeg,image/jpg,image/webp"
                                >
                                <div class="upload-content" id="facility-upload-placeholder">
                                    <div class="upload-icon-circle">
                                        <i class="fa-solid fa-cloud-arrow-up"></i>
                                    </div>
                                    <p class="upload-text mb-1"><strong>Klik atau seret file ke sini untuk mengunggah</strong></p>
                                    <span class="upload-subtext">PNG, JPG, JPEG, atau WEBP (Maksimal 5MB)</span>
                                </div>
                                <div class="preview-container d-none text-center" id="facility-preview-wrapper">
                                    <img id="facility-img-preview" src="#" alt="Preview Foto Fasilitas" class="preview-avatar mb-2">
                                    <div class="d-flex align-items-center justify-content-center gap-2">
                                        <span class="preview-filename text-truncate" id="facility-preview-filename">foto.jpg</span>
                                        <span class="badge bg-primary fs-8">Ganti Foto</span>
                                    </div>
                                </div>
                            </div>
                            <small class="form-hint">
                                <i class="fa-solid fa-circle-info"></i>
                                Pilih foto fasilitas dari perangkat Anda. Foto lama akan dihapus.
                            </small>
                        </div>

                        <!-- DESKRIPSI -->
                        <div class="col-12">
                            <label class="form-label">Deskripsi Fasilitas</label>
                            <textarea 
                                name="deskripsi" 
                                class="form-control custom-textarea" 
                                rows="4" 
                                maxlength="1000" 
                                placeholder="Tuliskan informasi singkat mengenai fasilitas ini..."></textarea>
                            <small class="form-hint">
                                Maksimal 1000 karakter
                            </small>
                        </div>

                    </div>
                </div>

                <!-- FORM FOOTER -->
                <div class="form-footer">
                    <a href="<?= site_url('admin/fasilitas'); ?>" class="btn-cancel" title="Batal dan kembali">
                        <i class="fa-solid fa-xmark me-2"></i>Batal
                    </a>
                    <button type="submit" class="btn-save" id="btn-submit-fasilitas" title="Simpan data fasilitas">
                        <span class="btn-save-content">
                            <i class="fa-solid fa-floppy-disk me-2"></i>Simpan Fasilitas
                        </span>
                        <span class="btn-save-spinner"></span>
                    </button>
                </div>

            </div>
        </form>

    </div>
</div>

<style>
/* ===================== DESIGN TOKENS ===================== */
:root {
    --facility-card: #ffffff;
    --facility-subtle: #f8fafc;
    --facility-input-bg: #f8fafc;
    --facility-input-focus: #ffffff;
    --facility-input-border: #cbd5e1;
    --facility-border: rgba(226, 232, 240, .8);
    --facility-title: #0f172a;
    --facility-subtitle: #64748b;
    --facility-hover: #f1f5f9;
    --facility-accent: #0ea5e9;
    --facility-glow: rgba(14, 165, 233, .25);
    --facility-soft: rgba(14, 165, 233, .10);
    --facility-soft-border: rgba(14, 165, 233, .22);
    --facility-icon-muted: #94a3b8;
    --facility-success: #059669;
    --facility-danger: #dc2626;
    --facility-shadow: 0 10px 25px -5px rgba(15, 23, 42, .05), 0 8px 10px -6px rgba(15, 23, 42, .02);
}

[data-bs-theme="dark"],
[data-theme="dark"],
body.dark-mode,
.dark-mode {
    --facility-card: #0f172a;
    --facility-subtle: #1e293b;
    --facility-input-bg: #1e293b;
    --facility-input-focus: #111827;
    --facility-input-border: rgba(255, 255, 255, .12);
    --facility-border: rgba(255, 255, 255, .08);
    --facility-title: #f8fafc;
    --facility-subtitle: #94a3b8;
    --facility-hover: #1e293b;
    --facility-accent: #38bdf8;
    --facility-glow: rgba(56, 189, 248, .25);
    --facility-soft: rgba(56, 189, 248, .10);
    --facility-soft-border: rgba(56, 189, 248, .22);
    --facility-icon-muted: #64748b;
    --facility-success: #34d399;
    --facility-danger: #f87171;
    --facility-shadow: 0 12px 30px -5px rgba(0, 0, 0, .4);
}

/* ===================== PAGE HEADER ===================== */
.page-header-custom {
    position: relative;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 20px;
    padding: 22px 28px;
    background: var(--facility-card);
    border: 1px solid var(--facility-border);
    border-radius: 20px;
    box-shadow: var(--facility-shadow);
}

.page-header-custom::before {
    content: "";
    position: absolute;
    inset: 0 auto 0 0;
    width: 4px;
    background: linear-gradient(180deg, var(--facility-accent), #0369a1);
}


.page-header-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 52px;
    height: 52px;
    border-radius: 16px;
    background: var(--facility-soft);
    border: 1px solid var(--facility-soft-border);
    color: var(--facility-accent);
    font-size: 22px;
    transition: transform 0.35s ease;
}

.page-header-custom:hover .page-header-icon {
    transform: rotate(-6deg) scale(1.06);
}

.badge-header-tag {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 4px 10.5px;
    background: var(--facility-soft);
    border: 1px solid var(--facility-soft-border);
    color: var(--facility-accent);
    border-radius: 20px;
    font-size: 10.5px;
    font-weight: 800;
    letter-spacing: 0.5px;
    text-transform: uppercase;
    margin-bottom: 8px;
}

.page-title {
    margin: 0 0 4px;
    color: var(--facility-title);
    font-size: 22px;
    font-weight: 800;
    letter-spacing: -0.3px;
}

.page-subtitle {
    margin: 0;
    color: var(--facility-subtitle);
    font-size: 13px;
}

.btn-back {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    padding: 10px 18px;
    text-decoration: none;
    color: var(--facility-title);
    background: var(--facility-subtle);
    border: 1px solid var(--facility-border);
    border-radius: 12px;
    font-size: 12.5px;
    font-weight: 600;
    transition: all 0.25s ease;
}

.btn-back:hover {
    color: var(--facility-accent);
    background: var(--facility-hover);
    transform: translateX(-3px);
}

/* ===================== CARD ===================== */
.custom-card {
    overflow: hidden;
    background: var(--facility-card);
    border: 1px solid var(--facility-border);
    border-radius: 20px;
    box-shadow: var(--facility-shadow);
    animation: facilityFadeUp 0.4s ease both;
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

.custom-card:hover {
    border-color: rgba(56, 189, 248, 0.3);
    box-shadow: 0 16px 34px -10px rgba(15, 23, 42, 0.12);
}

.card-title-custom {
    padding: 18px 24px;
    background: var(--facility-subtle);
    border-bottom: 1px solid var(--facility-border);
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

.title-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 42px;
    height: 42px;
    border-radius: 12px;
    background: var(--facility-soft);
    border: 1px solid var(--facility-soft-border);
    color: var(--facility-accent);
    font-size: 16px;
    flex-shrink: 0;
}

.card-body-custom {
    padding: 24px;
}

/* ===================== FORM ELEMENTS ===================== */
.form-label {
    display: block;
    margin-bottom: 8px;
    color: var(--facility-title);
    font-size: 12.5px;
    font-weight: 700;
}

.form-label.required:: {
    content: " *";
    color: #ef4444;
}

.input-icon-group {
    position: relative;
}

.input-icon {
    position: absolute;
    top: 50%;
    left: 14px;
    color: var(--facility-icon-muted);
    font-size: 14px;
    pointer-events: none;
    transform: translateY(-50%);
    transition: color 0.25s ease;
}

.input-icon-group:focus-within .input-icon {
    color: var(--facility-accent);
}

.form-control {
    width: 100%;
    padding: 10px 16px;
    color: var(--facility-title);
    background-color: var(--facility-input-bg);
    border: 1px solid var(--facility-input-border);
    border-radius: 12px;
    font-size: 13.5px;
    transition: all 0.25s ease;
}

.form-control.with-icon {
    padding-left: 42px;
}

.form-control:hover:not(:focus) {
    border-color: var(--facility-accent);
}

.form-control:focus {
    color: var(--facility-title);
    background-color: var(--facility-input-focus);
    border-color: var(--facility-accent);
    box-shadow: 0 0 0 4px var(--facility-glow);
    outline: none;
}

.form-control::placeholder {
    color: var(--facility-subtitle);
    opacity: 0.6;
}

.custom-textarea {
    min-height: 120px;
    resize: vertical;
    line-height: 1.65;
}

.form-hint {
    display: flex;
    align-items: center;
    gap: 4px;
    margin-top: 7px;
    color: var(--facility-subtitle);
    font-size: 11.5px;
}

/* ===================== STATUS TOGGLE ===================== */
.status-toggle-card {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    min-height: 64px;
    padding: 10px 12px;
    cursor: pointer;
    background: var(--facility-input-bg);
    border: 1px solid var(--facility-input-border);
    border-radius: 14px;
    transition: all 0.25s ease;
}

.status-toggle-card:hover,
.status-toggle-card:focus-visible {
    border-color: var(--facility-accent);
    box-shadow: 0 0 0 4px var(--facility-glow);
    outline: none;
}

.status-toggle-info {
    display: flex;
    align-items: center;
    gap: 10px;
    min-width: 0;
}

.status-toggle-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 36px;
    height: 36px;
    flex-shrink: 0;
    border-radius: 10px;
    transition: all 0.25s ease;
}

.status-toggle-icon.active {
    color: #10b981;
    background: rgba(16, 185, 129, .12);
}

.status-toggle-icon.inactive {
    color: #ef4444;
    background: rgba(239, 68, 68, .12);
}

.status-toggle-info strong {
    display: block;
    color: var(--facility-title);
    font-size: 12px;
    font-weight: 800;
}

.status-toggle-info small {
    display: block;
    margin-top: 1px;
    color: var(--facility-subtitle);
    font-size: 10px;
}

.custom-switch {
    width: 42px;
    height: 24px;
    padding: 3px;
    flex-shrink: 0;
    border-radius: 50px;
    background: #cbd5e1;
    transition: background 0.25s ease, box-shadow 0.25s ease;
}

.custom-switch.active {
    background: #10b981;
    box-shadow: 0 3px 10px rgba(16, 185, 129, .25);
}

.custom-switch.inactive {
    background: #64748b;
}

.switch-knob {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 18px;
    height: 18px;
    background: #ffffff;
    border-radius: 50%;
    font-size: 8px;
    box-shadow: 0 2px 5px rgba(15, 23, 42, .18);
    transform: translateX(18px);
    transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
}

.custom-switch.inactive .switch-knob {
    transform: translateX(0);
}

.custom-switch.active .switch-knob i {
    color: #10b981;
}

.custom-switch.inactive .switch-knob i {
    color: #64748b;
    transform: rotate(45deg);
}

/* ===================== UPLOAD DROPZONE ===================== */
.upload-dropzone {
    padding: 28px 24px;
    cursor: pointer;
    text-align: center;
    background: var(--facility-subtle);
    border: 2px dashed var(--facility-input-border);
    border-radius: 14px;
    transition: all 0.25s ease;
}

.upload-dropzone:hover,
.upload-dropzone.dragover {
    background: var(--facility-hover);
    border-color: var(--facility-accent);
    box-shadow: 0 0 0 4px var(--facility-glow);
}

.upload-icon-circle {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 50px;
    height: 50px;
    margin: 0 auto 10px;
    color: var(--facility-accent);
    background: var(--facility-soft);
    border: 1px solid var(--facility-soft-border);
    border-radius: 14px;
    font-size: 20px;
    transition: transform 0.3s ease;
}

.upload-dropzone:hover .upload-icon-circle {
    transform: translateY(-3px);
}

.upload-text {
    margin: 0 0 5px;
    color: var(--facility-title);
    font-size: 13px;
}

.upload-subtext {
    color: var(--facility-subtitle);
    font-size: 11.5px;
    line-height: 1.6;
}

.preview-container {
    padding: 10px 0;
}

.preview-avatar {
    width: 125px;
    height: 125px;
    object-fit: cover;
    border: 2px solid var(--facility-accent);
    border-radius: 14px;
    box-shadow: 0 8px 20px rgba(14, 165, 233, .15);
}

.preview-filename {
    max-width: 260px;
    overflow: hidden;
    color: var(--facility-title);
    font-size: 12px;
    text-overflow: ellipsis;
    white-space: nowrap;
}

/* ===================== BUTTONS ===================== */
.form-footer {
    display: flex;
    align-items: center;
    justify-content: flex-end;
    gap: 10px;
    padding: 18px 24px;
    background: var(--facility-subtle);
    border-top: 1px solid var(--facility-border);
}

.btn-cancel,
.btn-save {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    min-height: 40px;
    padding: 11px 20px;
    border-radius: 12px;
    font-size: 12.5px;
    font-weight: 700;
    text-decoration: none;
    transition: all 0.25s ease;
    cursor: pointer;
}

.btn-cancel {
    color: var(--facility-title);
    background: var(--facility-card);
    border: 1px solid var(--facility-border);
}

.btn-cancel:hover {
    color: #ef4444;
    background: var(--facility-hover);
    transform: translateY(-1px);
}

.btn-save {
    position: relative;
    overflow: hidden;
    color: #ffffff;
    background: linear-gradient(135deg, #0284c7, #0369a1);
    border: none;
    box-shadow: 0 6px 18px rgba(2, 132, 199, .28);
}

.btn-save:hover {
    box-shadow: 0 10px 24px rgba(2, 132, 199, .45);
    transform: translateY(-2px);
}

.btn-save-content {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: opacity 0.2s ease;
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
    animation: facilitySpin 0.7s linear infinite;
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

/* ===================== ALERT AUTO-DISMISS ===================== */
.alert-autodismiss {
    position: relative;
    overflow: hidden;
    animation: facilityAlertIn 0.35s cubic-bezier(0.34, 1.56, 0.64, 1);
}

@keyframes facilityAlertIn {
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
    animation: facilityAlertOut 0.35s ease forwards;
}

@keyframes facilityAlertOut {
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
    background: rgba(148, 163, 184, .2);
}

.alert-progress-bar {
    height: 100%;
    width: 100%;
    background: #ef4444;
    transform-origin: left;
    animation-name: facilityAlertProgress;
    animation-timing-function: linear;
    animation-fill-mode: forwards;
}

@keyframes facilityAlertProgress {
    from {
        transform: scaleX(1);
    }
    to {
        transform: scaleX(0);
    }
}

.alert-icon-box {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 36px;
    height: 36px;
    border-radius: 10px;
    background: rgba(239, 68, 68, .12);
    color: #f87171;
    flex-shrink: 0;
}

.alert-custom-danger {
    background: rgba(239, 68, 68, .06);
    border-color: rgba(239, 68, 68, .15);
    color: #dc2626;
}

.alert-heading {
    font-size: 12px;
    font-weight: 800;
}

/* ===================== RESPONSIVE ===================== */
@media (max-width: 768px) {
    .page-header-custom {
        flex-direction: column;
        align-items: stretch;
        padding: 20px 18px;
    }

    .page-header-custom:: {
        display: none;
    }

    .btn-back {
        width: 100%;
        justify-content: center;
    }

    .card-title-custom,
    .card-body-custom {
        padding: 20px 18px;
    }

    .form-footer {
        flex-direction: column-reverse;
        align-items: stretch;
        padding: 18px;
    }

    .btn-cancel,
    .btn-save {
        width: 100%;
        justify-content: center;
        text-align: center;
    }
}

/* ===================== REDUCED MOTION ===================== */
@media (prefers-reduced-motion: reduce) {
    .alert-autodismiss,
    .custom-card,
    .page-header-icon,
    .upload-icon-circle,
    .btn-save-spinner,
    .input-icon,
    .form-control,
    .status-toggle-card,
    .btn-back,
    .btn-cancel,
    .btn-save,
    .switch-knob {
        animation: none !important;
        transition: none !important;
    }
}
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // ===================== STATUS TOGGLE =====================
        const statusToggle = document.getElementById('statusToggle');
        const statusInput = document.getElementById('statusInput');
        const customSwitch = document.getElementById('customSwitch');
        const statusIcon = document.getElementById('statusIcon');
        const statusLabel = document.getElementById('statusLabel');
        const statusDescription = document.getElementById('statusDescription');

        function updateStatus(isActive) {
            statusInput.value = isActive ? 'aktif' : 'nonaktif';

            customSwitch.classList.toggle('active', isActive);
            customSwitch.classList.toggle('inactive', !isActive);

            statusIcon.classList.toggle('active', isActive);
            statusIcon.classList.toggle('inactive', !isActive);

            statusIcon.innerHTML = isActive
                ? '<i class="fa-solid fa-circle-check"></i>'
                : '<i class="fa-solid fa-circle-xmark"></i>';

            statusLabel.textContent = isActive ? 'Aktif' : 'Nonaktif';

            statusDescription.textContent = isActive
                ? 'Fasilitas tersedia dan dapat digunakan.'
                : 'Fasilitas sedang tidak tersedia.';

            statusToggle.setAttribute('aria-pressed', isActive ? 'true' : 'false');
        }

        function toggleStatus() {
            const isCurrentlyActive = statusInput.value === 'aktif';
            updateStatus(!isCurrentlyActive);
        }

        if (statusToggle) {
            statusToggle.addEventListener('click', toggleStatus);
            statusToggle.addEventListener('keydown', function (e) {
                if (e.key === 'Enter' || e.key === ' ') {
                    e.preventDefault();
                    toggleStatus();
                }
            });
        }

        // ===================== UPLOAD FOTO =====================
        const dropzone = document.getElementById('facility-dropzone');
        const input = document.getElementById('facility-foto-input');
        const placeholder = document.getElementById('facility-upload-placeholder');
        const preview = document.getElementById('facility-preview-wrapper');
        const image = document.getElementById('facility-img-preview');
        const filename = document.getElementById('facility-preview-filename');

        function validateFile(file) {
            const allowedTypes = ['image/png', 'image/jpeg', 'image/jpg', 'image/webp'];
            const maxSize = 5 * 1024 * 1024; // 5MB

            if (!allowedTypes.includes(file.type)) {
                alert('Format file tidak didukung. Gunakan PNG, JPG, JPEG, atau WEBP.');
                input.value = '';
                return false;
            }

            if (file.size > maxSize) {
                alert('Ukuran foto maksimal 5MB.');
                input.value = '';
                return false;
            }

            return true;
        }

        function showPreview(file) {
            if (!file) return;

            if (!validateFile(file)) return;

            const reader = new FileReader();
            reader.onload = function (e) {
                image.src = e.target.result;
                filename.textContent = file.name;
                placeholder.classList.add('d-none');
                preview.classList.remove('d-none');
            };
            reader.readAsDataURL(file);
        }

        if (dropzone && input) {
            dropzone.addEventListener('click', function () {
                input.click();
            });

            dropzone.addEventListener('keydown', function (e) {
                if (e.key === 'Enter' || e.key === ' ') {
                    e.preventDefault();
                    input.click();
                }
            });

            input.addEventListener('change', function () {
                showPreview(this.files[0]);
            });

            ['dragenter', 'dragover'].forEach(evt => {
                dropzone.addEventListener(evt, function (e) {
                    e.preventDefault();
                    e.stopPropagation();
                    dropzone.classList.add('dragover');
                });
            });

            ['dragleave', 'drop'].forEach(evt => {
                dropzone.addEventListener(evt, function (e) {
                    e.preventDefault();
                    e.stopPropagation();
                    dropzone.classList.remove('dragover');
                });
            });

            dropzone.addEventListener('drop', function (e) {
                const files = e.dataTransfer.files;
                if (!files.length) return;

                try {
                    input.files = files;
                    showPreview(files[0]);
                } catch (error) {
                    alert('File tidak dapat diproses oleh browser.');
                }
            });
        }

        // ===================== AUTO-DISMISS ALERT =====================
        document.querySelectorAll('.alert-autodismiss').forEach(function (alertEl) {
            const duration = parseInt(alertEl.getAttribute('data-autodismiss'), 10) || 6000;
            const bar = alertEl.querySelector('.alert-progress-bar');

            if (bar) bar.style.animationDuration = duration + 'ms';

            let dismissed = false;

            function closeAlert() {
                if (dismissed) return;
                dismissed = true;
                alertEl.classList.add('alert-hiding');
                setTimeout(() => {
                    if (alertEl.parentNode) alertEl.parentNode.removeChild(alertEl);
                }, 350);
            }

            let remaining = duration;
            let startedAt = Date.now();
            let timer = setTimeout(closeAlert, remaining);

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

            const closeBtn = alertEl.querySelector('.btn-close');
            if (closeBtn) {
                closeBtn.addEventListener('click', function (e) {
                    e.preventDefault();
                    clearTimeout(timer);
                    closeAlert();
                });
            }
        });

        // ===================== FORM SUBMIT LOADING =====================
        const form = document.getElementById('form-tambah-fasilitas');
        const submitBtn = document.getElementById('btn-submit-fasilitas');

        if (form && submitBtn) {
            form.addEventListener('submit', function () {
                submitBtn.classList.add('is-loading');
            });
        }
    });
</script>

<?php $this->load->view('admin/template/footer'); ?>