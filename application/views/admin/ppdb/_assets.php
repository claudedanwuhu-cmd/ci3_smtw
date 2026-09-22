<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<style>
    :root {
        --ppdb-card: #ffffff;        --ppdb-subtle: #f8fafc;
        --ppdb-input-bg: #f8fafc;    --ppdb-input-focus: #ffffff;
        --ppdb-input-border: #cbd5e1;
        --ppdb-border: rgba(226, 232, 240, .8);
        --ppdb-title: #0f172a;       --ppdb-subtitle: #64748b;
        --ppdb-hover: #f1f5f9;
        --ppdb-accent: #0ea5e9;      --ppdb-glow: rgba(14, 165, 233, .25);
        --ppdb-soft: rgba(14, 165, 233, .10);  --ppdb-soft-border: rgba(14, 165, 233, .22);
        --ppdb-icon-muted: #94a3b8;
        --ppdb-success: #059669;     --ppdb-danger: #dc2626;
        --ppdb-shadow: 0 10px 25px -5px rgba(15, 23, 42, .05), 0 8px 10px -6px rgba(15, 23, 42, .02);
    }
    [data-bs-theme="dark"], [data-theme="dark"], body.dark-mode, .dark-mode {
        --ppdb-card: #0f172a;        --ppdb-subtle: #1e293b;
        --ppdb-input-bg: #1e293b;    --ppdb-input-focus: #111827;
        --ppdb-input-border: rgba(255, 255, 255, .12);
        --ppdb-border: rgba(255, 255, 255, .08);
        --ppdb-title: #f8fafc;       --ppdb-subtitle: #94a3b8;
        --ppdb-hover: #1e293b;
        --ppdb-accent: #38bdf8;      --ppdb-glow: rgba(56, 189, 248, .25);
        --ppdb-soft: rgba(56, 189, 248, .10);  --ppdb-soft-border: rgba(56, 189, 248, .22);
        --ppdb-icon-muted: #64748b;
        --ppdb-success: #34d399;     --ppdb-danger: #f87171;
        --ppdb-shadow: 0 12px 30px -5px rgba(0, 0, 0, .4);
    }

    /* ---------- Keyframes ---------- */
    @keyframes fadeUp { from { opacity: 0; transform: translateY(12px); } to { opacity: 1; transform: none; } }
    @keyframes alertIn { from { opacity: 0; transform: translateY(-14px) scale(.97); } to { opacity: 1; transform: none; } }
    @keyframes alertProgress { from { transform: scaleX(1); } to { transform: scaleX(0); } }
    @keyframes pulse { 0% { box-shadow: 0 0 0 0 rgba(16, 185, 129, .55); } 70%, 100% { box-shadow: 0 0 0 6px rgba(16, 185, 129, 0); } }
    @keyframes spin { to { transform: rotate(360deg); } }

    /* ---------- Notifikasi flash ---------- */
    .alert.alert-autodismiss {
        position: relative; display: flex; align-items: center; gap: 12px; overflow: hidden;
        padding: 14px 48px 17px 16px; border-radius: 14px; border: 1px solid;
        animation: alertIn .5s cubic-bezier(.34, 1.56, .64, 1) both;
        transition: max-height .35s ease, opacity .35s ease, transform .35s ease, padding .35s ease, margin .35s ease;
    }
    .alert.alert-autodismiss.is-success { background: rgba(16, 185, 129, .12); border-color: rgba(16, 185, 129, .28); color: var(--ppdb-success); }
    .alert.alert-autodismiss.is-error   { background: rgba(239, 68, 68, .12);  border-color: rgba(239, 68, 68, .28);  color: var(--ppdb-danger); }
    .alert.alert-autodismiss.alert-hiding { opacity: 0; transform: translateY(-10px); max-height: 0 !important; padding-top: 0; padding-bottom: 0; margin-bottom: 0 !important; border-width: 0; }
    .alert-icon-box { width: 36px; height: 36px; border-radius: 10px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; font-size: 16px; background: rgba(148, 163, 184, .16); }
    .is-success .alert-icon-box { background: rgba(16, 185, 129, .18); }
    .is-error .alert-icon-box   { background: rgba(239, 68, 68, .18); }
    .alert-content { min-width: 0; }
    .alert-content strong { display: block; font-size: 13.5px; font-weight: 700; }
    .alert-content span { display: block; font-size: 12.5px; color: var(--ppdb-title); word-break: break-word; }
    .alert.alert-autodismiss .btn-close { position: absolute; top: 12px; right: 12px; padding: 8px; font-size: 10px; opacity: .6; }
    .alert.alert-autodismiss .btn-close:hover { opacity: 1; }
    [data-bs-theme="dark"] .alert .btn-close, [data-theme="dark"] .alert .btn-close, body.dark-mode .alert .btn-close, .dark-mode .alert .btn-close { filter: invert(1) grayscale(100%) brightness(200%); }
    .alert-progress-track { position: absolute; left: 0; right: 0; bottom: 0; height: 3px; background: rgba(148, 163, 184, .15); }
    .alert-progress-bar { height: 100%; width: 100%; transform-origin: left center; animation: alertProgress 4.5s linear forwards; }
    .is-success .alert-progress-bar { background: var(--ppdb-success); }
    .is-error .alert-progress-bar   { background: var(--ppdb-danger); }

    /* ---------- Page header ---------- */
    .page-header-custom {
        position: relative; overflow: hidden; display: flex; align-items: center; justify-content: space-between; gap: 20px;
        background: var(--ppdb-card); border: 1px solid var(--ppdb-border); border-radius: 20px;
        padding: 22px 28px; box-shadow: var(--ppdb-shadow); animation: fadeUp .4s ease backwards;
    }
    .page-header-custom::before { content: ""; position: absolute; left: 0; top: 0; bottom: 0; width: 4px; background: linear-gradient(180deg, var(--ppdb-accent), #0369a1); }
        .page-header-custom > * { position: relative; z-index: 1; }
    .page-header-icon {
        width: 52px; height: 52px; border-radius: 16px; flex-shrink: 0; display: flex; align-items: center; justify-content: center;
        background: var(--ppdb-soft); border: 1px solid var(--ppdb-soft-border); color: var(--ppdb-accent); font-size: 22px;
        transition: transform .3s ease;
    }
    .page-header-custom:hover .page-header-icon { transform: rotate(-6deg) scale(1.06); }
    .badge-header-tag {
        display: inline-flex; align-items: center; gap: 6px; padding: 3px 10px; border-radius: 999px;
        background: var(--ppdb-soft); border: 1px solid var(--ppdb-soft-border); color: var(--ppdb-accent);
        font-size: 10.5px; font-weight: 800; text-transform: uppercase; letter-spacing: .6px;
    }
    .page-title { margin: 4px 0 2px; font-size: 22px; font-weight: 800; letter-spacing: -.3px; color: var(--ppdb-title); }
    .page-subtitle { margin: 0; font-size: 13px; color: var(--ppdb-subtitle); }

    /* ---------- Card ---------- */
    .custom-card {
        background: var(--ppdb-card); border: 1px solid var(--ppdb-border); border-radius: 20px;
        overflow: hidden; box-shadow: var(--ppdb-shadow); animation: fadeUp .4s ease .05s backwards;
    }
    .card-title-custom {
        display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 14px;
        background: var(--ppdb-subtle); border-bottom: 1px solid var(--ppdb-border); padding: 18px 24px;
    }
    .title-icon {
        width: 42px; height: 42px; border-radius: 12px; flex-shrink: 0; display: flex; align-items: center; justify-content: center;
        background: var(--ppdb-soft); border: 1px solid var(--ppdb-soft-border); color: var(--ppdb-accent); font-size: 17px;
    }
    .card-title-custom h5 { margin: 0; font-size: 15px; font-weight: 700; color: var(--ppdb-title); }
    .card-title-custom small { display: block; font-size: 12px; color: var(--ppdb-subtitle); }
    .total-badge {
        display: inline-flex; align-items: center; padding: 6px 14px; border-radius: 999px;
        background: var(--ppdb-soft); border: 1px solid var(--ppdb-soft-border); color: var(--ppdb-accent);
        font-size: 12px; font-weight: 700; white-space: nowrap;
    }

    /* ---------- Tombol ---------- */
    .btn-add, .btn-save, .btn-back, .btn-cancel {
        position: relative; display: inline-flex; align-items: center; justify-content: center; gap: 8px;
        border-radius: 12px; padding: 11px 20px; font-size: 12.5px; font-weight: 700; line-height: 1.2;
        text-decoration: none; cursor: pointer; white-space: nowrap;
    }
    .btn-add, .btn-save {
        border: 0; background: linear-gradient(135deg, #0284c7, #0369a1); color: #ffffff !important;
        box-shadow: 0 6px 18px rgba(2, 132, 199, .28); transition: transform .25s ease, box-shadow .25s ease;
    }
    .btn-add:hover, .btn-save:hover { transform: translateY(-2px); box-shadow: 0 10px 24px rgba(2, 132, 199, .45); }
    .btn-save.is-loading { color: transparent !important; pointer-events: none; }
    .btn-save.is-loading::after {
        content: ""; position: absolute; top: 50%; left: 50%; width: 18px; height: 18px; margin: -9px 0 0 -9px;
        border: 2.5px solid rgba(255, 255, 255, .3); border-top-color: #ffffff; border-radius: 50%; animation: spin .7s linear infinite;
    }
    .btn-back {
        background: var(--ppdb-subtle); border: 1px solid var(--ppdb-border); color: var(--ppdb-title);
        transition: background .2s ease, color .2s ease, transform .2s ease;
    }
    .btn-back:hover { background: var(--ppdb-hover); color: var(--ppdb-accent); transform: translateX(-3px); }
    .btn-cancel {
        background: var(--ppdb-card); border: 1px solid var(--ppdb-border); color: var(--ppdb-title);
        transition: color .2s ease, transform .2s ease;
    }
    .btn-cancel:hover { color: #ef4444; transform: translateY(-1px); }
    .btn-action {
        width: 36px; height: 36px; border-radius: 10px; display: inline-flex; align-items: center; justify-content: center;
        font-size: 14px; text-decoration: none; cursor: pointer; transition: background .2s ease, color .2s ease, border-color .2s ease, transform .2s ease;
    }
    .btn-action.edit { background: var(--ppdb-subtle); border: 1px solid var(--ppdb-border); color: var(--ppdb-subtitle); }
    .btn-action.edit:hover { background: var(--ppdb-accent); border-color: var(--ppdb-accent); color: #ffffff; transform: translateY(-2px); }
    .btn-action.delete { background: rgba(239, 68, 68, .10); border: 1px solid rgba(239, 68, 68, .18); color: #f87171; }
    .btn-action.delete:hover { background: #ef4444; border-color: #ef4444; color: #ffffff; transform: translateY(-2px); }
    .btn-add:focus-visible, .btn-save:focus-visible, .btn-back:focus-visible, .btn-cancel:focus-visible, .btn-action:focus-visible {
        outline: 2px solid var(--ppdb-accent); outline-offset: 2px;
    }

    /* ---------- Status badge ---------- */
    .status-badge { display: inline-flex; align-items: center; gap: 7px; padding: 5px 12px; border-radius: 999px; font-size: 11.5px; font-weight: 700; white-space: nowrap; }
    .status-badge .dot { width: 6px; height: 6px; border-radius: 50%; background: currentColor; }
    .status-badge.active   { background: rgba(16, 185, 129, .12); color: var(--ppdb-success); }
    .status-badge.active .dot { animation: pulse 1.8s ease-in-out infinite; }
    .status-badge.inactive { background: rgba(239, 68, 68, .12); color: var(--ppdb-danger); }

    /* ---------- Empty state ---------- */
    .empty-state { text-align: center; padding: 56px 24px; }
    .empty-icon {
        width: 64px; height: 64px; border-radius: 18px; margin-bottom: 16px; display: inline-flex; align-items: center; justify-content: center;
        background: var(--ppdb-soft); border: 1px solid var(--ppdb-soft-border); color: var(--ppdb-accent); font-size: 26px;
    }
    .empty-title { margin-bottom: 4px; font-size: 15px; font-weight: 700; color: var(--ppdb-title); }
    .empty-text { margin: 0 0 18px; font-size: 12.5px; color: var(--ppdb-subtitle); }

    /* ---------- Form ---------- */
    .form-body { padding: 24px; }
    .custom-card .form-label { margin-bottom: 8px; font-size: 12.5px; font-weight: 700; color: var(--ppdb-title); }
    .custom-card .form-label.required::after { content: "*"; margin-left: 4px; color: var(--ppdb-danger); }
    .input-icon-group { position: relative; }
    .input-icon { position: absolute; left: 16px; top: 50%; transform: translateY(-50%); font-size: 14px; color: var(--ppdb-icon-muted); pointer-events: none; transition: color .2s ease; }
    .input-icon-group:focus-within .input-icon { color: var(--ppdb-accent); }
    .custom-card .form-control {
        background: var(--ppdb-input-bg); border: 1px solid var(--ppdb-input-border); border-radius: 12px;
        color: var(--ppdb-title); font-size: 13.5px; padding: 11px 14px; transition: border-color .2s ease, box-shadow .2s ease, background .2s ease;
    }
    .custom-card .form-control.with-icon { padding-left: 42px; }
    .custom-card .form-control::placeholder { color: var(--ppdb-icon-muted); }
    .custom-card .form-control:hover { border-color: var(--ppdb-accent); }
    .custom-card .form-control:focus { background: var(--ppdb-input-focus); border-color: var(--ppdb-accent); box-shadow: 0 0 0 4px var(--ppdb-glow); color: var(--ppdb-title); outline: 0; }
    .custom-card input[type="date"] { color-scheme: light; }
    [data-bs-theme="dark"] .custom-card input[type="date"], [data-theme="dark"] .custom-card input[type="date"],
    body.dark-mode .custom-card input[type="date"], .dark-mode .custom-card input[type="date"] { color-scheme: dark; }
    .custom-textarea { resize: vertical; min-height: 120px; line-height: 1.65; }
    .form-hint { display: flex; justify-content: space-between; gap: 12px; margin-top: 6px; font-size: 12px; color: var(--ppdb-subtitle); }
    .form-hint i { margin-right: 6px; color: var(--ppdb-accent); }
    .form-hint .char-count { white-space: nowrap; }

    .status-toggle {
        display: flex; align-items: center; gap: 14px; padding: 14px 16px; border-radius: 14px; cursor: pointer; user-select: none;
        background: var(--ppdb-input-bg); border: 1px solid var(--ppdb-input-border); transition: border-color .2s ease, box-shadow .2s ease;
    }
    .status-toggle:hover { border-color: var(--ppdb-accent); }
    .status-toggle:focus-visible { outline: 0; border-color: var(--ppdb-accent); box-shadow: 0 0 0 4px var(--ppdb-glow); }
    .status-toggle-icon {
        width: 38px; height: 38px; border-radius: 12px; flex-shrink: 0; display: flex; align-items: center; justify-content: center;
        font-size: 17px; background: rgba(16, 185, 129, .12); color: var(--ppdb-success); transition: background .25s ease, color .25s ease;
    }
    .status-toggle[aria-checked="false"] .status-toggle-icon { background: rgba(100, 116, 139, .14); color: var(--ppdb-subtitle); }
    .status-toggle-text { flex: 1; min-width: 0; }
    .status-toggle-text strong { display: block; font-size: 13px; font-weight: 700; color: var(--ppdb-title); }
    .status-toggle-text span { font-size: 12px; color: var(--ppdb-subtitle); }
    .switch { position: relative; width: 42px; height: 24px; flex-shrink: 0; border-radius: 999px; background: var(--ppdb-success); transition: background .25s ease; }
    .switch .knob { position: absolute; top: 3px; left: 3px; width: 18px; height: 18px; border-radius: 50%; background: var(--ppdb-card); box-shadow: 0 2px 4px rgba(0, 0, 0, .2); transform: translateX(18px); transition: transform .25s ease; }
    .status-toggle[aria-checked="false"] .switch { background: var(--ppdb-icon-muted); }
    .status-toggle[aria-checked="false"] .switch .knob { transform: translateX(0); }

    .form-footer { display: flex; justify-content: flex-end; gap: 12px; padding: 18px 24px; background: var(--ppdb-subtle); border-top: 1px solid var(--ppdb-border); }

    /* ---------- Responsif ---------- */
    @media (max-width: 768px) {
        .page-header-custom { flex-direction: column; align-items: stretch; padding: 18px; }
        .page-header-custom .btn-add, .page-header-custom .btn-back { width: 100%; }
        .card-title-custom { padding: 16px 18px; }
        .form-body { padding: 18px; }
        .form-footer { flex-direction: column-reverse; padding: 16px 18px; }
        .form-footer .btn-cancel, .form-footer .btn-save { width: 100%; }
    }

    /* ---------- Reduced motion ---------- */
    @media (prefers-reduced-motion: reduce) {
        .content-wrapper *, .content-wrapper *::before, .content-wrapper *::after {
            animation-duration: .01ms !important; animation-delay: 0s !important; animation-iteration-count: 1 !important; transition-duration: .01ms !important;
        }
        .page-header-custom:hover .page-header-icon { transform: none; }
        .alert-progress-track { display: none; }
    }
</style>

<script>
(function () {
    /* Flash: auto-dismiss dengan pause saat hover */
    document.querySelectorAll('.alert-autodismiss').forEach(function (el) {
        var total = parseInt(el.getAttribute('data-autodismiss'), 10) || 4500;
        var bar = el.querySelector('.alert-progress-bar');
        var closeBtn = el.querySelector('.btn-close');
        var remaining = total, startedAt = 0, timer = null, hiding = false;

        if (bar) bar.style.animationDuration = total + 'ms';

        function hide() {
            if (hiding) return;
            hiding = true;
            clearTimeout(timer);
            el.style.maxHeight = el.offsetHeight + 'px';
            void el.offsetHeight;
            el.classList.add('alert-hiding');
            setTimeout(function () { if (el.parentNode) el.parentNode.removeChild(el); }, 380);
        }
        function run(ms) { startedAt = Date.now(); timer = setTimeout(hide, ms); }

        el.addEventListener('mouseenter', function () {
            if (hiding) return;
            clearTimeout(timer);
            remaining -= Date.now() - startedAt;
            if (bar) bar.style.animationPlayState = 'paused';
        });
        el.addEventListener('mouseleave', function () {
            if (hiding) return;
            remaining = Math.max(remaining, 800);
            if (bar) bar.style.animationPlayState = 'running';
            run(remaining);
        });
        if (closeBtn) closeBtn.addEventListener('click', hide);
        run(remaining);
    });

    /* Toggle status (role="switch") */
    var toggle = document.getElementById('statusToggle');
    if (toggle) {
        var input = document.getElementById('statusInput');
        var icon = toggle.querySelector('.status-toggle-icon i');
        var desc = document.getElementById('statusDesc');
        var setStatus = function (on) {
            toggle.setAttribute('aria-checked', on ? 'true' : 'false');
            input.value = on ? 'aktif' : 'nonaktif';
            icon.className = on ? 'fa-solid fa-circle-check' : 'fa-solid fa-circle-xmark';
            desc.textContent = on ? 'Aktif. Klik untuk menonaktifkan.' : 'Nonaktif. Klik untuk mengaktifkan.';
        };
        var flip = function () { setStatus(toggle.getAttribute('aria-checked') !== 'true'); };
        toggle.addEventListener('click', flip);
        toggle.addEventListener('keydown', function (e) {
            if (e.key === 'Enter' || e.key === ' ') { e.preventDefault(); flip(); }
        });
    }

    /* Penghitung karakter textarea */
    document.querySelectorAll('textarea[data-counter]').forEach(function (ta) {
        var out = document.getElementById(ta.getAttribute('data-counter'));
        var update = function () { if (out) out.textContent = ta.value.length; };
        ta.addEventListener('input', update);
        update();
    });

    /* Loading tombol simpan */
    var form = document.getElementById('ppdbForm');
    if (form) {
        var btn = form.querySelector('.btn-save');
        form.addEventListener('submit', function (e) {
            if (btn && btn.classList.contains('is-loading')) { e.preventDefault(); return; }
            if (btn) btn.classList.add('is-loading');
        });
        window.addEventListener('pageshow', function (e) {
            if (e.persisted && btn) btn.classList.remove('is-loading');
        });
    }
})();
</script>
