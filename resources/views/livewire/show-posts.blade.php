<div wire:init="loadPosts">
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
                <div class="flex items-center">
                    <span>Mostar</span>

                    <select class="mx-2" wire:model="cant">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>

                    <span>Entradas</span>
                </div>
                {{-- <input type="text" wire:model="search"> --}}
                <x-jet-input class="flex-1 mx-4" type="text" wire:model="search" placeholder="Buscar" />
                {{-- asi mando a llamar a otro componente | aqui esta otro componente reactivo --}} 
                @livewire('create-post') 
            </div>
            {{-- preguntamos si existe un post --}}
            @if(count($posts))
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
                            <th class="cursor-pointer px-4 py-2">Acciones
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($posts as $item)
                        <tr>
                            <td class="border px-4 py-2">{{$item->id}}</td>
                            <td class="border px-4 py-2">{{$item->title}}</td>
                            <td class="border px-4 py-2">{{$item->content}}</td>
                            <td class="border px-4 py-2 flex">
                                <a class="btn btn-green" wire:click="edit({{$item}})">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a class="btn btn-red ml-2" wire:click="$emit('deletePost', {{$item->id}} )">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table> 

                {{-- paginacion --}}
                @if ($posts->hasPages())
                <div class="px-6 py-4">
                    {{$posts->links()}}
                </div> 
        @endif
            @else 
                <div class="text-center px-6 py-4">
                    <h1>No existe ningun registro coincidente</h1>
                </div>
            @endif
            
            
            

    </div>
    <x-jet-dialog-modal wire:model="open_edit">
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
            <x-jet-secondary-button wire:click="$set('open_edit', false)"> 
                Cancelar
            </x-jet-secondary-button>

            <x-jet-danger-button wire:click="update"  wire:loaging.attr="disabled" wire:target="update" class="disabled:opacity-25">
                Actualizar
            </x-jet-danger-button>

            
        </x-slot>

    </x-jet-dialog-modal>

    @push('js')
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Livewire.on('deletePost' , postId => {
                Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {

                    Livewire.emitTo('show-posts', 'delete', postId);
                    Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                    )
                }
                })
            });
        </script>
    @endpush
    


</div>
</div>

</div>
