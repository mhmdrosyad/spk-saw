<?= $this->extend('layout/page_layout') ?>

<?= $this->section('content') ?>
<div class="container mt-4">
    <h2>Edit Alternatif</h2>

    <!-- Form untuk edit alternatif -->
    <form action="<?= base_url('home/updateAlternatif'); ?>" method="post">
        <input type="hidden" name="id" value="<?= $alternatif['id']; ?>">
        <div class="mb-3">
            <label for="topic" class="form-label">Topic</label>
            <input type="text" class="form-control" id="topic" name="topic" value="<?= $alternatif['topic']; ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
<?= $this->endSection(); ?>