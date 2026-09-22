<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$items = !empty($ppdb) ? $ppdb : [];
$total = count($items);

$bulan = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
$tgl_valid = function ($d) {
    return !empty($d) && strpos($d, '0000') !== 0 && strtotime($d) !== false;
};
$tgl_fmt = function ($d) use ($bulan) {
    $t = strtotime($d);
    return date('j', $t) . ' ' . $bulan[(int) date('n', $t) - 1] . ' ' . date('Y', $t);
};
$blok = [
    ['isi',         'fa-circle-info', 'Informasi utama', 'Belum ada informasi.'],
    ['persyaratan', 'fa-list-check',  'Persyaratan',     'Belum ada persyaratan.'],
    ['alur',        'fa-route',       'Alur pendaftaran','Belum ada alur.'],
];
?>
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
                    <i class="fa-solid fa-file-signature"></i>
                </div>
                <div>
                    <span class="badge-header-tag">
                        <i class="fa-solid fa-layer-group"></i> Modul PPDB
                    </span>
                    <h2 class="page-title">Penerimaan Peserta Didik Baru</h2>
                    <p class="page-subtitle">Kelola informasi gelombang, persyaratan, dan alur pendaftaran peserta didik.</p>
                </div>
            </div>
            <a href="<?= site_url('admin/ppdb/tambah'); ?>" class="btn-add">
                <i class="fa-solid fa-plus"></i> Tambah PPDB
            </a>
        </div>

        <!-- 3. CARD DAFTAR -->
        <div class="custom-card">
            <div class="card-title-custom">
                <div class="d-flex align-items-center gap-3">
                    <div class="title-icon"><i class="fa-solid fa-address-card"></i></div>
                    <div>
                        <h5>Daftar Informasi PPDB</h5>
                        <small>Seluruh gelombang pendaftaran yang terdaftar</small>
                    </div>
                </div>

                <div class="card-tools">
                    <?php if ($total > 0): ?>
                        <div class="table-toolbar">
                            <div class="table-search-group">
                                <i class="fa-solid fa-magnifying-glass"></i>
                                <input type="search" id="ppdbSearch" placeholder="Cari informasi PPDB..." aria-label="Cari informasi PPDB" autocomplete="off">
                            </div>
                            <div class="filter-group" role="group" aria-label="Filter status">
                                <button type="button" class="filter-chip active" data-filter="semua" aria-pressed="true">Semua</button>
                                <button type="button" class="filter-chip" data-filter="aktif" aria-pressed="false">Aktif</button>
                                <button type="button" class="filter-chip" data-filter="nonaktif" aria-pressed="false">Nonaktif</button>
                            </div>
                        </div>
                    <?php endif; ?>
                    <span class="total-badge"><span id="totalCount"><?= (int) $total; ?></span>&nbsp;data</span>
                </div>
            </div>

            <?php if ($total > 0): ?>
                <div class="ppdb-list" id="ppdbList">
                    <?php $n = 0; foreach ($items as $item):
                        $aktif       = (($item->status ?? '') === 'aktif');
                        $ada_mulai   = $tgl_valid($item->tanggal_mulai ?? '');
                        $ada_selesai = $tgl_valid($item->tanggal_selesai ?? '');
                        $ts          = $ada_mulai ? strtotime($item->tanggal_mulai) : null;
                        $id          = (int) ($item->id ?? 0);
                        $search      = mb_strtolower(trim(($item->judul ?? '') . ' ' . ($item->isi ?? '') . ' ' . ($item->persyaratan ?? '') . ' ' . ($item->alur ?? '')), 'UTF-8');

                        if ($ada_mulai && $ada_selesai) {
                            $periode = $tgl_fmt($item->tanggal_mulai) . ' — ' . $tgl_fmt($item->tanggal_selesai);
                        } elseif ($ada_mulai) {
                            $periode = 'Mulai ' . $tgl_fmt($item->tanggal_mulai);
                        } else {
                            $periode = 'Periode belum ditentukan';
                        }
                    ?>
                        <article class="ppdb-item" style="--i: <?= min($n, 7); ?>;"
                                 data-status="<?= $aktif ? 'aktif' : 'nonaktif'; ?>"
                                 data-search="<?= html_escape($search); ?>">
                            <div class="ppdb-item-main">

                                <?php if ($ts): ?>
                                    <div class="date-tile">
                                        <span class="day"><?= date('j', $ts); ?></span>
                                        <span class="month"><?= html_escape($bulan[(int) date('n', $ts) - 1]); ?></span>
                                        <span class="year"><?= date('Y', $ts); ?></span>
                                    </div>
                                <?php else: ?>
                                    <div class="date-tile is-empty" aria-hidden="true">
                                        <i class="fa-regular fa-calendar-days"></i>
                                    </div>
                                <?php endif; ?>

                                <div class="ppdb-item-content">
                                    <div class="ppdb-item-head">
                                        <h4 class="ppdb-item-title"><?= html_escape($item->judul ?? ''); ?></h4>
                                        <?php if ($aktif): ?>
                                            <span class="status-badge active"><span class="dot"></span> Aktif</span>
                                        <?php else: ?>
                                            <span class="status-badge inactive"><span class="dot"></span> Nonaktif</span>
                                        <?php endif; ?>
                                    </div>

                                    <div class="ppdb-item-period">
                                        <i class="fa-regular fa-calendar-days"></i> <?= html_escape($periode); ?>
                                    </div>

                                    <div class="row g-3">
                                        <?php foreach ($blok as $b): $teks = trim((string) ($item->{$b[0]} ?? '')); ?>
                                            <div class="col-lg-4">
                                                <div class="info-block">
                                                    <div class="info-block-title"><i class="fa-solid <?= $b[1]; ?>"></i> <?= $b[2]; ?></div>
                                                    <?php if ($teks !== ''): ?>
                                                        <div class="info-block-text"><?= html_escape($teks); ?></div>
                                                    <?php else: ?>
                                                        <div class="info-block-text is-empty"><?= $b[3]; ?></div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>

                            <div class="ppdb-item-footer">
                                <span class="item-meta"><i class="fa-solid fa-circle-info"></i> ID: #<?= $id; ?></span>
                                <div class="action-buttons">
                                    <a href="<?= site_url('admin/ppdb/edit/' . $id); ?>" class="btn-action edit" title="Sunting PPDB" aria-label="Sunting PPDB">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <a href="<?= site_url('admin/ppdb/hapus/' . $id); ?>" class="btn-action delete" title="Hapus PPDB" aria-label="Hapus PPDB"
                                       onclick="return confirm('Yakin ingin menghapus informasi PPDB ini?');">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </a>
                                </div>
                            </div>
                        </article>
                    <?php $n++; endforeach; ?>
                </div>

                <!-- Empty state: tidak ditemukan -->
                <div class="empty-state d-none" id="emptySearch">
                    <div class="empty-icon"><i class="fa-solid fa-magnifying-glass"></i></div>
                    <div class="empty-title">Tidak ditemukan</div>
                    <p class="empty-text">Coba kata kunci lain atau ubah filter status.</p>
                    <button type="button" class="btn-cancel" id="resetFilter">
                        <i class="fa-solid fa-xmark"></i> Reset pencarian
                    </button>
                </div>
            <?php else: ?>
                <!-- Empty state: belum ada data -->
                <div class="empty-state">
                    <div class="empty-icon"><i class="fa-solid fa-folder-open"></i></div>
                    <div class="empty-title">Belum ada data</div>
                    <p class="empty-text">Buat gelombang pendaftaran baru untuk mulai mengelola data PPDB.</p>
                    <a href="<?= site_url('admin/ppdb/tambah'); ?>" class="btn-add">
                        <i class="fa-solid fa-plus"></i> Tambah PPDB
                    </a>
                </div>
            <?php endif; ?>
        </div>

    </div>
</div>

<?php $this->load->view('admin/ppdb/_assets'); ?>

<style>
    .card-tools { display: flex; align-items: center; flex-wrap: wrap; gap: 10px; }
    .table-toolbar { display: flex; align-items: center; flex-wrap: wrap; gap: 10px; }

    .table-search-group { position: relative; }
    .table-search-group i { position: absolute; left: 13px; top: 50%; transform: translateY(-50%); font-size: 13px; color: var(--ppdb-icon-muted); pointer-events: none; transition: color .2s ease; }
    .table-search-group:focus-within i { color: var(--ppdb-accent); }
    .table-search-group input {
        min-width: 220px; padding: 9px 12px 9px 36px; border-radius: 10px; font-size: 13px;
        background: var(--ppdb-input-bg); border: 1px solid var(--ppdb-input-border); color: var(--ppdb-title);
        transition: border-color .2s ease, box-shadow .2s ease, background .2s ease;
    }
    .table-search-group input::placeholder { color: var(--ppdb-icon-muted); }
    .table-search-group input:hover { border-color: var(--ppdb-accent); }
    .table-search-group input:focus { outline: 0; background: var(--ppdb-input-focus); border-color: var(--ppdb-accent); box-shadow: 0 0 0 3px var(--ppdb-glow); }

    .filter-group { display: inline-flex; gap: 2px; padding: 3px; border: 1px solid var(--ppdb-border); border-radius: 999px; background: var(--ppdb-card); }
    .filter-chip { border: 0; background: transparent; color: var(--ppdb-subtitle); padding: 6px 14px; border-radius: 999px; font-size: 12px; font-weight: 700; cursor: pointer; transition: background .2s ease, color .2s ease; }
    .filter-chip:hover { color: var(--ppdb-title); }
    .filter-chip.active { background: var(--ppdb-soft); color: var(--ppdb-accent); box-shadow: inset 0 0 0 1px var(--ppdb-soft-border); }
    .filter-chip:focus-visible { outline: 2px solid var(--ppdb-accent); outline-offset: 2px; }

    .ppdb-list { display: flex; flex-direction: column; gap: 16px; padding: 24px; }
    .ppdb-item {
        background: var(--ppdb-card); border: 1px solid var(--ppdb-border); border-radius: 16px; overflow: hidden;
        box-shadow: var(--ppdb-shadow); transition: transform .25s ease, border-color .25s ease, box-shadow .25s ease;
        animation: fadeUp .4s ease backwards; animation-delay: calc(var(--i, 0) * .05s);
    }
    .ppdb-item:hover { transform: translateY(-3px); border-color: var(--ppdb-soft-border); box-shadow: 0 16px 32px -10px rgba(15, 23, 42, .12); }
    [data-bs-theme="dark"] .ppdb-item:hover, [data-theme="dark"] .ppdb-item:hover, body.dark-mode .ppdb-item:hover, .dark-mode .ppdb-item:hover { box-shadow: 0 16px 36px -8px rgba(0, 0, 0, .55); }

    .ppdb-item-main { display: flex; gap: 20px; padding: 22px 24px; }
    .date-tile {
        width: 68px; flex-shrink: 0; align-self: flex-start; text-align: center; padding: 10px 6px; border-radius: 14px;
        background: var(--ppdb-soft); border: 1px solid var(--ppdb-soft-border); color: var(--ppdb-accent);
    }
    .date-tile .day { display: block; font-size: 26px; font-weight: 800; line-height: 1; }
    .date-tile .month { display: block; margin-top: 4px; font-size: 11px; font-weight: 800; text-transform: uppercase; letter-spacing: .6px; }
    .date-tile .year { display: block; font-size: 11px; font-weight: 600; color: var(--ppdb-subtitle); }
    .date-tile.is-empty { display: flex; align-items: center; justify-content: center; height: 68px; font-size: 22px; color: var(--ppdb-icon-muted); background: var(--ppdb-subtle); border-color: var(--ppdb-border); }

    .ppdb-item-content { flex: 1; min-width: 0; }
    .ppdb-item-head { display: flex; align-items: flex-start; justify-content: space-between; gap: 12px; flex-wrap: wrap; }
    .ppdb-item-title { margin: 0; font-size: 16px; font-weight: 700; color: var(--ppdb-title); word-break: break-word; }
    .ppdb-item-period { margin: 4px 0 14px; font-size: 12.5px; color: var(--ppdb-subtitle); }
    .ppdb-item-period i { margin-right: 6px; color: var(--ppdb-accent); }

    .info-block { height: 100%; padding: 14px 16px; border-radius: 12px; background: var(--ppdb-subtle); border: 1px solid var(--ppdb-border); }
    .info-block-title { display: flex; align-items: center; gap: 8px; margin-bottom: 6px; font-size: 12px; font-weight: 700; color: var(--ppdb-title); }
    .info-block-title i { color: var(--ppdb-accent); }
    .info-block-text {
        font-size: 12.5px; line-height: 1.6; color: var(--ppdb-subtitle); white-space: pre-line; word-break: break-word;
        display: -webkit-box; -webkit-line-clamp: 3; line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;
    }
    .info-block-text.is-empty { font-style: italic; color: var(--ppdb-icon-muted); }

    .ppdb-item-footer { display: flex; align-items: center; justify-content: space-between; gap: 12px; padding: 12px 24px; background: var(--ppdb-subtle); border-top: 1px solid var(--ppdb-border); }
    .item-meta { font-size: 12px; font-weight: 600; color: var(--ppdb-subtitle); }
    .item-meta i { margin-right: 6px; color: var(--ppdb-accent); }
    .action-buttons { display: flex; align-items: center; gap: 8px; }

    @media (max-width: 768px) {
        .card-tools, .table-toolbar { width: 100%; }
        .table-search-group { flex: 1 1 100%; }
        .table-search-group input { width: 100%; min-width: 0; }
        .ppdb-list { padding: 16px; }
        .ppdb-item-main { flex-direction: column; gap: 14px; padding: 18px; }
        .date-tile { width: auto; display: flex; align-items: baseline; gap: 6px; padding: 8px 14px; }
        .date-tile .day { font-size: 20px; }
        .date-tile .month { margin-top: 0; }
        .date-tile.is-empty { height: auto; padding: 8px 14px; }
        .ppdb-item-footer { padding: 12px 18px; }
    }
    @media (prefers-reduced-motion: reduce) {
        .ppdb-item { animation: none; transition: none; }
        .ppdb-item:hover { transform: none; }
    }
</style>

<script>
(function () {
    var list = document.getElementById('ppdbList');
    if (!list) return;

    var items = [].slice.call(list.querySelectorAll('.ppdb-item'));
    var input = document.getElementById('ppdbSearch');
    var chips = [].slice.call(document.querySelectorAll('.filter-chip'));
    var counter = document.getElementById('totalCount');
    var emptyBox = document.getElementById('emptySearch');
    var resetBtn = document.getElementById('resetFilter');
    var filter = 'semua';

    function apply() {
        var q = input.value.trim().toLowerCase();
        var visible = 0;
        items.forEach(function (el) {
            var okStatus = (filter === 'semua' || el.getAttribute('data-status') === filter);
            var okText = (!q || el.getAttribute('data-search').indexOf(q) !== -1);
            var show = okStatus && okText;
            el.classList.toggle('d-none', !show);
            if (show) visible++;
        });
        counter.textContent = visible;
        emptyBox.classList.toggle('d-none', visible !== 0);
        list.classList.toggle('d-none', visible === 0);
    }
    function setFilter(value) {
        filter = value;
        chips.forEach(function (c) {
            var on = c.getAttribute('data-filter') === value;
            c.classList.toggle('active', on);
            c.setAttribute('aria-pressed', on ? 'true' : 'false');
        });
        apply();
    }

    input.addEventListener('input', apply);
    chips.forEach(function (c) {
        c.addEventListener('click', function () { setFilter(c.getAttribute('data-filter')); });
    });
    if (resetBtn) resetBtn.addEventListener('click', function () { input.value = ''; setFilter('semua'); input.focus(); });
})();
</script>

<?php $this->load->view('admin/template/footer'); ?>
