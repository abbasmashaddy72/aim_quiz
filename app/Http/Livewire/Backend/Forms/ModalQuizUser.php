<?php

namespace App\Http\Livewire\Backend\Forms;

use App\Models\QuizUser;
use Carbon\Carbon;
use Illuminate\Support\Str;
use LivewireUI\Modal\ModalComponent;
use WireUi\Traits\Actions;

class ModalQuizUser extends ModalComponent
{
    use Actions;
    // Set Data
    public $quiz_user_id;
    // Model Values
    public $unique_id, $name, $father_name, $gender, $dob, $location, $mobile, $aic;

    public function mount()
    {
        if (!empty($this->quiz_user_id)) {
            $data = QuizUser::findOrFail($this->quiz_user_id);
            $this->unique_id = $data->unique_id;
            $this->name = $data->name;
            $this->father_name = $data->father_name;
            $this->gender = $data->gender;
            $this->dob = Carbon::parse($data->dob)->age;
            $this->location = $data->location;
            $this->mobile = $data->mobile;
            $this->aic = $data->aic;
        }
    }

    protected $rules = [
        'unique_id' => '',
        'name' => '',
        'father_name' => '',
        'gender' => '',
        'dob' => '',
        'location' => '',
        'mobile' => '',
        'aic' => '',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function add()
    {
        $validatedData = $this->validate();

        $current_dob = $validatedData['dob'];

        $new_dob = new Carbon();
        $validatedData['dob'] = $new_dob->subYears($current_dob)->format('Y-m-d');

        if (!empty($this->quiz_user_id)) {

            $validatedData['unique_id'] = Str::random(5);
            QuizUser::where('id', $this->quiz_user_id)->update($validatedData);

            $this->notification()->success($title = 'Quiz User Updated Successfully!');
        } else {
            $validatedData['unique_id'] = Str::random(5);
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
