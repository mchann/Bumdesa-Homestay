

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <!-- Header Section -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">
                <i class="fas fa-leaf me-2 text-success"></i>Tambah Produk UMKM
            </h1>
            <p class="text-muted mt-1">Lengkapi informasi produk UMKM baru Anda</p>
        </div>
        <a href="<?php echo e(route('admin.umkm.index')); ?>" class="btn btn-outline-success shadow-sm px-4">
            <i class="fas fa-arrow-left me-2"></i> Kembali ke Daftar Produk
        </a>
    </div>

    <!-- Main Form Card -->
    <div class="card shadow-lg mb-4 border-0" style="border-top: 4px solid #28a745;">
        <div class="card-header bg-gradient-success text-white py-3">
            <h5 class="mb-0">
                <i class="fas fa-plus-circle me-2"></i>Form Tambah Produk Baru
            </h5>
        </div>
        <div class="card-body p-4">
            <form action="<?php echo e(route('admin.umkm.store')); ?>" method="POST" enctype="multipart/form-data" id="productForm">
                <?php echo csrf_field(); ?>

                <div class="row">
                    <!-- Kolom Kiri -->
                    <div class="col-md-8">
                        <!-- Nama Produk -->
                        <div class="form-group mb-4">
                            <label for="nama_produk" class="fw-bold text-success mb-2">
                                <i class="fas fa-tag me-2"></i>Nama Produk <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-success">
                                    <i class="fas fa-tag text-success"></i>
                                </span>
                                <input type="text" class="form-control border-success <?php $__errorArgs = ['nama_produk'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                       id="nama_produk" name="nama_produk" 
                                       value="<?php echo e(old('nama_produk')); ?>" 
                                       placeholder="Masukkan nama produk yang menarik" required>
                            </div>
                            <?php $__errorArgs = ['nama_produk'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback d-block mt-2">
                                    <i class="fas fa-exclamation-triangle me-1"></i><?php echo e($message); ?>

                                </div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <!-- Deskripsi -->
                        <div class="form-group mb-4">
                            <label for="deskripsi" class="fw-bold text-success mb-2">
                                <i class="fas fa-align-left me-2"></i>Deskripsi Produk <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-success align-items-start pt-3">
                                    <i class="fas fa-edit text-success"></i>
                                </span>
                                <textarea class="form-control border-success <?php $__errorArgs = ['deskripsi'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                          id="deskripsi" name="deskripsi" rows="5" 
                                          placeholder="Deskripsikan produk secara detail termasuk keunggulan dan manfaatnya" required><?php echo e(old('deskripsi')); ?></textarea>
                            </div>
                            <?php $__errorArgs = ['deskripsi'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback d-block mt-2">
                                    <i class="fas fa-exclamation-triangle me-1"></i><?php echo e($message); ?>

                                </div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <div class="d-flex justify-content-between mt-2">
                                <small class="form-text text-muted">
                                    <i class="fas fa-info-circle me-1"></i>Minimal 50 karakter untuk deskripsi yang informatif
                                </small>
                                <small id="char-count" class="form-text text-muted">0 karakter</small>
                            </div>
                        </div>

                        <!-- No. Telepon Owner -->
                        <div class="form-group mb-4">
                            <label for="no_telepon_owner" class="fw-bold text-success mb-2">
                                <i class="fas fa-phone me-2"></i>No. Telepon Owner <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-success">
                                    <i class="fab fa-whatsapp text-success"></i>
                                </span>
                                <input type="text" 
                                       class="form-control border-success <?php $__errorArgs = ['no_telepon_owner'];
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
                                       placeholder="Contoh: 081234567890" 
                                       required
                                       oninput="formatPhoneNumber(this)">
                                <button type="button" class="btn btn-outline-success" onclick="testWhatsAppNumber()">
                                    <i class="fab fa-whatsapp me-1"></i> Test
                                </button>
                            </div>
                            <?php $__errorArgs = ['no_telepon_owner'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback d-block mt-2">
                                    <i class="fas fa-exclamation-triangle me-1"></i><?php echo e($message); ?>

                                </div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <div class="mt-2">
                                <div id="phone-format-info" class="alert alert-success py-2 mb-2" style="display: none;">
                                    <i class="fas fa-check-circle me-2"></i>
                                    <span class="fw-semibold">Format valid!</span> Nomor siap untuk WhatsApp
                                </div>
                                <div id="phone-format-error" class="alert alert-danger py-2 mb-2" style="display: none;">
                                    <i class="fas fa-times-circle me-2"></i>
                                    <span class="fw-semibold">Format tidak valid!</span> <span id="error-message"></span>
                                </div>
                            </div>
                            <small class="form-text text-muted">
                                <i class="fas fa-info-circle me-1"></i>
                                Format: 08xxx, +628xxx, atau 628xxx. Akan otomatis dikonversi ke format WhatsApp.
                            </small>
                        </div>
                    </div>

                    <!-- Kolom Kanan - Upload Gambar -->
                    <div class="col-md-4">
                        <div class="form-group mb-4">
                            <label class="fw-bold text-success mb-2">
                                <i class="fas fa-image me-2"></i>Gambar Produk <span class="text-danger">*</span>
                            </label>
                            <div class="upload-area border-success rounded-3 p-4 bg-light d-flex flex-column align-items-center justify-content-center" 
                                 style="height: 250px; cursor: pointer; border: 2px dashed #28a745;" 
                                 onclick="document.getElementById('gambar').click()">
                                <div class="preview-container text-center">
                                    <img id="preview-image" class="img-fluid mb-2 rounded shadow-sm" 
                                         style="max-height: 160px; display:none; border: 3px solid #28a745;">
                                    <span class="remove-image" onclick="removeImage(event)" 
                                          style="display: none;">
                                        <i class="fas fa-times-circle text-danger bg-white rounded-circle p-1 shadow"></i>
                                    </span>
                                </div>
                                <div id="upload-placeholder" class="text-center">
                                    <i class="fas fa-cloud-upload-alt fa-3x text-success mb-3"></i>
                                    <p class="mb-1 fw-bold text-success">Klik untuk upload gambar</p>
                                    <small class="text-muted">Drag & drop file disini</small>
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
                                    <div class="invalid-feedback d-block mt-2">
                                        <i class="fas fa-exclamation-triangle me-1"></i><?php echo e($message); ?>

                                    </div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <div class="mt-3 text-center">
                                <small class="form-text text-muted">
                                    <i class="fas fa-shield-alt me-1"></i>
                                    Format: JPG, PNG, GIF (Maksimal 2MB). Rekomendasi rasio 1:1 untuk tampilan terbaik.
                                </small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Divider -->
                <div class="row">
                    <div class="col-12">
                        <div class="divider-with-text my-4">
                            <span class="divider-text bg-white px-3 text-success fw-bold">
                                <i class="fas fa-info-circle me-2"></i>INFORMASI PRODUK
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Informasi Harga & Kategori -->
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="harga" class="fw-bold text-success mb-2">
                                <i class="fas fa-tag me-2"></i>Harga (Rp) <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-success">Rp</span>
                                <input type="number" class="form-control border-success <?php $__errorArgs = ['harga'];
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
                            </div>
                            <?php $__errorArgs = ['harga'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback d-block mt-2">
                                    <i class="fas fa-exclamation-triangle me-1"></i><?php echo e($message); ?>

                                </div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="kategori" class="fw-bold text-success mb-2">
                                <i class="fas fa-tags me-2"></i>Kategori <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-success">
                                    <i class="fas fa-list text-success"></i>
                                </span>
                                <select class="form-control border-success <?php $__errorArgs = ['kategori'];
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
                            </div>
                            <?php $__errorArgs = ['kategori'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback d-block mt-2">
                                    <i class="fas fa-exclamation-triangle me-1"></i><?php echo e($message); ?>

                                </div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="stok" class="fw-bold text-success mb-2">
                                <i class="fas fa-boxes me-2"></i>Stok <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-success">
                                    <i class="fas fa-cubes text-success"></i>
                                </span>
                                <input type="number" class="form-control border-success <?php $__errorArgs = ['stok'];
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
                            </div>
                            <?php $__errorArgs = ['stok'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback d-block mt-2">
                                    <i class="fas fa-exclamation-triangle me-1"></i><?php echo e($message); ?>

                                </div>
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
                            <label for="berat" class="fw-bold text-success mb-2">
                                <i class="fas fa-weight me-2"></i>Berat <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <input type="number" class="form-control border-success <?php $__errorArgs = ['berat'];
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
                                <span class="input-group-text bg-light border-success" id="satuan-berat-text">gr</span>
                            </div>
                            <?php $__errorArgs = ['berat'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback d-block mt-2">
                                    <i class="fas fa-exclamation-triangle me-1"></i><?php echo e($message); ?>

                                </div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group mb-3">
                            <label for="satuan_berat" class="fw-bold text-success mb-2">
                                <i class="fas fa-balance-scale me-2"></i>Satuan Berat <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-success">
                                    <i class="fas fa-ruler text-success"></i>
                                </span>
                                <select class="form-control border-success <?php $__errorArgs = ['satuan_berat'];
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
                            </div>
                            <?php $__errorArgs = ['satuan_berat'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback d-block mt-2">
                                    <i class="fas fa-exclamation-triangle me-1"></i><?php echo e($message); ?>

                                </div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group mb-3">
                            <label for="badge" class="fw-bold text-success mb-2">
                                <i class="fas fa-certificate me-2"></i>Badge Produk
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-success">
                                    <i class="fas fa-star text-success"></i>
                                </span>
                                <select class="form-control border-success" id="badge" name="badge">
                                    <option value="">Tidak ada badge</option>
                                    <option value="Terlaris" <?php echo e(old('badge') == 'Terlaris' ? 'selected' : ''); ?>>🔥 Terlaris</option>
                                    <option value="Baru" <?php echo e(old('badge') == 'Baru' ? 'selected' : ''); ?>>🆕 Baru</option>
                                    <option value="Diskon" <?php echo e(old('badge') == 'Diskon' ? 'selected' : ''); ?>>💫 Diskon</option>
                                </select>
                            </div>
                            <small class="form-text text-muted mt-1">
                                <i class="fas fa-lightbulb me-1"></i>Opsional: Tambahkan badge untuk menarik perhatian
                            </small>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group mb-3">
                            <label for="status" class="fw-bold text-success mb-2">
                                <i class="fas fa-power-off me-2"></i>Status <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-success">
                                    <i class="fas fa-toggle-on text-success"></i>
                                </span>
                                <select class="form-control border-success <?php $__errorArgs = ['status'];
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
                            </div>
                            <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback d-block mt-2">
                                    <i class="fas fa-exclamation-triangle me-1"></i><?php echo e($message); ?>

                                </div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>
                </div>

                <!-- Tags -->
                <div class="form-group mb-4">
                    <label for="tags" class="fw-bold text-success mb-2">
                        <i class="fas fa-tags me-2"></i>Tags Produk
                    </label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-success">
                            <i class="fas fa-hashtag text-success"></i>
                        </span>
                        <input type="text" class="form-control border-success" id="tags" name="tags" 
                               value="<?php echo e(old('tags')); ?>"
                               placeholder="Contoh: kopi, banyuwangi, lokal, organik">
                    </div>
                    <small class="form-text text-muted mt-1">
                        <i class="fas fa-lightbulb me-1"></i>
                        Pisahkan dengan koma. Tags membantu dalam pencarian dan filtering produk.
                    </small>
                </div>

                <!-- Tombol Aksi -->
                <div class="form-group mt-5 pt-4 border-top">
                    <div class="d-flex gap-3">
                        <button type="submit" class="btn btn-success btn-lg px-5 shadow-sm fw-bold">
                            <i class="fas fa-save me-2"></i> Simpan Produk
                        </button>
                        <a href="<?php echo e(route('admin.umkm.index')); ?>" class="btn btn-outline-success btn-lg px-5">
                            <i class="fas fa-times me-2"></i> Batal
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
.upload-area {
    transition: all 0.3s ease;
    border: 2px dashed #28a745;
}
.upload-area:hover {
    border-color: #1e7e34;
    background-color: #e8f5e8;
    transform: translateY(-2px);
}
.preview-container {
    position: relative;
    display: inline-block;
}
.remove-image {
    position: absolute;
    top: 5px;
    right: 5px;
    background: rgba(255,255,255,0.9);
    border-radius: 50%;
    width: 30px;
    height: 30px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    opacity: 0;
    transition: opacity 0.3s;
    box-shadow: 0 2px 8px rgba(0,0,0,0.2);
}
.preview-container:hover .remove-image {
    opacity: 1;
}
.form-control:focus, .form-select:focus {
    border-color: #28a745;
    box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25);
}
.bg-gradient-success {
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%) !important;
}
.card {
    box-shadow: 0 0.5rem 1.5rem rgba(40, 167, 69, 0.15);
    transition: box-shadow 0.3s ease;
}
.card:hover {
    box-shadow: 0 0.5rem 2rem rgba(40, 167, 69, 0.2);
}
.input-group-text {
    transition: all 0.3s ease;
}
.input-group:focus-within .input-group-text {
    background-color: #d4edda;
    border-color: #28a745;
}
.divider-with-text {
    position: relative;
    text-align: center;
    border-bottom: 2px solid #e9ecef;
}
.divider-text {
    position: relative;
    top: -0.7em;
}
.btn-success {
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
    border: none;
    transition: all 0.3s ease;
}
.btn-success:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(40, 167, 69, 0.3);
}
.alert {
    border-radius: 10px;
    border: none;
    font-size: 0.875rem;
}
.alert-success {
    background-color: rgba(40, 167, 69, 0.1);
    border-left: 4px solid #28a745;
}
.alert-danger {
    background-color: rgba(220, 53, 69, 0.1);
    border-left: 4px solid #dc3545;
}
</style>

<script>
// Format dan validasi nomor telepon
function formatPhoneNumber(input) {
    let value = input.value.replace(/\D/g, '');
    
    // Format untuk WhatsApp (62xxxxxxxxxxx)
    let cleanValue = value;
    if (value.startsWith('0')) {
        cleanValue = '62' + value.substring(1);
    } else if (value.startsWith('8')) {
        cleanValue = '62' + value;
    } else if (value.startsWith('+62')) {
        cleanValue = value.substring(1);
    }
    
    // Validasi format
    const phoneFormatInfo = document.getElementById('phone-format-info');
    const phoneFormatError = document.getElementById('phone-format-error');
    const pattern = /^62[1-9][0-9]{7,11}$/;
    
    if (pattern.test(cleanValue)) {
        // Tampilkan format yang rapi
        let displayValue = cleanValue;
        if (cleanValue.length >= 3) {
            displayValue = cleanValue.substring(0, 2) + ' ' + cleanValue.substring(2);
        }
        if (cleanValue.length >= 6) {
            displayValue = cleanValue.substring(0, 2) + ' ' + cleanValue.substring(2, 5) + ' ' + cleanValue.substring(5);
        }
        if (cleanValue.length >= 9) {
            displayValue = cleanValue.substring(0, 2) + ' ' + cleanValue.substring(2, 5) + ' ' + 
                          cleanValue.substring(5, 9) + ' ' + cleanValue.substring(9);
        }
        
        input.value = displayValue;
        phoneFormatInfo.style.display = 'block';
        phoneFormatError.style.display = 'none';
        input.classList.remove('is-invalid');
        input.classList.add('is-valid');
        
        // Simpan nilai bersih untuk submit
        input.setAttribute('data-clean-value', cleanValue);
    } else if (value.length > 0) {
        phoneFormatInfo.style.display = 'none';
        phoneFormatError.style.display = 'block';
        document.getElementById('error-message').textContent = 'Format nomor tidak valid. Contoh: 081234567890';
        input.classList.remove('is-valid');
        input.classList.add('is-invalid');
    } else {
        phoneFormatInfo.style.display = 'none';
        phoneFormatError.style.display = 'none';
        input.classList.remove('is-valid', 'is-invalid');
    }
}

function testWhatsAppNumber() {
    const input = document.getElementById('no_telepon_owner');
    const cleanValue = input.getAttribute('data-clean-value');
    
    if (cleanValue) {
        const whatsappLink = `https://wa.me/${cleanValue}`;
        window.open(whatsappLink, '_blank');
    } else {
        alert('Harap masukkan nomor telepon yang valid terlebih dahulu.');
    }
}

// Pastikan nilai bersih dikirim saat form submit
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('productForm');
    form.addEventListener('submit', function() {
        const phoneInput = document.getElementById('no_telepon_owner');
        const cleanValue = phoneInput.getAttribute('data-clean-value');
        
        if (cleanValue) {
            phoneInput.value = cleanValue; // Ganti dengan nilai tanpa spasi
        }
    });
    
    // Hitung karakter deskripsi
    const deskripsi = document.getElementById('deskripsi');
    deskripsi.addEventListener('input', function() {
        const charCount = this.value.length;
        document.getElementById('char-count').textContent = charCount + ' karakter';
        
        if (charCount < 50) {
            document.getElementById('char-count').classList.remove('text-success');
            document.getElementById('char-count').classList.add('text-warning');
        } else {
            document.getElementById('char-count').classList.remove('text-warning');
            document.getElementById('char-count').classList.add('text-success');
        }
    });
    
    // Update satuan berat text
    document.getElementById('satuan_berat').addEventListener('change', function(e) {
        document.getElementById('satuan-berat-text').textContent = e.target.value;
    });
    
    // Format nilai yang sudah ada saat halaman dimuat
    const phoneInput = document.getElementById('no_telepon_owner');
    if (phoneInput.value) {
        formatPhoneNumber({ target: phoneInput });
    }
    
    // Hitung karakter awal
    const initialCharCount = deskripsi.value.length;
    document.getElementById('char-count').textContent = initialCharCount + ' karakter';
    if (initialCharCount >= 50) {
        document.getElementById('char-count').classList.add('text-success');
    }
});

// Fungsi-fungsi untuk upload gambar (tetap sama)
function previewImage(event) {
    const preview = document.getElementById('preview-image');
    const placeholder = document.getElementById('upload-placeholder');
    const removeBtn = document.querySelector('.remove-image');
    const file = event.target.files[0];
    
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
    uploadArea.style.borderColor = '#1e7e34';
    uploadArea.style.backgroundColor = '#e8f5e8';
}

function unhighlight() {
    uploadArea.style.borderColor = '#28a745';
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
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\US3R\Downloads\new before pull\tamansari tourism\resources\views/admin/umkm/create.blade.php ENDPATH**/ ?>