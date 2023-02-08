<?php

namespace App\Http\Livewire\Backend\Tables;

use App\Models\Question;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\NumberColumn;

class QuestionsTable extends LivewireDatatable
{
    public $model = Question::class;
    public $exportable = true;

    public function builder()
    {
        return Question::query()->with('topic', 'options');
    }

    public function columns()
    {
        return [
            Column::checkbox()
                ->label('Checkbox'),

            Column::index($this)
                ->unsortable(),

            Column::name('topic.name')
                ->searchable()
                ->filterable()
                ->label('Topic Name'),

            Column::name('question_text')
                ->searchable()
                ->filterable(),

            NumberColumn::name('option.option:count')
                ->filterable()
                ->label('Options Count'),

            DateColumn::name('created_at')
                ->filterable(),

            Column::callback(['id'], function ($id) {
                return view('pages.backend.question.actions', ['id' => $id]);
            })->excludeFromExport()->unsortable()->label('Action'),
        ];
    }
}
