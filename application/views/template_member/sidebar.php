<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion sidemobile" id="accordionSidebar">

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
    <li <?= $this->uri->segment(1) == 'Member' ? 'class="nav-item active"' : 'class="nav-item"' ?>>
        <a class=" nav-link" href="<?= base_url('Member'); ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Beranda</span></a>
    </li>
    <li <?= $this->uri->segment(1) == 'Transaksi' ? 'class="nav-item active"' : 'class="nav-item"' ?>>
        <a class="nav-link" href="<?= base_url('Transaksi'); ?>">
            <i class="fas fa-file-invoice-dollar fa-fw"></i>
            <span>Transaksi</span></a>
    </li>
    <li <?= $this->uri->segment(1) == 'Profil_m' ? 'class="nav-item active"' : 'class="nav-item"' ?>>
        <a class="nav-link" href="<?= base_url('Profil_m'); ?>">
            <i class="fas fa-user fa-sm fa-fw"></i>
            <span>Profil</span></a>
    </li>
    <li <?= $this->uri->segment(1) == 'Pengajuan' || $this->uri->segment(1) == 'tambah' || $this->uri->segment(1) == 'detail_p' ? 'class="nav-item active"' : 'class="nav-item"' ?>>
        <a class="nav-link" href="<?= base_url('Pengajuan'); ?>">
            <i class="fas fa-file-import"></i>
            <span>Pengajuan</span></a>
    </li>
    <hr class="sidebar-divider">
    <li class="nav-item">
        <a class="nav-link" href="#logoutModal" data-toggle="modal">
            <i class="fas fa-sign-out-alt fa-fw"></i>
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