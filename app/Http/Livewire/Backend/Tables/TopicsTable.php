<?php

namespace App\Http\Livewire\Backend\Tables;

use App\Models\Topic;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\NumberColumn;

class TopicsTable extends LivewireDatatable
{
    public $model = Topic::class;
    public $exportable = true;

    public function builder()
    {
        return Topic::query()->with('questions');
    }

    public function types()
    {
        return getEnum('topics', 'type');
    }

    public function columns()
    {
        return [
            Column::checkbox()
                ->label('Checkbox'),

            Column::index($this)
                ->unsortable(),

            Column::name('title')
                ->searchable()
                ->filterable(),

            Column::name('type')
                ->searchable()
                ->filterable($this->types()),

            BooleanColumn::name('age_restriction')
                ->filterable(),

            Column::name('qr')
                ->filterable(),

            BooleanColumn::name('pdf')
                ->filterable(),

            NumberColumn::name('questions.question_text:count')
                ->filterable()
                ->label('Questions Count'),

            DateColumn::name('created_at')
                ->filterable(),

            Column::callback(['id'], function ($id) {
                return view('pages.backend.topic.actions', ['id' => $id]);
            })->excludeFromExport()->unsortable()->label('Action'),
        ];
    }
}
