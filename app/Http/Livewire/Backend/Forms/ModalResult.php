<?php

namespace App\Http\Livewire\Backend\Forms;

use LivewireUI\Modal\ModalComponent;
use WireUi\Traits\Actions;

class ModalResult extends ModalComponent
{
    use Actions;

    public function render()
    {
        return view('livewire.backend.forms.modal-result');
    }
}
