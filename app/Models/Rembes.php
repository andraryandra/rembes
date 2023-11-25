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
        'nama',
        'nominal',
        'tanggal',
        'status',
        'deskripsi',
        'foto_bukti',
    ];
}
