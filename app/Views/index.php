<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SPK Pemilihan Topik Skripsi</title>
  <link rel="shortcut icon" type="image/png" href="<?= base_url('assets/images/logos/uaa.png') ?>" />
  <link rel="stylesheet" href="<?= base_url('assets/css/styles.min.css') ?>" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.68/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.68/vfs_fonts.js"></script>

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
              <h5 class="mb-0">Input Data Mahasiswa</h5>
            </div>
            <div class="card-body">
              <form action="/" method="post">
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
                            <select class="form-control" name="nilai_akademik[]" required>
                              <option value="">Pilih IPK</option>
                              <option value="< 2,0">
                                < 2,0</option>
                              <option value="2,0 – 2,5">2,1 – 2,5</option>
                              <option value="2,6 – 3,0">2,6 – 3,0</option>
                              <option value="3,1 – 3,5">3,1 – 3,5</option>
                              <option value="> 3,5">> 3,5</option>
                            </select>
                          </td>
                          <td>
                            <select class="form-control" name="h_projek[]" required>
                              <!-- Options for histori projek -->
                              <option value="">Pilih</option>
                              <option value="Tidak Ada 0">Tidak Ada</option>
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
                              <option value="Belum Menguasai < 39">Belum Menguasai &lt; 39 </option>
                              <option value="Kurang Menguasai 40 s/d 59">Kurang Menguasai 40 s/d 59</option>
                              <option value="Cukup Menguasai 60 s/d 74">Cukup Menguasai 60 s/d 74</option>
                              <option value="Menguasai 75 s/d 84">Menguasai 75 s/d 84 </option>
                              <option value="Sangat Menguasai 85 s/d 100">Sangat Menguasai 85 s/d 100</option>
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
          <di<div class="container mt-4">
            <div class="card">
              <h2 class="card-title">Mapping Values</h2>
              <div class="table-responsive">
                <button id="toggleTable" class="btn btn-primary mb-3">
                  Tampilkan
                  <i class="ti ti-eye fs-4 ms-2"></i>
                </button>
                <table class="table table-bordered" id="mappingTable" style="display: none;">
                  <thead>
                    <tr>
                      <th>NO</th>
                      <th>Nilai Akademik</th>
                      <th>History Projek</th>
                      <th>Pelatihan</th>
                      <th>Minat</th>
                      <th>Kemampuan</th>
                      <th>Nilai</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>
                        <div class="numbering">
                          <div class="text-center" style="font-weight: bold;">1</div>
                          <div class="text-center" style="font-weight: bold;">2</div>
                          <div class="text-center" style="font-weight: bold;">3</div>
                          <div class="text-center" style="font-weight: bold;">4</div>
                          <div class="text-center" style="font-weight: bold;">5</div>
                        </div>
                      </td>
                      <td>
                        <div>
                          <div>
                            < 2,0</div>
                              <div>2,1 – 2,5</div>
                              <div>2,6 – 3,0</div>
                              <div>3,1 – 3,5</div>
                              <div>> 3,5</div>
                          </div>
                      </td>

                      <td>
                        <div>
                          <div>Tidak Ada</div>
                          <div>1 – 2</div>
                          <div>3 – 4</div>
                          <div>5 – 6</div>
                          <div>> 7</div>
                        </div>
                      </td>
                      <td>
                        <div>
                          <div>Tidak Berhubungan Dengan Alternatif</div>
                          <div>Kurang Menunjang Dengan Alternatif</div>
                          <div>Cukup Menunjang Dengan Alternatif</div>
                          <div>Sesuai Dengan Alternatif</div>
                          <div>Sangat Sesuai Dengan Alternatif</div>
                        </div>
                      </td>
                      <td>
                        <div>
                          <div>Sangat Tidak Minat</div>
                          <div>Tidak Minat</div>
                          <div>Cukup Minat</div>
                          <div>Minat</div>
                          <div>Sangat Minat</div>
                        </div>
                      </td>
                      <td>
                        <div>
                          <div>Belum Menguasai &lt; 39 </div>
                          <div>Kurang Menguasai 40 s/d 59</div>
                          <div>Cukup Menguasai 60 s/d 74</div>
                          <div>Menguasai 75 s/d 84 </div>
                          <div>Sangat Menguasai 85 s/d 100</div>
                        </div>
                      </td>
                      <td>
                        <div>
                          <div>0</div>
                          <div>1</div>
                          <div>2</div>
                          <div>3</div>
                          <div>4</div>
                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>



              </div>
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
              <div class="card-subtitle mb-2 text-muted" id="pesan"></div>
              <h6 class="card-subtitle mb-2 text-muted">Topic yang di rekomendasikan untuk <span class="fw-bolder text-uppercase text-success"><?= $nama; ?></span> adalah <strong class="text-success"><?= $recommendedTopicsString; ?></strong></h6>
              <p class="lead"></p>
              <!-- ... (Tambahkan elemen HTML atau kelas Bootstrap sesuai kebutuhan) ... -->
            </div>
          </div>
          <button onclick="generatePDF()" class="btn btn-primary float-end">
            Cetak <i class="ti ti-printer fs-4 ms-2"></i>
          </button>
          <script src="<?= base_url('assets/libs/jquery/dist/jquery.min.js') ?>"></script>
          <!-- Di dalam HTML Anda atau di dalam file JavaScript Anda -->
          <script>
            // Mendapatkan nilai dari PHP dan membersihkannya
            var recommendedTopicsString = '<?= $recommendedTopicsString; ?>';
            var cleanedRecommendedTopics = recommendedTopicsString.trim();

            // Mendapatkan elemen div dengan ID "pesan"
            var pesanElement = document.getElementById('pesan');

            // Memeriksa jika string tidak kosong
            if (cleanedRecommendedTopics !== '') {
              // Menghitung jumlah topik dengan memisahkan string menggunakan koma
              var numberOfTopics = cleanedRecommendedTopics.split(',').map(topic => topic.trim()).length;

              // Menampilkan pesan sesuai dengan jumlah topik
              var pesanText = '';
              if (numberOfTopics === 1) {
                pesanText = '';
              } else {
                pesanText = 'Anda memiliki ' + numberOfTopics + ' rekomendasi topic.';
              }

              // Menetapkan teks pesan ke dalam elemen div
              pesanElement.innerText = pesanText;
            } else {
              // Menampilkan pesan jika string kosong
              pesanElement.innerText = 'Tidak ada rekomendasi topik.';
            }
          </script>

          <script>
            let nama = <?= json_encode($nama, JSON_PRETTY_PRINT); ?>;
            let nim = <?= json_encode($nim, JSON_PRETTY_PRINT); ?>;
            let alternatif = <?= json_encode($alternatifOptions, JSON_PRETTY_PRINT); ?>;
            let hasil = <?= json_encode($hasilPerhitungan, JSON_PRETTY_PRINT); ?>;
            let rekomendasi = <?= json_encode($recommendedTopicsString, JSON_PRETTY_PRINT); ?>;

            let nilaiAkademik = <?= json_encode($nilaiAkademik, JSON_PRETTY_PRINT); ?>;
            let historiProjek = <?= json_encode($historiProjek, JSON_PRETTY_PRINT); ?>;
            let pelatihan = <?= json_encode($pelatihan, JSON_PRETTY_PRINT); ?>;
            let minat = <?= json_encode($minat, JSON_PRETTY_PRINT); ?>;
            let kemampuan = <?= json_encode($kemampuan, JSON_PRETTY_PRINT); ?>;

            function generatePDF() {
              // Mengurutkan data berdasarkan rank
              var sortedData = alternatif.map((item, index) => {
                return {
                  ...item,
                  rank: hasil[index].rank
                };
              }).sort((a, b) => b.rank - a.rank);

              var tabelData = [];

              // Menambahkan header tabel
              tabelData.push([{
                  text: "No.",
                  bold: true,
                  fillColor: '#5d87ff'
                },
                {
                  text: "Alternatif",
                  bold: true,
                  fillColor: '#5d87ff'
                },
                {
                  text: "Nilai Akademik",
                  bold: true,
                  fillColor: '#5d87ff'
                },
                {
                  text: "Histori Projek",
                  bold: true,
                  fillColor: '#5d87ff'
                },
                {
                  text: "Pelatihan",
                  bold: true,
                  fillColor: '#5d87ff'
                },
                {
                  text: "Minat",
                  bold: true,
                  fillColor: '#5d87ff'
                },
                {
                  text: "Kemampuan",
                  bold: true,
                  fillColor: '#5d87ff'
                }
              ]);

              // Menambahkan data ke dalam tabel
              for (let i = 0; i < alternatif.length; i++) {
                let nomor = i + 1; // Nomor diisi otomatis dari 1
                let alternatifData = alternatif[i].topic;
                let nilaiAkademikData = nilaiAkademik[i]; // Mengambil nilai_akademik dari array
                let historiProjekData = historiProjek[i]; // Mengambil nilai_akademik dari array
                let pelatihanData = pelatihan[i]; // Mengambil nilai_akademik dari array
                let minatData = minat[i]; // Mengambil nilai_akademik dari array
                let kemampuanData = kemampuan[i]; // Mengambil nilai_akademik dari array

                tabelData.push([{
                    text: nomor.toString()
                  },
                  {
                    text: alternatifData
                  },
                  {
                    text: nilaiAkademikData.toString()
                  }, // Menggunakan toString() untuk memastikan tipe data teks
                  {
                    text: historiProjekData.toString()
                  }, // Ganti dengan data yang sesuai
                  {
                    text: pelatihanData.toString()
                  }, // Ganti dengan data yang sesuai
                  {
                    text: minatData.toString()
                  }, // Ganti dengan data yang sesuai
                  {
                    text: kemampuanData.toString()
                  } // Ganti dengan data yang sesuai
                ]);
              }
              // Membuat document definition
              var docDefinition = {
                content: [{
                    text: 'Hasil Rekomendasi Pemilihan Topik Skripsi',
                    style: 'header'
                  },
                  {
                    text: 'Nama: ' + nama.toUpperCase(),
                    style: 'paragraf'
                  },
                  {
                    text: 'NIM: ' + nim,
                    style: 'paragraf'
                  },
                  {
                    text: 'Data yang Diinput',
                    style: 'subheader'
                  },
                  {
                    table: {
                      headerRows: 1,
                      widths: ["auto", "auto", "auto", "auto", "auto", "auto", "auto"],
                      body: tabelData
                    }
                  },
                  {
                    text: 'Hasil Perhitungan',
                    style: 'subheader'
                  },
                  {
                    table: {
                      headerRows: 1,
                      widths: ["*", "*"],
                      body: [
                        [{
                          text: "Alternatif",
                          bold: true,
                          fillColor: '#5d87ff',
                        }, {
                          text: "Hasil",
                          bold: true,
                          fillColor: '#5d87ff',
                        }]
                      ],
                    }
                  },
                  {
                    text: 'Rekomendasi',
                    style: 'subheader'
                  },
                  {
                    text: 'Topic yang di rekomendasikan untuk ' + nama.toUpperCase() + ' adalah ' + rekomendasi + '.',
                    style: 'paragraf'
                  }
                ],
                styles: {
                  header: {
                    fontSize: 18,
                    bold: true,
                    margin: [0, 0, 0, 10],
                    alignment: 'center'
                  },
                  subheader: {
                    fontSize: 16,
                    bold: true,
                    margin: [0, 10, 0, 3]
                  },
                  paragraf: {
                    fontSize: 14,
                    margin: [0, 0, 0, 5]
                  }
                }

              };

              if (cleanedRecommendedTopics !== '') {
                var numberOfTopics = cleanedRecommendedTopics.split(',').map(topic => topic.trim()).length;

                // Menampilkan pesan sesuai dengan jumlah topik
                var pesanText = '';
                if (numberOfTopics === 1) {
                  pesanText = '';
                } else {
                  pesanText = 'Anda memiliki ' + numberOfTopics + ' rekomendasi topik.';
                }

                // Menambahkan pesan langsung ke dalam objek docDefinition

                docDefinition.content.splice(docDefinition.content.length - 1, 0, {
                  text: pesanText,
                  style: 'paragraf'
                });

                // ... (kode yang sudah ada)
              } else {
                // Menampilkan pesan jika string kosong
                docDefinition.content.push({
                  text: 'Tidak ada rekomendasi topik.',
                  style: 'paragraf'
                });

                // ... (kode yang sudah ada)
              }

              // Mengisi data tabel
              for (var i = 0; i < sortedData.length; i++) {
                var alternatifTopic = sortedData[i].topic;
                var hasilRank = sortedData[i].rank;
                docDefinition.content[6].table.body.push([alternatifTopic, hasilRank]);
              }

              // Membuat PDF
              pdfMake.createPdf(docDefinition).download(`hasil_${nama}_${nim}.pdf`);


            }

            $(document).ready(function() {
              // Toggle the table on button click
              $("#toggleTable").click(function() {
                $("#mappingTable").toggle();
              });
            });
          </script>
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
  <script src="<?= base_url('assets/libs/simplebar/dist/simplebar.js') ?>"></script>
</body>

</html>