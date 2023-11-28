<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryTahun extends Model
{
    use HasFactory;

    protected $table = 'category_tahuns';

    protected $fillable = [
        'nama_category_tahun',
        'slug',
        'status',
        'deskripsi',
    ];
}
