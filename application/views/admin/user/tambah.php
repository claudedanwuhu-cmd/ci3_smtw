<?php
/**
 * Halaman tambah pengguna (form mandiri, tanpa partial).
 */
$is_edit      = false;
$u            = null;
$action       = site_url('admin/user/simpan');
$submit_label = 'Simpan User';
$val          = function ($key, $default = '') use ($u) {
    return ($u !== null && isset($u->$key)) ? (string) $u->$key : $default;
};
$is_active = ($val('status', 'aktif') !== 'nonaktif');
$role      = $val('role', 'petugas');
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
                    <i class="fa-solid fa-user-plus"></i>
                </div>
                <div>
                    <span class="badge-header-tag mb-1">
                        <i class="fa-solid fa-users-gear me-1"></i> Manajemen User
                    </span>
                    <h2 class="page-title">Tambah User</h2>
                    <p class="page-subtitle">Buat akun administrator atau petugas baru untuk panel admin.</p>
                </div>
            </div>
            <a href="<?= site_url('admin/user'); ?>" class="btn-back">
                <i class="fa-solid fa-arrow-left me-2"></i> Kembali
            </a>
        </div>

        <!-- 3. CARD FORM -->
        <div class="custom-card">
            <div class="card-title-custom">
                <div class="d-flex align-items-center gap-3">
                    <div class="title-icon">
                        <i class="fa-solid fa-address-card"></i>
                    </div>
                    <div>
                        <h5>Formulir Tambah User</h5>
                        <small>Isi data akun dan hak akses di bawah ini</small>
                    </div>
                </div>
                <span class="total-badge"><i class="fa-solid fa-plus me-1"></i> Form Input</span>
            </div>

            <form action="<?= html_escape($action); ?>" method="post" data-loading-form autocomplete="off">
                <?php if ($this->config->item('csrf_protection') === TRUE): ?>
                    <input type="hidden" name="<?= html_escape($this->security->get_csrf_token_name()); ?>" value="<?= html_escape($this->security->get_csrf_hash()); ?>">
                <?php endif; ?>

                <div class="form-body">
                    <div class="row g-4">

                        <!-- NAMA LENGKAP -->
                        <div class="col-md-6">
                            <label for="user-nama" class="form-label required">Nama Lengkap</label>
                            <div class="input-icon-group">
                                <i class="fa-solid fa-user input-icon"></i>
                                <input type="text" id="user-nama" name="nama" class="form-control with-icon"
                                       value="<?= html_escape($val('nama')); ?>"
                                       placeholder="Masukkan nama lengkap" required>
                            </div>
                        </div>

                        <!-- USERNAME -->
                        <div class="col-md-6">
                            <label for="user-username" class="form-label required">Username</label>
                            <div class="input-icon-group">
                                <i class="fa-solid fa-at input-icon"></i>
                                <input type="text" id="user-username" name="username" class="form-control with-icon"
                                       value="<?= html_escape($val('username')); ?>"
                                       placeholder="<?= $is_edit ? 'Masukkan username' : 'Masukkan username unik'; ?>"
                                       autocomplete="off" required>
                            </div>
                        </div>

                        <!-- PASSWORD -->
                        <div class="col-md-6">
                            <label for="user-password" class="form-label<?= $is_edit ? '' : ' required'; ?>">
                                <?= $is_edit ? 'Password Baru' : 'Password'; ?>
                            </label>
                            <div class="input-icon-group">
                                <i class="fa-solid fa-lock input-icon"></i>
                                <input type="password" id="user-password" name="password" class="form-control with-icon"
                                       placeholder="<?= $is_edit ? 'Kosongkan jika tidak ingin mengubah password' : 'Masukkan password akun'; ?>"
                                       autocomplete="new-password"<?= $is_edit ? '' : ' required'; ?>>
                            </div>
                            <div class="form-hint">
                                <i class="fa-solid fa-circle-info"></i>
                                <span><?= $is_edit ? 'Kosongkan jika tidak ingin mengganti password.' : 'Gunakan kombinasi huruf, angka, dan simbol agar aman.'; ?></span>
                            </div>
                        </div>

                        <!-- ROLE -->
                        <div class="col-md-6">
                            <label for="user-role" class="form-label required">Role Akses</label>
                            <div class="input-icon-group">
                                <i class="fa-solid fa-shield-halved input-icon"></i>
                                <select id="user-role" name="role" class="form-control with-icon custom-select" required>
                                    <option value="petugas"<?= $role === 'petugas' ? ' selected' : ''; ?>>Petugas</option>
                                    <option value="admin"<?= $role === 'admin' ? ' selected' : ''; ?>>Admin</option>
                                </select>
                            </div>
                        </div>

                        <!-- STATUS (TOGGLE CARD) -->
                        <div class="col-md-6">
                            <div class="form-label" id="user-status-label">Status Akun</div>
                            <div class="toggle-card" role="switch" tabindex="0"
                                 aria-checked="<?= $is_active ? 'true' : 'false'; ?>"
                                 aria-labelledby="user-status-label"
                                 data-toggle-status
                                 data-on-label="Akun aktif"
                                 data-on-desc="User dapat masuk ke panel admin."
                                 data-off-label="Akun nonaktif"
                                 data-off-desc="User tidak dapat masuk ke sistem.">
                                <div class="toggle-icon">
                                    <i class="<?= $is_active ? 'fa-solid fa-circle-check' : 'fa-solid fa-circle-xmark'; ?>"></i>
                                </div>
                                <div class="toggle-text">
                                    <strong class="toggle-label"><?= $is_active ? 'Akun aktif' : 'Akun nonaktif'; ?></strong>
                                    <span class="toggle-desc"><?= $is_active ? 'User dapat masuk ke panel admin.' : 'User tidak dapat masuk ke sistem.'; ?></span>
                                </div>
                                <span class="toggle-switch" aria-hidden="true"></span>
                                <input type="hidden" name="status" value="<?= $is_active ? 'aktif' : 'nonaktif'; ?>">
                            </div>
                        </div>

                        <!-- FOTO -->
                        <div class="col-md-6">
                            <label for="user-foto" class="form-label">Nama File Foto</label>
                            <div class="input-icon-group">
                                <i class="fa-solid fa-image input-icon"></i>
                                <input type="text" id="user-foto" name="foto" class="form-control with-icon"
                                       value="<?= html_escape($val('foto')); ?>"
                                       placeholder="Contoh: admin.jpg (opsional)">
                            </div>
                            <div class="form-hint">
                                <i class="fa-solid fa-circle-info"></i>
                                <span>Opsional. Nama file foto di folder assets/img/user.</span>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="form-footer">
                    <a href="<?= site_url('admin/user'); ?>" class="btn-cancel">
                        <i class="fa-solid fa-xmark me-2"></i> Batal
                    </a>
                    <button type="submit" class="btn-save">
                        <i class="fa-solid fa-floppy-disk me-2"></i> <?= html_escape($submit_label); ?>
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
    --user-card: #ffffff;        --user-subtle: #f8fafc;
    --user-input-bg: #f8fafc;    --user-input-focus: #ffffff;
    --user-input-border: #cbd5e1;
    --user-border: rgba(226, 232, 240, .8);
    --user-title: #0f172a;       --user-subtitle: #64748b;
    --user-hover: #f1f5f9;
    --user-accent: #0ea5e9;      --user-glow: rgba(14, 165, 233, .25);
    --user-soft: rgba(14, 165, 233, .10);  --user-soft-border: rgba(14, 165, 233, .22);
    --user-icon-muted: #94a3b8;
    --user-success: #059669;     --user-danger: #dc2626;
    --user-shadow: 0 10px 25px -5px rgba(15, 23, 42, .05), 0 8px 10px -6px rgba(15, 23, 42, .02);
}
[data-bs-theme="dark"], [data-theme="dark"], body.dark-mode, .dark-mode {
    --user-card: #0f172a;        --user-subtle: #1e293b;
    --user-input-bg: #1e293b;    --user-input-focus: #111827;
    --user-input-border: rgba(255, 255, 255, .12);
    --user-border: rgba(255, 255, 255, .08);
    --user-title: #f8fafc;       --user-subtitle: #94a3b8;
    --user-hover: #1e293b;
    --user-accent: #38bdf8;      --user-glow: rgba(56, 189, 248, .25);
    --user-soft: rgba(56, 189, 248, .10);  --user-soft-border: rgba(56, 189, 248, .22);
    --user-icon-muted: #64748b;
    --user-success: #34d399;     --user-danger: #f87171;
    --user-shadow: 0 12px 30px -5px rgba(0, 0, 0, .4);
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
    animation: userAlertIn .45s cubic-bezier(.34, 1.56, .64, 1) backwards;
}
.alert-autodismiss.is-success {
    background: rgba(16, 185, 129, .12);
    border-color: rgba(16, 185, 129, .30);
    color: var(--user-success);
}
.alert-autodismiss.is-error {
    background: rgba(239, 68, 68, .12);
    border-color: rgba(239, 68, 68, .30);
    color: var(--user-danger);
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
    animation: userAlertProgress linear forwards;
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
    background: var(--user-card);
    border: 1px solid var(--user-border);
    border-radius: 20px;
    box-shadow: var(--user-shadow);
    animation: userFadeUp .4s ease both;
}
.page-header-custom::before {
    content: "";
    position: absolute;
    inset: 0 auto 0 0;
    width: 4px;
    background: linear-gradient(180deg, var(--user-accent), #0369a1);
}
.page-header-custom::after {
    content: "";
    position: absolute;
    top: -70px;
    right: -50px;
    width: 180px;
    height: 180px;
    border-radius: 50%;
    background: var(--user-soft);
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
    background: var(--user-soft);
    border: 1px solid var(--user-soft-border);
    color: var(--user-accent);
    font-size: 22px;
    transition: transform .35s ease;
}
.page-header-custom:hover .page-header-icon { transform: rotate(-6deg) scale(1.06); }
.badge-header-tag {
    display: inline-flex;
    align-items: center;
    padding: 4px 10px;
    border-radius: 999px;
    background: var(--user-soft);
    border: 1px solid var(--user-soft-border);
    color: var(--user-accent);
    font-size: 10.5px;
    font-weight: 800;
    letter-spacing: .6px;
    text-transform: uppercase;
}
.page-title {
    margin: 0 0 2px;
    color: var(--user-title);
    font-size: 22px;
    font-weight: 800;
    letter-spacing: -.3px;
}
.page-subtitle {
    margin: 0;
    color: var(--user-subtitle);
    font-size: 13px;
}

/* =========================================================
   CARD
========================================================= */
.custom-card {
    overflow: hidden;
    background: var(--user-card);
    border: 1px solid var(--user-border);
    border-radius: 20px;
    box-shadow: var(--user-shadow);
    animation: userFadeUp .4s ease .05s both;
    transition: box-shadow .3s ease, border-color .3s ease;
}
.custom-card:hover {
    border-color: var(--user-soft-border);
    box-shadow: 0 16px 34px -10px rgba(15, 23, 42, .12);
}
[data-bs-theme="dark"] .custom-card:hover,
[data-theme="dark"] .custom-card:hover,
body.dark-mode .custom-card:hover,
.dark-mode .custom-card:hover {
    box-shadow: 0 16px 34px -10px rgba(0, 0, 0, .55);
}
.card-title-custom {
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 16px;
    padding: 18px 24px;
    background: var(--user-subtle);
    border-bottom: 1px solid var(--user-border);
}
.title-icon {
    width: 42px;
    height: 42px;
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 12px;
    background: var(--user-soft);
    border: 1px solid var(--user-soft-border);
    color: var(--user-accent);
    font-size: 16px;
}
.card-title-custom h5 {
    margin: 0 0 2px;
    color: var(--user-title);
    font-size: 15px;
    font-weight: 700;
}
.card-title-custom small {
    color: var(--user-subtitle);
    font-size: 12px;
}
.total-badge {
    display: inline-flex;
    align-items: center;
    padding: 6px 14px;
    border-radius: 999px;
    background: var(--user-soft);
    border: 1px solid var(--user-soft-border);
    color: var(--user-accent);
    font-size: 12px;
    font-weight: 700;
}

/* =========================================================
   ANIMASI
========================================================= */
@keyframes userFadeUp {
    from { opacity: 0; transform: translateY(12px); }
    to   { opacity: 1; transform: translateY(0); }
}
@keyframes userAlertIn {
    from { opacity: 0; transform: translateY(-14px) scale(.98); }
    to   { opacity: 1; transform: translateY(0) scale(1); }
}
@keyframes userAlertProgress {
    from { transform: scaleX(1); }
    to   { transform: scaleX(0); }
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
    animation: userSpin .7s linear infinite;
}
.btn-back {
    background: var(--user-subtle);
    border: 1px solid var(--user-border);
    color: var(--user-title);
}
.btn-back:hover {
    background: var(--user-hover);
    color: var(--user-accent);
    transform: translateX(-3px);
}
.btn-cancel {
    background: var(--user-card);
    border: 1px solid var(--user-border);
    color: var(--user-title);
}
.btn-cancel:hover {
    color: #ef4444;
    transform: translateY(-1px);
}
.btn-back:focus-visible, .btn-cancel:focus-visible, .btn-save:focus-visible,
.alert-autodismiss .btn-close:focus-visible {
    outline: 2px solid var(--user-accent);
    outline-offset: 2px;
}
@keyframes userSpin { to { transform: rotate(360deg); } }

/* =========================================================
   FORM
========================================================= */
.form-body { padding: 24px; }
.custom-card .form-label {
    display: block;
    margin-bottom: 8px;
    color: var(--user-title);
    font-size: 12.5px;
    font-weight: 700;
}
.form-label.required::after { content: " *"; color: var(--user-danger); }

.input-icon-group { position: relative; }
.input-icon {
    position: absolute;
    top: 50%;
    left: 16px;
    z-index: 2;
    width: 16px;
    transform: translateY(-50%);
    text-align: center;
    color: var(--user-icon-muted);
    font-size: 14px;
    pointer-events: none;
    transition: color .2s ease;
}
.input-icon-group:focus-within .input-icon { color: var(--user-accent); }

.custom-card .form-control {
    padding: 11px 16px;
    background-color: var(--user-input-bg);
    border: 1px solid var(--user-input-border);
    border-radius: 12px;
    color: var(--user-title);
    font-size: 13.5px;
    line-height: 1.5;
    box-shadow: none;
    transition: border-color .2s ease, background-color .2s ease, box-shadow .2s ease;
}
.custom-card .form-control.with-icon { padding-left: 42px; }
.custom-card .form-control::placeholder { color: var(--user-icon-muted); opacity: 1; }
.custom-card .form-control:hover:not(:focus) { border-color: var(--user-accent); }
.custom-card .form-control:focus {
    outline: 0;
    background-color: var(--user-input-focus);
    border-color: var(--user-accent);
    color: var(--user-title);
    box-shadow: 0 0 0 4px var(--user-glow);
}
.custom-card .form-control:-webkit-autofill {
    -webkit-text-fill-color: var(--user-title);
    caret-color: var(--user-title);
    box-shadow: 0 0 0 1000px var(--user-input-bg) inset;
}
.custom-card .form-control:-webkit-autofill:focus {
    box-shadow: 0 0 0 1000px var(--user-input-focus) inset, 0 0 0 4px var(--user-glow);
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
.custom-select option { background: var(--user-input-bg); color: var(--user-title); }

.form-hint {
    display: flex;
    align-items: center;
    gap: 6px;
    margin-top: 8px;
    color: var(--user-subtitle);
    font-size: 11.5px;
}
.form-hint i { color: var(--user-accent); }

.form-footer {
    display: flex;
    align-items: center;
    justify-content: flex-end;
    gap: 12px;
    padding: 18px 24px;
    background: var(--user-subtle);
    border-top: 1px solid var(--user-border);
}

input[type="date"] { color-scheme: light; }
[data-bs-theme="dark"] input[type="date"],
[data-theme="dark"] input[type="date"],
body.dark-mode input[type="date"],
.dark-mode input[type="date"] { color-scheme: dark; }

/* =========================================================
   TOGGLE STATUS
========================================================= */
.toggle-card {
    display: flex;
    align-items: center;
    gap: 14px;
    padding: 12px 16px;
    background: var(--user-input-bg);
    border: 1px solid var(--user-input-border);
    border-radius: 12px;
    cursor: pointer;
    user-select: none;
    transition: border-color .2s ease, background-color .2s ease, box-shadow .2s ease;
}
.toggle-card:hover { border-color: var(--user-accent); }
.toggle-card:focus-visible {
    outline: 0;
    border-color: var(--user-accent);
    box-shadow: 0 0 0 4px var(--user-glow);
}
.toggle-icon {
    width: 38px;
    height: 38px;
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 11px;
    background: rgba(16, 185, 129, .12);
    color: var(--user-success);
    font-size: 16px;
    transition: background-color .25s ease, color .25s ease;
}
.toggle-card[aria-checked="false"] .toggle-icon {
    background: rgba(239, 68, 68, .12);
    color: var(--user-danger);
}
.toggle-text { flex: 1; min-width: 0; display: flex; flex-direction: column; }
.toggle-text strong { color: var(--user-title); font-size: 13px; font-weight: 700; }
.toggle-text span   { color: var(--user-subtitle); font-size: 12px; }
.toggle-switch {
    position: relative;
    flex-shrink: 0;
    width: 42px;
    height: 24px;
    border-radius: 999px;
    background: var(--user-success);
    transition: background-color .25s ease;
}
.toggle-switch::after {
    content: "";
    position: absolute;
    top: 3px;
    left: 21px;
    width: 18px;
    height: 18px;
    border-radius: 50%;
    background: var(--user-card);
    box-shadow: 0 1px 3px rgba(15, 23, 42, .25);
    transition: left .25s ease;
}
.toggle-card[aria-checked="false"] .toggle-switch { background: var(--user-icon-muted); }
.toggle-card[aria-checked="false"] .toggle-switch::after { left: 3px; }

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
    .custom-card .form-control, .input-icon,
    .toggle-card, .toggle-icon, .toggle-switch, .toggle-switch::after {
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

    // Toggle status akun (role="switch", Enter / Spasi)
    document.querySelectorAll('[data-toggle-status]').forEach(function (card) {
        var input = card.querySelector('input[type="hidden"]');
        var icon  = card.querySelector('.toggle-icon i');
        var label = card.querySelector('.toggle-label');
        var desc  = card.querySelector('.toggle-desc');

        function render(active) {
            card.setAttribute('aria-checked', active ? 'true' : 'false');
            if (input) input.value = active ? 'aktif' : 'nonaktif';
            if (icon)  icon.className = active ? 'fa-solid fa-circle-check' : 'fa-solid fa-circle-xmark';
            if (label) label.textContent = card.getAttribute(active ? 'data-on-label' : 'data-off-label');
            if (desc)  desc.textContent  = card.getAttribute(active ? 'data-on-desc' : 'data-off-desc');
        }
        function toggle() { render(card.getAttribute('aria-checked') !== 'true'); }

        card.addEventListener('click', toggle);
        card.addEventListener('keydown', function (e) {
            if (e.key === 'Enter' || e.key === ' ' || e.key === 'Spacebar') {
                e.preventDefault();
                toggle();
            }
        });
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