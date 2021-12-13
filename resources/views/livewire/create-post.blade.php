<div>
    <x-jet-danger-button wire:click="$set('open', true)"> 
        Crear Nuevo Post
    </x-jet-danger-button>

    {{-- mandamos a llamar el modal jetstream --}}
    <x-jet-dialog-modal wire:model="open">
        {{-- necesita 3 slot --}}
        <x-slot name="title">
            Crear nuevo post
        </x-slot>

        <x-slot name="content">

            <div class="mb-4">
                <x-jet-label value="Title:" />
                <x-jet-input type="text" wire:model="title" class="w-full" />
                <x-jet-input-error for="title" class="mt-3" />
            </div>
            <div class="mb-4">
                <x-jet-label value="Content:" />
                <x-jet-input type="text" wire:model="content" class="w-full" />
                <x-jet-input-error for="content" class="mt-3" />
            </div>
        </x-slot>

        <x-slot name="footer">
            {{-- metodo magico --}}
            <x-jet-secondary-button wire:click="$set('open', false)"> 
                Cancelar
            </x-jet-secondary-button>

            <x-jet-danger-button wire:click="save"  wire:loaging.attr="disabled" wire:target="save" class="disabled:opacity-25">
                Crear Post
            </x-jet-danger-button>

            
        </x-slot>

    </x-jet-dialog-modal>
</div>
