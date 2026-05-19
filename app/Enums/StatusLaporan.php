<?php

namespace App\Enums;

enum StatusLaporan: string
{
    case Pending = 'pending';
    case Diproses = 'diproses';
    case Selesai = 'selesai';

    public function label(): string
    {
        return match($this) {
            StatusLaporan::Pending  => 'Pending',
            StatusLaporan::Diproses => 'Diproses',
            StatusLaporan::Selesai  => 'Selesai',
        };
    }
}