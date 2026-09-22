<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Berita
 *
 * Dua halaman publik:
 *   /berita             → daftar berita
 *   /berita/detail/xxx  → satu berita, "xxx" boleh slug maupun id
 *
 * Kalau Anda sudah punya controller Berita sendiri, jangan timpa filenya.
 * Salin saja method detail() dan helper profil() ke controller yang ada.
 */
class Berita extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->helper(array('url', 'text'));
	}

	/* ------------------------------------------------------------------ */

	public function index()
	{
		$this->load->view('public/list', array(
			'title'   => 'Berita sekolah',
			'heading' => 'Berita sekolah',
			'type'    => 'berita',
			'items'   => $this->semua(30),
			'profil'  => $this->profil(),
		));
	}

	/**
	 * Halaman baca.
	 *
	 * @param string $kunci slug berita, atau id bila tabel belum punya slug
	 */
	public function detail($kunci = NULL)
	{
		$item = $this->satu($kunci);

		if (!$item) {
			show_404();
			return;
		}

		$id = isset($item->id) ? $item->id : NULL;

		$this->load->view('public/detail', array(
			'title'   => isset($item->judul) ? $item->judul : 'Berita sekolah',
			'item'    => $item,
			'lainnya' => $this->lainnya($id, 3),
			'profil'  => $this->profil(),
		));
	}

	/**
	 * Alias supaya tautan lama /berita/baca/xxx tetap hidup.
	 */
	public function baca($kunci = NULL)
	{
		$this->detail($kunci);
	}

	/* ------------------------------------------------------------------ */

	private function terbit()
	{
		if ($this->db->field_exists('status', 'berita')) {
			$this->db->where_in('status', array('publish', 'published', 'aktif', 'terbit', '1', 1));
		} elseif ($this->db->field_exists('is_publish', 'berita')) {
			$this->db->where('is_publish', 1);
		}
	}

	private function urutan()
	{
		foreach (array('tanggal', 'created_at', 'tgl', 'tanggal_publish', 'id') as $kolom) {
			if ($this->db->field_exists($kolom, 'berita')) {
				return $kolom;
			}
		}
		return 'id';
	}

	private function semua($limit = NULL)
	{
		if (!$this->db->table_exists('berita')) {
			return array();
		}

		$this->terbit();
		$this->db->order_by($this->urutan(), 'DESC');
		if ($limit !== NULL) {
			$this->db->limit((int) $limit);
		}
		return $this->db->get('berita')->result();
	}

	private function satu($kunci)
	{
		$kunci = trim((string) $kunci);
		if ($kunci === '' || !$this->db->table_exists('berita')) {
			return NULL;
		}

		if ($this->db->field_exists('slug', 'berita')) {
			$this->db->where('slug', $kunci);
			$this->terbit();
			$item = $this->db->get('berita')->row();
			if ($item) {
				return $item;
			}
		}

		if (ctype_digit($kunci) && $this->db->field_exists('id', 'berita')) {
			$this->db->where('id', (int) $kunci);
			$this->terbit();
			return $this->db->get('berita')->row();
		}

		return NULL;
	}

	private function lainnya($kecuali, $limit = 3)
	{
		if (!$this->db->table_exists('berita')) {
			return array();
		}

		$this->terbit();
		if ($this->db->field_exists('id', 'berita') && $kecuali !== NULL && $kecuali !== '') {
			$this->db->where('id !=', $kecuali);
		}
		$this->db->order_by($this->urutan(), 'DESC')->limit((int) $limit);
		return $this->db->get('berita')->result();
	}

	/**
	 * Profil sekolah dipakai footer untuk alamat dan kontak.
	 * Dibungkus pengecekan supaya tidak menggagalkan halaman kalau
	 * tabelnya belum ada.
	 */
	protected function profil()
	{
		$this->load->database();
		if (!$this->db->table_exists('profil')) {
			return NULL;
		}
		return $this->db->get('profil')->row();
	}
}