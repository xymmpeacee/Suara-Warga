<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FotoRespons extends Model
{
    protected $table = 'foto_respons';
    protected $fillable = ['respons_id', 'path'];

    public function respons()
    {
        return $this->belongsTo(Respons::class);
    }
}