<?= $this->extend('layout/page_layout') ?>

<?= $this->section('content') ?>
<div class="container mt-4">
    <div class="card mt-3">
        <div class="card-header">
            <h2>Data Hasil</h2>
        </div>
        <div class="card-body">
            <?php if (session()->has('success')) : ?>
                <div class="alert alert-success" role="alert">
                    <?= session('success') ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($hasilData)) : ?>
                <div class="form-group">
                    <label for="topicFilter">Filter topic</label>
                    <select class="form-control" id="topicFilter" onchange="filterByTopic()">
                        <option value="">All Topics</option>
                        <?php foreach ($allTopics as $topic) : ?>
                            <option value="<?= $topic['topic']; ?>"><?= $topic['topic']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Tabel hasil -->
                <table class="table table-bordered" id="hasilTable">
                    <thead class="text-center text-white bg-primary">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>NIM</th>
                            <th>Rekomendasi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-center" id="filteredResults">
                        <?php foreach ($hasilData as $key => $hasil) : ?>
                            <tr>
                                <td><?= $key + 1; ?></td>
                                <td><?= $hasil['nama']; ?></td>
                                <td><?= $hasil['nim']; ?></td>
                                <td style="color: green;"><?= $hasil['rekomendasi']; ?></td>
                                <td class="text-center">
                                    <a href="<?= base_url('/hapus/' . $hasil['id']); ?>" class="btn btn-danger" onclick="deleteData(event, <?= $hasil['id'] ?>)">
                                        Hapus <i class="ti ti-trash fs-4 ms-2"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else : ?>
                <p class="mt-3">Tidak ada data hasil yang tersedia.</p>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
    // Data hasil awal
    var originalData = <?= json_encode($hasilData); ?>;

    function filterByTopic() {
        var selectedTopic = document.getElementById('topicFilter').value;

        // Menyaring data sesuai dengan topik yang dipilih
        var filteredData = selectedTopic === '' ?
            originalData :
            originalData.filter(data => data.rekomendasi === selectedTopic);

        // Memperbarui tampilan tabel hasil dengan data yang disaring
        updateTable(filteredData);
    }

    function updateTable(data) {
        var tableBody = document.getElementById('filteredResults');

        // Mengosongkan tabel sebelum memasukkan data baru
        tableBody.innerHTML = '';

        // Menambahkan data yang sesuai ke dalam tabel
        data.forEach((row, index) => {
            var deleteUrl = `<?= base_url('/hapus/') ?>${row.id}`;
            var newRow = `<tr>
                <td>${index + 1}</td>
                <td>${row.nama}</td>
                <td>${row.nim}</td>
                <td>${row.rekomendasi}</td>
                <td class="text-center">
                    <a href="${deleteUrl}" class="btn btn-danger" onclick="deleteData(event, ${row.id})">
                        Hapus <i class="ti ti-trash fs-4 ms-2"></i>
                    </a>
                </td>
            </tr>`;
            tableBody.innerHTML += newRow;
        });
    }

    function deleteData(event, id) {
        event.preventDefault();
        if (id) {
            var deleteUrl = `<?= base_url('hapus/') ?>${id}`;

            if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                fetch(deleteUrl, {
                        method: 'GET'
                    })
                    .then(response => response.json()) // Parse the JSON response
                    .then(data => {
                        if (data.success) {
                            // Handle success
                            alert('Data berhasil dihapus.');
                            location.reload();
                        } else {
                            throw new Error('Gagal menghapus data');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Terjadi kesalahan saat menghapus data.');
                    });
            }
        }
    }
</script>
<?= $this->endSection(); ?>