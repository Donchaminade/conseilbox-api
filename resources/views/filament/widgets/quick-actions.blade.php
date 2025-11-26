<x-filament::section class="fi-section">
    <div class="flex items-center justify-between mb-6">
        <div>
            <p class="text-sm uppercase tracking-[0.3em] text-slate-400">Actions rapides</p>
            <p class="text-xl font-semibold text-white">Accès direct aux tâches critiques</p>
        </div>
        <span class="text-xs text-slate-400 hidden md:inline">Optimisé selon les principes One UI</span>
    </div>

    <div class="grid gap-4 md:grid-cols-3">
        @foreach ($actions as $action)
            <a
                href="{{ $action['url'] }}"
                class="group relative overflow-hidden rounded-2xl p-5 border border-white/5 bg-gradient-to-br {{ $action['accent'] }} text-white shadow-lg transition transform hover:-translate-y-1 hover:shadow-2xl"
            >
                <div class="absolute inset-0 opacity-20 bg-[radial-gradient(circle_at_top,#fff,transparent_45%)]"></div>
                <div class="relative z-10 flex items-center justify-between">
                    <div>
                        <p class="text-sm font-semibold">{{ $action['label'] }}</p>
                        <p class="mt-1 text-xs text-white/80 leading-relaxed">{{ $action['description'] }}</p>
                    </div>
                    <div class="p-2 rounded-full bg-white/20 backdrop-blur">
                        <x-filament::icon :icon="$action['icon']" class="w-4 h-4" />
                    </div>
                </div>
                <span class="relative z-10 mt-4 inline-flex items-center gap-1 text-xs font-semibold uppercase tracking-widest text-white/80">
                    Commencer
                    <svg viewBox="0 0 24 24" class="w-4 h-4 transition group-hover:translate-x-1">
                        <path d="M5 12h14m0 0-5-5m5 5-5 5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </span>
            </a>
        @endforeach
    </div>
</x-filament::section>

