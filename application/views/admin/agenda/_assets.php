<?php
/**
 * Aset bersama modul Agenda (CSS + JS).
 *
 * index  : $this->load->view('admin/agenda/_assets');
 * tambah : $this->load->view('admin/agenda/_assets', ['assets_form' => true]);
 * edit   : $this->load->view('admin/agenda/_assets', ['assets_form' => true]);
 */
$assets_form = !empty($assets_form);
?>
<style>
	/* ===================== DESIGN TOKENS ===================== */
	:root {
		--agenda-card: #ffffff;
		--agenda-subtle: #f8fafc;
		--agenda-input-bg: #f8fafc;
		--agenda-input-focus: #ffffff;
		--agenda-input-border: #cbd5e1;
		--agenda-border: rgba(226, 232, 240, 0.8);
		--agenda-title: #0f172a;
		--agenda-subtitle: #64748b;
		--agenda-hover: #f1f5f9;
		--agenda-accent: #0ea5e9;
		--agenda-glow: rgba(14, 165, 233, 0.25);
		--agenda-soft: rgba(14, 165, 233, 0.10);
		--agenda-soft-border: rgba(14, 165, 233, 0.22);
		--agenda-icon-muted: #94a3b8;
		--agenda-success: #059669;
		--agenda-danger: #dc2626;
		--agenda-shadow: 0 10px 25px -5px rgba(15, 23, 42, 0.05), 0 8px 10px -6px rgba(15, 23, 42, 0.02);
	}

	[data-bs-theme="dark"],
	[data-theme="dark"],
	body.dark-mode,
	.dark-mode {
		--agenda-card: #0f172a;
		--agenda-subtle: #1e293b;
		--agenda-input-bg: #1e293b;
		--agenda-input-focus: #111827;
		--agenda-input-border: rgba(255, 255, 255, 0.12);
		--agenda-border: rgba(255, 255, 255, 0.08);
		--agenda-title: #f8fafc;
		--agenda-subtitle: #94a3b8;
		--agenda-hover: #1e293b;
		--agenda-accent: #38bdf8;
		--agenda-glow: rgba(56, 189, 248, 0.25);
		--agenda-soft: rgba(56, 189, 248, 0.10);
		--agenda-soft-border: rgba(56, 189, 248, 0.22);
		--agenda-icon-muted: #64748b;
		--agenda-success: #34d399;
		--agenda-danger: #f87171;
		--agenda-shadow: 0 12px 30px -5px rgba(0, 0, 0, 0.4);
	}

	[data-bs-theme="dark"] .alert-autodismiss .btn-close,
	[data-theme="dark"] .alert-autodismiss .btn-close,
	body.dark-mode .alert-autodismiss .btn-close,
	.dark-mode .alert-autodismiss .btn-close {
		filter: invert(1) grayscale(100%) brightness(200%);
	}

	/* ===================== FLASH ALERT (AUTO-DISMISS) ===================== */
	.alert.alert-autodismiss {
		position: relative;
		overflow: hidden;
		display: flex;
		align-items: center;
		gap: 14px;
		padding: 14px 18px;
		margin-bottom: 24px;
		border: 1px solid transparent;
		border-radius: 16px;
		animation: agendaAlertIn 0.35s cubic-bezier(0.34, 1.56, 0.64, 1);
		transition: opacity 0.35s ease, transform 0.35s ease, max-height 0.35s ease,
			padding 0.35s ease, margin 0.35s ease, border-width 0.35s ease;
	}

	.alert.alert-autodismiss.is-success {
		background: rgba(16, 185, 129, 0.12);
		border-color: rgba(16, 185, 129, 0.28);
		color: var(--agenda-success);
	}

	.alert.alert-autodismiss.is-error {
		background: rgba(239, 68, 68, 0.12);
		border-color: rgba(239, 68, 68, 0.28);
		color: var(--agenda-danger);
	}

	.alert-icon-box {
		width: 36px;
		height: 36px;
		border-radius: 10px;
		display: flex;
		align-items: center;
		justify-content: center;
		font-size: 17px;
		flex-shrink: 0;
	}

	.is-success .alert-icon-box { background: rgba(16, 185, 129, 0.18); }
	.is-error .alert-icon-box { background: rgba(239, 68, 68, 0.18); }

	.alert-content {
		flex: 1;
		min-width: 0;
		display: flex;
		flex-direction: column;
		gap: 1px;
	}

	.alert-content strong {
		font-size: 13.5px;
		font-weight: 700;
	}

	.alert-content span {
		font-size: 12.5px;
		opacity: 0.92;
		word-break: break-word;
	}

	.alert.alert-autodismiss .btn-close {
		position: static;
		padding: 8px;
		flex-shrink: 0;
		opacity: 0.6;
	}

	.alert.alert-autodismiss .btn-close:hover { opacity: 1; }

	.alert.alert-autodismiss.alert-hiding {
		opacity: 0;
		transform: translateY(-10px);
		max-height: 0 !important;
		padding-top: 0;
		padding-bottom: 0;
		margin-bottom: 0 !important;
		border-width: 0;
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
		transform-origin: left;
		animation-name: agendaAlertProgress;
		animation-timing-function: linear;
		animation-fill-mode: forwards;
		animation-duration: 4500ms;
	}

	.is-success .alert-progress-bar { background: var(--agenda-success); }
	.is-error .alert-progress-bar { background: var(--agenda-danger); }

	@keyframes agendaAlertIn {
		from { opacity: 0; transform: translateY(-14px) scale(0.98); }
		to { opacity: 1; transform: translateY(0) scale(1); }
	}

	@keyframes agendaAlertProgress {
		from { transform: scaleX(1); }
		to { transform: scaleX(0); }
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
		background: var(--agenda-card);
		border: 1px solid var(--agenda-border);
		border-radius: 20px;
		box-shadow: var(--agenda-shadow);
		animation: agendaFadeUp 0.4s ease both;
	}

	.page-header-custom::before {
		content: "";
		position: absolute;
		inset: 0 auto 0 0;
		width: 4px;
		background: linear-gradient(180deg, var(--agenda-accent), #0369a1);
	}


	.page-header-custom > * {
		position: relative;
		z-index: 1;
	}

	.page-header-icon {
		width: 52px;
		height: 52px;
		border-radius: 16px;
		background: var(--agenda-soft);
		border: 1px solid var(--agenda-soft-border);
		color: var(--agenda-accent);
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
		padding: 4px 12px;
		background: var(--agenda-soft);
		color: var(--agenda-accent);
		border: 1px solid var(--agenda-soft-border);
		border-radius: 999px;
		font-size: 10.5px;
		font-weight: 800;
		text-transform: uppercase;
		letter-spacing: 0.5px;
	}

	.page-title {
		color: var(--agenda-title);
		font-size: 22px;
		font-weight: 800;
		letter-spacing: -0.3px;
		margin: 0 0 2px;
	}

	.page-subtitle {
		color: var(--agenda-subtitle);
		font-size: 13px;
		margin: 0;
	}

	/* ===================== CARD ===================== */
	.custom-card {
		background: var(--agenda-card);
		border: 1px solid var(--agenda-border);
		border-radius: 20px;
		overflow: hidden;
		box-shadow: var(--agenda-shadow);
		animation: agendaFadeUp 0.4s ease both;
	}

	.card-title-custom {
		display: flex;
		align-items: center;
		gap: 14px;
		padding: 18px 24px;
		background: var(--agenda-subtle);
		border-bottom: 1px solid var(--agenda-border);
	}

	.title-icon {
		width: 42px;
		height: 42px;
		border-radius: 12px;
		background: var(--agenda-soft);
		border: 1px solid var(--agenda-soft-border);
		color: var(--agenda-accent);
		display: flex;
		align-items: center;
		justify-content: center;
		font-size: 16px;
		flex-shrink: 0;
	}

	.card-title-custom h5 {
		margin: 0 0 2px;
		color: var(--agenda-title);
		font-size: 15px;
		font-weight: 700;
	}

	.card-title-custom small {
		color: var(--agenda-subtitle);
		font-size: 12px;
	}

	.total-badge {
		display: inline-flex;
		align-items: center;
		padding: 6px 14px;
		background: var(--agenda-soft);
		border: 1px solid var(--agenda-soft-border);
		color: var(--agenda-accent);
		border-radius: 999px;
		font-size: 12px;
		font-weight: 700;
		white-space: nowrap;
	}

	@keyframes agendaFadeUp {
		from { opacity: 0; transform: translateY(12px); }
		to { opacity: 1; transform: translateY(0); }
	}

	/* ===================== BUTTONS ===================== */
	.btn-add,
	.btn-save {
		display: inline-flex;
		align-items: center;
		justify-content: center;
		padding: 11px 20px;
		background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%);
		color: #ffffff;
		border: none;
		border-radius: 12px;
		font-size: 12.5px;
		font-weight: 700;
		text-decoration: none;
		white-space: nowrap;
		cursor: pointer;
		box-shadow: 0 6px 18px rgba(2, 132, 199, 0.28);
		transition: transform 0.25s ease, box-shadow 0.25s ease;
	}

	.btn-add:hover,
	.btn-save:hover {
		color: #ffffff;
		transform: translateY(-2px);
		box-shadow: 0 10px 24px rgba(2, 132, 199, 0.45);
	}

	.btn-back,
	.btn-cancel {
		display: inline-flex;
		align-items: center;
		justify-content: center;
		background: var(--agenda-subtle);
		color: var(--agenda-title);
		border: 1px solid var(--agenda-border);
		border-radius: 12px;
		padding: 10px 20px;
		font-size: 12.5px;
		font-weight: 600;
		text-decoration: none;
		white-space: nowrap;
		transition: all 0.25s ease;
	}

	.btn-back:hover {
		background: var(--agenda-hover);
		color: var(--agenda-accent);
		transform: translateX(-3px);
	}

	.btn-cancel {
		background: var(--agenda-card);
	}

	.btn-cancel:hover {
		background: var(--agenda-hover);
		color: #ef4444;
		transform: translateY(-1px);
	}

	.btn-add:focus-visible,
	.btn-back:focus-visible,
	.btn-cancel:focus-visible,
	.btn-save:focus-visible,
	.alert-autodismiss .btn-close:focus-visible {
		outline: 2px solid var(--agenda-accent);
		outline-offset: 2px;
	}

	/* Tombol simpan: loading state */
	.btn-save { position: relative; overflow: hidden; }
	.btn-save-content { display: inline-flex; align-items: center; transition: opacity 0.2s ease; }
	.btn-save.is-loading { pointer-events: none; }
	.btn-save.is-loading .btn-save-content { opacity: 0; }

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
		animation: agendaSpin 0.7s linear infinite;
	}

	.btn-save.is-loading .btn-save-spinner { opacity: 1; }

	@keyframes agendaSpin { to { transform: rotate(360deg); } }

<?php if ($assets_form): ?>
	/* ===================== FORM ===================== */
	.card-body-custom { padding: 24px; }

	.form-label {
		color: var(--agenda-title);
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
		z-index: 2;
		color: var(--agenda-icon-muted);
		font-size: 14px;
		pointer-events: none;
		transition: color 0.25s ease;
	}

	.input-icon-group:focus-within .input-icon { color: var(--agenda-accent); }

	.form-control,
	.form-select {
		background-color: var(--agenda-input-bg);
		border: 1px solid var(--agenda-input-border);
		border-radius: 12px;
		color: var(--agenda-title);
		font-size: 13.5px;
		padding: 10px 16px;
		transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
	}

	.form-control.with-icon { padding-left: 42px; }

	.form-control:hover:not(:focus),
	.form-select:hover:not(:focus) { border-color: var(--agenda-accent); }

	.form-control:focus,
	.form-select:focus {
		background-color: var(--agenda-input-focus);
		border-color: var(--agenda-accent);
		color: var(--agenda-title);
		box-shadow: 0 0 0 4px var(--agenda-glow);
		outline: none;
	}

	.form-control::placeholder {
		color: var(--agenda-subtitle);
		opacity: 0.6;
	}

	input[type="date"].form-control { color-scheme: light; }

	[data-bs-theme="dark"] input[type="date"].form-control,
	[data-theme="dark"] input[type="date"].form-control,
	body.dark-mode input[type="date"].form-control,
	.dark-mode input[type="date"].form-control {
		color-scheme: dark;
	}

	.custom-textarea {
		resize: vertical;
		min-height: 120px;
		line-height: 1.65;
	}

	.form-hint {
		display: flex;
		align-items: flex-start;
		justify-content: space-between;
		gap: 12px;
		margin-top: 8px;
		color: var(--agenda-subtitle);
		font-size: 11.5px;
	}

	/* Toggle status keaktifan */
	.status-toggle {
		display: flex;
		align-items: center;
		gap: 12px;
		padding: 10px 14px;
		background: var(--agenda-input-bg);
		border: 1px solid var(--agenda-input-border);
		border-radius: 12px;
		cursor: pointer;
		user-select: none;
		transition: all 0.25s ease;
	}

	.status-toggle:hover { border-color: var(--agenda-accent); }

	.status-toggle:focus-visible {
		outline: none;
		border-color: var(--agenda-accent);
		box-shadow: 0 0 0 4px var(--agenda-glow);
	}

	.status-toggle-icon {
		width: 38px;
		height: 38px;
		border-radius: 10px;
		background: rgba(239, 68, 68, 0.10);
		color: var(--agenda-danger);
		display: flex;
		align-items: center;
		justify-content: center;
		font-size: 16px;
		flex-shrink: 0;
		transition: all 0.25s ease;
	}

	.status-toggle.is-active .status-toggle-icon {
		background: rgba(16, 185, 129, 0.12);
		color: var(--agenda-success);
	}

	.status-toggle-text {
		flex: 1;
		min-width: 0;
	}

	.status-toggle-text strong {
		display: block;
		color: var(--agenda-title);
		font-size: 13px;
		font-weight: 700;
	}

	.status-toggle-text small {
		display: block;
		color: var(--agenda-subtitle);
		font-size: 11.5px;
	}

	.status-switch {
		position: relative;
		width: 42px;
		height: 24px;
		border-radius: 999px;
		background: var(--agenda-icon-muted);
		flex-shrink: 0;
		transition: background 0.25s ease;
	}

	.status-knob {
		position: absolute;
		top: 3px;
		left: 3px;
		width: 18px;
		height: 18px;
		border-radius: 50%;
		background: var(--agenda-card);
		box-shadow: 0 1px 4px rgba(0, 0, 0, 0.25);
		transition: transform 0.25s cubic-bezier(0.4, 0, 0.2, 1);
	}

	.status-toggle.is-active .status-switch { background: var(--agenda-success); }
	.status-toggle.is-active .status-knob { transform: translateX(18px); }

	/* Footer form */
	.form-footer {
		display: flex;
		align-items: center;
		justify-content: flex-end;
		gap: 12px;
		padding: 18px 24px;
		background: var(--agenda-subtle);
		border-top: 1px solid var(--agenda-border);
	}

<?php endif; ?>
	/* ===================== RESPONSIF ===================== */
	@media (max-width: 768px) {
		.page-header-custom {
			flex-direction: column;
			align-items: stretch;
			padding: 18px;
		}

		.btn-add,
		.btn-back {
			width: 100%;
		}

		.card-title-custom { padding: 16px 18px; }
<?php if ($assets_form): ?>

		.card-body-custom { padding: 20px 18px; }

		.form-footer {
			flex-direction: column-reverse;
			align-items: stretch;
			padding: 16px 18px;
		}

		.btn-cancel,
		.btn-save {
			width: 100%;
		}
<?php endif; ?>
	}

	/* ===================== REDUCED MOTION ===================== */
	@media (prefers-reduced-motion: reduce) {
		.page-header-custom,
		.custom-card,
		.alert.alert-autodismiss,
		.alert-progress-bar,
		.page-header-icon,
		.btn-add,
		.btn-save,
		.btn-save-spinner,
		.btn-back {
			animation: none !important;
			transition: none !important;
		}
<?php if ($assets_form): ?>

		.status-toggle,
		.status-toggle-icon,
		.status-switch,
		.status-knob,
		.form-control,
		.input-icon-group .input-icon {
			transition: none !important;
		}
<?php endif; ?>
	}
</style>

<script>
	document.addEventListener('DOMContentLoaded', function () {

		/* ---------- Flash message: auto-dismiss ---------- */
		document.querySelectorAll('.alert-autodismiss').forEach(function (alertEl) {
			var duration = parseInt(alertEl.getAttribute('data-autodismiss'), 10) || 5000;
			var bar = alertEl.querySelector('.alert-progress-bar');
			if (bar) bar.style.animationDuration = duration + 'ms';

			var dismissed = false;

			function closeAlert() {
				if (dismissed) return;
				dismissed = true;
				alertEl.style.maxHeight = alertEl.offsetHeight + 'px';
				void alertEl.offsetHeight; // paksa reflow agar transisi max-height berjalan
				alertEl.classList.add('alert-hiding');
				setTimeout(function () {
					if (alertEl.parentNode) alertEl.parentNode.removeChild(alertEl);
				}, 380);
			}

			var remaining = duration;
			var startedAt = Date.now();
			var timer = setTimeout(closeAlert, remaining);

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
<?php if ($assets_form): ?>

		/* ---------- Toggle status keaktifan ---------- */
		var toggle = document.getElementById('status-toggle');
		var statusInput = document.getElementById('status-input');

		if (toggle && statusInput) {
			var statusIcon = document.getElementById('status-icon');
			var statusText = document.getElementById('status-text');
			var statusDesc = document.getElementById('status-desc');

			var setStatus = function (active) {
				toggle.classList.toggle('is-active', active);
				toggle.setAttribute('aria-checked', active ? 'true' : 'false');
				statusInput.value = active ? 'aktif' : 'nonaktif';
				statusIcon.className = 'fa-solid ' + (active ? 'fa-circle-check' : 'fa-circle-xmark');
				statusText.textContent = active ? 'Aktif' : 'Nonaktif';
				statusDesc.textContent = active ? 'Agenda sedang berlaku' : 'Agenda tidak berlaku';
			};

			toggle.addEventListener('click', function () {
				setStatus(statusInput.value !== 'aktif');
			});

			toggle.addEventListener('keydown', function (e) {
				if (e.key === 'Enter' || e.key === ' ' || e.key === 'Spacebar') {
					e.preventDefault();
					toggle.click();
				}
			});
		}

		/* ---------- Penghitung karakter deskripsi ---------- */
		var deskripsiInput = document.getElementById('deskripsi-input');
		var deskripsiCount = document.getElementById('deskripsi-count');

		if (deskripsiInput && deskripsiCount) {
			var updateCount = function () {
				deskripsiCount.textContent = deskripsiInput.value.length;
			};
			deskripsiInput.addEventListener('input', updateCount);
			updateCount();
		}

		/* ---------- Loading state tombol simpan ---------- */
		var formAgenda = document.getElementById('form-agenda');
		var btnSubmit = document.getElementById('btn-submit-agenda');

		if (formAgenda && btnSubmit) {
			formAgenda.addEventListener('submit', function () {
				btnSubmit.classList.add('is-loading');
			});

			// Tombol "kembali" browser: pulihkan tombol dari state loading
			window.addEventListener('pageshow', function (e) {
				if (e.persisted) btnSubmit.classList.remove('is-loading');
			});
		}
<?php endif; ?>
	});
</script>