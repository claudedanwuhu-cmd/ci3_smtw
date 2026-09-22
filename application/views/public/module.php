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
	/* ----------------------------------------------------------------------
	   Halaman daftar untuk controller yang mengirim $module.
	   Bentuk kartunya ditentukan sepenuhnya oleh public/_ui.php, jadi tiap
	   modul tampil dengan bahasa visualnya sendiri tanpa cabang if di sini.
	   Blok ini berada setelah _ui dimuat karena memakai fungsinya.
	   ---------------------------------------------------------------------- */
	$modul  = sk_module(isset($module) ? $module : (isset($type) ? $type : ''));
	$meta   = sk_meta($modul);
	$items  = isset($items) && is_array($items) ? $items : array();
	$judul  = isset($heading) && trim((string) $heading) !== ''
		? $heading
		: (isset($title) && trim((string) $title) !== '' ? $title : $meta[0]);
	$profil = isset($profil) ? $profil : NULL;
	$cream  = in_array($modul, array('galeri', 'prestasi', 'ekstrakurikuler'), TRUE);
	?>

	<title><?= html_escape(isset($title) ? $title : $judul); ?> &middot; SMA Negeri Tawangmangu</title>
	<meta name="description" content="<?= html_escape($meta[2]); ?>">
</head>

<body>
	<div class="scroll-progress"></div>

	<?php sk_nav($modul); ?>

	<?php sk_hero(array(
		'judul'   => $judul,
		'eyebrow' => $meta[1],
		'teks'    => $meta[2],
		'jumlah'  => count($items),
		'satuan'  => $meta[3],
	)); ?>

	<main class="page-body<?= $cream ? ' page-body--cream' : ''; ?>">
		<div class="shell">
			<?php sk_cards($items, $modul, $judul); ?>
		</div>
	</main>

	<?php sk_footer($profil); ?>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
