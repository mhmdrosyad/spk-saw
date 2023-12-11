<?php

namespace App\Controllers;

use App\Models\M_Alternatif;
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

        // Hitung data menggunakan metode SAW
        $hasilPerhitungan = $this->hitungSAW($nilaiAkademik, $historiProjek, $pelatihan, $minat, $kemampuan);

        // Ambil data alternatif (diperlukan untuk menampilkan form lagi)
        $alternatifModel = new M_Alternatif();
        $data['alternatifOptions'] = $alternatifModel->findAll();

        // Pass hasil perhitungan ke view
        $data['hasilPerhitungan'] = $hasilPerhitungan;

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
            // echo '<pre>';
            // echo "Nilai Maksimum pada Alternatif $key: $maxValue\n";
            // echo '</pre>';

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


        // Hitung total nilai untuk setiap kriteria
        $totalKriteria = array_fill_keys(array_keys($totalNilai[0]), 0);
        foreach ($totalNilai as $alternatif) {
            foreach ($alternatif as $kriteria => $nilai) {
                $totalKriteria[$kriteria] += $nilai;
            }
        }

        // Hitung bobot berdasarkan total nilai kriteria
        $jumlahAlternatif = count($totalNilai);
        $bobot = array_map(function ($total) use ($jumlahAlternatif) {
            return $total / $jumlahAlternatif;
        }, $totalKriteria);

        // Terapkan bobot kriteria pada hasil perhitungan
        foreach ($totalNilai as $key => $alternatif) {
            foreach ($alternatif as $kriteria => $nilai) {
                $totalNilai[$key][$kriteria] *= $bobotKriteria[$kriteria];
            }
        }

        // Tahap Perangkingan
        $ranking = [];
        foreach ($totalNilai as $key => $alternatif) {
            $totalNilai[$key]['rank'] = 0; // Inisialisasi peringkat
            foreach ($alternatif as $kriteria => $nilai) {
                $totalNilai[$key]['rank'] += $nilai;
            }
            $ranking[$key] = $totalNilai[$key]['rank'];
        }
        // echo '<pre>';
        // echo 'Tahap Analisis (Perhitungan SAW):';
        // print_r($ranking);
        // echo '</pre>';
        // Urutkan peringkat dari besar ke kecil
        arsort($ranking);

        // Tambahkan peringkat ke hasil perhitungan
        foreach ($ranking as $key => $rank) {
            $totalNilai[$key]['rank'] = $rank;
        }

        return $totalNilai;
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
                    case '2,5 – 3,0':
                        return 0.2;
                    case '3,0 – 3,5':
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
}
