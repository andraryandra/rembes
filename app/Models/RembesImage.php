<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RembesImage extends Model
{
    use HasFactory;

    protected $table = 'rembes_images';

    protected $fillable = [
        'rembes_item_id',
        'foto_bukti',
    ];
}
