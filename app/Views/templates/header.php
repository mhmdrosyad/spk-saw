<!-- app/Views/templates/header.php -->

<header class="main-header-top hidden-print">
    <a href="<?= base_url('/') ?>" class="logo"><img class="img-fluid able-logo" alt="Dashboard"></a>
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#!" data-toggle="offcanvas" class="sidebar-toggle"></a>
        <!-- Navbar Right Menu-->
        <ul class="top-nav">
            <!-- User Menu-->
            <li class="dropdown">
                <a href="#!" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle drop icon-circle drop-image">
                    <span><img class="img-circle " src="<?= base_url('assets/images/avatar-1.png') ?>" style="width:40px;" alt="User Image"></span>
                    <span>John <b>Doe</b> <i class=" icofont icofont-simple-down"></i></span>
                </a>
                <ul class="dropdown-menu settings-menu">
                    <div class="dropdown-divider m-0"></div>
                    <li><a href="<?= base_url('login1.html') ?>"><i class="icon-logout"></i> Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>
</header>