<?php

namespace Tests\Feature;

use App\Exports\PatientExport;
use App\Http\Livewire\PatientCreate;
use App\Http\Livewire\PatientTable;
use App\Models\Patient;
use App\Rules\BloodPressureFormat;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Maatwebsite\Excel\Facades\Excel;
use Tests\TestCase;

class PatientTest extends TestCase
{
    use RefreshDatabase;

    // index & update tests ...
    /**
     * @test
    **/
    public function itChecksIfTheDataTableExists()
    {
        $this->get(route('patient.index'))->assertSeeLivewire('patient-table');
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
    public function itDoesntUpdateBloodPressureIfItHasMoreThanOneSlash()
    {
        $patient = Patient::factory()->create([
            'blood_pressure' => '90/60'
        ]);

        Livewire::test(PatientTable::class)
            ->set('blood_pressure', '90/60/92')
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

    // create tests ...

    /**
     * @test
     **/
    public function itChecksIfTheCreateComponentExists()
    {
        $this->get(route('patient.create'))->assertSeeLivewire('patient-create');
    }

    /**
     * @test
     **/
    public function itCreatesAPatient()
    {
        Livewire::test(PatientCreate::class)
            ->set('name', 'omar esmaeel')
            ->set('blood_pressure', '120/80')
            ->call('store');

            $this->assertTrue(Patient::where('name','omar esmaeel')->exists());
    }
 // export tests ...
    /**
     * @test
     **/
    public function itDownloadsCsvFile()
    {
        $response = $this->get(route('patient.export'));
        $response->assertDownload('patients.csv');
    }

    /**
     * @test
     **/
    public function itDownloadsCsvFileWithPatientData()
    {
        Excel::fake();
        Patient::factory()->create([
            'name' => 'omar esmaeel'
        ]);
        $this->get(route('patient.export'));
        Excel::assertDownloaded('patients.csv', function(PatientExport $export) {
            return $export->collection()->contains('name','=','omar esmaeel');
        });

    }
}
