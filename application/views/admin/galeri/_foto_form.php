<?php
/**
 * Form foto (dipakai foto_tambah.php dan foto_edit.php).
 *
 * Variabel yang dikirim:
 *   $form_mode  : 'tambah' | 'edit'
 *   $form_data  : objek foto (mode edit) atau null (mode tambah)
 *   $form_album : objek album induk
 */
$is_edit   = (isset($form_mode) && $form_mode === 'edit' && !empty($form_data));
$row       = $is_edit ? $form_data : null;
$album_row = $form_album;

$max_mb   = 4;    // batas ukuran upload (MB), samakan dengan konfigurasi controller
$desc_max = 500;

$back_url = site_url('admin/galeri/foto/' . (int) $album_row->id);
$action   = $is_edit
    ? site_url('admin/galeri/foto_update/' . (int) $row->id . '/' . (int) $album_row->id)
    : site_url('admin/galeri/foto_simpan');

$foto_file = !empty($row->foto) ? basename($row->foto) : '';
$foto_url  = $foto_file !== '' ? base_url('assets/img/galeri/' . rawurlencode($foto_file)) : '';
$has_foto  = $foto_url !== '';
$deskripsi = $row->deskripsi ?? '';
?>
<form id="form-galeri" action="<?= $action; ?>" method="POST" enctype="multipart/form-data">
    <?php if (!$is_edit): ?>
        <input type="hidden" name="album_id" value="<?= (int) $album_row->id; ?>">
    <?php else: ?>
        <input type="hidden" name="foto_lama" value="<?= html_escape($row->foto ?? ''); ?>">
    <?php endif; ?>

    <div class="custom-card mb-4">

        <div class="card-title-custom">
            <div class="d-flex align-items-center gap-3">
                <div class="title-icon">
                    <i class="fa-solid fa-image"></i>
                </div>
                <div>
                    <h5>Informasi Foto</h5>
                    <small>Foto untuk album <?= html_escape($album_row->nama_album); ?></small>
                </div>
            </div>
        </div>

        <div class="card-body-custom">
            <div class="row g-4">

                <!-- JUDUL -->
                <div class="col-12">
                    <label class="form-label" for="foto-judul">Judul Foto</label>
                    <div class="input-icon-group">
                        <i class="fa-solid fa-heading input-icon"></i>
                        <input type="text" id="foto-judul" name="judul" class="form-control with-icon"
                            value="<?= html_escape($row->judul ?? ''); ?>"
                            placeholder="Masukkan judul foto">
                    </div>
                </div>

                <!-- UPLOAD FOTO -->
                <div class="col-12">
                    <label class="form-label<?= $is_edit ? '' : ' required'; ?>">
                        <?= $is_edit ? 'Ganti Foto' : 'File Foto'; ?>
                    </label>

                    <div class="upload-dropzone" id="uploadDropzone" role="button" tabindex="0"
                        aria-label="Pilih atau seret foto ke sini" aria-describedby="uploadError"
                        data-max-mb="<?= $max_mb; ?>" data-has-initial="<?= $has_foto ? '1' : '0'; ?>">

                        <input type="file" name="foto" id="fotoInput" class="upload-input" tabindex="-1"
                            accept="image/png, image/jpeg, image/jpg, image/webp"
                            <?= $is_edit ? '' : 'required'; ?>>

                        <div class="upload-content text-center<?= $has_foto ? ' d-none' : ''; ?>" id="uploadPlaceholder">
                            <div class="upload-icon-circle mb-2">
                                <i class="fa-solid fa-cloud-arrow-up"></i>
                            </div>
                            <p class="upload-text mb-1"><strong>Klik atau seret file ke sini untuk mengunggah</strong></p>
                            <span class="upload-subtext">PNG, JPG, JPEG, atau WEBP (Maksimal <?= $max_mb; ?>MB)</span>
                        </div>

                        <div class="preview-container text-center<?= $has_foto ? '' : ' d-none'; ?>" id="previewWrapper">
                            <img id="imgPreview" class="preview-image mb-2" alt="Pratinjau foto"
                                <?= $has_foto ? 'src="' . $foto_url . '"' : ''; ?>>
                            <div class="d-flex align-items-center justify-content-center gap-2">
                                <span class="preview-filename text-truncate d-inline-block" id="previewFilename"><?= html_escape($foto_file); ?></span>
                                <span class="preview-badge" id="previewBadge"><?= $is_edit ? 'Foto saat ini' : 'Foto baru'; ?></span>
                            </div>
                        </div>
                    </div>

                    <div class="upload-error d-none" id="uploadError" role="alert">
                        <i class="fa-solid fa-circle-exclamation"></i>
                        <span id="uploadErrorText"></span>
                    </div>

                    <?php if ($is_edit): ?>
                        <div class="form-hint">
                            <span><i class="fa-solid fa-circle-info me-1"></i>Kosongkan jika tidak ingin mengganti foto.</span>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- DESKRIPSI -->
                <div class="col-12">
                    <label class="form-label" for="foto-deskripsi">Deskripsi</label>
                    <textarea id="foto-deskripsi" name="deskripsi" class="form-control custom-textarea" rows="5"
                        maxlength="<?= $desc_max; ?>" data-counter="foto-deskripsi-count"
                        placeholder="Tuliskan keterangan singkat foto..."><?= html_escape($deskripsi); ?></textarea>
                    <div class="form-hint">
                        <span><i class="fa-solid fa-circle-info me-1"></i>Opsional. Tampil di kartu foto.</span>
                        <span class="char-counter"><span id="foto-deskripsi-count">0</span>/<?= $desc_max; ?></span>
                    </div>
                </div>

            </div>
        </div>

        <!-- FOOTER / BUTTONS -->
        <div class="form-footer">
            <a href="<?= $back_url; ?>" class="btn-cancel">
                <i class="fa-solid fa-xmark me-2"></i> Batal
            </a>
            <button type="submit" id="btn-submit-galeri" class="btn-save">
                <span class="btn-save-content">
                    <i class="fa-solid fa-floppy-disk me-2"></i>
                    <?= $is_edit ? 'Simpan Perubahan' : 'Simpan Foto'; ?>
                </span>
                <span class="btn-save-spinner"></span>
            </button>
        </div>

    </div>
</form>
