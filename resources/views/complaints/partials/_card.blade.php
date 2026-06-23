{{-- Complaint Card Partial - expects $complaint variable --}}
<div class="card-lift bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100 cursor-pointer"
    onclick="openDetailModal({{ $complaint->id }})">
    {{-- Image --}}
    <div class="relative aspect-video bg-gray-200">
        <img src="{{ str_starts_with($complaint->photo_path, 'http') ? $complaint->photo_path : asset('storage/' . $complaint->photo_path) }}"
            alt="{{ $complaint->title }}" class="w-full h-full object-cover" loading="lazy">
    </div>

    {{-- Body --}}
    <div class="p-5">
        {{-- Category & Status --}}
        <div class="flex items-center justify-between mb-3">
            <span class="flex items-center gap-1 text-xs text-gray-500 border border-gray-200 rounded-full px-2.5 py-0.5">
                <svg class="w-3.5 h-3.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 0 0 3 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 0 0 5.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 0 0 9.568 3Z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6Z" />
                </svg>
                {{ $complaint->category_label }}
            </span>
            <span class="{{ $complaint->status_color }} text-xs font-semibold px-2.5 py-0.5 rounded-full">{{ $complaint->status_label }}</span>
        </div>

        <h3 class="font-bold text-gray-900 mb-1.5 line-clamp-1">{{ $complaint->title }}</h3>
        <p class="text-sm text-gray-500 leading-relaxed mb-4 line-clamp-2">{{ $complaint->description }}</p>

        <div class="space-y-1.5 text-xs text-gray-400">
            @if($complaint->address)
            <div class="flex items-center gap-1.5">
                <svg class="w-3.5 h-3.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                </svg>
                <span class="line-clamp-1">{{ $complaint->address }}</span>
            </div>
            @endif
            <div class="flex items-center gap-3 text-xs text-gray-400 mb-3">
                <div class="flex items-center gap-1.5">
                    <svg class="w-3.5 h-3.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                    </svg>
                    <span>Warga Anonim</span>
                </div>
                <span class="flex items-center gap-1">
                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    {{ $complaint->created_at->diffForHumans() }}
                </span>
                @if(isset($complaint->responses_count))
                <span class="flex items-center gap-1">
                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12.76c0 1.6 1.123 2.994 2.707 3.227 1.087.16 2.185.283 3.293.369V21l4.076-4.076a1.526 1.526 0 0 1 1.037-.443 48.282 48.282 0 0 0 5.68-.494c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z" />
                    </svg>
                    {{ $complaint->responses_count }} tanggapan
                </span>
                @endif
            </div>

            {{-- Garis + ticket code + upvote --}}
            <div class="flex items-center justify-between pt-3 border-t border-gray-100">
                <span class="text-[11px] text-gray-400 font-mono">{{ $complaint->ticket_code }}</span>
                <span class="inline-flex items-center gap-1 text-xs text-gray-400">
                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.633 10.25c.806 0 1.533-.446 2.031-1.08a9.041 9.041 0 0 1 2.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 0 0 .322-1.672V2.75a.75.75 0 0 1 .75-.75 2.25 2.25 0 0 1 2.25 2.25c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282m0 0h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 0 1-2.649 7.521c-.388.482-.987.729-1.605.729H13.48c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 0 0-1.423-.23H5.904m10.598-9.75H14.25M5.904 18.5c.083.205.173.405.27.602.197.4-.078.898-.523.898h-.908c-.889 0-1.713-.518-1.972-1.368a12 12 0 0 1-.521-3.507c0-1.553.295-3.036.831-4.398C3.387 9.953 4.167 9.5 5 9.5h1.053c.472 0 .745.556.5.96a8.958 8.958 0 0 0-1.302 4.665c0 1.194.232 2.333.654 3.375Z" />
                    </svg>
                    {{ $complaint->upvote_count }}
                </span>
            </div>
        </div>
    </div>
</div>