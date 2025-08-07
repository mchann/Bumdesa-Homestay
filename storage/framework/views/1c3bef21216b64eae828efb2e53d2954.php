<?php $__env->startSection('content'); ?>
<div class="container d-flex flex-column justify-content-center align-items-center min-vh-100 py-5">
    <div class="w-100" style="max-width: 420px;">
        
        <div class="text-center mb-4">
            <h2 class="fw-bold mb-2" style="font-size: 1.75rem; color: #080909;">Welcome Back!</h2>
            <p class="text-muted">Sign in to your account</p>
        </div>

        
        <?php if($errors->any()): ?>
            <div class="alert alert-danger mb-4">
                <div class="d-flex align-items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-exclamation-circle-fill flex-shrink-0 me-2" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 4a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 1 0v-3A.5.5 0 0 0 8 4zm0 8a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0 0 1h1a.5.5 0 0 0 .5-.5z"/>
                    </svg>
                    <div>
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div><?php echo e($error); ?></div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <?php if(session('status')): ?>
            <div class="alert alert-success mb-4">
                <div class="d-flex align-items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-check-circle-fill flex-shrink-0 me-2" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                    </svg>
                    <div><?php echo e(session('status')); ?></div>
                </div>
            </div>
        <?php endif; ?>

        
        <div class="bg-white p-4 rounded-3 shadow-sm">
            <form method="POST" action="<?php echo e(route('login')); ?>" novalidate>
                <?php echo csrf_field(); ?>

                
                <div class="mb-4">
                    <label for="email" class="form-label fw-medium" style="color: #000000;">Email</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
                                <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2Zm13 2.383-4.708 2.825L15 11.105V5.383Zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741ZM1 11.105l4.708-2.897L1 5.383v5.722Z"/>
                            </svg>
                        </span>
                        <input id="email" name="email" type="email" 
                               class="form-control py-2 px-3 <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                               placeholder="Enter Your Email"
                               value="<?php echo e(old('email')); ?>" 
                               required 
                               autofocus
                               autocomplete="email">
                    </div>
                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback d-block">
                            <?php echo e($message); ?>

                        </div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                
                <div class="mb-3">
                    <label for="password" class="form-label fw-medium" style="color: #000000;">Password</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-lock" viewBox="0 0 16 16">
                                <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2zM5 8h6a1 1 0 0 1 1 1v5a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V9a1 1 0 0 1 1-1z"/>
                            </svg>
                        </span>
                        <input id="password" name="password" type="password" 
                               class="form-control py-2 px-3 <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                               placeholder="Enter Your Password" 
                               required
                               autocomplete="current-password">
                        
                    </div>
                    <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback d-block">
                            <?php echo e($message); ?>

                        </div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>>
                        <label class="form-check-label" for="remember" style="color: #000000;">
                            Remember me
                        </label>
                    </div>
                    <a href="<?php echo e(route('password.request')); ?>" class="text-decoration-none" style="color: #000000; font-weight: 500;">Forgot Password?</a>
                </div>

                
                <button type="submit" class="btn w-100 py-2 mb-3 fw-medium" style="border-radius: 8px; background-color: #0fb800; color: white;">
                    Sign in
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right ms-2" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
                    </svg>
                </button>
                
                
                <div class="text-center mb-4">
                    <p class="text-muted">Don't have an account? 
                        <a href="<?php echo e(route('register')); ?>" class="text-decoration-none fw-medium" style="color: #2e8b57;">Register here</a>
                    </p>
                </div>

                
                <div class="d-flex align-items-center my-4">
                    <hr class="flex-grow-1">
                    <span class="mx-3 text-muted">or continue with</span>
                    <hr class="flex-grow-1">
                </div>

                
                <div class="d-flex gap-3 justify-content-center">
                    <a href="<?php echo e(route('facebook.redirect')); ?>" 
                       class="btn d-flex align-items-center justify-content-center py-2 px-4 border rounded-3 fw-medium"
                       style="transition: all 0.3s ease; background-color: #f8f9fa;">
                        <div class="social-icon-wrapper me-2" style="width: 20px; height: 20px;">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="100%" height="100%" fill="#1877F2">
                                <path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"/>
                            </svg>
                        </div>
                        Facebook
                    </a>
                    <a href="<?php echo e(route('google.redirect')); ?>" 
                       class="btn d-flex align-items-center justify-content-center py-2 px-4 border rounded-3 fw-medium"
                       style="transition: all 0.3s ease; background-color: #f8f9fa;">
                        <div class="social-icon-wrapper me-2" style="width: 20px; height: 20px;">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="100%" height="100%">
                                <path fill="#EA4335" d="M5.266 9.765A7.077 7.077 0 0 1 12 4.909c1.69 0 3.218.6 4.418 1.582L19.91 3C17.782 1.145 15.055 0 12 0 7.27 0 3.198 2.698 1.24 6.65l4.026 3.115z"/>
                                <path fill="#34A853" d="M16.04 18.013c-1.09.703-2.474 1.078-4.04 1.078a7.077 7.077 0 0 1-6.723-4.823l-4.04 3.067A11.965 11.965 0 0 0 12 24c2.933 0 5.735-1.043 7.834-3l-3.793-2.987z"/>
                                <path fill="#4A90E2" d="M19.834 21c2.195-2.048 3.62-5.096 3.62-9 0-.71-.109-1.473-.272-2.182H12v4.637h6.436c-.317 1.559-1.17 2.766-2.395 3.558L19.834 21z"/>
                                <path fill="#FBBC05" d="M5.277 14.268A7.12 7.12 0 0 1 4.909 12c0-.782.125-1.533.357-2.235L1.24 6.65A11.934 11.934 0 0 0 0 12c0 1.92.445 3.73 1.237 5.335l4.04-3.067z"/>
                            </svg>
                        </div>
                        Google
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
<style>
    body {
        background-color: #f8f9fa;
    }
    .rounded-3 {
        border-radius: 12px !important;
    }
    .form-control {
        border: 1px solid #ced4da;
        border-radius: 8px !important;
        height: 44px;
    }
    .form-control:focus {
        border-color: #86b7fe;
        box-shadow: 0 0 0 0.25rem rgba(46, 139, 87, 0.25);
    }
    .btn:hover {
        opacity: 0.9;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    hr {
        border-color: #e5e7eb;
    }
    .social-icon-wrapper {
        display: flex;
        align-items: center;
        justify-content: center;
    }
    a.btn:hover {
        color: #2e8b57 !important;
        background-color: #e9ecef !important;
    }
    .input-group-text {
        border-radius: 8px 0 0 8px !important;
    }
    .toggle-password {
        cursor: pointer;
        border-radius: 0 8px 8px 0 !important;
    }
    .invalid-feedback {
        font-size: 0.875rem;
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Toggle password visibility
        document.querySelectorAll('.toggle-password').forEach(function(button) {
            button.addEventListener('click', function() {
                const target = document.querySelector(this.getAttribute('data-target'));
                const icon = this.querySelector('svg');
                
                if (target.type === 'password') {
                    target.type = 'text';
                    icon.classList.replace('bi-eye', 'bi-eye-slash');
                } else {
                    target.type = 'password';
                    icon.classList.replace('bi-eye-slash', 'bi-eye');
                }
            });
        });

        // Add animation to form elements
        const formElements = document.querySelectorAll('.form-control, .btn, .social-login-btn');
        formElements.forEach(el => {
            el.addEventListener('focus', () => {
                el.style.transition = 'all 0.3s ease';
            });
        });
    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layout.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\homestay-bumdes\resources\views/auth/login.blade.php ENDPATH**/ ?>