<?php

namespace Tests\Feature;

use App\Http\Livewire\PatientTable;
use App\Models\Patient;
use App\Rules\BloodPressureFormat;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class PatientTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
    **/
    public function itChecksIfTheDataTableExists()
    {
        $this->get('/')->assertSeeLivewire('patient-table');
    }

    /**
     * @test
     **/
    public function itUpdatesBloodPressure()
    {
        $patient = Patient::factory()->create([
            'blood_pressure' => '90/60'
        ]);

        Livewire::test(PatientTable::class)
            ->set('blood_pressure', '120/80')
            ->call('update',$patient->id);

        $this->assertTrue(Patient::where('blood_pressure','120/80')->exists());
    }

    /**
     * @test
     **/
    public function itDoesntUpdateBloodPressureIfSlashNoExists()
    {
        $patient = Patient::factory()->create([
            'blood_pressure' => '90/60'
        ]);

        Livewire::test(PatientTable::class)
            ->set('blood_pressure', 'test')
            ->call('update',$patient->id)
            ->assertHasErrors(['blood_pressure' => new BloodPressureFormat()]);

    }

    /**
     * @test
     **/
    public function itDoesntUpdateBloodPressureIfReadingsAreNotNumeric()
    {
        $patient = Patient::factory()->create([
            'blood_pressure' => '90/60'
        ]);

        Livewire::test(PatientTable::class)
            ->set('blood_pressure', 'test/test')
            ->call('update',$patient->id)
            ->assertHasErrors(['blood_pressure' => new BloodPressureFormat()]);

    }
}
