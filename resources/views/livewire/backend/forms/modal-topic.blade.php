<x-backend.modal-form form-action="add">
    <x-slot name="title">
        Update {{ $title }}
    </x-slot>

    <x-slot name="content">
        <div class="grid-cols-1 gap-2 row-gap-0 sm:grid">
            <x-native-select label="Select Type" placeholder="Select one Type" :options="$types" wire:model="type" />

            <x-input name="title" label="Title" type="text" wire:model='title' />

            <x-input name="start" label="Start Date" type="date" wire:model='start' />

            <x-input name="end" label="End Date" type="date" wire:model='end' />

            @if ($type == 'Online' || $type == 'Offline')
                <div class="mt-2">
                    <x-checkbox id="age_restriction" label="Age Restriction" wire:model="age_restriction" />
                </div>

                <x-input name="count" label="Total Question Count" type="number" wire:model='count' />

                <x-textarea wire:model="declaration" label="Declaration" placeholder="Your Declaration Message" />

                <x-textarea wire:model="matter" label="Slides Matter" placeholder="Your Slides Matter" />

                {{-- <x-backend.ckeditor id="bodyen" lang="EN" name="matter" label="Slides Matter"
                    wire:model='matter' /> --}}

                <x-input name="pdf" label="PDF" type="file" wire:model='pdf' />
            @endif
        </div>
    </x-slot>

    <x-slot name="buttons">
        <button class="btn btn-primary" type="submit">Save</button>
    </x-slot>
</x-backend.modal-form>
