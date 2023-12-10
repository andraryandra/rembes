<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentRembes extends Model
{
    use HasFactory;
    protected $table = 'comment_rembes';
    protected $fillable = [
        'rembes_id',
        'user_id',
        'comment',
    ];

    public function rembes()
    {
        return $this->belongsTo(Rembes::class, 'rembes_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
