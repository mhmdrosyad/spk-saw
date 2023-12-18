<?= $this->extend('layout/page_layout') ?>

<?= $this->section('content') ?>
<div class="container mt-4">

    <!-- Card Tambah Alternatif -->
    <div class="card mb-4">
        <div class="card-body">
            <h2 class="card-title">Tambah Alternatif</h2>
            <!-- Form untuk tambah alternatif -->
            <form action="<?= base_url('alternatif/simpan'); ?>" method="post">
                <div class="mb-3">
                    <label for="topic" class="form-label">Topic</label>
                    <input type="text" class="form-control" id="topic" name="topic" required>
                </div>
                <button type="submit" class="btn btn-primary">
                    Simpan <i class="ti ti-file fs-4 ms-2"></i>
                </button>

            </form>
        </div>
    </div>

    <!-- Card Data Alternatif -->
    <div class="card">
        <div class="card-body">
            <h2 class="card-title">Data Alternatif</h2>
            <?php if (!empty($alternatifData)) : ?>
                <table class="table table-bordered mt-3">
                    <thead class="text-center bg-primary">
                        <tr>
                            <th>No</th>
                            <th>Topic</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($alternatifData as $key => $alternatif) : ?>
                            <tr>
                                <td><?= $key + 1; ?></td>
                                <td><?= $alternatif['topic']; ?></td>
                                <td class="text-center">
                                    <a href="<?= base_url('home/editAlternatif/' . $alternatif['id']); ?>" class="btn btn-warning">Edit <i class="ti ti-edit fs-4 ms-2"></i></a>
                                    <a href="<?= base_url('home/hapusAlternatif/' . $alternatif['id']); ?>" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus
                                        <i class="ti ti-trash fs-4 ms-2"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else : ?>
                <p>Tidak ada data alternatif yang tersedia.</p>
            <?php endif; ?>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>