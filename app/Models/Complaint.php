<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Complaint extends Model
{
    protected $fillable = [
        'ticket_code',
        'category',
        'title',
        'description',
        'latitude',
        'longitude',
        'address',
        'photo_path',
        'priority',
        'whatsapp',
        'reporter_name',
        'reporter_email',
        'status',
        'upvote_count',
    ];

    protected $casts = [
        'latitude' => 'decimal:7',
        'longitude' => 'decimal:7',
        'upvote_count' => 'integer',
    ];

    // ===== Label helpers =====

    /** Label kategori yang readable */
    public const CATEGORY_LABELS = [
        'jalan_rusak' => 'Jalan Rusak',
        'sampah' => 'Sampah',
        'penerangan' => 'Penerangan',
        'drainase' => 'Drainase',
        'fasilitas_umum' => 'Fasilitas Umum',
        'lainnya' => 'Lainnya',
    ];

    /** Warna badge status */
    public const STATUS_COLORS = [
        'pending' => 'bg-yellow-100 text-yellow-700',
        'diproses' => 'bg-blue-100 text-blue-700',
        'selesai' => 'bg-green-100 text-green-700',
        'ditolak' => 'bg-red-100 text-red-700',
    ];

    /** Warna badge kategori */
   public const CATEGORY_COLORS = [
    'jalan_rusak' => 'bg-primary text-white',
    'sampah' => 'bg-primary text-white',
    'penerangan' => 'bg-primary text-white',
    'drainase' => 'bg-primary text-white',
    'fasilitas_umum' => 'bg-primary text-white',
    'lainnya' => 'bg-primary text-white',
];

    public const PRIORITY_LABELS = [
        'rendah' => 'Rendah',
        'sedang' => 'Sedang',
        'tinggi' => 'Tinggi',
    ];

    // ===== Accessors =====

    public function getCategoryLabelAttribute(): string
    {
        return self::CATEGORY_LABELS[$this->category] ?? $this->category;
    }

    public function getStatusLabelAttribute(): string
    {
        return ucfirst($this->status);
    }

    public function getStatusColorAttribute(): string
    {
        return self::STATUS_COLORS[$this->status] ?? 'bg-gray-100 text-gray-700';
    }

    public function getCategoryColorAttribute(): string
    {
        return self::CATEGORY_COLORS[$this->category] ?? 'bg-gray-500 text-white';
    }

    /** Nama pelapor untuk tampilan publik (selalu anonim) */
    public function getPublicReporterNameAttribute(): string
    {
        return 'Warga Anonim';
    }

    /** Nama pelapor asli (untuk admin) */
    public function getActualReporterNameAttribute(): string
    {
        return $this->reporter_name ?? 'Warga Anonim';
    }

    // ===== Relationships =====

    public function responses(): HasMany
    {
        return $this->hasMany(ComplaintResponse::class)->orderByDesc('created_at');
    }

    public function upvotes(): HasMany
    {
        return $this->hasMany(Upvote::class);
    }

    // ===== Ticket Code Generator =====

    /**
     * Generate kode tiket unik: SW-{2 digit tahun}-{5 char alfanumerik random}
     * Loop sampai ditemukan yang unique di database
     */
    public static function generateTicketCode(): string
    {
        $year = date('y');

        do {
            $random = strtoupper(Str::random(5));
            $code = "SW-{$year}-{$random}";
        } while (self::where('ticket_code', $code)->exists());

        return $code;
    }
}
