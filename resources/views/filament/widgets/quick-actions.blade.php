<x-filament::section class="fi-section">
    <div class="flex flex-col gap-3 md:flex-row md:items-center md:justify-between">
        <div class="flex items-baseline gap-3">
            <p class="text-sm uppercase tracking-[0.3em] text-slate-400">Actions rapides</p>
            <span class="text-xs text-slate-500">Accès direct aux tâches critiques</span>
        </div>
        <div class="flex flex-wrap gap-2">
            @foreach ($actions as $action)
                <a
                    href="{{ $action['url'] }}"
                    class="inline-flex items-center gap-2 rounded-full border border-white/10 bg-slate-900/80 px-4 py-1.5 text-xs font-medium text-slate-100 hover:border-white/30 hover:bg-slate-800 transition"
                >
                    <span class="inline-flex h-6 w-6 items-center justify-center rounded-full bg-white/10">
                        <x-filament::icon :icon="$action['icon']" class="w-3.5 h-3.5" />
                    </span>
                    <span>{{ $action['label'] }}</span>
                </a>
            @endforeach
        </div>
    </div>
</x-filament::section>

