<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gambar extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_gallery',
        'gambar',
    ];

    protected $table = 'Gambar';

    public function gallery()
    {
        return $this->belongsTo(Gallery::class, 'id_gallery', 'id');
    }
}
