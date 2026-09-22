<?php $this->load->view('admin/template/header'); ?>
<?php $this->load->view('admin/template/sidebar'); ?>

<div class="main-content">
    <?php $this->load->view('admin/template/navbar'); ?>

    <div class="content-wrapper guide-page">
        <section class="guide-hero">
            <div class="guide-hero-noise"></div>
            <div class="guide-hero-content">
                <span class="guide-eyebrow"><i class="fa-solid fa-compass"></i> Control room sekolah</span>
                <h2>Website sekolah, <em>naik kelas.</em></h2>
                <p>Semua yang perlu kamu tahu untuk mengisi, merapikan, dan menerbitkan informasi SMA Negeri Tawangmangu dengan percaya diri.</p>
                <div class="guide-hero-actions">
                    <a href="#alur" class="guide-primary-btn"><i class="fa-solid fa-play"></i> Mulai dari alur kerja</a>
                    <a href="<?= site_url('admin/dashboard'); ?>" class="guide-ghost-btn"><i class="fa-solid fa-arrow-left"></i> Kembali ke dashboard</a>
                </div>
            </div>
            <div class="guide-hero-art" aria-hidden="true">
                <div class="art-ring ring-one"></div>
                <div class="art-ring ring-two"></div>
                <div class="art-screen"><i class="fa-solid fa-school"></i><span>READY TO PUBLISH</span></div>
                <i class="fa-solid fa-star art-star star-one"></i>
                <i class="fa-solid fa-bolt art-star star-two"></i>
            </div>
        </section>

        <div class="guide-layout">
            <aside class="guide-nav">
                <span class="guide-nav-label">Di halaman ini</span>
                <a class="guide-nav-link is-current" href="#mulai"><span>01</span> Mulai di sini</a>
                <a class="guide-nav-link" href="#modul"><span>02</span> Peta modul</a>
                <a class="guide-nav-link" href="#alur"><span>03</span> Alur publikasi</a>
                <a class="guide-nav-link" href="#checklist"><span>04</span> Checklist cepat</a>
                <div class="guide-nav-tip"><i class="fa-solid fa-lightbulb"></i><strong>Tip hari ini</strong><p>Isi judul yang singkat dan jelas. Judul yang baik membuat pengunjung langsung tahu isi halaman.</p></div>
            </aside>

            <main class="guide-main">
                <section id="mulai" class="guide-section intro-section">
                    <div class="section-heading"><span class="section-number">01</span><div><span class="section-kicker">Orientasi</span><h3>Mulai dari tiga kebiasaan kecil</h3></div></div>
                    <div class="habit-grid">
                        <article class="habit-card"><div class="habit-icon blue"><i class="fa-solid fa-eye"></i></div><span>01 / Cek tampilan</span><h4>Lihat dari sisi pengunjung</h4><p>Setelah menyimpan data, buka halaman publik untuk memastikan tulisan, gambar, dan tautannya tampil rapi.</p></article>
                        <article class="habit-card"><div class="habit-icon orange"><i class="fa-solid fa-pen-to-square"></i></div><span>02 / Tulis terarah</span><h4>Satu halaman, satu pesan</h4><p>Gunakan judul yang spesifik, paragraf pendek, dan gambar yang benar-benar membantu pembaca.</p></article>
                        <article class="habit-card"><div class="habit-icon green"><i class="fa-solid fa-cloud-arrow-up"></i></div><span>03 / Simpan aman</span><h4>Publikasikan dengan teliti</h4><p>Pastikan status, tanggal, dan kategori sudah benar sebelum konten menjadi konsumsi publik.</p></article>
                    </div>
                </section>

                <section id="modul" class="guide-section">
                    <div class="section-heading"><span class="section-number">02</span><div><span class="section-kicker">Peta kendali</span><h3>Kenali semua ruang kerja</h3></div></div>
                    <p class="section-lead">Setiap menu punya tugasnya sendiri. Pilih satu kartu untuk langsung masuk ke modul yang ingin kamu kelola.</p>
                    <div class="module-grid">
                        <a href="<?= site_url('admin/berita'); ?>" class="module-card module-blue"><div class="module-card-top"><i class="fa-solid fa-newspaper"></i><span>Konten</span></div><h4>Berita</h4><p>Ceritakan kegiatan dan kabar terbaru sekolah.</p><small>Tambah artikel <i class="fa-solid fa-arrow-right"></i></small></a>
                        <a href="<?= site_url('admin/pengumuman'); ?>" class="module-card module-orange"><div class="module-card-top"><i class="fa-solid fa-bullhorn"></i><span>Konten</span></div><h4>Pengumuman</h4><p>Sampaikan informasi penting yang perlu segera diketahui.</p><small>Kelola informasi <i class="fa-solid fa-arrow-right"></i></small></a>
                        <a href="<?= site_url('admin/agenda'); ?>" class="module-card module-green"><div class="module-card-top"><i class="fa-solid fa-calendar-days"></i><span>Aktivitas</span></div><h4>Agenda</h4><p>Atur jadwal kegiatan agar tidak terlewat.</p><small>Atur jadwal <i class="fa-solid fa-arrow-right"></i></small></a>
                        <a href="<?= site_url('admin/galeri'); ?>" class="module-card module-pink"><div class="module-card-top"><i class="fa-solid fa-images"></i><span>Media</span></div><h4>Galeri</h4><p>Susun album foto yang membuat cerita lebih hidup.</p><small>Kelola album <i class="fa-solid fa-arrow-right"></i></small></a>
                        <a href="<?= site_url('admin/profil'); ?>" class="module-card module-purple"><div class="module-card-top"><i class="fa-solid fa-school"></i><span>Identitas</span></div><h4>Profil Sekolah</h4><p>Rawat informasi utama dan wajah sekolah.</p><small>Edit profil <i class="fa-solid fa-arrow-right"></i></small></a>
                        <a href="<?= site_url('admin/guru'); ?>" class="module-card module-cyan"><div class="module-card-top"><i class="fa-solid fa-chalkboard-user"></i><span>Data</span></div><h4>Guru & Staff</h4><p>Perbarui data pendidik dan tenaga kependidikan.</p><small>Kelola data <i class="fa-solid fa-arrow-right"></i></small></a>
                        <a href="<?= site_url('admin/download'); ?>" class="module-card module-red"><div class="module-card-top"><i class="fa-solid fa-download"></i><span>Layanan</span></div><h4>Download</h4><p>Sediakan dokumen resmi yang mudah diakses.</p><small>Tambah berkas <i class="fa-solid fa-arrow-right"></i></small></a>
                        <a href="<?= site_url('admin/ppdb'); ?>" class="module-card module-yellow"><div class="module-card-top"><i class="fa-solid fa-file-signature"></i><span>Layanan</span></div><h4>PPDB</h4><p>Kelola informasi penerimaan peserta didik baru.</p><small>Atur PPDB <i class="fa-solid fa-arrow-right"></i></small></a>
                    </div>
                </section>

                <section id="alur" class="guide-section flow-section">
                    <div class="section-heading"><span class="section-number">03</span><div><span class="section-kicker">Formula publikasi</span><h3>Alur kerja tanpa drama</h3></div></div>
                    <div class="flow-track">
                        <div class="flow-step"><span class="flow-step-no">1</span><div><strong>Pilih modul</strong><p>Tentukan apakah kontenmu berita, pengumuman, agenda, atau media.</p></div></div>
                        <div class="flow-step"><span class="flow-step-no">2</span><div><strong>Isi informasi inti</strong><p>Lengkapi judul, isi, tanggal, gambar, dan kolom wajib lainnya.</p></div></div>
                        <div class="flow-step"><span class="flow-step-no">3</span><div><strong>Periksa ulang</strong><p>Baca lagi dari atas. Rapikan typo dan pastikan gambar tidak pecah.</p></div></div>
                        <div class="flow-step"><span class="flow-step-no">4</span><div><strong>Simpan & pantau</strong><p>Simpan perubahan, lalu cek halaman publik untuk validasi akhir.</p></div></div>
                    </div>
                    <div class="flow-callout"><i class="fa-solid fa-shield-heart"></i><div><strong>Golden rule</strong><p>Kalau informasi menyangkut tanggal atau pendaftaran, tulis tanggal dan batas waktunya secara eksplisit.</p></div></div>
                </section>

                <section id="checklist" class="guide-section checklist-section">
                    <div class="section-heading"><span class="section-number">04</span><div><span class="section-kicker">Sebelum klik simpan</span><h3>Checklist publikasi</h3></div></div>
                    <div class="checklist-grid">
                        <div class="checklist-panel"><div class="checklist-panel-title"><i class="fa-solid fa-spell-check"></i><span>Teks & struktur</span></div><label><input type="checkbox"> Judul langsung menjelaskan isi</label><label><input type="checkbox"> Tidak ada typo atau kalimat menggantung</label><label><input type="checkbox"> Paragraf tidak terlalu panjang</label><label><input type="checkbox"> Tanggal dan lokasi sudah sesuai</label></div>
                        <div class="checklist-panel"><div class="checklist-panel-title"><i class="fa-solid fa-image"></i><span>Visual & tautan</span></div><label><input type="checkbox"> Gambar relevan dan tidak pecah</label><label><input type="checkbox"> Nama file mudah dikenali</label><label><input type="checkbox"> Tautan bisa dibuka</label><label><input type="checkbox"> Sudah cek tampilan mobile</label></div>
                    </div>
                </section>

                <section class="guide-finale"><div class="finale-mark"><i class="fa-solid fa-rocket"></i></div><div><span class="section-kicker">Kamu sudah siap</span><h3>Bangun website yang terasa hidup.</h3><p>Konten yang konsisten membuat sekolah terlihat aktif, terbuka, dan dekat dengan komunitasnya.</p></div><a href="<?= site_url('admin/dashboard'); ?>" class="guide-primary-btn">Mulai mengelola <i class="fa-solid fa-arrow-right"></i></a></section>
            </main>
        </div>
    </div>
</div>

<style>
.guide-page { --guide-ink: #102a43; --guide-muted: #627d98; --guide-line: #d9e2ec; --guide-paper: #ffffff; --guide-bg: #f5f8fb; color: var(--guide-ink); }
[data-theme="dark"] .guide-page, body.dark-mode .guide-page { --guide-ink: #f1f5f9; --guide-muted: #9fb3c8; --guide-line: rgba(148,163,184,.18); --guide-paper: #101b31; --guide-bg: #081121; }
.guide-hero { position: relative; min-height: 330px; overflow: hidden; display: flex; align-items: center; padding: 46px 52px; margin-bottom: 30px; border-radius: 26px; color: #fff; background: #0b3954; box-shadow: 0 20px 42px rgba(11,57,84,.22); }
.guide-hero:before { content: ''; position: absolute; inset: 0; background: radial-gradient(circle at 80% 15%, rgba(0,180,216,.7), transparent 35%), linear-gradient(125deg, #0b3954, #071e35 72%); }
.guide-hero-noise { position: absolute; inset: 0; opacity: .2; background-image: linear-gradient(135deg, rgba(255,255,255,.08) 25%, transparent 25%, transparent 50%, rgba(255,255,255,.08) 50%, rgba(255,255,255,.08) 75%, transparent 75%); background-size: 32px 32px; }
.guide-hero-content { position: relative; z-index: 2; max-width: 640px; }
.guide-eyebrow, .section-kicker { display: block; color: #38bdf8; font-size: 10px; font-weight: 800; letter-spacing: 1.8px; text-transform: uppercase; }
.guide-eyebrow { display: inline-flex; gap: 8px; align-items: center; padding: 7px 11px; margin-bottom: 18px; color: #cffafe; border: 1px solid rgba(165,243,252,.25); border-radius: 99px; background: rgba(8,145,178,.16); }
.guide-hero h2 { max-width: 560px; margin: 0 0 12px; font-size: clamp(30px, 4vw, 52px); line-height: 1.04; letter-spacing: -1.8px; font-weight: 800; }
.guide-hero h2 em { color: #67e8f9; font-style: normal; }
.guide-hero p { max-width: 540px; margin: 0; color: #c5d7e8; font-size: 14px; line-height: 1.7; }
.guide-hero-actions { display: flex; flex-wrap: wrap; gap: 10px; margin-top: 26px; }
.guide-primary-btn, .guide-ghost-btn { display: inline-flex; align-items: center; gap: 9px; padding: 11px 16px; border-radius: 11px; font-size: 12px; font-weight: 800; text-decoration: none; transition: transform .2s ease, background .2s ease; }
.guide-primary-btn { color: #073b4c; background: #a5f3fc; }
.guide-primary-btn:hover { color: #073b4c; background: #cffafe; transform: translateY(-2px); }
.guide-ghost-btn { color: #d8f3fa; border: 1px solid rgba(255,255,255,.22); }
.guide-ghost-btn:hover { color: #fff; background: rgba(255,255,255,.1); transform: translateY(-2px); }
.guide-hero-art { position: absolute; z-index: 1; right: 7%; width: 230px; height: 230px; }
.art-ring { position: absolute; border: 1px solid rgba(103,232,249,.25); border-radius: 50%; }
.ring-one { inset: 0; animation: guideSpin 16s linear infinite; }.ring-two { inset: 28px; border-style: dashed; animation: guideSpin 11s linear infinite reverse; }
.art-screen { position: absolute; inset: 64px 40px; display: flex; align-items: center; justify-content: center; flex-direction: column; gap: 7px; color: #a5f3fc; border: 1px solid rgba(165,243,252,.4); border-radius: 18px; background: rgba(4,27,48,.65); box-shadow: 0 0 30px rgba(34,211,238,.16); transform: rotate(7deg); }
.art-screen i { font-size: 32px; }.art-screen span { font-size: 8px; font-weight: 800; letter-spacing: 1px; }.art-star { position: absolute; color: #fcd34d; }.star-one { top: 20px; right: 8px; }.star-two { bottom: 22px; left: 8px; color: #fda4af; }
@keyframes guideSpin { to { transform: rotate(360deg); } }
.guide-layout { display: grid; grid-template-columns: 190px minmax(0, 1fr); gap: 36px; align-items: start; }
.guide-nav { position: sticky; top: 24px; }.guide-nav-label { display: block; margin: 0 0 12px 13px; color: var(--guide-muted); font-size: 10px; font-weight: 800; letter-spacing: 1.4px; text-transform: uppercase; }
.guide-nav-link { display: flex; align-items: center; gap: 10px; padding: 10px 12px; margin-bottom: 3px; color: var(--guide-muted); border-left: 2px solid transparent; font-size: 12px; font-weight: 700; text-decoration: none; }.guide-nav-link span { color: #9fb3c8; font-size: 10px; }.guide-nav-link:hover, .guide-nav-link.is-current { color: #0284c7; border-left-color: #06b6d4; background: rgba(6,182,212,.06); }.guide-nav-tip { padding: 16px; margin-top: 24px; color: #7c2d12; border-radius: 15px; background: #ffedd5; }.guide-nav-tip i { color: #ea580c; }.guide-nav-tip strong { display: block; margin: 8px 0 4px; font-size: 11px; }.guide-nav-tip p { margin: 0; font-size: 10px; line-height: 1.6; }
.guide-section { padding: 4px 0 44px; scroll-margin-top: 25px; }.section-heading { display: flex; align-items: flex-start; gap: 14px; margin-bottom: 22px; }.section-number { color: #06b6d4; font-size: 11px; font-weight: 800; letter-spacing: 1px; }.section-heading h3 { margin: 5px 0 0; color: var(--guide-ink); font-size: 24px; font-weight: 800; letter-spacing: -.6px; }.section-lead { max-width: 620px; margin: -8px 0 22px; color: var(--guide-muted); font-size: 13px; line-height: 1.7; }
.habit-grid, .module-grid, .checklist-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 13px; }.habit-card, .module-card, .checklist-panel { padding: 20px; color: var(--guide-ink); border: 1px solid var(--guide-line); border-radius: 16px; background: var(--guide-paper); box-shadow: 0 8px 24px rgba(15,23,42,.035); }.habit-card { min-height: 200px; }.habit-icon { display: grid; place-items: center; width: 39px; height: 39px; margin-bottom: 17px; border-radius: 12px; font-size: 15px; }.habit-icon.blue { color: #0284c7; background: #e0f2fe; }.habit-icon.orange { color: #ea580c; background: #ffedd5; }.habit-icon.green { color: #059669; background: #d1fae5; }.habit-card span { color: var(--guide-muted); font-size: 9px; font-weight: 800; letter-spacing: 1px; text-transform: uppercase; }.habit-card h4, .module-card h4 { margin: 8px 0 7px; font-size: 15px; font-weight: 800; }.habit-card p, .module-card p { margin: 0; color: var(--guide-muted); font-size: 11px; line-height: 1.65; }
.module-grid { grid-template-columns: repeat(4, 1fr); }.module-card { display: block; min-height: 190px; text-decoration: none; transition: transform .2s ease, border-color .2s ease, box-shadow .2s ease; }.module-card:hover { color: var(--guide-ink); border-color: #67e8f9; box-shadow: 0 12px 24px rgba(8,145,178,.1); transform: translateY(-4px); }.module-card-top { display: flex; align-items: center; justify-content: space-between; margin-bottom: 18px; }.module-card-top i { font-size: 18px; }.module-card-top span { padding: 4px 7px; border-radius: 6px; color: var(--guide-muted); background: var(--guide-bg); font-size: 8px; font-weight: 800; text-transform: uppercase; }.module-card small { display: block; margin-top: 17px; color: #0284c7; font-size: 10px; font-weight: 800; }.module-card small i { margin-left: 5px; transition: margin .2s ease; }.module-card:hover small i { margin-left: 9px; }.module-blue .module-card-top i { color: #2563eb; }.module-orange .module-card-top i { color: #ea580c; }.module-green .module-card-top i { color: #059669; }.module-pink .module-card-top i { color: #db2777; }.module-purple .module-card-top i { color: #9333ea; }.module-cyan .module-card-top i { color: #0891b2; }.module-red .module-card-top i { color: #e11d48; }.module-yellow .module-card-top i { color: #ca8a04; }
.flow-section { padding-top: 6px; }.flow-track { position: relative; display: grid; grid-template-columns: repeat(4,1fr); gap: 13px; }.flow-track:before { content: ''; position: absolute; top: 20px; left: 7%; right: 7%; border-top: 1px dashed #67e8f9; opacity: .5; }.flow-step { position: relative; z-index: 1; }.flow-step-no { display: grid; place-items: center; width: 40px; height: 40px; margin-bottom: 15px; color: #fff; border: 5px solid var(--guide-bg); border-radius: 50%; background: #0891b2; font-size: 12px; font-weight: 800; }.flow-step strong { font-size: 13px; }.flow-step p { margin: 7px 0 0; color: var(--guide-muted); font-size: 11px; line-height: 1.6; }.flow-callout { display: flex; gap: 13px; align-items: center; padding: 14px 17px; margin-top: 24px; color: #075985; border: 1px solid #bae6fd; border-radius: 13px; background: #f0f9ff; }.flow-callout i { font-size: 20px; }.flow-callout strong { font-size: 11px; }.flow-callout p { margin: 3px 0 0; font-size: 11px; }
.checklist-grid { grid-template-columns: repeat(2, 1fr); }.checklist-panel-title { display: flex; align-items: center; gap: 9px; padding-bottom: 14px; margin-bottom: 4px; border-bottom: 1px solid var(--guide-line); font-size: 13px; font-weight: 800; }.checklist-panel-title i { color: #0891b2; }.checklist-panel label { display: flex; align-items: center; gap: 9px; padding-top: 13px; color: var(--guide-muted); font-size: 11px; cursor: pointer; }.checklist-panel input { width: 15px; height: 15px; accent-color: #0891b2; }.checklist-panel input:checked + * { text-decoration: line-through; }.guide-finale { display: flex; align-items: center; gap: 17px; padding: 22px; margin-bottom: 20px; border-radius: 18px; background: linear-gradient(110deg, #0e7490, #164e63); color: #fff; }.finale-mark { display: grid; place-items: center; width: 45px; height: 45px; flex: 0 0 45px; border-radius: 14px; color: #164e63; background: #a5f3fc; font-size: 18px; }.guide-finale h3 { margin: 4px 0 4px; color: #fff; font-size: 17px; }.guide-finale p { margin: 0; color: #c5f6fa; font-size: 11px; }.guide-finale .guide-primary-btn { margin-left: auto; white-space: nowrap; }
@media (max-width: 1100px) { .guide-hero-art { right: 2%; opacity: .55; }.module-grid { grid-template-columns: repeat(3,1fr); } }. 
@media (max-width: 800px) { .guide-layout { display: block; }.guide-nav { position: static; display: flex; gap: 5px; overflow-x: auto; padding-bottom: 18px; margin-bottom: 10px; }.guide-nav-label, .guide-nav-tip { display: none; }.guide-nav-link { flex: 0 0 auto; border: 1px solid var(--guide-line); border-radius: 8px; }.guide-nav-link.is-current { border-color: #06b6d4; }.habit-grid, .module-grid { grid-template-columns: repeat(2,1fr); }.guide-hero { padding: 34px 28px; }.guide-hero-art { display: none; } }. 
@media (max-width: 575px) { .habit-grid, .module-grid, .checklist-grid, .flow-track { grid-template-columns: 1fr; }.guide-hero h2 { font-size: 34px; }.guide-hero { min-height: auto; }.guide-finale { align-items: flex-start; flex-wrap: wrap; }.guide-finale .guide-primary-btn { margin-left: 62px; } }
</style>
<script>
document.querySelectorAll('.guide-nav-link').forEach(function (link) {
    link.addEventListener('click', function () {
        document.querySelectorAll('.guide-nav-link').forEach(function (item) { item.classList.remove('is-current'); });
        link.classList.add('is-current');
    });
});
</script>
