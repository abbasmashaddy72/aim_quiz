<x-backend.modal-form form-action="add">
    <x-slot name="title">
        Update {{ $name }}
    </x-slot>

    <x-slot name="content">
        <div class="grid-cols-1 gap-2 row-gap-0 sm:grid">
            <x-input name="name" label="Name" type="text" wire:model='name' />

            <x-input name="age" label="Age" type="number" wire:model='age' />

            <x-input name="location" label="Location" type="location" wire:model='location' />

            <x-input name="mobile" label="Mobile" type="number" wire:model='mobile' />
        </div>
    </x-slot>

    <x-slot name="buttons">
        <button class="btn btn-primary" type="submit">Save</button>
    </x-slot>
</x-backend.modal-form>
