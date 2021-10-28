@extends('layouts.app')
@section('content')

    <div class="container flex flex-col justify-center mx-auto px-8 pt-16">
        <h2 class="text-2xl lg:text-3xl font-bold mb-9 text-center text-gray-900">
            Create New Patient
        </h2>

        <livewire:patient-create></livewire:patient-create>
    </div>

@endsection
