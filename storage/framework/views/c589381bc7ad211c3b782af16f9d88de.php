<?php $__env->startSection('content'); ?>
<div class="container d-flex flex-column justify-content-center align-items-center min-vh-100 py-5">
    <div class="w-100" style="max-width: 420px;">
        
        <div class="text-center mb-4">
            <h2 class="fw-bold mb-2" style="font-size: 1.75rem; color: #000000;">Create an Account</h2>
            <p class="text-muted">Join Dewitari Tamansari</p>
        </div>

        
        <?php if($errors->any()): ?>
            <div class="alert alert-danger mb-4">
                <ul class="mb-0">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

        
        <div class="bg-white p-4 rounded-3 shadow-sm">
            <form method="POST" action="<?php echo e(route('register')); ?>">
                <?php echo csrf_field(); ?>

                
                <div class="mb-4">
                    <label for="name" class="form-label fw-medium" style="color: #000000;">Name<span class="text-danger">*</span></label>
                    <input id="name" name="name" type="text" 
                           class="form-control py-2 px-3 <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                           placeholder="Enter Your Name"
                           value="<?php echo e(old('name')); ?>" required autofocus>
                    <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback">
                            <?php echo e($message); ?>

                        </div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                
                <div class="mb-4">
                    <label for="email" class="form-label fw-medium" style="color: #000000;">Email Address<span class="text-danger">*</span></label>
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
                           value="<?php echo e(old('email')); ?>" required>
                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback">
                            <?php echo e($message); ?>

                        </div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                
                <div class="mb-4">
                    <label for="password" class="form-label fw-medium" style="color: #000000;">Password<span class="text-danger">*</span></label>
                    <input id="password" name="password" type="password" 
                           class="form-control py-2 px-3 <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                           placeholder="Enter Your Password" required>
                    <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback">
                            <?php echo e($message); ?>

                        </div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                
                <div class="mb-4">
                    <label for="password_confirmation" class="form-label fw-medium" style="color: #000000;">Confirm Password<span class="text-danger">*</span></label>
                    <input id="password_confirmation" name="password_confirmation" type="password" 
                           class="form-control py-2 px-3" 
                           placeholder="Confirm Your Password" required>
                </div>

                
                <button type="submit" class="btn w-100 py-2 mb-3 fw-medium" style="border-radius: 8px; background-color: #03cb00; color: white;">
                    Register
                </button>

                
                <div class="text-center mb-4">
                    <p class="text-muted">Already have an account? 
                        <a href="<?php echo e(route('login')); ?>" class="text-decoration-none" style="color: #03cb00; font-weight: 500;">Login here</a>
                    </p>
                </div>

                
                <div class="d-flex align-items-center my-4">
                    <hr class="flex-grow-1">
                    <span class="mx-3 text-muted">Or Continue With</span>
                    <hr class="flex-grow-1">
                </div>

                
                <div class="d-flex gap-3 justify-content-center">
                    <a href="<?php echo e(route('facebook.redirect')); ?>" 
                       class="btn d-flex align-items-center justify-content-center py-2 px-4 border border-gray-300 bg-white rounded-3 fw-medium"
                       style="transition: all 0.3s ease;">
                        <div class="social-icon-wrapper me-2" style="width: 20px; height: 20px;">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="100%" height="100%" fill="#1877F2">
                                <path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"/>
                            </svg>
                        </div>
                        Facebook
                    </a>
                    <a href="<?php echo e(route('google.redirect')); ?>" 
                       class="btn d-flex align-items-center justify-content-center py-2 px-4 border border-gray-300 bg-white rounded-3 fw-medium"
                       style="transition: all 0.3s ease;">
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
    }
    .form-label {
        margin-bottom: 0.5rem;
        display: block;
    }
    .text-danger {
        color: #dc3545;
    }
</style>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layout.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\File Tugas Dinaaaaaa\Tugas Smt 5\PAL\tamansari tourism\resources\views/auth/register.blade.php ENDPATH**/ ?>