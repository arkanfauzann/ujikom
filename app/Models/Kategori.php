<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategori';
    public $timestamps = false;
    protected $fillable = ['judul'];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
} 