<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Foto extends Model
{
    protected $table = 'foto';
    protected $fillable = ['galery_id', 'judul', 'file'];
    public $timestamps = true;

    public function galery()
    {
        return $this->belongsTo(Galery::class, 'galery_id');
    }
} 