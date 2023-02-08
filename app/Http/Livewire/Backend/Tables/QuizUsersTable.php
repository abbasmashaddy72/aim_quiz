<?php

namespace App\Http\Livewire\Backend\Tables;

use App\Models\QuizUser;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\NumberColumn;

class QuizUsersTable extends LivewireDatatable
{
    public $model = QuizUser::class;
    public $exportable = true;

    public function builder()
    {
        return QuizUser::query()->with('result');
    }

    public function columns()
    {
        return [
            Column::checkbox()
                ->label('Checkbox'),

            Column::index($this)
                ->unsortable(),

            Column::name('name')
                ->searchable()
                ->filterable(),

            Column::name('location')
                ->searchable()
                ->truncate(80)
                ->filterable(),

            NumberColumn::name('age')
                ->filterable(),

            NumberColumn::name('mobile')
                ->filterable(),

            NumberColumn::name('result.quiz_user_id:count')
                ->filterable()
                ->label('Results Count'),

            DateColumn::name('created_at')
                ->filterable(),

            Column::callback(['id'], function ($id) {
                return view('pages.backend.quiz_user.actions', ['id' => $id]);
            })->excludeFromExport()->unsortable()->label('Action'),
        ];
    }
}
