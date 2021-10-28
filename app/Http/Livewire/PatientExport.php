<?php

namespace App\Http\Livewire;

use App\Jobs\ExportJob;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class PatientExport extends Component
{
    public $batchId;
    public $exporting = false;
    public $exportFinished = false;

    public function export()
    {
        $this->exporting = true;
        $this->exportFinished = false;

        $batch = Bus::batch([
            new ExportJob(),
        ])->name('Export Patients')->dispatch();

        $this->batchId = $batch->id;
    }
    public function getExportBatchProperty()
    {
        if (!$this->batchId) {
            return null;
        }

        return Bus::findBatch($this->batchId);
    }
    public function downloadExport()
    {
        return Storage::download('public/patients.csv');
    }
    public function updateExportProgress()
    {

        if ($this->exportBatch && $this->exportBatch->finished()) {
            $this->exportFinished = true;
            $this->exporting = false;
        }
    }

    public function render()
    {
        return view('livewire.patient-export');
    }
}
