<x-backend.modal-form form-action="add">
    <x-slot name="title">
        Update {{ $name }}
    </x-slot>

    <x-slot name="content">
        <div class="grid-cols-1 gap-2 row-gap-0 sm:grid">

            <div class="text-sm text-black">{{ $unique_id }}</div>

            <x-input name="name" label="Name" type="text" wire:model='name' />

            <x-input name="father_name" label="Father Name" type="text" wire:model='father_name' />

            <x-native-select label="Select Gender" placeholder="Select Gender" :options="['Male', 'Female']" wire:model="gender" />

            <x-input name="age" label="Age" type="number" wire:model='dob' />

            <x-input name="location" label="Location" type="location" wire:model='location' />

            <x-input name="mobile" label="Mobile" type="number" wire:model='mobile' />

            <x-checkbox id="checkbox" wire:model="aic" disabled />

        </div>
    </x-slot>

    <x-slot name="buttons">
        <button class="btn btn-primary" type="submit">Save</button>
    </x-slot>
</x-backend.modal-form>
