<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="id">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>
		<?= html_escape($judul); ?> -
		<?= html_escape($profil->nama_sekolah); ?>
	</title>

	<!-- =====================================================
	     GOOGLE FONT
	===================================================== -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link
		href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Fraunces:ital,wght@0,500;0,600;1,500;1,600&family=Plus+Jakarta+Sans:wght@500;600;700;800;900&display=swap"
		rel="stylesheet">

	<!-- =====================================================
	     BOOTSTRAP
	===================================================== -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

	<!-- =====================================================
	     FONT AWESOME
	===================================================== -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

	<style>
		/* =====================================================
		   ROOT
		===================================================== */
		:root {
			--teal: #0b4a4a;
			--teal-deep: #062f2f;
			--teal-light: #12706b;
			--gold: #c8933f;
			--gold-deep: #a97a2c;
			--gold-soft: #f7ebd8;
			--cream: #faf7f1;
			--text: #2a3532;
			--muted: #6d7a76;
			--white: #ffffff;
			--border: #e7e2d6;
			--radius: 18px;
			--radius-lg: 24px;
			--shadow: 0 22px 55px rgba(6, 47, 47, .12);
			--shadow-soft: 0 6px 20px rgba(6, 47, 47, .05);
			--shadow-hover: 0 20px 45px rgba(6, 47, 47, .13);
			--ease: cubic-bezier(.22, .61, .36, 1);
		}

		/* =====================================================
		   GLOBAL
		===================================================== */
		* {
			box-sizing: border-box;
		}

		html {
			scroll-behavior: smooth;
			scroll-padding-top: 90px;
		}

		body {
			margin: 0;
			background: var(--white);
			color: var(--text);
			font-family: 'DM Sans', sans-serif;
			font-size: 15px;
			overflow-x: hidden;
		}

		a {
			text-decoration: none;
		}

		img {
			max-width: 100%;
		}

		::selection {
			background: var(--gold);
			color: #fff;
		}

		/* Scrollbar */
		::-webkit-scrollbar {
			width: 10px;
		}

		::-webkit-scrollbar-track {
			background: var(--cream);
		}

		::-webkit-scrollbar-thumb {
			background: #c9d2ce;
			border-radius: 10px;
			border: 3px solid var(--cream);
		}

		::-webkit-scrollbar-thumb:hover {
			background: var(--teal);
		}

		/* =====================================================
		   SCROLL REVEAL
		===================================================== */
		[data-reveal] {
			opacity: 0;
			transform: translateY(26px);
			transition:
				opacity .75s var(--ease),
				transform .75s var(--ease);
			will-change: opacity, transform;
		}

		[data-reveal].is-visible {
			opacity: 1;
			transform: none;
		}

		[data-reveal][data-reveal="left"] {
			transform: translateX(-30px);
		}

		[data-reveal][data-reveal="right"] {
			transform: translateX(30px);
		}

		[data-reveal][data-reveal="zoom"] {
			transform: scale(.94);
		}

		[data-reveal].is-visible {
			transform: none;
		}

		@media (prefers-reduced-motion: reduce) {

			[data-reveal] {
				opacity: 1 !important;
				transform: none !important;
			}

			.komp-illustration::before {
				animation: none !important;
			}

			html {
				scroll-behavior: auto;
			}
		}

		/* =====================================================
		   TYPOGRAPHY
		===================================================== */
		.eyebrow-italic {
			display: inline-flex;
			align-items: center;
			gap: 9px;
			margin-bottom: 10px;
			color: var(--gold);
			font-family: 'Fraunces', serif;
			font-size: 15px;
			font-style: italic;
			font-weight: 500;
			letter-spacing: .2px;
		}

		.eyebrow-italic::before {
			content: "";
			width: 26px;
			height: 2px;
			border-radius: 2px;
			background: linear-gradient(90deg, transparent, var(--gold));
		}

		.text-center .eyebrow-italic::after {
			content: "";
			width: 26px;
			height: 2px;
			border-radius: 2px;
			background: linear-gradient(90deg, var(--gold), transparent);
		}

		.section-title {
			margin-bottom: 14px;
			color: var(--teal);
			font-family: 'Plus Jakarta Sans', sans-serif;
			font-size: clamp(26px, 3.4vw, 36px);
			font-weight: 800;
			letter-spacing: -.8px;
			line-height: 1.2;
			text-wrap: balance;
		}

		.title-accent {
			position: relative;
			display: inline-block;
			color: var(--gold);
		}

		.title-accent::after {
			content: "";
			position: absolute;
			left: 0;
			right: 0;
			bottom: 2px;
			height: 8px;
			z-index: -1;
			border-radius: 8px;
			background: rgba(200, 147, 63, .18);
		}

		.section-description {
			max-width: 620px;
			color: var(--muted);
			font-size: 14.5px;
			line-height: 1.85;
			text-wrap: pretty;
		}

		/* =====================================================
		   NAVBAR
		===================================================== */
		.main-navbar {
			min-height: 78px;
			background: rgba(255, 255, 255, .92);
			backdrop-filter: blur(14px);
			-webkit-backdrop-filter: blur(14px);
			border-bottom: 1px solid var(--border);
			transition: box-shadow .3s ease, min-height .3s ease, background .3s ease;
		}

		.main-navbar.scrolled {
			min-height: 68px;
			background: rgba(255, 255, 255, .97);
			box-shadow: 0 10px 30px rgba(6, 47, 47, .08);
		}

		.main-navbar.scrolled .nav-link {
			padding-top: 24px !important;
			padding-bottom: 24px !important;
		}

		@media (min-width: 992px) {
			.main-navbar .container {
				display: grid;
				grid-template-columns: auto 1fr auto;
				align-items: center;
				column-gap: 24px;
			}

			.nav-center {
				margin-left: auto;
				margin-right: auto;
			}
		}

		.brand {
			display: flex;
			align-items: center;
			gap: 12px;
			color: var(--teal);
		}

		.brand-logo {
			position: relative;
			width: 46px;
			height: 46px;
			display: flex;
			align-items: center;
			justify-content: center;
			border-radius: 12px;
			background: linear-gradient(150deg, var(--teal), var(--teal-deep));
			color: white;
			font-size: 19px;
			box-shadow: 0 8px 18px rgba(6, 47, 47, .22);
			transition: transform .35s var(--ease);
		}

		.brand-logo::after {
			content: "";
			position: absolute;
			inset: -3px;
			border-radius: 15px;
			border: 1px solid rgba(200, 147, 63, .35);
			opacity: 0;
			transition: opacity .3s ease;
		}

		.brand:hover .brand-logo {
			transform: rotate(-6deg) scale(1.05);
		}

		.brand:hover .brand-logo::after {
			opacity: 1;
		}

		.brand-name {
			display: block;
			font-family: 'Plus Jakarta Sans', sans-serif;
			font-size: 13px;
			font-weight: 800;
			line-height: 1.25;
		}

		.brand-subtitle {
			color: #97a29c;
			font-size: 9px;
			font-weight: 700;
			letter-spacing: 1px;
			text-transform: uppercase;
		}

		.nav-link {
			position: relative;
			padding: 29px 13px !important;
			color: #3d4a46 !important;
			font-size: 12.5px;
			font-weight: 600;
			transition: color .25s ease, padding .3s ease;
		}

		.nav-link::after {
			content: "";
			position: absolute;
			left: 13px;
			right: 13px;
			bottom: 22px;
			height: 2px;
			border-radius: 2px;
			background: var(--gold);
			transform: scaleX(0);
			transform-origin: left;
			transition: transform .3s var(--ease);
		}

		.nav-link:hover::after,
		.nav-link.active::after {
			transform: scaleX(1);
		}

		.nav-link:hover,
		.nav-link.active {
			color: var(--teal) !important;
		}

		.dropdown-toggle::after {
			transition: transform .25s ease;
		}

		.nav-item.show .dropdown-toggle::after {
			transform: rotate(180deg);
		}

		.search-bar {
			display: flex;
			align-items: center;
			gap: 6px;
			padding: 4px 4px 4px 15px;
			background: var(--cream);
			border: 1px solid var(--border);
			border-radius: 30px;
			transition: border-color .25s ease, box-shadow .25s ease;
		}

		.search-bar:focus-within {
			border-color: #d9c49b;
			box-shadow: 0 0 0 4px rgba(200, 147, 63, .1);
		}

		.search-bar input {
			width: 130px;
			border: 0;
			outline: none;
			background: transparent;
			color: var(--text);
			font-size: 12.5px;
		}

		.search-bar input::placeholder {
			color: var(--muted);
		}

		.search-bar button {
			width: 30px;
			height: 30px;
			flex: 0 0 30px;
			display: flex;
			align-items: center;
			justify-content: center;
			border: 0;
			border-radius: 50%;
			background: var(--teal);
			color: white;
			font-size: 11px;
			transition: .25s var(--ease);
		}

		.search-bar button:hover {
			background: var(--gold);
			transform: rotate(-12deg);
		}

		.nav-actions {
			display: flex;
			align-items: center;
			gap: 14px;
		}

		.nav-cta {
			position: relative;
			overflow: hidden;
			padding: 10px 20px !important;
			border-radius: 9px;
			background: linear-gradient(120deg, var(--gold), #dba659);
			color: white !important;
			font-size: 12.5px;
			font-weight: 700;
			box-shadow: 0 8px 18px rgba(200, 147, 63, .28);
			transition: transform .25s var(--ease), box-shadow .25s ease;
		}

		.nav-cta::before {
			content: "";
			position: absolute;
			top: 0;
			left: -120%;
			width: 60%;
			height: 100%;
			background: linear-gradient(100deg, transparent, rgba(255, 255, 255, .45), transparent);
			transform: skewX(-20deg);
			transition: left .6s var(--ease);
		}

		.nav-cta:hover::before {
			left: 130%;
		}

		.nav-cta:hover {
			transform: translateY(-2px);
			box-shadow: 0 14px 26px rgba(200, 147, 63, .35);
		}

		.nav-login {
			display: inline-flex;
			align-items: center;
			justify-content: center;
			padding: 9px 16px;
			border: 1px solid var(--border);
			border-radius: 9px;
			background: #fff;
			color: var(--teal) !important;
			font-size: 12.5px;
			font-weight: 700;
			transition: .25s var(--ease);
		}

		.nav-login:hover {
			border-color: rgba(11, 74, 74, .25);
			background: var(--cream);
			color: var(--teal-deep) !important;
			transform: translateY(-2px);
			box-shadow: 0 8px 18px rgba(6, 47, 47, .08);
		}

		.nav-mobile-actions {
			padding-top: 14px;
			margin-top: 10px;
			border-top: 1px solid var(--border);
		}

		.nav-mobile-actions .search-bar {
			width: 100%;
			margin-bottom: 12px;
		}

		.nav-mobile-actions .search-bar input {
			width: 100%;
			flex: 1;
		}

		.nav-mobile-actions .nav-cta {
			display: block;
			text-align: center;
		}

		.dropdown-menu {
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

			to {
				opacity: 1;
				transform: none;
			}
		}

		.dropdown-item {
			padding: 9px 11px;
			border-radius: 9px;
			color: #3d4a46;
			font-size: 12px;
			font-weight: 600;
			transition: .2s ease;
		}

		.dropdown-item:hover,
		.dropdown-item:focus {
			background: var(--cream);
			color: var(--teal);
			transform: translateX(3px);
		}

		/* =====================================================
		   HERO
		===================================================== */
		.hero-slider {
			position: relative;
			height: 620px;
			overflow: hidden;
			background: var(--teal-deep);
		}

		.hero-slide {
			position: absolute;
			inset: 0;
			opacity: 0;
			background-position: center;
			background-size: cover;
			transform: scale(1.06);
			transition:
				opacity 1.1s ease,
				transform 6s linear;
		}

		.hero-slide.active {
			opacity: 1;
			transform: scale(1);
		}

		.hero-slide::after {
			content: "";
			position: absolute;
			inset: 0;
			background:
				linear-gradient(0deg,
					rgba(6, 47, 47, .92) 4%,
					rgba(6, 47, 47, .45) 45%,
					rgba(6, 47, 47, .45) 100%),
				radial-gradient(1100px 520px at 15% 85%,
					rgba(200, 147, 63, .22),
					transparent 65%);
		}

		.hero-caption {
			position: absolute;
			left: 0;
			bottom: 0;
			z-index: 3;
			max-width: 700px;
			padding: 55px 15px 66px;
			color: white;
		}

		.hero-caption .eyebrow-italic {
			color: var(--gold-soft);
		}

		.hero-caption .eyebrow-italic::before {
			background: linear-gradient(90deg, transparent, var(--gold-soft));
		}

		.hero-caption h1 {
			max-width: 720px;
			margin: 0 0 16px;
			font-family: 'Plus Jakarta Sans', sans-serif;
			font-size: clamp(28px, 4.2vw, 48px);
			font-weight: 800;
			line-height: 1.14;
			letter-spacing: -1.1px;
			text-wrap: balance;
			text-shadow: 0 10px 40px rgba(0, 0, 0, .3);
		}

		.hero-caption p {
			max-width: 545px;
			margin-bottom: 24px;
			color: rgba(255, 255, 255, .85);
			font-size: 14px;
			line-height: 1.85;
		}

		.hero-anim {
			animation: heroUp .8s var(--ease) both;
		}

		.hero-anim.d1 {
			animation-delay: .05s;
		}

		.hero-anim.d2 {
			animation-delay: .15s;
		}

		.hero-anim.d3 {
			animation-delay: .25s;
		}

		.hero-anim.d4 {
			animation-delay: .35s;
		}

		@keyframes heroUp {
			from {
				opacity: 0;
				transform: translateY(22px);
			}

			to {
				opacity: 1;
				transform: none;
			}
		}

		.hero-scroll-hint {
			position: absolute;
			right: 26px;
			bottom: 96px;
			z-index: 4;
			display: flex;
			align-items: center;
			gap: 9px;
			color: rgba(255, 255, 255, .6);
			font-size: 10px;
			font-weight: 700;
			letter-spacing: 2px;
			text-transform: uppercase;
			writing-mode: vertical-rl;
		}

		.hero-scroll-hint::after {
			content: "";
			width: 1px;
			height: 46px;
			background: linear-gradient(var(--gold), transparent);
			animation: scrollPulse 1.9s ease-in-out infinite;
		}

		@keyframes scrollPulse {

			0%,
			100% {
				opacity: .3;
				transform: scaleY(.6);
			}

			50% {
				opacity: 1;
				transform: scaleY(1);
			}
		}

		.btn-gold {
			position: relative;
			display: inline-flex;
			align-items: center;
			overflow: hidden;
			padding: 13px 24px;
			border: 0;
			border-radius: 9px;
			background: linear-gradient(120deg, var(--gold), #dba659);
			color: white;
			font-size: 12.5px;
			font-weight: 700;
			letter-spacing: .3px;
			box-shadow: 0 12px 26px rgba(200, 147, 63, .32);
			transition: transform .25s var(--ease), box-shadow .25s ease;
		}

		.btn-gold::before {
			content: "";
			position: absolute;
			top: 0;
			left: -120%;
			width: 60%;
			height: 100%;
			background: linear-gradient(100deg, transparent, rgba(255, 255, 255, .45), transparent);
			transform: skewX(-20deg);
			transition: left .6s var(--ease);
		}

		.btn-gold:hover::before {
			left: 130%;
		}

		.btn-gold:hover {
			color: white;
			transform: translateY(-3px);
			box-shadow: 0 18px 34px rgba(200, 147, 63, .4);
		}

		.btn-gold i {
			transition: transform .25s var(--ease);
		}

		.btn-gold:hover i {
			transform: translateX(4px);
		}

		.slider-dots {
			position: absolute;
			right: 25px;
			bottom: 34px;
			z-index: 4;
			display: flex;
			gap: 8px;
		}

		.slider-dot {
			width: 9px;
			height: 9px;
			padding: 0;
			border: 0;
			border-radius: 50%;
			background: rgba(255, 255, 255, .4);
			cursor: pointer;
			transition: .35s var(--ease);
		}

		.slider-dot:hover {
			background: rgba(255, 255, 255, .75);
		}

		.slider-dot.active {
			width: 26px;
			border-radius: 5px;
			background: var(--gold);
			box-shadow: 0 0 14px rgba(200, 147, 63, .7);
		}

		.slider-arrow {
			position: absolute;
			top: 50%;
			z-index: 4;
			width: 44px;
			height: 44px;
			display: flex;
			align-items: center;
			justify-content: center;
			transform: translateY(-50%);
			border: 1px solid rgba(255, 255, 255, .35);
			border-radius: 50%;
			background: rgba(255, 255, 255, .1);
			backdrop-filter: blur(6px);
			color: white;
			transition: .3s var(--ease);
		}

		.slider-arrow:hover {
			background: var(--gold);
			border-color: var(--gold);
			transform: translateY(-50%) scale(1.1);
		}

		.slider-prev {
			left: 20px;
		}

		.slider-next {
			right: 20px;
		}

		/* =====================================================
		   STATS
		===================================================== */
		.stats {
			position: relative;
			background: var(--cream);
			border-bottom: 1px solid var(--border);
		}

		.stats::before {
			content: "";
			position: absolute;
			inset: 0;
			background-image:
				radial-gradient(rgba(11, 74, 74, .06) 1px, transparent 1px);
			background-size: 22px 22px;
			opacity: .6;
			pointer-events: none;
		}

		.stats-container {
			position: relative;
			padding: 38px 0;
		}

		.stat {
			position: relative;
			text-align: center;
			border-right: 1px solid var(--border);
			transition: transform .3s var(--ease);
		}

		.stat:hover {
			transform: translateY(-4px);
		}

		.stat:last-child {
			border-right: 0;
		}

		.stat-icon {
			width: 38px;
			height: 38px;
			display: flex;
			align-items: center;
			justify-content: center;
			margin: 0 auto 10px;
			border-radius: 11px;
			background: rgba(200, 147, 63, .14);
			color: var(--gold);
			font-size: 14px;
			transition: .3s var(--ease);
		}

		.stat:hover .stat-icon {
			background: var(--teal);
			color: var(--gold);
			transform: rotate(-8deg);
		}

		.stat-number {
			color: var(--teal);
			font-family: 'Plus Jakarta Sans', sans-serif;
			font-size: 38px;
			font-weight: 800;
			line-height: 1;
			letter-spacing: -1px;
		}

		.stat-label {
			margin-top: 8px;
			color: var(--muted);
			font-size: 11.5px;
			font-weight: 600;
			letter-spacing: .3px;
		}

		/* =====================================================
		   SECTION
		===================================================== */
		.section {
			position: relative;
			padding: 92px 0;
		}

		.section-soft {
			background: var(--cream);
		}

		.section-pattern::before {
			content: "";
			position: absolute;
			inset: 0;
			background-image:
				radial-gradient(rgba(11, 74, 74, .05) 1px, transparent 1px);
			background-size: 24px 24px;
			pointer-events: none;
		}

		.section-pattern>.container {
			position: relative;
			z-index: 1;
		}

		/* =====================================================
		   WELCOME
		===================================================== */
		.welcome-lede {
			position: relative;
			max-width: 840px;
			margin: 0 auto 50px;
			padding: 0 18px;
			color: var(--teal);
			font-family: 'Fraunces', serif;
			font-size: 20px;
			line-height: 1.75;
			text-align: center;
		}

		.welcome-lede::before,
		.welcome-lede::after {
			position: absolute;
			color: rgba(200, 147, 63, .35);
			font-family: 'Fraunces', serif;
			font-size: 54px;
			line-height: 1;
		}

		.welcome-lede::before {
			content: "\201C";
			top: -14px;
			left: -6px;
		}

		.welcome-lede::after {
			content: "\201D";
			right: -6px;
			bottom: -34px;
		}

		/* =====================================================
		   VISI & MISI
		   Dua panel bermotif: VISI gelap, MISI terang.
		===================================================== */
		.vm-card {
			position: relative;
			isolation: isolate;
			overflow: hidden;
			padding: 34px;
			border-radius: 26px;
			transition: transform .4s var(--ease), box-shadow .4s ease;
		}

		.vm-card:hover {
			transform: translateY(-6px);
		}

		/* ---------- motif titik / garis ---------- */
		.vm-card::before {
			content: "";
			position: absolute;
			inset: 0;
			z-index: -2;
			pointer-events: none;
		}

		/* ---------- cahaya sudut ---------- */
		.vm-card::after {
			content: "";
			position: absolute;
			z-index: -2;
			width: 340px;
			height: 340px;
			right: -120px;
			top: -160px;
			border-radius: 50%;
			pointer-events: none;
		}

		/* ---------- ikon raksasa transparan ---------- */
		.vm-watermark {
			position: absolute;
			right: -18px;
			bottom: -26px;
			z-index: -1;
			font-size: 168px;
			line-height: 1;
			pointer-events: none;
			user-select: none;
		}

		/* ---------- VISI : teal gelap ---------- */
		.vm-card.visi {
			background: linear-gradient(150deg, #0d5350 0%, #0a3f3f 52%, #052a2a 100%);
			border: 1px solid rgba(255, 255, 255, .09);
			color: #fff;
			box-shadow: 0 20px 50px rgba(6, 47, 47, .24);
		}

		.vm-card.visi:hover {
			box-shadow: 0 30px 66px rgba(6, 47, 47, .32);
		}

		.vm-card.visi::before {
			background-image:
				radial-gradient(rgba(255, 255, 255, .1) 1px, transparent 1px);
			background-size: 18px 18px;
			opacity: .55;
		}

		.vm-card.visi::after {
			background: radial-gradient(circle, rgba(200, 147, 63, .3), transparent 68%);
		}

		.vm-card.visi .vm-watermark {
			color: rgba(255, 255, 255, .05);
		}

		/* ---------- MISI : krem terang ---------- */
		.vm-card.misi {
			background: linear-gradient(155deg, #fdfbf6 0%, #f6f1e6 100%);
			border: 1px solid var(--border);
			color: var(--teal);
			box-shadow: 0 18px 45px rgba(6, 47, 47, .08);
		}

		.vm-card.misi:hover {
			box-shadow: 0 26px 58px rgba(6, 47, 47, .13);
		}

		.vm-card.misi::before {
			background-image:
				repeating-linear-gradient(135deg,
					rgba(11, 74, 74, .045) 0 1px,
					transparent 1px 11px);
		}

		.vm-card.misi::after {
			background: radial-gradient(circle, rgba(200, 147, 63, .16), transparent 68%);
		}

		.vm-card.misi .vm-watermark {
			color: rgba(11, 74, 74, .045);
		}

		/* ---------- garis aksen atas ---------- */
		.vm-accent {
			position: absolute;
			top: 0;
			left: 0;
			right: 0;
			z-index: 3;
			height: 4px;
		}

		.vm-card.visi .vm-accent {
			background: linear-gradient(90deg, var(--gold) 0%, rgba(200, 147, 63, .15) 60%, transparent 100%);
		}

		.vm-card.misi .vm-accent {
			background: linear-gradient(90deg, var(--teal) 0%, rgba(11, 74, 74, .15) 60%, transparent 100%);
		}

		/* ---------- header ---------- */
		.vision-card-top {
			position: relative;
			z-index: 2;
			display: flex;
			align-items: center;
			justify-content: space-between;
			margin-bottom: 24px;
		}

		.vm-label {
			display: inline-flex;
			align-items: center;
			gap: 9px;
			padding: 7px 15px;
			border-radius: 30px;
			font-family: 'Plus Jakarta Sans', sans-serif;
			font-size: 10px;
			font-style: normal;
			font-weight: 800;
			letter-spacing: 1.5px;
			text-transform: uppercase;
		}

		.vm-label::before {
			content: "";
			width: 6px;
			height: 6px;
			border-radius: 50%;
			background: currentColor;
		}

		.vm-card.visi .vm-label {
			background: rgba(200, 147, 63, .16);
			border: 1px solid rgba(200, 147, 63, .38);
			color: #e9c98c;
		}

		.vm-card.misi .vm-label {
			background: rgba(11, 74, 74, .06);
			border: 1px solid rgba(11, 74, 74, .14);
			color: var(--teal);
		}

		.vision-card-number {
			font-family: 'Plus Jakarta Sans', sans-serif;
			font-size: 30px;
			font-weight: 800;
			letter-spacing: -1px;
			line-height: 1;
		}

		.vm-card.visi .vision-card-number {
			color: rgba(255, 255, 255, .13);
		}

		.vm-card.misi .vision-card-number {
			color: rgba(11, 74, 74, .12);
		}

		/* ---------- ikon utama ---------- */
		.vision-main {
			position: relative;
			z-index: 2;
			display: flex;
			align-items: flex-start;
			gap: 18px;
		}

		.vision-icon {
			width: 56px;
			height: 56px;
			flex: 0 0 56px;
			display: flex;
			align-items: center;
			justify-content: center;
			border-radius: 18px;
			font-size: 21px;
			transition: transform .4s var(--ease);
		}

		.vm-card.visi .vision-icon {
			background: rgba(255, 255, 255, .09);
			border: 1px solid rgba(255, 255, 255, .16);
			color: var(--gold);
		}

		.vm-card.misi .vision-icon {
			background: linear-gradient(150deg, var(--teal), var(--teal-deep));
			color: var(--gold);
			box-shadow: 0 12px 26px rgba(6, 47, 47, .2);
		}

		.vm-card:hover .vision-icon {
			transform: rotate(-8deg) scale(1.06);
		}

		/* ---------- kotak putih pernyataan ---------- */
		.vm-statement {
			position: relative;
			flex: 1;
			min-width: 0;
			padding: 24px 26px;
			border-radius: 20px;
			background: #fff;
			border: 1px solid var(--border);
			box-shadow: 0 12px 30px rgba(6, 47, 47, .1);
		}

		.vm-statement::before {
			content: "";
			position: absolute;
			left: 0;
			top: 22px;
			bottom: 22px;
			width: 3px;
			border-radius: 0 4px 4px 0;
			background: linear-gradient(var(--gold), rgba(200, 147, 63, .25));
		}

		/* tanda kutip halus */
		.vm-statement::after {
			content: "\201D";
			position: absolute;
			right: 18px;
			top: 4px;
			color: rgba(200, 147, 63, .22);
			font-family: 'Fraunces', serif;
			font-size: 52px;
			line-height: 1;
		}

		.vision-main h3 {
			margin: 0 0 11px;
			padding-right: 34px;
			color: var(--teal);
			font-family: 'Fraunces', serif;
			font-size: clamp(21px, 2.1vw, 26px);
			font-weight: 600;
			line-height: 1.3;
			letter-spacing: -.4px;
			text-wrap: balance;
		}

		.vision-description {
			margin: 0;
			color: var(--muted);
			font-size: 12.8px;
			line-height: 1.85;
		}

		/* ---------- label daftar ---------- */
		.vm-list-label {
			position: relative;
			z-index: 2;
			display: flex;
			align-items: center;
			gap: 10px;
			margin: 26px 0 13px;
			font-family: 'Plus Jakarta Sans', sans-serif;
			font-size: 10px;
			font-weight: 800;
			letter-spacing: 1.4px;
			text-transform: uppercase;
		}

		.vm-list-label::after {
			content: "";
			flex: 1;
			height: 1px;
		}

		.vm-card.visi .vm-list-label {
			color: rgba(255, 255, 255, .5);
		}

		.vm-card.visi .vm-list-label::after {
			background: linear-gradient(90deg, rgba(255, 255, 255, .16), transparent);
		}

		.vm-card.misi .vm-list-label {
			color: var(--muted);
		}

		.vm-card.misi .vm-list-label::after {
			background: linear-gradient(90deg, var(--border), transparent);
		}

		/* ---------- kotak putih daftar ---------- */
		.vision-focus,
		.vm-card.misi .mission-list {
			position: relative;
			z-index: 2;
			display: flex;
			flex-direction: column;
			gap: 11px;
		}

		.vision-focus-item,
		.vm-card.misi .mission-item {
			position: relative;
			display: flex;
			align-items: flex-start;
			gap: 13px;
			padding: 15px 17px;
			border-radius: 16px;
			background: #fff;
			border: 1px solid var(--border);
			box-shadow: 0 6px 18px rgba(6, 47, 47, .06);
			transition: .32s var(--ease);
		}

		.vision-focus-item::before,
		.vm-card.misi .mission-item::before {
			content: "";
			position: absolute;
			left: 0;
			top: 14px;
			bottom: 14px;
			width: 3px;
			border-radius: 0 4px 4px 0;
			background: var(--gold);
			opacity: 0;
			transition: opacity .3s ease;
		}

		.vision-focus-item:hover::before,
		.vm-card.misi .mission-item:hover::before {
			opacity: 1;
		}

		.vision-focus-item:hover,
		.vm-card.misi .mission-item:hover {
			transform: translateX(6px);
			border-color: #dbc69f;
			box-shadow: 0 14px 32px rgba(6, 47, 47, .14);
		}

		.vision-focus-icon,
		.vm-card.misi .mission-icon {
			width: 34px;
			height: 34px;
			flex: 0 0 34px;
			display: flex;
			align-items: center;
			justify-content: center;
			border-radius: 11px;
			background: var(--gold-soft);
			color: var(--gold);
			font-size: 12px;
			transition: .3s var(--ease);
		}

		.vision-focus-item:hover .vision-focus-icon,
		.vm-card.misi .mission-item:hover .mission-icon {
			background: linear-gradient(150deg, var(--teal), var(--teal-deep));
			color: var(--gold);
		}

		.vision-focus-content,
		.vm-card.misi .mission-content {
			flex: 1;
			min-width: 0;
		}

		.vision-focus-content strong,
		.vm-card.misi .mission-content strong {
			display: block;
			margin-bottom: 4px;
			color: var(--teal);
			font-family: 'Plus Jakarta Sans', sans-serif;
			font-size: 11.5px;
			font-weight: 800;
			letter-spacing: .2px;
			line-height: 1.55;
		}

		.vision-focus-content span,
		.vm-card.misi .mission-content p {
			display: block;
			margin: 0;
			color: var(--muted);
			font-size: 11px;
			line-height: 1.75;
		}

		/* ---------- butir misi bernomor ---------- */
		.vm-card.misi .mission-content ul {
			counter-reset: misi;
			margin: 10px 0 0;
			padding: 0;
		}

		.vm-card.misi .mission-content li {
			position: relative;
			margin: 0;
			padding: 10px 0 10px 32px;
			border-top: 1px dashed var(--border);
			list-style: none;
			color: var(--muted);
			font-size: 11px;
			line-height: 1.75;
		}

		.vm-card.misi .mission-content li:first-child {
			padding-top: 4px;
			border-top: 0;
		}

		.vm-card.misi .mission-content li:last-child {
			padding-bottom: 2px;
		}

		.vm-card.misi .mission-content li::before {
			counter-increment: misi;
			content: counter(misi, decimal-leading-zero);
			position: absolute;
			left: 0;
			top: 9px;
			width: 21px;
			height: 21px;
			display: flex;
			align-items: center;
			justify-content: center;
			border-radius: 7px;
			background: var(--gold-soft);
			color: var(--gold-deep);
			font-family: 'Plus Jakarta Sans', sans-serif;
			font-size: 9px;
			font-weight: 800;
		}

		.vm-card.misi .mission-content li:first-child::before {
			top: 3px;
		}

		.vm-card.misi .mission-content li strong {
			display: inline;
			margin: 0;
			color: var(--teal);
			font-size: 11px;
		}

		/* =====================================================
		   DOUBLE TRACK
		===================================================== */
		.double-track {
			position: relative;
			overflow: hidden;
			margin-top: 48px;
			padding: 38px;
			border-radius: var(--radius-lg);
			background:
				linear-gradient(135deg, var(--teal) 0%, #0a3f3f 55%, var(--teal-deep) 100%);
			color: white;
			box-shadow: var(--shadow);
		}

		.double-track::before {
			content: "";
			position: absolute;
			width: 320px;
			height: 320px;
			right: -120px;
			top: -160px;
			border: 1px solid rgba(255, 255, 255, .08);
			border-radius: 50%;
		}

		.double-track::after {
			content: "";
			position: absolute;
			width: 220px;
			height: 220px;
			right: -60px;
			top: -110px;
			border: 1px solid rgba(200, 147, 63, .18);
			border-radius: 50%;
		}

		.double-track-header {
			position: relative;
			z-index: 2;
			display: flex;
			align-items: center;
			gap: 16px;
			margin-bottom: 26px;
		}

		.double-track-icon {
			width: 52px;
			height: 52px;
			display: flex;
			align-items: center;
			justify-content: center;
			flex: 0 0 52px;
			border-radius: 16px;
			background: rgba(255, 255, 255, .1);
			border: 1px solid rgba(255, 255, 255, .12);
			color: var(--gold);
			font-size: 20px;
		}

		.double-track-title {
			margin: 0;
			color: white;
			font-family: 'Plus Jakarta Sans', sans-serif;
			font-size: 20px;
			font-weight: 800;
		}

		.double-track-subtitle {
			margin: 4px 0 0;
			color: rgba(255, 255, 255, .62);
			font-size: 11.5px;
		}

		.double-track-grid {
			position: relative;
			z-index: 2;
			display: grid;
			grid-template-columns: repeat(2, 1fr);
			gap: 18px;
		}

		.double-track-item {
			padding: 24px;
			border: 1px solid rgba(255, 255, 255, .1);
			border-radius: 16px;
			background: rgba(255, 255, 255, .06);
			transition: .3s var(--ease);
		}

		.double-track-item:hover {
			transform: translateY(-5px);
			background: rgba(255, 255, 255, .1);
			border-color: rgba(200, 147, 63, .35);
		}

		.double-track-item i {
			display: block;
			margin-bottom: 13px;
			color: var(--gold);
			font-size: 21px;
			transition: transform .3s var(--ease);
		}

		.double-track-item:hover i {
			transform: scale(1.14) rotate(-6deg);
		}

		.double-track-item h4 {
			margin: 0 0 8px;
			color: white;
			font-size: 13.5px;
			font-weight: 800;
		}

		.double-track-item p {
			margin: 0;
			color: rgba(255, 255, 255, .68);
			font-size: 11.5px;
			line-height: 1.75;
		}

		/* =====================================================
		   EKSTRAKURIKULER — "TEMUKAN POTENSIMU"
		   Gaya khas: KARTU MEDALI LENGKUNG (arch card).
		   Ikon berada di dalam medali bulat dengan cincin
		   konis yang berputar pelan. Saat hover, warna teal
		   naik dari bawah seperti tinta yang mengisi kartu.
		   Sengaja dibuat berbeda total dari "Jelajahi Sekolah"
		   yang memakai kartu baris horizontal.
		===================================================== */
		.komp-grid {
			display: grid;
			grid-template-columns: repeat(auto-fill, minmax(206px, 1fr));
			justify-content: center;
			gap: 22px;
			margin-top: 46px;
		}

		.komp-card {
			--c: #c8933f;
			--c2: #e6bd7c;
			position: relative;
			z-index: 0;
			display: flex;
			width: auto;
			flex-direction: column;
			align-items: center;
			isolation: isolate;
			overflow: hidden;
			padding: 34px 20px 26px;
			border: 1px solid var(--border);
			/* lengkung khas: atas membulat seperti pintu gerbang */
			border-radius: 120px 120px 22px 22px;
			background:
				linear-gradient(180deg, #ffffff 0%, #fdfbf7 100%);
			color: inherit;
			text-align: center;
			box-shadow: var(--shadow-soft);
			transition:
				transform .45s var(--ease),
				box-shadow .45s ease,
				border-color .35s ease;
		}

		/* tinta warna yang naik dari bawah saat hover */
		.komp-card::before {
			content: "";
			position: absolute;
			inset: 0;
			z-index: -1;
			/* fallback warna solid untuk peramban lama */
			background: var(--c);
			background:
				linear-gradient(170deg,
					color-mix(in srgb, var(--c) 92%, #062f2f) 0%,
					var(--c) 55%,
					color-mix(in srgb, var(--c) 78%, #000) 100%);
			transform: translateY(101%);
			transition: transform .55s var(--ease);
		}

		.komp-card:hover::before {
			transform: translateY(0);
		}

		/* kilau menyapu saat hover */
		.komp-card::after {
			content: "";
			position: absolute;
			top: 0;
			left: -60%;
			z-index: -1;
			width: 45%;
			height: 100%;
			background:
				linear-gradient(100deg,
					transparent,
					rgba(255, 255, 255, .35),
					transparent);
			transform: skewX(-18deg);
			transition: left .8s var(--ease);
		}

		.komp-card:hover::after {
			left: 125%;
		}

		.komp-card:hover {
			transform: translateY(-10px);
			border-color: transparent;
			box-shadow: 0 26px 50px rgba(6, 47, 47, .22);
		}

		/* ---------- MEDALI IKON ---------- */
		.komp-illustration {
			position: relative;
			z-index: 2;
			width: 94px;
			height: 94px;
			display: flex;
			align-items: center;
			justify-content: center;
			margin-bottom: 18px;
		}

		/* cincin konis berputar — ciri khas bagian ini */
		.komp-illustration::before {
			content: "";
			position: absolute;
			inset: 0;
			border-radius: 50%;
			padding: 2px;
			background:
				conic-gradient(from 0deg,
					transparent 0deg,
					var(--c) 70deg,
					var(--c2) 140deg,
					transparent 220deg,
					var(--c) 330deg,
					transparent 360deg);
			-webkit-mask:
				linear-gradient(#000 0 0) content-box,
				linear-gradient(#000 0 0);
			-webkit-mask-composite: xor;
			mask:
				linear-gradient(#000 0 0) content-box,
				linear-gradient(#000 0 0);
			mask-composite: exclude;
			animation: kompSpin 14s linear infinite;
			opacity: .85;
			transition: opacity .35s ease;
		}

		@keyframes kompSpin {
			from {
				transform: rotate(0deg);
			}

			to {
				transform: rotate(360deg);
			}
		}

		/* denyut halus di belakang medali */
		.komp-illustration::after {
			content: "";
			position: absolute;
			inset: -8px;
			border-radius: 50%;
			border: 1px solid var(--c);
			opacity: 0;
			transform: scale(.82);
			transition: .5s var(--ease);
		}

		.komp-card:hover .komp-illustration::after {
			opacity: .55;
			transform: scale(1);
			border-color: rgba(255, 255, 255, .55);
		}

		/* piringan medali (dulu wajik, kini cakram) */
		.komp-shape {
			position: absolute;
			inset: 9px;
			border-radius: 50%;
			background: var(--gold-soft);
			background:
				radial-gradient(circle at 32% 28%,
					#ffffff 0%,
					color-mix(in srgb, var(--c) 16%, #ffffff) 58%,
					color-mix(in srgb, var(--c) 28%, #ffffff) 100%);
			box-shadow:
				inset 0 -6px 14px rgba(0, 0, 0, .06),
				0 10px 22px rgba(6, 47, 47, .12);
			transition: .55s var(--ease);
		}

		.komp-illustration i {
			position: relative;
			z-index: 3;
			color: var(--c);
			font-size: 26px;
			transition: .45s var(--ease);
		}

		.komp-photo {
			position: relative;
			z-index: 3;
			width: 76px;
			height: 76px;
			border-radius: 50%;
			object-fit: cover;
			box-shadow: 0 5px 14px rgba(6, 47, 47, .2);
			transition: .45s var(--ease);
		}

		/* variasi warna per urutan kartu supaya tidak monoton */
		.komp-card:nth-child(6n+2) {
			--c: #12706b;
			--c2: #34a49d;
		}

		.komp-card:nth-child(6n+3) {
			--c: #3c5ea8;
			--c2: #7b9ae0;
		}

		.komp-card:nth-child(6n+4) {
			--c: #1c7a42;
			--c2: #49b377;
		}

		.komp-card:nth-child(6n+5) {
			--c: #6b52b5;
			--c2: #9b86e2;
		}

		.komp-card:nth-child(6n+6) {
			--c: #b5455f;
			--c2: #e0899b;
		}

		/* hover: medali jadi putih bercahaya, cincin memutar cepat */
		.komp-card:hover .komp-shape {
			inset: 6px;
			background:
				radial-gradient(circle at 34% 26%,
					#ffffff 0%,
					#fdf6ea 62%,
					#f3e4cb 100%);
			box-shadow:
				inset 0 -6px 14px rgba(0, 0, 0, .08),
				0 14px 30px rgba(0, 0, 0, .22);
		}

		.komp-card:hover .komp-illustration::before {
			animation-duration: 3s;
			opacity: 1;
			background:
				conic-gradient(from 0deg,
					transparent 0deg,
					#ffffff 80deg,
					var(--gold-soft) 150deg,
					transparent 230deg,
					#ffffff 330deg,
					transparent 360deg);
		}

		.komp-card:hover .komp-illustration i {
			color: var(--c);
			transform: scale(1.14) rotate(-8deg);
		}

		.komp-card:hover .komp-photo {
			transform: scale(1.08);
			box-shadow: 0 8px 20px rgba(0, 0, 0, .24);
		}

		.komp-name {
			position: relative;
			z-index: 2;
			margin-bottom: 8px;
			color: var(--teal);
			font-family: 'Plus Jakarta Sans', sans-serif;
			font-size: 14px;
			font-weight: 800;
			line-height: 1.35;
			letter-spacing: -.2px;
			transition: color .3s ease;
		}

		/* garis kecil di bawah nama, melebar saat hover */
		.komp-name::after {
			content: "";
			display: block;
			width: 18px;
			height: 2px;
			margin: 8px auto 0;
			border-radius: 2px;
			background: var(--c);
			transition: .45s var(--ease);
		}

		.komp-card:hover .komp-name {
			color: #fff;
		}

		.komp-card:hover .komp-name::after {
			width: 42px;
			background: var(--gold-soft);
		}

		.komp-desc {
			position: relative;
			z-index: 2;
			display: -webkit-box;
			-webkit-line-clamp: 2;
			-webkit-box-orient: vertical;
			overflow: hidden;
			margin: 0;
			color: var(--muted);
			font-size: 11.5px;
			line-height: 1.7;
			transition: color .3s ease;
		}

		.komp-card:hover .komp-desc {
			color: rgba(255, 255, 255, .82);
		}

		/* =====================================================
		   JELAJAHI SEKOLAH — KARTU BARIS (horizontal row)
		   Gaya khas: ikon kotak di kiri, teks rata kiri,
		   pita warna di tepi kiri, dan tombol panah bundar.
		   Berbeda arah dengan "Temukan Potensimu" yang
		   berbentuk medali melengkung dan rata tengah.
		===================================================== */
		.portal-grid {
			display: grid;
			grid-template-columns: repeat(auto-fit, minmax(292px, 1fr));
			gap: 18px;
			margin-top: 46px;
		}

		.portal-card {
			--c: #c8933f;
			--c-soft: #f7ebd8;
			position: relative;
			display: grid;
			grid-template-columns: 62px 1fr;
			grid-template-areas:
				"icon name"
				"icon count"
				"icon foot";
			align-content: center;
			column-gap: 16px;
			row-gap: 2px;
			overflow: hidden;
			padding: 22px 22px 22px 26px;
			border-radius: 18px;
			background: #fff;
			border: 1px solid var(--border);
			text-align: left;
			text-decoration: none !important;
			box-shadow: var(--shadow-soft);
			transition:
				transform .4s var(--ease),
				box-shadow .4s ease,
				border-color .3s ease;
		}

		/* pita warna di tepi kiri */
		.portal-card::before {
			content: "";
			position: absolute;
			left: 0;
			top: 0;
			bottom: 0;
			width: 5px;
			height: auto;
			background: var(--c);
			transform: scaleY(.22);
			transform-origin: center;
			transition: transform .45s var(--ease);
		}

		.portal-card:hover::before {
			transform: scaleY(1);
		}

		/* rona warna menyapu dari kiri */
		.portal-card::after {
			content: "";
			position: absolute;
			inset: 0;
			left: 0;
			top: 0;
			width: 100%;
			height: 100%;
			margin: 0;
			border-radius: 0;
			background:
				linear-gradient(100deg,
					var(--c-soft) 0%,
					rgba(255, 255, 255, 0) 62%);
			opacity: 0;
			transition: opacity .45s ease;
			pointer-events: none;
		}

		.portal-card:hover::after {
			opacity: 1;
		}

		.portal-card:hover {
			transform: translateY(-6px);
			border-color: var(--c);
			box-shadow: 0 22px 40px rgba(6, 47, 47, .16);
		}

		/* ---------- IKON KOTAK ---------- */
		.portal-card-icon {
			grid-area: icon;
			position: relative;
			z-index: 2;
			width: 62px;
			height: 62px;
			display: flex;
			align-items: center;
			justify-content: center;
			align-self: center;
			margin-bottom: 0;
			/* sudut asimetris — beda dari medali bulat di atasnya */
			border-radius: 20px 8px 20px 8px;
			background: var(--c-soft);
			color: var(--c);
			font-size: 24px;
			transition: .45s var(--ease);
		}

		.portal-card-icon::before {
			content: "";
			position: absolute;
			inset: -6px;
			border-radius: 24px 10px 24px 10px;
			border: 1px dashed var(--c);
			opacity: 0;
			transform: scale(.85) rotate(-6deg);
			transition: .5s var(--ease);
		}

		.portal-card:hover .portal-card-icon {
			background: var(--c);
			color: #fff;
			transform: rotate(-4deg) scale(1.04);
			box-shadow: 0 14px 26px rgba(6, 47, 47, .2);
		}

		.portal-card:hover .portal-card-icon::before {
			opacity: .55;
			transform: scale(1) rotate(0deg);
		}

		/* ---------- TEKS ---------- */
		.portal-name {
			grid-area: name;
			position: relative;
			z-index: 2;
			margin-bottom: 2px;
			color: var(--teal);
			font-family: 'Plus Jakarta Sans', sans-serif;
			font-size: 15px;
			font-weight: 800;
			letter-spacing: -.3px;
			transition: color .25s ease;
		}

		.portal-card:hover .portal-name {
			color: var(--c);
		}

		.portal-count {
			grid-area: count;
			position: relative;
			z-index: 2;
			display: inline-flex;
			align-items: center;
			gap: 6px;
			margin-bottom: 10px;
			color: var(--muted);
			font-size: 11px;
			font-weight: 600;
		}

		.portal-count::before {
			content: "";
			width: 6px;
			height: 6px;
			border-radius: 50%;
			background: var(--c);
			box-shadow: 0 0 0 3px rgba(0, 0, 0, .04);
		}

		/* ---------- TOMBOL LIHAT DETAIL ---------- */
		.portal-card-footer {
			grid-area: foot;
			position: relative;
			z-index: 2;
			display: inline-flex;
			align-items: center;
			gap: 8px;
			justify-self: start;
			margin-top: 0;
			padding: 0;
			border: 0;
			border-radius: 0;
			background: transparent;
			color: var(--c);
			font-size: 11px;
			font-weight: 800;
			letter-spacing: .2px;
			transition: gap .3s var(--ease);
		}

		.portal-card-footer i {
			width: 22px;
			height: 22px;
			display: inline-flex;
			align-items: center;
			justify-content: center;
			border-radius: 50%;
			background: var(--c-soft);
			color: var(--c);
			font-size: 9px;
			transition: .35s var(--ease);
		}

		.portal-card:hover .portal-card-footer {
			gap: 12px;
			background: transparent;
			border: 0;
			box-shadow: none;
			color: var(--c);
		}

		.portal-card:hover .portal-card-footer i {
			background: var(--c);
			color: #fff;
			transform: translateX(3px);
			box-shadow: 0 8px 16px rgba(6, 47, 47, .18);
		}

		/* ---------- WARNA PER KATEGORI ---------- */
		.portal-card.is-pengumuman {
			--c: #c8933f;
			--c-soft: #fbf1de;
		}

		.portal-card.is-prestasi {
			--c: #b8860b;
			--c-soft: #fdf1dc;
		}

		.portal-card.is-fasilitas {
			--c: #0b4a4a;
			--c-soft: #e6f1ef;
		}

		.portal-card.is-guru {
			--c: #3c5ea8;
			--c-soft: #eaf0fb;
		}

		.portal-card.is-download {
			--c: #6b52b5;
			--c-soft: #f0ecfa;
		}

		.portal-card.is-ppdb {
			--c: #1c7a42;
			--c-soft: #e4f7ea;
		}

		.portal-card.is-galeri {
			--c: #b5455f;
			--c-soft: #fae9ec;
		}

		/* =====================================================
		   GALERI  (bento kompak & aesthetic)
		===================================================== */
		.gallery-head {
			display: flex;
			justify-content: space-between;
			align-items: flex-end;
			gap: 16px;
			margin-bottom: 26px;
		}

		.gallery-front-grid {
			display: grid;
			grid-template-columns: repeat(4, 1fr);
			grid-auto-rows: 132px;
			grid-auto-flow: dense;
			gap: 12px;
		}

		.gallery-front-item {
			position: relative;
			height: 100%;
			overflow: hidden;
			border-radius: 16px;
			background: var(--teal-deep);
			box-shadow: 0 6px 18px rgba(6, 47, 47, .08);
			transition: transform .45s var(--ease), box-shadow .45s ease;
		}

		/* satu item besar tiap 7 gambar — ritme rapi, tidak boros tempat */
		.gallery-front-item:nth-child(7n+1) {
			grid-column: span 2;
			grid-row: span 2;
		}

		.gallery-front-item:hover {
			transform: translateY(-4px);
			box-shadow: 0 16px 34px rgba(6, 47, 47, .18);
			z-index: 2;
		}

		.gallery-front-item img {
			width: 100%;
			height: 100%;
			object-fit: cover;
			transform: scale(1.01);
			transition: transform .7s var(--ease), filter .45s ease;
		}

		.gallery-front-item:hover img {
			transform: scale(1.08);
		}

		/* lapisan gelap halus, muncul penuh saat hover */
		.gallery-front-item::before {
			content: "";
			position: absolute;
			inset: 0;
			z-index: 1;
			background: linear-gradient(180deg, transparent 45%, rgba(6, 47, 47, .85) 100%);
			opacity: .75;
			transition: opacity .4s ease;
		}

		.gallery-front-item:hover::before {
			opacity: 1;
		}

		/* ikon zoom kecil */
		.gallery-front-item::after {
			content: "\f00e";
			position: absolute;
			top: 10px;
			right: 10px;
			z-index: 3;
			width: 28px;
			height: 28px;
			display: flex;
			align-items: center;
			justify-content: center;
			border-radius: 50%;
			background: rgba(255, 255, 255, .92);
			color: var(--teal);
			font-family: "Font Awesome 6 Free";
			font-weight: 900;
			font-size: 10px;
			opacity: 0;
			transform: scale(.7);
			transition: .35s var(--ease);
		}

		.gallery-front-item:hover::after {
			opacity: 1;
			transform: none;
		}

		.gallery-front-caption {
			position: absolute;
			inset: auto 0 0;
			z-index: 2;
			padding: 14px 14px 13px;
			color: white;
		}

		.gallery-front-caption strong {
			display: -webkit-box;
			-webkit-line-clamp: 2;
			-webkit-box-orient: vertical;
			overflow: hidden;
			font-family: 'Plus Jakarta Sans', sans-serif;
			font-size: 12px;
			font-weight: 800;
			line-height: 1.4;
		}

		.gallery-front-caption span {
			display: inline-flex;
			align-items: center;
			gap: 6px;
			max-height: 0;
			margin-top: 0;
			overflow: hidden;
			color: rgba(255, 255, 255, .8);
			font-size: 10.5px;
			opacity: 0;
			transition: .4s var(--ease);
		}

		.gallery-front-item:hover .gallery-front-caption span {
			max-height: 20px;
			margin-top: 5px;
			opacity: 1;
		}

		.gallery-front-caption span::before {
			content: "";
			width: 12px;
			height: 1px;
			background: var(--gold);
		}

		.empty-data {
			padding: 38px;
			border: 1px dashed var(--border);
			border-radius: var(--radius);
			background: var(--cream);
			color: var(--muted);
			font-size: 13px;
			text-align: center;
		}

		/* =====================================================
		   BERITA
		===================================================== */
		.news-card {
			height: 100%;
			overflow: hidden;
			border: 1px solid var(--border);
			border-radius: var(--radius);
			background: white;
			box-shadow: var(--shadow-soft);
			transition: .35s var(--ease);
		}

		.news-card:hover {
			transform: translateY(-6px);
			border-color: #e2d3b6;
			box-shadow: var(--shadow-hover);
		}

		.news-image-wrap {
			position: relative;
			overflow: hidden;
		}

		.news-image {
			width: 100%;
			height: 190px;
			object-fit: cover;
			transition: transform .6s var(--ease);
		}

		.news-card:hover .news-image {
			transform: scale(1.07);
		}

		.news-tag {
			position: absolute;
			left: 14px;
			top: 14px;
			z-index: 2;
			padding: 6px 12px;
			border-radius: 6px;
			background: var(--gold);
			color: white;
			font-size: 9.5px;
			font-weight: 800;
			letter-spacing: .6px;
			text-transform: uppercase;
			box-shadow: 0 6px 14px rgba(200, 147, 63, .35);
		}

		.news-body {
			padding: 20px;
		}

		.news-date {
			margin-bottom: 10px;
			color: var(--gold);
			font-size: 10.5px;
			font-weight: 700;
		}

		.news-title {
			min-height: 42px;
			margin-bottom: 14px;
			color: var(--teal);
			font-family: 'Plus Jakarta Sans', sans-serif;
			font-size: 14px;
			font-weight: 700;
			line-height: 1.5;
			transition: color .25s ease;
		}

		.news-card:hover .news-title {
			color: var(--gold-deep);
		}

		.news-link {
			display: inline-flex;
			align-items: center;
			gap: 5px;
			color: var(--gold);
			font-size: 10.8px;
			font-weight: 800;
			letter-spacing: .3px;
			transition: gap .25s ease, color .25s ease;
		}

		.news-link:hover {
			gap: 10px;
			color: var(--gold-deep);
		}

		/* =====================================================
		   AGENDA
		===================================================== */
		.agenda-wrapper {
			overflow: hidden;
			border: 1px solid var(--border);
			border-radius: var(--radius);
			background: white;
			box-shadow: var(--shadow-soft);
		}

		.agenda-item {
			position: relative;
			display: flex;
			gap: 16px;
			padding: 20px;
			border-bottom: 1px solid var(--border);
			transition: background .3s ease;
		}

		.agenda-item::before {
			content: "";
			position: absolute;
			left: 0;
			top: 0;
			bottom: 0;
			width: 3px;
			background: var(--gold);
			transform: scaleY(0);
			transition: transform .3s var(--ease);
		}

		.agenda-item:hover::before {
			transform: scaleY(1);
		}

		.agenda-item:hover {
			background: var(--cream);
		}

		.agenda-item:last-child {
			border-bottom: 0;
		}

		.agenda-date {
			width: 54px;
			height: 58px;
			flex: 0 0 54px;
			display: flex;
			align-items: center;
			justify-content: center;
			flex-direction: column;
			border-radius: 12px;
			background: linear-gradient(150deg, var(--teal), var(--teal-deep));
			color: white;
			box-shadow: 0 8px 16px rgba(6, 47, 47, .16);
			transition: transform .3s var(--ease);
		}

		.agenda-item:hover .agenda-date {
			transform: scale(1.06) rotate(-4deg);
		}

		.agenda-day {
			font-family: 'Plus Jakarta Sans', sans-serif;
			font-size: 18px;
			font-weight: 800;
			line-height: 1;
		}

		.agenda-month {
			margin-top: 4px;
			color: var(--gold);
			font-size: 8px;
			font-weight: 700;
			letter-spacing: .6px;
			text-transform: uppercase;
		}

		.agenda-title {
			margin-bottom: 6px;
			color: var(--teal);
			font-family: 'Plus Jakarta Sans', sans-serif;
			font-size: 12.8px;
			font-weight: 700;
			line-height: 1.5;
		}

		.agenda-location {
			color: var(--muted);
			font-size: 10.8px;
		}

		.agenda-location i {
			color: var(--gold);
		}

		/* =====================================================
		   BADGE
		===================================================== */
		.badge-strip {
			padding: 28px 0;
			background:
				linear-gradient(100deg, var(--teal-deep), #0a3b39 50%, var(--teal-deep));
		}

		.badge-item {
			display: flex;
			align-items: center;
			justify-content: center;
			gap: 10px;
			color: rgba(255, 255, 255, .8);
			font-size: 11.5px;
			font-weight: 700;
			letter-spacing: .3px;
			transition: color .25s ease, transform .25s var(--ease);
		}

		.badge-item:hover {
			color: #fff;
			transform: translateY(-3px);
		}

		.badge-item i {
			color: var(--gold);
			font-size: 16px;
			transition: transform .3s var(--ease);
		}

		.badge-item:hover i {
			transform: scale(1.15) rotate(-8deg);
		}

		/* =====================================================
		   CTA
		===================================================== */
		.cta {
			position: relative;
			overflow: hidden;
			padding: 84px 0;
			background:
				linear-gradient(105deg, var(--teal-deep), var(--teal));
			color: white;
			text-align: center;
		}

		.cta::before {
			content: "";
			position: absolute;
			width: 300px;
			height: 300px;
			right: -110px;
			top: -150px;
			border: 1px solid rgba(255, 255, 255, .08);
			border-radius: 50%;
		}

		.cta::after {
			content: "";
			position: absolute;
			width: 220px;
			height: 220px;
			left: -90px;
			bottom: -120px;
			border: 1px solid rgba(200, 147, 63, .2);
			border-radius: 50%;
		}

		.cta .container {
			position: relative;
			z-index: 2;
		}

		.cta-title {
			margin-bottom: 12px;
			font-family: 'Plus Jakarta Sans', sans-serif;
			font-size: clamp(24px, 3.2vw, 32px);
			font-weight: 800;
			letter-spacing: -.6px;
			text-wrap: balance;
		}

		.cta-description {
			max-width: 560px;
			margin: 0 auto 26px;
			color: rgba(255, 255, 255, .75);
			font-size: 13.5px;
			line-height: 1.8;
		}

		/* =====================================================
		   FOOTER
		===================================================== */
		footer {
			position: relative;
			padding-top: 64px;
			background: var(--teal-deep);
			color: white;
		}

		footer::before {
			content: "";
			position: absolute;
			top: 0;
			left: 0;
			right: 0;
			height: 3px;
			background: linear-gradient(90deg, var(--gold), var(--teal-light), var(--gold));
		}

		.footer-brand {
			display: flex;
			align-items: center;
			gap: 12px;
			margin-bottom: 16px;
		}

		.footer-brand .brand-logo {
			background: rgba(255, 255, 255, .08);
			border: 1px solid rgba(255, 255, 255, .1);
			box-shadow: none;
		}

		.footer-title {
			font-family: 'Plus Jakarta Sans', sans-serif;
			font-size: 13px;
			font-weight: 800;
			line-height: 1.4;
		}

		.footer-text {
			color: rgba(255, 255, 255, .6);
			font-size: 11.5px;
			line-height: 1.85;
		}

		a.footer-text {
			transition: color .2s ease, padding-left .2s ease;
		}

		a.footer-text:hover {
			color: var(--gold);
			padding-left: 5px;
		}

		.footer-heading {
			position: relative;
			margin-bottom: 18px;
			padding-bottom: 10px;
			font-size: 11.5px;
			font-weight: 800;
			letter-spacing: .6px;
			text-transform: uppercase;
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

		.footer-block {
			margin-bottom: 22px;
			padding-left: 16px;
			border-left: 2px solid rgba(255, 255, 255, .15);
		}

		.footer-block i {
			color: var(--gold);
		}

		.map-frame {
			width: 100%;
			height: 210px;
			margin-top: 4px;
			border: 0;
			border-radius: 14px;
			filter: grayscale(.25);
			transition: filter .35s ease;
		}

		.map-frame:hover {
			filter: none;
		}

		.socials {
			display: flex;
			gap: 9px;
			margin-top: 18px;
		}

		.social {
			width: 35px;
			height: 35px;
			display: flex;
			align-items: center;
			justify-content: center;
			border-radius: 10px;
			background: rgba(255, 255, 255, .08);
			color: white;
			font-size: 12px;
			transition: .28s var(--ease);
		}

		.social:hover {
			background: var(--gold);
			color: #fff;
			transform: translateY(-4px);
			box-shadow: 0 10px 20px rgba(200, 147, 63, .3);
		}

		.footer-bottom {
			margin-top: 48px;
			padding: 20px 0;
			border-top: 1px solid rgba(255, 255, 255, .08);
			color: rgba(255, 255, 255, .45);
			font-size: 10.5px;
		}

		/* =====================================================
		   BACK TO TOP
		===================================================== */
		.back-to-top {
			position: fixed;
			right: 22px;
			bottom: 22px;
			z-index: 60;
			width: 44px;
			height: 44px;
			display: flex;
			align-items: center;
			justify-content: center;
			border: 0;
			border-radius: 50%;
			background: var(--teal);
			color: #fff;
			font-size: 14px;
			box-shadow: 0 12px 26px rgba(6, 47, 47, .28);
			opacity: 0;
			visibility: hidden;
			transform: translateY(14px);
			transition: .35s var(--ease);
		}

		.back-to-top.show {
			opacity: 1;
			visibility: visible;
			transform: none;
		}

		.back-to-top:hover {
			background: var(--gold);
			transform: translateY(-4px);
		}

		/* =====================================================
		   PROGRESS BAR
		===================================================== */
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

		/* =====================================================
		   RESPONSIVE
		===================================================== */
		@media (max-width: 991px) {
			.hero-slider {
				height: 500px;
			}

			.hero-scroll-hint {
				display: none;
			}

			.stat {
				margin-bottom: 6px;
				padding-bottom: 18px;
				border-right: 0;
				border-bottom: 1px solid var(--border);
			}

			.stat:nth-last-child(-n+2) {
				margin-bottom: 0;
				padding-bottom: 0;
				border-bottom: 0;
			}

			.gallery-front-grid {
				grid-template-columns: repeat(3, 1fr);
				grid-auto-rows: 120px;
			}

			.gallery-front-item:nth-child(7n+1) {
				grid-column: span 2;
				grid-row: span 2;
			}

			.portal-grid {
				grid-template-columns: repeat(3, minmax(0, 1fr));
			}

			.nav-mobile-actions {
				display: flex;
				flex-direction: column;
			}

			.nav-mobile-actions .nav-login,
			.nav-mobile-actions .nav-cta {
				width: 100%;
				margin-bottom: 10px;
			}

			.nav-link::after {
				display: none;
			}
		}

		@media (max-width: 767px) {
			.double-track-grid {
				grid-template-columns: 1fr;
			}

			.gallery-head {
				flex-direction: column;
				align-items: flex-start;
			}
		}

		@media (max-width: 575px) {
			.komp-grid {
				grid-template-columns: 1fr;
			}

			.komp-card {
				width: auto;
			}

			.hero-slider {
				height: 440px;
			}

			.hero-caption {
				padding-bottom: 54px;
			}

			.hero-caption h1 {
				font-size: 26px;
			}

			.section {
				padding: 62px 0;
			}

			.welcome-lede {
				font-size: 17px;
			}

			.vm-card {
				padding: 26px 20px;
				border-radius: 22px;
			}

			.vision-main {
				flex-direction: column;
				gap: 16px;
			}

			.vm-statement {
				padding: 20px 20px;
			}

			.vm-watermark {
				font-size: 130px;
			}

			.vision-card-top {
				margin-bottom: 22px;
			}

			.vision-main h3 {
				font-size: 26px;
			}

			.vision-description {
				font-size: 12px;
			}

			.vision-focus-item,
			.vm-card.misi .mission-item {
				padding: 13px;
			}

			.double-track {
				padding: 26px 20px;
			}

			.portal-grid {
				grid-template-columns: repeat(2, minmax(0, 1fr));
				gap: 14px;
			}

			.portal-card {
				padding: 24px 12px 20px;
			}

			.portal-card-icon {
				width: 60px;
				height: 60px;
				font-size: 22px;
			}

			.portal-name {
				font-size: 13px;
			}

			.gallery-front-grid {
				grid-template-columns: repeat(2, 1fr);
				grid-auto-rows: 112px;
				gap: 10px;
			}

			.gallery-front-item:nth-child(7n+1) {
				grid-column: span 2;
				grid-row: span 2;
			}
		}

		/* =====================================================
		   =====================================================
		   PENYEMPURNAAN TAMPILAN (POLISH LAYER)
		   Blok ini hanya menimpa gaya visual. Tidak ada
		   struktur, kelas, maupun logika PHP yang diubah.
		   =====================================================
		===================================================== */

		/* ---------- animasi bersama ---------- */
		@keyframes floatSoft {

			0%,
			100% {
				transform: translateY(0);
			}

			50% {
				transform: translateY(-14px);
			}
		}

		@keyframes auraPulse {

			0%,
			100% {
				opacity: .45;
				transform: scale(1);
			}

			50% {
				opacity: .8;
				transform: scale(1.08);
			}
		}

		@keyframes shineSweep {
			0% {
				background-position: -220% 0;
			}

			100% {
				background-position: 220% 0;
			}
		}

		@keyframes ringSpin {
			to {
				transform: rotate(360deg);
			}
		}

		@keyframes tickerSlide {
			0% {
				transform: translateX(0);
			}

			100% {
				transform: translateX(-50%);
			}
		}

		/* ---------- reveal jadi lebih halus ---------- */
		[data-reveal] {
			filter: blur(6px);
			transition:
				opacity .8s var(--ease),
				transform .8s var(--ease),
				filter .8s var(--ease);
		}

		[data-reveal].is-visible {
			filter: blur(0);
		}

		/* =====================================================
		   NAVBAR
		===================================================== */
		.main-navbar {
			background: rgba(255, 255, 255, .78);
			backdrop-filter: blur(18px) saturate(1.4);
			-webkit-backdrop-filter: blur(18px) saturate(1.4);
		}

		.main-navbar.scrolled {
			background: rgba(255, 255, 255, .95);
			box-shadow: 0 14px 34px rgba(6, 47, 47, .09);
		}

		.brand-logo {
			overflow: hidden;
		}

		.brand-logo::before {
			content: "";
			position: absolute;
			inset: 0;
			background:
				linear-gradient(115deg,
					transparent 35%,
					rgba(255, 255, 255, .35) 50%,
					transparent 65%);
			background-size: 220% 100%;
			animation: shineSweep 4.5s ease-in-out infinite;
		}

		.nav-cta {
			position: relative;
			overflow: hidden;
		}

		.nav-cta::after {
			content: "";
			position: absolute;
			top: 0;
			left: -80%;
			width: 45%;
			height: 100%;
			background:
				linear-gradient(100deg,
					transparent,
					rgba(255, 255, 255, .45),
					transparent);
			transform: skewX(-18deg);
			transition: left .7s var(--ease);
		}

		.nav-cta:hover::after {
			left: 130%;
		}

		/* =====================================================
		   HERO
		===================================================== */
		.hero-slider {
			height: 660px;
		}

		.hero-slide.active {
			animation: heroKen 9s var(--ease) both;
		}

		@keyframes heroKen {
			from {
				transform: scale(1.12);
			}

			to {
				transform: scale(1);
			}
		}

		/* garis emas tipis di bawah hero */
		.hero-slider::after {
			content: "";
			position: absolute;
			left: 0;
			right: 0;
			bottom: 0;
			z-index: 5;
			height: 3px;
			background:
				linear-gradient(90deg,
					var(--gold),
					var(--teal-light),
					var(--gold));
			background-size: 220% 100%;
			animation: shineSweep 6s linear infinite;
		}

		.hero-caption h1 {
			text-shadow: 0 14px 46px rgba(0, 0, 0, .45);
		}

		/* aksen cahaya lembut di belakang teks hero */
		.hero-caption::before {
			content: "";
			position: absolute;
			left: -60px;
			bottom: -40px;
			z-index: -1;
			width: 420px;
			height: 420px;
			border-radius: 50%;
			background:
				radial-gradient(circle,
					rgba(200, 147, 63, .26),
					transparent 68%);
			animation: auraPulse 7s ease-in-out infinite;
			pointer-events: none;
		}

		.slider-arrow {
			background: rgba(255, 255, 255, .12);
			box-shadow: 0 10px 26px rgba(0, 0, 0, .18);
		}

		/* =====================================================
		   STATISTIK
		===================================================== */
		.stats-container {
			padding: 32px 26px;
			margin-top: 26px;
			margin-bottom: 8px;
			border: 1px solid var(--border);
			border-radius: 22px;
			background: rgba(255, 255, 255, .88);
			backdrop-filter: blur(14px);
			-webkit-backdrop-filter: blur(14px);
			box-shadow: 0 26px 60px rgba(6, 47, 47, .14);
		}

		.stats {
			padding-bottom: 46px;
		}

		.stat-icon {
			width: 44px;
			height: 44px;
			font-size: 16px;
			background:
				linear-gradient(140deg,
					rgba(200, 147, 63, .18),
					rgba(200, 147, 63, .06));
			box-shadow: inset 0 0 0 1px rgba(200, 147, 63, .18);
		}

		.stat:hover .stat-icon {
			background: linear-gradient(140deg, var(--teal), var(--teal-deep));
			box-shadow: 0 12px 22px rgba(6, 47, 47, .22);
		}

		.stat-number {
			background:
				linear-gradient(120deg,
					var(--teal) 0%,
					var(--teal-light) 45%,
					var(--gold) 100%);
			-webkit-background-clip: text;
			background-clip: text;
			-webkit-text-fill-color: transparent;
		}

		/* =====================================================
		   JUDUL SECTION
		===================================================== */
		.section-title {
			position: relative;
		}

		.title-accent::after {
			height: 10px;
			background:
				linear-gradient(90deg,
					rgba(200, 147, 63, .28),
					rgba(200, 147, 63, .08));
			transform-origin: left;
			animation: none;
		}

		.text-center .section-description {
			margin-left: auto;
			margin-right: auto;
		}

		/* ornamen lingkaran lembut pada section berlatar krem */
		.section-soft {
			position: relative;
			overflow: hidden;
		}

		.section-soft::after {
			content: "";
			position: absolute;
			right: -160px;
			top: -120px;
			width: 420px;
			height: 420px;
			border-radius: 50%;
			background:
				radial-gradient(circle,
					rgba(200, 147, 63, .12),
					transparent 70%);
			animation: floatSoft 11s ease-in-out infinite;
			pointer-events: none;
		}

		.section-soft>.container {
			position: relative;
			z-index: 1;
		}

		/* =====================================================
		   WELCOME / VISI MISI
		===================================================== */
		.welcome-lede {
			font-size: 21px;
		}

		.vm-card {
			transition:
				transform .5s var(--ease),
				box-shadow .5s ease;
		}

		.vm-card:hover {
			transform: translateY(-8px);
		}

		.vm-card .vm-watermark {
			transition: transform .8s var(--ease), opacity .6s ease;
		}

		.vm-card:hover .vm-watermark {
			transform: rotate(-8deg) scale(1.06);
		}

		.double-track {
			position: relative;
			overflow: hidden;
		}

		.double-track-item {
			transition:
				transform .4s var(--ease),
				background .4s ease,
				border-color .4s ease;
		}

		.double-track-item:hover {
			transform: translateY(-6px);
		}

		/* =====================================================
		   GALERI
		===================================================== */
		.gallery-front-item {
			border-radius: 18px;
		}

		.gallery-front-item:hover {
			transform: translateY(-6px) scale(1.012);
		}

		/* =====================================================
		   BERITA
		===================================================== */
		.news-card {
			position: relative;
			border-radius: 20px;
		}

		.news-card::after {
			content: "";
			position: absolute;
			left: 0;
			right: 0;
			bottom: 0;
			height: 3px;
			border-radius: 0 0 20px 20px;
			background: linear-gradient(90deg, var(--gold), var(--teal-light));
			transform: scaleX(0);
			transform-origin: left;
			transition: transform .5s var(--ease);
		}

		.news-card:hover::after {
			transform: scaleX(1);
		}

		.news-image-wrap::after {
			content: "";
			position: absolute;
			inset: 0;
			background:
				linear-gradient(180deg,
					transparent 55%,
					rgba(6, 47, 47, .35) 100%);
			opacity: 0;
			transition: opacity .4s ease;
		}

		.news-card:hover .news-image-wrap::after {
			opacity: 1;
		}

		.news-tag {
			border-radius: 30px;
			padding: 6px 14px;
			backdrop-filter: blur(6px);
		}

		/* =====================================================
		   AGENDA
		===================================================== */
		.agenda-wrapper {
			border-radius: 20px;
		}

		.agenda-item:hover {
			background:
				linear-gradient(90deg,
					var(--cream),
					rgba(250, 247, 241, 0));
		}

		/* =====================================================
		   BADGE STRIP
		===================================================== */
		.badge-strip {
			position: relative;
			overflow: hidden;
		}

		.badge-strip::before {
			content: "";
			position: absolute;
			inset: 0;
			background:
				radial-gradient(600px 180px at 20% 0%,
					rgba(200, 147, 63, .18),
					transparent 70%);
			pointer-events: none;
		}

		.badge-strip .container {
			position: relative;
			z-index: 1;
		}

		.badge-item {
			padding: 12px 8px;
			border-radius: 14px;
			border: 1px solid rgba(255, 255, 255, .07);
			background: rgba(255, 255, 255, .03);
			transition:
				color .25s ease,
				transform .3s var(--ease),
				background .3s ease,
				border-color .3s ease;
		}

		.badge-item:hover {
			background: rgba(255, 255, 255, .08);
			border-color: rgba(200, 147, 63, .35);
			transform: translateY(-5px);
		}

		/* =====================================================
		   CTA
		===================================================== */
		.cta::before {
			animation: floatSoft 12s ease-in-out infinite;
		}

		.cta::after {
			animation: floatSoft 9s ease-in-out infinite reverse;
		}

		.cta-title {
			background:
				linear-gradient(100deg,
					#ffffff 20%,
					var(--gold-soft) 45%,
					#ffffff 70%);
			background-size: 220% 100%;
			-webkit-background-clip: text;
			background-clip: text;
			-webkit-text-fill-color: transparent;
			animation: shineSweep 8s linear infinite;
		}

		/* =====================================================
		   FOOTER
		===================================================== */
		footer::before {
			background-size: 220% 100%;
			animation: shineSweep 7s linear infinite;
		}

		.social {
			border: 1px solid rgba(255, 255, 255, .08);
		}

		.map-frame {
			height: 228px;
			border: 1px solid rgba(255, 255, 255, .1);
		}

		/* =====================================================
		   BACK TO TOP
		===================================================== */
		.back-to-top {
			width: 48px;
			height: 48px;
			background:
				linear-gradient(150deg, var(--teal), var(--teal-deep));
		}

		.back-to-top::before {
			content: "";
			position: absolute;
			inset: -5px;
			border-radius: 50%;
			border: 1px dashed rgba(200, 147, 63, .55);
			animation: ringSpin 9s linear infinite;
		}

		.back-to-top:hover {
			background: linear-gradient(150deg, var(--gold), var(--gold-deep));
		}

		/* =====================================================
		   RESPONSIF UNTUK TATA LETAK BARU
		===================================================== */
		@media (max-width: 991px) {
			.hero-slider {
				height: 520px;
			}

			.portal-grid {
				grid-template-columns: repeat(auto-fit, minmax(270px, 1fr));
			}

			.stats-container {
				margin-top: 20px;
				padding: 26px 18px;
			}
		}

		@media (max-width: 767px) {
			.komp-grid {
				grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
				gap: 16px;
			}

			.komp-card {
				padding: 26px 14px 22px;
				border-radius: 100px 100px 20px 20px;
			}

			.komp-illustration {
				width: 78px;
				height: 78px;
			}

			.komp-illustration i {
				font-size: 22px;
			}
		}

		@media (max-width: 575px) {
			.komp-grid {
				grid-template-columns: repeat(2, minmax(0, 1fr));
				gap: 12px;
			}

			.komp-card {
				width: auto;
				padding: 22px 10px 18px;
			}

			.komp-illustration {
				width: 68px;
				height: 68px;
				margin-bottom: 14px;
			}

			.komp-name {
				font-size: 12.5px;
			}

			.komp-desc {
				display: none;
			}

			.portal-grid {
				grid-template-columns: 1fr;
				gap: 12px;
			}

			.portal-card {
				grid-template-columns: 54px 1fr;
				padding: 18px 16px 18px 20px;
			}

			.portal-card-icon {
				width: 54px;
				height: 54px;
				font-size: 20px;
			}

			.portal-name {
				font-size: 14px;
			}

			.stats-container {
				margin-top: 16px;
				padding: 22px 14px;
			}
		}

		/* ---------- hormati preferensi kurangi gerak ---------- */
		@media (prefers-reduced-motion: reduce) {

			.brand-logo::before,
			.hero-slider::after,
			.hero-caption::before,
			.hero-slide.active,
			.section-soft::after,
			.cta::before,
			.cta::after,
			.cta-title,
			footer::before,
			.back-to-top::before,
			.komp-illustration::before {
				animation: none !important;
			}

			[data-reveal] {
				filter: none !important;
			}
		}

		/* =====================================================
		   =====================================================
		   LAPIS KEDUA — SAMBUTAN, GALERI, BERITA, AGENDA,
		   PENCARIAN, DAN PERAPATAN RUANG KOSONG
		   =====================================================
		===================================================== */

		/* -----------------------------------------------------
		   1. RAPATKAN RUANG KOSONG
		----------------------------------------------------- */
		.section {
			padding: 68px 0;
		}

		.section .text-center.mb-5 {
			margin-bottom: 34px !important;
		}

		.welcome-lede {
			margin-bottom: 34px;
			font-size: 19.5px;
			line-height: 1.7;
		}

		.komp-grid,
		.portal-grid {
			margin-top: 0;
		}

		.double-track {
			margin-top: 26px;
		}

		.stats {
			padding-bottom: 34px;
		}

		.stats-container {
			margin-top: 20px;
		}

		.badge-strip {
			padding: 22px 0;
		}

		.cta {
			padding: 66px 0;
		}

		footer {
			padding-top: 52px;
		}

		.footer-bottom {
			margin-top: 34px;
		}

		.gallery-head {
			margin-bottom: 20px;
		}

		.section-description {
			max-width: 640px;
			font-size: 14px;
			line-height: 1.75;
		}

		/* -----------------------------------------------------
		   2. SAMBUTAN KEPALA SEKOLAH
		----------------------------------------------------- */
		.greeting-section {
			position: relative;
			overflow: hidden;
			padding-top: 0;
		}

		.greeting-wrap {
			position: relative;
			display: grid;
			grid-template-columns: 300px 1fr;
			align-items: center;
			gap: 42px;
			overflow: hidden;
			padding: 40px 44px;
			border: 1px solid var(--border);
			border-radius: 28px;
			background:
				linear-gradient(135deg, #fdfbf6 0%, #f6f1e7 55%, #f1f5f3 100%);
			box-shadow: 0 22px 50px rgba(6, 47, 47, .1);
		}

		/* ornamen tanda kutip raksasa */
		.greeting-wrap::before {
			content: "\201C";
			position: absolute;
			right: 26px;
			top: -34px;
			color: rgba(200, 147, 63, .14);
			font-family: 'Fraunces', serif;
			font-size: 210px;
			line-height: 1;
			pointer-events: none;
		}

		.greeting-wrap::after {
			content: "";
			position: absolute;
			left: -120px;
			bottom: -140px;
			width: 320px;
			height: 320px;
			border-radius: 50%;
			background:
				radial-gradient(circle, rgba(11, 74, 74, .1), transparent 70%);
			pointer-events: none;
		}

		.greeting-figure {
			position: relative;
			z-index: 2;
			text-align: center;
		}

		.greeting-photo {
			position: relative;
			width: 100%;
			aspect-ratio: 3 / 3.6;
			overflow: hidden;
			border-radius: 140px 140px 24px 24px;
			background: linear-gradient(160deg, var(--teal), var(--teal-deep));
			box-shadow: 0 22px 44px rgba(6, 47, 47, .26);
		}

		.greeting-photo img {
			width: 100%;
			height: 100%;
			object-fit: cover;
			object-position: top center;
			transition: transform .7s var(--ease);
		}

		.greeting-photo:hover img {
			transform: scale(1.05);
		}

		.greeting-photo-fallback {
			position: absolute;
			inset: 0;
			display: flex;
			align-items: center;
			justify-content: center;
			color: rgba(255, 255, 255, .3);
			font-size: 76px;
		}

		/* bingkai emas yang sedikit bergeser */
		.greeting-photo-ring {
			position: absolute;
			inset: 0;
			border-radius: inherit;
			box-shadow: inset 0 0 0 1px rgba(255, 255, 255, .25);
			pointer-events: none;
		}

		.greeting-figure::before {
			content: "";
			position: absolute;
			left: 14px;
			top: 16px;
			right: -14px;
			bottom: 54px;
			z-index: -1;
			border: 1.5px solid rgba(200, 147, 63, .45);
			border-radius: 140px 140px 24px 24px;
			transition: transform .5s var(--ease);
		}

		.greeting-figure:hover::before {
			transform: translate(6px, -6px);
		}

		.greeting-name-card {
			position: relative;
			z-index: 3;
			display: inline-flex;
			flex-direction: column;
			gap: 3px;
			margin-top: -28px;
			padding: 14px 22px;
			border: 1px solid var(--border);
			border-radius: 16px;
			background: rgba(255, 255, 255, .96);
			backdrop-filter: blur(8px);
			box-shadow: 0 14px 30px rgba(6, 47, 47, .14);
		}

		.greeting-role {
			color: var(--gold);
			font-size: 9.5px;
			font-weight: 800;
			letter-spacing: 1.1px;
			text-transform: uppercase;
		}

		.greeting-name {
			color: var(--teal);
			font-family: 'Plus Jakarta Sans', sans-serif;
			font-size: 14.5px;
			font-weight: 800;
			line-height: 1.35;
		}

		.greeting-school {
			color: var(--muted);
			font-size: 10.5px;
			font-weight: 600;
		}

		.greeting-body {
			position: relative;
			z-index: 2;
		}

		.greeting-body .section-title {
			margin-bottom: 16px;
		}

		.greeting-text {
			position: relative;
			max-width: 640px;
			padding-left: 20px;
			border-left: 2px solid rgba(200, 147, 63, .35);
		}

		.greeting-text p {
			margin-bottom: 12px;
			color: var(--muted);
			font-size: 14px;
			line-height: 1.9;
			text-wrap: pretty;
		}

		.greeting-text p:first-child {
			color: var(--teal);
			font-family: 'Fraunces', serif;
			font-size: 16.5px;
			font-style: italic;
			line-height: 1.8;
		}

		.greeting-text p:last-child {
			margin-bottom: 0;
		}

		.greeting-sign {
			display: flex;
			align-items: center;
			gap: 14px;
			margin-top: 22px;
		}

		.greeting-sign-line {
			width: 46px;
			height: 2px;
			border-radius: 2px;
			background: linear-gradient(90deg, var(--gold), transparent);
		}

		.greeting-sign strong {
			display: block;
			color: var(--teal);
			font-family: 'Plus Jakarta Sans', sans-serif;
			font-size: 13px;
			font-weight: 800;
		}

		.greeting-sign span {
			color: var(--muted);
			font-size: 11px;
		}

		/* -----------------------------------------------------
		   3. GALERI
		----------------------------------------------------- */
		.gallery-head-side {
			display: flex;
			align-items: center;
			gap: 16px;
		}

		.gallery-count {
			display: inline-flex;
			align-items: center;
			gap: 7px;
			padding: 7px 14px;
			border: 1px solid var(--border);
			border-radius: 30px;
			background: #fff;
			color: var(--teal);
			font-size: 11px;
			font-weight: 800;
		}

		.gallery-count i {
			color: var(--gold);
		}

		.gallery-filter {
			display: flex;
			flex-wrap: wrap;
			gap: 8px;
			margin-bottom: 18px;
		}

		.gallery-chip {
			padding: 8px 16px;
			border: 1px solid var(--border);
			border-radius: 30px;
			background: #fff;
			color: var(--muted);
			font-family: 'DM Sans', sans-serif;
			font-size: 11.5px;
			font-weight: 700;
			cursor: pointer;
			transition: .3s var(--ease);
		}

		.gallery-chip:hover {
			border-color: var(--gold);
			color: var(--teal);
			transform: translateY(-2px);
		}

		.gallery-chip.active {
			border-color: transparent;
			background: linear-gradient(120deg, var(--teal), var(--teal-deep));
			color: #fff;
			box-shadow: 0 10px 20px rgba(6, 47, 47, .2);
		}

		.gallery-front-grid {
			gap: 14px;
			grid-auto-rows: 140px;
		}

		.gallery-front-item {
			cursor: zoom-in;
			animation: galFade .45s var(--ease) both;
		}

		@keyframes galFade {
			from {
				opacity: 0;
				transform: scale(.94);
			}

			to {
				opacity: 1;
				transform: none;
			}
		}

		.gallery-front-item.is-hidden {
			display: none;
		}

		.gallery-front-caption strong {
			font-size: 12.5px;
		}

		/* ---------- LIGHTBOX ---------- */
		.lightbox {
			position: fixed;
			inset: 0;
			z-index: 3000;
			display: flex;
			align-items: center;
			justify-content: center;
			padding: 26px;
			background: rgba(4, 26, 26, .92);
			backdrop-filter: blur(6px);
			opacity: 0;
			visibility: hidden;
			transition: opacity .35s ease, visibility .35s ease;
		}

		.lightbox.show {
			opacity: 1;
			visibility: visible;
		}

		.lightbox-inner {
			position: relative;
			max-width: 960px;
			width: 100%;
			transform: scale(.94);
			transition: transform .4s var(--ease);
		}

		.lightbox.show .lightbox-inner {
			transform: none;
		}

		.lightbox img {
			width: 100%;
			max-height: 74vh;
			object-fit: contain;
			border-radius: 16px;
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

		.lightbox-close,
		.lightbox-nav {
			position: absolute;
			display: flex;
			align-items: center;
			justify-content: center;
			width: 44px;
			height: 44px;
			border: 1px solid rgba(255, 255, 255, .25);
			border-radius: 50%;
			background: rgba(255, 255, 255, .1);
			color: #fff;
			font-size: 14px;
			cursor: pointer;
			transition: .3s var(--ease);
		}

		.lightbox-close:hover,
		.lightbox-nav:hover {
			background: var(--gold);
			border-color: var(--gold);
		}

		.lightbox-close {
			top: -56px;
			right: 0;
		}

		.lightbox-nav.prev {
			left: -56px;
			top: 50%;
			transform: translateY(-50%);
		}

		.lightbox-nav.next {
			right: -56px;
			top: 50%;
			transform: translateY(-50%);
		}

		/* -----------------------------------------------------
		   4. BERITA
		----------------------------------------------------- */
		.block-head {
			display: flex;
			align-items: flex-end;
			justify-content: space-between;
			gap: 16px;
			margin-bottom: 22px;
		}

		.news-stack {
			display: grid;
			grid-template-columns: repeat(2, minmax(0, 1fr));
			gap: 18px;
		}

		.news-card {
			display: flex;
			flex-direction: column;
			height: 100%;
			border-radius: 20px;
		}

		/* berita pertama tampil melebar dengan gambar di kiri */
		.news-card.news-featured {
			grid-column: 1 / -1;
			flex-direction: row;
			align-items: stretch;
		}

		.news-card.news-featured .news-image-wrap {
			flex: 0 0 46%;
			min-height: 218px;
		}

		.news-card.news-featured .news-image {
			height: 100%;
			min-height: 218px;
		}

		.news-card.news-featured .news-body {
			display: flex;
			flex: 1;
			flex-direction: column;
			justify-content: center;
			padding: 24px 24px;
		}

		.news-card.news-featured .news-title {
			font-size: 18px;
			line-height: 1.4;
		}

		.news-image-wrap {
			display: block;
		}

		.news-image {
			height: 168px;
		}

		.news-tag {
			background: rgba(200, 147, 63, .92);
			letter-spacing: .8px;
		}

		.news-featured .news-tag {
			background: rgba(11, 74, 74, .92);
		}

		.news-body {
			display: flex;
			flex: 1;
			flex-direction: column;
			padding: 18px 20px 20px;
		}

		.news-meta {
			display: flex;
			align-items: center;
			gap: 9px;
			margin-bottom: 9px;
		}

		.news-date,
		.news-readtime {
			display: inline-flex;
			align-items: center;
			gap: 5px;
			margin-bottom: 0;
			color: var(--muted);
			font-size: 10.5px;
			font-weight: 600;
		}

		.news-date i {
			color: var(--gold);
		}

		.news-readtime i {
			color: var(--teal-light);
		}

		.news-dot {
			width: 4px;
			height: 4px;
			border-radius: 50%;
			background: var(--border);
		}

		.news-title {
			min-height: 0;
			margin-bottom: 8px;
			font-size: 14.5px;
			font-weight: 800;
			letter-spacing: -.2px;
		}

		.news-excerpt {
			display: -webkit-box;
			-webkit-line-clamp: 2;
			-webkit-box-orient: vertical;
			overflow: hidden;
			margin-bottom: 12px;
			color: var(--muted);
			font-size: 12.2px;
			line-height: 1.7;
		}

		.news-featured .news-excerpt {
			-webkit-line-clamp: 3;
			font-size: 13px;
		}

		.news-body .news-link {
			margin-top: auto;
		}

		/* -----------------------------------------------------
		   5. AGENDA (linimasa)
		----------------------------------------------------- */
		.agenda-wrapper {
			position: relative;
			height: 100%;
			border-radius: 22px;
			background:
				linear-gradient(180deg, #ffffff 0%, #fdfcf9 100%);
		}

		.agenda-top {
			display: flex;
			align-items: center;
			justify-content: space-between;
			gap: 12px;
			padding: 16px 20px;
			border-bottom: 1px solid var(--border);
			background:
				linear-gradient(120deg, var(--teal-deep), var(--teal));
			border-radius: 22px 22px 0 0;
		}

		.agenda-top-label {
			display: inline-flex;
			align-items: center;
			gap: 8px;
			color: #fff;
			font-size: 11.5px;
			font-weight: 800;
			letter-spacing: .3px;
		}

		.agenda-top-label i {
			color: var(--gold);
		}

		.agenda-top-count {
			padding: 5px 11px;
			border-radius: 30px;
			background: rgba(255, 255, 255, .12);
			color: var(--gold-soft);
			font-size: 10px;
			font-weight: 700;
		}

		.agenda-timeline {
			position: relative;
			padding: 6px 0;
		}

		/* garis linimasa */
		.agenda-timeline::before {
			content: "";
			position: absolute;
			left: 47px;
			top: 18px;
			bottom: 18px;
			width: 2px;
			background:
				linear-gradient(180deg,
					rgba(200, 147, 63, .5),
					rgba(200, 147, 63, .08));
		}

		.agenda-item {
			position: relative;
			display: flex;
			gap: 16px;
			padding: 15px 20px;
			border-bottom: 1px dashed var(--border);
			transition: background .3s ease, transform .3s var(--ease);
		}

		.agenda-item:hover {
			transform: translateX(3px);
		}

		.agenda-item:last-child {
			border-bottom: 0;
		}

		.agenda-date {
			position: relative;
			z-index: 2;
			width: 54px;
			height: 56px;
			flex: 0 0 54px;
			border-radius: 14px;
		}

		.agenda-item.is-today .agenda-date {
			background: linear-gradient(150deg, var(--gold), var(--gold-deep));
			box-shadow: 0 10px 20px rgba(200, 147, 63, .35);
		}

		.agenda-item.is-today .agenda-month {
			color: #fff;
		}

		.agenda-item.is-past .agenda-date {
			background: linear-gradient(150deg, #9aa7a3, #7d8a86);
			box-shadow: none;
		}

		.agenda-content {
			flex: 1;
			min-width: 0;
		}

		.agenda-status {
			display: inline-flex;
			align-items: center;
			gap: 5px;
			margin-bottom: 6px;
			padding: 3px 9px;
			border-radius: 30px;
			background: rgba(11, 74, 74, .08);
			color: var(--teal);
			font-size: 9.5px;
			font-weight: 800;
			letter-spacing: .3px;
			text-transform: uppercase;
		}

		.agenda-item.is-today .agenda-status {
			background: rgba(200, 147, 63, .16);
			color: var(--gold-deep);
		}

		.agenda-item.is-today .agenda-status::before {
			content: "";
			width: 6px;
			height: 6px;
			border-radius: 50%;
			background: var(--gold);
			animation: auraPulse 1.6s ease-in-out infinite;
		}

		.agenda-item.is-past .agenda-status {
			background: rgba(109, 122, 118, .12);
			color: var(--muted);
		}

		.agenda-item.is-past .agenda-title {
			color: var(--muted);
			text-decoration: line-through;
			text-decoration-color: rgba(109, 122, 118, .4);
		}

		.agenda-title {
			margin-bottom: 5px;
			font-size: 13px;
		}

		/* -----------------------------------------------------
		   6. PENCARIAN
		----------------------------------------------------- */
		.search-overlay {
			position: fixed;
			inset: 0;
			z-index: 3100;
			display: flex;
			justify-content: center;
			padding: 14vh 20px 20px;
			background: rgba(4, 26, 26, .55);
			backdrop-filter: blur(8px);
			opacity: 0;
			visibility: hidden;
			transition: opacity .3s ease, visibility .3s ease;
		}

		.search-overlay.show {
			opacity: 1;
			visibility: visible;
		}

		.search-panel {
			width: 100%;
			max-width: 620px;
			max-height: 70vh;
			display: flex;
			flex-direction: column;
			overflow: hidden;
			border-radius: 20px;
			background: #fff;
			box-shadow: 0 34px 80px rgba(0, 0, 0, .35);
			transform: translateY(-18px) scale(.97);
			transition: transform .35s var(--ease);
		}

		.search-overlay.show .search-panel {
			transform: none;
		}

		.search-panel-head {
			display: flex;
			align-items: center;
			gap: 12px;
			padding: 16px 18px;
			border-bottom: 1px solid var(--border);
		}

		.search-panel-head i {
			color: var(--gold);
			font-size: 15px;
		}

		.search-panel-head input {
			flex: 1;
			border: 0;
			outline: 0;
			background: transparent;
			color: var(--text);
			font-family: 'DM Sans', sans-serif;
			font-size: 15px;
			font-weight: 600;
		}

		.search-esc {
			padding: 4px 9px;
			border: 1px solid var(--border);
			border-radius: 7px;
			background: var(--cream);
			color: var(--muted);
			font-size: 9.5px;
			font-weight: 700;
			letter-spacing: .5px;
		}

		.search-results {
			flex: 1;
			overflow-y: auto;
			padding: 8px;
		}

		.search-group-label {
			padding: 10px 12px 6px;
			color: var(--muted);
			font-size: 9.5px;
			font-weight: 800;
			letter-spacing: 1px;
			text-transform: uppercase;
		}

		.search-result {
			display: flex;
			align-items: center;
			gap: 12px;
			width: 100%;
			padding: 11px 12px;
			border: 0;
			border-radius: 12px;
			background: transparent;
			color: var(--text);
			text-align: left;
			cursor: pointer;
			transition: background .2s ease;
		}

		.search-result:hover,
		.search-result.is-active {
			background: var(--cream);
		}

		.search-result-icon {
			width: 34px;
			height: 34px;
			flex: 0 0 34px;
			display: flex;
			align-items: center;
			justify-content: center;
			border-radius: 10px;
			background: var(--gold-soft);
			color: var(--gold-deep);
			font-size: 12px;
		}

		.search-result-text {
			flex: 1;
			min-width: 0;
		}

		.search-result-text strong {
			display: block;
			color: var(--teal);
			font-family: 'Plus Jakarta Sans', sans-serif;
			font-size: 13px;
			font-weight: 700;
			white-space: nowrap;
			overflow: hidden;
			text-overflow: ellipsis;
		}

		.search-result-text span {
			color: var(--muted);
			font-size: 10.5px;
		}

		.search-result mark {
			padding: 0;
			background: rgba(200, 147, 63, .28);
			color: inherit;
			border-radius: 3px;
		}

		.search-result-go {
			color: var(--muted);
			font-size: 10px;
		}

		.search-empty {
			padding: 34px 20px;
			color: var(--muted);
			font-size: 13px;
			text-align: center;
		}

		.search-empty i {
			display: block;
			margin-bottom: 10px;
			color: var(--border);
			font-size: 26px;
		}

		.search-hint {
			padding: 10px 16px;
			border-top: 1px solid var(--border);
			background: var(--cream);
			color: var(--muted);
			font-size: 10px;
			font-weight: 600;
		}

		.search-hint kbd {
			padding: 2px 6px;
			border: 1px solid var(--border);
			border-radius: 5px;
			background: #fff;
			color: var(--teal);
			font-size: 9px;
		}

		/* sorotan pada elemen tujuan pencarian */
		@keyframes searchGlow {

			0%,
			100% {
				box-shadow: 0 0 0 0 rgba(200, 147, 63, 0);
			}

			30% {
				box-shadow: 0 0 0 5px rgba(200, 147, 63, .45);
			}
		}

		.search-target {
			animation: searchGlow 1.6s ease-in-out 2;
			border-radius: 18px;
		}

		/* -----------------------------------------------------
		   7. RESPONSIF
		----------------------------------------------------- */
		@media (max-width: 1199px) {
			.greeting-wrap {
				grid-template-columns: 260px 1fr;
				gap: 34px;
				padding: 34px 32px;
			}
		}

		@media (max-width: 991px) {
			.greeting-wrap {
				grid-template-columns: 1fr;
				gap: 30px;
				padding: 30px 24px;
			}

			.greeting-figure {
				max-width: 280px;
				margin: 0 auto;
			}

			.greeting-photo {
				aspect-ratio: 3 / 3.3;
			}

			.news-card.news-featured {
				flex-direction: column;
			}

			.news-card.news-featured .news-image-wrap {
				flex: none;
				min-height: 0;
			}

			.news-card.news-featured .news-image {
				height: 210px;
				min-height: 0;
			}

			.agenda-wrapper {
				margin-top: 6px;
			}
		}

		@media (max-width: 767px) {
			.section {
				padding: 54px 0;
			}

			.news-stack {
				grid-template-columns: 1fr;
			}

			.gallery-head-side {
				width: 100%;
				justify-content: space-between;
			}

			.lightbox-close {
				top: -48px;
			}

			.lightbox-nav.prev {
				left: 4px;
			}

			.lightbox-nav.next {
				right: 4px;
			}

			.search-overlay {
				padding: 8vh 14px 14px;
			}
		}

		@media (max-width: 575px) {
			.greeting-text {
				padding-left: 14px;
			}

			.greeting-text p:first-child {
				font-size: 15px;
			}

			.agenda-timeline::before {
				left: 43px;
			}
		}

		@media (prefers-reduced-motion: reduce) {

			.gallery-front-item,
			.agenda-item.is-today .agenda-status::before {
				animation: none !important;
			}
		}
	</style>
</head>

<body>
	<!-- =====================================================
	     SCROLL PROGRESS
	===================================================== -->
	<div class="scroll-progress" id="scrollProgress"></div>

	<!-- =====================================================
	     NAVBAR
	===================================================== -->
	<nav class="navbar navbar-expand-lg main-navbar sticky-top" id="mainNavbar">
		<div class="container">
			<a href="<?= site_url(); ?>" class="brand">
				<span class="brand-logo">
					<i class="fa-solid fa-school"></i>
				</span>
				<span>
					<span class="brand-name">
						SMA NEGERI TAWANGMANGU
					</span>
					<span class="brand-subtitle">
						Pendidikan • Karakter • Prestasi
					</span>
				</span>
			</a>

			<button class="navbar-toggler
					   border-0
					   shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavigation">
				<i class="fa-solid fa-bars" style="color:var(--teal);">
				</i>
			</button>

			<div class="collapse navbar-collapse" id="mainNavigation">
				<ul class="navbar-nav
						   nav-center
						   align-items-lg-center">
					<li class="nav-item">
						<a href="#beranda" class="nav-link active">
							Beranda
						</a>
					</li>
					<li class="nav-item dropdown">
						<a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
							Profil Sekolah
						</a>
						<ul class="dropdown-menu
								   border-0
								   shadow-sm">
							<li>
								<a href="#tentang" class="dropdown-item">
									Tentang Sekolah
								</a>
							</li>
							<li>
								<a href="#visi-misi" class="dropdown-item">
									Visi &amp; Misi
								</a>
							</li>
							<li>
								<a href="#double-track" class="dropdown-item">
									Double Track
								</a>
							</li>
						</ul>
					</li>
					<li class="nav-item dropdown">
						<a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
							Kesiswaan
						</a>
						<ul class="dropdown-menu
								   border-0
								   shadow-sm">
							<li>
								<a href="#kompetensi" class="dropdown-item">
									Ekstrakurikuler
								</a>
							</li>
							<li>
								<a href="#agenda" class="dropdown-item">
									Agenda
								</a>
							</li>
						</ul>
					</li>
					<li class="nav-item">
						<a href="<?= site_url('berita'); ?>" class="nav-link">
							Berita
						</a>
					</li>
					<li class="nav-item">
						<a href="#kontak" class="nav-link">
							Kontak
						</a>
					</li>
				</ul>

				<div class="nav-mobile-actions
						   d-lg-none">
					<form class="search-bar" role="search" onsubmit="return false;">
						<input type="search" placeholder="Cari informasi sekolah...">
						<button type="submit">
							<i class="fa-solid
									   fa-magnifying-glass">
							</i>
						</button>
					</form>
					<a href="<?= site_url('admin/auth'); ?>" class="nav-login">
						<i class="fa-solid fa-right-to-bracket me-1"></i> Login
					</a>
					<a href="#informasi-sekolah" class="nav-cta">
						SPMB
					</a>
				</div>
			</div>

			<div class="nav-actions
					   d-none
					   d-lg-flex">
				<form class="search-bar" role="search" onsubmit="return false;">
					<input type="search" placeholder="Cari...">
					<button type="submit">
						<i class="fa-solid
								   fa-magnifying-glass">
						</i>
					</button>
				</form>
				<a href="<?= site_url('admin/auth'); ?>" class="nav-login">
					<i class="fa-solid fa-right-to-bracket me-1"></i> Login
				</a>
				<a href="#informasi-sekolah" class="nav-cta">
					SPMB
				</a>
			</div>
		</div>
	</nav>

	<!-- =====================================================
	     HERO
	===================================================== -->
	<section class="hero-slider" id="beranda">
		<?php foreach ($profil->hero->slides as $index => $slide): ?>
		<div class="hero-slide
					<?= $index === 0 ? 'active' : ''; ?>" data-eyebrow="<?= html_escape($slide->eyebrow); ?>"
			data-title="<?= html_escape($slide->judul); ?>" data-description="<?= html_escape($slide->deskripsi); ?>"
			data-button="<?= html_escape($slide->tombol); ?>" data-link="<?= html_escape($slide->link); ?>" style="
					background-image:
					url('<?= html_escape($slide->gambar); ?>')
				">
		</div>
		<?php endforeach; ?>

		<div class="container
				   h-100
				   position-relative">
			<div class="hero-caption">
				<span class="eyebrow-italic hero-anim d1">
					<?= html_escape($profil->hero->slides[0]->eyebrow); ?>
				</span>
				<h1 class="hero-anim d2">
					<?= html_escape($profil->hero->slides[0]->judul); ?>
				</h1>
				<p class="hero-anim d3">
					Selamat datang di
					<?= html_escape(
						$profil->nama_sekolah
					); ?>
					—
					<?= html_escape($profil->hero->slides[0]->deskripsi); ?>
				</p>
				<a href="<?= html_escape($profil->hero->slides[0]->link); ?>" class="btn-gold hero-link hero-anim d4">
					<?= html_escape($profil->hero->slides[0]->tombol); ?>
					<i class="fa-solid
							   fa-arrow-right
							   ms-2">
					</i>
				</a>
			</div>
		</div>

		<span class="hero-scroll-hint">Scroll</span>

		<button class="slider-arrow slider-prev" aria-label="Sebelumnya">
			<i class="fa-solid fa-chevron-left"></i>
		</button>
		<button class="slider-arrow slider-next" aria-label="Berikutnya">
			<i class="fa-solid fa-chevron-right"></i>
		</button>

		<div class="slider-dots">
			<?php foreach (
				$profil->hero->slides
				as $index => $slide
			): ?>
			<button class="slider-dot
						<?= $index === 0
							? 'active'
							: ''; ?>" data-slide="<?= $index; ?>">
			</button>
			<?php endforeach; ?>
		</div>
	</section>

	<!-- =====================================================
	     STATISTIK
	===================================================== -->
	<section class="stats">
		<div class="container">
			<div class="stats-container">
				<div class="row g-4 g-lg-0">
					<div class="col-6 col-lg-3">
						<div class="stat" data-reveal>
							<div class="stat-icon">
								<i class="fa-solid fa-chalkboard-user"></i>
							</div>
							<div class="stat-number counter" data-count="<?= $guru_count; ?>">
								0+
							</div>
							<div class="stat-label">
								Tenaga Pendidik
							</div>
						</div>
					</div>
					<div class="col-6 col-lg-3">
						<div class="stat" data-reveal>
							<div class="stat-icon">
								<i class="fa-solid fa-trophy"></i>
							</div>
							<div class="stat-number counter" data-count="<?= $prestasi_count; ?>">
								0+
							</div>
							<div class="stat-label">
								Prestasi Sekolah
							</div>
						</div>
					</div>
					<div class="col-6 col-lg-3">
						<div class="stat" data-reveal>
							<div class="stat-icon">
								<i class="fa-solid fa-people-group"></i>
							</div>
							<div class="stat-number counter" data-count="<?= count($ekstrakurikuler); ?>">
								0+
							</div>
							<div class="stat-label">
								Ekstrakurikuler
							</div>
						</div>
					</div>
					<div class="col-6 col-lg-3">
						<div class="stat" data-reveal>
							<div class="stat-icon">
								<i class="fa-solid fa-newspaper"></i>
							</div>
							<div class="stat-number counter" data-count="<?= count($berita); ?>">
								0+
							</div>
							<div class="stat-label">
								Informasi Terbaru
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- =====================================================
	     TENTANG SEKOLAH
	===================================================== -->
	<section class="section" id="tentang">
		<div class="container">
			<div class="text-center mb-5" data-reveal>
				<span class="eyebrow-italic">
					Selamat Datang
				</span>
				<h2 class="section-title">
					Tentang
					<?= html_escape(
						$profil->nama_sekolah
					); ?>
				</h2>
			</div>

			<p class="welcome-lede" data-reveal>
				<?= html_escape(
					$profil->konsep_pendidikan
				); ?>
			</p>

			<!-- =================================================
			     VISI & MISI
			================================================= -->
			<div class="row g-4 align-items-start" id="visi-misi">

				<!-- =================================================
				     VISI
				================================================= -->
				<div class="col-lg-6">
					<div class="vm-card visi" data-reveal="left">
						<span class="vm-accent"></span>
						<span class="vm-watermark">
							<i class="fa-solid fa-earth-asia"></i>
						</span>

						<div class="vision-card-top">
							<span class="vm-label">
								Visi Sekolah
							</span>
							<span class="vision-card-number">
								01
							</span>
						</div>

						<div class="vision-main">
							<div class="vision-icon">
								<i class="fa-solid
										   fa-earth-asia">
								</i>
							</div>
							<div class="vm-statement">
								<h3>
									<?= html_escape(
										$profil->visi['judul']
									); ?>
								</h3>
								<p class="vision-description">
									<?= html_escape(
										$profil->visi['deskripsi']
									); ?>
								</p>
							</div>
						</div>

						<?php
						$vision_icons = array(
							'Wawasan Global'
								=> 'fa-globe',
							'Daya Saing'
								=> 'fa-ranking-star',
							'Potensi Lokal'
								=> 'fa-mountain-sun'
						);
						?>
						<?php if (!empty($profil->visi['fokus'])): ?>
						<div class="vm-list-label">Fokus Utama</div>

						<div class="vision-focus">
							<?php foreach (
								$profil->visi['fokus']
								as $judul_fokus
								=> $isi_fokus
							): ?>
							<div class="vision-focus-item">
								<div class="vision-focus-icon">
									<i class="fa-solid
											<?= isset(
												$vision_icons[
													$judul_fokus
												]
											)
											? $vision_icons[
												$judul_fokus
											]
											: 'fa-star'; ?>">
									</i>
								</div>
								<div class="vision-focus-content">
									<strong>
										<?= html_escape(
												$judul_fokus
											); ?>
									</strong>
									<span>
										<?= html_escape(
												$isi_fokus
											); ?>
									</span>
								</div>
							</div>
							<?php endforeach; ?>
						</div>
						<?php endif; ?>
					</div>
				</div>

				<!-- =================================================
				     MISI
				================================================= -->
				<div class="col-lg-6">
					<div class="vm-card misi" data-reveal="right">
						<span class="vm-accent"></span>
						<span class="vm-watermark">
							<i class="fa-solid fa-bullseye"></i>
						</span>

						<!-- HEADER -->
						<div class="vision-card-top">
							<span class="vm-label">
								Misi Sekolah
							</span>
							<span class="vision-card-number">
								02
							</span>
						</div>

						<!-- MAIN -->
						<div class="vision-main">
							<div class="vision-icon">
								<i class="fa-solid fa-bullseye"></i>
							</div>
							<div class="vm-statement">
								<h3>
									Langkah Menuju Tawangmangu untuk Dunia
								</h3>
								<p class="vision-description">
									Mewujudkan pendidikan yang memadukan
									kemampuan akademik, keterampilan,
									karakter, serta potensi lokal
									Tawangmangu untuk menghadapi masa depan.
								</p>
							</div>
						</div>

						<?php
						/* Hanya merapikan tampilan teks misi:
						   memecah penomoran "1. 2. 3." menjadi daftar
						   dan mengubah **tebal** menjadi cetak tebal. */
						if (!function_exists('misi_format')) {
							function misi_format($teks)
							{
								$aman = html_escape($teks);
								return preg_replace(
									'/\*\*(.+?)\*\*/s',
									'<strong>$1</strong>',
									$aman
								);
							}
						}
						if (!function_exists('misi_pecah')) {
							function misi_pecah($teks)
							{
								$teks = trim((string) $teks);
								$bagian = preg_split(
									'/(?:^|\s)\d{1,2}\.\s+/',
									$teks,
									-1,
									PREG_SPLIT_NO_EMPTY
								);
								if (
									is_array($bagian)
									&& count($bagian) > 1
								) {
									return array_map('trim', $bagian);
								}
								return false;
							}
						}
						?>

						<div class="vm-list-label">Butir Misi</div>

						<!-- MISSION LIST -->
						<div class="mission-list">
							<?php foreach (
								$profil->misi
								as $judul_misi
								=> $isi_misi
							): ?>
							<div class="mission-item">
								<div class="mission-icon">
									<i class="fa-solid fa-check"></i>
								</div>
								<div class="mission-content">
									<strong>
										<?= html_escape(
												$judul_misi
											); ?>
									</strong>
									<?php if (
										is_array($isi_misi)
									): ?>
									<ul>
										<?php foreach (
											$isi_misi
											as $item
										): ?>
										<li>
											<?= misi_format($item); ?>
										</li>
										<?php endforeach; ?>
									</ul>
									<?php else: ?>
									<?php $daftar_misi = misi_pecah($isi_misi); ?>
									<?php if ($daftar_misi !== false): ?>
									<ul>
										<?php foreach (
											$daftar_misi
											as $item
										): ?>
										<li>
											<?= misi_format($item); ?>
										</li>
										<?php endforeach; ?>
									</ul>
									<?php else: ?>
									<p>
										<?= misi_format($isi_misi); ?>
									</p>
									<?php endif; ?>
									<?php endif; ?>
								</div>
							</div>
							<?php endforeach; ?>
						</div>
					</div>
				</div>
			</div>

			<!-- =================================================
			     DOUBLE TRACK
			================================================= -->
			<div class="double-track" id="double-track" data-reveal>
				<div class="double-track-header">
					<div class="double-track-icon">
						<i class="fa-solid
								   fa-code-branch">
						</i>
					</div>
					<div>
						<h3 class="double-track-title">
							Konsep Pendidikan
							<span style="color:var(--gold);">
								Double Track
							</span>
						</h3>
						<p class="double-track-subtitle">
							Memadukan kemampuan akademik
							dengan keterampilan kehidupan
						</p>
					</div>
				</div>

				<div class="double-track-grid">
					<!-- AKADEMIK -->
					<div class="double-track-item">
						<i class="fa-solid
								   fa-graduation-cap">
						</i>
						<h4>
							Jalur Akademik
						</h4>
						<p>
							Fokus pada penguasaan ilmu pengetahuan
							dan penerapan standar kurikulum nasional
							untuk membangun dasar akademik siswa.
						</p>
					</div>
					<!-- LIFE SKILL -->
					<div class="double-track-item">
						<i class="fa-solid
								   fa-lightbulb">
						</i>
						<h4>
							Jalur Keterampilan
							(Life Skill)
						</h4>
						<p>
							Mengembangkan keterampilan berbasis
							potensi lokal Tawangmangu seperti
							tanaman herbal, kuliner, seni budaya,
							dan pariwisata.
						</p>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- =====================================================
	     SAMBUTAN KEPALA SEKOLAH
	     Memakai data yang sudah ada di admin/profil:
	     nama_kepala, foto_kepala, sambutan_kepala.
	===================================================== -->
	<?php
	$nama_kepala = trim((string) ($profil->nama_kepala ?? ''));
	$foto_kepala = trim((string) ($profil->foto_kepala ?? ''));
	$sambutan_kepala = trim((string) ($profil->sambutan_kepala ?? ''));
	$foto_kepala_url = $foto_kepala !== '' ? base_url('assets/img/' . ltrim($foto_kepala, '/')) : '';
	?>
	<?php if ($nama_kepala !== '' || $sambutan_kepala !== ''): ?>
	<section class="section greeting-section" id="sambutan">
		<div class="container">
			<div class="greeting-wrap">

				<!-- FOTO -->
				<div class="greeting-figure" data-reveal="left">
					<div class="greeting-photo">
						<?php if ($foto_kepala !== ''): ?>
						<img src="<?= html_escape($foto_kepala_url); ?>"
							alt="Foto <?= html_escape($nama_kepala ?: 'Kepala Sekolah'); ?>" loading="lazy">
						<?php else: ?>
						<span class="greeting-photo-fallback">
							<i class="fa-solid fa-user-tie"></i>
						</span>
						<?php endif; ?>
						<span class="greeting-photo-ring"></span>
					</div>

					<div class="greeting-name-card">
						<span class="greeting-role">
							<i class="fa-solid fa-user-tie"></i> Kepala Sekolah
						</span>
						<strong class="greeting-name">
							<?= html_escape($nama_kepala ?: 'Kepala Sekolah'); ?>
						</strong>
						<span class="greeting-school">
							<?= html_escape($profil->nama_sekolah); ?>
						</span>
					</div>
				</div>

				<!-- TEKS SAMBUTAN -->
				<div class="greeting-body" data-reveal="right">
					<span class="eyebrow-italic">Kata Sambutan</span>
					<h2 class="section-title">
						Sambutan <span class="title-accent">Kepala Sekolah</span>
					</h2>

					<div class="greeting-text">
						<?php if ($sambutan_kepala !== ''): ?>
						<?php foreach (preg_split('/\R+/', $sambutan_kepala) as $paragraf): ?>
						<?php if (trim($paragraf) !== ''): ?>
						<p><?= html_escape(trim($paragraf)); ?></p>
						<?php endif; ?>
						<?php endforeach; ?>
						<?php else: ?>
						<p>
							Selamat datang di website resmi
							<?= html_escape($profil->nama_sekolah); ?>.
							Semoga kehadiran laman ini dapat menjadi jembatan
							informasi antara sekolah, siswa, orang tua, dan
							masyarakat luas.
						</p>
						<?php endif; ?>
					</div>

					<div class="greeting-sign">
						<span class="greeting-sign-line"></span>
						<div>
							<strong><?= html_escape($nama_kepala ?: 'Kepala Sekolah'); ?></strong>
							<span>Kepala <?= html_escape($profil->nama_sekolah); ?></span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<?php endif; ?>

	<!-- =====================================================
	     EKSTRAKURIKULER
	===================================================== -->
	<section class="section section-soft" id="kompetensi">
		<div class="container">
			<div class="text-center mb-5" data-reveal>
				<span class="eyebrow-italic">
					Pengembangan Diri
				</span>
				<h2 class="section-title">
					Temukan <span class="title-accent">Potensimu</span>
				</h2>
				<p class="section-description mx-auto">
					Beragam kegiatan ekstrakurikuler
					untuk mengembangkan minat,
					bakat, kreativitas, dan kemampuan
					sosial siswa.
				</p>
			</div>

			<?php
			$komp_icon_map = array(
				'futsal'
					=> 'fa-futbol',
				'sepak bola'
					=> 'fa-futbol',
				'basket'
					=> 'fa-basketball',
				'voli'
					=> 'fa-volleyball',
				'badminton'
					=> 'fa-table-tennis-paddle-ball',
				'bulu tangkis'
					=> 'fa-table-tennis-paddle-ball',
				'renang'
					=> 'fa-person-swimming',
				'silat'
					=> 'fa-hand-fist',
				'karate'
					=> 'fa-hand-fist',
				'taekwondo'
					=> 'fa-hand-fist',
				'paskibra'
					=> 'fa-flag',
				'pramuka'
					=> 'fa-campground',
				'pmr'
					=> 'fa-kit-medical',
				'musik'
					=> 'fa-music',
				'band'
					=> 'fa-music',
				'paduan suara'
					=> 'fa-music',
				'tari'
					=> 'fa-person-walking',
				'teater'
					=> 'fa-masks-theater',
				'drama'
					=> 'fa-masks-theater',
				'seni'
					=> 'fa-palette',
				'fotografi'
					=> 'fa-camera',
				'jurnalistik'
					=> 'fa-newspaper',
				'karya ilmiah'
					=> 'fa-flask',
				'robotik'
					=> 'fa-robot',
				'komputer'
					=> 'fa-laptop-code',
				'coding'
					=> 'fa-laptop-code',
				'bahasa'
					=> 'fa-language',
				'inggris'
					=> 'fa-language',
				'debat'
					=> 'fa-comments',
				'rohis'
					=> 'fa-mosque',
				'rokris'
					=> 'fa-cross',
				'keagamaan'
					=> 'fa-place-of-worship',
				'pecinta alam'
					=> 'fa-mountain-sun',
				'catur'
					=> 'fa-chess',
				'osis'
					=> 'fa-users-gear',
				'kuliner'
					=> 'fa-utensils',
				'memasak'
					=> 'fa-utensils',
				'otomotif'
					=> 'fa-car'
			);
			function komp_icon($nama, $map)
			{
				$nama_lower =
					strtolower($nama);
				foreach (
					$map
					as $keyword
					=> $icon
				) {
					if (
						strpos(
							$nama_lower,
							$keyword
						) !== false
					) {
						return $icon;
					}
				}
				return 'fa-star';
			}
			?>

			<div class="komp-grid">
				<?php foreach (
					$ekstrakurikuler
					as $item
				): ?>
				<?php
					if (
						is_array($item)
					) {
						$komp_nama =
							$item['nama']
							?? '';
						$komp_desc =
							$item['deskripsi']
							?? '';
						$komp_foto =
							$item['foto']
							?? '';
					}
					elseif (
						is_object($item)
					) {
						$komp_nama =
							$item->nama
							?? '';
						$komp_desc =
							$item->deskripsi
							?? '';
						$komp_foto =
							$item->foto
							?? '';
					}
					else {
						$komp_nama =
							$item;
						$komp_desc =
							'';
						$komp_foto =
							'';
					}
					$komp_foto_url = trim((string) $komp_foto) !== ''
						? base_url('uploads/ekstrakurikuler/' . rawurlencode(basename($komp_foto)))
						: '';
					?>
				<a href="<?= site_url('ekstrakurikuler'); ?>" class="komp-card" data-reveal="zoom">
					<div class="komp-illustration">
						<div class="komp-shape"></div>
						<?php if ($komp_foto_url !== ''): ?>
						<img class="komp-photo" src="<?= html_escape($komp_foto_url); ?>"
							alt="Foto <?= html_escape($komp_nama); ?>" loading="lazy">
						<?php else: ?>
						<i class="fa-solid
								<?= komp_icon(
									$komp_nama,
									$komp_icon_map
								); ?>">
						</i>
						<?php endif; ?>
					</div>
					<div class="komp-name">
						<?= html_escape(
								$komp_nama
							); ?>
					</div>
					<?php if (
							trim($komp_desc)
							!== ''
						): ?>
					<p class="komp-desc">
						<?= html_escape(
									$komp_desc
								); ?>
					</p>
					<?php endif; ?>
				</a>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<!-- =====================================================
	     INFORMASI SEKOLAH / JELAJAHI SEKOLAH
	===================================================== -->
	<section class="section section-pattern" id="informasi-sekolah">
		<div class="container">
			<div class="text-center mb-5" data-reveal>
				<span class="eyebrow-italic">Pusat Informasi</span>
				<h2 class="section-title">Jelajahi <span class="title-accent">Sekolah</span></h2>
				<p class="section-description mx-auto">Informasi akademik, kegiatan, prestasi, fasilitas, dan layanan
					sekolah dalam satu tempat.</p>
			</div>

			<?php
			/* Hitung jumlah data tiap kategori (tanpa mengubah sistem) */
			function portal_total($data)
			{
				if (
					is_array($data)
					|| $data instanceof Countable
				) {
					return count($data);
				}
				return 0;
			}

			$portal_menu = array(
				array(
					'kelas' => 'is-pengumuman',
					'icon' => 'fa-bullhorn',
					'nama' => 'Pengumuman',
					'url' => site_url('pengumuman'),
					'jumlah' => portal_total($pengumuman)
				),
				array(
					'kelas' => 'is-prestasi',
					'icon' => 'fa-trophy',
					'nama' => 'Prestasi',
					'url' => site_url('prestasi'),
					'jumlah' => portal_total($prestasi)
				),
				array(
					'kelas' => 'is-fasilitas',
					'icon' => 'fa-building',
					'nama' => 'Fasilitas',
					'url' => site_url('fasilitas'),
					'jumlah' => portal_total($fasilitas)
				),
				array(
					'kelas' => 'is-guru',
					'icon' => 'fa-chalkboard-user',
					'nama' => 'Guru & Staff',
					'url' => site_url('guru'),
					'jumlah' => portal_total($guru)
				),
				array(
					'kelas' => 'is-download',
					'icon' => 'fa-file-arrow-down',
					'nama' => 'Download',
					'url' => site_url('download'),
					'jumlah' => portal_total($download)
				),
				array(
					'kelas' => 'is-ppdb',
					'icon' => 'fa-file-signature',
					'nama' => 'PPDB / SPMB',
					'url' => site_url('ppdb'),
					'jumlah' => portal_total($ppdb)
				),
				array(
					'kelas' => 'is-galeri',
					'icon' => 'fa-images',
					'nama' => 'Galeri',
					'url' => site_url('galeri'),
					'jumlah' => portal_total($galeri)
				)
			);
			?>

			<div class="portal-grid">
				<?php foreach ($portal_menu as $menu): ?>
				<a class="portal-card <?= $menu['kelas']; ?>" href="<?= $menu['url']; ?>" data-reveal="zoom">
					<div class="portal-card-icon">
						<i class="fa-solid <?= $menu['icon']; ?>"></i>
					</div>
					<div class="portal-name">
						<?= html_escape($menu['nama']); ?>
					</div>
					<div class="portal-count">
						<?= $menu['jumlah']; ?> data tersedia
					</div>
					<span class="portal-card-footer">
						Lihat Detail <i class="fa-solid fa-arrow-right"></i>
					</span>
				</a>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<!-- =====================================================
	<!-- =====================================================
	     GALERI SEKOLAH
	===================================================== -->
	<section class="section section-soft" id="galeri-sekolah">
		<div class="container">
			<div class="gallery-head" data-reveal>
				<div>
					<span class="eyebrow-italic">Dokumentasi Kegiatan</span>
					<h2 class="section-title mb-0">Galeri <span class="title-accent">Sekolah</span></h2>
					<p class="section-description mb-0">Momen kegiatan belajar, lomba, dan keseharian warga sekolah.
					</p>
				</div>
				<div class="gallery-head-side">
					<span class="gallery-count">
						<i class="fa-solid fa-images"></i>
						<?= is_array($galeri) || $galeri instanceof Countable ? count($galeri) : 0; ?> Foto
					</span>
					<a href="<?= site_url('galeri'); ?>" class="news-link">Lihat semua <i
							class="fa-solid fa-arrow-right ms-1"></i></a>
				</div>
			</div>

			<?php if (!empty($galeri)): ?>
			<!-- penyaring album dibuat otomatis oleh JS dari data-album -->
			<div class="gallery-filter" id="galleryFilter" data-reveal></div>

			<div class="gallery-front-grid" id="galleryGrid">
				<?php foreach ($galeri as $item): ?>
				<?php
					$g_raw = trim((string) ($item->foto ?? $item->gambar ?? ''));
					$g_candidates = array();
					if ($g_raw !== '' && preg_match('~^(https?:)?//~i', $g_raw)) {
						$g_candidates[] = $g_raw;
					} elseif ($g_raw !== '') {
						$g_raw = ltrim(str_replace('\\', '/', $g_raw), '/');
						$g_name = rawurlencode(basename($g_raw));
						if (strpos($g_raw, 'assets/') === 0 || strpos($g_raw, 'uploads/') === 0) {
							$g_candidates[] = base_url($g_raw);
						}
						foreach (array('assets/img/galeri', 'uploads/galeri', 'assets/uploads/galeri', 'assets/img') as $g_folder) {
							$g_candidates[] = base_url($g_folder . '/' . $g_name);
						}
						if (dirname($g_raw) !== '.') {
							$g_candidates[] = base_url('assets/img/' . $g_raw);
							$g_candidates[] = base_url($g_raw);
						}
					}
					$g_candidates = array_values(array_unique(array_filter($g_candidates)));
					$g_foto = $g_candidates ? array_shift($g_candidates) : '';
					$g_fallback = implode('|', $g_candidates);
					$g_judul = $item->judul ?? 'Dokumentasi sekolah';
					$g_album = $item->nama_album ?? 'Kegiatan sekolah';
					?>
				<a class="gallery-front-item<?= $g_foto === '' ? ' is-no-photo' : ''; ?>" href="<?= site_url('galeri'); ?>" data-reveal="zoom"
					data-album="<?= html_escape($g_album); ?>" data-src="<?= $g_foto; ?>"
					data-title="<?= html_escape($g_judul); ?>">
					<?php if ($g_foto !== ''): ?>
					<img src="<?= html_escape($g_foto); ?>" data-fallback="<?= html_escape($g_fallback); ?>"
						alt="<?= html_escape($g_judul); ?>" loading="lazy">
					<?php else: ?><span class="media-fallback"><i class="fa-solid fa-image"></i></span><?php endif; ?>
					<span class="gallery-front-caption">
						<strong><?= html_escape($g_judul); ?></strong>
						<span><?= html_escape($g_album); ?></span>
					</span>
				</a>
				<?php endforeach; ?>
			</div>
			<?php else: ?><div class="empty-data">Belum ada dokumentasi galeri.</div><?php endif; ?>
		</div>
	</section>

	<!-- =====================================================
	     BERITA & AGENDA
	===================================================== -->
	<section class="section" id="berita">
		<div class="container">
			<div class="row g-4 g-xl-5">

				<!-- ============================ BERITA -->
				<div class="col-lg-7">
					<div class="block-head" data-reveal>
						<div>
							<span class="eyebrow-italic">Informasi Sekolah</span>
							<h2 class="section-title mb-0">Berita &amp; Kegiatan</h2>
						</div>
						<a href="<?= site_url('berita'); ?>" class="news-link d-none d-sm-inline-flex">
							Semua berita <i class="fa-solid fa-arrow-right ms-1"></i>
						</a>
					</div>

					<div class="news-stack">
						<?php $berita_index = 0; ?>
						<?php foreach ($berita as $item): ?>
						<?php
							$berita_index++;
							$n_waktu = strtotime($item->tanggal);
							/* Thumbnail admin disimpan sebagai berita/nama-file. */
							$n_media = trim((string) ($item->thumbnail ?? $item->gambar ?? $item->foto ?? ''));
							if ($n_media !== '' && preg_match('~^(https?:)?//~i', $n_media)) {
								$n_gambar = $n_media;
							} elseif ($n_media !== '' && preg_match('~^(assets|uploads)/~i', ltrim($n_media, '/'))) {
								$n_gambar = base_url(ltrim($n_media, '/'));
							} elseif ($n_media !== '') {
								$n_gambar = base_url('assets/img/' . ltrim($n_media, '/'));
							} else {
								$n_gambar = 'https://images.unsplash.com/photo-1509062522246-3755977927d7?auto=format&fit=crop&w=900&q=80';
							}
							/* tautan ke halaman baca: pakai slug bila ada, kalau tidak pakai id */
							$n_kunci = !empty($item->slug) ? $item->slug : (isset($item->id) ? $item->id : '');
							$n_url   = $n_kunci !== ''
								? site_url('berita/detail/' . rawurlencode($n_kunci))
								: site_url('berita');
							?>
						<article class="news-card <?= $berita_index === 1 ? 'news-featured' : ''; ?>" data-reveal>
							<a class="news-image-wrap" href="<?= $n_url; ?>">
								<img class="news-image" src="<?= $n_gambar; ?>"
									alt="<?= html_escape($item->judul); ?>" loading="lazy">
								<span class="news-tag">
									<?= $berita_index === 1 ? 'Terbaru' : 'Berita'; ?>
								</span>
							</a>
							<div class="news-body">
								<div class="news-meta">
									<span class="news-date">
										<i class="fa-regular fa-calendar"></i>
										<?= date('d M Y', $n_waktu); ?>
									</span>
									<span class="news-dot"></span>
									<span class="news-readtime">
										<i class="fa-regular fa-clock"></i> 2 menit baca
									</span>
								</div>
								<h3 class="news-title"><?= html_escape($item->judul); ?></h3>
								<?php if (!empty($item->isi)): ?>
								<p class="news-excerpt">
									<?php
										$n_isi = trim(strip_tags($item->isi));
										$n_isi = function_exists('mb_strimwidth')
											? mb_strimwidth($n_isi, 0, 165, '...')
											: (strlen($n_isi) > 162 ? substr($n_isi, 0, 162) . '...' : $n_isi);
										?>
									<?= html_escape($n_isi); ?>
								</p>
								<?php endif; ?>
								<a href="<?= $n_url; ?>" class="news-link">
									Baca Selengkapnya <i class="fa-solid fa-arrow-right ms-1"></i>
								</a>
							</div>
						</article>
						<?php endforeach; ?>
					</div>
				</div>

				<!-- ============================ AGENDA -->
				<div class="col-lg-5" id="agenda">
					<div class="block-head" data-reveal>
						<div>
							<span class="eyebrow-italic">Kegiatan Mendatang</span>
							<h2 class="section-title mb-0">Agenda Sekolah</h2>
						</div>
					</div>

					<div class="agenda-wrapper" data-reveal="right">
						<div class="agenda-top">
							<span class="agenda-top-label">
								<i class="fa-regular fa-calendar-check"></i> Jadwal Terdekat
							</span>
							<span class="agenda-top-count">
								<?= is_array($agenda) || $agenda instanceof Countable ? count($agenda) : 0; ?> agenda
							</span>
						</div>

						<div class="agenda-timeline">
							<?php foreach ($agenda as $item): ?>
							<?php
								$timestamp = strtotime($item->tanggal);
								$selisih_hari = (int) floor(
									(strtotime(date('Y-m-d', $timestamp)) - strtotime(date('Y-m-d')))
									/ 86400
								);
								if ($selisih_hari < 0) {
									$status_agenda = 'Selesai';
									$kelas_status = 'is-past';
								} elseif ($selisih_hari === 0) {
									$status_agenda = 'Hari ini';
									$kelas_status = 'is-today';
								} elseif ($selisih_hari === 1) {
									$status_agenda = 'Besok';
									$kelas_status = 'is-soon';
								} else {
									$status_agenda = $selisih_hari . ' hari lagi';
									$kelas_status = 'is-soon';
								}
								?>
							<div class="agenda-item <?= $kelas_status; ?>">
								<div class="agenda-date">
									<div class="agenda-day"><?= date('d', $timestamp); ?></div>
									<div class="agenda-month"><?= date('M', $timestamp); ?></div>
								</div>
								<div class="agenda-content">
									<span class="agenda-status"><?= $status_agenda; ?></span>
									<div class="agenda-title"><?= html_escape($item->judul); ?></div>
									<div class="agenda-location">
										<i class="fa-solid fa-location-dot me-1"></i>
										<?= html_escape($item->lokasi); ?>
									</div>
								</div>
							</div>
							<?php endforeach; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- =====================================================
	     BADGE STRIP
	===================================================== -->
	<section class="badge-strip">
		<div class="container">
			<div class="row g-3 text-center">
				<div class="col-6 col-lg-3">
					<div class="badge-item">
						<i class="fa-solid
								   fa-certificate">
						</i>
						Terakreditasi
					</div>
				</div>
				<div class="col-6 col-lg-3">
					<div class="badge-item">
						<i class="fa-solid
								   fa-book-open">
						</i>
						Kurikulum Merdeka
					</div>
				</div>
				<div class="col-6 col-lg-3">
					<div class="badge-item">
						<i class="fa-solid
								   fa-shield-heart">
						</i>
						Sekolah Ramah Anak
					</div>
				</div>
				<div class="col-6 col-lg-3">
					<div class="badge-item">
						<i class="fa-solid
								   fa-people-group">
						</i>
						Mitra Dunia Kerja
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- =====================================================
	     CTA / SPMB
	===================================================== -->
	<section class="cta" id="SPMB">
		<div class="container">
			<h2 class="cta-title" data-reveal>
				Siap Menjadi Bagian
				dari Sekolah Kami?
			</h2>
			<p class="cta-description" data-reveal>
				Kenali lebih dekat lingkungan,
				program, dan berbagai kegiatan
				<?= html_escape(
					$profil->nama_sekolah
				); ?>.
			</p>
			<a href="#kontak" class="btn-gold" data-reveal>
				Hubungi Sekolah
				<i class="fa-solid
						   fa-arrow-right
						   ms-2">
				</i>
			</a>
		</div>
	</section>

	<!-- =====================================================
	     FOOTER
	===================================================== -->
	<footer id="kontak">
		<div class="container">
			<div class="row g-5">
				<!-- BRAND -->
				<div class="col-lg-4">
					<div class="footer-brand">
						<span class="brand-logo">
							<i class="fa-solid
									   fa-school">
							</i>
						</span>
						<div class="footer-title">
							SMA NEGERI<br>
							TAWANGMANGU
						</div>
					</div>
					<p class="footer-text">
						<?= html_escape(
							$profil->nama_sekolah
						); ?>
						berkomitmen menciptakan
						lingkungan pendidikan yang
						mendukung siswa untuk belajar,
						berkembang, dan berprestasi.
					</p>
					<div class="footer-text">
						<strong>NPSN:</strong> <?= html_escape($profil->npsn ?: '-'); ?><br>
						<strong>NSS:</strong> <?= html_escape($profil->nss ?: '-'); ?><br>
						<strong>Kepala Sekolah:</strong> <?= html_escape($profil->nama_kepala ?: '-'); ?>
					</div>
					<div class="socials">
						<a href="#" class="social">
							<i class="fa-brands
									   fa-instagram">
							</i>
						</a>
						<a href="#" class="social">
							<i class="fa-brands
									   fa-facebook-f">
							</i>
						</a>
						<a href="#" class="social">
							<i class="fa-brands
									   fa-youtube">
							</i>
						</a>
						<a href="#" class="social">
							<i class="fa-brands
									   fa-tiktok">
							</i>
						</a>
					</div>
				</div>

				<!-- ALAMAT -->
				<div class="col-lg-4">
					<div class="footer-heading">
						Alamat Sekolah
					</div>
					<div class="footer-block">
						<div class="footer-text mb-1">
							<?= html_escape(
								$profil->alamat
							); ?><br>
							<?= html_escape(trim($profil->desa . ', ' . $profil->kecamatan)); ?><br>
							<?= html_escape(trim($profil->kabupaten . ', ' . $profil->provinsi . ' ' . $profil->kode_pos)); ?>
						</div>
						<div class="footer-text">
							<i class="fa-solid fa-phone me-1"></i> <?= html_escape($profil->telepon ?: '-'); ?><br>
							<i class="fa-solid fa-envelope me-1"></i> <?= html_escape($profil->email ?: '-'); ?>
						</div>
						<?php if (!empty($profil->website)): ?><div class="footer-text"><i
								class="fa-solid fa-globe me-1"></i> <?= html_escape($profil->website); ?></div>
						<?php endif; ?>
					</div>
					<div class="footer-heading">
						Navigasi
					</div>
					<div class="footer-text">
						<a href="#tentang" class="footer-text
								   d-block
								   mb-1">
							Profil Sekolah
						</a>
						<a href="#visi-misi" class="footer-text
								   d-block
								   mb-1">
							Visi &amp; Misi
						</a>
						<a href="#kompetensi" class="footer-text
								   d-block
								   mb-1">
							Ekstrakurikuler
						</a>
						<a href="#berita" class="footer-text
								   d-block">
							Berita
						</a>
					</div>
				</div>

				<!-- MAP -->
				<div class="col-lg-4">
					<div class="footer-heading">
						Lokasi
					</div>
					<iframe class="map-frame" loading="lazy" referrerpolicy="no-referrer-when-downgrade"
						src="https://www.google.com/maps?q=SMA+Negeri+Tawangmangu&output=embed">
					</iframe>
				</div>
			</div>

			<div class="footer-bottom text-center">
				© <?= date('Y'); ?>
				SMA Negeri Tawangmangu.
				All Rights Reserved.
			</div>
		</div>
	</footer>

	<!-- =====================================================
	     BACK TO TOP
	===================================================== -->
	<button class="back-to-top" id="backToTop" aria-label="Kembali ke atas">
		<i class="fa-solid fa-arrow-up"></i>
	</button>

	<!-- =====================================================
	     BOOTSTRAP JS
	===================================================== -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
	</script>

	<script>
		document.addEventListener(
			'DOMContentLoaded',
			function () {
				/* =================================================
				   COUNTER
				================================================= */
				const counters =
					document.querySelectorAll(
						'.counter'
					);
				const animateCounter =
					(el) => {
						const target =
							parseInt(
								el.getAttribute(
									'data-count'
								),
								10
							) || 0;
						let current = 0;
						const step =
							Math.max(
								1,
								Math.ceil(
									target / 40
								)
							);
						const tick = () => {
							current += step;
							el.textContent =
								(
									current >= target ?
									target :
									current
								) + '+';
							if (
								current < target
							) {
								requestAnimationFrame(
									tick
								);
							}
						};
						tick();
					};
				const obs =
					new IntersectionObserver(
						(entries) => {
							entries.forEach(
								(entry) => {
									if (
										entry.isIntersecting
									) {
										animateCounter(
											entry.target
										);
										obs.unobserve(
											entry.target
										);
									}
								}
							);
						}, {
							threshold: .4
						}
					);
				counters.forEach(
					(counter) => {
						obs.observe(
							counter
						);
					}
				);

				/* =================================================
				   SCROLL REVEAL
				================================================= */
				const revealItems =
					document.querySelectorAll(
						'[data-reveal]'
					);
				if ('IntersectionObserver' in window) {
					const revealObserver =
						new IntersectionObserver(
							(entries) => {
								entries.forEach(
									(entry, i) => {
										if (entry.isIntersecting) {
											const el = entry.target;
											const delay =
												Math.min(
													i * 70,
													350
												);
											setTimeout(
												() => {
													el.classList.add(
														'is-visible'
													);
												},
												delay
											);
											revealObserver.unobserve(el);
										}
									}
								);
							}, {
								threshold: .12,
								rootMargin: '0px 0px -40px 0px'
							}
						);
					revealItems.forEach(
						(el) => {
							revealObserver.observe(el);
						}
					);
				} else {
					revealItems.forEach(
						(el) => {
							el.classList.add('is-visible');
						}
					);
				}

				/* =================================================
				   NAVBAR SCROLLED + PROGRESS + BACK TO TOP
				================================================= */
				const navbar =
					document.getElementById(
						'mainNavbar'
					);
				const progress =
					document.getElementById(
						'scrollProgress'
					);
				const backToTop =
					document.getElementById(
						'backToTop'
					);

				const onScroll = () => {
					const y = window.scrollY;
					const docHeight =
						document.documentElement.scrollHeight -
						window.innerHeight;

					if (navbar) {
						navbar.classList.toggle(
							'scrolled',
							y > 40
						);
					}
					if (progress && docHeight > 0) {
						progress.style.width =
							((y / docHeight) * 100) + '%';
					}
					if (backToTop) {
						backToTop.classList.toggle(
							'show',
							y > 420
						);
					}
				};

				window.addEventListener(
					'scroll',
					onScroll, {
						passive: true
					}
				);
				onScroll();

				if (backToTop) {
					backToTop.addEventListener(
						'click',
						() => {
							window.scrollTo({
								top: 0,
								behavior: 'smooth'
							});
						}
					);
				}

				/* =================================================
				   ACTIVE NAV ON SCROLL
				================================================= */
				const sections =
					document.querySelectorAll(
						'section[id]'
					);
				const navLinks =
					document.querySelectorAll(
						'.navbar-nav .nav-link[href^="#"]'
					);
				if (sections.length && navLinks.length) {
					const sectionObserver =
						new IntersectionObserver(
							(entries) => {
								entries.forEach(
									(entry) => {
										if (entry.isIntersecting) {
											const id = entry.target.getAttribute('id');
											navLinks.forEach(
												(link) => {
													link.classList.toggle(
														'active',
														link.getAttribute('href') === '#' + id
													);
												}
											);
										}
									}
								);
							}, {
								threshold: .35
							}
						);
					sections.forEach(
						(sec) => {
							sectionObserver.observe(sec);
						}
					);
				}

				/* =================================================
				   TUTUP MENU MOBILE SETELAH KLIK
				================================================= */
				const navCollapse =
					document.getElementById(
						'mainNavigation'
					);
				if (navCollapse) {
					navCollapse
						.querySelectorAll('a[href^="#"]')
						.forEach(
							(link) => {
								link.addEventListener(
									'click',
									() => {
										if (
											window.innerWidth < 992 &&
											navCollapse.classList.contains('show')
										) {
											const instance =
												bootstrap.Collapse.getInstance(
													navCollapse
												) ||
												new bootstrap.Collapse(
													navCollapse, {
														toggle: false
													}
												);
											instance.hide();
										}
									}
								);
							}
						);
				}

				/* =================================================
				   HERO SLIDER
				================================================= */
				const slides =
					document.querySelectorAll(
						'.hero-slide'
					);
				const dots =
					document.querySelectorAll(
						'.slider-dot'
					);
				let current = 0;
				let timer;

				const restartHeroAnim = () => {
					document
						.querySelectorAll('.hero-anim')
						.forEach(
							(el) => {
								el.style.animation = 'none';
								/* paksa reflow */
								void el.offsetWidth;
								el.style.animation = '';
							}
						);
				};

				const goTo =
					(index) => {
						if (!slides.length) {
							return;
						}
						slides[current]
							.classList
							.remove(
								'active'
							);
						if (dots[current]) {
							dots[current]
								.classList
								.remove(
									'active'
								);
						}
						current =
							(
								index +
								slides.length
							) %
							slides.length;
						slides[current]
							.classList
							.add(
								'active'
							);
						if (dots[current]) {
							dots[current]
								.classList
								.add(
									'active'
								);
						}
						const slide = slides[current];
						document.querySelector('.hero-caption .eyebrow-italic').textContent = slide.dataset.eyebrow;
						document.querySelector('.hero-caption h1').textContent = slide.dataset.title;
						document.querySelector('.hero-caption p').textContent =
							'Selamat datang di <?= html_escape($profil->nama_sekolah); ?> - ' + slide.dataset.description;
						document.querySelector('.hero-link').href = slide.dataset.link;
						document.querySelector('.hero-link').firstChild.textContent = slide.dataset.button;
						restartHeroAnim();
					};

				const startAutoplay =
					() => {
						clearInterval(
							timer
						);
						if (
							slides.length > 1
						) {
							timer =
								setInterval(
									() => {
										goTo(
											current + 1
										);
									},
									5000
								);
						}
					};

				const nextButton =
					document.querySelector(
						'.slider-next'
					);
				const prevButton =
					document.querySelector(
						'.slider-prev'
					);
				if (nextButton) {
					nextButton.addEventListener(
						'click',
						() => {
							goTo(
								current + 1
							);
							startAutoplay();
						}
					);
				}
				if (prevButton) {
					prevButton.addEventListener(
						'click',
						() => {
							goTo(
								current - 1
							);
							startAutoplay();
						}
					);
				}
				dots.forEach(
					(dot, index) => {
						dot.addEventListener(
							'click',
							() => {
								goTo(
									index
								);
								startAutoplay();
							}
						);
					}
				);

				/* geser hero dengan keyboard */
				document.addEventListener(
					'keydown',
					(e) => {
						if (e.key === 'ArrowRight') {
							goTo(current + 1);
							startAutoplay();
						}
						if (e.key === 'ArrowLeft') {
							goTo(current - 1);
							startAutoplay();
						}
					}
				);

				startAutoplay();
			}
		);
	</script>

	<!-- =====================================================
	     PANEL PENCARIAN
	===================================================== -->
	<div class="search-overlay" id="searchOverlay" role="dialog" aria-modal="true" aria-label="Pencarian">
		<div class="search-panel">
			<div class="search-panel-head">
				<i class="fa-solid fa-magnifying-glass"></i>
				<input type="search" id="searchInput" placeholder="Cari berita, ekstrakurikuler, agenda, halaman..."
					autocomplete="off">
				<span class="search-esc">ESC</span>
			</div>
			<div class="search-results" id="searchResults"></div>
			<div class="search-hint">
				<kbd>↑</kbd> <kbd>↓</kbd> pilih &nbsp;·&nbsp; <kbd>Enter</kbd> buka &nbsp;·&nbsp;
				<kbd>Esc</kbd> tutup
			</div>
		</div>
	</div>

	<!-- =====================================================
	     LIGHTBOX GALERI
	===================================================== -->
	<div class="lightbox" id="galleryLightbox" role="dialog" aria-modal="true" aria-label="Pratinjau foto">
		<div class="lightbox-inner">
			<button class="lightbox-close" type="button" aria-label="Tutup">
				<i class="fa-solid fa-xmark"></i>
			</button>
			<button class="lightbox-nav prev" type="button" aria-label="Foto sebelumnya">
				<i class="fa-solid fa-chevron-left"></i>
			</button>
			<button class="lightbox-nav next" type="button" aria-label="Foto berikutnya">
				<i class="fa-solid fa-chevron-right"></i>
			</button>
			<img id="lightboxImage" src="" alt="">
			<div class="lightbox-caption" id="lightboxCaption"></div>
		</div>
	</div>

	<!-- =====================================================
	     PENCARIAN · FILTER GALERI · LIGHTBOX
	===================================================== -->
	<script>
		document.addEventListener('DOMContentLoaded', function () {

			/* =================================================
			   A. PENCARIAN SITUS
			================================================= */
			const overlay = document.getElementById('searchOverlay');
			const input = document.getElementById('searchInput');
			const resultBox = document.getElementById('searchResults');

			/* --- susun indeks pencarian dari isi halaman --- */
			const buildIndex = () => {
				const data = [];
				const push = (judul, kategori, ikon, target, href) => {
					const teks = (judul || '').replace(/\s+/g, ' ').trim();
					if (!teks) return;
					data.push({
						judul: teks,
						kategori: kategori,
						ikon: ikon,
						target: target || null,
						href: href || null
					});
				};

				/* halaman / bagian dari menu navigasi */
				document.querySelectorAll('.navbar-nav a[href^="#"]').forEach((a) => {
					const id = a.getAttribute('href').slice(1);
					const el = document.getElementById(id);
					if (el) push(a.textContent, 'Halaman', 'fa-compass', el, null);
				});

				/* kartu Jelajahi Sekolah */
				document.querySelectorAll('.portal-card').forEach((card) => {
					const nama = card.querySelector('.portal-name');
					if (nama) push(nama.textContent, 'Informasi Sekolah', 'fa-folder-open', card, card.getAttribute('href'));
				});

				/* ekstrakurikuler */
				document.querySelectorAll('.komp-card').forEach((card) => {
					const nama = card.querySelector('.komp-name');
					if (nama) push(nama.textContent, 'Ekstrakurikuler', 'fa-star', card, null);
				});

				/* berita */
				document.querySelectorAll('.news-card').forEach((card) => {
					const judul = card.querySelector('.news-title');
					if (judul) push(judul.textContent, 'Berita', 'fa-newspaper', card, null);
				});

				/* agenda */
				document.querySelectorAll('.agenda-item').forEach((item) => {
					const judul = item.querySelector('.agenda-title');
					if (judul) push(judul.textContent, 'Agenda', 'fa-calendar-day', item, null);
				});

				/* galeri */
				document.querySelectorAll('.gallery-front-item').forEach((item) => {
					push(item.dataset.title, 'Galeri', 'fa-image', item, null);
				});

				/* butir visi & misi */
				document.querySelectorAll('.vision-focus-content strong, .mission-content strong').forEach((el) => {
					push(el.textContent, 'Visi & Misi', 'fa-bullseye', el.closest('.vm-card'), null);
				});

				/* sambutan kepala sekolah */
				const sambutan = document.getElementById('sambutan');
				if (sambutan) {
					const nama = sambutan.querySelector('.greeting-name');
					push('Sambutan Kepala Sekolah', 'Profil', 'fa-user-tie', sambutan, null);
					if (nama) push(nama.textContent, 'Kepala Sekolah', 'fa-user-tie', sambutan, null);
				}

				return data;
			};

			let indeks = [];
			let hasilAktif = [];
			let posisi = -1;

			const escapeHtml = (t) => t.replace(/[&<>"']/g, (c) => ({
				'&': '&amp;',
				'<': '&lt;',
				'>': '&gt;',
				'"': '&quot;',
				"'": '&#39;'
			}[c]));

			const sorot = (teks, kata) => {
				const aman = escapeHtml(teks);
				if (!kata) return aman;
				const pola = kata.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
				return aman.replace(new RegExp('(' + pola + ')', 'ig'), '<mark>$1</mark>');
			};

			const gambarHasil = (kata) => {
				const kunci = kata.trim().toLowerCase();

				if (!kunci) {
					hasilAktif = indeks.slice(0, 6);
					resultBox.innerHTML =
						'<div class="search-group-label">Saran pencarian</div>' +
						hasilAktif.map((d, i) => kartuHasil(d, i, '')).join('');
					posisi = -1;
					return;
				}

				hasilAktif = indeks
					.filter((d) => d.judul.toLowerCase().includes(kunci))
					.slice(0, 14);

				if (!hasilAktif.length) {
					resultBox.innerHTML =
						'<div class="search-empty">' +
						'<i class="fa-solid fa-magnifying-glass-minus"></i>' +
						'Tidak ada hasil untuk "' + escapeHtml(kata) + '"' +
						'</div>';
					posisi = -1;
					return;
				}

				resultBox.innerHTML =
					'<div class="search-group-label">' + hasilAktif.length + ' hasil ditemukan</div>' +
					hasilAktif.map((d, i) => kartuHasil(d, i, kata)).join('');
				posisi = 0;
				tandaiAktif();
			};

			const kartuHasil = (d, i, kata) =>
				'<button type="button" class="search-result" data-index="' + i + '">' +
				'<span class="search-result-icon"><i class="fa-solid ' + d.ikon + '"></i></span>' +
				'<span class="search-result-text">' +
				'<strong>' + sorot(d.judul, kata) + '</strong>' +
				'<span>' + d.kategori + '</span>' +
				'</span>' +
				'<span class="search-result-go"><i class="fa-solid fa-arrow-right"></i></span>' +
				'</button>';

			const tandaiAktif = () => {
				resultBox.querySelectorAll('.search-result').forEach((el, i) => {
					el.classList.toggle('is-active', i === posisi);
					if (i === posisi) el.scrollIntoView({ block: 'nearest' });
				});
			};

			const bukaPencarian = () => {
				indeks = buildIndex();
				overlay.classList.add('show');
				document.body.style.overflow = 'hidden';
				gambarHasil('');
				setTimeout(() => input.focus(), 120);
			};

			const tutupPencarian = () => {
				overlay.classList.remove('show');
				document.body.style.overflow = '';
				input.value = '';
			};

			const bukaHasil = (d) => {
				if (!d) return;
				if (d.href && d.href !== '#') {
					window.location.href = d.href;
					return;
				}
				tutupPencarian();
				const el = d.target;
				if (!el) return;
				setTimeout(() => {
					/* tinggi navbar lengket + sedikit jarak nafas */
					const nav = document.getElementById('mainNavbar');
					const tinggiNav = nav ? nav.offsetHeight : 78;
					const jarak = tinggiNav + 24;

					const kotak = el.getBoundingClientRect();
					const tinggiLayar = window.innerHeight - jarak;
					let tujuan;

					if (kotak.height >= tinggiLayar) {
						/* elemen tinggi (mis. satu section penuh):
						   sejajarkan bagian atasnya di bawah navbar */
						tujuan = window.scrollY + kotak.top - jarak;
					} else {
						/* elemen pendek: taruh di tengah ruang yang tersisa */
						tujuan = window.scrollY + kotak.top - jarak -
							((tinggiLayar - kotak.height) / 2);
					}

					window.scrollTo({
						top: Math.max(0, Math.round(tujuan)),
						behavior: 'smooth'
					});

					el.classList.add('search-target');
					setTimeout(() => el.classList.remove('search-target'), 3400);
				}, 220);
			};

			/* --- hubungkan semua form pencarian di navbar --- */
			document.querySelectorAll('.search-bar').forEach((form) => {
				form.addEventListener('submit', (e) => {
					e.preventDefault();
					const isi = form.querySelector('input');
					bukaPencarian();
					if (isi && isi.value.trim()) {
						input.value = isi.value;
						gambarHasil(input.value);
						isi.value = '';
					}
				});
				const isi = form.querySelector('input');
				if (isi) {
					isi.addEventListener('focus', () => {
						if (window.innerWidth >= 992) bukaPencarian();
					});
				}
				const tombol = form.querySelector('button');
				if (tombol) {
					tombol.addEventListener('click', (e) => {
						e.preventDefault();
						bukaPencarian();
					});
				}
			});

			if (overlay && input && resultBox) {
				input.addEventListener('input', () => gambarHasil(input.value));

				resultBox.addEventListener('click', (e) => {
					const tombol = e.target.closest('.search-result');
					if (!tombol) return;
					bukaHasil(hasilAktif[parseInt(tombol.dataset.index, 10)]);
				});

				overlay.addEventListener('click', (e) => {
					if (e.target === overlay) tutupPencarian();
				});

				document.querySelector('.search-esc').addEventListener('click', tutupPencarian);

				document.addEventListener('keydown', (e) => {
					/* pintasan Ctrl/Cmd + K */
					if ((e.ctrlKey || e.metaKey) && e.key.toLowerCase() === 'k') {
						e.preventDefault();
						overlay.classList.contains('show') ? tutupPencarian() : bukaPencarian();
						return;
					}
					if (!overlay.classList.contains('show')) return;

					if (e.key === 'Escape') {
						tutupPencarian();
					} else if (e.key === 'ArrowDown') {
						e.preventDefault();
						if (hasilAktif.length) {
							posisi = (posisi + 1) % hasilAktif.length;
							tandaiAktif();
						}
					} else if (e.key === 'ArrowUp') {
						e.preventDefault();
						if (hasilAktif.length) {
							posisi = (posisi - 1 + hasilAktif.length) % hasilAktif.length;
							tandaiAktif();
						}
					} else if (e.key === 'Enter') {
						e.preventDefault();
						bukaHasil(hasilAktif[posisi >= 0 ? posisi : 0]);
					}
				});
			}

			/* =================================================
			   B. FILTER ALBUM GALERI
			================================================= */
			const grid = document.getElementById('galleryGrid');
			const filterBox = document.getElementById('galleryFilter');

			if (grid && filterBox) {
				const kartu = Array.from(grid.querySelectorAll('.gallery-front-item'));
				const album = Array.from(
					new Set(kartu.map((k) => (k.dataset.album || '').trim()).filter(Boolean))
				);

				if (album.length > 1) {
					const daftar = ['Semua'].concat(album);
					filterBox.innerHTML = daftar
						.map((a, i) =>
							'<button type="button" class="gallery-chip' + (i === 0 ? ' active' : '') +
							'" data-album="' + (i === 0 ? '*' : a.replace(/"/g, '&quot;')) + '">' +
							a + '</button>'
						).join('');

					filterBox.addEventListener('click', (e) => {
						const chip = e.target.closest('.gallery-chip');
						if (!chip) return;
						filterBox.querySelectorAll('.gallery-chip')
							.forEach((c) => c.classList.toggle('active', c === chip));

						const pilih = chip.dataset.album;
						kartu.forEach((k) => {
							const cocok = pilih === '*' || (k.dataset.album || '').trim() === pilih;
							k.classList.toggle('is-hidden', !cocok);
							if (cocok) {
								k.style.animation = 'none';
								void k.offsetWidth;
								k.style.animation = '';
							}
						});
					});
				} else {
					filterBox.remove();
				}

				/* =============================================
				   C. LIGHTBOX GALERI
				============================================= */
				const lb = document.getElementById('galleryLightbox');
				const lbImg = document.getElementById('lightboxImage');
				const lbCap = document.getElementById('lightboxCaption');
				let indexAktif = 0;

				const tampilkan = (i) => {
					const daftar = kartu.filter((k) => !k.classList.contains('is-hidden'));
					if (!daftar.length) return;
					indexAktif = (i + daftar.length) % daftar.length;
					const k = daftar[indexAktif];
					lbImg.onerror = () => {
						const fallback = (lbImg.dataset.fallback || '').split('|').filter(Boolean);
						const next = fallback.shift();
						if (next) {
							lbImg.dataset.fallback = fallback.join('|');
							lbImg.src = next;
						} else {
							lbImg.removeAttribute('src');
						}
					};
					lbImg.dataset.fallback = '';
					lbImg.src = k.dataset.src || '';
					lbImg.alt = k.dataset.title || '';
					lbCap.innerHTML =
						escapeHtml(k.dataset.title || 'Dokumentasi sekolah') +
						'<span>' + escapeHtml(k.dataset.album || '') + '</span>';
				};

				kartu.forEach((k) => {
					k.addEventListener('click', (e) => {
						e.preventDefault();
						const daftar = kartu.filter((x) => !x.classList.contains('is-hidden'));
						tampilkan(daftar.indexOf(k));
						lb.classList.add('show');
						document.body.style.overflow = 'hidden';
					});
				});

				const tutupLb = () => {
					lb.classList.remove('show');
					document.body.style.overflow = '';
				};

				lb.querySelector('.lightbox-close').addEventListener('click', tutupLb);
				lb.querySelector('.lightbox-nav.prev').addEventListener('click', () => tampilkan(indexAktif - 1));
				lb.querySelector('.lightbox-nav.next').addEventListener('click', () => tampilkan(indexAktif + 1));
				lb.addEventListener('click', (e) => {
					if (e.target === lb) tutupLb();
				});

				document.addEventListener('keydown', (e) => {
					if (!lb.classList.contains('show')) return;
					if (e.key === 'Escape') tutupLb();
					if (e.key === 'ArrowRight') tampilkan(indexAktif + 1);
					if (e.key === 'ArrowLeft') tampilkan(indexAktif - 1);
				});
			}
		});
	</script>
</body>

</html>