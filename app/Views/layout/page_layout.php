<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin|Pemilihan Topik Skripsi</title>
    <link rel="shortcut icon" type="image/png" href="<?= base_url('assets/images/logos/favicon.png') ?>" />
    <link rel="stylesheet" href="<?= base_url('assets/css/styles.min.css') ?>" />
</head>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
        <!-- Sidebar Start -->
        <?= $this->include('layout/sidebar') ?>
        <!--  Sidebar End -->
        <!--  Main wrapper -->
        <div class="body-wrapper">
            <!--  Header Start -->
            <?= $this->include('layout/header') ?>
            <!--  Header End -->
            <div class="container-fluid">
                <?= $this->renderSection('content') ?>
                <?= $this->include('layout/footer') ?>
            </div>
        </div>
    </div>
    <script src="<?= base_url('assets/libs/jquery/dist/jquery.min.js') ?>"></script>
    <script src="<?= base_url('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/sidebarmenu.js') ?>"></script>
    <script src="<?= base_url('assets/js/app.min.js') ?>"></script>
    <script src="<?= base_url('assets/libs/apexcharts/dist/apexcharts.min.js') ?>"></script>
    <script src="<?= base_url('assets/libs/simplebar/dist/simplebar.js') ?>"></script>
    <script src="<?= base_url('assets/js/dashboard.js') ?>"></script>
</body>

</html>