<div class="fi-simple-layout" style="padding-top: 5rem;">
    <div class="fi-simple-main-ctn">
        <div class="fi-simple-card">
            <h2 class="fi-card-header-heading text-xl font-bold tracking-tight">
                Connexion
            </h2>

            <form wire:submit.prevent="login" class="mt-8">
                <div>
                    <label for="code" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Code d'accès</label>
                    <div class="mt-1">
                        <input wire:model="code" id="code" type="password" class="fi-input block w-full rounded-lg shadow-sm border-gray-300 focus:border-primary-500 focus:ring-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" />
                        @error('code') <p class="mt-2 text-sm text-danger-600 dark:text-danger-400">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="mt-6">
                    <button type="submit" class="fi-btn fi-btn-primary block w-full">
                        Se connecter
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
