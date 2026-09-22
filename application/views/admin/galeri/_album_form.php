<?php
/**
 * Form album (dipakai album_tambah.php dan album_edit.php).
 *
 * Variabel yang dikirim:
 *   $form_mode : 'tambah' | 'edit'
 *   $form_data : objek album (mode edit) atau null (mode tambah)
 */
$is_edit   = (isset($form_mode) && $form_mode === 'edit' && !empty($form_data));
$row       = $is_edit ? $form_data : null;
$action    = $is_edit
    ? site_url('admin/galeri/album_update/' . (int) $row->id)
    : site_url('admin/galeri/album_simpan');
$tanggal   = (!empty($row->tanggal) && $row->tanggal !== '0000-00-00')
    ? date('Y-m-d', strtotime($row->tanggal))
    : '';
$deskripsi = $row->deskripsi ?? '';
$desc_max  = 500;
?>
<form id="form-galeri" action="<?= $action; ?>" method="POST">
    <div class="custom-card mb-4">

        <div class="card-title-custom">
            <div class="d-flex align-items-center gap-3">
                <div class="title-icon">
                    <i class="fa-solid fa-folder-open"></i>
                </div>
                <div>
                    <h5>Informasi Album</h5>
                    <small>Isi nama, deskripsi, dan tanggal kegiatan album</small>
                </div>
            </div>
        </div>

        <div class="card-body-custom">
            <div class="row g-4">

                <!-- NAMA ALBUM -->
                <div class="col-12">
                    <label class="form-label required" for="album-nama">Nama Album</label>
                    <div class="input-icon-group">
                        <i class="fa-solid fa-folder input-icon"></i>
                        <input type="text" id="album-nama" name="nama_album" class="form-control with-icon"
                            value="<?= html_escape($row->nama_album ?? ''); ?>"
                            placeholder="Masukkan nama album" required>
                    </div>
                </div>

                <!-- DESKRIPSI -->
                <div class="col-12">
                    <label class="form-label" for="album-deskripsi">Deskripsi</label>
                    <textarea id="album-deskripsi" name="deskripsi" class="form-control custom-textarea" rows="5"
                        maxlength="<?= $desc_max; ?>" data-counter="album-deskripsi-count"
                        placeholder="Tuliskan deskripsi singkat album..."><?= html_escape($deskripsi); ?></textarea>
                    <div class="form-hint">
                        <span><i class="fa-solid fa-circle-info me-1"></i>Opsional. Tampil di kartu album.</span>
                        <span class="char-counter"><span id="album-deskripsi-count">0</span>/<?= $desc_max; ?></span>
                    </div>
                </div>

                <!-- TANGGAL -->
                <div class="col-md-4">
                    <label class="form-label" for="album-tanggal">Tanggal</label>
                    <div class="input-icon-group">
                        <i class="fa-regular fa-calendar-days input-icon"></i>
                        <input type="date" id="album-tanggal" name="tanggal" class="form-control with-icon"
                            value="<?= html_escape($tanggal); ?>">
                    </div>
                </div>

            </div>
        </div>

        <!-- FOOTER / BUTTONS -->
        <div class="form-footer">
            <a href="<?= site_url('admin/galeri'); ?>" class="btn-cancel">
                <i class="fa-solid fa-xmark me-2"></i> Batal
            </a>
            <button type="submit" id="btn-submit-galeri" class="btn-save">
                <span class="btn-save-content">
                    <i class="fa-solid fa-floppy-disk me-2"></i>
                    <?= $is_edit ? 'Simpan Perubahan' : 'Simpan Album'; ?>
                </span>
                <span class="btn-save-spinner"></span>
            </button>
        </div>

    </div>
</form>
