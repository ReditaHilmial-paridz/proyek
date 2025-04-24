

<?php $__env->startSection('content'); ?>
<!-- Font Awesome CDN -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

<div class="container-fluid mt-4">
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="mb-3">Data Siswa</h2>
            <div class="d-flex align-items-center gap-2">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addStudentModal">
                    <i class="fas fa-plus me-1"></i>Tambah
                </button>
                 <form action="<?php echo e(route('siswa.template')); ?>" method="GET">
        <button type="submit" class="btn btn-success">
            <i class="fas fa-file-excel me-1"></i>Download Excel
        </button>
    </form>
            </div>
        </div>
    </div>
    
    <!-- Search & Counter Section -->
<div class="d-flex justify-content-between align-items-center flex-wrap mb-3">
    <div>
        <span id="shownCount">Menampilkan 0 dari <?php echo e(count($siswas)); ?></span>
    </div>
    <div class="input-group" style="max-width: 250px;">
        <span class="input-group-text"><i class="fas fa-search"></i></span>
        <input type="text" name="search" id="searchInput"
               class="form-control form-control-sm"
               placeholder="Cari siswa..." 
               value="<?php echo e(request('search')); ?>">
    </div>
</div>


    <!-- Table Section -->
    <div class="row">
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Status</th>
                            <th>Tanggal Masuk</th>
                            <th>Tanggal Keluar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="siswaTableBody">
                        <?php $__currentLoopData = $siswas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $siswa): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr id="row_<?php echo e($siswa->id); ?>">
                            <td><?php echo e($loop->iteration); ?></td>
                            <td><?php echo e($siswa->nama); ?></td>
                            <td><?php echo e($siswa->status); ?></td>
                            <td><?php echo e($siswa->tanggal_masuk); ?></td>
                            <td><?php echo e($siswa->tanggal_keluar ?? '-'); ?></td>
                            <td>
                                <div class="d-flex gap-2">
                                    <button class="btn btn-sm btn-warning edit-btn"
                                        data-id="<?php echo e($siswa->id); ?>"
                                        data-nama="<?php echo e($siswa->nama); ?>"
                                        data-status="<?php echo e($siswa->status); ?>"
                                        data-tanggal-masuk="<?php echo e($siswa->tanggal_masuk); ?>"
                                        data-tanggal-keluar="<?php echo e($siswa->tanggal_keluar); ?>"
                                        data-bs-toggle="modal" 
                                        data-bs-target="#editStudentModal">
                                        ✏️
                                    </button>
                                    <button class="btn btn-sm btn-danger delete-btn" 
                                        data-id="<?php echo e($siswa->id); ?>">
                                        🗑️</button>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
       
<!-- Modal Tambah Data Siswa -->
<div class="modal fade" id="addStudentModal" tabindex="-1" aria-labelledby="addStudentModalLabel" aria-hidden="true">
<div class="modal-dialog modal-fullscreen">
        <div class="modal-content" style="background-color: #d9d9d9; ">
            
            <!-- Modal Header -->
            <div class="modal-header border-0">
                <h4 class="modal-title w-100 text-center fw-bold" id="addStudentModalLabel">Tambah Data Siswa</h4>
            </div>

            <!-- Modal Body -->
            <div class="modal-body px-4">
                <form id="addStudentForm" action="<?php echo e(route('siswa.store')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama</label>
                        <input type="text" class="form-control rounded-1" name="nama" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Status</label>
                        <input type="text" class="form-control rounded-1" name="status" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Tanggal Masuk</label>
                        <input type="date" class="form-control rounded-1" name="tanggal_masuk" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Tanggal Keluar</label>
                        <input type="date" class="form-control rounded-1" name="tanggal_keluar">
                    </div>

                    <!-- Modal Footer -->
                    <div class="d-flex justify-content-end gap-2 mt-4">
                        <button type="button" class="btn" data-bs-dismiss="modal"
                            style="background-color: #c2c2f0; color: black; min-width: 100px;">Batal</button>
                        <button type="submit" class="btn"
                            style="background-color: #0d47a1; color: white; min-width: 100px;">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Modal Edit Data Siswa -->
<div class="modal fade" id="editStudentModal" tabindex="-1" aria-labelledby="editStudentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content" style="background-color: #d9d9d9;">
            <!-- Modal Header -->
            <div class="modal-header border-0">
                <h4 class="modal-title w-100 text-center fw-bold" id="editStudentModalLabel">Edit Data Siswa</h4>
            </div>

            <!-- Modal Body -->
            <div class="modal-body px-4">
                <form id="editStudentForm">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" id="editId">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama</label>
                        <input type="text" class="form-control rounded-1" id="editNama" required />
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Status</label>
                        <input type="text" class="form-control rounded-1" id="editStatus" required />
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Tanggal Masuk</label>
                        <input type="date" class="form-control rounded-1" id="editTanggalMasuk" required />
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Tanggal Keluar</label>
                        <input type="date" class="form-control rounded-1" id="editTanggalKeluar" />
                    </div>

                    <!-- Modal Footer -->
                    <div class="d-flex justify-content-end gap-2 mt-4">
                        <button type="button" class="btn" data-bs-dismiss="modal"
                            style="background-color: #c2c2f0; color: black; min-width: 100px;">Batal</button>
                        <button type="submit" class="btn"
                            style="background-color: #0d47a1; color: white; min-width: 100px;">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- jQuery harus dimuat dulu -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="<?php echo e(asset('js/siswa.js')); ?>"></script>

<!-- AJAX Script -->
<script >

    
    $(document).ready(function () {

         // 🔍 Fitur Pencarian dengan Update Jumlah Tampilan
         $('#searchInput').on('keyup', function () {
            let value = $(this).val().toLowerCase();
            let visibleCount = 0;

            $('#siswaTableBody tr').each(function () {
                let isMatch = $(this).text().toLowerCase().indexOf(value) > -1;
                $(this).toggle(isMatch);
                if (isMatch) visibleCount++;
            });

            // 🧮 Update jumlah entri yang tampil
            $('#shownCount').text(`Menampilkan ${visibleCount} dari <?php echo e(count($siswas)); ?>`);
        });
        // 🟢 Tambah Data Siswa
        $('#addStudentForm').submit(function (e) {
    e.preventDefault();
    const formData = $(this).serialize();

    $.ajax({
        url: $(this).attr('action'), // Lebih fleksibel daripada hardcode route
        method: "POST",
        data: formData,
        success: function (response) {
            if (response.success) {
                const siswa = response.siswa;
                const rowCount = $('#siswaTableBody tr').length;

                const row = `
                    <tr id="row_${siswa.id}">
                        <td>${rowCount + 1}</td>
                        <td>${siswa.nama}</td>
                        <td>${siswa.status}</td>
                        <td>${siswa.tanggal_masuk}</td>
                        <td>${siswa.tanggal_keluar ?? '-'}</td>
                        <td>
                            <button class="btn btn-primary btn-sm edit-btn" 
                                    data-id="${siswa.id}"
                                    data-nama="${siswa.nama}"
                                    data-status="${siswa.status}"
                                    data-tanggal-masuk="${siswa.tanggal_masuk}"
                                    data-tanggal-keluar="${siswa.tanggal_keluar ?? ''}"
                                    data-bs-toggle="modal" 
                                    data-bs-target="#editStudentModal">✏️</button>
                            <button class="btn btn-danger btn-sm delete-btn" data-id="${siswa.id}">🗑️</button>
                        </td>
                    </tr>
                `;

                $('#siswaTableBody').append(row);
                $('#addStudentModal').modal('hide');
                $('#addStudentForm')[0].reset();
                alert("Data siswa berhasil ditambahkan!");
            } else {
                alert("Terjadi kesalahan saat menambahkan data.");
            }
        },
        error: function (xhr) {
            alert("Error: " + xhr.responseText);
        }
    });
});



    // 🖊️ Event untuk tombol Edit
    $(document).on('click', '.edit-btn', function () {
        let id = $(this).data('id');
        let nama = $(this).data('nama');
        let status = $(this).data('status');
        let tanggalMasuk = $(this).data('tanggal-masuk');
        let tanggalKeluar = $(this).data('tanggal-keluar');

        // Isi form dalam modal
        $('#editId').val(id);
        $('#editNama').val(nama);
        $('#editStatus').val(status);
        $('#editTanggalMasuk').val(tanggalMasuk);
        $('#editTanggalKeluar').val(tanggalKeluar);

        // Tampilkan modal edit
        $('#editStudentModal').modal('show');
    });

    // 📝 Kirim Form Edit ke Server
$('#editStudentForm').off('submit').on('submit', function (e) {
    e.preventDefault();

    let id = $('#editId').val();
    let formData = {
        _token: "<?php echo e(csrf_token()); ?>",
        _method: "PUT", // Laravel menerima update dengan PUT
        nama: $('#editNama').val(),
        status: $('#editStatus').val(),
        tanggal_masuk: $('#editTanggalMasuk').val(),
        tanggal_keluar: $('#editTanggalKeluar').val()
    };

    $.ajax({
        url: `/siswa/${id}`,
        type: "POST", // Laravel hanya menerima POST, gunakan _method: PUT
        data: formData,
        success: function (response) {
            if (response.success) {
                let siswa = response.siswa;

                // 🔄 Update tampilan tabel tanpa reload
                let updatedRow = `
                    <td>${siswa.id}</td>
                    <td>${siswa.nama}</td>
                    <td>${siswa.status}</td>
                    <td>${siswa.tanggal_masuk}</td>
                    <td>${siswa.tanggal_keluar ?? '-'}</td>
                    <td>
                        <button class="btn btn-primary edit-btn"
                            data-id="${siswa.id}"
                            data-nama="${siswa.nama}"
                            data-status="${siswa.status}"
                            data-tanggal-masuk="${siswa.tanggal_masuk}"
                            data-tanggal-keluar="${siswa.tanggal_keluar}"
                            data-bs-toggle="modal"
                            data-bs-target="#editStudentModal">
                            ✏️
                        </button>
                        <button class="btn btn-danger delete-btn" data-id="${siswa.id}">🗑️</button>
                    </td>
                `;

                // Ganti isi row dengan data baru dan beri efek highlight kuning
                $(`#row_${id}`).html(updatedRow).addClass('table-warning');

                // Efek highlight hanya 2 detik
                setTimeout(() => {
                    $(`#row_${id}`).removeClass('table-warning');
                }, 2000);

                // Tutup modal edit
                $('#editStudentModal').modal('hide');

                alert("Data siswa berhasil diperbarui!");
            } else {
                alert("Gagal memperbarui data.");
            }
        },
        error: function (xhr) {
            alert("Error: " + xhr.responseText);
        }
    });
});




        // 🔴 Hapus Data Siswa
        $(document).on('click', '.delete-btn', function () {
            let id = $(this).data('id');
            if (confirm("Apakah kamu yakin ingin menghapus data ini?")) {
                $.ajax({
                    url: `/siswa/${id}`,
                    type: "POST", // Laravel hanya menerima POST
                    data: {
                        _method: "DELETE",
                        _token: "<?php echo e(csrf_token()); ?>"
                    },
                    success: function (response) {
                        if (response.success) {
                            $(`#row_${id}`).remove();
                            alert("Data siswa berhasil dihapus!");
                        } else {
                            alert("Gagal menghapus data.");
                        }
                    },
                    error: function (xhr) {
                        alert("Error: " + xhr.responseText);
                    }
                });
            }
        });
    });

    $(document).ready(function () {
    $('#searchInput').on('keyup', function () {
        let value = $(this).val().toLowerCase();
        $('#siswaTableBody tr').filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
    });
});
</script>

<style>
    .modal-custom {
    max-width: 850px; /* Ukuran sedang, bisa diatur sesuai kebutuhan */
    width: 1000%;
}

@media (max-width: 768px) {
        .table th, .table td {
            padding: 0.5rem;
            font-size: 0.875rem;
        }
        
        .btn {
            min-width: auto;
            padding: 0.25rem 0.5rem;
        }
        
        .modal-body {
            padding: 1rem;
        }
    }
    
    .table-hover tbody tr:hover {
        background-color: #f8f9fa;
    }

</style>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\try\resources\views/admin/siswa/dashboard.blade.php ENDPATH**/ ?>