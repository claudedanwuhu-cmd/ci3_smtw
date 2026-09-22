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
                    <i class="fa-solid fa-file-circle-plus"></i>
                </div>
                <div>
                    <span class="badge-header-tag mb-1">
                        <i class="fa-solid fa-plus me-1"></i> Form Input
                    </span>
                    <h2 class="page-title">Tambah Foto</h2>
                    <p class="page-subtitle">Tambahkan foto ke album <strong><?= html_escape($album->nama_album); ?></strong>.</p>
                </div>
            </div>
            <a href="<?= site_url('admin/galeri/foto/' . (int) $album->id); ?>" class="btn-back">
                <i class="fa-solid fa-arrow-left me-2"></i>
                Kembali
            </a>
        </div>

        <!-- 3. FORM -->
        <?php $this->load->view('admin/galeri/_foto_form', [
            'form_mode'  => 'tambah',
            'form_data'  => null,
            'form_album' => $album,
        ]); ?>

    </div>
</div>

<?php $this->load->view('admin/galeri/_assets'); ?>

<?php $this->load->view('admin/template/footer'); ?>
