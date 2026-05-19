<?php

namespace App\Models;

use App\Enums\StatusLaporan;
use Illuminate\Database\Eloquent\Model;

class Respons extends Model
{
    protected $table = 'respons';
    protected $fillable = ['laporan_id', 'user_id', 'pesan', 'status_baru'];

    protected $casts = [
        'status_baru' => StatusLaporan::class,
    ];

    public function laporan()
    {
        return $this->belongsTo(Laporan::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function fotos()
    {
        return $this->hasMany(FotoRespons::class);
    }
}