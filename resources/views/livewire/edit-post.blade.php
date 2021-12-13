<div>
    
    <a class="btn btn-green" wire:click="$set('open', true)">
        <i class="fas fa-edit"></i>
    </a>
    {{-- mandamos a llamar el modal jetstream --}}
    <x-jet-dialog-modal wire:model="open">
        {{-- necesita 3 slot --}}
        <x-slot name="title">
            Editar Post
        </x-slot>

        <x-slot name="content">

            <div class="mb-4">
                <x-jet-label value="Title:" />
                <x-jet-input type="text" wire:model="post.title" class="w-full" />
                <x-jet-input-error for="title" class="mt-3" />
            </div>
            <div class="mb-4">
                <x-jet-label value="Content:" />
                <x-jet-input type="text" wire:model="post.content" class="w-full" />
                <x-jet-input-error for="content" class="mt-3" />
            </div>
        </x-slot>

        <x-slot name="footer">
            {{-- metodo magico --}}
            <x-jet-secondary-button wire:click="$set('open', false)"> 
                Cancelar
            </x-jet-secondary-button>

            <x-jet-danger-button wire:click="save"  wire:loaging.attr="disabled" wire:target="save" class="disabled:opacity-25">
                Actualizar
            </x-jet-danger-button>

            
        </x-slot>

    </x-jet-dialog-modal>

</div>
