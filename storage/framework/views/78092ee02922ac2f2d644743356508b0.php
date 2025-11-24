

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-store me-2 text-primary"></i>Tambah Produk UMKM
        </h1>
        <a href="<?php echo e(route('admin.umkm.index')); ?>" class="btn btn-outline-secondary shadow-sm">
            <i class="fas fa-arrow-left me-1"></i> Kembali ke Daftar Produk
        </a>
    </div>

    <div class="card shadow mb-4 border-0">
        <div class="card-body">
            <form action="<?php echo e(route('admin.umkm.store')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>

                <div class="row">
                    <!-- Kolom Kiri -->
                    <div class="col-md-8">
                        <div class="form-group mb-4">
                            <label for="nama_produk" class="fw-semibold">Nama Produk <span class="text-danger">*</span></label>
                            <input type="text" class="form-control <?php $__errorArgs = ['nama_produk'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                   id="nama_produk" name="nama_produk" 
                                   value="<?php echo e(old('nama_produk')); ?>" 
                                   placeholder="Masukkan nama produk" required>
                            <?php $__errorArgs = ['nama_produk'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="form-group mb-4">
                            <label for="deskripsi" class="fw-semibold">Deskripsi <span class="text-danger">*</span></label>
                            <textarea class="form-control <?php $__errorArgs = ['deskripsi'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                      id="deskripsi" name="deskripsi" rows="5" 
                                      placeholder="Deskripsikan produk secara detail" required><?php echo e(old('deskripsi')); ?></textarea>
                            <?php $__errorArgs = ['deskripsi'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <small class="form-text text-muted">Minimal 50 karakter untuk deskripsi yang informatif</small>
                        </div>

                        <!-- Field No. Telepon Owner -->
<div class="form-group mb-4">
    <label for="no_telepon_owner" class="fw-semibold">No. Telepon Owner <span class="text-danger">*</span></label>
    <input type="text" 
           class="form-control <?php $__errorArgs = ['no_telepon_owner'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
           id="no_telepon_owner" 
           name="no_telepon_owner" 
           value="<?php echo e(old('no_telepon_owner')); ?>" 
           placeholder="Contoh: 6281234567890" 
           pattern="^(\+62|62|0)8[1-9][0-9]{6,9}$"
           title="Format: 08xxx, +628xxx, atau 628xxx (minimal 10-13 digit)"
           required
           oninput="formatPhoneNumber(this)">
    <?php $__errorArgs = ['no_telepon_owner'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
        <div class="invalid-feedback"><?php echo e($message); ?></div>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    <small class="form-text text-muted">
        Format: 08xxx, +628xxx, atau 628xxx (contoh: 081234567890, +6281234567890, 6281234567890). 
        Akan otomatis dikonversi ke format WhatsApp (62xxxxxxxxxxx).
    </small>
    <div id="phone-format-info" class="form-text text-success" style="display: none;">
        ✅ Format nomor telepon valid untuk WhatsApp
    </div>
</div>
                    <!-- Kolom Kanan - Upload Gambar -->
                    <div class="col-md-4">
                        <div class="form-group mb-4">
                            <label class="fw-semibold">Gambar Produk <span class="text-danger">*</span></label>
                            <div class="upload-area border rounded-3 p-3 bg-light d-flex flex-column align-items-center justify-content-center" 
                                 style="height: 220px; cursor: pointer;" 
                                 onclick="document.getElementById('gambar').click()">
                                <div class="preview-container text-center">
                                    <img id="preview-image" class="img-fluid mb-2 rounded" 
                                         style="max-height: 150px; display:none;">
                                    <span class="remove-image" onclick="removeImage(event)" 
                                          style="display: none;">
                                        <i class="fas fa-times text-danger"></i>
                                    </span>
                                </div>
                                <div id="upload-placeholder" class="text-center">
                                    <i class="fas fa-cloud-upload-alt fa-2x text-muted mb-3"></i>
                                    <p class="mb-1 fw-medium">Klik untuk upload gambar</p>
                                    <small class="text-muted">Drag & drop disini</small>
                                </div>
                                <input type="file" class="d-none <?php $__errorArgs = ['gambar'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                       id="gambar" name="gambar" accept="image/*" 
                                       required onchange="previewImage(event)">
                                <?php $__errorArgs = ['gambar'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="invalid-feedback d-block"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <small class="form-text text-muted mt-2">
                                Format: JPG, PNG, GIF (Maksimal 2MB). Rekomendasi rasio 1:1 untuk tampilan terbaik.
                            </small>
                        </div>
                    </div>
                </div>

                <hr class="my-4">

                <!-- Informasi Harga & Kategori -->
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="harga" class="fw-semibold">Harga (Rp) <span class="text-danger">*</span></label>
                            <input type="number" class="form-control <?php $__errorArgs = ['harga'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                   id="harga" name="harga" min="0" 
                                   value="<?php echo e(old('harga')); ?>" 
                                   placeholder="0" required>
                            <?php $__errorArgs = ['harga'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="kategori" class="fw-semibold">Kategori <span class="text-danger">*</span></label>
                            <select class="form-control <?php $__errorArgs = ['kategori'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                    id="kategori" name="kategori" required>
                                <option value="">Pilih Kategori</option>
                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($category); ?>" <?php echo e(old('kategori') == $category ? 'selected' : ''); ?>>
                                        <?php echo e($category); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php $__errorArgs = ['kategori'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="stok" class="fw-semibold">Stok <span class="text-danger">*</span></label>
                            <input type="number" class="form-control <?php $__errorArgs = ['stok'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                   id="stok" name="stok" min="0" 
                                   value="<?php echo e(old('stok', 0)); ?>" 
                                   placeholder="0" required>
                            <?php $__errorArgs = ['stok'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>
                </div>

                <!-- Informasi Berat & Status -->
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group mb-3">
                            <label for="berat" class="fw-semibold">Berat <span class="text-danger">*</span></label>
                            <input type="number" class="form-control <?php $__errorArgs = ['berat'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                   id="berat" name="berat" min="0" step="0.01" 
                                   value="<?php echo e(old('berat', 0)); ?>" 
                                   placeholder="0.00" required>
                            <?php $__errorArgs = ['berat'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group mb-3">
                            <label for="satuan_berat" class="fw-semibold">Satuan Berat <span class="text-danger">*</span></label>
                            <select class="form-control <?php $__errorArgs = ['satuan_berat'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                    id="satuan_berat" name="satuan_berat" required>
                                <option value="gr" <?php echo e(old('satuan_berat') == 'gr' ? 'selected' : ''); ?>>Gram (gr)</option>
                                <option value="kg" <?php echo e(old('satuan_berat') == 'kg' ? 'selected' : ''); ?>>Kilogram (kg)</option>
                                <option value="ml" <?php echo e(old('satuan_berat') == 'ml' ? 'selected' : ''); ?>>Mililiter (ml)</option>
                            </select>
                            <?php $__errorArgs = ['satuan_berat'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group mb-3">
                            <label for="badge" class="fw-semibold">Badge</label>
                            <select class="form-control" id="badge" name="badge">
                                <option value="">Tidak ada badge</option>
                                <option value="Terlaris" <?php echo e(old('badge') == 'Terlaris' ? 'selected' : ''); ?>>🔥 Terlaris</option>
                                <option value="Baru" <?php echo e(old('badge') == 'Baru' ? 'selected' : ''); ?>>🆕 Baru</option>
                                <option value="Diskon" <?php echo e(old('badge') == 'Diskon' ? 'selected' : ''); ?>>💫 Diskon</option>
                            </select>
                            <small class="form-text text-muted">Opsional: Tambahkan badge untuk menarik perhatian</small>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group mb-3">
                            <label for="status" class="fw-semibold">Status <span class="text-danger">*</span></label>
                            <select class="form-control <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                    id="status" name="status" required>
                                <option value="active" <?php echo e(old('status') == 'active' ? 'selected' : ''); ?>>🟢 Aktif</option>
                                <option value="inactive" <?php echo e(old('status') == 'inactive' ? 'selected' : ''); ?>>🔴 Nonaktif</option>
                            </select>
                            <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>
                </div>

                <!-- Tags -->
                <div class="form-group mb-4">
                    <label for="tags" class="fw-semibold">Tags</label>
                    <input type="text" class="form-control" id="tags" name="tags" 
                           value="<?php echo e(old('tags')); ?>"
                           placeholder="Contoh: kopi, banyuwangi, lokal, organik">
                    <small class="form-text text-muted">
                        Pisahkan dengan koma. Tags membantu dalam pencarian dan filtering produk.
                    </small>
                </div>

                <!-- Tombol Aksi -->
                <div class="form-group mt-5 pt-3 border-top">
                    <button type="submit" class="btn btn-primary btn-lg px-4 shadow-sm">
                        <i class="fas fa-save me-2"></i> Simpan Produk
                    </button>
                    <a href="<?php echo e(route('admin.umkm.index')); ?>" class="btn btn-outline-secondary btn-lg px-4">
                        <i class="fas fa-times me-1"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
.upload-area {
    transition: all 0.3s ease;
    border: 2px dashed #dee2e6;
}
.upload-area:hover {
    border-color: #4dabf7;
    background-color: #f8f9fa;
}
.preview-container {
    position: relative;
    display: inline-block;
}
.remove-image {
    position: absolute;
    top: 5px;
    right: 5px;
    background: rgba(255,255,255,0.8);
    border-radius: 50%;
    width: 25px;
    height: 25px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    opacity: 0;
    transition: opacity 0.3s;
}
.preview-container:hover .remove-image {
    opacity: 1;
}
.form-control:focus, .form-select:focus {
    border-color: #4dabf7;
    box-shadow: 0 0 0 0.2rem rgba(77, 171, 247, 0.25);
}
</style>

<script>
function previewImage(event) {
    const preview = document.getElementById('preview-image');
    const placeholder = document.getElementById('upload-placeholder');
    const removeBtn = document.querySelector('.remove-image');
    const file = event.target.files[0];
    
    // Validasi ukuran file (max 2MB)
    if (file && file.size > 2 * 1024 * 1024) {
        alert('Ukuran file maksimal 2MB');
        event.target.value = '';
        return;
    }
    
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
            placeholder.style.display = 'none';
            removeBtn.style.display = 'block';
        }
        reader.readAsDataURL(file);
    }
}

function removeImage(event) {
    event.stopPropagation();
    const preview = document.getElementById('preview-image');
    const placeholder = document.getElementById('upload-placeholder');
    const removeBtn = document.querySelector('.remove-image');
    const fileInput = document.getElementById('gambar');
    
    preview.style.display = 'none';
    placeholder.style.display = 'block';
    removeBtn.style.display = 'none';
    fileInput.value = '';
}

// Format input harga secara real-time
document.getElementById('harga').addEventListener('input', function(e) {
    let value = e.target.value.replace(/\D/g, '');
    if (value) {
        e.target.value = parseInt(value, 10);
    }
});

// Drag and drop functionality
const uploadArea = document.querySelector('.upload-area');
['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
    uploadArea.addEventListener(eventName, preventDefaults, false);
});

function preventDefaults(e) {
    e.preventDefault();
    e.stopPropagation();
}

['dragenter', 'dragover'].forEach(eventName => {
    uploadArea.addEventListener(eventName, highlight, false);
});

['dragleave', 'drop'].forEach(eventName => {
    uploadArea.addEventListener(eventName, unhighlight, false);
});

function highlight() {
    uploadArea.style.borderColor = '#4dabf7';
    uploadArea.style.backgroundColor = '#e7f3ff';
}

function unhighlight() {
    uploadArea.style.borderColor = '#dee2e6';
    uploadArea.style.backgroundColor = '#f8f9fa';
}

uploadArea.addEventListener('drop', handleDrop, false);

function handleDrop(e) {
    const dt = e.dataTransfer;
    const files = dt.files;
    document.getElementById('gambar').files = files;
    previewImage({ target: { files: files } });
}
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\US3R\Downloads\tamansari tourism\resources\views/admin/umkm/create.blade.php ENDPATH**/ ?>