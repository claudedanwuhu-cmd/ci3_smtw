<?php $this->load->view('admin/template/header'); ?>
<?php $this->load->view('admin/template/sidebar'); ?>

<div class="main-content">
    <?php $this->load->view('admin/template/navbar'); ?>

    <div class="content-wrapper">

        <!-- 1. FLASH MESSAGE -->
        <?php $this->load->view('admin/ppdb/_flash'); ?>

        <!-- 2. PAGE HEADER -->
        <div class="page-header-custom mb-4">
            <div class="d-flex align-items-center gap-3">
                <div class="page-header-icon">
                    <i class="fa-solid fa-file-pen"></i>
                </div>
                <div>
                    <span class="badge-header-tag">
                        <i class="fa-solid fa-pen-to-square"></i> Form Edit
                    </span>
                    <h2 class="page-title">Sunting Informasi PPDB</h2>
                    <p class="page-subtitle">Perbarui informasi gelombang, persyaratan, dan alur pendaftaran peserta didik.</p>
                </div>
            </div>
            <a href="<?= site_url('admin/ppdb'); ?>" class="btn-back">
                <i class="fa-solid fa-arrow-left"></i> Kembali
            </a>
        </div>

        <!-- 3. CARD FORM -->
        <div class="custom-card">
            <div class="card-title-custom">
                <div class="d-flex align-items-center gap-3">
                    <div class="title-icon"><i class="fa-solid fa-pen-to-square"></i></div>
                    <div>
                        <h5>Formulir Sunting PPDB</h5>
                        <small>Pastikan semua data terisi dengan benar sebelum menyimpan</small>
                    </div>
                </div>
                <span class="total-badge">ID: #<?= (int) $ppdb->id; ?></span>
            </div>

            <?php $this->load->view('admin/ppdb/_form', [
                'form_action'  => site_url('admin/ppdb/update/' . (int) $ppdb->id),
                'submit_label' => 'Simpan Perubahan',
                'item'         => $ppdb,
            ]); ?>
        </div>

    </div>
</div>

<?php $this->load->view('admin/ppdb/_assets'); ?>
<?php $this->load->view('admin/template/footer'); ?>
