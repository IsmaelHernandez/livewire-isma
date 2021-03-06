<div class="relative">
@php($id = $attributes->wire('model')->value)
@if($image instanceof Livewire\TemporaryUploadedFile)
    <x-jet-danger-button wire:click="$set('{{$id}}')" class="absolute bottom-2 right-2">
        {{__('Change Image')}}
    </x-jet-danger-button>
    <img src="{{ $image->temporaryUrl() }}" class="border-2 rounded"> 
@elseif($existing)
    <img src="{{ Storage::disk('public')->url($existing) }}" alt="" >
@else
    <div class="h-32 bg-gray-50 border-2 border-dashed rounded flex items-center justify-center">
        <x-jet-label for="$id" class="cursor-pointer inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition" :value="__('Select Image')"/>
    </div>
@endif
     <x-jet-input wire:model="{{$id}}" :id="$id" class="hidden" type="file" />

</div>