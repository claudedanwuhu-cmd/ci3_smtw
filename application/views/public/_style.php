<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link
	href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Fraunces:ital,wght@0,500;0,600;1,500;1,600&family=Plus+Jakarta+Sans:wght@500;600;700;800;900&display=swap"
	rel="stylesheet">

<style>
	/* ==========================================================================
	   SISTEM DESAIN PUBLIK — SMA NEGERI TAWANGMANGU
	   Satu sumber kebenaran untuk seluruh halaman publik.
	   Token, kerangka halaman (navbar / hero / footer), dan komponen dasar.
	   Gaya khusus tiap modul ada di public/_ui.php.
	   ========================================================================== */

	:root {
		/* Warna — sama persis dengan beranda */
		--teal: #0b4a4a;
		--teal-deep: #062f2f;
		--teal-light: #12706b;
		--gold: #c8933f;
		--gold-deep: #a97a2c;
		--gold-soft: #f7ebd8;
		--cream: #faf7f1;
		--white: #ffffff;
		--text: #2a3532;
		--muted: #6d7a76;
		--border: #e7e2d6;

		/* Bayangan bernada teal, bukan hitam netral */
		--shadow-soft: 0 6px 20px rgba(6, 47, 47, .05);
		--shadow-md: 0 14px 34px rgba(6, 47, 47, .09);
		--shadow-lg: 0 22px 55px rgba(6, 47, 47, .12);
		--shadow-hover: 0 26px 50px rgba(6, 47, 47, .18);

		--radius-sm: 10px;
		--radius: 18px;
		--radius-lg: 24px;
		--radius-pill: 999px;

		--ease: cubic-bezier(.22, .61, .36, 1);
		--shell: 1180px;
	}

	/* ==========================================================================
	   DASAR
	   ========================================================================== */
	* {
		box-sizing: border-box;
	}

	html {
		scroll-behavior: smooth;
		scroll-padding-top: 96px;
	}

	body {
		margin: 0;
		background: var(--white) !important;
		color: var(--text) !important;
		font-family: 'DM Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
		font-size: 15px;
		line-height: 1.7;
		overflow-x: hidden;
		-webkit-font-smoothing: antialiased;
		-moz-osx-font-smoothing: grayscale;
		text-rendering: optimizeLegibility;
	}

	img {
		max-width: 100%;
	}

	a {
		text-decoration: none;
	}

	::selection {
		background: var(--gold);
		color: #fff;
	}

	:focus-visible {
		outline: 2px solid var(--gold);
		outline-offset: 3px;
		border-radius: 4px;
	}

	::-webkit-scrollbar {
		width: 10px;
	}

	::-webkit-scrollbar-track {
		background: var(--cream);
	}

	::-webkit-scrollbar-thumb {
		background: #c9d2ce;
		border: 3px solid var(--cream);
		border-radius: 10px;
	}

	::-webkit-scrollbar-thumb:hover {
		background: var(--teal);
	}

	.shell {
		width: 100%;
		max-width: var(--shell);
		margin: 0 auto;
		padding: 0 20px;
	}

	/* ==========================================================================
	   TIPOGRAFI BERSAMA
	   ========================================================================== */
	.eyebrow {
		display: inline-flex;
		align-items: center;
		gap: 9px;
		margin-bottom: 12px;
		color: var(--gold);
		font-family: 'Fraunces', Georgia, serif;
		font-size: 15px;
		font-style: italic;
		font-weight: 500;
	}

	.eyebrow::before {
		content: "";
		width: 26px;
		height: 2px;
		border-radius: 2px;
		background: linear-gradient(90deg, transparent, currentColor);
	}

	.head-title {
		margin: 0 0 14px;
		color: var(--teal);
		font-family: 'Plus Jakarta Sans', sans-serif;
		font-size: 36px;
		font-weight: 800;
		letter-spacing: 0;
		line-height: 1.2;
		text-wrap: balance;
	}

	.lede {
		max-width: 62ch;
		margin: 0;
		color: var(--muted);
		font-size: 14.5px;
		line-height: 1.8;
		text-wrap: pretty;
	}

	/* ==========================================================================
	   TOMBOL
	   ========================================================================== */
	.btn-gold {
		position: relative;
		display: inline-flex;
		align-items: center;
		gap: 9px;
		overflow: hidden;
		padding: 13px 24px;
		border: 0;
		border-radius: 10px;
		background: linear-gradient(120deg, var(--gold), #dba659);
		color: #fff;
		font-size: 12.5px;
		font-weight: 700;
		letter-spacing: .3px;
		box-shadow: 0 12px 26px rgba(200, 147, 63, .3);
		transition: transform .25s var(--ease), box-shadow .25s ease;
	}

	.btn-gold::before {
		content: "";
		position: absolute;
		inset: 0 auto 0 -120%;
		width: 60%;
		background: linear-gradient(100deg, transparent, rgba(255, 255, 255, .45), transparent);
		transform: skewX(-20deg);
		transition: left .6s var(--ease);
	}

	.btn-gold:hover {
		color: #fff;
		transform: translateY(-3px);
		box-shadow: 0 18px 34px rgba(200, 147, 63, .4);
	}

	.btn-gold:hover::before {
		left: 130%;
	}

	.btn-quiet {
		display: inline-flex;
		align-items: center;
		gap: 8px;
		padding: 12px 20px;
		border: 1px solid rgba(255, 255, 255, .28);
		border-radius: 10px;
		background: rgba(255, 255, 255, .08);
		color: #fff;
		font-size: 12.5px;
		font-weight: 700;
		transition: .25s var(--ease);
	}

	.btn-quiet:hover {
		background: rgba(255, 255, 255, .16);
		border-color: rgba(255, 255, 255, .5);
		color: #fff;
	}

	.link-gold {
		display: inline-flex;
		align-items: center;
		gap: 6px;
		color: var(--gold-deep);
		font-size: 11.5px;
		font-weight: 800;
		letter-spacing: .2px;
		transition: gap .25s var(--ease), color .2s ease;
	}

	.link-gold:hover {
		gap: 11px;
		color: var(--teal);
	}

	/* ==========================================================================
	   NAVBAR
	   ========================================================================== */
	.site-nav {
		position: sticky;
		top: 0;
		z-index: 1000;
		min-height: 76px;
		padding: 0;
		background: rgba(255, 255, 255, .8) !important;
		backdrop-filter: blur(18px) saturate(1.4);
		-webkit-backdrop-filter: blur(18px) saturate(1.4);
		border-bottom: 1px solid var(--border) !important;
		transition: background .3s ease, box-shadow .3s ease, min-height .3s ease;
	}

	.site-nav.is-stuck {
		min-height: 66px;
		background: rgba(255, 255, 255, .96) !important;
		box-shadow: 0 14px 34px rgba(6, 47, 47, .09);
	}

	.site-nav .brand {
		display: inline-flex;
		align-items: center;
		gap: 12px;
		color: var(--teal) !important;
		text-decoration: none;
	}

	.brand-mark {
		position: relative;
		display: grid;
		place-items: center;
		width: 44px;
		height: 44px;
		overflow: hidden;
		border-radius: 12px;
		background: linear-gradient(150deg, var(--teal), var(--teal-deep));
		color: #fff;
		font-size: 18px;
		box-shadow: 0 8px 18px rgba(6, 47, 47, .22);
		transition: transform .35s var(--ease);
	}

	.site-nav .brand:hover .brand-mark {
		transform: rotate(-6deg) scale(1.05);
	}

	.brand-text {
		display: block;
		font-family: 'Plus Jakarta Sans', sans-serif;
		font-size: 13px;
		font-weight: 800;
		line-height: 1.25;
		letter-spacing: 0;
	}

	.brand-sub {
		display: block;
		color: #97a29c;
		font-size: 9px;
		font-weight: 700;
		letter-spacing: 1px;
		text-transform: uppercase;
	}

	.site-nav .nav-link {
		position: relative;
		padding: 26px 13px !important;
		color: #3d4a46 !important;
		font-size: 12.5px;
		font-weight: 600;
		transition: color .25s ease, padding .3s ease;
	}

	.site-nav.is-stuck .nav-link {
		padding-top: 21px !important;
		padding-bottom: 21px !important;
	}

	.site-nav .nav-link::after {
		content: "";
		position: absolute;
		left: 13px;
		right: 13px;
		bottom: 19px;
		height: 2px;
		border-radius: 2px;
		background: var(--gold);
		transform: scaleX(0);
		transform-origin: left;
		transition: transform .3s var(--ease);
	}

	.site-nav .nav-link:hover,
	.site-nav .nav-link.active {
		color: var(--teal) !important;
	}

	.site-nav .nav-link:hover::after,
	.site-nav .nav-link.active::after {
		transform: scaleX(1);
	}

	.site-nav .dropdown-toggle::after {
		transition: transform .25s ease;
	}

	.site-nav .nav-item.show .dropdown-toggle::after {
		transform: rotate(180deg);
	}

	.site-nav .dropdown-menu {
		margin-top: 0 !important;
		padding: 8px;
		border: 1px solid var(--border) !important;
		border-radius: 14px;
		box-shadow: 0 16px 35px rgba(6, 47, 47, .12) !important;
		animation: dropIn .25s var(--ease);
	}

	@keyframes dropIn {
		from {
			opacity: 0;
			transform: translateY(-8px);
		}
	}

	.site-nav .dropdown-item {
		padding: 9px 11px;
		border-radius: 9px;
		color: #3d4a46;
		font-size: 12px;
		font-weight: 600;
		transition: .2s ease;
	}

	.site-nav .dropdown-item:hover,
	.site-nav .dropdown-item:focus,
	.site-nav .dropdown-item.active {
		background: var(--cream);
		color: var(--teal);
		transform: translateX(3px);
	}

	.nav-tools {
		display: flex;
		align-items: center;
		gap: 10px;
	}

	.login-link {
		display: inline-flex;
		align-items: center;
		gap: 7px;
		padding: 9px 16px;
		border: 1px solid var(--border);
		border-radius: 10px;
		background: #fff;
		color: var(--teal) !important;
		font-size: 12.5px;
		font-weight: 700;
		white-space: nowrap;
		transition: .25s var(--ease);
	}

	.login-link:hover {
		background: var(--cream);
		border-color: rgba(11, 74, 74, .25);
		transform: translateY(-2px);
		box-shadow: 0 8px 18px rgba(6, 47, 47, .08);
	}

	.nav-cta {
		position: relative;
		display: inline-flex;
		align-items: center;
		gap: 7px;
		overflow: hidden;
		padding: 10px 18px;
		border-radius: 10px;
		background: linear-gradient(120deg, var(--gold), #dba659);
		color: #fff !important;
		font-size: 12.5px;
		font-weight: 700;
		white-space: nowrap;
		box-shadow: 0 8px 18px rgba(200, 147, 63, .28);
		transition: transform .25s var(--ease), box-shadow .25s ease;
	}

	.nav-cta::before {
		content: "";
		position: absolute;
		inset: 0 auto 0 -110%;
		width: 55%;
		background: linear-gradient(100deg, transparent, rgba(255, 255, 255, .45), transparent);
		transform: skewX(-20deg);
		transition: left .65s var(--ease);
	}

	.nav-cta:hover {
		transform: translateY(-2px);
		box-shadow: 0 14px 26px rgba(200, 147, 63, .35);
	}

	.nav-cta:hover::before {
		left: 130%;
	}

	.site-nav .navbar-toggler {
		padding: 8px 12px;
		border: 1px solid var(--border);
		border-radius: 10px;
		color: var(--teal);
		box-shadow: none !important;
	}

	/* ==========================================================================
	   HERO HALAMAN
	   Satu elemen pemersatu: latar teal bermotif titik, rona emas,
	   dan garis emas berkilau di dasar — persis bahasa beranda.
	   ========================================================================== */
	.page-hero,
	.public-hero,
	.hero {
		position: relative;
		overflow: hidden;
		padding: 74px 0 78px;
		background:
			radial-gradient(1100px 520px at 12% 110%, rgba(200, 147, 63, .22), transparent 62%),
			linear-gradient(135deg, #0d5350 0%, #0a3f3f 52%, var(--teal-deep) 100%);
		color: #fff;
	}

	.page-hero::before,
	.public-hero::before,
	.hero::before {
		content: "";
		position: absolute;
		inset: 0;
		background-image: radial-gradient(rgba(255, 255, 255, .09) 1px, transparent 1px);
		background-size: 22px 22px;
		mask-image: linear-gradient(to bottom, #000, transparent);
		-webkit-mask-image: linear-gradient(to bottom, #000, transparent);
		pointer-events: none;
	}

	.page-hero::after,
	.public-hero::after,
	.hero::after {
		content: "";
		position: absolute;
		left: 0;
		right: 0;
		bottom: 0;
		height: 3px;
		background: linear-gradient(90deg, var(--gold), var(--teal-light), var(--gold));
		background-size: 220% 100%;
		animation: railShine 7s linear infinite;
	}

	@keyframes railShine {
		to {
			background-position: 220% 0;
		}
	}

	.page-hero .shell,
	.public-hero .container,
	.hero .container {
		position: relative;
		z-index: 2;
	}

	.hero-grid {
		display: grid;
		grid-template-columns: minmax(0, 1fr) auto;
		align-items: end;
		gap: 32px;
	}

	.crumb {
		display: flex;
		align-items: center;
		flex-wrap: wrap;
		gap: 8px;
		margin-bottom: 18px;
		color: rgba(255, 255, 255, .55);
		font-size: 11px;
		font-weight: 600;
	}

	.crumb a {
		color: rgba(255, 255, 255, .75);
		transition: color .2s ease;
	}

	.crumb a:hover {
		color: var(--gold-soft);
	}

	.crumb i {
		font-size: 7px;
		opacity: .6;
	}

	.hero-home-link {
		display: inline-flex;
		align-items: center;
		gap: 8px;
		margin-bottom: 24px;
		padding: 9px 13px;
		border: 1px solid rgba(255, 255, 255, .28);
		border-radius: 8px;
		background: rgba(255, 255, 255, .08);
		color: #fff;
		font-size: 12px;
		font-weight: 700;
		transition: background .2s ease, border-color .2s ease, transform .2s ease;
	}

	.hero-home-link:hover {
		border-color: rgba(255, 255, 255, .5);
		background: rgba(255, 255, 255, .16);
		color: #fff;
		transform: translateY(-2px);
	}

	.page-hero .eyebrow {
		color: var(--gold-soft);
	}

	.page-hero h1,
	.public-hero h1,
	.hero h1 {
		margin: 0 0 14px;
		color: #fff;
		font-family: 'Plus Jakarta Sans', sans-serif;
		font-size: 46px;
		font-weight: 800;
		letter-spacing: 0;
		line-height: 1.12;
		text-wrap: balance;
	}

	.page-hero p,
	.public-hero p,
	.hero p {
		max-width: 56ch;
		margin: 0;
		color: rgba(255, 255, 255, .78);
		font-size: 14.5px;
		line-height: 1.85;
	}

	/* Cap jumlah data di sisi kanan hero */
	.hero-count {
		display: flex;
		align-items: baseline;
		gap: 10px;
		padding: 18px 26px;
		border: 1px solid rgba(255, 255, 255, .16);
		border-radius: var(--radius);
		background: rgba(255, 255, 255, .06);
		backdrop-filter: blur(6px);
		white-space: nowrap;
	}

	.hero-count b {
		color: var(--gold);
		font-family: 'Plus Jakarta Sans', sans-serif;
		font-size: 34px;
		font-weight: 800;
		letter-spacing: 0;
		line-height: 1;
	}

	.hero-count span {
		color: rgba(255, 255, 255, .6);
		font-size: 11px;
		font-weight: 600;
	}

	/* Lencana/tag lama tetap didukung */
	.tag {
		display: inline-flex;
		align-items: center;
		gap: 7px;
		padding: 6px 14px;
		border: 1px solid rgba(200, 147, 63, .3);
		border-radius: var(--radius-pill);
		background: rgba(200, 147, 63, .14);
		color: var(--gold) !important;
		font-size: 11px;
		font-weight: 700;
		letter-spacing: .3px;
	}

	/* ==========================================================================
	   ISI HALAMAN
	   ========================================================================== */
	.page-body,
	.public-content {
		position: relative;
		padding: 58px 0 84px;
	}

	.page-end-space {
		height: 72px;
	}

	.page-body--cream {
		background: var(--cream);
	}

	.block-head {
		display: flex;
		align-items: flex-end;
		justify-content: space-between;
		flex-wrap: wrap;
		gap: 16px;
		margin-bottom: 28px;
	}

	/* Keadaan kosong: ajakan, bukan permintaan maaf */
	.empty-state {
		display: grid;
		place-items: center;
		gap: 6px;
		padding: 56px 26px;
		border: 1px dashed var(--border);
		border-radius: var(--radius-lg);
		background: var(--cream);
		text-align: center;
	}

	.empty-state-icon {
		display: grid;
		place-items: center;
		width: 62px;
		height: 62px;
		margin-bottom: 8px;
		border-radius: 50%;
		background: var(--gold-soft);
		color: var(--gold-deep);
		font-size: 22px;
	}

	.empty-state h3 {
		margin: 0;
		color: var(--teal);
		font-family: 'Plus Jakarta Sans', sans-serif;
		font-size: 17px;
		font-weight: 800;
	}

	.empty-state p {
		max-width: 46ch;
		margin: 0;
		color: var(--muted);
		font-size: 13px;
	}

	/* Pengganti gambar yang gagal dimuat */
	.media-fallback {
		display: grid;
		place-items: center;
		width: 100%;
		height: 100%;
		min-height: 120px;
		background:
			repeating-linear-gradient(135deg, rgba(11, 74, 74, .045) 0 1px, transparent 1px 11px),
			var(--gold-soft);
		color: rgba(11, 74, 74, .32);
		font-size: 28px;
	}

	/* ==========================================================================
	   KOMPATIBILITAS KELAS LAMA (.item / .article-content / .profile-panel)
	   Supaya view lain yang belum dirombak tidak rusak.
	   ========================================================================== */
	.item,
	.article-content,
	.profile-panel {
		background: var(--white);
		border: 1px solid var(--border);
		border-radius: var(--radius-lg);
		box-shadow: var(--shadow-soft);
	}

	.item {
		display: flex;
		flex-direction: column;
		height: 100%;
		overflow: hidden;
		transition: transform .35s var(--ease), box-shadow .35s ease, border-color .3s ease;
	}

	.item:hover {
		transform: translateY(-6px);
		border-color: #e2d3b6;
		box-shadow: var(--shadow-hover);
	}

	.item-media,
	.item-placeholder {
		width: 100%;
		height: 210px;
		object-fit: cover;
	}

	.item-placeholder {
		display: grid;
		place-items: center;
		background: var(--gold-soft);
		color: var(--teal);
		font-size: 30px;
	}

	.item-body {
		display: flex;
		flex-direction: column;
		flex-grow: 1;
		padding: 24px;
	}

	.item h2 {
		color: var(--teal);
		font-family: 'Plus Jakarta Sans', sans-serif;
		font-size: 17px;
		font-weight: 800;
		letter-spacing: 0;
		line-height: 1.4;
	}

	/* ==========================================================================
	   ARTIKEL
	   ========================================================================== */
	.article-content {
		padding: clamp(28px, 5vw, 56px);
	}

	.article-back {
		display: inline-flex;
		align-items: center;
		gap: 8px;
		color: var(--teal);
		font-size: 12.5px;
		font-weight: 700;
		transition: gap .25s var(--ease), color .2s ease;
	}

	.article-back:hover {
		gap: 13px;
		color: var(--gold-deep);
	}

	.article-body {
		color: var(--text);
		font-size: 16px;
		line-height: 1.9;
	}

	.article-body p {
		max-width: 68ch;
	}

	/* ==========================================================================
	   FOOTER
	   ========================================================================== */
	.public-footer {
		position: relative;
		padding: 56px 0 0;
		background: var(--teal-deep);
		color: rgba(255, 255, 255, .62);
		font-size: 12.5px;
	}

	.public-footer::before {
		content: "";
		position: absolute;
		top: 0;
		left: 0;
		right: 0;
		height: 3px;
		background: linear-gradient(90deg, var(--gold), var(--teal-light), var(--gold));
		background-size: 220% 100%;
		animation: railShine 7s linear infinite;
	}

	.footer-grid {
		display: grid;
		grid-template-columns: 1.4fr 1fr 1fr;
		gap: 44px;
	}

	.footer-brand {
		display: flex;
		align-items: center;
		gap: 12px;
		margin-bottom: 16px;
		color: #fff;
	}

	.footer-brand .brand-mark {
		background: rgba(255, 255, 255, .08);
		border: 1px solid rgba(255, 255, 255, .12);
		box-shadow: none;
	}

	.footer-brand b {
		display: block;
		font-family: 'Plus Jakarta Sans', sans-serif;
		font-size: 13px;
		font-weight: 800;
		line-height: 1.4;
	}

	.footer-intro {
		max-width: 44ch;
		margin: 0 0 14px;
	}

	.footer-heading {
		position: relative;
		margin-bottom: 18px;
		padding-bottom: 10px;
		color: #fff;
		font-size: 11.5px;
		font-weight: 800;
		letter-spacing: .6px;
	}

	.footer-heading::after {
		content: "";
		position: absolute;
		left: 0;
		bottom: 0;
		width: 28px;
		height: 2px;
		border-radius: 2px;
		background: var(--gold);
	}

	.public-footer a {
		color: rgba(255, 255, 255, .8);
		transition: color .2s ease, padding-left .2s ease;
	}

	.public-footer a:hover {
		color: var(--gold);
		padding-left: 5px;
	}

	.footer-links a {
		display: block;
		margin-bottom: 8px;
	}

	.footer-contact i {
		width: 18px;
		color: var(--gold);
	}

	.footer-bottom {
		margin-top: 44px;
		padding: 18px 0;
		border-top: 1px solid rgba(255, 255, 255, .08);
		color: rgba(255, 255, 255, .45);
		font-size: 10.5px;
		text-align: center;
	}

	/* ==========================================================================
	   PROGRESS + KEMBALI KE ATAS
	   ========================================================================== */
	.scroll-progress {
		position: fixed;
		top: 0;
		left: 0;
		z-index: 2000;
		width: 0;
		height: 3px;
		background: linear-gradient(90deg, var(--gold), var(--teal-light));
		transition: width .1s linear;
	}

	.to-top {
		position: fixed;
		right: 22px;
		bottom: 22px;
		z-index: 900;
		display: grid;
		place-items: center;
		width: 46px;
		height: 46px;
		border: 0;
		border-radius: 50%;
		background: linear-gradient(150deg, var(--teal), var(--teal-deep));
		color: #fff;
		font-size: 14px;
		box-shadow: 0 12px 26px rgba(6, 47, 47, .28);
		opacity: 0;
		visibility: hidden;
		transform: translateY(14px);
		transition: .35s var(--ease);
	}

	.to-top.show {
		opacity: 1;
		visibility: visible;
		transform: none;
	}

	.to-top:hover {
		background: linear-gradient(150deg, var(--gold), var(--gold-deep));
		transform: translateY(-4px);
	}

	/* ==========================================================================
	   LIGHTBOX (dipakai galeri & fasilitas)
	   ========================================================================== */
	.lightbox {
		position: fixed;
		inset: 0;
		z-index: 3000;
		display: grid;
		place-items: center;
		padding: 26px;
		background: rgba(4, 26, 26, .93);
		backdrop-filter: blur(6px);
		opacity: 0;
		visibility: hidden;
		transition: opacity .3s ease, visibility .3s ease;
	}

	.lightbox.show {
		opacity: 1;
		visibility: visible;
	}

	.lightbox-inner {
		position: relative;
		width: 100%;
		max-width: 940px;
		transform: scale(.95);
		transition: transform .35s var(--ease);
	}

	.lightbox.show .lightbox-inner {
		transform: none;
	}

	.lightbox img {
		width: 100%;
		max-height: 74vh;
		object-fit: contain;
		border-radius: var(--radius);
		box-shadow: 0 30px 70px rgba(0, 0, 0, .5);
	}

	.lightbox-caption {
		margin-top: 14px;
		color: #fff;
		font-family: 'Plus Jakarta Sans', sans-serif;
		font-size: 14px;
		font-weight: 700;
		text-align: center;
	}

	.lightbox-caption span {
		display: block;
		margin-top: 4px;
		color: var(--gold-soft);
		font-family: 'DM Sans', sans-serif;
		font-size: 11.5px;
		font-weight: 500;
	}

	.lightbox button {
		position: absolute;
		display: grid;
		place-items: center;
		width: 44px;
		height: 44px;
		border: 1px solid rgba(255, 255, 255, .25);
		border-radius: 50%;
		background: rgba(255, 255, 255, .1);
		color: #fff;
		cursor: pointer;
		transition: .25s var(--ease);
	}

	.lightbox button:hover {
		background: var(--gold);
		border-color: var(--gold);
	}

	.lightbox .lb-close {
		top: -56px;
		right: 0;
	}

	.lightbox .lb-prev {
		top: 50%;
		left: -56px;
		transform: translateY(-50%);
	}

	.lightbox .lb-next {
		top: 50%;
		right: -56px;
		transform: translateY(-50%);
	}

	/* ==========================================================================
	   SATU MOMEN GERAK: masuknya isi halaman, bertingkat
	   ========================================================================== */
	[data-rise] {
		opacity: 0;
		transform: translateY(18px);
		transition: opacity .6s var(--ease), transform .6s var(--ease);
	}

	[data-rise].in {
		opacity: 1;
		transform: none;
	}

	/* ==========================================================================
	   RESPONSIF
	   ========================================================================== */
	@media (max-width: 991px) {
		.head-title {
			font-size: 30px;
		}

		.page-hero h1,
		.public-hero h1,
		.hero h1 {
			font-size: 38px;
		}

		.page-hero,
		.public-hero,
		.hero {
			padding: 56px 0 58px;
		}

		.hero-grid {
			grid-template-columns: 1fr;
			align-items: start;
		}

		.hero-count {
			justify-self: start;
			padding: 14px 20px;
		}

		.site-nav .nav-link {
			padding: 10px 12px !important;
		}

		.site-nav .nav-link::after {
			display: none;
		}

		.site-nav .navbar-collapse {
			margin-top: 12px;
			padding: 14px;
			border: 1px solid var(--border);
			border-radius: var(--radius);
			background: #fff;
			box-shadow: var(--shadow-lg);
		}

		.nav-tools {
			margin-top: 12px;
			padding-top: 12px;
			border-top: 1px solid var(--border);
		}

		.nav-tools .login-link,
		.nav-tools .nav-cta {
			flex: 1;
			justify-content: center;
		}

		.footer-grid {
			grid-template-columns: 1fr 1fr;
			gap: 30px;
		}

		.lightbox .lb-close {
			top: -48px;
		}

		.lightbox .lb-prev {
			left: 6px;
		}

		.lightbox .lb-next {
			right: 6px;
		}
	}

	@media (max-width: 575px) {
		.head-title {
			font-size: 27px;
		}

		.page-hero h1,
		.public-hero h1,
		.hero h1 {
			font-size: 31px;
		}

		.page-body,
		.public-content {
			padding: 42px 0 62px;
		}

		.footer-grid {
			grid-template-columns: 1fr;
		}
	}

	@media (prefers-reduced-motion: reduce) {

		html {
			scroll-behavior: auto;
		}

		[data-rise] {
			opacity: 1 !important;
			transform: none !important;
		}

		.page-hero::after,
		.public-hero::after,
		.hero::after,
		.public-footer::before {
			animation: none !important;
		}
	}
</style>

<script>
	/* ==========================================================================
	   PERILAKU BERSAMA
	   Dimuat di <head>, semua kerja ditunda sampai DOM siap.
	   ========================================================================== */
	(function () {
		'use strict';

		/* --- Gambar gagal dimuat: coba kandidat path berikutnya ---------------
		   Peristiwa `error` pada <img> tidak menggelembung, jadi ditangkap
		   pada fase capture di document. Inilah yang membuat foto galeri
		   tetap tampil walau nama file disimpan dengan pola folder berbeda. */
		document.addEventListener('error', function (e) {
			var img = e.target;
			if (!img || img.tagName !== 'IMG') return;
			if (img.closest('.lightbox')) return;

			var next = (img.getAttribute('data-fallback') || '').split('|').filter(Boolean);
			if (next.length) {
				img.setAttribute('data-fallback', next.slice(1).join('|'));
				img.src = next[0];
				return;
			}

			if (img.dataset.replaced) return;
			img.dataset.replaced = '1';
			var box = document.createElement('span');
			box.className = 'media-fallback';
			box.innerHTML = '<i class="fa-solid ' + (img.getAttribute('data-icon') || 'fa-image') + '"></i>';
			if (img.parentNode) img.parentNode.replaceChild(box, img);
		}, true);

		document.addEventListener('DOMContentLoaded', function () {

			/* --- Navbar menempel, bilah progres, tombol ke atas --- */
			var nav = document.querySelector('.site-nav');
			var bar = document.querySelector('.scroll-progress');
			var top = document.querySelector('.to-top');

			function onScroll() {
				var y = window.scrollY;
				if (nav) nav.classList.toggle('is-stuck', y > 30);
				if (top) top.classList.toggle('show', y > 400);
				if (bar) {
					var h = document.documentElement.scrollHeight - window.innerHeight;
					bar.style.width = h > 0 ? (y / h) * 100 + '%' : '0';
				}
			}
			window.addEventListener('scroll', onScroll, { passive: true });
			onScroll();

			if (top) {
				top.addEventListener('click', function () {
					window.scrollTo({ top: 0, behavior: 'smooth' });
				});
			}

			/* --- Masuknya isi: satu gelombang bertingkat --- */
			var rise = document.querySelectorAll('[data-rise]');
			if (!('IntersectionObserver' in window)) {
				rise.forEach(function (el) { el.classList.add('in'); });
			} else {
				var io = new IntersectionObserver(function (entries) {
					entries.forEach(function (entry, i) {
						if (!entry.isIntersecting) return;
						var el = entry.target;
						setTimeout(function () { el.classList.add('in'); }, Math.min(i * 55, 330));
						io.unobserve(el);
					});
				}, { threshold: .1, rootMargin: '0px 0px -40px 0px' });
				rise.forEach(function (el) { io.observe(el); });
			}

			/* --- Penyaring kategori (galeri) --- */
			var chips = document.querySelector('[data-filter]');
			if (chips) {
				var scope = document.getElementById(chips.getAttribute('data-filter'));
				chips.addEventListener('click', function (e) {
					var chip = e.target.closest('.chip');
					if (!chip || !scope) return;
					chips.querySelectorAll('.chip').forEach(function (c) {
						c.classList.toggle('is-on', c === chip);
					});
					var want = chip.getAttribute('data-group');
					scope.querySelectorAll('[data-group]').forEach(function (card) {
						var hit = want === '*' || card.getAttribute('data-group') === want;
						card.classList.toggle('is-out', !hit);
						if (hit) {
							card.style.animation = 'none';
							void card.offsetWidth;
							card.style.animation = '';
						}
					});
				});
			}

			/* --- Lightbox --- */
			var lb = document.getElementById('lightbox');
			if (!lb) return;
			var lbImg = lb.querySelector('img');
			var lbCap = lb.querySelector('.lightbox-caption');
			var shots = Array.prototype.slice.call(document.querySelectorAll('[data-zoom]'));
			var at = 0;

			function visible() {
				return shots.filter(function (s) { return !s.classList.contains('is-out'); });
			}

			function show(i) {
				var list = visible();
				if (!list.length) return;
				at = (i + list.length) % list.length;
				var node = list[at];
				lbImg.onerror = function () {
					var fallback = (lbImg.getAttribute('data-fallback') || '')
						.split('|').filter(Boolean);
					var next = fallback.shift();
					if (next) {
						lbImg.setAttribute('data-fallback', fallback.join('|'));
						lbImg.src = next;
					} else {
						lbImg.removeAttribute('src');
					}
				};
				lbImg.setAttribute('data-fallback', '');
				lbImg.src = node.getAttribute('data-zoom');
				lbImg.alt = node.getAttribute('data-title') || '';
				lbCap.innerHTML = (node.getAttribute('data-title') || 'Dokumentasi sekolah') +
					'<span>' + (node.getAttribute('data-group') || '') + '</span>';
			}

			function close() {
				lb.classList.remove('show');
				document.body.style.overflow = '';
			}

			function bukaLightbox(node) {
				show(visible().indexOf(node));
				lb.classList.add('show');
				document.body.style.overflow = 'hidden';
			}

			shots.forEach(function (node) {
				node.addEventListener('click', function (e) {
					e.preventDefault();
					bukaLightbox(node);
				});
				/* foto galeri bisa difokuskan lewat Tab, jadi Enter/Spasi
				   harus membukanya juga. */
				node.addEventListener('keydown', function (e) {
					if (e.key !== 'Enter' && e.key !== ' ') return;
					e.preventDefault();
					bukaLightbox(node);
				});
			});

			lb.querySelector('.lb-close').addEventListener('click', close);
			lb.querySelector('.lb-prev').addEventListener('click', function () { show(at - 1); });
			lb.querySelector('.lb-next').addEventListener('click', function () { show(at + 1); });
			lb.addEventListener('click', function (e) { if (e.target === lb) close(); });

			document.addEventListener('keydown', function (e) {
				if (!lb.classList.contains('show')) return;
				if (e.key === 'Escape') close();
				if (e.key === 'ArrowRight') show(at + 1);
				if (e.key === 'ArrowLeft') show(at - 1);
			});
		});
	})();
</script>
