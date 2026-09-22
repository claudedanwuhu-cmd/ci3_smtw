<?php
/**
 * Aset bersama modul Galeri (CSS + JS).
 * Dipanggil di setiap halaman galeri lewat:
 *   $this->load->view('admin/galeri/_assets');
 */
?>
<style>
/* -----------------------------------------------------------------
   TOKENS (prefix --galeri-*)
----------------------------------------------------------------- */
:root {
    --galeri-card: #ffffff;
    --galeri-subtle: #f8fafc;
    --galeri-input-bg: #f8fafc;
    --galeri-input-focus: #ffffff;
    --galeri-input-border: #cbd5e1;
    --galeri-border: rgba(226, 232, 240, 0.8);
    --galeri-title: #0f172a;
    --galeri-subtitle: #64748b;
    --galeri-hover: #f1f5f9;
    --galeri-accent: #0ea5e9;
    --galeri-glow: rgba(14, 165, 233, 0.25);
    --galeri-soft: rgba(14, 165, 233, 0.10);
    --galeri-soft-border: rgba(14, 165, 233, 0.22);
    --galeri-icon-muted: #94a3b8;
    --galeri-success: #059669;
    --galeri-danger: #dc2626;
    --galeri-shadow: 0 10px 25px -5px rgba(15, 23, 42, 0.05), 0 8px 10px -6px rgba(15, 23, 42, 0.02);
}

[data-bs-theme="dark"],
[data-theme="dark"],
body.dark-mode,
.dark-mode {
    --galeri-card: #0f172a;
    --galeri-subtle: #1e293b;
    --galeri-input-bg: #1e293b;
    --galeri-input-focus: #111827;
    --galeri-input-border: rgba(255, 255, 255, 0.12);
    --galeri-border: rgba(255, 255, 255, 0.08);
    --galeri-title: #f8fafc;
    --galeri-subtitle: #94a3b8;
    --galeri-hover: #1e293b;
    --galeri-accent: #38bdf8;
    --galeri-glow: rgba(56, 189, 248, 0.25);
    --galeri-soft: rgba(56, 189, 248, 0.10);
    --galeri-soft-border: rgba(56, 189, 248, 0.22);
    --galeri-icon-muted: #64748b;
    --galeri-success: #34d399;
    --galeri-danger: #f87171;
    --galeri-shadow: 0 12px 30px -5px rgba(0, 0, 0, 0.4);
}

/* Native date picker mengikuti tema */
input[type="date"] { color-scheme: light; }
[data-bs-theme="dark"] input[type="date"],
[data-theme="dark"] input[type="date"],
body.dark-mode input[type="date"],
.dark-mode input[type="date"] { color-scheme: dark; }

.text-title { color: var(--galeri-title) !important; }
.text-subtle { color: var(--galeri-subtitle) !important; }

/* Fokus keyboard terlihat */
.page-header-custom a:focus-visible,
.custom-card a:focus-visible,
.custom-card button:focus-visible,
.upload-dropzone:focus-visible,
.alert-autodismiss .btn-close:focus-visible {
    outline: 2px solid var(--galeri-accent);
    outline-offset: 2px;
}

/* -----------------------------------------------------------------
   FLASH MESSAGE (AUTO-DISMISS)
----------------------------------------------------------------- */
.alert-autodismiss {
    position: relative;
    display: flex;
    align-items: center;
    gap: 14px;
    padding: 16px 20px;
    border: 1px solid transparent;
    border-radius: 16px;
    overflow: hidden;
    backdrop-filter: blur(8px);
    animation: galeriAlertIn 0.35s cubic-bezier(0.34, 1.56, 0.64, 1);
    transition: opacity 0.35s ease, transform 0.35s ease, max-height 0.35s ease,
                padding 0.35s ease, margin 0.35s ease, border-width 0.35s ease;
}

.alert-autodismiss.is-success {
    background: rgba(16, 185, 129, 0.12);
    border-color: rgba(16, 185, 129, 0.28);
    color: var(--galeri-success);
}

.alert-autodismiss.is-error {
    background: rgba(239, 68, 68, 0.12);
    border-color: rgba(239, 68, 68, 0.28);
    color: var(--galeri-danger);
}

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

.alert-autodismiss.is-success .alert-icon-box { background: rgba(16, 185, 129, 0.18); }
.alert-autodismiss.is-error .alert-icon-box { background: rgba(239, 68, 68, 0.18); }

.alert-content {
    flex: 1;
    min-width: 0;
    display: flex;
    flex-direction: column;
    gap: 1px;
}

.alert-content strong { font-size: 13.5px; font-weight: 700; }
.alert-content span { font-size: 12.5px; overflow-wrap: anywhere; }

.alert-autodismiss .btn-close {
    flex-shrink: 0;
    font-size: 11px;
    opacity: 0.6;
    padding: 8px;
}
.alert-autodismiss .btn-close:hover { opacity: 1; }

[data-bs-theme="dark"] .alert-autodismiss .btn-close,
[data-theme="dark"] .alert-autodismiss .btn-close,
body.dark-mode .alert-autodismiss .btn-close,
.dark-mode .alert-autodismiss .btn-close {
    filter: invert(1) grayscale(100%) brightness(200%);
}

.alert-progress-track {
    position: absolute;
    left: 0; right: 0; bottom: 0;
    height: 3px;
    background: rgba(148, 163, 184, 0.2);
}

.alert-progress-bar {
    height: 100%;
    width: 100%;
    background: currentColor;
    transform-origin: left;
    animation: galeriProgress 4.5s linear forwards;
}

.alert-autodismiss.alert-hiding {
    opacity: 0;
    transform: translateY(-10px);
    max-height: 0 !important;
    padding-top: 0 !important;
    padding-bottom: 0 !important;
    margin-bottom: 0 !important;
    border-width: 0;
}

@keyframes galeriAlertIn {
    from { opacity: 0; transform: translateY(-14px) scale(0.98); }
    to { opacity: 1; transform: translateY(0) scale(1); }
}

@keyframes galeriProgress {
    from { transform: scaleX(1); }
    to { transform: scaleX(0); }
}

/* -----------------------------------------------------------------
   PAGE HEADER
----------------------------------------------------------------- */
.page-header-custom {
    position: relative;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 20px;
    padding: 22px 28px;
    background: var(--galeri-card);
    border: 1px solid var(--galeri-border);
    border-radius: 20px;
    box-shadow: var(--galeri-shadow);
    animation: galeriFadeUp 0.4s ease both;
}

.page-header-custom::before {
    content: "";
    position: absolute;
    inset: 0 auto 0 0;
    width: 4px;
    background: linear-gradient(180deg, var(--galeri-accent), #0369a1);
}


.page-header-custom > * { position: relative; z-index: 1; }

.page-header-icon {
    width: 52px;
    height: 52px;
    border-radius: 16px;
    background: var(--galeri-soft);
    border: 1px solid var(--galeri-soft-border);
    color: var(--galeri-accent);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 22px;
    flex-shrink: 0;
    transition: transform 0.35s ease;
}

.page-header-custom:hover .page-header-icon { transform: rotate(-6deg) scale(1.06); }

.badge-header-tag {
    display: inline-flex;
    align-items: center;
    background: var(--galeri-soft);
    color: var(--galeri-accent);
    border: 1px solid var(--galeri-soft-border);
    padding: 4px 10px;
    border-radius: 999px;
    font-size: 10.5px;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.page-title {
    color: var(--galeri-title);
    font-size: 22px;
    font-weight: 800;
    letter-spacing: -0.3px;
    margin: 0 0 2px;
    overflow-wrap: anywhere;
}

.page-subtitle {
    color: var(--galeri-subtitle);
    font-size: 13px;
    margin: 0;
}

.page-subtitle strong { color: var(--galeri-title); font-weight: 700; }

.page-header-actions {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: 10px;
}

/* -----------------------------------------------------------------
   BUTTONS
----------------------------------------------------------------- */
.btn-add,
.btn-save {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-height: 42px;
    padding: 11px 20px;
    border: 0;
    border-radius: 12px;
    background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%);
    color: #ffffff !important;
    text-decoration: none;
    font-size: 12.5px;
    font-weight: 700;
    white-space: nowrap;
    cursor: pointer;
    box-shadow: 0 6px 18px rgba(2, 132, 199, 0.28);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.btn-add:hover,
.btn-save:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 24px rgba(2, 132, 199, 0.45);
}

.btn-back {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-height: 42px;
    padding: 10px 20px;
    background: var(--galeri-subtle);
    color: var(--galeri-title);
    border: 1px solid var(--galeri-border);
    border-radius: 12px;
    text-decoration: none;
    font-size: 12.5px;
    font-weight: 600;
    white-space: nowrap;
    transition: all 0.25s ease;
}

.btn-back:hover {
    background: var(--galeri-hover);
    color: var(--galeri-accent);
    transform: translateX(-3px);
}

.btn-cancel {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-height: 42px;
    padding: 11px 22px;
    background: var(--galeri-card);
    color: var(--galeri-title);
    border: 1px solid var(--galeri-border);
    border-radius: 12px;
    text-decoration: none;
    font-size: 12.5px;
    font-weight: 600;
    transition: all 0.2s ease;
}

.btn-cancel:hover {
    background: var(--galeri-hover);
    color: #ef4444;
    transform: translateY(-1px);
}

.btn-save { position: relative; overflow: hidden; }
.btn-save-content { display: inline-flex; align-items: center; transition: opacity 0.2s ease; }
.btn-save.is-loading { pointer-events: none; }
.btn-save.is-loading .btn-save-content { opacity: 0; }

.btn-save-spinner {
    position: absolute;
    top: 50%; left: 50%;
    width: 18px; height: 18px;
    margin: -9px 0 0 -9px;
    border: 2.5px solid rgba(255, 255, 255, 0.35);
    border-top-color: #ffffff;
    border-radius: 50%;
    opacity: 0;
    animation: galeriSpin 0.7s linear infinite;
}
.btn-save.is-loading .btn-save-spinner { opacity: 1; }

@keyframes galeriSpin { to { transform: rotate(360deg); } }

.btn-action {
    width: 36px;
    height: 36px;
    border-radius: 10px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    font-size: 13px;
    flex-shrink: 0;
    transition: all 0.25s ease;
}

.btn-action:hover { transform: translateY(-2px); }

.btn-action.edit {
    background: var(--galeri-subtle);
    color: var(--galeri-title);
    border: 1px solid var(--galeri-border);
}

.btn-action.edit:hover {
    background: var(--galeri-accent);
    color: #ffffff;
    border-color: var(--galeri-accent);
}

.btn-action.delete {
    background: rgba(239, 68, 68, 0.10);
    color: #f87171;
    border: 1px solid rgba(239, 68, 68, 0.2);
}

.btn-action.delete:hover {
    background: #ef4444;
    color: #ffffff;
    border-color: #ef4444;
}

/* -----------------------------------------------------------------
   CARD
----------------------------------------------------------------- */
.custom-card {
    background: var(--galeri-card);
    border: 1px solid var(--galeri-border);
    border-radius: 20px;
    overflow: hidden;
    box-shadow: var(--galeri-shadow);
    animation: galeriFadeUp 0.4s ease both;
}

@keyframes galeriFadeUp {
    from { opacity: 0; transform: translateY(12px); }
    to { opacity: 1; transform: translateY(0); }
}

.card-title-custom {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 14px;
    padding: 18px 24px;
    background: var(--galeri-subtle);
    border-bottom: 1px solid var(--galeri-border);
}

.title-icon {
    width: 42px;
    height: 42px;
    border-radius: 12px;
    background: var(--galeri-soft);
    border: 1px solid var(--galeri-soft-border);
    color: var(--galeri-accent);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 16px;
    flex-shrink: 0;
}

.card-title-custom h5 {
    margin: 0 0 2px;
    color: var(--galeri-title);
    font-size: 15px;
    font-weight: 700;
}

.card-title-custom small {
    color: var(--galeri-subtitle);
    font-size: 12px;
}

.total-badge {
    display: inline-flex;
    align-items: center;
    color: var(--galeri-accent);
    background: var(--galeri-soft);
    border: 1px solid var(--galeri-soft-border);
    padding: 6px 14px;
    border-radius: 999px;
    font-size: 12px;
    font-weight: 700;
    white-space: nowrap;
}

.card-body-custom { padding: 24px; }

/* -----------------------------------------------------------------
   TOOLBAR PENCARIAN
----------------------------------------------------------------- */
.table-search-group {
    position: relative;
    display: flex;
    align-items: center;
}

.table-search-icon {
    position: absolute;
    left: 14px;
    color: var(--galeri-subtitle);
    font-size: 13px;
    pointer-events: none;
}

.table-search-input {
    background: var(--galeri-card);
    border: 1px solid var(--galeri-border);
    border-radius: 10px;
    padding: 8px 14px 8px 36px;
    font-size: 13px;
    color: var(--galeri-title);
    min-width: 220px;
    transition: all 0.25s ease;
}

.table-search-input::placeholder { color: var(--galeri-subtitle); opacity: 0.75; }

.table-search-input:hover:not(:focus) { border-color: var(--galeri-accent); }

.table-search-input:focus {
    outline: none;
    border-color: var(--galeri-accent);
    box-shadow: 0 0 0 3px var(--galeri-glow);
}

/* -----------------------------------------------------------------
   GRID KARTU (album & foto)
----------------------------------------------------------------- */
.galeri-item {
    animation: galeriFadeUp 0.4s ease both;
    animation-delay: calc(var(--i, 0) * 0.05s);
}

.gallery-card {
    height: 100%;
    display: flex;
    flex-direction: column;
    overflow: hidden;
    background: var(--galeri-card);
    border: 1px solid var(--galeri-border);
    border-radius: 16px;
    box-shadow: var(--galeri-shadow);
    transition: transform 0.25s ease, box-shadow 0.25s ease, border-color 0.25s ease;
}

.gallery-card:hover {
    transform: translateY(-4px);
    border-color: var(--galeri-soft-border);
    box-shadow: 0 16px 34px -10px rgba(15, 23, 42, 0.18);
}

[data-bs-theme="dark"] .gallery-card:hover,
[data-theme="dark"] .gallery-card:hover,
body.dark-mode .gallery-card:hover,
.dark-mode .gallery-card:hover {
    box-shadow: 0 16px 34px -10px rgba(0, 0, 0, 0.6);
}

.gallery-media {
    position: relative;
    height: 190px;
    flex-shrink: 0;
    overflow: hidden;
    background: var(--galeri-subtle);
    border-bottom: 1px solid var(--galeri-border);
}

.gallery-media.has-image::after {
    content: "";
    position: absolute;
    inset: 0;
    background: linear-gradient(180deg, rgba(15, 23, 42, 0) 55%, rgba(15, 23, 42, 0.28) 100%);
    pointer-events: none;
}

.gallery-image {
    width: 100%;
    height: 100%;
    display: block;
    object-fit: cover;
    transition: transform 0.4s ease;
}

.gallery-card:hover .gallery-image { transform: scale(1.045); }

.gallery-placeholder {
    position: absolute;
    inset: 0;
    display: flex;
    align-items: center;
    justify-content: center;
}

.gallery-placeholder-icon {
    width: 64px;
    height: 64px;
    border-radius: 18px;
    background: var(--galeri-soft);
    border: 1px solid var(--galeri-soft-border);
    color: var(--galeri-accent);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 28px;
}

/* Foto rusak / tidak ada: tampilkan placeholder ikon lokal */
.gallery-media.has-image .gallery-placeholder { display: none; }
.gallery-media.has-image.is-broken .gallery-placeholder { display: flex; }
.gallery-media.is-broken .gallery-image { display: none; }
.gallery-media.is-broken::after { display: none; }

.gallery-card-body {
    display: flex;
    flex-direction: column;
    flex: 1;
    padding: 16px 18px;
}

.gallery-card-content { flex: 1; min-width: 0; }

.gallery-card-content h5 {
    margin: 0 0 6px;
    color: var(--galeri-title);
    font-size: 15px;
    font-weight: 700;
    overflow-wrap: anywhere;
}

.gallery-card-desc {
    margin: 0;
    overflow: hidden;
    display: -webkit-box;
    -webkit-box-orient: vertical;
    -webkit-line-clamp: 3;
    color: var(--galeri-subtitle);
    font-size: 12.5px;
    line-height: 1.6;
    overflow-wrap: anywhere;
}

.gallery-card-desc.is-empty { font-style: italic; opacity: 0.85; }

.album-date {
    display: flex;
    align-items: center;
    gap: 7px;
    margin-top: 12px;
    color: var(--galeri-subtitle);
    font-size: 12px;
}

.album-date i { color: var(--galeri-accent); }

.gallery-card-footer {
    display: flex;
    align-items: center;
    justify-content: flex-end;
    gap: 8px;
    margin-top: 16px;
    padding-top: 14px;
    border-top: 1px solid var(--galeri-border);
}

.gallery-card-footer .btn-card-main { margin-right: auto; }

/* -----------------------------------------------------------------
   EMPTY STATE
----------------------------------------------------------------- */
.empty-data {
    text-align: center;
    padding: 60px 20px;
}

.empty-icon {
    width: 64px;
    height: 64px;
    margin: 0 auto 16px;
    border-radius: 18px;
    background: var(--galeri-soft);
    border: 1px solid var(--galeri-soft-border);
    color: var(--galeri-accent);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 26px;
}

.empty-title {
    margin-bottom: 4px;
    color: var(--galeri-title);
    font-size: 15px;
    font-weight: 700;
}

.empty-text {
    margin: 0 0 16px;
    color: var(--galeri-subtitle);
    font-size: 12.5px;
}

.empty-text:last-child { margin-bottom: 0; }

/* -----------------------------------------------------------------
   FORM
----------------------------------------------------------------- */
.form-label {
    color: var(--galeri-title);
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
    color: var(--galeri-icon-muted);
    font-size: 14px;
    pointer-events: none;
    z-index: 2;
    transition: color 0.25s ease;
}

.input-icon-group:focus-within .input-icon { color: var(--galeri-accent); }

.custom-card .form-control {
    background-color: var(--galeri-input-bg);
    border: 1px solid var(--galeri-input-border);
    border-radius: 12px;
    font-size: 13.5px;
    color: var(--galeri-title);
    padding: 10px 16px;
    transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
}

.custom-card .form-control.with-icon { padding-left: 42px; }

.custom-card .form-control:hover:not(:focus) { border-color: var(--galeri-accent); }

.custom-card .form-control:focus {
    background-color: var(--galeri-input-focus);
    border-color: var(--galeri-accent);
    color: var(--galeri-title);
    box-shadow: 0 0 0 4px var(--galeri-glow);
    outline: none;
}

.custom-card .form-control::placeholder {
    color: var(--galeri-subtitle);
    opacity: 0.6;
}

.custom-textarea {
    resize: vertical;
    min-height: 110px;
    line-height: 1.65;
}

.form-hint {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    margin-top: 8px;
    color: var(--galeri-subtitle);
    font-size: 11.5px;
}

.char-counter { font-variant-numeric: tabular-nums; white-space: nowrap; }
.char-counter.is-limit { color: var(--galeri-danger); font-weight: 700; }

/* Dropzone upload foto */
.upload-dropzone {
    position: relative;
    border: 2px dashed var(--galeri-input-border);
    background-color: var(--galeri-subtle);
    border-radius: 16px;
    padding: 24px;
    cursor: pointer;
    transition: all 0.25s ease;
}

.upload-dropzone:hover {
    border-color: var(--galeri-accent);
    background-color: var(--galeri-hover);
}

.upload-dropzone.dragover {
    border-color: var(--galeri-accent);
    background-color: var(--galeri-hover);
    box-shadow: 0 0 0 4px var(--galeri-glow);
}

/* Input file disembunyikan secara visual, tetap bisa divalidasi browser */
.upload-input {
    position: absolute;
    left: 50%;
    bottom: 0;
    width: 1px;
    height: 1px;
    opacity: 0;
    pointer-events: none;
}

.upload-icon-circle {
    width: 44px;
    height: 44px;
    border-radius: 50%;
    background: var(--galeri-soft);
    color: var(--galeri-accent);
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
    transition: transform 0.3s ease;
}

.upload-dropzone:hover .upload-icon-circle { transform: translateY(-3px); }

.upload-text {
    color: var(--galeri-title);
    font-size: 13.5px;
}

.upload-subtext {
    color: var(--galeri-subtitle);
    font-size: 11.5px;
}

.preview-image {
    width: 220px;
    max-width: 100%;
    height: 140px;
    object-fit: cover;
    border-radius: 14px;
    border: 3px solid var(--galeri-accent);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}

.preview-filename {
    max-width: 250px;
    font-size: 12px;
    color: var(--galeri-title);
}

.preview-badge {
    display: inline-flex;
    align-items: center;
    padding: 3px 10px;
    border-radius: 999px;
    background: var(--galeri-soft);
    border: 1px solid var(--galeri-soft-border);
    color: var(--galeri-accent);
    font-size: 11px;
    font-weight: 700;
}

.upload-error {
    display: flex;
    align-items: center;
    gap: 6px;
    margin-top: 8px;
    color: var(--galeri-danger);
    font-size: 12px;
    font-weight: 600;
}

/* Footer form */
.form-footer {
    padding: 18px 24px;
    background: var(--galeri-subtle);
    border-top: 1px solid var(--galeri-border);
    display: flex;
    align-items: center;
    justify-content: flex-end;
    gap: 12px;
}

/* -----------------------------------------------------------------
   RESPONSIF
----------------------------------------------------------------- */
@media (max-width: 768px) {
    .page-header-custom {
        flex-direction: column;
        align-items: stretch;
        padding: 18px;
    }

    .page-header-custom > .btn-add,
    .page-header-custom > .btn-back { width: 100%; }

    .page-header-actions { width: 100%; }
    .page-header-actions > .btn-add,
    .page-header-actions > .btn-back { flex: 1 1 100%; }

    .card-title-custom {
        flex-direction: column;
        align-items: flex-start;
        gap: 12px;
        padding: 18px;
    }

    .toolbar-right {
        width: 100%;
        justify-content: space-between;
    }

    .table-search-group { flex: 1; }
    .table-search-input { min-width: 0; width: 100%; }

    .card-body-custom { padding: 20px 18px; }

    .form-footer {
        flex-direction: column-reverse;
        align-items: stretch;
        padding: 18px;
    }

    .form-footer .btn-cancel,
    .form-footer .btn-save { width: 100%; }

    .upload-dropzone { padding: 20px 16px; }
}

/* -----------------------------------------------------------------
   REDUCED MOTION
----------------------------------------------------------------- */
@media (prefers-reduced-motion: reduce) {
    .alert-autodismiss,
    .alert-progress-bar,
    .page-header-custom,
    .page-header-icon,
    .custom-card,
    .galeri-item,
    .gallery-card,
    .gallery-image,
    .upload-icon-circle,
    .btn-add,
    .btn-back,
    .btn-cancel,
    .btn-save,
    .btn-save-spinner,
    .btn-action {
        animation: none !important;
        transition: none !important;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {

    /* ---------------------------------------------------------
       1. FLASH MESSAGE: auto-dismiss + pause saat hover
    --------------------------------------------------------- */
    document.querySelectorAll('.alert-autodismiss').forEach(function (alertEl) {
        var duration = parseInt(alertEl.getAttribute('data-autodismiss'), 10) || 4500;
        var bar = alertEl.querySelector('.alert-progress-bar');
        if (bar) bar.style.animationDuration = duration + 'ms';

        var dismissed = false;
        var remaining = duration;
        var startedAt = Date.now();
        var timer = setTimeout(closeAlert, remaining);

        function closeAlert() {
            if (dismissed) return;
            dismissed = true;
            clearTimeout(timer);
            alertEl.style.maxHeight = alertEl.offsetHeight + 'px';
            void alertEl.offsetHeight; // paksa reflow agar transisi max-height berjalan
            alertEl.classList.add('alert-hiding');
            setTimeout(function () {
                if (alertEl.parentNode) alertEl.parentNode.removeChild(alertEl);
            }, 380);
        }

        alertEl.addEventListener('mouseenter', function () {
            if (dismissed) return;
            clearTimeout(timer);
            remaining -= (Date.now() - startedAt);
            if (bar) bar.style.animationPlayState = 'paused';
        });

        alertEl.addEventListener('mouseleave', function () {
            if (dismissed) return;
            if (bar) bar.style.animationPlayState = 'running';
            startedAt = Date.now();
            remaining = Math.max(remaining, 800);
            timer = setTimeout(closeAlert, remaining);
        });

        var closeBtn = alertEl.querySelector('.btn-close');
        if (closeBtn) {
            closeBtn.addEventListener('click', function (e) {
                e.preventDefault();
                closeAlert();
            });
        }
    });

    /* ---------------------------------------------------------
       2. PENCARIAN CLIENT-SIDE (grid album / foto)
    --------------------------------------------------------- */
    var searchInput = document.getElementById('galeri-search-input');
    var grid = document.getElementById('galeri-grid');
    var countEl = document.getElementById('galeri-count');
    var noResult = document.getElementById('galeri-no-result');

    if (searchInput && grid) {
        searchInput.addEventListener('input', function () {
            var keyword = searchInput.value.trim().toLowerCase();
            var items = grid.querySelectorAll('.galeri-item');
            var visible = 0;

            items.forEach(function (item) {
                var match = (item.getAttribute('data-search') || '').indexOf(keyword) !== -1;
                item.classList.toggle('d-none', !match);
                if (match) visible++;
            });

            if (countEl) countEl.textContent = visible;
            if (noResult) noResult.classList.toggle('d-none', visible !== 0 || items.length === 0);
        });
    }

    /* ---------------------------------------------------------
       3. FOTO RUSAK -> placeholder ikon lokal
    --------------------------------------------------------- */
    document.querySelectorAll('.gallery-image').forEach(function (img) {
        function markBroken() {
            var media = img.closest('.gallery-media');
            if (media) media.classList.add('is-broken');
        }
        img.addEventListener('error', markBroken);
        if (img.complete && img.naturalWidth === 0 && img.getAttribute('src')) markBroken();
    });

    /* ---------------------------------------------------------
       4. PENGHITUNG KARAKTER TEXTAREA
    --------------------------------------------------------- */
    document.querySelectorAll('.custom-textarea[data-counter]').forEach(function (ta) {
        var counter = document.getElementById(ta.getAttribute('data-counter'));
        if (!counter) return;
        var box = counter.parentNode;
        var max = parseInt(ta.getAttribute('maxlength'), 10) || 0;

        function update() {
            var len = ta.value.length;
            counter.textContent = len;
            if (box && max) box.classList.toggle('is-limit', len >= max);
        }
        ta.addEventListener('input', update);
        update();
    });

    /* ---------------------------------------------------------
       5. UPLOAD FOTO: dropzone, preview, validasi
    --------------------------------------------------------- */
    var zone = document.getElementById('uploadDropzone');
    if (zone) {
        var input = document.getElementById('fotoInput');
        var placeholder = document.getElementById('uploadPlaceholder');
        var wrapper = document.getElementById('previewWrapper');
        var preview = document.getElementById('imgPreview');
        var nameEl = document.getElementById('previewFilename');
        var badgeEl = document.getElementById('previewBadge');
        var errorEl = document.getElementById('uploadError');
        var errorText = document.getElementById('uploadErrorText');
        var maxMb = parseFloat(zone.getAttribute('data-max-mb')) || 4;
        var hasInitial = zone.getAttribute('data-has-initial') === '1';
        var initialSrc = preview ? preview.getAttribute('src') : '';
        var initialName = nameEl ? nameEl.textContent : '';
        var initialBadge = badgeEl ? badgeEl.textContent : '';
        var hasNewFile = false;

        function showError(msg) {
            errorText.textContent = msg;
            errorEl.classList.remove('d-none');
        }

        function clearError() {
            errorEl.classList.add('d-none');
            errorText.textContent = '';
        }

        function restoreState() {
            hasNewFile = false;
            if (hasInitial) {
                preview.src = initialSrc;
                nameEl.textContent = initialName;
                badgeEl.textContent = initialBadge;
                placeholder.classList.add('d-none');
                wrapper.classList.remove('d-none');
            } else {
                preview.removeAttribute('src');
                placeholder.classList.remove('d-none');
                wrapper.classList.add('d-none');
            }
        }

        function validate(file) {
            if (!file.type || file.type.indexOf('image/') !== 0) {
                return 'File harus berupa gambar (PNG, JPG, JPEG, atau WEBP).';
            }
            if (file.size > maxMb * 1024 * 1024) {
                return 'Ukuran foto maksimal ' + maxMb + ' MB.';
            }
            return '';
        }

        function showPreview(file) {
            var reader = new FileReader();
            reader.onload = function (event) {
                hasNewFile = true;
                preview.src = event.target.result;
                nameEl.textContent = file.name;
                badgeEl.textContent = 'Foto baru';
                placeholder.classList.add('d-none');
                wrapper.classList.remove('d-none');
            };
            reader.readAsDataURL(file);
        }

        function handleFile(file) {
            var message = validate(file);
            if (message) {
                input.value = '';
                showError(message);
                restoreState();
                return;
            }
            clearError();
            showPreview(file);
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

        input.addEventListener('change', function () {
            var file = input.files && input.files[0];
            if (file) {
                handleFile(file);
            } else {
                clearError();
                restoreState();
            }
        });

        input.addEventListener('invalid', function (e) {
            e.preventDefault();
            showError('Pilih foto terlebih dahulu.');
            zone.focus();
        });

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
            var files = e.dataTransfer && e.dataTransfer.files;
            if (!files || !files.length) return;
            if (files.length > 1) {
                showError('Pilih satu foto saja.');
                return;
            }
            var message = validate(files[0]);
            if (message) {
                showError(message);
                return;
            }
            input.files = files;
            handleFile(files[0]);
        });

        // Foto lama gagal dimuat -> kembali ke tampilan placeholder
        if (hasInitial) {
            var onInitialError = function () {
                if (hasNewFile) return;
                hasInitial = false;
                restoreState();
            };
            preview.addEventListener('error', onInitialError);
            if (preview.complete && preview.naturalWidth === 0) onInitialError();
        }
    }

    /* ---------------------------------------------------------
       6. LOADING STATE TOMBOL SIMPAN
    --------------------------------------------------------- */
    var form = document.getElementById('form-galeri');
    var btnSubmit = document.getElementById('btn-submit-galeri');
    if (form && btnSubmit) {
        form.addEventListener('submit', function () {
            btnSubmit.classList.add('is-loading');
        });
    }
});

// Halaman dipulihkan dari cache (tombol Back): reset spinner
window.addEventListener('pageshow', function (e) {
    if (!e.persisted) return;
    document.querySelectorAll('.btn-save.is-loading').forEach(function (btn) {
        btn.classList.remove('is-loading');
    });
});
</script>
