<?php $this->load->view('admin/template/header'); ?>
<?php $this->load->view('admin/template/sidebar'); ?>

<div class="main-content">
    <?php $this->load->view('admin/template/navbar'); ?>

    <div class="content-wrapper">

        <!-- 1. FLASH MESSAGE -->
        <?php $this->load->view('admin/galeri/_flash'); ?>

        <!-- 2. PAGE HEADER -->
        <div class="page-header-custom mb-4">
            <div class="d-flex align-items-center gap-3">
                <div class="page-header-icon">
                    <i class="fa-solid fa-images"></i>
                </div>
                <div>
                    <span class="badge-header-tag mb-1">
                        <i class="fa-solid fa-layer-group me-1"></i> Album Galeri
                    </span>
                    <h2 class="page-title"><?= html_escape($album->nama_album); ?></h2>
                    <p class="page-subtitle">Kelola foto dalam album ini.</p>
                </div>
            </div>
            <div class="page-header-actions">
                <a href="<?= site_url('admin/galeri/foto_tambah/' . (int) $album->id); ?>" class="btn-add">
                    <i class="fa-solid fa-plus me-2"></i>
                    Tambah Foto
                </a>
                <a href="<?= site_url('admin/galeri'); ?>" class="btn-back">
                    <i class="fa-solid fa-arrow-left me-2"></i>
                    Kembali
                </a>
            </div>
        </div>

        <!-- 3. DAFTAR FOTO -->
        <div class="custom-card">
            <div class="card-title-custom">
                <div class="d-flex align-items-center gap-3">
                    <div class="title-icon">
                        <i class="fa-solid fa-images"></i>
                    </div>
                    <div>
                        <h5>Daftar Foto</h5>
                        <small>Foto dalam album <?= html_escape($album->nama_album); ?></small>
                    </div>
                </div>
                <div class="d-flex align-items-center gap-3 flex-wrap toolbar-right">
                    <div class="table-search-group">
                        <i class="fa-solid fa-magnifying-glass table-search-icon"></i>
                        <input type="text" id="galeri-search-input" class="table-search-input"
                            placeholder="Cari judul, deskripsi..." aria-label="Cari foto">
                    </div>
                    <div class="total-badge">
                        <i class="fa-solid fa-image me-1"></i>
                        <span id="galeri-count"><?= !empty($foto) ? count($foto) : 0; ?></span>&nbsp;Foto
                    </div>
                </div>
            </div>

            <div class="card-body-custom">
                <div class="row g-4" id="galeri-grid">

                    <?php if (!empty($foto)): ?>
                        <?php $no = 0; ?>
                        <?php foreach ($foto as $item): ?>
                            <?php
                                $file      = !empty($item->foto) ? basename($item->foto) : '';
                                $foto_url  = $file !== '' ? base_url('assets/img/galeri/' . rawurlencode($file)) : '';
                                $judul     = !empty($item->judul) ? $item->judul : 'Tanpa judul';
                                $search    = strtolower(($item->judul ?? '') . ' ' . ($item->deskripsi ?? ''));
                            ?>
                            <div class="col-xl-4 col-md-6 galeri-item" style="--i: <?= min($no, 8); ?>;"
                                data-search="<?= html_escape($search); ?>">
                                <div class="gallery-card">

                                    <!-- FOTO -->
                                    <div class="gallery-media<?= $foto_url !== '' ? ' has-image' : ''; ?>">
                                        <?php if ($foto_url !== ''): ?>
                                            <img src="<?= $foto_url; ?>" class="gallery-image" loading="lazy"
                                                alt="<?= html_escape($judul); ?>">
                                        <?php endif; ?>
                                        <div class="gallery-placeholder">
                                            <div class="gallery-placeholder-icon">
                                                <i class="fa-solid fa-image"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="gallery-card-body">
                                        <div class="gallery-card-content">
                                            <h5><?= html_escape($judul); ?></h5>

                                            <?php if (!empty($item->deskripsi)): ?>
                                                <p class="gallery-card-desc"><?= html_escape($item->deskripsi); ?></p>
                                            <?php else: ?>
                                                <p class="gallery-card-desc is-empty">Tidak ada deskripsi.</p>
                                            <?php endif; ?>
                                        </div>

                                        <!-- AKSI -->
                                        <div class="gallery-card-footer">
                                            <a href="<?= site_url('admin/galeri/foto_edit/' . (int) $item->id . '/' . (int) $album->id); ?>"
                                                class="btn-action edit" title="Edit Foto"
                                                aria-label="Edit foto <?= html_escape($judul); ?>">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                            <a href="<?= site_url('admin/galeri/foto_hapus/' . (int) $item->id . '/' . (int) $album->id); ?>"
                                                class="btn-action delete" title="Hapus Foto"
                                                aria-label="Hapus foto <?= html_escape($judul); ?>"
                                                onclick="return confirm('Yakin ingin menghapus foto ini?');">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <?php $no++; ?>
                        <?php endforeach; ?>

                        <!-- TIDAK DITEMUKAN -->
                        <div class="col-12 d-none" id="galeri-no-result">
                            <div class="empty-data">
                                <div class="empty-icon">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </div>
                                <div class="empty-title">Tidak ditemukan</div>
                                <p class="empty-text">Tidak ada foto yang cocok dengan pencarian.</p>
                            </div>
                        </div>

                    <?php else: ?>

                        <!-- BELUM ADA DATA -->
                        <div class="col-12">
                            <div class="empty-data">
                                <div class="empty-icon">
                                    <i class="fa-solid fa-image"></i>
                                </div>
                                <div class="empty-title">Belum ada foto</div>
                                <p class="empty-text">Album ini belum memiliki foto. Tambahkan foto kegiatan sekarang.</p>
                                <a href="<?= site_url('admin/galeri/foto_tambah/' . (int) $album->id); ?>" class="btn-add">
                                    <i class="fa-solid fa-plus me-2"></i> Tambah Foto Sekarang
                                </a>
                            </div>
                        </div>

                    <?php endif; ?>

                </div>
            </div>
        </div>

    </div>
</div>

<?php $this->load->view('admin/galeri/_assets'); ?>

<?php $this->load->view('admin/template/footer'); ?>
