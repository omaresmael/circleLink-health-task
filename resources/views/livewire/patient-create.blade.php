<div class="flex flex-col items-center justify-center text-gray-700">
    <form class="flex flex-col bg-gray-200 rounded shadow-lg p-12" wire:submit.prevent="store">
        <label class="font-semibold text-xs" for="usernameField">Patient Name</label>
        <input
            wire:model="name"
            class="flex items-center shadow shadow-inline h-12 px-4 w-64
                   mt-2 rounded focus:outline-none focus:ring-2" type="text"  placeholder="Enter patient name">
        @error('name') <div class="text-red-500 text-xs italic">{{ $message }}</div> @enderror
        <label class="font-semibold text-xs mt-3" for="passwordField">Blood Pressure Reading</label>
        <input
            wire:model="blood_pressure"
            class="flex items-center shadow shadow-inline h-12 px-4 w-64
                   mt-2 rounded focus:outline-none focus:ring-2"type="text" placeholder="Format ex: 120/80">
        @error('blood_pressure') <div class="text-red-500 text-xs italic">{{ $message }}</div> @enderror
        <button type="submit"
                class="flex items-center justify-center h-12 px-6 w-64 bg-blue-600
                mt-8 rounded font-semibold text-sm text-blue-100 hover:bg-blue-700">Save</button>
        <div class="flex mt-6 justify-center text-xs">
            <a class="text-blue-400 hover:text-blue-500" href="{{route('patient.index')}}">Go Back to patients' data</a>

        </div>

    </form>
    <!-- Component End  -->

</div>
