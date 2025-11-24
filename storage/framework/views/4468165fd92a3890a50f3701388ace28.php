<?php $__env->startSection('title', 'Tambah Kamar'); ?>

<?php $__env->startSection('content'); ?>
<head>
 <style>
        :root {
            --primary: #10B981;
            --primary-dark: #059669;
            --primary-light: #A7F3D0;
            --secondary: #3B82F6;
            --light: #F3F4F6;
            --dark: #1F2937;
            --gray: #9CA3AF;
            --danger: #EF4444;
            --success: #10B981;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #ECFDF5 0%, #F0FDF4 100%);
            color: var(--dark);
            min-height: 100vh;
        }
        
        .container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 20px;
        }
        
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .header h1 {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 10px;
            background: linear-gradient(90deg, var(--primary) 0%, var(--primary-dark) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        
        .header p {
            font-size: 1.1rem;
            color: var(--gray);
        }
        
        .card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            margin-bottom: 30px;
            border-top: 4px solid var(--primary);
        }
        
        .card-header {
            background: linear-gradient(90deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: white;
            padding: 20px 25px;
            font-size: 1.2rem;
            font-weight: 600;
        }
        
        .card-body {
            padding: 25px;
        }
        
        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-group.full-width {
            grid-column: span 2;
        }
        
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: var(--dark);
        }
        
        .input-group {
            position: relative;
        }
        
        input, select, textarea {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #E5E7EB;
            border-radius: 10px;
            font-size: 1rem;
            transition: all 0.3s;
            background: white;
        }
        
        input:focus, select:focus, textarea:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.2);
        }
        
        .input-icon {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray);
        }
        
        .currency-prefix {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--dark);
            font-weight: 500;
        }
        
        .input-with-icon {
            padding-left: 45px;
        }
        
        .error-message {
            color: var(--danger);
            font-size: 0.85rem;
            margin-top: 5px;
            display: flex;
            align-items: center;
            gap: 5px;
        }
        
        .image-upload {
            display: flex;
            align-items: center;
            gap: 20px;
        }
        
        .image-preview {
            width: 150px;
            height: 120px;
            border: 2px dashed var(--primary-light);
            border-radius: 10px;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--light);
        }
        
        .image-preview img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .upload-area {
            flex: 1;
            border: 2px dashed var(--primary-light);
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s;
            background: #F0FDF4;
        }
        
        .upload-area:hover {
            border-color: var(--primary);
            background: rgba(16, 185, 129, 0.1);
        }
        
        .upload-icon {
            font-size: 2rem;
            color: var(--primary);
            margin-bottom: 10px;
        }
        
        .facilities-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 12px;
        }
        
        .facility-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px;
            border-radius: 8px;
            background: #F0FDF4;
            transition: all 0.2s;
        }
        
        .facility-item:hover {
            background: #D1FAE5;
        }
        
        .facility-item input[type="checkbox"] {
            width: 18px;
            height: 18px;
            accent-color: var(--primary);
        }
        
        .btn-submit {
            background: linear-gradient(90deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: white;
            border: none;
            padding: 15px 30px;
            border-radius: 10px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: all 0.3s;
            box-shadow: 0 4px 6px rgba(16, 185, 129, 0.3);
            margin: 0 auto;
        }
        
        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 10px rgba(16, 185, 129, 0.4);
        }
        
        @media (max-width: 768px) {
            .form-grid {
                grid-template-columns: 1fr;
            }
            
            .form-group.full-width {
                grid-column: span 1;
            }
            
            .image-upload {
                flex-direction: column;
            }
            
            .image-preview {
                width: 100%;
                height: 150px;
            }
            
            .facilities-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Tambah Kamar Baru</h1>
            <p>Isi detail kamar untuk homestay Anda</p>
        </div>
        
        <div class="card">
            <div class="card-header">
                <i class="fas fa-bed"></i> Informasi Kamar
            </div>
            <div class="card-body">
                <form action="<?php echo e(route('pemilik.kamar.store')); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    
                    <div class="form-grid">
                        <!-- Homestay Selection -->
                        <div class="form-group full-width">
                            <label for="homestay_id">Pilih Homestay</label>
                            <div class="input-group">
                                <select name="homestay_id" id="homestay_id" required>
                                    <?php $__currentLoopData = $homestays; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $homestay): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($homestay->homestay_id); ?>"><?php echo e($homestay->nama_homestay); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <?php $__errorArgs = ['homestay_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="error-message">
                                    <i class="fas fa-exclamation-circle"></i> <?php echo e($message); ?>

                                </div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        
                        <!-- Jenis Kamar Selection -->
                        <div class="form-group full-width">
                            <label for="jenis_kamar_id">Jenis Kamar</label>
                            <div class="input-group">
                                <select name="jenis_kamar_id" id="jenis_kamar_id" required>
                                    <option value="">-- Pilih Jenis Kamar --</option>
                                    <?php $__currentLoopData = $jenisKamars; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $jenis): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($jenis->jenis_kamar_id); ?>"><?php echo e($jenis->nama_jenis); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <?php $__errorArgs = ['jenis_kamar_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="error-message">
                                    <i class="fas fa-exclamation-circle"></i> <?php echo e($message); ?>

                                </div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        
                        <!-- Room Name -->
                        <div class="form-group">
                            <label for="nama_kamar">Nama Kamar</label>
                            <input type="text" name="nama_kamar" id="nama_kamar" value="<?php echo e(old('nama_kamar')); ?>" required>
                            <?php $__errorArgs = ['nama_kamar'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="error-message">
                                    <i class="fas fa-exclamation-circle"></i> <?php echo e($message); ?>

                                </div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        
                        <!-- Capacity -->
                        <div class="form-group">
                            <label for="kapasitas">Kapasitas (orang)</label>
                            <input type="number" name="kapasitas" id="kapasitas" value="<?php echo e(old('kapasitas')); ?>" min="1" required>
                            <?php $__errorArgs = ['kapasitas'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="error-message">
                                    <i class="fas fa-exclamation-circle"></i> <?php echo e($message); ?>

                                </div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        
                        <!-- Price -->
                        <div class="form-group">
                            <label for="harga">Harga per Malam (Rp)</label>
                            <div class="input-group">
                                <div class="currency-prefix">Rp</div>
                                <input type="number" name="harga" id="harga" class="input-with-icon" value="<?php echo e(old('harga')); ?>" step="1000" required>
                            </div>
                            <?php $__errorArgs = ['harga'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="error-message">
                                    <i class="fas fa-exclamation-circle"></i> <?php echo e($message); ?>

                                </div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        
                        <!-- Room Photo -->
                        <div class="form-group full-width">
                            <label>Foto Kamar</label>
                            <div class="image-upload">
                                <div class="image-preview">
                                    <img id="preview" src="https://via.placeholder.com/300x200?text=Upload+Photo" alt="Preview">
                                </div>
                                <label class="upload-area" for="foto_kamar">
                                    <div class="upload-icon">
                                        <i class="fas fa-cloud-upload-alt"></i>
                                    </div>
                                    <p class="upload-text">Klik untuk upload atau drag & drop</p>
                                    <p class="upload-info">PNG, JPG, JPEG (Max. 5MB)</p>
                                    <input type="file" name="foto_kamar" id="foto_kamar" accept="image/*" required style="display: none;">
                                </label>
                            </div>
                            <?php $__errorArgs = ['foto_kamar'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="error-message">
                                    <i class="fas fa-exclamation-circle"></i> <?php echo e($message); ?>

                                </div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        
                        <!-- Facilities -->
                        <div class="form-group full-width">
                            <label>Fasilitas Kamar</label>
                            <div class="facilities-grid">
                                <?php $__currentLoopData = $fasilitas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $f): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="facility-item">
                                        <input type="checkbox" name="fasilitas[]" value="<?php echo e($f->fasilitas_id); ?>" id="facility-<?php echo e($f->fasilitas_id); ?>" 
                                            <?php echo e(in_array($f->fasilitas_id, old('fasilitas', [])) ? 'checked' : ''); ?>>
                                        <label for="facility-<?php echo e($f->fasilitas_id); ?>"><?php echo e($f->nama_fasilitas); ?></label>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            <?php $__errorArgs = ['fasilitas'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="error-message">
                                    <i class="fas fa-exclamation-circle"></i> <?php echo e($message); ?>

                                </div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>
                    
                    <!-- Submit Button -->
                    <div style="text-align: center; margin-top: 30px;">
                        <button type="submit" class="btn-submit">
                            <i class="fas fa-plus-circle"></i> Tambah Kamar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Image preview functionality
            const photoInput = document.getElementById('foto_kamar');
            const preview = document.getElementById('preview');
            
            photoInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(event) {
                        preview.src = event.target.result;
                    };
                    reader.readAsDataURL(file);
                }
            });
            
            // Drag and drop for image upload
            const uploadArea = document.querySelector('.upload-area');
            
            uploadArea.addEventListener('dragover', function(e) {
                e.preventDefault();
                this.style.borderColor = '#10B981';
                this.style.backgroundColor = 'rgba(16, 185, 129, 0.2)';
            });
            
            uploadArea.addEventListener('dragleave', function() {
                this.style.borderColor = '#A7F3D0';
                this.style.backgroundColor = '#F0FDF4';
            });
            
            uploadArea.addEventListener('drop', function(e) {
                e.preventDefault();
                this.style.borderColor = '#A7F3D0';
                this.style.backgroundColor = '#F0FDF4';
                
                const file = e.dataTransfer.files[0];
                if (file && file.type.startsWith('image/')) {
                    photoInput.files = e.dataTransfer.files;
                    
                    const reader = new FileReader();
                    reader.onload = function(event) {
                        preview.src = event.target.result;
                    };
                    reader.readAsDataURL(file);
                }
            });
        });
    </script>
</body>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.pemilik', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\US3R\Downloads\tamansari tourism\resources\views/pemilik/kamar/create.blade.php ENDPATH**/ ?>