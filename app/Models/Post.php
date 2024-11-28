<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';
    protected $fillable = ['judul', 'kategori_id', 'isi', 'petugas_id', 'status', 'tanggal'];
    protected $dates = ['created_at', 'updated_at', 'tanggal'];

    public function petugas()
    {
        return $this->belongsTo(Petugas::class);
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    public function galery()
    {
        return $this->hasOne(Galery::class);
    }

    public function getAuthorAttribute()
    {
        return $this->petugas->username ?? 'Admin';
    }
} 