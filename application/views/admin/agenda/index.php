<?php
$agenda = $agenda ?? [];
$bulan  = [1 => 'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
?>
<?php $this->load->view('admin/template/header'); ?>
<?php $this->load->view('admin/template/sidebar'); ?>

<div class="main-content">
	<?php $this->load->view('admin/template/navbar'); ?>

	<div class="content-wrapper">

		<!-- 1. FLASH MESSAGE -->
		<?php $this->load->view('admin/agenda/_flash'); ?>

		<!-- 2. PAGE HEADER -->
		<div class="page-header-custom mb-4">
			<div class="d-flex align-items-center gap-3">
				<div class="page-header-icon">
					<i class="fa-solid fa-calendar-days"></i>
				</div>
				<div>
					<span class="badge-header-tag mb-1">
						<i class="fa-solid fa-layer-group me-1"></i> Manajemen Kegiatan
					</span>
					<h2 class="page-title">Agenda</h2>
					<p class="page-subtitle">Kelola agenda dan kegiatan SMA Negeri Tawangmangu.</p>
				</div>
			</div>
			<a href="<?= site_url('admin/agenda/tambah'); ?>" class="btn-add">
				<i class="fa-solid fa-plus me-2"></i>
				Tambah Agenda
			</a>
		</div>

		<!-- 3. TABEL AGENDA -->
		<div class="custom-card">
			<div class="card-title-custom has-toolbar justify-content-between">
				<div class="d-flex align-items-center gap-3">
					<div class="title-icon">
						<i class="fa-solid fa-calendar-days"></i>
					</div>
					<div>
						<h5>Daftar Agenda</h5>
						<small>Semua kegiatan yang tercatat di agenda sekolah</small>
					</div>
				</div>
				<div class="d-flex align-items-center gap-3 flex-wrap toolbar-right">
					<div class="table-search-group">
						<i class="fa-solid fa-magnifying-glass table-search-icon"></i>
						<input type="text" id="agenda-search-input" class="table-search-input"
							placeholder="Cari judul, lokasi, tanggal..." aria-label="Cari agenda">
					</div>
					<div class="filter-chips" role="group" aria-label="Filter status">
						<button type="button" class="filter-chip is-active" data-filter="all" aria-pressed="true">Semua</button>
						<button type="button" class="filter-chip" data-filter="aktif" aria-pressed="false">Aktif</button>
						<button type="button" class="filter-chip" data-filter="nonaktif" aria-pressed="false">Nonaktif</button>
					</div>
					<div class="total-badge">
						<i class="fa-solid fa-calendar-days me-1"></i>
						<span id="agenda-count"><?= count($agenda); ?></span>&nbsp;Agenda
					</div>
				</div>
			</div>

			<div class="table-responsive">
				<table class="table custom-table align-middle mb-0">
					<thead>
						<tr>
							<th width="60" class="text-center">No</th>
							<th>Judul Agenda</th>
							<th>Tanggal</th>
							<th>Lokasi</th>
							<th class="text-center">Status</th>
							<th width="120" class="text-end">Aksi</th>
						</tr>
					</thead>
					<tbody id="agenda-table-body">
						<?php if (!empty($agenda)): ?>
							<?php foreach ($agenda as $idx => $item): ?>
								<?php
								$ts         = !empty($item->tanggal) ? strtotime($item->tanggal) : false;
								$tgl_text   = ($ts && $ts > 0) ? date('j', $ts) . ' ' . $bulan[(int) date('n', $ts)] . ' ' . date('Y', $ts) : '-';
								$deskripsi  = trim(strip_tags($item->deskripsi ?? ''));
								$ringkas    = ($deskripsi !== '') ? mb_strimwidth($deskripsi, 0, 80, '…', 'UTF-8') : 'Tanpa deskripsi';
								$is_active  = (($item->status ?? '') === 'aktif');
								$search_key = mb_strtolower(($item->judul ?? '') . ' ' . ($item->lokasi ?? '') . ' ' . $tgl_text, 'UTF-8');
								?>
								<tr class="agenda-row" style="--i: <?= min((int) $idx, 8); ?>"
									data-status="<?= $is_active ? 'aktif' : 'nonaktif'; ?>"
									data-search="<?= html_escape($search_key); ?>">

									<!-- NO -->
									<td class="text-center fw-semibold text-subtle"><?= (int) $idx + 1; ?></td>

									<!-- JUDUL -->
									<td>
										<div class="item-title"><?= html_escape($item->judul ?? '-'); ?></div>
										<div class="item-meta"><?= html_escape($ringkas); ?></div>
									</td>

									<!-- TANGGAL -->
									<td>
										<span class="meta-line">
											<i class="fa-regular fa-calendar-days"></i>
											<span><?= html_escape($tgl_text); ?></span>
										</span>
									</td>

									<!-- LOKASI -->
									<td>
										<?php if (!empty($item->lokasi)): ?>
											<span class="meta-line">
												<i class="fa-solid fa-location-dot"></i>
												<span title="<?= html_escape($item->lokasi); ?>"><?= html_escape($item->lokasi); ?></span>
											</span>
										<?php else: ?>
											<span class="text-subtle">-</span>
										<?php endif; ?>
									</td>

									<!-- STATUS -->
									<td class="text-center">
										<span class="status-badge <?= $is_active ? 'active' : 'inactive'; ?>">
											<?= $is_active ? 'Aktif' : 'Nonaktif'; ?>
										</span>
									</td>

									<!-- AKSI -->
									<td class="text-end">
										<div class="action-buttons justify-content-end">
											<a href="<?= site_url('admin/agenda/edit/' . $item->id); ?>" class="btn-action edit"
												title="Edit agenda" aria-label="Edit agenda <?= html_escape($item->judul ?? ''); ?>">
												<i class="fa-solid fa-pen-to-square"></i>
											</a>
											<a href="<?= site_url('admin/agenda/hapus/' . $item->id); ?>" class="btn-action delete"
												title="Hapus agenda" aria-label="Hapus agenda <?= html_escape($item->judul ?? ''); ?>"
												onclick="return confirm('Yakin ingin menghapus agenda ini?');">
												<i class="fa-solid fa-trash-can"></i>
											</a>
										</div>
									</td>
								</tr>
							<?php endforeach; ?>

							<!-- EMPTY STATE: TIDAK DITEMUKAN -->
							<tr id="agenda-no-result" class="no-hover d-none">
								<td colspan="6" class="empty-data">
									<div class="empty-icon">
										<i class="fa-solid fa-magnifying-glass"></i>
									</div>
									<div class="empty-title">Tidak ditemukan</div>
									<p class="empty-text mb-0">Tidak ada agenda yang cocok dengan pencarian atau filter.</p>
								</td>
							</tr>
						<?php else: ?>
							<!-- EMPTY STATE: BELUM ADA DATA -->
							<tr class="no-hover">
								<td colspan="6" class="empty-data">
									<div class="empty-icon">
										<i class="fa-solid fa-calendar-xmark"></i>
									</div>
									<div class="empty-title">Belum ada agenda</div>
									<p class="empty-text mb-3">Tambahkan kegiatan pertama untuk mulai mengisi agenda sekolah.</p>
									<a href="<?= site_url('admin/agenda/tambah'); ?>" class="btn-add">
										<i class="fa-solid fa-plus me-2"></i> Tambah Agenda
									</a>
								</td>
							</tr>
						<?php endif; ?>
					</tbody>
				</table>
			</div>
		</div>

	</div>
</div>

<?php $this->load->view('admin/agenda/_assets'); ?>

<style>
	.text-subtle { color: var(--agenda-subtitle) !important; }

	/* ===================== TOOLBAR: PENCARIAN & FILTER ===================== */
	.table-search-group {
		position: relative;
		display: flex;
		align-items: center;
	}

	.table-search-icon {
		position: absolute;
		left: 14px;
		color: var(--agenda-subtitle);
		font-size: 13px;
		pointer-events: none;
	}

	.table-search-input {
		min-width: 220px;
		padding: 8px 14px 8px 36px;
		background: var(--agenda-card);
		border: 1px solid var(--agenda-border);
		border-radius: 10px;
		color: var(--agenda-title);
		font-size: 13px;
		transition: all 0.25s ease;
	}

	.table-search-input::placeholder {
		color: var(--agenda-subtitle);
		opacity: 0.75;
	}

	.table-search-input:hover:not(:focus) { border-color: var(--agenda-accent); }

	.table-search-input:focus {
		outline: none;
		border-color: var(--agenda-accent);
		box-shadow: 0 0 0 3px var(--agenda-glow);
	}

	.filter-chips {
		display: inline-flex;
		gap: 2px;
		padding: 3px;
		background: var(--agenda-card);
		border: 1px solid var(--agenda-border);
		border-radius: 999px;
	}

	.filter-chip {
		padding: 5px 12px;
		background: transparent;
		border: 0;
		border-radius: 999px;
		color: var(--agenda-subtitle);
		font-size: 12px;
		font-weight: 700;
		cursor: pointer;
		transition: all 0.2s ease;
	}

	.filter-chip:hover { color: var(--agenda-title); }

	.filter-chip.is-active {
		background: var(--agenda-soft);
		color: var(--agenda-accent);
		box-shadow: inset 0 0 0 1px var(--agenda-soft-border);
	}

	.filter-chip:focus-visible,
	.btn-action:focus-visible {
		outline: 2px solid var(--agenda-accent);
		outline-offset: 2px;
	}

	/* ===================== TABEL ===================== */
	.custom-table {
		--bs-table-bg: transparent;
		--bs-table-color: var(--agenda-title);
		--bs-table-border-color: var(--agenda-border);
		color: var(--agenda-title);
		margin-bottom: 0;
	}

	.custom-table thead th {
		padding: 16px 20px;
		background: var(--agenda-subtle);
		color: var(--agenda-subtitle);
		border-bottom: 1px solid var(--agenda-border);
		font-size: 11px;
		font-weight: 700;
		text-transform: uppercase;
		letter-spacing: 0.6px;
		white-space: nowrap;
	}

	.custom-table tbody td {
		padding: 16px 20px;
		background: transparent;
		color: var(--agenda-title);
		border-bottom: 1px solid var(--agenda-border);
		font-size: 13.5px;
	}

	.custom-table tbody tr:last-child td { border-bottom: 0; }

	.custom-table tbody tr { transition: background-color 0.2s ease; }
	.custom-table tbody tr:hover { background-color: var(--agenda-hover); }
	.custom-table tbody tr.no-hover:hover { background-color: transparent; }

	.custom-table tbody tr.agenda-row {
		animation: agendaRowIn 0.3s ease both;
		animation-delay: calc(var(--i, 0) * 0.05s);
	}

	@keyframes agendaRowIn {
		from { opacity: 0; transform: translateX(-6px); }
		to { opacity: 1; transform: translateX(0); }
	}

	.item-title {
		max-width: 360px;
		color: var(--agenda-title);
		font-size: 14px;
		font-weight: 700;
	}

	.item-meta {
		max-width: 340px;
		margin-top: 2px;
		color: var(--agenda-subtitle);
		font-size: 11.5px;
		overflow: hidden;
		text-overflow: ellipsis;
		white-space: nowrap;
	}

	.meta-line {
		display: inline-flex;
		align-items: center;
		gap: 8px;
		color: var(--agenda-title);
		font-weight: 500;
	}

	.meta-line i {
		color: var(--agenda-accent);
		font-size: 13px;
	}

	.meta-line span {
		max-width: 220px;
		overflow: hidden;
		text-overflow: ellipsis;
		white-space: nowrap;
	}

	/* ===================== STATUS BADGE ===================== */
	.status-badge {
		display: inline-flex;
		align-items: center;
		gap: 7px;
		padding: 5px 12px;
		border: 1px solid transparent;
		border-radius: 999px;
		font-size: 11.5px;
		font-weight: 700;
	}

	.status-badge::before {
		content: "";
		width: 6px;
		height: 6px;
		border-radius: 50%;
		background: currentColor;
	}

	.status-badge.active {
		background: rgba(16, 185, 129, 0.12);
		border-color: rgba(16, 185, 129, 0.28);
		color: var(--agenda-success);
	}

	.status-badge.active::before { animation: agendaPulse 1.8s ease-in-out infinite; }

	.status-badge.inactive {
		background: rgba(239, 68, 68, 0.12);
		border-color: rgba(239, 68, 68, 0.28);
		color: var(--agenda-danger);
	}

	@keyframes agendaPulse {
		0%, 100% { opacity: 1; box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.5); }
		50% { opacity: 0.7; box-shadow: 0 0 0 3px rgba(16, 185, 129, 0); }
	}

	/* ===================== TOMBOL AKSI ===================== */
	.action-buttons {
		display: flex;
		gap: 8px;
	}

	.btn-action {
		width: 36px;
		height: 36px;
		border-radius: 10px;
		display: inline-flex;
		align-items: center;
		justify-content: center;
		font-size: 13px;
		text-decoration: none;
		transition: all 0.25s ease;
	}

	.btn-action.edit {
		background: var(--agenda-subtle);
		color: var(--agenda-title);
		border: 1px solid var(--agenda-border);
	}

	.btn-action.edit:hover {
		background: var(--agenda-accent);
		border-color: var(--agenda-accent);
		color: #ffffff;
		transform: translateY(-2px);
	}

	.btn-action.delete {
		background: rgba(239, 68, 68, 0.10);
		color: #f87171;
		border: 1px solid rgba(239, 68, 68, 0.2);
	}

	.btn-action.delete:hover {
		background: #ef4444;
		border-color: #ef4444;
		color: #ffffff;
		transform: translateY(-2px);
	}

	/* ===================== EMPTY STATE ===================== */
	.custom-table tbody td.empty-data {
		padding: 60px 20px;
		text-align: center;
		border-bottom: 0;
	}

	.empty-icon {
		width: 64px;
		height: 64px;
		margin: 0 auto 16px;
		border-radius: 18px;
		background: var(--agenda-soft);
		color: var(--agenda-accent);
		display: flex;
		align-items: center;
		justify-content: center;
		font-size: 26px;
	}

	.empty-title {
		margin-bottom: 4px;
		color: var(--agenda-title);
		font-size: 15px;
		font-weight: 700;
	}

	.empty-text {
		color: var(--agenda-subtitle);
		font-size: 12.5px;
	}

	/* ===================== RESPONSIF ===================== */
	@media (max-width: 768px) {
		.card-title-custom.has-toolbar {
			flex-direction: column;
			align-items: flex-start;
		}

		.toolbar-right {
			width: 100%;
			justify-content: space-between;
		}

		.table-search-group { flex: 1 1 100%; }

		.table-search-input {
			width: 100%;
			min-width: 0;
		}

		.custom-table thead th,
		.custom-table tbody td { padding: 14px 16px; }
	}

	/* ===================== REDUCED MOTION ===================== */
	@media (prefers-reduced-motion: reduce) {
		.agenda-row,
		.status-badge.active::before,
		.btn-action,
		.table-search-input,
		.filter-chip {
			animation: none !important;
			transition: none !important;
		}
	}
</style>

<script>
	document.addEventListener('DOMContentLoaded', function () {
		var searchInput = document.getElementById('agenda-search-input');
		var tbody = document.getElementById('agenda-table-body');
		var countEl = document.getElementById('agenda-count');
		var noResultRow = document.getElementById('agenda-no-result');
		var chips = document.querySelectorAll('.filter-chip');

		if (!searchInput || !tbody) return;

		var rows = tbody.querySelectorAll('.agenda-row');
		var activeFilter = 'all';

		function applyFilter() {
			var keyword = searchInput.value.trim().toLowerCase();
			var visibleCount = 0;

			rows.forEach(function (row) {
				var matchStatus = activeFilter === 'all' || row.getAttribute('data-status') === activeFilter;
				var matchKeyword = row.getAttribute('data-search').indexOf(keyword) !== -1;
				var match = matchStatus && matchKeyword;
				row.classList.toggle('d-none', !match);
				if (match) visibleCount++;
			});

			if (countEl) countEl.textContent = visibleCount;
			if (noResultRow) noResultRow.classList.toggle('d-none', visibleCount !== 0 || rows.length === 0);
		}

		searchInput.addEventListener('input', applyFilter);

		chips.forEach(function (chip) {
			chip.addEventListener('click', function () {
				activeFilter = chip.getAttribute('data-filter');
				chips.forEach(function (c) {
					var isActive = c === chip;
					c.classList.toggle('is-active', isActive);
					c.setAttribute('aria-pressed', isActive ? 'true' : 'false');
				});
				applyFilter();
			});
		});
	});
</script>

<?php $this->load->view('admin/template/footer'); ?>