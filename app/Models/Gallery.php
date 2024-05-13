<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_folder',
    ];

    protected $table = 'Gallery';

    public function gambar()
    {
        return $this->hasMany(Gambar::class, 'id_gallery');
    }
}
