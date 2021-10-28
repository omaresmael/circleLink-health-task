<?php

namespace App\Http\Livewire;

use App\Rules\BloodPressureFormat;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Patient;

class PatientTable extends DataTableComponent
{

    public $editedPatientIndex = '';
    public $blood_pressure = '';

    protected function rules()
    {
        return [
            'blood_pressure' => ['required',new BloodPressureFormat()],

        ];
    }
    public function edit($id)
    {

        $this->editedPatientIndex = $id;
    }
    public function update(Patient $patient)
    {
        $this->validate();
        $patient->update(['blood_pressure'=>$this->blood_pressure]);
        $this->reset(['editedPatientIndex', 'blood_pressure']);

    }

    public function columns(): array
    {
        $this->singleColumnSorting = true;
        return [

            Column::make('ID','id')
            ->sortable(),
            Column::make('Name')
            ->sortable()
            ->searchable(),
            Column::make('Blood Pressure','blood_pressure'),
            Column::make('Actions')

        ];
    }
    public function rowView(): string
    {
        return 'components.patient-table.row';
    }

    public function query(): Builder
    {
        return Patient::query();
    }
}
