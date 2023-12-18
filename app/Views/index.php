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
              <h5 class="card-title fw-semibold mb-6 text-center">Selamat Datang Di Sistem Pendukung Keputusan Penentuan Topik Skripsi</h5>
            </div>
          </div>

          <div class="card">
            <div class="card-header">
              <h5 class="mb-0">Input Data Mahasiswa</h5>
            </div>
            <div class="card">
              <div class="card-body">
                <form action="<?= base_url('proses-form') ?>" method="post">
                  <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" name="nama" class="form-control" id="nama" required>
                  </div>
                  <div class="mb-3">
                    <label for="nim" class="form-label">NIM</label>
                    <input type="text" name="nim" class="form-control" id="nim" pattern="[0-9]+" title="Masukkan hanya karakter numerik" required>
                  </div>

                  <div class="mb-3 table-responsive">
                    <table class="table table-bordered">
                      <thead class="bg-primary text-center">
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
                              <select class="form-control" name="nilai_akademik[]" required>
                                <option value="">Pilih IPK</option>
                                <option value="< 2,0">
                                  < 2,0</option>
                                <option value="2,0 – 2,5">2,0 – 2,5</option>
                                <option value="2,5 – 3,0">2,5 – 3,0</option>
                                <option value="3,0 – 3,5">3,0 – 3,5</option>
                                <option value="> 3,5">> 3,5</option>
                              </select>
                            </td>
                            <td>
                              <select class="form-control" name="h_projek[]" required>
                                <!-- Options for histori projek -->
                                <option value="">Pilih</option>
                                <option value="1 – 2">1 – 2</option>
                                <option value="3 – 4">3 – 4</option>
                                <option value="5 – 6">5 – 6</option>
                                <option value="> 7">> 7</option>
                              </select>
                            </td>
                            <td>
                              <select class="form-control" name="pelatihan[]" required>
                                <!-- Options for pelatihan -->
                                <option value="">Pilih</option>
                                <option value="Tidak Berhubungan Dengan Alternatif">Tidak Berhubungan Dengan Alternatif</option>
                                <option value="Kurang Menunjang Dengan Alternatif">Kurang Menunjang Dengan Alternatif</option>
                                <option value="Cukup Menunjang Dengan Alternatif">Cukup Menunjang Dengan Alternatif</option>
                                <option value="Sesuai Dengan Alternatif">Sesuai Dengan Alternatif</option>
                                <option value="Sangat Sesuai Dengan Alternatif">Sangat Sesuai Dengan Alternatif</option>
                              </select>
                            </td>
                            <td>
                              <select class="form-control" name="minat[]" required>
                                <!-- Options for minat -->
                                <option value="">Tingkat Minat</option>
                                <option value="Sangat Tidak Minat">Sangat Tidak Minat</option>
                                <option value="Tidak Minat">Tidak Minat</option>
                                <option value="Cukup Minat">Cukup Minat</option>
                                <option value="Minat">Minat</option>
                                <option value="Sangat Minat">Sangat Minat</option>
                              </select>
                            </td>
                            <td>
                              <select class="form-control" name="kemampuan[]" required>
                                <!-- Options for kemampuan -->
                                <option value="">Pilih</option>
                                <option value="Belum Menguasai < 39">Belum Menguasai</option>
                                <option value="Kurang Menguasai 40 s/d 59">Kurang Menguasai</option>
                                <option value="Cukup Menguasai 60 s/d 74">Cukup Menguasai</option>
                                <option value="Menguasai 75 s/d 84">Menguasai </option>
                                <option value="Sangat Menguasai 85 s/d 100">Sangat Menguasai</option>
                              </select>
                            </td>
                          </tr>
                        <?php endforeach; ?>
                      </tbody>
                    </table>
                  </div>
                  <button type="submit" class="btn btn-primary float-end">
                    Proses <i class="ti ti-arrow-right fs-4 ms-2"></i>
                  </button>

                </form>
              </div>
            </div>
            <!-- hasil -->
            <?php if (isset($hasilPerhitungan)) : ?>
              <h5 class="card-title fw-semibold mb-4">Hasil Perhitungan</h5>
              <div class="card mb-4">
                <div class="card-body">
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
              <h5 class="card-title fw-semibold mb-4">Rekomendasi Topik Skripsi</h5>
              <div class="card">
                <div class="card-body">
                  <h6 class="card-subtitle mb-2 text-muted">Topic yang di rekomendasikan <strong class="text-success"><?= $alternatifOptions[key($hasilPerhitungan)]['topic']; ?> </strong></h6>
                  <p class="lead"></p>
                  <!-- ... (Tambahkan elemen HTML atau kelas Bootstrap sesuai kebutuhan) ... -->
                </div>
              </div>
            <?php endif; ?>



          </div>
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