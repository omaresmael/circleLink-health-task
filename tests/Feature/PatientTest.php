<?php

namespace Tests\Feature;


use App\Http\Livewire\PatientExport;
use App\Http\Livewire\PatientCreate;
use App\Http\Livewire\PatientTable;
use App\Models\Patient;
use App\Rules\BloodPressureFormat;
use Illuminate\Bus\PendingBatch;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Bus;
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
    public function itDispatchesQueueExport()
    {
        Bus::fake();
        Livewire::test(PatientExport::class)
            ->call('export');

        Bus::assertBatched(function (PendingBatch $batch) {
            return $batch->name == 'Export Patients' &&
                $batch->jobs->count() === 1;
        });

    }
    /**
     * @test
     **/
    public function itStoresPatientExport()
    {
        Excel::fake();
        Livewire::test(PatientExport::class)
            ->call('export');
        Excel::assertStored('public/patients.csv');
    }
}
