<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login User</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .password-toggle {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            z-index: 5;
        }
        .password-input-group {
            position: relative;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h2 class="text-center">Login User</h2>
                    </div>
                    <div class="card-body">
                        <form action="<?php echo e(route('user.login')); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <div class="form-group">
                                <label for="user_email">Email</label>
                                <input type="email" 
                                       class="form-control" 
                                       id="user_email" 
                                       name="email" 
                                       required
                                       autocomplete="email"
                                       aria-describedby="emailHelp">
                                <small id="emailHelp" class="form-text text-muted">Masukkan email Anda</small>
                            </div>
                            <div class="form-group">
                                <label for="user_password">Password</label>
                                <div class="password-input-group">
                                    <input type="password" 
                                           class="form-control" 
                                           id="user_password" 
                                           name="password" 
                                           required
                                           autocomplete="current-password"
                                           aria-describedby="passwordHelp">
                                    <i class="fas fa-eye password-toggle" id="togglePassword"></i>
                                </div>
                                <small id="passwordHelp" class="form-text text-muted">Masukkan password Anda</small>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const togglePassword = document.querySelector('#togglePassword');
            const password = document.querySelector('#user_password');
            
            togglePassword.addEventListener('click', function() {
                // Toggle the type attribute
                const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                password.setAttribute('type', type);
                
                // Toggle the eye icon
                this.classList.toggle('fa-eye');
                this.classList.toggle('fa-eye-slash');
            });
        });
    </script>
</body>
</html><?php /**PATH C:\laragon\www\try\resources\views/auth/user/login.blade.php ENDPATH**/ ?>