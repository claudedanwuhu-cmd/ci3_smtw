<?php $this->load->view('admin/template/header'); ?>
<?php $this->load->view('admin/template/sidebar'); ?>

<div class="main-content">
    <?php $this->load->view('admin/template/navbar'); ?>

    <div class="content-wrapper">

        <!-- FLASH MESSAGE: SUCCESS -->
        <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-autodismiss is-success" role="alert" data-autodismiss="4500">
                <div class="alert-icon-box"><i class="fa-solid fa-circle-check"></i></div>
                <div class="alert-content">
                    <strong>Berhasil</strong>
                    <span><?= html_escape($this->session->flashdata('success')); ?></span>
                </div>
                <button type="button" class="btn-close" aria-label="Tutup notifikasi"></button>
                <div class="alert-progress-track"><div class="alert-progress-bar"></div></div>
            </div>
        <?php endif; ?>

        <!-- FLASH MESSAGE: ERROR -->
        <?php if ($this->session->flashdata('error')): ?>
            <div class="alert alert-autodismiss is-error" role="alert" data-autodismiss="6000">
                <div class="alert-icon-box"><i class="fa-solid fa-circle-exclamation"></i></div>
                <div class="alert-content">
                    <strong>Gagal memproses data</strong>
                    <span><?= html_escape($this->session->flashdata('error')); ?></span>
                </div>
                <button type="button" class="btn-close" aria-label="Tutup notifikasi"></button>
                <div class="alert-progress-track"><div class="alert-progress-bar"></div></div>
            </div>
        <?php endif; ?>

        <!-- HEADER HALAMAN -->
        <div class="page-header-custom mb-4">
            <div class="d-flex align-items-center gap-3">
                <div class="page-header-icon">
                    <i class="fa-solid fa-file-pen"></i>
                </div>
                <div>
                    <span class="badge-header-tag mb-1">
                        <i class="fa-solid fa-pen-to-square me-1"></i> Form Edit
                    </span>
                    <h2 class="page-title">Edit Pengumuman</h2>
                    <p class="page-subtitle">Perbarui informasi pengumuman di bawah ini.</p>
                </div>
            </div>
            <a href="<?= site_url('admin/pengumuman'); ?>" class="btn-back">
                <i class="fa-solid fa-arrow-left me-2"></i>
                Kembali
            </a>
        </div>

        <!-- FORM EDIT -->
        <form id="form-edit-pengumuman" action="<?= site_url('admin/pengumuman/update/' . $pengumuman->id); ?>" method="POST">
            <div class="custom-card mb-4">

                <div class="card-title-custom">
                    <div class="title-icon">
                        <i class="fa-solid fa-bullhorn"></i>
                    </div>
                    <div>
                        <h5>Informasi Pengumuman</h5>
                        <small>Lengkapi judul, tanggal, dan isi pengumuman</small>
                    </div>
                </div>

                <div class="card-body-custom">
                    <div class="row g-4">

                        <!-- JUDUL -->
                        <div class="col-md-8">
                            <label class="form-label required">Judul Pengumuman</label>
                            <div class="input-icon-group">
                                <i class="fa-solid fa-heading input-icon"></i>
                                <input type="text" name="judul" class="form-control with-icon"
                                    value="<?= html_escape($pengumuman->judul ?? ''); ?>"
                                    placeholder="Contoh: Libur Semester Ganjil 2026..." required>
                            </div>
                        </div>

                        <!-- TANGGAL -->
                        <div class="col-md-4">
                            <label class="form-label">Tanggal</label>
                            <div class="input-icon-group">
                                <i class="fa-regular fa-calendar-days input-icon"></i>
                                <input type="date" name="tanggal" class="form-control with-icon peng-date-input"
                                    value="<?= html_escape($pengumuman->tanggal ?? ''); ?>">
                            </div>
                        </div>

                        <!-- ISI PENGUMUMAN -->
                        <div class="col-md-12">
                            <label class="form-label">Isi Pengumuman</label>
                            <textarea name="isi" id="peng-isi" class="form-control custom-textarea" rows="7"
                                placeholder="Tuliskan isi lengkap pengumuman di sini..."><?= html_escape($pengumuman->isi ?? ''); ?></textarea>
                            <div class="textarea-hint">
                                <i class="fa-solid fa-circle-info me-1"></i>
                                <span id="peng-isi-counter">0 karakter</span>
                            </div>
                        </div>

                        <!-- STATUS KEAKTIFAN (TOGGLE) -->
                        <?php $peng_aktif = isset($pengumuman->status) && in_array(strtolower(trim((string) $pengumuman->status)), array('aktif', 'publish', '1'), TRUE); ?>
                        <div class="col-md-12">
                            <label class="form-label">Status Keaktifan</label>
                            <div class="status-toggle-card" id="status-toggle" role="switch" tabindex="0"
                                aria-checked="<?= $peng_aktif ? 'true' : 'false'; ?>">
                                <div class="status-toggle-icon">
                                    <i class="fa-solid <?= $peng_aktif ? 'fa-circle-check' : 'fa-circle-xmark'; ?>"></i>
                                </div>
                                <div class="status-toggle-text">
                                    <span class="status-toggle-label"><?= $peng_aktif ? 'Aktif Ditampilkan' : 'Nonaktif / Disembunyikan'; ?></span>
                                    <span class="status-toggle-desc">Pengumuman akan langsung tampil di website saat status aktif.</span>
                                </div>
                                <div class="status-switch">
                                    <div class="status-switch-knob"></div>
                                </div>
                                <input type="hidden" name="status" id="status-input" value="<?= $peng_aktif ? 'aktif' : 'nonaktif'; ?>">
                            </div>
                        </div>

                    </div>
                </div>

                <!-- FOOTER / BUTTONS -->
                <div class="form-footer">
                    <a href="<?= site_url('admin/pengumuman'); ?>" class="btn-cancel">
                        <i class="fa-solid fa-xmark me-2"></i> Batal
                    </a>
                    <button type="submit" id="btn-submit-pengumuman" class="btn-save">
                        <span class="btn-save-content">
                            <i class="fa-solid fa-floppy-disk me-2"></i>
                            Perbarui Pengumuman
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
   DESIGN TOKENS
===================================================================== */
:root {
    --peng-card: #ffffff;
    --peng-subtle: #f8fafc;
    --peng-input-bg: #f8fafc;
    --peng-input-focus: #ffffff;
    --peng-input-border: #cbd5e1;
    --peng-border: rgba(226, 232, 240, .8);
    --peng-title: #0f172a;
    --peng-subtitle: #64748b;
    --peng-hover: #f1f5f9;
    --peng-accent: #0ea5e9;
    --peng-glow: rgba(14, 165, 233, .25);
    --peng-soft: rgba(14, 165, 233, .10);
    --peng-soft-border: rgba(14, 165, 233, .22);
    --peng-icon-muted: #94a3b8;
    --peng-success: #059669;
    --peng-danger: #dc2626;
    --peng-shadow: 0 10px 25px -5px rgba(15, 23, 42, .05), 0 8px 10px -6px rgba(15, 23, 42, .02);
}

[data-bs-theme="dark"], [data-theme="dark"], body.dark-mode, .dark-mode {
    --peng-card: #0f172a;
    --peng-subtle: #1e293b;
    --peng-input-bg: #1e293b;
    --peng-input-focus: #111827;
    --peng-input-border: rgba(255, 255, 255, .12);
    --peng-border: rgba(255, 255, 255, .08);
    --peng-title: #f8fafc;
    --peng-subtitle: #94a3b8;
    --peng-hover: #1e293b;
    --peng-accent: #38bdf8;
    --peng-glow: rgba(56, 189, 248, .25);
    --peng-soft: rgba(56, 189, 248, .10);
    --peng-soft-border: rgba(56, 189, 248, .22);
    --peng-icon-muted: #64748b;
    --peng-success: #34d399;
    --peng-danger: #f87171;
    --peng-shadow: 0 12px 30px -5px rgba(0, 0, 0, .4);
}

.fs-7 { font-size: 13px; }

/* FLASH MESSAGE */
.alert.alert-autodismiss {
    position: relative; display: flex; align-items: flex-start; gap: 14px;
    overflow: hidden; border-radius: 16px; padding: 16px 44px 16px 18px; margin-bottom: 20px;
    border: 1px solid transparent;
    animation: pengAlertIn .35s cubic-bezier(.34, 1.56, .64, 1);
}
.alert-autodismiss.is-success { background: rgba(16, 185, 129, .12); border-color: rgba(16, 185, 129, .3); color: var(--peng-success); }
.alert-autodismiss.is-error { background: rgba(239, 68, 68, .12); border-color: rgba(239, 68, 68, .3); color: var(--peng-danger); }
@keyframes pengAlertIn { from { opacity: 0; transform: translateY(-14px) scale(.98); } to { opacity: 1; transform: translateY(0) scale(1); } }
.alert-autodismiss.alert-hiding { animation: pengAlertOut .35s ease forwards; }
@keyframes pengAlertOut { to { opacity: 0; transform: translateY(-10px) scale(.98); margin-bottom: 0 !important; max-height: 0; padding-top: 0; padding-bottom: 0; } }
.alert-icon-box { width: 36px; height: 36px; flex-shrink: 0; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 17px; background: currentColor; }
.alert-icon-box i { color: var(--peng-card); }
.alert-content { display: flex; flex-direction: column; gap: 2px; }
.alert-content strong { font-size: 13.5px; font-weight: 800; }
.alert-content span { font-size: 13px; color: var(--peng-title); opacity: .85; }
.alert-autodismiss .btn-close {
    position: absolute; top: 14px; right: 14px; width: 22px; height: 22px; border: none; background: transparent;
    opacity: .6; cursor: pointer;
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23000'%3e%3cpath d='M.293.293a1 1 0 011.414 0L8 6.586 14.293.293a1 1 0 111.414 1.414L9.414 8l6.293 6.293a1 1 0 01-1.414 1.414L8 9.414l-6.293 6.293a1 1 0 01-1.414-1.414L6.586 8 .293 1.707a1 1 0 010-1.414z'/%3e%3c/svg%3e");
    background-repeat: no-repeat; background-position: center; background-size: 12px;
}
[data-bs-theme="dark"] .alert-autodismiss .btn-close,
[data-theme="dark"] .alert-autodismiss .btn-close,
body.dark-mode .alert-autodismiss .btn-close,
.dark-mode .alert-autodismiss .btn-close { filter: invert(1); }
.alert-autodismiss .btn-close:hover { opacity: 1; }
.alert-progress-track { position: absolute; left: 0; right: 0; bottom: 0; height: 3px; background: rgba(148, 163, 184, .2); }
.alert-progress-bar { height: 100%; width: 100%; background: currentColor; transform-origin: left; animation-name: pengAlertProgress; animation-timing-function: linear; animation-fill-mode: forwards; }
@keyframes pengAlertProgress { from { transform: scaleX(1); } to { transform: scaleX(0); } }

/* PAGE HEADER */
.page-header-custom {
    position: relative; overflow: hidden;
    background: var(--peng-card); border: 1px solid var(--peng-border); border-radius: 20px;
    padding: 22px 28px; display: flex; align-items: center; justify-content: space-between;
    box-shadow: var(--peng-shadow); gap: 20px;
}
.page-header-custom::before { content: ""; position: absolute; inset: 0 auto 0 0; width: 4px; background: linear-gradient(180deg, var(--peng-accent), #0369a1); }
.page-header-custom::after { content: ""; position: absolute; top: -60px; right: -60px; width: 180px; height: 180px; border-radius: 50%; background: var(--peng-soft); pointer-events: none; }
.page-header-icon {
    width: 52px; height: 52px; border-radius: 16px; background: var(--peng-soft); border: 1px solid var(--peng-soft-border);
    color: var(--peng-accent); display: flex; align-items: center; justify-content: center; font-size: 22px; flex-shrink: 0;
    transition: transform .35s ease;
}
.page-header-custom:hover .page-header-icon { transform: rotate(-6deg) scale(1.06); }
.badge-header-tag { display: inline-flex; align-items: center; background: var(--peng-soft); color: var(--peng-accent); border: 1px solid var(--peng-soft-border); padding: 4px 10px; border-radius: 20px; font-size: 10.5px; font-weight: 800; text-transform: uppercase; letter-spacing: .5px; }
.page-title { color: var(--peng-title); font-size: 22px; font-weight: 800; margin: 0 0 2px; letter-spacing: -.3px; }
.page-subtitle { color: var(--peng-subtitle); font-size: 13px; margin: 0; }

.btn-back {
    display: inline-flex; align-items: center; background: var(--peng-subtle); color: var(--peng-title);
    border: 1px solid var(--peng-border); text-decoration: none; padding: 10px 20px; border-radius: 12px;
    font-size: 13px; font-weight: 600; transition: all .25s ease; position: relative; z-index: 1;
}
.btn-back:hover { background: var(--peng-hover); color: var(--peng-accent); transform: translateX(-3px); }

/* CARD */
.custom-card { background: var(--peng-card); border: 1px solid var(--peng-border); border-radius: 20px; overflow: hidden; box-shadow: var(--peng-shadow); animation: pengFadeUp .4s ease both; }
@keyframes pengFadeUp { from { opacity: 0; transform: translateY(12px); } to { opacity: 1; transform: translateY(0); } }
.card-title-custom { display: flex; align-items: center; gap: 14px; padding: 18px 24px; background: var(--peng-subtle); border-bottom: 1px solid var(--peng-border); }
.title-icon { width: 40px; height: 40px; background: var(--peng-soft); border-radius: 12px; color: var(--peng-accent); display: flex; align-items: center; justify-content: center; font-size: 16px; flex-shrink: 0; }
.card-title-custom h5 { margin: 0 0 2px; color: var(--peng-title); font-size: 15px; font-weight: 700; }
.card-title-custom small { color: var(--peng-subtitle); font-size: 12px; }
.card-body-custom { padding: 24px; }

/* FORM ELEMENTS */
.form-label { color: var(--peng-title); font-size: 12.5px; font-weight: 700; margin-bottom: 8px; display: block; }
.form-label.required::after { content: " *"; color: var(--peng-danger); }
.input-icon-group { position: relative; display: flex; align-items: center; }
.input-icon-group .input-icon { position: absolute; left: 14px; color: var(--peng-icon-muted); font-size: 14px; pointer-events: none; transition: color .25s ease; }
.input-icon-group:focus-within .input-icon { color: var(--peng-accent); }
.form-control, .form-select {
    background-color: var(--peng-input-bg); border: 1px solid var(--peng-input-border); border-radius: 12px;
    font-size: 13.5px; color: var(--peng-title); padding: 10px 16px; width: 100%;
    transition: all .25s cubic-bezier(.4, 0, .2, 1);
}
.form-control.with-icon { padding-left: 42px; }
.form-control:hover:not(:focus), .form-select:hover:not(:focus) { border-color: var(--peng-accent); }
.form-control:focus, .form-select:focus { background-color: var(--peng-input-focus); border-color: var(--peng-accent); color: var(--peng-title); box-shadow: 0 0 0 4px var(--peng-glow); outline: none; }
.form-control::placeholder { color: var(--peng-subtitle); opacity: .6; }
.peng-date-input { color-scheme: light; }
[data-bs-theme="dark"] .peng-date-input, [data-theme="dark"] .peng-date-input, body.dark-mode .peng-date-input, .dark-mode .peng-date-input { color-scheme: dark; }

.custom-textarea { resize: vertical; min-height: 160px; line-height: 1.65; }
.textarea-hint { margin-top: 6px; font-size: 11.5px; color: var(--peng-subtitle); display: flex; align-items: center; }

/* STATUS TOGGLE CARD */
.status-toggle-card {
    position: relative; display: flex; align-items: center; gap: 14px;
    background: var(--peng-input-bg); border: 1px solid var(--peng-input-border); border-radius: 14px;
    padding: 14px 18px; cursor: pointer; transition: all .25s ease; outline: none;
}
.status-toggle-card:focus-visible { border-color: var(--peng-accent); box-shadow: 0 0 0 4px var(--peng-glow); }
.status-toggle-icon { width: 38px; height: 38px; border-radius: 10px; background: rgba(16, 185, 129, .15); color: #10b981; display: flex; align-items: center; justify-content: center; font-size: 16px; flex-shrink: 0; transition: all .2s ease; }
.status-toggle-text { display: flex; flex-direction: column; gap: 2px; flex: 1; }
.status-toggle-label { font-size: 13.5px; font-weight: 700; color: var(--peng-title); }
.status-toggle-desc { font-size: 11.5px; color: var(--peng-subtitle); }
.status-switch { width: 42px; height: 24px; border-radius: 999px; background: #cbd5e1; flex-shrink: 0; position: relative; transition: background .25s ease; }
.status-switch-knob { position: absolute; top: 3px; left: 3px; width: 18px; height: 18px; border-radius: 50%; background: #ffffff; box-shadow: 0 1px 3px rgba(0,0,0,.25); transition: transform .25s ease; }
.status-toggle-card[aria-checked="true"] .status-switch { background: #10b981; }
.status-toggle-card[aria-checked="true"] .status-switch-knob { transform: translateX(18px); }
.status-toggle-card[aria-checked="false"] .status-toggle-icon { background: rgba(239, 68, 68, .15); color: var(--peng-danger); }

/* FOOTER BUTTONS */
.form-footer { padding: 18px 24px; background: var(--peng-subtle); border-top: 1px solid var(--peng-border); display: flex; align-items: center; justify-content: flex-end; gap: 12px; }
.btn-cancel { background: var(--peng-card); border: 1px solid var(--peng-border); color: var(--peng-title); text-decoration: none; border-radius: 12px; padding: 11px 22px; font-size: 13px; font-weight: 600; transition: all .2s ease; display: inline-flex; align-items: center; }
.btn-cancel:hover { background: var(--peng-hover); color: var(--peng-danger); }
.btn-save { position: relative; overflow: hidden; border: none; background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%); color: #ffffff; border-radius: 12px; padding: 11px 26px; font-size: 13px; font-weight: 700; transition: all .3s ease; box-shadow: 0 4px 15px rgba(2, 132, 199, .3); cursor: pointer; }
.btn-save:hover { transform: translateY(-2px); box-shadow: 0 8px 22px rgba(2, 132, 199, .45); color: #fff; }
.btn-save-content { display: inline-flex; align-items: center; transition: opacity .2s ease; }
.btn-save.is-loading .btn-save-content { opacity: 0; }
.btn-save.is-loading { pointer-events: none; }
.btn-save-spinner { position: absolute; top: 50%; left: 50%; width: 18px; height: 18px; margin: -9px 0 0 -9px; border: 2.5px solid rgba(255,255,255,.35); border-top-color: #fff; border-radius: 50%; opacity: 0; animation: pengSpin .7s linear infinite; }
.btn-save.is-loading .btn-save-spinner { opacity: 1; }
@keyframes pengSpin { to { transform: rotate(360deg); } }

/* RESPONSIVE */
@media (max-width: 768px) {
    .page-header-custom { flex-direction: column; align-items: stretch; }
    .btn-back { justify-content: center; }
    .card-body-custom, .card-title-custom, .form-footer { padding: 20px 18px; }
    .form-footer { flex-direction: column-reverse; align-items: stretch; }
    .btn-cancel, .btn-save { width: 100%; justify-content: center; text-align: center; }
}

@media (prefers-reduced-motion: reduce) {
    .alert-autodismiss, .custom-card, .page-header-icon, .btn-save-spinner, .status-switch-knob { animation: none !important; transition: none !important; }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // ---------- AUTO-DISMISS FLASH MESSAGE ----------
    document.querySelectorAll('.alert-autodismiss').forEach(function (alertEl) {
        var duration = parseInt(alertEl.getAttribute('data-autodismiss'), 10) || 5000;
        var bar = alertEl.querySelector('.alert-progress-bar');
        if (bar) bar.style.animationDuration = duration + 'ms';

        var dismissed = false;
        function closeAlert() {
            if (dismissed) return;
            dismissed = true;
            alertEl.style.maxHeight = alertEl.scrollHeight + 'px';
            requestAnimationFrame(function () { alertEl.classList.add('alert-hiding'); });
            setTimeout(function () {
                if (alertEl.parentNode) alertEl.parentNode.removeChild(alertEl);
            }, 380);
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

    // ---------- COUNTER ISI PENGUMUMAN ----------
    var isiEl = document.getElementById('peng-isi');
    var counterEl = document.getElementById('peng-isi-counter');
    function updateCounter() {
        if (isiEl && counterEl) counterEl.textContent = isiEl.value.length + ' karakter';
    }
    if (isiEl) {
        isiEl.addEventListener('input', updateCounter);
        updateCounter();
    }

    // ---------- STATUS TOGGLE ----------
    var toggle = document.getElementById('status-toggle');
    var statusInput = document.getElementById('status-input');
    var toggleLabel = toggle ? toggle.querySelector('.status-toggle-label') : null;
    var toggleIcon = toggle ? toggle.querySelector('.status-toggle-icon i') : null;

    function setToggleState(active) {
        toggle.setAttribute('aria-checked', active ? 'true' : 'false');
        statusInput.value = active ? 'aktif' : 'nonaktif';
        if (toggleLabel) toggleLabel.textContent = active ? 'Aktif Ditampilkan' : 'Nonaktif / Disembunyikan';
        if (toggleIcon) {
            toggleIcon.classList.toggle('fa-circle-check', active);
            toggleIcon.classList.toggle('fa-circle-xmark', !active);
        }
    }

    if (toggle) {
        toggle.addEventListener('click', function () {
            setToggleState(toggle.getAttribute('aria-checked') !== 'true');
        });
        toggle.addEventListener('keydown', function (e) {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                setToggleState(toggle.getAttribute('aria-checked') !== 'true');
            }
        });
    }

    // ---------- LOADING STATE TOMBOL SIMPAN ----------
    var formEdit = document.getElementById('form-edit-pengumuman');
    var btnSubmit = document.getElementById('btn-submit-pengumuman');
    if (formEdit && btnSubmit) {
        formEdit.addEventListener('submit', function () {
            btnSubmit.classList.add('is-loading');
        });
    }
});
</script>

<?php $this->load->view('admin/template/footer'); ?>