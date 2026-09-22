<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Publicsite extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper(array('url', 'text'));
    }

    public function profil()
    {
        $profil = $this->db->table_exists('profil') ? $this->db->get('profil')->row() : NULL;
        $this->render('Profil Sekolah', 'profil', $profil ? array($profil) : array());
    }

    public function berita()
    {
        $this->render('Berita Sekolah', 'berita', $this->rows('berita', 'tanggal'));
    }

    public function berita_detail($slug)
    {
        $item = $this->db->table_exists('berita') ? $this->db->where('slug', $slug)->get('berita')->row() : NULL;
        if (!$item) {
            show_404();
        }

        $this->render($item->judul, 'berita', array($item));
    }

    public function module($module)
    {
        $allowed = array('guru', 'prestasi', 'pengumuman', 'agenda', 'ekstrakurikuler', 'fasilitas', 'galeri', 'download', 'ppdb');
        if (!in_array($module, $allowed, TRUE)) {
            show_404();
        }

        $table = $module === 'galeri' ? 'galeri' : $module;
        $items = $module === 'pengumuman'
            ? $this->published_rows($table, 'id', 'publish')
            : $this->rows($table, 'id');

        $this->render(ucwords(str_replace('_', ' ', $module)), $module, $items);
    }

    private function rows($table, $order_by = 'id')
    {
        if (!$this->db->table_exists($table)) {
            return array();
        }

        return $this->db->order_by($order_by, 'DESC')->get($table)->result();
    }

    private function published_rows($table, $order_by = 'id', $status = 'publish')
    {
        if (!$this->db->table_exists($table) || !$this->db->field_exists('status', $table)) {
            return array();
        }

        return $this->db->where('status', $status)->order_by($order_by, 'DESC')->get($table)->result();
    }

    private function render($title, $module, $items)
    {
        $this->load->view('public/module', array(
            'title' => $title,
            'module' => $module,
            'items' => $items
        ));
    }
}