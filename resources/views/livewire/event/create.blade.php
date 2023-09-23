<form wire:submit.prevent="create">
    <div class="mt-5">
        <x-input-label for="title" :value="__('Title')" />
        <x-text-input wire:model='form.title' class="block mt-1 w-full" type="text" required autofocus
            autocomplete="title" />
        <x-input-error :messages="$errors->get('form.title')" class="mt-2" />
    </div>



    <div class="mt-5">
        <x-input-label for="body" :value="__('body')" />
        <x-text-input wire:model='form.body' class="block mt-1 w-full" type="text" required autofocus
            autocomplete="body" />
        <x-input-error :messages="$errors->get('form.body')" class="mt-2" />
    </div>



    <div class="mt-5">
        <x-input-label for="place" :value="__('place')" />
        <x-text-input wire:model='form.place' class="block mt-1 w-full" type="text" required autofocus
            autocomplete="place" />
        <x-input-error :messages="$errors->get('form.place')" class="mt-2" />
    </div>



    <div class="mt-5">
        <x-input-label for="start_date" :value="__('start_date')" />
        <x-text-input wire:model='form.start_date' class="block mt-1 w-full" type="date" required autofocus
            autocomplete="start_date" />
        <x-input-error :messages="$errors->get('form.start_date')" class="mt-2" />
    </div>



    <div class="mt-5">
        <x-input-label for="end_date" :value="__('end_date')" />
        <x-text-input wire:model='form.end_date' class="block mt-1 w-full" type="date" required autofocus
            autocomplete="end_date" />
        <x-input-error :messages="$errors->get('form.end_date')" class="mt-2" />
    </div>



    <div class="mt-5">
        <x-input-label for="price" :value="__('price')" />
        <x-text-input wire:model='form.price' class="block mt-1 w-full" type="number" required autofocus
            autocomplete="price" />
        <x-input-error :messages="$errors->get('form.price')" class="mt-2" />
    </div>

    <div class="mt-5">
        <x-input-label for="tags" :value="__('tags')" />
        <x-text-input wire:model='form.tags' class="block mt-1 w-full" type="text" required autofocus
            autocomplete="tags" />
        <x-input-error :messages="$errors->get('form.tags')" class="mt-2" />
        <span class="text-sm text-gray-600 space-y-1">
            ex1,ex2,ex3
        </span>
    </div>

    <div class="flex items-center justify-end mt-4">

        <x-primary-button class="ml-4">
            {{ __('Create') }}
        </x-primary-button>
    </div>
</form>
