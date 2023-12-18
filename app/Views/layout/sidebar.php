<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <a href="/" class="text-nowrap logo-img">
                <img src="<?= base_url('assets/images/logos/logo-saw.svg') ?>" width="180" alt="" />
            </a>
            <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-8"></i>
            </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
            <ul id="sidebarnav">
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Home</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="<?= base_url('hasil'); ?>" aria-expanded="false">

                        <span>
                            <i class="ti ti-history"></i>
                        </span>
                        <span class="hide-menu">Histori Perhitungan</span>
                    </a>
                </li>
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Admin</span>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link" href="<?= base_url('tambah'); ?>" aria-expanded="false">
                        <span>
                            <i class="ti ti-file-plus"></i>
                        </span>
                        <span class="hide-menu">Tambah Topic</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="./ui-card.html" aria-expanded="false">
                        <span>
                            <i class="ti ti-file-description"></i>
                        </span>
                        <span class="hide-menu">Data Alternatif</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="./ui-forms.html" aria-expanded="false">
                        <span>
                            <i class="ti ti-users"></i>
                        </span>
                        <span class="hide-menu">Data User</span>
                    </a>
                </li>
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">AKUN</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="/logout" aria-expanded="false">
                        <span>
                            <i class="ti ti-logout"></i>
                        </span>
                        <span class="hide-menu">Logout</span>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>