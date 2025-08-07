@extends('layouts.app')

@section('content')
    <style>
        /* Prototype Styles */
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f5f5f5;
            color: #333;
            margin: 0;
            padding: 0;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        
        .header {
            text-align: center;
            margin-bottom: 30px;
            padding: 20px 0;
        }
        
        .header h1 {
            font-size: 2.2rem;
            color: #333;
            margin-bottom: 10px;
            position: relative;
            display: inline-block;
        }
        
        .header h1:after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 2px;
            background: #666;
        }
        
        .header p {
            color: #666;
            font-size: 1rem;
        }
        
        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 25px;
        }
        
        .product-card {
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 3px 10px rgba(0,0,0,0.08);
            transition: transform 0.3s ease;
        }
        
        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .product-image {
            height: 180px;
            background-color: #e0e0e0;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #999;
            font-size: 0.9rem;
        }
        
        .product-info {
            padding: 15px;
        }
        
        .product-title {
            font-size: 1.1rem;
            margin: 0 0 5px 0;
            color: #333;
        }
        
        .product-desc {
            font-size: 0.85rem;
            color: #666;
            margin: 0 0 10px 0;
        }
        
        .product-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 10px;
            border-top: 1px solid #eee;
        }
        
        .product-price {
            font-weight: 600;
            color: #333;
        }
        
        .order-btn {
            background: #666;
            color: white;
            border: none;
            padding: 5px 12px;
            border-radius: 4px;
            font-size: 0.8rem;
            cursor: pointer;
            transition: background 0.3s;
        }
        
        .order-btn:hover {
            background: #555;
        }
        
        .badge {
            position: absolute;
            top: 10px;
            left: 10px;
            background: #333;
            color: white;
            padding: 3px 8px;
            font-size: 0.7rem;
            border-radius: 3px;
        }
        
        @media (max-width: 768px) {
            .product-grid {
                grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Produk UMKM Lokal</h1>
            <p>Dukung perekonomian lokal dengan produk berkualitas</p>
        </div>
        
        <div class="product-grid">
            <!-- Product 1 -->
            <div class="product-card">
                <div class="product-image">
                    [Gambar Produk 1]
                </div>
                <div class="product-info">
                    <h3 class="product-title">Kopi Ijen Raung</h3>
                    <p class="product-desc">Kopi arabika khas Banyuwangi</p>
                    <div class="product-footer">
                        <span class="product-price">Rp 75.000</span>
                        <button class="order-btn">Pesan</button>
                    </div>
                </div>
            </div>
            
            <!-- Product 2 -->
            <div class="product-card">
                <div class="product-image">
                    [Gambar Produk 2]
                </div>
                <div class="product-info">
                    <h3 class="product-title">Madu Hutan Ijen</h3>
                    <p class="product-desc">Madu alami dari hutan Ijen</p>
                    <div class="product-footer">
                        <span class="product-price">Rp 120.000</span>
                        <button class="order-btn">Pesan</button>
                    </div>
                </div>
            </div>
            
            <!-- Product 3 -->
            <div class="product-card">
                <div class="badge">Baru</div>
                <div class="product-image">
                    [Gambar Produk 3]
                </div>
                <div class="product-info">
                    <h3 class="product-title">Kerajinan Bambu</h3>
                    <p class="product-desc">Produk kerajinan tangan</p>
                    <div class="product-footer">
                        <span class="product-price">Rp 75.000</span>
                        <button class="order-btn">Pesan</button>
                    </div>
                </div>
            </div>
            
            <!-- Product 4 -->
            <div class="product-card">
                <div class="badge">Terlaris</div>
                <div class="product-image">
                    [Gambar Produk 4]
                </div>
                <div class="product-info">
                    <h3 class="product-title">Tenun Osing</h3>
                    <p class="product-desc">Kain tradisional Banyuwangi</p>
                    <div class="product-footer">
                        <span class="product-price">Rp 255.000</span>
                        <button class="order-btn">Pesan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
@endsection