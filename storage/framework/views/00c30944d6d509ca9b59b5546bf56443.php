

<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <!-- Search Bar & Tambah Button -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <input type="text" class="form-control w-25" placeholder="Search..." />
        <!-- Tombol untuk membuka modal -->
        <button class="btn btn-primary px-4 py-2" data-bs-toggle="modal" data-bs-target="#tambahFasilitasModal">
            + Tambah
        </button>
    </div>

    <!-- Modal Tambah Fasilitas -->
    <div class="modal fade" id="tambahFasilitasModal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">Tambah Fasilitas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="text" class="form-control mb-2" placeholder="Nama Fasilitas" />
                    <input class="form-control mb-2" placeholder="Kategori" />
                    <input type="text" class="form-control mb-2" placeholder="Kondisi" />
                    <input type="text" class="form-control mb-2" placeholder="Lokasi" />
                    <textarea class="form-control mb-2" placeholder="Deskripsi"></textarea>

                    <!-- Upload Gambar -->
                    <input type="file" class="form-control mb-2" accept="image/*" id="uploadImage" />
                    <div class="mt-2" id="imagePreviewContainer" style="display: none;">
                        <img id="imagePreview" class="img-thumbnail" style="max-width: 200px;" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button class="btn btn-success">Simpan</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Kartu Fasilitas -->
    <div class="row">
        <div class="col-md-4">
            <div class="card shadow-sm mb-4">
                <img class="card-img-top img-fluid" alt="Gambar Fasilitas">
                <div class="card-body">
                    <h5 class="card-title fw-bold">tes</h5>
                    <p class="mb-1"><strong>Kategori:</strong></p>
                    <p class="mb-1"><strong>Kondisi:</strong> </p>
                    <p class="mb-1"><strong>Lokasi:</strong> </p>
                    <p class="mb-1"><strong>Deskripsi:</strong></p>
                    <div class="d-flex justify-content-end gap-2">
                        <button class="btn btn-warning btn-sm"><i class="bi bi-pencil"></i></button>
                        <button class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.card {
    border-radius: 12px;
    transition: transform 0.2s ease-in-out;
}
.card:hover {
    transform: scale(1.03);
}
</style>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.getElementById("uploadImage").addEventListener("change", function(event) {
    const file = event.target.files[0];
    if (file) {
        const preview = document.getElementById("imagePreview");
        preview.src = URL.createObjectURL(file);
        document.getElementById("imagePreviewContainer").style.display = "block";
    }
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\try\resources\views/admin/fasilitas/dashboard.blade.php ENDPATH**/ ?>