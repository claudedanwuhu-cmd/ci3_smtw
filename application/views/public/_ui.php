<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php
/* ==========================================================================
   public/_ui.php
   Dimuat tepat setelah public/_style.php di dalam <head>.
   Isinya dua hal:
     1. Gaya khas tiap modul (di bawah, dalam <style>)
     2. Fungsi bantu: sk_nav(), sk_footer(), sk_cards(), sk_media(), dst.
   Semua fungsi dijaga function_exists supaya aman jika view dimuat dua kali.
   ========================================================================== */

if (!function_exists('sk_module')) {
	/** Menyeragamkan nama modul dari controller mana pun. */
	function sk_module($raw)
	{
		$m = strtolower(trim((string) $raw));
		$peta = array(
			'ekskul' => 'ekstrakurikuler',
			'ekstra' => 'ekstrakurikuler',
			'spmb' => 'ppdb',
			'ppdb' => 'ppdb',
			'guru' => 'guru',
			'staff' => 'guru',
			'gurustaff' => 'guru',
			'guru_staff' => 'guru',
			'news' => 'berita',
			'berita' => 'berita',
			'pengumuman' => 'pengumuman',
			'prestasi' => 'prestasi',
			'fasilitas' => 'fasilitas',
			'download' => 'download',
			'unduhan' => 'download',
			'galeri' => 'galeri',
			'gallery' => 'galeri',
			'agenda' => 'agenda',
		);
		return isset($peta[$m]) ? $peta[$m] : ($m !== '' ? $m : 'umum');
	}
}

if (!function_exists('sk_pick')) {
	/** Mengambil nilai pertama yang terisi dari beberapa kemungkinan kolom. */
	function sk_pick($item, array $keys, $default = '')
	{
		foreach ($keys as $key) {
			$val = is_array($item)
				? (isset($item[$key]) ? $item[$key] : null)
				: (isset($item->$key) ? $item->$key : null);
			if ($val === null || is_array($val) || is_object($val)) {
				continue; /* kolom bertipe majemuk ditangani pemanggilnya sendiri */
			}
			if (trim((string) $val) !== '') {
				return $val;
			}
		}
		return $default;
	}
}

if (!function_exists('sk_folders')) {
	/** Daftar folder yang akan dicoba untuk tiap modul, berurutan. */
	function sk_folders($module)
	{
		$peta = array(
			'berita' => array('assets/img/berita', 'assets/img', 'uploads/berita'),
			'guru' => array('assets/img/guru', 'assets/img', 'uploads/guru'),
			'prestasi' => array('uploads/prestasi', 'assets/img/prestasi', 'assets/img'),
			'galeri' => array('assets/img/galeri', 'uploads/galeri', 'assets/uploads/galeri', 'assets/img'),
			'fasilitas' => array('assets/img/fasilitas', 'assets/img', 'uploads/fasilitas'),
			'ekstrakurikuler' => array('uploads/ekstrakurikuler', 'assets/img/ekstrakurikuler', 'assets/img'),
		);
		return isset($peta[$module])
			? $peta[$module]
			: array('assets/img/' . $module, 'assets/img', 'uploads/' . $module, 'uploads');
	}
}

if (!function_exists('sk_media')) {
	/**
	 * Menyusun URL gambar beserta rantai cadangannya.
	 *
	 * Nama file di basis data tidak konsisten: ada yang polos ("foto.jpg"),
	 * ada yang sudah membawa folder ("galeri/foto.jpg"), ada yang URL penuh.
	 * Fungsi ini menyiapkan beberapa kandidat; kalau yang pertama gagal,
	 * JS di _style.php akan mencoba kandidat berikutnya sebelum menyerah
	 * ke kotak pengganti. Inilah perbaikan untuk foto galeri yang kosong.
	 *
	 * @return array|null array('src' => ..., 'fallback' => 'url|url')
	 */
	function sk_media($item, $module)
	{
		$raw = trim((string) sk_pick($item, array('foto', 'gambar', 'thumbnail', 'image', 'file_foto')));
		if ($raw === '') {
			return null;
		}
		if (preg_match('~^(https?:)?//~i', $raw)) {
			return array('src' => $raw, 'fallback' => '');
		}

		$raw = ltrim(str_replace('\\', '/', $raw), '/');
		$nama = rawurlencode(basename($raw));
		$dir = trim(dirname($raw), './');
		$kandidat = array();

		/* Sudah membawa folder publik yang jelas: hormati apa adanya. */
		if (strpos($raw, 'assets/') === 0 || strpos($raw, 'uploads/') === 0) {
			$kandidat[] = base_url($raw);
		}

		foreach (sk_folders($module) as $folder) {
			$kandidat[] = base_url(trim($folder, '/') . '/' . $nama);
		}

		/* Membawa sub-folder sendiri, mis. "galeri/2024/upacara.jpg". */
		if ($dir !== '') {
			$kandidat[] = base_url('assets/img/' . $raw);
			$kandidat[] = base_url($raw);
		}

		$kandidat = array_values(array_unique(array_filter($kandidat)));
		if (!$kandidat) {
			return null;
		}

		return array(
			'src' => array_shift($kandidat),
			'fallback' => implode('|', $kandidat),
		);
	}
}

if (!function_exists('sk_img')) {
	/** Mencetak <img> lengkap dengan rantai cadangan. */
	function sk_img($media, $alt, $class = '', $icon = 'fa-image')
	{
		if (!$media) {
			echo '<span class="media-fallback"><i class="fa-solid ' . $icon . '"></i></span>';
			return;
		}
		echo '<img class="' . $class . '"'
			. ' src="' . html_escape($media['src']) . '"'
			. ' data-fallback="' . html_escape($media['fallback']) . '"'
			. ' data-icon="' . $icon . '"'
			. ' alt="' . html_escape($alt) . '" loading="lazy">';
	}
}

if (!function_exists('sk_judul')) {
	function sk_judul($item, $module)
	{
		$khusus = array(
			'guru' => array('nama', 'nama_guru', 'judul'),
			'prestasi' => array('nama_prestasi', 'judul', 'nama'),
			'fasilitas' => array('nama_fasilitas', 'nama', 'judul'),
			'galeri' => array('judul', 'nama_album', 'nama'),
			'ekstrakurikuler' => array('nama', 'nama_ekskul', 'judul'),
		);
		$keys = isset($khusus[$module]) ? $khusus[$module] : array('judul', 'nama', 'nama_album');
		return sk_pick($item, $keys, 'Tanpa judul');
	}
}

if (!function_exists('sk_isi')) {
	function sk_isi($item)
	{
		return sk_pick($item, array('deskripsi', 'isi', 'keterangan', 'ringkasan', 'pembina', 'alamat'));
	}
}

if (!function_exists('sk_ringkas')) {
	/** Memotong teks pada batas kata, tanpa bergantung pada helper CI. */
	function sk_ringkas($teks, $jumlah_kata = 22)
	{
		$teks = trim(preg_replace('/\s+/u', ' ', strip_tags((string) $teks)));
		if ($teks === '') {
			return '';
		}
		$kata = explode(' ', $teks);
		if (count($kata) <= $jumlah_kata) {
			return $teks;
		}
		return implode(' ', array_slice($kata, 0, $jumlah_kata)) . '…';
	}
}

if (!function_exists('sk_tanggal')) {
	/** Mengembalikan timestamp bila kolom tanggal terisi dan valid. */
	function sk_tanggal($item)
	{
		$raw = sk_pick($item, array('tanggal', 'tgl', 'created_at', 'tanggal_mulai', 'waktu'));
		if ($raw === '') {
			return null;
		}
		$ts = strtotime($raw);
		return $ts ? $ts : null;
	}
}

if (!function_exists('sk_bulan')) {
	function sk_bulan($ts)
	{
		$nama = array('Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des');
		return $nama[(int) date('n', $ts) - 1];
	}
}

if (!function_exists('sk_meta')) {
	/**
	 * Salinan teks hero untuk tiap modul: judul, kalimat pembuka, dan satuan
	 * hitungan. Ditulis dari sudut pandang pembaca, bukan nama tabel.
	 */
	function sk_meta($module)
	{
		$peta = array(
			'berita' => array('Berita sekolah', 'Warta harian', 'Catatan kegiatan, kunjungan, dan kabar resmi dari lingkungan sekolah.', 'berita'),
			'pengumuman' => array('Pengumuman', 'Papan pengumuman', 'Informasi resmi untuk siswa, orang tua, dan guru. Yang terbaru selalu di atas.', 'pengumuman'),
			'prestasi' => array('Prestasi siswa', 'Lemari piala', 'Hasil lomba dan penghargaan yang dibawa pulang siswa SMA Negeri Tawangmangu.', 'penghargaan'),
			'fasilitas' => array('Fasilitas sekolah', 'Ruang belajar', 'Ruang, laboratorium, dan sarana penunjang yang bisa dipakai seluruh warga sekolah.', 'fasilitas'),
			'guru' => array('Guru dan staf', 'Siapa yang mengajar', 'Tenaga pendidik dan tenaga kependidikan yang mendampingi siswa setiap hari.', 'orang'),
			'download' => array('Unduhan', 'Berkas sekolah', 'Formulir, panduan, dan dokumen resmi yang bisa diunduh kapan saja.', 'berkas'),
			'ppdb' => array('Pendaftaran SPMB', 'Jalur masuk', 'Tahapan, syarat, dan jadwal penerimaan peserta didik baru.', 'tahap'),
			'galeri' => array('Galeri sekolah', 'Dokumentasi', 'Momen belajar, lomba, dan keseharian warga sekolah, tersusun per album.', 'foto'),
			'agenda' => array('Agenda sekolah', 'Kegiatan mendatang', 'Jadwal kegiatan yang sudah dipastikan, lengkap dengan tempatnya.', 'agenda'),
			'ekstrakurikuler' => array('Ekstrakurikuler', 'Temukan potensimu', 'Kegiatan di luar jam pelajaran untuk mengasah minat, bakat, dan kerja sama.', 'kegiatan'),
		);
		return isset($peta[$module])
			? $peta[$module]
			: array('Informasi sekolah', 'Pusat informasi', 'Informasi resmi SMA Negeri Tawangmangu untuk warga sekolah dan masyarakat.', 'data');
	}
}

/* ==========================================================================
   NAVBAR
   ========================================================================== */
if (!function_exists('sk_nav')) {
	function sk_nav($aktif = '')
	{
		$grup = function ($daftar) use ($aktif) {
			return in_array($aktif, $daftar, TRUE) ? ' active' : '';
		};
		$on = function ($nama) use ($aktif) {
			return $aktif === $nama ? ' active' : '';
		};
		?>
		<nav class="navbar navbar-expand-lg site-nav">
			<div class="shell d-flex align-items-center">
				<a class="brand" href="<?= site_url(); ?>">
					<span class="brand-mark"><i class="fa-solid fa-school"></i></span>
					<span>
						<span class="brand-text">SMA NEGERI TAWANGMANGU</span>
						<span class="brand-sub">Pendidikan &middot; Karakter &middot; Prestasi</span>
					</span>
				</a>

				<button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse"
					data-bs-target="#publicNav" aria-controls="publicNav" aria-expanded="false"
					aria-label="Buka menu">
					<i class="fa-solid fa-bars"></i>
				</button>

				<div class="collapse navbar-collapse" id="publicNav">
					<ul class="navbar-nav ms-auto align-items-lg-center">
						<li class="nav-item">
							<a class="nav-link<?= $on('beranda'); ?>" href="<?= site_url(); ?>">Beranda</a>
						</li>
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle<?= $grup(array('profil', 'guru', 'fasilitas')); ?>"
								href="#" data-bs-toggle="dropdown">Sekolah</a>
							<ul class="dropdown-menu">
								<li><a class="dropdown-item<?= $on('profil'); ?>"
										href="<?= site_url('profil'); ?>">Profil sekolah</a></li>
								<li><a class="dropdown-item<?= $on('guru'); ?>"
										href="<?= site_url('guru'); ?>">Guru &amp; staf</a></li>
								<li><a class="dropdown-item<?= $on('fasilitas'); ?>"
										href="<?= site_url('fasilitas'); ?>">Fasilitas</a></li>
							</ul>
						</li>
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle<?= $grup(array('ekstrakurikuler', 'prestasi', 'agenda')); ?>"
								href="#" data-bs-toggle="dropdown">Kesiswaan</a>
							<ul class="dropdown-menu">
								<li><a class="dropdown-item<?= $on('ekstrakurikuler'); ?>"
										href="<?= site_url('ekstrakurikuler'); ?>">Ekstrakurikuler</a></li>
								<li><a class="dropdown-item<?= $on('prestasi'); ?>"
										href="<?= site_url('prestasi'); ?>">Prestasi</a></li>
								<li><a class="dropdown-item<?= $on('agenda'); ?>"
										href="<?= site_url('agenda'); ?>">Agenda</a></li>
							</ul>
						</li>
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle<?= $grup(array('berita', 'pengumuman', 'download')); ?>"
								href="#" data-bs-toggle="dropdown">Informasi</a>
							<ul class="dropdown-menu">
								<li><a class="dropdown-item<?= $on('berita'); ?>"
										href="<?= site_url('berita'); ?>">Berita</a></li>
								<li><a class="dropdown-item<?= $on('pengumuman'); ?>"
										href="<?= site_url('pengumuman'); ?>">Pengumuman</a></li>
								<li><a class="dropdown-item<?= $on('download'); ?>"
										href="<?= site_url('download'); ?>">Unduhan</a></li>
							</ul>
						</li>
						<li class="nav-item">
							<a class="nav-link<?= $on('galeri'); ?>" href="<?= site_url('galeri'); ?>">Galeri</a>
						</li>
					</ul>

					<div class="nav-tools ms-lg-3">
						<a class="login-link" href="<?= site_url('admin/auth'); ?>">
							<i class="fa-solid fa-right-to-bracket"></i>Login
						</a>
						<a class="nav-cta" href="<?= site_url('ppdb'); ?>">SPMB</a>
					</div>
				</div>
			</div>
		</nav>
		<?php
	}
}

/* ==========================================================================
   HERO HALAMAN
   ========================================================================== */
if (!function_exists('sk_hero')) {
	/**
	 * @param array $o judul, eyebrow, teks, jumlah, satuan, induk (label crumb)
	 */
	function sk_hero(array $o)
	{
		$judul = isset($o['judul']) ? $o['judul'] : '';
		$eyebrow = isset($o['eyebrow']) ? $o['eyebrow'] : '';
		$teks = isset($o['teks']) ? $o['teks'] : '';
		$jumlah = isset($o['jumlah']) ? $o['jumlah'] : null;
		$satuan = isset($o['satuan']) ? $o['satuan'] : 'data';
		?>
		<header class="page-hero">
			<div class="shell">
				<nav class="crumb" aria-label="Jejak halaman">
					<a href="<?= site_url(); ?>">Beranda</a>
					<i class="fa-solid fa-chevron-right"></i>
					<span><?= html_escape($judul); ?></span>
				</nav>
				<a class="hero-home-link" href="<?= site_url(); ?>#informasi-sekolah">
					<i class="fa-solid fa-compass"></i>
					Kembali ke Jelajahi Sekolah
				</a>

				<div class="hero-grid">
					<div>
						<?php if ($eyebrow !== ''): ?>
							<span class="eyebrow"><?= html_escape($eyebrow); ?></span>
						<?php endif; ?>
						<h1><?= html_escape($judul); ?></h1>
						<?php if ($teks !== ''): ?>
							<p><?= html_escape($teks); ?></p>
						<?php endif; ?>
					</div>

					<?php if ($jumlah !== null): ?>
						<div class="hero-count">
							<b><?= (int) $jumlah; ?></b>
							<span><?= html_escape($satuan); ?></span>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</header>
		<?php
	}
}

/* ==========================================================================
   FOOTER
   ========================================================================== */
if (!function_exists('sk_footer')) {
	function sk_footer($profil = NULL)
	{
		$alamat = $profil ? sk_pick($profil, array('alamat')) : '';
		$telepon = $profil ? sk_pick($profil, array('telepon', 'no_telp', 'hp')) : '';
		$email = $profil ? sk_pick($profil, array('email')) : '';
		?>
		<footer class="public-footer">
			<div class="shell">
				<div class="footer-grid">
					<div>
						<div class="footer-brand">
							<span class="brand-mark"><i class="fa-solid fa-school"></i></span>
							<b>SMA NEGERI<br>TAWANGMANGU</b>
						</div>
						<p class="footer-intro">
							Sekolah menengah atas negeri di lereng Lawu yang memadukan jalur akademik
							dan keterampilan berbasis potensi lokal Tawangmangu.
						</p>
						<div class="footer-contact">
							<?php if ($alamat !== ''): ?>
								<div><i class="fa-solid fa-location-dot"></i><?= html_escape($alamat); ?></div>
							<?php endif; ?>
							<?php if ($telepon !== ''): ?>
								<div><i class="fa-solid fa-phone"></i><?= html_escape($telepon); ?></div>
							<?php endif; ?>
							<?php if ($email !== ''): ?>
								<div><i class="fa-solid fa-envelope"></i><?= html_escape($email); ?></div>
							<?php endif; ?>
						</div>
					</div>

					<div>
						<div class="footer-heading">Tentang sekolah</div>
						<div class="footer-links">
							<a href="<?= site_url('profil'); ?>">Profil dan sejarah</a>
							<a href="<?= site_url('guru'); ?>">Guru dan staf</a>
							<a href="<?= site_url('fasilitas'); ?>">Fasilitas</a>
							<a href="<?= site_url('prestasi'); ?>">Prestasi</a>
						</div>
					</div>

					<div>
						<div class="footer-heading">Informasi</div>
						<div class="footer-links">
							<a href="<?= site_url('berita'); ?>">Berita</a>
							<a href="<?= site_url('pengumuman'); ?>">Pengumuman</a>
							<a href="<?= site_url('agenda'); ?>">Agenda</a>
							<a href="<?= site_url('download'); ?>">Unduhan</a>
							<a href="<?= site_url('ppdb'); ?>">Pendaftaran SPMB</a>
						</div>
					</div>
				</div>

				<div class="footer-bottom">
					&copy; <?= date('Y'); ?> SMA Negeri Tawangmangu. Seluruh hak cipta dilindungi.
				</div>
			</div>
		</footer>

		<button class="to-top" type="button" aria-label="Kembali ke atas">
			<i class="fa-solid fa-arrow-up"></i>
		</button>

		<div class="lightbox" id="lightbox" role="dialog" aria-modal="true" aria-label="Pratinjau foto">
			<div class="lightbox-inner">
				<button class="lb-close" type="button" aria-label="Tutup"><i class="fa-solid fa-xmark"></i></button>
				<button class="lb-prev" type="button" aria-label="Sebelumnya"><i
						class="fa-solid fa-chevron-left"></i></button>
				<button class="lb-next" type="button" aria-label="Berikutnya"><i
						class="fa-solid fa-chevron-right"></i></button>
				<img src="" alt="">
				<div class="lightbox-caption"></div>
			</div>
		</div>
		<?php
	}
}

/* ==========================================================================
   KOSONG
   ========================================================================== */
if (!function_exists('sk_kosong')) {
	function sk_kosong($label, $ikon = 'fa-folder-open')
	{
		?>
		<div class="empty-state" data-rise>
			<span class="empty-state-icon"><i class="fa-solid <?= $ikon; ?>"></i></span>
			<h3>Halaman ini masih menunggu isi</h3>
			<p>Data <?= html_escape(strtolower($label)); ?> ditambahkan lewat panel administrasi sekolah dan akan
				langsung tampil di sini.</p>
		</div>
		<?php
	}
}

/* ==========================================================================
   RENDER DAFTAR — satu bahasa visual untuk tiap modul
   ========================================================================== */
if (!function_exists('sk_cards')) {
	function sk_cards($items, $module, $label = 'Informasi')
	{
		$module = sk_module($module);
		$items = is_array($items) ? $items : (array) $items;

		if (empty($items)) {
			$ikon = array(
				'guru' => 'fa-user-group',
				'prestasi' => 'fa-trophy',
				'galeri' => 'fa-images',
				'download' => 'fa-file-arrow-down',
				'agenda' => 'fa-calendar-day',
				'fasilitas' => 'fa-building',
				'ppdb' => 'fa-file-signature',
			);
			sk_kosong($label, isset($ikon[$module]) ? $ikon[$module] : 'fa-folder-open');
			return;
		}

		switch ($module) {
			case 'pengumuman':
				sk_board($items);
				break;
			case 'prestasi':
				sk_trophies($items);
				break;
			case 'fasilitas':
				sk_rooms($items);
				break;
			case 'guru':
				sk_roster($items);
				break;
			case 'download':
				sk_files($items);
				break;
			case 'ppdb':
				sk_flow($items);
				break;
			case 'galeri':
				sk_mosaic($items);
				break;
			case 'agenda':
				sk_calendar($items);
				break;
			case 'ekstrakurikuler':
				sk_clubs($items);
				break;
			case 'berita':
				sk_press($items);
				break;
			default:
				sk_plain($items, $module);
		}
	}
}

/* ---------- PENGUMUMAN — papan pengumuman -------------------------------- */
if (!function_exists('sk_board')) {
	function sk_board($items)
	{
		echo '<div class="board">';
		foreach ($items as $item) {
			$ts = sk_tanggal($item);
			$baru = $ts && (time() - $ts) < 60 * 60 * 24 * 14;
			?>
			<article class="notice<?= $baru ? ' is-new' : ''; ?>" data-rise>
				<div class="notice-stamp">
					<?php if ($ts): ?>
						<b><?= date('d', $ts); ?></b>
						<span><?= sk_bulan($ts); ?></span>
						<i><?= date('Y', $ts); ?></i>
					<?php else: ?>
						<b><i class="fa-solid fa-thumbtack"></i></b>
					<?php endif; ?>
				</div>
				<div class="notice-body">
					<h2><?= html_escape(sk_judul($item, 'pengumuman')); ?></h2>
					<?php $isi = sk_ringkas(sk_isi($item), 34); ?>
					<?php if ($isi !== ''): ?>
						<p><?= html_escape($isi); ?></p>
					<?php endif; ?>
					<?php if ($baru): ?>
						<span class="notice-flag">Baru diumumkan</span>
					<?php endif; ?>
				</div>
			</article>
			<?php
		}
		echo '</div>';
	}
}

/* ---------- PRESTASI — lemari piala -------------------------------------- */
if (!function_exists('sk_trophies')) {
	function sk_trophies($items)
	{
		echo '<div class="trophies">';
		foreach ($items as $item) {
			$ts = sk_tanggal($item);
			$foto = sk_media($item, 'prestasi');
			$siswa = sk_pick($item, array('nama_siswa', 'peraih', 'nama_peserta'));
			$tingkat = sk_pick($item, array('tingkat', 'level', 'kategori'));
			$juara = sk_pick($item, array('peringkat', 'juara', 'hasil'));
			?>
			<article class="trophy" data-rise>
				<span class="trophy-ribbon" aria-hidden="true"></span>
				<div class="trophy-disc">
					<?php if ($foto): ?>
						<?php sk_img($foto, sk_judul($item, 'prestasi'), 'trophy-photo', 'fa-trophy'); ?>
					<?php else: ?>
						<i class="fa-solid fa-trophy"></i>
					<?php endif; ?>
				</div>
				<h2><?= html_escape(sk_judul($item, 'prestasi')); ?></h2>
				<?php if ($siswa !== ''): ?>
					<p class="trophy-who"><?= html_escape($siswa); ?></p>
				<?php endif; ?>
				<?php $isi = sk_ringkas(sk_isi($item), 18); ?>
				<?php if ($isi !== '' && $isi !== $siswa): ?>
					<p class="trophy-note"><?= html_escape($isi); ?></p>
				<?php endif; ?>
				<div class="trophy-foot">
					<?php if ($juara !== ''): ?><span><?= html_escape($juara); ?></span><?php endif; ?>
					<?php if ($tingkat !== ''): ?><span><?= html_escape($tingkat); ?></span><?php endif; ?>
					<?php if ($ts): ?><span><?= date('Y', $ts); ?></span><?php endif; ?>
				</div>
			</article>
			<?php
		}
		echo '</div>';
	}
}

/* ---------- FASILITAS — katalog ruang ------------------------------------ */
if (!function_exists('sk_rooms')) {
	function sk_rooms($items)
	{
		echo '<div class="rooms">';
		foreach ($items as $item) {
			$foto = sk_media($item, 'fasilitas');
			$judul = sk_judul($item, 'fasilitas');
			$jumlah = sk_pick($item, array('jumlah', 'kapasitas', 'unit'));
			?>
			<article class="room" data-rise>
				<div class="room-photo"
					<?= $foto ? 'data-zoom="' . html_escape($foto['src']) . '" data-title="' . html_escape($judul) . '" data-group="Fasilitas"' : ''; ?>>
					<?php sk_img($foto, $judul, '', 'fa-building'); ?>
				</div>
				<div class="room-body">
					<h2><?= html_escape($judul); ?></h2>
					<?php $isi = sk_ringkas(sk_isi($item), 30); ?>
					<?php if ($isi !== ''): ?>
						<p><?= html_escape($isi); ?></p>
					<?php endif; ?>
					<?php if ($jumlah !== ''): ?>
						<span class="room-meta"><i class="fa-solid fa-layer-group"></i>
							<?= html_escape($jumlah); ?> unit</span>
					<?php endif; ?>
				</div>
			</article>
			<?php
		}
		echo '</div>';
	}
}

/* ---------- GURU & STAF — kartu roster ----------------------------------- */
if (!function_exists('sk_roster')) {
	function sk_roster($items)
	{
		echo '<div class="roster">';
		foreach ($items as $item) {
			$nama = sk_judul($item, 'guru');
			$jabatan = sk_pick($item, array('jabatan', 'posisi'), 'Guru');
			$mapel = sk_pick($item, array('mata_pelajaran', 'mapel', 'bidang'));
			$nip = sk_pick($item, array('nip', 'nuptk'));
			$status = sk_pick($item, array('status'));
			$foto = sk_media($item, 'guru');
			$pimpinan = stripos($jabatan, 'kepala') !== FALSE;
			?>
			<article class="person<?= $pimpinan ? ' is-lead' : ''; ?>" data-rise>
				<div class="person-photo"><?php sk_img($foto, $nama, '', 'fa-user'); ?></div>
				<div class="person-body">
					<h2><?= html_escape($nama); ?></h2>
					<p class="person-role"><?= html_escape($jabatan); ?></p>
					<dl class="person-data">
						<?php if ($nip !== ''): ?>
							<dt>NIP</dt>
							<dd><?= html_escape($nip); ?></dd>
						<?php endif; ?>
						<?php if ($mapel !== ''): ?>
							<dt>Mengampu</dt>
							<dd><?= html_escape($mapel); ?></dd>
						<?php endif; ?>
						<?php if ($status !== ''): ?>
							<dt>Status</dt>
							<dd><?= html_escape(ucfirst($status)); ?></dd>
						<?php endif; ?>
					</dl>
				</div>
			</article>
			<?php
		}
		echo '</div>';
	}
}

/* ---------- DOWNLOAD — rak berkas ---------------------------------------- */
if (!function_exists('sk_files')) {
	function sk_files($items)
	{
		echo '<div class="files">';
		foreach ($items as $item) {
			$berkas = trim((string) sk_pick($item, array('file', 'berkas', 'nama_file')));
			// Database lama dapat berisi path Windows lengkap; URL publik hanya boleh memakai nama file.
			$berkas_path = str_replace('\\', '/', $berkas);
			$nama_berkas = basename($berkas_path);
			$ext = strtolower(pathinfo($nama_berkas, PATHINFO_EXTENSION));
			$peta = array(
				'pdf' => array('pdf', 'fa-file-pdf'),
				'doc' => array('doc', 'fa-file-word'),
				'docx' => array('doc', 'fa-file-word'),
				'xls' => array('xls', 'fa-file-excel'),
				'xlsx' => array('xls', 'fa-file-excel'),
				'ppt' => array('ppt', 'fa-file-powerpoint'),
				'pptx' => array('ppt', 'fa-file-powerpoint'),
				'zip' => array('zip', 'fa-file-zipper'),
				'rar' => array('zip', 'fa-file-zipper'),
				'jpg' => array('img', 'fa-file-image'),
				'png' => array('img', 'fa-file-image'),
			);
			$gaya = isset($peta[$ext]) ? $peta[$ext] : array('etc', 'fa-file-lines');
			$ts = sk_tanggal($item);
			$url = $nama_berkas !== '' && $nama_berkas !== '.'
				? base_url('assets/uploads/download/' . rawurlencode($nama_berkas))
				: '';
			?>
			<article class="file ext-<?= $gaya[0]; ?>" data-rise>
				<div class="file-type">
					<i class="fa-solid <?= $gaya[1]; ?>"></i>
					<span><?= html_escape($ext !== '' ? strtoupper($ext) : 'FILE'); ?></span>
				</div>
				<div class="file-body">
					<h2><?= html_escape(sk_judul($item, 'download')); ?></h2>
					<?php $isi = sk_ringkas(sk_isi($item), 20); ?>
					<?php if ($isi !== ''): ?>
						<p><?= html_escape($isi); ?></p>
					<?php endif; ?>
					<?php if ($ts): ?>
						<span class="file-date">Diunggah <?= date('d', $ts) . ' ' . sk_bulan($ts) . ' ' . date('Y', $ts); ?></span>
					<?php endif; ?>
				</div>
				<?php if ($url !== ''): ?>
					<a class="file-get" href="<?= $url; ?>" download>
						<i class="fa-solid fa-arrow-down"></i>Unduh
					</a>
				<?php else: ?>
					<span class="file-get is-off">Berkas belum tersedia</span>
				<?php endif; ?>
			</article>
			<?php
		}
		echo '</div>';
	}
}

/* ---------- PPDB / SPMB — alur pendaftaran ------------------------------- */
if (!function_exists('sk_flow')) {
	function sk_flow($items)
	{
		?>
		<div class="flow-lead" data-rise>
			<div>
				<h2>Pendaftaran peserta didik baru</h2>
				<p>Ikuti urutan di bawah ini. Setiap tahap punya tenggat sendiri, jadi selesaikan satu tahap
					sebelum lanjut ke berikutnya.</p>
			</div>
			<a class="btn-gold" href="<?= site_url('pengumuman'); ?>">
				Lihat pengumuman resmi<i class="fa-solid fa-arrow-right"></i>
			</a>
		</div>

		<ol class="flow">
			<?php $n = 0; ?>
			<?php foreach ($items as $item): ?>
				<?php $n++;
				$ts = sk_tanggal($item); ?>
				<li class="flow-step" data-rise>
					<span class="flow-node"><?= $n; ?></span>
					<div class="flow-card">
						<h3><?= html_escape(sk_judul($item, 'ppdb')); ?></h3>
						<?php $isi = sk_ringkas(sk_isi($item), 46); ?>
						<?php if ($isi !== ''): ?>
							<p><?= html_escape($isi); ?></p>
						<?php endif; ?>
						<?php if ($ts): ?>
							<span class="flow-when">
								<i class="fa-regular fa-calendar"></i>
								<?= date('d', $ts) . ' ' . sk_bulan($ts) . ' ' . date('Y', $ts); ?>
							</span>
						<?php endif; ?>
					</div>
				</li>
			<?php endforeach; ?>
		</ol>
		<?php
	}
}

/* ---------- GALERI — mosaik + penyaring album + lightbox ----------------- */
if (!function_exists('sk_mosaic')) {
	function sk_mosaic($items)
	{
		/* Kumpulkan nama album untuk tombol penyaring. */
		$album = array();
		foreach ($items as $item) {
			$nama = trim((string) sk_pick($item, array('nama_album', 'album', 'kategori')));
			if ($nama !== '' && !in_array($nama, $album, TRUE)) {
				$album[] = $nama;
			}
		}
		?>
		<?php if (count($album) > 1): ?>
			<div class="chips" data-filter="mosaic" data-rise>
				<button type="button" class="chip is-on" data-group="*">Semua album</button>
				<?php foreach ($album as $nama): ?>
					<button type="button" class="chip" data-group="<?= html_escape($nama); ?>">
						<?= html_escape($nama); ?>
					</button>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>

		<div class="mosaic" id="mosaic">
			<?php foreach ($items as $item): ?>
				<?php
				$judul = sk_judul($item, 'galeri');
				$nama_album = trim((string) sk_pick($item, array('nama_album', 'album', 'kategori'), 'Kegiatan sekolah'));
				$foto = sk_media($item, 'galeri');
				?>
				<figure class="shot" data-group="<?= html_escape($nama_album); ?>"
					<?= $foto ? 'data-zoom="' . html_escape($foto['src']) . '"' : ''; ?>
					data-title="<?= html_escape($judul); ?>" tabindex="0" data-rise>
					<?php sk_img($foto, $judul, '', 'fa-image'); ?>
					<figcaption>
						<strong><?= html_escape($judul); ?></strong>
						<span><?= html_escape($nama_album); ?></span>
					</figcaption>
				</figure>
			<?php endforeach; ?>
		</div>
		<?php
	}
}

/* ---------- AGENDA — linimasa kegiatan ----------------------------------- */
if (!function_exists('sk_calendar')) {
	function sk_calendar($items)
	{
		echo '<div class="calendar">';
		foreach ($items as $item) {
			$ts = sk_tanggal($item);
			$kelas = '';
			$status = '';
			if ($ts) {
				$selisih = (int) floor((strtotime(date('Y-m-d', $ts)) - strtotime(date('Y-m-d'))) / 86400);
				if ($selisih < 0) {
					$kelas = ' is-past';
					$status = 'Sudah berlangsung';
				} elseif ($selisih === 0) {
					$kelas = ' is-today';
					$status = 'Hari ini';
				} elseif ($selisih === 1) {
					$status = 'Besok';
				} else {
					$status = $selisih . ' hari lagi';
				}
			}
			$lokasi = sk_pick($item, array('lokasi', 'tempat'));
			?>
			<article class="event<?= $kelas; ?>" data-rise>
				<div class="event-date">
					<?php if ($ts): ?>
						<b><?= date('d', $ts); ?></b><span><?= sk_bulan($ts); ?></span>
					<?php else: ?>
						<b><i class="fa-regular fa-calendar"></i></b>
					<?php endif; ?>
				</div>
				<div class="event-body">
					<?php if ($status !== ''): ?>
						<span class="event-status"><?= html_escape($status); ?></span>
					<?php endif; ?>
					<h2><?= html_escape(sk_judul($item, 'agenda')); ?></h2>
					<?php if ($lokasi !== ''): ?>
						<p><i class="fa-solid fa-location-dot"></i><?= html_escape($lokasi); ?></p>
					<?php endif; ?>
				</div>
			</article>
			<?php
		}
		echo '</div>';
	}
}

/* ---------- EKSTRAKURIKULER — kartu medali lengkung ---------------------- */
if (!function_exists('sk_clubs')) {
	function sk_clubs($items)
	{
		echo '<div class="clubs">';
		foreach ($items as $item) {
			$nama = sk_judul($item, 'ekstrakurikuler');
			$foto = sk_media($item, 'ekstrakurikuler');
			$pembina = sk_pick($item, array('pembina', 'pelatih'));
			?>
			<article class="club" data-rise>
				<div class="club-medal">
					<?php if ($foto): ?>
						<?php sk_img($foto, $nama, 'club-photo', 'fa-star'); ?>
					<?php else: ?>
						<i class="fa-solid fa-star"></i>
					<?php endif; ?>
				</div>
				<h2><?= html_escape($nama); ?></h2>
				<?php $isi = sk_ringkas(sk_isi($item), 16); ?>
				<?php if ($isi !== ''): ?>
					<p><?= html_escape($isi); ?></p>
				<?php endif; ?>
				<?php if ($pembina !== ''): ?>
					<span class="club-coach">Pembina <?= html_escape($pembina); ?></span>
				<?php endif; ?>
			</article>
			<?php
		}
		echo '</div>';
	}
}

/* ---------- BERITA — kartu editorial ------------------------------------- */
if (!function_exists('sk_press')) {
	function sk_press($items)
	{
		echo '<div class="press">';
		$i = 0;
		foreach ($items as $item) {
			$i++;
			$ts = sk_tanggal($item);
			$foto = sk_media($item, 'berita');
			$judul = sk_judul($item, 'berita');
			$slug = sk_pick($item, array('slug', 'id'));
			$url = $slug !== '' ? site_url('berita/detail/' . rawurlencode($slug)) : '';
			?>
			<article class="story<?= $i === 1 ? ' is-lead' : ''; ?>" data-rise>
				<div class="story-photo">
					<?php sk_img($foto, $judul, '', 'fa-newspaper'); ?>
				</div>
				<div class="story-body">
					<?php if ($ts): ?>
						<span class="story-date">
							<?= date('d', $ts) . ' ' . sk_bulan($ts) . ' ' . date('Y', $ts); ?>
						</span>
					<?php endif; ?>
					<h2><?= html_escape($judul); ?></h2>
					<?php $isi = sk_ringkas(sk_isi($item), $i === 1 ? 38 : 22); ?>
					<?php if ($isi !== ''): ?>
						<p><?= html_escape($isi); ?></p>
					<?php endif; ?>
					<?php if ($url !== ''): ?>
						<a class="link-gold" href="<?= $url; ?>">
							Baca berita ini<i class="fa-solid fa-arrow-right"></i>
						</a>
					<?php endif; ?>
				</div>
			</article>
			<?php
		}
		echo '</div>';
	}
}

/* ---------- MODUL LAIN — kartu netral ------------------------------------ */
if (!function_exists('sk_plain')) {
	function sk_plain($items, $module)
	{
		echo '<div class="plain">';
		foreach ($items as $item) {
			$foto = sk_media($item, $module);
			$judul = sk_judul($item, $module);
			$ts = sk_tanggal($item);
			?>
			<article class="plain-card" data-rise>
				<?php if ($foto): ?>
					<div class="plain-photo"><?php sk_img($foto, $judul, '', 'fa-image'); ?></div>
				<?php endif; ?>
				<div class="plain-body">
					<h2><?= html_escape($judul); ?></h2>
					<?php $isi = sk_ringkas(sk_isi($item), 26); ?>
					<?php if ($isi !== ''): ?>
						<p><?= html_escape($isi); ?></p>
					<?php endif; ?>
					<?php if ($ts): ?>
						<span class="plain-date"><?= date('d', $ts) . ' ' . sk_bulan($ts) . ' ' . date('Y', $ts); ?></span>
					<?php endif; ?>
				</div>
			</article>
			<?php
		}
		echo '</div>';
	}
}
?>

<style>
	/* ==========================================================================
	   GAYA KHAS TIAP MODUL
	   Tiap modul punya bentuk sendiri, bukan satu kartu yang dipakai ulang:
	     pengumuman  → baris papan pengumuman
	     prestasi    → cakram medali berpita
	     fasilitas   → kartu belah foto/teks, arah berselang-seling
	     guru        → kartu roster berfoto lengkung
	     download    → baris berkas tanpa gambar
	     ppdb        → linimasa bernomor (memang sebuah urutan)
	     galeri      → mosaik bento + lightbox
	   ========================================================================== */

	/* ---------- PENGUMUMAN ---------- */
	.board {
		display: grid;
		gap: 14px;
	}

	.notice {
		position: relative;
		display: grid;
		grid-template-columns: 86px minmax(0, 1fr);
		gap: 24px;
		overflow: hidden;
		padding: 22px 26px 22px 30px;
		border: 1px solid var(--border);
		border-radius: var(--radius);
		background: #fff;
		box-shadow: var(--shadow-soft);
		transition: transform .35s var(--ease), box-shadow .35s ease, border-color .3s ease;
	}

	.notice::before {
		content: "";
		position: absolute;
		left: 0;
		top: 0;
		bottom: 0;
		width: 5px;
		background: var(--gold);
		transform: scaleY(.18);
		transition: transform .4s var(--ease);
	}

	.notice:hover {
		transform: translateX(6px);
		border-color: #e0cfab;
		box-shadow: var(--shadow-md);
	}

	.notice:hover::before {
		transform: scaleY(1);
	}

	.notice-stamp {
		display: grid;
		align-content: center;
		justify-items: center;
		padding: 12px 0;
		border: 1px dashed rgba(200, 147, 63, .45);
		border-radius: 14px;
		background: var(--cream);
		line-height: 1;
	}

	.notice-stamp b {
		color: var(--teal);
		font-family: 'Plus Jakarta Sans', sans-serif;
		font-size: 26px;
		font-weight: 800;
		letter-spacing: 0;
	}

	.notice-stamp span {
		margin-top: 5px;
		color: var(--gold-deep);
		font-size: 11px;
		font-weight: 700;
	}

	.notice-stamp>i {
		margin-top: 3px;
		color: var(--muted);
		font-size: 9.5px;
		font-style: normal;
	}

	.notice-body h2 {
		margin: 0 0 6px;
		color: var(--teal);
		font-family: 'Plus Jakarta Sans', sans-serif;
		font-size: 17px;
		font-weight: 800;
		letter-spacing: 0;
		line-height: 1.4;
	}

	.notice-body p {
		max-width: 76ch;
		margin: 0;
		color: var(--muted);
		font-size: 13.5px;
		line-height: 1.8;
	}

	.notice-flag {
		display: inline-block;
		margin-top: 12px;
		padding: 4px 11px;
		border-radius: var(--radius-pill);
		background: rgba(200, 147, 63, .16);
		color: var(--gold-deep);
		font-size: 10.5px;
		font-weight: 800;
	}

	/* ---------- PRESTASI ---------- */
	.trophies {
		display: grid;
		grid-template-columns: repeat(auto-fill, minmax(258px, 1fr));
		gap: 20px;
	}

	.trophy {
		--medal: #c8933f;
		--medal-soft: #f7ebd8;
		position: relative;
		display: flex;
		flex-direction: column;
		align-items: center;
		padding: 46px 24px 24px;
		border: 1px solid var(--border);
		border-radius: 22px;
		background: linear-gradient(180deg, #fff 0%, #fdfbf7 100%);
		text-align: center;
		box-shadow: var(--shadow-soft);
		transition: transform .4s var(--ease), box-shadow .4s ease, border-color .3s ease;
	}

	.trophy:nth-child(3n+2) {
		--medal: #8d9aa3;
		--medal-soft: #eef1f3;
	}

	.trophy:nth-child(3n+3) {
		--medal: #a4643a;
		--medal-soft: #f6e9e1;
	}

	.trophy:hover {
		transform: translateY(-8px);
		border-color: var(--medal);
		box-shadow: var(--shadow-hover);
	}

	/* pita yang tersampir di bahu kartu */
	.trophy-ribbon {
		position: absolute;
		top: 0;
		left: 50%;
		width: 54px;
		height: 30px;
		background: var(--medal);
		transform: translateX(-50%);
		clip-path: polygon(0 0, 100% 0, 100% 100%, 50% 72%, 0 100%);
	}

	.trophy-disc {
		position: relative;
		display: grid;
		place-items: center;
		width: 92px;
		height: 92px;
		margin: 6px 0 18px;
		overflow: hidden;
		border-radius: 50%;
		background: radial-gradient(circle at 32% 28%, #fff 0%, var(--medal-soft) 62%, var(--medal-soft) 100%);
		box-shadow:
			0 0 0 3px #fff,
			0 0 0 4px var(--medal),
			inset 0 -6px 14px rgba(0, 0, 0, .07),
			0 12px 24px rgba(6, 47, 47, .12);
		color: var(--medal);
		font-size: 30px;
		transition: transform .45s var(--ease);
	}

	.trophy:hover .trophy-disc {
		transform: scale(1.06) rotate(-5deg);
	}

	.trophy-photo {
		width: 100%;
		height: 100%;
		object-fit: cover;
	}

	.trophy h2 {
		margin: 0 0 6px;
		color: var(--teal);
		font-family: 'Fraunces', Georgia, serif;
		font-size: 19px;
		font-weight: 600;
		line-height: 1.35;
		text-wrap: balance;
	}

	.trophy-who {
		margin: 0;
		color: var(--gold-deep);
		font-size: 12.5px;
		font-weight: 700;
	}

	.trophy-note {
		margin: 8px 0 0;
		color: var(--muted);
		font-size: 12.5px;
		line-height: 1.7;
	}

	.trophy-foot {
		display: flex;
		flex-wrap: wrap;
		justify-content: center;
		gap: 6px;
		width: 100%;
		margin-top: 16px;
		padding-top: 14px;
		border-top: 1px dashed var(--border);
	}

	.trophy-foot span {
		padding: 4px 10px;
		border-radius: var(--radius-pill);
		background: var(--medal-soft);
		color: #4a5854;
		font-size: 10.5px;
		font-weight: 700;
	}

	/* ---------- FASILITAS ---------- */
	.rooms {
		display: grid;
		grid-template-columns: repeat(auto-fit, minmax(420px, 1fr));
		gap: 20px;
	}

	.room {
		display: grid;
		grid-template-columns: 190px minmax(0, 1fr);
		overflow: hidden;
		border: 1px solid var(--border);
		border-radius: var(--radius-lg);
		background: #fff;
		box-shadow: var(--shadow-soft);
		transition: transform .4s var(--ease), box-shadow .4s ease;
	}

	/* arah berselang-seling supaya barisnya punya irama */
	.rooms .room:nth-child(even) {
		grid-template-columns: minmax(0, 1fr) 190px;
	}

	.rooms .room:nth-child(even) .room-photo {
		order: 2;
	}

	.room:hover {
		transform: translateY(-6px);
		box-shadow: var(--shadow-hover);
	}

	.room-photo {
		position: relative;
		overflow: hidden;
		min-height: 210px;
		background: var(--teal-deep);
		cursor: zoom-in;
	}

	.room-photo img {
		width: 100%;
		height: 100%;
		object-fit: cover;
		transition: transform .7s var(--ease);
	}

	.room:hover .room-photo img {
		transform: scale(1.07);
	}

	.room-body {
		display: flex;
		flex-direction: column;
		justify-content: center;
		padding: 26px 28px;
	}

	.room-body h2 {
		position: relative;
		margin: 0 0 10px;
		padding-bottom: 12px;
		color: var(--teal);
		font-family: 'Plus Jakarta Sans', sans-serif;
		font-size: 18px;
		font-weight: 800;
		letter-spacing: 0;
	}

	.room-body h2::after {
		content: "";
		position: absolute;
		left: 0;
		bottom: 0;
		width: 26px;
		height: 2px;
		border-radius: 2px;
		background: var(--gold);
		transition: width .4s var(--ease);
	}

	.room:hover .room-body h2::after {
		width: 58px;
	}

	.room-body p {
		margin: 0;
		color: var(--muted);
		font-size: 13.5px;
		line-height: 1.8;
	}

	.room-meta {
		display: inline-flex;
		align-items: center;
		gap: 7px;
		margin-top: 14px;
		color: var(--gold-deep);
		font-size: 11.5px;
		font-weight: 700;
	}

	/* ---------- GURU & STAF ---------- */
	.roster {
		display: grid;
		grid-template-columns: repeat(auto-fill, minmax(216px, 1fr));
		gap: 20px;
	}

	.person {
		display: flex;
		flex-direction: column;
		overflow: hidden;
		padding: 20px 20px 22px;
		border: 1px solid var(--border);
		border-radius: 20px;
		background: #fff;
		box-shadow: var(--shadow-soft);
		transition: transform .35s var(--ease), box-shadow .35s ease, border-color .3s ease;
	}

	.person:hover {
		transform: translateY(-6px);
		border-color: #dbc69f;
		box-shadow: var(--shadow-hover);
	}

	.person-photo {
		position: relative;
		aspect-ratio: 3 / 3.4;
		overflow: hidden;
		margin-bottom: 16px;
		/* lengkung atas, gema dari foto kepala sekolah di beranda */
		border-radius: 110px 110px 16px 16px;
		background: linear-gradient(160deg, var(--teal), var(--teal-deep));
	}

	.person-photo img,
	.person-photo .media-fallback {
		width: 100%;
		height: 100%;
		object-fit: cover;
		object-position: top center;
		transition: transform .6s var(--ease);
	}

	.person:hover .person-photo img {
		transform: scale(1.05);
	}

	.person-body h2 {
		margin: 0 0 3px;
		color: var(--teal);
		font-family: 'Plus Jakarta Sans', sans-serif;
		font-size: 15px;
		font-weight: 800;
		letter-spacing: 0;
		line-height: 1.35;
	}

	.person-role {
		margin: 0 0 12px;
		color: var(--gold-deep);
		font-size: 11.5px;
		font-weight: 700;
	}

	.person-data {
		display: grid;
		grid-template-columns: auto 1fr;
		gap: 5px 12px;
		margin: 0;
		padding-top: 12px;
		border-top: 1px dashed var(--border);
	}

	.person-data dt {
		color: var(--muted);
		font-size: 10.5px;
		font-weight: 600;
	}

	.person-data dd {
		margin: 0;
		color: var(--text);
		font-size: 11.5px;
		font-weight: 600;
		text-align: right;
		word-break: break-word;
	}

	/* kepala sekolah tampil melebar dan mendatar */
	.person.is-lead {
		grid-column: span 2;
		flex-direction: row;
		align-items: center;
		gap: 22px;
		padding: 22px;
		border-color: #dbc69f;
		background: linear-gradient(135deg, #fdfbf6 0%, #f6f1e7 100%);
	}

	.person.is-lead .person-photo {
		flex: 0 0 132px;
		width: 132px;
		aspect-ratio: 3 / 3.4;
		margin: 0;
	}

	.person.is-lead .person-body {
		flex: 1;
		min-width: 0;
	}

	.person.is-lead h2 {
		font-size: 19px;
	}

	/* ---------- DOWNLOAD ---------- */
	.files {
		display: grid;
		gap: 12px;
	}

	.file {
		--ink: #6d7a76;
		--ink-soft: #eef1f0;
		display: grid;
		grid-template-columns: 62px minmax(0, 1fr) auto;
		align-items: center;
		gap: 20px;
		padding: 18px 22px;
		border: 1px solid var(--border);
		border-radius: 16px;
		background: #fff;
		box-shadow: var(--shadow-soft);
		transition: border-color .3s ease, box-shadow .3s ease, transform .3s var(--ease);
	}

	.file:hover {
		transform: translateY(-3px);
		border-color: var(--ink);
		box-shadow: var(--shadow-md);
	}

	.file.ext-pdf {
		--ink: #b5455f;
		--ink-soft: #fae9ec;
	}

	.file.ext-doc {
		--ink: #3c5ea8;
		--ink-soft: #eaf0fb;
	}

	.file.ext-xls {
		--ink: #1c7a42;
		--ink-soft: #e4f7ea;
	}

	.file.ext-ppt {
		--ink: #c07230;
		--ink-soft: #fbeee1;
	}

	.file.ext-zip {
		--ink: #6b52b5;
		--ink-soft: #f0ecfa;
	}

	.file.ext-img {
		--ink: #12706b;
		--ink-soft: #e2f1ef;
	}

	.file-type {
		display: grid;
		place-items: center;
		gap: 2px;
		width: 62px;
		height: 62px;
		border-radius: 14px;
		background: var(--ink-soft);
		color: var(--ink);
	}

	.file-type i {
		font-size: 21px;
	}

	.file-type span {
		font-size: 8.5px;
		font-weight: 800;
		letter-spacing: .5px;
	}

	.file-body h2 {
		margin: 0 0 3px;
		color: var(--teal);
		font-family: 'Plus Jakarta Sans', sans-serif;
		font-size: 15.5px;
		font-weight: 800;
		letter-spacing: 0;
		line-height: 1.4;
	}

	.file-body p {
		margin: 0;
		color: var(--muted);
		font-size: 12.5px;
	}

	.file-date {
		display: inline-block;
		margin-top: 5px;
		color: var(--muted);
		font-size: 10.5px;
		font-weight: 600;
	}

	.file-get {
		display: inline-flex;
		align-items: center;
		gap: 8px;
		padding: 11px 20px;
		border: 1px solid var(--ink);
		border-radius: var(--radius-pill);
		color: var(--ink);
		font-size: 12px;
		font-weight: 800;
		white-space: nowrap;
		transition: .25s var(--ease);
	}

	.file-get:hover {
		background: var(--ink);
		color: #fff;
		transform: translateY(-2px);
	}

	.file-get.is-off {
		border-style: dashed;
		border-color: var(--border);
		color: var(--muted);
		font-weight: 600;
		cursor: default;
	}

	/* ---------- PPDB / SPMB ---------- */
	.flow-lead {
		position: relative;
		display: flex;
		align-items: center;
		justify-content: space-between;
		flex-wrap: wrap;
		gap: 24px;
		overflow: hidden;
		margin-bottom: 38px;
		padding: 34px 38px;
		border-radius: var(--radius-lg);
		background: linear-gradient(135deg, var(--teal) 0%, #0a3f3f 55%, var(--teal-deep) 100%);
		color: #fff;
		box-shadow: var(--shadow-lg);
	}

	.flow-lead::before {
		content: "";
		position: absolute;
		right: -110px;
		top: -150px;
		width: 300px;
		height: 300px;
		border: 1px solid rgba(255, 255, 255, .09);
		border-radius: 50%;
	}

	.flow-lead>div {
		position: relative;
		z-index: 2;
		max-width: 54ch;
	}

	.flow-lead h2 {
		margin: 0 0 8px;
		font-family: 'Plus Jakarta Sans', sans-serif;
		font-size: 22px;
		font-weight: 800;
		letter-spacing: 0;
	}

	.flow-lead p {
		margin: 0;
		color: rgba(255, 255, 255, .72);
		font-size: 13.5px;
		line-height: 1.8;
	}

	.flow-lead .btn-gold {
		position: relative;
		z-index: 2;
	}

	.flow {
		position: relative;
		margin: 0;
		padding: 0;
		list-style: none;
	}

	.flow-step {
		position: relative;
		display: grid;
		grid-template-columns: 52px minmax(0, 1fr);
		gap: 22px;
		padding-bottom: 20px;
	}

	/* garis penghubung antar tahap */
	.flow-step::before {
		content: "";
		position: absolute;
		left: 25px;
		top: 52px;
		bottom: -2px;
		width: 2px;
		background: linear-gradient(180deg, rgba(200, 147, 63, .5), rgba(200, 147, 63, .12));
	}

	.flow-step:last-child::before {
		display: none;
	}

	.flow-node {
		position: relative;
		z-index: 2;
		display: grid;
		place-items: center;
		width: 52px;
		height: 52px;
		border-radius: 50%;
		background: linear-gradient(150deg, var(--teal), var(--teal-deep));
		color: var(--gold);
		font-family: 'Plus Jakarta Sans', sans-serif;
		font-size: 17px;
		font-weight: 800;
		box-shadow: 0 10px 22px rgba(6, 47, 47, .2);
	}

	.flow-card {
		padding: 22px 26px;
		border: 1px solid var(--border);
		border-radius: var(--radius);
		background: #fff;
		box-shadow: var(--shadow-soft);
		transition: transform .35s var(--ease), box-shadow .35s ease;
	}

	.flow-card:hover {
		transform: translateX(5px);
		box-shadow: var(--shadow-md);
	}

	.flow-card h3 {
		margin: 0 0 7px;
		color: var(--teal);
		font-family: 'Plus Jakarta Sans', sans-serif;
		font-size: 16.5px;
		font-weight: 800;
		letter-spacing: 0;
	}

	.flow-card p {
		max-width: 72ch;
		margin: 0;
		color: var(--muted);
		font-size: 13.5px;
		line-height: 1.8;
	}

	.flow-when {
		display: inline-flex;
		align-items: center;
		gap: 7px;
		margin-top: 12px;
		padding: 5px 12px;
		border-radius: var(--radius-pill);
		background: var(--gold-soft);
		color: var(--gold-deep);
		font-size: 11px;
		font-weight: 700;
	}

	/* ---------- GALERI ---------- */
	.chips {
		display: flex;
		flex-wrap: wrap;
		gap: 8px;
		margin-bottom: 22px;
	}

	.chip {
		padding: 8px 16px;
		border: 1px solid var(--border);
		border-radius: var(--radius-pill);
		background: #fff;
		color: var(--muted);
		font-family: 'DM Sans', sans-serif;
		font-size: 11.5px;
		font-weight: 700;
		cursor: pointer;
		transition: .25s var(--ease);
	}

	.chip:hover {
		border-color: var(--gold);
		color: var(--teal);
		transform: translateY(-2px);
	}

	.chip.is-on {
		border-color: transparent;
		background: linear-gradient(120deg, var(--teal), var(--teal-deep));
		color: #fff;
		box-shadow: 0 10px 20px rgba(6, 47, 47, .2);
	}

	.mosaic {
		display: grid;
		grid-template-columns: repeat(4, 1fr);
		grid-auto-rows: 152px;
		grid-auto-flow: dense;
		gap: 14px;
	}

	.shot {
		position: relative;
		margin: 0;
		overflow: hidden;
		border-radius: var(--radius);
		background: var(--teal-deep);
		cursor: zoom-in;
		box-shadow: var(--shadow-soft);
		animation: shotIn .45s var(--ease) both;
		transition: transform .4s var(--ease), box-shadow .4s ease;
	}

	@keyframes shotIn {
		from {
			opacity: 0;
			transform: scale(.94);
		}
	}

	/* satu foto besar tiap tujuh — memberi ritme tanpa boros ruang */
	.shot:nth-child(7n+1) {
		grid-column: span 2;
		grid-row: span 2;
	}

	.shot.is-out {
		display: none;
	}

	.shot img {
		width: 100%;
		height: 100%;
		object-fit: cover;
		transition: transform .7s var(--ease);
	}

	.shot:hover {
		transform: translateY(-5px);
		box-shadow: var(--shadow-hover);
		z-index: 2;
	}

	.shot:hover img {
		transform: scale(1.07);
	}

	.shot::after {
		content: "";
		position: absolute;
		inset: 0;
		background: linear-gradient(180deg, transparent 44%, rgba(6, 47, 47, .88) 100%);
		opacity: .8;
		transition: opacity .35s ease;
		pointer-events: none;
	}

	.shot:hover::after {
		opacity: 1;
	}

	.shot figcaption {
		position: absolute;
		inset: auto 0 0;
		z-index: 2;
		padding: 14px;
		color: #fff;
	}

	.shot figcaption strong {
		display: -webkit-box;
		-webkit-line-clamp: 2;
		-webkit-box-orient: vertical;
		overflow: hidden;
		font-family: 'Plus Jakarta Sans', sans-serif;
		font-size: 12.5px;
		font-weight: 800;
		line-height: 1.4;
	}

	.shot figcaption span {
		display: block;
		max-height: 0;
		overflow: hidden;
		color: var(--gold-soft);
		font-size: 10.5px;
		opacity: 0;
		transition: .35s var(--ease);
	}

	.shot:hover figcaption span,
	.shot:focus-visible figcaption span {
		max-height: 22px;
		margin-top: 4px;
		opacity: 1;
	}

	/* ---------- AGENDA ---------- */
	.calendar {
		display: grid;
		gap: 12px;
	}

	.event {
		display: grid;
		grid-template-columns: 62px minmax(0, 1fr);
		gap: 20px;
		padding: 18px 22px;
		border: 1px solid var(--border);
		border-radius: 16px;
		background: #fff;
		box-shadow: var(--shadow-soft);
		transition: transform .3s var(--ease), box-shadow .3s ease;
	}

	.event:hover {
		transform: translateX(5px);
		box-shadow: var(--shadow-md);
	}

	.event-date {
		display: grid;
		place-content: center;
		justify-items: center;
		width: 62px;
		height: 66px;
		border-radius: 14px;
		background: linear-gradient(150deg, var(--teal), var(--teal-deep));
		color: #fff;
		line-height: 1;
	}

	.event-date b {
		font-family: 'Plus Jakarta Sans', sans-serif;
		font-size: 21px;
		font-weight: 800;
	}

	.event-date span {
		margin-top: 5px;
		color: var(--gold);
		font-size: 9.5px;
		font-weight: 700;
	}

	.event.is-today .event-date {
		background: linear-gradient(150deg, var(--gold), var(--gold-deep));
		box-shadow: 0 10px 20px rgba(200, 147, 63, .35);
	}

	.event.is-today .event-date span {
		color: #fff;
	}

	.event.is-past .event-date {
		background: linear-gradient(150deg, #9aa7a3, #7d8a86);
	}

	.event-status {
		display: inline-block;
		margin-bottom: 6px;
		padding: 3px 10px;
		border-radius: var(--radius-pill);
		background: rgba(11, 74, 74, .08);
		color: var(--teal);
		font-size: 10px;
		font-weight: 800;
	}

	.event.is-today .event-status {
		background: rgba(200, 147, 63, .18);
		color: var(--gold-deep);
	}

	.event.is-past .event-status {
		color: var(--muted);
	}

	.event-body h2 {
		margin: 0;
		color: var(--teal);
		font-family: 'Plus Jakarta Sans', sans-serif;
		font-size: 15px;
		font-weight: 700;
		line-height: 1.45;
	}

	.event.is-past .event-body h2 {
		color: var(--muted);
	}

	.event-body p {
		margin: 5px 0 0;
		color: var(--muted);
		font-size: 12px;
	}

	.event-body p i {
		margin-right: 6px;
		color: var(--gold);
	}

	/* ---------- EKSTRAKURIKULER ---------- */
	.clubs {
		display: grid;
		grid-template-columns: repeat(auto-fill, minmax(210px, 1fr));
		gap: 20px;
	}

	.club {
		display: flex;
		flex-direction: column;
		align-items: center;
		padding: 32px 20px 24px;
		border: 1px solid var(--border);
		/* lengkung gerbang, ciri kartu ekskul di beranda */
		border-radius: 120px 120px 22px 22px;
		background: linear-gradient(180deg, #fff 0%, #fdfbf7 100%);
		text-align: center;
		box-shadow: var(--shadow-soft);
		transition: transform .4s var(--ease), box-shadow .4s ease, border-color .3s ease;
	}

	.club:hover {
		transform: translateY(-8px);
		border-color: var(--gold);
		box-shadow: var(--shadow-hover);
	}

	.club-medal {
		display: grid;
		place-items: center;
		width: 88px;
		height: 88px;
		margin-bottom: 16px;
		overflow: hidden;
		border-radius: 50%;
		background: radial-gradient(circle at 32% 28%, #fff 0%, var(--gold-soft) 100%);
		box-shadow: 0 0 0 1px rgba(200, 147, 63, .35), 0 10px 22px rgba(6, 47, 47, .12);
		color: var(--gold);
		font-size: 26px;
		transition: transform .4s var(--ease);
	}

	.club:hover .club-medal {
		transform: scale(1.06) rotate(-6deg);
	}

	.club-photo {
		width: 100%;
		height: 100%;
		object-fit: cover;
	}

	.club h2 {
		margin: 0 0 6px;
		color: var(--teal);
		font-family: 'Plus Jakarta Sans', sans-serif;
		font-size: 14.5px;
		font-weight: 800;
		line-height: 1.35;
	}

	.club p {
		margin: 0;
		color: var(--muted);
		font-size: 11.5px;
		line-height: 1.7;
	}

	.club-coach {
		margin-top: 12px;
		color: var(--gold-deep);
		font-size: 10.5px;
		font-weight: 700;
	}

	/* ---------- BERITA ---------- */
	.press {
		display: grid;
		grid-template-columns: repeat(2, minmax(0, 1fr));
		gap: 20px;
	}

	.story {
		display: flex;
		flex-direction: column;
		overflow: hidden;
		border: 1px solid var(--border);
		border-radius: 20px;
		background: #fff;
		box-shadow: var(--shadow-soft);
		transition: transform .35s var(--ease), box-shadow .35s ease, border-color .3s ease;
	}

	.story:hover {
		transform: translateY(-6px);
		border-color: #e2d3b6;
		box-shadow: var(--shadow-hover);
	}

	.story.is-lead {
		grid-column: 1 / -1;
		flex-direction: row;
	}

	.story-photo {
		overflow: hidden;
		background: var(--teal-deep);
	}

	.story.is-lead .story-photo {
		flex: 0 0 46%;
		min-height: 250px;
	}

	.story-photo img,
	.story-photo .media-fallback {
		width: 100%;
		height: 190px;
		object-fit: cover;
		transition: transform .6s var(--ease);
	}

	.story.is-lead .story-photo img,
	.story.is-lead .story-photo .media-fallback {
		height: 100%;
		min-height: 250px;
	}

	.story:hover .story-photo img {
		transform: scale(1.06);
	}

	.story-body {
		display: flex;
		flex: 1;
		flex-direction: column;
		padding: 20px 22px 22px;
	}

	.story.is-lead .story-body {
		justify-content: center;
		padding: 30px 32px;
	}

	.story-date {
		margin-bottom: 8px;
		color: var(--gold-deep);
		font-size: 10.5px;
		font-weight: 700;
	}

	.story h2 {
		margin: 0 0 8px;
		color: var(--teal);
		font-family: 'Plus Jakarta Sans', sans-serif;
		font-size: 15.5px;
		font-weight: 800;
		letter-spacing: 0;
		line-height: 1.45;
	}

	.story.is-lead h2 {
		font-size: 24px;
		letter-spacing: 0;
		line-height: 1.3;
	}

	.story p {
		margin: 0 0 14px;
		color: var(--muted);
		font-size: 13px;
		line-height: 1.75;
	}

	.story .link-gold {
		margin-top: auto;
	}

	/* ---------- MODUL LAIN ---------- */
	.plain {
		display: grid;
		grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
		gap: 20px;
	}

	.plain-card {
		display: flex;
		flex-direction: column;
		overflow: hidden;
		border: 1px solid var(--border);
		border-radius: var(--radius-lg);
		background: #fff;
		box-shadow: var(--shadow-soft);
		transition: transform .35s var(--ease), box-shadow .35s ease;
	}

	.plain-card:hover {
		transform: translateY(-6px);
		box-shadow: var(--shadow-hover);
	}

	.plain-photo img,
	.plain-photo .media-fallback {
		width: 100%;
		height: 190px;
		object-fit: cover;
	}

	.plain-body {
		padding: 22px;
	}

	.plain-body h2 {
		margin: 0 0 8px;
		color: var(--teal);
		font-family: 'Plus Jakarta Sans', sans-serif;
		font-size: 16px;
		font-weight: 800;
		line-height: 1.4;
	}

	.plain-body p {
		margin: 0;
		color: var(--muted);
		font-size: 13px;
		line-height: 1.75;
	}

	.plain-date {
		display: inline-block;
		margin-top: 12px;
		color: var(--gold-deep);
		font-size: 10.5px;
		font-weight: 700;
	}

	/* ==========================================================================
	   RESPONSIF MODUL
	   ========================================================================== */
	@media (max-width: 991px) {
		.rooms {
			grid-template-columns: 1fr;
		}

		.mosaic {
			grid-template-columns: repeat(3, 1fr);
			grid-auto-rows: 132px;
		}

		.press {
			grid-template-columns: 1fr;
		}

		.story.is-lead {
			flex-direction: column;
		}

		.story.is-lead .story-photo {
			flex: none;
			min-height: 0;
		}

		.story.is-lead .story-photo img,
		.story.is-lead .story-photo .media-fallback {
			height: 220px;
			min-height: 0;
		}

		.story.is-lead h2 {
			font-size: 20px;
		}

		.flow-lead {
			padding: 26px 24px;
		}
	}

	@media (max-width: 767px) {
		.room {
			grid-template-columns: 1fr;
		}

		.rooms .room:nth-child(even) {
			grid-template-columns: 1fr;
		}

		.rooms .room:nth-child(even) .room-photo {
			order: 0;
		}

		.room-photo {
			min-height: 200px;
		}

		.file {
			grid-template-columns: 54px minmax(0, 1fr);
			row-gap: 14px;
		}

		.file-get {
			grid-column: 1 / -1;
			justify-content: center;
		}

		.person.is-lead {
			flex-direction: column;
			align-items: stretch;
			text-align: left;
		}

		.person.is-lead .person-photo {
			width: 100%;
			flex: none;
		}
	}

	@media (max-width: 575px) {
		.notice {
			grid-template-columns: 66px minmax(0, 1fr);
			gap: 16px;
			padding: 18px 18px 18px 22px;
		}

		.notice-stamp b {
			font-size: 21px;
		}

		.mosaic {
			grid-template-columns: repeat(2, 1fr);
			grid-auto-rows: 118px;
			gap: 10px;
		}

		.trophies,
		.roster,
		.clubs {
			grid-template-columns: repeat(2, minmax(0, 1fr));
			gap: 12px;
		}

		.person.is-lead {
			grid-column: span 2;
		}

		.club {
			padding: 24px 12px 18px;
			border-radius: 90px 90px 18px 18px;
		}

		.club p {
			display: none;
		}

		.flow-step {
			grid-template-columns: 42px minmax(0, 1fr);
			gap: 14px;
		}

		.flow-node {
			width: 42px;
			height: 42px;
			font-size: 15px;
		}

		.flow-step::before {
			left: 20px;
			top: 44px;
		}

		.flow-card {
			padding: 18px 20px;
		}
	}

	@media (prefers-reduced-motion: reduce) {
		.shot {
			animation: none !important;
		}
	}
</style>
