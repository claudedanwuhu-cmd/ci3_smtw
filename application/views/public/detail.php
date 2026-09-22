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
	$judul    = sk_judul($item, 'berita');
	$stempel  = sk_tanggal($item);
	$foto     = sk_media($item, 'berita');
	$isi      = (string) sk_pick($item, array('isi', 'konten', 'deskripsi'));
	$paragraf = array_values(array_filter(array_map('trim', preg_split('/\R+/', $isi)), 'strlen'));
	$menit    = max(1, (int) ceil(str_word_count(strip_tags($isi)) / 200));
	$profil   = isset($profil) ? $profil : NULL;
	$alamat   = current_url();
	?>

	<title><?= html_escape($judul); ?> &middot; SMA Negeri Tawangmangu</title>
	<meta name="description" content="<?= html_escape(sk_ringkas($isi, 28)); ?>">

	<style>
		/* ------------------------------------------------------------------
		   Halaman baca. Satu kolom sempit, tipografi diperbesar, dan foto
		   utama sengaja naik menindih hero supaya pembaca langsung tahu
		   di mana artikel dimulai.
		   ------------------------------------------------------------------ */
		.read-hero {
			padding-bottom: 130px;
		}

		.read-hero h1 {
			max-width: 20ch;
		}

		.read-meta {
			display: flex;
			align-items: center;
			flex-wrap: wrap;
			gap: 8px 18px;
			margin-top: 18px;
			color: rgba(255, 255, 255, .7);
			font-size: 12px;
			font-weight: 600;
		}

		.read-meta i {
			margin-right: 6px;
			color: var(--gold);
		}

		.read-wrap {
			position: relative;
			z-index: 3;
			max-width: 820px;
			margin: -100px auto 0;
			padding: 0 20px;
		}

		.read-figure {
			overflow: hidden;
			margin-bottom: 0;
			border: 1px solid rgba(255, 255, 255, .14);
			border-radius: var(--radius-lg) var(--radius-lg) 0 0;
			background: var(--teal-deep);
		}

		.read-figure img,
		.read-figure .media-fallback {
			display: block;
			width: 100%;
			height: 330px;
			object-fit: cover;
		}

		.read-sheet {
			padding: clamp(28px, 5vw, 52px);
			border: 1px solid var(--border);
			border-radius: var(--radius-lg);
			background: #fff;
			box-shadow: var(--shadow-lg);
		}

		.read-figure+.read-sheet {
			border-top: 0;
			border-radius: 0 0 var(--radius-lg) var(--radius-lg);
		}

		.read-sheet p {
			max-width: 66ch;
			margin: 0 0 18px;
			color: var(--text);
			font-size: 16.5px;
			line-height: 1.9;
		}

		/* huruf pembuka besar, ciri halaman baca */
		.read-sheet p:first-of-type::first-letter {
			float: left;
			margin: 6px 12px 0 0;
			color: var(--teal);
			font-family: 'Fraunces', Georgia, serif;
			font-size: 62px;
			font-weight: 600;
			line-height: .82;
		}

		.read-rule {
			height: 1px;
			margin: 34px 0 24px;
			border: 0;
			background: linear-gradient(90deg, var(--gold), var(--border) 45%, transparent);
		}

		.read-foot {
			display: flex;
			align-items: center;
			justify-content: space-between;
			flex-wrap: wrap;
			gap: 16px;
		}

		.share {
			display: flex;
			align-items: center;
			gap: 8px;
			color: var(--muted);
			font-size: 11.5px;
			font-weight: 700;
		}

		.share a,
		.share button {
			display: grid;
			place-items: center;
			width: 34px;
			height: 34px;
			border: 1px solid var(--border);
			border-radius: 10px;
			background: #fff;
			color: var(--teal);
			font-size: 12px;
			cursor: pointer;
			transition: .25s var(--ease);
		}

		.share a:hover,
		.share button:hover {
			background: var(--teal);
			border-color: var(--teal);
			color: #fff;
			transform: translateY(-3px);
		}

		/* Tawaran bacaan berikutnya, dibuat ringan supaya tidak menyaingi
		   artikel yang baru saja dibaca. */
		.more {
			max-width: 820px;
			margin: 52px auto 0;
			padding: 0 20px;
		}

		.more-head {
			display: flex;
			align-items: baseline;
			justify-content: space-between;
			flex-wrap: wrap;
			gap: 12px;
			margin-bottom: 18px;
			padding-bottom: 14px;
			border-bottom: 1px solid var(--border);
		}

		.more-head h2 {
			margin: 0;
			color: var(--teal);
			font-family: 'Plus Jakarta Sans', sans-serif;
			font-size: 17px;
			font-weight: 800;
			letter-spacing: 0;
		}

		.more-list {
			display: grid;
			grid-template-columns: repeat(3, minmax(0, 1fr));
			gap: 16px;
		}

		.more-item {
			display: flex;
			flex-direction: column;
			overflow: hidden;
			border: 1px solid var(--border);
			border-radius: 16px;
			background: #fff;
			box-shadow: var(--shadow-soft);
			transition: transform .3s var(--ease), box-shadow .3s ease, border-color .3s ease;
		}

		.more-item:hover {
			transform: translateY(-5px);
			border-color: #e2d3b6;
			box-shadow: var(--shadow-md);
		}

		.more-item img,
		.more-item .media-fallback {
			width: 100%;
			height: 118px;
			object-fit: cover;
		}

		.more-item span {
			padding: 13px 15px 4px;
			color: var(--gold-deep);
			font-size: 10px;
			font-weight: 700;
		}

		.more-item strong {
			display: -webkit-box;
			-webkit-line-clamp: 3;
			-webkit-box-orient: vertical;
			overflow: hidden;
			padding: 0 15px 16px;
			color: var(--teal);
			font-family: 'Plus Jakarta Sans', sans-serif;
			font-size: 13.5px;
			font-weight: 700;
			line-height: 1.45;
		}

		@media (max-width: 767px) {
			.more-list {
				grid-template-columns: 1fr;
			}

			.more-item {
				flex-direction: row;
				align-items: center;
			}

			.more-item img,
			.more-item .media-fallback {
				flex: 0 0 104px;
				width: 104px;
				height: 88px;
			}

			.more-item span {
				display: none;
			}

			.more-item strong {
				padding: 12px 14px;
			}

			.read-hero {
				padding-bottom: 100px;
			}

			.read-wrap {
				margin-top: -80px;
			}

			.read-figure img,
			.read-figure .media-fallback {
				height: 210px;
			}
		}
	</style>
</head>

<body>
	<div class="scroll-progress"></div>

	<?php sk_nav('berita'); ?>

	<header class="page-hero read-hero">
		<div class="shell">
			<nav class="crumb" aria-label="Jejak halaman">
				<a href="<?= site_url(); ?>">Beranda</a>
				<i class="fa-solid fa-chevron-right"></i>
				<a href="<?= site_url('berita'); ?>">Berita</a>
				<i class="fa-solid fa-chevron-right"></i>
				<span>Artikel</span>
			</nav>
			<a class="hero-home-link" href="<?= site_url(); ?>#informasi-sekolah">
				<i class="fa-solid fa-compass"></i>
				Kembali ke Jelajahi Sekolah
			</a>

			<span class="eyebrow">Warta sekolah</span>
			<h1><?= html_escape($judul); ?></h1>

			<div class="read-meta">
				<?php if ($stempel): ?>
					<span>
						<i class="fa-regular fa-calendar"></i>
						<time datetime="<?= date('Y-m-d', $stempel); ?>">
							<?= date('d', $stempel) . ' ' . sk_bulan($stempel) . ' ' . date('Y', $stempel); ?>
						</time>
					</span>
				<?php endif; ?>
				<span><i class="fa-regular fa-clock"></i><?= $menit; ?> menit baca</span>
				<span><i class="fa-solid fa-school"></i>Redaksi sekolah</span>
			</div>
		</div>
	</header>

	<main class="read-wrap">
		<?php if ($foto): ?>
			<figure class="read-figure">
				<?php sk_img($foto, $judul, '', 'fa-newspaper'); ?>
			</figure>
		<?php endif; ?>

		<article class="read-sheet">
			<?php if ($paragraf): ?>
				<?php foreach ($paragraf as $baris): ?>
					<p><?= html_escape($baris); ?></p>
				<?php endforeach; ?>
			<?php else: ?>
				<p>Isi berita ini belum ditulis. Redaksi sekolah akan melengkapinya melalui panel administrasi.</p>
			<?php endif; ?>

			<hr class="read-rule">

			<div class="read-foot">
				<a class="article-back" href="<?= site_url('berita'); ?>">
					<i class="fa-solid fa-arrow-left"></i>Kembali ke daftar berita
				</a>

				<div class="share">
					<span>Bagikan</span>
					<a href="https://wa.me/?text=<?= rawurlencode($judul . ' — ' . $alamat); ?>" target="_blank"
						rel="noopener" aria-label="Bagikan lewat WhatsApp">
						<i class="fa-brands fa-whatsapp"></i>
					</a>
					<a href="https://www.facebook.com/sharer/sharer.php?u=<?= rawurlencode($alamat); ?>"
						target="_blank" rel="noopener" aria-label="Bagikan ke Facebook">
						<i class="fa-brands fa-facebook-f"></i>
					</a>
					<button type="button" id="copyLink" aria-label="Salin tautan">
						<i class="fa-solid fa-link"></i>
					</button>
				</div>
			</div>
		</article>
	</main>

	<?php if (!empty($lainnya)): ?>
		<section class="more" data-rise>
			<div class="more-head">
				<h2>Berita lain yang mungkin Anda lewatkan</h2>
				<a class="link-gold" href="<?= site_url('berita'); ?>">
					Semua berita<i class="fa-solid fa-arrow-right"></i>
				</a>
			</div>

			<div class="more-list">
				<?php foreach ($lainnya as $lain): ?>
					<?php
					$l_judul = sk_judul($lain, 'berita');
					$l_foto  = sk_media($lain, 'berita');
					$l_ts    = sk_tanggal($lain);
					$l_kunci = sk_pick($lain, array('slug', 'id'));
					?>
					<a class="more-item"
						href="<?= $l_kunci !== '' ? site_url('berita/detail/' . rawurlencode($l_kunci)) : '#'; ?>">
						<?php sk_img($l_foto, $l_judul, '', 'fa-newspaper'); ?>
						<?php if ($l_ts): ?>
							<span><?= date('d', $l_ts) . ' ' . sk_bulan($l_ts) . ' ' . date('Y', $l_ts); ?></span>
						<?php endif; ?>
						<strong><?= html_escape($l_judul); ?></strong>
					</a>
				<?php endforeach; ?>
			</div>
		</section>
	<?php endif; ?>

	<div class="page-end-space" aria-hidden="true"></div>

	<?php sk_footer($profil); ?>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
	<script>
		document.getElementById('copyLink').addEventListener('click', function () {
			var tombol = this;
			var selesai = function () {
				tombol.innerHTML = '<i class="fa-solid fa-check"></i>';
				setTimeout(function () {
					tombol.innerHTML = '<i class="fa-solid fa-link"></i>';
				}, 1800);
			};
			if (navigator.clipboard) {
				navigator.clipboard.writeText(window.location.href).then(selesai);
			} else {
				var kotak = document.createElement('input');
				kotak.value = window.location.href;
				document.body.appendChild(kotak);
				kotak.select();
				document.execCommand('copy');
				document.body.removeChild(kotak);
				selesai();
			}
		});
	</script>
</body>

</html>