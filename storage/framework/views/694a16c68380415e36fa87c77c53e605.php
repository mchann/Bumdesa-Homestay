

<?php $__env->startSection('content'); ?>
<head>
    <style>
        /* Modern Styles - Konsisten dengan halaman sebelumnya */
        :root {
            --primary: #2c5530;
            --primary-light: #4a7856;
            --secondary: #d4af37;
            --accent: #e63946;
            --light: #f8f9fa;
            --dark: #212529;
            --gray: #6c757d;
            --light-gray: #e9ecef;
            --transition: all 0.3s ease;
            --shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            --shadow-hover: 0 15px 40px rgba(0, 0, 0, 0.12);
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Poppins', 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #e4edf5 100%);
            color: var(--dark);
            line-height: 1.6;
            min-height: 100vh;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        
        /* Breadcrumb */
        .breadcrumb {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 30px;
            font-size: 0.9rem;
            color: var(--gray);
        }
        
        .breadcrumb a {
            color: var(--primary);
            text-decoration: none;
            transition: var(--transition);
        }
        
        .breadcrumb a:hover {
            color: var(--primary-light);
        }
        
        .breadcrumb span {
            color: var(--gray);
        }
        
        /* Product Detail Layout */
        .product-detail {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 50px;
            margin-bottom: 60px;
        }
        
        /* Product Images */
        .product-images {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }
        
        .main-image {
            width: 100%;
            height: 400px;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: var(--shadow);
            background: white;
        }
        
        .main-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .image-placeholder {
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, var(--light-gray), #dbeafe);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--gray);
            font-size: 1rem;
        }
        
        /* Product Info */
        .product-info {
            background: white;
            padding: 30px;
            border-radius: 16px;
            box-shadow: var(--shadow);
            height: fit-content;
        }
        
        .product-header {
            margin-bottom: 20px;
        }
        
        .product-badge {
            display: inline-block;
            background: var(--accent);
            color: white;
            padding: 5px 15px;
            font-size: 0.8rem;
            font-weight: 600;
            border-radius: 20px;
            margin-bottom: 15px;
        }
        
        .product-badge.new {
            background: var(--secondary);
        }
        
        .product-title {
            font-size: 2rem;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 10px;
            line-height: 1.2;
        }
        
        .product-category {
            color: var(--primary);
            font-size: 1rem;
            font-weight: 500;
            margin-bottom: 15px;
        }
        
        .product-price {
            font-size: 2.2rem;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 20px;
        }
        
        /* Product Meta */
        .product-meta {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
            margin-bottom: 25px;
            padding: 20px;
            background: var(--light);
            border-radius: 12px;
        }
        
        .meta-item {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }
        
        .meta-label {
            font-size: 0.8rem;
            color: var(--gray);
            font-weight: 500;
        }
        
        .meta-value {
            font-size: 1rem;
            font-weight: 600;
            color: var(--dark);
        }
        
        /* Order Section */
        .order-section {
            margin-bottom: 25px;
        }
        
        .quantity-selector {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 20px;
        }
        
        .quantity-label {
            font-weight: 600;
            color: var(--dark);
        }
        
        .quantity-controls {
            display: flex;
            align-items: center;
            gap: 10px;
            border: 2px solid var(--light-gray);
            border-radius: 8px;
            padding: 5px;
        }
        
        .quantity-btn {
            background: none;
            border: none;
            width: 30px;
            height: 30px;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 1.2rem;
            color: var(--primary);
            transition: var(--transition);
        }
        
        .quantity-btn:hover {
            background: var(--light-gray);
        }
        
        .quantity-input {
            width: 50px;
            text-align: center;
            border: none;
            font-size: 1rem;
            font-weight: 600;
            background: none;
        }
        
        .quantity-input:focus {
            outline: none;
        }
        
        .order-actions {
            display: flex;
            gap: 15px;
        }
        
        .btn-primary {
            flex: 2;
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            color: white;
            border: none;
            padding: 15px 30px;
            border-radius: 10px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            box-shadow: 0 4px 12px rgba(44, 85, 48, 0.2);
        }
        
        .btn-primary:hover {
            background: linear-gradient(135deg, var(--primary-light), var(--primary));
            box-shadow: 0 6px 15px rgba(44, 85, 48, 0.3);
            transform: translateY(-2px);
        }
        
        .btn-secondary {
            flex: 1;
            background: white;
            color: var(--primary);
            border: 2px solid var(--primary);
            padding: 15px 30px;
            border-radius: 10px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
        }
        
        .btn-secondary:hover {
            background: var(--light);
            transform: translateY(-2px);
        }
        
        /* Product Description */
        .product-description {
            background: white;
            padding: 30px;
            border-radius: 16px;
            box-shadow: var(--shadow);
            margin-bottom: 40px;
        }
        
        .section-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid var(--light-gray);
        }
        
        .description-content {
            line-height: 1.8;
            color: var(--dark);
        }
        
        /* Product Tags */
        .product-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 15px;
        }
        
        .tag {
            background: var(--light);
            color: var(--primary);
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
        }
        
        /* Contact Info */
        .contact-info {
            background: white;
            padding: 25px;
            border-radius: 16px;
            box-shadow: var(--shadow);
            margin-bottom: 40px;
        }
        
        .contact-item {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 15px;
        }
        
        .contact-icon {
            width: 40px;
            height: 40px;
            background: var(--light);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
        }
        
        .contact-details h4 {
            font-weight: 600;
            margin-bottom: 5px;
        }
        
        .contact-details p {
            color: var(--gray);
            font-size: 0.9rem;
        }
        
        /* Related Products */
        .related-products {
            margin-top: 60px;
        }
        
        .related-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 25px;
            margin-top: 30px;
        }
        
        .related-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: var(--shadow);
            transition: var(--transition);
        }
        
        .related-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-hover);
        }
        
        .related-image {
            width: 100%;
            height: 150px;
            background: var(--light-gray);
        }
        
        .related-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .related-info {
            padding: 15px;
        }
        
        .related-title {
            font-weight: 600;
            margin-bottom: 5px;
            font-size: 1rem;
        }
        
        .related-price {
            color: var(--primary);
            font-weight: 700;
            font-size: 1.1rem;
        }
        
        /* Responsive Design */
        @media (max-width: 968px) {
            .product-detail {
                grid-template-columns: 1fr;
                gap: 30px;
            }
            
            .main-image {
                height: 350px;
            }
        }
        
        @media (max-width: 768px) {
            .product-meta {
                grid-template-columns: 1fr;
            }
            
            .order-actions {
                flex-direction: column;
            }
            
            .product-title {
                font-size: 1.6rem;
            }
            
            .product-price {
                font-size: 1.8rem;
            }
        }
        
        @media (max-width: 576px) {
            .container {
                padding: 15px;
            }
            
            .product-info, 
            .product-description, 
            .contact-info {
                padding: 20px;
            }
            
            .main-image {
                height: 300px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Breadcrumb Navigation -->
        <div class="breadcrumb">
            <a href="<?php echo e(route('umkm')); ?>">Produk UMKM</a>
            <span>></span>
            <a href="<?php echo e(route('umkm')); ?>?kategori=<?php echo e($product->kategori); ?>"><?php echo e($product->kategori); ?></a>
            <span>></span>
            <span><?php echo e($product->nama_produk); ?></span>
        </div>
        
        <!-- Product Detail Section -->
        <div class="product-detail">
            <!-- Product Images -->
            <div class="product-images">
                <div class="main-image">
                    <?php if($product->gambar): ?>
                        <img src="<?php echo e(asset('storage/' . $product->gambar)); ?>" alt="<?php echo e($product->nama_produk); ?>">
                    <?php else: ?>
                        <div class="image-placeholder">
                            <span>Gambar <?php echo e($product->nama_produk); ?></span>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            
            <!-- Product Information -->
            <div class="product-info">
                <div class="product-header">
                    <?php if($product->badge): ?>
                        <div class="product-badge <?php echo e($product->badge == 'Baru' ? 'new' : ''); ?>">
                            <?php echo e($product->badge); ?>

                        </div>
                    <?php endif; ?>
                    
                    <h1 class="product-title"><?php echo e($product->nama_produk); ?></h1>
                    <div class="product-category"><?php echo e($product->kategori); ?></div>
                    <div class="product-price">Rp <?php echo e(number_format($product->harga, 0, ',', '.')); ?></div>
                </div>
                
                <!-- Product Meta Information -->
                <div class="product-meta">
                    <div class="meta-item">
                        <span class="meta-label">Stok Tersedia</span>
                        <span class="meta-value"><?php echo e($product->stok); ?> unit</span>
                    </div>
                    <div class="meta-item">
                        <span class="meta-label">Berat</span>
                        <span class="meta-value"><?php echo e($product->berat); ?> <?php echo e($product->satuan_berat); ?></span>
                    </div>
                    <div class="meta-item">
                        <span class="meta-label">Terjual</span>
                        <span class="meta-value"><?php echo e($product->terjual); ?> unit</span>
                    </div>
                    <div class="meta-item">
                        <span class="meta-label">Rating</span>
                        <span class="meta-value">
                            <?php for($i = 1; $i <= 5; $i++): ?>
                                <?php if($i <= $product->rating): ?>
                                    ⭐
                                <?php else: ?>
                                    ☆
                                <?php endif; ?>
                            <?php endfor; ?>
                            (<?php echo e($product->rating); ?>)
                        </span>
                    </div>
                </div>
                
                <!-- Order Section -->
                <div class="order-section">
                    <div class="quantity-selector">
                        <span class="quantity-label">Jumlah:</span>
                        <div class="quantity-controls">
                            <button class="quantity-btn" onclick="decreaseQuantity()">-</button>
                            <input type="number" class="quantity-input" id="quantity" value="1" min="1" max="<?php echo e($product->stok); ?>">
                            <button class="quantity-btn" onclick="increaseQuantity()">+</button>
                        </div>
                        <span class="stock-info">Tersisa <?php echo e($product->stok); ?> unit</span>
                    </div>
                    
                    <div class="order-actions">
                        <button class="btn-primary" onclick="orderProduct()">
                            📞 Pesan via WhatsApp
                        </button>
                        <button class="btn-secondary" onclick="addToCart()">
                            🛒 Simpan
                        </button>
                    </div>
                </div>
                
                <!-- Contact Information -->
                <div class="contact-info">
                    <h3 class="section-title">Informasi Penjual</h3>
                    <div class="contact-item">
                        <div class="contact-icon">
                            📞
                        </div>
                        <div class="contact-details">
                            <h4>No. Telepon Owner</h4>
                            <p><?php echo e($product->no_telepon_owner); ?></p>
                        </div>
                    </div>
                    <div class="contact-item">
                        <div class="contact-icon">
                            🏪
                        </div>
                        <div class="contact-details">
                            <h4>Status Toko</h4>
                            <p><?php echo e($product->status == 'active' ? '🟢 Buka' : '🔴 Tutup Sementara'); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Product Description -->
        <div class="product-description">
            <h2 class="section-title">Deskripsi Produk</h2>
            <div class="description-content">
                <?php echo e($product->deskripsi); ?>

            </div>
            
            <?php if($product->tags && count($product->tags) > 0): ?>
                <div class="product-tags">
                    <?php $__currentLoopData = $product->tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <span class="tag">#<?php echo e($tag); ?></span>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php endif; ?>
        </div>
        
        <!-- Related Products -->
        <?php if($relatedProducts->count() > 0): ?>
        <div class="related-products">
            <h2 class="section-title">Produk Serupa</h2>
            <div class="related-grid">
                <?php $__currentLoopData = $relatedProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $relatedProduct): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e(route('umkm.detail', $relatedProduct->slug)); ?>" class="related-card">
                    <div class="related-image">
                        <?php if($relatedProduct->gambar): ?>
                            <img src="<?php echo e(asset('storage/' . $relatedProduct->gambar)); ?>" alt="<?php echo e($relatedProduct->nama_produk); ?>">
                        <?php else: ?>
                            <div style="width: 100%; height: 100%; background: var(--light-gray); display: flex; align-items: center; justify-content: center; color: var(--gray);">
                                <span>Gambar</span>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="related-info">
                        <h4 class="related-title"><?php echo e($relatedProduct->nama_produk); ?></h4>
                        <div class="related-price">Rp <?php echo e(number_format($relatedProduct->harga, 0, ',', '.')); ?></div>
                    </div>
                </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
        <?php endif; ?>
    </div>

    <script>
        // Quantity Control
        function increaseQuantity() {
            const input = document.getElementById('quantity');
            const max = parseInt(input.max);
            if (parseInt(input.value) < max) {
                input.value = parseInt(input.value) + 1;
            }
        }
        
        function decreaseQuantity() {
            const input = document.getElementById('quantity');
            if (parseInt(input.value) > 1) {
                input.value = parseInt(input.value) - 1;
            }
        }
        
        // Order Product via WhatsApp dengan Profile Pelanggan
function orderProduct() {
    const quantity = document.getElementById('quantity').value;
    const productName = "<?php echo e($product->nama_produk); ?>";
    const price = "<?php echo e($product->harga); ?>";
    const phoneNumber = "<?php echo e($product->no_telepon_owner); ?>";
    
    // Ambil data profile pelanggan dari PHP
    const userProfile = <?php echo json_encode(Auth::user()->pelangganProfile ?? null, 15, 512) ?>;
    
    let customerInfo = '';
    if (userProfile) {
        customerInfo = `\n👤 *Informasi Pemesan:*\n` +
                      `📛 Nama: ${userProfile.nama_lengkap}\n` +
                      `📞 Telepon: ${userProfile.nomor_telepon}\n` +
                      `🌍 Kewarganegaraan: ${userProfile.kewarganegaraan}\n`;
    } else {
        customerInfo = `\n⚠️ *Informasi Pemesan:* Profil belum lengkap\n`;
    }
    
    const message = `Halo, saya ingin memesan produk:\n\n` +
                  `📦 *${productName}*\n` +
                  `💰 Harga: Rp ${parseInt(price).toLocaleString('id-ID')}\n` +
                  `📦 Jumlah: ${quantity} unit\n` +
                  `💰 Total: Rp ${(parseInt(price) * parseInt(quantity)).toLocaleString('id-ID')}\n` +
                  customerInfo +
                  `\nApakah produk ini tersedia?`;
    
    const whatsappUrl = `https://wa.me/${phoneNumber}?text=${encodeURIComponent(message)}`;
    window.open(whatsappUrl, '_blank');
}
        
        // Add to Cart (placeholder function)
        function addToCart() {
            const quantity = document.getElementById('quantity').value;
            alert(`Produk "${productName}" sebanyak ${quantity} unit telah disimpan!`);
            // Implementasi cart functionality bisa ditambahkan di sini
        }
        
        // Input validation for quantity
        document.getElementById('quantity').addEventListener('change', function() {
            const max = parseInt(this.max);
            const value = parseInt(this.value);
            
            if (value < 1) {
                this.value = 1;
            } else if (value > max) {
                this.value = max;
            }
        });
    </script>
</body>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\US3R\Downloads\new before pull\tamansari tourism\resources\views/page/detail_umkm.blade.php ENDPATH**/ ?>