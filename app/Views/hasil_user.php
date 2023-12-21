<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SPK Pemilihan Topik Skripsi</title>
    <link rel="shortcut icon" type="image/png" href="<?= base_url('assets/images/logos/favicon.png') ?>" />
    <link rel="stylesheet" href="<?= base_url('assets/css/styles.min.css') ?>" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.18.0/font/bootstrap-icons.css" rel="stylesheet">

</head>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
        <div class="container mt-5">
            <div class="card">
                <div class="card-body text-primary">
                    <div class="card text-white bg-primary">
                        <div class="card-body">
                            <h5 class="card-title text-white fw-semibold mb-6 text-center">Selamat Datang Di Sistem Pendukung Keputusan Penentuan Topik Skripsi</h5>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                        </div>
                        <div class="card-body">
                            <form action="<?= base_url('proses-form') ?>" method="post">
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama</label>
                                    <input type="text" name="nama" class="form-control" id="nama" value="<?= $nama; ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="nim" class="form-label">NIM</label>
                                    <input type="text" name="nim" class="form-control" id="nim" pattern="[0-9]+" title="Masukkan hanya karakter numerik" value="<?= $nim; ?>">
                                </div>

                                <div class="mb-3 table-responsive">
                                    <table class="table table-bordered">
                                        <thead class="bg-primary text-center text-white">
                                            <tr>
                                                <th>No</th>
                                                <th class="col-2">Alternatif</th>
                                                <th class="col-2">Nilai Akademik</th>
                                                <th class="col-2">Histori Projek</th>
                                                <th class="col-2">Pelatihan</th>
                                                <th class="col-2">Minat</th>
                                                <th class="col-2">Kemampuan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($alternatifOptions as $key => $alternatif) : ?>
                                                <tr>
                                                    <td><?= $key + 1; ?></td>
                                                    <td><?= $alternatif['topic']; ?></td>
                                                    <td>
                                                        <input type="text" name="nama" class="form-control" id="nama" value="<?= $nilaiAkademik[$key]; ?>">
                                                    </td>
                                                    <td>
                                                        <input type="text" name="nama" class="form-control" id="nama" value="<?= $historiProjek[$key]; ?>">
                                                    </td>
                                                    <td>
                                                        <input type="text" name="nama" class="form-control" id="nama" value="<?= $pelatihan[$key]; ?>">
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <input type="text" name="nama" class="form-control" id="nama" value="<?= $minat[$key]; ?>">
                                                    </td>
                                                    <td>
                                                        <input type="text" name="nama" class="form-control" id="nama" value="<?= $kemampuan[$key]; ?>">
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>

                            </form>
                        </div>
                    </div>
                    <!-- hasil -->
                    <?php if (isset($hasilPerhitungan)) : ?>
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0">Hasil Perhitungan</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3 fw-bold fs-4 text-uppercase text-dark fw-bold d-flex flex-column">
                                    <span>Nama: <?= $nama; ?></span>
                                    <span>NIM: <?= $nim; ?></span>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped">
                                        <thead class="table-dark">
                                            <tr>
                                                <th>Alternatif</th>
                                                <th>Total Nilai</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($hasilPerhitungan as $key => $totalNilai) : ?>
                                                <tr>
                                                    <td><?= $alternatifOptions[$key]['topic']; ?></td>
                                                    <td><?= number_format($totalNilai['rank'], 3); ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <!-- end hasil -->

                    <?php if (isset($hasilPerhitungan)) : ?>
                        <!-- Tampilkan rekomendasi topik skripsi sebagai card -->
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0">Rekomendasi Topik Skripsi</h5>
                            </div>

                            <div class="card-body">
                                <h6 class="card-subtitle mb-2 text-muted">Topic yang di rekomendasikan untuk <span class="fw-bolder text-uppercase text-success"><?= $nama; ?></span> adalah <strong class="text-success"><?= $alternatifOptions[key($hasilPerhitungan)]['topic']; ?> </strong></h6>
                                <p class="lead"></p>
                                <!-- ... (Tambahkan elemen HTML atau kelas Bootstrap sesuai kebutuhan) ... -->
                            </div>
                        </div>
                        <a href="/cetak-pdf" class="btn btn-primary float-end">
                            Cetak <i class="ti ti-arrow-right fs-4 ms-2"></i>
                        </a>
                    <?php endif; ?>




                </div>
            </div>
        </div>

        <?= $this->include('layout/footer') ?>
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