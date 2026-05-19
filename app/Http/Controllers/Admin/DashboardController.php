<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Laporan;
use App\Models\User;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $totalLaporan  = Laporan::count();
        $totalPending  = Laporan::where('status', 'pending')->count();
        $totalDiproses = Laporan::where('status', 'diproses')->count();
        $totalSelesai  = Laporan::where('status', 'selesai')->count();
        $totalWarga    = User::role('warga')->count();
        $laporanTerbaru = Laporan::with(['user', 'kategori'])->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalLaporan',
            'totalPending',
            'totalDiproses',
            'totalSelesai',
            'totalWarga',
            'laporanTerbaru'
        ));
    }
}