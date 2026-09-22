<?php
/**
 * Halaman daftar pengguna.
 * Variabel: $users (array object: id, nama, username, role, status, foto, created_at)
 */
$users      = (isset($users) && is_array($users)) ? $users : [];
$current_id = (int) $this->session->userdata('user_id');
$lower      = function_exists('mb_strtolower') ? 'mb_strtolower' : 'strtolower';
$bulan      = ['', 'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
?>
<?php $this->load->view('admin/template/header'); ?>
<?php $this->load->view('admin/template/sidebar'); ?>

<div class="main-content">
    <?php $this->load->view('admin/template/navbar'); ?>

    <div class="content-wrapper">

        <!-- 1. FLASH MESSAGE -->
        <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-autodismiss is-success mb-4" role="status" data-autodismiss="4500">
                <div class="alert-icon-box"><i class="fa-solid fa-circle-check"></i></div>
                <div class="alert-content">
                    <strong>Berhasil</strong>
                    <span><?= html_escape($this->session->flashdata('success')); ?></span>
                </div>
                <button type="button" class="btn-close" aria-label="Tutup notifikasi"></button>
                <div class="alert-progress-track"><div class="alert-progress-bar" style="animation-duration: 4500ms;"></div></div>
            </div>
        <?php endif; ?>

        <?php if ($this->session->flashdata('error')): ?>
            <div class="alert alert-autodismiss is-error mb-4" role="alert" data-autodismiss="6000">
                <div class="alert-icon-box"><i class="fa-solid fa-circle-exclamation"></i></div>
                <div class="alert-content">
                    <strong>Gagal memproses data</strong>
                    <span><?= html_escape($this->session->flashdata('error')); ?></span>
                </div>
                <button type="button" class="btn-close" aria-label="Tutup notifikasi"></button>
                <div class="alert-progress-track"><div class="alert-progress-bar" style="animation-duration: 6000ms;"></div></div>
            </div>
        <?php endif; ?>

        <!-- 2. PAGE HEADER -->
        <div class="page-header-custom mb-4">
            <div class="d-flex align-items-center gap-3">
                <div class="page-header-icon">
                    <i class="fa-solid fa-user-shield"></i>
                </div>
                <div>
                    <span class="badge-header-tag mb-1">
                        <i class="fa-solid fa-users-gear me-1"></i> Manajemen User
                    </span>
                    <h2 class="page-title">Manajemen User</h2>
                    <p class="page-subtitle">Kelola akun administrator dan petugas panel admin SMA Negeri Tawangmangu.</p>
                </div>
            </div>
            <a href="<?= site_url('admin/user/tambah'); ?>" class="btn-add">
                <i class="fa-solid fa-plus me-2"></i> Tambah User
            </a>
        </div>

        <!-- 3. CARD TABEL -->
        <div class="custom-card">
            <div class="card-title-custom">
                <div class="d-flex align-items-center gap-3">
                    <div class="title-icon">
                        <i class="fa-solid fa-address-card"></i>
                    </div>
                    <div>
                        <h5>Daftar User</h5>
                        <small>Akun yang memiliki hak akses ke panel admin</small>
                    </div>
                </div>
                <div class="d-flex align-items-center gap-3 flex-wrap toolbar-right">
                    <div class="table-search-group">
                        <i class="fa-solid fa-magnifying-glass table-search-icon"></i>
                        <input type="text" id="user-search-input" class="table-search-input"
                               placeholder="Cari nama, username, role..." aria-label="Cari user" autocomplete="off">
                    </div>
                    <div class="filter-chips" role="group" aria-label="Filter status">
                        <button type="button" class="filter-chip is-active" data-filter="semua" aria-pressed="true">Semua</button>
                        <button type="button" class="filter-chip" data-filter="aktif" aria-pressed="false">Aktif</button>
                        <button type="button" class="filter-chip" data-filter="nonaktif" aria-pressed="false">Nonaktif</button>
                    </div>
                    <span class="total-badge">
                        <i class="fa-solid fa-users me-1"></i>
                        <span id="user-count"><?= count($users); ?></span>&nbsp;Data
                    </span>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table custom-table align-middle mb-0">
                    <thead>
                        <tr>
                            <th width="60" class="text-center">No</th>
                            <th width="80" class="text-center">Foto</th>
                            <th>Nama Lengkap</th>
                            <th>Role</th>
                            <th class="text-center">Status</th>
                            <th>Dibuat</th>
                            <th width="120" class="text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="user-table-body">
                        <?php if (!empty($users)): ?>
                            <?php $no = 1; foreach ($users as $item): ?>
                                <?php
                                $nama     = (string) ($item->nama ?? '');
                                $username = (string) ($item->username ?? '');
                                $role     = (string) ($item->role ?? '');
                                $status   = (($item->status ?? '') === 'aktif') ? 'aktif' : 'nonaktif';
                                $foto     = !empty($item->foto) ? basename(str_replace('\\', '/', (string) $item->foto)) : '';
                                $ts       = !empty($item->created_at) ? strtotime($item->created_at) : false;
                                $dibuat   = $ts ? date('j', $ts) . ' ' . $bulan[(int) date('n', $ts)] . ' ' . date('Y', $ts) : '-';
                                ?>
                                <tr class="user-row" style="--i: <?= min($no, 8); ?>;"
                                    data-status="<?= $status; ?>"
                                    data-search="<?= html_escape($lower($nama . ' ' . $username . ' ' . $role)); ?>">

                                    <td class="text-center cell-no"><?= $no++; ?></td>

                                    <td class="text-center">
                                        <?php if ($foto !== ''): ?>
                                            <img src="<?= html_escape(base_url('assets/img/user/' . rawurlencode($foto))); ?>"
                                                 class="user-photo" alt="Foto <?= html_escape($nama); ?>" loading="lazy">
                                            <div class="user-photo-placeholder mx-auto d-none"><i class="fa-solid fa-user"></i></div>
                                        <?php else: ?>
                                            <div class="user-photo-placeholder mx-auto"><i class="fa-solid fa-user"></i></div>
                                        <?php endif; ?>
                                    </td>

                                    <td>
                                        <div class="user-name"><?= html_escape($nama); ?></div>
                                        <div class="user-sub">@<?= html_escape($username); ?></div>
                                    </td>

                                    <td>
                                        <span class="badge-role">
                                            <i class="fa-solid fa-shield-halved me-1"></i><?= html_escape(ucfirst($role)); ?>
                                        </span>
                                    </td>

                                    <td class="text-center">
                                        <?php if ($status === 'aktif'): ?>
                                            <span class="status-badge active">Aktif</span>
                                        <?php else: ?>
                                            <span class="status-badge inactive">Nonaktif</span>
                                        <?php endif; ?>
                                    </td>

                                    <td class="cell-date"><?= html_escape($dibuat); ?></td>

                                    <td class="text-end">
                                        <div class="action-buttons justify-content-end">
                                            <a href="<?= site_url('admin/user/edit/' . rawurlencode($item->id)); ?>"
                                               class="btn-action edit" title="Edit user"
                                               aria-label="Edit user <?= html_escape($nama); ?>">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                            <?php if ((int) $item->id !== $current_id): ?>
                                                <a href="<?= site_url('admin/user/hapus/' . rawurlencode($item->id)); ?>"
                                                   class="btn-action delete" title="Hapus user"
                                                   aria-label="Hapus user <?= html_escape($nama); ?>"
                                                   onclick="return confirm('Yakin ingin menghapus user ini?');">
                                                    <i class="fa-solid fa-trash-can"></i>
                                                </a>
                                            <?php else: ?>
                                                <span class="btn-action delete is-disabled" title="Akun yang sedang digunakan tidak dapat dihapus"
                                                      aria-label="Akun yang sedang digunakan tidak dapat dihapus" aria-disabled="true">
                                                    <i class="fa-solid fa-lock"></i>
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>

                            <tr id="user-no-result" class="d-none">
                                <td colspan="7" class="empty-data">
                                    <div class="empty-icon"><i class="fa-solid fa-magnifying-glass"></i></div>
                                    <strong class="empty-title">Tidak ditemukan</strong>
                                    <p class="empty-text">Tidak ada user yang cocok dengan pencarian atau filter.</p>
                                </td>
                            </tr>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" class="empty-data">
                                    <div class="empty-icon"><i class="fa-solid fa-users-slash"></i></div>
                                    <strong class="empty-title">Belum ada data</strong>
                                    <p class="empty-text">Belum ada user yang terdaftar di panel admin.</p>
                                    <a href="<?= site_url('admin/user/tambah'); ?>" class="btn-add">
                                        <i class="fa-solid fa-plus me-2"></i> Tambah User
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

<style>
/* =========================================================
   TOKENS
========================================================= */
:root {
    --user-card: #ffffff;        --user-subtle: #f8fafc;
    --user-input-bg: #f8fafc;    --user-input-focus: #ffffff;
    --user-input-border: #cbd5e1;
    --user-border: rgba(226, 232, 240, .8);
    --user-title: #0f172a;       --user-subtitle: #64748b;
    --user-hover: #f1f5f9;
    --user-accent: #0ea5e9;      --user-glow: rgba(14, 165, 233, .25);
    --user-soft: rgba(14, 165, 233, .10);  --user-soft-border: rgba(14, 165, 233, .22);
    --user-icon-muted: #94a3b8;
    --user-success: #059669;     --user-danger: #dc2626;
    --user-shadow: 0 10px 25px -5px rgba(15, 23, 42, .05), 0 8px 10px -6px rgba(15, 23, 42, .02);
}
[data-bs-theme="dark"], [data-theme="dark"], body.dark-mode, .dark-mode {
    --user-card: #0f172a;        --user-subtle: #1e293b;
    --user-input-bg: #1e293b;    --user-input-focus: #111827;
    --user-input-border: rgba(255, 255, 255, .12);
    --user-border: rgba(255, 255, 255, .08);
    --user-title: #f8fafc;       --user-subtitle: #94a3b8;
    --user-hover: #1e293b;
    --user-accent: #38bdf8;      --user-glow: rgba(56, 189, 248, .25);
    --user-soft: rgba(56, 189, 248, .10);  --user-soft-border: rgba(56, 189, 248, .22);
    --user-icon-muted: #64748b;
    --user-success: #34d399;     --user-danger: #f87171;
    --user-shadow: 0 12px 30px -5px rgba(0, 0, 0, .4);
}

/* =========================================================
   FLASH MESSAGE
========================================================= */
.alert.alert-autodismiss {
    position: relative;
    overflow: hidden;
    display: flex;
    align-items: center;
    gap: 14px;
    padding: 14px 48px 14px 16px;
    border: 1px solid;
    border-radius: 16px;
    transition: opacity .35s ease, transform .35s ease, max-height .35s ease,
                padding .35s ease, margin .35s ease, border-width .35s ease;
    animation: userAlertIn .45s cubic-bezier(.34, 1.56, .64, 1) backwards;
}
.alert-autodismiss.is-success {
    background: rgba(16, 185, 129, .12);
    border-color: rgba(16, 185, 129, .30);
    color: var(--user-success);
}
.alert-autodismiss.is-error {
    background: rgba(239, 68, 68, .12);
    border-color: rgba(239, 68, 68, .30);
    color: var(--user-danger);
}
.alert-autodismiss.alert-hiding {
    opacity: 0;
    transform: translateY(-10px);
    max-height: 0 !important;
    padding-top: 0;
    padding-bottom: 0;
    margin-top: 0 !important;
    margin-bottom: 0 !important;
    border-width: 0;
}
.alert-icon-box {
    width: 36px;
    height: 36px;
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 10px;
    font-size: 16px;
}
.alert-autodismiss.is-success .alert-icon-box { background: rgba(16, 185, 129, .18); }
.alert-autodismiss.is-error .alert-icon-box   { background: rgba(239, 68, 68, .18); }
.alert-content {
    min-width: 0;
    display: flex;
    flex-direction: column;
    gap: 1px;
}
.alert-content strong { font-size: 13.5px; font-weight: 700; }
.alert-content span   { font-size: 12.5px; opacity: .92; word-break: break-word; }
.alert-autodismiss .btn-close {
    position: absolute;
    top: 50%;
    right: 14px;
    transform: translateY(-50%);
    margin: 0;
    padding: 6px;
    font-size: 10px;
    opacity: .55;
    transition: opacity .2s ease;
}
.alert-autodismiss .btn-close:hover { opacity: 1; }
.alert-progress-track {
    position: absolute;
    left: 0; right: 0; bottom: 0;
    height: 3px;
    background: rgba(148, 163, 184, .18);
}
.alert-progress-bar {
    width: 100%;
    height: 100%;
    background: currentColor;
    transform-origin: left center;
    animation: userAlertProgress linear forwards;
}
[data-bs-theme="dark"] .alert-autodismiss .btn-close,
[data-theme="dark"] .alert-autodismiss .btn-close,
body.dark-mode .alert-autodismiss .btn-close,
.dark-mode .alert-autodismiss .btn-close {
    filter: invert(1) grayscale(100%) brightness(200%);
}

/* =========================================================
   PAGE HEADER
========================================================= */
.page-header-custom {
    position: relative;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 20px;
    padding: 22px 28px;
    background: var(--user-card);
    border: 1px solid var(--user-border);
    border-radius: 20px;
    box-shadow: var(--user-shadow);
    animation: userFadeUp .4s ease both;
}
.page-header-custom::before {
    content: "";
    position: absolute;
    inset: 0 auto 0 0;
    width: 4px;
    background: linear-gradient(180deg, var(--user-accent), #0369a1);
}
.page-header-custom::after {
    content: "";
    position: absolute;
    top: -70px;
    right: -50px;
    width: 180px;
    height: 180px;
    border-radius: 50%;
    background: var(--user-soft);
    pointer-events: none;
}
.page-header-custom > * { position: relative; z-index: 1; }
.page-header-icon {
    width: 52px;
    height: 52px;
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 16px;
    background: var(--user-soft);
    border: 1px solid var(--user-soft-border);
    color: var(--user-accent);
    font-size: 22px;
    transition: transform .35s ease;
}
.page-header-custom:hover .page-header-icon { transform: rotate(-6deg) scale(1.06); }
.badge-header-tag {
    display: inline-flex;
    align-items: center;
    padding: 4px 10px;
    border-radius: 999px;
    background: var(--user-soft);
    border: 1px solid var(--user-soft-border);
    color: var(--user-accent);
    font-size: 10.5px;
    font-weight: 800;
    letter-spacing: .6px;
    text-transform: uppercase;
}
.page-title {
    margin: 0 0 2px;
    color: var(--user-title);
    font-size: 22px;
    font-weight: 800;
    letter-spacing: -.3px;
}
.page-subtitle {
    margin: 0;
    color: var(--user-subtitle);
    font-size: 13px;
}

/* =========================================================
   CARD
========================================================= */
.custom-card {
    overflow: hidden;
    background: var(--user-card);
    border: 1px solid var(--user-border);
    border-radius: 20px;
    box-shadow: var(--user-shadow);
    animation: userFadeUp .4s ease .05s both;
    transition: box-shadow .3s ease, border-color .3s ease;
}
.custom-card:hover {
    border-color: var(--user-soft-border);
    box-shadow: 0 16px 34px -10px rgba(15, 23, 42, .12);
}
[data-bs-theme="dark"] .custom-card:hover,
[data-theme="dark"] .custom-card:hover,
body.dark-mode .custom-card:hover,
.dark-mode .custom-card:hover {
    box-shadow: 0 16px 34px -10px rgba(0, 0, 0, .55);
}
.card-title-custom {
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 16px;
    padding: 18px 24px;
    background: var(--user-subtle);
    border-bottom: 1px solid var(--user-border);
}
.title-icon {
    width: 42px;
    height: 42px;
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 12px;
    background: var(--user-soft);
    border: 1px solid var(--user-soft-border);
    color: var(--user-accent);
    font-size: 16px;
}
.card-title-custom h5 {
    margin: 0 0 2px;
    color: var(--user-title);
    font-size: 15px;
    font-weight: 700;
}
.card-title-custom small {
    color: var(--user-subtitle);
    font-size: 12px;
}
.total-badge {
    display: inline-flex;
    align-items: center;
    padding: 6px 14px;
    border-radius: 999px;
    background: var(--user-soft);
    border: 1px solid var(--user-soft-border);
    color: var(--user-accent);
    font-size: 12px;
    font-weight: 700;
}

/* =========================================================
   ANIMASI
========================================================= */
@keyframes userFadeUp {
    from { opacity: 0; transform: translateY(12px); }
    to   { opacity: 1; transform: translateY(0); }
}
@keyframes userAlertIn {
    from { opacity: 0; transform: translateY(-14px) scale(.98); }
    to   { opacity: 1; transform: translateY(0) scale(1); }
}
@keyframes userAlertProgress {
    from { transform: scaleX(1); }
    to   { transform: scaleX(0); }
}

/* =========================================================
   BUTTON
========================================================= */
.btn-add {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 11px 20px;
    border: 0;
    border-radius: 12px;
    background: linear-gradient(135deg, #0284c7, #0369a1);
    color: #ffffff !important;
    font-size: 12.5px;
    font-weight: 700;
    line-height: 1.4;
    text-decoration: none;
    white-space: nowrap;
    box-shadow: 0 6px 18px rgba(2, 132, 199, .28);
    transition: all .25s ease;
}
.btn-add:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 24px rgba(2, 132, 199, .45);
}
.btn-add:focus-visible, .btn-action:focus-visible, .filter-chip:focus-visible,
.alert-autodismiss .btn-close:focus-visible {
    outline: 2px solid var(--user-accent);
    outline-offset: 2px;
}

/* =========================================================
   TOOLBAR: PENCARIAN & FILTER
========================================================= */
.table-search-group { position: relative; display: flex; align-items: center; }
.table-search-icon {
    position: absolute;
    left: 14px;
    color: var(--user-icon-muted);
    font-size: 13px;
    pointer-events: none;
    transition: color .2s ease;
}
.table-search-group:focus-within .table-search-icon { color: var(--user-accent); }
.table-search-input {
    min-width: 220px;
    padding: 8px 14px 8px 36px;
    background: var(--user-card);
    border: 1px solid var(--user-border);
    border-radius: 10px;
    color: var(--user-title);
    font-size: 13px;
    transition: border-color .2s ease, box-shadow .2s ease;
}
.table-search-input::placeholder { color: var(--user-icon-muted); opacity: 1; }
.table-search-input:focus {
    outline: 0;
    border-color: var(--user-accent);
    box-shadow: 0 0 0 3px var(--user-glow);
}
.filter-chips {
    display: inline-flex;
    gap: 2px;
    padding: 3px;
    background: var(--user-card);
    border: 1px solid var(--user-border);
    border-radius: 999px;
}
.filter-chip {
    padding: 5px 13px;
    border: 0;
    border-radius: 999px;
    background: transparent;
    color: var(--user-subtitle);
    font-size: 12px;
    font-weight: 700;
    cursor: pointer;
    transition: background-color .2s ease, color .2s ease, box-shadow .2s ease;
}
.filter-chip:hover { color: var(--user-accent); }
.filter-chip.is-active {
    background: var(--user-soft);
    color: var(--user-accent);
    box-shadow: inset 0 0 0 1px var(--user-soft-border);
}

/* =========================================================
   TABEL
========================================================= */
.custom-table {
    --bs-table-bg: transparent;
    --bs-table-color: var(--user-title);
    margin-bottom: 0;
    color: var(--user-title);
    white-space: nowrap;
}
.custom-table > :not(caption) > * > * {
    background-color: transparent;
    color: var(--user-title);
    border-bottom: 1px solid var(--user-border);
    box-shadow: none;
}
.custom-table thead th {
    padding: 14px 20px;
    background-color: var(--user-subtle);
    color: var(--user-subtitle);
    font-size: 11px;
    font-weight: 700;
    letter-spacing: .6px;
    text-transform: uppercase;
}
.custom-table td { padding: 14px 20px; font-size: 13.5px; }
.custom-table tbody tr { transition: background-color .2s ease; }
.custom-table tbody tr:hover > * { background-color: var(--user-hover); }
.user-row { animation: userRowIn .3s ease calc(var(--i, 1) * .05s) both; }
@keyframes userRowIn {
    from { opacity: 0; transform: translateX(-6px); }
    to   { opacity: 1; transform: translateX(0); }
}
.cell-no { color: var(--user-subtitle); font-weight: 600; }

.user-photo, .user-photo-placeholder {
    width: 44px;
    height: 44px;
    border-radius: 12px;
}
.user-photo {
    display: block;
    margin: 0 auto;
    object-fit: cover;
    border: 1px solid var(--user-border);
}
.user-photo-placeholder {
    display: flex;
    align-items: center;
    justify-content: center;
    background: var(--user-soft);
    border: 1px solid var(--user-soft-border);
    color: var(--user-accent);
    font-size: 18px;
}
.user-name { color: var(--user-title); font-size: 14px; font-weight: 700; }
.user-sub  { margin-top: 2px; color: var(--user-subtitle); font-size: 11.5px; }
.cell-date { color: var(--user-subtitle); font-size: 12.5px; }

.badge-role {
    display: inline-flex;
    align-items: center;
    padding: 4px 10px;
    border-radius: 999px;
    background: var(--user-soft);
    border: 1px solid var(--user-soft-border);
    color: var(--user-accent);
    font-size: 11.5px;
    font-weight: 700;
}
.status-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 5px 12px;
    border-radius: 999px;
    font-size: 11.5px;
    font-weight: 700;
}
.status-badge.active {
    background: rgba(16, 185, 129, .12);
    color: var(--user-success);
}
.status-badge.active::before {
    content: "";
    width: 6px;
    height: 6px;
    border-radius: 50%;
    background: currentColor;
    animation: userPulse 1.8s ease-in-out infinite;
}
.status-badge.inactive {
    background: rgba(239, 68, 68, .12);
    color: var(--user-danger);
}
@keyframes userPulse {
    0%, 100% { opacity: 1;  box-shadow: 0 0 0 0 rgba(16, 185, 129, .5); }
    50%      { opacity: .7; box-shadow: 0 0 0 3px rgba(16, 185, 129, 0); }
}

.action-buttons { display: flex; gap: 8px; }
.btn-action {
    width: 36px;
    height: 36px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: 10px;
    font-size: 13px;
    text-decoration: none;
    transition: all .25s ease;
}
.btn-action:hover { transform: translateY(-2px); }
.btn-action.edit {
    background: var(--user-subtle);
    border: 1px solid var(--user-border);
    color: var(--user-title);
}
.btn-action.edit:hover {
    background: var(--user-accent);
    border-color: var(--user-accent);
    color: #ffffff;
}
.btn-action.delete {
    background: rgba(239, 68, 68, .10);
    border: 1px solid rgba(239, 68, 68, .20);
    color: #f87171;
}
.btn-action.delete:hover {
    background: #ef4444;
    border-color: #ef4444;
    color: #ffffff;
}
.btn-action.delete.is-disabled {
    cursor: not-allowed;
    opacity: .48;
    transform: none;
}

/* =========================================================
   EMPTY STATE
========================================================= */
.empty-data { padding: 60px 20px !important; text-align: center; white-space: normal; }
.empty-icon {
    width: 64px;
    height: 64px;
    margin: 0 auto 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 18px;
    background: var(--user-soft);
    color: var(--user-accent);
    font-size: 26px;
}
.empty-title { display: block; margin-bottom: 4px; color: var(--user-title); font-size: 14px; font-weight: 700; }
.empty-text  { display: block; margin: 0; color: var(--user-subtitle); font-size: 12.5px; }
.empty-data .btn-add { margin-top: 16px; }

/* =========================================================
   RESPONSIVE & REDUCED MOTION
========================================================= */
@media (max-width: 768px) {
    .page-header-custom { flex-direction: column; align-items: stretch; gap: 16px; padding: 18px 18px 18px 22px; }
    .card-title-custom  { align-items: flex-start; padding: 16px; }
    .toolbar-right, .table-search-group, .table-search-input, .filter-chips { width: 100%; }
    .filter-chip { flex: 1; }
    .btn-add { width: 100%; }
}
@media (prefers-reduced-motion: reduce) {
    .alert-autodismiss, .alert-progress-bar, .page-header-custom, .page-header-icon,
    .custom-card, .user-row, .btn-add, .btn-action, .status-badge.active::before,
    .table-search-input, .filter-chip, .custom-table tbody tr {
        animation: none !important;
        transition: none !important;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Flash message: auto-dismiss, pause saat hover, tombol tutup
    document.querySelectorAll('.alert-autodismiss').forEach(function (alertEl) {
        var duration = parseInt(alertEl.getAttribute('data-autodismiss'), 10) || 4500;
        var bar = alertEl.querySelector('.alert-progress-bar');
        var closeBtn = alertEl.querySelector('.btn-close');
        var remaining = duration;
        var startedAt = Date.now();
        var timer = null;
        var closed = false;

        if (bar) bar.style.animationDuration = duration + 'ms';

        function closeAlert() {
            if (closed) return;
            closed = true;
            clearTimeout(timer);
            alertEl.style.maxHeight = alertEl.offsetHeight + 'px';
            void alertEl.offsetHeight;
            alertEl.classList.add('alert-hiding');
            setTimeout(function () {
                if (alertEl.parentNode) alertEl.parentNode.removeChild(alertEl);
            }, 380);
        }

        function startTimer(ms) {
            startedAt = Date.now();
            timer = setTimeout(closeAlert, ms);
        }

        startTimer(remaining);

        alertEl.addEventListener('mouseenter', function () {
            if (closed) return;
            clearTimeout(timer);
            remaining -= (Date.now() - startedAt);
            if (bar) bar.style.animationPlayState = 'paused';
        });
        alertEl.addEventListener('mouseleave', function () {
            if (closed) return;
            if (bar) bar.style.animationPlayState = 'running';
            startTimer(Math.max(remaining, 800));
        });

        if (closeBtn) {
            closeBtn.addEventListener('click', function (e) {
                e.preventDefault();
                closeAlert();
            });
        }
    });

    // Foto gagal dimuat: tampilkan placeholder ikon
    document.querySelectorAll('.user-photo').forEach(function (img) {
        function showPlaceholder() {
            img.classList.add('d-none');
            var ph = img.parentNode.querySelector('.user-photo-placeholder');
            if (ph) ph.classList.remove('d-none');
        }
        img.addEventListener('error', showPlaceholder);
        if (img.complete && img.naturalWidth === 0) showPlaceholder();
    });

    // Pencarian + filter status (client-side)
    var input    = document.getElementById('user-search-input');
    var tbody    = document.getElementById('user-table-body');
    var countEl  = document.getElementById('user-count');
    var noResult = document.getElementById('user-no-result');
    var chips    = document.querySelectorAll('.filter-chip');
    var filter   = 'semua';

    if (tbody) {
        var rows = tbody.querySelectorAll('.user-row');

        // Animasi masuk cukup sekali, agar tidak berulang saat baris disaring
        rows.forEach(function (row) {
            row.addEventListener('animationend', function () { row.style.animation = 'none'; });
        });

        function applyFilter() {
            var keyword = input ? input.value.trim().toLowerCase() : '';
            var visible = 0;

            rows.forEach(function (row) {
                var matchText   = (row.getAttribute('data-search') || '').indexOf(keyword) !== -1;
                var matchStatus = filter === 'semua' || row.getAttribute('data-status') === filter;
                var show = matchText && matchStatus;
                row.classList.toggle('d-none', !show);
                if (show) visible++;
            });

            if (countEl) countEl.textContent = visible;
            if (noResult) noResult.classList.toggle('d-none', visible !== 0 || rows.length === 0);
        }

        if (input) input.addEventListener('input', applyFilter);
        chips.forEach(function (chip) {
            chip.addEventListener('click', function () {
                filter = chip.getAttribute('data-filter');
                chips.forEach(function (c) {
                    var on = (c === chip);
                    c.classList.toggle('is-active', on);
                    c.setAttribute('aria-pressed', on ? 'true' : 'false');
                });
                applyFilter();
            });
        });
    }
});
</script>

<?php $this->load->view('admin/template/footer'); ?>