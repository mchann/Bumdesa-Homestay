<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class UmkmProduct extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nama_produk',
        'deskripsi',
        'harga',
        'kategori',
        'gambar',
        'no_telepon_owner', // Tambahkan ini
        'status',
        'stok',
        'berat',
        'satuan_berat',
        'tags',
        'rating',
        'terjual',
        'badge',
        'slug'
    ];

    protected $casts = [
        'harga' => 'decimal:2',
        'stok' => 'integer',
        'berat' => 'decimal:2',
        'rating' => 'decimal:1',
        'terjual' => 'integer',
        'tags' => 'array'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->nama_produk) . '-' . time();
            }
        });
    }

    // Scope untuk produk aktif
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    // Scope untuk filter kategori
    public function scopeByCategory($query, $category)
    {
        if ($category && $category != 'semua') {
            return $query->where('kategori', $category);
        }
        return $query;
    }

    // Scope untuk pencarian
    public function scopeSearch($query, $search)
    {
        if ($search) {
            return $query->where('nama_produk', 'like', "%{$search}%")
                        ->orWhere('deskripsi', 'like', "%{$search}%")
                        ->orWhere('kategori', 'like', "%{$search}%");
        }
        return $query;
    }

    // Accessor untuk format harga
    public function getHargaFormattedAttribute()
    {
        return 'Rp ' . number_format($this->harga, 0, ',', '.');
    }

    // Accessor untuk format berat
    public function getBeratFormattedAttribute()
    {
        return $this->berat . ' ' . $this->satuan_berat;
    }

    // Accessor untuk gambar URL
    public function getGambarUrlAttribute()
    {
        if ($this->gambar) {
            return asset('storage/' . $this->gambar);
        }
        return asset('images/default-product.png');
    }

    // Method untuk menambah jumlah terjual
    public function incrementTerjual($quantity = 1)
    {
        $this->increment('terjual', $quantity);
    }

    // Method untuk update rating
    public function updateRating($newRating)
    {
        // Logika update rating bisa disesuaikan dengan kebutuhan
        $this->rating = $newRating;
        $this->save();
    }

    // Method untuk cek stok tersedia
    public function isInStock()
    {
        return $this->stok > 0;
    }

    // Method untuk cek produk aktif
    public function isActive()
    {
        return $this->status === 'active';
    }
}