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
                    <i class="fa-solid fa-pen-to-square"></i>
                </div>
                <div>
                    <span class="badge-header-tag mb-1">
                        <i class="fa-solid fa-pen-to-square me-1"></i> Form Edit
                    </span>
                    <h2 class="page-title">Edit Album</h2>
                    <p class="page-subtitle">Perbarui informasi album galeri di bawah ini.</p>
                </div>
            </div>
            <a href="<?= site_url('admin/galeri'); ?>" class="btn-back">
                <i class="fa-solid fa-arrow-left me-2"></i>
                Kembali
            </a>
        </div>

        <!-- 3. FORM -->
        <?php $this->load->view('admin/galeri/_album_form', ['form_mode' => 'edit', 'form_data' => $album]); ?>

    </div>
</div>

<?php $this->load->view('admin/galeri/_assets'); ?>

<?php $this->load->view('admin/template/footer'); ?>
