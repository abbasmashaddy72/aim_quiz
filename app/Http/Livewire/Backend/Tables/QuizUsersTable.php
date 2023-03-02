<?php

namespace App\Http\Livewire\Backend\Tables;

use App\Models\QuizUser;
use Carbon\Carbon;
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

            Column::name('unique_id')
                ->searchable()
                ->filterable(),

            Column::name('name')
                ->searchable()
                ->filterable(),

            Column::name('father_name')
                ->searchable()
                ->filterable(),

            Column::name('gender')
                ->searchable()
                ->filterable(['Male', 'Female']),

            Column::name('location')
                ->searchable()
                ->truncate(80)
                ->filterable(),

            NumberColumn::callback(['dob'], function ($id) {
                return  Carbon::parse($id)->age;
            })->label('Age')
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
