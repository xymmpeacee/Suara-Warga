<?php

namespace App\Models;

use App\Enums\StatusLaporan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Laporan extends Model
{
    use HasFactory;

    protected $table = 'laporan';
    protected $fillable = [
        'user_id', 'kategori_id', 'judul',
        'deskripsi', 'latitude', 'longitude',
        'alamat', 'status'
    ];

    protected $casts = [
        'status' => StatusLaporan::class,
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function fotos()
    {
        return $this->hasMany(FotoLaporan::class);
    }

    public function respons()
    {
        return $this->hasMany(Respons::class);
    }
}