

<?php $__env->startSection('content'); ?>
    <div class="container">
        <h1 class="my-4">Tambah Akun</h1>
        <form id="akunForm" action="<?php echo e(route('akun.store')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div class="form-group">
                <label for="akun_name">Nama Lengkap</label>
                <input type="text" 
                       name="name" 
                       id="akun_name" 
                       class="form-control" 
                       required
                       autocomplete="name"
                       aria-describedby="nameHelp">
                <small id="nameHelp" class="form-text text-muted">Masukkan nama lengkap</small>
            </div>
            
            <div class="form-group">
                <label for="akun_email">Email</label>
                <input type="email" 
                       name="email" 
                       id="akun_email" 
                       class="form-control" 
                       required
                       autocomplete="email"
                       aria-describedby="emailHelp">
                <small id="emailHelp" class="form-text text-muted">Contoh: user@example.com</small>
            </div>
            
            <div class="form-group">
                <label for="akun_password">Password</label>
                <input type="password" 
                       name="password" 
                       id="akun_password" 
                       class="form-control" 
                       required
                       minlength="6"
                       autocomplete="new-password"
                       aria-describedby="passwordHelp">
                <small id="passwordHelp" class="form-text text-muted">Minimal 6 karakter</small>
            </div>
            
            <div class="form-group">
                <label for="akun_role">Role</label>
                <select name="role" 
                        id="akun_role" 
                        class="form-control" 
                        required
                        aria-describedby="roleHelp">
                    <option value="">Pilih Role</option>
                    <option value="siswa aktif">Siswa Aktif</option>
                    <option value="calon siswa">Calon Siswa</option>
                    <option value="alumni">Alumni</option>
                </select>
                <small id="roleHelp" class="form-text text-muted">Pilih role pengguna</small>
            </div>
            
            <div class="mt-3">
                <button type="submit" class="btn btn-primary">Buat Akun</button>
                <a href="<?php echo e(route('akun.index')); ?>" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>

    <!-- Modal Validasi -->
    <div class="modal fade" id="validationModal" tabindex="-1" aria-labelledby="validationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-warning text-white">
                    <h5 class="modal-title" id="validationModalLabel">Perbaiki Input</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="validationMessage">
                    <!-- Pesan validasi akan muncul di sini -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Mengerti</button>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function() {
        $('#akunForm').submit(function(e) {
            e.preventDefault();
            
            // Reset error states
            $('.is-invalid').removeClass('is-invalid');
            
            // Validate inputs
            let isValid = true;
            let errorMessage = '';
            
            // Name validation
            const name = $('#akun_name').val().trim();
            if (name.length < 3) {
                $('#akun_name').addClass('is-invalid');
                errorMessage += '<p>- Nama harus minimal 3 karakter</p>';
                isValid = false;
            }
            
            // Email validation
            const email = $('#akun_email').val().trim();
            if (!email.includes('@') || !email.includes('.')) {
                $('#akun_email').addClass('is-invalid');
                errorMessage += '<p>- Email tidak valid</p>';
                isValid = false;
            }
            
            // Password validation
            const password = $('#akun_password').val();
            if (password.length < 6) {
                $('#akun_password').addClass('is-invalid');
                errorMessage += '<p>- Password harus minimal 6 karakter</p>';
                isValid = false;
            }
            
            // Role validation
            const role = $('#akun_role').val();
            if (!role) {
                $('#akun_role').addClass('is-invalid');
                errorMessage += '<p>- Harap pilih role</p>';
                isValid = false;
            }
            
            if (!isValid) {
                $('#validationMessage').html('<p>Harap perbaiki kesalahan berikut:</p>' + errorMessage);
                $('#validationModal').modal('show');
                return false;
            }
            
            // If all valid, submit the form
            this.submit();
        });
    });
    </script>

    <style>
        .is-invalid {
            border-color: #dc3545;
        }
        .invalid-feedback {
            color: #dc3545;
            display: none;
            width: 100%;
            margin-top: 0.25rem;
            font-size: 0.875em;
        }
        .is-invalid ~ .invalid-feedback {
            display: block;
        }
    </style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\try\resources\views/admin/akun/create.blade.php ENDPATH**/ ?>