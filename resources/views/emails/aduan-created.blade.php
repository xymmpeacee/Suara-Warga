<!DOCTYPE html>
<html lang="id">
<head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"></head>
<body style="margin:0;padding:0;background:#F3F4F6;font-family:'Segoe UI',Arial,sans-serif;">
<div style="max-width:560px;margin:32px auto;background:#fff;border-radius:16px;overflow:hidden;box-shadow:0 2px 8px rgba(0,0,0,0.06);">
    <div style="background:#1B3FE4;padding:28px 32px;text-align:center;">
        <h1 style="color:#fff;font-size:22px;margin:0;">SuaraWarga</h1>
        <p style="color:rgba(255,255,255,0.7);font-size:12px;margin:4px 0 0;letter-spacing:2px;">LAYANAN ADUAN</p>
    </div>
    <div style="padding:32px;">
        <p style="color:#374151;font-size:15px;line-height:1.6;margin:0 0 16px;">
            Halo {{ $complaint->reporter_name ?? 'Warga' }},
        </p>
        <p style="color:#374151;font-size:15px;line-height:1.6;margin:0 0 24px;">
            Laporan Anda telah berhasil dikirim dan tercatat dalam sistem kami. Berikut adalah kode tiket Anda:
        </p>
        <div style="background:#F0F3FF;border:2px dashed #1B3FE4;border-radius:12px;padding:20px;text-align:center;margin-bottom:24px;">
            <p style="color:#6B7280;font-size:12px;margin:0 0 6px;text-transform:uppercase;letter-spacing:1px;">Kode Tiket</p>
            <p style="color:#1B3FE4;font-size:28px;font-weight:bold;margin:0;letter-spacing:2px;">{{ $complaint->ticket_code }}</p>
        </div>
        <table style="width:100%;border-collapse:collapse;margin-bottom:24px;">
            <tr><td style="padding:8px 0;color:#6B7280;font-size:13px;">Judul</td><td style="padding:8px 0;color:#111827;font-size:13px;font-weight:600;">{{ $complaint->title }}</td></tr>
            <tr><td style="padding:8px 0;color:#6B7280;font-size:13px;">Kategori</td><td style="padding:8px 0;color:#111827;font-size:13px;">{{ $complaint->category_label }}</td></tr>
            <tr><td style="padding:8px 0;color:#6B7280;font-size:13px;">Status</td><td style="padding:8px 0;color:#111827;font-size:13px;">{{ ucfirst($complaint->status) }}</td></tr>
        </table>
        <div style="text-align:center;">
            <a href="{{ route('lacak-status', ['search' => $complaint->ticket_code]) }}" style="display:inline-block;background:#1B3FE4;color:#fff;padding:12px 28px;border-radius:999px;text-decoration:none;font-size:14px;font-weight:600;">Lacak Status Aduan</a>
        </div>
    </div>
    <div style="padding:16px 32px;border-top:1px solid #E5E7EB;text-align:center;">
        <p style="color:#9CA3AF;font-size:11px;margin:0;">© 2026 SuaraWarga. Untuk warga, oleh warga.</p>
    </div>
</div>
</body>
</html>
