<?php $this->load->view('admin/template/header'); ?>
<?php $this->load->view('admin/template/sidebar'); ?>

<div class="main-content">
    <?php $this->load->view('admin/template/navbar'); ?>

    <div class="content-wrapper">

        <!-- =====================================================
             FLASH MESSAGE
        ====================================================== -->

        <?php if ($this->session->flashdata('success')): ?>
            <div
                class="alert alert-autodismiss is-success mb-4"
                data-autodismiss="4500"
                role="alert"
            >
                <div class="alert-icon-box">
                    <i class="fa-solid fa-circle-check"></i>
                </div>

                <div class="alert-content">
                    <strong>Berhasil</strong>
                    <span>
                        <?= html_escape($this->session->flashdata('success')); ?>
                    </span>
                </div>

                <button
                    type="button"
                    class="btn-close"
                    aria-label="Tutup notifikasi"
                ></button>

                <div class="alert-progress-track">
                    <div class="alert-progress-bar"></div>
                </div>
            </div>
        <?php endif; ?>


        <?php if ($this->session->flashdata('error')): ?>
            <div
                class="alert alert-autodismiss is-error mb-4"
                data-autodismiss="6000"
                role="alert"
            >
                <div class="alert-icon-box">
                    <i class="fa-solid fa-circle-xmark"></i>
                </div>

                <div class="alert-content">
                    <strong>Gagal memproses data</strong>
                    <span>
                        <?= html_escape($this->session->flashdata('error')); ?>
                    </span>
                </div>

                <button
                    type="button"
                    class="btn-close"
                    aria-label="Tutup notifikasi"
                ></button>

                <div class="alert-progress-track">
                    <div class="alert-progress-bar"></div>
                </div>
            </div>
        <?php endif; ?>


        <!-- =====================================================
             PAGE HEADER
        ====================================================== -->

        <div class="page-header-custom mb-4">

            <div class="page-header-left">

                <div class="page-header-icon">
                    <i class="fa-solid fa-building"></i>
                </div>

                <div class="page-header-info">

                    <span class="badge-header-tag">
                        <i class="fa-solid fa-school"></i>
                        Sarana &amp; Prasarana
                    </span>

                    <h2 class="page-title">
                        Fasilitas Sekolah
                    </h2>

                    <p class="page-subtitle">
                        Kelola data sarana dan prasarana yang tersedia
                        di SMA Negeri Tawangmangu.
                    </p>

                </div>

            </div>

            <a
                href="<?= site_url('admin/fasilitas/tambah'); ?>"
                class="btn-add"
                aria-label="Tambah fasilitas"
            >
                <i class="fa-solid fa-plus"></i>
                <span>Tambah Fasilitas</span>
            </a>

        </div>


        <!-- =====================================================
             MAIN CARD
        ====================================================== -->

        <div class="custom-card">

            <!-- CARD HEADER -->
            <div class="card-title-custom">

                <div class="card-title-left">

                    <div class="title-icon">
                        <i class="fa-solid fa-building"></i>
                    </div>

                    <div>
                        <h5>Data Fasilitas Sekolah</h5>

                        <small>
                            Daftar sarana dan prasarana sekolah yang terdaftar
                        </small>
                    </div>

                </div>

                <div class="total-badge">
                    <i class="fa-solid fa-layer-group"></i>

                    <span>
                        <?= !empty($fasilitas) ? count($fasilitas) : 0; ?>
                        Fasilitas
                    </span>
                </div>

            </div>


            <!-- CARD BODY -->
            <div class="content-card-body">

                <?php if (!empty($fasilitas)): ?>

                    <div class="row g-4">

                        <?php
                        $facility_index = 0;
                        foreach ($fasilitas as $item):
                            $facility_index++;

                            $nama_fasilitas = !empty($item->nama_fasilitas)
                                ? $item->nama_fasilitas
                                : 'Fasilitas Tanpa Nama';

                            $deskripsi = !empty($item->deskripsi)
                                ? $item->deskripsi
                                : 'Belum ada deskripsi fasilitas.';

                            $status = !empty($item->status)
                                ? $item->status
                                : 'nonaktif';
                        ?>

                            <div
                                class="col-xl-4 col-md-6 facility-item"
                                style="--i: <?= min($facility_index, 8); ?>;"
                            >

                                <div class="facility-card">

                                    <!-- IMAGE -->
                                    <div class="facility-image-wrapper">

                                        <?php if (!empty($item->foto)): ?>

                                            <img
                                                src="<?= base_url('assets/img/fasilitas/' . rawurlencode(basename($item->foto))); ?>"
                                                class="facility-image"
                                                alt="<?= html_escape($nama_fasilitas); ?>"
                                                loading="lazy"
                                            >

                                        <?php else: ?>

                                            <div
                                                class="facility-placeholder"
                                                aria-label="Tidak ada foto fasilitas"
                                            >
                                                <div class="facility-placeholder-icon">
                                                    <i class="fa-solid fa-building"></i>
                                                </div>
                                            </div>

                                        <?php endif; ?>


                                        <!-- IMAGE OVERLAY -->
                                        <div class="facility-image-overlay"></div>


                                        <!-- STATUS -->
                                        <div class="facility-status">

                                            <?php if ($status === 'aktif'): ?>

                                                <span class="status-badge active">
                                                    <i class="fa-solid fa-circle-check"></i>
                                                    Aktif
                                                </span>

                                            <?php else: ?>

                                                <span class="status-badge inactive">
                                                    <i class="fa-solid fa-circle-xmark"></i>
                                                    Nonaktif
                                                </span>

                                            <?php endif; ?>

                                        </div>

                                    </div>


                                    <!-- CONTENT -->
                                    <div class="facility-body">

                                        <div class="facility-heading">

                                            <h5 class="facility-title">
                                                <?= html_escape($nama_fasilitas); ?>
                                            </h5>

                                            <span
                                                class="facility-category"
                                                title="Fasilitas sekolah"
                                            >
                                                <i class="fa-solid fa-school"></i>
                                            </span>

                                        </div>


                                        <p class="facility-description">
                                            <?= html_escape($deskripsi); ?>
                                        </p>


                                        <div class="facility-footer">

                                            <span class="facility-label">
                                                <i class="fa-solid fa-building-columns"></i>
                                                Fasilitas Sekolah
                                            </span>


                                            <div class="action-buttons">

                                                <a
                                                    href="<?= site_url('admin/fasilitas/edit/' . (int) $item->id); ?>"
                                                    class="btn-action edit"
                                                    title="Edit Data"
                                                    aria-label="Edit <?= html_escape($nama_fasilitas); ?>"
                                                >
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </a>

                                                <a
                                                    href="<?= site_url('admin/fasilitas/hapus/' . (int) $item->id); ?>"
                                                    class="btn-action delete"
                                                    title="Hapus Data"
                                                    aria-label="Hapus <?= html_escape($nama_fasilitas); ?>"
                                                    onclick="return confirm('Yakin ingin menghapus fasilitas ini?');"
                                                >
                                                    <i class="fa-solid fa-trash-can"></i>
                                                </a>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        <?php endforeach; ?>

                    </div>

                <?php else: ?>

                    <!-- EMPTY STATE -->
                    <div class="empty-data">

                        <div class="empty-icon">
                            <i class="fa-solid fa-building"></i>
                        </div>

                        <div class="empty-title">
                            Belum ada data fasilitas
                        </div>

                        <p class="empty-subtitle">
                            Sistem belum mencatat fasilitas sekolah.
                        </p>

                        <a
                            href="<?= site_url('admin/fasilitas/tambah'); ?>"
                            class="btn-add"
                            aria-label="Tambahkan fasilitas"
                        >
                            <i class="fa-solid fa-plus"></i>
                            Tambahkan Fasilitas
                        </a>

                    </div>

                <?php endif; ?>

            </div>

        </div>

    </div>
</div>


<style>
/* =========================================================
   FACILITY MODULE
   CONSISTENT WITH SMA NEGERI TAWANGMANGU DESIGN SYSTEM
========================================================= */

:root {
    --facility-card: #ffffff;
    --facility-subtle: #f8fafc;

    --facility-input-bg: #f8fafc;
    --facility-input-focus: #ffffff;
    --facility-input-border: #cbd5e1;

    --facility-border: rgba(226, 232, 240, .8);

    --facility-title: #0f172a;
    --facility-subtitle: #64748b;

    --facility-hover: #f1f5f9;

    --facility-accent: #0ea5e9;
    --facility-glow: rgba(14, 165, 233, .25);

    --facility-soft: rgba(14, 165, 233, .10);
    --facility-soft-border: rgba(14, 165, 233, .22);

    --facility-icon-muted: #94a3b8;

    --facility-success: #059669;
    --facility-danger: #dc2626;

    --facility-shadow:
        0 10px 25px -5px rgba(15, 23, 42, .05),
        0 8px 10px -6px rgba(15, 23, 42, .02);
}


/* =========================================================
   DARK MODE
========================================================= */

[data-bs-theme="dark"],
[data-theme="dark"],
body.dark-mode,
.dark-mode {

    --facility-card: #0f172a;
    --facility-subtle: #1e293b;

    --facility-input-bg: #1e293b;
    --facility-input-focus: #111827;
    --facility-input-border: rgba(255, 255, 255, .12);

    --facility-border: rgba(255, 255, 255, .08);

    --facility-title: #f8fafc;
    --facility-subtitle: #94a3b8;

    --facility-hover: #1e293b;

    --facility-accent: #38bdf8;
    --facility-glow: rgba(56, 189, 248, .25);

    --facility-soft: rgba(56, 189, 248, .10);
    --facility-soft-border: rgba(56, 189, 248, .22);

    --facility-icon-muted: #64748b;

    --facility-success: #34d399;
    --facility-danger: #f87171;

    --facility-shadow:
        0 12px 30px -5px rgba(0, 0, 0, .4);
}


/* =========================================================
   GENERAL
========================================================= */

.text-title {
    color: var(--facility-title);
}

.text-subtle {
    color: var(--facility-subtitle);
}


/* =========================================================
   FLASH MESSAGE
========================================================= */

.alert-autodismiss {
    position: relative;
    overflow: hidden;

    display: flex;
    align-items: center;
    gap: 12px;

    padding: 14px 18px;

    border-radius: 16px;

    animation:
        alertIn .45s cubic-bezier(.34, 1.56, .64, 1);
}

.alert-autodismiss.is-success {
    color: var(--facility-success);
    background: rgba(16, 185, 129, .12);
    border: 1px solid rgba(16, 185, 129, .25);
}

.alert-autodismiss.is-error {
    color: var(--facility-danger);
    background: rgba(239, 68, 68, .12);
    border: 1px solid rgba(239, 68, 68, .25);
}

.alert-icon-box {
    width: 36px;
    height: 36px;

    flex-shrink: 0;

    border-radius: 10px;

    display: flex;
    align-items: center;
    justify-content: center;
}

.is-success .alert-icon-box {
    background: rgba(16, 185, 129, .14);
}

.is-error .alert-icon-box {
    background: rgba(239, 68, 68, .14);
}

.alert-content {
    min-width: 0;

    display: flex;
    flex-direction: column;
    gap: 2px;
}

.alert-content strong {
    font-size: 12px;
    font-weight: 800;
}

.alert-content span {
    font-size: 12.5px;
    color: var(--facility-subtitle);
}

.alert-autodismiss .btn-close {
    margin-left: auto;
    flex-shrink: 0;
    opacity: .7;
}

.alert-progress-track {
    position: absolute;
    left: 0;
    right: 0;
    bottom: 0;

    height: 3px;
    background: transparent;
}

.is-success .alert-progress-bar {
    background: var(--facility-success);
}

.is-error .alert-progress-bar {
    background: var(--facility-danger);
}

.alert-progress-bar {
    width: 100%;
    height: 100%;

    transform-origin: left;

    animation: alertProgress linear forwards;
}

.alert-hiding {
    max-height: 200px;
    opacity: 0;
    transform: translateY(-8px);

    padding-top: 0;
    padding-bottom: 0;

    transition:
        opacity .35s ease,
        transform .35s ease,
        max-height .38s ease,
        padding .38s ease;
}

@keyframes alertIn {
    from {
        opacity: 0;
        transform: translateY(-10px) scale(.98);
    }

    to {
        opacity: 1;
        transform: translateY(0) scale(1);
    }
}

@keyframes alertProgress {
    from {
        transform: scaleX(1);
    }

    to {
        transform: scaleX(0);
    }
}


/* =========================================================
   PAGE HEADER
========================================================= */

.page-header-custom {
    position: relative;
    overflow: hidden;

    background: var(--facility-card);

    border: 1px solid var(--facility-border);
    border-radius: 20px;

    padding: 22px 28px;

    display: flex;
    align-items: center;
    justify-content: space-between;

    gap: 20px;

    box-shadow: var(--facility-shadow);

    animation: fadeUp .4s ease both;
}


/* LEFT GRADIENT LINE */

.page-header-custom::before {
    content: "";

    position: absolute;

    left: 0;
    top: 0;
    bottom: 0;

    width: 4px;

    background:
        linear-gradient(
            180deg,
            var(--facility-accent),
            #0369a1
        );

    pointer-events: none;
}


/* RIGHT GLOW */



/* HEADER LEFT */

.page-header-left {
    position: relative;
    z-index: 1;

    display: flex;
    align-items: center;

    gap: 16px;
}

.page-header-icon {
    width: 52px;
    height: 52px;

    flex-shrink: 0;

    border-radius: 16px;

    background: var(--facility-soft);
    border: 1px solid var(--facility-soft-border);

    color: var(--facility-accent);

    display: flex;
    align-items: center;
    justify-content: center;

    font-size: 22px;

    transition:
        transform .3s ease,
        box-shadow .3s ease;
}

.page-header-custom:hover .page-header-icon {
    transform: rotate(-6deg) scale(1.06);

    box-shadow:
        0 8px 20px var(--facility-glow);
}

.page-header-info {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
}

.badge-header-tag {
    display: inline-flex;
    align-items: center;
    gap: 5px;

    padding: 4px 10px;

    border-radius: 20px;

    background: var(--facility-soft);
    border: 1px solid var(--facility-soft-border);

    color: var(--facility-accent);

    font-size: 10.5px;
    font-weight: 800;

    text-transform: uppercase;
    letter-spacing: .5px;
}

.page-title {
    color: var(--facility-title);

    font-size: 22px;
    font-weight: 800;

    letter-spacing: -.3px;

    margin: 4px 0 2px;
}

.page-subtitle {
    color: var(--facility-subtitle);

    font-size: 13px;

    margin: 0;
}


/* =========================================================
   PRIMARY BUTTON
========================================================= */

.btn-add {
    position: relative;
    z-index: 2;

    display: inline-flex;
    align-items: center;
    justify-content: center;

    gap: 8px;

    padding: 11px 20px;

    border-radius: 12px;

    background:
        linear-gradient(
            135deg,
            #0284c7,
            #0369a1
        );

    color: #ffffff !important;

    text-decoration: none;

    font-size: 12.5px;
    font-weight: 700;

    white-space: nowrap;

    box-shadow:
        0 6px 18px rgba(2, 132, 199, .28);

    transition:
        transform .25s ease,
        box-shadow .25s ease;
}

.btn-add:hover {
    color: #ffffff !important;

    transform: translateY(-2px);

    box-shadow:
        0 10px 24px rgba(2, 132, 199, .45);
}


/* =========================================================
   MAIN CARD
========================================================= */

.custom-card {
    overflow: hidden;

    background: var(--facility-card);

    border: 1px solid var(--facility-border);
    border-radius: 20px;

    box-shadow: var(--facility-shadow);

    animation: fadeUp .4s ease both;
    animation-delay: .05s;
}


/* =========================================================
   CARD HEADER
========================================================= */

.card-title-custom {
    display: flex;
    align-items: center;
    justify-content: space-between;

    gap: 15px;

    padding: 18px 24px;

    background: var(--facility-subtle);

    border-bottom: 1px solid var(--facility-border);
}

.card-title-left {
    display: flex;
    align-items: center;

    gap: 13px;
}

.title-icon {
    width: 42px;
    height: 42px;

    flex-shrink: 0;

    border-radius: 12px;

    background: var(--facility-soft);
    border: 1px solid var(--facility-soft-border);

    color: var(--facility-accent);

    display: flex;
    align-items: center;
    justify-content: center;

    font-size: 16px;
}

.card-title-custom h5 {
    margin: 0 0 2px;

    color: var(--facility-title);

    font-size: 15px;
    font-weight: 700;
}

.card-title-custom small {
    color: var(--facility-subtitle);

    font-size: 12px;
}

.total-badge {
    display: inline-flex;
    align-items: center;

    gap: 5px;

    padding: 6px 12px;

    border-radius: 20px;

    background: var(--facility-soft);
    border: 1px solid var(--facility-soft-border);

    color: var(--facility-accent);

    font-size: 12px;
    font-weight: 700;

    white-space: nowrap;
}


/* =========================================================
   CARD BODY
========================================================= */

.content-card-body {
    padding: 24px;
}


/* =========================================================
   FACILITY CARD
========================================================= */

.facility-item {
    animation:
        fadeUp .4s ease both;

    animation-delay:
        calc(var(--i) * .05s);
}

.facility-card {
    height: 100%;

    overflow: hidden;

    background: var(--facility-card);

    border: 1px solid var(--facility-border);
    border-radius: 16px;

    transition:
        transform .3s ease,
        border-color .3s ease,
        box-shadow .3s ease;
}

.facility-card:hover {
    transform: translateY(-4px);

    border-color: var(--facility-soft-border);

    box-shadow:
        0 16px 32px rgba(15, 23, 42, .08);
}

[data-bs-theme="dark"] .facility-card:hover,
[data-theme="dark"] .facility-card:hover,
body.dark-mode .facility-card:hover,
.dark-mode .facility-card:hover {
    box-shadow:
        0 16px 32px rgba(0, 0, 0, .35);
}


/* =========================================================
   IMAGE
========================================================= */

.facility-image-wrapper {
    position: relative;

    height: 190px;

    overflow: hidden;

    background: var(--facility-subtle);
}

.facility-image {
    display: block;

    width: 100%;
    height: 100%;

    object-fit: cover;

    transition: transform .45s ease;
}

.facility-card:hover .facility-image {
    transform: scale(1.045);
}

.facility-image-overlay {
    position: absolute;
    inset: 0;

    background:
        linear-gradient(
            to bottom,
            rgba(15, 23, 42, .08),
            transparent 45%,
            rgba(15, 23, 42, .15)
        );

    pointer-events: none;
}


/* =========================================================
   PLACEHOLDER
========================================================= */

.facility-placeholder {
    width: 100%;
    height: 100%;

    display: flex;
    align-items: center;
    justify-content: center;

    background:
        radial-gradient(
            circle at center,
            var(--facility-soft),
            transparent 65%
        );
}

.facility-placeholder-icon {
    width: 64px;
    height: 64px;

    border-radius: 18px;

    background: var(--facility-soft);
    border: 1px solid var(--facility-soft-border);

    color: var(--facility-accent);

    display: flex;
    align-items: center;
    justify-content: center;

    font-size: 25px;
}


/* =========================================================
   STATUS
========================================================= */

.facility-status {
    position: absolute;

    top: 13px;
    right: 13px;

    z-index: 3;
}

.status-badge {
    display: inline-flex;
    align-items: center;

    gap: 5px;

    padding: 5px 11px;

    border-radius: 20px;

    font-size: 11.5px;
    font-weight: 700;

    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
}

.status-badge.active {
    background: rgba(5, 150, 105, .88);
    color: #ffffff;

    border: 1px solid rgba(255, 255, 255, .25);
}

.status-badge.inactive {
    background: rgba(220, 38, 38, .88);
    color: #ffffff;

    border: 1px solid rgba(255, 255, 255, .25);
}

.status-badge.active i {
    animation: pulse 1.8s ease-in-out infinite;
}


/* =========================================================
   FACILITY BODY
========================================================= */

.facility-body {
    padding: 18px;
}

.facility-heading {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;

    gap: 10px;
}

.facility-title {
    margin: 0 0 8px;

    color: var(--facility-title);

    font-size: 15px;
    font-weight: 700;
}

.facility-category {
    width: 28px;
    height: 28px;

    flex-shrink: 0;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 9px;

    background: var(--facility-soft);

    color: var(--facility-accent);

    font-size: 11px;
}

.facility-description {
    min-height: 60px;

    margin: 0 0 18px;

    color: var(--facility-subtitle);

    font-size: 12.5px;
    line-height: 1.6;

    display: -webkit-box;

    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;

    overflow: hidden;
}


/* =========================================================
   FOOTER
========================================================= */

.facility-footer {
    display: flex;
    align-items: center;
    justify-content: space-between;

    gap: 10px;

    padding-top: 14px;

    border-top: 1px solid var(--facility-border);
}

.facility-label {
    display: inline-flex;
    align-items: center;

    gap: 5px;

    color: var(--facility-subtitle);

    font-size: 10.5px;
    font-weight: 600;
}

.action-buttons {
    display: flex;
    gap: 7px;
}


/* =========================================================
   ACTION BUTTON
========================================================= */

.btn-action {
    width: 36px;
    height: 36px;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 10px;

    text-decoration: none;

    font-size: 12.5px;

    transition:
        transform .25s ease,
        background .25s ease,
        color .25s ease,
        border-color .25s ease;
}

.btn-action.edit {
    background: var(--facility-subtle);

    border: 1px solid var(--facility-border);

    color: var(--facility-title);
}

.btn-action.edit:hover {
    background: var(--facility-accent);
    border-color: var(--facility-accent);

    color: #ffffff;

    transform: translateY(-2px);
}

.btn-action.delete {
    background: rgba(239, 68, 68, .10);

    border: 1px solid rgba(239, 68, 68, .18);

    color: #f87171;
}

.btn-action.delete:hover {
    background: #ef4444;
    border-color: #ef4444;

    color: #ffffff;

    transform: translateY(-2px);
}


/* =========================================================
   EMPTY STATE
========================================================= */

.empty-data {
    padding: 60px 20px;

    text-align: center;
}

.empty-icon {
    width: 64px;
    height: 64px;

    margin: 0 auto 16px;

    border-radius: 18px;

    background: var(--facility-soft);
    border: 1px solid var(--facility-soft-border);

    color: var(--facility-accent);

    display: flex;
    align-items: center;
    justify-content: center;

    font-size: 26px;
}

.empty-title {
    margin-bottom: 4px;

    color: var(--facility-title);

    font-size: 15px;
    font-weight: 700;
}

.empty-subtitle {
    margin: 0 0 18px;

    color: var(--facility-subtitle);

    font-size: 12.5px;
}


/* =========================================================
   ANIMATION
========================================================= */

@keyframes fadeUp {
    from {
        opacity: 0;
        transform: translateY(12px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes pulse {
    0%,
    100% {
        opacity: 1;
        transform: scale(1);
    }

    50% {
        opacity: .55;
        transform: scale(.85);
    }
}


/* =========================================================
   RESPONSIVE
========================================================= */

@media (max-width: 768px) {

    .page-header-custom {
        flex-direction: column;
        align-items: stretch;

        padding: 20px;
    }

    .page-header-left {
        align-items: flex-start;
    }

    .btn-add {
        width: 100%;
    }

    .card-title-custom {
        flex-direction: column;
        align-items: flex-start;
    }

    .total-badge {
        align-self: flex-start;
    }

    .content-card-body {
        padding: 18px;
    }

    .facility-image-wrapper {
        height: 210px;
    }

    .facility-footer {
        align-items: flex-start;
    }
}


/* =========================================================
   REDUCED MOTION
========================================================= */

@media (prefers-reduced-motion: reduce) {

    *,
    *::before,
    *::after {
        animation-duration: .01ms !important;
        animation-iteration-count: 1 !important;
        transition-duration: .01ms !important;
        scroll-behavior: auto !important;
    }
}
</style>


<script>
document.addEventListener('DOMContentLoaded', function () {

    /* =====================================================
       AUTO DISMISS FLASH MESSAGE
    ===================================================== */

    document.querySelectorAll('.alert-autodismiss').forEach(function (alertEl) {

        var duration =
            parseInt(
                alertEl.getAttribute('data-autodismiss'),
                10
            ) || 4500;

        var bar =
            alertEl.querySelector('.alert-progress-bar');

        if (bar) {
            bar.style.animationDuration =
                duration + 'ms';
        }

        var dismissed = false;
        var remaining = duration;
        var startedAt = Date.now();

        function closeAlert() {

            if (dismissed) {
                return;
            }

            dismissed = true;

            var currentHeight =
                alertEl.offsetHeight;

            alertEl.style.maxHeight =
                currentHeight + 'px';

            requestAnimationFrame(function () {
                alertEl.classList.add('alert-hiding');
            });

            setTimeout(function () {

                if (alertEl.parentNode) {
                    alertEl.parentNode.removeChild(alertEl);
                }

            }, 380);
        }


        var timer =
            setTimeout(closeAlert, remaining);


        /* PAUSE SAAT HOVER */

        alertEl.addEventListener(
            'mouseenter',
            function () {

                if (dismissed) {
                    return;
                }

                clearTimeout(timer);

                remaining -=
                    Date.now() - startedAt;

                if (bar) {
                    bar.style.animationPlayState =
                        'paused';
                }

            }
        );


        /* LANJUT SAAT MOUSELEAVE */

        alertEl.addEventListener(
            'mouseleave',
            function () {

                if (dismissed) {
                    return;
                }

                if (bar) {
                    bar.style.animationPlayState =
                        'running';
                }

                startedAt = Date.now();

                timer = setTimeout(
                    closeAlert,
                    Math.max(remaining, 800)
                );

            }
        );


        /* CLOSE BUTTON */

        var closeBtn =
            alertEl.querySelector('.btn-close');

        if (closeBtn) {

            closeBtn.addEventListener(
                'click',
                function (event) {

                    event.preventDefault();

                    clearTimeout(timer);

                    closeAlert();

                }
            );

        }

    });

});
</script>


<?php $this->load->view('admin/template/footer'); ?>