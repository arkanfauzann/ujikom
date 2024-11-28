<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Petugas extends Model
{
    protected $table = 'petugas';
    protected $fillable = ['username', 'password'];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
} 