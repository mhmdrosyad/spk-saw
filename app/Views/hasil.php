<?= $this->extend('layout/page_layout') ?>

<?= $this->section('content') ?>
<div class="container mt-4">
    <h2>Data Hasil</h2>

    <?php if (!empty($hasilData)) : ?>
        <div class="card mt-3">
            <div class="card-body">
                <table class="table table-bordered">
                    <thead class="text-center text-white bg-primary">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>NIM</th>
                            <th>Rekomendasi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        <?php foreach ($hasilData as $key => $hasil) : ?>
                            <tr>
                                <td><?= $key + 1; ?></td>
                                <td><?= $hasil['nama']; ?></td>
                                <td><?= $hasil['nim']; ?></td>
                                <td style="color: green;"><?= $hasil['rekomendasi']; ?></td>
                                <td class="text-center">
                                    <a href="<?= base_url('home/hapus/' . $hasil['id']); ?>" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                        Hapus <i class="ti ti-trash fs-4 ms-2"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php else : ?>
        <div class="card mt-3">
            <div class="card-body">
                <p class="mt-3">Tidak ada data hasil yang tersedia.</p>
            </div>
        </div>
    <?php endif; ?>
</div>

<?= $this->endSection(); ?>