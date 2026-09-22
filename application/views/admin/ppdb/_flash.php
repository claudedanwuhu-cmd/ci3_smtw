<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $flash_ok = $this->session->flashdata('success'); ?>
<?php $flash_err = $this->session->flashdata('error'); ?>

<?php if ($flash_ok): ?>
    <div class="alert alert-autodismiss is-success mb-4" role="status" data-autodismiss="4500">
        <div class="alert-icon-box"><i class="fa-solid fa-circle-check"></i></div>
        <div class="alert-content">
            <strong>Berhasil</strong>
            <span><?= html_escape($flash_ok); ?></span>
        </div>
        <button type="button" class="btn-close" aria-label="Tutup"></button>
        <div class="alert-progress-track"><div class="alert-progress-bar"></div></div>
    </div>
<?php endif; ?>

<?php if ($flash_err): ?>
    <div class="alert alert-autodismiss is-error mb-4" role="alert" data-autodismiss="6000">
        <div class="alert-icon-box"><i class="fa-solid fa-circle-xmark"></i></div>
        <div class="alert-content">
            <strong>Gagal memproses data</strong>
            <span><?= html_escape($flash_err); ?></span>
        </div>
        <button type="button" class="btn-close" aria-label="Tutup"></button>
        <div class="alert-progress-track"><div class="alert-progress-bar"></div></div>
    </div>
<?php endif; ?>
