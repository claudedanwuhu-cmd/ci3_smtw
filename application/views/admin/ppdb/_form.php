<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * Partial form PPDB (dipakai tambah & edit).
 * Variabel: $form_action (string), $submit_label (string), $item (object|null)
 */
$item = isset($item) ? $item : null;

$val = function ($key) use ($item) {
    return ($item && isset($item->$key)) ? (string) $item->$key : '';
};
$tgl = function ($key) use ($val) {
    $v = $val($key);
    return ($v !== '' && strpos($v, '0000') !== 0 && strtotime($v) !== false) ? date('Y-m-d', strtotime($v)) : '';
};
$aktif = $item ? ($val('status') === 'aktif') : true;

$textareas = [
    ['isi',        'Informasi utama PPDB',    'Jelaskan rincian informasi pelaksanaan PPDB...',               'Deskripsikan informasi utama terkait pelaksanaan PPDB secara jelas.'],
    ['persyaratan','Persyaratan pendaftaran', 'Tuliskan daftar persyaratan yang harus disiapkan...',          'Rincikan dokumen atau ketentuan berkas yang wajib dipenuhi calon peserta didik.'],
    ['alur',       'Alur pendaftaran',        'Jelaskan tahapan atau alur pendaftaran secara berurutan...',   'Uraikan langkah-langkah pendaftaran dari awal hingga selesai.'],
];
?>
<form action="<?= html_escape($form_action); ?>" method="post" id="ppdbForm">
    <?php if ($this->config->item('csrf_protection') === TRUE): ?>
        <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
    <?php endif; ?>

    <div class="form-body">
        <div class="row g-4">

            <div class="col-12">
                <label class="form-label required" for="judul">Judul gelombang / informasi</label>
                <div class="input-icon-group">
                    <i class="fa-solid fa-heading input-icon"></i>
                    <input type="text" id="judul" name="judul" class="form-control with-icon"
                           value="<?= html_escape($val('judul')); ?>"
                           placeholder="Contoh: Gelombang 1 Tahun Ajaran 2026/2027" required>
                </div>
            </div>

            <div class="col-md-6">
                <label class="form-label" for="tanggal_mulai">Tanggal mulai pendaftaran</label>
                <div class="input-icon-group">
                    <i class="fa-regular fa-calendar-days input-icon"></i>
                    <input type="date" id="tanggal_mulai" name="tanggal_mulai" class="form-control with-icon"
                           value="<?= html_escape($tgl('tanggal_mulai')); ?>">
                </div>
            </div>

            <div class="col-md-6">
                <label class="form-label" for="tanggal_selesai">Tanggal selesai pendaftaran</label>
                <div class="input-icon-group">
                    <i class="fa-regular fa-calendar-days input-icon"></i>
                    <input type="date" id="tanggal_selesai" name="tanggal_selesai" class="form-control with-icon"
                           value="<?= html_escape($tgl('tanggal_selesai')); ?>">
                </div>
            </div>

            <div class="col-12">
                <label class="form-label required" id="statusLabel">Status PPDB</label>
                <div class="status-toggle" id="statusToggle" role="switch" tabindex="0"
                     aria-checked="<?= $aktif ? 'true' : 'false'; ?>" aria-labelledby="statusLabel">
                    <div class="status-toggle-icon">
                        <i class="fa-solid <?= $aktif ? 'fa-circle-check' : 'fa-circle-xmark'; ?>"></i>
                    </div>
                    <div class="status-toggle-text">
                        <strong>Status PPDB</strong>
                        <span id="statusDesc"><?= $aktif ? 'Aktif. Klik untuk menonaktifkan.' : 'Nonaktif. Klik untuk mengaktifkan.'; ?></span>
                    </div>
                    <span class="switch" aria-hidden="true"><span class="knob"></span></span>
                    <input type="hidden" name="status" id="statusInput" value="<?= $aktif ? 'aktif' : 'nonaktif'; ?>">
                </div>
            </div>

            <?php foreach ($textareas as $t): ?>
                <div class="col-12">
                    <label class="form-label" for="<?= $t[0]; ?>"><?= html_escape($t[1]); ?></label>
                    <textarea id="<?= $t[0]; ?>" name="<?= $t[0]; ?>" rows="5" class="form-control custom-textarea"
                              data-counter="<?= $t[0]; ?>Count"
                              placeholder="<?= html_escape($t[2]); ?>"><?= html_escape($val($t[0])); ?></textarea>
                    <div class="form-hint">
                        <span><i class="fa-solid fa-circle-info"></i><?= html_escape($t[3]); ?></span>
                        <span class="char-count"><b id="<?= $t[0]; ?>Count">0</b> karakter</span>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>
    </div>

    <div class="form-footer">
        <a href="<?= site_url('admin/ppdb'); ?>" class="btn-cancel">
            <i class="fa-solid fa-xmark"></i> Batal
        </a>
        <button type="submit" class="btn-save">
            <i class="fa-solid fa-floppy-disk"></i> <?= html_escape($submit_label); ?>
        </button>
    </div>
</form>
