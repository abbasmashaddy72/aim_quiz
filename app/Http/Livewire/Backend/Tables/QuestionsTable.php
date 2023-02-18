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
        return Question::query()->with('topics', 'options');
    }

    public function columns()
    {
        return [
            Column::checkbox()
                ->label('Checkbox'),

            Column::index($this)
                ->unsortable(),

            Column::name('topics.title')
                ->searchable()
                ->filterable()
                ->label('Topic Name'),

            Column::name('question_text')
                ->searchable()
                ->filterable(),

            Column::name('age_restriction')
                ->searchable()
                ->filterable(),

            Column::name('answer_explanation')
                ->searchable()
                ->filterable(),

            Column::name('more_info_link')
                ->searchable()
                ->filterable()
                ->label('Reference Text / Link'),

            NumberColumn::name('options.option:count')
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
