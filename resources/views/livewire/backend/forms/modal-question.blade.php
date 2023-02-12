<x-backend.modal-form form-action="add">
    <x-slot name="title">
        Update {{ $title }}
    </x-slot>

    <x-slot name="content">
        <div class="grid-cols-1 gap-2 row-gap-0 sm:grid">
            <x-native-select label="Select Topic" placeholder="Select one Topic" :options="$topics" option-label="title"
                option-value="id" wire:model="topic_id" />

            <x-textarea name="question_text" label="Question Text" wire:model='question_text' />

            <x-textarea name="answer_explanation" label="Answer Explanation" wire:model='answer_explanation' />

            <x-input name="more_info_link" label='Reference Text / Link' wire:model='more_info_link' />

            @if ($topic_age_restriction == 1)
                <x-input name="age_restriction"
                    label='Age Restriction (Ex: <=20, >=50 ensure without any space & = with < / >)'
                    wire:model='age_restriction' />
            @endif

            @if ($topic_type != 'Marks')
                <x-input name="option_1" label='Option 1' wire:model='option_1' />
                <x-input name="option_2" label='Option 2' wire:model='option_2' />
                <x-input name="option_3" label='Option 3' wire:model='option_3' />
                <x-input name="option_4" label='Option 4' wire:model='option_4' />

                <x-label>Correct Option</x-label>
                <div class="grid grid-cols-4 gap-4">
                    <x-checkbox id="correct_option_1" label="Option 1" wire:model="correct_option_1" />
                    <x-checkbox id="correct_option_2" label="Option 2" wire:model="correct_option_2" />
                    <x-checkbox id="correct_option_3" label="Option 3" wire:model="correct_option_3" />
                    <x-checkbox id="correct_option_4" label="Option 4" wire:model="correct_option_4" />
                </div>
            @endif
        </div>
    </x-slot>

    <x-slot name="buttons">
        <button class="btn btn-primary" type="submit">Save</button>
    </x-slot>
</x-backend.modal-form>
