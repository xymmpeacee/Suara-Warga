<!-- Aduan Terkini Section -->
<section id="aduan-terkini" class="py-20 sm:py-28 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between mb-10 reveal">
            <div>
                <span class="inline-block text-xs font-bold tracking-[0.2em] uppercase text-primary mb-3">Aduan Terkini</span>
                <h2 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-gray-900">Apa yang dilaporkan warga</h2>
            </div>
            <a href="{{ route('lacak-status') }}" class="text-primary text-sm font-semibold hover:underline mt-3 sm:mt-0 inline-flex items-center gap-1">
                Lihat semua
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"/></svg>
            </a>
        </div>

        <!-- Cards -->
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 reveal-stagger">
            @forelse($recentComplaints as $complaint)
                @include('complaints.partials._card', ['complaint' => $complaint])
            @empty
                <div class="col-span-full text-center py-10 text-gray-400">Belum ada aduan masuk.</div>
            @endforelse
        </div>
    </div>
</section>
