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

                <!-- Chart Container -->
                <div class="chart-container mt-3">
                    <div id="topicChart"></div>
                </div>

                <!-- Filter Dropdown -->
                <div class="form-group">
                    <label for="topicFilter">Filter topic</label>
                    <select class="form-control" id="topicFilter" onchange="filterByTopic()">
                        <option value="">All Topics</option>
                        <?php foreach ($allTopics as $topic) : ?>
                            <option value="<?= $topic['topic']; ?>"><?= $topic['topic']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Result Table with Responsive and Search Features -->
                <div class="table-responsive">
                    <table id="hasilTable" class="table table-striped">
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
                                    <td><?= $hasil['rekomendasi']; ?></td>
                                    <td class="text-center">
                                        <a href="<?= base_url('/hapus/' . $hasil['id']); ?>" class="btn btn-danger" onclick="deleteData(event, <?= $hasil['id'] ?>)">
                                            Hapus <i class="ti ti-trash fs-4 ms-2"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

            <?php else : ?>
                <p class="mt-3">Tidak ada data hasil yang tersedia.</p>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Highcharts Script -->
<script src="https://code.highcharts.com/highcharts.js"></script>
<!-- DataTables CSS and JS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.6/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.6/js/jquery.dataTables.js"></script>

<script>
    // Add color mapping for consistent colors
    var colorMap = {};

    var originalData = <?= json_encode($hasilData); ?>;

    updateChart(originalData);

    function filterByTopic() {
        var selectedTopic = document.getElementById('topicFilter').value;
        var filteredData = selectedTopic === '' ?
            originalData :
            originalData.filter(data => {
                var recomTopics = data.rekomendasi.split(',').map(topic => topic.trim());
                return recomTopics.includes(selectedTopic);
            });

        updateTable(filteredData);
    }


    function updateTable(data) {
        var tableBody = document.getElementById('filteredResults');
        tableBody.innerHTML = '';

        data.forEach((row, index) => {
            var deleteUrl = '<?= base_url('hapus/') ?>' + row.id;
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

        updateChart(originalData);

        // Destroy and redraw DataTable for updated content
        $('#hasilTable').DataTable().destroy();
        $('#hasilTable').DataTable();
    }

    function updateChart(data) {
        var topics = {};

        data.forEach(row => {
            var recomTopics = row.rekomendasi.split(',').map(topic => topic.trim());

            recomTopics.forEach(topic => {
                topics[topic] = (topics[topic] || 0) + 1;

                // Assign a color if not assigned before
                if (!colorMap[topic]) {
                    colorMap[topic] = getRandomColor();
                }
            });
        });

        var chartData = Object.keys(topics).map(topic => ({
            name: topic,
            y: topics[topic],
            color: colorMap[topic]
        }));

        Highcharts.chart('topicChart', {
            chart: {
                type: 'column',
                height: 300
            },
            title: {
                text: 'Grafik Rekomendasi Topik'
            },
            xAxis: {
                categories: chartData.map(item => item.name),
                labels: {
                    style: {
                        fontSize: '12px'
                    }
                }
            },
            yAxis: {
                title: {
                    text: 'Jumlah Rekomendasi'
                },
                labels: {
                    style: {
                        fontSize: '12px'
                    }
                }
            },
            legend: {
                enabled: false
            },
            plotOptions: {
                column: {
                    dataLabels: {
                        enabled: true,
                        color: '#333',
                        style: {
                            fontSize: '10px'
                        },
                        formatter: function() {
                            return this.y;
                        }
                    }
                }
            },
            series: [{
                name: 'Jumlah Rekomendasi',
                data: chartData
            }]
        });
    }

    function getRandomColor() {
        return '#' + Math.floor(Math.random() * 16777215).toString(16);
    }

    function deleteData(event, id) {
        event.preventDefault();
        if (id) {
            var deleteUrl = '<?= base_url('hapus/') ?>' + id;

            if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                fetch(deleteUrl, {
                        method: 'GET'
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
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

    // Function to change the number of rows displayed
    function changeRowCount() {
        var rowCount = document.getElementById('rowCount').value;
        $('#hasilTable').DataTable().page.len(rowCount).draw();
    }

    // Function to enable search on the table
    function searchTable() {
        var searchInput = document.getElementById('searchInput').value;
        $('#hasilTable').DataTable().search(searchInput).draw();
    }
</script>

<?= $this->endSection(); ?>