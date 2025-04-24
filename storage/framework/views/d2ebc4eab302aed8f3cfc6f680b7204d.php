

<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h5>Edit Data Arsip</h5>
        </div>
        <div class="card-body">
        <form action="<?php echo e(route('arsip.update', $arsip->id)); ?>" method="POST" enctype="multipart/form-data">

                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>
                
                <div class="mb-3">
                    <label for="nama_dokumen" class="form-label">Nama Dokumen</label>
                    <input type="text" class="form-control" id="nama_dokumen" name="nama_dokumen" value="<?php echo e(old('nama_dokumen', $arsip->nama_dokumen)); ?>" required>
                </div>
                

                <div class="mb-3">
                    <label for="nama_pengirim" class="form-label">Pengirim</label>
                    <input type="text" class="form-control" id="nama_pengirim" name="nama_pengirim" value="<?php echo e(old('nama_pengirim', $arsip->nama_pengirim)); ?>" required>
                </div>

                <div class="mb-3">
                    <label for="nama_penerima" class="form-label">Penerima</label>
                    <input type="text" class="form-control" id="nama_penerima" name="nama_penerima" value="<?php echo e(old('nama_penerima', $arsip->nama_penerima)); ?>" required>
                </div>

                <div class="mb-3">
    <label for="kategori" class="form-label">Kategori Surat</label>
    <select class="form-select" id="kategori" name="kategori" required>
        <option value="">Pilih Kategori</option>
        <option value="Masuk" <?php echo e(old('kategori', $arsip->kategori) == 'Masuk' ? 'selected' : ''); ?>>Masuk</option>
        <option value="Keluar" <?php echo e(old('kategori', $arsip->kategori) == 'Keluar' ? 'selected' : ''); ?>>Keluar</option>
    </select>
</div>


<div class="mb-3">
    <label for="tujuan" class="form-label">Tujuan</label>
    <select class="form-select" id="tujuan" name="tujuan" required>
        <option value="">Pilih Tujuan</option>
        <option value="Pemerintahan" <?php echo e(old('tujuan', $arsip->tujuan) == 'Pemerintahan' ? 'selected' : ''); ?>>Pemerintahan</option>
        <option value="Pendidikan" <?php echo e(old('tujuan', $arsip->tujuan) == 'Pendidikan' ? 'selected' : ''); ?>>Pendidikan</option>
    </select>
</div>

<div class="mb-3">
    <label for="file_arsip" class="form-label">Upload File</label>
    <input type="file" class="form-control <?php $__errorArgs = ['file_arsip'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
           id="file_arsip" name="file_arsip" required
           accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
    
    <?php $__errorArgs = ['file_arsip'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
        <div class="invalid-feedback"><?php echo e($message); ?></div>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    
    <?php if(isset($arsip->file_path) && $arsip->file_path): ?>
        <div class="mt-2">
            <span class="badge bg-info text-dark">
                File saat ini: 
                <a href="<?php echo e(asset('storage/'.$arsip->file_path)); ?>" target="_blank" class="text-decoration-none">
                    <?php echo e(basename($arsip->file_path)); ?>

                </a>
            </span>
        </div>
    <?php endif; ?>
    
    <small class="text-muted">
        Format: PDF, DOC, DOCX, JPG, PNG (Maks. 10MB)
    </small>
</div>

                <div class="d-flex justify-content-end">
                    <a href="<?php echo e(route('arsip.index')); ?>" class="btn btn-secondary me-2">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\try\resources\views/admin/arsip/edit.blade.php ENDPATH**/ ?>