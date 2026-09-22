<?php
/**
 * Partial form File Download (dipakai tambah.php dan edit.php).
 *
 * Variabel yang diterima:
 *   $action       string       URL tujuan form
 *   $submit_label string       Label tombol simpan
 *   $download     object|null  Data lama (null = mode tambah)
 */
$download     = $download ?? null;
$is_edit      = !empty($download);
$submit_label = $submit_label ?? 'Simpan';

$val = function ($field) use ($download) {
    return (!empty($download) && isset($download->$field)) ? (string) $download->$field : '';
};

$judul      = $val('judul');
$kategori   = $val('kategori');
$keterangan = $val('keterangan');
$file_name  = $val('file');
$tanggal    = $is_edit
    ? (!empty($download->tanggal) ? date('Y-m-d', strtotime($download->tanggal)) : '')
    : date('Y-m-d');

$kategori_list = ['Akademik', 'Administrasi', 'PPDB', 'Formulir', 'Lainnya'];
if ($kategori !== '' && !in_array($kategori, $kategori_list, true)) {
    $kategori_list[] = $kategori; // pertahankan nilai lama yang tidak ada di daftar
}
?>
<form id="download-form" action="<?= html_escape($action); ?>" method="post" enctype="multipart/form-data">
    <?php if (config_item('csrf_protection') === TRUE): ?>
        <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
    <?php endif; ?>

    <div class="card-body-custom">
        <div class="row g-4">

            <!-- Judul -->
            <div class="col-md-8">
                <label class="form-label required" for="download-judul">Judul</label>
                <div class="input-icon-group">
                    <i class="fa-solid fa-heading input-icon"></i>
                    <input type="text" id="download-judul" name="judul" class="form-control custom-input with-icon"
                           value="<?= html_escape($judul); ?>" placeholder="Masukkan judul file" required>
                </div>
            </div>

            <!-- Kategori -->
            <div class="col-md-4">
                <label class="form-label" for="download-kategori">Kategori</label>
                <div class="input-icon-group">
                    <i class="fa-solid fa-folder input-icon"></i>
                    <select id="download-kategori" name="kategori" class="form-select custom-input with-icon">
                        <option value="">Umum</option>
                        <?php foreach ($kategori_list as $opt): ?>
                            <option value="<?= html_escape($opt); ?>" <?= ($opt === $kategori) ? 'selected' : ''; ?>><?= html_escape($opt); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <!-- File -->
            <div class="col-md-8">
                <label class="form-label <?= $is_edit ? '' : 'required'; ?>" for="download-file-input"><?= $is_edit ? 'Ganti File' : 'File'; ?></label>

                <div class="dropzone" id="download-dropzone" role="button" tabindex="0"
                     aria-label="Pilih atau seret file ke area ini"
                     data-max-mb="10" data-allowed="pdf,doc,docx,xls,xlsx,zip">
                    <input type="file" name="file" id="download-file-input" class="file-input-hidden" tabindex="-1"
                           accept=".pdf,.doc,.docx,.xls,.xlsx,.zip" <?= $is_edit ? '' : 'required'; ?>>
                    <div class="dropzone-icon"><i class="fa-solid fa-cloud-arrow-up"></i></div>
                    <div class="dropzone-text">
                        <strong id="download-dropzone-label"><?= $is_edit ? 'Klik atau seret file baru ke sini' : 'Klik atau seret file ke sini'; ?></strong>
                        <small id="download-dropzone-hint">PDF, DOC, DOCX, XLS, XLSX, ZIP &bull; Maksimal 10 MB</small>
                    </div>
                </div>
                <div class="dropzone-error" id="download-dropzone-error" role="alert"></div>

                <?php if ($is_edit): ?>
                    <input type="hidden" name="file_lama" value="<?= html_escape($file_name); ?>">
                    <div class="current-file">
                        <div class="current-file-icon"><i class="fa-solid fa-file-lines"></i></div>
                        <div>
                            <small>File saat ini</small>
                            <strong><?= !empty($file_name) ? html_escape(basename($file_name)) : '-'; ?></strong>
                        </div>
                    </div>
                    <div class="form-hint">
                        <span><i class="fa-solid fa-circle-info"></i>Kosongkan jika tidak ingin mengganti file.</span>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Tanggal -->
            <div class="col-md-4">
                <label class="form-label" for="download-tanggal">Tanggal</label>
                <div class="input-icon-group">
                    <i class="fa-regular fa-calendar-days input-icon"></i>
                    <input type="date" id="download-tanggal" name="tanggal" class="form-control custom-input with-icon"
                           value="<?= html_escape($tanggal); ?>">
                </div>
            </div>

            <!-- Keterangan -->
            <div class="col-12">
                <label class="form-label" for="download-keterangan">Keterangan</label>
                <textarea id="download-keterangan" name="keterangan" rows="6"
                          class="form-control custom-input custom-textarea"
                          placeholder="Masukkan keterangan file..."><?= html_escape($keterangan); ?></textarea>
                <div class="form-hint">
                    <span><i class="fa-solid fa-circle-info"></i>Jelaskan isi dokumen secara singkat.</span>
                    <span><span id="download-keterangan-count">0</span> karakter</span>
                </div>
            </div>

        </div>
    </div>

    <div class="form-footer">
        <a href="<?= site_url('admin/download'); ?>" class="btn-cancel">
            <i class="fa-solid fa-xmark me-2"></i>
            Batal
        </a>
        <button type="submit" class="btn-save">
            <i class="fa-solid fa-floppy-disk me-2"></i>
            <?= html_escape($submit_label); ?>
        </button>
    </div>
</form>
