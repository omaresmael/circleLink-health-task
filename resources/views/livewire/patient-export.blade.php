<div class="flex flex-col md:flex-row items-center" x-data="{loading:false}">
    <button wire:click="export" @click="loading = true" class="text-gray-900 mb-1 md:mb-0 hover:text-white hover:bg-gray-900 border-solid
                       border border-gray-700 font-semibold py-2 px-4 rounded">Export</button>
    <div class="ml-1" x-show="loading">Exporting...please wait.</div>
    @if($exporting && !$exportFinished)
        <div class="ml-1" x-data="loading = false" wire:poll="updateExportProgress">almost done ...</div>
    @endif
    @if($exportFinished)
        <span class="ml-1" x-show="!loading">Done... Download file <a class=" cursor-pointer text-blue-600" wire:click="downloadExport">here</a></span>
    @endif
</div>
