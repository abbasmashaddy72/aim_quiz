<?php

namespace App\Http\Livewire\Backend\Forms;

use App\Models\QuizUser;
use LivewireUI\Modal\ModalComponent;
use WireUi\Traits\Actions;

class ModalQuizUser extends ModalComponent
{
    use Actions;
    // Set Data
    public $quiz_user_id;
    // Model Values
    public $name, $age, $location, $mobile;

    public function mount()
    {
        if (!empty($this->quiz_user_id)) {
            $data = QuizUser::findOrFail($this->quiz_user_id);
            $this->name = $data->name;
            $this->age = $data->age;
            $this->location = $data->location;
            $this->mobile = $data->mobile;
        }
    }

    protected $rules = [
        'name' => '',
        'age' => '',
        'location' => '',
        'mobile' => ''
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function add()
    {
        $validatedData = $this->validate();

        if (!empty($this->quiz_user_id)) {

            QuizUser::where('id', $this->quiz_user_id)->update($validatedData);

            $this->notification()->success($title = 'Quiz User Updated Successfully!');
        } else {
            $user = QuizUser::create($validatedData);

            $this->notification()->success($title = 'Quiz User Saved Successfully!');
        }

        $this->emit('refreshLivewireDatatable');

        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.backend.forms.modal-quiz-user');
    }
}
