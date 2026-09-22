<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!doctype html>
<html lang="id">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

	<?php $this->load->view('public/_style'); ?>
	<?php $this->load->view('public/_ui'); ?>

	<?php
	/* Blok ini memakai fungsi dari _ui.php, jadi letaknya setelah view itu dimuat. */
	$p = isset($profil) ? $profil : NULL;

	$nama     = $p ? sk_pick($p, array('nama_sekolah'), 'SMA Negeri Tawangmangu') : 'SMA Negeri Tawangmangu';
	$alamat   = $p ? sk_pick($p, array('alamat')) : '';
	$sejarah  = $p ? (string) sk_pick($p, array('sejarah')) : '';

	/* Kolom visi/misi bisa berupa teks polos atau array, tergantung controller. */
	if (!function_exists('profil_teks')) {
		function profil_teks($nilai)
		{
			if (is_array($nilai) || is_object($nilai)) {
				$baris = array();
				foreach ((array) $nilai as $kunci => $isi) {
					if (is_array($isi) || is_object($isi)) {
						foreach ((array) $isi as $anak) {
							if (is_scalar($anak)) $baris[] = trim((string) $anak);
						}
					} elseif (is_scalar($isi)) {
						$baris[] = is_string($kunci) && trim((string) $isi) === ''
							? $kunci
							: trim((string) $isi);
					}
				}
				return implode("\n", array_filter($baris, 'strlen'));
			}
			return trim((string) $nilai);
		}
	}

	$visi = $p && isset($p->visi) ? profil_teks($p->visi) : '';
	$misi = $p && isset($p->misi) ? profil_teks($p->misi) : '';
	$npsn     = $p ? sk_pick($p, array('npsn')) : '';
	$nss      = $p ? sk_pick($p, array('nss')) : '';
	$kepala   = $p ? sk_pick($p, array('nama_kepala', 'kepala_sekolah')) : '';
	$telepon  = $p ? sk_pick($p, array('telepon', 'no_telp')) : '';
	$email    = $p ? sk_pick($p, array('email')) : '';
	$judul    = isset($heading) && trim((string) $heading) !== '' ? $heading : 'Profil sekolah';

	/* Memecah teks misi bernomor ("1. ... 2. ...") menjadi daftar butir. */
	$butir_misi = array();
	if (trim($misi) !== '') {
		$pecah = preg_split('/(?:^|\s)\d{1,2}[\.\)]\s+/u', trim($misi), -1, PREG_SPLIT_NO_EMPTY);
		if (is_array($pecah) && count($pecah) > 1) {
			$butir_misi = array_map('trim', $pecah);
		} else {
			$butir_misi = array_values(array_filter(array_map('trim', preg_split('/\R+/', $misi)), 'strlen'));
		}
	}

	$identitas = array();
	if ($npsn !== '')    $identitas[] = array('NPSN', $npsn, 'fa-hashtag');
	if ($nss !== '')     $identitas[] = array('NSS', $nss, 'fa-barcode');
	if ($kepala !== '')  $identitas[] = array('Kepala sekolah', $kepala, 'fa-user-tie');
	if ($telepon !== '') $identitas[] = array('Telepon', $telepon, 'fa-phone');
	if ($email !== '')   $identitas[] = array('Surel', $email, 'fa-envelope');
	if ($alamat !== '')  $identitas[] = array('Alamat', $alamat, 'fa-location-dot');
	?>

	<title><?= html_escape(isset($title) ? $title : $judul); ?> &middot; <?= html_escape($nama); ?></title>
	<meta name="description"
		content="Sejarah, visi, dan misi <?= html_escape($nama); ?> beserta identitas resmi sekolah.">

	<style>
		/* ------------------------------------------------------------------
		   Profil dibaca berurutan: identitas → sejarah → visi → misi.
		   Visi memakai panel teal gelap dan misi panel krem, sama seperti
		   sepasang kartu di beranda, supaya halaman ini terasa satu keluarga.
		   ------------------------------------------------------------------ */
		.id-strip {
			display: grid;
			grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
			gap: 0;
			overflow: hidden;
			margin-top: -46px;
			margin-bottom: 52px;
			border: 1px solid var(--border);
			border-radius: var(--radius-lg);
			background: #fff;
			box-shadow: var(--shadow-lg);
		}

		.id-cell {
			display: flex;
			align-items: flex-start;
			gap: 14px;
			padding: 22px 24px;
			border-right: 1px solid var(--border);
			border-bottom: 1px solid var(--border);
		}

		.id-cell i {
			display: grid;
			place-items: center;
			flex: 0 0 36px;
			width: 36px;
			height: 36px;
			border-radius: 11px;
			background: var(--gold-soft);
			color: var(--gold-deep);
			font-size: 13px;
		}

		.id-cell dt {
			color: var(--muted);
			font-size: 10.5px;
			font-weight: 700;
			letter-spacing: .4px;
		}

		.id-cell dd {
			margin: 2px 0 0;
			color: var(--teal);
			font-family: 'Plus Jakarta Sans', sans-serif;
			font-size: 13.5px;
			font-weight: 800;
			line-height: 1.45;
			word-break: break-word;
		}

		.chapter {
			margin-bottom: 52px;
		}

		.chapter-head {
			margin-bottom: 22px;
		}

		.story-column {
			column-gap: 46px;
		}

		.story-column p {
			max-width: 70ch;
			margin: 0 0 16px;
			color: var(--text);
			font-size: 15.5px;
			line-height: 1.9;
		}

		.story-column p:first-of-type {
			color: var(--teal);
			font-family: 'Fraunces', Georgia, serif;
			font-size: 19px;
			font-style: italic;
			line-height: 1.75;
		}

		.pair {
			display: grid;
			grid-template-columns: repeat(2, minmax(0, 1fr));
			gap: 22px;
			align-items: start;
		}

		.panel {
			position: relative;
			isolation: isolate;
			overflow: hidden;
			padding: 34px;
			border-radius: 26px;
		}

		.panel::before {
			content: "";
			position: absolute;
			inset: 0;
			z-index: -2;
		}

		.panel-mark {
			position: absolute;
			right: -18px;
			bottom: -30px;
			z-index: -1;
			font-size: 168px;
			line-height: 1;
			pointer-events: none;
		}

		.panel h2 {
			margin: 0 0 16px;
			font-family: 'Plus Jakarta Sans', sans-serif;
			font-size: 20px;
			font-weight: 800;
			letter-spacing: 0;
		}

		/* VISI — teal gelap */
		.panel-visi {
			border: 1px solid rgba(255, 255, 255, .09);
			background: linear-gradient(150deg, #0d5350 0%, #0a3f3f 52%, #052a2a 100%);
			color: #fff;
			box-shadow: 0 20px 50px rgba(6, 47, 47, .24);
		}

		.panel-visi::before {
			background-image: radial-gradient(rgba(255, 255, 255, .1) 1px, transparent 1px);
			background-size: 18px 18px;
			opacity: .55;
		}

		.panel-visi .panel-mark {
			color: rgba(255, 255, 255, .05);
		}

		.panel-visi h2 {
			color: #fff;
		}

		.visi-quote {
			position: relative;
			padding: 26px 28px;
			border: 1px solid var(--border);
			border-radius: 20px;
			background: #fff;
			box-shadow: 0 12px 30px rgba(6, 47, 47, .18);
		}

		.visi-quote::before {
			content: "";
			position: absolute;
			left: 0;
			top: 22px;
			bottom: 22px;
			width: 3px;
			border-radius: 0 4px 4px 0;
			background: linear-gradient(var(--gold), rgba(200, 147, 63, .25));
		}

		.visi-quote p {
			margin: 0;
			color: var(--teal);
			font-family: 'Fraunces', Georgia, serif;
			font-size: 17.5px;
			line-height: 1.7;
		}

		/* MISI — krem terang */
		.panel-misi {
			border: 1px solid var(--border);
			background: linear-gradient(155deg, #fdfbf6 0%, #f6f1e6 100%);
			color: var(--teal);
			box-shadow: 0 18px 45px rgba(6, 47, 47, .08);
		}

		.panel-misi::before {
			background-image: repeating-linear-gradient(135deg, rgba(11, 74, 74, .045) 0 1px, transparent 1px 11px);
		}

		.panel-misi .panel-mark {
			color: rgba(11, 74, 74, .045);
		}

		.misi-list {
			counter-reset: misi;
			margin: 0;
			padding: 0;
			list-style: none;
		}

		.misi-list li {
			position: relative;
			display: flex;
			align-items: flex-start;
			gap: 14px;
			margin-bottom: 10px;
			padding: 15px 18px;
			border: 1px solid var(--border);
			border-radius: 16px;
			background: #fff;
			color: var(--muted);
			font-size: 13px;
			line-height: 1.75;
			box-shadow: var(--shadow-soft);
			transition: transform .3s var(--ease), box-shadow .3s ease;
		}

		.misi-list li:hover {
			transform: translateX(5px);
			box-shadow: var(--shadow-md);
		}

		.misi-list li::before {
			counter-increment: misi;
			content: counter(misi, decimal-leading-zero);
			display: grid;
			place-items: center;
			flex: 0 0 26px;
			width: 26px;
			height: 26px;
			border-radius: 9px;
			background: var(--gold-soft);
			color: var(--gold-deep);
			font-family: 'Plus Jakarta Sans', sans-serif;
			font-size: 10px;
			font-weight: 800;
		}

		.next-strip {
			display: grid;
			grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
			gap: 14px;
			margin-top: 8px;
		}

		.next-link {
			display: flex;
			align-items: center;
			justify-content: space-between;
			gap: 12px;
			padding: 18px 22px;
			border: 1px solid var(--border);
			border-radius: 16px;
			background: #fff;
			color: var(--teal);
			font-family: 'Plus Jakarta Sans', sans-serif;
			font-size: 13.5px;
			font-weight: 800;
			box-shadow: var(--shadow-soft);
			transition: .3s var(--ease);
		}

		.next-link i {
			color: var(--gold);
			transition: transform .3s var(--ease);
		}

		.next-link:hover {
			border-color: var(--gold);
			color: var(--teal);
			transform: translateY(-4px);
			box-shadow: var(--shadow-md);
		}

		.next-link:hover i {
			transform: translateX(4px);
		}

		@media (max-width: 991px) {
			.pair {
				grid-template-columns: 1fr;
			}

			.id-strip {
				margin-top: -30px;
			}
		}

		@media (max-width: 575px) {
			.panel {
				padding: 26px 20px;
			}

			.story-column p:first-of-type {
				font-size: 17px;
			}
		}
	</style>
</head>

<body>
	<div class="scroll-progress"></div>

	<?php sk_nav('profil'); ?>

	<?php sk_hero(array(
		'judul'   => $judul,
		'eyebrow' => 'Mengenal sekolah',
		'teks'    => 'Identitas resmi, perjalanan sekolah, serta arah yang dituju ' . $nama . '.',
	)); ?>

	<main class="page-body">
		<div class="shell">

			<?php if ($identitas): ?>
				<dl class="id-strip" data-rise>
					<?php foreach ($identitas as $baris): ?>
						<div class="id-cell">
							<i class="fa-solid <?= $baris[2]; ?>"></i>
							<div>
								<dt><?= html_escape($baris[0]); ?></dt>
								<dd><?= html_escape($baris[1]); ?></dd>
							</div>
						</div>
					<?php endforeach; ?>
				</dl>
			<?php endif; ?>

			<?php if (trim($sejarah) !== ''): ?>
				<section class="chapter" data-rise>
					<div class="chapter-head">
						<span class="eyebrow">Perjalanan sekolah</span>
						<h2 class="head-title">Sejarah singkat</h2>
					</div>
					<div class="story-column">
						<?php foreach (preg_split('/\R+/', $sejarah) as $baris): ?>
							<?php if (trim($baris) !== ''): ?>
								<p><?= html_escape(trim($baris)); ?></p>
							<?php endif; ?>
						<?php endforeach; ?>
					</div>
				</section>
			<?php endif; ?>

			<?php if (trim($visi) !== '' || $butir_misi): ?>
				<section class="chapter">
					<div class="chapter-head" data-rise>
						<span class="eyebrow">Arah sekolah</span>
						<h2 class="head-title">Visi dan misi</h2>
					</div>

					<div class="pair">
						<?php if (trim($visi) !== ''): ?>
							<div class="panel panel-visi" data-rise>
								<span class="panel-mark"><i class="fa-solid fa-earth-asia"></i></span>
								<h2>Visi</h2>
								<div class="visi-quote">
									<p><?= nl2br(html_escape(trim($visi))); ?></p>
								</div>
							</div>
						<?php endif; ?>

						<?php if ($butir_misi): ?>
							<div class="panel panel-misi" data-rise>
								<span class="panel-mark"><i class="fa-solid fa-bullseye"></i></span>
								<h2>Misi</h2>
								<ol class="misi-list">
									<?php foreach ($butir_misi as $baris): ?>
										<li><span><?= html_escape($baris); ?></span></li>
									<?php endforeach; ?>
								</ol>
							</div>
						<?php endif; ?>
					</div>
				</section>
			<?php endif; ?>

			<?php if (trim($sejarah) === '' && trim($visi) === '' && !$butir_misi): ?>
				<?php sk_kosong('profil sekolah', 'fa-landmark'); ?>
			<?php endif; ?>

			<section class="chapter" data-rise>
				<div class="chapter-head">
					<span class="eyebrow">Lanjut menelusuri</span>
					<h2 class="head-title">Halaman lain yang berkaitan</h2>
				</div>
				<div class="next-strip">
					<a class="next-link" href="<?= site_url('guru'); ?>">
						Guru dan staf<i class="fa-solid fa-arrow-right"></i>
					</a>
					<a class="next-link" href="<?= site_url('fasilitas'); ?>">
						Fasilitas<i class="fa-solid fa-arrow-right"></i>
					</a>
					<a class="next-link" href="<?= site_url('prestasi'); ?>">
						Prestasi<i class="fa-solid fa-arrow-right"></i>
					</a>
					<a class="next-link" href="<?= site_url('ppdb'); ?>">
						Pendaftaran SPMB<i class="fa-solid fa-arrow-right"></i>
					</a>
				</div>
			</section>
		</div>
	</main>

	<?php sk_footer($p); ?>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
