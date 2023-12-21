<?php

namespace App\Controllers;

use App\Models\M_Alternatif;
use App\Models\M_Hasil;
use CodeIgniter\Controller;

class Home extends BaseController
{
    public function index()
    {
        $alternatifModel = new M_Alternatif();

        // Cek apakah ada data hasil perhitungan dari formulir sebelumnya
        if ($this->request->getMethod() == 'post') {
            // Ambil data dari form
            $nilaiAkademik = $this->request->getPost('nilai_akademik');
            $historiProjek = $this->request->getPost('h_projek');
            $pelatihan = $this->request->getPost('pelatihan');
            $minat = $this->request->getPost('minat');
            $kemampuan = $this->request->getPost('kemampuan');

            // Hitung data menggunakan metode SAW
            $hasilPerhitungan = $this->hitungSAW($nilaiAkademik, $historiProjek, $pelatihan, $minat, $kemampuan);

            // Pass hasil perhitungan ke view
            $data['hasilPerhitungan'] = $hasilPerhitungan;
        }

        // Ambil data alternatif
        $data['alternatifOptions'] = $alternatifModel->findAll();

        return view('index', $data);
    }
    public function prosesForm()
    {
        // Ambil data dari form
        $nilaiAkademik = $this->request->getPost('nilai_akademik');
        $historiProjek = $this->request->getPost('h_projek');
        $pelatihan = $this->request->getPost('pelatihan');
        $minat = $this->request->getPost('minat');
        $kemampuan = $this->request->getPost('kemampuan');

        // Simpan nama dan nim ke dalam variabel
        $nama = $this->request->getPost('nama');
        $nim = $this->request->getPost('nim');

        // Hitung data menggunakan metode SAW
        $hasilPerhitungan = $this->hitungSAW($nilaiAkademik, $historiProjek, $pelatihan, $minat, $kemampuan, $nama, $nim);

        // Ambil data alternatif (diperlukan untuk menampilkan form lagi)
        $alternatifModel = new M_Alternatif();
        $data['alternatifOptions'] = $alternatifModel->findAll();

        // Pass hasil perhitungan dan data nama dan nim ke view
        $data['hasilPerhitungan'] = $hasilPerhitungan;
        $data['nama'] = $nama;
        $data['nim'] = $nim;

        $data['nilaiAkademik'] = $nilaiAkademik;
        $data['historiProjek'] = $historiProjek;
        $data['pelatihan'] = $pelatihan;
        $data['minat'] = $minat;
        $data['kemampuan'] = $kemampuan;

        // Dapatkan semua kunci (keys) dari hasil perhitungan
        $keys = array_keys($hasilPerhitungan);

        // Dapatkan kunci dengan nilai rank tertinggi
        $maxRankKey = array_search(max(array_column($hasilPerhitungan, 'rank')), array_column($hasilPerhitungan, 'rank'));

        // Pastikan bahwa kunci yang digunakan adalah kunci yang benar
        if ($maxRankKey !== false && isset($keys[$maxRankKey])) {
            $bestAlternativeKey = $keys[$maxRankKey];

            // Dapatkan rekomendasi menggunakan kunci yang benar
            $recommendedTopic = isset($data['alternatifOptions'][$bestAlternativeKey]['topic']) ? $data['alternatifOptions'][$bestAlternativeKey]['topic'] : '';

            // Simpan hasil perhitungan ke dalam tabel hasil
            $hasilModel = new M_Hasil();
            $dataHasil = [
                'nama' => $nama,
                'nim' => $nim,
                'rekomendasi' => $recommendedTopic,
            ];

            $hasilModel->simpanHasil($dataHasil);
        }

        return view('index', $data);
    }

    protected function hitungSAW($nilaiAkademik, $historiProjek, $pelatihan, $minat, $kemampuan)
    {
        $totalNilai = [];
        $bobotKriteria = [
            'nilai_akademik' => 0.15,
            'h_projek' => 0.15,
            'pelatihan' => 0.2,
            'minat' => 0.25,
            'kemampuan' => 0.25,
        ];

        // Tahap Analisis (Perhitungan SAW)
        foreach ($nilaiAkademik as $key => $nilai) {
            $nilaiMapped = $this->mapToNumericValue($nilai, 'nilai_akademik');
            $historiProjekMapped = $this->mapToNumericValue($historiProjek[$key], 'h_projek');
            $pelatihanMapped = $this->mapToNumericValue($pelatihan[$key], 'pelatihan');
            $minatMapped = $this->mapToNumericValue($minat[$key], 'minat');
            $kemampuanMapped = $this->mapToNumericValue($kemampuan[$key], 'kemampuan');


            $totalNilai[$key] = [
                'nilai_akademik' => $nilaiMapped,
                'h_projek' => $historiProjekMapped,
                'pelatihan' => $pelatihanMapped,
                'minat' => $minatMapped,
                'kemampuan' => $kemampuanMapped,

            ];
            // echo '<pre>';
            // echo 'Tahap Analisis (Perhitungan SAW):';
            // print_r($totalNilai);
            // echo '</pre>';
        }

        // Normalisasi setiap elemen matriks
        foreach ($totalNilai as $key => $alternatif) {
            // Temukan nilai maksimum pada baris
            $maxValue = max($alternatif);


            // Periksa apakah $maxValue adalah nol
            if ($maxValue != 0) {
                // Normalisasi setiap elemen matriks
                foreach ($alternatif as $kriteria => $nilai) {
                    $totalNilai[$key][$kriteria] /= $maxValue;
                }
            } else {
                // Penanganan ketika $maxValue adalah nol (misalnya, atur semua nilai pada baris ini menjadi 0)
                foreach ($alternatif as $kriteria => $nilai) {
                    $totalNilai[$key][$kriteria] = 0;
                }
            }
        }
        // echo '<pre>';
        // echo "Nilai Maksimum pada Alternatif $key: $maxValue\n";
        // echo '</pre>';

        // Hitung total nilai untuk setiap kriteria
        $totalKriteria = array_fill_keys(array_keys($totalNilai[0]), 0);
        foreach ($totalNilai as $alternatif) {
            foreach ($alternatif as $kriteria => $nilai) {
                $totalKriteria[$kriteria] += $nilai;
            }
        }
        // echo '<pre>';
        // echo 'Total Nilai setiap kriteria (Perhitungan SAW):';
        // print_r($totalNilai);
        // echo '</pre>';

        // Hitung bobot berdasarkan total nilai kriteria
        $jumlahAlternatif = count($totalNilai);
        $bobot = array_map(function ($total) use ($jumlahAlternatif) {
            return $total / $jumlahAlternatif;
        }, $totalKriteria);
        // echo '<pre>';
        // echo 'Total Nilai Kriteria(Perhitungan SAW):';
        // print_r($totalNilai);
        // echo '</pre>';
        // Terapkan bobot kriteria pada hasil perhitungan
        foreach ($totalNilai as $key => $alternatif) {
            foreach ($alternatif as $kriteria => $nilai) {
                $totalNilai[$key][$kriteria] *= $bobotKriteria[$kriteria];
            }
        }
        // echo '<pre>';
        // echo 'Total Nilai (Perhitungan SAW):';
        // print_r($totalNilai);
        // echo '</pre>';
        // Tahap Perangkingan
        $ranking = [];
        foreach ($totalNilai as $key => $alternatif) {
            $totalNilai[$key]['rank'] = 0; // Inisialisasi peringkat
            foreach ($alternatif as $kriteria => $nilai) {
                $totalNilai[$key]['rank'] += $nilai;
            }
            $ranking[$key] = $totalNilai[$key]['rank'];
        }
        // Urutkan peringkat dari besar ke kecil
        arsort($ranking);

        // Tambahkan peringkat ke hasil perhitungan
        $sortedTotalNilai = [];
        foreach ($ranking as $key => $rank) {
            // Bulatkan nilai total menjadi 3 angka di belakang koma
            $totalNilai[$key]['rank'] = round($totalNilai[$key]['rank'], 3);
            $sortedTotalNilai[$key] = $totalNilai[$key];
        }
        return $sortedTotalNilai;
    }

    protected function mapToNumericValue($selectedValue, $criteria)
    {
        switch ($criteria) {
            case 'nilai_akademik':
                switch ($selectedValue) {
                    case '< 2,0':
                        return 0;
                    case '2,0 – 2,5':
                        return 0.1;
                    case '2,6 – 3,0':
                        return 0.2;
                    case '3,1 – 3,5':
                        return 0.3;
                    case '> 3,5':
                        return 0.4;
                    default:
                        return 0;
                }
                break;

            case 'h_projek':
                // Map values for 'historiProjek' criteria
                // Add similar cases for other criteria
                switch ($selectedValue) {
                    case 'Tidak Ada 0':
                        return 0;
                    case '1 – 2':
                        return 0.1;
                    case '3 – 4':
                        return 0.2;
                    case '5 – 6':
                        return 0.3;
                    case '> 7':
                        return 0.4;
                    default:
                        return 0;
                }
                break;

            case 'pelatihan':
                // Map values for 'pelatihan' criteria
                // Add similar cases for other criteria
                switch ($selectedValue) {
                    case 'Tidak Berhubungan Dengan Alternatif':
                        return 0;
                    case 'Kurang Menunjang Dengan Alternatif':
                        return 0.1;
                    case 'Cukup Menunjang Dengan Alternatif':
                        return 0.2;
                    case 'Sesuai Dengan Alternatif':
                        return 0.3;
                    case 'Sangat Sesuai Dengan Alternatif':
                        return 0.4;
                    default:
                        return 0;
                }
                break;

            case 'minat':
                // Map values for 'minat' criteria
                // Add similar cases for other criteria
                switch ($selectedValue) {
                    case 'Sangat Tidak Minat':
                        return 0;
                    case 'Tidak Minat':
                        return 0.1;
                    case 'Cukup Minat':
                        return 0.2;
                    case 'Minat':
                        return 0.3;
                    case 'Sangat Minat':
                        return 0.4;
                    default:
                        return 0;
                }
                break;

            case 'kemampuan':
                // Map values for 'kemampuan' criteria
                // Add similar cases for other criteria
                switch ($selectedValue) {
                    case 'Belum Menguasai < 39':
                        return 0;
                    case 'Kurang Menguasai 40 s/d 59':
                        return 0.1;
                    case 'Cukup Menguasai 60 s/d 74':
                        return 0.2;
                    case 'Menguasai 75 s/d 84':
                        return 0.3;
                    case 'Sangat Menguasai 85 s/d 100':
                        return 0.4;
                    default:
                        return 0;
                }
                break;

            default:
                return 0;
        }
    }

    // HomeController.php

    public function hasil()
    {
        $hasilModel = new M_Hasil();
        $data['hasilData'] = $hasilModel->findAll();

        return view('hasil', $data);
    }
    public function hapus($id)
    {
        $hasilModel = new M_Hasil();
        $hasilModel->delete($id);

        // Setelah menghapus, arahkan kembali ke halaman hasil
        return redirect()->to(base_url('admin'))->with('success', 'Data berhasil dihapus.');
    }
    public function tambahAlternatif()
    {
        // Buat instance dari model M_Alternatif
        $alternatifModel = new M_Alternatif();

        // Ambil data alternatif dari tabel alternatif
        $data['alternatifData'] = $alternatifModel->findAll();

        // Tampilkan view tambah_alternatif dengan data alternatif
        return view('tambah_alternatif', $data);
    }

    public function simpanAlternatif()
    {
        // Ambil data dari form
        $data = [
            'topic' => $this->request->getPost('topic'),
        ];

        // Simpan data ke dalam tabel alternatif
        $alternatifModel = new M_Alternatif();
        $alternatifModel->insert($data);

        // Redirect ke halaman lain jika diperlukan
        return redirect()->to(base_url('/tambah'))->with('success', 'Tambah alternatif berhasil.');
    }
    public function hapusAlternatif($id)
    {
        // Buat instance dari model M_Alternatif
        $alternatifModel = new M_Alternatif();

        // Hapus alternatif berdasarkan ID
        $alternatifModel->delete($id);

        // Redirect ke halaman tambah_alternatif
        return redirect()->to(base_url('tambah'))->with('success', 'Alternatif berhasil dihapus.');
    }
    public function editAlternatif($id)
    {
        // Buat instance dari model M_Alternatif
        $alternatifModel = new M_Alternatif();

        // Ambil data alternatif berdasarkan ID
        $data['alternatif'] = $alternatifModel->find($id);

        // Tampilkan view edit_alternatif dengan data alternatif
        return view('edit_alternatif', $data);
    }

    public function updateAlternatif()
    {
        // Dapatkan data dari form
        $id = $this->request->getPost('id');
        $topic = $this->request->getPost('topic');

        // Validasi data form sesuai kebutuhan

        // Buat instance dari model M_Alternatif
        $alternatifModel = new M_Alternatif();

        // Update data alternatif berdasarkan ID
        $alternatifModel->update($id, ['topic' => $topic]);

        // Redirect ke halaman tambah_alternatif
        return redirect()->to(base_url('tambah'))->with('success', 'Update alternatif berhasil.');
    }
}
