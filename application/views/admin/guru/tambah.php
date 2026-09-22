<?php $this->load->view('admin/template/header'); ?>
<?php $this->load->view('admin/template/sidebar'); ?>

<div class="main-content">
	<?php $this->load->view('admin/template/navbar'); ?>

	<div class="content-wrapper">

		<!-- FLASH ERROR MESSAGE -->
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
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			<div class="alert-progress-track"><div class="alert-progress-bar"></div></div>
		</div>
		<?php endif; ?>

		<!-- HEADER HALAMAN -->
		<div class="page-header-custom mb-4">
			<div class="d-flex align-items-center gap-3">
				<div class="page-header-icon">
					<i class="fa-solid fa-user-plus"></i>
				</div>
				<div>
					<span class="badge-header-tag mb-1">
						<i class="fa-solid fa-pen-to-square me-1"></i> Form Input
					</span>
					<h2 class="page-title">Tambah Data Guru</h2>
					<p class="page-subtitle">Isi formulir di bawah untuk menambahkan tenaga pendidik atau staff baru.
					</p>
				</div>
			</div>
			<a href="<?= site_url('admin/guru'); ?>" class="btn-back">
				<i class="fa-solid fa-arrow-left me-2"></i>
				Kembali
			</a>
		</div>

		<!-- FORM INPUT -->
		<form id="form-tambah-guru" action="<?= site_url('admin/guru/simpan'); ?>" method="POST" enctype="multipart/form-data">
			<div class="custom-card mb-4">

				<div class="card-title-custom">
					<div class="title-icon">
						<i class="fa-solid fa-address-card"></i>
					</div>
					<div>
						<h5>Informasi Pendidik</h5>
						<small>Pastikan data NIP dan NUPTK diisi sesuai dokumen resmi</small>
					</div>
				</div>

				<div class="card-body-custom">
					<div class="row g-4">

						<!-- NAMA LENGKAP -->
						<div class="col-md-8">
							<label class="form-label required">Nama Lengkap</label>
							<div class="input-icon-group">
								<i class="fa-solid fa-user input-icon"></i>
								<input type="text" name="nama" class="form-control with-icon"
									placeholder="Masukkan nama lengkap beserta gelar..." required>
							</div>
						</div>

						<!-- JENIS KELAMIN -->
						<div class="col-md-4">
							<label class="form-label">Jenis Kelamin</label>
							<div class="gender-selector">
								<label class="gender-option">
									<input type="radio" name="jenis_kelamin" value="L">
									<div class="gender-box">
										<i class="fa-solid fa-mars"></i>
										<span>Laki-laki</span>
									</div>
								</label>
								<label class="gender-option">
									<input type="radio" name="jenis_kelamin" value="P">
									<div class="gender-box">
										<i class="fa-solid fa-venus"></i>
										<span>Perempuan</span>
									</div>
								</label>
							</div>
						</div>

						<!-- NIP -->
						<div class="col-md-6">
							<label class="form-label">NIP (Nomor Induk Pegawai)</label>
							<div class="input-icon-group">
								<i class="fa-solid fa-id-card input-icon"></i>
								<input type="text" name="nip" class="form-control with-icon font-monospace"
									placeholder="19xxxxxxxxxxxxxx">
							</div>
						</div>

						<!-- NUPTK -->
						<div class="col-md-6">
							<label class="form-label">NUPTK</label>
							<div class="input-icon-group">
								<i class="fa-solid fa-id-badge input-icon"></i>
								<input type="text" name="nuptk" class="form-control with-icon font-monospace"
									placeholder="xxxxxxxxxxxxxxxx">
							</div>
						</div>

						<!-- JABATAN -->
						<div class="col-md-6">
							<label class="form-label">Jabatan</label>
							<div class="input-icon-group">
								<i class="fa-solid fa-briefcase input-icon"></i>
								<input type="text" name="jabatan" class="form-control with-icon"
									placeholder="Contoh: Guru Pengajar / Kepala Sekolah / Staff TU">
							</div>
						</div>

						<!-- MATA PELAJARAN -->
						<div class="col-md-6">
							<label class="form-label">Mata Pelajaran</label>
							<div class="input-icon-group">
								<i class="fa-solid fa-book-open input-icon"></i>
								<input type="text" name="mata_pelajaran" class="form-control with-icon"
									placeholder="Contoh: Bahasa Indonesia, Matematika">
							</div>
						</div>

						<!-- UPLOAD FOTO DARI DEVICE -->
						<div class="col-md-12">
							<label class="form-label">Upload Foto / Avatar Guru</label>
							<div class="upload-dropzone" onclick="document.getElementById('fotoInput').click();">
								<input type="file" name="foto" id="fotoInput" class="d-none"
									accept="image/png, image/jpeg, image/jpg, image/webp">

								<div class="upload-content text-center" id="uploadPlaceholder">
									<div class="upload-icon-circle mb-2">
										<i class="fa-solid fa-cloud-arrow-up"></i>
									</div>
									<p class="upload-text mb-1"><strong>Klik atau seret file ke sini untuk
											mengunggah</strong></p>
									<span class="upload-subtext">PNG, JPG, JPEG, atau WEBP (Maksimal 2MB)</span>
								</div>

								<div class="preview-container d-none text-center" id="previewWrapper">
									<img id="imgPreview" src="#" alt="Preview Foto" class="preview-avatar mb-2">
									<div class="d-flex align-items-center justify-content-center gap-2">
										<span class="preview-filename text-truncate"
											id="previewFilename">foto.jpg</span>
										<span class="badge bg-primary fs-8">Ganti Foto</span>
									</div>
								</div>
							</div>
						</div>

						<!-- DESKRIPSI -->
						<div class="col-md-12">
							<label class="form-label">Deskripsi / Profil Brief</label>
							<textarea name="deskripsi" class="form-control custom-textarea" rows="4"
								placeholder="Tuliskan latar belakang singkat, prestasi, atau kata pengantar guru..."></textarea>
						</div>

						<!-- STATUS KEAKTIFAN -->
						<div class="col-md-4">
							<label class="form-label">Status Keaktifan</label>
							<select name="status" class="form-select custom-select">
								<option value="aktif">🟢 Aktif Mengajar</option>
								<option value="nonaktif">🔴 Nonaktif / Cuti</option>
							</select>
						</div>

					</div>
				</div>

				<!-- FOOTER / BUTTONS -->
				<div class="form-footer">
					<a href="<?= site_url('admin/guru'); ?>" class="btn-cancel">
						<i class="fa-solid fa-xmark me-2"></i> Batal
					</a>
					<button type="submit" id="btn-submit-guru" class="btn-save">
						<span class="btn-save-content">
							<i class="fa-solid fa-floppy-disk me-2"></i>
							Simpan Data Guru
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
		--guru-icon-muted: #94a3b8;
		--dropzone-bg: #f1f5f9;
		--dropzone-border: #cbd5e1;
	}

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
		--guru-icon-muted: #64748b;
		--dropzone-bg: #111827;
		--dropzone-border: rgba(255, 255, 255, 0.15);
	}

	.fs-7 {
		font-size: 13px;
	}

	.fs-8 {
		font-size: 11px;
	}

	/* Alert Custom Danger */
	.alert-custom-danger {
		background: rgba(239, 68, 68, 0.12);
		border: 1px solid rgba(239, 68, 68, 0.25);
		color: #ef4444;
		border-radius: 16px;
		padding: 16px 20px;
		backdrop-filter: blur(8px);
	}

	[data-theme="dark"] .alert-custom-danger,
	body.dark-mode .alert-custom-danger {
		color: #f87171;
	}

	.alert-icon-box {
		width: 36px;
		height: 36px;
		border-radius: 10px;
		background: rgba(239, 68, 68, 0.2);
		display: flex;
		align-items: center;
		justify-content: center;
		font-size: 18px;
		flex-shrink: 0;
	}

	/* Page Header */
	.page-header-custom {
		background: var(--guru-card-bg);
		border: 1px solid var(--guru-border);
		border-radius: 20px;
		padding: 22px 28px;
		display: flex;
		align-items: center;
		justify-content: space-between;
		box-shadow: var(--guru-shadow);
		gap: 20px;
	}

	.badge-header-tag {
		display: inline-flex;
		align-items: center;
		background: rgba(14, 165, 233, 0.1);
		color: var(--guru-accent);
		border: 1px solid rgba(14, 165, 233, 0.2);
		padding: 4px 12px;
		border-radius: 20px;
		font-size: 11px;
		font-weight: 700;
		text-transform: uppercase;
		letter-spacing: 0.5px;
	}

	.page-title {
		color: var(--guru-title);
		font-size: 22px;
		font-weight: 800;
		margin: 0 0 2px;
		letter-spacing: -0.3px;
	}

	.page-subtitle {
		color: var(--guru-subtitle);
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
	}

	.btn-back {
		display: inline-flex;
		align-items: center;
		background: var(--guru-card-subtle);
		color: var(--guru-title);
		border: 1px solid var(--guru-border);
		text-decoration: none;
		padding: 10px 20px;
		border-radius: 12px;
		font-size: 13px;
		font-weight: 600;
		transition: all 0.25s ease;
	}

	.btn-back:hover {
		background: var(--guru-hover);
		color: var(--guru-accent);
		transform: translateX(-3px);
	}

	/* Custom Cards */
	.custom-card {
		background: var(--guru-card-bg);
		border: 1px solid var(--guru-border);
		border-radius: 20px;
		overflow: hidden;
		box-shadow: var(--guru-shadow);
	}

	.card-title-custom {
		display: flex;
		align-items: center;
		gap: 14px;
		padding: 18px 24px;
		background: var(--guru-card-subtle);
		border-bottom: 1px solid var(--guru-border);
	}

	.title-icon {
		width: 40px;
		height: 40px;
		background: rgba(14, 165, 233, 0.12);
		border-radius: 12px;
		color: var(--guru-accent);
		display: flex;
		align-items: center;
		justify-content: center;
		font-size: 16px;
		flex-shrink: 0;
	}

	.card-title-custom h5 {
		margin: 0 0 2px;
		color: var(--guru-title);
		font-size: 15px;
		font-weight: 700;
	}

	.card-title-custom small {
		color: var(--guru-subtitle);
		font-size: 12px;
	}

	.card-body-custom {
		padding: 24px;
	}

	/* Form Elements & Inputs */
	.form-label {
		color: var(--guru-title);
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
		color: var(--guru-icon-muted);
		font-size: 14px;
		pointer-events: none;
		transition: color 0.25s ease;
	}

	.form-control,
	.form-select {
		background-color: var(--guru-input-bg);
		border: 1px solid var(--guru-input-border);
		border-radius: 12px;
		font-size: 13.5px;
		color: var(--guru-input-color);
		padding: 10px 16px;
		transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
	}

	.form-control.with-icon {
		padding-left: 42px;
	}

	.form-control:focus,
	.form-select:focus {
		background-color: var(--guru-input-focus-bg);
		border-color: var(--guru-accent);
		color: var(--guru-input-color);
		box-shadow: 0 0 0 4px var(--guru-accent-glow);
		outline: none;
	}

	.input-icon-group .form-control:focus+.input-icon,
	.input-icon-group:focus-within .input-icon {
		color: var(--guru-accent);
	}

	.form-control::placeholder {
		color: var(--guru-subtitle);
		opacity: 0.6;
	}

	/* Dropzone Style Photo Upload */
	.upload-dropzone {
		border: 2px dashed var(--dropzone-border);
		background-color: var(--dropzone-bg);
		border-radius: 16px;
		padding: 24px;
		cursor: pointer;
		transition: all 0.25s ease;
	}

	.upload-dropzone:hover {
		border-color: var(--guru-accent);
		background-color: var(--guru-card-subtle);
	}

	.upload-icon-circle {
		width: 44px;
		height: 44px;
		border-radius: 50%;
		background: rgba(14, 165, 233, 0.12);
		color: var(--guru-accent);
		display: inline-flex;
		align-items: center;
		justify-content: center;
		font-size: 18px;
	}

	.upload-text {
		color: var(--guru-title);
		font-size: 13.5px;
	}

	.upload-subtext {
		color: var(--guru-subtitle);
		font-size: 11.5px;
	}

	.preview-avatar {
		width: 84px;
		height: 84px;
		object-fit: cover;
		border-radius: 50%;
		border: 3px solid var(--guru-accent);
		box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
	}

	.preview-filename {
		max-width: 200px;
		font-size: 12px;
		color: var(--guru-title);
	}

	/* Gender Selector */
	.gender-selector {
		display: grid;
		grid-template-columns: 1fr 1fr;
		gap: 10px;
	}

	.gender-option input {
		display: none;
	}

	.gender-box {
		display: flex;
		align-items: center;
		justify-content: center;
		gap: 8px;
		padding: 10px 14px;
		background: var(--guru-input-bg);
		border: 1px solid var(--guru-input-border);
		border-radius: 12px;
		cursor: pointer;
		font-size: 13px;
		font-weight: 600;
		color: var(--guru-subtitle);
		transition: all 0.2s ease;
	}

	.gender-option input:checked+.gender-box {
		background: rgba(14, 165, 233, 0.12);
		border-color: var(--guru-accent);
		color: var(--guru-accent);
	}

	.custom-textarea {
		resize: vertical;
		min-height: 90px;
		line-height: 1.6;
	}

	.custom-select {
		cursor: pointer;
	}

	/* Form Footer Area */
	.form-footer {
		padding: 18px 24px;
		background: var(--guru-card-subtle);
		border-top: 1px solid var(--guru-border);
		display: flex;
		align-items: center;
		justify-content: flex-end;
		gap: 12px;
	}

	.btn-cancel {
		background: var(--guru-card-bg);
		border: 1px solid var(--guru-border);
		color: var(--guru-title);
		text-decoration: none;
		border-radius: 12px;
		padding: 11px 22px;
		font-size: 13px;
		font-weight: 600;
		transition: all 0.2s ease;
	}

	.btn-cancel:hover {
		background: var(--guru-hover);
		color: #ef4444;
	}

	.btn-save {
		border: none;
		background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%);
		color: #ffffff;
		border-radius: 12px;
		padding: 11px 26px;
		font-size: 13px;
		font-weight: 700;
		transition: all 0.3s ease;
		box-shadow: 0 4px 15px rgba(2, 132, 199, 0.3);
		cursor: pointer;
	}

	.btn-save:hover {
		transform: translateY(-2px);
		box-shadow: 0 8px 22px rgba(2, 132, 199, 0.45);
		color: #ffffff;
	}

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
			justify-content: center;
			text-align: center;
		}
	}

	/* ===================== POLISH: FLASH ALERT (AUTO-DISMISS) ===================== */
	.alert-autodismiss {
		position: relative;
		overflow: hidden;
		animation: guruAlertIn 0.35s cubic-bezier(0.34, 1.56, 0.64, 1);
	}

	@keyframes guruAlertIn {
		from { opacity: 0; transform: translateY(-14px) scale(0.98); }
		to { opacity: 1; transform: translateY(0) scale(1); }
	}

	.alert-autodismiss.alert-hiding {
		animation: guruAlertOut 0.35s ease forwards;
	}

	@keyframes guruAlertOut {
		to { opacity: 0; transform: translateY(-10px) scale(0.98); margin-bottom: 0 !important; max-height: 0; padding-top: 0; padding-bottom: 0; }
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
		background: #ef4444;
		transform-origin: left;
		animation-name: guruAlertProgress;
		animation-timing-function: linear;
		animation-fill-mode: forwards;
	}

	@keyframes guruAlertProgress {
		from { transform: scaleX(1); }
		to { transform: scaleX(0); }
	}

	/* ===================== POLISH: PAGE HEADER ===================== */
	.page-header-custom { position: relative; overflow: hidden; }
	.page-header-custom::before {
		content: "";
		position: absolute; inset: 0 auto 0 0;
		width: 4px;
		background: linear-gradient(180deg, var(--guru-accent), #0369a1);
	}
	.page-header-icon { transition: transform 0.35s ease; }
	.page-header-custom:hover .page-header-icon { transform: rotate(-6deg) scale(1.06); }

	/* ===================== POLISH: CARD ENTRANCE ===================== */
	.custom-card { animation: guruFadeUp 0.4s ease both; }
	@keyframes guruFadeUp {
		from { opacity: 0; transform: translateY(12px); }
		to { opacity: 1; transform: translateY(0); }
	}

	.form-control:hover:not(:focus),
	.form-select:hover:not(:focus) { border-color: var(--guru-accent); }

	/* ===================== POLISH: DROPZONE DRAG STATE ===================== */
	.upload-dropzone.dragover {
		border-color: var(--guru-accent);
		background-color: var(--guru-card-subtle);
		box-shadow: 0 0 0 4px var(--guru-accent-glow);
	}
	.upload-icon-circle { transition: transform 0.3s ease; }
	.upload-dropzone:hover .upload-icon-circle { transform: translateY(-3px); }

	/* ===================== POLISH: SAVE BUTTON LOADING STATE ===================== */
	.btn-save { position: relative; overflow: hidden; }
	.btn-save-content { display: inline-flex; align-items: center; transition: opacity 0.2s ease; }
	.btn-save.is-loading .btn-save-content { opacity: 0; }
	.btn-save.is-loading { pointer-events: none; }
	.btn-save-spinner {
		position: absolute; top: 50%; left: 50%;
		width: 18px; height: 18px; margin: -9px 0 0 -9px;
		border: 2.5px solid rgba(255, 255, 255, 0.35);
		border-top-color: #ffffff;
		border-radius: 50%;
		opacity: 0;
		animation: guruSpin 0.7s linear infinite;
	}
	.btn-save.is-loading .btn-save-spinner { opacity: 1; }

	@keyframes guruSpin { to { transform: rotate(360deg); } }

	@media (prefers-reduced-motion: reduce) {
		.alert-autodismiss, .custom-card, .page-header-icon,
		.upload-icon-circle, .btn-save-spinner { animation: none !important; transition: none !important; }
	}

</style>

<!-- SCRIPT FILE PREVIEW LENGKAP -->
<script>
	document.addEventListener('DOMContentLoaded', function () {
		const fotoInput = document.getElementById('fotoInput');
		const imgPreview = document.getElementById('imgPreview');
		const previewFilename = document.getElementById('previewFilename');
		const uploadPlaceholder = document.getElementById('uploadPlaceholder');
		const previewWrapper = document.getElementById('previewWrapper');
		const dropzone = document.querySelector('.upload-dropzone');

		function showPreview(file) {
			if (!file) return;
			const reader = new FileReader();
			reader.onload = function (event) {
				imgPreview.src = event.target.result;
				previewFilename.textContent = file.name;
				uploadPlaceholder.classList.add('d-none');
				previewWrapper.classList.remove('d-none');
			};
			reader.readAsDataURL(file);
		}

		if (fotoInput) {
			fotoInput.addEventListener('change', function (e) {
				const file = e.target.files[0];
				if (file) {
					showPreview(file);
				} else {
					imgPreview.src = '#';
					uploadPlaceholder.classList.remove('d-none');
					previewWrapper.classList.add('d-none');
				}
			});
		}

		// Highlight dropzone saat file di-drag & drop langsung ke area upload
		if (dropzone && fotoInput) {
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
				if (e.dataTransfer && e.dataTransfer.files && e.dataTransfer.files.length) {
					fotoInput.files = e.dataTransfer.files;
					showPreview(e.dataTransfer.files[0]);
				}
			});
		}

		// Auto-dismiss notifikasi error
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

		// Loading state saat form disimpan
		var formTambah = document.getElementById('form-tambah-guru');
		var btnSubmit = document.getElementById('btn-submit-guru');
		if (formTambah && btnSubmit) {
			formTambah.addEventListener('submit', function () {
				btnSubmit.classList.add('is-loading');
			});
		}
	});

</script>

<?php $this->load->view('admin/template/footer'); ?>