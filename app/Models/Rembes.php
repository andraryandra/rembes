<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rembes extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'rembes';

    protected $fillable = [
        'user_id',
        'name',
        'category_tahun_id',
        'tanggal_ticket',
        'status',
        'description',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function categoryTahun()
    {
        return $this->belongsTo(CategoryTahun::class, 'category_tahun_id', 'id');
    }
}
