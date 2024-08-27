<div>
    <header class="fi-simple-header py-8">
        <h1 class="fi-header-heading text-2xl font-bold tracking-tight text-gray-950 dark:text-white sm:text-3xl">
            Perfil de Usuario
        </h1>
    </header>
    <x-filament-panels::form id="form" wire:submit="save">
        {{ $this->form }}
        <x-filament-panels::form.actions :actions="$this->getCachedFormActions()" :full-width="$this->hasFullWidthFormActions()" />
    </x-filament-panels::form>
</div>
