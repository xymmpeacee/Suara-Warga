{{-- Complaint Card Partial - expects $complaint variable --}}
<div class="card-lift bg-white rounded-2xl shadow-sm overflow-hidden border border-gray-100 cursor-pointer"
     onclick="openDetailModal({{ $complaint->id }})">
    {{-- Image --}}
    <div class="relative aspect-video bg-gray-200">
        <img src="{{ str_starts_with($complaint->photo_path, 'http') ? $complaint->photo_path : asset('storage/' . $complaint->photo_path) }}"
             alt="{{ $complaint->title }}" class="w-full h-full object-cover" loading="lazy">
        {{-- Category badge --}}
        <div class="absolute top-3 left-3">
            <span class="{{ $complaint->category_color }} text-[11px] font-semibold px-2.5 py-1 rounded-full">{{ $complaint->category_label }}</span>
        </div>
        {{-- Status badge --}}
        <div class="absolute top-3 right-3">
            <span class="{{ $complaint->status_color }} text-xs font-semibold px-2.5 py-0.5 rounded-full">{{ $complaint->status_label }}</span>
        </div>
    </div>

    {{-- Body --}}
    <div class="p-5">
        <h3 class="font-bold text-gray-900 mb-1.5 line-clamp-1">{{ $complaint->title }}</h3>
        <p class="text-sm text-gray-500 leading-relaxed mb-4 line-clamp-2">{{ $complaint->description }}</p>

        <div class="space-y-1.5 text-xs text-gray-400">
            @if($complaint->address)
            <div class="flex items-center gap-1.5"><span>📍</span><span class="line-clamp-1">{{ $complaint->address }}</span></div>
            @endif
            <div class="flex items-center gap-1.5"><span>👤</span><span>Warga Anonim</span></div>
        </div>

        <div class="flex items-center justify-between mt-4 pt-3 border-t border-gray-100">
            <div class="flex items-center gap-3 text-xs text-gray-400">
                <span class="flex items-center gap-1">🕐 {{ $complaint->created_at->diffForHumans() }}</span>
                @if(isset($complaint->responses_count))
                <span class="flex items-center gap-1">💬 {{ $complaint->responses_count }} tanggapan</span>
                @endif
            </div>
            <div class="flex items-center gap-2">
                <span class="text-[11px] text-gray-300 font-mono">{{ $complaint->ticket_code }}</span>
                <span class="inline-flex items-center gap-1 text-xs text-gray-400">👍 {{ $complaint->upvote_count }}</span>
            </div>
        </div>
    </div>
</div>
