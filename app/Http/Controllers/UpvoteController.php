<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use App\Models\Upvote;
use App\Http\Requests\UpvoteRequest;
use Illuminate\Support\Facades\DB;

class UpvoteController extends Controller
{
    /** Upvote sebuah laporan (AJAX endpoint, return JSON) */
    public function store(UpvoteRequest $request, Complaint $complaint)
    {
        $email = $request->validated()['email'];

        // Cek apakah email sudah pernah upvote laporan ini
        $exists = Upvote::where('complaint_id', $complaint->id)
            ->where('email', $email)
            ->exists();

        if ($exists) {
            return response()->json([
                'success' => false,
                'message' => 'Kamu sudah mendukung laporan ini sebelumnya.',
                'upvote_count' => $complaint->upvote_count,
            ], 200);
        }

        // Insert upvote + increment counter dalam satu transaction
        DB::transaction(function () use ($complaint, $email) {
            Upvote::create([
                'complaint_id' => $complaint->id,
                'email' => $email,
            ]);

            $complaint->increment('upvote_count');
        });

        return response()->json([
            'success' => true,
            'message' => 'Terima kasih! Dukunganmu telah tercatat.',
            'upvote_count' => $complaint->fresh()->upvote_count,
        ]);
    }
}
