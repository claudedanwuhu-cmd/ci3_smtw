<?php
/**
 * CSS + JS bersama modul Download (dipakai tambah.php dan edit.php).
 * Dimuat lewat: $this->load->view('admin/download/_assets');
 */
?>
<style>
/* ==========================================================
   MODUL DOWNLOAD: token, komponen, dan responsif
   (dipakai bersama oleh tambah.php dan edit.php)
========================================================== */
:root {
    --download-card: #ffffff;
    --download-subtle: #f8fafc;
    --download-input-bg: #f8fafc;
    --download-input-focus: #ffffff;
    --download-input-border: #cbd5e1;
    --download-border: rgba(226, 232, 240, .8);
    --download-title: #0f172a;
    --download-subtitle: #64748b;
    --download-hover: #f1f5f9;
    --download-accent: #0ea5e9;
    --download-glow: rgba(14, 165, 233, .25);
    --download-soft: rgba(14, 165, 233, .10);
    --download-soft-border: rgba(14, 165, 233, .22);
    --download-icon-muted: #94a3b8;
    --download-success: #059669;
    --download-danger: #dc2626;
    --download-shadow: 0 10px 25px -5px rgba(15, 23, 42, .05), 0 8px 10px -6px rgba(15, 23, 42, .02);
}

[data-bs-theme="dark"],
[data-theme="dark"],
body.dark-mode,
.dark-mode {
    --download-card: #0f172a;
    --download-subtle: #1e293b;
    --download-input-bg: #1e293b;
    --download-input-focus: #111827;
    --download-input-border: rgba(255, 255, 255, .12);
    --download-border: rgba(255, 255, 255, .08);
    --download-title: #f8fafc;
    --download-subtitle: #94a3b8;
    --download-hover: #1e293b;
    --download-accent: #38bdf8;
    --download-glow: rgba(56, 189, 248, .25);
    --download-soft: rgba(56, 189, 248, .10);
    --download-soft-border: rgba(56, 189, 248, .22);
    --download-icon-muted: #64748b;
    --download-success: #34d399;
    --download-danger: #f87171;
    --download-shadow: 0 12px 30px -5px rgba(0, 0, 0, .4);
}

/* ---------- Flash message ---------- */
.alert.alert-autodismiss {
    position: relative;
    overflow: hidden;
    display: flex;
    align-items: center;
    gap: 14px;
    padding: 14px 18px;
    border-radius: 16px;
    border: 1px solid transparent;
    box-shadow: var(--download-shadow);
    transition: max-height .35s ease, opacity .3s ease, transform .3s ease, padding .35s ease, margin .35s ease, border-width .35s ease;
    animation: downloadAlertIn .4s cubic-bezier(.34, 1.56, .64, 1) both;
}
.alert.alert-autodismiss.is-success {
    background: rgba(16, 185, 129, .12);
    border-color: rgba(16, 185, 129, .28);
    color: var(--download-success);
}
.alert.alert-autodismiss.is-error {
    background: rgba(239, 68, 68, .12);
    border-color: rgba(239, 68, 68, .28);
    color: var(--download-danger);
}
.alert.alert-autodismiss.alert-hiding {
    max-height: 0 !important;
    opacity: 0;
    transform: translateY(-10px);
    padding-top: 0;
    padding-bottom: 0;
    margin-top: 0 !important;
    margin-bottom: 0 !important;
    border-width: 0;
}
.alert-icon-box {
    width: 36px;
    height: 36px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    font-size: 16px;
}
.is-success .alert-icon-box { background: rgba(16, 185, 129, .16); }
.is-error .alert-icon-box { background: rgba(239, 68, 68, .16); }
.alert-content {
    flex: 1;
    min-width: 0;
    display: flex;
    flex-direction: column;
    gap: 2px;
}
.alert-content strong {
    color: inherit;
    font-size: 13px;
    font-weight: 700;
}
.alert-content span {
    color: var(--download-title);
    font-size: 12.5px;
    word-break: break-word;
}
.alert-autodismiss .btn-close {
    position: static;
    flex-shrink: 0;
    padding: 8px;
    font-size: 11px;
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
    width: 100%;
    height: 100%;
    background: var(--download-success);
    transform-origin: left;
    animation-name: downloadAlertProgress;
    animation-duration: 4.5s;
    animation-timing-function: linear;
    animation-fill-mode: forwards;
}
.is-error .alert-progress-bar { background: var(--download-danger); }

@keyframes downloadAlertIn {
    from { opacity: 0; transform: translateY(-14px) scale(.98); }
    to { opacity: 1; transform: translateY(0) scale(1); }
}
@keyframes downloadAlertProgress {
    from { transform: scaleX(1); }
    to { transform: scaleX(0); }
}

/* ---------- Page header ---------- */
.page-header-custom {
    position: relative;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 20px;
    padding: 22px 28px;
    background: var(--download-card);
    border: 1px solid var(--download-border);
    border-radius: 20px;
    box-shadow: var(--download-shadow);
    animation: downloadFadeUp .4s ease both;
}
.page-header-custom::before {
    content: "";
    position: absolute;
    inset: 0 auto 0 0;
    width: 4px;
    background: linear-gradient(180deg, var(--download-accent), #0369a1);
}
.page-header-custom::after {
    content: "";
    position: absolute;
    top: -90px;
    right: -60px;
    width: 180px;
    height: 180px;
    border-radius: 50%;
    background: var(--download-soft);
    pointer-events: none;
}
.page-header-custom > * {
    position: relative;
    z-index: 1;
}
.page-header-left {
    display: flex;
    align-items: center;
    gap: 16px;
    min-width: 0;
}
.page-header-icon {
    width: 52px;
    height: 52px;
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 16px;
    background: var(--download-soft);
    border: 1px solid var(--download-soft-border);
    color: var(--download-accent);
    font-size: 22px;
    transition: transform .35s ease;
}
.page-header-custom:hover .page-header-icon {
    transform: rotate(-6deg) scale(1.06);
}
.badge-header-tag {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    margin-bottom: 6px;
    padding: 4px 10px;
    border-radius: 999px;
    background: var(--download-soft);
    color: var(--download-accent);
    font-size: 10.5px;
    font-weight: 800;
    letter-spacing: .6px;
    text-transform: uppercase;
}
.page-title {
    margin: 0;
    color: var(--download-title);
    font-size: 22px;
    font-weight: 800;
    letter-spacing: -.3px;
}
.page-subtitle {
    margin: 4px 0 0;
    color: var(--download-subtitle);
    font-size: 13px;
}

/* ---------- Card ---------- */
.custom-card {
    overflow: hidden;
    background: var(--download-card);
    border: 1px solid var(--download-border);
    border-radius: 20px;
    box-shadow: var(--download-shadow);
    animation: downloadFadeUp .4s ease both;
}
.card-title-custom {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 14px;
    padding: 18px 24px;
    background: var(--download-subtle);
    border-bottom: 1px solid var(--download-border);
}
.title-icon {
    width: 42px;
    height: 42px;
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 12px;
    background: var(--download-soft);
    border: 1px solid var(--download-soft-border);
    color: var(--download-accent);
    font-size: 16px;
}
.card-title-custom h5 {
    margin: 0 0 2px;
    color: var(--download-title);
    font-size: 15px;
    font-weight: 700;
}
.card-title-custom small {
    display: block;
    color: var(--download-subtitle);
    font-size: 12px;
}
.total-badge {
    display: inline-flex;
    align-items: center;
    padding: 6px 14px;
    border-radius: 999px;
    background: var(--download-soft);
    border: 1px solid var(--download-soft-border);
    color: var(--download-accent);
    font-size: 12px;
    font-weight: 700;
    white-space: nowrap;
}

@keyframes downloadFadeUp {
    from { opacity: 0; transform: translateY(12px); }
    to { opacity: 1; transform: translateY(0); }
}

/* ---------- Tombol ---------- */
.btn-add,
.btn-save,
.btn-back,
.btn-cancel {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 11px 20px;
    border-radius: 12px;
    font-family: inherit;
    font-size: 12.5px;
    font-weight: 700;
    line-height: 1.4;
    text-decoration: none;
    white-space: nowrap;
    cursor: pointer;
    transition: transform .25s ease, box-shadow .25s ease, background-color .25s ease, color .25s ease, border-color .25s ease;
}
.btn-add,
.btn-save {
    position: relative;
    border: 0;
    background: linear-gradient(135deg, #0284c7, #0369a1);
    color: #ffffff;
    box-shadow: 0 6px 18px rgba(2, 132, 199, .28);
}
.btn-add:hover,
.btn-save:hover {
    color: #ffffff;
    transform: translateY(-2px);
    box-shadow: 0 10px 24px rgba(2, 132, 199, .45);
}
.btn-save.is-loading,
.btn-save.is-loading:hover {
    color: transparent;
    transform: none;
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
    border-radius: 50%;
    border: 2.5px solid rgba(255, 255, 255, .35);
    border-top-color: #ffffff;
    animation: downloadSpin .7s linear infinite;
}
.btn-back {
    background: var(--download-subtle);
    border: 1px solid var(--download-border);
    color: var(--download-title);
}
.btn-back:hover {
    background: var(--download-hover);
    color: var(--download-accent);
    transform: translateX(-3px);
}
.btn-cancel {
    background: var(--download-card);
    border: 1px solid var(--download-border);
    color: var(--download-title);
}
.btn-cancel:hover {
    color: #ef4444;
    transform: translateY(-1px);
}
.btn-action {
    width: 36px;
    height: 36px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: 10px;
    font-size: 13px;
    text-decoration: none;
    transition: transform .25s ease, background-color .25s ease, color .25s ease, border-color .25s ease;
}
.btn-action.edit {
    background: var(--download-subtle);
    border: 1px solid var(--download-border);
    color: var(--download-title);
}
.btn-action.edit:hover {
    background: var(--download-accent);
    border-color: var(--download-accent);
    color: #ffffff;
    transform: translateY(-2px);
}
.btn-action.delete {
    background: rgba(239, 68, 68, .10);
    border: 1px solid rgba(239, 68, 68, .22);
    color: #f87171;
}
.btn-action.delete:hover {
    background: #ef4444;
    border-color: #ef4444;
    color: #ffffff;
    transform: translateY(-2px);
}
.btn-add:focus-visible,
.btn-save:focus-visible,
.btn-back:focus-visible,
.btn-cancel:focus-visible,
.btn-action:focus-visible,
.alert-autodismiss .btn-close:focus-visible {
    outline: 2px solid var(--download-accent);
    outline-offset: 2px;
}

@keyframes downloadSpin {
    to { transform: rotate(360deg); }
}

/* ---------- Form ---------- */
.card-body-custom {
    padding: 26px 28px;
}
.form-label {
    display: block;
    margin-bottom: 8px;
    color: var(--download-title);
    font-size: 12.5px;
    font-weight: 700;
}
.form-label.required::after {
    content: " *";
    color: var(--download-danger);
}
.input-icon-group {
    position: relative;
}
.input-icon-group .input-icon {
    position: absolute;
    top: 50%;
    left: 15px;
    z-index: 2;
    transform: translateY(-50%);
    color: var(--download-icon-muted);
    font-size: 14px;
    pointer-events: none;
    transition: color .2s ease;
}
.input-icon-group:focus-within .input-icon {
    color: var(--download-accent);
}
.form-control.custom-input,
.form-select.custom-input {
    min-height: 44px;
    background-color: var(--download-input-bg);
    border: 1px solid var(--download-input-border);
    border-radius: 12px;
    color: var(--download-title);
    font-size: 13.5px;
    transition: border-color .2s ease, box-shadow .2s ease, background-color .2s ease;
}
.form-control.custom-input.with-icon,
.form-select.custom-input.with-icon {
    padding-left: 42px;
}
.form-control.custom-input::placeholder {
    color: var(--download-icon-muted);
}
.form-control.custom-input:hover,
.form-select.custom-input:hover {
    border-color: var(--download-accent);
}
.form-control.custom-input:focus,
.form-select.custom-input:focus {
    background-color: var(--download-input-focus);
    border-color: var(--download-accent);
    box-shadow: 0 0 0 4px var(--download-glow);
    color: var(--download-title);
}
.form-select.custom-input option {
    background: var(--download-card);
    color: var(--download-title);
}
.custom-textarea {
    padding: 12px 14px;
    line-height: 1.65;
    resize: vertical;
}
.form-hint {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    margin-top: 8px;
    color: var(--download-subtitle);
    font-size: 11.5px;
}
.form-hint i {
    margin-right: 6px;
    color: var(--download-icon-muted);
}

/* ---------- Dropzone ---------- */
.dropzone {
    position: relative;
    display: flex;
    align-items: center;
    gap: 14px;
    min-height: 96px;
    padding: 18px 20px;
    background: var(--download-input-bg);
    border: 2px dashed var(--download-input-border);
    border-radius: 16px;
    cursor: pointer;
    transition: border-color .2s ease, background-color .2s ease, box-shadow .2s ease;
}
.dropzone:hover {
    border-color: var(--download-accent);
}
.dropzone:focus-visible {
    outline: none;
    border-color: var(--download-accent);
    box-shadow: 0 0 0 4px var(--download-glow);
}
.dropzone.dragover {
    background: var(--download-soft);
    border-color: var(--download-accent);
    box-shadow: 0 0 0 4px var(--download-glow);
}
.dropzone.has-error {
    border-color: var(--download-danger);
}
.file-input-hidden {
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
    opacity: 0;
    pointer-events: none;
}
.dropzone-icon {
    width: 44px;
    height: 44px;
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 12px;
    background: var(--download-soft);
    border: 1px solid var(--download-soft-border);
    color: var(--download-accent);
    font-size: 17px;
}
.dropzone-icon i {
    transition: transform .25s ease;
}
.dropzone:hover .dropzone-icon i,
.dropzone.dragover .dropzone-icon i {
    transform: translateY(-3px);
}
.dropzone-text {
    min-width: 0;
}
.dropzone-text strong {
    display: block;
    color: var(--download-title);
    font-size: 13px;
    font-weight: 700;
    word-break: break-all;
}
.dropzone-text small {
    display: block;
    margin-top: 3px;
    color: var(--download-subtitle);
    font-size: 11.5px;
}
.dropzone-error {
    display: none;
    align-items: center;
    gap: 6px;
    margin-top: 8px;
    color: var(--download-danger);
    font-size: 12px;
    font-weight: 600;
}
.dropzone-error.is-visible {
    display: flex;
}

/* ---------- File saat ini (edit) ---------- */
.current-file {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-top: 12px;
    padding: 11px 14px;
    background: var(--download-subtle);
    border: 1px solid var(--download-border);
    border-radius: 12px;
}
.current-file-icon {
    width: 36px;
    height: 36px;
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 10px;
    background: var(--download-soft);
    border: 1px solid var(--download-soft-border);
    color: var(--download-accent);
}
.current-file small {
    display: block;
    color: var(--download-subtitle);
    font-size: 10.5px;
}
.current-file strong {
    display: block;
    margin-top: 2px;
    color: var(--download-title);
    font-size: 12px;
    word-break: break-all;
}

/* ---------- Footer form ---------- */
.form-footer {
    display: flex;
    justify-content: flex-end;
    gap: 10px;
    padding: 18px 24px;
    background: var(--download-subtle);
    border-top: 1px solid var(--download-border);
}

/* ---------- Dark mode: rule turunan ---------- */
input[type="date"] { color-scheme: light; }
[data-bs-theme="dark"] input[type="date"],
[data-theme="dark"] input[type="date"],
body.dark-mode input[type="date"],
.dark-mode input[type="date"] {
    color-scheme: dark;
}

[data-bs-theme="dark"] .alert-autodismiss .btn-close,
[data-theme="dark"] .alert-autodismiss .btn-close,
body.dark-mode .alert-autodismiss .btn-close,
.dark-mode .alert-autodismiss .btn-close {
    filter: invert(1) grayscale(100%) brightness(200%);
}

[data-bs-theme="dark"] .form-select,
[data-theme="dark"] .form-select,
body.dark-mode .form-select,
.dark-mode .form-select {
    --bs-form-select-bg-img: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23adb5bd' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m2 5 6 6 6-6'/%3e%3c/svg%3e");
}

/* ---------- Responsif ---------- */
@media (max-width: 768px) {
    .page-header-custom {
        flex-direction: column;
        align-items: stretch;
        padding: 18px;
    }
    .page-header-custom > .btn-back {
        width: 100%;
    }
    .card-title-custom {
        padding: 16px 18px;
    }
    .card-body-custom {
        padding: 18px;
    }
    .form-footer {
        flex-direction: column-reverse;
        padding: 16px 18px;
    }
    .form-footer .btn-save,
    .form-footer .btn-cancel {
        width: 100%;
    }
}

/* ---------- Reduced motion ---------- */
@media (prefers-reduced-motion: reduce) {
    .alert.alert-autodismiss,
    .alert-progress-bar,
    .page-header-custom,
    .page-header-icon,
    .custom-card,
    .dropzone-icon i,
    .btn-save.is-loading::after,
    .btn-save,
    .btn-back,
    .btn-cancel {
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
            void alertEl.offsetHeight; // paksa reflow agar transisi max-height berjalan
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

    // Pratinjau, validasi, dan drag & drop dropzone file
    var zone = document.getElementById('download-dropzone');
    var input = document.getElementById('download-file-input');
    var labelEl = document.getElementById('download-dropzone-label');
    var hintEl = document.getElementById('download-dropzone-hint');
    var errorEl = document.getElementById('download-dropzone-error');

    if (zone && input) {
        var maxMb = parseFloat(zone.getAttribute('data-max-mb')) || 10;
        var allowed = (zone.getAttribute('data-allowed') || '').split(',');
        var defaultLabel = labelEl ? labelEl.textContent : '';
        var defaultHint = hintEl ? hintEl.textContent : '';

        function formatSize(bytes) {
            if (bytes >= 1048576) return (bytes / 1048576).toFixed(1) + ' MB';
            return Math.max(1, Math.round(bytes / 1024)) + ' KB';
        }

        function showError(msg) {
            zone.classList.add('has-error');
            if (errorEl) {
                errorEl.innerHTML = '<i class="fa-solid fa-circle-info"></i>';
                errorEl.appendChild(document.createTextNode(msg));
                errorEl.classList.add('is-visible');
            }
        }

        function clearError() {
            zone.classList.remove('has-error');
            if (errorEl) {
                errorEl.textContent = '';
                errorEl.classList.remove('is-visible');
            }
        }

        function resetZone() {
            if (labelEl) labelEl.textContent = defaultLabel;
            if (hintEl) hintEl.textContent = defaultHint;
        }

        function handleFiles() {
            var files = input.files;
            clearError();

            if (!files || !files.length) {
                resetZone();
                return;
            }

            var file = files[0];
            var ext = (file.name.split('.').pop() || '').toLowerCase();
            var message = '';

            if (files.length > 1) {
                message = 'Pilih satu file saja.';
            } else if (allowed.indexOf(ext) === -1) {
                message = 'Format file tidak didukung. Gunakan ' + allowed.join(', ').toUpperCase() + '.';
            } else if (file.size > maxMb * 1048576) {
                message = 'Ukuran file melebihi batas ' + maxMb + ' MB.';
            }

            if (message) {
                input.value = '';
                resetZone();
                showError(message);
                return;
            }

            if (labelEl) labelEl.textContent = file.name;
            if (hintEl) hintEl.textContent = ext.toUpperCase() + ' \u2022 ' + formatSize(file.size);
        }

        zone.addEventListener('click', function (e) {
            if (e.target === input) return;
            input.click();
        });

        zone.addEventListener('keydown', function (e) {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                input.click();
            }
        });

        input.addEventListener('change', handleFiles);

        ['dragenter', 'dragover'].forEach(function (evt) {
            zone.addEventListener(evt, function (e) {
                e.preventDefault();
                zone.classList.add('dragover');
            });
        });

        ['dragleave', 'drop'].forEach(function (evt) {
            zone.addEventListener(evt, function (e) {
                e.preventDefault();
                zone.classList.remove('dragover');
            });
        });

        zone.addEventListener('drop', function (e) {
            if (e.dataTransfer && e.dataTransfer.files && e.dataTransfer.files.length) {
                input.files = e.dataTransfer.files;
                handleFiles();
            }
        });
    }

    // Penghitung karakter keterangan
    var textarea = document.getElementById('download-keterangan');
    var counter = document.getElementById('download-keterangan-count');
    if (textarea && counter) {
        var updateCount = function () { counter.textContent = textarea.value.length; };
        textarea.addEventListener('input', updateCount);
        updateCount();
    }

    // Tombol simpan: status loading saat submit
    var form = document.getElementById('download-form');
    var saveBtn = form ? form.querySelector('.btn-save') : null;
    if (form && saveBtn) {
        form.addEventListener('submit', function () {
            saveBtn.classList.add('is-loading');
        });
        window.addEventListener('pageshow', function () {
            saveBtn.classList.remove('is-loading');
        });
    }
});
</script>
