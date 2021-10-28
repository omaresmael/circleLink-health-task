<?php

namespace App\Http\Livewire;

use App\Models\Patient;
use App\Rules\BloodPressureFormat;
use Livewire\Component;

class PatientCreate extends Component
{
    public $name;
    public $blood_pressure;

    protected function rules()
    {
        return [
            'name' => ['required','string'],
            'blood_pressure' => ['required',new BloodPressureFormat()],
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function store()
    {
        $validatedData = $this->validate();
        Patient::create($validatedData);
        return redirect(route('patient.index'))->with(['message' => 'Patient has been created successfully']);
    }

    public function render()
    {
        return view('livewire.patient-create');
    }
}
