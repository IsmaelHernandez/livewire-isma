<div>
    {{-- header --}}
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-800 leading-tight">
            {{__('ShowPosts')}}
        </h1>
    </x-slot>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-12">
        <div class="bg-white overflow-hidder shadow-xl sm:rounded-lg px-4 py-4">
            <br>
            <div class="px-6 py-4 flex items-center">
                {{-- <input type="text" wire:model="search"> --}}
                <x-jet-input class="flex-1 mr-4" type="text" wire:model="search" placeholder="Buscar" />
                {{-- asi mando a llamar a otro componente --}}
                @livewire('create-post') 
            </div>
            {{-- preguntamos si existe un post --}}
            @if($posts->count())
                <table class="table-fixed w-full">
                    <thead>
                        <tr class="bg-indigo-600 text-white">
                            <th class="cursor-pointer px-4 py-2" wire:click="order('id')">ID
                                {{-- si lo que tenemos almacenado en sort es igual title imprime--}}
                                @if ($sort == 'id')

                                    @if ($direction == 'asc')
                                        <i class="fas fa-sort-alpha-up-alt float-right"></i>
                                    @else
                                        <i class="fas fa-sort-alpha-down-alt float-right"></i>
                                    @endif
                                    
                                @else
                                    <i class="fas fa-sort float-right"></i>
                                @endif
                            </th>
                            <th class="cursor-pointer px-4 py-2" wire:click="order('title')">Title
                                {{-- si lo que tenemos almacenado en sort es igual title imprime--}}
                                @if ($sort == 'title')

                                    @if ($direction == 'asc')
                                        <i class="fas fa-sort-alpha-up-alt float-right"></i>
                                    @else
                                        <i class="fas fa-sort-alpha-down-alt float-right"></i>
                                    @endif
                                    
                                @else
                                    <i class="fas fa-sort float-right"></i>
                                @endif
                            </th>
                            <th class="cursor-pointer px-4 py-2" wire:click="order('content')">Content
                                {{-- si lo que tenemos almacenado en sort es igual title imprime--}}
                                @if ($sort == 'content')

                                    @if ($direction == 'asc')
                                        <i class="fas fa-sort-alpha-up-alt float-right"></i>
                                    @else
                                        <i class="fas fa-sort-alpha-down-alt float-right"></i>
                                    @endif
                                    
                                @else
                                    <i class="fas fa-sort float-right"></i>
                                @endif

                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($posts as $post)
                        <tr>
                            <td class="border px-4 py-2">{{$post->id}}</td>
                            <td class="border px-4 py-2">{{$post->title}}</td>
                            <td class="border px-4 py-2">{{$post->content}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table> 
            @else 
                <div class="text-center px-6 py-4">
                    <h1>No existe ningun registro coincidente</h1>
                </div>
            @endif
    </div>
    </div>
</div>

</div>
