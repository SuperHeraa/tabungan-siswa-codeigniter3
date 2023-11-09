<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-info sidebar sidebar-dark accordion sidemobile" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center">
        <div class="sidebar-brand-icon">
            <i class="fas fa-dollar-sign"></i>
        </div>
        <div class="sidebar-brand-text mx-3">TABSIS</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li <?= $this->uri->segment(1) == 'Admin' ? 'class="nav-item active"' : 'class="nav-item"' ?>>
        <a class=" nav-link" href="<?= base_url('Admin'); ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider item">

    <!-- Heading -->
    <div class="sidebar-heading item">
        MENU DATA
    </div>
    <li <?= $this->uri->segment(1) == 'Datasiswa' ? 'class="nav-item active"' : 'class="nav-item"' ?>>
        <a class=" nav-link" href="<?= base_url('Datasiswa'); ?>">
            <i class="fas fa-fw fa-graduation-cap"></i>
            <span>Data Siswa</span></a>
    </li>
    <li <?= $this->uri->segment(1) == 'Tabungan' || $this->uri->segment(1) == 'Setoran' || $this->uri->segment(1) == 'Penarikan' || $this->uri->segment(1) == 'Detail' || $this->uri->segment(2) == 'setor_tunai' || $this->uri->segment(2) == 'tarik_tunai' ? 'class="nav-item active"' : 'class="nav-item"' ?>>
        <a class="nav-link" href="<?= base_url('Tabungan'); ?>">
            <i class="fas fa-fw fa-comments-dollar"></i>
            <span>Tabungan</span></a>
    </li>
    <hr class="sidebar-divider item">
    <div class="sidebar-heading item">
        MASTER DATA
    </div>
    <li <?= $this->uri->segment(1) == 'Sekolah' ? 'class="nav-item active"' : 'class="nav-item"' ?>>
        <a class="nav-link" href="<?= base_url('Sekolah'); ?>">
            <i class="fas fa-fw fa-school"></i>
            <span>Sekolah</span></a>
    </li>
    <li <?= $this->uri->segment(1) == 'Alat' ? 'class="nav-item active"' : 'class="nav-item"' ?>>
        <a class="nav-link" href="<?= base_url('Alat'); ?>">
            <i class="fas fa-fw fa-tools"></i>
            <span>Alat</span></a>
    </li>
    <li <?= $this->uri->segment(1) == 'Laporan' ? 'class="nav-item active"' : 'class="nav-item"' ?>>
        <a class="nav-link" href="<?= base_url('Laporan'); ?>">
            <i class="fas fa-file-alt fa-fw"></i>
            <span>Laporan</span></a>
    </li>
    <hr class="sidebar-divider item">
    <div class="sidebar-heading item">
        USER DATA
    </div>
    <li <?= $this->uri->segment(1) == 'Pengguna' ? 'class="nav-item active"' : 'class="nav-item"' ?>>
        <a class="nav-link" href="<?= base_url('Pengguna'); ?>">
            <i class="fas fa-fw fa-user-cog"></i>
            <span>Pengguna</span></a>
    </li>
    <li id="item" <?= $this->uri->segment(1) == 'Profil' || $this->uri->segment(1) == 'Ubahpassword' ? 'class="nav-item active"' : 'class="nav-item"' ?>>
        <a class="nav-link" href="<?= base_url('Profil'); ?>">
            <i class="fas fa-user fa-sm fa-fw"></i>
            <span>Profil</span></a>
    </li>
    <li id="item" <?= $this->uri->segment(1) == 'Pengajuan' || $this->uri->segment(1) == 'Ubahpassword' ? 'class="nav-item active"' : 'class="nav-item"' ?>>
        <a class="nav-link" href="<?= base_url('Pengajuan'); ?>">
            <i class="fas fa-file-import"></i>
            <span>Pengajuan</span></a>
    </li>

    <hr class="sidebar-divider">
    <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal">
            <i class="fas fa-sign-out-alt"></i>
            <span>Logout</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->