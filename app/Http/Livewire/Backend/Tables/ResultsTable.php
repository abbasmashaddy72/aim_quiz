<?php

namespace App\Http\Livewire\Backend\Tables;

use App\Models\Result;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class ResultsTable extends LivewireDatatable
{
    public $model = Result::class;
    public $exportable = true;

    public function builder()
    {
        return Result::query()->with('quiz_user', 'topic', 'question', 'option');
    }

    public function columns()
    {
        return [
            Column::checkbox()
                ->label('Checkbox'),

            Column::index($this)
                ->unsortable(),

            Column::name('quiz_user.name')
                ->searchable()
                ->filterable(),

            Column::name('topic.title')
                ->searchable()
                ->filterable(),

            BooleanColumn::name('correct')
                ->filterable(),

            DateColumn::name('created_at')
                ->filterable(),

            Column::callback(['id'], function ($id) {
                return view('pages.backend.result.actions', ['id' => $id]);
            })->excludeFromExport()->unsortable()->label('Action'),
        ];
    }
}
