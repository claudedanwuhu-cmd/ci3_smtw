<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$this->load->view('admin/template/header');
$this->load->view('admin/template/sidebar');
?>

<div class="main-content">
    <?php $this->load->view('admin/template/navbar'); ?>

    <div class="content-wrapper">

        <!-- FLASH MESSAGE -->
        <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-custom-success alert-dismissible fade show mb-4 alert-autodismiss" role="status" data-autodismiss="4500">
                <div class="d-flex align-items-center gap-2">
                    <i class="fa-solid fa-circle-check fs-5"></i>
                    <span><?= html_escape($this->session->flashdata('success')); ?></span>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
                <div class="alert-progress-track"><div class="alert-progress-bar"></div></div>
            </div>
        <?php endif; ?>

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
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
                <div class="alert-progress-track"><div class="alert-progress-bar alert-progress-bar-error"></div></div>
            </div>
        <?php endif; ?>

        <!-- HEADER HALAMAN -->
        <div class="page-header-custom mb-4">
            <div class="d-flex align-items-center gap-3">
                <div class="page-header-icon">
                    <i class="fa-solid fa-trophy"></i>
                </div>
                <div>
                    <span class="badge-header-tag mb-1">
                        <i class="fa-solid fa-circle-plus me-1"></i> Form Input
                    </span>
                    <h2 class="page-title">Tambah Prestasi</h2>
                    <p class="page-subtitle">Tambahkan data prestasi siswa atau pencapaian sekolah baru ke dalam sistem.</p>
                </div>
            </div>
            <a href="<?= site_url('admin/prestasi'); ?>" class="btn-back">
                <i class="fa-solid fa-arrow-left me-2"></i>
                Kembali
            </a>
        </div>

        <!-- FORM INPUT -->
        <form id="form-tambah-prestasi" data-loading-form action="<?= site_url('admin/prestasi/simpan'); ?>" method="POST" enctype="multipart/form-data">

            <!-- CSRF Token -->
            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">

            <div class="custom-card mb-4">

                <!-- 1. INFORMASI UTAMA -->
                <div class="card-title-custom">
                    <div class="title-icon">
                        <i class="fa-solid fa-award"></i>
                    </div>
                    <div>
                        <h5>Informasi Utama Prestasi</h5>
                        <small>Detail kejuaraan atau kompetisi yang diikuti</small>
                    </div>
                </div>

                <div class="card-body-custom">
                    <div class="row g-4">

                        <!-- NAMA PRESTASI -->
                        <div class="col-md-8">
                            <label class="form-label required" for="nama_prestasi">Nama Prestasi / Kejuaraan</label>
                            <div class="input-icon-group">
                                <i class="fa-solid fa-heading input-icon"></i>
                                <input type="text" id="nama_prestasi" name="nama_prestasi" class="form-control with-icon"
                                    placeholder="Contoh: Juara 1 Lomba Pidato Bahasa Indonesia" required>
                            </div>
                        </div>

                        <!-- JUARA -->
                        <div class="col-md-4">
                            <label class="form-label" for="juara">Capaian / Juara</label>
                            <div class="input-icon-group">
                                <i class="fa-solid fa-medal input-icon"></i>
                                <input type="text" id="juara" name="juara" class="form-control with-icon"
                                    placeholder="Contoh: Juara 1 / Harapan 2">
                            </div>
                        </div>

                        <!-- TINGKAT -->
                        <div class="col-md-4">
                            <label class="form-label" for="tingkat">Tingkat Kejuaraan</label>
                            <div class="input-icon-group">
                                <i class="fa-solid fa-layer-group input-icon"></i>
                                <select id="tingkat" name="tingkat" class="form-select with-icon">
                                    <option value="">-- Pilih Tingkat --</option>
                                    <option value="Sekolah">Sekolah</option>
                                    <option value="Kecamatan">Kecamatan</option>
                                    <option value="Kabupaten">Kabupaten</option>
                                    <option value="Provinsi">Provinsi</option>
                                    <option value="Nasional">Nasional</option>
                                    <option value="Internasional">Internasional</option>
                                </select>
                            </div>
                        </div>

                        <!-- PENYELENGGARA -->
                        <div class="col-md-4">
                            <label class="form-label" for="penyelenggara">Penyelenggara</label>
                            <div class="input-icon-group">
                                <i class="fa-solid fa-building-columns input-icon"></i>
                                <input type="text" id="penyelenggara" name="penyelenggara" class="form-control with-icon"
                                    placeholder="Contoh: Dinas Pendidikan">
                            </div>
                        </div>

                        <!-- TANGGAL -->
                        <div class="col-md-4">
                            <label class="form-label" for="tanggal">Tanggal Pelaksanaan</label>
                            <div class="input-icon-group">
                                <i class="fa-solid fa-calendar-day input-icon"></i>
                                <input type="date" id="tanggal" name="tanggal" class="form-control with-icon">
                            </div>
                        </div>

                    </div>
                </div>

                <!-- 2. DATA PESERTA -->
                <div class="card-title-custom">
                    <div class="title-icon">
                        <i class="fa-solid fa-user-graduate"></i>
                    </div>
                    <div>
                        <h5>Data Peserta / Peraih Prestasi</h5>
                        <small>Identitas siswa atau nama tim peraih penghargaan</small>
                    </div>
                </div>

                <div class="card-body-custom">
                    <div class="row g-4">

                        <!-- NAMA SISWA -->
                        <div class="col-md-8">
                            <label class="form-label" for="nama_siswa">Nama Siswa / Nama Tim</label>
                            <div class="input-icon-group">
                                <i class="fa-solid fa-user input-icon"></i>
                                <input type="text" id="nama_siswa" name="nama_siswa" class="form-control with-icon"
                                    placeholder="Nama siswa atau nama kelompok yang meraih prestasi">
                            </div>
                        </div>

                        <!-- KELAS -->
                        <div class="col-md-4">
                            <label class="form-label" for="kelas">Kelas</label>
                            <div class="input-icon-group">
                                <i class="fa-solid fa-school input-icon"></i>
                                <input type="text" id="kelas" name="kelas" class="form-control with-icon"
                                    placeholder="Contoh: IX A / XII IPA 1">
                            </div>
                        </div>

                    </div>
                </div>

                <!-- 3. DOKUMENTASI FOTO -->
                <div class="card-title-custom">
                    <div class="title-icon">
                        <i class="fa-solid fa-image"></i>
                    </div>
                    <div>
                        <h5>Dokumentasi / Foto Kegiatan</h5>
                        <small>Upload bukti foto piala, piagam, atau foto penyerahan hadiah</small>
                    </div>
                </div>

                <div class="card-body-custom">
                    <div class="row g-4">
                        <div class="col-md-12">
                            <label class="form-label" id="foto-label">Upload Foto Prestasi</label>

                            <div class="upload-dropzone" id="dropzone-area" role="button" tabindex="0" aria-labelledby="foto-label">
                                <input type="file" name="foto" id="file-input" class="d-none"
                                    accept="image/png, image/jpeg, image/jpg, image/webp">

                                <div class="upload-content text-center" id="dropzone-prompt">
                                    <div class="upload-icon-circle mb-2">
                                        <i class="fa-solid fa-cloud-arrow-up"></i>
                                    </div>
                                    <p class="upload-text mb-1"><strong>Klik atau seret file ke sini untuk mengunggah</strong></p>
                                    <span class="upload-subtext">PNG, JPG, JPEG, atau WEBP (Maksimal 2MB)</span>
                                </div>

                                <div class="preview-container d-none text-center" id="dropzone-preview">
                                    <img id="image-preview" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" alt="Preview Foto" class="preview-thumb mb-2">
                                    <div class="d-flex align-items-center justify-content-center gap-2">
                                        <span class="preview-filename text-truncate" id="file-name"></span>
                                        <span class="badge bg-primary fs-8">Ganti Foto</span>
                                    </div>
                                    <div class="preview-meta" id="file-size"></div>
                                    <button type="button" class="btn-remove-file d-none" id="btn-remove-file">
                                        <i class="fa-solid fa-trash-can me-1"></i> Hapus Foto
                                    </button>
                                </div>
                            </div>

                            <div class="upload-error d-none" id="upload-error" role="alert">
                                <i class="fa-solid fa-circle-exclamation me-2"></i>
                                <span id="upload-error-text"></span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 4. DESKRIPSI -->
                <div class="card-title-custom">
                    <div class="title-icon">
                        <i class="fa-solid fa-align-left"></i>
                    </div>
                    <div>
                        <h5>Deskripsi Tambahan</h5>
                        <small>Catatan ringkas mengenai jalannya perlombaan</small>
                    </div>
                </div>

                <div class="card-body-custom">
                    <div class="row g-4">
                        <div class="col-md-12">
                            <label class="form-label" for="deskripsi">Keterangan / Deskripsi Ringkas</label>
                            <textarea id="deskripsi" name="deskripsi" class="form-control custom-textarea" rows="4"
                                placeholder="Tuliskan keterangan singkat mengenai kegiatan, tingkat persaingan, atau catatan khusus..."></textarea>
                        </div>
                    </div>
                </div>

                <!-- FOOTER / BUTTONS -->
                <div class="form-footer">
                    <a href="<?= site_url('admin/prestasi'); ?>" class="btn-cancel">
                        <i class="fa-solid fa-xmark me-2"></i> Batal
                    </a>
                    <button type="submit" id="btn-submit-prestasi" class="btn-save">
                        <span class="btn-save-content">
                            <i class="fa-solid fa-floppy-disk me-2"></i>
                            Simpan Prestasi
                        </span>
                        <span class="btn-save-spinner"></span>
                    </button>
                </div>

            </div>
        </form>

    </div>
</div>

<style>
/* =====================================================================
   DESIGN SYSTEM ADMIN (SHARED) - identik dengan halaman Guru & Staff.
   Blok ini sama persis di index.php, tambah.php, dan edit.php.
===================================================================== */
:root {
    --guru-bg: #f8fafc;
    --guru-card-bg: #ffffff;
    --guru-card-subtle: #f8fafc;
    --guru-input-bg: #f8fafc;
    --guru-input-border: #cbd5e1;
    --guru-input-color: #0f172a;
    --guru-input-focus-bg: #ffffff;
    --guru-border: rgba(226, 232, 240, 0.8);
    --guru-title: #0f172a;
    --guru-subtitle: #64748b;
    --guru-hover: #f1f5f9;
    --guru-shadow: 0 10px 25px -5px rgba(15, 23, 42, 0.05), 0 8px 10px -6px rgba(15, 23, 42, 0.01);
    --guru-accent: #0ea5e9;
    --guru-accent-glow: rgba(14, 165, 233, 0.25);
    --guru-accent-soft: rgba(14, 165, 233, 0.12);
    --guru-accent-ring: rgba(14, 165, 233, 0.25);
    --guru-icon-muted: #94a3b8;
    --dropzone-bg: #f1f5f9;
    --dropzone-border: #cbd5e1;
    --guru-success: #059669;
    --guru-success-soft: rgba(16, 185, 129, 0.15);
    --guru-success-ring: rgba(16, 185, 129, 0.3);
    --guru-danger: #ef4444;
    --guru-danger-soft: rgba(239, 68, 68, 0.12);
    --guru-danger-ring: rgba(239, 68, 68, 0.28);
    --guru-btn-from: #0284c7;
    --guru-btn-to: #0369a1;
    --guru-scheme: light;
}

/* Dukungan semua selector dark mode (Bootstrap 5.3, data-theme, class body/html) */
[data-bs-theme="dark"],
[data-theme="dark"],
body.dark-mode,
.dark-mode {
    --guru-bg: #070d19;
    --guru-card-bg: #0f172a;
    --guru-card-subtle: #1e293b;
    --guru-input-bg: #1e293b;
    --guru-input-border: rgba(255, 255, 255, 0.12);
    --guru-input-color: #f1f5f9;
    --guru-input-focus-bg: #111827;
    --guru-border: rgba(255, 255, 255, 0.08);
    --guru-title: #f8fafc;
    --guru-subtitle: #94a3b8;
    --guru-hover: #1e293b;
    --guru-shadow: 0 12px 30px -5px rgba(0, 0, 0, 0.4);
    --guru-accent: #38bdf8;
    --guru-accent-glow: rgba(56, 189, 248, 0.25);
    --guru-accent-soft: rgba(56, 189, 248, 0.12);
    --guru-accent-ring: rgba(56, 189, 248, 0.25);
    --guru-icon-muted: #64748b;
    --dropzone-bg: #111827;
    --dropzone-border: rgba(255, 255, 255, 0.15);
    --guru-success: #34d399;
    --guru-danger: #f87171;
    --guru-scheme: dark;
}

.text-title { color: var(--guru-title) !important; }
.text-subtle { color: var(--guru-subtitle) !important; }
.fs-7 { font-size: 13px; }
.fs-8 { font-size: 11px; }

/* ===================== FLASH ALERT (AUTO-DISMISS) ===================== */
.alert-custom-success,
.alert-custom-danger {
    position: relative;
    overflow: hidden;
    border-radius: 16px;
    padding: 16px 52px 16px 20px;
    backdrop-filter: blur(8px);
    animation: guruAlertIn 0.35s cubic-bezier(0.34, 1.56, 0.64, 1);
}

.alert-custom-success {
    background: var(--guru-success-soft) !important;
    border: 1px solid var(--guru-success-ring) !important;
    color: var(--guru-success) !important;
}

.alert-custom-danger {
    background: var(--guru-danger-soft) !important;
    border: 1px solid var(--guru-danger-ring) !important;
    color: var(--guru-danger) !important;
}

.alert-custom-success .btn-close,
.alert-custom-danger .btn-close {
    position: absolute;
    top: 50%;
    right: 14px;
    margin: 0;
    padding: 8px;
    transform: translateY(-50%);
    opacity: 0.6;
    z-index: 2;
}

.alert-custom-success .btn-close:hover,
.alert-custom-danger .btn-close:hover { opacity: 1; }

[data-theme="dark"] .alert .btn-close,
body.dark-mode .alert .btn-close,
.dark-mode .alert .btn-close { filter: invert(1) grayscale(100%) brightness(200%); }

.alert-icon-box {
    width: 36px;
    height: 36px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
    flex-shrink: 0;
}

.alert-custom-success .alert-icon-box { background: rgba(16, 185, 129, 0.2); }
.alert-custom-danger .alert-icon-box { background: rgba(239, 68, 68, 0.2); }

.alert-heading {
    color: inherit;
    font-size: 14px;
    font-weight: 700;
}

.alert-autodismiss.alert-hiding { animation: guruAlertOut 0.35s ease forwards; }

.alert-progress-track {
    position: absolute;
    left: 0; right: 0; bottom: 0;
    height: 3px;
    background: rgba(148, 163, 184, 0.2);
}

.alert-progress-bar {
    height: 100%;
    width: 100%;
    background: var(--guru-success);
    transform-origin: left;
    animation-name: guruAlertProgress;
    animation-timing-function: linear;
    animation-fill-mode: forwards;
}

.alert-progress-bar-error { background: var(--guru-danger); }

/* ===================== PAGE HEADER ===================== */
.page-header-custom {
    position: relative;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 20px;
    padding: 22px 28px;
    background: var(--guru-card-bg) !important;
    border: 1px solid var(--guru-border) !important;
    border-radius: 20px;
    box-shadow: var(--guru-shadow);
}

.page-header-custom::before {
    content: "";
    position: absolute;
    inset: 0 auto 0 0;
    width: 4px;
    background: linear-gradient(180deg, var(--guru-accent), var(--guru-btn-to));
}

.badge-header-tag {
    display: inline-flex;
    align-items: center;
    background: var(--guru-accent-soft);
    color: var(--guru-accent);
    border: 1px solid var(--guru-accent-ring);
    padding: 4px 12px;
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
    width: 50px;
    height: 50px;
    border-radius: 14px;
    background: var(--guru-card-subtle);
    border: 1px solid var(--guru-border);
    color: var(--guru-accent);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 22px;
    flex-shrink: 0;
    transition: transform 0.35s ease;
}

.page-header-custom:hover .page-header-icon { transform: rotate(-6deg) scale(1.06); }

/* ===================== PRIMARY BUTTON (Tambah / Simpan) ===================== */
.btn-add,
.btn-save {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border: 1px solid transparent;
    background: linear-gradient(135deg, var(--guru-btn-from) 0%, var(--guru-btn-to) 100%);
    background-origin: border-box;
    color: #ffffff !important;
    text-decoration: none;
    padding: 11px 24px;
    border-radius: 12px;
    font-size: 13px;
    font-weight: 700;
    white-space: nowrap;
    cursor: pointer;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    box-shadow: 0 6px 18px rgba(2, 132, 199, 0.3);
}

.btn-add:hover,
.btn-save:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 24px rgba(2, 132, 199, 0.45);
}

.btn-add:focus-visible,
.btn-save:focus-visible {
    outline: none;
    box-shadow: 0 0 0 4px var(--guru-accent-glow);
}

/* ===================== CARD ===================== */
.custom-card {
    background: var(--guru-card-bg) !important;
    border: 1px solid var(--guru-border) !important;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: var(--guru-shadow);
    animation: guruFadeUp 0.4s ease both;
    transition: box-shadow 0.3s ease, border-color 0.3s ease;
}

.custom-card.card-hover:hover {
    border-color: var(--guru-accent-ring) !important;
    box-shadow: 0 16px 34px -10px rgba(15, 23, 42, 0.12);
}

.card-title-custom {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: 14px;
    padding: 18px 24px;
    background: var(--guru-card-subtle) !important;
    border-bottom: 1px solid var(--guru-border) !important;
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

.title-icon {
    width: 40px;
    height: 40px;
    background: var(--guru-accent-soft);
    border: 1px solid var(--guru-accent-ring);
    border-radius: 12px;
    color: var(--guru-accent);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 16px;
    flex-shrink: 0;
}

.card-body-custom { padding: 24px; }
.card-body-custom + .card-title-custom { border-top: 1px solid var(--guru-border); }

/* ===================== KEYFRAMES ===================== */
@keyframes guruAlertIn {
    from { opacity: 0; transform: translateY(-14px) scale(0.98); }
    to { opacity: 1; transform: translateY(0) scale(1); }
}

@keyframes guruAlertOut {
    from { opacity: 1; max-height: 200px; }
    to { opacity: 0; transform: translateY(-10px) scale(0.98); margin-bottom: 0 !important; max-height: 0; padding-top: 0; padding-bottom: 0; border-width: 0; }
}

@keyframes guruAlertProgress {
    from { transform: scaleX(1); }
    to { transform: scaleX(0); }
}

@keyframes guruFadeUp {
    from { opacity: 0; transform: translateY(12px); }
    to { opacity: 1; transform: translateY(0); }
}

/* ===================== RESPONSIVE (SHARED) ===================== */
@media (max-width: 768px) {
    .page-header-custom { flex-direction: column; align-items: stretch; }
    .btn-add { justify-content: center; }
}

/* ===================== FORM: BACK / CANCEL BUTTONS ===================== */
.btn-back,
.btn-cancel {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    border-radius: 12px;
    font-size: 13px;
    font-weight: 600;
    cursor: pointer;
    font-family: inherit;
    transition: all 0.25s ease;
}

.btn-back {
    background: var(--guru-card-subtle);
    color: var(--guru-title);
    border: 1px solid var(--guru-border);
    padding: 10px 20px;
}

.btn-back:hover {
    background: var(--guru-hover);
    color: var(--guru-accent);
    transform: translateX(-3px);
}

.btn-cancel {
    background: var(--guru-card-bg);
    color: var(--guru-title);
    border: 1px solid var(--guru-border);
    padding: 11px 22px;
}

.btn-cancel:hover {
    background: var(--guru-hover);
    color: var(--guru-danger);
}

.btn-back:focus-visible,
.btn-cancel:focus-visible {
    outline: none;
    box-shadow: 0 0 0 4px var(--guru-accent-glow);
}

/* ===================== FORM: LABEL & INPUT ===================== */
.form-label {
    color: var(--guru-title);
    font-size: 12.5px;
    font-weight: 700;
    margin-bottom: 8px;
}

.form-label.required::after {
    content: " *";
    color: var(--guru-danger);
}

.label-hint {
    color: var(--guru-subtitle);
    font-size: 11.5px;
    font-weight: 400;
}

.form-hint {
    display: flex;
    align-items: center;
    margin-top: 10px;
    color: var(--guru-subtitle);
    font-size: 12px;
}

.input-icon-group {
    position: relative;
    display: flex;
    align-items: center;
}

.input-icon-group .input-icon {
    position: absolute;
    left: 14px;
    color: var(--guru-icon-muted);
    font-size: 14px;
    pointer-events: none;
    z-index: 5;
    transition: color 0.25s ease;
}

.content-wrapper .form-control,
.content-wrapper .form-select {
    background-color: var(--guru-input-bg);
    border: 1px solid var(--guru-input-border);
    border-radius: 12px;
    font-size: 13.5px;
    color: var(--guru-input-color);
    padding: 10px 16px;
    color-scheme: var(--guru-scheme);
    transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
}

.content-wrapper .form-control.with-icon,
.content-wrapper .form-select.with-icon { padding-left: 42px; }

.content-wrapper .form-control:hover:not(:focus),
.content-wrapper .form-select:hover:not(:focus) { border-color: var(--guru-accent); }

.content-wrapper .form-control:focus,
.content-wrapper .form-select:focus {
    background-color: var(--guru-input-focus-bg);
    border-color: var(--guru-accent);
    color: var(--guru-input-color);
    box-shadow: 0 0 0 4px var(--guru-accent-glow);
    outline: none;
}

.content-wrapper .form-control:user-invalid { border-color: var(--guru-danger); }

.input-icon-group:focus-within .input-icon { color: var(--guru-accent); }

.content-wrapper .form-control::placeholder {
    color: var(--guru-subtitle);
    opacity: 0.6;
}

.content-wrapper .form-select {
    appearance: none;
    cursor: pointer;
    padding-right: 38px;
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%2364748b' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m2 5 6 6 6-6'/%3e%3c/svg%3e");
    background-repeat: no-repeat;
    background-position: right 14px center;
    background-size: 12px 12px;
}

.custom-textarea {
    resize: vertical;
    min-height: 90px;
    line-height: 1.6;
}

/* ===================== FORM: DROPZONE UPLOAD FOTO ===================== */
.upload-dropzone {
    border: 2px dashed var(--dropzone-border);
    background-color: var(--dropzone-bg);
    border-radius: 16px;
    padding: 24px;
    cursor: pointer;
    transition: all 0.25s ease;
}

.upload-dropzone:hover,
.upload-dropzone:focus-visible {
    outline: none;
    border-color: var(--guru-accent);
    background-color: var(--guru-card-subtle);
}

.upload-dropzone.dragover {
    border-color: var(--guru-accent);
    background-color: var(--guru-card-subtle);
    box-shadow: 0 0 0 4px var(--guru-accent-glow);
}

.upload-dropzone.has-error { border-color: var(--guru-danger); }

.upload-icon-circle {
    width: 44px;
    height: 44px;
    border-radius: 50%;
    background: var(--guru-accent-soft);
    color: var(--guru-accent);
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
    transition: transform 0.3s ease;
}

.upload-dropzone:hover .upload-icon-circle { transform: translateY(-3px); }

.upload-text {
    color: var(--guru-title);
    font-size: 13.5px;
}

.upload-subtext {
    color: var(--guru-subtitle);
    font-size: 11.5px;
}

.preview-thumb {
    width: 96px;
    height: 96px;
    object-fit: cover;
    border-radius: 16px;
    border: 3px solid var(--guru-accent);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}

.preview-filename {
    max-width: 220px;
    font-size: 12px;
    color: var(--guru-title);
}

.preview-meta {
    margin-top: 4px;
    color: var(--guru-subtitle);
    font-size: 11.5px;
}

.btn-remove-file {
    margin-top: 10px;
    padding: 6px 14px;
    border-radius: 10px;
    background: var(--guru-danger-soft);
    color: var(--guru-danger);
    border: 1px solid var(--guru-danger-ring);
    font-size: 12px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.25s ease;
}

.btn-remove-file:hover {
    background: #ef4444;
    color: #ffffff;
    border-color: #ef4444;
    transform: translateY(-2px);
}

.upload-error {
    display: flex;
    align-items: center;
    margin-top: 10px;
    padding: 10px 14px;
    border-radius: 12px;
    background: var(--guru-danger-soft);
    border: 1px solid var(--guru-danger-ring);
    color: var(--guru-danger);
    font-size: 12.5px;
    font-weight: 600;
}

/* ===================== FORM: FOOTER & SAVE LOADING ===================== */
.form-footer {
    padding: 18px 24px;
    background: var(--guru-card-subtle);
    border-top: 1px solid var(--guru-border);
    display: flex;
    align-items: center;
    justify-content: flex-end;
    gap: 12px;
}

.btn-save { position: relative; overflow: hidden; }
.btn-save-content { display: inline-flex; align-items: center; transition: opacity 0.2s ease; }
.btn-save.is-loading .btn-save-content { opacity: 0; }
.btn-save.is-loading { pointer-events: none; }

.btn-save-spinner {
    position: absolute;
    top: 50%; left: 50%;
    width: 18px; height: 18px;
    margin: -9px 0 0 -9px;
    border: 2.5px solid rgba(255, 255, 255, 0.35);
    border-top-color: #ffffff;
    border-radius: 50%;
    opacity: 0;
    animation: guruSpin 0.7s linear infinite;
}

.btn-save.is-loading .btn-save-spinner { opacity: 1; }

@keyframes guruSpin { to { transform: rotate(360deg); } }

@media (max-width: 768px) {
    .btn-back { justify-content: center; }

    .card-body-custom,
    .card-title-custom,
    .form-footer { padding: 20px 18px; }

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
}

@media (prefers-reduced-motion: reduce) {
    .alert-custom-success, .alert-custom-danger, .custom-card, .page-header-icon,
    .upload-icon-circle, .btn-save-spinner { animation: none !important; transition: none !important; }
}
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // ---- Flash alert: auto-dismiss, pause saat di-hover, tutup manual
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

        // ---- Upload foto: preview, drag & drop, validasi tipe & ukuran
        var fileInput = document.getElementById('file-input');
        var dropzone = document.getElementById('dropzone-area');
        var promptBox = document.getElementById('dropzone-prompt');
        var previewBox = document.getElementById('dropzone-preview');
        var imgPreview = document.getElementById('image-preview');
        var fileName = document.getElementById('file-name');
        var fileSize = document.getElementById('file-size');
        var btnRemove = document.getElementById('btn-remove-file');
        var errorBox = document.getElementById('upload-error');
        var errorText = document.getElementById('upload-error-text');

        var BLANK = 'data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7';
        var FALLBACK = 'data:image/svg+xml;utf8,' + encodeURIComponent(
            '<svg xmlns="http://www.w3.org/2000/svg" width="120" height="120" viewBox="0 0 120 120">' +
            '<rect width="120" height="120" rx="16" fill="#e2e8f0"/>' +
            '<circle cx="44" cy="44" r="8" fill="#94a3b8"/>' +
            '<path d="M24 92l24-28 18 20 12-14 18 22z" fill="#94a3b8"/></svg>'
        );
        var MAX_SIZE = 2 * 1024 * 1024;
        var ALLOWED = ['image/png', 'image/jpeg', 'image/webp'];

        if (dropzone && fileInput) {
            // Simpan kondisi awal (edit: foto lama, tambah: kosong) untuk fitur batal
            var original = {
                hasPhoto: !previewBox.classList.contains('d-none'),
                src: imgPreview.getAttribute('src'),
                name: fileName.textContent.trim(),
                meta: fileSize.textContent.trim()
            };

            function formatSize(bytes) {
                return bytes >= 1048576 ? (bytes / 1048576).toFixed(2) + ' MB' : (bytes / 1024).toFixed(1) + ' KB';
            }

            function validate(file) {
                if (ALLOWED.indexOf(file.type) === -1) return 'Format file tidak didukung. Gunakan PNG, JPG, JPEG, atau WEBP.';
                if (file.size > MAX_SIZE) return 'Ukuran file ' + formatSize(file.size) + ' melebihi batas 2 MB.';
                return '';
            }

            function showError(msg) {
                errorText.textContent = msg;
                errorBox.classList.remove('d-none');
                dropzone.classList.add('has-error');
            }

            function clearError() {
                errorBox.classList.add('d-none');
                dropzone.classList.remove('has-error');
            }

            function resetPreview() {
                if (original.hasPhoto) {
                    imgPreview.src = original.src;
                    fileName.textContent = original.name;
                    fileSize.textContent = original.meta;
                    promptBox.classList.add('d-none');
                    previewBox.classList.remove('d-none');
                } else {
                    imgPreview.src = BLANK;
                    fileName.textContent = '';
                    fileSize.textContent = '';
                    promptBox.classList.remove('d-none');
                    previewBox.classList.add('d-none');
                }
                btnRemove.classList.add('d-none');
            }

            function showPreview(file) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    imgPreview.src = e.target.result;
                    fileName.textContent = file.name;
                    fileSize.textContent = formatSize(file.size);
                    promptBox.classList.add('d-none');
                    previewBox.classList.remove('d-none');
                    btnRemove.classList.remove('d-none');
                };
                reader.readAsDataURL(file);
            }

            // Gambar gagal dimuat -> tampilkan placeholder lokal (tanpa layanan eksternal)
            imgPreview.addEventListener('error', function () {
                var cur = imgPreview.getAttribute('src');
                if (cur !== FALLBACK && cur !== BLANK) imgPreview.src = FALLBACK;
            });
            if (imgPreview.complete && imgPreview.naturalWidth === 0 && imgPreview.getAttribute('src') !== BLANK) {
                imgPreview.src = FALLBACK;
            }

            // Buka dialog file lewat klik / keyboard
            dropzone.addEventListener('click', function (e) {
                if (e.target === fileInput) return;
                fileInput.click();
            });
            dropzone.addEventListener('keydown', function (e) {
                if ((e.key === 'Enter' || e.key === ' ') && e.target === dropzone) {
                    e.preventDefault();
                    fileInput.click();
                }
            });

            fileInput.addEventListener('change', function () {
                var file = fileInput.files[0];
                if (!file) { clearError(); resetPreview(); return; }
                var err = validate(file);
                if (err) {
                    fileInput.value = '';
                    resetPreview();
                    showError(err);
                    return;
                }
                clearError();
                showPreview(file);
            });

            btnRemove.addEventListener('click', function (e) {
                e.preventDefault();
                e.stopPropagation();
                fileInput.value = '';
                clearError();
                resetPreview();
            });

            // Drag & drop
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
                var files = e.dataTransfer && e.dataTransfer.files;
                if (!files || !files.length) return;
                var err = validate(files[0]);
                if (err) { showError(err); return; }
                try {
                    var dt = new DataTransfer();
                    dt.items.add(files[0]);
                    fileInput.files = dt.files;
                } catch (ex) {
                    fileInput.files = files;
                }
                clearError();
                showPreview(files[0]);
            });
        }

        // ---- Loading state saat form disimpan
        var formEl = document.querySelector('form[data-loading-form]');
        var btnSubmit = document.getElementById('btn-submit-prestasi');
        if (formEl && btnSubmit) {
            formEl.addEventListener('submit', function (e) {
                if (btnSubmit.classList.contains('is-loading')) { e.preventDefault(); return; }
                btnSubmit.classList.add('is-loading');
            });
            window.addEventListener('pageshow', function () {
                btnSubmit.classList.remove('is-loading');
            });
        }
    });
</script>

<?php $this->load->view('admin/template/footer'); ?>