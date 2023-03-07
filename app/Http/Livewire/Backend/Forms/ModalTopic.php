<?php

namespace App\Http\Livewire\Backend\Forms;

use App\Models\Topic;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use WireUi\Traits\Actions;

class ModalTopic extends ModalComponent
{
    use Actions, WithFileUploads;
    // Set Data
    public $topic_id;
    // Model Values
    public $title, $count, $start, $end, $type, $qr, $age_restriction, $declaration, $matter, $pdf;
    public function mount()
    {
        if (!empty($this->topic_id)) {
            $data = Topic::findOrFail($this->topic_id);
            $this->title = $data->title;
            $this->count = $data->count;
            $this->start = $data->start;
            $this->end = $data->end;
            $this->type = $data->type;
            $this->qr = $data->qr;
            $this->age_restriction = $data->age_restriction;
            $this->declaration = $data->declaration;
            $this->matter = $data->matter;
            $this->pdf = $data->pdf;
        }
    }

    protected $rules = [
        'title' => '',
        'count' => '',
        'start' => '',
        'end' => '',
        'type' => '',
        'qr' => '',
        'age_restriction' => '',
        'declaration' => '',
        'matter' => '',
        'pdf' => '',
    ];


    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function add()
    {
        $validatedData = $this->validate();

        if (!empty($this->topic_id)) {
            $topic = Topic::where('id', $this->topic_id)->first();

            if (!empty($this->pdf) && gettype($this->pdf) != 'string' && $topic->type != 'Marks') {
                $validatedData['pdf'] = $this->pdf->store('topic', 'public');
            }
            if ($this->type == 'Marks') {
                unset($validatedData['age_restriction']);
            }

            unset($validatedData['qr']);

            Topic::where('id', $this->topic_id)->update($validatedData);

            $this->notification()->success($title = 'Topic Updated Successfully!');
        } else {
            if (!empty($this->pdf) && gettype($this->pdf) != 'string' && $this->type != 'Marks') {
                $validatedData['pdf'] = $this->pdf->store('topic', 'public');
            }
            $validatedData['qr'] = 1;
            if ($this->type == 'Marks') {
                unset($validatedData['age_restriction']);
            }

            if (is_null($validatedData['age_restriction'])) {
                $validatedData['age_restriction'] = 0;
            }

            $topic = Topic::create($validatedData);

            $validatedData['qr'] = QrCode::size(100)->generate(route('ready.quiz', ['topic' => $topic->id]));

            $topic->update(['qr' => $validatedData['qr']]);

            $this->notification()->success($title = 'Topic Saved Successfully!');
        }

        $this->emit('refreshLivewireDatatable');

        $this->closeModal();
    }

    public function render()
    {
        $types = getEnum('topics', 'type');

        return view('livewire.backend.forms.modal-topic', compact('types'));
    }
}
