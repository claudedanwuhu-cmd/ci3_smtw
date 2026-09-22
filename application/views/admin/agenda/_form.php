<?php
/**
 * Form Agenda (dipakai tambah & edit).
 *
 * Variabel yang diterima:
 *   $form_action  string  URL action form
 *   $submit_label string  Label tombol simpan
 *   $item         object|null  Data agenda (null saat tambah)
 */
$item         = $item ?? null;
$form_action  = $form_action ?? site_url('admin/agenda/simpan');
$submit_label = $submit_label ?? 'Simpan Agenda';

$status_value = (isset($item->status) && $item->status === 'nonaktif') ? 'nonaktif' : 'aktif';
$is_active    = ($status_value === 'aktif');

$tanggal_value = '';
if (!empty($item->tanggal) && strtotime($item->tanggal) > 0) {
	$tanggal_value = date('Y-m-d', strtotime($item->tanggal));
}
?>
<form id="form-agenda" action="<?= $form_action; ?>" method="POST">
	<div class="custom-card mb-4">

		<div class="card-title-custom">
			<div class="title-icon">
				<i class="fa-solid fa-calendar-days"></i>
			</div>
			<div>
				<h5>Informasi Agenda</h5>
				<small>Lengkapi data kegiatan sekolah</small>
			</div>
		</div>

		<div class="card-body-custom">
			<div class="row g-4">

				<!-- JUDUL -->
				<div class="col-md-8">
					<label class="form-label required" for="judul-input">Judul Agenda</label>
					<div class="input-icon-group">
						<i class="fa-solid fa-heading input-icon"></i>
						<input type="text" id="judul-input" name="judul" class="form-control with-icon"
							value="<?= html_escape($item->judul ?? ''); ?>"
							placeholder="Contoh: Upacara Hari Kemerdekaan" required>
					</div>
				</div>

				<!-- TANGGAL -->
				<div class="col-md-4">
					<label class="form-label" for="tanggal-input">Tanggal</label>
					<div class="input-icon-group">
						<i class="fa-regular fa-calendar-days input-icon"></i>
						<input type="date" id="tanggal-input" name="tanggal" class="form-control with-icon"
							value="<?= html_escape($tanggal_value); ?>">
					</div>
				</div>

				<!-- LOKASI -->
				<div class="col-md-6">
					<label class="form-label" for="lokasi-input">Lokasi</label>
					<div class="input-icon-group">
						<i class="fa-solid fa-location-dot input-icon"></i>
						<input type="text" id="lokasi-input" name="lokasi" class="form-control with-icon"
							value="<?= html_escape($item->lokasi ?? ''); ?>"
							placeholder="Contoh: Lapangan Upacara / Aula Sekolah">
					</div>
				</div>

				<!-- STATUS KEAKTIFAN -->
				<div class="col-md-6">
					<div class="form-label" id="status-label">Status Keaktifan</div>
					<div class="status-toggle <?= $is_active ? 'is-active' : ''; ?>" id="status-toggle"
						role="switch" tabindex="0" aria-labelledby="status-label"
						aria-checked="<?= $is_active ? 'true' : 'false'; ?>">
						<div class="status-toggle-icon">
							<i class="fa-solid <?= $is_active ? 'fa-circle-check' : 'fa-circle-xmark'; ?>" id="status-icon"></i>
						</div>
						<div class="status-toggle-text">
							<strong id="status-text"><?= $is_active ? 'Aktif' : 'Nonaktif'; ?></strong>
							<small id="status-desc"><?= $is_active ? 'Agenda sedang berlaku' : 'Agenda tidak berlaku'; ?></small>
						</div>
						<span class="status-switch"><span class="status-knob"></span></span>
					</div>
					<input type="hidden" name="status" id="status-input" value="<?= $status_value; ?>">
				</div>

				<!-- DESKRIPSI -->
				<div class="col-md-12">
					<label class="form-label" for="deskripsi-input">Deskripsi</label>
					<textarea id="deskripsi-input" name="deskripsi" class="form-control custom-textarea" rows="6"
						maxlength="1000"
						placeholder="Tuliskan waktu, peserta, atau hal penting tentang kegiatan ini..."><?= html_escape($item->deskripsi ?? ''); ?></textarea>
					<div class="form-hint">
						<span><i class="fa-solid fa-circle-info me-1"></i> Deskripsi singkat membantu pengunjung memahami kegiatan.</span>
						<span><span id="deskripsi-count">0</span> / 1000</span>
					</div>
				</div>

			</div>
		</div>

		<!-- FOOTER / BUTTONS -->
		<div class="form-footer">
			<a href="<?= site_url('admin/agenda'); ?>" class="btn-cancel">
				<i class="fa-solid fa-xmark me-2"></i> Batal
			</a>
			<button type="submit" id="btn-submit-agenda" class="btn-save">
				<span class="btn-save-content">
					<i class="fa-solid fa-floppy-disk me-2"></i>
					<?= html_escape($submit_label); ?>
				</span>
				<span class="btn-save-spinner"></span>
			</button>
		</div>

	</div>
</form>