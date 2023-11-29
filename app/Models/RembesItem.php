<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RembesItem extends Model
{
    use HasFactory;

    protected $table = 'rembes_items';

    protected $fillable = [
        'rembes_id',
        'nama_rembes',
        'nominal',
        'tanggal_rembes',
        'deskripsi',
    ];
}
