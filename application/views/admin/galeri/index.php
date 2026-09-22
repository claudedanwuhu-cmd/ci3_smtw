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
                        <i class="fa-solid fa-layer-group me-1"></i> Manajemen Galeri
                    </span>
                    <h2 class="page-title">Galeri</h2>
                    <p class="page-subtitle">Kelola album dan foto kegiatan SMA Negeri Tawangmangu.</p>
                </div>
            </div>
            <a href="<?= site_url('admin/galeri/album_tambah'); ?>" class="btn-add">
                <i class="fa-solid fa-plus me-2"></i>
                Tambah Album
            </a>
        </div>

        <!-- 3. DAFTAR ALBUM -->
        <div class="custom-card">
            <div class="card-title-custom">
                <div class="d-flex align-items-center gap-3">
                    <div class="title-icon">
                        <i class="fa-solid fa-folder-open"></i>
                    </div>
                    <div>
                        <h5>Daftar Album</h5>
                        <small>Album foto kegiatan sekolah</small>
                    </div>
                </div>
                <div class="d-flex align-items-center gap-3 flex-wrap toolbar-right">
                    <div class="table-search-group">
                        <i class="fa-solid fa-magnifying-glass table-search-icon"></i>
                        <input type="text" id="galeri-search-input" class="table-search-input"
                            placeholder="Cari nama album, deskripsi..." aria-label="Cari album">
                    </div>
                    <div class="total-badge">
                        <i class="fa-solid fa-folder me-1"></i>
                        <span id="galeri-count"><?= !empty($album) ? count($album) : 0; ?></span>&nbsp;Album
                    </div>
                </div>
            </div>

            <div class="card-body-custom">
                <div class="row g-4" id="galeri-grid">

                    <?php if (!empty($album)): ?>
                        <?php $no = 0; ?>
                        <?php foreach ($album as $item): ?>
                            <?php
                                $tgl_valid = !empty($item->tanggal) && $item->tanggal !== '0000-00-00';
                                $tgl_label = $tgl_valid ? date('d-m-Y', strtotime($item->tanggal)) : '';
                                $search    = strtolower(($item->nama_album ?? '') . ' ' . ($item->deskripsi ?? '') . ' ' . $tgl_label);
                            ?>
                            <div class="col-xl-4 col-md-6 galeri-item" style="--i: <?= min($no, 8); ?>;"
                                data-search="<?= html_escape($search); ?>">
                                <div class="gallery-card">

                                    <!-- COVER -->
                                    <div class="gallery-media">
                                        <div class="gallery-placeholder">
                                            <div class="gallery-placeholder-icon">
                                                <i class="fa-solid fa-folder-open"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="gallery-card-body">
                                        <div class="gallery-card-content">
                                            <h5><?= html_escape($item->nama_album); ?></h5>

                                            <?php if (!empty($item->deskripsi)): ?>
                                                <p class="gallery-card-desc"><?= html_escape($item->deskripsi); ?></p>
                                            <?php else: ?>
                                                <p class="gallery-card-desc is-empty">Tidak ada deskripsi album.</p>
                                            <?php endif; ?>

                                            <?php if ($tgl_valid): ?>
                                                <div class="album-date">
                                                    <i class="fa-regular fa-calendar-days"></i>
                                                    <?= html_escape($tgl_label); ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>

                                        <!-- AKSI -->
                                        <div class="gallery-card-footer">
                                            <a href="<?= site_url('admin/galeri/foto/' . (int) $item->id); ?>" class="btn-add btn-card-main">
                                                <i class="fa-solid fa-images me-2"></i>
                                                Lihat Foto
                                            </a>
                                            <a href="<?= site_url('admin/galeri/album_edit/' . (int) $item->id); ?>" class="btn-action edit"
                                                title="Edit Album" aria-label="Edit album <?= html_escape($item->nama_album); ?>">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                            <a href="<?= site_url('admin/galeri/album_hapus/' . (int) $item->id); ?>" class="btn-action delete"
                                                title="Hapus Album" aria-label="Hapus album <?= html_escape($item->nama_album); ?>"
                                                onclick="return confirm('Yakin ingin menghapus album ini beserta fotonya?');">
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
                                <p class="empty-text">Tidak ada album yang cocok dengan pencarian.</p>
                            </div>
                        </div>

                    <?php else: ?>

                        <!-- BELUM ADA DATA -->
                        <div class="col-12">
                            <div class="empty-data">
                                <div class="empty-icon">
                                    <i class="fa-solid fa-images"></i>
                                </div>
                                <div class="empty-title">Belum ada album</div>
                                <p class="empty-text">Buat album pertama untuk menyimpan foto kegiatan sekolah.</p>
                                <a href="<?= site_url('admin/galeri/album_tambah'); ?>" class="btn-add">
                                    <i class="fa-solid fa-plus me-2"></i> Tambah Album Sekarang
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
