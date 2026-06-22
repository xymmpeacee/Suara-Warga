<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use App\Http\Requests\StoreComplaintRequest;
use App\Mail\AduanCreatedMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ComplaintController extends Controller
{
    /** Halaman Lacak Status — daftar aduan publik dengan search & filter */
    public function index(Request $request)
    {
        $query = Complaint::withCount('responses');

        // Search: ticket_code, title, atau address
        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('ticket_code', 'like', "%{$search}%")
                  ->orWhere('title', 'like', "%{$search}%")
                  ->orWhere('address', 'like', "%{$search}%");
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

        $complaints = $query->latest()->paginate(9)->withQueryString();

        return view('complaints.track', compact('complaints'));
    }

    /** Halaman form buat aduan */
    public function create()
    {
        return view('complaints.create');
    }

    /** Simpan aduan baru ke database */
    public function store(StoreComplaintRequest $request)
    {
        $validated = $request->validated();

        // Upload foto ke storage/app/public/complaints
        $photoPath = $request->file('photo')->store('complaints', 'public');

        $complaint = Complaint::create([
            'ticket_code' => Complaint::generateTicketCode(),
            'category' => $validated['category'],
            'title' => $validated['title'],
            'description' => $validated['description'],
            'latitude' => $validated['latitude'],
            'longitude' => $validated['longitude'],
            'address' => $validated['address'] ?? null,
            'photo_path' => $photoPath,
            'priority' => $validated['priority'],
            'whatsapp' => $validated['whatsapp'],
            'reporter_name' => $validated['reporter_name'] ?: null,
            'reporter_email' => $validated['reporter_email'],
        ]);

        // Kirim email notifikasi tiket ke pelapor
        Mail::to($complaint->reporter_email)->send(new AduanCreatedMail($complaint));

        return redirect()->route('buat-aduan.sukses', $complaint);
    }

    /** Halaman sukses setelah buat aduan */
    public function success(Complaint $complaint)
    {
        return view('complaints.success', compact('complaint'));
    }

    /** Detail aduan (JSON response untuk modal) */
    public function show(Complaint $complaint)
    {
        $complaint->load('responses');

        return response()->json([
            'id' => $complaint->id,
            'ticket_code' => $complaint->ticket_code,
            'category' => $complaint->category,
            'category_label' => $complaint->category_label,
            'category_color' => $complaint->category_color,
            'title' => $complaint->title,
            'description' => $complaint->description,
            'latitude' => $complaint->latitude,
            'longitude' => $complaint->longitude,
            'address' => $complaint->address,
            'photo_url' => str_starts_with($complaint->photo_path, 'http')
                ? $complaint->photo_path
                : asset('storage/' . $complaint->photo_path),
            'priority' => $complaint->priority,
            'reporter_name' => auth('admin')->check() ? $complaint->actual_reporter_name : $complaint->public_reporter_name,
            'status' => $complaint->status,
            'status_label' => $complaint->status_label,
            'status_color' => $complaint->status_color,
            'upvote_count' => $complaint->upvote_count,
            'created_at' => $complaint->created_at->diffForHumans(),
            'created_at_formatted' => $complaint->created_at->format('d M Y, H:i'),
            'responses' => $complaint->responses->map(fn ($r) => [
                'status' => ucfirst($r->status_at_response),
                'message' => $r->message,
                'photo_url' => $r->photo_path
                    ? (str_starts_with($r->photo_path, 'http') ? $r->photo_path : asset('storage/' . $r->photo_path))
                    : null,
                'created_at' => $r->created_at->diffForHumans(),
                'created_at_formatted' => $r->created_at->format('d M Y, H:i'),
            ]),
        ]);
    }
}
