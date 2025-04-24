

<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <!-- Header -->
    <div class="card p-3 bg-primary text-white">
        <h5 class="m-0">Data Surat Arsip</h5>
    </div>

    <!-- Kontrol & Pencarian -->
    <div class="d-flex justify-content-between mt-3 align-items-center flex-wrap">
        <div class="d-flex mb-2">
            <a href="<?php echo e(route('arsip.create')); ?>" class="btn btn-primary me-2">
                <i class="fas fa-plus me-1"></i>Tambah Data
            </a>
            <form method="GET" action="<?php echo e(route('arsip.index')); ?>" class="d-flex" style="width: 250px;">
                <input type="text" name="search" class="form-control form-control-sm" 
                       placeholder="Cari dokumen/pengirim/penerima..." 
                       value="<?php echo e(request('search')); ?>"
                       aria-label="Search">
                <button class="btn btn-outline-secondary btn-sm" type="submit">
                    <i class="bi bi-search"></i>
                </button>
            </form>
        </div>

        <div class="d-flex align-items-center mb-2">
            <span class="me-2">Tampilkan:</span>
            <select class="form-select form-select-sm" style="width: 80px;" onchange="window.location.href = '?per_page=' + this.value + '&search=<?php echo e(request('search')); ?>'">
                <option value="5" <?php echo e(request('per_page') == 5 ? 'selected' : ''); ?>>5</option>
                <option value="10" <?php echo e(request('per_page') == 10 ? 'selected' : ''); ?>>10</option>
                <option value="25" <?php echo e(request('per_page') == 25 ? 'selected' : ''); ?>>25</option>
                <option value="50" <?php echo e(request('per_page') == 50 ? 'selected' : ''); ?>>50</option>
            </select>
        </div>
    </div>

    <?php if(request('search')): ?>
    <div class="alert alert-info mt-2 mb-3">
        Menampilkan hasil pencarian untuk: <strong><?php echo e(request('search')); ?></strong>
        <a href="<?php echo e(route('arsip.index')); ?>" class="float-end text-decoration-none">× Hapus pencarian</a>
    </div>
    <?php endif; ?>

    <!-- Tabel -->
    <div class="card mt-3">
        <div class="table-responsive">
            <table class="table table-bordered table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Nama Dokumen</th>
                        <th>Pengirim</th>
                        <th>Penerima</th>
                        <th>Kategori</th>
                        <th>Tujuan</th>
                        <th>File</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $arsips; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $arsip): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e(($arsips->currentPage() - 1) * $arsips->perPage() + $loop->iteration); ?></td>
                        <td><?php echo e($arsip->created_at->translatedFormat('d/m/Y H:i')); ?></td>
                        <td><?php echo e($arsip->nama_dokumen); ?></td>
                        <td><?php echo e($arsip->nama_pengirim); ?></td>
                        <td><?php echo e($arsip->nama_penerima); ?></td>
                        <td>
    <span class="badge border 
        <?php echo e($arsip->kategori == 'Masuk' ? 'border-success text-success' : 'border-danger text-danger'); ?> 
        bg-white">
        <?php echo e($arsip->kategori); ?>

    </span>
</td>

                        <td><?php echo e($arsip->tujuan); ?></td>
                        <td>
                            <?php if($arsip->file_path): ?>
                                <a href="<?php echo e(asset('storage/' . $arsip->file_path)); ?>" target="_blank">
                                    <?php echo e(basename($arsip->file_path)); ?>

                                </a>
                            <?php else: ?>
                                <span class="text-muted">Tidak ada file</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <a href="<?php echo e(route('arsip.edit', $arsip->id)); ?>" class="btn btn-warning" title="Edit">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <?php if($arsip->file_path): ?>
                                <a href="<?php echo e(asset('storage/' . $arsip->file_path)); ?>" class="btn btn-success" target="_blank" title="Download">
                                    <i class="bi bi-download"></i>
                                </a>
                                <?php endif; ?>
                                <form action="<?php echo e(route('arsip.destroy', $arsip->id)); ?>" method="POST" class="d-inline">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-danger" title="Hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="9" class="text-center">Tidak ada data ditemukan</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="card-footer">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">
                <div class="mb-2 mb-md-0">
                    Menampilkan <strong><?php echo e($arsips->firstItem()); ?></strong> - <strong><?php echo e($arsips->lastItem()); ?></strong> dari <strong><?php echo e($arsips->total()); ?></strong> data
                </div>
                <div>
                    <ul class="pagination pagination-sm m-0">
                        <?php if($arsips->onFirstPage()): ?>
                            <li class="page-item disabled"><span class="page-link">&laquo;</span></li>
                        <?php else: ?>
                            <li class="page-item">
                                <a class="page-link" href="<?php echo e($arsips->previousPageUrl()); ?>&per_page=<?php echo e(request('per_page')); ?>&search=<?php echo e(request('search')); ?>" rel="prev">&laquo;</a>
                            </li>
                        <?php endif; ?>

                        <?php $__currentLoopData = $arsips->getUrlRange(1, $arsips->lastPage()); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($page == $arsips->currentPage()): ?>
                                <li class="page-item active"><span class="page-link"><?php echo e($page); ?></span></li>
                            <?php else: ?>
                                <li class="page-item">
                                    <a class="page-link" href="<?php echo e($url); ?>&per_page=<?php echo e(request('per_page')); ?>&search=<?php echo e(request('search')); ?>"><?php echo e($page); ?></a>
                                </li>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        <?php if($arsips->hasMorePages()): ?>
                            <li class="page-item">
                                <a class="page-link" href="<?php echo e($arsips->nextPageUrl()); ?>&per_page=<?php echo e(request('per_page')); ?>&search=<?php echo e(request('search')); ?>" rel="next">&raquo;</a>
                            </li>
                        <?php else: ?>
                            <li class="page-item disabled"><span class="page-link">&raquo;</span></li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\try\resources\views/admin/arsip/dashboard.blade.php ENDPATH**/ ?>