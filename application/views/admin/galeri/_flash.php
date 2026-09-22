<?php
/**
 * Flash message modul Galeri.
 * Dipanggil di setiap halaman galeri lewat:
 *   $this->load->view('admin/galeri/_flash');
 */
$flash_success = $this->session->flashdata('success');
$flash_error   = $this->session->flashdata('error');
?>

<?php if (!empty($flash_success)): ?>
    <div class="alert alert-autodismiss is-success mb-4" role="status" data-autodismiss="4500">
        <div class="alert-icon-box">
            <i class="fa-solid fa-circle-check"></i>
        </div>
        <div class="alert-content">
            <strong>Berhasil</strong>
            <span><?= html_escape($flash_success); ?></span>
        </div>
        <button type="button" class="btn-close" aria-label="Tutup notifikasi"></button>
        <div class="alert-progress-track"><div class="alert-progress-bar"></div></div>
    </div>
<?php endif; ?>

<?php if (!empty($flash_error)): ?>
    <div class="alert alert-autodismiss is-error mb-4" role="alert" data-autodismiss="6000">
        <div class="alert-icon-box">
            <i class="fa-solid fa-circle-exclamation"></i>
        </div>
        <div class="alert-content">
            <strong>Gagal memproses data</strong>
            <span><?= html_escape($flash_error); ?></span>
        </div>
        <button type="button" class="btn-close" aria-label="Tutup notifikasi"></button>
        <div class="alert-progress-track"><div class="alert-progress-bar"></div></div>
    </div>
<?php endif; ?>
