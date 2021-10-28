<x-livewire-tables::table.cell>
    {{ $row->id }}
</x-livewire-tables::table.cell>
<x-livewire-tables::table.cell>
    {{ $row->name }}
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
    @if($editedPatientIndex == $row->id)

        <input
            class="shadow appearance-none border rounded py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
            placeholder="previous record: {{$row->blood_pressure}}"
            type="text"
            wire:model.defer="blood_pressure"
        >
        @error('blood_pressure') <div class="text-red-500 text-xs italic">{{ $message }}</div> @enderror
    @else
        {{ $row->blood_pressure }}
    @endif

</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
    @if($editedPatientIndex == $row->id)
        <button wire:click="update({{$row->id}})"
                class="text-blue-700 hover:text-white hover:bg-blue-700 border-solid
                       border border-gray-700 font-bold py-2 px-4 rounded">Save</button>
    @else

            <button wire:click="edit({{$row->id}})"
                    class="text-green-700 hover:text-white hover:bg-green-700 border-solid
                           border border-gray-700 font-semibold py-2 px-4 rounded">Edit</button>

    @endif
</x-livewire-tables::table.cell>
