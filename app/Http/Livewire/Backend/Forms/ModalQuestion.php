<?php

namespace App\Http\Livewire\Backend\Forms;

use App\Models\Question;
use App\Models\QuestionsOption;
use App\Models\Topic;
use LivewireUI\Modal\ModalComponent;
use WireUi\Traits\Actions;

class ModalQuestion extends ModalComponent
{
    use Actions;
    // Set Data
    public $question_id;
    // Model Values
    public $topic_id, $question_text, $answer_explanation, $more_info_link, $age_restriction;
    // Related Values
    public $topic_type, $topic_age_restriction, $option_1, $option_2, $option_3, $option_4, $correct_option_1, $correct_option_2, $correct_option_3, $correct_option_4;

    public function mount()
    {
        if (!empty($this->question_id)) {
            $data = Question::with('topic', 'options')->findOrFail($this->question_id);
            $this->topic_id = $data->topic_id;
            $this->question_text = $data->question_text;
            $this->answer_explanation = $data->answer_explanation;
            $this->more_info_link = $data->more_info_link;
            $this->age_restriction = $data->age_restriction;
            // Topic
            $this->topic_type = $data->topic->type;
            $this->topic_age_restriction = $data->topic->age_restriction;
            // Option
            foreach ($data->options as $key => $options) {
                if ($key == 0) {
                    $this->option_1 = $options->option ?? '';
                    $this->correct_option_1 = $options->correct ?? '';
                }
                if ($key == 1) {
                    $this->option_2 = $options->option ?? '';
                    $this->correct_option_2 = $options->correct ?? '';
                }
                if ($key == 2) {
                    $this->option_3 = $options->option ?? '';
                    $this->correct_option_3 = $options->correct ?? '';
                }
                if ($key == 3) {
                    $this->option_4 = $options->option ?? '';
                    $this->correct_option_4 = $options->correct ?? '';
                }
            }
        }
    }

    protected $rules = [
        'topic_id' => '',
        'question_text' => '',
        'answer_explanation' => '',
        'more_info_link' => '',
        'age_restriction' => '',
    ];

    public function updatedTopicId()
    {
        $data = Topic::findOrFail($this->topic_id);

        $this->topic_type = $data->type;
        $this->topic_age_restriction = $data->age_restriction;
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function add()
    {
        $validatedData = $this->validate();

        if (!empty($this->question_id)) {
            $question = Question::where('id', $this->question_id)->first();

            if (empty($this->age_restriction)) {
                unset($validatedData['age_restriction']);
            }

            Question::where('id', $this->question_id)->update($validatedData);

            if ($this->topic_type != 'Marks') {
                QuestionsOption::updateOrCreate([
                    'question_id' => $this->question_id,
                    'option' => $this->option_1
                ], [
                    'correct' => $this->correct_option_1 ?? 0
                ]);
                QuestionsOption::updateOrCreate([
                    'question_id' => $this->question_id,
                    'option' => $this->option_2
                ], [
                    'correct' => $this->correct_option_2 ?? 0
                ]);
                QuestionsOption::updateOrCreate([
                    'question_id' => $this->question_id,
                    'option' => $this->option_3
                ], [
                    'correct' => $this->correct_option_3 ?? 0
                ]);
                QuestionsOption::updateOrCreate([
                    'question_id' => $this->question_id,
                    'option' => $this->option_4
                ], [
                    'correct' => $this->correct_option_4 ?? 0
                ]);
            }

            $this->notification()->success($title = 'Question Updated Successfully!');
        } else {

            if (empty($this->age_restriction)) {
                unset($validatedData['age_restriction']);
            }

            $question = Question::create($validatedData);

            if ($this->topic_type != 'Marks') {
                QuestionsOption::updateOrCreate([
                    'question_id' => $question->id,
                    'option' => $this->option_1
                ], [
                    'correct' => $this->correct_option_1 ?? 0
                ]);
                QuestionsOption::updateOrCreate([
                    'question_id' => $question->id,
                    'option' => $this->option_2
                ], [
                    'correct' => $this->correct_option_2 ?? 0
                ]);
                QuestionsOption::updateOrCreate([
                    'question_id' => $question->id,
                    'option' => $this->option_3
                ], [
                    'correct' => $this->correct_option_3 ?? 0
                ]);
                QuestionsOption::updateOrCreate([
                    'question_id' => $question->id,
                    'option' => $this->option_4
                ], [
                    'correct' => $this->correct_option_4 ?? 0
                ]);
            }

            $this->notification()->success($title = 'Question Saved Successfully!');
        }

        $this->emit('refreshLivewireDatatable');

        $this->closeModal();
    }

    public function render()
    {
        $topics = Topic::get();

        return view('livewire.backend.forms.modal-question', compact('topics'));
    }
}
