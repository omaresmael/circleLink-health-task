@extends('layouts.app')
@section('content')
@if(session('message'))
        <div class="fixed text-center py-4 lg:px-4 right-0 bottom-0" x-show="flash" x-data="{flash:true}">
            <div class="p-2 bg-indigo-800 items-center text-indigo-100 leading-none lg:rounded-full flex lg:inline-flex" role="alert">
                <span class="flex rounded-full bg-indigo-500 uppercase px-2 py-1 text-xs font-bold mr-3">New</span>
                <span class="font-semibold mr-2 text-left flex-auto">{{session('message')}}</span>
                <svg @click="flash = false" class="fill-current opacity-75 h-4 w-4" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
            </div>
        </div>
@endif
    <div class="container flex flex-col justify-center mx-auto px-8 pt-16" x-data="{isEdit:false}">
        <h2 class="text-2xl lg:text-3xl font-bold mb-9 text-center text-gray-900">
            Patients Data
        </h2>
        <div class="flex flex-col md:flex-row text-center px-3 py-3 bg-gray-100 mb-3 justify-between rounded shadow-inner">
            <livewire:patient-export />
            <a href="{{route('patient.create')}}">
                <button class="text-blue-600 hover:text-white hover:bg-blue-600 border-solid
                               border border-gray-700 font-semibold py-2 px-4 rounded">
                    Create New Patient
                </button>
            </a>
        </div>
        <livewire:patient-table />
    </div>
@endsection

