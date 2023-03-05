<x-backend.modal-form form-action="add">
    <x-slot name="title">
        Update {{ $name }}
    </x-slot>

    <x-slot name="content">
        <div class="grid-cols-1 gap-2 row-gap-0 sm:grid">

            <div class="text-sm text-black">{{ $unique_id }}</div>

            <x-input label="{{ __('Name') }}" name="name" wire:model.defer='name' placeholder="Your Name"
                type="text" required autofocus />

            <x-input label="{{ __('Father Name') }}" name="father_name" wire:model.defer='father_name'
                placeholder="Your Father's Name" type="text" required />

            <x-native-select label="Select Gender" placeholder="Select Gender" :options="['Male', 'Female']" wire:model="gender" />

            <x-input label="{{ __('Age (in Years)') }}" name="age" wire:model.defer='dob'
                placeholder="Please Fill Your Age" type="number" required />

            <x-input label="{{ __('Location') }}" name="location" wire:model.defer='location' placeholder="Locality"
                type="text" required />

            <x-input label="{{ __('Contact Number') }}" name="mobile" wire:model.defer='mobile'
                placeholder="Please Enter Your 10 Digits Mobile Number" type="number" required />

            <x-label label="Do you Attend Any Islamic Class?" />
            <label class="inline-flex items-center">
                <input type="radio" class="w-4 h-4 form-radio" id="yes" value="1" wire:model="aic">
                <span class="ml-2">Yes</span>
            </label>
            <label class="inline-flex items-center">
                <input type="radio" class="w-4 h-4 form-radio" id="no" value="0" wire:model="aic">
                <span class="ml-2">No, I want to Join</span>
            </label>
            {{--
            <x-input name="name" label="Name" type="text" wire:model='name' />

            <x-input name="father_name" label="Father Name" type="text" wire:model='father_name' />

            <x-native-select label="Select Gender" placeholder="Select Gender" :options="['Male', 'Female']" wire:model="gender" />

            <x-input name="age" label="Age" type="number" wire:model='dob' />

            <x-input name="location" label="Location" type="location" wire:model='location' />

            <x-input name="mobile" label="Mobile" type="number" wire:model='mobile' />

            <x-checkbox id="checkbox" wire:model="aic" disabled /> --}}

        </div>
    </x-slot>

    <x-slot name="buttons">
        <button class="btn btn-primary" type="submit">Save</button>
    </x-slot>
</x-backend.modal-form>
