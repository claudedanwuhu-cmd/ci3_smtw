<?php
$s   = (isset($pengaturan) && is_object($pengaturan)) ? $pengaturan : null;
$val = function ($key) use ($s) {
    return ($s !== null && isset($s->$key)) ? (string) $s->$key : '';
};
?>
<?php $this->load->view('admin/template/header'); ?>
<?php $this->load->view('admin/template/sidebar'); ?>

<div class="main-content">
    <?php $this->load->view('admin/template/navbar'); ?>

    <div class="content-wrapper">

        <!-- 1. FLASH MESSAGE -->
        <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-autodismiss is-success mb-4" role="status" data-autodismiss="4500">
                <div class="alert-icon-box"><i class="fa-solid fa-circle-check"></i></div>
                <div class="alert-content">
                    <strong>Berhasil</strong>
                    <span><?= html_escape($this->session->flashdata('success')); ?></span>
                </div>
                <button type="button" class="btn-close" aria-label="Tutup notifikasi"></button>
                <div class="alert-progress-track"><div class="alert-progress-bar" style="animation-duration: 4500ms;"></div></div>
            </div>
        <?php endif; ?>

        <?php if ($this->session->flashdata('error')): ?>
            <div class="alert alert-autodismiss is-error mb-4" role="alert" data-autodismiss="6000">
                <div class="alert-icon-box"><i class="fa-solid fa-circle-exclamation"></i></div>
                <div class="alert-content">
                    <strong>Gagal memproses data</strong>
                    <span><?= html_escape($this->session->flashdata('error')); ?></span>
                </div>
                <button type="button" class="btn-close" aria-label="Tutup notifikasi"></button>
                <div class="alert-progress-track"><div class="alert-progress-bar" style="animation-duration: 6000ms;"></div></div>
            </div>
        <?php endif; ?>

        <!-- 2. PAGE HEADER -->
        <div class="page-header-custom mb-4">
            <div class="d-flex align-items-center gap-3">
                <div class="page-header-icon">
                    <i class="fa-solid fa-gear"></i>
                </div>
                <div>
                    <span class="badge-header-tag mb-1">
                        <i class="fa-solid fa-sliders me-1"></i> Konfigurasi Sistem
                    </span>
                    <h2 class="page-title">Pengaturan Website</h2>
                    <p class="page-subtitle">Atur identitas sekolah, kontak, sosial media, dan informasi footer website.</p>
                </div>
            </div>
        </div>

        <!-- 3. CARD FORM -->
        <div class="custom-card">
            <div class="card-title-custom">
                <div class="d-flex align-items-center gap-3">
                    <div class="title-icon">
                        <i class="fa-solid fa-globe"></i>
                    </div>
                    <div>
                        <h5>Formulir Pengaturan Sistem</h5>
                        <small>Sesuaikan informasi global website sekolah di bawah ini</small>
                    </div>
                </div>
                <span class="total-badge"><i class="fa-solid fa-layer-group me-1"></i> Pengaturan Global</span>
            </div>

            <form action="<?= site_url('admin/pengaturan/update'); ?>" method="post" data-loading-form>
                <div class="form-body">

            <div class="form-section">
                <div class="form-section-title">
                    <div class="section-icon"><i class="fa-solid fa-school"></i></div>
                    <h6>Identitas Website</h6>
                </div>
                <div class="row g-4">
                    <div class="col-md-8">
                        <label for="set-nama_sekolah" class="form-label required">Nama Sekolah</label>
                        <div class="input-icon-group">
                            <i class="fa-solid fa-school input-icon"></i>
                            <input type="text" id="set-nama_sekolah" name="nama_sekolah" class="form-control with-icon"
                                   value="<?= html_escape($val('nama_sekolah')); ?>"
                                   placeholder="Masukkan nama sekolah" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="set-tagline" class="form-label">Tagline</label>
                        <div class="input-icon-group">
                            <i class="fa-solid fa-quote-left input-icon"></i>
                            <input type="text" id="set-tagline" name="tagline" class="form-control with-icon"
                                   value="<?= html_escape($val('tagline')); ?>"
                                   placeholder="Slogan atau tagline">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="set-logo" class="form-label">Logo Website</label>
                        <div class="input-icon-group">
                            <i class="fa-solid fa-image input-icon"></i>
                            <input type="text" id="set-logo" name="logo" class="form-control with-icon"
                                   value="<?= html_escape($val('logo')); ?>"
                                   placeholder="Nama file logo">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="set-favicon" class="form-label">Favicon Website</label>
                        <div class="input-icon-group">
                            <i class="fa-solid fa-bookmark input-icon"></i>
                            <input type="text" id="set-favicon" name="favicon" class="form-control with-icon"
                                   value="<?= html_escape($val('favicon')); ?>"
                                   placeholder="Nama file favicon">
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-section">
                <div class="form-section-title">
                    <div class="section-icon"><i class="fa-solid fa-address-card"></i></div>
                    <h6>Kontak Sekolah</h6>
                </div>
                <div class="row g-4">
                    <div class="col-12">
                        <label for="set-alamat" class="form-label">Alamat Lengkap</label>
                        <div class="input-icon-group is-textarea">
                            <i class="fa-solid fa-map-location-dot input-icon"></i>
                            <textarea id="set-alamat" name="alamat" rows="3"
                                      class="form-control with-icon custom-textarea"
                                      placeholder="Masukkan alamat lengkap sekolah"
                                      data-count-target="count-alamat"><?= html_escape($val('alamat')); ?></textarea>
                        </div>
                        <div class="form-hint">
                            <i class="fa-solid fa-circle-info"></i>
                            <span>Tuliskan alamat selengkap mungkin.</span>
                            <span class="char-count"><span id="count-alamat">0</span> karakter</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="set-telepon" class="form-label">Telepon</label>
                        <div class="input-icon-group">
                            <i class="fa-solid fa-phone input-icon"></i>
                            <input type="text" id="set-telepon" name="telepon" class="form-control with-icon"
                                   value="<?= html_escape($val('telepon')); ?>"
                                   placeholder="Nomor telepon">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="set-email" class="form-label">Email Resmi</label>
                        <div class="input-icon-group">
                            <i class="fa-solid fa-envelope input-icon"></i>
                            <input type="email" id="set-email" name="email" class="form-control with-icon"
                                   value="<?= html_escape($val('email')); ?>"
                                   placeholder="Alamat email aktif">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="set-whatsapp" class="form-label">WhatsApp</label>
                        <div class="input-icon-group">
                            <i class="fa-brands fa-whatsapp input-icon"></i>
                            <input type="text" id="set-whatsapp" name="whatsapp" class="form-control with-icon"
                                   value="<?= html_escape($val('whatsapp')); ?>"
                                   placeholder="Nomor WhatsApp">
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-section">
                <div class="form-section-title">
                    <div class="section-icon"><i class="fa-solid fa-share-nodes"></i></div>
                    <h6>Sosial Media</h6>
                </div>
                <div class="row g-4">
                    <div class="col-md-4">
                        <label for="set-facebook" class="form-label">Facebook</label>
                        <div class="input-icon-group">
                            <i class="fa-brands fa-facebook input-icon"></i>
                            <input type="text" id="set-facebook" name="facebook" class="form-control with-icon"
                                   value="<?= html_escape($val('facebook')); ?>"
                                   placeholder="URL atau akun Facebook">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="set-instagram" class="form-label">Instagram</label>
                        <div class="input-icon-group">
                            <i class="fa-brands fa-instagram input-icon"></i>
                            <input type="text" id="set-instagram" name="instagram" class="form-control with-icon"
                                   value="<?= html_escape($val('instagram')); ?>"
                                   placeholder="URL atau akun Instagram">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="set-youtube" class="form-label">YouTube</label>
                        <div class="input-icon-group">
                            <i class="fa-brands fa-youtube input-icon"></i>
                            <input type="text" id="set-youtube" name="youtube" class="form-control with-icon"
                                   value="<?= html_escape($val('youtube')); ?>"
                                   placeholder="URL atau channel YouTube">
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-section">
                <div class="form-section-title">
                    <div class="section-icon"><i class="fa-solid fa-location-dot"></i></div>
                    <h6>Lokasi dan Footer</h6>
                </div>
                <div class="row g-4">
                    <div class="col-12">
                        <label for="set-maps" class="form-label">Google Maps (Embed HTML / Iframe)</label>
                        <div class="input-icon-group is-textarea">
                            <i class="fa-solid fa-map input-icon"></i>
                            <textarea id="set-maps" name="maps" rows="3"
                                      class="form-control with-icon custom-textarea"
                                      placeholder="Kode embed Google Maps"
                                      data-count-target="count-maps"><?= html_escape($val('maps')); ?></textarea>
                        </div>
                        <div class="form-hint">
                            <i class="fa-solid fa-circle-info"></i>
                            <span>Tempel kode embed iframe dari Google Maps.</span>
                            <span class="char-count"><span id="count-maps">0</span> karakter</span>
                        </div>
                    </div>
                    <div class="col-12">
                        <label for="set-footer" class="form-label">Teks Footer</label>
                        <div class="input-icon-group is-textarea">
                            <i class="fa-solid fa-copyright input-icon"></i>
                            <textarea id="set-footer" name="footer" rows="3"
                                      class="form-control with-icon custom-textarea"
                                      placeholder="Teks hak cipta atau catatan footer website"
                                      data-count-target="count-footer"><?= html_escape($val('footer')); ?></textarea>
                        </div>
                        <div class="form-hint">
                            <i class="fa-solid fa-circle-info"></i>
                            <span>Teks ini tampil di bagian bawah website.</span>
                            <span class="char-count"><span id="count-footer">0</span> karakter</span>
                        </div>
                    </div>
                </div>
            </div>

                </div>

                <div class="form-footer">
                    <button type="submit" class="btn-save">
                        <i class="fa-solid fa-floppy-disk me-2"></i> Simpan Pengaturan
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>

<style>
/* =========================================================
   TOKENS
========================================================= */
:root {
    --set-card: #ffffff;        --set-subtle: #f8fafc;
    --set-input-bg: #f8fafc;    --set-input-focus: #ffffff;
    --set-input-border: #cbd5e1;
    --set-border: rgba(226, 232, 240, .8);
    --set-title: #0f172a;       --set-subtitle: #64748b;
    --set-hover: #f1f5f9;
    --set-accent: #0ea5e9;      --set-glow: rgba(14, 165, 233, .25);
    --set-soft: rgba(14, 165, 233, .10);  --set-soft-border: rgba(14, 165, 233, .22);
    --set-icon-muted: #94a3b8;
    --set-success: #059669;     --set-danger: #dc2626;
    --set-shadow: 0 10px 25px -5px rgba(15, 23, 42, .05), 0 8px 10px -6px rgba(15, 23, 42, .02);
}
[data-bs-theme="dark"], [data-theme="dark"], body.dark-mode, .dark-mode {
    --set-card: #0f172a;        --set-subtle: #1e293b;
    --set-input-bg: #1e293b;    --set-input-focus: #111827;
    --set-input-border: rgba(255, 255, 255, .12);
    --set-border: rgba(255, 255, 255, .08);
    --set-title: #f8fafc;       --set-subtitle: #94a3b8;
    --set-hover: #1e293b;
    --set-accent: #38bdf8;      --set-glow: rgba(56, 189, 248, .25);
    --set-soft: rgba(56, 189, 248, .10);  --set-soft-border: rgba(56, 189, 248, .22);
    --set-icon-muted: #64748b;
    --set-success: #34d399;     --set-danger: #f87171;
    --set-shadow: 0 12px 30px -5px rgba(0, 0, 0, .4);
}

/* =========================================================
   FLASH MESSAGE
========================================================= */
.alert.alert-autodismiss {
    position: relative;
    overflow: hidden;
    display: flex;
    align-items: center;
    gap: 14px;
    padding: 14px 48px 14px 16px;
    border: 1px solid;
    border-radius: 16px;
    transition: opacity .35s ease, transform .35s ease, max-height .35s ease,
                padding .35s ease, margin .35s ease, border-width .35s ease;
    animation: setAlertIn .45s cubic-bezier(.34, 1.56, .64, 1) backwards;
}
.alert-autodismiss.is-success {
    background: rgba(16, 185, 129, .12);
    border-color: rgba(16, 185, 129, .30);
    color: var(--set-success);
}
.alert-autodismiss.is-error {
    background: rgba(239, 68, 68, .12);
    border-color: rgba(239, 68, 68, .30);
    color: var(--set-danger);
}
.alert-autodismiss.alert-hiding {
    opacity: 0;
    transform: translateY(-10px);
    max-height: 0 !important;
    padding-top: 0;
    padding-bottom: 0;
    margin-top: 0 !important;
    margin-bottom: 0 !important;
    border-width: 0;
}
.alert-icon-box {
    width: 36px;
    height: 36px;
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 10px;
    font-size: 16px;
}
.alert-autodismiss.is-success .alert-icon-box { background: rgba(16, 185, 129, .18); }
.alert-autodismiss.is-error .alert-icon-box   { background: rgba(239, 68, 68, .18); }
.alert-content {
    min-width: 0;
    display: flex;
    flex-direction: column;
    gap: 1px;
}
.alert-content strong { font-size: 13.5px; font-weight: 700; }
.alert-content span   { font-size: 12.5px; opacity: .92; word-break: break-word; }
.alert-autodismiss .btn-close {
    position: absolute;
    top: 50%;
    right: 14px;
    transform: translateY(-50%);
    margin: 0;
    padding: 6px;
    font-size: 10px;
    opacity: .55;
    transition: opacity .2s ease;
}
.alert-autodismiss .btn-close:hover { opacity: 1; }
.alert-progress-track {
    position: absolute;
    left: 0; right: 0; bottom: 0;
    height: 3px;
    background: rgba(148, 163, 184, .18);
}
.alert-progress-bar {
    width: 100%;
    height: 100%;
    background: currentColor;
    transform-origin: left center;
    animation: setAlertProgress linear forwards;
}
[data-bs-theme="dark"] .alert-autodismiss .btn-close,
[data-theme="dark"] .alert-autodismiss .btn-close,
body.dark-mode .alert-autodismiss .btn-close,
.dark-mode .alert-autodismiss .btn-close {
    filter: invert(1) grayscale(100%) brightness(200%);
}

/* =========================================================
   PAGE HEADER
========================================================= */
.page-header-custom {
    position: relative;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 20px;
    padding: 22px 28px;
    background: var(--set-card);
    border: 1px solid var(--set-border);
    border-radius: 20px;
    box-shadow: var(--set-shadow);
    animation: setFadeUp .4s ease both;
}
.page-header-custom::before {
    content: "";
    position: absolute;
    inset: 0 auto 0 0;
    width: 4px;
    background: linear-gradient(180deg, var(--set-accent), #0369a1);
}
.page-header-custom::after {
    content: "";
    position: absolute;
    top: -70px;
    right: -50px;
    width: 180px;
    height: 180px;
    border-radius: 50%;
    background: var(--set-soft);
    pointer-events: none;
}
.page-header-custom > * { position: relative; z-index: 1; }
.page-header-icon {
    width: 52px;
    height: 52px;
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 16px;
    background: var(--set-soft);
    border: 1px solid var(--set-soft-border);
    color: var(--set-accent);
    font-size: 22px;
    transition: transform .35s ease;
}
.page-header-custom:hover .page-header-icon { transform: rotate(-6deg) scale(1.06); }
.badge-header-tag {
    display: inline-flex;
    align-items: center;
    padding: 4px 10px;
    border-radius: 999px;
    background: var(--set-soft);
    border: 1px solid var(--set-soft-border);
    color: var(--set-accent);
    font-size: 10.5px;
    font-weight: 800;
    letter-spacing: .6px;
    text-transform: uppercase;
}
.page-title {
    margin: 0 0 2px;
    color: var(--set-title);
    font-size: 22px;
    font-weight: 800;
    letter-spacing: -.3px;
}
.page-subtitle {
    margin: 0;
    color: var(--set-subtitle);
    font-size: 13px;
}

/* =========================================================
   CARD
========================================================= */
.custom-card {
    overflow: hidden;
    background: var(--set-card);
    border: 1px solid var(--set-border);
    border-radius: 20px;
    box-shadow: var(--set-shadow);
    animation: setFadeUp .4s ease .05s both;
}
.card-title-custom {
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 16px;
    padding: 18px 24px;
    background: var(--set-subtle);
    border-bottom: 1px solid var(--set-border);
}
.title-icon {
    width: 42px;
    height: 42px;
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 12px;
    background: var(--set-soft);
    border: 1px solid var(--set-soft-border);
    color: var(--set-accent);
    font-size: 16px;
}
.card-title-custom h5 {
    margin: 0 0 2px;
    color: var(--set-title);
    font-size: 15px;
    font-weight: 700;
}
.card-title-custom small {
    color: var(--set-subtitle);
    font-size: 12px;
}
.total-badge {
    display: inline-flex;
    align-items: center;
    padding: 6px 14px;
    border-radius: 999px;
    background: var(--set-soft);
    border: 1px solid var(--set-soft-border);
    color: var(--set-accent);
    font-size: 12px;
    font-weight: 700;
}

/* =========================================================
   BUTTON
========================================================= */
.btn-back, .btn-cancel, .btn-save {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 11px 20px;
    border-radius: 12px;
    font-size: 12.5px;
    font-weight: 700;
    line-height: 1.4;
    text-decoration: none;
    white-space: nowrap;
    cursor: pointer;
    transition: all .25s ease;
}
.btn-save {
    position: relative;
    border: 0;
    background: linear-gradient(135deg, #0284c7, #0369a1);
    color: #ffffff !important;
    box-shadow: 0 6px 18px rgba(2, 132, 199, .28);
}
.btn-save:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 24px rgba(2, 132, 199, .45);
}
.btn-save.is-loading {
    color: transparent !important;
    pointer-events: none;
}
.btn-save.is-loading::after {
    content: "";
    position: absolute;
    top: 50%;
    left: 50%;
    width: 18px;
    height: 18px;
    margin: -9px 0 0 -9px;
    border: 2.5px solid rgba(255, 255, 255, .3);
    border-top-color: #ffffff;
    border-radius: 50%;
    animation: setSpin .7s linear infinite;
}
.btn-back {
    background: var(--set-subtle);
    border: 1px solid var(--set-border);
    color: var(--set-title);
}
.btn-back:hover {
    background: var(--set-hover);
    color: var(--set-accent);
    transform: translateX(-3px);
}
.btn-cancel {
    background: var(--set-card);
    border: 1px solid var(--set-border);
    color: var(--set-title);
}
.btn-cancel:hover {
    color: #ef4444;
    transform: translateY(-1px);
}
.btn-back:focus-visible, .btn-cancel:focus-visible, .btn-save:focus-visible,
.alert-autodismiss .btn-close:focus-visible {
    outline: 2px solid var(--set-accent);
    outline-offset: 2px;
}

/* =========================================================
   FORM
========================================================= */
.form-body { padding: 24px; }
.custom-card .form-label {
    display: block;
    margin-bottom: 8px;
    color: var(--set-title);
    font-size: 12.5px;
    font-weight: 700;
}
.form-label.required::after { content: " *"; color: var(--set-danger); }

.input-icon-group { position: relative; }
.input-icon {
    position: absolute;
    top: 50%;
    left: 16px;
    z-index: 2;
    width: 16px;
    transform: translateY(-50%);
    text-align: center;
    color: var(--set-icon-muted);
    font-size: 14px;
    pointer-events: none;
    transition: color .2s ease;
}
.input-icon-group:focus-within .input-icon { color: var(--set-accent); }
.input-icon-group.is-textarea .input-icon { top: 17px; transform: none; }

.custom-card .form-control {
    padding: 11px 16px;
    background-color: var(--set-input-bg);
    border: 1px solid var(--set-input-border);
    border-radius: 12px;
    color: var(--set-title);
    font-size: 13.5px;
    line-height: 1.5;
    box-shadow: none;
    transition: border-color .2s ease, background-color .2s ease, box-shadow .2s ease;
}
.custom-card .form-control.with-icon { padding-left: 42px; }
.custom-card .form-control::placeholder { color: var(--set-icon-muted); opacity: 1; }
.custom-card .form-control:hover:not(:focus) { border-color: var(--set-accent); }
.custom-card .form-control:focus {
    outline: 0;
    background-color: var(--set-input-focus);
    border-color: var(--set-accent);
    color: var(--set-title);
    box-shadow: 0 0 0 4px var(--set-glow);
}
.custom-card .form-control:-webkit-autofill {
    -webkit-text-fill-color: var(--set-title);
    caret-color: var(--set-title);
    box-shadow: 0 0 0 1000px var(--set-input-bg) inset;
}
.custom-card .form-control:-webkit-autofill:focus {
    box-shadow: 0 0 0 1000px var(--set-input-focus) inset, 0 0 0 4px var(--set-glow);
}
.custom-select {
    padding-right: 40px !important;
    appearance: none;
    -webkit-appearance: none;
    cursor: pointer;
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%2394a3b8' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m2 5 6 6 6-6'/%3e%3c/svg%3e");
    background-repeat: no-repeat;
    background-position: right 16px center;
    background-size: 14px 10px;
}
.custom-select option { background: var(--set-input-bg); color: var(--set-title); }
.custom-textarea { min-height: 96px; resize: vertical; line-height: 1.65 !important; }

.form-hint {
    display: flex;
    align-items: center;
    gap: 6px;
    margin-top: 8px;
    color: var(--set-subtitle);
    font-size: 11.5px;
}
.form-hint i { color: var(--set-accent); }
.form-hint .char-count { margin-left: auto; font-variant-numeric: tabular-nums; white-space: nowrap; }

.form-footer {
    display: flex;
    align-items: center;
    justify-content: flex-end;
    gap: 12px;
    padding: 18px 24px;
    background: var(--set-subtle);
    border-top: 1px solid var(--set-border);
}

input[type="date"] { color-scheme: light; }
[data-bs-theme="dark"] input[type="date"],
[data-theme="dark"] input[type="date"],
body.dark-mode input[type="date"],
.dark-mode input[type="date"] { color-scheme: dark; }

/* =========================================================
   ANIMASI
========================================================= */
@keyframes setFadeUp {
    from { opacity: 0; transform: translateY(12px); }
    to   { opacity: 1; transform: translateY(0); }
}
@keyframes setAlertIn {
    from { opacity: 0; transform: translateY(-14px) scale(.98); }
    to   { opacity: 1; transform: translateY(0) scale(1); }
}
@keyframes setAlertProgress {
    from { transform: scaleX(1); }
    to   { transform: scaleX(0); }
}
@keyframes setSpin { to { transform: rotate(360deg); } }

/* =========================================================
   SECTION FORM
========================================================= */
.form-section + .form-section { margin-top: 32px; }
.form-section-title {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 20px;
    padding-bottom: 12px;
    border-bottom: 1px solid var(--set-border);
}
.section-icon {
    width: 28px;
    height: 28px;
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 8px;
    background: var(--set-soft);
    border: 1px solid var(--set-soft-border);
    color: var(--set-accent);
    font-size: 12px;
}
.form-section-title h6 {
    margin: 0;
    color: var(--set-title);
    font-size: 13.5px;
    font-weight: 700;
}

/* =========================================================
   RESPONSIVE & REDUCED MOTION
========================================================= */
@media (max-width: 768px) {
    .page-header-custom { flex-direction: column; align-items: stretch; gap: 16px; padding: 18px 18px 18px 22px; }
    .card-title-custom  { padding: 16px; }
    .form-body          { padding: 16px; }
    .form-footer        { flex-direction: column-reverse; align-items: stretch; padding: 16px; }
    .btn-back, .btn-cancel, .btn-save { width: 100%; }
}
@media (prefers-reduced-motion: reduce) {
    .alert-autodismiss, .alert-progress-bar, .page-header-custom, .page-header-icon,
    .custom-card, .btn-back, .btn-cancel, .btn-save, .btn-save::after,
    .custom-card .form-control, .input-icon {
        animation: none !important;
        transition: none !important;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Flash message: auto-dismiss, pause saat hover, tombol tutup
    document.querySelectorAll('.alert-autodismiss').forEach(function (alertEl) {
        var duration = parseInt(alertEl.getAttribute('data-autodismiss'), 10) || 4500;
        var bar = alertEl.querySelector('.alert-progress-bar');
        var closeBtn = alertEl.querySelector('.btn-close');
        var remaining = duration;
        var startedAt = Date.now();
        var timer = null;
        var closed = false;

        if (bar) bar.style.animationDuration = duration + 'ms';

        function closeAlert() {
            if (closed) return;
            closed = true;
            clearTimeout(timer);
            alertEl.style.maxHeight = alertEl.offsetHeight + 'px';
            void alertEl.offsetHeight;
            alertEl.classList.add('alert-hiding');
            setTimeout(function () {
                if (alertEl.parentNode) alertEl.parentNode.removeChild(alertEl);
            }, 380);
        }

        function startTimer(ms) {
            startedAt = Date.now();
            timer = setTimeout(closeAlert, ms);
        }

        startTimer(remaining);

        alertEl.addEventListener('mouseenter', function () {
            if (closed) return;
            clearTimeout(timer);
            remaining -= (Date.now() - startedAt);
            if (bar) bar.style.animationPlayState = 'paused';
        });
        alertEl.addEventListener('mouseleave', function () {
            if (closed) return;
            if (bar) bar.style.animationPlayState = 'running';
            startTimer(Math.max(remaining, 800));
        });

        if (closeBtn) {
            closeBtn.addEventListener('click', function (e) {
                e.preventDefault();
                closeAlert();
            });
        }
    });

    // Penghitung karakter pada textarea
    document.querySelectorAll('textarea[data-count-target]').forEach(function (area) {
        var out = document.getElementById(area.getAttribute('data-count-target'));
        if (!out) return;
        function update() { out.textContent = area.value.length.toLocaleString('id-ID'); }
        area.addEventListener('input', update);
        update();
    });

    // Tombol simpan: state loading saat form dikirim (mencegah klik ganda)
    document.querySelectorAll('form[data-loading-form]').forEach(function (form) {
        var btn = form.querySelector('.btn-save');
        form.addEventListener('submit', function (e) {
            if (form.getAttribute('data-submitting') === '1') {
                e.preventDefault();
                return;
            }
            form.setAttribute('data-submitting', '1');
            if (btn) btn.classList.add('is-loading');
        });
    });
    window.addEventListener('pageshow', function (e) {
        if (!e.persisted) return;
        document.querySelectorAll('form[data-loading-form]').forEach(function (form) {
            form.removeAttribute('data-submitting');
            var btn = form.querySelector('.btn-save');
            if (btn) btn.classList.remove('is-loading');
        });
    });
});
</script>

<?php $this->load->view('admin/template/footer'); ?>