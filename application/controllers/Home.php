<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    class Home extends CI_Controller
    {
            public function __construct()
            {
                parent::__construct();
                $this->load->database();
                $this->load->helper(array('url', 'text'));
            }

        public function index()
        {
                $profil = $this->db->table_exists('profil') ? $this->db->get('profil')->row() : NULL;
                $nama_sekolah = $profil && !empty($profil->nama_sekolah) ? $profil->nama_sekolah : 'SMA Negeri Tawangmangu';

                $data = array(
                    'judul' => 'Beranda',
                    'profil' => $this->normalise_profil($profil, $nama_sekolah),
                    'guru_count' => $this->count_table('guru'),
                    'prestasi_count' => $this->count_table('prestasi'),
                    'berita' => $this->rows('berita', 'tanggal', 4),
                    'agenda' => $this->rows('agenda', 'tanggal', 4, TRUE),
                    'ekstrakurikuler' => $this->rows('ekstrakurikuler', 'id', 12),
                    'pengumuman' => $this->published_rows('pengumuman', 'id', 6, 'publish'),
                    'fasilitas' => $this->rows('fasilitas', 'id', 8),
                    'prestasi' => $this->rows('prestasi', 'tanggal', 6),
                    'guru' => $this->rows('guru', 'id', 8),
                    'download' => $this->rows('download', 'id', 6),
                    'ppdb' => $this->rows('ppdb', 'id', 3),
                    'galeri' => $this->gallery_rows(),
                    'carousel' => $this->carousel_rows()
                );
            $this->load->view('home', $data);
        }

            private function count_table($table)
            {
                return $this->db->table_exists($table) ? (int) $this->db->count_all($table) : 0;
            }

            private function rows($table, $order_by = 'id', $limit = 0, $future_only = FALSE)
            {
                if (!$this->db->table_exists($table)) {
                    return array();
                }

                if ($future_only && $this->db->field_exists('tanggal', $table)) {
                    $this->db->where('tanggal >=', date('Y-m-d'));
                }

                $query = $this->db->order_by($order_by, 'DESC');
                if ($limit > 0) {
                    $query->limit($limit);
                }

                return $query->get($table)->result();
            }

            private function published_rows($table, $order_by = 'id', $limit = 0, $status = 'publish')
            {
                if (!$this->db->table_exists($table) || !$this->db->field_exists('status', $table)) {
                    return array();
                }

                $query = $this->db->where('status', $status)->order_by($order_by, 'DESC');
                if ($limit > 0) {
                    $query->limit($limit);
                }

                return $query->get($table)->result();
            }

            private function carousel_rows()
            {
                if (!$this->db->table_exists('carousel')) {
                    return array();
                }

                return $this->db->where('status', 'aktif')
                    ->order_by('urutan', 'ASC')
                    ->order_by('id', 'DESC')
                    ->get('carousel')
                    ->result();
            }

            private function gallery_rows()
            {
                if (!$this->db->table_exists('galeri')) {
                    return array();
                }

                return $this->db->select('galeri.*, album_galeri.nama_album')
                    ->from('galeri')
                    ->join('album_galeri', 'album_galeri.id = galeri.album_id', 'left')
                    ->order_by('galeri.id', 'DESC')
                    ->limit(8)
                    ->get()
                    ->result();
            }

            private function normalise_profil($profil, $nama_sekolah)
            {
                $visi_judul = 'Tawangmangu untuk Dunia';
                $visi_deskripsi = 'Mewujudkan peserta didik yang memiliki wawasan global, mampu berkolaborasi, berdaya saing, serta tetap berpijak pada potensi lokal.';
                $misi = array(
                    'Membangun karakter berintegritas dan tangguh' => 'Mendorong kejujuran, kemandirian, tanggung jawab, kreativitas, serta semangat kompetitif.'
                );

                if ($profil) {
                    $visi_text = trim((string) ($profil->visi ?? ''));
                    if ($visi_text !== '') {
                        $visi_deskripsi = $visi_text;
                    }

                    $misi_text = trim((string) ($profil->misi ?? ''));
                    if ($misi_text !== '') {
                        $misi = array('Misi Sekolah' => $misi_text);
                    }
                }

                $carousel = $this->carousel_rows();
                $slides = array();
                if ($carousel) {
                    foreach ($carousel as $item) {
                        $slides[] = (object) array(
                            'gambar' => base_url('assets/img/' . ltrim($item->gambar, '/')),
                            'eyebrow' => 'Informasi Sekolah',
                            'judul' => $item->judul,
                            'deskripsi' => $item->deskripsi,
                            'tombol' => $item->tombol ?: 'Jelajahi Sekolah',
                            'link' => $item->link ?: '#tentang'
                        );
                    }
                } else {
                    $slides = array(
                        (object) array('gambar' => 'https://images.unsplash.com/photo-1562774053-701939374585?auto=format&fit=crop&w=1800&q=85', 'eyebrow' => 'Sekolah untuk masa depan', 'judul' => 'Mewujudkan Pelajar yang Berprestasi dan Berkarakter', 'deskripsi' => 'Tempat belajar, berkembang, dan menemukan potensi diri untuk menghadapi masa depan.', 'tombol' => 'Jelajahi Sekolah', 'link' => '#tentang'),
                        (object) array('gambar' => 'https://images.unsplash.com/photo-1523050854058-8df90110c9f1?auto=format&fit=crop&w=1800&q=85', 'eyebrow' => 'Pendidikan berkarakter', 'judul' => 'Tumbuh Bersama dalam Lingkungan yang Positif', 'deskripsi' => 'Membangun kemampuan akademik, karakter, dan keterampilan peserta didik.', 'tombol' => 'Tentang Sekolah', 'link' => '#tentang'),
                        (object) array('gambar' => 'https://images.unsplash.com/photo-1509062522246-3755977927d7?auto=format&fit=crop&w=1800&q=85', 'eyebrow' => 'Potensi lokal untuk dunia', 'judul' => 'Belajar, Berkarya, dan Berprestasi', 'deskripsi' => 'Mengembangkan potensi siswa melalui pengalaman belajar yang bermakna.', 'tombol' => 'Lihat Informasi', 'link' => '#informasi-sekolah')
                    );
                }

                return (object) array(
                    'nama_sekolah' => $nama_sekolah,
                    'alamat' => $profil && !empty($profil->alamat) ? $profil->alamat : 'Tawangmangu, Karanganyar, Jawa Tengah',
                    'npsn' => $profil->npsn ?? '',
                    'nss' => $profil->nss ?? '',
                    'telepon' => $profil->telepon ?? '',
                    'email' => $profil->email ?? '',
                    'website' => $profil->website ?? '',
                    'desa' => $profil->desa ?? '',
                    'kecamatan' => $profil->kecamatan ?? '',
                    'kabupaten' => $profil->kabupaten ?? '',
                    'provinsi' => $profil->provinsi ?? '',
                    'kode_pos' => $profil->kode_pos ?? '',
                    'latitude' => $profil->latitude ?? '',
                    'longitude' => $profil->longitude ?? '',
                    'nama_kepala' => $profil->nama_kepala ?? '',
                    'foto_kepala' => $profil->foto_kepala ?? '',
                    'sambutan_kepala' => $profil->sambutan_kepala ?? '',
                    'hero' => (object) array(
                        'eyebrow' => 'Sekolah untuk masa depan',
                        'judul' => 'Mewujudkan Pelajar yang Berprestasi dan Berkarakter',
                        'deskripsi' => 'Tempat belajar, berkembang, dan menemukan potensi diri untuk menghadapi masa depan.',
                        'tombol' => 'Jelajahi Sekolah',
                        'gambar' => array_map(function ($slide) { return $slide->gambar; }, $slides),
                        'slides' => $slides
                    ),
                    'visi' => array('judul' => $visi_judul, 'deskripsi' => $visi_deskripsi, 'fokus' => array()),
                    'konsep_pendidikan' => $profil && !empty($profil->sejarah) ? $profil->sejarah : 'SMA Negeri Tawangmangu memadukan pendidikan akademik, karakter, keterampilan, dan potensi lokal untuk menyiapkan masa depan peserta didik.',
                    'misi' => $misi
                );
            }
        private function profil_dummy()
        {
            return (object) array(
                'nama_sekolah' => 'SMA Negeri Tawangmangu',
                'alamat' => 'Tawangmangu, Karanganyar, Jawa Tengah',
                'hero' => (object) array(
                    'eyebrow' => 'Sekolah untuk masa depan',
                    'judul' => 'Mewujudkan Pelajar yang Berprestasi dan Berkarakter',
                    'deskripsi' =>
                        'Tempat belajar, berkembang, dan menemukan potensi diri untuk menghadapi masa depan.',
                    'tombol' => 'Jelajahi Sekolah',
                    'gambar' => array(
                        'https://images.unsplash.com/photo-1562774053-701939374585?auto=format&fit=crop&w=1800&q=85',
                        'https://images.unsplash.com/photo-1523050854058-8df90110c9f1?auto=format&fit=crop&w=1800&q=85',
                        'https://images.unsplash.com/photo-1509062522246-3755977927d7?auto=format&fit=crop&w=1800&q=85'
                    )
                ),
                'visi' => array(
                    'judul' =>
                        'Tawangmangu untuk Dunia',
                    'deskripsi' =>
                        'Mewujudkan peserta didik yang memiliki wawasan global, mampu berkolaborasi secara internasional, memiliki daya saing, serta tetap berpijak pada potensi dan kearifan lokal Tawangmangu.',
                    'fokus' => array(
                        'Wawasan Global' =>
                            'Mempersiapkan siswa agar memiliki wawasan luas dan mampu beradaptasi dengan perkembangan dunia.',
                        'Daya Saing' =>
                            'Membentuk peserta didik yang kompeten, percaya diri, kreatif, dan siap menghadapi masa depan.',
                        'Potensi Lokal' =>
                            'Mengangkat kekayaan Tawangmangu seperti pariwisata, seni budaya, kuliner, dan tanaman obat ke tingkat yang lebih luas.'
                    )
                ),
                'konsep_pendidikan' =>
                    'SMA Negeri Tawangmangu menerapkan konsep sekolah futuristik melalui sistem Double Track yang memadukan jalur akademik dengan keterampilan Life Skill berbasis potensi lokal Tawangmangu.',
                'misi' => array(
                    'Menyelenggarakan Pendidikan Berbasis Double Track' =>
                        'Mengintegrasikan kurikulum akademik nasional dengan pendidikan keterampilan (Life Skill) untuk mempersiapkan siswa menghadapi masa depan.',
                    'Mengangkat Potensi Lokal ke Kancah Global' => array(
                        'Tanaman obat dan herbal',
                        'Kuliner khas Tawangmangu',
                        'Seni dan budaya lokal',
                        'Kepariwisataan'
                    ),
                    'Membangun Karakter Berintegritas dan Tangguh' =>
                        'Mendorong kejujuran, kemandirian, tanggung jawab, kreativitas, serta semangat kompetitif bagi seluruh peserta didik.',
                    'Menciptakan Lingkungan Belajar Modern dan Terbuka' =>
                        'Mengoptimalkan fasilitas futuristik, teknologi, serta pembelajaran luar ruang (outdoor learning) yang interaktif dan menyenangkan.'
                )
            );
        }
        private function berita_dummy()
        {
            return array(
                (object) array(
                    'judul' => 'Menyambut Tahun Ajaran dengan Semangat Baru',
                    'tanggal' => '2026-09-03'
                ),
                (object) array(
                    'judul' => 'Siswa SMA Negeri Tawangmangu Raih Prestasi',
                    'tanggal' => '2026-09-01'
                ),
                (object) array(
                    'judul' => 'Kegiatan Sekolah Bulan September',
                    'tanggal' => '2026-08-28'
                )
            );
        }
        private function agenda_dummy()
        {
            return array(
                (object) array(
                    'judul' => 'Upacara Bendera',
                    'tanggal' => '2026-09-14',
                    'lokasi' => 'Lapangan Sekolah'
                ),
                (object) array(
                    'judul' => 'Pekan Kegiatan Ekstrakurikuler',
                    'tanggal' => '2026-09-18',
                    'lokasi' => 'Lingkungan Sekolah'
                )
            );
        }
    }
?>
