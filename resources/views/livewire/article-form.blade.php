<div>
    {{-- header --}}
    <x-slot name="header">
        {{-- //estilizar el titulo --}}
        <h1 class="font-semibold text-xl text-gray-800 leading-tight">
            {{-- titulo traducible --}}
            {{__('New Article')}}
        </h1>
    </x-slot>
<div>
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <x-jet-form-section submit="save">
            <x-slot name="title">
                {{__('New article')}}
            </x-slot>
            <x-slot name="description">
                {{__('Some description')}}
            </x-slot>
            <x-slot name="form">
                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="title" :value="__('Title')"/>
                    <x-jet-input wire:model="article.title" id="title" class="mt-1 block w-full" type="text" />
                    <x-jet-input-error for="article.title" class="mt-3" />
                </div>
                <div class="col-span-6 sm:col-span-4"">
                    <x-jet-label for="slug" :value="__('SLug')"/>
                    <x-jet-input wire:model="article.slug" id="slug" class="mt-1 block w-full" type="text" />
                    <x-jet-input-error for="article.slug" class="mt-3" />
                </div>
                <div class="col-span-6 sm:col-span-4"">
                    <x-jet-label for="content" :value="__('Content')"/>
                    <x-textarea wire:model="article.content" id="content" class="mt-1 block w-full" />
                    <x-jet-input-error for="article.content" class="mt-3" />
                </div>
                <x-slot name="actions">
                    <x-jet-button>
                        {{__('save')}}
                    </x-jet-button>
                </x-slot>
                
            </x-slot>
        </x-jet-form-section>
    </div>
</div>
</div>
