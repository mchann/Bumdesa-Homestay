@extends('layouts.app')

@section('content')
<head>
    <style>
        /* Modern Styles */
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
        
        /* Header Styles */
        .header {
            text-align: center;
            margin-bottom: 50px;
            padding: 40px 0;
            position: relative;
        }
        
        .header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 4px;
            background: linear-gradient(to right, var(--secondary), var(--primary));
            border-radius: 2px;
        }
        
        .header h1 {
            font-size: 2.8rem;
            font-weight: 700;
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 15px;
            position: relative;
            display: inline-block;
        }
        
        .header p {
            color: var(--gray);
            font-size: 1.1rem;
            max-width: 600px;
            margin: 0 auto;
        }
        
        /* Product Grid */
        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 30px;
        }
        
        /* Product Card */
        .product-card {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: var(--shadow);
            transition: var(--transition);
            position: relative;
            display: flex;
            flex-direction: column;
            height: 100%;
            text-decoration: none;
            color: inherit;
        }
        
        .product-card:hover {
            transform: translateY(-10px);
            box-shadow: var(--shadow-hover);
            text-decoration: none;
            color: inherit;
        }
        
        .product-image-container {
            position: relative;
            height: 200px;
            overflow: hidden;
        }
        
        .product-image {
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, var(--light-gray), #dbeafe);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--gray);
            font-size: 0.9rem;
            transition: var(--transition);
        }
        
        .product-card:hover .product-image {
            transform: scale(1.05);
        }
        
        .product-badge {
            position: absolute;
            top: 12px;
            left: 12px;
            background: var(--accent);
            color: white;
            padding: 5px 12px;
            font-size: 0.75rem;
            font-weight: 600;
            border-radius: 20px;
            z-index: 2;
            box-shadow: 0 4px 8px rgba(230, 57, 70, 0.3);
        }
        
        .product-badge.new {
            background: var(--secondary);
            box-shadow: 0 4px 8px rgba(212, 175, 55, 0.3);
        }
        
        .product-badge.terlaris {
            background: var(--accent);
        }
        
        .product-badge.diskon {
            background: #e74c3c;
        }
        
        .product-info {
            padding: 20px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }
        
        .product-title {
            font-size: 1.3rem;
            font-weight: 600;
            margin: 0 0 8px 0;
            color: var(--dark);
            line-height: 1.3;
        }
        
        .product-desc {
            font-size: 0.9rem;
            color: var(--gray);
            margin: 0 0 15px 0;
            flex-grow: 1;
            line-height: 1.5;
        }
        
        .product-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
            font-size: 0.8rem;
            color: var(--gray);
        }
        
        .product-category {
            background: var(--light);
            padding: 4px 8px;
            border-radius: 12px;
            font-weight: 500;
        }
        
        .product-rating {
            display: flex;
            align-items: center;
            gap: 4px;
        }
        
        .product-stats {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
            font-size: 0.8rem;
            color: var(--gray);
        }
        
        .product-terjual {
            display: flex;
            align-items: center;
            gap: 4px;
        }
        
        .product-stok {
            display: flex;
            align-items: center;
            gap: 4px;
        }
        
        .product-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 15px;
            border-top: 1px solid var(--light-gray);
        }
        
        .product-price {
            font-weight: 700;
            font-size: 1.2rem;
            color: var(--primary);
        }
        
        .detail-btn {
            background: transparent;
            color: var(--primary);
            border: 2px solid var(--primary);
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 0.9rem;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }
        
        .detail-btn:hover {
            background: var(--primary);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(44, 85, 48, 0.2);
        }
        
        /* Category Filter */
        .category-filter {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-bottom: 40px;
            flex-wrap: wrap;
        }
        
        .filter-btn {
            background: white;
            border: 2px solid var(--light-gray);
            padding: 8px 20px;
            border-radius: 30px;
            font-size: 0.9rem;
            font-weight: 500;
            cursor: pointer;
            transition: var(--transition);
            text-decoration: none;
            color: inherit;
        }
        
        .filter-btn.active, .filter-btn:hover {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
            text-decoration: none;
        }
        
        /* Search Bar */
        .search-container {
            display: flex;
            justify-content: center;
            margin-bottom: 40px;
        }
        
        .search-bar {
            display: flex;
            max-width: 500px;
            width: 100%;
            box-shadow: var(--shadow);
            border-radius: 50px;
            overflow: hidden;
        }
        
        .search-input {
            flex-grow: 1;
            padding: 15px 25px;
            border: none;
            font-size: 1rem;
            background: white;
        }
        
        .search-input:focus {
            outline: none;
        }
        
        .search-btn {
            background: var(--primary);
            color: white;
            border: none;
            padding: 0 25px;
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .search-btn:hover {
            background: var(--primary-light);
        }
        
        /* Results Info */
        .results-info {
            text-align: center;
            margin-bottom: 20px;
            color: var(--gray);
            font-size: 0.9rem;
        }
        
        /* Footer */
        .footer {
            text-align: center;
            margin-top: 60px;
            padding: 30px 0;
            color: var(--gray);
            font-size: 0.9rem;
            border-top: 1px solid var(--light-gray);
        }
        
        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: var(--gray);
        }
        
        .empty-state img {
            width: 150px;
            margin-bottom: 20px;
            opacity: 0.7;
        }
        
        .empty-state h3 {
            font-size: 1.5rem;
            margin-bottom: 10px;
            color: var(--dark);
        }
        
        /* Responsive Design */
        @media (max-width: 768px) {
            .header h1 {
                font-size: 2.2rem;
            }
            
            .product-grid {
                grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
                gap: 20px;
            }
            
            .category-filter {
                gap: 10px;
            }
            
            .product-footer {
                flex-direction: column;
                gap: 10px;
                align-items: stretch;
            }
            
            .detail-btn {
                text-align: center;
                justify-content: center;
            }
        }
        
        @media (max-width: 576px) {
            .header h1 {
                font-size: 1.8rem;
            }
            
            .header p {
                font-size: 1rem;
            }
            
            .product-grid {
                grid-template-columns: 1fr;
            }
            
            .search-bar {
                flex-direction: column;
                border-radius: 12px;
            }
            
            .search-input {
                padding: 12px 20px;
            }
            
            .search-btn {
                padding: 12px 20px;
            }
            
            .category-filter {
                justify-content: flex-start;
                overflow-x: auto;
                padding-bottom: 10px;
            }
            
            .product-meta {
                flex-direction: column;
                align-items: flex-start;
                gap: 8px;
            }
            
            .product-stats {
                flex-direction: column;
                align-items: flex-start;
                gap: 5px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Produk UMKM Lokal</h1>
            <p>Dukung perekonomian lokal dengan produk berkualitas dari pengrajin terbaik daerah</p>
        </div>
        
        <div class="search-container">
            <form action="{{ route('umkm') }}" method="GET" class="search-bar">
                <input type="text" class="search-input" name="search" placeholder="Cari produk UMKM..." value="{{ $searchQuery }}">
                <button type="submit" class="search-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                    </svg>
                </button>
            </form>
        </div>
        
        <div class="category-filter">
            <a href="{{ route('umkm') }}?kategori=semua" 
               class="filter-btn {{ $selectedCategory == 'semua' ? 'active' : '' }}">
                Semua Produk
            </a>
            @foreach($categories as $category)
            <a href="{{ route('umkm') }}?kategori={{ $category }}" 
               class="filter-btn {{ $selectedCategory == $category ? 'active' : '' }}">
                {{ $category }}
            </a>
            @endforeach
        </div>
        
        @if($products->count() > 0)
            <div class="results-info">
                Menampilkan {{ $products->count() }} produk 
                @if($selectedCategory != 'semua')
                    dalam kategori {{ $selectedCategory }}
                @endif
                @if($searchQuery)
                    untuk pencarian "{{ $searchQuery }}"
                @endif
            </div>
            
            <div class="product-grid">
                @foreach($products as $product)
                <div class="product-card">
                    @if($product->badge)
                    <div class="product-badge {{ 
                        $product->badge == 'Baru' ? 'new' : 
                        ($product->badge == 'Terlaris' ? 'terlaris' : 
                        ($product->badge == 'Diskon' ? 'diskon' : '')) 
                    }}">{{ $product->badge }}</div>
                    @endif
                    
                    <div class="product-image-container">
                        <div class="product-image">
                            @if($product->gambar)
                            <img src="{{ asset('storage/' . $product->gambar) }}" alt="{{ $product->nama_produk }}" 
                                 style="width: 100%; height: 100%; object-fit: cover;">
                            @else
                            <span>Gambar {{ $product->nama_produk }}</span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="product-info">
                        <h3 class="product-title">{{ $product->nama_produk }}</h3>
                        
                        <div class="product-meta">
                            <span class="product-category">{{ $product->kategori }}</span>
                            <div class="product-rating">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= $product->rating)
                                        ⭐
                                    @else
                                        ☆
                                    @endif
                                @endfor
                                <span>({{ $product->rating }})</span>
                            </div>
                        </div>
                        
                        <div class="product-stats">
                            <div class="product-terjual">
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M0 1.5A1.5 1.5 0 0 1 1.5 0h13A1.5 1.5 0 0 1 16 1.5v13a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 14.5v-13z"/>
                                    <path d="M3 2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm0 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm0 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm3-6a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm0 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm0 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm3-6a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm0 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1z"/>
                                </svg>
                                Terjual: {{ $product->terjual }}
                            </div>
                            <div class="product-stok">
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M8 7a.5.5 0 0 1 .5.5V9H10a.5.5 0 0 1 0 1H8.5v1.5a.5.5 0 0 1-1 0V10H6a.5.5 0 0 1 0-1h1.5V7.5A.5.5 0 0 1 8 7z"/>
                                    <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"/>
                                </svg>
                                Stok: {{ $product->stok }}
                            </div>
                        </div>
                        
                        <p class="product-desc">{{ Str::limit($product->deskripsi, 100) }}</p>
                        
                        <div class="product-footer">
                            <span class="product-price">Rp {{ number_format($product->harga, 0, ',', '.') }}</span>
                            <a href="{{ route('umkm.detail', $product->slug) }}" class="detail-btn">
                                Lihat Detail
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <div class="empty-state">
                <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="currentColor" viewBox="0 0 16 16" style="opacity: 0.5;">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                </svg>
                <h3>Tidak ada produk ditemukan</h3>
                <p>Coba gunakan kata kunci atau kategori yang berbeda</p>
                @if($selectedCategory != 'semua' || $searchQuery)
                <a href="{{ route('umkm') }}" class="detail-btn" style="margin-top: 15px;">
                    Tampilkan Semua Produk
                </a>
                @endif
            </div>
        @endif
        
        <div class="footer">
            <p>&copy; {{ date('Y') }} UMKM Lokal Banyuwangi. Semua hak dilindungi.</p>
        </div>
    </div>

    <script>
        // JavaScript untuk filter dan interaksi
        document.addEventListener('DOMContentLoaded', function() {
            const filterButtons = document.querySelectorAll('.filter-btn');
            
            filterButtons.forEach(button => {
                button.addEventListener('click', function() {
                    filterButtons.forEach(btn => btn.classList.remove('active'));
                    this.classList.add('active');
                });
            });
            
            const productCards = document.querySelectorAll('.product-card');
            
            productCards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-10px)';
                });
                
                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                });
            });
        });
    </script>
</body>
@endsection