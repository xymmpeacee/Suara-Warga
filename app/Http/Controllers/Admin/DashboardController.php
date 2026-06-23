<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use App\Models\ComplaintResponse;
use App\Http\Requests\UpdateComplaintRequest;
use App\Mail\AduanStatusUpdatedMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class DashboardController extends Controller
{
    /** Dashboard admin — statistik, tabel laporan, search, filter, sort */
    public function index(Request $request)
    {
        // Statistik
        $stats = [
            'total' => Complaint::count(),
            'pending' => Complaint::where('status', 'pending')->count(),
            'diproses' => Complaint::where('status', 'diproses')->count(),
            'selesai' => Complaint::where('status', 'selesai')->count(),
        ];

        // Query builder
        $query = Complaint::withCount('responses');

        // Search
        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('ticket_code', 'like', "%{$search}%")
                    ->orWhere('title', 'like', "%{$search}%")
                    ->orWhere('address', 'like', "%{$search}%")
                    ->orWhere('reporter_name', 'like', "%{$search}%");
            });
        }

        // Filter kategori
        if ($category = $request->input('category')) {
            $query->where('category', $category);
        }

        // Filter status
        if ($status = $request->input('status')) {
            $query->where('status', $status);
        }

        // Sort (default: terbaru, opsi: upvote terbanyak)
        $sort = $request->input('sort', 'terbaru');
        if ($sort === 'upvote') {
            $query->orderByDesc('upvote_count');
        } else {
            $query->latest();
        }

        $complaints = $query->paginate(5)->withQueryString();

        return view('admin.dashboard', compact('stats', 'complaints', 'sort'));
    }

    /** Update status aduan + simpan tanggapan + kirim notifikasi email */
    public function update(UpdateComplaintRequest $request, Complaint $complaint)
    {
        $validated = $request->validated();

        // Upload foto bukti perbaikan (opsional)
        $photoPath = null;
        if ($request->hasFile('photo')) {

            $file = $request->file('photo');

            $fileName = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();

            $file->move(
                public_path('storage/responses'),
                $fileName
            );

            $photoPath = 'responses/' . $fileName;
        }

        // Insert response baru
        ComplaintResponse::create([
            'complaint_id' => $complaint->id,
            'status_at_response' => $validated['status'],
            'message' => $validated['message'] ?? null,
            'photo_path' => $photoPath,
        ]);

        // Update status complaint
        $complaint->update(['status' => $validated['status']]);

        // Kirim email notifikasi ke pelapor + semua pendukung (queued)
        $recipients = collect([$complaint->reporter_email]);

        // Tambahkan semua email upvoter
        $upvoterEmails = $complaint->upvotes()->pluck('email');
        $recipients = $recipients->merge($upvoterEmails)->unique();

        foreach ($recipients as $email) {
            if ($email) {
                Mail::to($email)->send(new AduanStatusUpdatedMail($complaint, $validated['message'] ?? null));
            }
        }

        return redirect()->route('admin.dashboard')
            ->with('success', "Status aduan {$complaint->ticket_code} berhasil diperbarui menjadi " . ucfirst($validated['status']) . '.');
    }
    public function destroy(Complaint $complaint)
    {
        $complaint->delete();
        return redirect()->route('admin.dashboard')
            ->with('success', "Aduan {$complaint->ticket_code} berhasil dihapus.");
    }
}
