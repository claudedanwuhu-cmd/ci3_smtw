<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->database();
        $this->load->helper('url');
    }

    public function index()
    {
        $data['title'] = 'Dashboard';

        $data['jumlah_guru'] = $this->safe_count('guru');
        $data['jumlah_berita'] = $this->safe_count('berita');
        $data['jumlah_pengumuman'] = $this->safe_count('pengumuman');
        $data['jumlah_agenda'] = $this->safe_count('agenda');
        $data['jumlah_prestasi'] = $this->safe_count('prestasi');
        $data['jumlah_ekstrakurikuler'] = $this->safe_count('ekstrakurikuler');
        $data['jumlah_galeri'] = $this->safe_count('galeri');
        $data['jumlah_download'] = $this->safe_count('download');
        $data['jumlah_fasilitas'] = $this->safe_count('fasilitas');

        $data['berita_terbaru'] = $this->db->table_exists('berita')
            ? $this->db->order_by('id', 'DESC')->limit(5)->get('berita')->result()
            : array();

        $data['agenda_terbaru'] = $this->db->table_exists('agenda')
            ? $this->db->where('tanggal >=', date('Y-m-d'))->order_by('tanggal', 'ASC')->limit(5)->get('agenda')->result()
            : array();

        $this->load->view('admin/dashboard', $data);
    }

    private function safe_count($table)
    {
        return $this->db->table_exists($table) ? $this->db->count_all($table) : 0;
    }
}
