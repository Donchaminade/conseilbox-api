<div class="fi-infolists-page grid auto-cols-fr gap-y-8 lg:grid-cols-3 lg:gap-x-8">
    <div class="fi-infolists-col-span-1 lg:col-span-2 space-y-6">
        <div class="fi-section rounded-xl bg-white shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10">
            <div class="fi-section-header flex h-16 items-center gap-x-3 overflow-hidden px-6">
                <h3 class="fi-section-header-heading text-xl font-semibold tracking-tight text-gray-950 dark:text-white">
                    Détails de la Publicité
                </h3>
            </div>
            <div class="fi-section-content-ctn border-t border-gray-200 p-6 dark:border-white/10">
                <div class="fi-section-content">
                    <div class="flex items-center gap-x-3">
                        <img
                            src="{{ $record->image_url ? Storage::url($record->image_url) : asset('images/logodark.png') }}"
                            alt="{{ $record->title }}"
                            class="h-24 w-24 object-cover rounded-full"
                        />
                        <div class="flex-1">
                            <h3 class="text-xl font-bold tracking-tight text-gray-950 dark:text-white sm:text-2xl">
                                {{ $record->title }}
                            </h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                {{ $record->is_active ? 'Active' : 'Inactive' }}
                                @if($record->start_date)
                                    - Du {{ \Carbon\Carbon::parse($record->start_date)->format('d/m/Y') }}
                                @endif
                                @if($record->end_date)
                                    au {{ \Carbon\Carbon::parse($record->end_date)->format('d/m/Y') }}
                                @endif
                            </p>
                        </div>
                    </div>

                    <div class="mt-4">
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Contenu :</p>
                        <div class="text-gray-700 dark:text-gray-200">
                            {{ $record->content ?? 'Aucun contenu.' }}
                        </div>
                    </div>

                    @if($record->target_url)
                        <div class="mt-4">
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">URL Cible :</p>
                            <a href="{{ $record->target_url }}" target="_blank" class="text-primary-600 hover:underline">
                                {{ $record->target_url }}
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="fi-infolists-col-span-1 space-y-6">
        <div class="fi-section rounded-xl bg-white shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10">
            <div class="fi-section-header flex h-16 items-center gap-x-3 overflow-hidden px-6">
                <h3 class="fi-section-header-heading text-xl font-semibold tracking-tight text-gray-950 dark:text-white">
                    Informations Additionnelles
                </h3>
            </div>
            <div class="fi-section-content-ctn border-t border-gray-200 p-6 dark:border-white/10">
                <div class="fi-section-content">
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Créé le :</p>
                        <div class="text-gray-700 dark:text-gray-200">
                            {{ \Carbon\Carbon::parse($record->created_at)->format('d/m/Y H:i') }}
                        </div>
                    </div>
                    <div class="mt-4">
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Modifié le :</p>
                        <div class="text-gray-700 dark:text-gray-200">
                            {{ \Carbon\Carbon::parse($record->updated_at)->format('d/m/Y H:i') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="fi-section rounded-xl bg-white shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10">
            <div class="fi-section-content-ctn p-6">
                <div class="flex gap-x-2">
                    {{ \Filament\Actions\Action::make('edit')
                        ->label('Modifier')
                        ->url(\App\Filament\Resources\Publicites\PubliciteResource::getUrl('edit', ['record' => $record]))
                        ->icon('heroicon-o-pencil')
                        ->color('primary')
                        ->button()
                    }}
                    {{ \Filament\Actions\Action::make('delete')
                        ->label('Supprimer')
                        ->requiresConfirmation()
                        ->action(fn (\App\Models\Publicite $publicite) => $publicite->delete())
                        ->icon('heroicon-o-trash')
                        ->color('danger')
                        ->button()
                    }}
                </div>
            </div>
        </div>
    </div>
</div>