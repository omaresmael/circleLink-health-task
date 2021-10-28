<?php

namespace App\Http\Controllers;

use App\Exports\PatientExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class PatientController extends Controller
{
    public function index()
    {
        return view('patient.index');
    }

    public function create()
    {
        return view('patient.create');
    }

}
