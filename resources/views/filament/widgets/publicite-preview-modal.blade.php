<x-filament-panels::page>
    <div class="filament-infolists-page grid auto-cols-fr gap-y-8 lg:grid-cols-3 lg:gap-x-8">
        <div class="fi-infolists-col-span-1 lg:col-span-2 space-y-6">
            <x-filament-panels::section>
                <div class="flex items-center gap-x-3">
                    <x-filament::avatar
                        src="{{ $record->image_url ? Storage::url($record->image_url) : asset('images/logodark.png') }}"
                        alt="{{ $record->title }}"
                        class="h-24 w-24 object-cover"
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

                <x-filament-infolists::entry-wrapper class="mt-4">
                    <x-filament-infolists::field-wrapper-label>Contenu :</x-filament-infolists::field-wrapper-label>
                    <div class="text-gray-700 dark:text-gray-200">
                        {{ $record->content ?? 'Aucun contenu.' }}
                    </div>
                </x-filament-infolists::entry-wrapper>

                @if($record->target_url)
                    <x-filament-infolists::entry-wrapper class="mt-4">
                        <x-filament-infolists::field-wrapper-label>URL Cible :</x-filament-infolists::field-wrapper-label>
                        <a href="{{ $record->target_url }}" target="_blank" class="text-primary-600 hover:underline">
                            {{ $record->target_url }}
                        </a>
                    </x-filament-infolists::entry-wrapper>
                @endif
            </x-filament-panels::section>
        </div>

        <div class="fi-infolists-col-span-1 space-y-6">
            <x-filament-panels::section>
                <x-filament-infolists::entry-wrapper>
                    <x-filament-infolists::field-wrapper-label>Créé le :</x-filament-infolists::field-wrapper-label>
                    <div class="text-gray-700 dark:text-gray-200">
                        {{ \Carbon\Carbon::parse($record->created_at)->format('d/m/Y H:i') }}
                    </div>
                </x-filament-infolists::entry-wrapper>
                <x-filament-infolists::entry-wrapper>
                    <x-filament-infolists::field-wrapper-label>Modifié le :</x-filament-infolists::field-wrapper-label>
                    <div class="text-gray-700 dark:text-gray-200">
                        {{ \Carbon\Carbon::parse($record->updated_at)->format('d/m/Y H:i') }}
                    </div>
                </x-filament-infolists::entry-wrapper>
            </x-filament-panels::section>

            <x-filament-panels::section>
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
            </x-filament-panels::section>
        </div>
    </div>
</x-filament-panels::page>