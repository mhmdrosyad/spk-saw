<?= $this->extend('templates/main') ?>

<?= $this->section('content') ?>
<div class="container mt-4">
   <h2 class="mb-4">Form Input Kriteria</h2>

   <div class="card mb-4">
      <div class="card-body">
         <form action="<?= base_url('proses-form') ?>" method="post">
            <div class="mb-3 row">
               <label for="nama" class="col-sm-1 col-form-label">Nama</label>
               <div class="col-sm-4">
                  <input type="text" class="form-control" id="nama" name="nama" required>
               </div>
            </div>

            <div class="mb-3 row">
               <label for="nim" class="col-sm-1 col-form-label">NIM</label>
               <div class="col-sm-4">
                  <input type="text" class="form-control" id="nim" name="nim" required>
               </div>
            </div>


            <table class="table table-bordered">
               <thead>
                  <tr>
                     <th>No</th>
                     <th>Alternatif</th>
                     <th>Nilai Akademik</th>
                     <th>Histori Projek</th>
                     <th>Pelatihan</th>
                     <th>Minat</th>
                     <th>Kemampuan</th>
                  </tr>
               </thead>
               <tbody>
                  <?php foreach ($alternatifOptions as $key => $alternatif) : ?>
                     <tr>
                        <td><?= $key + 1; ?></td>
                        <td><?= $alternatif['topic']; ?></td>
                        <td>
                           <select class="form-control" name="nilai_akademik[]">
                              <option value="< 2,0">
                                 < 2,0</option>
                              <option value="2,0 – 2,5">2,0 – 2,5</option>
                              <option value="2,5 – 3,0">2,5 – 3,0</option>
                              <option value="3,0 – 3,5">3,0 – 3,5</option>
                              <option value="> 3,5">> 3,5</option>
                           </select>
                        </td>
                        <td>
                           <select class="form-control" name="h_projek[]">
                              <!-- Options for histori projek -->
                              <option value="Tidak Ada 0">Tidak Ada</option>
                              <option value="1 – 2">1 – 2</option>
                              <option value="3 – 4">3 – 4</option>
                              <option value="5 – 6">5 – 6</option>
                              <option value="> 7">> 7</option>
                           </select>
                        </td>
                        <td>
                           <select class="form-control" name="pelatihan[]">
                              <!-- Options for pelatihan -->
                              <option value="Tidak Berhubungan Dengan Alternatif">Tidak Berhubungan Dengan Alternatif</option>
                              <option value="Kurang Menunjang Dengan Alternatif">Kurang Menunjang Dengan Alternatif</option>
                              <option value="Cukup Menunjang Dengan Alternatif">Cukup Menunjang Dengan Alternatif</option>
                              <option value="Sesuai Dengan Alternatif">Sesuai Dengan Alternatif</option>
                              <option value="Sangat Sesuai Dengan Alternatif">Sangat Sesuai Dengan Alternatif</option>
                           </select>
                        </td>
                        <td>
                           <select class="form-control" name="minat[]">
                              <!-- Options for minat -->
                              <option value="Sangat Tidak Minat">Sangat Tidak Minat</option>
                              <option value="Tidak Minat">Tidak Minat</option>
                              <option value="Cukup Minat">Cukup Minat</option>
                              <option value="Minat">Minat</option>
                              <option value="Sangat Minat">Sangat Minat</option>
                           </select>
                        </td>
                        <td>
                           <select class="form-control" name="kemampuan[]">
                              <!-- Options for kemampuan -->
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

            <button type="submit" class="btn btn-primary">Proses</button>
         </form>
      </div>
   </div>

   <?php if (isset($hasilPerhitungan)) : ?>
      <div class="card mt-4">
         <div class="card-body">
            <h4>Hasil Perhitungan</h4>
            <table class="table table-bordered">
               <thead>
                  <tr>
                     <th>Alternatif</th>
                     <th>Total Nilai</th>
                  </tr>
               </thead>
               <tbody>
                  <?php foreach ($hasilPerhitungan as $key => $totalNilai) : ?>
                     <tr>
                        <td><?= $alternatifOptions[$key]['topic']; ?></td>
                        <td><?= $totalNilai['rank']; ?></td>
                     </tr>
                  <?php endforeach; ?>
               </tbody>
            </table>
         </div>
      </div>
   <?php endif; ?>
</div>
<?= $this->endSection() ?>