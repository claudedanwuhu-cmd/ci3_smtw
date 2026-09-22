<header class="top-navbar">
    <div>
        <h1 class="page-title"><?= isset($title) ? $title : 'Dashboard'; ?></h1>
        <div class="page-subtitle">Sistem Informasi SMA Negeri Tawangmangu</div>
    </div>

    <div class="user-area">
        <!-- Tombol Toggle Dark / Light Mode -->
        <button type="button" class="theme-toggle-btn" id="themeToggle" title="Ganti Tema">
            <i class="fa-solid fa-moon" id="themeIcon"></i>
        </button>

        <!-- Profil User -->
        <div class="user-profile">
            <div class="user-avatar">
                <?php
                $nama = $this->session->userdata('nama');
                echo !empty($nama) ? strtoupper(substr($nama, 0, 1)) : 'U';
                ?>
            </div>
            <div class="user-info">
                <div class="user-name"><?= $this->session->userdata('nama') ?: 'User'; ?></div>
                <div class="user-role"><?= ucfirst($this->session->userdata('role') ?: 'Guest'); ?></div>
            </div>
        </div>
    </div>
</header>