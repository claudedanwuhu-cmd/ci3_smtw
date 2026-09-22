<?php $this->load->view('admin/template/header'); ?>
<?php $this->load->view('admin/template/sidebar'); ?>

<!-- Leaflet CSS & JS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<div class="main-content">
    <?php $this->load->view('admin/template/navbar'); ?>

    <div class="content-wrapper">

        <!-- FLASH MESSAGE -->
        <?php if ($this->session->flashdata('success')): ?>
        <div class="alert alert-custom-success alert-dismissible fade show mb-4 alert-autodismiss" role="alert" data-autodismiss="4500">
            <div class="d-flex align-items-center gap-3">
                <div class="alert-icon-box">
                    <i class="fa-solid fa-circle-check"></i>
                </div>
                <div>
                    <h6 class="alert-heading mb-0">Berhasil!</h6>
                    <span class="fs-7"><?= $this->session->flashdata('success'); ?></span>
                </div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            <div class="alert-progress-track"><div class="alert-progress-bar"></div></div>
        </div>
        <?php endif; ?>

        <?php if ($this->session->flashdata('error')): ?>
        <div class="alert alert-custom-error alert-dismissible fade show mb-4 alert-autodismiss" role="alert" data-autodismiss="5500">
            <div class="d-flex align-items-center gap-3">
                <div class="alert-icon-box alert-icon-box-error">
                    <i class="fa-solid fa-circle-exclamation"></i>
                </div>
                <div>
                    <h6 class="alert-heading mb-0">Gagal!</h6>
                    <span class="fs-7"><?= $this->session->flashdata('error'); ?></span>
                </div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            <div class="alert-progress-track"><div class="alert-progress-bar alert-progress-bar-error"></div></div>
        </div>
        <?php endif; ?>

        <!-- HEADER HALAMAN -->
        <div class="page-header-custom mb-4">
            <div class="d-flex align-items-center gap-3">
                <div class="page-header-icon">
                    <i class="fa-solid fa-school"></i>
                </div>
                <div>
                    <span class="badge-header-tag mb-1">
                        <i class="fa-solid fa-sliders me-1"></i> Pengaturan Utama
                    </span>
                    <h2 class="page-title">Profil Sekolah</h2>
                    <p class="page-subtitle">Kelola informasi utama, lokasi peta, dan identitas resmi sekolah.</p>
                </div>
            </div>
        </div>

        <form id="form-profil-sekolah" action="<?= site_url('admin/profil/update'); ?>" method="POST" enctype="multipart/form-data">

            <!-- IDENTITAS SEKOLAH -->
            <div class="custom-card mb-4">
                <div class="card-title-custom">
                    <div class="title-icon icon-blue">
                        <i class="fa-solid fa-building-columns"></i>
                    </div>
                    <div>
                        <h5>Identitas Sekolah</h5>
                        <small>Informasi dasar registrasi dan kontak resmi sekolah</small>
                    </div>
                </div>

                <div class="card-body-custom">
                    <div class="row g-4">
                        <div class="col-md-8">
                            <label class="form-label">Nama Sekolah <span class="text-danger">*</span></label>
                            <div class="input-icon-group">
                                <i class="fa-solid fa-graduation-cap input-icon"></i>
                                <input type="text" name="nama_sekolah" class="form-control with-icon"
                                    value="<?= htmlspecialchars($profil->nama_sekolah ?? ''); ?>"
                                    placeholder="Masukkan nama sekolah" required>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">NPSN</label>
                            <div class="input-icon-group">
                                <i class="fa-solid fa-id-card input-icon"></i>
                                <input type="text" name="npsn" class="form-control with-icon"
                                    value="<?= htmlspecialchars($profil->npsn ?? ''); ?>"
                                    placeholder="Contoh: 12345678">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">NSS</label>
                            <div class="input-icon-group">
                                <i class="fa-solid fa-hashtag input-icon"></i>
                                <input type="text" name="nss" class="form-control with-icon"
                                    value="<?= htmlspecialchars($profil->nss ?? ''); ?>"
                                    placeholder="Nomor Statistik Sekolah">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Telepon</label>
                            <div class="input-icon-group">
                                <i class="fa-solid fa-phone input-icon"></i>
                                <input type="text" name="telepon" class="form-control with-icon"
                                    value="<?= htmlspecialchars($profil->telepon ?? ''); ?>"
                                    placeholder="Nomor telepon sekolah">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Email</label>
                            <div class="input-icon-group">
                                <i class="fa-solid fa-envelope input-icon"></i>
                                <input type="email" name="email" class="form-control with-icon"
                                    value="<?= htmlspecialchars($profil->email ?? ''); ?>"
                                    placeholder="email@sekolah.sch.id">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <label class="form-label">Website Resmi</label>
                            <div class="input-icon-group">
                                <i class="fa-solid fa-globe input-icon"></i>
                                <input type="text" name="website" class="form-control with-icon"
                                    value="<?= htmlspecialchars($profil->website ?? ''); ?>"
                                    placeholder="https://www.sekolah.sch.id">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ALAMAT & LOKASI PETA -->
            <div class="custom-card mb-4">
                <div class="card-title-custom">
                    <div class="title-icon icon-emerald">
                        <i class="fa-solid fa-location-dot"></i>
                    </div>
                    <div>
                        <h5>Alamat & Titik Lokasi Peta</h5>
                        <small>Cari nama tempat, isi koordinat manual, atau klik/geser pin pada peta</small>
                    </div>
                </div>

                <div class="card-body-custom">
                    <div class="row g-4">
                        <!-- SEARCH & PETA INTERAKTIF -->
                        <div class="col-md-12">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <label class="form-label mb-0">Pilih Lokasi Sekolah pada Peta</label>
                                <small class="text-accent"><i class="fa-solid fa-circle-info me-1"></i>Klik/cari lokasi untuk mengisi alamat otomatis</small>
                            </div>

                            <!-- TOMBOL & INPUT SEARCH PETA -->
                            <div class="input-group search-map-group mb-3">
                                <span class="input-group-text style-search-icon">
                                    <i class="fa-solid fa-magnifying-glass search-icon-color"></i>
                                </span>
                                <input type="text" id="map-search-input" class="form-control input-search-map" placeholder="Cari lokasi/alamat di peta (contoh: Kartasura, Surakarta, dll)...">
                                <button class="btn btn-primary px-4 fw-bold btn-search-map" type="button" id="btn-map-search">
                                    <i class="fa-solid fa-search me-1"></i> Cari
                                </button>
                            </div>

                            <div id="map" class="map-container mb-3"></div>
                        </div>

                        <!-- INPUT KOORDINAT LATITUDE & LONGITUDE (MANUAL INPUT) -->
                        <div class="col-md-6">
                            <label class="form-label">Latitude</label>
                            <div class="input-icon-group">
                                <i class="fa-solid fa-map-pin input-icon"></i>
                                <input type="text" name="latitude" id="latitude" class="form-control with-icon"
                                    value="<?= htmlspecialchars($profil->latitude ?? ''); ?>"
                                    placeholder="Contoh: -7.5592">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Longitude</label>
                            <div class="input-icon-group">
                                <i class="fa-solid fa-location-crosshairs input-icon"></i>
                                <input type="text" name="longitude" id="longitude" class="form-control with-icon"
                                    value="<?= htmlspecialchars($profil->longitude ?? ''); ?>"
                                    placeholder="Contoh: 110.7719">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <label class="form-label">Alamat Lengkap (Jalan, RT/RW)</label>
                            <textarea name="alamat" id="alamat" class="form-control custom-textarea" rows="3"
                                placeholder="Klik peta di atas atau tuliskan alamat lengkap..."><?= htmlspecialchars($profil->alamat ?? ''); ?></textarea>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Desa / Kelurahan</label>
                            <input type="text" name="desa" id="desa" class="form-control"
                                value="<?= htmlspecialchars($profil->desa ?? ''); ?>"
                                placeholder="Nama desa / kelurahan">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Kecamatan</label>
                            <input type="text" name="kecamatan" id="kecamatan" class="form-control"
                                value="<?= htmlspecialchars($profil->kecamatan ?? ''); ?>" placeholder="Nama kecamatan">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Kabupaten / Kota</label>
                            <input type="text" name="kabupaten" id="kabupaten" class="form-control"
                                value="<?= htmlspecialchars($profil->kabupaten ?? ''); ?>"
                                placeholder="Nama kabupaten / kota">
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Provinsi</label>
                            <input type="text" name="provinsi" id="provinsi" class="form-control"
                                value="<?= htmlspecialchars($profil->provinsi ?? ''); ?>" placeholder="Provinsi">
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Kode Pos</label>
                            <input type="text" name="kode_pos" id="kode_pos" class="form-control"
                                value="<?= htmlspecialchars($profil->kode_pos ?? ''); ?>" placeholder="Kode Pos">
                        </div>
                    </div>
                </div>
            </div>

            <!-- PROFIL SEKOLAH -->
            <div class="custom-card mb-4">
                <div class="card-title-custom">
                    <div class="title-icon icon-purple">
                        <i class="fa-solid fa-book-open"></i>
                    </div>
                    <div>
                        <h5>Sejarah & Visi Misi</h5>
                        <small>Uraian historis serta tujuan strategis lembaga</small>
                    </div>
                </div>

                <div class="card-body-custom">
                    <div class="mb-4">
                        <label class="form-label">Sejarah Sekolah</label>
                        <textarea name="sejarah" class="form-control custom-textarea" rows="5"
                            placeholder="Tuliskan sejarah berdirinya sekolah..."><?= htmlspecialchars($profil->sejarah ?? ''); ?></textarea>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Visi Sekolah</label>
                        <textarea name="visi" class="form-control custom-textarea" rows="3"
                            placeholder="Tuliskan visi sekolah..."><?= htmlspecialchars($profil->visi ?? ''); ?></textarea>
                    </div>

                    <div>
                        <label class="form-label">Misi Sekolah</label>
                        <textarea name="misi" class="form-control custom-textarea" rows="5"
                            placeholder="Tuliskan poin-poin misi sekolah..."><?= htmlspecialchars($profil->misi ?? ''); ?></textarea>
                    </div>
                </div>
            </div>

            <!-- SAMBUTAN KEPALA SEKOLAH -->
            <div class="custom-card mb-4">
                <div class="card-title-custom">
                    <div class="title-icon icon-amber">
                        <i class="fa-solid fa-user-tie"></i>
                    </div>
                    <div>
                        <h5>Kepala Sekolah</h5>
                        <small>Informasi pimpinan sekolah dan kata sambutan</small>
                    </div>
                </div>

                <div class="card-body-custom">
                    <div class="row g-4">
                        <div class="col-md-5">
                            <div class="mb-3">
                                <label class="form-label">Nama Kepala Sekolah</label>
                                <div class="input-icon-group">
                                    <i class="fa-solid fa-user input-icon"></i>
                                    <input type="text" name="nama_kepala" class="form-control with-icon"
                                        value="<?= htmlspecialchars($profil->nama_kepala ?? ''); ?>"
                                        placeholder="Nama lengkap beserta gelar">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Foto Kepala Sekolah</label>
                                <div class="upload-dropzone" onclick="document.getElementById('foto_kepala_input').click();">
                                    <input type="file" name="foto_kepala" id="foto_kepala_input" accept="image/*"
                                        class="d-none" onchange="previewKepalaPhoto(this)">

                                    <div class="upload-content text-center <?= !empty($profil->foto_kepala) ? 'd-none' : ''; ?>" id="upload_placeholder">
                                        <div class="upload-icon-circle mb-2">
                                            <i class="fa-solid fa-cloud-arrow-up"></i>
                                        </div>
                                        <p class="upload-text mb-1"><strong>Klik untuk unggah foto</strong></p>
                                        <span class="upload-subtext">PNG, JPG, JPEG, atau WEBP (Maks. 2MB)</span>
                                    </div>

                                    <div class="preview-container <?= empty($profil->foto_kepala) ? 'd-none' : ''; ?> text-center" id="preview_wrapper">
                                        <img id="image_preview_img" src="<?= !empty($profil->foto_kepala) ? base_url('assets/img/' . ltrim($profil->foto_kepala, '/')) : '#'; ?>" alt="Preview Foto" class="preview-avatar mb-2">
                                        <div class="d-flex align-items-center justify-content-center gap-2">
                                            <span class="preview-filename text-truncate" id="preview_filename"><?= !empty($profil->foto_kepala) ? html_escape(basename($profil->foto_kepala)) : 'foto.jpg'; ?></span>
                                            <span class="badge bg-primary fs-8">Ganti Foto</span>
                                        </div>
                                    </div>
                                </div>

                                <?php if (!empty($profil->foto_kepala)): ?>
                                <div class="current-photo-info mt-2">
                                    <i class="fa-solid fa-image text-muted me-1"></i>
                                    <span class="text-subtle">Foto aktif: </span>
                                    <a href="<?= base_url('assets/img/' . ltrim($profil->foto_kepala, '/')); ?>" target="_blank"
                                        class="fw-bold text-accent text-decoration-none">Lihat Foto</a>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="col-md-7">
                            <label class="form-label">Sambutan Kepala Sekolah</label>
                            <textarea name="sambutan_kepala" class="form-control custom-textarea" rows="8"
                                placeholder="Tuliskan kata sambutan kepala sekolah..."><?= htmlspecialchars($profil->sambutan_kepala ?? ''); ?></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ACTION SAVE AREA -->
            <div class="save-area mb-5">
                <div class="save-info">
                    <div class="save-icon-circle">
                        <i class="fa-solid fa-shield-halved"></i>
                    </div>
                    <div>
                        <strong>Verifikasi & Simpan Data</strong>
                        <p class="mb-0 text-subtle">Pastikan seluruh entri data dan lokasi peta telah sesuai.</p>
                    </div>
                </div>
                <button type="submit" id="btn-submit-profil" class="btn-save">
                    <span class="btn-save-content">
                        <i class="fa-solid fa-floppy-disk me-2"></i> Simpan Perubahan
                    </span>
                    <span class="btn-save-spinner"></span>
                </button>
            </div>

        </form>
    </div>
</div>

<style>
    :root {
        --prof-card-bg: #ffffff;
        --prof-card-subtle: #f8fafc;
        --prof-border: rgba(226, 232, 240, 0.8);
        --prof-title: #0f172a;
        --prof-subtitle: #64748b;
        --prof-input-bg: #ffffff;
        --prof-input-border: #cbd5e1;
        --prof-input-color: #0f172a;
        --prof-placeholder: #94a3b8;
        --prof-input-focus-bg: #ffffff;
        --prof-shadow: 0 10px 25px -5px rgba(15, 23, 42, 0.05);
        --prof-accent: #0ea5e9;
        --prof-accent-glow: rgba(14, 165, 233, 0.25);
        --prof-icon-muted: #64748b;
        --dropzone-bg: #f1f5f9;
        --dropzone-border: #cbd5e1;
    }

    [data-theme="dark"], body.dark-mode {
        --prof-card-bg: #0f172a;
        --prof-card-subtle: #1e293b;
        --prof-border: rgba(255, 255, 255, 0.08);
        --prof-title: #f8fafc;
        --prof-subtitle: #94a3b8;
        --prof-input-bg: #1e293b;
        --prof-input-border: rgba(255, 255, 255, 0.18);
        --prof-input-color: #f8fafc;
        --prof-placeholder: #94a3b8; /* Kontras terang di dark mode */
        --prof-input-focus-bg: #111827;
        --prof-shadow: 0 12px 30px -5px rgba(0, 0, 0, 0.4);
        --prof-accent: #38bdf8;
        --prof-accent-glow: rgba(56, 189, 248, 0.25);
        --prof-icon-muted: #94a3b8;
        --dropzone-bg: #111827;
        --dropzone-border: rgba(255, 255, 255, 0.15);
    }

    /* PETA & DARK MODE MAP */
    .map-container {
        height: 360px;
        width: 100%;
        border-radius: 16px;
        border: 2px solid var(--prof-border);
        box-shadow: var(--prof-shadow);
        z-index: 1;
        transition: all 0.3s ease;
    }

    [data-theme="dark"] .leaflet-tile-pane,
    body.dark-mode .leaflet-tile-pane {
        filter: brightness(0.6) invert(1) contrast(3) hue-rotate(200deg) saturate(0.3);
    }

    [data-theme="dark"] .leaflet-marker-pane,
    [data-theme="dark"] .leaflet-popup-pane,
    body.dark-mode .leaflet-marker-pane,
    body.dark-mode .leaflet-popup-pane {
        filter: none !important;
    }

    [data-theme="dark"] .leaflet-control-zoom a,
    body.dark-mode .leaflet-control-zoom a {
        background-color: #1e293b !important;
        color: #f8fafc !important;
        border-color: rgba(255, 255, 255, 0.1) !important;
    }

    [data-theme="dark"] .leaflet-container,
    body.dark-mode .leaflet-container {
        background: #0f172a !important;
    }

    /* INPUT SEARCH GROUP STYLING FIX */
    .search-map-group {
        border-radius: 12px;
        box-shadow: none;
    }

    .style-search-icon {
        background-color: var(--prof-input-bg) !important;
        border: 1px solid var(--prof-input-border) !important;
        border-right: none !important;
        border-top-left-radius: 12px !important;
        border-bottom-left-radius: 12px !important;
        padding-left: 14px;
        padding-right: 6px;
    }

    .search-icon-color {
        color: var(--prof-icon-muted) !important;
    }

    .input-search-map {
        background-color: var(--prof-input-bg) !important;
        border: 1px solid var(--prof-input-border) !important;
        border-left: none !important;
        border-top-right-radius: 0 !important;
        border-bottom-right-radius: 0 !important;
        color: var(--prof-input-color) !important;
        font-size: 13.5px;
    }

    .btn-search-map {
        border-top-right-radius: 12px !important;
        border-bottom-right-radius: 12px !important;
    }

    .search-map-group:focus-within .style-search-icon {
        border-color: var(--prof-accent) !important;
    }

    .search-map-group:focus-within .input-search-map {
        border-color: var(--prof-accent) !important;
        box-shadow: none !important;
    }

    .text-subtle { color: var(--prof-subtitle) !important; }
    .text-accent { color: var(--prof-accent) !important; }
    .fs-7 { font-size: 13px; }
    .fs-8 { font-size: 11px; }

    .alert-custom-success {
        background: rgba(16, 185, 129, 0.12);
        border: 1px solid rgba(16, 185, 129, 0.25);
        color: #10b981;
        border-radius: 16px;
        padding: 16px 20px;
    }

    .alert-icon-box {
        width: 36px; height: 36px; border-radius: 10px;
        background: rgba(16, 185, 129, 0.2);
        display: flex; align-items: center; justify-content: center; font-size: 18px;
    }

    .page-header-custom {
        background: var(--prof-card-bg);
        border: 1px solid var(--prof-border);
        border-radius: 20px;
        padding: 22px 28px;
        box-shadow: var(--prof-shadow);
    }

    .badge-header-tag {
        display: inline-flex; align-items: center;
        background: rgba(14, 165, 233, 0.1);
        color: var(--prof-accent);
        border: 1px solid rgba(14, 165, 233, 0.2);
        padding: 4px 12px; border-radius: 20px;
        font-size: 11px; font-weight: 700;
    }

    .page-title { color: var(--prof-title); font-size: 22px; font-weight: 800; margin-bottom: 2px; }
    .page-subtitle { color: var(--prof-subtitle); font-size: 13px; margin-bottom: 0; }

    .page-header-icon {
        width: 50px; height: 50px; border-radius: 14px;
        background: var(--prof-card-subtle);
        border: 1px solid var(--prof-border);
        color: var(--prof-accent);
        display: flex; align-items: center; justify-content: center; font-size: 22px;
    }

    .custom-card {
        background: var(--prof-card-bg);
        border: 1px solid var(--prof-border);
        border-radius: 20px; overflow: hidden; box-shadow: var(--prof-shadow);
    }

    .card-title-custom {
        display: flex; align-items: center; gap: 14px;
        padding: 18px 24px; border-bottom: 1px solid var(--prof-border);
        background: var(--prof-card-subtle);
    }

    .title-icon {
        width: 40px; height: 40px; border-radius: 12px;
        display: flex; align-items: center; justify-content: center; font-size: 16px;
    }

    .icon-blue { background: rgba(37, 99, 235, 0.12); color: #3b82f6; }
    .icon-emerald { background: rgba(16, 185, 129, 0.12); color: #10b981; }
    .icon-purple { background: rgba(168, 85, 247, 0.12); color: #a855f7; }
    .icon-amber { background: rgba(245, 158, 11, 0.12); color: #f59e0b; }

    .card-title-custom h5 { margin: 0 0 2px; color: var(--prof-title); font-size: 15px; font-weight: 700; }
    .card-title-custom small { color: var(--prof-subtitle); font-size: 12px; }
    .card-body-custom { padding: 24px; }

    .form-label { color: var(--prof-title); font-size: 12.5px; font-weight: 700; margin-bottom: 8px; }

    .input-icon-group { position: relative; display: flex; align-items: center; }
    .input-icon-group .input-icon { position: absolute; left: 14px; color: var(--prof-icon-muted); font-size: 14px; pointer-events: none; z-index: 2; }

    .form-control {
        background-color: var(--prof-input-bg);
        border: 1px solid var(--prof-input-border);
        border-radius: 12px; font-size: 13.5px; color: var(--prof-input-color);
        padding: 10px 16px; transition: all 0.25s ease;
    }

    /* PLACEHOLDER COLOR FIX */
    .form-control::placeholder,
    ::placeholder {
        color: var(--prof-placeholder) !important;
        opacity: 0.85 !important;
    }

    .form-control.with-icon { padding-left: 42px; }

    .form-control:focus {
        background-color: var(--prof-input-focus-bg);
        border-color: var(--prof-accent); color: var(--prof-input-color);
        box-shadow: 0 0 0 4px var(--prof-accent-glow); outline: none;
    }

    .input-icon-group .form-control:focus+.input-icon,
    .input-icon-group:focus-within .input-icon { color: var(--prof-accent); }

    .custom-textarea { resize: vertical; min-height: 90px; line-height: 1.6; }

    .upload-dropzone {
        border: 2px dashed var(--dropzone-border); background-color: var(--dropzone-bg);
        border-radius: 16px; padding: 20px; cursor: pointer; transition: all 0.25s ease;
    }
    .upload-dropzone:hover { border-color: var(--prof-accent); background-color: var(--prof-card-subtle); }

    .upload-icon-circle {
        width: 42px; height: 42px; border-radius: 50%;
        background: rgba(14, 165, 233, 0.12); color: var(--prof-accent);
        display: inline-flex; align-items: center; justify-content: center; font-size: 18px;
    }

    .upload-text { color: var(--prof-title); font-size: 13px; }
    .upload-subtext { color: var(--prof-subtitle); font-size: 11px; }

    .preview-avatar { width: 80px; height: 80px; object-fit: cover; border-radius: 50%; border: 3px solid var(--prof-accent); }
    .preview-filename { max-width: 150px; font-size: 12px; color: var(--prof-title); }

    .save-area {
        background: var(--prof-card-bg); border: 1px solid var(--prof-border);
        border-radius: 20px; padding: 20px 26px; display: flex; align-items: center; justify-content: space-between; gap: 20px;
        box-shadow: var(--prof-shadow);
    }

    .save-info { display: flex; align-items: center; gap: 14px; }
    .save-icon-circle {
        width: 44px; height: 44px; border-radius: 12px;
        background: rgba(14, 165, 233, 0.12); color: var(--prof-accent);
        display: flex; align-items: center; justify-content: center; font-size: 18px;
    }
    .save-info strong { font-size: 13.5px; color: var(--prof-title); display: block; }

    .btn-save {
        border: none; background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%);
        color: #ffffff; border-radius: 12px; padding: 12px 30px; font-size: 13.5px; font-weight: 700;
        transition: all 0.3s ease; box-shadow: 0 6px 20px rgba(2, 132, 199, 0.3);
    }

    .btn-save:hover { transform: translateY(-2px); box-shadow: 0 10px 25px rgba(2, 132, 199, 0.45); color: #fff; }

    @media (max-width: 768px) {
        .save-area { flex-direction: column; align-items: stretch; }
        .btn-save { width: 100%; justify-content: center; }
    }

    /* ===================== POLISH: FLASH ALERT (AUTO-DISMISS) ===================== */
    .alert-autodismiss {
        position: relative;
        overflow: hidden;
        border-radius: 16px;
        padding: 16px 20px;
        box-shadow: var(--prof-shadow);
        animation: alertSlideIn 0.35s cubic-bezier(0.34, 1.56, 0.64, 1);
    }

    @keyframes alertSlideIn {
        from { opacity: 0; transform: translateY(-14px) scale(0.98); }
        to { opacity: 1; transform: translateY(0) scale(1); }
    }

    .alert-autodismiss.alert-hiding {
        animation: alertSlideOut 0.35s ease forwards;
    }

    @keyframes alertSlideOut {
        to { opacity: 0; transform: translateY(-10px) scale(0.98); margin-bottom: 0 !important; max-height: 0; padding-top: 0; padding-bottom: 0; }
    }

    .alert-custom-success .btn-close { filter: none; }

    .alert-custom-error {
        background: rgba(239, 68, 68, 0.1);
        border: 1px solid rgba(239, 68, 68, 0.25);
        color: #ef4444;
    }

    .alert-icon-box-error { background: rgba(239, 68, 68, 0.18); }

    .alert-progress-track {
        position: absolute;
        left: 0; right: 0; bottom: 0;
        height: 3px;
        background: rgba(148, 163, 184, 0.2);
    }

    .alert-progress-bar {
        height: 100%;
        width: 100%;
        background: #10b981;
        transform-origin: left;
        animation-name: alertProgress;
        animation-timing-function: linear;
        animation-fill-mode: forwards;
    }

    .alert-progress-bar-error { background: #ef4444; }

    @keyframes alertProgress {
        from { transform: scaleX(1); }
        to { transform: scaleX(0); }
    }

    /* ===================== POLISH: PAGE HEADER ===================== */
    .page-header-custom { position: relative; overflow: hidden; }
    .page-header-custom::before {
        content: "";
        position: absolute; inset: 0 auto 0 0;
        width: 4px;
        background: linear-gradient(180deg, var(--prof-accent), #0369a1);
    }
    .page-header-icon {
        transition: transform 0.35s ease;
    }
    .page-header-custom:hover .page-header-icon { transform: rotate(-6deg) scale(1.06); }

    /* ===================== POLISH: CARD ENTRANCE ===================== */
    .custom-card, .save-area {
        animation: cardFadeUp 0.45s ease both;
    }
    .custom-card:nth-of-type(1) { animation-delay: 0.02s; }
    .custom-card:nth-of-type(2) { animation-delay: 0.08s; }
    .custom-card:nth-of-type(3) { animation-delay: 0.14s; }
    .custom-card:nth-of-type(4) { animation-delay: 0.2s; }
    .save-area { animation-delay: 0.26s; }

    @keyframes cardFadeUp {
        from { opacity: 0; transform: translateY(14px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .custom-card {
        transition: box-shadow 0.3s ease, border-color 0.3s ease;
    }
    .custom-card:hover {
        border-color: rgba(14, 165, 233, 0.35);
        box-shadow: 0 16px 34px -10px rgba(15, 23, 42, 0.12);
    }

    .title-icon { transition: transform 0.3s ease; }
    .card-title-custom:hover .title-icon { transform: scale(1.08); }

    /* ===================== POLISH: FORM FOCUS FEEL ===================== */
    .form-control { position: relative; }
    .form-control:hover:not(:focus) { border-color: var(--prof-accent); }

    /* ===================== POLISH: UPLOAD DROPZONE DRAG STATE ===================== */
    .upload-dropzone.dragover {
        border-color: var(--prof-accent);
        background-color: var(--prof-card-subtle);
        box-shadow: 0 0 0 4px var(--prof-accent-glow);
    }
    .upload-dropzone { position: relative; }
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
        animation: spin 0.7s linear infinite;
    }
    .btn-save.is-loading .btn-save-spinner { opacity: 1; }

    @keyframes spin { to { transform: rotate(360deg); } }

    /* ===================== POLISH: SEARCH MAP BUTTON FEEDBACK ===================== */
    .btn-search-map { transition: transform 0.15s ease; }
    .btn-search-map:active { transform: scale(0.96); }

    @media (prefers-reduced-motion: reduce) {
        .alert-autodismiss, .custom-card, .save-area, .page-header-icon,
        .title-icon, .upload-icon-circle, .btn-save-spinner { animation: none !important; transition: none !important; }
    }
</style>

<script>
    // Preview Gambar Foto Kepala Sekolah
    function previewKepalaPhoto(input) {
        const file = input.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                document.getElementById('image_preview_img').src = e.target.result;
                document.getElementById('preview_filename').textContent = file.name;
                document.getElementById('upload_placeholder').classList.add('d-none');
                document.getElementById('preview_wrapper').classList.remove('d-none');
            }
            reader.readAsDataURL(file);
        }
    }

    // Auto-dismiss notifikasi flash message (sukses / gagal)
    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll('.alert-autodismiss').forEach(function (alertEl) {
            var duration = parseInt(alertEl.getAttribute('data-autodismiss'), 10) || 4500;

            // Jalankan animasi progress bar sesuai durasi
            var bar = alertEl.querySelector('.alert-progress-bar');
            if (bar) {
                bar.style.animationDuration = duration + 'ms';
            }

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

            // Jeda hitung mundur saat kursor di atas notifikasi
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

            // Tutup otomatis juga saat tombol close ditekan manual
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
        var formProfil = document.getElementById('form-profil-sekolah');
        var btnSubmit = document.getElementById('btn-submit-profil');
        if (formProfil && btnSubmit) {
            formProfil.addEventListener('submit', function () {
                btnSubmit.classList.add('is-loading');
            });
        }

        // Highlight dropzone saat file di-drag ke area upload
        var dropzone = document.querySelector('.upload-dropzone');
        var fotoInput = document.getElementById('foto_kepala_input');
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
                    previewKepalaPhoto(fotoInput);
                }
            });
        }
    });

    // Inisialisasi Map, Geocoding, dan Update Manual Koordinat
    document.addEventListener("DOMContentLoaded", function() {
        var defaultLat = parseFloat("<?= !empty($profil->latitude) ? $profil->latitude : '-7.5592'; ?>");
        var defaultLng = parseFloat("<?= !empty($profil->longitude) ? $profil->longitude : '110.7719'; ?>");

        var map = L.map('map').setView([defaultLat, defaultLng], 14);

        // Tile OSM Resmi
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© OpenStreetMap'
        }).addTo(map);

        var marker = L.marker([defaultLat, defaultLng], { draggable: true }).addTo(map);

        // Fungsi Ambil Detail Alamat Berdasarkan Lat & Lng
        function getAddressDetails(lat, lng, skipInputUpdate = false) {
            if (!skipInputUpdate) {
                document.getElementById('latitude').value = lat;
                document.getElementById('longitude').value = lng;
            }

            fetch(`https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${lat}&lon=${lng}`)
                .then(response => response.json())
                .then(data => {
                    if (data && data.address) {
                        const addr = data.address;
                        
                        document.getElementById('alamat').value = data.display_name || '';
                        document.getElementById('desa').value = addr.village || addr.suburb || addr.neighbourhood || '';
                        document.getElementById('kecamatan').value = addr.town || addr.city_district || addr.subdistrict || '';
                        document.getElementById('kabupaten').value = addr.city || addr.regency || addr.county || '';
                        document.getElementById('provinsi').value = addr.state || '';
                        document.getElementById('kode_pos').value = addr.postcode || '';
                    }
                })
                .catch(err => console.error("Gagal mendapatkan alamat:", err));
        }

        // Update Peta saat input koordinat manual diubah
        function updateMapFromCoordinates() {
            var latVal = parseFloat(document.getElementById('latitude').value);
            var lngVal = parseFloat(document.getElementById('longitude').value);

            if (!isNaN(latVal) && !isNaN(lngVal)) {
                map.setView([latVal, lngVal], 16);
                marker.setLatLng([latVal, lngVal]);
                getAddressDetails(latVal, lngVal, true);
            }
        }

        document.getElementById('latitude').addEventListener('change', updateMapFromCoordinates);
        document.getElementById('longitude').addEventListener('change', updateMapFromCoordinates);

        // Event listener saat peta diklik
        map.on('click', function(e) {
            var lat = e.latlng.lat;
            var lng = e.latlng.lng;
            marker.setLatLng([lat, lng]);
            getAddressDetails(lat, lng);
        });

        // Event listener saat marker digeser (dragged)
        marker.on('dragend', function(e) {
            var lat = marker.getLatLng().lat;
            var lng = marker.getLatLng().lng;
            getAddressDetails(lat, lng);
        });

        // FUNGSI CARI LOKASI DI PETA
        function searchLocation() {
            var query = document.getElementById('map-search-input').value;
            if (!query.trim()) return;

            fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(query)}`)
                .then(response => response.json())
                .then(results => {
                    if (results && results.length > 0) {
                        var lat = parseFloat(results[0].lat);
                        var lon = parseFloat(results[0].lon);

                        map.setView([lat, lon], 16);
                        marker.setLatLng([lat, lon]);

                        getAddressDetails(lat, lon);
                    } else {
                        alert('Lokasi tidak ditemukan. Coba kata kunci yang lebih spesifik.');
                    }
                })
                .catch(err => console.error("Gagal mencari lokasi:", err));
        }

        // Trigger pencarian tombol klik & tombol Enter
        document.getElementById('btn-map-search').addEventListener('click', searchLocation);
        document.getElementById('map-search-input').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                searchLocation();
            }
        });
    });
</script>

<?php $this->load->view('admin/template/footer'); ?>