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
					<i class="fa-solid fa-calendar-plus"></i>
				</div>
				<div>
					<span class="badge-header-tag mb-1">
						<i class="fa-solid fa-plus me-1"></i> Form Input
					</span>
					<h2 class="page-title">Tambah Agenda</h2>
					<p class="page-subtitle">Tambahkan kegiatan baru ke agenda sekolah.</p>
				</div>
			</div>
			<a href="<?= site_url('admin/agenda'); ?>" class="btn-back">
				<i class="fa-solid fa-arrow-left me-2"></i>
				Kembali
			</a>
		</div>

		<!-- 3. FORM -->
		<?php $this->load->view('admin/agenda/_form', [
			'item'         => null,
			'form_action'  => site_url('admin/agenda/simpan'),
			'submit_label' => 'Simpan Agenda',
		]); ?>

	</div>
</div>

<?php $this->load->view('admin/agenda/_assets', ['assets_form' => true]); ?>

<?php $this->load->view('admin/template/footer'); ?>